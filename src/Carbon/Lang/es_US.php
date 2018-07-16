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
    'year' => 'un año|:count años',
    'month' => 'un mes|:count meses',
    'day' => 'un día|:count días',
    'hour' => 'una hora|:count horas',
    'minute' => 'un minuto|:count minutos',
    'second' => 'unos segundos|:count segundos',
    'ago' => 'hace :time',
    'from_now' => 'en :time',
    'formats' => [
        'LT' => 'h:mm A',
        'LTS' => 'h:mm:ss A',
        'L' => 'MM/DD/YYYY',
        'LL' => 'MMMM [de] D [de] YYYY',
        'LLL' => 'MMMM [de] D [de] YYYY h:mm A',
        'LLLL' => 'dddd, MMMM [de] D [de] YYYY h:mm A',
    ],
    'calendar' => [
        'sameDay' => '',
        'nextDay' => '',
        'nextWeek' => '',
        'lastDay' => '',
        'lastWeek' => '',
        'sameElse' => 'L',
    ],
    'months' => ['enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre'],
    'months_short' => [
    ],
    'weekdays' => ['domingo', 'lunes', 'martes', 'miércoles', 'jueves', 'viernes', 'sábado'],
    'weekdays_short' => ['dom.', 'lun.', 'mar.', 'mié.', 'jue.', 'vie.', 'sáb.'],
    'weekdays_min' => ['do', 'lu', 'ma', 'mi', 'ju', 'vi', 'sá'],
];
