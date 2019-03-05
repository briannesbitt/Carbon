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
 */
return array_replace_recursive(require __DIR__.'/en.php', [
    'formats' => [
        'L' => 'DD/MM/YYYY',
    ],
    'months' => ['Januwari', 'Februwari', 'Mashi', 'Ephreli', 'Meyi', 'Juni', 'Julayi', 'Agasti', 'Septhemba', 'Okthoba', 'Novemba', 'Disemba'],
    'months_short' => ['Jan', 'Feb', 'Mas', 'Eph', 'Mey', 'Jun', 'Jul', 'Aga', 'Sep', 'Okt', 'Nov', 'Dis'],
    'weekdays' => ['iSonto', 'uMsombuluko', 'uLwesibili', 'uLwesithathu', 'uLwesine', 'uLwesihlanu', 'uMgqibelo'],
    'weekdays_short' => ['Son', 'Mso', 'Bil', 'Tha', 'Sin', 'Hla', 'Mgq'],
    'weekdays_min' => ['Son', 'Mso', 'Bil', 'Tha', 'Sin', 'Hla', 'Mgq'],
    'day_of_first_week_of_year' => 1,

    'year' => ':count unyaka',
    'y' => ':count unyaka',
    'a_year' => ':count unyaka',

    'month' => ':count inyanga',
    'm' => ':count inyanga',
    'a_month' => ':count inyanga',

    'week' => ':count iviki',
    'w' => ':count iviki',
    'a_week' => ':count iviki',

    'day' => ':count ilanga',
    'd' => ':count ilanga',
    'a_day' => ':count ilanga',

    'hour' => ':count ihora',
    'h' => ':count ihora',
    'a_hour' => ':count ihora',

    'minute' => ':count isikhashana', // less reliable
    'min' => ':count isikhashana', // less reliable
    'a_minute' => ':count isikhashana', // less reliable

    'second' => ':count isikhashana',
    's' => ':count isikhashana',
    'a_second' => ':count isikhashana',
]);
