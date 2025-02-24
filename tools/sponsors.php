<?php

declare(strict_types=1);

namespace Carbon\Doc\Sponsors;

use Carbon\CarbonImmutable;

function getCustomSponsorOverride(): array
{
    return [
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
    ];
}

function getAllBackers(): array
{
    $customSponsorOverride = getCustomSponsorOverride();

    $members = json_decode(file_get_contents('https://opencollective.com/carbon/members/all.json'), true);

    foreach ($members as &$member) {
        $member = array_merge($member, $customSponsorOverride[$member['MemberId']] ?? []);
    }

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
        'image' => '/docs/sponsors/tidelift-brand.png',
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
        'image' => '/docs/sponsors/slotozilla.png',
        'website' => 'https://www.slotozilla.com/nz/free-spins',
    ];

    return array_map(static function (array $member) {
        $createdAt = CarbonImmutable::parse($member['createdAt']);
        $lastTransactionAt = CarbonImmutable::parse($member['lastTransactionAt']);

        if ($createdAt->format('d H:i:s.u') > $lastTransactionAt->format('d H:i:s.u')) {
            $createdAt = $createdAt
                ->setDay($lastTransactionAt->day)
                ->modify($lastTransactionAt->format('H:i:s.u'));
        }

        $isYearly = str_contains(strtolower($member['tier'] ?? ''), 'yearly');
        $monthlyContribution = (float) (
        $isYearly && $lastTransactionAt > CarbonImmutable::parse('-1 year')
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

        if ($member['role'] === 'HOST') {
            $status = 'host';
            $rank = -1;
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
    }, $members);
}

function getOpenCollective(string $status): string
{
    static $content = [];
    static $members = null;

    $members = $members ?? getAllBackers();

    if (!isset($content[$status])) {
        $list = array_filter($members, static fn ($item) => ($item['status'] ?? null) === $status);

        usort($list, static fn (array $a, array $b) => (
        ($b['star'] <=> $a['star'])
            ?: ($b['rank'] <=> $a['rank'])
            ?: ($b['monthlyContribution'] <=> $a['monthlyContribution'])
                ?: ($b['totalAmountDonated'] <=> $a['totalAmountDonated'])
        ));

        $content[$status] = implode('', array_map(static function (array $member) use ($status) {
                $href = htmlspecialchars($member['website'] ?? $member['profile']);
                $src = $member['image'] ?? (strtr($member['profile'], ['https://opencollective.com/' => 'https://images.opencollective.com/']).'/avatar/256.png');
                [$x, $y] = @getimagesize($src) ?: [0, 0];
                $validImage = ($x && $y);
                $src = $validImage ? htmlspecialchars($src) : 'https://opencollective.com/static/images/default-guest-logo.svg';
                $height = match ($status) {
                    'sponsor' => 64,
                    'backerPlus' => 42,
                    'backer' => 32,
                    default => 24,
                };
                $margin = match ($status) {
                    'sponsor' => 10,
                    'backerPlus' => 6,
                    'backer' => 5,
                    default => 3,
                };
                $width = $validImage ? round($x * $height / $y) : $height;

                if (!str_contains($href, 'utm_source') && !preg_match('/^https?:\/\/(?:www\.)?(?:onlinekasyno-polis\.pl|zonaminecraft\.net|slotozilla\.com)(\/.*)?$/', $href)) {
                    $href .= (!str_contains($href, '?') ? '?' : '&amp;').'utm_source=opencollective&amp;utm_medium=github&amp;utm_campaign=Carbon';
                }

                $title = htmlspecialchars(($member['description'] ?? null) ?: $member['name']);
                $alt = htmlspecialchars($member['name']);

                return "\n".'        <a style="position: relative; margin: '.$margin.'px; display: inline-block; border: '.($height / 8).'px solid '.($member['star'] ? '#7ac35f' : 'transparent').';'.($status === 'sponsor' ? ' background: white;' : ' border-radius: 50%; overflow: hidden;').'" title="'.$title.'" href="'.$href.'" target="_blank">'.
                    '<img alt="'.$alt.'" src="'.$src.'" width="'.min($width, 2 * $height).'" height="'.$height.'">'.
                    ($member['star'] ? '<span style="position: absolute; top: -15px; right: -15px; text-shadow: 0 0 3px black;">⭐</span>' : '').
                    '</a>';
            }, $list))."\n    ";
    }

    return $content[$status];
}
