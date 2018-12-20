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
    'year' => 'um ano|:count anos',
    'y' => ':counta|:counta',
    'month' => 'um mês|:count meses',
    'm' => ':countm|:countm',
    'week' => ':count semana|:count semanas',
    'w' => ':countsem|:countsem',
    'day' => 'um dia|:count dias',
    'd' => ':countd|:countd',
    'hour' => 'uma hora|:count horas',
    'h' => ':counth|:counth',
    'minute' => 'um minuto|:count minutos',
    'min' => ':countmin|:countmin',
    'second' => 'poucos segundos|:count segundos',
    's' => ':counts|:counts',
    'ago' => 'há :time',
    'from_now' => 'em :time',
    'after' => 'após :time',
    'before' => ':time atrás',
    'diff_now' => 'agora',
    'diff_yesterday' => 'ontem',
    'diff_tomorrow' => 'amanhã',
    'diff_before_yesterday' => 'anteontem',
    'diff_after_tomorrow' => 'depois de amanhã',
    'period_recurrences' => 'uma|:count vez',
    'period_interval' => 'toda :interval',
    'period_start_date' => 'de :date',
    'period_end_date' => 'até :date',
    'formats' => [
        'LT' => 'HH:mm',
        'LTS' => 'HH:mm:ss',
        'L' => 'DD/MM/YYYY',
        'LL' => 'D [de] MMMM [de] YYYY',
        'LLL' => 'D [de] MMMM [de] YYYY [às] HH:mm',
        'LLLL' => 'dddd, D [de] MMMM [de] YYYY [às] HH:mm',
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
    'list' => [', ', ' e '],
];
