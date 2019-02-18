<?php

/**
 * This file is part of the Carbon package.
 *
 * (c) Brian Nesbitt <brian@nesbot.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

return [
    'year' => ':count سال',
    'a_year' => 'یک سال'.'|:count '.'سال',
    'y' => ':count سال',
    'month' => ':count ماه',
    'a_month' => 'یک ماه'.'|:count '.'ماه',
    'm' => ':count ماه',
    'week' => ':count هفته',
    'a_week' => 'یک هفته'.'|:count '.'هفته',
    'w' => ':count هفته',
    'day' => ':count روز',
    'a_day' => 'یک روز'.'|:count '.'روز',
    'd' => ':count روز',
    'hour' => ':count ساعت',
    'a_hour' => 'یک دقیقهیک ساعت'.'|:count '.'ساعت',
    'h' => ':count ساعت',
    'minute' => ':count دقیقه',
    'a_minute' => 'یک دقیقه'.'|:count '.'دقیقه',
    'min' => ':count دقیقه',
    'second' => ':count ثانیه|چند ثانیه',
    's' => ':count ثانیه',
    'ago' => ':time پیش',
    'from_now' => 'در :time',
    'after' => ':time پس از',
    'before' => ':time پیش از',
    'formats' => [
        'LT' => 'HH:mm',
        'LTS' => 'HH:mm:ss',
        'L' => 'DD/MM/YYYY',
        'LL' => 'D MMMM YYYY',
        'LLL' => 'D MMMM YYYY HH:mm',
        'LLLL' => 'dddd, D MMMM YYYY HH:mm',
    ],
    'calendar' => [
        'sameDay' => '[امروز ساعت] LT',
        'nextDay' => '[فردا ساعت] LT',
        'nextWeek' => 'dddd [ساعت] LT',
        'lastDay' => '[دیروز ساعت] LT',
        'lastWeek' => 'dddd [پیش] [ساعت] LT',
        'sameElse' => 'L',
    ],
    'ordinal' => ':timeم',
    'meridiem' => function ($hour, $minute, $isLower) {
        return $hour < 12 ? 'قبل از ظهر' : 'بعد از ظهر';
    },
    'months' => ['ژانویه', 'فوریه', 'مارس', 'آوریل', 'مه', 'ژوئن', 'ژوئیه', 'اوت', 'سپتامبر', 'اکتبر', 'نوامبر', 'دسامبر'],
    'months_short' => ['ژانویه', 'فوریه', 'مارس', 'آوریل', 'مه', 'ژوئن', 'ژوئیه', 'اوت', 'سپتامبر', 'اکتبر', 'نوامبر', 'دسامبر'],
    'weekdays' => ['یکu200cشنبه', 'دوشنبه', 'سهu200cشنبه', 'چهارشنبه', 'پنجu200cشنبه', 'جمعه', 'شنبه'],
    'weekdays_short' => ['یکu200cشنبه', 'دوشنبه', 'سهu200cشنبه', 'چهارشنبه', 'پنجu200cشنبه', 'جمعه', 'شنبه'],
    'weekdays_min' => ['ی', 'د', 'س', 'چ', 'پ', 'ج', 'ش'],
    'first_day_of_week' => 6,
    'day_of_first_week_of_year' => 1,
    'list' => ['، ', ' و '],
];
