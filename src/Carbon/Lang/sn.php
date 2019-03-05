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
    'meridiem' => ['a', 'p'],
    'weekdays' => ['Svondo', 'Muvhuro', 'Chipiri', 'Chitatu', 'China', 'Chishanu', 'Mugovera'],
    'weekdays_short' => ['Svo', 'Muv', 'Chp', 'Cht', 'Chn', 'Chs', 'Mug'],
    'weekdays_min' => ['Sv', 'Mu', 'Cp', 'Ct', 'Cn', 'Cs', 'Mg'],
    'months' => ['Ndira', 'Kukadzi', 'Kurume', 'Kubvumbi', 'Chivabvu', 'Chikumi', 'Chikunguru', 'Nyamavhuvhu', 'Gunyana', 'Gumiguru', 'Mbudzi', 'Zvita'],
    'months_short' => ['Ndi', 'Kuk', 'Kur', 'Kub', 'Chv', 'Chk', 'Chg', 'Nya', 'Gun', 'Gum', 'Mbu', 'Zvi'],
    'formats' => [
        'LT' => 'HH:mm',
        'LTS' => 'HH:mm:ss',
        'L' => 'YYYY-MM-dd',
        'LL' => 'YYYY MMM D',
        'LLL' => 'YYYY MMMM D HH:mm',
        'LLLL' => 'YYYY MMMM D, dddd HH:mm',
    ],

    'minute' => ':count Nguva dzezuva', // less reliable
    'min' => ':count Nguva dzezuva', // less reliable
    'a_minute' => ':count Nguva dzezuva', // less reliable

    'second' => ':count piri', // less reliable
    's' => ':count piri', // less reliable
    'a_second' => ':count piri', // less reliable

    'year' => ':count gore',
    'y' => ':count gore',
    'a_year' => ':count gore',

    'month' => 'mwedzi :count',
    'm' => 'mwedzi :count',
    'a_month' => 'mwedzi :count',

    'week' => ':count Vhiki',
    'w' => ':count Vhiki',
    'a_week' => ':count Vhiki',

    'day' => ':count Musi',
    'd' => ':count Musi',
    'a_day' => ':count Musi',

    'hour' => ':count Nguva dzezuva',
    'h' => ':count Nguva dzezuva',
    'a_hour' => ':count Nguva dzezuva',
]);
