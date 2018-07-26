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
    'year' => ':count Joer',
    'y' => ':countJ',
    'month' => ':count Mount|:count Méint',
    'm' => ':countMo',
    'week' => ':count Woch|:count Wochen',
    'w' => ':countWo|:countWo',
    'day' => ':count Dag|:count Deeg',
    'd' => ':countD',
    'hour' => ':count Stonn|:count Stonnen',
    'h' => ':countSto',
    'minute' => ':count Minutt|:count Minutten',
    'min' => ':countM',
    'second' => ':count Sekonnen',
    's' => ':countSek',

    'formats' => [
        'LT' => 'H:mm [Auer]',
        'LTS' => 'H:mm:ss [Auer]',
        'L' => 'DD.MM.YYYY',
        'LL' => 'D. MMMM YYYY',
        'LLL' => 'D. MMMM YYYY H:mm [Auer]',
        'LLLL' => 'dddd, D. MMMM YYYY H:mm [Auer]',
    ],

    'calendar' => [
        'sameDay' => '[Haut um] LT',
        'nextDay' => '[Muer um] LT',
        'nextWeek' => 'dddd [um] LT',
        'lastDay' => '[Gëschter um] LT',
        'lastWeek' => function (\Carbon\CarbonInterface $date) {
            // Different date string for 'Dënschdeg' (Tuesday) and 'Donneschdeg' (Thursday) due to phonological rule
            switch ($date->dayOfWeek) {
                case 2:
                case 4:
                    return '[Leschten] dddd [um] LT';
                default:
                    return '[Leschte] dddd [um] LT';
            }
        },
        'sameElse' => 'L',
    ],

    'months' => ['Januar', 'Februar', 'Mäerz', 'Abrëll', 'Mee', 'Juni', 'Juli', 'August', 'September', 'Oktober', 'November', 'Dezember'],
    'months_short' => ['Jan.', 'Febr.', 'Mrz.', 'Abr.', 'Mee', 'Jun.', 'Jul.', 'Aug.', 'Sept.', 'Okt.', 'Nov.', 'Dez.'],
    'weekdays' => ['Sonndeg', 'Méindeg', 'Dënschdeg', 'Mëttwoch', 'Donneschdeg', 'Freideg', 'Samschdeg'],
    'weekdays_short' => ['So.', 'Mé.', 'Dë.', 'Më.', 'Do.', 'Fr.', 'Sa.'],
    'weekdays_min' => ['So', 'Mé', 'Dë', 'Më', 'Do', 'Fr', 'Sa'],
    'ordinal' => ':number.',
    'first_day_of_week' => 1,
    'day_of_first_week_of_year' => 4,
];
