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
    'year' => 'rok|',
    'y' => ':countr|:countl',
    'month' => 'miesiąc|',
    'm' => ':countmies',
    'week' => ':count tydzień|:count tygodnie|:count tygodni',
    'w' => ':counttyg',
    'day' => '1 dzień|:count dni',
    'd' => ':countd',
    'hour' => '|',
    'h' => ':countg',
    'minute' => '|',
    'min' => ':countm',
    'second' => 'kilka sekund|',
    's' => ':counts',
    'ago' => ':time temu',
    'from_now' => 'za :time',
    'after' => ':time po',
    'before' => ':time przed',
    'diff_now' => 'przed chwilą',
    'diff_yesterday' => 'wczoraj',
    'diff_tomorrow' => 'jutro',
    'diff_before_yesterday' => 'przedwczoraj',
    'diff_after_tomorrow' => 'pojutrze',
    'formats' => [
        'LT' => 'HH:mm',
        'LTS' => 'HH:mm:ss',
        'L' => 'DD.MM.YYYY',
        'LL' => 'D MMMM YYYY',
        'LLL' => 'D MMMM YYYY HH:mm',
        'LLLL' => 'dddd, D MMMM YYYY HH:mm',
    ],
    'calendar' => [
        'sameDay' => '[Dziś o] LT',
        'nextDay' => '[Jutro o] LT',
        'nextWeek' => '',
        'lastDay' => '[Wczoraj o] LT',
        'lastWeek' => '',
        'sameElse' => 'L',
    ],
    'months' => [
    ],
    'months_short' => ['sty', 'lut', 'mar', 'kwi', 'maj', 'cze', 'lip', 'sie', 'wrz', 'paź', 'lis', 'gru'],
    'weekdays' => ['niedziela', 'poniedziałek', 'wtorek', 'środa', 'czwartek', 'piątek', 'sobota'],
    'weekdays_short' => ['ndz', 'pon', 'wt', 'śr', 'czw', 'pt', 'sob'],
    'weekdays_min' => ['Nd', 'Pn', 'Wt', 'Śr', 'Cz', 'Pt', 'So'],
];
