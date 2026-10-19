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
 * - JD Isaacks
 * - Atef Ben Ali (atefBB)
 * - Mohamed Sabil (mohamedsabil83)
 * - Abdullah-Alhariri
 * - Mousab Salah (123mousab)
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
    'year' => implode('|', [':count سنة', 'سنة', 'سنتين', ':count سنوات', ':count سنة', ':count سنة']),
    'a_year' => implode('|', [':count سنة', 'سنة', 'سنتين', ':count سنوات', ':count سنة', ':count سنة']),
    'month' => implode('|', [':count شهر', 'شهر', 'شهرين', ':count أشهر', ':count شهر', ':count شهر']),
    'a_month' => implode('|', [':count شهر', 'شهر', 'شهرين', ':count أشهر', ':count شهر', ':count شهر']),
    'week' => implode('|', [':count أسبوع', 'أسبوع', 'أسبوعين', ':count أسابيع', ':count أسبوع', ':count أسبوع']),
    'a_week' => implode('|', [':count أسبوع', 'أسبوع', 'أسبوعين', ':count أسابيع', ':count أسبوع', ':count أسبوع']),
    'day' => implode('|', [':count يوم', 'يوم', 'يومين', ':count أيام', ':count يوم', ':count يوم']),
    'a_day' => implode('|', [':count يوم', 'يوم', 'يومين', ':count أيام', ':count يوم', ':count يوم']),
    'hour' => implode('|', [':count ساعة', 'ساعة', 'ساعتين', ':count ساعات', ':count ساعة', ':count ساعة']),
    'a_hour' => implode('|', [':count ساعة', 'ساعة', 'ساعتين', ':count ساعات', ':count ساعة', ':count ساعة']),
    'minute' => implode('|', [':count دقيقة', 'دقيقة', 'دقيقتين', ':count دقائق', ':count دقيقة', ':count دقيقة']),
    'a_minute' => implode('|', [':count دقيقة', 'دقيقة', 'دقيقتين', ':count دقائق', ':count دقيقة', ':count دقيقة']),
    'second' => implode('|', [':count ثانية', 'ثانية', 'ثانيتين', ':count ثواني', ':count ثانية', ':count ثانية']),
    'a_second' => implode('|', [':count ثانية', 'ثانية', 'ثانيتين', ':count ثواني', ':count ثانية', ':count ثانية']),
    'ago' => 'منذ :time',
    'from_now' => 'في :time',
    'after' => 'بعد :time',
    'before' => 'قبل :time',
    'diff_now' => 'الآن',
    'diff_today' => 'اليوم',
    'diff_today_regexp' => 'اليوم(?:\\s+على)?(?:\\s+الساعة)?',
    'diff_yesterday' => 'أمس',
    'diff_yesterday_regexp' => 'أمس(?:\\s+على)?(?:\\s+الساعة)?',
    'diff_tomorrow' => 'غداً',
    'diff_tomorrow_regexp' => 'غدً?اً?(?:\\s+على)?(?:\\s+الساعة)?',
    'diff_before_yesterday' => 'قبل الأمس',
    'diff_after_tomorrow' => 'بعد غد',
    'period_recurrences' => implode('|', [':count مرة', 'مرة', 'مرتين', ':count مرات', ':count مرة', ':count مرة']),
    'period_interval' => 'كل :interval',
    'period_start_date' => 'من :date',
    'period_end_date' => 'إلى :date',
    'months' => $months,
    'months_short' => $months,
    'weekdays' => ['الأحد', 'الاثنين', 'الثلاثاء', 'الأربعاء', 'الخميس', 'الجمعة', 'السبت'],
    'weekdays_short' => ['أحد', 'اثنين', 'ثلاثاء', 'أربعاء', 'خميس', 'جمعة', 'سبت'],
    'weekdays_min' => ['ح', 'ن', 'ث', 'ر', 'خ', 'ج', 'س'],
    'list' => ['، ', ' و '],
    'first_day_of_week' => 6,
    'day_of_first_week_of_year' => 1,
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
    'meridiem' => ['ص', 'م'],
    'weekend' => [5, 6],
    'alt_numbers' => ['۰۰', '۰۱', '۰۲', '۰۳', '۰٤', '۰٥', '۰٦', '۰۷', '۰۸', '۰۹', '۱۰', '۱۱', '۱۲', '۱۳', '۱٤', '۱٥', '۱٦', '۱۷', '۱۸', '۱۹', '۲۰', '۲۱', '۲۲', '۲۳', '۲٤', '۲٥', '۲٦', '۲۷', '۲۸', '۲۹', '۳۰', '۳۱', '۳۲', '۳۳', '۳٤', '۳٥', '۳٦', '۳۷', '۳۸', '۳۹', '٤۰', '٤۱', '٤۲', '٤۳', '٤٤', '٤٥', '٤٦', '٤۷', '٤۸', '٤۹', '٥۰', '٥۱', '٥۲', '٥۳', '٥٤', '٥٥', '٥٦', '٥۷', '٥۸', '٥۹', '٦۰', '٦۱', '٦۲', '٦۳', '٦٤', '٦٥', '٦٦', '٦۷', '٦۸', '٦۹', '۷۰', '۷۱', '۷۲', '۷۳', '۷٤', '۷٥', '۷٦', '۷۷', '۷۸', '۷۹', '۸۰', '۸۱', '۸۲', '۸۳', '۸٤', '۸٥', '۸٦', '۸۷', '۸۸', '۸۹', '۹۰', '۹۱', '۹۲', '۹۳', '۹٤', '۹٥', '۹٦', '۹۷', '۹۸', '۹۹'],
];
