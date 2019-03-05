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
 * Unknown default region, use the first alphabetically.
 */
return array_replace_recursive(require __DIR__.'/en.php', [
    'formats' => [
        'LT' => 'HH:mm',
        'LTS' => 'HH:mm:ss',
        'L' => 'DD/MM/YYYY',
        'LL' => 'D MMM, YYYY',
        'LLL' => 'D MMMM YYYY HH:mm',
        'LLLL' => 'dddd D MMMM YYYY HH:mm',
    ],
    'months' => ['siilo', 'colte', 'mbooy', 'seeɗto', 'duujal', 'korse', 'morso', 'juko', 'siilto', 'yarkomaa', 'jolal', 'bowte'],
    'months_short' => ['sii', 'col', 'mbo', 'see', 'duu', 'kor', 'mor', 'juk', 'slt', 'yar', 'jol', 'bow'],
    'weekdays' => ['dewo', 'aaɓnde', 'mawbaare', 'njeslaare', 'naasaande', 'mawnde', 'hoore-biir'],
    'weekdays_short' => ['dew', 'aaɓ', 'maw', 'nje', 'naa', 'mwd', 'hbi'],
    'weekdays_min' => ['dew', 'aaɓ', 'maw', 'nje', 'naa', 'mwd', 'hbi'],
    'first_day_of_week' => 1,
    'day_of_first_week_of_year' => 1,
    'meridiem' => ['subaka', 'kikiiɗe'],

    'year' => ':count baret',
    'y' => ':count baret',
    'a_year' => ':count baret',

    'month' => ':count lewru',
    'm' => ':count lewru',
    'a_month' => ':count lewru',

    'week' => ':count naange',
    'w' => ':count naange',
    'a_week' => ':count naange',

    'day' => ':count naange',
    'd' => ':count naange',
    'a_day' => ':count naange',

    'hour' => ':count montor',
    'h' => ':count montor',
    'a_hour' => ':count montor',

    'minute' => ':count tokossuoum',
    'min' => ':count tokossuoum',
    'a_minute' => ':count tokossuoum',

    'second' => ':count tenen',
    's' => ':count tenen',
    'a_second' => ':count tenen',
]);
