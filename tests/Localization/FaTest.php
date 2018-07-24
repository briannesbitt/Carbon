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

class FaTest extends LocalizationTestCase
{
    const LOCALE = 'fa'; // Persian

    const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'شنبه پیش ساعت 00:00',
        // Carbon::now()->subDays(2)->calendar()
        'یکu200cشنبه ساعت 20:49',
        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'فردا ساعت 22:00',
        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        'امروز ساعت 10:00',
        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'امروز ساعت 02:00',
        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        'دیروز ساعت 01:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'سهu200cشنبه پیش ساعت 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'سهu200cشنبه ساعت 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'جمعه ساعت 00:00',
        // Carbon::now()->subSeconds(1)->diffForHumans()
        'چند ثانیه پیش',
        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        '1 ثانیه پیش',
        // Carbon::now()->subSeconds(2)->diffForHumans()
        'ثانیه d% پیش',
        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        '2 ثانیه پیش',
        // Carbon::now()->subMinutes(1)->diffForHumans()
        'یک دقیقه پیش',
        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        '1 دقیقه پیش',
        // Carbon::now()->subMinutes(2)->diffForHumans()
        '2 دقیقه پیش',
        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        '2 دقیقه پیش',
        // Carbon::now()->subHours(1)->diffForHumans()
        'یک ساعت پیش',
        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        '1 ساعت پیش',
        // Carbon::now()->subHours(2)->diffForHumans()
        '2 ساعت پیش',
        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        '2 ساعت پیش',
        // Carbon::now()->subDays(1)->diffForHumans()
        'یک روز پیش',
        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        '1 روز پیش',
        // Carbon::now()->subDays(2)->diffForHumans()
        '2 روز پیش',
        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        '2 روز پیش',
        // Carbon::now()->subWeeks(1)->diffForHumans()
        '1 هفته پیش',
        // Carbon::now()->subWeeks(1)->diffForHumans(null, false, true)
        '1 هفته پیش',
        // Carbon::now()->subWeeks(2)->diffForHumans()
        '2 هفته پیش',
        // Carbon::now()->subWeeks(2)->diffForHumans(null, false, true)
        '2 هفته پیش',
        // Carbon::now()->subMonths(1)->diffForHumans()
        'یک ماه پیش',
        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        '1 ماه پیش',
        // Carbon::now()->subMonths(2)->diffForHumans()
        '2 ماه پیش',
        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        '2 ماه پیش',
        // Carbon::now()->subYears(1)->diffForHumans()
        'یک سال پیش',
        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        '1 سال پیش',
        // Carbon::now()->subYears(2)->diffForHumans()
        '2 سال پیش',
        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        '2 سال پیش',
        // Carbon::now()->addSecond()->diffForHumans()
        'در چند ثانیه',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        'در 1 ثانیه',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now())
        'چند ثانیه پس از',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), false, true)
        '1 ثانیه پس از',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond())
        'چند ثانیه پیش از',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond(), false, true)
        '1 ثانیه پیش از',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true)
        'چند ثانیه',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true, true)
        '1 ثانیه',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        'ثانیه d%',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        '2 ثانیه',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        'در 1 ثانیه',
        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        'یک دقیقه چند ثانیه',
        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        '2 سال 3 ماه 1 روز 1 ثانیه',
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        '1 هفته 10 ساعت',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 هفته 6 روز',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 هفته 6 روز',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        '2 هفته یک ساعت',
    ];
}
