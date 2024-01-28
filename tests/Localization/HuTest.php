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
class HuTest extends LocalizationTestCase
{
    public const LOCALE = 'hu'; // Hungarian

    public const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'holnap 0:00-kor',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'szombaton 0:00-kor',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'vasárnap 0:00-kor',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'hétfőn 0:00-kor',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'kedden 0:00-kor',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'szerdán 0:00-kor',
        // Carbon::parse('2018-01-05 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-05 00:00:00'))
        'csütörtökön 0:00-kor',
        // Carbon::parse('2018-01-06 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-06 00:00:00'))
        'pénteken 0:00-kor',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'kedden 0:00-kor',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'szerdán 0:00-kor',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'csütörtökön 0:00-kor',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'pénteken 0:00-kor',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'szombaton 0:00-kor',
        // Carbon::now()->subDays(2)->calendar()
        'múlt vasárnap 20:49-kor',
        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'tegnap 22:00-kor',
        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        'ma 10:00-kor',
        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'ma 2:00-kor',
        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        'holnap 1:00-kor',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'kedden 0:00-kor',
        // Carbon::parse('2018-01-08 00:00:00')->subDay()->calendar(Carbon::parse('2018-01-08 00:00:00'))
        'tegnap 0:00-kor',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'tegnap 0:00-kor',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'múlt kedden 0:00-kor',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'múlt hétfőn 0:00-kor',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'múlt vasárnap 0:00-kor',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'múlt szombaton 0:00-kor',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'múlt pénteken 0:00-kor',
        // Carbon::parse('2018-01-03 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-03 00:00:00'))
        'múlt csütörtökön 0:00-kor',
        // Carbon::parse('2018-01-02 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-02 00:00:00'))
        'múlt szerdán 0:00-kor',
        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'múlt pénteken 0:00-kor',
        // Carbon::parse('2018-01-01 00:00:00')->isoFormat('Qo Mo Do Wo wo')
        '1. 1. 1. 1. 1.',
        // Carbon::parse('2018-01-02 00:00:00')->isoFormat('Do wo')
        '2. 1.',
        // Carbon::parse('2018-01-03 00:00:00')->isoFormat('Do wo')
        '3. 1.',
        // Carbon::parse('2018-01-04 00:00:00')->isoFormat('Do wo')
        '4. 1.',
        // Carbon::parse('2018-01-05 00:00:00')->isoFormat('Do wo')
        '5. 1.',
        // Carbon::parse('2018-01-06 00:00:00')->isoFormat('Do wo')
        '6. 1.',
        // Carbon::parse('2018-01-07 00:00:00')->isoFormat('Do wo')
        '7. 1.',
        // Carbon::parse('2018-01-11 00:00:00')->isoFormat('Do wo')
        '11. 2.',
        // Carbon::parse('2018-02-09 00:00:00')->isoFormat('DDDo')
        '40.',
        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('DDDo')
        '41.',
        // Carbon::parse('2018-04-10 00:00:00')->isoFormat('DDDo')
        '100.',
        // Carbon::parse('2018-02-10 00:00:00', 'Europe/Paris')->isoFormat('h:mm a z')
        '12:00 de CET',
        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 DE, 12:00 de',
        // Carbon::parse('2018-02-10 01:30:00')->isoFormat('h:mm A, h:mm a')
        '1:30 DE, 1:30 de',
        // Carbon::parse('2018-02-10 02:00:00')->isoFormat('h:mm A, h:mm a')
        '2:00 DE, 2:00 de',
        // Carbon::parse('2018-02-10 06:00:00')->isoFormat('h:mm A, h:mm a')
        '6:00 DE, 6:00 de',
        // Carbon::parse('2018-02-10 10:00:00')->isoFormat('h:mm A, h:mm a')
        '10:00 DE, 10:00 de',
        // Carbon::parse('2018-02-10 12:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 DU, 12:00 du',
        // Carbon::parse('2018-02-10 17:00:00')->isoFormat('h:mm A, h:mm a')
        '5:00 DU, 5:00 du',
        // Carbon::parse('2018-02-10 21:30:00')->isoFormat('h:mm A, h:mm a')
        '9:30 DU, 9:30 du',
        // Carbon::parse('2018-02-10 23:00:00')->isoFormat('h:mm A, h:mm a')
        '11:00 DU, 11:00 du',
        // Carbon::parse('2018-01-01 00:00:00')->ordinal('hour')
        '0.',
        // Carbon::now()->subSeconds(1)->diffForHumans()
        '1 másodperce',
        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        '1 másodperce',
        // Carbon::now()->subSeconds(2)->diffForHumans()
        '2 másodperce',
        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        '2 másodperce',
        // Carbon::now()->subMinutes(1)->diffForHumans()
        '1 perce',
        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        '1 perce',
        // Carbon::now()->subMinutes(2)->diffForHumans()
        '2 perce',
        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        '2 perce',
        // Carbon::now()->subHours(1)->diffForHumans()
        '1 órája',
        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        '1 órája',
        // Carbon::now()->subHours(2)->diffForHumans()
        '2 órája',
        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        '2 órája',
        // Carbon::now()->subDays(1)->diffForHumans()
        '1 napja',
        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        '1 napja',
        // Carbon::now()->subDays(2)->diffForHumans()
        '2 napja',
        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        '2 napja',
        // Carbon::now()->subWeeks(1)->diffForHumans()
        '1 hete',
        // Carbon::now()->subWeeks(1)->diffForHumans(null, false, true)
        '1 hete',
        // Carbon::now()->subWeeks(2)->diffForHumans()
        '2 hete',
        // Carbon::now()->subWeeks(2)->diffForHumans(null, false, true)
        '2 hete',
        // Carbon::now()->subMonths(1)->diffForHumans()
        '1 hónapja',
        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        '1 hónapja',
        // Carbon::now()->subMonths(2)->diffForHumans()
        '2 hónapja',
        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        '2 hónapja',
        // Carbon::now()->subYears(1)->diffForHumans()
        '1 éve',
        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        '1 éve',
        // Carbon::now()->subYears(2)->diffForHumans()
        '2 éve',
        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        '2 éve',
        // Carbon::now()->addSecond()->diffForHumans()
        '1 másodperc múlva',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        '1 másodperc múlva',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now())
        '1 másodperccel később',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), false, true)
        '1 másodperccel később',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond())
        '1 másodperccel korábban',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond(), false, true)
        '1 másodperccel korábban',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true)
        '1 másodperc',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true, true)
        '1 másodperc',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        '2 másodperc',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        '2 másodperc',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        '1 másodperc múlva',
        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        '1 perc 1 másodperc',
        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        '2 év 3 hónap 1 nap 1 másodperc',
        // Carbon::now()->addYears(3)->diffForHumans(null, null, false, 4)
        '3 év múlva',
        // Carbon::now()->subMonths(5)->diffForHumans(null, null, true, 4)
        '5 hónapja',
        // Carbon::now()->subYears(2)->subMonths(3)->subDay()->subSecond()->diffForHumans(null, null, true, 4)
        '2 éve 3 hónapja 1 napja 1 másodperce',
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        '1 hét 10 óra',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 hét 6 nap',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 hét 6 nap',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(["join" => true, "parts" => 2])
        '1 hét és 6 nap múlva',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        '2 hét 1 óra',
        // Carbon::now()->addHour()->diffForHumans(["aUnit" => true])
        '1 óra múlva',
        // CarbonInterval::days(2)->forHumans()
        '2 nap',
        // CarbonInterval::create('P1DT3H')->forHumans(true)
        '1 nap 3 óra',
    ];
}
