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
    'month' => 'месец|:count месеци',
    'week' => ':count седмица|:count седмици',
    'day' => 'ден|:count дена',
    'hour' => 'час|:count часа',
    'minute' => 'минута|:count минути',
    'second' => 'неколку секунди|:count секунди',
    'ago' => 'пред :time',
    'from_now' => 'после :time',
    'after' => 'по :time',
    'before' => 'пред :time',
    'formats' => [
        'LT' => 'H:mm',
        'LTS' => 'H:mm:ss',
        'L' => 'D.MM.YYYY',
        'LL' => 'D MMMM YYYY',
        'LLL' => 'D MMMM YYYY H:mm',
        'LLLL' => 'dddd, D MMMM YYYY H:mm',
    ],
    'calendar' => [
        'sameDay' => '[Денес во] LT',
        'nextDay' => '[Утре во] LT',
        'nextWeek' => '[Во] dddd [во] LT',
        'lastDay' => '[Вчера во] LT',
        'lastWeek' => '',
        'sameElse' => 'L',
    ],
    'months' => ['јануари', 'февруари', 'март', 'април', 'мај', 'јуни', 'јули', 'август', 'септември', 'октомври', 'ноември', 'декември'],
    'months_short' => ['јан', 'фев', 'мар', 'апр', 'мај', 'јун', 'јул', 'авг', 'сеп', 'окт', 'ное', 'дек'],
    'weekdays' => ['недела', 'понеделник', 'вторник', 'среда', 'четврток', 'петок', 'сабота'],
    'weekdays_short' => ['нед', 'пон', 'вто', 'сре', 'чет', 'пет', 'саб'],
    'weekdays_min' => ['нe', 'пo', 'вт', 'ср', 'че', 'пе', 'сa'],
];
