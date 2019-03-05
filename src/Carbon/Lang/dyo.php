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
    'weekdays' => ['Dimas', 'Teneŋ', 'Talata', 'Alarbay', 'Aramisay', 'Arjuma', 'Sibiti'],
    'weekdays_short' => ['Dim', 'Ten', 'Tal', 'Ala', 'Ara', 'Arj', 'Sib'],
    'weekdays_min' => ['Dim', 'Ten', 'Tal', 'Ala', 'Ara', 'Arj', 'Sib'],
    'months' => ['Sanvie', 'Fébirie', 'Mars', 'Aburil', 'Mee', 'Sueŋ', 'Súuyee', 'Ut', 'Settembar', 'Oktobar', 'Novembar', 'Disambar'],
    'months_short' => ['Sa', 'Fe', 'Ma', 'Ab', 'Me', 'Su', 'Sú', 'Ut', 'Se', 'Ok', 'No', 'De'],
    'first_day_of_week' => 1,
    'formats' => [
        'LT' => 'HH:mm',
        'LTS' => 'HH:mm:ss',
        'L' => 'D/M/YYYY',
        'LL' => 'D MMM YYYY',
        'LLL' => 'D MMMM YYYY HH:mm',
        'LLLL' => 'dddd D MMMM YYYY HH:mm',
    ],

    'year' => ':count balaab', // less reliable
    'y' => ':count balaab', // less reliable
    'a_year' => ':count balaab', // less reliable

    'month' => ':count balaab', // less reliable
    'm' => ':count balaab', // less reliable
    'a_month' => ':count balaab', // less reliable

    'week' => ':count balaab', // less reliable
    'w' => ':count balaab', // less reliable
    'a_week' => ':count balaab', // less reliable

    'day' => ':count balaab', // less reliable
    'd' => ':count balaab', // less reliable
    'a_day' => ':count balaab', // less reliable
]);
