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
    'year' => 'година|:count години',
    'y' => ':count година|:count години',
    'month' => 'месец|:count месеца',
    'm' => ':count месец|:count месеца',
    'week' => ':count седмица|:count седмици',
    'w' => ':count седмица|:count седмици',
    'day' => 'ден|:count дни',
    'd' => ':count ден|:count дни',
    'hour' => 'час|:count часа',
    'h' => ':count час|:count часа',
    'minute' => 'минута|:count минути',
    'min' => ':count минута|:count минути',
    'second' => 'няколко секунди|:count секунди',
    's' => ':count секунда|:count секунди',
    'ago' => 'преди :time',
    'from_now' => 'след :time',
    'after' => 'след :time',
    'before' => 'преди :time',
    'formats' => [
        'LT' => 'H:mm',
        'LTS' => 'H:mm:ss',
        'L' => 'D.MM.YYYY',
        'LL' => 'D MMMM YYYY',
        'LLL' => 'D MMMM YYYY H:mm',
        'LLLL' => 'dddd, D MMMM YYYY H:mm',
    ],
    'calendar' => [
        'sameDay' => '[Днес в] LT',
        'nextDay' => '[Утре в] LT',
        'nextWeek' => 'dddd [в] LT',
        'lastDay' => '[Вчера в] LT',
        'lastWeek' => '',
        'sameElse' => 'L',
    ],
    'months' => ['януари', 'февруари', 'март', 'април', 'май', 'юни', 'юли', 'август', 'септември', 'октомври', 'ноември', 'декември'],
    'months_short' => ['янр', 'фев', 'мар', 'апр', 'май', 'юни', 'юли', 'авг', 'сеп', 'окт', 'ное', 'дек'],
    'weekdays' => ['неделя', 'понеделник', 'вторник', 'сряда', 'четвъртък', 'петък', 'събота'],
    'weekdays_short' => ['нед', 'пон', 'вто', 'сря', 'чет', 'пет', 'съб'],
    'weekdays_min' => ['нд', 'пн', 'вт', 'ср', 'чт', 'пт', 'сб'],
];
