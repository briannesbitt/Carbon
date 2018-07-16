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
    'year' => 'рік|',
    'y' => ':count рік|:count роки|:count років',
    'month' => 'місяць|',
    'm' => ':count місяць|:count місяці|:count місяців',
    'week' => ':count тиждень|:count тижні|:count тижнів',
    'w' => ':count тиждень|:count тижні|:count тижнів',
    'day' => 'день|',
    'd' => ':count день|:count дні|:count днів',
    'hour' => 'годину|',
    'h' => ':count година|:count години|:count годин',
    'minute' => '|',
    'min' => ':count хвилину|:count хвилини|:count хвилин',
    'second' => 'декілька секунд|',
    's' => ':count секунду|:count секунди|:count секунд',
    'ago' => ':time тому',
    'from_now' => 'за :time',
    'after' => ':time після',
    'before' => ':time до',
    'diff_now' => 'щойно',
    'diff_yesterday' => 'вчора',
    'diff_tomorrow' => 'завтра',
    'diff_before_yesterday' => 'позавчора',
    'diff_after_tomorrow' => 'післязавтра',
    'period_recurrences' => 'один раз|:count рази|:count разів',
    'period_interval' => 'кожні :interval',
    'period_start_date' => 'з :date',
    'period_end_date' => 'до :date',
    'formats' => [
        'LT' => 'HH:mm',
        'LTS' => 'HH:mm:ss',
        'L' => 'DD.MM.YYYY',
        'LL' => 'D MMMM YYYY р.',
        'LLL' => 'D MMMM YYYY р., HH:mm',
        'LLLL' => 'dddd, D MMMM YYYY р., HH:mm',
    ],
    'calendar' => [
        'sameDay' => '',
        'nextDay' => '',
        'nextWeek' => '',
        'lastDay' => '',
        'lastWeek' => '',
        'sameElse' => 'L',
    ],
    'months' => [
    ],
    'months_short' => ['січ', 'лют', 'бер', 'квіт', 'трав', 'черв', 'лип', 'серп', 'вер', 'жовт', 'лист', 'груд'],
    'weekdays' => [
    ],
    'weekdays_short' => ['нд', 'пн', 'вт', 'ср', 'чт', 'пт', 'сб'],
    'weekdays_min' => ['нд', 'пн', 'вт', 'ср', 'чт', 'пт', 'сб'],
];
