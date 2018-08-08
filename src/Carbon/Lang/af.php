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
    'year' => '\'n jaar|:count jare',
    'y' => ':count jaar|:count jare',
    'month' => '\'n maand|:count maande',
    'm' => ':count maand|:count maande',
    'week' => ':count week|:count weke',
    'w' => ':count week|:count weke',
    'day' => '\'n dag|:count dae',
    'd' => ':count dag|:count dae',
    'hour' => '\'n uur|:count ure',
    'h' => ':count uur|:count ure',
    'minute' => '\'n minuut|:count minute',
    'min' => ':count minuut|:count minute',
    'second' => '\'n paar sekondes|:count sekondes',
    's' => ':count sekond|:count sekondes',
    'ago' => ':time gelede',
    'from_now' => 'oor :time',
    'after' => ':time na',
    'before' => ':time voor',
    'diff_yesterday' => 'Gister',
    'diff_tomorrow' => 'Môre',
    'formats' => [
        'LT' => 'HH:mm',
        'LTS' => 'HH:mm:ss',
        'L' => 'DD/MM/YYYY',
        'LL' => 'D MMMM YYYY',
        'LLL' => 'D MMMM YYYY HH:mm',
        'LLLL' => 'dddd, D MMMM YYYY HH:mm',
    ],
    'calendar' => [
        'sameDay' => '[Vandag om] LT',
        'nextDay' => '[Môre om] LT',
        'nextWeek' => 'dddd [om] LT',
        'lastDay' => '[Gister om] LT',
        'lastWeek' => '[Laas] dddd [om] LT',
        'sameElse' => 'L',
    ],
    'ordinal' => function ($number, $period) {
        return $number.(($number === 1 || $number === 8 || $number >= 20) ? 'ste' : 'de');
    },
    'meridiem' => function ($hour, $minute, $isLower) {
        $meridiem = $hour < 12 ? 'VM' : 'NM';

        return $isLower ? strtolower($meridiem) : $meridiem;
    },
    'months' => ['Januarie', 'Februarie', 'Maart', 'April', 'Mei', 'Junie', 'Julie', 'Augustus', 'September', 'Oktober', 'November', 'Desember'],
    'months_short' => ['Jan', 'Feb', 'Mrt', 'Apr', 'Mei', 'Jun', 'Jul', 'Aug', 'Sep', 'Okt', 'Nov', 'Des'],
    'weekdays' => ['Sondag', 'Maandag', 'Dinsdag', 'Woensdag', 'Donderdag', 'Vrydag', 'Saterdag'],
    'weekdays_short' => ['Son', 'Maa', 'Din', 'Woe', 'Don', 'Vry', 'Sat'],
    'weekdays_min' => ['So', 'Ma', 'Di', 'Wo', 'Do', 'Vr', 'Sa'],
    'first_day_of_week' => 1,
    'day_of_first_week_of_year' => 4,
];
