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
class EtEeTest extends LocalizationTestCase
{
    public const LOCALE = 'et_EE'; // Estonian

    public const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'homme 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'laupäev 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'pühapäev 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'esmaspäev 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'teisipäev 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'kolmapäev 00:00',
        // Carbon::parse('2018-01-05 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-05 00:00:00'))
        'neljapäev 00:00',
        // Carbon::parse('2018-01-06 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-06 00:00:00'))
        'reede 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'teisipäev 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'kolmapäev 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'neljapäev 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'reede 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'laupäev 00:00',
        // Carbon::now()->subDays(2)->calendar()
        'eelmine pühapäev 20:49',
        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'eile 22:00',
        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        'täna 10:00',
        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'täna 02:00',
        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        'homme 01:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'teisipäev 00:00',
        // Carbon::parse('2018-01-08 00:00:00')->subDay()->calendar(Carbon::parse('2018-01-08 00:00:00'))
        'eile 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'eile 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'eelmine teisipäev 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'eelmine esmaspäev 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'eelmine pühapäev 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'eelmine laupäev 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'eelmine reede 00:00',
        // Carbon::parse('2018-01-03 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-03 00:00:00'))
        'eelmine neljapäev 00:00',
        // Carbon::parse('2018-01-02 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-02 00:00:00'))
        'eelmine kolmapäev 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'eelmine reede 00:00',
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
        '6 1',
        // Carbon::parse('2018-01-07 00:00:00')->isoFormat('Do wo')
        '7 1',
        // Carbon::parse('2018-01-11 00:00:00')->isoFormat('Do wo')
        '11 2',
        // Carbon::parse('2018-02-09 00:00:00')->isoFormat('DDDo')
        '40',
        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('DDDo')
        '41',
        // Carbon::parse('2018-04-10 00:00:00')->isoFormat('DDDo')
        '100',
        // Carbon::parse('2018-02-10 00:00:00', 'Europe/Paris')->isoFormat('h:mm a z')
        '12:00 enne lõunat CET',
        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 enne lõunat, 12:00 enne lõunat',
        // Carbon::parse('2018-02-10 01:30:00')->isoFormat('h:mm A, h:mm a')
        '1:30 enne lõunat, 1:30 enne lõunat',
        // Carbon::parse('2018-02-10 02:00:00')->isoFormat('h:mm A, h:mm a')
        '2:00 enne lõunat, 2:00 enne lõunat',
        // Carbon::parse('2018-02-10 06:00:00')->isoFormat('h:mm A, h:mm a')
        '6:00 enne lõunat, 6:00 enne lõunat',
        // Carbon::parse('2018-02-10 10:00:00')->isoFormat('h:mm A, h:mm a')
        '10:00 enne lõunat, 10:00 enne lõunat',
        // Carbon::parse('2018-02-10 12:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 pärast lõunat, 12:00 pärast lõunat',
        // Carbon::parse('2018-02-10 17:00:00')->isoFormat('h:mm A, h:mm a')
        '5:00 pärast lõunat, 5:00 pärast lõunat',
        // Carbon::parse('2018-02-10 21:30:00')->isoFormat('h:mm A, h:mm a')
        '9:30 pärast lõunat, 9:30 pärast lõunat',
        // Carbon::parse('2018-02-10 23:00:00')->isoFormat('h:mm A, h:mm a')
        '11:00 pärast lõunat, 11:00 pärast lõunat',
        // Carbon::parse('2018-01-01 00:00:00')->ordinal('hour')
        '0',
        // Carbon::now()->subSeconds(1)->diffForHumans()
        '1 sekund tagasi',
        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        '1 s tagasi',
        // Carbon::now()->subSeconds(2)->diffForHumans()
        '2 sekundit tagasi',
        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        '2 s tagasi',
        // Carbon::now()->subMinutes(1)->diffForHumans()
        '1 minut tagasi',
        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        '1 min tagasi',
        // Carbon::now()->subMinutes(2)->diffForHumans()
        '2 minutit tagasi',
        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        '2 min tagasi',
        // Carbon::now()->subHours(1)->diffForHumans()
        '1 tund tagasi',
        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        '1 t tagasi',
        // Carbon::now()->subHours(2)->diffForHumans()
        '2 tundi tagasi',
        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        '2 t tagasi',
        // Carbon::now()->subDays(1)->diffForHumans()
        '1 päev tagasi',
        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        '1 p tagasi',
        // Carbon::now()->subDays(2)->diffForHumans()
        '2 päeva tagasi',
        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        '2 p tagasi',
        // Carbon::now()->subWeeks(1)->diffForHumans()
        '1 nädal tagasi',
        // Carbon::now()->subWeeks(1)->diffForHumans(null, false, true)
        '1 näd tagasi',
        // Carbon::now()->subWeeks(2)->diffForHumans()
        '2 nädalat tagasi',
        // Carbon::now()->subWeeks(2)->diffForHumans(null, false, true)
        '2 näd tagasi',
        // Carbon::now()->subMonths(1)->diffForHumans()
        '1 kuu tagasi',
        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        '1 k tagasi',
        // Carbon::now()->subMonths(2)->diffForHumans()
        '2 kuud tagasi',
        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        '2 k tagasi',
        // Carbon::now()->subYears(1)->diffForHumans()
        '1 aasta tagasi',
        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        '1 a tagasi',
        // Carbon::now()->subYears(2)->diffForHumans()
        '2 aastat tagasi',
        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        '2 a tagasi',
        // Carbon::now()->addSecond()->diffForHumans()
        '1 sekundi pärast',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        '1 s pärast',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now())
        '1 sekund pärast',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), false, true)
        '1 s pärast',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond())
        '1 sekund enne',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond(), false, true)
        '1 s enne',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true)
        '1 sekund',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true, true)
        '1 s',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        '2 sekundit',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        '2 s',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        '1 s pärast',
        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        '1 minut 1 sekund',
        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        '2 a 3 k 1 p 1 s',
        // Carbon::now()->addYears(3)->diffForHumans(null, null, false, 4)
        '3 aasta pärast',
        // Carbon::now()->subMonths(5)->diffForHumans(null, null, true, 4)
        '5 k tagasi',
        // Carbon::now()->subYears(2)->subMonths(3)->subDay()->subSecond()->diffForHumans(null, null, true, 4)
        '2 a 3 k 1 p 1 s tagasi',
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        '1 nädal 10 tundi',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 nädal 6 päeva',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 nädal 6 päeva',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(["join" => true, "parts" => 2])
        '1 nädala ja 6 päeva pärast',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        '2 nädalat 1 tund',
        // Carbon::now()->addHour()->diffForHumans(["aUnit" => true])
        '1 tunni pärast',
        // CarbonInterval::days(2)->forHumans()
        '2 päeva',
        // CarbonInterval::create('P1DT3H')->forHumans(true)
        '1 p 3 t',
    ];
}
