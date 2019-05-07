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

class SrLatnXkTest extends LocalizationTestCase
{
    const LOCALE = 'sr_Latn_XK'; // Serbian

    const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'sutra u 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'у суботу у 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'у недељу у 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'у ponedeljak у 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'у utorak у 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'у среду у 00:00',
        // Carbon::parse('2018-01-05 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-05 00:00:00'))
        'у četvrtak у 00:00',
        // Carbon::parse('2018-01-06 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-06 00:00:00'))
        'у petak у 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'у utorak у 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'у среду у 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'у četvrtak у 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'у petak у 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'у суботу у 00:00',
        // Carbon::now()->subDays(2)->calendar()
        'прошле недеље у 20:49',
        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'juče u 22:00',
        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        'danas u 10:00',
        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'danas u 02:00',
        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        'sutra u 01:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'у utorak у 00:00',
        // Carbon::parse('2018-01-08 00:00:00')->subDay()->calendar(Carbon::parse('2018-01-08 00:00:00'))
        'juče u 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'juče u 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'прошлог уторка у 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'прошлог понедељка у 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'прошле недеље у 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'прошле суботе у 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'прошлог петка у 00:00',
        // Carbon::parse('2018-01-03 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-03 00:00:00'))
        'прошлог четвртка у 00:00',
        // Carbon::parse('2018-01-02 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-02 00:00:00'))
        'прошле среде у 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'прошлог петка у 00:00',
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
        '12:00 пре подне cet',
        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 пре подне, 12:00 пре подне',
        // Carbon::parse('2018-02-10 01:30:00')->isoFormat('h:mm A, h:mm a')
        '1:30 пре подне, 1:30 пре подне',
        // Carbon::parse('2018-02-10 02:00:00')->isoFormat('h:mm A, h:mm a')
        '2:00 пре подне, 2:00 пре подне',
        // Carbon::parse('2018-02-10 06:00:00')->isoFormat('h:mm A, h:mm a')
        '6:00 пре подне, 6:00 пре подне',
        // Carbon::parse('2018-02-10 10:00:00')->isoFormat('h:mm A, h:mm a')
        '10:00 пре подне, 10:00 пре подне',
        // Carbon::parse('2018-02-10 12:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 по подне, 12:00 по подне',
        // Carbon::parse('2018-02-10 17:00:00')->isoFormat('h:mm A, h:mm a')
        '5:00 по подне, 5:00 по подне',
        // Carbon::parse('2018-02-10 21:30:00')->isoFormat('h:mm A, h:mm a')
        '9:30 по подне, 9:30 по подне',
        // Carbon::parse('2018-02-10 23:00:00')->isoFormat('h:mm A, h:mm a')
        '11:00 по подне, 11:00 по подне',
        // Carbon::parse('2018-01-01 00:00:00')->ordinal('hour')
        '0.',
        // Carbon::now()->subSeconds(1)->diffForHumans()
        'pre 1 sekund',
        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        'pre 1 sek.',
        // Carbon::now()->subSeconds(2)->diffForHumans()
        'pre 2 sekund',
        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        'pre 2 sek.',
        // Carbon::now()->subMinutes(1)->diffForHumans()
        'pre 1 minut',
        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        'pre 1 min.',
        // Carbon::now()->subMinutes(2)->diffForHumans()
        'pre 2 minut',
        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        'pre 2 min.',
        // Carbon::now()->subHours(1)->diffForHumans()
        'pre 1 sat',
        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        'pre 1 č.',
        // Carbon::now()->subHours(2)->diffForHumans()
        'pre 2 sat',
        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        'pre 2 č.',
        // Carbon::now()->subDays(1)->diffForHumans()
        'pre 1 dan',
        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        'pre 1 d.',
        // Carbon::now()->subDays(2)->diffForHumans()
        'pre 2 dan',
        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        'pre 2 d.',
        // Carbon::now()->subWeeks(1)->diffForHumans()
        'pre 1 nedelju',
        // Carbon::now()->subWeeks(1)->diffForHumans(null, false, true)
        'pre 1 ned.',
        // Carbon::now()->subWeeks(2)->diffForHumans()
        'pre 2 nedelju',
        // Carbon::now()->subWeeks(2)->diffForHumans(null, false, true)
        'pre 2 ned.',
        // Carbon::now()->subMonths(1)->diffForHumans()
        'pre 1 mesec',
        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        'pre 1 mj.',
        // Carbon::now()->subMonths(2)->diffForHumans()
        'pre 2 mesec',
        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        'pre 2 mj.',
        // Carbon::now()->subYears(1)->diffForHumans()
        'pre 1 godinu',
        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        'pre 1 g.',
        // Carbon::now()->subYears(2)->diffForHumans()
        'pre 2 godinu',
        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        'pre 2 g.',
        // Carbon::now()->addSecond()->diffForHumans()
        'za 1 sekund',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        'za 1 sek.',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now())
        'nakon 1 sekund',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), false, true)
        'nakon 1 sek.',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond())
        'pre 1 sekund',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond(), false, true)
        'pre 1 sek.',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true)
        '1 sekund',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true, true)
        '1 sek.',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        '2 sekund',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        '2 sek.',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        'za 1 sek.',
        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        '1 minut 1 sekund',
        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        '2 g. 3 mj. 1 d. 1 sek.',
        // Carbon::now()->addYears(3)->diffForHumans(null, null, false, 4)
        'za 3 godina',
        // Carbon::now()->subMonths(5)->diffForHumans(null, null, true, 4)
        'pre 5 mj.',
        // Carbon::now()->subYears(2)->subMonths(3)->subDay()->subSecond()->diffForHumans(null, null, true, 4)
        'pre 2 g. 3 mj. 1 d. 1 sek.',
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        '1 nedelja 10 sat',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 nedelja 6 dan',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 nedelja 6 dan',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(["join" => true, "parts" => 2])
        'za 1 nedelja i 6 dan',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        '2 nedelja 1 sat',
        // Carbon::now()->addHour()->diffForHumans(["aUnit" => true])
        'za 1 sat',
        // CarbonInterval::days(2)->forHumans()
        '2 dan',
        // CarbonInterval::create('P1DT3H')->forHumans(true)
        '1 d. 3 č.',
    ];
}
