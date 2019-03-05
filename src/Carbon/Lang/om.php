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
 * - Ge'ez Frontier Foundation & Sagalee Oromoo Publishing Co. Inc.    locales@geez.org
 */
return array_replace_recursive(require __DIR__.'/en.php', [
    'formats' => [
        'LT' => 'HH:mm',
        'LTS' => 'HH:mm:ss',
        'L' => 'DD/MM/YYYY',
        'LL' => 'dd-MMM-YYYY',
        'LLL' => 'dd MMMM YYYY HH:mm',
        'LLLL' => 'dddd, MMMM D, YYYY HH:mm',
    ],
    'months' => ['Amajjii', 'Guraandhala', 'Bitooteessa', 'Elba', 'Caamsa', 'Waxabajjii', 'Adooleessa', 'Hagayya', 'Fuulbana', 'Onkololeessa', 'Sadaasa', 'Muddee'],
    'months_short' => ['Ama', 'Gur', 'Bit', 'Elb', 'Cam', 'Wax', 'Ado', 'Hag', 'Ful', 'Onk', 'Sad', 'Mud'],
    'weekdays' => ['Dilbata', 'Wiixata', 'Qibxata', 'Roobii', 'Kamiisa', 'Jimaata', 'Sanbata'],
    'weekdays_short' => ['Dil', 'Wix', 'Qib', 'Rob', 'Kam', 'Jim', 'San'],
    'weekdays_min' => ['Dil', 'Wix', 'Qib', 'Rob', 'Kam', 'Jim', 'San'],
    'day_of_first_week_of_year' => 1,
    'meridiem' => ['WD', 'WB'],

    'year' => ':count Class', // less reliable
    'y' => ':count Class', // less reliable
    'a_year' => ':count Class', // less reliable

    'week' => ':count Dilbata', // less reliable
    'w' => ':count Dilbata', // less reliable
    'a_week' => ':count Dilbata', // less reliable

    'day' => ':count aduu', // less reliable
    'd' => ':count aduu', // less reliable
    'a_day' => ':count aduu', // less reliable

    'hour' => ':count sa&#039;aatii', // less reliable
    'h' => ':count sa&#039;aatii', // less reliable
    'a_hour' => ':count sa&#039;aatii', // less reliable

    'minute' => ':count sa&#039;aatii', // less reliable
    'min' => ':count sa&#039;aatii', // less reliable
    'a_minute' => ':count sa&#039;aatii', // less reliable

    'second' => ':count abba', // less reliable
    's' => ':count abba', // less reliable
    'a_second' => ':count abba', // less reliable

    'month' => ':count Month',
    'm' => ':count Month',
    'a_month' => ':count Month',
]);
