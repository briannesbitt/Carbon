<?php

/**
 * This file is part of the Carbon package.
 *
 * (c) Brian Nesbitt <brian@nesbot.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/*
 * Authors:
 * - Ash
 * - François B
 * - Marco Perrando
 * - Massimiliano Caniparoli
 * - JD Isaacks
 * - Andrea Martini
 * - Francesco Marasco
 * - Tizianoz93
 * - Davide Casiraghi (davide-casiraghi)
 */
return [
    'year' => ':count anno|:count anni',
    'a_year' => 'un anno|:count anni',
    'y' => ':count anno|:count anni',
    'month' => ':count mese|:count mesi',
    'a_month' => 'un mese|:count mesi',
    'm' => ':count mese|:count mesi',
    'week' => ':count settimana|:count settimane',
    'a_week' => 'una settimana|:count settimane',
    'w' => ':count set.',
    'day' => ':count giorno|:count giorni',
    'a_day' => 'un giorno|:count giorni',
    'd' => ':count g|:count gg',
    'hour' => ':count ora|:count ore',
    'a_hour' => 'un\'ora|:count ore',
    'h' => ':count h',
    'minute' => ':count minuto|:count minuti',
    'a_minute' => 'un minuto|:count minuti',
    'min' => ':count min.',
    'second' => ':count secondo|:count secondi',
    'a_second' => 'alcuni secondi|:count secondi',
    's' => ':count sec.',
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
    'period_interval' => 'ogni :interval',
    'period_start_date' => 'dal :date',
    'period_end_date' => 'al :date',
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
        'lastDay' => '[Ieri alle] LT',
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
    'list' => [', ', ' e '],
];
