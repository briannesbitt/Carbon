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
}, 'se');

return [
    'year' => 'okta jahki|:count jagit',
    'month' => 'okta mánnu|:count mánut',
    'week' => 'okta vahkku|:count vahkku',
    'day' => 'okta beaivi|:count beaivvit',
    'hour' => 'okta diimmu|:count diimmut',
    'minute' => 'okta minuhta|:count minuhtat',
    'second' => 'moadde sekunddat|:count sekunddat',
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
];
