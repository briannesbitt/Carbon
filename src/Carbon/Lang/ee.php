<?php

/**
 * This file is part of the Carbon package.
 *
 * (c) Brian Nesbitt <brian@nesbot.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

return array_replace_recursive(require __DIR__.'/en.php', [
    'meridiem' => ['ŋ', 'ɣ'],
    'weekdays' => ['kɔsiɖa', 'dzoɖa', 'blaɖa', 'kuɖa', 'yawoɖa', 'fiɖa', 'memleɖa'],
    'weekdays_short' => ['kɔs', 'dzo', 'bla', 'kuɖ', 'yaw', 'fiɖ', 'mem'],
    'weekdays_min' => ['kɔs', 'dzo', 'bla', 'kuɖ', 'yaw', 'fiɖ', 'mem'],
    'months' => ['dzove', 'dzodze', 'tedoxe', 'afɔfĩe', 'dama', 'masa', 'siamlɔm', 'deasiamime', 'anyɔnyɔ', 'kele', 'adeɛmekpɔxe', 'dzome'],
    'months_short' => ['dzv', 'dzd', 'ted', 'afɔ', 'dam', 'mas', 'sia', 'dea', 'any', 'kel', 'ade', 'dzm'],
    'first_day_of_week' => 1,
    'formats' => [
        'LT' => 'a [ga] h:mm',
        'LTS' => 'a [ga] h:mm:ss',
        'L' => 'M/D/YYYY',
        'LL' => 'MMM D [lia], YYYY',
        'LLL' => 'a [ga] h:mm MMMM D [lia] YYYY',
        'LLLL' => 'a [ga] h:mm dddd, MMMM D [lia] YYYY',
    ],
]);
