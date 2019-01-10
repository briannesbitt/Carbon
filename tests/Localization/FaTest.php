<?php

/**
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
        // Carbon::parse('2018-01-04 00:00:00')->addDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'فردا ساعت 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'شنبه ساعت 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'یکu200cشنبه ساعت 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'دوشنبه ساعت 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'سهu200cشنبه ساعت 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'چهارشنبه ساعت 00:00',
        // Carbon::parse('2018-01-05 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-05 00:00:00'))
        'پنجu200cشنبه ساعت 00:00',
        // Carbon::parse('2018-01-06 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-06 00:00:00'))
        'جمعه ساعت 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'سهu200cشنبه ساعت 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'چهارشنبه ساعت 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'پنجu200cشنبه ساعت 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'جمعه ساعت 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'شنبه ساعت 00:00',
        // Carbon::now()->subDays(2)->calendar()
        'یکu200cشنبه پیش ساعت 20:49',
        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'دیروز ساعت 22:00',
        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        'امروز ساعت 10:00',
        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'امروز ساعت 02:00',
        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        'فردا ساعت 01:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'سهu200cشنبه ساعت 00:00',
        // Carbon::parse('2018-01-08 00:00:00')->subDay()->calendar(Carbon::parse('2018-01-08 00:00:00'))
        'دیروز ساعت 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'دیروز ساعت 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'سهu200cشنبه پیش ساعت 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'دوشنبه پیش ساعت 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'یکu200cشنبه پیش ساعت 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'شنبه پیش ساعت 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'جمعه پیش ساعت 00:00',
        // Carbon::parse('2018-01-03 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-03 00:00:00'))
        'پنجu200cشنبه پیش ساعت 00:00',
        // Carbon::parse('2018-01-02 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-02 00:00:00'))
        'چهارشنبه پیش ساعت 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'جمعه پیش ساعت 00:00',
        // Carbon::parse('2018-01-01 00:00:00')->isoFormat('Qo Mo Do Wo wo')
        ':timeم :timeم :timeم :timeم :timeم',
        // Carbon::parse('2018-01-02 00:00:00')->isoFormat('Do wo')
        ':timeم :timeم',
        // Carbon::parse('2018-01-03 00:00:00')->isoFormat('Do wo')
        ':timeم :timeم',
        // Carbon::parse('2018-01-04 00:00:00')->isoFormat('Do wo')
        ':timeم :timeم',
        // Carbon::parse('2018-01-05 00:00:00')->isoFormat('Do wo')
        ':timeم :timeم',
        // Carbon::parse('2018-01-06 00:00:00')->isoFormat('Do wo')
        ':timeم :timeم',
        // Carbon::parse('2018-01-07 00:00:00')->isoFormat('Do wo')
        ':timeم :timeم',
        // Carbon::parse('2018-01-11 00:00:00')->isoFormat('Do wo')
        ':timeم :timeم',
        // Carbon::parse('2018-02-09 00:00:00')->isoFormat('DDDo')
        ':timeم',
        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('DDDo')
        ':timeم',
        // Carbon::parse('2018-04-10 00:00:00')->isoFormat('DDDo')
        ':timeم',
        // Carbon::parse('2018-02-10 00:00:00', 'Europe/Paris')->isoFormat('h:mm a z')
        '12:00 قبل از ظهر cet',
        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 قبل از ظهر, 12:00 قبل از ظهر',
        // Carbon::parse('2018-02-10 01:30:00')->isoFormat('h:mm A, h:mm a')
        '1:30 قبل از ظهر, 1:30 قبل از ظهر',
        // Carbon::parse('2018-02-10 02:00:00')->isoFormat('h:mm A, h:mm a')
        '2:00 قبل از ظهر, 2:00 قبل از ظهر',
        // Carbon::parse('2018-02-10 06:00:00')->isoFormat('h:mm A, h:mm a')
        '6:00 قبل از ظهر, 6:00 قبل از ظهر',
        // Carbon::parse('2018-02-10 10:00:00')->isoFormat('h:mm A, h:mm a')
        '10:00 قبل از ظهر, 10:00 قبل از ظهر',
        // Carbon::parse('2018-02-10 12:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 بعد از ظهر, 12:00 بعد از ظهر',
        // Carbon::parse('2018-02-10 17:00:00')->isoFormat('h:mm A, h:mm a')
        '5:00 بعد از ظهر, 5:00 بعد از ظهر',
        // Carbon::parse('2018-02-10 21:30:00')->isoFormat('h:mm A, h:mm a')
        '9:30 بعد از ظهر, 9:30 بعد از ظهر',
        // Carbon::parse('2018-02-10 23:00:00')->isoFormat('h:mm A, h:mm a')
        '11:00 بعد از ظهر, 11:00 بعد از ظهر',
        // Carbon::parse('2018-01-01 00:00:00')->ordinal('hour')
        ':timeم',
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
        // Carbon::now()->addYears(3)->diffForHumans(null, null, false, 4)
        'در 3 سال',
        // Carbon::now()->subMonths(5)->diffForHumans(null, null, true, 4)
        '5 ماه پیش',
        // Carbon::now()->subYears(2)->subMonths(3)->subDay()->subSecond()->diffForHumans(null, null, true, 4)
        '2 سال 3 ماه 1 روز 1 ثانیه پیش',
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        '1 هفته 10 ساعت',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 هفته 6 روز',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 هفته 6 روز',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        '2 هفته یک ساعت',
        // CarbonInterval::days(2)->forHumans()
        '2 روز',
        // CarbonInterval::create('P1DT3H')->forHumans(true)
        '1 روز 3 ساعت',
    ];
}
