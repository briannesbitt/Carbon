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
 * - Swara Mohammed
 */
$months = [
    'ڕێبەندان',
    'ڕەشەمە',
    'نەورۆز',
    'گوڵان',
    'جۆزەردان',
    'پوشپەڕ',
    'گەلاوێژ',
    'خەرمانان',
    'ڕەزبەر',
    'گەڵاڕێزان',
    'سەرماوەرز',
    'بەفرانبار',
];

return [
    'year' => implode('|', ['{0}:count ساڵێک', '{1}ساڵێک', '{2}ساڵێک', ']2,11[:count ساڵێک', ']10,Inf[:count ساڵێک']),
    'a_year' => implode('|', ['{0}:count ساڵێک', '{1}ساڵێک', '{2}ساڵێک', ']2,11[:count ساڵێک', ']10,Inf[:count ساڵێک']),
    'month' => implode('|', ['{0}:count مانگێک', '{1}مانگێک', '{2}مانگێک', ']2,11[:count مانگێک', ']10,Inf[:count مانگێک']),
    'a_month' => implode('|', ['{0}:count مانگێک', '{1}مانگێک', '{2}مانگێک', ']2,11[:count مانگێک', ']10,Inf[:count مانگێک']),
    'week' => implode('|', ['{0}:count هەفتەیەک', '{1}هەفتەیەک', '{2}هەفتەیەک', ']2,11[:count هەفتەیەک', ']10,Inf[:count هەفتەیەک']),
    'a_week' => implode('|', ['{0}:count هەفتەیەک', '{1}هەفتەیەک', '{2}هەفتەیەک', ']2,11[:count هەفتەیەک', ']10,Inf[:count هەفتەیەک']),
    'day' => implode('|', ['{0}:count ڕۆژێک', '{1}ڕۆژێک', '{2}ڕۆژێک', ']2,11[:count ڕۆژێک', ']10,Inf[:count ڕۆژێک']),
    'a_day' => implode('|', ['{0}:count ڕۆژێک', '{1}ڕۆژێک', '{2}ڕۆژێک', ']2,11[:count ڕۆژێک', ']10,Inf[:count ڕۆژێک']),
    'hour' => implode('|', ['{0}:count کاتژمێرێک', '{1}کاتژمێرێک', '{2}کاتژمێرێک', ']2,11[:count کاتژمێرێک', ']10,Inf[:count کاتژمێرێک']),
    'a_hour' => implode('|', ['{0}:count کاتژمێرێک', '{1}کاتژمێرێک', '{2}کاتژمێرێک', ']2,11[:count کاتژمێرێک', ']10,Inf[:coکاتژمێرێکunt کاتژمێرێک']),
    'minute' => implode('|', ['{0}:count خولەکێک', '{1}خولەکێک', '{2}خولەکێک', ']2,11[:count خولەکێک', ']10,Inf[:count خولەکێک']),
    'a_minute' => implode('|', ['{0}:count خولەکێک', '{1}خولەکێک', '{2}خولەکێک', ']2,11[:count خولەکێک', ']10,Inf[:count خولەکێک']),
    'second' => implode('|', ['{0}:count چرکەیەک', '{1}چرکەیەک', '{2}چرکەیەک', ']2,11[:count چرکەیەک', ']10,Inf[:count چرکەیەک']),
    'a_second' => implode('|', ['{0}:count چرکەیەک', '{1}چرکەیەک', '{2}چرکەیەک', ']2,11[:count چرکەیەک', ']10,Inf[:count چرکەیەک']),
    'ago' => 'پێشتر :time',
    'from_now' => ':time لە ئێستاوە',
    'after' => 'دوای :time',
    'before' => 'پێش :time',
    'diff_now' => 'ئێستا',
    'diff_today' => 'ئەمڕۆ',
    'diff_today_regexp' => 'ڕۆژ(?:\\s+لە)?(?:\\s+کاتژمێر)?',
    'diff_yesterday' => 'دوێنێ',
    'diff_yesterday_regexp' => 'دوێنێ(?:\\s+لە)?(?:\\s+کاتژمێر)?',
    'diff_tomorrow' => 'سبەینێ',
    'diff_tomorrow_regexp' => 'سبەینێ(?:\\s+لە)?(?:\\s+کاتژمێر)?',
    'diff_before_yesterday' => 'پێش دوێنێ',
    'diff_after_tomorrow' => 'دوای سبەینێ',
    'period_recurrences' => implode('|', ['{0}جار', '{1}جار', '{2}:count دووجار', ']2,11[:count جار', ']10,Inf[:count جار']),
    'period_interval' => 'هەموو :interval',
    'period_start_date' => 'لە :date',
    'period_end_date' => 'بۆ :date',
    'months' => $months,
    'months_short' => $months,
    'weekdays' => ['یەکشەممە', 'دووشەممە', 'سێشەممە', 'چوارشەممە', 'پێنجشەممە', 'هەینی', 'شەممە'],
    'weekdays_short' => ['یەکشەممە', 'دووشەممە', 'سێشەممە', 'چوارشەممە', 'پێنجشەممە', 'هەینی', 'شەممە'],
    'weekdays_min' => ['یەکشەممە', 'دووشەممە', 'سێشەممە', 'چوارشەممە', 'پێنجشەممە', 'هەینی', 'شەممە'],
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
        'sameDay' => '[ئەمڕۆ لە کاتژمێر] LT',
        'nextDay' => '[سبەینێ لە کاتژمێر] LT',
        'nextWeek' => 'dddd [لە کاتژمێر] LT',
        'lastDay' => '[دوێنێ لە کاتژمێر] LT',
        'lastWeek' => 'dddd [لە کاتژمێر] LT',
        'sameElse' => 'L',
    ],
    'meridiem' => ['پ.ن', 'د.ن'],
    'weekend' => [5, 6],
];
