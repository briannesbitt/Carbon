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
 * - Philippe Vaucher
 * - Jakub Tesinsky
 * - Martin Suja
 * - Nikos Timiopulos
 * - Bohuslav Blín
 * - Tsutomu Kuroda
 * - tjku
 * - Lukas Svoboda
 * - Max Melentiev
 * - Juanito Fatas
 * - Akira Matsuda
 * - Christopher Dell
 * - Václav Pávek
 * - CodeSkills
 * - Tlapi
 * - newman101
 * - Petr Kadlec
 */
return [
    'year' => ':count rok|:count roky|:count let',
    'y' => ':count rok|:count roky|:count let',
    'month' => ':count měsíc|:count měsíce|:count měsíců',
    'm' => ':count měs.',
    'week' => ':count týden|:count týdny|:count týdnů',
    'w' => ':count týd.',
    'day' => ':count den|:count dny|:count dní',
    'd' => ':count den|:count dny|:count dní',
    'hour' => ':count hodinu|:count hodiny|:count hodin',
    'h' => ':count hod.',
    'minute' => ':count minutu|:count minuty|:count minut',
    'min' => ':count min.',
    'second' => ':count sekundu|:count sekundy|:count sekund',
    's' => ':count sek.',
    'ago' => ':time nazpět',
    'from_now' => 'za :time',
    'after' => 'o :time později',
    'before' => ':time předtím',
    'first_day_of_week' => 1,
    'day_of_first_week_of_year' => 4,
    'months' => ['leden', 'únor', 'březen', 'duben', 'květen', 'červen', 'červenec', 'srpen', 'září', 'říjen', 'listopad', 'prosinec'],
    'months_short' => ['led', 'úno', 'bře', 'dub', 'kvě', 'čer', 'čer', 'srp', 'zář', 'říj', 'lis', 'pro'],
    'weekdays' => ['neděle', 'pondělí', 'úterý', 'středa', 'čtvrtek', 'pátek', 'sobota'],
    'weekdays_short' => ['ned', 'pon', 'úte', 'stř', 'čtv', 'pát', 'sob'],
    'weekdays_min' => ['ne', 'po', 'út', 'st', 'čt', 'pá', 'so'],
    'list' => [', ', ' a '],
    'formats' => [
        'LT' => 'HH:mm',
        'LTS' => 'HH:mm:ss',
        'L' => 'DD. MM. YYYY',
        'LL' => 'D. MMMM YYYY',
        'LLL' => 'D. MMMM YYYY HH:mm',
        'LLLL' => 'dddd D. MMMM YYYY HH:mm',
    ],
    'meridiem' => ['dopoledne', 'odpoledne'],
];
