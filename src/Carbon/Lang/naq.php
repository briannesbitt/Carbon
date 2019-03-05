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
    'meridiem' => ['ǁgoagas', 'ǃuias'],
    'weekdays' => ['Sontaxtsees', 'Mantaxtsees', 'Denstaxtsees', 'Wunstaxtsees', 'Dondertaxtsees', 'Fraitaxtsees', 'Satertaxtsees'],
    'weekdays_short' => ['Son', 'Ma', 'De', 'Wu', 'Do', 'Fr', 'Sat'],
    'weekdays_min' => ['Son', 'Ma', 'De', 'Wu', 'Do', 'Fr', 'Sat'],
    'months' => ['ǃKhanni', 'ǃKhanǀgôab', 'ǀKhuuǁkhâb', 'ǃHôaǂkhaib', 'ǃKhaitsâb', 'Gamaǀaeb', 'ǂKhoesaob', 'Aoǁkhuumûǁkhâb', 'Taraǀkhuumûǁkhâb', 'ǂNûǁnâiseb', 'ǀHooǂgaeb', 'Hôasoreǁkhâb'],
    'months_short' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
    'first_day_of_week' => 1,
    'formats' => [
        'LT' => 'h:mm a',
        'LTS' => 'h:mm:ss a',
        'L' => 'DD/MM/YYYY',
        'LL' => 'D MMM YYYY',
        'LLL' => 'D MMMM YYYY h:mm a',
        'LLLL' => 'dddd, D MMMM YYYY h:mm a',
    ],

    'year' => ':count sores', // less reliable
    'y' => ':count sores', // less reliable
    'a_year' => ':count sores', // less reliable

    'month' => ':count sores', // less reliable
    'm' => ':count sores', // less reliable
    'a_month' => ':count sores', // less reliable

    'week' => ':count hû', // less reliable
    'w' => ':count hû', // less reliable
    'a_week' => ':count hû', // less reliable

    'day' => ':count sores', // less reliable
    'd' => ':count sores', // less reliable
    'a_day' => ':count sores', // less reliable

    'hour' => ':count sores', // less reliable
    'h' => ':count sores', // less reliable
    'a_hour' => ':count sores', // less reliable

    'minute' => ':count axab', // less reliable
    'min' => ':count axab', // less reliable
    'a_minute' => ':count axab', // less reliable

    'second' => ':count ǀgam', // less reliable
    's' => ':count ǀgam', // less reliable
    'a_second' => ':count ǀgam', // less reliable
]);
