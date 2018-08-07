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
    'year' => ':count Jahr|:count Jahre',
    'y' => ':countJ|:countJ',
    'month' => ':count Monat|:count Monate',
    'm' => ':countMon|:countMon',
    'week' => ':count Woche|:count Wochen',
    'w' => ':countWo|:countWo',
    'day' => ':count Tag|:count Tage',
    'd' => ':countTg|:countTg',
    'hour' => ':count Stunde|:count Stunden',
    'h' => ':countStd|:countStd',
    'minute' => ':count Minute|:count Minuten',
    'min' => ':countMin|:countMin',
    'second' => ':count Sekunde|:count Sekunden',
    's' => ':countSek|:countSek',
    'ago' => 'vor :time',
    'from_now' => 'in :time',
    'after' => ':time später',
    'before' => ':time zuvor',

    'year_from_now' => ':count Jahr|:count Jahren',
    'month_from_now' => ':count Monat|:count Monaten',
    'week_from_now' => ':count Woche|:count Wochen',
    'day_from_now' => ':count Tag|:count Tagen',
    'year_ago' => ':count Jahr|:count Jahren',
    'month_ago' => ':count Monat|:count Monaten',
    'week_ago' => ':count Woche|:count Wochen',
    'day_ago' => ':count Tag|:count Tagen',

    'diff_now' => 'Gerade eben',
    'diff_yesterday' => 'Gestern',
    'diff_tomorrow' => 'Heute',
    'diff_before_yesterday' => 'Vorgestern',
    'diff_after_tomorrow' => 'Übermorgen',

    'formats' => [
        'LT' => 'HH:mm',
        'LTS' => 'HH:mm:ss',
        'L' => 'DD.MM.YYYY',
        'LL' => 'D. MMMM YYYY',
        'LLL' => 'D. MMMM YYYY HH:mm',
        'LLLL' => 'dddd, D. MMMM YYYY HH:mm',
    ],

    'calendar' => [
        'sameDay' => '[heute um] LT [Uhr]',
        'nextDay' => '[morgen um] LT [Uhr]',
        'nextWeek' => 'dddd [um] LT [Uhr]',
        'lastDay' => '[gestern um] LT [Uhr]',
        'lastWeek' => '[letzten] dddd [um] LT [Uhr]',
        'sameElse' => 'L',
    ],

    'months' => ['Januar', 'Februar', 'März', 'April', 'Mai', 'Juni', 'Juli', 'August', 'September', 'Oktober', 'November', 'Dezember'],
    'months_short' => ['Jan.', 'Feb.', 'März', 'Apr.', 'Mai', 'Juni', 'Juli', 'Aug.', 'Sep.', 'Okt.', 'Nov.', 'Dez.'],
    'weekdays' => ['Sonntag', 'Montag', 'Dienstag', 'Mittwoch', 'Donnerstag', 'Freitag', 'Samstag'],
    'weekdays_short' => ['So.', 'Mo.', 'Di.', 'Mi.', 'Do.', 'Fr.', 'Sa.'],
    'weekdays_min' => ['So', 'Mo', 'Di', 'Mi', 'Do', 'Fr', 'Sa'],
    'ordinal' => ':number.',
    'first_day_of_week' => 1,
    'day_of_first_week_of_year' => 4,
];
