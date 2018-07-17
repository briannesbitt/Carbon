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
    'year' => 'a year|:count years',
    'month' => 'a month|:count months',
    'day' => 'a day|:count days',
    'hour' => 'an hour|:count hours',
    'minute' => 'a minute|:count minutes',
    'second' => 'a few seconds|:count seconds',
    'ago' => ':time ago',
    'from_now' => 'in :time',
    'diff_yesterday' => 'Yesterday',
    'diff_tomorrow' => 'Tomorrow',
    'formats' => [
        'LT' => 'h:mm A',
        'LTS' => 'h:mm:ss A',
        'L' => 'DD/MM/YYYY',
        'LL' => 'D MMMM YYYY',
        'LLL' => 'D MMMM YYYY h:mm A',
        'LLLL' => 'dddd, D MMMM YYYY h:mm A',
    ],
    'calendar' => [
        'sameDay' => '[Today at] LT',
        'nextDay' => '[Tomorrow at] LT',
        'nextWeek' => 'dddd [at] LT',
        'lastDay' => '[Yesterday at] LT',
        'lastWeek' => '[Last] dddd [at] LT',
        'sameElse' => 'L',
    ],
    'months' => ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
    'months_short' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
    'weekdays' => ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'],
    'weekdays_short' => ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
    'weekdays_min' => ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
];
