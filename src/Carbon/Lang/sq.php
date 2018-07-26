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
    'year' => 'një vit|:count vite',
    'y' => ':count vit|:count vjet',
    'month' => 'një muaj|:count muaj',
    'm' => ':count muaj|:count muaj',
    'week' => ':count javë|:count javë',
    'w' => ':count javë|:count javë',
    'day' => 'një ditë|:count ditë',
    'd' => ':count ditë|:count ditë',
    'hour' => 'një orë|:count orë',
    'h' => ':count orë|:count orë',
    'minute' => 'një minutë|:count minuta',
    'min' => ':count minutë|:count minuta',
    'second' => 'disa sekonda|:count sekonda',
    's' => ':count sekondë|:count sekonda',
    'ago' => ':time më parë',
    'from_now' => 'në :time',
    'after' => ':time pas',
    'before' => ':time para',
    'formats' => [
        'LT' => 'HH:mm',
        'LTS' => 'HH:mm:ss',
        'L' => 'DD/MM/YYYY',
        'LL' => 'D MMMM YYYY',
        'LLL' => 'D MMMM YYYY HH:mm',
        'LLLL' => 'dddd, D MMMM YYYY HH:mm',
    ],
    'calendar' => [
        'sameDay' => '[Sot në] LT',
        'nextDay' => '[Nesër në] LT',
        'nextWeek' => 'dddd [në] LT',
        'lastDay' => '[Dje në] LT',
        'lastWeek' => 'dddd [e kaluar në] LT',
        'sameElse' => 'L',
    ],
    'ordinal' => ':number.',
    'meridiem' => function ($hour, $minute, $isLower) {
        $meridiem = $hour < 12 ? 'PD' : 'MD';

        return $isLower ? strtolower($meridiem) : $meridiem;
    },
    'months' => ['Janar', 'Shkurt', 'Mars', 'Prill', 'Maj', 'Qershor', 'Korrik', 'Gusht', 'Shtator', 'Tetor', 'Nëntor', 'Dhjetor'],
    'months_short' => ['Jan', 'Shk', 'Mar', 'Pri', 'Maj', 'Qer', 'Kor', 'Gus', 'Sht', 'Tet', 'Nën', 'Dhj'],
    'weekdays' => ['E Diel', 'E Hënë', 'E Martë', 'E Mërkurë', 'E Enjte', 'E Premte', 'E Shtunë'],
    'weekdays_short' => ['Die', 'Hën', 'Mar', 'Mër', 'Enj', 'Pre', 'Sht'],
    'weekdays_min' => ['D', 'H', 'Ma', 'Më', 'E', 'P', 'Sh'],
    'first_day_of_week' => 1,
    'day_of_first_week_of_year' => 4,
];
