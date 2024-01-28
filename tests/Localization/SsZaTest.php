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
class SsZaTest extends LocalizationTestCase
{
    public const LOCALE = 'ss_ZA'; // Swati

    public const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Kusasa nga 12:00 ekuseni',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Umgcibelo nga 12:00 ekuseni',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Lisontfo nga 12:00 ekuseni',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Umsombuluko nga 12:00 ekuseni',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Lesibili nga 12:00 ekuseni',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Lesitsatfu nga 12:00 ekuseni',
        // Carbon::parse('2018-01-05 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-05 00:00:00'))
        'Lesine nga 12:00 ekuseni',
        // Carbon::parse('2018-01-06 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-06 00:00:00'))
        'Lesihlanu nga 12:00 ekuseni',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Lesibili nga 12:00 ekuseni',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Lesitsatfu nga 12:00 ekuseni',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Lesine nga 12:00 ekuseni',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Lesihlanu nga 12:00 ekuseni',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Umgcibelo nga 12:00 ekuseni',
        // Carbon::now()->subDays(2)->calendar()
        'Lisontfo leliphelile nga 8:49 ebusuku',
        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Itolo nga 10:00 ebusuku',
        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        'Namuhla nga 10:00 ekuseni',
        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Namuhla nga 2:00 ekuseni',
        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        'Kusasa nga 1:00 ekuseni',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Lesibili nga 12:00 ekuseni',
        // Carbon::parse('2018-01-08 00:00:00')->subDay()->calendar(Carbon::parse('2018-01-08 00:00:00'))
        'Itolo nga 12:00 ekuseni',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Itolo nga 12:00 ekuseni',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Lesibili leliphelile nga 12:00 ekuseni',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Umsombuluko leliphelile nga 12:00 ekuseni',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Lisontfo leliphelile nga 12:00 ekuseni',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Umgcibelo leliphelile nga 12:00 ekuseni',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Lesihlanu leliphelile nga 12:00 ekuseni',
        // Carbon::parse('2018-01-03 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-03 00:00:00'))
        'Lesine leliphelile nga 12:00 ekuseni',
        // Carbon::parse('2018-01-02 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-02 00:00:00'))
        'Lesitsatfu leliphelile nga 12:00 ekuseni',
        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Lesihlanu leliphelile nga 12:00 ekuseni',
        // Carbon::parse('2018-01-01 00:00:00')->isoFormat('Qo Mo Do Wo wo')
        '1a 1a 1a 1a 1a',
        // Carbon::parse('2018-01-02 00:00:00')->isoFormat('Do wo')
        '2a 1a',
        // Carbon::parse('2018-01-03 00:00:00')->isoFormat('Do wo')
        '3e 1a',
        // Carbon::parse('2018-01-04 00:00:00')->isoFormat('Do wo')
        '4e 1a',
        // Carbon::parse('2018-01-05 00:00:00')->isoFormat('Do wo')
        '5e 1a',
        // Carbon::parse('2018-01-06 00:00:00')->isoFormat('Do wo')
        '6e 1a',
        // Carbon::parse('2018-01-07 00:00:00')->isoFormat('Do wo')
        '7e 1a',
        // Carbon::parse('2018-01-11 00:00:00')->isoFormat('Do wo')
        '11e 2a',
        // Carbon::parse('2018-02-09 00:00:00')->isoFormat('DDDo')
        '40e',
        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('DDDo')
        '41a',
        // Carbon::parse('2018-04-10 00:00:00')->isoFormat('DDDo')
        '100e',
        // Carbon::parse('2018-02-10 00:00:00', 'Europe/Paris')->isoFormat('h:mm a z')
        '12:00 ekuseni CET',
        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 ekuseni, 12:00 ekuseni',
        // Carbon::parse('2018-02-10 01:30:00')->isoFormat('h:mm A, h:mm a')
        '1:30 ekuseni, 1:30 ekuseni',
        // Carbon::parse('2018-02-10 02:00:00')->isoFormat('h:mm A, h:mm a')
        '2:00 ekuseni, 2:00 ekuseni',
        // Carbon::parse('2018-02-10 06:00:00')->isoFormat('h:mm A, h:mm a')
        '6:00 ekuseni, 6:00 ekuseni',
        // Carbon::parse('2018-02-10 10:00:00')->isoFormat('h:mm A, h:mm a')
        '10:00 ekuseni, 10:00 ekuseni',
        // Carbon::parse('2018-02-10 12:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 emini, 12:00 emini',
        // Carbon::parse('2018-02-10 17:00:00')->isoFormat('h:mm A, h:mm a')
        '5:00 entsambama, 5:00 entsambama',
        // Carbon::parse('2018-02-10 21:30:00')->isoFormat('h:mm A, h:mm a')
        '9:30 ebusuku, 9:30 ebusuku',
        // Carbon::parse('2018-02-10 23:00:00')->isoFormat('h:mm A, h:mm a')
        '11:00 ebusuku, 11:00 ebusuku',
        // Carbon::parse('2018-01-01 00:00:00')->ordinal('hour')
        '0e',
        // Carbon::now()->subSeconds(1)->diffForHumans()
        'wenteka nga emizuzwana lomcane',
        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        'wenteka nga emizuzwana lomcane',
        // Carbon::now()->subSeconds(2)->diffForHumans()
        'wenteka nga 2 mzuzwana',
        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        'wenteka nga 2 mzuzwana',
        // Carbon::now()->subMinutes(1)->diffForHumans()
        'wenteka nga umzuzu',
        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        'wenteka nga umzuzu',
        // Carbon::now()->subMinutes(2)->diffForHumans()
        'wenteka nga 2 emizuzu',
        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        'wenteka nga 2 emizuzu',
        // Carbon::now()->subHours(1)->diffForHumans()
        'wenteka nga lihora',
        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        'wenteka nga lihora',
        // Carbon::now()->subHours(2)->diffForHumans()
        'wenteka nga 2 emahora',
        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        'wenteka nga 2 emahora',
        // Carbon::now()->subDays(1)->diffForHumans()
        'wenteka nga lilanga',
        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        'wenteka nga lilanga',
        // Carbon::now()->subDays(2)->diffForHumans()
        'wenteka nga 2 emalanga',
        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        'wenteka nga 2 emalanga',
        // Carbon::now()->subWeeks(1)->diffForHumans()
        'wenteka nga 1 liviki',
        // Carbon::now()->subWeeks(1)->diffForHumans(null, false, true)
        'wenteka nga 1 liviki',
        // Carbon::now()->subWeeks(2)->diffForHumans()
        'wenteka nga 2 emaviki',
        // Carbon::now()->subWeeks(2)->diffForHumans(null, false, true)
        'wenteka nga 2 emaviki',
        // Carbon::now()->subMonths(1)->diffForHumans()
        'wenteka nga inyanga',
        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        'wenteka nga inyanga',
        // Carbon::now()->subMonths(2)->diffForHumans()
        'wenteka nga 2 tinyanga',
        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        'wenteka nga 2 tinyanga',
        // Carbon::now()->subYears(1)->diffForHumans()
        'wenteka nga umnyaka',
        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        'wenteka nga umnyaka',
        // Carbon::now()->subYears(2)->diffForHumans()
        'wenteka nga 2 iminyaka',
        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        'wenteka nga 2 iminyaka',
        // Carbon::now()->addSecond()->diffForHumans()
        'nga emizuzwana lomcane',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        'nga emizuzwana lomcane',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now())
        'after',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), false, true)
        'after',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond())
        'before',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond(), false, true)
        'before',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true)
        'emizuzwana lomcane',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true, true)
        'emizuzwana lomcane',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        '2 mzuzwana',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        '2 mzuzwana',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        'nga emizuzwana lomcane',
        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        'umzuzu emizuzwana lomcane',
        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        '2 iminyaka 3 tinyanga lilanga emizuzwana lomcane',
        // Carbon::now()->addYears(3)->diffForHumans(null, null, false, 4)
        'nga 3 iminyaka',
        // Carbon::now()->subMonths(5)->diffForHumans(null, null, true, 4)
        'wenteka nga 5 tinyanga',
        // Carbon::now()->subYears(2)->subMonths(3)->subDay()->subSecond()->diffForHumans(null, null, true, 4)
        'wenteka nga 2 iminyaka 3 tinyanga lilanga emizuzwana lomcane',
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        '1 liviki 10 emahora',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 liviki 6 emalanga',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 liviki 6 emalanga',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(["join" => true, "parts" => 2])
        'nga 1 liviki 6 emalanga',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        '2 emaviki lihora',
        // Carbon::now()->addHour()->diffForHumans(["aUnit" => true])
        'nga lihora',
        // CarbonInterval::days(2)->forHumans()
        '2 emalanga',
        // CarbonInterval::create('P1DT3H')->forHumans(true)
        'lilanga 3 emahora',
    ];
}
