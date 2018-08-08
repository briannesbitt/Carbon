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
    'year' => 'ett år|:count år',
    'y' => ':count år|:count år',
    'month' => 'en månad|:count månader',
    'm' => ':count månad|:count månader',
    'week' => ':count vecka|:count veckor',
    'w' => ':count vecka|:count veckor',
    'day' => 'en dag|:count dagar',
    'd' => ':count dag|:count dagar',
    'hour' => 'en timme|:count timmar',
    'h' => ':count timme|:count timmar',
    'minute' => 'en minut|:count minuter',
    'min' => ':count minut|:count minuter',
    'second' => 'några sekunder|:count sekunder',
    's' => ':count sekund|:count sekunder',
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
    'ordinal' => function ($number, $period) {
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
    'weekdays_short' => ['sön', 'mån', 'tis', 'ons', 'tor', 'fre', 'lör'],
    'weekdays_min' => ['sö', 'må', 'ti', 'on', 'to', 'fr', 'lö'],
    'first_day_of_week' => 1,
    'day_of_first_week_of_year' => 4,
];
