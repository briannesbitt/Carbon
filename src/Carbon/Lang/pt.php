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
 * - Cassiano Montanari
 * - Matt Pope
 * - François B
 * - Prodis
 * - JD Isaacks
 * - Raphael Amorim
 * - João Magalhães
 * - victortobias
 * - Paulo Freitas
 * - Sebastian Thierer
 */
return [
    'year' => ':count ano|:count anos',
    'a_year' => 'um ano|:count anos',
    'y' => ':counta',
    'month' => ':count mês|:count meses',
    'a_month' => 'um mês|:count meses',
    'm' => ':countm',
    'week' => ':count semana|:count semanas',
    'a_week' => 'uma semana|:count semanas',
    'w' => ':countsem',
    'day' => ':count dia|:count dias',
    'a_day' => 'um dia|:count dias',
    'd' => ':countd',
    'hour' => ':count hora|:count horas',
    'a_hour' => 'uma hora|:count horas',
    'h' => ':counth',
    'minute' => ':count minuto|:count minutos',
    'a_minute' => 'um minuto|:count minutos',
    'min' => ':countmin',
    'second' => ':count segundo|:count segundos',
    'a_second' => 'alguns segundos|:count segundos',
    's' => ':counts',
    'ago' => 'há :time',
    'from_now' => 'em :time',
    'after' => ':time depois',
    'before' => ':time antes',
    'diff_now' => 'agora',
    'diff_yesterday' => 'ontem',
    'diff_tomorrow' => 'amanhã',
    'diff_before_yesterday' => 'anteontem',
    'diff_after_tomorrow' => 'depois de amanhã',
    'period_recurrences' => 'uma vez|:count vezes',
    'period_interval' => 'cada :interval',
    'period_start_date' => 'de :date',
    'period_end_date' => 'até :date',
    'formats' => [
        'LT' => 'HH:mm',
        'LTS' => 'HH:mm:ss',
        'L' => 'DD/MM/YYYY',
        'LL' => 'D [de] MMMM [de] YYYY',
        'LLL' => 'D [de] MMMM [de] YYYY HH:mm',
        'LLLL' => 'dddd, D [de] MMMM [de] YYYY HH:mm',
    ],
    'calendar' => [
        'sameDay' => '[Hoje às] LT',
        'nextDay' => '[Amanhã às] LT',
        'nextWeek' => 'dddd [às] LT',
        'lastDay' => '[Ontem às] LT',
        'lastWeek' => function (\Carbon\CarbonInterface $date) {
            switch ($date->dayOfWeek) {
                case 0:
                case 6:
                    return '[Último] dddd [às] LT';
                default:
                    return '[Última] dddd [às] LT';
            }
        },
        'sameElse' => 'L',
    ],
    'ordinal' => ':numberº',
    'months' => ['janeiro', 'fevereiro', 'março', 'abril', 'maio', 'junho', 'julho', 'agosto', 'setembro', 'outubro', 'novembro', 'dezembro'],
    'months_short' => ['jan', 'fev', 'mar', 'abr', 'mai', 'jun', 'jul', 'ago', 'set', 'out', 'nov', 'dez'],
    'weekdays' => ['Domingo', 'Segunda-feira', 'Terça-feira', 'Quarta-feira', 'Quinta-feira', 'Sexta-feira', 'Sábado'],
    'weekdays_short' => ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sáb'],
    'weekdays_min' => ['Do', '2ª', '3ª', '4ª', '5ª', '6ª', 'Sá'],
    'first_day_of_week' => 1,
    'day_of_first_week_of_year' => 4,
    'list' => [', ', ' e '],
];
