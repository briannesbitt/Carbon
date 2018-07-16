<?php

/*
 * This file is part of the Carbon package.
 *
 * (c) Brian Nesbitt <brian@nesbot.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

return [
    'year' => 'he tau|:count tau',
    'month' => 'he marama|:count marama',
    'day' => 'he ra|:count ra',
    'hour' => 'te haora|:count haora',
    'minute' => 'he meneti|:count meneti',
    'second' => 'te hēkona ruarua|:count hēkona',
    'ago' => ':time i mua',
    'from_now' => 'i roto i :time',
    'formats' => [
        'LT' => 'HH:mm',
        'LTS' => 'HH:mm:ss',
        'L' => 'DD/MM/YYYY',
        'LL' => 'D MMMM YYYY',
        'LLL' => 'D MMMM YYYY [i] HH:mm',
        'LLLL' => 'dddd, D MMMM YYYY [i] HH:mm',
    ],
    'calendar' => [
        'sameDay' => '[i teie mahana, i] LT',
        'nextDay' => '[apopo i] LT',
        'nextWeek' => 'dddd [i] LT',
        'lastDay' => '[inanahi i] LT',
        'lastWeek' => 'dddd [whakamutunga i] LT',
        'sameElse' => 'L',
    ],
    'months' => ['Kohi-tāte', 'Hui-tanguru', 'Poutū-te-rangi', 'Paenga-whāwhā', 'Haratua', 'Pipiri', 'Hōngoingoi', 'Here-turi-kōkā', 'Mahuru', 'Whiringa-ā-nuku', 'Whiringa-ā-rangi', 'Hakihea'],
    'months_short' => ['Kohi', 'Hui', 'Pou', 'Pae', 'Hara', 'Pipi', 'Hōngoi', 'Here', 'Mahu', 'Whi-nu', 'Whi-ra', 'Haki'],
    'weekdays' => ['Rātapu', 'Mane', 'Tūrei', 'Wenerei', 'Tāite', 'Paraire', 'Hātarei'],
    'weekdays_short' => ['Ta', 'Ma', 'Tū', 'We', 'Tāi', 'Pa', 'Hā'],
    'weekdays_min' => ['Ta', 'Ma', 'Tū', 'We', 'Tāi', 'Pa', 'Hā'],
];
