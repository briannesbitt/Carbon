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
    return $number > 1 ? 1 : 0;
}, 'tzl');

return [
    'year' => ':count ar|:count ars',
    'y' => ':count ar|:count ars',
    'month' => ':count mes|:count mesen',
    'm' => ':count mes|:count mesen',
    'week' => ':count seifetziua|:count seifetziuas',
    'w' => ':count seifetziua|:count seifetziuas',
    'day' => ':count ziua|:count ziuas',
    'd' => ':count ziua|:count ziuas',
    'hour' => ':count þora|:count þoras',
    'h' => ':count þora|:count þoras',
    'minute' => ':count míut|:count míuts',
    'min' => ':count míut|:count míuts',
    'second' => ':count secunds',
    's' => ':count secunds',

    'ago' => 'ja :time',
    'from_now' => 'osprei :time',

    'diff_yesterday' => 'ieiri',
    'diff_tomorrow' => 'demà',

    'formats' => [
        'LT' => 'HH.mm',
        'LTS' => 'HH.mm.ss',
        'L' => 'DD.MM.YYYY',
        'LL' => 'D. MMMM [dallas] YYYY',
        'LLL' => 'D. MMMM [dallas] YYYY HH.mm',
        'LLLL' => 'dddd, [li] D. MMMM [dallas] YYYY HH.mm',
    ],

    'calendar' => [
        'sameDay' => '[oxhi à] LT',
        'nextDay' => '[demà à] LT',
        'nextWeek' => 'dddd [à] LT',
        'lastDay' => '[ieiri à] LT',
        'lastWeek' => '[sür el] dddd [lasteu à] LT',
        'sameElse' => 'L',
    ],

    'meridiem' => function ($hour, $minute, $isLower) {
        $meridiem = 'D\''.($hour > 11 ? 'O' : 'A');

        return $isLower ? strtolower($meridiem) : $meridiem;
    },

    'months' => ['Januar', 'Fevraglh', 'Març', 'Avrïu', 'Mai', 'Gün', 'Julia', 'Guscht', 'Setemvar', 'Listopäts', 'Noemvar', 'Zecemvar'],
    'months_short' => ['Jan', 'Fev', 'Mar', 'Avr', 'Mai', 'Gün', 'Jul', 'Gus', 'Set', 'Lis', 'Noe', 'Zec'],
    'weekdays' => ['Súladi', 'Lúneçi', 'Maitzi', 'Márcuri', 'Xhúadi', 'Viénerçi', 'Sáturi'],
    'weekdays_short' => ['Súl', 'Lún', 'Mai', 'Már', 'Xhú', 'Vié', 'Sát'],
    'weekdays_min' => ['Sú', 'Lú', 'Ma', 'Má', 'Xh', 'Vi', 'Sá'],
    'ordinal' => ':number.',
    'first_day_of_week' => 1,
    'day_of_first_week_of_year' => 4,
];
