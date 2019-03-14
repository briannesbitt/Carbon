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
 * - szl_PL locale Przemyslaw Buczkowski libc-alpha@sourceware.org
 */
return array_replace_recursive(require __DIR__.'/en.php', [
    'formats' => [
        'L' => 'DD.MM.YYYY',
    ],
    'months' => ['styczyń', 'luty', 'merc', 'kwjeciyń', 'moj', 'czyrwjyń', 'lipjyń', 'siyrpjyń', 'wrzesiyń', 'październik', 'listopad', 'grudziyń'],
    'months_short' => ['sty', 'lut', 'mer', 'kwj', 'moj', 'czy', 'lip', 'siy', 'wrz', 'paź', 'lis', 'gru'],
    'weekdays' => ['niydziela', 'pyńdziŏek', 'wtŏrek', 'strzŏda', 'sztwortek', 'pjōntek', 'sobŏta'],
    'weekdays_short' => ['niy', 'pyń', 'wtŏ', 'str', 'szt', 'pjō', 'sob'],
    'weekdays_min' => ['niy', 'pyń', 'wtŏ', 'str', 'szt', 'pjō', 'sob'],
    'first_day_of_week' => 1,
    'day_of_first_week_of_year' => 4,

    'year' => ':count rok',
    'y' => ':count rok',
    'a_year' => ':count rok',

    'month' => ':count mjeśůnc',
    'm' => ':count mjeśůnc',
    'a_month' => ':count mjeśůnc',

    'week' => ':count Tydźyń',
    'w' => ':count Tydźyń',
    'a_week' => ':count Tydźyń',

    'day' => ':count dźyń',
    'd' => ':count dźyń',
    'a_day' => ':count dźyń',

    'hour' => ':count godzina',
    'h' => ':count godzina',
    'a_hour' => ':count godzina',

    'minute' => ':count Minuta',
    'min' => ':count Minuta',
    'a_minute' => ':count Minuta',

    'second' => ':count Sekůnda',
    's' => ':count Sekůnda',
    'a_second' => ':count Sekůnda',
]);
