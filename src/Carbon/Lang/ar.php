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
 * - Atef Ben Ali (atefBB)
 * - Ibrahim AshShohail
 * - MLTDev
 * - Mohamed Sabil (mohamedsabil83)
 * - Yazan Alnugnugh (yazan-alnugnugh)
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
    'year' => implode('|', ['{0}:count سنة', '{1}:count سنة', '{2}:count سنتين', ']2,11[:count سنوات', ']10,Inf[:count سنة']),
    'a_year' => implode('|', ['{0}:count سنة', '{1}:count سنة', '{2}:count سنتين', ']2,11[:count سنوات', ']10,Inf[:count سنة']),
    'month' => implode('|', ['{0}:count شهر', '{1}:count شهر', '{2}:count شهرين', ']2,11[:count شهور', ']10,Inf[:count شهر']),
    'a_month' => implode('|', ['{0}:count شهر', '{1}:count شهر', '{2}:count شهرين', ']2,11[:count شهور', ']10,Inf[:count شهر']),
    'week' => implode('|', ['{0}:count أسبوع', '{1}:count أسبوع', '{2}:count أسبوعين', ']2,11[:count أسابيع', ']10,Inf[:count أسبوع']),
    'a_week' => implode('|', ['{0}:count أسبوع', '{1}:count أسبوع', '{2}:count أسبوعين', ']2,11[:count أسابيع', ']10,Inf[:count أسبوع']),
    'day' => implode('|', ['{0}:count يوم', '{1}:count يوم', '{2}:count يومين', ']2,11[:count أيام', ']10,Inf[:count يوم']),
    'a_day' => implode('|', ['{0}:count يوم', '{1}:count يوم', '{2}:count يومين', ']2,11[:count أيام', ']10,Inf[:count يوم']),
    'hour' => implode('|', ['{0}:count ساعة', '{1}:count ساعة', '{2}:count ساعتين', ']2,11[:count ساعات', ']10,Inf[:count ساعة']),
    'a_hour' => implode('|', ['{0}:count ساعة', '{1}:count ساعة', '{2}:count ساعتين', ']2,11[:count ساعات', ']10,Inf[:count ساعة']),
    'minute' => implode('|', ['{0}:count دقيقة', '{1}:count دقيقة', '{2}:count دقيقتين', ']2,11[:count دقائق', ']10,Inf[:count دقيقة']),
    'a_minute' => implode('|', ['{0}:count دقيقة', '{1}:count دقيقة', '{2}:count دقيقتين', ']2,11[:count دقائق', ']10,Inf[:count دقيقة']),
    'second' => implode('|', ['{0}:count ثانية', '{1}:count ثانية', '{2}:count ثانيتين', ']2,11[:count ثواني', ']10,Inf[:count ثانية']),
    'a_second' => implode('|', ['{0}:count ثانية', '{1}:count ثانية', '{2}:count ثانيتين', ']2,11[:count ثواني', ']10,Inf[:count ثانية']),
    'ago' => 'منذ :time',
    'from_now' => ':time من الآن',
    'after' => 'بعد :time',
    'before' => 'قبل :time',
    'diff_now' => 'الآن',
    'diff_yesterday' => 'أمس',
    'diff_tomorrow' => 'غداً',
    'diff_before_yesterday' => 'قبل الأمس',
    'diff_after_tomorrow' => 'بعد غد',
    'period_recurrences' => implode('|', ['{0}مرة', '{1}مرة', '{2}:count مرتين', ']2,11[:count مرات', ']10,Inf[:count مرة']),
    'period_interval' => 'كل :interval',
    'period_start_date' => 'من :date',
    'period_end_date' => 'إلى :date',
    'months' => $months,
    'months_short' => $months,
    'weekdays' => ['الأحد', 'الاثنين', 'الثلاثاء', 'الأربعاء', 'الخميس', 'الجمعة', 'السبت'],
    'weekdays_short' => ['أحد', 'اثنين', 'ثلاثاء', 'أربعاء', 'خميس', 'جمعة', 'سبت'],
    'weekdays_min' => ['ح', 'اث', 'ثل', 'أر', 'خم', 'ج', 'س'],
    'list' => ['، ', ' و '],
    'first_day_of_week' => 6,
    'day_of_first_week_of_year' => 1,
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
    'meridiem' => ['ص', 'م'],
    'weekend' => [5, 6],
];
