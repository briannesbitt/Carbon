<?php

/**
 * This file is part of the Carbon package.
 *
 * (c) Brian Nesbitt <brian@nesbot.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
\Symfony\Component\Translation\PluralizationRules::set(function ($number) {
    return $number === 1 ? 0 : 1;
}, 'tl');

return [
    'year' => 'isang taon|:count taon',
    'month' => 'isang buwan|:count buwan',
    'week' => 'isang linggo|:count linggo',
    'day' => 'isang araw|:count araw',
    'hour' => 'isang oras|:count oras',
    'minute' => 'isang minuto|:count minuto',
    'second' => 'ilang segundo|:count segundo',
    'ago' => ':time ang nakalipas',
    'from_now' => 'sa loob ng :time',
    'formats' => [
        'LT' => 'HH:mm',
        'LTS' => 'HH:mm:ss',
        'L' => 'MM/D/YYYY',
        'LL' => 'MMMM D, YYYY',
        'LLL' => 'MMMM D, YYYY HH:mm',
        'LLLL' => 'dddd, MMMM DD, YYYY HH:mm',
    ],
    'calendar' => [
        'sameDay' => 'LT [ngayong araw]',
        'nextDay' => '[Bukas ng] LT',
        'nextWeek' => 'LT [sa susunod na] dddd',
        'lastDay' => 'LT [kahapon]',
        'lastWeek' => 'LT [noong nakaraang] dddd',
        'sameElse' => 'L',
    ],
    'months' => ['Enero', 'Pebrero', 'Marso', 'Abril', 'Mayo', 'Hunyo', 'Hulyo', 'Agosto', 'Setyembre', 'Oktubre', 'Nobyembre', 'Disyembre'],
    'months_short' => ['Ene', 'Peb', 'Mar', 'Abr', 'May', 'Hun', 'Hul', 'Ago', 'Set', 'Okt', 'Nob', 'Dis'],
    'weekdays' => ['Linggo', 'Lunes', 'Martes', 'Miyerkules', 'Huwebes', 'Biyernes', 'Sabado'],
    'weekdays_short' => ['Lin', 'Lun', 'Mar', 'Miy', 'Huw', 'Biy', 'Sab'],
    'weekdays_min' => ['Li', 'Lu', 'Ma', 'Mi', 'Hu', 'Bi', 'Sab'],
    'first_day_of_week' => 1,
    'day_of_first_week_of_year' => 4,
    'list' => [', ', ' at '],
];
