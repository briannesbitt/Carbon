<?php

/**
 * This file is part of the Carbon package.
 *
 * (c) Brian Nesbitt <brian@nesbot.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Carbon\CarbonImmutable;

require_once __DIR__.'/vendor/autoload.php';

function getMaxHistoryMonthsByAmount($amount): int
{
    if ($amount >= 50) {
        return 6;
    }

    if ($amount >= 20) {
        return 4;
    }

    return 2;
}

function getHtmlAttribute($rawValue): string
{
    return str_replace(
        ['​', "\r"],
        '',
        trim(htmlspecialchars((string) $rawValue), "  \n\r\t\v\0"),
    );
}

function getOpenCollectiveSponsors(): string
{
    $customSponsorImages = [
        // For consistency and equity among sponsors, as of now, we kindly ask our sponsors
        // to provide an image having a width/height ratio between 1/1 and 2/1.
        // By default, we'll show the member picture from OpenCollective, and will resize it if bigger
        // int(OpenCollective.MemberId) => ImageURL
    ];

    $members = json_decode(file_get_contents('https://opencollective.com/carbon/members/all.json'), true);

    $list = array_filter($members, static function ($member): bool {
        return ($member['lastTransactionAmount'] > 3 || $member['isActive']) &&
            $member['role'] === 'BACKER' &&
            $member['type'] !== 'USER' &&
            (
                $member['totalAmountDonated'] > 100 ||
                $member['lastTransactionAt'] > CarbonImmutable::now()
                    ->subMonthsNoOverflow(getMaxHistoryMonthsByAmount($member['lastTransactionAmount']))
                    ->format('Y-m-d h:i') ||
                $member['isActive'] && $member['lastTransactionAmount'] >= 30
            );
    });

    $list = array_map(static function (array $member): array {
        $createdAt = CarbonImmutable::parse($member['createdAt']);
        $lastTransactionAt = CarbonImmutable::parse($member['lastTransactionAt']);

        if ($createdAt->format('d H:i:s.u') > $lastTransactionAt->format('d H:i:s.u')) {
            $createdAt = $createdAt
                ->setDay($lastTransactionAt->day)
                ->modify($lastTransactionAt->format('H:i:s.u'));
        }

        $monthlyContribution = (float) ($member['totalAmountDonated'] / ceil($createdAt->floatDiffInMonths()));

        if (
            $lastTransactionAt->isAfter('last month') &&
            $member['lastTransactionAmount'] > $monthlyContribution
        ) {
            $monthlyContribution = (float) $member['lastTransactionAmount'];
        }

        $yearlyContribution = (float) ($member['totalAmountDonated'] / max(1, $createdAt->floatDiffInYears()));
        $status = null;

        if ($monthlyContribution > 29) {
            $status = 'sponsor';
        } elseif ($monthlyContribution > 14.5) {
            $status = 'backerPlus';
        } elseif ($monthlyContribution > 4.5 || $yearlyContribution > 40) {
            $status = 'backer';
        } elseif ($member['totalAmountDonated'] > 0) {
            $status = 'helper';
        }

        return array_merge($member, [
            'star' => ($monthlyContribution > 98 || $yearlyContribution > 500),
            'status' => $status,
            'monthlyContribution' => $monthlyContribution,
            'yearlyContribution' => $yearlyContribution,
        ]);
    }, $list);

    usort($list, static function (array $a, array $b): int {
        return ($b['monthlyContribution'] <=> $a['monthlyContribution'])
            ?: ($b['totalAmountDonated'] <=> $a['totalAmountDonated']);
    });

    return implode('', array_map(static function (array $member) use ($customSponsorImages): string {
        $href = htmlspecialchars($member['website'] ?? $member['profile']);
        $src = $customSponsorImages[$member['MemberId'] ?? ''] ?? $member['image'] ?? (strtr($member['profile'], ['https://opencollective.com/' => 'https://images.opencollective.com/']).'/avatar/256.png');
        [$x, $y] = @getimagesize($src) ?: [0, 0];
        $validImage = ($x && $y);
        $src = $validImage ? htmlspecialchars($src) : 'https://opencollective.com/static/images/default-guest-logo.svg';
        $height = match ($member['status']) {
            'sponsor' => 64,
            'backerPlus' => 42,
            'backer' => 32,
            default => 24,
        };
        $rel = match ($member['status']) {
            'sponsor', 'backerPlus' => '',
            default => ' rel="sponsored"',
        };

        $width = min($height * 2, $validImage ? round($x * $height / $y) : $height);
        $href .= (strpos($href, '?') === false ? '?' : '&amp;').'utm_source=opencollective&amp;utm_medium=github&amp;utm_campaign=Carbon';
        $title = getHtmlAttribute(($member['description'] ?? null) ?: $member['name']);
        $alt = getHtmlAttribute($member['name']);

        return "\n".'<a title="'.$title.'" href="'.$href.'" target="_blank"'.$rel.'>'.
            '<img alt="'.$alt.'" src="'.$src.'" width="'.$width.'" height="'.$height.'">'.
            '</a>';
    }, $list))."\n";
}

file_put_contents('readme.md', preg_replace_callback(
    '/(<!-- <open-collective-sponsors> -->)[\s\S]+(<!-- <\/open-collective-sponsors> -->)/',
    static function (array $match): string {
        return $match[1].getOpenCollectiveSponsors().$match[2];
    },
    file_get_contents('readme.md')
));
