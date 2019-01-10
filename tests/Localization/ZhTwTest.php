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

class ZhTwTest extends LocalizationTestCase
{
    const LOCALE = 'zh_TW'; // Chinese

    const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        '明天 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        '下星期六 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        '下星期日 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        '下星期一 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        '下星期二 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        '下星期三 00:00',
        // Carbon::parse('2018-01-05 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-05 00:00:00'))
        '下星期四 00:00',
        // Carbon::parse('2018-01-06 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-06 00:00:00'))
        '下星期五 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        '下星期二 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        '下星期三 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        '下星期四 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        '下星期五 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        '下星期六 00:00',
        // Carbon::now()->subDays(2)->calendar()
        '上星期日 20:49',
        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        '昨天 22:00',
        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        '今天 10:00',
        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        '今天 02:00',
        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        '明天 01:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        '下星期二 00:00',
        // Carbon::parse('2018-01-08 00:00:00')->subDay()->calendar(Carbon::parse('2018-01-08 00:00:00'))
        '昨天 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        '昨天 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        '上星期二 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        '上星期一 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        '上星期日 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        '上星期六 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        '上星期五 00:00',
        // Carbon::parse('2018-01-03 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-03 00:00:00'))
        '上星期四 00:00',
        // Carbon::parse('2018-01-02 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-02 00:00:00'))
        '上星期三 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        '上星期五 00:00',
        // Carbon::parse('2018-01-01 00:00:00')->isoFormat('Qo Mo Do Wo wo')
        '1月 1月 1日 1周 1周',
        // Carbon::parse('2018-01-02 00:00:00')->isoFormat('Do wo')
        '2日 1周',
        // Carbon::parse('2018-01-03 00:00:00')->isoFormat('Do wo')
        '3日 1周',
        // Carbon::parse('2018-01-04 00:00:00')->isoFormat('Do wo')
        '4日 1周',
        // Carbon::parse('2018-01-05 00:00:00')->isoFormat('Do wo')
        '5日 1周',
        // Carbon::parse('2018-01-06 00:00:00')->isoFormat('Do wo')
        '6日 1周',
        // Carbon::parse('2018-01-07 00:00:00')->isoFormat('Do wo')
        '7日 1周',
        // Carbon::parse('2018-01-11 00:00:00')->isoFormat('Do wo')
        '11日 2周',
        // Carbon::parse('2018-02-09 00:00:00')->isoFormat('DDDo')
        '40日',
        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('DDDo')
        '41日',
        // Carbon::parse('2018-04-10 00:00:00')->isoFormat('DDDo')
        '100日',
        // Carbon::parse('2018-02-10 00:00:00', 'Europe/Paris')->isoFormat('h:mm a z')
        '12:00 凌晨 cet',
        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 凌晨, 12:00 凌晨',
        // Carbon::parse('2018-02-10 01:30:00')->isoFormat('h:mm A, h:mm a')
        '1:30 凌晨, 1:30 凌晨',
        // Carbon::parse('2018-02-10 02:00:00')->isoFormat('h:mm A, h:mm a')
        '2:00 凌晨, 2:00 凌晨',
        // Carbon::parse('2018-02-10 06:00:00')->isoFormat('h:mm A, h:mm a')
        '6:00 早上, 6:00 早上',
        // Carbon::parse('2018-02-10 10:00:00')->isoFormat('h:mm A, h:mm a')
        '10:00 上午, 10:00 上午',
        // Carbon::parse('2018-02-10 12:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 中午, 12:00 中午',
        // Carbon::parse('2018-02-10 17:00:00')->isoFormat('h:mm A, h:mm a')
        '5:00 下午, 5:00 下午',
        // Carbon::parse('2018-02-10 21:30:00')->isoFormat('h:mm A, h:mm a')
        '9:30 晚上, 9:30 晚上',
        // Carbon::parse('2018-02-10 23:00:00')->isoFormat('h:mm A, h:mm a')
        '11:00 晚上, 11:00 晚上',
        // Carbon::parse('2018-01-01 00:00:00')->ordinal('hour')
        '0',
        // Carbon::now()->subSeconds(1)->diffForHumans()
        '幾秒前',
        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        '1秒前',
        // Carbon::now()->subSeconds(2)->diffForHumans()
        '2秒前',
        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        '2秒前',
        // Carbon::now()->subMinutes(1)->diffForHumans()
        '1分鐘前',
        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        '1分鐘前',
        // Carbon::now()->subMinutes(2)->diffForHumans()
        '2分鐘前',
        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        '2分鐘前',
        // Carbon::now()->subHours(1)->diffForHumans()
        '1小時前',
        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        '1小時前',
        // Carbon::now()->subHours(2)->diffForHumans()
        '2小時前',
        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        '2小時前',
        // Carbon::now()->subDays(1)->diffForHumans()
        '1天前',
        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        '1天前',
        // Carbon::now()->subDays(2)->diffForHumans()
        '2天前',
        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        '2天前',
        // Carbon::now()->subWeeks(1)->diffForHumans()
        '1週前',
        // Carbon::now()->subWeeks(1)->diffForHumans(null, false, true)
        '1週前',
        // Carbon::now()->subWeeks(2)->diffForHumans()
        '2週前',
        // Carbon::now()->subWeeks(2)->diffForHumans(null, false, true)
        '2週前',
        // Carbon::now()->subMonths(1)->diffForHumans()
        '1個月前',
        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        '1月前',
        // Carbon::now()->subMonths(2)->diffForHumans()
        '2個月前',
        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        '2月前',
        // Carbon::now()->subYears(1)->diffForHumans()
        '1年前',
        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        '1年前',
        // Carbon::now()->subYears(2)->diffForHumans()
        '2年前',
        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        '2年前',
        // Carbon::now()->addSecond()->diffForHumans()
        '幾秒內',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        '1秒內',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now())
        '幾秒後',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), false, true)
        '1秒後',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond())
        '幾秒前',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond(), false, true)
        '1秒前',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true)
        '幾秒',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true, true)
        '1秒',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        '2秒',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        '2秒',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        '1秒內',
        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        '1分鐘 幾秒',
        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        '2年 3月 1天 1秒',
        // Carbon::now()->addYears(3)->diffForHumans(null, null, false, 4)
        '3年內',
        // Carbon::now()->subMonths(5)->diffForHumans(null, null, true, 4)
        '5月前',
        // Carbon::now()->subYears(2)->subMonths(3)->subDay()->subSecond()->diffForHumans(null, null, true, 4)
        '2年 3月 1天 1秒前',
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        '1週 10小時',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1週 6天',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1週 6天',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        '2週 1小時',
        // CarbonInterval::days(2)->forHumans()
        '2天',
        // CarbonInterval::create('P1DT3H')->forHumans(true)
        '1天 3小時',
    ];
}
