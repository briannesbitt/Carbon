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
 * - RockET Systems Emani Fakaotimanava-Lui emani@niue.nu
 */
return array_replace_recursive(require __DIR__.'/en.php', [
    'formats' => [
        'L' => 'DD/MM/YY',
    ],
    'months' => ['Ianuali', 'Fepuali', 'Masi', 'Apelila', 'Me', 'Iuni', 'Iulai', 'Aokuso', 'Sepetema', 'Oketopa', 'Novema', 'Tesemo'],
    'months_short' => ['Ian', 'Fep', 'Mas', 'Ape', 'Me', 'Iun', 'Iul', 'Aok', 'Sep', 'Oke', 'Nov', 'Tes'],
    'weekdays' => ['Aho Tapu', 'Aho Gofua', 'Aho Ua', 'Aho Lotu', 'Aho Tuloto', 'Aho Falaile', 'Aho Faiumu'],
    'weekdays_short' => ['Tapu', 'Gofua', 'Ua', 'Lotu', 'Tuloto', 'Falaile', 'Faiumu'],
    'weekdays_min' => ['Tapu', 'Gofua', 'Ua', 'Lotu', 'Tuloto', 'Falaile', 'Faiumu'],
    'first_day_of_week' => 1,
    'day_of_first_week_of_year' => 1,

    'year' => ':count kauhala', // less reliable
    'y' => ':count kauhala', // less reliable
    'a_year' => ':count kauhala', // less reliable

    'week' => ':count aho', // less reliable
    'w' => ':count aho', // less reliable
    'a_week' => ':count aho', // less reliable

    'hour' => ':count ufū tagā', // less reliable
    'h' => ':count ufū tagā', // less reliable
    'a_hour' => ':count ufū tagā', // less reliable

    'minute' => ':count minuti', // less reliable
    'min' => ':count minuti', // less reliable
    'a_minute' => ':count minuti', // less reliable

    'second' => ':count minuti', // less reliable
    's' => ':count minuti', // less reliable
    'a_second' => ':count minuti', // less reliable

    'month' => ':count mahina',
    'm' => ':count mahina',
    'a_month' => ':count mahina',

    'day' => ':count aho',
    'd' => ':count aho',
    'a_day' => ':count aho',
]);
