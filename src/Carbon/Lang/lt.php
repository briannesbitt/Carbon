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
 * - Tsutomu Kuroda
 * - tjku
 * - valdas406
 * - Justas Palumickas
 * - Max Melentiev
 * - Andrius Janauskas
 * - Juanito Fatas
 * - Akira Matsuda
 * - Christopher Dell
 * - Enrique Vidal
 * - Simone Carletti
 * - Aaron Patterson
 * - Nicolás Hock Isaza
 * - Laurynas Butkus
 * - Sven Fuchs
 * - Dominykas Tijūnaitis
 * - Justinas Bolys
 * - Ričardas
 * - Kirill Chalkin
 * - Rolandas
 * - Justinas (Gamesh)
 */
return [
    'year' => ':count metus|:count metus|:count metų',
    'y' => ':count m.',
    'month' => ':count mėnesį|:count mėnesius|:count mėnesių',
    'm' => ':count mėn.',
    'week' => ':count savaitę|:count savaites|:count savaičių',
    'w' => ':count sav.',
    'day' => ':count dieną|:count dienas|:count dienų',
    'd' => ':count d.',
    'hour' => ':count valandą|:count valandas|:count valandų',
    'h' => ':count val.',
    'minute' => ':count minutę|:count minutes|:count minučių',
    'min' => ':count min.',
    'second' => ':count sekundę|:count sekundes|:count sekundžių',
    's' => ':count sek.',
    'second_from_now' => ':count sekundės|:count sekundžių|:count sekundžių',
    'minute_from_now' => ':count minutės|:count minučių|:count minučių',
    'hour_from_now' => ':count valandos|:count valandų|:count valandų',
    'day_from_now' => ':count dienos|:count dienų|:count dienų',
    'week_from_now' => ':count savaitės|:count savaičių|:count savaičių',
    'month_from_now' => ':count mėnesio|:count mėnesių|:count mėnesių',
    'year_from_now' => ':count metų',
    'ago' => 'prieš :time',
    'from_now' => 'už :time',
    'after' => 'po :time',
    'before' => ':time nuo dabar',
    'first_day_of_week' => 1,
    'day_of_first_week_of_year' => 4,
    'diff_now' => 'ką tik',
    'diff_yesterday' => 'vakar',
    'diff_tomorrow' => 'rytoj',
    'diff_before_yesterday' => 'užvakar',
    'diff_after_tomorrow' => 'poryt',
    'period_recurrences' => 'kartą|:count kartų',
    'period_interval' => 'kiekvieną :interval',
    'period_start_date' => 'nuo :date',
    'period_end_date' => 'iki :date',
    'months' => ['sausis', 'vasaris', 'kovas', 'balandis', 'gegužė', 'birželis', 'liepa', 'rugpjūtis', 'rugsėjis', 'spalis', 'lapkritis', 'gruodis'],
    'months_short' => ['sau', 'vas', 'kov', 'bal', 'geg', 'bir', 'lie', 'rgp', 'rgs', 'spa', 'lap', 'gru'],
    'weekdays' => ['sekmadienis', 'pirmadienis', 'antradienis', 'trečiadienis', 'ketvirtadienis', 'penktadienis', 'šeštadienis'],
    'weekdays_short' => ['sek', 'pir', 'ant', 'tre', 'ket', 'pen', 'šeš'],
    'weekdays_min' => ['se', 'pi', 'an', 'tr', 'ke', 'pe', 'še'],
    'list' => [', ', ' ir '],
    'formats' => [
        'LT' => 'HH:mm',
        'LTS' => 'HH:mm:ss',
        'L' => 'YYYY-MM-DD',
        'LL' => 'MMMM DD, YYYY',
        'LLL' => 'DD MMM HH:mm',
        'LLLL' => 'MMMM DD, YYYY HH:mm',
    ],
    'meridiem' => ['priešpiet', 'popiet'],
];
