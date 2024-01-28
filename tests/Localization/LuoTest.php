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
class LuoTest extends LocalizationTestCase
{
    public const LOCALE = 'luo'; // Luo

    public const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Tomorrow at 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Ngeso at 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Jumapil at 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Wuok Tich at 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Tich Ariyo at 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Tich Adek at 00:00',
        // Carbon::parse('2018-01-05 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-05 00:00:00'))
        'Tich Ang’wen at 00:00',
        // Carbon::parse('2018-01-06 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-06 00:00:00'))
        'Tich Abich at 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Tich Ariyo at 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Tich Adek at 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Tich Ang’wen at 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Tich Abich at 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Ngeso at 00:00',
        // Carbon::now()->subDays(2)->calendar()
        'Last Jumapil at 20:49',
        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Yesterday at 22:00',
        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        'Today at 10:00',
        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Today at 02:00',
        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        'Tomorrow at 01:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Tich Ariyo at 00:00',
        // Carbon::parse('2018-01-08 00:00:00')->subDay()->calendar(Carbon::parse('2018-01-08 00:00:00'))
        'Yesterday at 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Yesterday at 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last Tich Ariyo at 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last Wuok Tich at 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last Jumapil at 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last Ngeso at 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last Tich Abich at 00:00',
        // Carbon::parse('2018-01-03 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-03 00:00:00'))
        'Last Tich Ang’wen at 00:00',
        // Carbon::parse('2018-01-02 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-02 00:00:00'))
        'Last Tich Adek at 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Last Tich Abich at 00:00',
        // Carbon::parse('2018-01-01 00:00:00')->isoFormat('Qo Mo Do Wo wo')
        '1st 1st 1st 1st 1st',
        // Carbon::parse('2018-01-02 00:00:00')->isoFormat('Do wo')
        '2nd 1st',
        // Carbon::parse('2018-01-03 00:00:00')->isoFormat('Do wo')
        '3rd 1st',
        // Carbon::parse('2018-01-04 00:00:00')->isoFormat('Do wo')
        '4th 1st',
        // Carbon::parse('2018-01-05 00:00:00')->isoFormat('Do wo')
        '5th 1st',
        // Carbon::parse('2018-01-06 00:00:00')->isoFormat('Do wo')
        '6th 1st',
        // Carbon::parse('2018-01-07 00:00:00')->isoFormat('Do wo')
        '7th 2nd',
        // Carbon::parse('2018-01-11 00:00:00')->isoFormat('Do wo')
        '11th 2nd',
        // Carbon::parse('2018-02-09 00:00:00')->isoFormat('DDDo')
        '40th',
        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('DDDo')
        '41st',
        // Carbon::parse('2018-04-10 00:00:00')->isoFormat('DDDo')
        '100th',
        // Carbon::parse('2018-02-10 00:00:00', 'Europe/Paris')->isoFormat('h:mm a z')
        '12:00 od CET',
        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 OD, 12:00 od',
        // Carbon::parse('2018-02-10 01:30:00')->isoFormat('h:mm A, h:mm a')
        '1:30 OD, 1:30 od',
        // Carbon::parse('2018-02-10 02:00:00')->isoFormat('h:mm A, h:mm a')
        '2:00 OD, 2:00 od',
        // Carbon::parse('2018-02-10 06:00:00')->isoFormat('h:mm A, h:mm a')
        '6:00 OD, 6:00 od',
        // Carbon::parse('2018-02-10 10:00:00')->isoFormat('h:mm A, h:mm a')
        '10:00 OD, 10:00 od',
        // Carbon::parse('2018-02-10 12:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 OT, 12:00 ot',
        // Carbon::parse('2018-02-10 17:00:00')->isoFormat('h:mm A, h:mm a')
        '5:00 OT, 5:00 ot',
        // Carbon::parse('2018-02-10 21:30:00')->isoFormat('h:mm A, h:mm a')
        '9:30 OT, 9:30 ot',
        // Carbon::parse('2018-02-10 23:00:00')->isoFormat('h:mm A, h:mm a')
        '11:00 OT, 11:00 ot',
        // Carbon::parse('2018-01-01 00:00:00')->ordinal('hour')
        '0th',
        // Carbon::now()->subSeconds(1)->diffForHumans()
        'nus dakika 1 ago',
        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        'nus dakika 1 ago',
        // Carbon::now()->subSeconds(2)->diffForHumans()
        'nus dakika 2 ago',
        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        'nus dakika 2 ago',
        // Carbon::now()->subMinutes(1)->diffForHumans()
        'dakika 1 ago',
        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        'dakika 1 ago',
        // Carbon::now()->subMinutes(2)->diffForHumans()
        'dakika 2 ago',
        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        'dakika 2 ago',
        // Carbon::now()->subHours(1)->diffForHumans()
        'seche 1 ago',
        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        'seche 1 ago',
        // Carbon::now()->subHours(2)->diffForHumans()
        'seche 2 ago',
        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        'seche 2 ago',
        // Carbon::now()->subDays(1)->diffForHumans()
        'ndalo 1 ago',
        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        'ndalo 1 ago',
        // Carbon::now()->subDays(2)->diffForHumans()
        'ndalo 2 ago',
        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        'ndalo 2 ago',
        // Carbon::now()->subWeeks(1)->diffForHumans()
        'jumbe 1 ago',
        // Carbon::now()->subWeeks(1)->diffForHumans(null, false, true)
        'jumbe 1 ago',
        // Carbon::now()->subWeeks(2)->diffForHumans()
        'jumbe 2 ago',
        // Carbon::now()->subWeeks(2)->diffForHumans(null, false, true)
        'jumbe 2 ago',
        // Carbon::now()->subMonths(1)->diffForHumans()
        'dweche 1 ago',
        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        'dweche 1 ago',
        // Carbon::now()->subMonths(2)->diffForHumans()
        'dweche 2 ago',
        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        'dweche 2 ago',
        // Carbon::now()->subYears(1)->diffForHumans()
        'higni 1 ago',
        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        'higni 1 ago',
        // Carbon::now()->subYears(2)->diffForHumans()
        'higni 2 ago',
        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        'higni 2 ago',
        // Carbon::now()->addSecond()->diffForHumans()
        'nus dakika 1 from now',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        'nus dakika 1 from now',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now())
        'nus dakika 1 after',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), false, true)
        'nus dakika 1 after',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond())
        'nus dakika 1 before',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond(), false, true)
        'nus dakika 1 before',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true)
        'nus dakika 1',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true, true)
        'nus dakika 1',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        'nus dakika 2',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        'nus dakika 2',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        'nus dakika 1 from now',
        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        'dakika 1 nus dakika 1',
        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        'higni 2 dweche 3 ndalo 1 nus dakika 1',
        // Carbon::now()->addYears(3)->diffForHumans(null, null, false, 4)
        'higni 3 from now',
        // Carbon::now()->subMonths(5)->diffForHumans(null, null, true, 4)
        'dweche 5 ago',
        // Carbon::now()->subYears(2)->subMonths(3)->subDay()->subSecond()->diffForHumans(null, null, true, 4)
        'higni 2 dweche 3 ndalo 1 nus dakika 1 ago',
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        'jumbe 1 seche 10',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        'jumbe 1 ndalo 6',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        'jumbe 1 ndalo 6',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(["join" => true, "parts" => 2])
        'jumbe 1 and ndalo 6 from now',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        'jumbe 2 seche 1',
        // Carbon::now()->addHour()->diffForHumans(["aUnit" => true])
        'seche 1 from now',
        // CarbonInterval::days(2)->forHumans()
        'ndalo 2',
        // CarbonInterval::create('P1DT3H')->forHumans(true)
        'ndalo 1 seche 3',
    ];
}
