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
    'year' => 'godinu|',
    'y' => ':count godina|:count godine|:count godina',
    'month' => 'mesec|',
    'm' => ':count mesec|:count meseca|:count meseci',
    'week' => ':count nedelja|:count nedelje|:count nedelja',
    'w' => ':count nedelja|:count nedelje|:count nedelja',
    'day' => 'dan|',
    'd' => ':count dan|:count dana|:count dana',
    'hour' => '|',
    'h' => ':count sat|:count sata|:count sati',
    'minute' => '|',
    'min' => ':count minut|:count minuta |:count minuta',
    'second' => 'nekoliko sekundi|',
    's' => ':count sekund|:count sekunde|:count sekunde',
    'ago' => 'pre :time',
    'from_now' => 'za :time',
    'after' => 'nakon :time',
    'before' => 'pre :time',
    'year_from_now' => '{1,21,31,41,51} :count godinu|{2,3,4,22,23,24,32,33,34,42,43,44,52,53,54} :count godine|[5,Inf[ :count godina',
    'year_ago' => '{1,21,31,41,51} :count godinu|{2,3,4,22,23,24,32,33,34,42,43,44,52,53,54} :count godine|[5,Inf[ :count godina',
    'week_from_now' => '{1} :count nedelju|{2,3,4} :count nedelje|[5,Inf[ :count nedelja',
    'week_ago' => '{1} :count nedelju|{2,3,4} :count nedelje|[5,Inf[ :count nedelja',
    'formats' => [
        'LT' => 'H:mm',
        'LTS' => 'H:mm:ss',
        'L' => 'DD.MM.YYYY',
        'LL' => 'D. MMMM YYYY',
        'LLL' => 'D. MMMM YYYY H:mm',
        'LLLL' => 'dddd, D. MMMM YYYY H:mm',
    ],
    'calendar' => [
        'sameDay' => '[danas u] LT',
        'nextDay' => '[sutra u] LT',
        'nextWeek' => '',
        'lastDay' => '[juče u] LT',
        'lastWeek' => '',
        'sameElse' => 'L',
    ],
    'months' => ['januar', 'februar', 'mart', 'april', 'maj', 'jun', 'jul', 'avgust', 'septembar', 'oktobar', 'novembar', 'decembar'],
    'months_short' => ['jan.', 'feb.', 'mar.', 'apr.', 'maj', 'jun', 'jul', 'avg.', 'sep.', 'okt.', 'nov.', 'dec.'],
    'weekdays' => ['nedelja', 'ponedeljak', 'utorak', 'sreda', 'četvrtak', 'petak', 'subota'],
    'weekdays_short' => ['ned.', 'pon.', 'uto.', 'sre.', 'čet.', 'pet.', 'sub.'],
    'weekdays_min' => ['ne', 'po', 'ut', 'sr', 'če', 'pe', 'su'],
];
