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
class BsCyrlTest extends LocalizationTestCase
{
    public const LOCALE = 'bs_Cyrl'; // Bosnian

    public const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'sutra u 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'u subotu u 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'u nedjelju u 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'u понедјељак u 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'u уторак u 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'u srijedu u 00:00',
        // Carbon::parse('2018-01-05 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-05 00:00:00'))
        'u четвртак u 00:00',
        // Carbon::parse('2018-01-06 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-06 00:00:00'))
        'u петак u 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'u уторак u 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'u srijedu u 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'u четвртак u 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'u петак u 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'u subotu u 00:00',
        // Carbon::now()->subDays(2)->calendar()
        'prošlu недјеља u 20:49',
        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'jučer u 22:00',
        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        'danas u 10:00',
        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'danas u 02:00',
        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        'sutra u 01:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'u уторак u 00:00',
        // Carbon::parse('2018-01-08 00:00:00')->subDay()->calendar(Carbon::parse('2018-01-08 00:00:00'))
        'jučer u 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'jučer u 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'prošli уторак u 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'prošli понедјељак u 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'prošlu недјеља u 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'prošle subote u 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'prošli петак u 00:00',
        // Carbon::parse('2018-01-03 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-03 00:00:00'))
        'prošli четвртак u 00:00',
        // Carbon::parse('2018-01-02 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-02 00:00:00'))
        'prošlu сриједа u 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'prošli петак u 00:00',
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
        '12:00 пре подне CET',
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
        '12:00 поподне, 12:00 поподне',
        // Carbon::parse('2018-02-10 17:00:00')->isoFormat('h:mm A, h:mm a')
        '5:00 поподне, 5:00 поподне',
        // Carbon::parse('2018-02-10 21:30:00')->isoFormat('h:mm A, h:mm a')
        '9:30 поподне, 9:30 поподне',
        // Carbon::parse('2018-02-10 23:00:00')->isoFormat('h:mm A, h:mm a')
        '11:00 поподне, 11:00 поподне',
        // Carbon::parse('2018-01-01 00:00:00')->ordinal('hour')
        '0.',
        // Carbon::now()->subSeconds(1)->diffForHumans()
        'prije 1 sekund',
        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        'prije 1 sekund',
        // Carbon::now()->subSeconds(2)->diffForHumans()
        'prije 2 sekunda',
        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        'prije 2 sekunda',
        // Carbon::now()->subMinutes(1)->diffForHumans()
        'prije 1 minut',
        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        'prije 1 minut',
        // Carbon::now()->subMinutes(2)->diffForHumans()
        'prije 2 minuta',
        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        'prije 2 minuta',
        // Carbon::now()->subHours(1)->diffForHumans()
        'prije 1 sat',
        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        'prije 1 sat',
        // Carbon::now()->subHours(2)->diffForHumans()
        'prije 2 sata',
        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        'prije 2 sata',
        // Carbon::now()->subDays(1)->diffForHumans()
        'prije 1 dan',
        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        'prije 1 dan',
        // Carbon::now()->subDays(2)->diffForHumans()
        'prije 2 dana',
        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        'prije 2 dana',
        // Carbon::now()->subWeeks(1)->diffForHumans()
        'prije 1 sedmicu',
        // Carbon::now()->subWeeks(1)->diffForHumans(null, false, true)
        'prije 1 sedmica',
        // Carbon::now()->subWeeks(2)->diffForHumans()
        'prije 2 sedmice',
        // Carbon::now()->subWeeks(2)->diffForHumans(null, false, true)
        'prije 2 sedmice',
        // Carbon::now()->subMonths(1)->diffForHumans()
        'prije 1 mjesec',
        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        'prije 1 mjesec',
        // Carbon::now()->subMonths(2)->diffForHumans()
        'prije 2 mjeseca',
        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        'prije 2 mjeseca',
        // Carbon::now()->subYears(1)->diffForHumans()
        'prije 1 godinu',
        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        'prije 1 godina',
        // Carbon::now()->subYears(2)->diffForHumans()
        'prije 2 godine',
        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        'prije 2 godine',
        // Carbon::now()->addSecond()->diffForHumans()
        'za 1 sekund',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        'za 1 sekund',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now())
        'nakon 1 sekund',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), false, true)
        'nakon 1 sekund',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond())
        '1 sekund ranije',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond(), false, true)
        '1 sekund ranije',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true)
        '1 sekund',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true, true)
        '1 sekund',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        '2 sekunda',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        '2 sekunda',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        'za 1 sekund',
        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        '1 minut 1 sekund',
        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        '2 godine 3 mjeseca 1 dan 1 sekund',
        // Carbon::now()->addYears(3)->diffForHumans(null, null, false, 4)
        'za 3 godine',
        // Carbon::now()->subMonths(5)->diffForHumans(null, null, true, 4)
        'prije 5 mjeseci',
        // Carbon::now()->subYears(2)->subMonths(3)->subDay()->subSecond()->diffForHumans(null, null, true, 4)
        'prije 2 godine 3 mjeseca 1 dan 1 sekund',
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        '1 sedmica 10 sati',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 sedmica 6 dana',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 sedmica 6 dana',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(["join" => true, "parts" => 2])
        'za 1 sedmicu i 6 dana',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        '2 sedmice 1 sat',
        // Carbon::now()->addHour()->diffForHumans(["aUnit" => true])
        'za 1 sat',
        // CarbonInterval::days(2)->forHumans()
        '2 dana',
        // CarbonInterval::create('P1DT3H')->forHumans(true)
        '1 dan 3 sata',
    ];
}
