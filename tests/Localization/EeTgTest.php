<?php

/**
 * This file is part of the Carbon package.
 *
 * (c) Brian Nesbitt <brian@nesbot.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Tests\Localization;

class EeTgTest extends LocalizationTestCase
{
    const LOCALE = 'ee_TG'; // Ewe

    const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Tomorrow at 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'memleɖa at 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'kɔsiɖa at 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'dzoɖa at 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'blaɖa at 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'kuɖa at 00:00',
        // Carbon::parse('2018-01-05 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-05 00:00:00'))
        'yawoɖa at 00:00',
        // Carbon::parse('2018-01-06 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-06 00:00:00'))
        'fiɖa at 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'blaɖa at 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'kuɖa at 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'yawoɖa at 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'fiɖa at 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'memleɖa at 00:00',
        // Carbon::now()->subDays(2)->calendar()
        'Last kɔsiɖa at 20:49',
        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Yesterday at 22:00',
        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        'Today at 10:00',
        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Today at 02:00',
        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        'Tomorrow at 01:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'blaɖa at 00:00',
        // Carbon::parse('2018-01-08 00:00:00')->subDay()->calendar(Carbon::parse('2018-01-08 00:00:00'))
        'Yesterday at 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Yesterday at 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last blaɖa at 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last dzoɖa at 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last kɔsiɖa at 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last memleɖa at 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last fiɖa at 00:00',
        // Carbon::parse('2018-01-03 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-03 00:00:00'))
        'Last yawoɖa at 00:00',
        // Carbon::parse('2018-01-02 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-02 00:00:00'))
        'Last kuɖa at 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Last fiɖa at 00:00',
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
        '7th 1st',
        // Carbon::parse('2018-01-11 00:00:00')->isoFormat('Do wo')
        '11th 2nd',
        // Carbon::parse('2018-02-09 00:00:00')->isoFormat('DDDo')
        '40th',
        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('DDDo')
        '41st',
        // Carbon::parse('2018-04-10 00:00:00')->isoFormat('DDDo')
        '100th',
        // Carbon::parse('2018-02-10 00:00:00', 'Europe/Paris')->isoFormat('h:mm a z')
        '12:00 ŋ cet',
        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 ŋ, 12:00 ŋ',
        // Carbon::parse('2018-02-10 01:30:00')->isoFormat('h:mm A, h:mm a')
        '1:30 ŋ, 1:30 ŋ',
        // Carbon::parse('2018-02-10 02:00:00')->isoFormat('h:mm A, h:mm a')
        '2:00 ŋ, 2:00 ŋ',
        // Carbon::parse('2018-02-10 06:00:00')->isoFormat('h:mm A, h:mm a')
        '6:00 ŋ, 6:00 ŋ',
        // Carbon::parse('2018-02-10 10:00:00')->isoFormat('h:mm A, h:mm a')
        '10:00 ŋ, 10:00 ŋ',
        // Carbon::parse('2018-02-10 12:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 ɣ, 12:00 ɣ',
        // Carbon::parse('2018-02-10 17:00:00')->isoFormat('h:mm A, h:mm a')
        '5:00 ɣ, 5:00 ɣ',
        // Carbon::parse('2018-02-10 21:30:00')->isoFormat('h:mm A, h:mm a')
        '9:30 ɣ, 9:30 ɣ',
        // Carbon::parse('2018-02-10 23:00:00')->isoFormat('h:mm A, h:mm a')
        '11:00 ɣ, 11:00 ɣ',
        // Carbon::parse('2018-01-01 00:00:00')->ordinal('hour')
        '0th',
        // Carbon::now()->subSeconds(1)->diffForHumans()
        '1 ɖasedila ago',
        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        '1 ɖasedila ago',
        // Carbon::now()->subSeconds(2)->diffForHumans()
        '2 ɖasedila ago',
        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        '2 ɖasedila ago',
        // Carbon::now()->subMinutes(1)->diffForHumans()
        '1 sue ago',
        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        '1 sue ago',
        // Carbon::now()->subMinutes(2)->diffForHumans()
        '2 sue ago',
        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        '2 sue ago',
        // Carbon::now()->subHours(1)->diffForHumans()
        'gaƒoƒo 1 ago',
        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        'gaƒoƒo 1 ago',
        // Carbon::now()->subHours(2)->diffForHumans()
        'gaƒoƒo 2 ago',
        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        'gaƒoƒo 2 ago',
        // Carbon::now()->subDays(1)->diffForHumans()
        'ŋkeke 1 ago',
        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        'ŋkeke 1 ago',
        // Carbon::now()->subDays(2)->diffForHumans()
        'ŋkeke 2 ago',
        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        'ŋkeke 2 ago',
        // Carbon::now()->subWeeks(1)->diffForHumans()
        '1 Kɔsiɖagbe ago',
        // Carbon::now()->subWeeks(1)->diffForHumans(null, false, true)
        '1 Kɔsiɖagbe ago',
        // Carbon::now()->subWeeks(2)->diffForHumans()
        '2 Kɔsiɖagbe ago',
        // Carbon::now()->subWeeks(2)->diffForHumans(null, false, true)
        '2 Kɔsiɖagbe ago',
        // Carbon::now()->subMonths(1)->diffForHumans()
        '1 dzinu ago',
        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        '1 dzinu ago',
        // Carbon::now()->subMonths(2)->diffForHumans()
        '2 dzinu ago',
        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        '2 dzinu ago',
        // Carbon::now()->subYears(1)->diffForHumans()
        '1 eƒe ago',
        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        '1 eƒe ago',
        // Carbon::now()->subYears(2)->diffForHumans()
        '2 eƒe ago',
        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        '2 eƒe ago',
        // Carbon::now()->addSecond()->diffForHumans()
        '1 ɖasedila from now',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        '1 ɖasedila from now',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now())
        '1 ɖasedila after',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), false, true)
        '1 ɖasedila after',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond())
        '1 ɖasedila before',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond(), false, true)
        '1 ɖasedila before',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true)
        '1 ɖasedila',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true, true)
        '1 ɖasedila',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        '2 ɖasedila',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        '2 ɖasedila',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        '1 ɖasedila from now',
        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        '1 sue 1 ɖasedila',
        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        '2 eƒe 3 dzinu ŋkeke 1 1 ɖasedila',
        // Carbon::now()->addYears(3)->diffForHumans(null, null, false, 4)
        '3 eƒe from now',
        // Carbon::now()->subMonths(5)->diffForHumans(null, null, true, 4)
        '5 dzinu ago',
        // Carbon::now()->subYears(2)->subMonths(3)->subDay()->subSecond()->diffForHumans(null, null, true, 4)
        '2 eƒe 3 dzinu ŋkeke 1 1 ɖasedila ago',
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        '1 Kɔsiɖagbe gaƒoƒo 10',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 Kɔsiɖagbe ŋkeke 6',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 Kɔsiɖagbe ŋkeke 6',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(["join" => true, "parts" => 2])
        '1 Kɔsiɖagbe and ŋkeke 6 from now',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        '2 Kɔsiɖagbe gaƒoƒo 1',
        // Carbon::now()->addHour()->diffForHumans(["aUnit" => true])
        'gaƒoƒo 1 from now',
        // CarbonInterval::days(2)->forHumans()
        'ŋkeke 2',
        // CarbonInterval::create('P1DT3H')->forHumans(true)
        'ŋkeke 1 gaƒoƒo 3',
    ];
}
