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

class PlTest extends LocalizationTestCase
{
    const LOCALE = 'pl'; // Polish

    const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Jutro o 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'W sobotę o 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'W niedzielę o 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'W poniedziałek o 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'We wtorek o 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'W środę o 00:00',
        // Carbon::parse('2018-01-05 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-05 00:00:00'))
        'W czwartek o 00:00',
        // Carbon::parse('2018-01-06 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-06 00:00:00'))
        'W piątek o 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'We wtorek o 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'W środę o 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'W czwartek o 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'W piątek o 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'W sobotę o 00:00',
        // Carbon::now()->subDays(2)->calendar()
        'W zeszłą niedzielę o 20:49',
        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Wczoraj o 22:00',
        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        'Dziś o 10:00',
        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Dziś o 02:00',
        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        'Jutro o 01:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'We wtorek o 00:00',
        // Carbon::parse('2018-01-08 00:00:00')->subDay()->calendar(Carbon::parse('2018-01-08 00:00:00'))
        'Wczoraj o 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Wczoraj o 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'W zeszły wtorek o 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'W zeszły poniedziałek o 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'W zeszłą niedzielę o 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'W zeszłą sobotę o 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'W zeszły piątek o 00:00',
        // Carbon::parse('2018-01-03 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-03 00:00:00'))
        'W zeszły czwartek o 00:00',
        // Carbon::parse('2018-01-02 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-02 00:00:00'))
        'W zeszłą środę o 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'W zeszły piątek o 00:00',
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
        '12:00 am cet',
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
        '0.',
        // Carbon::now()->subSeconds(1)->diffForHumans()
        '1 sekunda temu',
        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        '1s temu',
        // Carbon::now()->subSeconds(2)->diffForHumans()
        '2 sekundy temu',
        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        '2s temu',
        // Carbon::now()->subMinutes(1)->diffForHumans()
        '1 minuta temu',
        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        '1m temu',
        // Carbon::now()->subMinutes(2)->diffForHumans()
        '2 minuty temu',
        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        '2m temu',
        // Carbon::now()->subHours(1)->diffForHumans()
        '1 godzina temu',
        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        '1g temu',
        // Carbon::now()->subHours(2)->diffForHumans()
        '2 godziny temu',
        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        '2g temu',
        // Carbon::now()->subDays(1)->diffForHumans()
        '1 dzień temu',
        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        '1d temu',
        // Carbon::now()->subDays(2)->diffForHumans()
        '2 dni temu',
        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        '2d temu',
        // Carbon::now()->subWeeks(1)->diffForHumans()
        '1 tydzień temu',
        // Carbon::now()->subWeeks(1)->diffForHumans(null, false, true)
        '1tyg temu',
        // Carbon::now()->subWeeks(2)->diffForHumans()
        '2 tygodnie temu',
        // Carbon::now()->subWeeks(2)->diffForHumans(null, false, true)
        '2tyg temu',
        // Carbon::now()->subMonths(1)->diffForHumans()
        '1 miesiąc temu',
        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        '1mies temu',
        // Carbon::now()->subMonths(2)->diffForHumans()
        '2 miesiące temu',
        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        '2mies temu',
        // Carbon::now()->subYears(1)->diffForHumans()
        '1 rok temu',
        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        '1r temu',
        // Carbon::now()->subYears(2)->diffForHumans()
        '2 lata temu',
        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        '2l temu',
        // Carbon::now()->addSecond()->diffForHumans()
        'za 1 sekunda',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        'za 1s',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now())
        '1 sekunda po',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), false, true)
        '1s po',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond())
        '1 sekunda przed',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond(), false, true)
        '1s przed',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true)
        '1 sekunda',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true, true)
        '1s',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        '2 sekundy',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        '2s',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        'za 1s',
        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        '1 minuta 1 sekunda',
        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        '2l 3mies 1d 1s',
        // Carbon::now()->addYears(3)->diffForHumans(null, null, false, 4)
        'za 3 lata',
        // Carbon::now()->subMonths(5)->diffForHumans(null, null, true, 4)
        '5mies temu',
        // Carbon::now()->subYears(2)->subMonths(3)->subDay()->subSecond()->diffForHumans(null, null, true, 4)
        '2l 3mies 1d 1s temu',
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        '1 tydzień 10 godzin',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 tydzień 6 dni',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 tydzień 6 dni',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        '2 tygodnie 1 godzina',
        // CarbonInterval::days(2)->forHumans()
        '2 dni',
        // CarbonInterval::create('P1DT3H')->forHumans(true)
        '1d 3g',
    ];
}
