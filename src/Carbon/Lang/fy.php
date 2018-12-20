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
    'year' => 'ien jier|:count jierren',
    'month' => 'ien moanne|:count moannen',
    'week' => 'in wike|:count wiken',
    'day' => 'ien dei|:count dagen',
    'hour' => 'ien oere|:count oeren',
    'minute' => 'ien minút|:count minuten',
    'second' => 'in pear sekonden|:count sekonden',
    'ago' => ':time lyn',
    'from_now' => 'oer :time',
    'diff_yesterday' => 'juster',
    'diff_tomorrow' => 'moarn',
    'formats' => [
        'LT' => 'HH:mm',
        'LTS' => 'HH:mm:ss',
        'L' => 'DD-MM-YYYY',
        'LL' => 'D MMMM YYYY',
        'LLL' => 'D MMMM YYYY HH:mm',
        'LLLL' => 'dddd D MMMM YYYY HH:mm',
    ],
    'calendar' => [
        'sameDay' => '[hjoed om] LT',
        'nextDay' => '[moarn om] LT',
        'nextWeek' => 'dddd [om] LT',
        'lastDay' => '[juster om] LT',
        'lastWeek' => '[ôfrûne] dddd [om] LT',
        'sameElse' => 'L',
    ],
    'ordinal' => function ($number, $period) {
        return $number.(($number === 1 || $number === 8 || $number >= 20) ? 'ste' : 'de');
    },
    'months' => ['jannewaris', 'febrewaris', 'maart', 'april', 'maaie', 'juny', 'july', 'augustus', 'septimber', 'oktober', 'novimber', 'desimber'],
    'months_short' => ['jan', 'feb', 'mrt', 'apr', 'mai', 'jun', 'jul', 'aug', 'sep', 'okt', 'nov', 'des'],
    'mmm_suffix' => '.',
    'weekdays' => ['snein', 'moandei', 'tiisdei', 'woansdei', 'tongersdei', 'freed', 'sneon'],
    'weekdays_short' => ['si.', 'mo.', 'ti.', 'wo.', 'to.', 'fr.', 'so.'],
    'weekdays_min' => ['Si', 'Mo', 'Ti', 'Wo', 'To', 'Fr', 'So'],
    'first_day_of_week' => 1,
    'day_of_first_week_of_year' => 4,
    'list' => [', ', ' en '],
];
