<?php
/* taqwim-disable taqwim/max-lines,taqwim/method.complexity, taqwim/method.max-depth,taqwim/no-nested-ternary*/
declare(strict_types=1);
namespace Carbon\Doc\Sponsors;
require __DIR__ . '/../vendor/autoload.php';

use Carbon\CarbonImmutable;

$destination_file = __DIR__ . '/../docs/public/data/backers.json';

function get_custom_sponsor_override(): array
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
			'image' => 'https://camo.githubusercontent.com/bdb8b8112771c6c3c6a86f5dfd789749542488474d767e5296f75d0c91d6d8e3/68747470733a2f2f6c67636e6577732e636f6d2f77702d636f6e74656e742f75706c6f6164732f323031382f30312f4c47432d6c6f676f2d76382d74656d702e706e67',

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

			// href attribute
			'website' => 'https://topcasino.net/',
        ],
    ];
}

function get_all_backers(): array
{
	$custom_sponsor_override = get_custom_sponsor_override();

	$members = json_decode(file_get_contents('https://opencollective.com/carbon/members/all.json'), true);

	foreach ($members as &$member) {
		$member = array_merge($member, $custom_sponsor_override[$member['MemberId']] ?? []);
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
		'lastTransactionAt' => CarbonImmutable::now()->format('Y-m-d') . ' 02:00',
		'lastTransactionAmount' => 25,
		'profile' => 'https://tidelift.com/',
		'name' => 'Tidelift',
		'description' => 'Get professional support for Carbon',
		'image' => '/sponsors/tidelift-brand.png',
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
		'image' => '/sponsors/slotozilla.png',
		'website' => 'https://www.slotozilla.com/nz/free-spins',
    ];

	return array_map(static function(array $member) {
        $created_at = CarbonImmutable::parse($member['createdAt']);
        $last_transaction_at = CarbonImmutable::parse($member['lastTransactionAt']);

        if ($created_at->format('d H:i:s.u') > $last_transaction_at->format('d H:i:s.u')) {
            $created_at = $created_at
                ->setDay($last_transaction_at->day)
                ->modify($last_transaction_at->format('H:i:s.u'));
        }

        $is_yearly = str_contains(strtolower($member['tier'] ?? ''), 'yearly');
        $monthly_contribution = (float) (
            $is_yearly && $last_transaction_at > CarbonImmutable::parse('-1 year')

            ? ($member['lastTransactionAmount'] / 11.2) // 11.2 instead of 12 to include the discount for yearly subscription
            : ($member['totalAmountDonated'] / ceil($created_at->floatDiffInMonths()))
            );

        if (!$is_yearly) {
            if (
                $last_transaction_at->isAfter('last month') &&
                $member['lastTransactionAmount'] > $monthly_contribution
            ) {
                $monthly_contribution = (float) $member['lastTransactionAmount'];
            }

            if ($last_transaction_at->isBefore('-75 days')) {
                $days = min(120, $last_transaction_at->diffInDays('now') - 70);
                $monthly_contribution *= 1 - $days / 240;
            }
        }

        $yearly_contribution = (float) (
            $is_yearly
            ? (12 * $monthly_contribution)
            : ($member['totalAmountDonated'] / max(1, $created_at->floatDiffInYears()))
            );
        $status = null;
        $rank = 0;

        if ($member['role'] === 'HOST') {
            $status = 'host';
            $rank = -1;
        } elseif ($monthly_contribution > 29 || $yearly_contribution > 700) {
            $status = 'sponsor';
            $rank = 4;
        } elseif ($monthly_contribution > 14.5 || $yearly_contribution > 500) {
            $status = 'backerPlus';
            $rank = 3;
        } elseif ($monthly_contribution > 4.5 || $yearly_contribution > 80) {
            $status = 'backer';
            $rank = 2;
        } elseif ($member['totalAmountDonated'] > 0) {
            $status = 'helper';
            $rank = 1;
        }

        return array_merge($member, [
            'star' => ($monthly_contribution > 98 || $yearly_contribution > 800),
            'status' => $status,
            'rank' => $rank,
            'monthlyContribution' => $monthly_contribution,
            'yearlyContribution' => $yearly_contribution,
        ]);
    }, $members);
}

file_put_contents($destination_file, json_encode(get_all_backers(), JSON_UNESCAPED_SLASHES));
function get_open_collective(string $status): string
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

		$content[$status] = implode('', array_map(static function(array $member) use ($status) {
            $href = htmlspecialchars($member['website'] ?? $member['profile']);
            $src = $member['image'] ?? (strtr($member['profile'], ['https://opencollective.com/' => 'https://images.opencollective.com/']) . '/avatar/256.png');
            [$x, $y] = @getimagesize($src) ?: [0, 0];
            $valid_image = ($x && $y);
            $src = $valid_image ? htmlspecialchars($src) : 'https://opencollective.com/static/images/default-guest-logo.svg';
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
            $width = $valid_image ? round($x * $height / $y) : $height;

            if (!str_contains($href, 'utm_source') && !preg_match('/^https?:\/\/(?:www\.)?(?:onlinekasyno-polis\.pl|zonaminecraft\.net|slotozilla\.com)(\/.*)?$/', $href)) {
                $href .= (!str_contains($href, '?') ? '?' : '&amp;') . 'utm_source=opencollective&amp;utm_medium=github&amp;utm_campaign=Carbon';
            }

            $title = htmlspecialchars(($member['description'] ?? null) ?: $member['name']);
            $alt = htmlspecialchars($member['name']);

            return "\n" . '        <a style="position: relative; margin: ' . $margin . 'px; display: inline-block; border: ' . ($height / 8) . 'px solid ' . ($member['star'] ? '#7ac35f' : 'transparent') . ';' . ($status === 'sponsor' ? ' background: white;' : ' border-radius: 50%; overflow: hidden;') . '" title="' . $title . '" href="' . $href . '" target="_blank">' .
            '<img alt="' . $alt . '" src="' . $src . '" width="' . min($width, 2 * $height) . '" height="' . $height . '">' .
            ($member['star'] ? '<span style="position: absolute; top: -15px; right: -15px; text-shadow: 0 0 3px black;">⭐</span>' : '') .
            '</a>';
        }, $list)) . "\n";
	}

	return $content[$status];
}
