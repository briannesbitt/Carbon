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
    'month' => 'un mois|:count mois',
    'day' => 'un jour|:count jours',
    'hour' => 'une heure|:count heures',
    'minute' => 'une minute|:count minutes',
    'second' => 'quelques secondes|:count secondes',
    'ago' => 'il y a :time',
    'from_now' => 'dans :time',
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
            default:
            case 'D':
            case 'M':
            case 'Q':
            case 'DDD':
            case 'd':
                return $number . ($number === 1 ? 'er' : 'e');

            // Words with feminine grammatical gender: semaine
            case 'w':
            case 'W':
                return $number . ($number === 1 ? 're' : 'e');
        }
    },
];
