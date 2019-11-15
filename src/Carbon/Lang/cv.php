<?php

/**
 * This file is part of the Carbon package.
 *
 * (c) Brian Nesbitt <brian@nesbot.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
\Symfony\Component\Translation\PluralizationRules::set(function ($number) {
    return $number === 1 ? 0 : 1;
}, 'cv');

/*
 * Authors:
 * - Josh Soref
 * - François B
 * - JD Isaacks
 */
return [
    'year' => ':count ҫул',
    'a_year' => 'пӗр ҫул|:count ҫул',
    'month' => ':count уйӑх',
    'a_month' => 'пӗр уйӑх|:count уйӑх',
    'week' => ':count эрне',
    'a_week' => 'пӗр эрне|:count эрне',
    'day' => ':count кун',
    'a_day' => 'пӗр кун|:count кун',
    'hour' => ':count сехет',
    'a_hour' => 'пӗр сехет|:count сехет',
    'minute' => ':count минут',
    'a_minute' => 'пӗр минут|:count минут',
    'second' => ':count ҫеккунт',
    'a_second' => 'пӗр-ик ҫеккунт|:count ҫеккунт',
    'ago' => ':time каялла',
    'from_now' => function ($time) {
        return $time.(\preg_match('/сехет$/', $time) ? 'рен' : (\preg_match('/ҫул/', $time) ? 'тан' : 'ран'));
    },
    'diff_yesterday' => 'Ӗнер',
    'diff_tomorrow' => 'Ыран',
    'formats' => [
        'LT' => 'HH:mm',
        'LTS' => 'HH:mm:ss',
        'L' => 'DD-MM-YYYY',
        'LL' => 'YYYY [ҫулхи] MMMM [уйӑхӗн] D[-мӗшӗ]',
        'LLL' => 'YYYY [ҫулхи] MMMM [уйӑхӗн] D[-мӗшӗ], HH:mm',
        'LLLL' => 'dddd, YYYY [ҫулхи] MMMM [уйӑхӗн] D[-мӗшӗ], HH:mm',
    ],
    'calendar' => [
        'sameDay' => '[Паян] LT [сехетре]',
        'nextDay' => '[Ыран] LT [сехетре]',
        'nextWeek' => '[Ҫитес] dddd LT [сехетре]',
        'lastDay' => '[Ӗнер] LT [сехетре]',
        'lastWeek' => '[Иртнӗ] dddd LT [сехетре]',
        'sameElse' => 'L',
    ],
    'ordinal' => ':number-мӗш',
    'months' => ['кӑрлач', 'нарӑс', 'пуш', 'ака', 'май', 'ҫӗртме', 'утӑ', 'ҫурла', 'авӑн', 'юпа', 'чӳк', 'раштав'],
    'months_short' => ['кӑр', 'нар', 'пуш', 'ака', 'май', 'ҫӗр', 'утӑ', 'ҫур', 'авн', 'юпа', 'чӳк', 'раш'],
    'weekdays' => ['вырсарникун', 'тунтикун', 'ытларикун', 'юнкун', 'кӗҫнерникун', 'эрнекун', 'шӑматкун'],
    'weekdays_short' => ['выр', 'тун', 'ытл', 'юн', 'кӗҫ', 'эрн', 'шӑм'],
    'weekdays_min' => ['вр', 'тн', 'ыт', 'юн', 'кҫ', 'эр', 'шм'],
    'first_day_of_week' => 1,
    'day_of_first_week_of_year' => 1,
    'list' => [', ', ' тата '],
];
