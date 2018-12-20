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
    'month' => ':count mesec|:count meseca|:count meseci',
    'm' => ':count mesec|:count meseca|:count meseci',
    'week' => ':count nedelja|:count nedelje|:count nedelja',
    'w' => ':count nedelja|:count nedelje|:count nedelja',
    'day' => ':count dan|:count dana|:count dana',
    'd' => ':count dan|:count dana|:count dana',
    'hour' => ':count sat|:count sata|:count sati',
    'h' => ':count sat|:count sata|:count sati',
    'minute' => ':count minut|:count minuta |:count minuta',
    'min' => ':count minut|:count minuta |:count minuta',
    'second' => ':count sekund|:count sekunde|:count sekunde',
    's' => ':count sekund|:count sekunde|:count sekunde',
    'ago' => 'pre :time',
    'from_now' => 'za :time',
    'after' => 'nakon :time',
    'before' => 'pre :time',
    'year_from_now' => '{1,21,31,41,51}:count godinu|{0,2,3,4,22,23,24,32,33,34,42,43,44,52,53,54}:count godine|[0,Inf[:count godina',
    'year_ago' => '{1,21,31,41,51}:count godinu|{0,2,3,4,22,23,24,32,33,34,42,43,44,52,53,54}:count godine|[0,Inf[:count godina',
    'week_from_now' => '{1}:count nedelju|{0,2,3,4}:count nedelje|[0,Inf[:count nedelja',
    'week_ago' => '{1}:count nedelju|{0,2,3,4}:count nedelje|[0,Inf[:count nedelja',
    'diff_yesterday' => 'juče',
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
        'nextWeek' => function (\Carbon\CarbonInterface $date) {
            switch ($date->dayOfWeek) {
                case 0:
                    return '[у недељу у] LT';
                case 3:
                    return '[у среду у] LT';
                case 6:
                    return '[у суботу у] LT';
                default:
                    return '[у] dddd [у] LT';
            }
        },
        'lastDay' => '[juče u] LT',
        'lastWeek' => function (\Carbon\CarbonInterface $date) {
            switch ($date->dayOfWeek) {
                case 0:
                    return '[прошле недеље у] LT';
                case 1:
                    return '[прошлог понедељка у] LT';
                case 2:
                    return '[прошлог уторка у] LT';
                case 3:
                    return '[прошле среде у] LT';
                case 4:
                    return '[прошлог четвртка у] LT';
                case 5:
                    return '[прошлог петка у] LT';
                default:
                    return '[прошле суботе у] LT';
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
