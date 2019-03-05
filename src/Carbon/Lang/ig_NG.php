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
 * - pablo@mandriva.com
 */
return array_replace_recursive(require __DIR__.'/en.php', [
    'formats' => [
        'L' => 'DD/MM/YY',
    ],
    'months' => ['Jenụwarị', 'Febrụwarị', 'Maachị', 'Eprel', 'Mee', 'Juun', 'Julaị', 'Ọgọọst', 'Septemba', 'Ọktoba', 'Novemba', 'Disemba'],
    'months_short' => ['Jen', 'Feb', 'Maa', 'Epr', 'Mee', 'Juu', 'Jul', 'Ọgọ', 'Sep', 'Ọkt', 'Nov', 'Dis'],
    'weekdays' => ['sọnde', 'mọnde', 'tuzde', 'wenzde', 'tọsde', 'fraịde', 'satọde'],
    'weekdays_short' => ['sọn', 'mọn', 'tuz', 'wen', 'tọs', 'fra', 'sat'],
    'weekdays_min' => ['sọn', 'mọn', 'tuz', 'wen', 'tọs', 'fra', 'sat'],
    'first_day_of_week' => 1,
    'day_of_first_week_of_year' => 1,

    'year' => ':count afo',
    'y' => ':count afo',
    'a_year' => ':count afo',

    'month' => ':count önwa',
    'm' => ':count önwa',
    'a_month' => ':count önwa',

    'week' => ':count ehihe', // less reliable
    'w' => ':count ehihe', // less reliable
    'a_week' => ':count ehihe', // less reliable

    'day' => ':count ehihe',
    'd' => ':count ehihe',
    'a_day' => ':count ehihe',

    'hour' => 'elekere :count',
    'h' => 'elekere :count',
    'a_hour' => 'elekere :count',

    'minute' => ':count kịrịkịrị', // less reliable
    'min' => ':count kịrịkịrị', // less reliable
    'a_minute' => ':count kịrịkịrị', // less reliable

    'second' => ':count nkwàdo', // less reliable
    's' => ':count nkwàdo', // less reliable
    'a_second' => ':count nkwàdo', // less reliable
]);
