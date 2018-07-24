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

class SvTest extends LocalizationTestCase
{
    const LOCALE = 'sv'; // Swedish

    const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'I lördags 00:00',
        // Carbon::now()->subDays(2)->calendar()
        'På söndag 20:49',
        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Imorgon 22:00',
        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        'Idag 10:00',
        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Idag 02:00',
        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        'Igår 01:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'I tisdags 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'På tisdag 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'På fredag 00:00',
        // Carbon::now()->subSeconds(1)->diffForHumans()
        'för några sekunder sedan',
        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        'för 1 sekund sedan',
        // Carbon::now()->subSeconds(2)->diffForHumans()
        'för 2 sekunder sedan',
        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        'för 2 sekunder sedan',
        // Carbon::now()->subMinutes(1)->diffForHumans()
        'för en minut sedan',
        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        'för 1 minut sedan',
        // Carbon::now()->subMinutes(2)->diffForHumans()
        'för 2 minuter sedan',
        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        'för 2 minuter sedan',
        // Carbon::now()->subHours(1)->diffForHumans()
        'för en timme sedan',
        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        'för 1 timme sedan',
        // Carbon::now()->subHours(2)->diffForHumans()
        'för 2 timmar sedan',
        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        'för 2 timmar sedan',
        // Carbon::now()->subDays(1)->diffForHumans()
        'för en dag sedan',
        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        'för 1 dag sedan',
        // Carbon::now()->subDays(2)->diffForHumans()
        'för 2 dagar sedan',
        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        'för 2 dagar sedan',
        // Carbon::now()->subWeeks(1)->diffForHumans()
        'för 1 vecka sedan',
        // Carbon::now()->subWeeks(1)->diffForHumans(null, false, true)
        'för 1 vecka sedan',
        // Carbon::now()->subWeeks(2)->diffForHumans()
        'för 2 veckor sedan',
        // Carbon::now()->subWeeks(2)->diffForHumans(null, false, true)
        'för 2 veckor sedan',
        // Carbon::now()->subMonths(1)->diffForHumans()
        'för en månad sedan',
        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        'för 1 månad sedan',
        // Carbon::now()->subMonths(2)->diffForHumans()
        'för 2 månader sedan',
        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        'för 2 månader sedan',
        // Carbon::now()->subYears(1)->diffForHumans()
        'för ett år sedan',
        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        'för 1 år sedan',
        // Carbon::now()->subYears(2)->diffForHumans()
        'för 2 år sedan',
        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        'för 2 år sedan',
        // Carbon::now()->addSecond()->diffForHumans()
        'om några sekunder',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        'om 1 sekund',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now())
        'några sekunder efter',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), false, true)
        '1 sekund efter',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond())
        'några sekunder före',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond(), false, true)
        '1 sekund före',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true)
        'några sekunder',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true, true)
        '1 sekund',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        '2 sekunder',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        '2 sekunder',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        'om 1 sekund',
        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        'en minut några sekunder',
        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        '2 år 3 månader 1 dag 1 sekund',
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        '1 vecka 10 timmar',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 vecka 6 dagar',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 vecka 6 dagar',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        '2 veckor en timme',
    ];
}
