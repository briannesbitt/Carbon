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
 * - Wacław Jacek
 * - François B
 * - Tim Fish
 * - Serhan Apaydın
 * - Massimiliano Caniparoli
 * - JD Isaacks
 * - Jakub Szwacz
 * - Jan
 * - Paul
 * - damlys
 */
return [
    'year' => ':count rok|:count lata|:count lat',
    'y' => ':countr|:countl',
    'month' => ':count miesiąc|:count miesiące|:count miesięcy',
    'm' => ':countmies',
    'week' => ':count tydzień|:count tygodnie|:count tygodni',
    'w' => ':counttyg',
    'day' => ':count dzień|:count dni|:count dni',
    'd' => ':countd',
    'hour' => ':count godzina|:count godziny|:count godzin',
    'h' => ':countg',
    'minute' => ':count minuta|:count minuty|:count minut',
    'min' => ':countm',
    'second' => ':count sekunda|:count sekundy|:count sekund',
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
        'nextWeek' => function (\Carbon\CarbonInterface $date) {
            switch ($date->dayOfWeek) {
                case 0:
                    return '[W niedzielę o] LT';
                case 2:
                    return '[We wtorek o] LT';
                case 3:
                    return '[W środę o] LT';
                case 6:
                    return '[W sobotę o] LT';
                default:
                    return '[W] dddd [o] LT';
            }
        },
        'lastDay' => '[Wczoraj o] LT',
        'lastWeek' => function (\Carbon\CarbonInterface $date) {
            switch ($date->dayOfWeek) {
                case 0:
                    return '[W zeszłą niedzielę o] LT';
                case 3:
                    return '[W zeszłą środę o] LT';
                case 6:
                    return '[W zeszłą sobotę o] LT';
                default:
                    return '[W zeszły] dddd [o] LT';
            }
        },
        'sameElse' => 'L',
    ],
    'ordinal' => ':number.',
    'months' => ['styczeń', 'luty', 'marzec', 'kwiecień', 'maj', 'czerwiec', 'lipiec', 'sierpień', 'wrzesień', 'październik', 'listopad', 'grudzień'],
    'months_short' => ['sty', 'lut', 'mar', 'kwi', 'maj', 'cze', 'lip', 'sie', 'wrz', 'paź', 'lis', 'gru'],
    'weekdays' => ['niedziela', 'poniedziałek', 'wtorek', 'środa', 'czwartek', 'piątek', 'sobota'],
    'weekdays_short' => ['ndz', 'pon', 'wt', 'śr', 'czw', 'pt', 'sob'],
    'weekdays_min' => ['Nd', 'Pn', 'Wt', 'Śr', 'Cz', 'Pt', 'So'],
    'first_day_of_week' => 1,
    'day_of_first_week_of_year' => 4,
    'list' => [', ', ' i '],
    'meridiem' => ['przed południem', 'po południu'],
];
