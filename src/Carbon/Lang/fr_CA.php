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
    'year' => 'un an|:count ans',
    'y' => ':count an|:count ans',
    'month' => 'un mois|:count mois',
    'm' => ':count mois',
    'week' => 'une semaine|:count semaines',
    'w' => ':count sem.',
    'day' => 'un jour|:count jours',
    'd' => ':count j.',
    'hour' => 'une heure|:count heures',
    'h' => ':count h.',
    'minute' => 'une minute|:count minutes',
    'min' => ':count min.',
    'second' => 'quelques secondes|:count secondes',
    's' => ':count sec.',
    'ago' => 'il y a :time',
    'from_now' => 'dans :time',
    'after' => ':time après',
    'before' => ':time avant',
    'diff_now' => 'à l\'instant',
    'diff_yesterday' => 'hier',
    'diff_tomorrow' => 'demain',
    'diff_before_yesterday' => 'avant-hier',
    'diff_after_tomorrow' => 'après-demain',
    'period_recurrences' => ':count fois',
    'period_interval' => 'tous les :interval',
    'period_start_date' => 'de :date',
    'period_end_date' => 'à :date',
    'formats' => [
        'LT' => 'HH:mm',
        'LTS' => 'HH:mm:ss',
        'L' => 'YYYY-MM-DD',
        'LL' => 'D MMMM YYYY',
        'LLL' => 'D MMMM YYYY HH:mm',
        'LLLL' => 'dddd D MMMM YYYY HH:mm',
    ],
    'calendar' => [
        'sameDay' => '[Aujourd’hui à] LT',
        'nextDay' => '[Demain à] LT',
        'nextWeek' => 'dddd [à] LT',
        'lastDay' => '[Hier à] LT',
        'lastWeek' => 'dddd [dernier à] LT',
        'sameElse' => 'L',
    ],
    'months' => ['janvier', 'février', 'mars', 'avril', 'mai', 'juin', 'juillet', 'août', 'septembre', 'octobre', 'novembre', 'décembre'],
    'months_short' => ['janv.', 'févr.', 'mars', 'avr.', 'mai', 'juin', 'juil.', 'août', 'sept.', 'oct.', 'nov.', 'déc.'],
    'weekdays' => ['dimanche', 'lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi'],
    'weekdays_short' => ['dim.', 'lun.', 'mar.', 'mer.', 'jeu.', 'ven.', 'sam.'],
    'weekdays_min' => ['di', 'lu', 'ma', 'me', 'je', 've', 'sa'],
    'ordinal' => function ($number, $period) {
        switch ($period) {
            // In french, only the first has be ordinal, other number remains cardinal
            // @link https://fr.wikihow.com/%C3%A9crire-la-date-en-fran%C3%A7ais
            case 'D':
                return $number.($number === 1 ? 'er' : '');

            default:
            case 'M':
            case 'Q':
            case 'DDD':
            case 'd':
                return $number.($number === 1 ? 'er' : 'e');

            // Words with feminine grammatical gender: semaine
            case 'w':
            case 'W':
                return $number.($number === 1 ? 're' : 'e');
        }
    },
    'list' => [', ', ' et '],
];
