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

class SsTest extends LocalizationTestCase
{
    const LOCALE = 'ss'; // Swati

    const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Umgcibelo leliphelile nga 12:00 ekuseni',
        // Carbon::now()->subDays(2)->calendar()
        'Lisontfo nga 8:49 ebusuku',
        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Kusasa nga 10:00 ebusuku',
        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        'Namuhla nga 10:00 ekuseni',
        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Namuhla nga 2:00 ekuseni',
        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        'Itolo nga 1:00 ekuseni',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Lesibili leliphelile nga 12:00 ekuseni',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Lesibili nga 12:00 ekuseni',
        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Lesihlanu nga 12:00 ekuseni',
        // Carbon::now()->subSeconds(1)->diffForHumans()
        'wenteka nga emizuzwana lomcane',
        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        'wenteka nga s',
        // Carbon::now()->subSeconds(2)->diffForHumans()
        'wenteka nga 2 mzuzwana',
        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        'wenteka nga s',
        // Carbon::now()->subMinutes(1)->diffForHumans()
        'wenteka nga umzuzu',
        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        'wenteka nga min',
        // Carbon::now()->subMinutes(2)->diffForHumans()
        'wenteka nga 2 emizuzu',
        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        'wenteka nga min',
        // Carbon::now()->subHours(1)->diffForHumans()
        'wenteka nga lihora',
        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        'wenteka nga h',
        // Carbon::now()->subHours(2)->diffForHumans()
        'wenteka nga 2 emahora',
        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        'wenteka nga h',
        // Carbon::now()->subDays(1)->diffForHumans()
        'wenteka nga lilanga',
        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        'wenteka nga d',
        // Carbon::now()->subDays(2)->diffForHumans()
        'wenteka nga 2 emalanga',
        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        'wenteka nga d',
        // Carbon::now()->subWeeks(1)->diffForHumans()
        'wenteka nga 1 liviki',
        // Carbon::now()->subWeeks(1)->diffForHumans(null, false, true)
        'wenteka nga w',
        // Carbon::now()->subWeeks(2)->diffForHumans()
        'wenteka nga 2 emaviki',
        // Carbon::now()->subWeeks(2)->diffForHumans(null, false, true)
        'wenteka nga w',
        // Carbon::now()->subMonths(1)->diffForHumans()
        'wenteka nga inyanga',
        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        'wenteka nga m',
        // Carbon::now()->subMonths(2)->diffForHumans()
        'wenteka nga 2 tinyanga',
        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        'wenteka nga m',
        // Carbon::now()->subYears(1)->diffForHumans()
        'wenteka nga umnyaka',
        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        'wenteka nga y',
        // Carbon::now()->subYears(2)->diffForHumans()
        'wenteka nga 2 iminyaka',
        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        'wenteka nga y',
        // Carbon::now()->addSecond()->diffForHumans()
        'nga emizuzwana lomcane',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        'nga s',
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
        's',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        '2 mzuzwana',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        's',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        'nga s',
        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        'umzuzu emizuzwana lomcane',
        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        'y m d s',
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        '1 liviki 10 emahora',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 liviki 6 emalanga',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 liviki 6 emalanga',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        '2 emaviki lihora',
    ];
}
