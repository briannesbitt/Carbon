<?php

/**
 * This file is part of the Carbon package.
 *
 * (c) Brian Nesbitt <brian@nesbot.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * Authors:
 * - Jordi Mallach jordi@gnu.org
 */
return array_replace_recursive(require __DIR__.'/en.php', [
    'formats' => [
        'L' => 'DD/MM/YY',
    ],
    'months' => ['de xineru', 'de febreru', 'de marzu', 'd’abril', 'de mayu', 'de xunu', 'de xunetu', 'd’agostu', 'de setiembre', 'd’ochobre', 'de payares', 'd’avientu'],
    'months_short' => ['xin', 'feb', 'mar', 'abr', 'may', 'xun', 'xnt', 'ago', 'set', 'och', 'pay', 'avi'],
    'weekdays' => ['domingu', 'llunes', 'martes', 'miércoles', 'xueves', 'vienres', 'sábadu'],
    'weekdays_short' => ['dom', 'llu', 'mar', 'mié', 'xue', 'vie', 'sáb'],
    'weekdays_min' => ['dom', 'llu', 'mar', 'mié', 'xue', 'vie', 'sáb'],
    'first_day_of_week' => 1,
    'day_of_first_week_of_year' => 4,

    'year' => ':count añu',
    'y' => ':count añu',
    'a_year' => ':count añu',

    'month' => ':count mes',
    'm' => ':count mes',
    'a_month' => ':count mes',

    'week' => ':count selmana',
    'w' => ':count selmana',
    'a_week' => ':count selmana',

    'day' => ':count día',
    'd' => ':count día',
    'a_day' => ':count día',

    'hour' => ':count hora',
    'h' => ':count hora',
    'a_hour' => ':count hora',

    'minute' => ':count minutu',
    'min' => ':count minutu',
    'a_minute' => ':count minutu',

    'second' => ':count segundu',
    's' => ':count segundu',
    'a_second' => ':count segundu',
]);
