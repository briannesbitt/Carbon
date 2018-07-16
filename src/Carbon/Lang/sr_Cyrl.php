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
    'year' => 'годину|',
    'y' => ':count г.',
    'month' => 'месец|',
    'm' => ':count м.',
    'week' => '{1} :count недеља|{2,3,4}:count недеље|[5,Inf[ :count недеља',
    'w' => ':count нед.',
    'day' => 'дан|',
    'd' => ':count д.',
    'hour' => '|',
    'h' => ':count ч.',
    'minute' => '|',
    'min' => ':count мин.',
    'second' => 'неколико секунди|',
    's' => ':count сек.',
    'ago' => 'пре :time',
    'from_now' => 'за :time',
    'after' => ':time након',
    'before' => ':time пре',
    'year_from_now' => '{1,21,31,41,51} :count годину|{2,3,4,22,23,24,32,33,34,42,43,44,52,53,54} :count године|[5,Inf[ :count година',
    'year_ago' => '{1,21,31,41,51} :count годину|{2,3,4,22,23,24,32,33,34,42,43,44,52,53,54} :count године|[5,Inf[ :count година',
    'week_from_now' => '{1} :count недељу|{2,3,4} :count недеље|[5,Inf[ :count недеља',
    'week_ago' => '{1} :count недељу|{2,3,4} :count недеље|[5,Inf[ :count недеља',
    'diff_now' => 'управо сада',
    'diff_yesterday' => 'јуче',
    'diff_tomorrow' => 'сутра',
    'diff_before_yesterday' => 'прекјуче',
    'diff_after_tomorrow' => 'прекосутра',
    'formats' => [
        'LT' => 'H:mm',
        'LTS' => 'H:mm:ss',
        'L' => 'DD.MM.YYYY',
        'LL' => 'D. MMMM YYYY',
        'LLL' => 'D. MMMM YYYY H:mm',
        'LLLL' => 'dddd, D. MMMM YYYY H:mm',
    ],
    'calendar' => [
        'sameDay' => '[данас у] LT',
        'nextDay' => '[сутра у] LT',
        'nextWeek' => '',
        'lastDay' => '[јуче у] LT',
        'lastWeek' => '',
        'sameElse' => 'L',
    ],
    'months' => ['јануар', 'фебруар', 'март', 'април', 'мај', 'јун', 'јул', 'август', 'септембар', 'октобар', 'новембар', 'децембар'],
    'months_short' => ['јан.', 'феб.', 'мар.', 'апр.', 'мај', 'јун', 'јул', 'авг.', 'сеп.', 'окт.', 'нов.', 'дец.'],
    'weekdays' => ['недеља', 'понедељак', 'уторак', 'среда', 'четвртак', 'петак', 'субота'],
    'weekdays_short' => ['нед.', 'пон.', 'уто.', 'сре.', 'чет.', 'пет.', 'суб.'],
    'weekdays_min' => ['не', 'по', 'ут', 'ср', 'че', 'пе', 'су'],
];
