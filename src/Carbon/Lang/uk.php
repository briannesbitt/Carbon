<?php

/*
 * This file is part of the Carbon package.
 *
 * (c) Brian Nesbitt <brian@nesbot.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

$processHoursFunction = function (\Carbon\CarbonInterface $date, string $format) {
    return $format.'о'.($date->hour === 11 ? 'б' : '').'] LT';
};

return [
    'year' => ':count рік|:count роки|:count років',
    'y' => ':count рік|:count роки|:count років',
    'month' => ':count місяць|:count місяці|:count місяців',
    'm' => ':count місяць|:count місяці|:count місяців',
    'week' => ':count тиждень|:count тижні|:count тижнів',
    'w' => ':count тиждень|:count тижні|:count тижнів',
    'day' => ':count день|:count дні|:count днів',
    'd' => ':count день|:count дні|:count днів',
    'hour' => ':count година|:count години|:count годин',
    'h' => ':count година|:count години|:count годин',
    'minute' => ':count хвилину|:count хвилини|:count хвилин',
    'min' => ':count хвилину|:count хвилини|:count хвилин',
    'second' => ':count секунду|:count секунди|:count секунд',
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
        'sameDay' => function (\Carbon\CarbonInterface $date) use ($processHoursFunction) {
            return $processHoursFunction($date, '[Сьогодні ');
        },
        'nextDay' => function (\Carbon\CarbonInterface $date) use ($processHoursFunction) {
            return $processHoursFunction($date, '[Завтра ');
        },
        'nextWeek' => function (\Carbon\CarbonInterface $date) use ($processHoursFunction) {
            return $processHoursFunction($date, '[У] dddd [');
        },
        'lastDay' => function (\Carbon\CarbonInterface $date) use ($processHoursFunction) {
            return $processHoursFunction($date, '[Вчора ');
        },
        'lastWeek' => function (\Carbon\CarbonInterface $date) use ($processHoursFunction) {
            switch ($date->dayOfWeek) {
                case 0:
                case 3:
                case 5:
                case 6:
                    return $processHoursFunction($date, '[Минулої] dddd [');
                default:
                    return $processHoursFunction($date, '[Минулого] dddd [');
            }
        },
        'sameElse' => 'L',
    ],
    'ordinal' => function ($number, $period) {
        switch ($period) {
            case 'M':
            case 'd':
            case 'DDD':
            case 'w':
            case 'W':
                return $number.'-й';
            case 'D':
                return $number.'-го';
            default:
                return $number;
        }
    },
    'meridiem' => function ($hour, $minute, $isLower) {
        if ($hour < 4) {
            return 'ночі';
        }
        if ($hour < 12) {
            return 'ранку';
        }
        if ($hour < 17) {
            return 'дня';
        }

        return 'вечора';
    },
    'months' => ['січня', 'лютого', 'березня', 'квітня', 'травня', 'червня', 'липня', 'серпня', 'вересня', 'жовтня', 'листопада', 'грудня'],
    'months_standalone' => ['січень', 'лютий', 'березень', 'квітень', 'травень', 'червень', 'липень', 'серпень', 'вересень', 'жовтень', 'листопад', 'грудень'],
    'months_short' => ['січ', 'лют', 'бер', 'квіт', 'трав', 'черв', 'лип', 'серп', 'вер', 'жовт', 'лист', 'груд'],
    'weekdays' => ['неділя', 'понеділок', 'вівторок', 'середа', 'четвер', 'п’ятниця', 'субота'],
    'weekdays_short' => ['нд', 'пн', 'вт', 'ср', 'чт', 'пт', 'сб'],
    'weekdays_min' => ['нд', 'пн', 'вт', 'ср', 'чт', 'пт', 'сб'],
    'first_day_of_week' => 1,
    'day_of_first_week_of_year' => 1,
];
