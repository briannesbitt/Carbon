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
    'year' => 'eit år|:count år',
    'month' => 'ein månad|:count månader',
    'week' => ':count uke|:count uker',
    'day' => 'ein dag|:count dagar',
    'hour' => 'ein time|:count timar',
    'minute' => 'eit minutt|:count minutt',
    'second' => 'nokre sekund|:count sekund',
    'ago' => ':time sidan',
    'from_now' => 'om :time',
    'formats' => [
        'LT' => 'HH:mm',
        'LTS' => 'HH:mm:ss',
        'L' => 'DD.MM.YYYY',
        'LL' => 'D. MMMM YYYY',
        'LLL' => 'D. MMMM YYYY [kl.] H:mm',
        'LLLL' => 'dddd D. MMMM YYYY [kl.] HH:mm',
    ],
    'calendar' => [
        'sameDay' => '[I dag klokka] LT',
        'nextDay' => '[I morgon klokka] LT',
        'nextWeek' => 'dddd [klokka] LT',
        'lastDay' => '[I går klokka] LT',
        'lastWeek' => '[Føregåande] dddd [klokka] LT',
        'sameElse' => 'L',
    ],
    'ordinal' => ':number.',
    'months' => ['januar', 'februar', 'mars', 'april', 'mai', 'juni', 'juli', 'august', 'september', 'oktober', 'november', 'desember'],
    'months_short' => ['jan', 'feb', 'mar', 'apr', 'mai', 'jun', 'jul', 'aug', 'sep', 'okt', 'nov', 'des'],
    'weekdays' => ['sundag', 'måndag', 'tysdag', 'onsdag', 'torsdag', 'fredag', 'laurdag'],
    'weekdays_short' => ['sun', 'mån', 'tys', 'ons', 'tor', 'fre', 'lau'],
    'weekdays_min' => ['su', 'må', 'ty', 'on', 'to', 'fr', 'lø'],
    'first_day_of_week' => 1,
    'day_of_first_week_of_year' => 4,
    'list' => [', ', ' og '],
];
