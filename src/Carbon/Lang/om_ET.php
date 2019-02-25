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
 */return array_replace_recursive(require __DIR__.'/en.php', [
    'formats' => [
        'L' => 'DD/MM/YYYY',
    ],
    'months' => ['Amajjii', 'Guraandhala', 'Bitooteessa', 'Elba', 'Caamsa', 'Waxabajjii', 'Adooleessa', 'Hagayya', 'Fuulbana', 'Onkololeessa', 'Sadaasa', 'Muddee'],
    'months_short' => ['Ama', 'Gur', 'Bit', 'Elb', 'Cam', 'Wax', 'Ado', 'Hag', 'Ful', 'Onk', 'Sad', 'Mud'],
    'weekdays' => ['Dilbata', ''],
    'weekdays_short' => ['Dil', 'Wix', 'Qib', 'Rob', 'Kam', 'Jim', 'San'],
    'weekdays_min' => ['Dil', 'Wix', 'Qib', 'Rob', 'Kam', 'Jim', 'San'],
    'day_of_first_week_of_year' => 1,
    'meridiem' => ['WD', 'WB'],
]);
