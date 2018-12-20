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
    'year' => ':count år|:count år',
    'y' => ':count år|:count år',
    'month' => ':count måned|:count måneder',
    'm' => ':count måned|:count måneder',
    'week' => ':count uke|:count uker',
    'w' => ':count uke|:count uker',
    'day' => ':count dag|:count dager',
    'd' => ':count dag|:count dager',
    'hour' => ':count time|:count timer',
    'h' => ':count time|:count timer',
    'minute' => ':count minutt|:count minutter',
    'min' => ':count minutt|:count minutter',
    'second' => ':count sekund|:count sekunder',
    's' => ':count sekund|:count sekunder',
    'ago' => ':time siden',
    'from_now' => 'om :time',
    'after' => ':time etter',
    'before' => ':time før',
    'diff_now' => 'akkurat nå',
    'diff_yesterday' => 'i går',
    'diff_tomorrow' => 'i morgen',
    'diff_before_yesterday' => 'i forgårs',
    'diff_after_tomorrow' => 'i overmorgen',
    'period_recurrences' => 'en gang|:count ganger',
    'period_interval' => 'hver :interval',
    'period_start_date' => 'fra :date',
    'period_end_date' => 'til :date',
    'months' => ['januar', 'februar', 'mars', 'april', 'mai', 'juni', 'juli', 'august', 'september', 'oktober', 'november', 'desember'],
    'months_short' => ['jan', 'feb', 'mar', 'apr', 'mai', 'jun', 'jul', 'aug', 'sep', 'okt', 'nov', 'des'],
    'weekdays' => ['søndag', 'mandag', 'tirsdag', 'onsdag', 'torsdag', 'fredag', 'lørdag'],
    'weekdays_short' => ['søn', 'man', 'tir', 'ons', 'tor', 'fre', 'lør'],
    'weekdays_min' => ['sø', 'ma', 'ti', 'on', 'to', 'fr', 'lø'],
    'ordinal' => ':number.',
    'first_day_of_week' => 1,
    'day_of_first_week_of_year' => 4,
    'formats' => [
        'LT' => 'HH:mm',
        'LTS' => 'HH:mm:ss',
        'L' => 'DD.MM.YYYY',
        'LL' => 'D. MMMM YYYY',
        'LLL' => 'D. MMMM YYYY HH:mm',
        'LLLL' => 'dddd, D. MMMM YYYY [kl.] HH:mm',
    ],
    'calendar' => [
        'sameDay' => '[i dag kl.] LT',
        'nextDay' => '[i morgen kl.] LT',
        'nextWeek' => 'på dddd [kl.] LT',
        'lastDay' => '[i går kl.] LT',
        'lastWeek' => '[i] dddd[s kl.] LT',
        'sameElse' => 'L',
    ],
    'list' => [', ', ' og '],
];
