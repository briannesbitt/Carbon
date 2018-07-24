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

class ZhHkTest extends LocalizationTestCase
{
    const LOCALE = 'zh_HK'; // Chinese

    const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        '上星期六00:00',
        // Carbon::now()->subDays(2)->calendar()
        '下星期日20:49',
        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        '明天22:00',
        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        '今天10:00',
        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        '今天02:00',
        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        '昨天01:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        '上星期二00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        '下星期二00:00',
        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        '下星期五00:00',
        // Carbon::now()->subSeconds(1)->diffForHumans()
        '幾秒前',
        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        '1秒前',
        // Carbon::now()->subSeconds(2)->diffForHumans()
        '2 秒前',
        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        '2秒前',
        // Carbon::now()->subMinutes(1)->diffForHumans()
        '1 分鐘前',
        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        '1分鐘前',
        // Carbon::now()->subMinutes(2)->diffForHumans()
        '2 分鐘前',
        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        '2分鐘前',
        // Carbon::now()->subHours(1)->diffForHumans()
        '1 小時前',
        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        '1小時前',
        // Carbon::now()->subHours(2)->diffForHumans()
        '2 小時前',
        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        '2小時前',
        // Carbon::now()->subDays(1)->diffForHumans()
        '1 天前',
        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        '1天前',
        // Carbon::now()->subDays(2)->diffForHumans()
        '2 天前',
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
        '1 個月前',
        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        '1月前',
        // Carbon::now()->subMonths(2)->diffForHumans()
        '2 個月前',
        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        '2月前',
        // Carbon::now()->subYears(1)->diffForHumans()
        '1 年前',
        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        '1年前',
        // Carbon::now()->subYears(2)->diffForHumans()
        '2 年前',
        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        '2年前',
        // Carbon::now()->addSecond()->diffForHumans()
        '幾秒內',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        '1秒內',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now())
        '幾秒后',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), false, true)
        '1秒后',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond())
        '幾秒前',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond(), false, true)
        '1秒前',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true)
        '幾秒',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true, true)
        '1秒',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        '2 秒',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        '2秒',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        '1秒內',
        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        '1 分鐘 幾秒',
        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        '2年 3月 1天 1秒',
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        '1週 10 小時',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1週 6 天',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1週 6 天',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        '2週 1 小時',
    ];
}
