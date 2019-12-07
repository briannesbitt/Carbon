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
 * - François B
 * - Fidel Pita
 * - JD Isaacks
 * - Diego Vilariño
 * - Sebastian Thierer
 */
return [
    'year' => ':count ano|:count anos',
    'a_year' => 'un ano|:count anos',
    'y' => ':count a.',
    'month' => ':count mes|:count meses',
    'a_month' => 'un mes|:count meses',
    'm' => ':count mes.',
    'week' => ':count semana|:count semanas',
    'a_week' => 'unha semana|:count semanas',
    'w' => ':count sem.',
    'day' => ':count día|:count días',
    'a_day' => 'un día|:count días',
    'd' => ':count d.',
    'hour' => ':count hora|:count horas',
    'a_hour' => 'unha hora|:count horas',
    'h' => ':count h.',
    'minute' => ':count minuto|:count minutos',
    'a_minute' => 'un minuto|:count minutos',
    'min' => ':count min.',
    'second' => ':count segundo|:count segundos',
    'a_second' => 'uns segundos|:count segundos',
    's' => ':count seg.',
    'ago' => 'hai :time',
    'from_now' => function ($time) {
        if (substr($time, 0, 2) === 'un') {
            return "n$time";
        }

        return "en $time";
    },
    'diff_now' => 'agora',
    'diff_yesterday' => 'onte',
    'diff_tomorrow' => 'mañá',
    'after' => ':time despois',
    'before' => ':time antes',
    'formats' => [
        'LT' => 'H:mm',
        'LTS' => 'H:mm:ss',
        'L' => 'DD/MM/YYYY',
        'LL' => 'D [de] MMMM [de] YYYY',
        'LLL' => 'D [de] MMMM [de] YYYY H:mm',
        'LLLL' => 'dddd, D [de] MMMM [de] YYYY H:mm',
    ],
    'calendar' => [
        'sameDay' => function (\Carbon\CarbonInterface $current) {
            return '[hoxe '.($current->hour !== 1 ? 'ás' : 'á').'] LT';
        },
        'nextDay' => function (\Carbon\CarbonInterface $current) {
            return '[mañá '.($current->hour !== 1 ? 'ás' : 'á').'] LT';
        },
        'nextWeek' => function (\Carbon\CarbonInterface $current) {
            return 'dddd ['.($current->hour !== 1 ? 'ás' : 'á').'] LT';
        },
        'lastDay' => function (\Carbon\CarbonInterface $current) {
            return '[onte '.($current->hour !== 1 ? 'á' : 'a').'] LT';
        },
        'lastWeek' => function (\Carbon\CarbonInterface $current) {
            return '[o] dddd [pasado '.($current->hour !== 1 ? 'ás' : 'á').'] LT';
        },
        'sameElse' => 'L',
    ],
    'ordinal' => ':numberº',
    'months' => ['xaneiro', 'febreiro', 'marzo', 'abril', 'maio', 'xuño', 'xullo', 'agosto', 'setembro', 'outubro', 'novembro', 'decembro'],
    'months_short' => ['xan.', 'feb.', 'mar.', 'abr.', 'mai.', 'xuñ.', 'xul.', 'ago.', 'set.', 'out.', 'nov.', 'dec.'],
    'weekdays' => ['domingo', 'luns', 'martes', 'mércores', 'xoves', 'venres', 'sábado'],
    'weekdays_short' => ['dom.', 'lun.', 'mar.', 'mér.', 'xov.', 'ven.', 'sáb.'],
    'weekdays_min' => ['do', 'lu', 'ma', 'mé', 'xo', 've', 'sá'],
    'first_day_of_week' => 1,
    'day_of_first_week_of_year' => 4,
    'list' => [', ', ' e '],
    'meridiem' => ['a.m.', 'p.m.'],
];
