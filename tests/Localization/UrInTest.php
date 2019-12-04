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

class UrInTest extends LocalizationTestCase
{
    const LOCALE = 'ur_IN'; // Urdu

    const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'کل بوقت 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'سنیچر بوقت 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'اتوار بوقت 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'پیر بوقت 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'منگل بوقت 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'بدھ بوقت 00:00',
        // Carbon::parse('2018-01-05 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-05 00:00:00'))
        'جمعرات بوقت 00:00',
        // Carbon::parse('2018-01-06 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-06 00:00:00'))
        'جمعہ بوقت 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'منگل بوقت 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'بدھ بوقت 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'جمعرات بوقت 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'جمعہ بوقت 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'سنیچر بوقت 00:00',
        // Carbon::now()->subDays(2)->calendar()
        'گذشتہ اتوار بوقت 20:49',
        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'گذشتہ روز بوقت 22:00',
        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        'آج بوقت 10:00',
        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'آج بوقت 02:00',
        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        'کل بوقت 01:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'منگل بوقت 00:00',
        // Carbon::parse('2018-01-08 00:00:00')->subDay()->calendar(Carbon::parse('2018-01-08 00:00:00'))
        'گذشتہ روز بوقت 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'گذشتہ روز بوقت 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'گذشتہ منگل بوقت 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'گذشتہ پیر بوقت 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'گذشتہ اتوار بوقت 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'گذشتہ سنیچر بوقت 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'گذشتہ جمعہ بوقت 00:00',
        // Carbon::parse('2018-01-03 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-03 00:00:00'))
        'گذشتہ جمعرات بوقت 00:00',
        // Carbon::parse('2018-01-02 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-02 00:00:00'))
        'گذشتہ بدھ بوقت 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'گذشتہ جمعہ بوقت 00:00',
        // Carbon::parse('2018-01-01 00:00:00')->isoFormat('Qo Mo Do Wo wo')
        '1 1 1 1 1',
        // Carbon::parse('2018-01-02 00:00:00')->isoFormat('Do wo')
        '2 1',
        // Carbon::parse('2018-01-03 00:00:00')->isoFormat('Do wo')
        '3 1',
        // Carbon::parse('2018-01-04 00:00:00')->isoFormat('Do wo')
        '4 1',
        // Carbon::parse('2018-01-05 00:00:00')->isoFormat('Do wo')
        '5 1',
        // Carbon::parse('2018-01-06 00:00:00')->isoFormat('Do wo')
        '6 1',
        // Carbon::parse('2018-01-07 00:00:00')->isoFormat('Do wo')
        '7 1',
        // Carbon::parse('2018-01-11 00:00:00')->isoFormat('Do wo')
        '11 2',
        // Carbon::parse('2018-02-09 00:00:00')->isoFormat('DDDo')
        '40',
        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('DDDo')
        '41',
        // Carbon::parse('2018-04-10 00:00:00')->isoFormat('DDDo')
        '100',
        // Carbon::parse('2018-02-10 00:00:00', 'Europe/Paris')->isoFormat('h:mm a z')
        '12:00 صبح CET',
        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 صبح, 12:00 صبح',
        // Carbon::parse('2018-02-10 01:30:00')->isoFormat('h:mm A, h:mm a')
        '1:30 صبح, 1:30 صبح',
        // Carbon::parse('2018-02-10 02:00:00')->isoFormat('h:mm A, h:mm a')
        '2:00 صبح, 2:00 صبح',
        // Carbon::parse('2018-02-10 06:00:00')->isoFormat('h:mm A, h:mm a')
        '6:00 صبح, 6:00 صبح',
        // Carbon::parse('2018-02-10 10:00:00')->isoFormat('h:mm A, h:mm a')
        '10:00 صبح, 10:00 صبح',
        // Carbon::parse('2018-02-10 12:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 شام, 12:00 شام',
        // Carbon::parse('2018-02-10 17:00:00')->isoFormat('h:mm A, h:mm a')
        '5:00 شام, 5:00 شام',
        // Carbon::parse('2018-02-10 21:30:00')->isoFormat('h:mm A, h:mm a')
        '9:30 شام, 9:30 شام',
        // Carbon::parse('2018-02-10 23:00:00')->isoFormat('h:mm A, h:mm a')
        '11:00 شام, 11:00 شام',
        // Carbon::parse('2018-01-01 00:00:00')->ordinal('hour')
        '0',
        // Carbon::now()->subSeconds(1)->diffForHumans()
        'چند سیکنڈ قبل',
        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        'چند سیکنڈ قبل',
        // Carbon::now()->subSeconds(2)->diffForHumans()
        '2 سیکنڈ قبل',
        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        '2 سیکنڈ قبل',
        // Carbon::now()->subMinutes(1)->diffForHumans()
        'ایک منٹ قبل',
        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        'ایک منٹ قبل',
        // Carbon::now()->subMinutes(2)->diffForHumans()
        '2 منٹ قبل',
        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        '2 منٹ قبل',
        // Carbon::now()->subHours(1)->diffForHumans()
        'ایک گھنٹہ قبل',
        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        'ایک گھنٹہ قبل',
        // Carbon::now()->subHours(2)->diffForHumans()
        '2 گھنٹے قبل',
        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        '2 گھنٹے قبل',
        // Carbon::now()->subDays(1)->diffForHumans()
        'ایک دن قبل',
        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        'ایک دن قبل',
        // Carbon::now()->subDays(2)->diffForHumans()
        '2 دن قبل',
        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        '2 دن قبل',
        // Carbon::now()->subWeeks(1)->diffForHumans()
        '1 ہفتے قبل',
        // Carbon::now()->subWeeks(1)->diffForHumans(null, false, true)
        '1 ہفتے قبل',
        // Carbon::now()->subWeeks(2)->diffForHumans()
        '2 ہفتے قبل',
        // Carbon::now()->subWeeks(2)->diffForHumans(null, false, true)
        '2 ہفتے قبل',
        // Carbon::now()->subMonths(1)->diffForHumans()
        'ایک ماہ قبل',
        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        'ایک ماہ قبل',
        // Carbon::now()->subMonths(2)->diffForHumans()
        '2 ماہ قبل',
        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        '2 ماہ قبل',
        // Carbon::now()->subYears(1)->diffForHumans()
        'ایک سال قبل',
        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        'ایک سال قبل',
        // Carbon::now()->subYears(2)->diffForHumans()
        '2 سال قبل',
        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        '2 سال قبل',
        // Carbon::now()->addSecond()->diffForHumans()
        'چند سیکنڈ بعد',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        'چند سیکنڈ بعد',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now())
        'چند سیکنڈ بعد',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), false, true)
        'چند سیکنڈ بعد',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond())
        'چند سیکنڈ پہلے',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond(), false, true)
        'چند سیکنڈ پہلے',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true)
        'چند سیکنڈ',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true, true)
        'چند سیکنڈ',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        '2 سیکنڈ',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        '2 سیکنڈ',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        'چند سیکنڈ بعد',
        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        'ایک منٹ چند سیکنڈ',
        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        '2 سال 3 ماہ ایک دن چند سیکنڈ',
        // Carbon::now()->addYears(3)->diffForHumans(null, null, false, 4)
        '3 سال بعد',
        // Carbon::now()->subMonths(5)->diffForHumans(null, null, true, 4)
        '5 ماہ قبل',
        // Carbon::now()->subYears(2)->subMonths(3)->subDay()->subSecond()->diffForHumans(null, null, true, 4)
        '2 سال 3 ماہ ایک دن چند سیکنڈ قبل',
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        '1 ہفتے 10 گھنٹے',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 ہفتے 6 دن',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 ہفتے 6 دن',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(["join" => true, "parts" => 2])
        '1 ہفتے اور 6 دن بعد',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        '2 ہفتے ایک گھنٹہ',
        // Carbon::now()->addHour()->diffForHumans(["aUnit" => true])
        'ایک گھنٹہ بعد',
        // CarbonInterval::days(2)->forHumans()
        '2 دن',
        // CarbonInterval::create('P1DT3H')->forHumans(true)
        'ایک دن 3 گھنٹے',
    ];
}
