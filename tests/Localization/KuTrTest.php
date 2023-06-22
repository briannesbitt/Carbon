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

/**
 * @group localization
 */
class KuTrTest extends LocalizationTestCase
{
    public const LOCALE = 'ku_TR'; // Kurdish

    public const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Tomorrow at 12:00 AM',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'şemî at 12:00 AM',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'yekşem at 12:00 AM',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'duşem at 12:00 AM',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'sêşem at 12:00 AM',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'çarşem at 12:00 AM',
        // Carbon::parse('2018-01-05 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-05 00:00:00'))
        'pêncşem at 12:00 AM',
        // Carbon::parse('2018-01-06 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-06 00:00:00'))
        'în at 12:00 AM',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'sêşem at 12:00 AM',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'çarşem at 12:00 AM',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'pêncşem at 12:00 AM',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'în at 12:00 AM',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'şemî at 12:00 AM',
        // Carbon::now()->subDays(2)->calendar()
        'Last yekşem at 8:49 PM',
        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Yesterday at 10:00 PM',
        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        'Today at 10:00 AM',
        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Today at 2:00 AM',
        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        'Tomorrow at 1:00 AM',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'sêşem at 12:00 AM',
        // Carbon::parse('2018-01-08 00:00:00')->subDay()->calendar(Carbon::parse('2018-01-08 00:00:00'))
        'Yesterday at 12:00 AM',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Yesterday at 12:00 AM',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last sêşem at 12:00 AM',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last duşem at 12:00 AM',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last yekşem at 12:00 AM',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last şemî at 12:00 AM',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last în at 12:00 AM',
        // Carbon::parse('2018-01-03 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-03 00:00:00'))
        'Last pêncşem at 12:00 AM',
        // Carbon::parse('2018-01-02 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-02 00:00:00'))
        'Last çarşem at 12:00 AM',
        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Last în at 12:00 AM',
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
        '6 2',
        // Carbon::parse('2018-01-07 00:00:00')->isoFormat('Do wo')
        '7 2',
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
        'berî 1 saniye',
        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        'berî 1 saniye',
        // Carbon::now()->subSeconds(2)->diffForHumans()
        'berî 2 saniye',
        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        'berî 2 saniye',
        // Carbon::now()->subMinutes(1)->diffForHumans()
        'berî 1 deqîqe',
        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        'berî 1 deqîqe',
        // Carbon::now()->subMinutes(2)->diffForHumans()
        'berî 2 deqîqe',
        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        'berî 2 deqîqe',
        // Carbon::now()->subHours(1)->diffForHumans()
        'berî 1 saet',
        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        'berî 1 saet',
        // Carbon::now()->subHours(2)->diffForHumans()
        'berî 2 saet',
        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        'berî 2 saet',
        // Carbon::now()->subDays(1)->diffForHumans()
        'berî 1 roj',
        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        'berî 1 roj',
        // Carbon::now()->subDays(2)->diffForHumans()
        'berî 2 roj',
        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        'berî 2 roj',
        // Carbon::now()->subWeeks(1)->diffForHumans()
        'berî 1 hefte',
        // Carbon::now()->subWeeks(1)->diffForHumans(null, false, true)
        'berî 1 hefte',
        // Carbon::now()->subWeeks(2)->diffForHumans()
        'berî 2 hefte',
        // Carbon::now()->subWeeks(2)->diffForHumans(null, false, true)
        'berî 2 hefte',
        // Carbon::now()->subMonths(1)->diffForHumans()
        'berî 1 meh',
        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        'berî 1 meh',
        // Carbon::now()->subMonths(2)->diffForHumans()
        'berî 2 meh',
        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        'berî 2 meh',
        // Carbon::now()->subYears(1)->diffForHumans()
        'berî 1 salê',
        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        'berî 1 salê',
        // Carbon::now()->subYears(2)->diffForHumans()
        'berî 2 salan',
        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        'berî 2 salan',
        // Carbon::now()->addSecond()->diffForHumans()
        'di 1 saniye de',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        'di 1 saniye de',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now())
        '1 saniye piştî',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), false, true)
        '1 saniye piştî',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond())
        '1 saniye berê',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond(), false, true)
        '1 saniye berê',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true)
        '1 saniye',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true, true)
        '1 saniye',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        '2 saniye',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        '2 saniye',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        'di 1 saniye de',
        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        '1 deqîqe 1 saniye',
        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        '2 sal 3 meh 1 roj 1 saniye',
        // Carbon::now()->addYears(3)->diffForHumans(null, null, false, 4)
        'di 3 salan de',
        // Carbon::now()->subMonths(5)->diffForHumans(null, null, true, 4)
        'berî 5 meh',
        // Carbon::now()->subYears(2)->subMonths(3)->subDay()->subSecond()->diffForHumans(null, null, true, 4)
        'berî 2 salan 3 meh 1 roj 1 saniye',
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        '1 hefte 10 saet',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 hefte 6 roj',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 hefte 6 roj',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(["join" => true, "parts" => 2])
        'di 1 hefte û 6 roj de',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        '2 hefte 1 saet',
        // Carbon::now()->addHour()->diffForHumans(["aUnit" => true])
        'di 1 saet de',
        // CarbonInterval::days(2)->forHumans()
        '2 roj',
        // CarbonInterval::create('P1DT3H')->forHumans(true)
        '1 roj 3 saet',
    ];
}
