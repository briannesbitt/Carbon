<?php

/*
 * This file is part of the Carbon package.
 *
 * (c) Brian Nesbitt <brian@nesbot.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

$months = [
    'يناير',
    'فبراير',
    'مارس',
    'أبريل',
    'مايو',
    'يونيو',
    'يوليو',
    'أغسطس',
    'سبتمبر',
    'أكتوبر',
    'نوفمبر',
    'ديسمبر',
];

return [
    'year' => implode('|', ['سنة', 'سنة', 'سنتين', 'سنوات'.' :count', 'سنة'.' :count']),
    'month' => implode('|', ['شهر', 'شهر', 'شهرين', 'أشهر'.' :count', 'شهر'.' :count']),
    'week' => implode('|', ['أسبوع', 'أسبوع', 'أسبوعين', 'أسابيع'.' :count', 'أسبوع'.' :count']),
    'day' => implode('|', ['يوم', 'يوم', 'يومين', 'أيام'.' :count', 'يوم'.' :count']),
    'hour' => implode('|', ['ساعة', 'ساعة', 'ساعتين', 'ساعات'.' :count', 'ساعة'.' :count']),
    'minute' => implode('|', ['دقيقة', 'دقيقة', 'دقيقتين', 'دقائق'.' :count', 'دقيقة'.' :count']),
    'second' => implode('|', ['ثانية', 'ثانية', 'ثانيتين', 'ثوان'.' :count', 'ثانية'.' :count']),
    'ago' => 'منذ :time',
    'from_now' => ':time من الآن',
    'after' => 'بعد :time',
    'before' => 'قبل :time',
    'formats' => [
        'LT' => 'HH:mm',
        'LTS' => 'HH:mm:ss',
        'L' => 'D/M/YYYY',
        'LL' => 'D MMMM YYYY',
        'LLL' => 'D MMMM YYYY HH:mm',
        'LLLL' => 'dddd D MMMM YYYY HH:mm',
    ],
    'calendar' => [
        'sameDay' => '[اليوم عند الساعة] LT',
        'nextDay' => '[غدًا عند الساعة] LT',
        'nextWeek' => 'dddd [عند الساعة] LT',
        'lastDay' => '[أمس عند الساعة] LT',
        'lastWeek' => 'dddd [عند الساعة] LT',
        'sameElse' => 'L',
    ],
    'meridiem' => function ($hour, $minute, $isLower) {
        return $hour < 12 ? 'ص' : 'م';
    },
    'weekdays' => ['الأحد', 'الإثنين', 'الثلاثاء', 'الأربعاء', 'الخميس', 'الجمعة', 'السبت'],
    'weekdays_short' => ['أحد', 'إثنين', 'ثلاثاء', 'أربعاء', 'خميس', 'جمعة', 'سبت'],
    'weekdays_min' => ['ح', 'ن', 'ث', 'ر', 'خ', 'ج', 'س'],
    'months' => $months,
    'months_short' => $months,
    'first_day_of_week' => 6,
    'day_of_first_week_of_year' => 1,
    'list' => ['، ', ' و '],
];
