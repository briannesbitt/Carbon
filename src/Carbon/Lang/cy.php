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
 * - François B
 * - JD Isaacks
 * - Daniel Monaghan
 */
return [
    'year' => '{1}blwyddyn|]1,Inf[:count flynedd',
    'y' => ':countbl',
    'month' => '{1}mis|]1,Inf[:count mis',
    'm' => ':countmi',
    'week' => ':count wythnos',
    'w' => ':countw',
    'day' => '{1}diwrnod|]1,Inf[:count diwrnod',
    'd' => ':countd',
    'hour' => '{1}awr|]1,Inf[:count awr',
    'h' => ':counth',
    'minute' => '{1}munud|]1,Inf[:count munud',
    'min' => ':countm',
    'second' => '{1}ychydig eiliadau|]1,Inf[:count eiliad',
    's' => ':counts',
    'ago' => ':time yn ôl',
    'from_now' => 'mewn :time',
    'after' => ':time ar ôl',
    'before' => ':time o\'r blaen',
    'diff_now' => 'nawr',
    'diff_yesterday' => 'ddoe',
    'diff_tomorrow' => 'yfory',
    'formats' => [
        'LT' => 'HH:mm',
        'LTS' => 'HH:mm:ss',
        'L' => 'DD/MM/YYYY',
        'LL' => 'D MMMM YYYY',
        'LLL' => 'D MMMM YYYY HH:mm',
        'LLLL' => 'dddd, D MMMM YYYY HH:mm',
    ],
    'calendar' => [
        'sameDay' => '[Heddiw am] LT',
        'nextDay' => '[Yfory am] LT',
        'nextWeek' => 'dddd [am] LT',
        'lastDay' => '[Ddoe am] LT',
        'lastWeek' => 'dddd [diwethaf am] LT',
        'sameElse' => 'L',
    ],
    'ordinal' => function ($number) {
        return $number.(
            $number > 20
                ? (in_array($number, [40, 50, 60, 80, 100]) ? 'fed' : 'ain')
                : ([
                    '', 'af', 'il', 'ydd', 'ydd', 'ed', 'ed', 'ed', 'fed', 'fed', 'fed', // 1af to 10fed
                    'eg', 'fed', 'eg', 'eg', 'fed', 'eg', 'eg', 'fed', 'eg', 'fed', // 11eg to 20fed
                ])[$number] ?? ''
        );
    },
    'months' => ['Ionawr', 'Chwefror', 'Mawrth', 'Ebrill', 'Mai', 'Mehefin', 'Gorffennaf', 'Awst', 'Medi', 'Hydref', 'Tachwedd', 'Rhagfyr'],
    'months_short' => ['Ion', 'Chwe', 'Maw', 'Ebr', 'Mai', 'Meh', 'Gor', 'Aws', 'Med', 'Hyd', 'Tach', 'Rhag'],
    'weekdays' => ['Dydd Sul', 'Dydd Llun', 'Dydd Mawrth', 'Dydd Mercher', 'Dydd Iau', 'Dydd Gwener', 'Dydd Sadwrn'],
    'weekdays_short' => ['Sul', 'Llun', 'Maw', 'Mer', 'Iau', 'Gwe', 'Sad'],
    'weekdays_min' => ['Su', 'Ll', 'Ma', 'Me', 'Ia', 'Gw', 'Sa'],
    'first_day_of_week' => 1,
    'day_of_first_week_of_year' => 4,
    'list' => [', ', ' a '],
    'meridiem' => ['yb', 'yh'],
];
