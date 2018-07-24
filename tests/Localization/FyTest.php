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

class FyTest extends LocalizationTestCase
{
    const LOCALE = 'fy'; // WesternFrisian

    const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'ôfrûne sneon om 00:00',
        // Carbon::now()->subDays(2)->calendar()
        'snein om 20:49',
        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'moarn om 22:00',
        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        'hjoed om 10:00',
        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'hjoed om 02:00',
        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        'juster om 01:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'ôfrûne tiisdei om 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'tiisdei om 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'freed om 00:00',
        // Carbon::now()->subSeconds(1)->diffForHumans()
        'in pear sekonden lyn',
        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        's lyn',
        // Carbon::now()->subSeconds(2)->diffForHumans()
        '2 sekonden lyn',
        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        's lyn',
        // Carbon::now()->subMinutes(1)->diffForHumans()
        'ien minút lyn',
        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        'min lyn',
        // Carbon::now()->subMinutes(2)->diffForHumans()
        '2 minuten lyn',
        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        'min lyn',
        // Carbon::now()->subHours(1)->diffForHumans()
        'ien oere lyn',
        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        'h lyn',
        // Carbon::now()->subHours(2)->diffForHumans()
        '2 oeren lyn',
        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        'h lyn',
        // Carbon::now()->subDays(1)->diffForHumans()
        'ien dei lyn',
        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        'd lyn',
        // Carbon::now()->subDays(2)->diffForHumans()
        '2 dagen lyn',
        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        'd lyn',
        // Carbon::now()->subWeeks(1)->diffForHumans()
        'in wike lyn',
        // Carbon::now()->subWeeks(1)->diffForHumans(null, false, true)
        'w lyn',
        // Carbon::now()->subWeeks(2)->diffForHumans()
        '2 wiken lyn',
        // Carbon::now()->subWeeks(2)->diffForHumans(null, false, true)
        'w lyn',
        // Carbon::now()->subMonths(1)->diffForHumans()
        'ien moanne lyn',
        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        'm lyn',
        // Carbon::now()->subMonths(2)->diffForHumans()
        '2 moannen lyn',
        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        'm lyn',
        // Carbon::now()->subYears(1)->diffForHumans()
        'ien jier lyn',
        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        'y lyn',
        // Carbon::now()->subYears(2)->diffForHumans()
        '2 jierren lyn',
        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        'y lyn',
        // Carbon::now()->addSecond()->diffForHumans()
        'oer in pear sekonden',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        'oer s',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now())
        'after',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), false, true)
        'after',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond())
        'before',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond(), false, true)
        'before',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true)
        'in pear sekonden',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true, true)
        's',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        '2 sekonden',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        's',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        'oer s',
        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        'ien minút in pear sekonden',
        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        'y m d s',
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        'in wike 10 oeren',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        'in wike 6 dagen',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        'in wike 6 dagen',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        '2 wiken ien oere',
    ];
}
