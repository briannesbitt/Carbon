<?php

/*
 * This file is part of the Carbon package.
 *
 * (c) Brian Nesbitt <brian@nesbot.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tests\Localization;

class TlhTest extends LocalizationTestCase
{
    const LOCALE = 'tlh';

    const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        '6 tera’ jar wa’ 2018 00:00',
        // Carbon::now()->subDays(2)->calendar()
        '13 tera’ jar vagh 2018 20:49',
        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'wa’leS 22:00',
        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        'DaHjaj 10:00',
        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'DaHjaj 02:00',
        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        'wa’Hu’ 01:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        '9 tera’ jar wa’ 2018 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        '2 tera’ jar wa’ 2018 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        '5 tera’ jar wa’ 2018 00:00',
        // Carbon::now()->subSeconds(1)->diffForHumans()
        'puS lup ret',
        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        's ret',
        // Carbon::now()->subSeconds(2)->diffForHumans()
        '2 lup ret',
        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        's ret',
        // Carbon::now()->subMinutes(1)->diffForHumans()
        'wa’ tup ret',
        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        'min ret',
        // Carbon::now()->subMinutes(2)->diffForHumans()
        '2 tup ret',
        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        'min ret',
        // Carbon::now()->subHours(1)->diffForHumans()
        'wa’ rep ret',
        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        'h ret',
        // Carbon::now()->subHours(2)->diffForHumans()
        '2 rep ret',
        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        'h ret',
        // Carbon::now()->subDays(1)->diffForHumans()
        'wa’ Hu’',
        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        'd ret',
        // Carbon::now()->subDays(2)->diffForHumans()
        '2 Hu’',
        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        'd ret',
        // Carbon::now()->subWeeks(1)->diffForHumans()
        'wa’ hogh ret',
        // Carbon::now()->subWeeks(1)->diffForHumans(null, false, true)
        'w ret',
        // Carbon::now()->subWeeks(2)->diffForHumans()
        '2 hogh ret',
        // Carbon::now()->subWeeks(2)->diffForHumans(null, false, true)
        'w ret',
        // Carbon::now()->subMonths(1)->diffForHumans()
        'wa’ wen',
        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        'm ret',
        // Carbon::now()->subMonths(2)->diffForHumans()
        '2 wen',
        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        'm ret',
        // Carbon::now()->subYears(1)->diffForHumans()
        'wa’ ben',
        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        'y ret',
        // Carbon::now()->subYears(2)->diffForHumans()
        '2 ben',
        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        'y ret',
        // Carbon::now()->addSecond()->diffForHumans()
        'puS lup pIq',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        's pIq',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now())
        'after',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), false, true)
        'after',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond())
        'before',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond(), false, true)
        'before',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true)
        'puS lup',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true, true)
        's',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        '2 lup',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        's',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        's pIq',
        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        'wa’ tup puS lup',
        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        'y m d s',
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        'wa’ hogh 10 rep',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        'wa’ hogh 6 jaj',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        'wa’ hogh 6 jaj',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        '2 hogh wa’ rep',
    ];
}
