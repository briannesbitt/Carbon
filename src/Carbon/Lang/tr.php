<?php

/**
 * This file is part of the Carbon package.
 *
 * (c) Brian Nesbitt <brian@nesbot.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * Authors:
 * - Josh Soref
 * - Alan Agius
 * - Erhan Gundogan
 * - François B
 * - JD Isaacks
 * - Murat Yüksel
 * - Baran Şengül
 * - Selami (selamialtin)
 * - TeomanBey
 */
return [
    'year' => ':count yıl',
    'a_year' => '{1}bir yıl|]1,Inf[:count yıl',
    'y' => ':county',
    'month' => ':count ay',
    'a_month' => '{1}bir ay|]1,Inf[:count ay',
    'm' => ':countay',
    'week' => ':count hafta',
    'a_week' => '{1}bir hafta|]1,Inf[:count hafta',
    'w' => ':counth',
    'day' => ':count gün',
    'a_day' => '{1}bir gün|]1,Inf[:count gün',
    'd' => ':countg',
    'hour' => ':count saat',
    'a_hour' => '{1}bir saat|]1,Inf[:count saat',
    'h' => ':countsa',
    'minute' => ':count dakika',
    'a_minute' => '{1}bir dakika|]1,Inf[:count dakika',
    'min' => ':countdk',
    'second' => ':count saniye',
    'a_second' => '{1}birkaç saniye|]1,Inf[:count saniye',
    's' => ':countsn',
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
    'ordinal' => function ($number, $period) {
        switch ($period) {
            case 'd':
            case 'D':
            case 'Do':
            case 'DD':
                return $number;
            default:
                if ($number === 0) {  // special case for zero
                    return "$number'ıncı";
                }

                static $suffixes = [
                    1 => '\'inci',
                    5 => '\'inci',
                    8 => '\'inci',
                    70 => '\'inci',
                    80 => '\'inci',
                    2 => '\'nci',
                    7 => '\'nci',
                    20 => '\'nci',
                    50 => '\'nci',
                    3 => '\'üncü',
                    4 => '\'üncü',
                    100 => '\'üncü',
                    6 => '\'ncı',
                    9 => '\'uncu',
                    10 => '\'uncu',
                    30 => '\'uncu',
                    60 => '\'ıncı',
                    90 => '\'ıncı',
                ];

                $lastDigit = $number % 10;

                return $number.($suffixes[$lastDigit] ?? $suffixes[$number % 100 - $lastDigit] ?? $suffixes[$number >= 100 ? 100 : -1] ?? '');
        }
    },
    'meridiem' => ['ÖÖ', 'ÖS', 'öö', 'ös'],
    'months' => ['Ocak', 'Şubat', 'Mart', 'Nisan', 'Mayıs', 'Haziran', 'Temmuz', 'Ağustos', 'Eylül', 'Ekim', 'Kasım', 'Aralık'],
    'months_short' => ['Oca', 'Şub', 'Mar', 'Nis', 'May', 'Haz', 'Tem', 'Ağu', 'Eyl', 'Eki', 'Kas', 'Ara'],
    'weekdays' => ['Pazar', 'Pazartesi', 'Salı', 'Çarşamba', 'Perşembe', 'Cuma', 'Cumartesi'],
    'weekdays_short' => ['Paz', 'Pts', 'Sal', 'Çar', 'Per', 'Cum', 'Cts'],
    'weekdays_min' => ['Pz', 'Pt', 'Sa', 'Ça', 'Pe', 'Cu', 'Ct'],
    'first_day_of_week' => 1,
    'day_of_first_week_of_year' => 1,
    'list' => [', ', ' ve '],
];
