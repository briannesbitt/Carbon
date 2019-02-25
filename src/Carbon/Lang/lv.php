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
 * - pirminis
 * - Tsutomu Kuroda
 * - tjku
 * - Andris Zāģeris
 * - Max Melentiev
 * - Edgars Beigarts
 * - Juanito Fatas
 * - Vitauts Stočka
 * - Akira Matsuda
 * - Christopher Dell
 * - Enrique Vidal
 * - Simone Carletti
 * - Aaron Patterson
 * - Kaspars Bankovskis
 * - Nicolás Hock Isaza
 * - Kavacky
 */
return [
    'year' => '0 gadiem|:count gada|:count gadiem',
    'y' => '0 gadiem|:count gada|:count gadiem',
    'month' => '0 mēnešiem|:count mēneša|:count mēnešiem',
    'm' => '0 mēnešiem|:count mēneša|:count mēnešiem',
    'week' => '0 nedēļām|:count nedēļas|:count nedēļām',
    'w' => '0 nedēļām|:count nedēļas|:count nedēļām',
    'day' => '0 dienām|:count dienas|:count dienām',
    'd' => '0 dienām|:count dienas|:count dienām',
    'hour' => '0 stundām|:count stundas|:count stundām',
    'h' => '0 stundām|:count stundas|:count stundām',
    'minute' => '0 minūtēm|:count minūtes|:count minūtēm',
    'min' => '0 minūtēm|:count minūtes|:count minūtēm',
    'second' => '0 sekundēm|:count sekundes|:count sekundēm',
    's' => '0 sekundēm|:count sekundes|:count sekundēm',
    'ago' => 'pirms :time',
    'from_now' => 'pēc :time',
    'after' => ':time vēlāk',
    'before' => ':time pirms',

    'year_after' => '0 gadus|:count gadu|:count gadus',
    'month_after' => '0 mēnešus|:count mēnesi|:count mēnešus',
    'week_after' => '0 nedēļas|:count nedēļu|:count nedēļas',
    'day_after' => '0 dienas|:count dienu|:count dienas',
    'hour_after' => '0 stundas|:count stundu|:count stundas',
    'minute_after' => '0 minūtes|:count minūti|:count minūtes',
    'second_after' => '0 sekundes|:count sekundi|:count sekundes',

    'year_before' => '0 gadus|:count gadu|:count gadus',
    'month_before' => '0 mēnešus|:count mēnesi|:count mēnešus',
    'week_before' => '0 nedēļas|:count nedēļu|:count nedēļas',
    'day_before' => '0 dienas|:count dienu|:count dienas',
    'hour_before' => '0 stundas|:count stundu|:count stundas',
    'minute_before' => '0 minūtes|:count minūti|:count minūtes',
    'second_before' => '0 sekundes|:count sekundi|:count sekundes',
    'first_day_of_week' => 1,
    'day_of_first_week_of_year' => 4,
    'list' => [', ', ' un '],
    'formats' => [
        'LT' => 'HH:mm',
        'LTS' => 'HH:mm:ss',
        'L' => 'DD.MM.YYYY.',
        'LL' => 'YYYY. [gada] D. MMMM',
        'LLL' => 'DD.MM.YYYY., HH:mm',
        'LLLL' => 'YYYY. [gada] D. MMMM, HH:mm',
    ],
    'weekdays' => ['svētdiena', 'pirmdiena', 'otrdiena', 'trešdiena', 'ceturtdiena', 'piektdiena', 'sestdiena'],
    'weekdays_short' => ['Sv.', 'P.', 'O.', 'T.', 'C.', 'Pk.', 'S.'],
    'weekdays_min' => ['Sv.', 'P.', 'O.', 'T.', 'C.', 'Pk.', 'S.'],
    'months' => ['janvārī', 'ferbruārī', 'martā', 'aprīlī', 'maijā', 'jūnijā', 'jūlijā', 'augustā', 'septembrī', 'oktobrī', 'novembrī', 'decembrī'],
    'months_short' => ['Janv', 'Febr', 'Marts', 'Apr', 'Maijs', 'Jūn', 'Jūl', 'Aug', 'Sept', 'Okt', 'Nov', 'Dec'],
    'meridiem' => ['priekšpusdiena', 'pēcpusdiena'],
];
