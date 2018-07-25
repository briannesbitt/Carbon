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

class SwTest extends LocalizationTestCase
{
    const LOCALE = 'sw'; // Swahili

    const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'wiki iliyopita Jumamosi saat 00:00',
        // Carbon::now()->subDays(2)->calendar()
        'wiki ijayo Jumapili saat 20:49',
        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'kesho saa 22:00',
        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        'leo saa 10:00',
        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'leo saa 02:00',
        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        'jana 01:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'wiki iliyopita Jumanne saat 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'wiki ijayo Jumanne saat 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'wiki ijayo Ijumaa saat 00:00',
        // Carbon::parse('2018-01-01 00:00:00')->isoFormat('Do wo')
        'ordinal ordinal',
        // Carbon::parse('2018-01-02 00:00:00')->isoFormat('Do wo')
        'ordinal ordinal',
        // Carbon::parse('2018-01-03 00:00:00')->isoFormat('Do wo')
        'ordinal ordinal',
        // Carbon::parse('2018-01-04 00:00:00')->isoFormat('Do wo')
        'ordinal ordinal',
        // Carbon::parse('2018-01-05 00:00:00')->isoFormat('Do wo')
        'ordinal ordinal',
        // Carbon::parse('2018-01-06 00:00:00')->isoFormat('Do wo')
        'ordinal ordinal',
        // Carbon::parse('2018-01-07 00:00:00')->isoFormat('Do wo')
        'ordinal ordinal',
        // Carbon::parse('2018-01-11 00:00:00')->isoFormat('Do wo')
        'ordinal ordinal',
        // Carbon::parse('2018-02-09 00:00:00')->isoFormat('DDDo')
        'ordinal',
        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('DDDo')
        'ordinal',
        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 AM, 12:00 am',
        // Carbon::parse('2018-02-10 01:30:00')->isoFormat('h:mm A, h:mm a')
        '1:30 AM, 1:30 am',
        // Carbon::parse('2018-02-10 02:00:00')->isoFormat('h:mm A, h:mm a')
        '2:00 AM, 2:00 am',
        // Carbon::parse('2018-02-10 06:00:00')->isoFormat('h:mm A, h:mm a')
        '6:00 AM, 6:00 am',
        // Carbon::parse('2018-02-10 10:00:00')->isoFormat('h:mm A, h:mm a')
        '10:00 AM, 10:00 am',
        // Carbon::parse('2018-02-10 12:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 PM, 12:00 pm',
        // Carbon::parse('2018-02-10 17:00:00')->isoFormat('h:mm A, h:mm a')
        '5:00 PM, 5:00 pm',
        // Carbon::parse('2018-02-10 23:00:00')->isoFormat('h:mm A, h:mm a')
        '11:00 PM, 11:00 pm',
        // Carbon::now()->subSeconds(1)->diffForHumans()
        'tokea hivi punde',
        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        'tokea sekunde 1',
        // Carbon::now()->subSeconds(2)->diffForHumans()
        'tokea sekunde 2',
        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        'tokea sekunde 2',
        // Carbon::now()->subMinutes(1)->diffForHumans()
        'tokea dakika moja',
        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        'tokea dakika 1',
        // Carbon::now()->subMinutes(2)->diffForHumans()
        'tokea dakika 2',
        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        'tokea dakika 2',
        // Carbon::now()->subHours(1)->diffForHumans()
        'tokea saa limoja',
        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        'tokea saa 1',
        // Carbon::now()->subHours(2)->diffForHumans()
        'tokea masaa 2',
        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        'tokea masaa 2',
        // Carbon::now()->subDays(1)->diffForHumans()
        'tokea siku moja',
        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        'tokea siku 1',
        // Carbon::now()->subDays(2)->diffForHumans()
        'tokea masiku 2',
        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        'tokea siku 2',
        // Carbon::now()->subWeeks(1)->diffForHumans()
        'tokea wiki 1',
        // Carbon::now()->subWeeks(1)->diffForHumans(null, false, true)
        'tokea wiki 1',
        // Carbon::now()->subWeeks(2)->diffForHumans()
        'tokea wiki 2',
        // Carbon::now()->subWeeks(2)->diffForHumans(null, false, true)
        'tokea wiki 2',
        // Carbon::now()->subMonths(1)->diffForHumans()
        'tokea mwezi mmoja',
        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        'tokea mwezi 1',
        // Carbon::now()->subMonths(2)->diffForHumans()
        'tokea miezi 2',
        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        'tokea miezi 2',
        // Carbon::now()->subYears(1)->diffForHumans()
        'tokea mwaka mmoja',
        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        'tokea mwaka 1',
        // Carbon::now()->subYears(2)->diffForHumans()
        'tokea miaka 2',
        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        'tokea miaka 2',
        // Carbon::now()->addSecond()->diffForHumans()
        'hivi punde baadaye',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        'sekunde 1 baadaye',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now())
        'hivi punde baada',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), false, true)
        'sekunde 1 baada',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond())
        'hivi punde kabla',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond(), false, true)
        'sekunde 1 kabla',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true)
        'hivi punde',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true, true)
        'sekunde 1',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        'sekunde 2',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        'sekunde 2',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        'sekunde 1 baadaye',
        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        'dakika moja hivi punde',
        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        'miaka 2 miezi 3 siku 1 sekunde 1',
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        'wiki 1 masaa 10',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        'wiki 1 masiku 6',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        'wiki 1 masiku 6',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        'wiki 2 saa limoja',
    ];
}
