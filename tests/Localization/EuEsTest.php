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
class EuEsTest extends LocalizationTestCase
{
    public const LOCALE = 'eu_ES'; // Basque

    public const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'bihar 00:00etan',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'larunbata 00:00etan',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'igandea 00:00etan',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'astelehena 00:00etan',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'asteartea 00:00etan',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'asteazkena 00:00etan',
        // Carbon::parse('2018-01-05 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-05 00:00:00'))
        'osteguna 00:00etan',
        // Carbon::parse('2018-01-06 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-06 00:00:00'))
        'ostirala 00:00etan',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'asteartea 00:00etan',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'asteazkena 00:00etan',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'osteguna 00:00etan',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'ostirala 00:00etan',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'larunbata 00:00etan',
        // Carbon::now()->subDays(2)->calendar()
        'aurreko igandea 20:49etan',
        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'atzo 22:00etan',
        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        'gaur 10:00etan',
        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'gaur 02:00etan',
        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        'bihar 01:00etan',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'asteartea 00:00etan',
        // Carbon::parse('2018-01-08 00:00:00')->subDay()->calendar(Carbon::parse('2018-01-08 00:00:00'))
        'atzo 00:00etan',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'atzo 00:00etan',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'aurreko asteartea 00:00etan',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'aurreko astelehena 00:00etan',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'aurreko igandea 00:00etan',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'aurreko larunbata 00:00etan',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'aurreko ostirala 00:00etan',
        // Carbon::parse('2018-01-03 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-03 00:00:00'))
        'aurreko osteguna 00:00etan',
        // Carbon::parse('2018-01-02 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-02 00:00:00'))
        'aurreko asteazkena 00:00etan',
        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'aurreko ostirala 00:00etan',
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
        '12:00 g CET',
        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 g, 12:00 g',
        // Carbon::parse('2018-02-10 01:30:00')->isoFormat('h:mm A, h:mm a')
        '1:30 g, 1:30 g',
        // Carbon::parse('2018-02-10 02:00:00')->isoFormat('h:mm A, h:mm a')
        '2:00 g, 2:00 g',
        // Carbon::parse('2018-02-10 06:00:00')->isoFormat('h:mm A, h:mm a')
        '6:00 g, 6:00 g',
        // Carbon::parse('2018-02-10 10:00:00')->isoFormat('h:mm A, h:mm a')
        '10:00 g, 10:00 g',
        // Carbon::parse('2018-02-10 12:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 a, 12:00 a',
        // Carbon::parse('2018-02-10 17:00:00')->isoFormat('h:mm A, h:mm a')
        '5:00 a, 5:00 a',
        // Carbon::parse('2018-02-10 21:30:00')->isoFormat('h:mm A, h:mm a')
        '9:30 a, 9:30 a',
        // Carbon::parse('2018-02-10 23:00:00')->isoFormat('h:mm A, h:mm a')
        '11:00 a, 11:00 a',
        // Carbon::parse('2018-01-01 00:00:00')->ordinal('hour')
        '0.',
        // Carbon::now()->subSeconds(1)->diffForHumans()
        'duela segundo batzuk',
        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        'duela Segundu 1',
        // Carbon::now()->subSeconds(2)->diffForHumans()
        'duela 2 segundo',
        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        'duela 2 segundu',
        // Carbon::now()->subMinutes(1)->diffForHumans()
        'duela minutu bat',
        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        'duela Minutu 1',
        // Carbon::now()->subMinutes(2)->diffForHumans()
        'duela 2 minutu',
        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        'duela 2 minutu',
        // Carbon::now()->subHours(1)->diffForHumans()
        'duela ordu bat',
        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        'duela Ordu 1',
        // Carbon::now()->subHours(2)->diffForHumans()
        'duela 2 ordu',
        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        'duela 2 ordu',
        // Carbon::now()->subDays(1)->diffForHumans()
        'duela egun bat',
        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        'duela Egun 1',
        // Carbon::now()->subDays(2)->diffForHumans()
        'duela 2 egun',
        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        'duela 2 egun',
        // Carbon::now()->subWeeks(1)->diffForHumans()
        'duela Aste 1',
        // Carbon::now()->subWeeks(1)->diffForHumans(null, false, true)
        'duela Aste 1',
        // Carbon::now()->subWeeks(2)->diffForHumans()
        'duela 2 aste',
        // Carbon::now()->subWeeks(2)->diffForHumans(null, false, true)
        'duela 2 aste',
        // Carbon::now()->subMonths(1)->diffForHumans()
        'duela hilabete bat',
        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        'duela Hile 1',
        // Carbon::now()->subMonths(2)->diffForHumans()
        'duela 2 hilabete',
        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        'duela 2 hile',
        // Carbon::now()->subYears(1)->diffForHumans()
        'duela urte bat',
        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        'duela Urte 1',
        // Carbon::now()->subYears(2)->diffForHumans()
        'duela 2 urte',
        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        'duela 2 urte',
        // Carbon::now()->addSecond()->diffForHumans()
        'segundo batzuk barru',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        'Segundu 1 barru',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now())
        'segundo batzuk geroago',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), false, true)
        'Segundu 1 geroago',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond())
        'segundo batzuk lehenago',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond(), false, true)
        'Segundu 1 lehenago',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true)
        'segundo batzuk',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true, true)
        'Segundu 1',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        '2 segundo',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        '2 segundu',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        'Segundu 1 barru',
        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        'minutu bat segundo batzuk',
        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        '2 urte 3 hile Egun 1 Segundu 1',
        // Carbon::now()->addYears(3)->diffForHumans(null, null, false, 4)
        '3 urte barru',
        // Carbon::now()->subMonths(5)->diffForHumans(null, null, true, 4)
        'duela 5 hile',
        // Carbon::now()->subYears(2)->subMonths(3)->subDay()->subSecond()->diffForHumans(null, null, true, 4)
        'duela 2 urte 3 hile Egun 1 Segundu 1',
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        'Aste 1 10 ordu',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        'Aste 1 6 egun',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        'Aste 1 6 egun',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(["join" => true, "parts" => 2])
        'Aste 1 eta 6 egun barru',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        '2 aste ordu bat',
        // Carbon::now()->addHour()->diffForHumans(["aUnit" => true])
        'ordu bat barru',
        // CarbonInterval::days(2)->forHumans()
        '2 egun',
        // CarbonInterval::create('P1DT3H')->forHumans(true)
        'Egun 1 3 ordu',
    ];
}
