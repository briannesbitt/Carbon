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
    'meridiem' => ['idiɓa', 'ebyámu'],
    'weekdays' => ['éti', 'mɔ́sú', 'kwasú', 'mukɔ́sú', 'ŋgisú', 'ɗónɛsú', 'esaɓasú'],
    'weekdays_short' => ['ét', 'mɔ́s', 'kwa', 'muk', 'ŋgi', 'ɗón', 'esa'],
    'weekdays_min' => ['ét', 'mɔ́s', 'kwa', 'muk', 'ŋgi', 'ɗón', 'esa'],
    'months' => ['dimɔ́di', 'ŋgɔndɛ', 'sɔŋɛ', 'diɓáɓá', 'emiasele', 'esɔpɛsɔpɛ', 'madiɓɛ́díɓɛ́', 'diŋgindi', 'nyɛtɛki', 'mayésɛ́', 'tiníní', 'eláŋgɛ́'],
    'months_short' => ['di', 'ŋgɔn', 'sɔŋ', 'diɓ', 'emi', 'esɔ', 'mad', 'diŋ', 'nyɛt', 'may', 'tin', 'elá'],
    'first_day_of_week' => 1,
    'formats' => [
        'LT' => 'HH:mm',
        'LTS' => 'HH:mm:ss',
        'L' => 'D/M/YYYY',
        'LL' => 'D MMM YYYY',
        'LLL' => 'D MMMM YYYY HH:mm',
        'LLLL' => 'dddd D MMMM YYYY HH:mm',
    ],

    'year' => ':count mbu',
    'y' => ':count mbu',
    'a_year' => ':count mbu',

    'month' => ':count modi',
    'm' => ':count modi',
    'a_month' => ':count modi',

    'week' => ':count woki',
    'w' => ':count woki',
    'a_week' => ':count woki',

    'day' => ':count buńa',
    'd' => ':count buńa',
    'a_day' => ':count buńa',

    'hour' => ':count ndoko',
    'h' => ':count ndoko',
    'a_hour' => ':count ndoko',

    'minute' => ':count ndoko',
    'min' => ':count ndoko',
    'a_minute' => ':count ndoko',

    'second' => ':count maba',
    's' => ':count maba',
    'a_second' => ':count maba',
]);
