<?php

/**
 * This file is part of the Carbon package.
 *
 * (c) Brian Nesbitt <brian@nesbot.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

return array_replace_recursive(require __DIR__.'/en.php', [
    'months' => ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
    'months_short' => ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
    'weekdays' => ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'],
    'weekdays_short' => ['Min', 'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab'],
    'weekdays_min' => ['M', 'S', 'S', 'R', 'K', 'J', 'S'],
    'formats' => [
        'LT' => 'HH.mm',
        'LTS' => 'HH.mm.ss',
        'L' => 'DD/MM/YYYY',
        'LL' => 'D MMM YYYY',
        'LLL' => 'D MMMM YYYY HH.mm',
        'LLLL' => 'dddd, DD MMMM YYYY HH.mm',
    ],

    'year' => 'tahun :count',
    'y' => 'tahun :count',
    'a_year' => 'tahun :count',

    'month' => ':count bulan',
    'm' => ':count bulan',
    'a_month' => ':count bulan',

    'week' => ':count minggu',
    'w' => ':count minggu',
    'a_week' => ':count minggu',

    'day' => ':count hari',
    'd' => ':count hari',
    'a_day' => ':count hari',

    'hour' => ':count jam',
    'h' => ':count jam',
    'a_hour' => ':count jam',

    'minute' => ':count menit',
    'min' => ':count menit',
    'a_minute' => ':count menit',

    'second' => ':count detik',
    's' => ':count detik',
    'a_second' => ':count detik',

    'ago' => ':time yang lalu',
    'from_now' => 'dalam :time',
]);
