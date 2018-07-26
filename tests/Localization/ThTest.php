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

class ThTest extends LocalizationTestCase
{
    const LOCALE = 'th'; // Thai

    const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'พรุ่งนี้ เวลา 0:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'เสาร์หน้า เวลา 0:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'อาทิตย์หน้า เวลา 0:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'จันทร์หน้า เวลา 0:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'อังคารหน้า เวลา 0:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'พุธหน้า เวลา 0:00',
        // Carbon::parse('2018-01-05 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-05 00:00:00'))
        'พฤหัสบดีหน้า เวลา 0:00',
        // Carbon::parse('2018-01-06 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-06 00:00:00'))
        'ศุกร์หน้า เวลา 0:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'อังคารหน้า เวลา 0:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'พุธหน้า เวลา 0:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'พฤหัสบดีหน้า เวลา 0:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'ศุกร์หน้า เวลา 0:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'เสาร์หน้า เวลา 0:00',
        // Carbon::now()->subDays(2)->calendar()
        'วันอาทิตย์ที่แล้ว เวลา 20:49',
        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'เมื่อวานนี้ เวลา 22:00',
        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        'วันนี้ เวลา 10:00',
        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'วันนี้ เวลา 2:00',
        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        'พรุ่งนี้ เวลา 1:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'อังคารหน้า เวลา 0:00',
        // Carbon::parse('2018-01-08 00:00:00')->subDay()->calendar(Carbon::parse('2018-01-08 00:00:00'))
        'เมื่อวานนี้ เวลา 0:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'เมื่อวานนี้ เวลา 0:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'วันอังคารที่แล้ว เวลา 0:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'วันจันทร์ที่แล้ว เวลา 0:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'วันอาทิตย์ที่แล้ว เวลา 0:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'วันเสาร์ที่แล้ว เวลา 0:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'วันศุกร์ที่แล้ว เวลา 0:00',
        // Carbon::parse('2018-01-03 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-03 00:00:00'))
        'วันพฤหัสบดีที่แล้ว เวลา 0:00',
        // Carbon::parse('2018-01-02 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-02 00:00:00'))
        'วันพุธที่แล้ว เวลา 0:00',
        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'วันศุกร์ที่แล้ว เวลา 0:00',
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
        '7 2',
        // Carbon::parse('2018-01-11 00:00:00')->isoFormat('Do wo')
        '11 2',
        // Carbon::parse('2018-02-09 00:00:00')->isoFormat('DDDo')
        '40',
        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('DDDo')
        '41',
        // Carbon::parse('2018-04-10 00:00:00')->isoFormat('DDDo')
        '100',
        // Carbon::parse('2018-02-10 00:00:00', 'Europe/Paris')->isoFormat('h:mm a z')
        '12:00 ก่อนเที่ยง cet',
        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 ก่อนเที่ยง, 12:00 ก่อนเที่ยง',
        // Carbon::parse('2018-02-10 01:30:00')->isoFormat('h:mm A, h:mm a')
        '1:30 ก่อนเที่ยง, 1:30 ก่อนเที่ยง',
        // Carbon::parse('2018-02-10 02:00:00')->isoFormat('h:mm A, h:mm a')
        '2:00 ก่อนเที่ยง, 2:00 ก่อนเที่ยง',
        // Carbon::parse('2018-02-10 06:00:00')->isoFormat('h:mm A, h:mm a')
        '6:00 ก่อนเที่ยง, 6:00 ก่อนเที่ยง',
        // Carbon::parse('2018-02-10 10:00:00')->isoFormat('h:mm A, h:mm a')
        '10:00 ก่อนเที่ยง, 10:00 ก่อนเที่ยง',
        // Carbon::parse('2018-02-10 12:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 หลังเที่ยง, 12:00 หลังเที่ยง',
        // Carbon::parse('2018-02-10 17:00:00')->isoFormat('h:mm A, h:mm a')
        '5:00 หลังเที่ยง, 5:00 หลังเที่ยง',
        // Carbon::parse('2018-02-10 21:30:00')->isoFormat('h:mm A, h:mm a')
        '9:30 หลังเที่ยง, 9:30 หลังเที่ยง',
        // Carbon::parse('2018-02-10 23:00:00')->isoFormat('h:mm A, h:mm a')
        '11:00 หลังเที่ยง, 11:00 หลังเที่ยง',
        // Carbon::parse('2018-01-01 00:00:00')->ordinal('hour')
        '0',
        // Carbon::now()->subSeconds(1)->diffForHumans()
        'ไม่กี่วินาทีที่แล้ว',
        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        '1 วินาทีที่แล้ว',
        // Carbon::now()->subSeconds(2)->diffForHumans()
        '2 วินาทีที่แล้ว',
        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        '2 วินาทีที่แล้ว',
        // Carbon::now()->subMinutes(1)->diffForHumans()
        '1 นาทีที่แล้ว',
        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        '1 นาทีที่แล้ว',
        // Carbon::now()->subMinutes(2)->diffForHumans()
        '2 นาทีที่แล้ว',
        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        '2 นาทีที่แล้ว',
        // Carbon::now()->subHours(1)->diffForHumans()
        '1 ชั่วโมงที่แล้ว',
        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        '1 ชั่วโมงที่แล้ว',
        // Carbon::now()->subHours(2)->diffForHumans()
        '2 ชั่วโมงที่แล้ว',
        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        '2 ชั่วโมงที่แล้ว',
        // Carbon::now()->subDays(1)->diffForHumans()
        '1 วันที่แล้ว',
        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        '1 วันที่แล้ว',
        // Carbon::now()->subDays(2)->diffForHumans()
        '2 วันที่แล้ว',
        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        '2 วันที่แล้ว',
        // Carbon::now()->subWeeks(1)->diffForHumans()
        '1 สัปดาห์ที่แล้ว',
        // Carbon::now()->subWeeks(1)->diffForHumans(null, false, true)
        '1 สัปดาห์ที่แล้ว',
        // Carbon::now()->subWeeks(2)->diffForHumans()
        '2 สัปดาห์ที่แล้ว',
        // Carbon::now()->subWeeks(2)->diffForHumans(null, false, true)
        '2 สัปดาห์ที่แล้ว',
        // Carbon::now()->subMonths(1)->diffForHumans()
        '1 เดือนที่แล้ว',
        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        '1 เดือนที่แล้ว',
        // Carbon::now()->subMonths(2)->diffForHumans()
        '2 เดือนที่แล้ว',
        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        '2 เดือนที่แล้ว',
        // Carbon::now()->subYears(1)->diffForHumans()
        '1 ปีที่แล้ว',
        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        '1 ปีที่แล้ว',
        // Carbon::now()->subYears(2)->diffForHumans()
        '2 ปีที่แล้ว',
        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        '2 ปีที่แล้ว',
        // Carbon::now()->addSecond()->diffForHumans()
        'อีก ไม่กี่วินาที',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        'อีก 1 วินาที',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now())
        'ไม่กี่วินาทีหลังจากนี้',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), false, true)
        '1 วินาทีหลังจากนี้',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond())
        'ไม่กี่วินาทีก่อน',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond(), false, true)
        '1 วินาทีก่อน',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true)
        'ไม่กี่วินาที',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true, true)
        '1 วินาที',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        '2 วินาที',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        '2 วินาที',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        'อีก 1 วินาที',
        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        '1 นาที ไม่กี่วินาที',
        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        '2 ปี 3 เดือน 1 วัน 1 วินาที',
        // Carbon::now()->addYears(3)->diffForHumans(null, null, false, 4)
        'อีก 3 ปี',
        // Carbon::now()->subMonths(5)->diffForHumans(null, null, true, 4)
        '5 เดือนที่แล้ว',
        // Carbon::now()->subYears(2)->subMonths(3)->subDay()->subSecond()->diffForHumans(null, null, true, 4)
        '2 ปี 3 เดือน 1 วัน 1 วินาทีที่แล้ว',
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        '1 สัปดาห์ 10 ชั่วโมง',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 สัปดาห์ 6 วัน',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 สัปดาห์ 6 วัน',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        '2 สัปดาห์ 1 ชั่วโมง',
        // CarbonInterval::days(2)->forHumans()
        '2 วัน',
        // CarbonInterval::create('P1DT3H')->forHumans(true)
        '1 วัน 3 ชั่วโมง',
    ];
}
