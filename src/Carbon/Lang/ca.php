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
    'year' => 'un any|:count anys',
    'y' => ':count any|:count anys',
    'month' => 'un mes|:count mesos',
    'm' => ':count mes|:count mesos',
    'week' => ':count setmana|:count setmanes',
    'w' => ':count setmana|:count setmanes',
    'day' => 'un dia|:count dies',
    'd' => ':count dia|:count dies',
    'hour' => 'una hora|:count hores',
    'h' => ':count hora|:count hores',
    'minute' => 'un minut|:count minuts',
    'min' => ':count minut|:count minuts',
    'second' => 'uns segons|:count segons',
    's' => ':count segon|:count segons',
    'ago' => 'fa :time',
    'from_now' => 'd\'aquí :time',
    'after' => ':time després',
    'before' => ':time abans',
    'diff_now' => 'ara mateix',
    'diff_yesterday' => 'ahir',
    'diff_tomorrow' => 'demà',
    'diff_before_yesterday' => 'abans d\'ahir',
    'diff_after_tomorrow' => 'demà passat',
    'period_recurrences' => ':count cop|:count cops',
    'period_interval' => 'cada :interval',
    'period_start_date' => 'de :date',
    'period_end_date' => 'fins a :date',
    'formats' => [
        'LT' => 'H:mm',
        'LTS' => 'H:mm:ss',
        'L' => 'DD/MM/YYYY',
        'LL' => 'D MMMM [de] YYYY',
        'LLL' => 'D MMMM [de] YYYY [a les] H:mm',
        'LLLL' => 'dddd D MMMM [de] YYYY [a les] H:mm',
    ],
    'calendar' => [
        'sameDay' => function (\Carbon\CarbonInterface $current) {
            return '[avui a '.($current->hour !== 1 ? 'les' : 'la').'] LT';
        },
        'nextDay' => function (\Carbon\CarbonInterface $current) {
            return '[demà a '.($current->hour !== 1 ? 'les' : 'la').'] LT';
        },
        'nextWeek' => function (\Carbon\CarbonInterface $current) {
            return 'dddd [a '.($current->hour !== 1 ? 'les' : 'la').'] LT';
        },
        'lastDay' => function (\Carbon\CarbonInterface $current) {
            return '[ahir a '.($current->hour !== 1 ? 'les' : 'la').'] LT';
        },
        'lastWeek' => function (\Carbon\CarbonInterface $current) {
            return '[el] dddd [passat a '.($current->hour !== 1 ? 'les' : 'la').'] LT';
        },
        'sameElse' => 'L',
    ],
    'ordinal' => function ($number, $period) {
        return $number.(
            ($period === 'w' || $period === 'W') ? 'a' : (
                ($number === 1) ? 'r' : (
                    ($number === 2) ? 'n' : (
                        ($number === 3) ? 'r' : (
                            ($number === 4) ? 't' : 'è'
                        )
                    )
                )
            )
        );
    },
    'months' => ['de gener', 'de febrer', 'de març', 'd\'abril', 'de maig', 'de juny', 'de juliol', 'd\'agost', 'de setembre', 'd\'octubre', 'de novembre', 'de desembre'],
    'months_standalone' => ['gener', 'febrer', 'març', 'abril', 'maig', 'juny', 'juliol', 'agost', 'setembre', 'octubre', 'novembre', 'desembre'],
    'months_short' => ['gen.', 'febr.', 'març', 'abr.', 'maig', 'juny', 'jul.', 'ag.', 'set.', 'oct.', 'nov.', 'des.'],
    'months_regexp' => '/D[oD]?[\s,]+MMMM?/',
    'weekdays' => ['diumenge', 'dilluns', 'dimarts', 'dimecres', 'dijous', 'divendres', 'dissabte'],
    'weekdays_short' => ['dg.', 'dl.', 'dt.', 'dc.', 'dj.', 'dv.', 'ds.'],
    'weekdays_min' => ['dg', 'dl', 'dt', 'dc', 'dj', 'dv', 'ds'],
    'first_day_of_week' => 1,
    'day_of_first_week_of_year' => 4,
];
