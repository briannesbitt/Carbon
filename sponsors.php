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

function getOpenCollectiveSponsors(): string
{
    $members = json_decode(file_get_contents('https://opencollective.com/carbon/members/all.json'), true);
    $sixMonthsAgo = CarbonImmutable::parse('now - 6 months')->format('Y-m-d h:i');

    $list = array_filter($members, static function ($member) use ($sixMonthsAgo) {
        return ($member['lastTransactionAmount'] > 3 || $member['isActive']) &&
            $member['role'] === 'BACKER' &&
            $member['type'] !== 'USER' &&
            ($member['totalAmountDonated'] > 100 || $member['lastTransactionAt'] > $sixMonthsAgo || $member['isActive'] && $member['lastTransactionAmount'] >= 30);
    });

    $list = array_map(static function (array $member) {
        $createdAt = CarbonImmutable::parse($member['createdAt']);
        $monthlyContribution = (float) ($member['totalAmountDonated'] / (1 + $createdAt->diffInMonths()));

        if (
            CarbonImmutable::parse($member['lastTransactionAt'])->isAfter('last month') &&
            $member['lastTransactionAmount'] > $monthlyContribution
        ) {
            $monthlyContribution = (float) $member['lastTransactionAmount'];
        }

        $yearlyContribution = (float) ($member['totalAmountDonated'] / max(1, $createdAt->floatDiffInYears()));
        $status = null;

        if ($monthlyContribution > 29) {
            $status = 'sponsor';
        } elseif ($monthlyContribution > 3 || $yearlyContribution > 20) {
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

    usort($list, static function (array $a, array $b) {
        return ($b['monthlyContribution'] <=> $a['monthlyContribution'])
            ?: ($b['totalAmountDonated'] <=> $a['totalAmountDonated']);
    });

    return implode('', array_map(static function (array $member) {
        $href = htmlspecialchars($member['website'] ?? $member['profile']);
        $src = $member['image'] ?? (strtr($member['profile'], ['https://opencollective.com/' => 'https://images.opencollective.com/']).'/avatar/256.png');
        [$x, $y] = @getimagesize($src) ?: [0, 0];
        $validImage = ($x && $y);
        $src = $validImage ? htmlspecialchars($src) : 'https://opencollective.com/static/images/default-guest-logo.svg';
        $height = 64;
        $width = $validImage ? round($x * $height / $y) : $height;
        $href .= (strpos($href, '?') === false ? '?' : '&amp;').'utm_source=opencollective&amp;utm_medium=github&amp;utm_campaign=Carbon';
        $title = htmlspecialchars(($member['description'] ?? null) ?: $member['name']);
        $alt = htmlspecialchars($member['name']);

        return "\n".'<a title="'.$title.'" href="'.$href.'" target="_blank" rel="sponsored">'.
            '<img alt="'.$alt.'" src="'.$src.'" width="'.$width.'" height="'.$height.'">'.
            '</a>';
    }, $list))."\n";
}

file_put_contents('readme.md', preg_replace_callback(
    '/(<!-- <open-collective-sponsors> -->)[\s\S]+(<!-- <\/open-collective-sponsors> -->)/',
    static function (array $match) {
        return $match[1].getOpenCollectiveSponsors().$match[2];
    },
    file_get_contents('readme.md')
));
