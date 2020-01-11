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
 * - Danish Standards Association    bug-glibc-locales@gnu.org
 */
return array_replace_recursive(require __DIR__.'/en.php', [
    'formats' => [
        'L' => 'MMM DD YYYY',
    ],
    'months' => ['januaarip', 'februaarip', 'marsip', 'apriilip', 'maajip', 'juunip', 'juulip', 'aggustip', 'septembarip', 'oktobarip', 'novembarip', 'decembarip'],
    'months_short' => ['jan', 'feb', 'mar', 'apr', 'maj', 'jun', 'jul', 'aug', 'sep', 'okt', 'nov', 'dec'],
    'weekdays' => ['sapaat', 'ataasinngorneq', 'marlunngorneq', 'pingasunngorneq', 'sisamanngorneq', 'tallimanngorneq', 'arfininngorneq'],
    'weekdays_short' => ['sap', 'ata', 'mar', 'pin', 'sis', 'tal', 'arf'],
    'weekdays_min' => ['sap', 'ata', 'mar', 'pin', 'sis', 'tal', 'arf'],
    'first_day_of_week' => 1,
    'day_of_first_week_of_year' => 1,

    'year' => ':count ukioq', // less reliable
    'y' => ':count ukioq', // less reliable
    'a_year' => ':count ukioq', // less reliable

    'month' => ':count Ukiup qaammatai',
    'm' => ':count Ukiup qaammatai',
    'a_month' => ':count Ukiup qaammatai',

    'week' => ':count sapaat', // less reliable
    'w' => ':count sapaat', // less reliable
    'a_week' => ':count sapaat', // less reliable

    'day' => ':count ulloq',
    'd' => ':count ulloq',
    'a_day' => ':count ulloq',

    'hour' => ':count akunneq',
    'h' => ':count akunneq',
    'a_hour' => ':count akunneq',

    'minute' => ':count eqqumiitsuliorneq', // less reliable
    'min' => ':count eqqumiitsuliorneq', // less reliable
    'a_minute' => ':count eqqumiitsuliorneq', // less reliable

    'second' => ':count marluk', // less reliable
    's' => ':count marluk', // less reliable
    'a_second' => ':count marluk', // less reliable
]);
