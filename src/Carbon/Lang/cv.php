<?php

/*
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

return [
    'year' => 'пӗр ҫул|:count ҫул',
    'month' => 'пӗр уйӑх|:count уйӑх',
    'week' => 'пӗр эрне|:count эрне',
    'day' => 'пӗр кун|:count кун',
    'hour' => 'пӗр сехет|:count сехет',
    'minute' => 'пӗр минут|:count минут',
    'second' => 'пӗр-ик ҫеккунт|:count ҫеккунт',
    'ago' => ':time каялла',
    'from_now' => function ($time) {
        return $time.(preg_match('/сехет$/', $time) ? 'рен' : (preg_match('/ҫул/', $time) ? 'тан' : 'ран'));
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
