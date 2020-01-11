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
 * - information from Kenneth Christiansen Kenneth Christiansen, Pablo Saratxaga kenneth@gnu.org, pablo@mandrakesoft.com
 */
return array_replace_recursive(require __DIR__.'/en.php', [
    'formats' => [
        'L' => 'DD.MM.YYYY',
    ],
    'months' => ['Jannuaar', 'Feberwaar', 'März', 'April', 'Mai', 'Juni', 'Juli', 'August', 'September', 'Oktober', 'November', 'Dezember'],
    'months_short' => ['Jan', 'Feb', 'Mär', 'Apr', 'Mai', 'Jun', 'Jul', 'Aug', 'Sep', 'Okt', 'Nov', 'Dez'],
    'weekdays' => ['Sünndag', 'Maandag', 'Dingsdag', 'Middeweek', 'Dunnersdag', 'Freedag', 'Sünnavend'],
    'weekdays_short' => ['Sdag', 'Maan', 'Ding', 'Migg', 'Dunn', 'Free', 'Svd.'],
    'weekdays_min' => ['Sdag', 'Maan', 'Ding', 'Migg', 'Dunn', 'Free', 'Svd.'],
    'first_day_of_week' => 1,
    'day_of_first_week_of_year' => 4,

    'year' => ':count Johr',
    'y' => ':count Johr',
    'a_year' => ':count Johr',

    'month' => ':count Maand',
    'm' => ':count Maand',
    'a_month' => ':count Maand',

    'week' => ':count Week',
    'w' => ':count Week',
    'a_week' => ':count Week',

    'day' => ':count Dag',
    'd' => ':count Dag',
    'a_day' => ':count Dag',

    'hour' => ':count Stünn',
    'h' => ':count Stünn',
    'a_hour' => ':count Stünn',

    'minute' => ':count Minuut',
    'min' => ':count Minuut',
    'a_minute' => ':count Minuut',

    'second' => ':count sekunn',
    's' => ':count sekunn',
    'a_second' => ':count sekunn',
]);
