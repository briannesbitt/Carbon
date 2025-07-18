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
    $customSponsorOverride = [
        // For consistency and equity among sponsors, as of now, we kindly ask our sponsors
        // to provide an image having a width/height ratio between 1/1 and 2/1.
        // By default, we'll show the member picture from OpenCollective, and will resize it if bigger
        662698 => [
            // alt attribute
            'name' => 'Non Gamstop Casinos',
            // title attribute
            'description' => 'Casinos not on Gamstop',
            // src attribute
            'image' => 'https://lgcnews.com/wp-content/uploads/2018/01/LGC-logo-v8-temp.png',
            // href attribute
            'website' => 'https://lgcnews.com/',
        ],
        663069 => [
            // alt attribute
            'name' => 'Ставки на спорт Favbet',
            // href attribute
            'website' => 'https://www.favbet.ua/uk/',
        ],
        676798 => [
            // alt attribute
            'name' => 'Top Casinos Canada',
            // title attribute
            'description' => 'Top Casinos Canada',
            // src attribute
            'image' => 'https://topcasino.net/img/topcasino-logo-cover.png',
            // href attribute
            'website' => 'https://topcasino.net/',
        ],
    ];

    $members = json_decode(file_get_contents('https://opencollective.com/carbon/members/all.json'), true);

    foreach ($members as &$member) {
        $member = array_merge($member, $customSponsorOverride[$member['MemberId']] ?? []);
    }

    // Adding sponsors paying via other payment methods
    $members[] = [
        'MemberId' => 1,
        'createdAt' => '2019-01-01 02:00',
        'type' => 'ORGANIZATION',
        'role' => 'BACKER',
        'tier' => 'backer+',
        'isActive' => true,
        'totalAmountDonated' => 1000,
        'currency' => 'USD',
        'lastTransactionAt' => CarbonImmutable::now()->format('Y-m-d').' 02:00',
        'lastTransactionAmount' => 25,
        'profile' => 'https://tidelift.com/',
        'name' => 'Tidelift',
        'description' => 'Get professional support for Carbon',
        'image' => 'https://carbon.nesbot.com/docs/sponsors/tidelift-brand.png',
        'website' => 'https://tidelift.com/subscription/pkg/packagist-nesbot-carbon?utm_source=packagist-nesbot-carbon&utm_medium=referral&utm_campaign=docs',
    ];
    $members[] = [
        'MemberId' => 2,
        'createdAt' => '2024-11-14 02:00',
        'type' => 'ORGANIZATION',
        'role' => 'BACKER',
        'tier' => 'backer+ yearly',
        'isActive' => true,
        'totalAmountDonated' => 170,
        'currency' => 'USD',
        'lastTransactionAt' => '2024-11-14 02:00',
        'lastTransactionAmount' => 170,
        'profile' => 'https://www.slotozilla.com/nz/free-spins',
        'name' => 'Slotozilla',
        'description' => 'Slotozilla website',
        'image' => 'https://carbon.nesbot.com/docs/sponsors/slotozilla.png',
        'website' => 'https://www.slotozilla.com/nz/free-spins',
    ];

    $list = array_filter($members, static fn (array $member): bool => $member['totalAmountDonated'] > 3 && $member['role'] !== 'HOST' && (
        $member['totalAmountDonated'] > 100 ||
        $member['lastTransactionAt'] > CarbonImmutable::now()
            ->subMonthsNoOverflow(getMaxHistoryMonthsByAmount($member['lastTransactionAmount']))
            ->format('Y-m-d h:i') ||
        $member['isActive'] && $member['lastTransactionAmount'] >= 30
    ));

    $list = array_map(static function (array $member): array {
        $createdAt = CarbonImmutable::parse($member['createdAt']);
        $lastTransactionAt = CarbonImmutable::parse($member['lastTransactionAt']);

        if ($createdAt->format('d H:i:s.u') > $lastTransactionAt->format('d H:i:s.u')) {
            $createdAt = $createdAt
                ->setDay($lastTransactionAt->day)
                ->modify($lastTransactionAt->format('H:i:s.u'));
        }

        $isYearly = str_contains(strtolower($member['tier'] ?? ''), 'yearly');
        $monthlyContribution = (float) (
            ($isYearly && $lastTransactionAt > CarbonImmutable::parse('-1 year'))
                ? ($member['lastTransactionAmount'] / 11.2) // 11.2 instead of 12 to include the discount for yearly subscription
                : ($member['totalAmountDonated'] / ceil($createdAt->floatDiffInMonths()))
        );

        if (!$isYearly) {
            if (
                $lastTransactionAt->isAfter('last month') &&
                $member['lastTransactionAmount'] > $monthlyContribution
            ) {
                $monthlyContribution = (float) $member['lastTransactionAmount'];
            }

            if ($lastTransactionAt->isBefore('-75 days')) {
                $days = min(120, $lastTransactionAt->diffInDays('now') - 70);
                $monthlyContribution *= 1 - $days / 240;
            }
        }

        $yearlyContribution = (float) (
            $isYearly
                ? (12 * $monthlyContribution)
                : ($member['totalAmountDonated'] / max(1, $createdAt->floatDiffInYears()))
        );
        $status = null;
        $rank = 0;

        if ($monthlyContribution > 50 || $yearlyContribution > 900) {
            $status = 'sponsor';
            $rank = 5;
        } elseif ($monthlyContribution > 29 || $yearlyContribution > 700) {
            $status = 'sponsor';
            $rank = 4;
        } elseif ($monthlyContribution > 14.5 || $yearlyContribution > 500) {
            $status = 'backerPlus';
            $rank = 3;
        } elseif ($monthlyContribution > 4.5 || $yearlyContribution > 80) {
            $status = 'backer';
            $rank = 2;
        } elseif ($member['totalAmountDonated'] > 0) {
            $status = 'helper';
            $rank = 1;
        }

        return array_merge($member, [
            'star' => ($monthlyContribution > 98 || $yearlyContribution > 800),
            'status' => $status,
            'rank' => $rank,
            'monthlyContribution' => $monthlyContribution,
            'yearlyContribution' => $yearlyContribution,
        ]);
    }, $list);

    usort($list, static function (array $a, array $b): int {
        return ($b['star'] <=> $a['star'])
            ?: ($b['rank'] <=> $a['rank'])
            ?: ($b['monthlyContribution'] <=> $a['monthlyContribution'])
            ?: ($b['totalAmountDonated'] <=> $a['totalAmountDonated']);
    });

    $membersByUrl = [];
    $output = '';
    $extra = '';

    foreach ($list as $member) {
        $url = $member['website'] ?? $member['profile'];

        if (isset($membersByUrl[$url]) || !\in_array($member['status'], ['sponsor', 'backerPlus'], true)) {
            continue;
        }

        $membersByUrl[$url] = $member;
        $href = htmlspecialchars($url);
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

        if (!str_contains($href, 'utm_source') && !preg_match('/^https?:\/\/(?:www\.)?(?:onlinekasyno-polis\.pl|zonaminecraft\.net|slotozilla\.com)(\/.*)?/', $href)) {
            $href .= (!str_contains($href, '?') ? '?' : '&amp;').'utm_source=opencollective&amp;utm_medium=github&amp;utm_campaign=Carbon';
        }

        $title = getHtmlAttribute(($member['description'] ?? null) ?: $member['name']);
        $alt = getHtmlAttribute($member['name']);

        if ($member['star']) {
            $width *= 1.5;
            $height *= 1.5;
        }

        $link = "\n".'<a title="'.$title.'" href="'.$href.'" target="_blank"'.$rel.'>'.
            '<img alt="'.$alt.'" src="'.$src.'" width="'.$width.'" height="'.$height.'">'.
            '</a>';

        if ($member['rank'] >= 5) {
            $output .= $link;

            continue;
        }

        $extra .= $link;
    }

    $github = [
        8343178 => 'ssddanbrown',
    ];

    foreach ($github as $avatar => $user) {
        $extra .= "\n".'<a title="'.$user.'" href="https://github.com/'.$user.'" target="_blank">'.
            '<img alt="'.$user.'" src="https://avatars.githubusercontent.com/u/'.$avatar.'?s=128&v=4" width="42" height="42">'.
            '</a>';
    }

    return $output.'<details><summary>See more</summary>'.$extra.'</details>';
}

file_put_contents('readme.md', preg_replace_callback(
    '/(<!-- <open-collective-sponsors> -->)[\s\S]+(<!-- <\/open-collective-sponsors> -->)/',
    static function (array $match): string {
        return $match[1].getOpenCollectiveSponsors().$match[2];
    },
    file_get_contents('readme.md'),
));
