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
    'year' => 'één jaar|:count jaar',
    'y' => ':count jaar',
    'month' => 'één maand|:count maanden',
    'm' => ':count maand|:count maanden',
    'week' => ':count week|:count weken',
    'w' => ':count week|:count weken',
    'day' => 'één dag|:count dagen',
    'd' => ':count dag|:count dagen',
    'hour' => 'één uur|:count uur',
    'h' => ':count uur',
    'minute' => 'één minuut|:count minuten',
    'min' => ':count minuut|:count minuten',
    'second' => 'een paar seconden|:count seconden',
    's' => ':count seconde|:count seconden',
    'ago' => ':time geleden',
    'from_now' => 'over :time',
    'after' => ':time later',
    'before' => ':time eerder',
    'diff_now' => 'nu',
    'diff_yesterday' => 'gisteren',
    'diff_tomorrow' => 'morgen',
    'diff_after_tomorrow' => 'overmorgen',
    'diff_before_yesterday' => 'eergisteren',
    'formats' => [
        'LT' => 'HH:mm',
        'LTS' => 'HH:mm:ss',
        'L' => 'DD-MM-YYYY',
        'LL' => 'D MMMM YYYY',
        'LLL' => 'D MMMM YYYY HH:mm',
        'LLLL' => 'dddd D MMMM YYYY HH:mm',
    ],
    'calendar' => [
        'sameDay' => '[vandaag om] LT',
        'nextDay' => '[morgen om] LT',
        'nextWeek' => 'dddd [om] LT',
        'lastDay' => '[gisteren om] LT',
        'lastWeek' => '[afgelopen] dddd [om] LT',
        'sameElse' => 'L',
    ],
    'ordinal' => function ($number) {
        return $number . (($number === 1 || $number === 8 || $number >= 20) ? 'ste' : 'de');
    },
    'months' => ['januari', 'februari', 'maart', 'april', 'mei', 'juni', 'juli', 'augustus', 'september', 'oktober', 'november', 'december'],
    'months_short' => ['jan', 'feb', 'mrt', 'apr', 'mei', 'jun', 'jul', 'aug', 'sep', 'okt', 'nov', 'dec'],
    'mmm_suffix' => '.',
    'weekdays' => ['zondag', 'maandag', 'dinsdag', 'woensdag', 'donderdag', 'vrijdag', 'zaterdag'],
    'weekdays_short' => ['zo.', 'ma.', 'di.', 'wo.', 'do.', 'vr.', 'za.'],
    'weekdays_min' => ['zo', 'ma', 'di', 'wo', 'do', 'vr', 'za'],
];
