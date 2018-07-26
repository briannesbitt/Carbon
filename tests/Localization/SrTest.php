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

class SrTest extends LocalizationTestCase
{
    const LOCALE = 'sr'; // Serbian

    const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'sutra u 0:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'у суботу у 0:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'у недељу у 0:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'у ponedeljak у 0:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'у utorak у 0:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'у среду у 0:00',
        // Carbon::parse('2018-01-05 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-05 00:00:00'))
        'у četvrtak у 0:00',
        // Carbon::parse('2018-01-06 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-06 00:00:00'))
        'у petak у 0:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'у utorak у 0:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'у среду у 0:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'у četvrtak у 0:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'у petak у 0:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'у суботу у 0:00',
        // Carbon::now()->subDays(2)->calendar()
        'прошле недеље у 20:49',
        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'juče u 22:00',
        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        'danas u 10:00',
        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'danas u 2:00',
        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        'sutra u 1:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'у utorak у 0:00',
        // Carbon::parse('2018-01-08 00:00:00')->subDay()->calendar(Carbon::parse('2018-01-08 00:00:00'))
        'juče u 0:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'juče u 0:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'прошлог уторка у 0:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'прошлог понедељка у 0:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'прошле недеље у 0:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'прошле суботе у 0:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'прошлог петка у 0:00',
        // Carbon::parse('2018-01-03 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-03 00:00:00'))
        'прошлог четвртка у 0:00',
        // Carbon::parse('2018-01-02 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-02 00:00:00'))
        'прошле среде у 0:00',
        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'прошлог петка у 0:00',
        // Carbon::parse('2018-01-01 00:00:00')->isoFormat('Qo Mo Do Wo wo')
        ':1. :1. :1. :1. :1.',
        // Carbon::parse('2018-01-02 00:00:00')->isoFormat('Do wo')
        ':2. :1.',
        // Carbon::parse('2018-01-03 00:00:00')->isoFormat('Do wo')
        ':3. :1.',
        // Carbon::parse('2018-01-04 00:00:00')->isoFormat('Do wo')
        ':4. :1.',
        // Carbon::parse('2018-01-05 00:00:00')->isoFormat('Do wo')
        ':5. :1.',
        // Carbon::parse('2018-01-06 00:00:00')->isoFormat('Do wo')
        ':6. :1.',
        // Carbon::parse('2018-01-07 00:00:00')->isoFormat('Do wo')
        ':7. :1.',
        // Carbon::parse('2018-01-11 00:00:00')->isoFormat('Do wo')
        ':11. :2.',
        // Carbon::parse('2018-02-09 00:00:00')->isoFormat('DDDo')
        ':40.',
        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('DDDo')
        ':41.',
        // Carbon::parse('2018-04-10 00:00:00')->isoFormat('DDDo')
        ':100.',
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
        ':0.',
        // Carbon::now()->subSeconds(1)->diffForHumans()
        'pre 1 sekund',
        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        'pre 1 sekund',
        // Carbon::now()->subSeconds(2)->diffForHumans()
        'pre 2 sekunde',
        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        'pre 2 sekunde',
        // Carbon::now()->subMinutes(1)->diffForHumans()
        'pre 1 minut',
        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        'pre 1 minut',
        // Carbon::now()->subMinutes(2)->diffForHumans()
        'pre 2 minuta',
        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        'pre 2 minuta',
        // Carbon::now()->subHours(1)->diffForHumans()
        'pre 1 sat',
        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        'pre 1 sat',
        // Carbon::now()->subHours(2)->diffForHumans()
        'pre 2 sata',
        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        'pre 2 sata',
        // Carbon::now()->subDays(1)->diffForHumans()
        'pre 1 dan',
        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        'pre 1 dan',
        // Carbon::now()->subDays(2)->diffForHumans()
        'pre 2 dana',
        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        'pre 2 dana',
        // Carbon::now()->subWeeks(1)->diffForHumans()
        'pre 1 nedelju',
        // Carbon::now()->subWeeks(1)->diffForHumans(null, false, true)
        'pre 1 nedelja',
        // Carbon::now()->subWeeks(2)->diffForHumans()
        'pre 2 nedelje',
        // Carbon::now()->subWeeks(2)->diffForHumans(null, false, true)
        'pre 2 nedelje',
        // Carbon::now()->subMonths(1)->diffForHumans()
        'pre 1 mesec',
        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        'pre 1 mesec',
        // Carbon::now()->subMonths(2)->diffForHumans()
        'pre 2 meseca',
        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        'pre 2 meseca',
        // Carbon::now()->subYears(1)->diffForHumans()
        'pre 1 godinu',
        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        'pre 1 godina',
        // Carbon::now()->subYears(2)->diffForHumans()
        'pre 2 godine',
        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        'pre 2 godine',
        // Carbon::now()->addSecond()->diffForHumans()
        'za 1 sekund',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        'za 1 sekund',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now())
        'nakon 1 sekund',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), false, true)
        'nakon 1 sekund',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond())
        'pre 1 sekund',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond(), false, true)
        'pre 1 sekund',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true)
        '1 sekund',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true, true)
        '1 sekund',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        '2 sekunde',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        '2 sekunde',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        'za 1 sekund',
        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        '1 minut 1 sekund',
        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        '2 godine 3 meseca 1 dan 1 sekund',
        // Carbon::now()->addYears(3)->diffForHumans(null, null, false, 4)
        'za 3 godine',
        // Carbon::now()->subMonths(5)->diffForHumans(null, null, true, 4)
        'pre 5 meseci',
        // Carbon::now()->subYears(2)->subMonths(3)->subDay()->subSecond()->diffForHumans(null, null, true, 4)
        'pre 2 godine 3 meseca 1 dan 1 sekund',
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        '1 nedelja 10 sati',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 nedelja 6 dana',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 nedelja 6 dana',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        '2 nedelje 1 sat',
        // CarbonInterval::days(2)->forHumans()
        '2 dana',
        // CarbonInterval::create('P1DT3H')->forHumans(true)
        '1 dan 3 sata',
    ];
}
