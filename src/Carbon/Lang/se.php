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
}, 'se');

/*
 * Authors:
 * - François B
 * - Karamell
 */
return [
    'year' => ':count jahki|:count jagit',
    'a_year' => 'okta jahki|:count jagit',
    'y' => ':count j.',
    'month' => ':count mánnu|:count mánut',
    'a_month' => 'okta mánnu|:count mánut',
    'm' => ':count mán.',
    'week' => ':count vahkku|:count vahkku',
    'a_week' => 'okta vahkku|:count vahkku',
    'w' => ':count v.',
    'day' => ':count beaivi|:count beaivvit',
    'a_day' => 'okta beaivi|:count beaivvit',
    'd' => ':count b.',
    'hour' => ':count diimmu|:count diimmut',
    'a_hour' => 'okta diimmu|:count diimmut',
    'h' => ':count d.',
    'minute' => ':count minuhta|:count minuhtat',
    'a_minute' => 'okta minuhta|:count minuhtat',
    'min' => ':count min.',
    'second' => ':count sekunddat|:count sekunddat',
    'a_second' => 'moadde sekunddat|:count sekunddat',
    's' => ':count s.',
    'ago' => 'maŋit :time',
    'from_now' => ':time geažes',
    'diff_yesterday' => 'ikte',
    'diff_tomorrow' => 'ihttin',
    'formats' => [
        'LT' => 'HH:mm',
        'LTS' => 'HH:mm:ss',
        'L' => 'DD.MM.YYYY',
        'LL' => 'MMMM D. [b.] YYYY',
        'LLL' => 'MMMM D. [b.] YYYY [ti.] HH:mm',
        'LLLL' => 'dddd, MMMM D. [b.] YYYY [ti.] HH:mm',
    ],
    'calendar' => [
        'sameDay' => '[otne ti] LT',
        'nextDay' => '[ihttin ti] LT',
        'nextWeek' => 'dddd [ti] LT',
        'lastDay' => '[ikte ti] LT',
        'lastWeek' => '[ovddit] dddd [ti] LT',
        'sameElse' => 'L',
    ],
    'ordinal' => ':number.',
    'months' => ['ođđajagemánnu', 'guovvamánnu', 'njukčamánnu', 'cuoŋománnu', 'miessemánnu', 'geassemánnu', 'suoidnemánnu', 'borgemánnu', 'čakčamánnu', 'golggotmánnu', 'skábmamánnu', 'juovlamánnu'],
    'months_short' => ['ođđj', 'guov', 'njuk', 'cuo', 'mies', 'geas', 'suoi', 'borg', 'čakč', 'golg', 'skáb', 'juov'],
    'weekdays' => ['sotnabeaivi', 'vuossárga', 'maŋŋebárga', 'gaskavahkku', 'duorastat', 'bearjadat', 'lávvardat'],
    'weekdays_short' => ['sotn', 'vuos', 'maŋ', 'gask', 'duor', 'bear', 'láv'],
    'weekdays_min' => ['s', 'v', 'm', 'g', 'd', 'b', 'L'],
    'first_day_of_week' => 1,
    'day_of_first_week_of_year' => 4,
    'list' => [', ', ' ja '],
    'meridiem' => ['i.b.', 'e.b.'],
];
