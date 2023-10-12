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
    'year' => ':count Joer',
    'a_year' => 'ee Joer|:count Joer',
    'y' => ':countj',
    'month' => ':count Mount|:count Méint',
    'a_month' => 'ee Mount|:count Méint',
    'm' => ':countm',
    'week' => ':count Wooch|:count Woochen',
    'a_week' => 'eng Wooch|:count Woochen',
    'w' => ':countw',
    'day' => ':count Dag|:count Deeg',
    'a_day' => 'een Dag|:count Deeg',
    'd' => ':countd',
    'hour' => ':count Stonn|:count Stonnen',
    'a_hour' => 'eine Stonn|:count Stonnen',
    'h' => ':counth',
    'minute' => ':count Minutt|:count Minutten',
    'a_minute' => 'eng Minutt|:count Minutten',
    'min' => ':countm',
    'second' => ':count Sekonn|:count Sekonnen',
    'a_second' => 'ë puer Sekonnen|:count Sekonnen',
    's' => ':counts',
    'ago' => 'virun :time',
    'from_now' => ':time ab elo',
    'after' => ':time virdrun',
    'before' => ':time dono',
    'meridiem' => ['Dinda', 'Dilolo'],
    'weekdays' => ['Sonndeg', 'Méindeg', 'Dënschdeg', 'Mëttwoch', 'Donneschdeg', 'Freideg', 'Samschdeg'],
    'weekdays_short' => ['Son', 'Méi', 'Dën', 'Mët', 'Don', 'Fre', 'Sam'],
    'weekdays_min' => ['So', 'Mé', 'Dë', 'Më', 'Do', 'Fr', 'Sa'],
    'months' => ['Januar', 'Februar', 'Mäerz', 'Abrëll', 'Mee', 'Juni', 'Juli', 'August', 'September', 'Oktober', 'November', 'Dezember'],
    'months_short' => ['Jan', 'Feb', 'Mäe', 'Abr', 'Mee', 'Jun', 'Jul', 'Aug', 'Sep', 'Okt', 'Nov', 'Dez'],
    'first_day_of_week' => 1,
    'formats' => [
        'LT' => 'HH:mm',
        'LTS' => 'HH:mm:ss',
        'L' => 'D/M/YYYY',
        'LL' => 'D MMM YYYY',
        'LLL' => 'D MMMM YYYY HH:mm',
        'LLLL' => 'dddd D MMMM YYYY HH:mm',
    ],
]);
