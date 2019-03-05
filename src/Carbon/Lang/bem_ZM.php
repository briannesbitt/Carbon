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
 * - ANLoc Martin Benjamin locales@africanlocalization.net
 */return array_replace_recursive(require __DIR__.'/en.php', [
    'formats' => [
        'L' => 'MM/DD/YYYY',
    ],
    'months' => ['Januari', 'Februari', 'Machi', 'Epreo', 'Mei', 'Juni', 'Julai', 'Ogasti', 'Septemba', 'Oktoba', 'Novemba', 'Disemba'],
    'months_short' => ['Jan', 'Feb', 'Mac', 'Epr', 'Mei', 'Jun', 'Jul', 'Oga', 'Sep', 'Okt', 'Nov', 'Dis'],
    'weekdays' => ['Pa Mulungu', 'Palichimo', 'Palichibuli', 'Palichitatu', 'Palichine', 'Palichisano', 'Pachibelushi'],
    'weekdays_short' => ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
    'weekdays_min' => ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
    'first_day_of_week' => 1,
    'day_of_first_week_of_year' => 1,
    'meridiem' => ['uluchelo', 'akasuba'],

    'year' => ':count akasuba', // less reliable
    'y' => ':count akasuba', // less reliable
    'a_year' => ':count akasuba', // less reliable

    'month' => ':count akasuba', // less reliable
    'm' => ':count akasuba', // less reliable
    'a_month' => ':count akasuba', // less reliable

    'day' => ':count akasuba', // less reliable
    'd' => ':count akasuba', // less reliable
    'a_day' => ':count akasuba', // less reliable

    'hour' => ':count akasuba', // less reliable
    'h' => ':count akasuba', // less reliable
    'a_hour' => ':count akasuba', // less reliable

    'second' => ':count ilino', // less reliable
    's' => ':count ilino', // less reliable
    'a_second' => ':count ilino', // less reliable

    'week' => ':count umulungu',
    'w' => ':count umulungu',
    'a_week' => ':count umulungu',
]);
