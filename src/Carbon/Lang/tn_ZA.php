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
 * - Zuza Software Foundation (Translate.org.za) Dwayne Bailey dwayne@translate.org.za
 */return array_replace_recursive(require __DIR__.'/en.php', [
    'formats' => [
        'L' => 'DD/MM/YYYY',
    ],
    'months' => ['Ferikgong', 'Tlhakole', 'Mopitlwe', 'Moranang', 'Motsheganong', 'Seetebosigo', 'Phukwi', 'Phatwe', 'Lwetse', 'Diphalane', 'Ngwanatsele', 'Sedimonthole'],
    'months_short' => ['Fer', 'Tlh', 'Mop', 'Mor', 'Mot', 'See', 'Phu', 'Pha', 'Lwe', 'Dip', 'Ngw', 'Sed'],
    'weekdays' => ['laTshipi', 'Mosupologo', 'Labobedi', 'Laboraro', 'Labone', 'Labotlhano', 'Lamatlhatso'],
    'weekdays_short' => ['Tsh', 'Mos', 'Bed', 'Rar', 'Ne', 'Tlh', 'Mat'],
    'weekdays_min' => ['Tsh', 'Mos', 'Bed', 'Rar', 'Ne', 'Tlh', 'Mat'],
    'day_of_first_week_of_year' => 1,

    'day' => ':count nako', // less reliable
    'd' => ':count nako', // less reliable
    'a_day' => ':count nako', // less reliable

    'minute' => ':count tshoganetso', // less reliable
    'min' => ':count tshoganetso', // less reliable
    'a_minute' => ':count tshoganetso', // less reliable

    'year' => ':count ngwaga',
    'y' => ':count ngwaga',
    'a_year' => ':count ngwaga',

    'month' => ':count kgwedi',
    'm' => ':count kgwedi',
    'a_month' => ':count kgwedi',

    'week' => ':count beke',
    'w' => ':count beke',
    'a_week' => ':count beke',

    'hour' => ':count nako',
    'h' => ':count nako',
    'a_hour' => ':count nako',

    'second' => ':count tshoganetso',
    's' => ':count tshoganetso',
    'a_second' => ':count tshoganetso',
]);
