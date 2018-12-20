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
    'جنوری',
    'فروری',
    'مارچ',
    'اپریل',
    'مئی',
    'جون',
    'جولائی',
    'اگست',
    'ستمبر',
    'اکتوبر',
    'نومبر',
    'دسمبر',
];

$weekdays = [
    'اتوار',
    'پیر',
    'منگل',
    'بدھ',
    'جمعرات',
    'جمعہ',
    'ہفتہ',
];

return [
    'year' => 'ایک سال|:count سال',
    'month' => 'ایک ماہ|:count ماہ',
    'week' => ':count ہفتے',
    'day' => 'ایک دن|:count دن',
    'hour' => 'ایک گھنٹہ|:count گھنٹے',
    'minute' => 'ایک منٹ|:count منٹ',
    'second' => 'چند سیکنڈ|:count سیکنڈ',
    'ago' => ':time قبل',
    'from_now' => ':time بعد',
    'after' => ':time بعد',
    'before' => ':time پہلے',
    'formats' => [
        'LT' => 'HH:mm',
        'LTS' => 'HH:mm:ss',
        'L' => 'DD/MM/YYYY',
        'LL' => 'D MMMM YYYY',
        'LLL' => 'D MMMM YYYY HH:mm',
        'LLLL' => 'dddd، D MMMM YYYY HH:mm',
    ],
    'calendar' => [
        'sameDay' => '[آج بوقت] LT',
        'nextDay' => '[کل بوقت] LT',
        'nextWeek' => 'dddd [بوقت] LT',
        'lastDay' => '[گذشتہ روز بوقت] LT',
        'lastWeek' => '[گذشتہ] dddd [بوقت] LT',
        'sameElse' => 'L',
    ],
    'meridiem' => function ($hour, $minute, $isLower) {
        return $hour < 12 ? 'صبح' : 'شام';
    },
    'months' => $months,
    'months_short' => $months,
    'weekdays' => $weekdays,
    'weekdays_short' => $weekdays,
    'weekdays_min' => $weekdays,
    'first_day_of_week' => 1,
    'day_of_first_week_of_year' => 4,
    'list' => ['، ', ' اور '],
];
