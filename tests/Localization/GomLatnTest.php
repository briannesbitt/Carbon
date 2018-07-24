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

class GomLatnTest extends LocalizationTestCase
{
    const LOCALE = 'gom_Latn'; // Konkani Latin script

    const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Fatlo Son\'var, rati 12:00 vazta',
        // Carbon::now()->subDays(2)->calendar()
        'Ieta to Aitar, rati 8:49 vazta',
        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Faleam rati 10:00 vazta',
        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        'Aiz sokalli 10:00 vazta',
        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Aiz rati 2:00 vazta',
        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        'Kal rati 1:00 vazta',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Fatlo Mongllar, rati 12:00 vazta',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Ieta to Mongllar, rati 12:00 vazta',
        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Ieta to Sukrar, rati 12:00 vazta',
        // Carbon::now()->subSeconds(1)->diffForHumans()
        'ago',
        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        'ago',
        // Carbon::now()->subSeconds(2)->diffForHumans()
        'ago',
        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        'ago',
        // Carbon::now()->subMinutes(1)->diffForHumans()
        'ago',
        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        'ago',
        // Carbon::now()->subMinutes(2)->diffForHumans()
        'ago',
        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        'ago',
        // Carbon::now()->subHours(1)->diffForHumans()
        'ago',
        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        'ago',
        // Carbon::now()->subHours(2)->diffForHumans()
        'ago',
        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        'ago',
        // Carbon::now()->subDays(1)->diffForHumans()
        'ago',
        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        'ago',
        // Carbon::now()->subDays(2)->diffForHumans()
        'ago',
        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        'ago',
        // Carbon::now()->subWeeks(1)->diffForHumans()
        'ago',
        // Carbon::now()->subWeeks(1)->diffForHumans(null, false, true)
        'ago',
        // Carbon::now()->subWeeks(2)->diffForHumans()
        'ago',
        // Carbon::now()->subWeeks(2)->diffForHumans(null, false, true)
        'ago',
        // Carbon::now()->subMonths(1)->diffForHumans()
        'ago',
        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        'ago',
        // Carbon::now()->subMonths(2)->diffForHumans()
        'ago',
        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        'ago',
        // Carbon::now()->subYears(1)->diffForHumans()
        'ago',
        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        'ago',
        // Carbon::now()->subYears(2)->diffForHumans()
        'ago',
        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        'ago',
        // Carbon::now()->addSecond()->diffForHumans()
        'from_now',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        'from_now',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now())
        'after',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), false, true)
        'after',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond())
        'before',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond(), false, true)
        'before',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true)
        ':1 second',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true, true)
        '1s',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        ':2 second',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        '2s',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        'from_now',
        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        '1 minute :1 second',
        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        '2v 3mh 1d 1s',
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        '1 satolleacho 10 hor',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 satolleacho 6 dis',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 satolleacho 6 dis',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        '2 satolleacho 1 hor',
    ];
}
