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

use PHPUnit\Framework\Attributes\Group;

#[Group('localization')]
class KoTest extends LocalizationTestCase
{
    public const LOCALE = 'ko'; // Korean

    public const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        '내일 오전 12:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        '토요일 오전 12:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        '일요일 오전 12:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        '월요일 오전 12:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        '화요일 오전 12:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        '수요일 오전 12:00',
        // Carbon::parse('2018-01-05 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-05 00:00:00'))
        '목요일 오전 12:00',
        // Carbon::parse('2018-01-06 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-06 00:00:00'))
        '금요일 오전 12:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        '화요일 오전 12:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        '수요일 오전 12:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        '목요일 오전 12:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        '금요일 오전 12:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        '토요일 오전 12:00',
        // Carbon::now()->subDays(2)->calendar()
        '지난주 일요일 오후 8:49',
        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        '어제 오후 10:00',
        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        '오늘 오전 10:00',
        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        '오늘 오전 2:00',
        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        '내일 오전 1:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        '화요일 오전 12:00',
        // Carbon::parse('2018-01-08 00:00:00')->subDay()->calendar(Carbon::parse('2018-01-08 00:00:00'))
        '어제 오전 12:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        '어제 오전 12:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        '지난주 화요일 오전 12:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        '지난주 월요일 오전 12:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        '지난주 일요일 오전 12:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        '지난주 토요일 오전 12:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        '지난주 금요일 오전 12:00',
        // Carbon::parse('2018-01-03 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-03 00:00:00'))
        '지난주 목요일 오전 12:00',
        // Carbon::parse('2018-01-02 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-02 00:00:00'))
        '지난주 수요일 오전 12:00',
        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        '지난주 금요일 오전 12:00',
        // Carbon::parse('2018-01-01 00:00:00')->isoFormat('Qo Mo Do Wo wo')
        '1월 1월 1일 1주 1주',
        // Carbon::parse('2018-01-02 00:00:00')->isoFormat('Do wo')
        '2일 1주',
        // Carbon::parse('2018-01-03 00:00:00')->isoFormat('Do wo')
        '3일 1주',
        // Carbon::parse('2018-01-04 00:00:00')->isoFormat('Do wo')
        '4일 1주',
        // Carbon::parse('2018-01-05 00:00:00')->isoFormat('Do wo')
        '5일 1주',
        // Carbon::parse('2018-01-06 00:00:00')->isoFormat('Do wo')
        '6일 1주',
        // Carbon::parse('2018-01-07 00:00:00')->isoFormat('Do wo')
        '7일 2주',
        // Carbon::parse('2018-01-11 00:00:00')->isoFormat('Do wo')
        '11일 2주',
        // Carbon::parse('2018-02-09 00:00:00')->isoFormat('DDDo')
        '40일',
        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('DDDo')
        '41일',
        // Carbon::parse('2018-04-10 00:00:00')->isoFormat('DDDo')
        '100일',
        // Carbon::parse('2018-02-10 00:00:00', 'Europe/Paris')->isoFormat('h:mm a z')
        '12:00 오전 CET',
        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 오전, 12:00 오전',
        // Carbon::parse('2018-02-10 01:30:00')->isoFormat('h:mm A, h:mm a')
        '1:30 오전, 1:30 오전',
        // Carbon::parse('2018-02-10 02:00:00')->isoFormat('h:mm A, h:mm a')
        '2:00 오전, 2:00 오전',
        // Carbon::parse('2018-02-10 06:00:00')->isoFormat('h:mm A, h:mm a')
        '6:00 오전, 6:00 오전',
        // Carbon::parse('2018-02-10 10:00:00')->isoFormat('h:mm A, h:mm a')
        '10:00 오전, 10:00 오전',
        // Carbon::parse('2018-02-10 12:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 오후, 12:00 오후',
        // Carbon::parse('2018-02-10 17:00:00')->isoFormat('h:mm A, h:mm a')
        '5:00 오후, 5:00 오후',
        // Carbon::parse('2018-02-10 21:30:00')->isoFormat('h:mm A, h:mm a')
        '9:30 오후, 9:30 오후',
        // Carbon::parse('2018-02-10 23:00:00')->isoFormat('h:mm A, h:mm a')
        '11:00 오후, 11:00 오후',
        // Carbon::parse('2018-01-01 00:00:00')->ordinal('hour')
        '0',
        // Carbon::now()->subSeconds(1)->diffForHumans()
        '1초 전',
        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        '1초 전',
        // Carbon::now()->subSeconds(2)->diffForHumans()
        '2초 전',
        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        '2초 전',
        // Carbon::now()->subMinutes(1)->diffForHumans()
        '1분 전',
        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        '1분 전',
        // Carbon::now()->subMinutes(2)->diffForHumans()
        '2분 전',
        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        '2분 전',
        // Carbon::now()->subHours(1)->diffForHumans()
        '1시간 전',
        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        '1시간 전',
        // Carbon::now()->subHours(2)->diffForHumans()
        '2시간 전',
        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        '2시간 전',
        // Carbon::now()->subDays(1)->diffForHumans()
        '1일 전',
        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        '1일 전',
        // Carbon::now()->subDays(2)->diffForHumans()
        '2일 전',
        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        '2일 전',
        // Carbon::now()->subWeeks(1)->diffForHumans()
        '1주 전',
        // Carbon::now()->subWeeks(1)->diffForHumans(null, false, true)
        '1주일 전',
        // Carbon::now()->subWeeks(2)->diffForHumans()
        '2주 전',
        // Carbon::now()->subWeeks(2)->diffForHumans(null, false, true)
        '2주일 전',
        // Carbon::now()->subMonths(1)->diffForHumans()
        '1개월 전',
        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        '1개월 전',
        // Carbon::now()->subMonths(2)->diffForHumans()
        '2개월 전',
        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        '2개월 전',
        // Carbon::now()->subYears(1)->diffForHumans()
        '1년 전',
        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        '1년 전',
        // Carbon::now()->subYears(2)->diffForHumans()
        '2년 전',
        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        '2년 전',
        // Carbon::now()->addSecond()->diffForHumans()
        '1초 후',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        '1초 후',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now())
        '1초 후',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), false, true)
        '1초 후',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond())
        '1초 전',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond(), false, true)
        '1초 전',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true)
        '1초',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true, true)
        '1초',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        '2초',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        '2초',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        '1초 후',
        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        '1분 1초',
        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        '2년 3개월 1일 1초',
        // Carbon::now()->addYears(3)->diffForHumans(null, null, false, 4)
        '3년 후',
        // Carbon::now()->subMonths(5)->diffForHumans(null, null, true, 4)
        '5개월 전',
        // Carbon::now()->subYears(2)->subMonths(3)->subDay()->subSecond()->diffForHumans(null, null, true, 4)
        '2년 3개월 1일 1초 전',
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        '1주 10시간',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1주 6일',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1주 6일',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(["join" => true, "parts" => 2])
        '1주 6일 후',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        '2주 1시간',
        // Carbon::now()->addHour()->diffForHumans(["aUnit" => true])
        '한시간 후',
        // CarbonInterval::days(2)->forHumans()
        '2일',
        // CarbonInterval::create('P1DT3H')->forHumans(true)
        '1일 3시간',
    ];
}
