<?php

declare(strict_types=1);

/**
 * This file is part of the Carbon package.
 *
 * (c) Brian Nesbitt <brian@nesbot.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tests\Localization;

use PHPUnit\Framework\Attributes\Group;

#[Group('localization')]
class SwUgTest extends LocalizationTestCase
{
    public const LOCALE = 'sw_UG'; // Swahili

    public const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'kesho saa 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'wiki ijayo Jumamosi saat 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'wiki ijayo Jumapili saat 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'wiki ijayo Jumatatu saat 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'wiki ijayo Jumanne saat 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'wiki ijayo Jumatano saat 00:00',
        // Carbon::parse('2018-01-05 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-05 00:00:00'))
        'wiki ijayo Alhamisi saat 00:00',
        // Carbon::parse('2018-01-06 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-06 00:00:00'))
        'wiki ijayo Ijumaa saat 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'wiki ijayo Jumanne saat 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'wiki ijayo Jumatano saat 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'wiki ijayo Alhamisi saat 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'wiki ijayo Ijumaa saat 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'wiki ijayo Jumamosi saat 00:00',
        // Carbon::now()->subDays(2)->calendar()
        'wiki iliyopita Jumapili saat 20:49',
        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'jana 22:00',
        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        'leo saa 10:00',
        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'leo saa 02:00',
        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        'kesho saa 01:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'wiki ijayo Jumanne saat 00:00',
        // Carbon::parse('2018-01-08 00:00:00')->subDay()->calendar(Carbon::parse('2018-01-08 00:00:00'))
        'jana 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'jana 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'wiki iliyopita Jumanne saat 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'wiki iliyopita Jumatatu saat 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'wiki iliyopita Jumapili saat 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'wiki iliyopita Jumamosi saat 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'wiki iliyopita Ijumaa saat 00:00',
        // Carbon::parse('2018-01-03 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-03 00:00:00'))
        'wiki iliyopita Alhamisi saat 00:00',
        // Carbon::parse('2018-01-02 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-02 00:00:00'))
        'wiki iliyopita Jumatano saat 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'wiki iliyopita Ijumaa saat 00:00',
        // Carbon::parse('2018-01-01 00:00:00')->isoFormat('Qo Mo Do Wo wo')
        '1 1 1 1 1',
        // Carbon::parse('2018-01-02 00:00:00')->isoFormat('Do wo')
        '2 1',
        // Carbon::parse('2018-01-03 00:00:00')->isoFormat('Do wo')
        '3 1',
        // Carbon::parse('2018-01-04 00:00:00')->isoFormat('Do wo')
        '4 1',
        // Carbon::parse('2018-01-05 00:00:00')->isoFormat('Do wo')
        '5 1',
        // Carbon::parse('2018-01-06 00:00:00')->isoFormat('Do wo')
        '6 1',
        // Carbon::parse('2018-01-07 00:00:00')->isoFormat('Do wo')
        '7 1',
        // Carbon::parse('2018-01-11 00:00:00')->isoFormat('Do wo')
        '11 2',
        // Carbon::parse('2018-02-09 00:00:00')->isoFormat('DDDo')
        '40',
        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('DDDo')
        '41',
        // Carbon::parse('2018-04-10 00:00:00')->isoFormat('DDDo')
        '100',
        // Carbon::parse('2018-02-10 00:00:00', 'Europe/Paris')->isoFormat('h:mm a z')
        '12:00 am CET',
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
        // Carbon::parse('2018-02-10 21:30:00')->isoFormat('h:mm A, h:mm a')
        '9:30 PM, 9:30 pm',
        // Carbon::parse('2018-02-10 23:00:00')->isoFormat('h:mm A, h:mm a')
        '11:00 PM, 11:00 pm',
        // Carbon::parse('2018-01-01 00:00:00')->ordinal('hour')
        '0',
        // Carbon::now()->subSeconds(1)->diffForHumans()
        'tokea sekunde 1',
        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        'tokea se. 1',
        // Carbon::now()->subSeconds(2)->diffForHumans()
        'tokea sekunde 2',
        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        'tokea se. 2',
        // Carbon::now()->subMinutes(1)->diffForHumans()
        'tokea dakika 1',
        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        'tokea d. 1',
        // Carbon::now()->subMinutes(2)->diffForHumans()
        'tokea dakika 2',
        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        'tokea d. 2',
        // Carbon::now()->subHours(1)->diffForHumans()
        'tokea saa 1',
        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        'tokea saa 1',
        // Carbon::now()->subHours(2)->diffForHumans()
        'tokea masaa 2',
        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        'tokea masaa 2',
        // Carbon::now()->subDays(1)->diffForHumans()
        'tokea siku 1',
        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        'tokea si. 1',
        // Carbon::now()->subDays(2)->diffForHumans()
        'tokea siku 2',
        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        'tokea si. 2',
        // Carbon::now()->subWeeks(1)->diffForHumans()
        'tokea wiki 1',
        // Carbon::now()->subWeeks(1)->diffForHumans(null, false, true)
        'tokea w. 1',
        // Carbon::now()->subWeeks(2)->diffForHumans()
        'tokea wiki 2',
        // Carbon::now()->subWeeks(2)->diffForHumans(null, false, true)
        'tokea w. 2',
        // Carbon::now()->subMonths(1)->diffForHumans()
        'tokea mwezi 1',
        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        'tokea mwezi 1',
        // Carbon::now()->subMonths(2)->diffForHumans()
        'tokea miezi 2',
        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        'tokea miezi 2',
        // Carbon::now()->subYears(1)->diffForHumans()
        'tokea mwaka 1',
        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        'tokea mwaka 1',
        // Carbon::now()->subYears(2)->diffForHumans()
        'tokea miaka 2',
        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        'tokea miaka 2',
        // Carbon::now()->addSecond()->diffForHumans()
        'sekunde 1 baadaye',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        'se. 1 baadaye',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now())
        'sekunde 1 baada',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), false, true)
        'se. 1 baada',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond())
        'sekunde 1 kabla',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond(), false, true)
        'se. 1 kabla',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true)
        'sekunde 1',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true, true)
        'se. 1',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        'sekunde 2',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        'se. 2',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        'se. 1 baadaye',
        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        'dakika 1 sekunde 1',
        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        'miaka 2 miezi 3 si. 1 se. 1',
        // Carbon::now()->addYears(3)->diffForHumans(null, null, false, 4)
        'miaka 3 baadaye',
        // Carbon::now()->subMonths(5)->diffForHumans(null, null, true, 4)
        'tokea miezi 5',
        // Carbon::now()->subYears(2)->subMonths(3)->subDay()->subSecond()->diffForHumans(null, null, true, 4)
        'tokea miaka 2 miezi 3 si. 1 se. 1',
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        'wiki 1 masaa 10',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        'wiki 1 siku 6',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        'wiki 1 siku 6',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(["join" => true, "parts" => 2])
        'wiki 1 na siku 6 baadaye',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        'wiki 2 saa 1',
        // Carbon::now()->addHour()->diffForHumans(["aUnit" => true])
        'saa limoja baadaye',
        // CarbonInterval::days(2)->forHumans()
        'siku 2',
        // CarbonInterval::create('P1DT3H')->forHumans(true)
        'si. 1 masaa 3',
    ];
}
