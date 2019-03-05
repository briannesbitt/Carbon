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
    'meridiem' => ['OD', 'OT'],
    'weekdays' => ['Jumapil', 'Wuok Tich', 'Tich Ariyo', 'Tich Adek', 'Tich Ang’wen', 'Tich Abich', 'Ngeso'],
    'weekdays_short' => ['JMP', 'WUT', 'TAR', 'TAD', 'TAN', 'TAB', 'NGS'],
    'weekdays_min' => ['JMP', 'WUT', 'TAR', 'TAD', 'TAN', 'TAB', 'NGS'],
    'months' => ['Dwe mar Achiel', 'Dwe mar Ariyo', 'Dwe mar Adek', 'Dwe mar Ang’wen', 'Dwe mar Abich', 'Dwe mar Auchiel', 'Dwe mar Abiriyo', 'Dwe mar Aboro', 'Dwe mar Ochiko', 'Dwe mar Apar', 'Dwe mar gi achiel', 'Dwe mar Apar gi ariyo'],
    'months_short' => ['DAC', 'DAR', 'DAD', 'DAN', 'DAH', 'DAU', 'DAO', 'DAB', 'DOC', 'DAP', 'DGI', 'DAG'],
    'formats' => [
        'LT' => 'HH:mm',
        'LTS' => 'HH:mm:ss',
        'L' => 'DD/MM/YYYY',
        'LL' => 'D MMM YYYY',
        'LLL' => 'D MMMM YYYY HH:mm',
        'LLLL' => 'dddd, D MMMM YYYY HH:mm',
    ],

    'year' => ':count chíeng&#039;', // less reliable
    'y' => ':count chíeng&#039;', // less reliable
    'a_year' => ':count chíeng&#039;', // less reliable

    'month' => ':count dwe', // less reliable
    'm' => ':count dwe', // less reliable
    'a_month' => ':count dwe', // less reliable

    'week' => ':count chíeng&#039;', // less reliable
    'w' => ':count chíeng&#039;', // less reliable
    'a_week' => ':count chíeng&#039;', // less reliable

    'day' => ':count chíeng&#039;', // less reliable
    'd' => ':count chíeng&#039;', // less reliable
    'a_day' => ':count chíeng&#039;', // less reliable

    'minute' => ':count ng&#039;ato', // less reliable
    'min' => ':count ng&#039;ato', // less reliable
    'a_minute' => ':count ng&#039;ato', // less reliable

    'second' => ':count lak', // less reliable
    's' => ':count lak', // less reliable
    'a_second' => ':count lak', // less reliable
]);
