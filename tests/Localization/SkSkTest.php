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
class SkSkTest extends LocalizationTestCase
{
    public const LOCALE = 'sk_SK'; // Slovak

    public const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'zajtra o 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'sobota o 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'nedeľa o 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'pondelok o 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'utorok o 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'streda o 00:00',
        // Carbon::parse('2018-01-05 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-05 00:00:00'))
        'štvrtok o 00:00',
        // Carbon::parse('2018-01-06 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-06 00:00:00'))
        'piatok o 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'utorok o 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'streda o 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'štvrtok o 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'piatok o 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'sobota o 00:00',
        // Carbon::now()->subDays(2)->calendar()
        'minulá nedeľa o 20:49',
        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'včera o 22:00',
        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        'dnes o 10:00',
        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'dnes o 02:00',
        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        'zajtra o 01:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'utorok o 00:00',
        // Carbon::parse('2018-01-08 00:00:00')->subDay()->calendar(Carbon::parse('2018-01-08 00:00:00'))
        'včera o 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'včera o 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'minulý utorok o 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'minulý pondelok o 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'minulá nedeľa o 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'minulá sobota o 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'minulý piatok o 00:00',
        // Carbon::parse('2018-01-03 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-03 00:00:00'))
        'minulý štvrtok o 00:00',
        // Carbon::parse('2018-01-02 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-02 00:00:00'))
        'minulá streda o 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'minulý piatok o 00:00',
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
        '12:00 dopoludnia CET',
        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 dopoludnia, 12:00 dopoludnia',
        // Carbon::parse('2018-02-10 01:30:00')->isoFormat('h:mm A, h:mm a')
        '1:30 dopoludnia, 1:30 dopoludnia',
        // Carbon::parse('2018-02-10 02:00:00')->isoFormat('h:mm A, h:mm a')
        '2:00 dopoludnia, 2:00 dopoludnia',
        // Carbon::parse('2018-02-10 06:00:00')->isoFormat('h:mm A, h:mm a')
        '6:00 dopoludnia, 6:00 dopoludnia',
        // Carbon::parse('2018-02-10 10:00:00')->isoFormat('h:mm A, h:mm a')
        '10:00 dopoludnia, 10:00 dopoludnia',
        // Carbon::parse('2018-02-10 12:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 popoludní, 12:00 popoludní',
        // Carbon::parse('2018-02-10 17:00:00')->isoFormat('h:mm A, h:mm a')
        '5:00 popoludní, 5:00 popoludní',
        // Carbon::parse('2018-02-10 21:30:00')->isoFormat('h:mm A, h:mm a')
        '9:30 popoludní, 9:30 popoludní',
        // Carbon::parse('2018-02-10 23:00:00')->isoFormat('h:mm A, h:mm a')
        '11:00 popoludní, 11:00 popoludní',
        // Carbon::parse('2018-01-01 00:00:00')->ordinal('hour')
        '0',
        // Carbon::now()->subSeconds(1)->diffForHumans()
        'pred 1 sekundou',
        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        'pred 1 s',
        // Carbon::now()->subSeconds(2)->diffForHumans()
        'pred 2 sekundami',
        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        'pred 2 s',
        // Carbon::now()->subMinutes(1)->diffForHumans()
        'pred 1 minútou',
        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        'pred 1 min',
        // Carbon::now()->subMinutes(2)->diffForHumans()
        'pred 2 minútami',
        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        'pred 2 min',
        // Carbon::now()->subHours(1)->diffForHumans()
        'pred 1 hodinou',
        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        'pred 1 h',
        // Carbon::now()->subHours(2)->diffForHumans()
        'pred 2 hodinami',
        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        'pred 2 h',
        // Carbon::now()->subDays(1)->diffForHumans()
        'pred 1 dňom',
        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        'pred 1 d',
        // Carbon::now()->subDays(2)->diffForHumans()
        'pred 2 dňami',
        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        'pred 2 d',
        // Carbon::now()->subWeeks(1)->diffForHumans()
        'pred 1 týždňom',
        // Carbon::now()->subWeeks(1)->diffForHumans(null, false, true)
        'pred 1 t',
        // Carbon::now()->subWeeks(2)->diffForHumans()
        'pred 2 týždňami',
        // Carbon::now()->subWeeks(2)->diffForHumans(null, false, true)
        'pred 2 t',
        // Carbon::now()->subMonths(1)->diffForHumans()
        'pred 1 mesiacom',
        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        'pred 1 m',
        // Carbon::now()->subMonths(2)->diffForHumans()
        'pred 2 mesiacmi',
        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        'pred 2 m',
        // Carbon::now()->subYears(1)->diffForHumans()
        'pred 1 rokom',
        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        'pred 1 r',
        // Carbon::now()->subYears(2)->diffForHumans()
        'pred 2 rokmi',
        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        'pred 2 r',
        // Carbon::now()->addSecond()->diffForHumans()
        'o 1 sekundu',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        'o 1 s',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now())
        '1 sekundu po',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), false, true)
        '1 s po',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond())
        '1 sekundu pred',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond(), false, true)
        '1 s pred',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true)
        '1 sekunda',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true, true)
        '1 s',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        '2 sekundy',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        '2 s',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        'o 1 s',
        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        '1 minúta 1 sekunda',
        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        '2 r 3 m 1 d 1 s',
        // Carbon::now()->addYears(3)->diffForHumans(null, null, false, 4)
        'o 3 roky',
        // Carbon::now()->subMonths(5)->diffForHumans(null, null, true, 4)
        'pred 5 m',
        // Carbon::now()->subYears(2)->subMonths(3)->subDay()->subSecond()->diffForHumans(null, null, true, 4)
        'pred 2 r 3 m 1 d 1 s',
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        '1 týždeň 10 hodín',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 týždeň 6 dní',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 týždeň 6 dní',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(["join" => true, "parts" => 2])
        'o 1 týždeň a 6 dní',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        '2 týždne 1 hodina',
        // Carbon::now()->addHour()->diffForHumans(["aUnit" => true])
        'o hodinu',
        // CarbonInterval::days(2)->forHumans()
        '2 dni',
        // CarbonInterval::create('P1DT3H')->forHumans(true)
        '1 d 3 h',
    ];
}
