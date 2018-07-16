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
    'year' => 'год|',
    'y' => ':count год|:count года|:count лет',
    'month' => 'месяц|',
    'm' => ':count месяц|:count месяца|:count месяцев',
    'week' => ':count неделю|:count недели|:count недель',
    'w' => ':count неделю|:count недели|:count недель',
    'day' => 'день|',
    'd' => ':count день|:count дня|:count дней',
    'hour' => 'час|',
    'h' => ':count час|:count часа|:count часов',
    'minute' => '|',
    'min' => ':count минуту|:count минуты|:count минут',
    'second' => 'несколько секунд|',
    's' => ':count секунду|:count секунды|:count секунд',
    'ago' => ':time назад',
    'from_now' => 'через :time',
    'after' => ':time после',
    'before' => ':time до',
    'formats' => [
        'LT' => 'H:mm',
        'LTS' => 'H:mm:ss',
        'L' => 'DD.MM.YYYY',
        'LL' => 'D MMMM YYYY г.',
        'LLL' => 'D MMMM YYYY г., H:mm',
        'LLLL' => 'dddd, D MMMM YYYY г., H:mm',
    ],
    'calendar' => [
        'sameDay' => '[Сегодня, в] LT',
        'nextDay' => '[Завтра, в] LT',
        'nextWeek' => '',
        'lastDay' => '[Вчера, в] LT',
        'lastWeek' => '',
        'sameElse' => 'L',
    ],
    'months' => [
    ],
    'months_short' => [
    ],
    'weekdays' => [
    ],
    'weekdays_short' => ['вс', 'пн', 'вт', 'ср', 'чт', 'пт', 'сб'],
    'weekdays_min' => ['вс', 'пн', 'вт', 'ср', 'чт', 'пт', 'сб'],
];
