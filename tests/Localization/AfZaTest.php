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
class AfZaTest extends LocalizationTestCase
{
    public const LOCALE = 'af_ZA'; // Afrikaans

    public const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Môre om 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Saterdag om 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Sondag om 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Maandag om 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Dinsdag om 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Woensdag om 00:00',
        // Carbon::parse('2018-01-05 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-05 00:00:00'))
        'Donderdag om 00:00',
        // Carbon::parse('2018-01-06 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-06 00:00:00'))
        'Vrydag om 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Dinsdag om 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Woensdag om 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Donderdag om 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Vrydag om 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Saterdag om 00:00',
        // Carbon::now()->subDays(2)->calendar()
        'Laas Sondag om 20:49',
        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Gister om 22:00',
        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        'Vandag om 10:00',
        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Vandag om 02:00',
        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        'Môre om 01:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Dinsdag om 00:00',
        // Carbon::parse('2018-01-08 00:00:00')->subDay()->calendar(Carbon::parse('2018-01-08 00:00:00'))
        'Gister om 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Gister om 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Laas Dinsdag om 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Laas Maandag om 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Laas Sondag om 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Laas Saterdag om 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Laas Vrydag om 00:00',
        // Carbon::parse('2018-01-03 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-03 00:00:00'))
        'Laas Donderdag om 00:00',
        // Carbon::parse('2018-01-02 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-02 00:00:00'))
        'Laas Woensdag om 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Laas Vrydag om 00:00',
        // Carbon::parse('2018-01-01 00:00:00')->isoFormat('Qo Mo Do Wo wo')
        '1ste 1ste 1ste 1ste 1ste',
        // Carbon::parse('2018-01-02 00:00:00')->isoFormat('Do wo')
        '2de 1ste',
        // Carbon::parse('2018-01-03 00:00:00')->isoFormat('Do wo')
        '3de 1ste',
        // Carbon::parse('2018-01-04 00:00:00')->isoFormat('Do wo')
        '4de 1ste',
        // Carbon::parse('2018-01-05 00:00:00')->isoFormat('Do wo')
        '5de 1ste',
        // Carbon::parse('2018-01-06 00:00:00')->isoFormat('Do wo')
        '6de 1ste',
        // Carbon::parse('2018-01-07 00:00:00')->isoFormat('Do wo')
        '7de 1ste',
        // Carbon::parse('2018-01-11 00:00:00')->isoFormat('Do wo')
        '11de 2de',
        // Carbon::parse('2018-02-09 00:00:00')->isoFormat('DDDo')
        '40ste',
        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('DDDo')
        '41ste',
        // Carbon::parse('2018-04-10 00:00:00')->isoFormat('DDDo')
        '100ste',
        // Carbon::parse('2018-02-10 00:00:00', 'Europe/Paris')->isoFormat('h:mm a z')
        '12:00 vm CET',
        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 VM, 12:00 vm',
        // Carbon::parse('2018-02-10 01:30:00')->isoFormat('h:mm A, h:mm a')
        '1:30 VM, 1:30 vm',
        // Carbon::parse('2018-02-10 02:00:00')->isoFormat('h:mm A, h:mm a')
        '2:00 VM, 2:00 vm',
        // Carbon::parse('2018-02-10 06:00:00')->isoFormat('h:mm A, h:mm a')
        '6:00 VM, 6:00 vm',
        // Carbon::parse('2018-02-10 10:00:00')->isoFormat('h:mm A, h:mm a')
        '10:00 VM, 10:00 vm',
        // Carbon::parse('2018-02-10 12:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 NM, 12:00 nm',
        // Carbon::parse('2018-02-10 17:00:00')->isoFormat('h:mm A, h:mm a')
        '5:00 NM, 5:00 nm',
        // Carbon::parse('2018-02-10 21:30:00')->isoFormat('h:mm A, h:mm a')
        '9:30 NM, 9:30 nm',
        // Carbon::parse('2018-02-10 23:00:00')->isoFormat('h:mm A, h:mm a')
        '11:00 NM, 11:00 nm',
        // Carbon::parse('2018-01-01 00:00:00')->ordinal('hour')
        '0de',
        // Carbon::now()->subSeconds(1)->diffForHumans()
        '1 sekond gelede',
        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        '1 s. gelede',
        // Carbon::now()->subSeconds(2)->diffForHumans()
        '2 sekondes gelede',
        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        '2 s. gelede',
        // Carbon::now()->subMinutes(1)->diffForHumans()
        '1 minuut gelede',
        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        '1 min. gelede',
        // Carbon::now()->subMinutes(2)->diffForHumans()
        '2 minute gelede',
        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        '2 min. gelede',
        // Carbon::now()->subHours(1)->diffForHumans()
        '1 uur gelede',
        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        '1 u. gelede',
        // Carbon::now()->subHours(2)->diffForHumans()
        '2 uur gelede',
        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        '2 u. gelede',
        // Carbon::now()->subDays(1)->diffForHumans()
        '1 dag gelede',
        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        '1 d. gelede',
        // Carbon::now()->subDays(2)->diffForHumans()
        '2 dae gelede',
        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        '2 d. gelede',
        // Carbon::now()->subWeeks(1)->diffForHumans()
        '1 week gelede',
        // Carbon::now()->subWeeks(1)->diffForHumans(null, false, true)
        '1 w. gelede',
        // Carbon::now()->subWeeks(2)->diffForHumans()
        '2 weke gelede',
        // Carbon::now()->subWeeks(2)->diffForHumans(null, false, true)
        '2 w. gelede',
        // Carbon::now()->subMonths(1)->diffForHumans()
        '1 maand gelede',
        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        '1 maa. gelede',
        // Carbon::now()->subMonths(2)->diffForHumans()
        '2 maande gelede',
        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        '2 maa. gelede',
        // Carbon::now()->subYears(1)->diffForHumans()
        '1 jaar gelede',
        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        '1 j. gelede',
        // Carbon::now()->subYears(2)->diffForHumans()
        '2 jaar gelede',
        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        '2 j. gelede',
        // Carbon::now()->addSecond()->diffForHumans()
        'oor 1 sekond',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        'oor 1 s.',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now())
        '1 sekond na',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), false, true)
        '1 s. na',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond())
        '1 sekond voor',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond(), false, true)
        '1 s. voor',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true)
        '1 sekond',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true, true)
        '1 s.',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        '2 sekondes',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        '2 s.',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        'oor 1 s.',
        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        '1 minuut 1 sekond',
        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        '2 j. 3 maa. 1 d. 1 s.',
        // Carbon::now()->addYears(3)->diffForHumans(null, null, false, 4)
        'oor 3 jaar',
        // Carbon::now()->subMonths(5)->diffForHumans(null, null, true, 4)
        '5 maa. gelede',
        // Carbon::now()->subYears(2)->subMonths(3)->subDay()->subSecond()->diffForHumans(null, null, true, 4)
        '2 j. 3 maa. 1 d. 1 s. gelede',
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        '1 week 10 uur',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 week 6 dae',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 week 6 dae',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(["join" => true, "parts" => 2])
        'oor 1 week en 6 dae',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        '2 weke 1 uur',
        // Carbon::now()->addHour()->diffForHumans(["aUnit" => true])
        'oor \'n uur',
        // CarbonInterval::days(2)->forHumans()
        '2 dae',
        // CarbonInterval::create('P1DT3H')->forHumans(true)
        '1 d. 3 u.',
    ];
}
