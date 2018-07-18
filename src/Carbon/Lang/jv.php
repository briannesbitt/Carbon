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
    'year' => 'setaun|:count taun',
    'month' => 'sewulan|:count wulan',
    'day' => 'sedinten|:count dinten',
    'hour' => 'setunggal jam|:count jam',
    'minute' => 'setunggal menit|:count menit',
    'second' => 'sawetawis detik|:count detik',
    'ago' => ':time ingkang kepengker',
    'from_now' => 'wonten ing :time',
    'formats' => [
        'LT' => 'HH.mm',
        'LTS' => 'HH.mm.ss',
        'L' => 'DD/MM/YYYY',
        'LL' => 'D MMMM YYYY',
        'LLL' => 'D MMMM YYYY [pukul] HH.mm',
        'LLLL' => 'dddd, D MMMM YYYY [pukul] HH.mm',
    ],
    'calendar' => [
        'sameDay' => '[Dinten puniko pukul] LT',
        'nextDay' => '[Mbenjang pukul] LT',
        'nextWeek' => 'dddd [pukul] LT',
        'lastDay' => '[Kala wingi pukul] LT',
        'lastWeek' => 'dddd [kepengker pukul] LT',
        'sameElse' => 'L',
    ],
    'meridiem' => function ($hour, $minute, $isLower) {
        if ($hour < 11) {
            return 'enjing';
        }
        if ($hour < 15) {
            return 'siyang';
        }
        if ($hour < 19) {
            return 'sonten';
        }
        return 'ndalu';
    },
    'months' => ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'Nopember', 'Desember'],
    'months_short' => ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Ags', 'Sep', 'Okt', 'Nop', 'Des'],
    'weekdays' => ['Minggu', 'Senen', 'Seloso', 'Rebu', 'Kemis', 'Jemuwah', 'Septu'],
    'weekdays_short' => ['Min', 'Sen', 'Sel', 'Reb', 'Kem', 'Jem', 'Sep'],
    'weekdays_min' => ['Mg', 'Sn', 'Sl', 'Rb', 'Km', 'Jm', 'Sp'],
];
