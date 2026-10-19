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
 * - Abdellah Chadidi
 * - Atef Ben Ali (atefBB)
 * - Mohamed Sabil (mohamedsabil83)
 * - Mousab Salah (123mousab)
 */
// Same for long and short
$months = [
    // @TODO add shakl to months
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
    'year' => implode('|', [':count سَنَة', 'سَنَة', 'سَنَتَيْن', ':count سَنَوَات', ':count سَنَة', ':count سَنَة']),
    'a_year' => implode('|', [':count سَنَة', 'سَنَة', 'سَنَتَيْن', ':count سَنَوَات', ':count سَنَة', ':count سَنَة']),
    'month' => implode('|', [':count شَهْرَ', 'شَهْرَ', 'شَهْرَيْن', ':count أَشْهُر', ':count شَهْرَ', ':count شَهْرَ']),
    'a_month' => implode('|', [':count شَهْرَ', 'شَهْرَ', 'شَهْرَيْن', ':count أَشْهُر', ':count شَهْرَ', ':count شَهْرَ']),
    'week' => implode('|', [':count أُسْبُوع', 'أُسْبُوع', 'أُسْبُوعَيْن', ':count أَسَابِيع', ':count أُسْبُوع', ':count أُسْبُوع']),
    'a_week' => implode('|', [':count أُسْبُوع', 'أُسْبُوع', 'أُسْبُوعَيْن', ':count أَسَابِيع', ':count أُسْبُوع', ':count أُسْبُوع']),
    'day' => implode('|', [':count يَوْم', 'يَوْم', 'يَوْمَيْن', ':count أَيَّام', ':count يَوْم', ':count يَوْم']),
    'a_day' => implode('|', [':count يَوْم', 'يَوْم', 'يَوْمَيْن', ':count أَيَّام', ':count يَوْم', ':count يَوْم']),
    'hour' => implode('|', [':count سَاعَة', 'سَاعَة', 'سَاعَتَيْن', ':count سَاعَات', ':count سَاعَة', ':count سَاعَة']),
    'a_hour' => implode('|', [':count سَاعَة', 'سَاعَة', 'سَاعَتَيْن', ':count سَاعَات', ':count سَاعَة', ':count سَاعَة']),
    'minute' => implode('|', [':count دَقِيقَة', 'دَقِيقَة', 'دَقِيقَتَيْن', ':count دَقَائِق', ':count دَقِيقَة', ':count دَقِيقَة']),
    'a_minute' => implode('|', [':count دَقِيقَة', 'دَقِيقَة', 'دَقِيقَتَيْن', ':count دَقَائِق', ':count دَقِيقَة', ':count دَقِيقَة']),
    'second' => implode('|', [':count ثَانِيَة', 'ثَانِيَة', 'ثَانِيَتَيْن', ':count ثَوَان', ':count ثَانِيَة', ':count ثَانِيَة']),
    'a_second' => implode('|', [':count ثَانِيَة', 'ثَانِيَة', 'ثَانِيَتَيْن', ':count ثَوَان', ':count ثَانِيَة', ':count ثَانِيَة']),
    'ago' => 'مُنْذُ :time',
    'from_now' => 'مِنَ الْآن :time',
    'after' => 'بَعْدَ :time',
    'before' => 'قَبْلَ :time',

    // @TODO add shakl to translations below
    'diff_now' => 'الآن',
    'diff_today' => 'اليوم',
    'diff_today_regexp' => 'اليوم(?:\\s+عند)?(?:\\s+الساعة)?',
    'diff_yesterday' => 'أمس',
    'diff_yesterday_regexp' => 'أمس(?:\\s+عند)?(?:\\s+الساعة)?',
    'diff_tomorrow' => 'غداً',
    'diff_tomorrow_regexp' => 'غدً?اً?(?:\\s+عند)?(?:\\s+الساعة)?',
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
