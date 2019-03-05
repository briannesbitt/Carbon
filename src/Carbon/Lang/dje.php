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
    'meridiem' => ['Subbaahi', 'Zaarikay b'],
    'weekdays' => ['Alhadi', 'Atinni', 'Atalaata', 'Alarba', 'Alhamisi', 'Alzuma', 'Asibti'],
    'weekdays_short' => ['Alh', 'Ati', 'Ata', 'Ala', 'Alm', 'Alz', 'Asi'],
    'weekdays_min' => ['Alh', 'Ati', 'Ata', 'Ala', 'Alm', 'Alz', 'Asi'],
    'months' => ['Žanwiye', 'Feewiriye', 'Marsi', 'Awiril', 'Me', 'Žuweŋ', 'Žuyye', 'Ut', 'Sektanbur', 'Oktoobur', 'Noowanbur', 'Deesanbur'],
    'months_short' => ['Žan', 'Fee', 'Mar', 'Awi', 'Me', 'Žuw', 'Žuy', 'Ut', 'Sek', 'Okt', 'Noo', 'Dee'],
    'first_day_of_week' => 1,
    'formats' => [
        'LT' => 'HH:mm',
        'LTS' => 'HH:mm:ss',
        'L' => 'D/M/YYYY',
        'LL' => 'D MMM, YYYY',
        'LLL' => 'D MMMM YYYY HH:mm',
        'LLLL' => 'dddd D MMMM YYYY HH:mm',
    ],

    'year' => ':count hari',
    'y' => ':count hari',
    'a_year' => ':count hari',

    'week' => ':count alzuma',
    'w' => ':count alzuma',
    'a_week' => ':count alzuma',

    'second' => ':count atinni',
    's' => ':count atinni',
    'a_second' => ':count atinni',
]);
