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
 */return array_replace_recursive(require __DIR__.'/en.php', [
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

    'year' => ':count Asmil',
    'y' => ':count Asmil',
    'a_year' => ':count Asmil',

    'week' => ':count Ayyur',
    'w' => ':count Ayyur',
    'a_week' => ':count Ayyur',

    'day' => ':count nekk',
    'd' => ':count nekk',
    'a_day' => ':count nekk',

    'hour' => ':count tamrilt',
    'h' => ':count tamrilt',
    'a_hour' => ':count tamrilt',

    'minute' => ':count tamrilt',
    'min' => ':count tamrilt',
    'a_minute' => ':count tamrilt',

    'second' => ':count arim ⴰⵔⵉⵎ',
    's' => ':count arim ⴰⵔⵉⵎ',
    'a_second' => ':count arim ⴰⵔⵉⵎ',
]);
