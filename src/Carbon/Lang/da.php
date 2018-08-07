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
    'year' => 'et år|:count år',
    'y' => ':count år|:count år',
    'month' => 'en måned|:count måneder',
    'm' => ':count måned|:count måneder',
    'week' => ':count uge|:count uger',
    'w' => ':count uge|:count uger',
    'day' => 'en dag|:count dage',
    'd' => ':count dag|:count dage',
    'hour' => 'en time|:count timer',
    'h' => ':count time|:count timer',
    'minute' => 'et minut|:count minutter',
    'min' => ':count minut|:count minutter',
    'second' => 'få sekunder|:count sekunder',
    's' => ':count sekund|:count sekunder',
    'ago' => ':time siden',
    'from_now' => 'om :time',
    'after' => ':time efter',
    'before' => ':time før',
    'formats' => [
        'LT' => 'HH:mm',
        'LTS' => 'HH:mm:ss',
        'L' => 'DD.MM.YYYY',
        'LL' => 'D. MMMM YYYY',
        'LLL' => 'D. MMMM YYYY HH:mm',
        'LLLL' => 'dddd [d.] D. MMMM YYYY [kl.] HH:mm',
    ],
    'calendar' => [
        'sameDay' => '[i dag kl.] LT',
        'nextDay' => '[i morgen kl.] LT',
        'nextWeek' => 'på dddd [kl.] LT',
        'lastDay' => '[i går kl.] LT',
        'lastWeek' => '[i] dddd[s kl.] LT',
        'sameElse' => 'L',
    ],
    'ordinal' => ':number.',
    'months' => ['januar', 'februar', 'marts', 'april', 'maj', 'juni', 'juli', 'august', 'september', 'oktober', 'november', 'december'],
    'months_short' => ['jan', 'feb', 'mar', 'apr', 'maj', 'jun', 'jul', 'aug', 'sep', 'okt', 'nov', 'dec'],
    'weekdays' => ['søndag', 'mandag', 'tirsdag', 'onsdag', 'torsdag', 'fredag', 'lørdag'],
    'weekdays_short' => ['søn', 'man', 'tir', 'ons', 'tor', 'fre', 'lør'],
    'weekdays_min' => ['sø', 'ma', 'ti', 'on', 'to', 'fr', 'lø'],
    'first_day_of_week' => 1,
    'day_of_first_week_of_year' => 4,
];
