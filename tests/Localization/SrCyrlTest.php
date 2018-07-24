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

class SrCyrlTest extends LocalizationTestCase
{
    const LOCALE = 'sr_Cyrl'; // Serbian

    const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'прошле суботе у 0:00',
        // Carbon::now()->subDays(2)->calendar()
        'у недељу у 20:49',
        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'сутра у 22:00',
        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        'данас у 10:00',
        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'данас у 2:00',
        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        'јуче у 1:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'прошлог уторка у 0:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'у уторак у 0:00',
        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'у петак у 0:00',
        // Carbon::now()->subSeconds(1)->diffForHumans()
        'пре 1 секунд',
        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        'пре 1 сек.',
        // Carbon::now()->subSeconds(2)->diffForHumans()
        'пре 2 секунде',
        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        'пре 2 сек.',
        // Carbon::now()->subMinutes(1)->diffForHumans()
        'пре 1 минут',
        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        'пре 1 мин.',
        // Carbon::now()->subMinutes(2)->diffForHumans()
        'пре 2 минута',
        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        'пре 2 мин.',
        // Carbon::now()->subHours(1)->diffForHumans()
        'пре 1 сат',
        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        'пре 1 ч.',
        // Carbon::now()->subHours(2)->diffForHumans()
        'пре 2 сата',
        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        'пре 2 ч.',
        // Carbon::now()->subDays(1)->diffForHumans()
        'пре 1 дан',
        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        'пре 1 д.',
        // Carbon::now()->subDays(2)->diffForHumans()
        'пре 2 дана',
        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        'пре 2 д.',
        // Carbon::now()->subWeeks(1)->diffForHumans()
        'пре 1 недељу',
        // Carbon::now()->subWeeks(1)->diffForHumans(null, false, true)
        'пре 1 нед.',
        // Carbon::now()->subWeeks(2)->diffForHumans()
        'пре 2 недеље',
        // Carbon::now()->subWeeks(2)->diffForHumans(null, false, true)
        'пре 2 нед.',
        // Carbon::now()->subMonths(1)->diffForHumans()
        'пре 1 месец',
        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        'пре 1 м.',
        // Carbon::now()->subMonths(2)->diffForHumans()
        'пре 2 месеца',
        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        'пре 2 м.',
        // Carbon::now()->subYears(1)->diffForHumans()
        'пре 1 годину',
        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        'пре 1 г.',
        // Carbon::now()->subYears(2)->diffForHumans()
        'пре 2 године',
        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        'пре 2 г.',
        // Carbon::now()->addSecond()->diffForHumans()
        'за 1 секунд',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        'за 1 сек.',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now())
        '1 секунд након',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), false, true)
        '1 сек. након',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond())
        '1 секунд пре',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond(), false, true)
        '1 сек. пре',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true)
        '1 секунд',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true, true)
        '1 сек.',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        '2 секунде',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        '2 сек.',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        'за 1 сек.',
        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        '1 минут 1 секунд',
        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        '2 г. 3 м. 1 д. 1 сек.',
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        '1 недеља 10 сати',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 недеља 6 дана',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 недеља 6 дана',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        '2 недеље 1 сат',
    ];
}
