<?php

/**
 * This file is part of the Carbon package.
 *
 * (c) Brian Nesbitt <brian@nesbot.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
\Symfony\Component\Translation\PluralizationRules::set(function ($number) {
    return $number === 1 ? 0 : 1;
}, 'gd');

/*
 * Authors:
 * - François B
 * - Jon Ashdown
 */
return [
    'year' => ':count bliadhna',
    'a_year' => 'bliadhna|:count bliadhna',
    'y' => ':count b.',
    'month' => ':count mìosan',
    'a_month' => 'mìos|:count mìosan',
    'm' => ':count ms.',
    'week' => ':count seachdainean',
    'a_week' => 'seachdain|:count seachdainean',
    'w' => ':count s.',
    'day' => ':count latha',
    'a_day' => 'latha|:count latha',
    'd' => ':count l.',
    'hour' => ':count uairean',
    'a_hour' => 'uair|:count uairean',
    'h' => ':count u.',
    'minute' => ':count mionaidean',
    'a_minute' => 'mionaid|:count mionaidean',
    'min' => ':count md.',
    'second' => ':count diogan',
    'a_second' => 'beagan diogan|:count diogan',
    's' => ':count d.',
    'ago' => 'bho chionn :time',
    'from_now' => 'ann an :time',
    'diff_yesterday' => 'An-dè',
    'diff_tomorrow' => 'A-màireach',
    'formats' => [
        'LT' => 'HH:mm',
        'LTS' => 'HH:mm:ss',
        'L' => 'DD/MM/YYYY',
        'LL' => 'D MMMM YYYY',
        'LLL' => 'D MMMM YYYY HH:mm',
        'LLLL' => 'dddd, D MMMM YYYY HH:mm',
    ],
    'calendar' => [
        'sameDay' => '[An-diugh aig] LT',
        'nextDay' => '[A-màireach aig] LT',
        'nextWeek' => 'dddd [aig] LT',
        'lastDay' => '[An-dè aig] LT',
        'lastWeek' => 'dddd [seo chaidh] [aig] LT',
        'sameElse' => 'L',
    ],
    'ordinal' => function ($number) {
        return $number.($number === 1 ? 'd' : ($number % 10 === 2 ? 'na' : 'mh'));
    },
    'months' => ['Am Faoilleach', 'An Gearran', 'Am Màrt', 'An Giblean', 'An Cèitean', 'An t-Ògmhios', 'An t-Iuchar', 'An Lùnastal', 'An t-Sultain', 'An Dàmhair', 'An t-Samhain', 'An Dùbhlachd'],
    'months_short' => ['Faoi', 'Gear', 'Màrt', 'Gibl', 'Cèit', 'Ògmh', 'Iuch', 'Lùn', 'Sult', 'Dàmh', 'Samh', 'Dùbh'],
    'weekdays' => ['Didòmhnaich', 'Diluain', 'Dimàirt', 'Diciadain', 'Diardaoin', 'Dihaoine', 'Disathairne'],
    'weekdays_short' => ['Did', 'Dil', 'Dim', 'Dic', 'Dia', 'Dih', 'Dis'],
    'weekdays_min' => ['Dò', 'Lu', 'Mà', 'Ci', 'Ar', 'Ha', 'Sa'],
    'first_day_of_week' => 1,
    'day_of_first_week_of_year' => 4,
    'list' => [', ', ' agus '],
    'meridiem' => ['m', 'f'],
];
