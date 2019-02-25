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
 * - Josh Soref
 * - JD Isaacks
 * - Cătălin Georgescu
 */
return [
    'year' => ':count an|:count ani|:count ani',
    'a_year' => 'un an|:count ani|:count ani',
    'y' => ':count a.',
    'month' => ':count lună|:count luni|:count luni',
    'a_month' => 'o lună|:count luni|:count luni',
    'm' => ':count l.',
    'week' => ':count săptămână|:count săptămâni|:count săptămâni',
    'a_week' => 'o săptămână|:count săptămâni|:count săptămâni',
    'w' => ':count săp.',
    'day' => ':count zi|:count zile|:count zile',
    'a_day' => 'o zi|:count zile|:count zile',
    'd' => ':count z.',
    'hour' => ':count oră|:count ore|:count ore',
    'a_hour' => 'o oră|:count ore|:count ore',
    'h' => ':count o.',
    'minute' => ':count minut|:count minute|:count minute',
    'a_minute' => 'un minut|:count minute|:count minute',
    'min' => ':count m.',
    'second' => ':count secundă|:count secunde|:count secunde',
    'a_second' => 'o secundă|:count secunde|:count secunde',
    's' => 'o sec.',
    'ago' => ':time în urmă',
    'from_now' => 'peste :time',
    'after' => 'peste :time',
    'before' => 'acum :time',
    'diff_yesterday' => 'ieri',
    'diff_tomorrow' => 'mâine',
    'formats' => [
        'LT' => 'H:mm',
        'LTS' => 'H:mm:ss',
        'L' => 'DD.MM.YYYY',
        'LL' => 'D MMMM YYYY',
        'LLL' => 'D MMMM YYYY H:mm',
        'LLLL' => 'dddd, D MMMM YYYY H:mm',
    ],
    'calendar' => [
        'sameDay' => '[azi la] LT',
        'nextDay' => '[mâine la] LT',
        'nextWeek' => 'dddd [la] LT',
        'lastDay' => '[ieri la] LT',
        'lastWeek' => '[fosta] dddd [la] LT',
        'sameElse' => 'L',
    ],
    'months' => ['ianuarie', 'februarie', 'martie', 'aprilie', 'mai', 'iunie', 'iulie', 'august', 'septembrie', 'octombrie', 'noiembrie', 'decembrie'],
    'months_short' => ['ian.', 'febr.', 'mart.', 'apr.', 'mai', 'iun.', 'iul.', 'aug.', 'sept.', 'oct.', 'nov.', 'dec.'],
    'weekdays' => ['duminică', 'luni', 'marți', 'miercuri', 'joi', 'vineri', 'sâmbătă'],
    'weekdays_short' => ['Dum', 'Lun', 'Mar', 'Mie', 'Joi', 'Vin', 'Sâm'],
    'weekdays_min' => ['Du', 'Lu', 'Ma', 'Mi', 'Jo', 'Vi', 'Sâ'],
    'first_day_of_week' => 1,
    'day_of_first_week_of_year' => 1,
    'list' => [', ', ' și '],
];
