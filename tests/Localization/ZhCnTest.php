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

class ZhCnTest extends LocalizationTestCase
{
    const LOCALE = 'zh_CN'; // Chinese

    const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        '昨天00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        '上星期六00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        '上星期日00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        '上星期一00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        '上星期二00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        '上星期三00:00',
        // Carbon::parse('2018-01-05 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-05 00:00:00'))
        '上星期四00:00',
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
        // Carbon::parse('2018-01-04 00:00:00')->subDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        '明天00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        '下星期二00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        '下星期一00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        '下星期日00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        '下星期六00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        '下星期五00:00',
        // Carbon::parse('2018-01-03 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-03 00:00:00'))
        '下星期四00:00',
        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        '下星期五00:00',
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
        '7日 2周',
        // Carbon::parse('2018-01-11 00:00:00')->isoFormat('Do wo')
        '11日 2周',
        // Carbon::parse('2018-02-09 00:00:00')->isoFormat('DDDo')
        '40日',
        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('DDDo')
        '41日',
        // Carbon::parse('2018-04-10 00:00:00')->isoFormat('DDDo')
        '100日',
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
        // Carbon::parse('2018-02-10 23:00:00')->isoFormat('h:mm A, h:mm a')
        '11:00 晚上, 11:00 晚上',
        // Carbon::parse('2018-01-01 00:00:00')->ordinal('hour')
        '0',
        // Carbon::now()->subSeconds(1)->diffForHumans()
        '几秒前',
        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        '1秒前',
        // Carbon::now()->subSeconds(2)->diffForHumans()
        '2秒前',
        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        '2秒前',
        // Carbon::now()->subMinutes(1)->diffForHumans()
        '1分钟前',
        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        '1分钟前',
        // Carbon::now()->subMinutes(2)->diffForHumans()
        '2分钟前',
        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        '2分钟前',
        // Carbon::now()->subHours(1)->diffForHumans()
        '1小时前',
        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        '1小时前',
        // Carbon::now()->subHours(2)->diffForHumans()
        '2小时前',
        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        '2小时前',
        // Carbon::now()->subDays(1)->diffForHumans()
        '1天前',
        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        '1天前',
        // Carbon::now()->subDays(2)->diffForHumans()
        '2天前',
        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        '2天前',
        // Carbon::now()->subWeeks(1)->diffForHumans()
        '1周前',
        // Carbon::now()->subWeeks(1)->diffForHumans(null, false, true)
        '1周前',
        // Carbon::now()->subWeeks(2)->diffForHumans()
        '2周前',
        // Carbon::now()->subWeeks(2)->diffForHumans(null, false, true)
        '2周前',
        // Carbon::now()->subMonths(1)->diffForHumans()
        '1个月前',
        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        '1个月前',
        // Carbon::now()->subMonths(2)->diffForHumans()
        '2个月前',
        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        '2个月前',
        // Carbon::now()->subYears(1)->diffForHumans()
        '1年前',
        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        '1年前',
        // Carbon::now()->subYears(2)->diffForHumans()
        '2年前',
        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        '2年前',
        // Carbon::now()->addSecond()->diffForHumans()
        '几秒内',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        '1秒内',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now())
        '几秒后',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), false, true)
        '1秒后',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond())
        '几秒前',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond(), false, true)
        '1秒前',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true)
        '几秒',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true, true)
        '1秒',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        '2秒',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        '2秒',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        '1秒内',
        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        '1分钟 几秒',
        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        '2年 3个月 1天 1秒',
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        '1周 10小时',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1周 6天',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1周 6天',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        '2周 1小时',
    ];
}
