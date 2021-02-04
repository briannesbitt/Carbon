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
 * - Azri Jamil
 * - JD Isaacks
 * - Josh Soref
 * - Azri Jamil
 * - Hariadi Hinta
 * - Ashraf Kamarudin
 */
return [
    'year' => ':count tahun',
    'a_year' => '{1}setahun|]1,Inf[:count tahun',
    'y' => ':count tahun',
    'month' => ':count bulan',
    'a_month' => '{1}sebulan|]1,Inf[:count bulan',
    'm' => ':count bulan',
    'week' => ':count minggu',
    'a_week' => '{1}seminggu|]1,Inf[:count minggu',
    'w' => ':count minggu',
    'day' => ':count hari',
    'a_day' => '{1}sehari|]1,Inf[:count hari',
    'd' => ':count hari',
    'hour' => ':count jam',
    'a_hour' => '{1}sejam|]1,Inf[:count jam',
    'h' => ':count jam',
    'minute' => ':count minit',
    'a_minute' => '{1}seminit|]1,Inf[:count minit',
    'min' => ':count minit',
    'second' => ':count saat',
    'a_second' => '{1}beberapa saat|]1,Inf[:count saat',
    'millisecond' => ':count milisaat',
    'a_millisecond' => '{1}semilisaat|]1,Inf[:count milliseconds',
    'microsecond' => ':count mikrodetik',
    'a_microsecond' => '{1}semikrodetik|]1,Inf[:count mikrodetik',
    's' => ':count saat',
    'ago' => ':time yang lepas',
    'from_now' => ':time dari sekarang',
    'after' => ':time kemudian',
    'before' => ':time lepas',
    'diff_now' => 'sekarang',
    'diff_today' => 'Hari',
    'diff_today_regexp' => 'Hari(?:\\s+ini)?(?:\\s+pukul)?',
    'diff_yesterday' => 'semalam',
    'diff_yesterday_regexp' => 'Semalam(?:\\s+pukul)?',
    'diff_tomorrow' => 'esok',
    'diff_tomorrow_regexp' => 'Esok(?:\\s+pukul)?',
    'diff_before_yesterday' => 'kelmarin',
    'diff_after_tomorrow' => 'lusa',
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
        'nextDay' => '[Esok pukul] LT',
        'nextWeek' => 'dddd [pukul] LT',
        'lastDay' => '[Kelmarin pukul] LT',
        'lastWeek' => 'dddd [lepas pukul] LT',
        'sameElse' => 'L',
    ],
    'meridiem' => static function ($hour) {
        if ($hour < 11) {
            return 'pagi';
        }
        if ($hour < 15) {
            return 'tengahari';
        }
        if ($hour < 19) {
            return 'petang';
        }

        return 'malam';
    },
    'months' => ['Januari', 'Februari', 'Mac', 'April', 'Mei', 'Jun', 'Julai', 'Ogos', 'September', 'Oktober', 'November', 'Disember'],
    'months_short' => ['Jan', 'Feb', 'Mac', 'Apr', 'Mei', 'Jun', 'Jul', 'Ogs', 'Sep', 'Okt', 'Nov', 'Dis'],
    'weekdays' => ['Ahad', 'Isnin', 'Selasa', 'Rabu', 'Khamis', 'Jumaat', 'Sabtu'],
    'weekdays_short' => ['Ahd', 'Isn', 'Sel', 'Rab', 'Kha', 'Jum', 'Sab'],
    'weekdays_min' => ['Ah', 'Is', 'Sl', 'Rb', 'Km', 'Jm', 'Sb'],
    'first_day_of_week' => 1,
    'day_of_first_week_of_year' => 1,
    'list' => [', ', ' dan '],
];
