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
    'year' => '{1}setahun|]1,Inf[:count tahun',
    'month' => '{1}sebulan|]1,Inf[:count bulan',
    'week' => '{1}seminggu|:count minggu',
    'day' => '{1}sehari|]1,Inf[:count hari',
    'hour' => '{1}sejam|]1,Inf[:count jam',
    'minute' => '{1}seminit|]1,Inf[:count minit',
    'second' => '{1}beberapa saat|]1,Inf[:count saat',
    'ago' => ':time yang lepas',
    'from_now' => 'dalam :time',
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
    'meridiem' => function ($hour, $minute, $isLower) {
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
];
