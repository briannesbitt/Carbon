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
 * - Josh Soref
 * - François B
 * - shaishavgandhi05
 * - Serhan Apaydın
 * - JD Isaacks
 * - Glavić
 * - Milos Sakovic
 */
return [
    'year' => ':count godina|:count godine|:count godina',
    'y' => ':count g.',
    'month' => ':count mesec|:count meseca|:count meseci',
    'm' => ':count mj.',
    'week' => ':count nedelja|:count nedelje|:count nedelja',
    'w' => ':count ned.',
    'day' => ':count dan|:count dana|:count dana',
    'd' => ':count d.',
    'hour' => ':count sat|:count sata|:count sati',
    'h' => ':count č.',
    'minute' => ':count minut|:count minuta|:count minuta',
    'min' => ':count min.',
    'second' => ':count sekundu|:count sekunde|:count sekundi',
    's' => ':count sek.',
    'ago' => 'pre :time',
    'from_now' => 'za :time',
    'after' => 'nakon :time',
    'before' => 'pre :time',

    'year_from_now' => ':count godinu|:count godine|:count godina',
    'year_ago' => ':count godinu|:count godine|:count godina',
    'week_from_now' => ':count nedelju|:count nedelje|:count nedelja',
    'week_ago' => ':count nedelju|:count nedelje|:count nedelja',

    'diff_now' => 'upravo sada',
    'diff_yesterday' => 'juče',
    'diff_tomorrow' => 'sutra',
    'diff_before_yesterday' => 'prekjuče',
    'diff_after_tomorrow' => 'preksutra',
    'formats' => [
        'LT' => 'H:mm',
        'LTS' => 'H:mm:ss',
        'L' => 'DD.MM.YYYY',
        'LL' => 'D. MMMM YYYY',
        'LLL' => 'D. MMMM YYYY H:mm',
        'LLLL' => 'dddd, D. MMMM YYYY H:mm',
    ],
    'calendar' => [
        'sameDay' => '[danas u] LT',
        'nextDay' => '[sutra u] LT',
        'nextWeek' => function (\Carbon\CarbonInterface $date) {
            switch ($date->dayOfWeek) {
                case 0:
                    return '[u nedelju u] LT';
                case 3:
                    return '[u sredu u] LT';
                case 6:
                    return '[u subotu u] LT';
                default:
                    return '[u] dddd [u] LT';
            }
        },
        'lastDay' => '[juče u] LT',
        'lastWeek' => function (\Carbon\CarbonInterface $date) {
            switch ($date->dayOfWeek) {
                case 0:
                    return '[prošle nedelje u] LT';
                case 1:
                    return '[prošlog ponedeljka u] LT';
                case 2:
                    return '[prošlog utorka u] LT';
                case 3:
                    return '[prošle srede u] LT';
                case 4:
                    return '[prošlog četvrtka u] LT';
                case 5:
                    return '[prošlog petka u] LT';
                default:
                    return '[prošle subote u] LT';
            }
        },
        'sameElse' => 'L',
    ],
    'ordinal' => ':number.',
    'months' => ['januar', 'februar', 'mart', 'april', 'maj', 'jun', 'jul', 'avgust', 'septembar', 'oktobar', 'novembar', 'decembar'],
    'months_short' => ['jan.', 'feb.', 'mar.', 'apr.', 'maj', 'jun', 'jul', 'avg.', 'sep.', 'okt.', 'nov.', 'dec.'],
    'weekdays' => ['nedelja', 'ponedeljak', 'utorak', 'sreda', 'četvrtak', 'petak', 'subota'],
    'weekdays_short' => ['ned.', 'pon.', 'uto.', 'sre.', 'čet.', 'pet.', 'sub.'],
    'weekdays_min' => ['ne', 'po', 'ut', 'sr', 'če', 'pe', 'su'],
    'first_day_of_week' => 1,
    'day_of_first_week_of_year' => 1,
    'list' => [', ', ' i '],
];
