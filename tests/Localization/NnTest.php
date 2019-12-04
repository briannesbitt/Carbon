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

class NnTest extends LocalizationTestCase
{
    const LOCALE = 'nn'; // NorwegianNynorsk

    const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'I morgon klokka 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'laurdag klokka 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'sundag klokka 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'måndag klokka 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'tysdag klokka 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'onsdag klokka 00:00',
        // Carbon::parse('2018-01-05 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-05 00:00:00'))
        'torsdag klokka 00:00',
        // Carbon::parse('2018-01-06 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-06 00:00:00'))
        'fredag klokka 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'tysdag klokka 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'onsdag klokka 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'torsdag klokka 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'fredag klokka 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'laurdag klokka 00:00',
        // Carbon::now()->subDays(2)->calendar()
        'Føregåande sundag klokka 20:49',
        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'I går klokka 22:00',
        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        'I dag klokka 10:00',
        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'I dag klokka 02:00',
        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        'I morgon klokka 01:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'tysdag klokka 00:00',
        // Carbon::parse('2018-01-08 00:00:00')->subDay()->calendar(Carbon::parse('2018-01-08 00:00:00'))
        'I går klokka 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'I går klokka 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Føregåande tysdag klokka 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Føregåande måndag klokka 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Føregåande sundag klokka 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Føregåande laurdag klokka 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Føregåande fredag klokka 00:00',
        // Carbon::parse('2018-01-03 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-03 00:00:00'))
        'Føregåande torsdag klokka 00:00',
        // Carbon::parse('2018-01-02 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-02 00:00:00'))
        'Føregåande onsdag klokka 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Føregåande fredag klokka 00:00',
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
        '12:00 f.m. CET',
        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 f.m., 12:00 f.m.',
        // Carbon::parse('2018-02-10 01:30:00')->isoFormat('h:mm A, h:mm a')
        '1:30 f.m., 1:30 f.m.',
        // Carbon::parse('2018-02-10 02:00:00')->isoFormat('h:mm A, h:mm a')
        '2:00 f.m., 2:00 f.m.',
        // Carbon::parse('2018-02-10 06:00:00')->isoFormat('h:mm A, h:mm a')
        '6:00 f.m., 6:00 f.m.',
        // Carbon::parse('2018-02-10 10:00:00')->isoFormat('h:mm A, h:mm a')
        '10:00 f.m., 10:00 f.m.',
        // Carbon::parse('2018-02-10 12:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 e.m., 12:00 e.m.',
        // Carbon::parse('2018-02-10 17:00:00')->isoFormat('h:mm A, h:mm a')
        '5:00 e.m., 5:00 e.m.',
        // Carbon::parse('2018-02-10 21:30:00')->isoFormat('h:mm A, h:mm a')
        '9:30 e.m., 9:30 e.m.',
        // Carbon::parse('2018-02-10 23:00:00')->isoFormat('h:mm A, h:mm a')
        '11:00 e.m., 11:00 e.m.',
        // Carbon::parse('2018-01-01 00:00:00')->ordinal('hour')
        '0.',
        // Carbon::now()->subSeconds(1)->diffForHumans()
        '1 sekund sidan',
        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        '1 sekund sidan',
        // Carbon::now()->subSeconds(2)->diffForHumans()
        '2 sekund sidan',
        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        '2 sekund sidan',
        // Carbon::now()->subMinutes(1)->diffForHumans()
        '1 minutt sidan',
        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        '1 minutt sidan',
        // Carbon::now()->subMinutes(2)->diffForHumans()
        '2 minutt sidan',
        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        '2 minutt sidan',
        // Carbon::now()->subHours(1)->diffForHumans()
        '1 time sidan',
        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        '1 time sidan',
        // Carbon::now()->subHours(2)->diffForHumans()
        '2 timar sidan',
        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        '2 timar sidan',
        // Carbon::now()->subDays(1)->diffForHumans()
        '1 dag sidan',
        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        '1 dag sidan',
        // Carbon::now()->subDays(2)->diffForHumans()
        '2 dagar sidan',
        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        '2 dagar sidan',
        // Carbon::now()->subWeeks(1)->diffForHumans()
        '1 uke sidan',
        // Carbon::now()->subWeeks(1)->diffForHumans(null, false, true)
        '1 uke sidan',
        // Carbon::now()->subWeeks(2)->diffForHumans()
        '2 uker sidan',
        // Carbon::now()->subWeeks(2)->diffForHumans(null, false, true)
        '2 uker sidan',
        // Carbon::now()->subMonths(1)->diffForHumans()
        '1 månad sidan',
        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        '1 månad sidan',
        // Carbon::now()->subMonths(2)->diffForHumans()
        '2 månader sidan',
        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        '2 månader sidan',
        // Carbon::now()->subYears(1)->diffForHumans()
        '1 år sidan',
        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        '1 år sidan',
        // Carbon::now()->subYears(2)->diffForHumans()
        '2 år sidan',
        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        '2 år sidan',
        // Carbon::now()->addSecond()->diffForHumans()
        'om 1 sekund',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        'om 1 sekund',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now())
        'after',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), false, true)
        'after',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond())
        'before',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond(), false, true)
        'before',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true)
        '1 sekund',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true, true)
        '1 sekund',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        '2 sekund',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        '2 sekund',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        'om 1 sekund',
        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        '1 minutt 1 sekund',
        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        '2 år 3 månader 1 dag 1 sekund',
        // Carbon::now()->addYears(3)->diffForHumans(null, null, false, 4)
        'om 3 år',
        // Carbon::now()->subMonths(5)->diffForHumans(null, null, true, 4)
        '5 månader sidan',
        // Carbon::now()->subYears(2)->subMonths(3)->subDay()->subSecond()->diffForHumans(null, null, true, 4)
        '2 år 3 månader 1 dag 1 sekund sidan',
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        '1 uke 10 timar',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 uke 6 dagar',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 uke 6 dagar',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(["join" => true, "parts" => 2])
        'om 1 uke og 6 dagar',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        '2 uker 1 time',
        // Carbon::now()->addHour()->diffForHumans(["aUnit" => true])
        'om ein time',
        // CarbonInterval::days(2)->forHumans()
        '2 dagar',
        // CarbonInterval::create('P1DT3H')->forHumans(true)
        '1 dag 3 timar',
    ];
}
