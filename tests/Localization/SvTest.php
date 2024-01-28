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
class SvTest extends LocalizationTestCase
{
    public const LOCALE = 'sv'; // Swedish

    public const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'I morgon 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'På lördag 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'På söndag 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'På måndag 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'På tisdag 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'På onsdag 00:00',
        // Carbon::parse('2018-01-05 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-05 00:00:00'))
        'På torsdag 00:00',
        // Carbon::parse('2018-01-06 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-06 00:00:00'))
        'På fredag 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'På tisdag 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'På onsdag 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'På torsdag 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'På fredag 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'På lördag 00:00',
        // Carbon::now()->subDays(2)->calendar()
        'I söndags 20:49',
        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'I går 22:00',
        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        'I dag 10:00',
        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'I dag 02:00',
        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        'I morgon 01:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'På tisdag 00:00',
        // Carbon::parse('2018-01-08 00:00:00')->subDay()->calendar(Carbon::parse('2018-01-08 00:00:00'))
        'I går 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'I går 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'I tisdags 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'I måndags 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'I söndags 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'I lördags 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'I fredags 00:00',
        // Carbon::parse('2018-01-03 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-03 00:00:00'))
        'I torsdags 00:00',
        // Carbon::parse('2018-01-02 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-02 00:00:00'))
        'I onsdags 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'I fredags 00:00',
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
        '12:00 fm CET',
        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 fm, 12:00 fm',
        // Carbon::parse('2018-02-10 01:30:00')->isoFormat('h:mm A, h:mm a')
        '1:30 fm, 1:30 fm',
        // Carbon::parse('2018-02-10 02:00:00')->isoFormat('h:mm A, h:mm a')
        '2:00 fm, 2:00 fm',
        // Carbon::parse('2018-02-10 06:00:00')->isoFormat('h:mm A, h:mm a')
        '6:00 fm, 6:00 fm',
        // Carbon::parse('2018-02-10 10:00:00')->isoFormat('h:mm A, h:mm a')
        '10:00 fm, 10:00 fm',
        // Carbon::parse('2018-02-10 12:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 em, 12:00 em',
        // Carbon::parse('2018-02-10 17:00:00')->isoFormat('h:mm A, h:mm a')
        '5:00 em, 5:00 em',
        // Carbon::parse('2018-02-10 21:30:00')->isoFormat('h:mm A, h:mm a')
        '9:30 em, 9:30 em',
        // Carbon::parse('2018-02-10 23:00:00')->isoFormat('h:mm A, h:mm a')
        '11:00 em, 11:00 em',
        // Carbon::parse('2018-01-01 00:00:00')->ordinal('hour')
        '0e',
        // Carbon::now()->subSeconds(1)->diffForHumans()
        'för 1 sekund sedan',
        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        'för 1 s sedan',
        // Carbon::now()->subSeconds(2)->diffForHumans()
        'för 2 sekunder sedan',
        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        'för 2 s sedan',
        // Carbon::now()->subMinutes(1)->diffForHumans()
        'för 1 minut sedan',
        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        'för 1 min sedan',
        // Carbon::now()->subMinutes(2)->diffForHumans()
        'för 2 minuter sedan',
        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        'för 2 min sedan',
        // Carbon::now()->subHours(1)->diffForHumans()
        'för 1 timme sedan',
        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        'för 1 tim sedan',
        // Carbon::now()->subHours(2)->diffForHumans()
        'för 2 timmar sedan',
        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        'för 2 tim sedan',
        // Carbon::now()->subDays(1)->diffForHumans()
        'för 1 dag sedan',
        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        'för 1 dgr sedan',
        // Carbon::now()->subDays(2)->diffForHumans()
        'för 2 dagar sedan',
        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        'för 2 dgr sedan',
        // Carbon::now()->subWeeks(1)->diffForHumans()
        'för 1 vecka sedan',
        // Carbon::now()->subWeeks(1)->diffForHumans(null, false, true)
        'för 1 v sedan',
        // Carbon::now()->subWeeks(2)->diffForHumans()
        'för 2 veckor sedan',
        // Carbon::now()->subWeeks(2)->diffForHumans(null, false, true)
        'för 2 v sedan',
        // Carbon::now()->subMonths(1)->diffForHumans()
        'för 1 månad sedan',
        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        'för 1 mån sedan',
        // Carbon::now()->subMonths(2)->diffForHumans()
        'för 2 månader sedan',
        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        'för 2 mån sedan',
        // Carbon::now()->subYears(1)->diffForHumans()
        'för 1 år sedan',
        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        'för 1 år sedan',
        // Carbon::now()->subYears(2)->diffForHumans()
        'för 2 år sedan',
        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        'för 2 år sedan',
        // Carbon::now()->addSecond()->diffForHumans()
        'om 1 sekund',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        'om 1 s',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now())
        '1 sekund efter',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), false, true)
        '1 s efter',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond())
        '1 sekund före',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond(), false, true)
        '1 s före',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true)
        '1 sekund',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true, true)
        '1 s',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        '2 sekunder',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        '2 s',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        'om 1 s',
        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        '1 minut 1 sekund',
        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        '2 år 3 mån 1 dgr 1 s',
        // Carbon::now()->addYears(3)->diffForHumans(null, null, false, 4)
        'om 3 år',
        // Carbon::now()->subMonths(5)->diffForHumans(null, null, true, 4)
        'för 5 mån sedan',
        // Carbon::now()->subYears(2)->subMonths(3)->subDay()->subSecond()->diffForHumans(null, null, true, 4)
        'för 2 år 3 mån 1 dgr 1 s sedan',
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        '1 vecka 10 timmar',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 vecka 6 dagar',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 vecka 6 dagar',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(["join" => true, "parts" => 2])
        'om 1 vecka och 6 dagar',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        '2 veckor 1 timme',
        // Carbon::now()->addHour()->diffForHumans(["aUnit" => true])
        'om en timme',
        // CarbonInterval::days(2)->forHumans()
        '2 dagar',
        // CarbonInterval::create('P1DT3H')->forHumans(true)
        '1 dgr 3 tim',
    ];
}
