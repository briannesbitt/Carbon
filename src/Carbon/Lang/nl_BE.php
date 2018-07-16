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
    'month' => 'één maand|:count maanden',
    'day' => 'één dag|:count dagen',
    'hour' => 'één uur|:count uur',
    'minute' => 'één minuut|:count minuten',
    'second' => 'een paar seconden|:count seconden',
    'ago' => ':time geleden',
    'from_now' => 'over :time',
    'formats' => [
        'LT' => 'HH:mm',
        'LTS' => 'HH:mm:ss',
        'L' => 'DD/MM/YYYY',
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
    'months' => ['januari', 'februari', 'maart', 'april', 'mei', 'juni', 'juli', 'augustus', 'september', 'oktober', 'november', 'december'],
    'months_short' => [
    ],
    'weekdays' => ['zondag', 'maandag', 'dinsdag', 'woensdag', 'donderdag', 'vrijdag', 'zaterdag'],
    'weekdays_short' => ['zo.', 'ma.', 'di.', 'wo.', 'do.', 'vr.', 'za.'],
    'weekdays_min' => ['zo', 'ma', 'di', 'wo', 'do', 'vr', 'za'],
];
