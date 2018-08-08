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
    'year' => 'mwaka mmoja|miaka :count',
    'y' => 'mwaka 1|miaka :count',
    'month' => 'mwezi mmoja|miezi :count',
    'm' => 'mwezi 1|miezi :count',
    'week' => 'wiki 1|wiki :count',
    'w' => 'wiki 1|wiki :count',
    'day' => 'siku moja|masiku :count',
    'd' => 'siku 1|siku :count',
    'hour' => 'saa limoja|masaa :count',
    'h' => 'saa 1|masaa :count',
    'minute' => 'dakika moja|dakika :count',
    'min' => 'dakika 1|dakika :count',
    'second' => 'hivi punde|sekunde :count',
    's' => 'sekunde 1|sekunde :count',
    'ago' => 'tokea :time',
    'from_now' => ':time baadaye',
    'after' => ':time baada',
    'before' => ':time kabla',
    'formats' => [
        'LT' => 'HH:mm',
        'LTS' => 'HH:mm:ss',
        'L' => 'DD.MM.YYYY',
        'LL' => 'D MMMM YYYY',
        'LLL' => 'D MMMM YYYY HH:mm',
        'LLLL' => 'dddd, D MMMM YYYY HH:mm',
    ],
    'calendar' => [
        'sameDay' => '[leo saa] LT',
        'nextDay' => '[kesho saa] LT',
        'nextWeek' => '[wiki ijayo] dddd [saat] LT',
        'lastDay' => '[jana] LT',
        'lastWeek' => '[wiki iliyopita] dddd [saat] LT',
        'sameElse' => 'L',
    ],
    'months' => ['Januari', 'Februari', 'Machi', 'Aprili', 'Mei', 'Juni', 'Julai', 'Agosti', 'Septemba', 'Oktoba', 'Novemba', 'Desemba'],
    'months_short' => ['Jan', 'Feb', 'Mac', 'Apr', 'Mei', 'Jun', 'Jul', 'Ago', 'Sep', 'Okt', 'Nov', 'Des'],
    'weekdays' => ['Jumapili', 'Jumatatu', 'Jumanne', 'Jumatano', 'Alhamisi', 'Ijumaa', 'Jumamosi'],
    'weekdays_short' => ['Jpl', 'Jtat', 'Jnne', 'Jtan', 'Alh', 'Ijm', 'Jmos'],
    'weekdays_min' => ['J2', 'J3', 'J4', 'J5', 'Al', 'Ij', 'J1'],
    'first_day_of_week' => 1,
    'day_of_first_week_of_year' => 1,
];
