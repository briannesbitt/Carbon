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
    'year' => 'setahun|:count tahun',
    'y' => ':count tahun',
    'month' => 'sebulan|:count bulan',
    'm' => ':count bulan',
    'week' => ':count minggu',
    'w' => ':count minggu',
    'day' => 'sehari|:count hari',
    'd' => ':count hari',
    'hour' => 'sejam|:count jam',
    'h' => ':count jam',
    'minute' => 'semenit|:count menit',
    'min' => ':count menit',
    'second' => 'beberapa detik|:count detik',
    's' => ':count detik',
    'ago' => ':time yang lalu',
    'from_now' => 'dalam :time',
    'after' => ':time setelah',
    'before' => ':time sebelum',
    'formats' => [
        'LT' => 'HH.mm',
        'LTS' => 'HH.mm.ss',
        'L' => 'DD/MM/YYYY',
        'LL' => 'D MMMM YYYY',
        'LLL' => 'D MMMM YYYY [pukul] HH.mm',
        'LLLL' => 'dddd, D MMMM YYYY [pukul] HH.mm',
    ],
    'calendar' => [
        'sameDay' => '[Hari ini pukul] LT',
        'nextDay' => '[Besok pukul] LT',
        'nextWeek' => 'dddd [pukul] LT',
        'lastDay' => '[Kemarin pukul] LT',
        'lastWeek' => 'dddd [lalu pukul] LT',
        'sameElse' => 'L',
    ],
    'months' => ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
    'months_short' => ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agt', 'Sep', 'Okt', 'Nov', 'Des'],
    'weekdays' => ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'],
    'weekdays_short' => ['Min', 'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab'],
    'weekdays_min' => ['Mg', 'Sn', 'Sl', 'Rb', 'Km', 'Jm', 'Sb'],
];
