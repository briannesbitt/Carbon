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
    'y' => ':count godinu|:count godine|:count godina',
    'month' => 'mjesec|',
    'm' => ':count mjesec|:count mjeseca|:count mjeseci',
    'week' => ':count tjedan|:count tjedna|:count tjedana',
    'w' => ':count tjedan|:count tjedna|:count tjedana',
    'day' => 'dan|',
    'd' => ':count dan|:count dana|:count dana',
    'hour' => '|',
    'h' => ':count sat|:count sata|:count sati',
    'minute' => '|',
    'min' => ':count minutu|:count minute |:count minuta',
    'second' => 'par sekundi|',
    's' => ':count sekundu|:count sekunde|:count sekundi',
    'ago' => 'prije :time',
    'from_now' => 'za :time',
    'after' => 'za :time',
    'before' => 'prije :time',
    'diff_yesterday' => 'jučer',
    'diff_tomorrow' => 'sutra',
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
        'lastDay' => '[jučer u] LT',
        'lastWeek' => '',
        'sameElse' => 'L',
    ],
    'ordinal' => ':number.',
    'months' => ['siječnja', 'veljače', 'ožujka', 'travnja', 'svibnja', 'lipnja', 'srpnja', 'kolovoza', 'rujna', 'listopada', 'studenoga', 'prosinca'],
    'months_standalone' => ['siječanj', 'veljača', 'ožujak', 'travanj', 'svibanj', 'lipanj', 'srpanj', 'kolovoz', 'rujan', 'listopad', 'studeni', 'prosinac'],
    'months_short' => ['sij.', 'velj.', 'ožu.', 'tra.', 'svi.', 'lip.', 'srp.', 'kol.', 'ruj.', 'lis.', 'stu.', 'pro.'],
    'weekdays' => ['nedjelja', 'ponedjeljak', 'utorak', 'srijeda', 'četvrtak', 'petak', 'subota'],
    'weekdays_short' => ['ned.', 'pon.', 'uto.', 'sri.', 'čet.', 'pet.', 'sub.'],
    'weekdays_min' => ['ne', 'po', 'ut', 'sr', 'če', 'pe', 'su'],
];
