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
class OcTest extends LocalizationTestCase
{
    public const LOCALE = 'oc'; // Occitan

    public const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Deman a 0:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'dissabte a 0:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'dimenge a 0:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'diluns a 0:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'dimars a 0:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'dimècres a 0:00',
        // Carbon::parse('2018-01-05 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-05 00:00:00'))
        'dijòus a 0:00',
        // Carbon::parse('2018-01-06 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-06 00:00:00'))
        'divendres a 0:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'dimars a 0:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'dimècres a 0:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'dijòus a 0:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'divendres a 0:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'dissabte a 0:00',
        // Carbon::now()->subDays(2)->calendar()
        'dimenge passat a 20:49',
        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Ièr a 22:00',
        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        'Uèi a 10:00',
        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Uèi a 2:00',
        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        'Deman a 1:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'dimars a 0:00',
        // Carbon::parse('2018-01-08 00:00:00')->subDay()->calendar(Carbon::parse('2018-01-08 00:00:00'))
        'Ièr a 0:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Ièr a 0:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'dimars passat a 0:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'diluns passat a 0:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'dimenge passat a 0:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'dissabte passat a 0:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'divendres passat a 0:00',
        // Carbon::parse('2018-01-03 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-03 00:00:00'))
        'dijòus passat a 0:00',
        // Carbon::parse('2018-01-02 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-02 00:00:00'))
        'dimècres passat a 0:00',
        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'divendres passat a 0:00',
        // Carbon::parse('2018-01-01 00:00:00')->isoFormat('Qo Mo Do Wo wo')
        '1èr 1èr 1èr 1èra 1èra',
        // Carbon::parse('2018-01-02 00:00:00')->isoFormat('Do wo')
        '2nd 1èra',
        // Carbon::parse('2018-01-03 00:00:00')->isoFormat('Do wo')
        '3en 1èra',
        // Carbon::parse('2018-01-04 00:00:00')->isoFormat('Do wo')
        '4en 1èra',
        // Carbon::parse('2018-01-05 00:00:00')->isoFormat('Do wo')
        '5en 1èra',
        // Carbon::parse('2018-01-06 00:00:00')->isoFormat('Do wo')
        '6en 1èra',
        // Carbon::parse('2018-01-07 00:00:00')->isoFormat('Do wo')
        '7en 1èra',
        // Carbon::parse('2018-01-11 00:00:00')->isoFormat('Do wo')
        '11en 2nda',
        // Carbon::parse('2018-02-09 00:00:00')->isoFormat('DDDo')
        '40en',
        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('DDDo')
        '41en',
        // Carbon::parse('2018-04-10 00:00:00')->isoFormat('DDDo')
        '100en',
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
        '0en',
        // Carbon::now()->subSeconds(1)->diffForHumans()
        'fa 1 segonda',
        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        'fa 1 segonda',
        // Carbon::now()->subSeconds(2)->diffForHumans()
        'fa 2 segondas',
        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        'fa 2 segondas',
        // Carbon::now()->subMinutes(1)->diffForHumans()
        'fa 1 minuta',
        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        'fa 1 minuta',
        // Carbon::now()->subMinutes(2)->diffForHumans()
        'fa 2 minutas',
        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        'fa 2 minutas',
        // Carbon::now()->subHours(1)->diffForHumans()
        'fa 1 ora',
        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        'fa 1 ora',
        // Carbon::now()->subHours(2)->diffForHumans()
        'fa 2 oras',
        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        'fa 2 oras',
        // Carbon::now()->subDays(1)->diffForHumans()
        'fa 1 jorn',
        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        'fa 1 jorn',
        // Carbon::now()->subDays(2)->diffForHumans()
        'fa 2 jorns',
        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        'fa 2 jorns',
        // Carbon::now()->subWeeks(1)->diffForHumans()
        'fa 1 setmana',
        // Carbon::now()->subWeeks(1)->diffForHumans(null, false, true)
        'fa 1 setmana',
        // Carbon::now()->subWeeks(2)->diffForHumans()
        'fa 2 setmanas',
        // Carbon::now()->subWeeks(2)->diffForHumans(null, false, true)
        'fa 2 setmanas',
        // Carbon::now()->subMonths(1)->diffForHumans()
        'fa 1 mes',
        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        'fa 1 mes',
        // Carbon::now()->subMonths(2)->diffForHumans()
        'fa 2 meses',
        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        'fa 2 meses',
        // Carbon::now()->subYears(1)->diffForHumans()
        'fa 1 an',
        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        'fa 1 an',
        // Carbon::now()->subYears(2)->diffForHumans()
        'fa 2 ans',
        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        'fa 2 ans',
        // Carbon::now()->addSecond()->diffForHumans()
        'd\'aquí 1 segonda',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        'd\'aquí 1 segonda',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now())
        '1 segonda aprèp',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), false, true)
        '1 segonda aprèp',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond())
        '1 segonda abans',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond(), false, true)
        '1 segonda abans',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true)
        '1 segonda',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true, true)
        '1 segonda',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        '2 segondas',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        '2 segondas',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        'd\'aquí 1 segonda',
        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        '1 minuta 1 segonda',
        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        '2 ans 3 meses 1 jorn 1 segonda',
        // Carbon::now()->addYears(3)->diffForHumans(null, null, false, 4)
        'd\'aquí 3 ans',
        // Carbon::now()->subMonths(5)->diffForHumans(null, null, true, 4)
        'fa 5 meses',
        // Carbon::now()->subYears(2)->subMonths(3)->subDay()->subSecond()->diffForHumans(null, null, true, 4)
        'fa 2 ans 3 meses 1 jorn 1 segonda',
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        '1 setmana 10 oras',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 setmana 6 jorns',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 setmana 6 jorns',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(["join" => true, "parts" => 2])
        'd\'aquí 1 setmana e 6 jorns',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        '2 setmanas 1 ora',
        // Carbon::now()->addHour()->diffForHumans(["aUnit" => true])
        'd\'aquí una ora',
        // CarbonInterval::days(2)->forHumans()
        '2 jorns',
        // CarbonInterval::create('P1DT3H')->forHumans(true)
        '1 jorn 3 oras',
    ];
}
