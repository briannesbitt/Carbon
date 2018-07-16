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
    'year' => 'سنة|:count سنوات',
    'month' => 'شهر|:count أشهر',
    'day' => 'يوم|:count أيام',
    'hour' => 'ساعة|:count ساعات',
    'minute' => 'دقيقة|:count دقائق',
    'second' => 'ثوان|:count ثانية',
    'ago' => 'منذ :time',
    'from_now' => 'في :time',
    'formats' => [
        'LT' => 'HH:mm',
        'LTS' => 'HH:mm:ss',
        'L' => 'DD/MM/YYYY',
        'LL' => 'D MMMM YYYY',
        'LLL' => 'D MMMM YYYY HH:mm',
        'LLLL' => 'dddd D MMMM YYYY HH:mm',
    ],
    'calendar' => [
        'sameDay' => '[اليوم على الساعة] LT',
        'nextDay' => '[غدا على الساعة] LT',
        'nextWeek' => 'dddd [على الساعة] LT',
        'lastDay' => '[أمس على الساعة] LT',
        'lastWeek' => 'dddd [على الساعة] LT',
        'sameElse' => 'L',
    ],
    'months' => ['يناير', 'فبراير', 'مارس', 'أبريل', 'ماي', 'يونيو', 'يوليوز', 'غشت', 'شتنبر', 'أكتوبر', 'نونبر', 'دجنبر'],
    'months_short' => ['يناير', 'فبراير', 'مارس', 'أبريل', 'ماي', 'يونيو', 'يوليوز', 'غشت', 'شتنبر', 'أكتوبر', 'نونبر', 'دجنبر'],
    'weekdays' => ['الأحد', 'الإتنين', 'الثلاثاء', 'الأربعاء', 'الخميس', 'الجمعة', 'السبت'],
    'weekdays_short' => ['احد', 'اتنين', 'ثلاثاء', 'اربعاء', 'خميس', 'جمعة', 'سبت'],
    'weekdays_min' => ['ح', 'ن', 'ث', 'ر', 'خ', 'ج', 'س'],
];
