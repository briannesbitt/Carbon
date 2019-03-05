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
 * - belkacem77@gmail.com
 */
return array_replace_recursive(require __DIR__.'/en.php', [
    'formats' => [
        'L' => 'DD/MM/YYYY',
    ],
    'months' => ['Yennayer', 'Fuṛar', 'Meɣres', 'Yebrir', 'Mayyu', 'Yunyu', 'Yulyu', 'ɣuct', 'Ctembeṛ', 'Tubeṛ', 'Wambeṛ', 'Dujembeṛ'],
    'months_short' => ['Yen', 'Fur', 'Meɣ', 'Yeb', 'May', 'Yun', 'Yul', 'ɣuc', 'Cte', 'Tub', 'Wam', 'Duj'],
    'weekdays' => ['Acer', 'Arim', 'Aram', 'Ahad', 'Amhad', 'Sem', 'Sed'],
    'weekdays_short' => ['Ace', 'Ari', 'Ara', 'Aha', 'Amh', 'Sem', 'Sed'],
    'weekdays_min' => ['Ace', 'Ari', 'Ara', 'Aha', 'Amh', 'Sem', 'Sed'],
    'first_day_of_week' => 6,
    'day_of_first_week_of_year' => 1,
    'meridiem' => ['FT', 'MD'],

    'year' => ':count aseggas', // less reliable
    'y' => ':count aseggas', // less reliable
    'a_year' => ':count aseggas', // less reliable

    'month' => ':count ayyur',
    'm' => ':count ayyur',
    'a_month' => ':count ayyur',

    'week' => ':count d-itteddun', // less reliable
    'w' => ':count d-itteddun', // less reliable
    'a_week' => ':count d-itteddun', // less reliable

    'day' => ':count nekk', // less reliable
    'd' => ':count nekk', // less reliable
    'a_day' => ':count nekk', // less reliable

    'hour' => ':count tamrilt', // less reliable
    'h' => ':count tamrilt', // less reliable
    'a_hour' => ':count tamrilt', // less reliable

    'minute' => ':count tamrilt', // less reliable
    'min' => ':count tamrilt', // less reliable
    'a_minute' => ':count tamrilt', // less reliable

    'second' => ':count deg', // less reliable
    's' => ':count deg', // less reliable
    'a_second' => ':count deg', // less reliable
]);
