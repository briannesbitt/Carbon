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

    'year' => ':count akasuba',
    'y' => ':count akasuba',
    'a_year' => ':count akasuba',

    'month' => ':count akasuba',
    'm' => ':count akasuba',
    'a_month' => ':count akasuba',

    'day' => ':count akasuba',
    'd' => ':count akasuba',
    'a_day' => ':count akasuba',

    'hour' => ':count akasuba',
    'h' => ':count akasuba',
    'a_hour' => ':count akasuba',

    'second' => ':count ilino',
    's' => ':count ilino',
    'a_second' => ':count ilino',
]);
