<?php

/*
 * This file is part of the Carbon package.
 *
 * (c) Brian Nesbitt <brian@nesbot.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

return [
    'year' => ':count godina|:count godine|:count godina',
    'y' => ':count godina|:count godine|:count godina',
    'month' => ':count mjesec|:count mjeseca|:count mjeseci',
    'm' => ':count mjesec|:count mjeseca|:count mjeseci',
    'week' => ':count nedjelja|:count nedjelje|:count nedjelja',
    'w' => ':count nedjelja|:count nedjelje|:count nedjelja',
    'day' => ':count dan|:count dana|:count dana',
    'd' => ':count dan|:count dana|:count dana',
    'hour' => ':count sat|:count sata|:count sati',
    'h' => ':count sat|:count sata|:count sati',
    'minute' => ':count minut|:count minuta|:count minuta',
    'min' => ':count minut|:count minuta|:count minuta',
    'second' => ':count sekund|:count sekunda|:count sekundi',
    's' => ':count sekund|:count sekunda|:count sekundi',
    'ago' => 'prije :time',
    'from_now' => 'za :time',
    'after' => 'nakon :time',
    'before' => ':time ranije',
    'diff_yesterday' => 'jučer',
    'diff_tomorrow' => 'sutra',
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
        'nextWeek' => function (\Carbon\CarbonInterface $current) {
            switch ($current->dayOfWeek) {
                case 0:
                    return '[u] [nedjelju] [u] LT';
                case 3:
                    return '[u] [srijedu] [u] LT';
                case 6:
                    return '[u] [subotu] [u] LT';
                default:
                    return '[u] dddd [u] LT';
            }
        },
        'lastDay' => '[jučer u] LT',
        'lastWeek' => function (\Carbon\CarbonInterface $current) {
            switch ($current->dayOfWeek) {
                case 0:
                case 3:
                    return '[prošlu] dddd [u] LT';
                case 6:
                    return '[prošle] [subote] [u] LT';
                default:
                    return '[prošli] dddd [u] LT';
            }
        },
        'sameElse' => 'L',
    ],
    'ordinal' => ':number.',
    'months' => ['januar', 'februar', 'mart', 'april', 'maj', 'juni', 'juli', 'august', 'septembar', 'oktobar', 'novembar', 'decembar'],
    'months_short' => ['jan.', 'feb.', 'mar.', 'apr.', 'maj.', 'jun.', 'jul.', 'aug.', 'sep.', 'okt.', 'nov.', 'dec.'],
    'weekdays' => ['nedjelja', 'ponedjeljak', 'utorak', 'srijeda', 'četvrtak', 'petak', 'subota'],
    'weekdays_short' => ['ned.', 'pon.', 'uto.', 'sri.', 'čet.', 'pet.', 'sub.'],
    'weekdays_min' => ['ne', 'po', 'ut', 'sr', 'če', 'pe', 'su'],
    'first_day_of_week' => 1,
    'day_of_first_week_of_year' => 1,
];
