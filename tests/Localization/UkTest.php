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

class UkTest extends LocalizationTestCase
{
    const LOCALE = 'uk'; // Ukrainian

    const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Минулої субота о 00:00',
        // Carbon::now()->subDays(2)->calendar()
        'У неділя о 20:49',
        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Завтра о 22:00',
        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        'Сьогодні о 10:00',
        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Сьогодні о 02:00',
        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        'Вчора о 01:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Минулого вівторок о 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'У вівторок о 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'У п’ятниця о 00:00',
        // Carbon::now()->subSeconds(1)->diffForHumans()
        '1 секунду тому',
        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        '1 секунду тому',
        // Carbon::now()->subSeconds(2)->diffForHumans()
        '2 секунди тому',
        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        '2 секунди тому',
        // Carbon::now()->subMinutes(1)->diffForHumans()
        '1 хвилину тому',
        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        '1 хвилину тому',
        // Carbon::now()->subMinutes(2)->diffForHumans()
        '2 хвилини тому',
        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        '2 хвилини тому',
        // Carbon::now()->subHours(1)->diffForHumans()
        '1 година тому',
        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        '1 година тому',
        // Carbon::now()->subHours(2)->diffForHumans()
        '2 години тому',
        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        '2 години тому',
        // Carbon::now()->subDays(1)->diffForHumans()
        '1 день тому',
        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        '1 день тому',
        // Carbon::now()->subDays(2)->diffForHumans()
        '2 дні тому',
        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        '2 дні тому',
        // Carbon::now()->subWeeks(1)->diffForHumans()
        '1 тиждень тому',
        // Carbon::now()->subWeeks(1)->diffForHumans(null, false, true)
        '1 тиждень тому',
        // Carbon::now()->subWeeks(2)->diffForHumans()
        '2 тижні тому',
        // Carbon::now()->subWeeks(2)->diffForHumans(null, false, true)
        '2 тижні тому',
        // Carbon::now()->subMonths(1)->diffForHumans()
        '1 місяць тому',
        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        '1 місяць тому',
        // Carbon::now()->subMonths(2)->diffForHumans()
        '2 місяці тому',
        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        '2 місяці тому',
        // Carbon::now()->subYears(1)->diffForHumans()
        '1 рік тому',
        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        '1 рік тому',
        // Carbon::now()->subYears(2)->diffForHumans()
        '2 роки тому',
        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        '2 роки тому',
        // Carbon::now()->addSecond()->diffForHumans()
        'за 1 секунду',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        'за 1 секунду',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now())
        '1 секунду після',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), false, true)
        '1 секунду після',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond())
        '1 секунду до',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond(), false, true)
        '1 секунду до',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true)
        '1 секунду',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true, true)
        '1 секунду',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        '2 секунди',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        '2 секунди',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        'за 1 секунду',
        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        '1 хвилину 1 секунду',
        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        '2 роки 3 місяці 1 день 1 секунду',
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        '1 тиждень 10 годин',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 тиждень 6 днів',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 тиждень 6 днів',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        '2 тижні 1 година',
    ];
}
