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
    'year' => 'ur bloaz|',
    'month' => 'ur miz|',
    'day' => 'un devezh|',
    'hour' => 'un eur|:count eur',
    'minute' => 'ur vunutenn|',
    'second' => 'un nebeud segondennoù|:count eilenn',
    'ago' => ':time \'zo',
    'from_now' => 'a-benn :time',
    'formats' => [
        'LT' => 'h[e]mm A',
        'LTS' => 'h[e]mm:ss A',
        'L' => 'DD/MM/YYYY',
        'LL' => 'D [a viz] MMMM YYYY',
        'LLL' => 'D [a viz] MMMM YYYY h[e]mm A',
        'LLLL' => 'dddd, D [a viz] MMMM YYYY h[e]mm A',
    ],
    'calendar' => [
        'sameDay' => '[Hiziv da] LT',
        'nextDay' => '[Warc\'hoazh da] LT',
        'nextWeek' => 'dddd [da] LT',
        'lastDay' => '[Dec\'h da] LT',
        'lastWeek' => 'dddd [paset da] LT',
        'sameElse' => 'L',
    ],
    'ordinal' => function ($number, $period) {
        return $number.($number === 1) ? 'añ' : 'vet';
    },
    'months' => ['Genver', 'C\'hwevrer', 'Meurzh', 'Ebrel', 'Mae', 'Mezheven', 'Gouere', 'Eost', 'Gwengolo', 'Here', 'Du', 'Kerzu'],
    'months_short' => ['Gen', 'C\'hwe', 'Meu', 'Ebr', 'Mae', 'Eve', 'Gou', 'Eos', 'Gwe', 'Her', 'Du', 'Ker'],
    'weekdays' => ['Sul', 'Lun', 'Meurzh', 'Merc\'her', 'Yaou', 'Gwener', 'Sadorn'],
    'weekdays_short' => ['Sul', 'Lun', 'Meu', 'Mer', 'Yao', 'Gwe', 'Sad'],
    'weekdays_min' => ['Su', 'Lu', 'Me', 'Mer', 'Ya', 'Gw', 'Sa'],
];
