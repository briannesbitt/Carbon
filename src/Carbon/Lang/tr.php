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
    'year' => 'bir yıl|:count yıl',
    'y' => ':count yıl',
    'month' => 'bir ay|:count ay',
    'm' => ':count ay',
    'week' => ':count hafta',
    'w' => ':count hafta',
    'day' => 'bir gün|:count gün',
    'd' => ':count gün',
    'hour' => 'bir saat|:count saat',
    'h' => ':count saat',
    'minute' => 'bir dakika|:count dakika',
    'min' => ':count dakika',
    'second' => 'birkaç saniye|:count saniye',
    's' => ':count saniye',
    'ago' => ':time önce',
    'from_now' => ':time sonra',
    'after' => ':time sonra',
    'before' => ':time önce',
    'formats' => [
        'LT' => 'HH:mm',
        'LTS' => 'HH:mm:ss',
        'L' => 'DD.MM.YYYY',
        'LL' => 'D MMMM YYYY',
        'LLL' => 'D MMMM YYYY HH:mm',
        'LLLL' => 'dddd, D MMMM YYYY HH:mm',
    ],
    'calendar' => [
        'sameDay' => '[bugün saat] LT',
        'nextDay' => '[yarın saat] LT',
        'nextWeek' => '[gelecek] dddd [saat] LT',
        'lastDay' => '[dün] LT',
        'lastWeek' => '[geçen] dddd [saat] LT',
        'sameElse' => 'L',
    ],
    'months' => ['Ocak', 'Şubat', 'Mart', 'Nisan', 'Mayıs', 'Haziran', 'Temmuz', 'Ağustos', 'Eylül', 'Ekim', 'Kasım', 'Aralık'],
    'months_short' => ['Oca', 'Şub', 'Mar', 'Nis', 'May', 'Haz', 'Tem', 'Ağu', 'Eyl', 'Eki', 'Kas', 'Ara'],
    'weekdays' => ['Pazar', 'Pazartesi', 'Salı', 'Çarşamba', 'Perşembe', 'Cuma', 'Cumartesi'],
    'weekdays_short' => ['Paz', 'Pts', 'Sal', 'Çar', 'Per', 'Cum', 'Cts'],
    'weekdays_min' => ['Pz', 'Pt', 'Sa', 'Ça', 'Pe', 'Cu', 'Ct'],
];
