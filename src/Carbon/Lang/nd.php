<?php

/**
 * This file is part of the Carbon package.
 *
 * (c) Brian Nesbitt <brian@nesbot.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

return array_replace_recursive(require __DIR__.'/en.php', [
    'weekdays' => ['Sonto', 'Mvulo', 'Sibili', 'Sithathu', 'Sine', 'Sihlanu', 'Mgqibelo'],
    'weekdays_short' => ['Son', 'Mvu', 'Sib', 'Sit', 'Sin', 'Sih', 'Mgq'],
    'weekdays_min' => ['Son', 'Mvu', 'Sib', 'Sit', 'Sin', 'Sih', 'Mgq'],
    'months' => ['Zibandlela', 'Nhlolanja', 'Mbimbitho', 'Mabasa', 'Nkwenkwezi', 'Nhlangula', 'Ntulikazi', 'Ncwabakazi', 'Mpandula', 'Mfumfu', 'Lwezi', 'Mpalakazi'],
    'months_short' => ['Zib', 'Nhlo', 'Mbi', 'Mab', 'Nkw', 'Nhla', 'Ntu', 'Ncw', 'Mpan', 'Mfu', 'Lwe', 'Mpal'],
    'formats' => [
        'LT' => 'HH:mm',
        'LTS' => 'HH:mm:ss',
        'L' => 'DD/MM/YYYY',
        'LL' => 'D MMM YYYY',
        'LLL' => 'D MMMM YYYY HH:mm',
        'LLLL' => 'dddd, D MMMM YYYY HH:mm',
    ],

    'year' => ':count indlu', // less reliable
    'y' => ':count indlu', // less reliable
    'a_year' => ':count indlu', // less reliable

    'day' => ':count jo', // less reliable
    'd' => ':count jo', // less reliable
    'a_day' => ':count jo', // less reliable

    'hour' => ':count iwatjhi', // less reliable
    'h' => ':count iwatjhi', // less reliable
    'a_hour' => ':count iwatjhi', // less reliable

    'minute' => ':count iwatjhi', // less reliable
    'min' => ':count iwatjhi', // less reliable
    'a_minute' => ':count iwatjhi', // less reliable
]);
