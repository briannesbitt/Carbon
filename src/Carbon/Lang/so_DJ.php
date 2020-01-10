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
 * - Ge'ez Frontier Foundation    locales@geez.org
 */
return array_replace_recursive(require __DIR__.'/en.php', [
    'formats' => [
        'L' => 'DD.MM.YYYY',
    ],
    'months' => ['Bisha Koobaad', 'Bisha Labaad', 'Bisha Saddexaad', 'Bisha Afraad', 'Bisha Shanaad', 'Bisha Lixaad', 'Bisha Todobaad', 'Bisha Sideedaad', 'Bisha Sagaalaad', 'Bisha Tobnaad', 'Bisha Kow iyo Tobnaad', 'Bisha Laba iyo Tobnaad'],
    'months_short' => ['Kob', 'Lab', 'Sad', 'Afr', 'Sha', 'Lix', 'Tod', 'Sid', 'Sag', 'Tob', 'KIT', 'LIT'],
    'weekdays' => ['Axad', 'Isniin', 'Salaaso', 'Arbaco', 'Khamiis', 'Jimco', 'Sabti'],
    'weekdays_short' => ['Axd', 'Isn', 'Tal', 'Arb', 'Kha', 'Jim', 'Sab'],
    'weekdays_min' => ['Axd', 'Isn', 'Tal', 'Arb', 'Kha', 'Jim', 'Sab'],
    'first_day_of_week' => 6,
    'day_of_first_week_of_year' => 1,
    'meridiem' => ['subaxnimo', 'galabnimo'],

    'year' => ':count sanad',
    'y' => ':count sanad',
    'a_year' => ':count sanad',

    'month' => ':count Bilaha',
    'm' => ':count Bilaha',
    'a_month' => ':count Bilaha',

    'week' => ':count todobaad',
    'w' => ':count todobaad',
    'a_week' => ':count todobaad',

    'day' => ':count maalin',
    'd' => ':count maalin',
    'a_day' => ':count maalin',

    'hour' => ':count saacad',
    'h' => ':count saacad',
    'a_hour' => ':count saacad',

    'minute' => ':count daqiiqad',
    'min' => ':count daqiiqad',
    'a_minute' => ':count daqiiqad',

    'second' => ':count ilbiriqsi',
    's' => ':count ilbiriqsi',
    'a_second' => ':count ilbiriqsi',
]);
