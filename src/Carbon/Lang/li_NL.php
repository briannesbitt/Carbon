<?php

/**
 * This file is part of the Carbon package.
 *
 * (c) Brian Nesbitt <brian@nesbot.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * Authors:
 * - information from Kenneth Christiansen Kenneth Christiansen, Pablo Saratxaga kenneth@gnu.org, pablo@mandriva.com
 */return array_replace_recursive(require __DIR__.'/en.php', [
    'formats' => [
        'L' => 'DD.MM.YYYY',
    ],
    'months' => ['jannewarie', 'fibberwarie', 'miert', 'eprèl', 'meij', 'junie', 'julie', 'augustus', 'september', 'oktober', 'november', 'desember'],
    'months_short' => ['jan', 'fib', 'mie', 'epr', 'mei', 'jun', 'jul', 'aug', 'sep', 'okt', 'nov', 'des'],
    'weekdays' => ['zóndig', 'maondig', 'daensdig', 'goonsdig', 'dónderdig', 'vriedig', 'zaoterdig'],
    'weekdays_short' => ['zón', 'mao', 'dae', 'goo', 'dón', 'vri', 'zao'],
    'weekdays_min' => ['zón', 'mao', 'dae', 'goo', 'dón', 'vri', 'zao'],
    'first_day_of_week' => 1,
    'day_of_first_week_of_year' => 4,
]);
