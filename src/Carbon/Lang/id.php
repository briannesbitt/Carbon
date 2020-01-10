<?php

/**
 * This file is part of the Carbon package.
 *
 * (c) Brian Nesbitt <brian@nesbot.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/*
 * Authors:
 * - Josh Soref
 * - du
 * - JD Isaacks
 * - Nafies Luthfi
 * - Raymundus Jati Primanda (mundusjp)
 * - diankur313
 * - a-wip0
 */
return [
    'year' => ':count tahun',
    'a_year' => '{1}setahun|]1,Inf[:count tahun',
    'y' => ':countthn',
    'month' => ':count bulan',
    'a_month' => '{1}sebulan|]1,Inf[:count bulan',
    'm' => ':countbln',
    'week' => ':count minggu',
    'a_week' => '{1}seminggu|]1,Inf[:count minggu',
    'w' => ':countmgg',
    'day' => ':count hari',
    'a_day' => '{1}sehari|]1,Inf[:count hari',
    'd' => ':counthr',
    'hour' => ':count jam',
    'a_hour' => '{1}sejam|]1,Inf[:count jam',
    'h' => ':countj',
    'minute' => ':count menit',
    'a_minute' => '{1}semenit|]1,Inf[:count menit',
    'min' => ':countmnt',
    'second' => ':count detik',
    'a_second' => '{1}beberapa detik|]1,Inf[:count detik',
    's' => ':countdt',
    'ago' => ':time yang lalu',
    'from_now' => ':time dari sekarang',
    'after' => ':time setelahnya',
    'before' => ':time sebelumnya',
    'diff_now' => 'sekarang',
    'diff_yesterday' => 'kemarin',
    'diff_tomorrow' => 'besok',
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
    'meridiem' => function ($hour) {
        if ($hour < 11) {
            return 'pagi';
        }
        if ($hour < 15) {
            return 'siang';
        }
        if ($hour < 19) {
            return 'sore';
        }

        return 'malam';
    },
    'months' => ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
    'months_short' => ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agt', 'Sep', 'Okt', 'Nov', 'Des'],
    'weekdays' => ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'],
    'weekdays_short' => ['Min', 'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab'],
    'weekdays_min' => ['Mg', 'Sn', 'Sl', 'Rb', 'Km', 'Jm', 'Sb'],
    'first_day_of_week' => 1,
    'day_of_first_week_of_year' => 1,
    'list' => [', ', ' dan '],
];
