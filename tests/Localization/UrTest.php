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

class UrTest extends LocalizationTestCase
{
    const LOCALE = 'ur'; // Urdu

    const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'گذشتہ ہفتہ بوقت 00:00',
        // Carbon::now()->subDays(2)->calendar()
        'اتوار بوقت 20:49',
        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'کل بوقت 22:00',
        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        'آج بوقت 10:00',
        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'آج بوقت 02:00',
        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        'گذشتہ روز بوقت 01:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'گذشتہ منگل بوقت 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'منگل بوقت 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'جمعہ بوقت 00:00',
        // Carbon::now()->subSeconds(1)->diffForHumans()
        'چند سیکنڈ قبل',
        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        's قبل',
        // Carbon::now()->subSeconds(2)->diffForHumans()
        '2 سیکنڈ قبل',
        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        's قبل',
        // Carbon::now()->subMinutes(1)->diffForHumans()
        'ایک منٹ قبل',
        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        'min قبل',
        // Carbon::now()->subMinutes(2)->diffForHumans()
        '2 منٹ قبل',
        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        'min قبل',
        // Carbon::now()->subHours(1)->diffForHumans()
        'ایک گھنٹہ قبل',
        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        'h قبل',
        // Carbon::now()->subHours(2)->diffForHumans()
        '2 گھنٹے قبل',
        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        'h قبل',
        // Carbon::now()->subDays(1)->diffForHumans()
        'ایک دن قبل',
        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        'd قبل',
        // Carbon::now()->subDays(2)->diffForHumans()
        '2 دن قبل',
        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        'd قبل',
        // Carbon::now()->subWeeks(1)->diffForHumans()
        '1 ہفتے قبل',
        // Carbon::now()->subWeeks(1)->diffForHumans(null, false, true)
        'w قبل',
        // Carbon::now()->subWeeks(2)->diffForHumans()
        '2 ہفتے قبل',
        // Carbon::now()->subWeeks(2)->diffForHumans(null, false, true)
        'w قبل',
        // Carbon::now()->subMonths(1)->diffForHumans()
        'ایک ماہ قبل',
        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        'm قبل',
        // Carbon::now()->subMonths(2)->diffForHumans()
        '2 ماہ قبل',
        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        'm قبل',
        // Carbon::now()->subYears(1)->diffForHumans()
        'ایک سال قبل',
        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        'y قبل',
        // Carbon::now()->subYears(2)->diffForHumans()
        '2 سال قبل',
        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        'y قبل',
        // Carbon::now()->addSecond()->diffForHumans()
        'چند سیکنڈ بعد',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        's بعد',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now())
        'چند سیکنڈ بعد',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), false, true)
        's بعد',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond())
        'چند سیکنڈ پہلے',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond(), false, true)
        's پہلے',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true)
        'چند سیکنڈ',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true, true)
        's',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        '2 سیکنڈ',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        's',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        's بعد',
        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        'ایک منٹ چند سیکنڈ',
        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        'y m d s',
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        '1 ہفتے 10 گھنٹے',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 ہفتے 6 دن',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 ہفتے 6 دن',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        '2 ہفتے ایک گھنٹہ',
    ];
}
