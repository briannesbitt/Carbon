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
 * - Ghorban M. Tavakoly Pablo Saratxaga & Ghorban M. Tavakoly pablo@walon.org & gmt314@yahoo.com
 * - SuperManPHP
 */
$transformDiff = function ($input) {
    return strtr($input, [
        'sekunt' => 'sekunt',
        'hepde' => 'hepde',
    ]);
};

return array_replace_recursive(require __DIR__.'/en.php', [
    'formats' => [
        'L' => 'DD.MM.YYYY',
    ],
    'months' => ['Ýanwar', 'Fewral', 'Mart', 'Aprel', 'Maý', 'Iýun', 'Iýul', 'Awgust', 'Sentýabr', 'Oktýabr', 'Noýabr', 'Dekabr'],
    'months_short' => ['Ýan', 'Few', 'Mar', 'Apr', 'Maý', 'Iýn', 'Iýl', 'Awg', 'Sen', 'Okt', 'Noý', 'Dek'],
    'weekdays' => ['Duşenbe', 'Sişenbe', 'Çarşenbe', 'Penşenbe', 'Anna', 'Şenbe', 'Ýekşenbe'],
    'weekdays_short' => ['Duş', 'Siş', 'Çar', 'Pen', 'Ann', 'Şen', 'Ýek'],
    'weekdays_min' => ['Duş', 'Siş', 'Çar', 'Pen', 'Ann', 'Şen', 'Ýek'],
    'first_day_of_week' => 1,
    'day_of_first_week_of_year' => 1,

    'year' => ':count ýyl',
    'y' => ':count ýyl',
    'a_year' => ':count ýyl',

    'month' => 'aý :count',
    'm' => 'aý :count',
    'a_month' => 'aý :count',

    'week' => ':count hepde',
    'w' => ':count hepde',
    'a_week' => ':count hepde',

    'day' => ':count gün',
    'd' => ':count gün',
    'a_day' => ':count gün',

    'hour' => ':count sagat',
    'h' => ':count sagat',
    'a_hour' => ':count sagat',

    'minute' => ':count minut',
    'min' => ':count minut',
    'a_minute' => ':count minut',

    'second' => ':count sekunt',
    's' => ':count sekunt',
    'a_second' => ':count sekunt',

    'ago' => function ($time) use ($transformDiff) {
        return $transformDiff($time).' ozal';
    },
    'from_now' => function ($time) use ($transformDiff) {
        return $transformDiff($time).' soňra';
    },
    'after' => function ($time) use ($transformDiff) {
        return $transformDiff($time).' soň';
    },
    'before' => function ($time) use ($transformDiff) {
        return $transformDiff($time).' öň';
    },
]);
