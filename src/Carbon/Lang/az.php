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
    'year' => 'bir il|:count il',
    'y' => ':count il',
    'month' => 'bir ay|:count ay',
    'm' => ':count ay',
    'week' => ':count həftə',
    'w' => ':count həftə',
    'day' => 'bir gün|:count gün',
    'd' => ':count gün',
    'hour' => 'bir saat|:count saat',
    'h' => ':count saat',
    'minute' => 'bir dəqiqə|:count dəqiqə',
    'min' => ':count dəqiqə',
    'second' => 'birneçə saniyə|:count saniyə',
    's' => ':count saniyə',
    'ago' => ':time əvvəl',
    'from_now' => ':time sonra',
    'after' => ':time sonra',
    'before' => ':time əvvəl',
    'diff_now' => 'indi',
    'diff_yesterday' => 'dünən',
    'diff_tomorrow' => 'sabah',
    'diff_before_yesterday' => 'srağagün',
    'diff_after_tomorrow' => 'birisi gün',
    'period_recurrences' => ':count dəfədən bir',
    'period_interval' => 'hər :interval',
    'period_start_date' => ':date tarixindən başlayaraq',
    'period_end_date' => ':date tarixinədək',
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
        'nextDay' => '[sabah saat] LT',
        'nextWeek' => '[gələn həftə] dddd [saat] LT',
        'lastDay' => '[dünən] LT',
        'lastWeek' => '[keçən həftə] dddd [saat] LT',
        'sameElse' => 'L',
    ],
    'months' => ['yanvar', 'fevral', 'mart', 'aprel', 'may', 'iyun', 'iyul', 'avqust', 'sentyabr', 'oktyabr', 'noyabr', 'dekabr'],
    'months_short' => ['yan', 'fev', 'mar', 'apr', 'may', 'iyn', 'iyl', 'avq', 'sen', 'okt', 'noy', 'dek'],
    'weekdays' => ['Bazar', 'Bazar ertəsi', 'Çərşənbə axşamı', 'Çərşənbə', 'Cümə axşamı', 'Cümə', 'Şənbə'],
    'weekdays_short' => ['Baz', 'BzE', 'ÇAx', 'Çər', 'CAx', 'Cüm', 'Şən'],
    'weekdays_min' => ['Bz', 'BE', 'ÇA', 'Çə', 'CA', 'Cü', 'Şə'],
];
