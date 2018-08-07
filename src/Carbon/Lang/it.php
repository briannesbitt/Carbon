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
    'year' => 'un anno|:count anni',
    'y' => ':count anno|:count anni',
    'month' => 'un mese|:count mesi',
    'm' => ':count mese|:count mesi',
    'week' => ':count settimana|:count settimane',
    'w' => ':count settimana|:count settimane',
    'day' => 'un giorno|:count giorni',
    'd' => ':count giorno|:count giorni',
    'hour' => 'un\'ora|:count ore',
    'h' => ':count ora|:count ore',
    'minute' => 'un minuto|:count minuti',
    'min' => ':count minuto|:count minuti',
    'second' => 'alcuni secondi|:count secondi',
    's' => ':count secondo|:count secondi',
    'ago' => ':time fa',
    'from_now' => function ($time) {
        return (preg_match('/^[0-9].+$/', $time) ? 'tra' : 'in')." $time";
    },
    'after' => ':time dopo',
    'before' => ':time prima',
    'diff_now' => 'proprio ora',
    'diff_yesterday' => 'ieri',
    'diff_tomorrow' => 'domani',
    'diff_before_yesterday' => 'l\'altro ieri',
    'diff_after_tomorrow' => 'dopodomani',
    'formats' => [
        'LT' => 'HH:mm',
        'LTS' => 'HH:mm:ss',
        'L' => 'DD/MM/YYYY',
        'LL' => 'D MMMM YYYY',
        'LLL' => 'D MMMM YYYY HH:mm',
        'LLLL' => 'dddd D MMMM YYYY HH:mm',
    ],
    'calendar' => [
        'sameDay' => '[Oggi alle] LT',
        'nextDay' => '[Domani alle] LT',
        'nextWeek' => 'dddd [alle] LT',
        'lastDay' => function (\Carbon\CarbonInterface $current) {
            switch ($current->dayOfWeek) {
                case 0:
                    return '[la scorsa] dddd [alle] LT';
                default:
                    return '[lo scorso] dddd [alle] LT';
            }
        },
        'lastWeek' => function (\Carbon\CarbonInterface $date) {
            switch ($date->dayOfWeek) {
                case 0:
                    return '[la scorsa] dddd [alle] LT';
                default:
                    return '[lo scorso] dddd [alle] LT';
            }
        },
        'sameElse' => 'L',
    ],
    'ordinal' => ':numberº',
    'months' => ['gennaio', 'febbraio', 'marzo', 'aprile', 'maggio', 'giugno', 'luglio', 'agosto', 'settembre', 'ottobre', 'novembre', 'dicembre'],
    'months_short' => ['gen', 'feb', 'mar', 'apr', 'mag', 'giu', 'lug', 'ago', 'set', 'ott', 'nov', 'dic'],
    'weekdays' => ['domenica', 'lunedì', 'martedì', 'mercoledì', 'giovedì', 'venerdì', 'sabato'],
    'weekdays_short' => ['dom', 'lun', 'mar', 'mer', 'gio', 'ven', 'sab'],
    'weekdays_min' => ['do', 'lu', 'ma', 'me', 'gi', 've', 'sa'],
    'first_day_of_week' => 1,
    'day_of_first_week_of_year' => 4,
];
