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
    'month' => 'en måned|:count måneder',
    'week' => ':count uke|:count uker',
    'day' => 'en dag|:count dager',
    'hour' => 'en time|:count timer',
    'minute' => 'ett minutt|:count minutter',
    'second' => 'noen sekunder|:count sekunder',
    'ago' => ':time siden',
    'from_now' => 'om :time',
    'formats' => [
        'LT' => 'HH:mm',
        'LTS' => 'HH:mm:ss',
        'L' => 'DD.MM.YYYY',
        'LL' => 'D. MMMM YYYY',
        'LLL' => 'D. MMMM YYYY [kl.] HH:mm',
        'LLLL' => 'dddd D. MMMM YYYY [kl.] HH:mm',
    ],
    'calendar' => [
        'sameDay' => '[i dag kl.] LT',
        'nextDay' => '[i morgen kl.] LT',
        'nextWeek' => 'dddd [kl.] LT',
        'lastDay' => '[i går kl.] LT',
        'lastWeek' => '[forrige] dddd [kl.] LT',
        'sameElse' => 'L',
    ],
    'ordinal' => ':number.',
    'months' => ['januar', 'februar', 'mars', 'april', 'mai', 'juni', 'juli', 'august', 'september', 'oktober', 'november', 'desember'],
    'months_short' => ['jan.', 'feb.', 'mars', 'april', 'mai', 'juni', 'juli', 'aug.', 'sep.', 'okt.', 'nov.', 'des.'],
    'weekdays' => ['søndag', 'mandag', 'tirsdag', 'onsdag', 'torsdag', 'fredag', 'lørdag'],
    'weekdays_short' => ['sø.', 'ma.', 'ti.', 'on.', 'to.', 'fr.', 'lø.'],
    'weekdays_min' => ['sø', 'ma', 'ti', 'on', 'to', 'fr', 'lø'],
    'first_day_of_week' => 1,
    'day_of_first_week_of_year' => 4,
];
