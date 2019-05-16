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
 * - Kristoffer Snabb
 * - JD Isaacks
 * - Jens Herlevsen
 * - Nightpine
 */
return [
    'year' => ':count år',
    'a_year' => 'ett år|:count år',
    'y' => ':count år',
    'month' => ':count månad|:count månader',
    'a_month' => 'en månad|:count månader',
    'm' => ':count mån.',
    'week' => ':count vecka|:count veckor',
    'a_week' => 'en vecka|:count veckor',
    'w' => ':count v.',
    'day' => ':count dag|:count dagar',
    'a_day' => 'en dag|:count dagar',
    'd' => ':count d.',
    'hour' => ':count timme|:count timmar',
    'a_hour' => 'en timme|:count timmar',
    'h' => ':count t.',
    'minute' => ':count minut|:count minuter',
    'a_minute' => 'en minut|:count minuter',
    'min' => ':count min.',
    'second' => ':count sekund|:count sekunder',
    'a_second' => 'några sekunder|:count sekunder',
    's' => ':count s.',
    'ago' => 'för :time sedan',
    'from_now' => 'om :time',
    'after' => ':time efter',
    'before' => ':time före',
    'diff_yesterday' => 'Igår',
    'diff_tomorrow' => 'Imorgon',
    'formats' => [
        'LT' => 'HH:mm',
        'LTS' => 'HH:mm:ss',
        'L' => 'YYYY-MM-DD',
        'LL' => 'D MMMM YYYY',
        'LLL' => 'D MMMM YYYY [kl.] HH:mm',
        'LLLL' => 'dddd D MMMM YYYY [kl.] HH:mm',
    ],
    'calendar' => [
        'sameDay' => '[Idag] LT',
        'nextDay' => '[Imorgon] LT',
        'nextWeek' => '[På] dddd LT',
        'lastDay' => '[Igår] LT',
        'lastWeek' => '[I] dddd[s] LT',
        'sameElse' => 'L',
    ],
    'ordinal' => function ($number) {
        $lastDigit = $number % 10;

        return $number.(
            (~~($number % 100 / 10) === 1) ? 'e' : (
                ($lastDigit === 1 || $lastDigit === 2) ? 'a' : 'e'
            )
        );
    },
    'months' => ['januari', 'februari', 'mars', 'april', 'maj', 'juni', 'juli', 'augusti', 'september', 'oktober', 'november', 'december'],
    'months_short' => ['jan', 'feb', 'mar', 'apr', 'maj', 'jun', 'jul', 'aug', 'sep', 'okt', 'nov', 'dec'],
    'weekdays' => ['söndag', 'måndag', 'tisdag', 'onsdag', 'torsdag', 'fredag', 'lördag'],
    'weekdays_short' => ['sön', 'mån', 'tis', 'ons', 'tors', 'fre', 'lör'],
    'weekdays_min' => ['sö', 'må', 'ti', 'on', 'to', 'fr', 'lö'],
    'first_day_of_week' => 1,
    'day_of_first_week_of_year' => 4,
    'list' => [', ', ' och '],
    'meridiem' => ['fm', 'em'],
];
