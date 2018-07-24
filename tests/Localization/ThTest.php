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
        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'วันเสาร์ที่แล้ว เวลา 0:00',
        // Carbon::now()->subDays(2)->calendar()
        'อาทิตย์หน้า เวลา 20:49',
        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'พรุ่งนี้ เวลา 22:00',
        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        'วันนี้ เวลา 10:00',
        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'วันนี้ เวลา 2:00',
        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        'เมื่อวานนี้ เวลา 1:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'วันอังคารที่แล้ว เวลา 0:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'อังคารหน้า เวลา 0:00',
        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'ศุกร์หน้า เวลา 0:00',
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
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        '1 สัปดาห์ 10 ชั่วโมง',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 สัปดาห์ 6 วัน',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 สัปดาห์ 6 วัน',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        '2 สัปดาห์ 1 ชั่วโมง',
    ];
}
