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
 * - Kunal Marwaha
 * - kostas
 * - François B
 * - Tim Fish
 * - Claire Coloma
 * - Steven Heinrich
 * - JD Isaacks
 * - Raphael Amorim
 * - Jorge Y. Castillo
 * - Víctor Díaz
 * - Diego
 * - Sebastian Thierer
 * - quinterocesar
 * - Daniel Commesse Liévanos (danielcommesse)
 */
return [
    'year' => ':count año|:count años',
    'a_year' => 'un año|:count años',
    'y' => ':count año|:count años',
    'month' => ':count mes|:count meses',
    'a_month' => 'un mes|:count meses',
    'm' => ':count mes|:count meses',
    'week' => ':count semana|:count semanas',
    'a_week' => 'una semana|:count semanas',
    'w' => ':countsem',
    'day' => ':count día|:count días',
    'a_day' => 'un día|:count días',
    'd' => ':countd',
    'hour' => ':count hora|:count horas',
    'a_hour' => 'una hora|:count horas',
    'h' => ':counth',
    'minute' => ':count minuto|:count minutos',
    'a_minute' => 'un minuto|:count minutos',
    'min' => ':countm',
    'second' => ':count segundo|:count segundos',
    'a_second' => 'unos segundos|:count segundos',
    's' => ':counts',
    'ago' => 'hace :time',
    'from_now' => 'en :time',
    'after' => ':time después',
    'before' => ':time antes',
    'diff_now' => 'ahora mismo',
    'diff_yesterday' => 'ayer',
    'diff_tomorrow' => 'mañana',
    'diff_before_yesterday' => 'antier',
    'diff_after_tomorrow' => 'pasado mañana',
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
            return '[hoy a la'.($current->hour !== 1 ? 's' : '').'] LT';
        },
        'nextDay' => function (\Carbon\CarbonInterface $current) {
            return '[mañana a la'.($current->hour !== 1 ? 's' : '').'] LT';
        },
        'nextWeek' => function (\Carbon\CarbonInterface $current) {
            return 'dddd [a la'.($current->hour !== 1 ? 's' : '').'] LT';
        },
        'lastDay' => function (\Carbon\CarbonInterface $current) {
            return '[ayer a la'.($current->hour !== 1 ? 's' : '').'] LT';
        },
        'lastWeek' => function (\Carbon\CarbonInterface $current) {
            return '[el] dddd [pasado a la'.($current->hour !== 1 ? 's' : '').'] LT';
        },
        'sameElse' => 'L',
    ],
    'months' => ['enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre'],
    'months_short' => ['ene', 'feb', 'mar', 'abr', 'may', 'jun', 'jul', 'ago', 'sep', 'oct', 'nov', 'dic'],
    'mmm_suffix' => '.',
    'ordinal' => ':numberº',
    'weekdays' => ['domingo', 'lunes', 'martes', 'miércoles', 'jueves', 'viernes', 'sábado'],
    'weekdays_short' => ['dom.', 'lun.', 'mar.', 'mié.', 'jue.', 'vie.', 'sáb.'],
    'weekdays_min' => ['do', 'lu', 'ma', 'mi', 'ju', 'vi', 'sá'],
    'first_day_of_week' => 1,
    'day_of_first_week_of_year' => 4,
    'list' => [', ', ' y '],
    'meridiem' => ['a. m.', 'p. m.'],
];
