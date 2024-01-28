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
class CmnTwTest extends LocalizationTestCase
{
    public const LOCALE = 'cmn_TW'; // Chinese

    public const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Tomorrow at 12:00 上午',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        '星期六 at 12:00 上午',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        '星期日 at 12:00 上午',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        '星期一 at 12:00 上午',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        '星期二 at 12:00 上午',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        '星期三 at 12:00 上午',
        // Carbon::parse('2018-01-05 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-05 00:00:00'))
        '星期四 at 12:00 上午',
        // Carbon::parse('2018-01-06 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-06 00:00:00'))
        '星期五 at 12:00 上午',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        '星期二 at 12:00 上午',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        '星期三 at 12:00 上午',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        '星期四 at 12:00 上午',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        '星期五 at 12:00 上午',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        '星期六 at 12:00 上午',
        // Carbon::now()->subDays(2)->calendar()
        'Last 星期日 at 8:49 下午',
        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Yesterday at 10:00 下午',
        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        'Today at 10:00 上午',
        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Today at 2:00 上午',
        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        'Tomorrow at 1:00 上午',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        '星期二 at 12:00 上午',
        // Carbon::parse('2018-01-08 00:00:00')->subDay()->calendar(Carbon::parse('2018-01-08 00:00:00'))
        'Yesterday at 12:00 上午',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Yesterday at 12:00 上午',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last 星期二 at 12:00 上午',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last 星期一 at 12:00 上午',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last 星期日 at 12:00 上午',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last 星期六 at 12:00 上午',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Last 星期五 at 12:00 上午',
        // Carbon::parse('2018-01-03 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-03 00:00:00'))
        'Last 星期四 at 12:00 上午',
        // Carbon::parse('2018-01-02 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-02 00:00:00'))
        'Last 星期三 at 12:00 上午',
        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'Last 星期五 at 12:00 上午',
        // Carbon::parse('2018-01-01 00:00:00')->isoFormat('Qo Mo Do Wo wo')
        '1st 1st 1st 1st 1st',
        // Carbon::parse('2018-01-02 00:00:00')->isoFormat('Do wo')
        '2nd 1st',
        // Carbon::parse('2018-01-03 00:00:00')->isoFormat('Do wo')
        '3rd 1st',
        // Carbon::parse('2018-01-04 00:00:00')->isoFormat('Do wo')
        '4th 1st',
        // Carbon::parse('2018-01-05 00:00:00')->isoFormat('Do wo')
        '5th 1st',
        // Carbon::parse('2018-01-06 00:00:00')->isoFormat('Do wo')
        '6th 1st',
        // Carbon::parse('2018-01-07 00:00:00')->isoFormat('Do wo')
        '7th 2nd',
        // Carbon::parse('2018-01-11 00:00:00')->isoFormat('Do wo')
        '11th 2nd',
        // Carbon::parse('2018-02-09 00:00:00')->isoFormat('DDDo')
        '40th',
        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('DDDo')
        '41st',
        // Carbon::parse('2018-04-10 00:00:00')->isoFormat('DDDo')
        '100th',
        // Carbon::parse('2018-02-10 00:00:00', 'Europe/Paris')->isoFormat('h:mm a z')
        '12:00 上午 CET',
        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 上午, 12:00 上午',
        // Carbon::parse('2018-02-10 01:30:00')->isoFormat('h:mm A, h:mm a')
        '1:30 上午, 1:30 上午',
        // Carbon::parse('2018-02-10 02:00:00')->isoFormat('h:mm A, h:mm a')
        '2:00 上午, 2:00 上午',
        // Carbon::parse('2018-02-10 06:00:00')->isoFormat('h:mm A, h:mm a')
        '6:00 上午, 6:00 上午',
        // Carbon::parse('2018-02-10 10:00:00')->isoFormat('h:mm A, h:mm a')
        '10:00 上午, 10:00 上午',
        // Carbon::parse('2018-02-10 12:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 下午, 12:00 下午',
        // Carbon::parse('2018-02-10 17:00:00')->isoFormat('h:mm A, h:mm a')
        '5:00 下午, 5:00 下午',
        // Carbon::parse('2018-02-10 21:30:00')->isoFormat('h:mm A, h:mm a')
        '9:30 下午, 9:30 下午',
        // Carbon::parse('2018-02-10 23:00:00')->isoFormat('h:mm A, h:mm a')
        '11:00 下午, 11:00 下午',
        // Carbon::parse('2018-01-01 00:00:00')->ordinal('hour')
        '0th',
        // Carbon::now()->subSeconds(1)->diffForHumans()
        '1 秒 ago',
        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        '1 秒 ago',
        // Carbon::now()->subSeconds(2)->diffForHumans()
        '2 秒 ago',
        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        '2 秒 ago',
        // Carbon::now()->subMinutes(1)->diffForHumans()
        '1 分钟 ago',
        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        '1 分钟 ago',
        // Carbon::now()->subMinutes(2)->diffForHumans()
        '2 分钟 ago',
        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        '2 分钟 ago',
        // Carbon::now()->subHours(1)->diffForHumans()
        '1 小时 ago',
        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        '1 小时 ago',
        // Carbon::now()->subHours(2)->diffForHumans()
        '2 小时 ago',
        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        '2 小时 ago',
        // Carbon::now()->subDays(1)->diffForHumans()
        '1 白天 ago',
        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        '1 白天 ago',
        // Carbon::now()->subDays(2)->diffForHumans()
        '2 白天 ago',
        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        '2 白天 ago',
        // Carbon::now()->subWeeks(1)->diffForHumans()
        '1 周 ago',
        // Carbon::now()->subWeeks(1)->diffForHumans(null, false, true)
        '1 周 ago',
        // Carbon::now()->subWeeks(2)->diffForHumans()
        '2 周 ago',
        // Carbon::now()->subWeeks(2)->diffForHumans(null, false, true)
        '2 周 ago',
        // Carbon::now()->subMonths(1)->diffForHumans()
        '1 月 ago',
        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        '1 月 ago',
        // Carbon::now()->subMonths(2)->diffForHumans()
        '2 月 ago',
        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        '2 月 ago',
        // Carbon::now()->subYears(1)->diffForHumans()
        '1 年 ago',
        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        '1 年 ago',
        // Carbon::now()->subYears(2)->diffForHumans()
        '2 年 ago',
        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        '2 年 ago',
        // Carbon::now()->addSecond()->diffForHumans()
        '1 秒 from now',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        '1 秒 from now',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now())
        '1 秒 after',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), false, true)
        '1 秒 after',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond())
        '1 秒 before',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond(), false, true)
        '1 秒 before',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true)
        '1 秒',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true, true)
        '1 秒',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        '2 秒',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        '2 秒',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        '1 秒 from now',
        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        '1 分钟 1 秒',
        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        '2 年 3 月 1 白天 1 秒',
        // Carbon::now()->addYears(3)->diffForHumans(null, null, false, 4)
        '3 年 from now',
        // Carbon::now()->subMonths(5)->diffForHumans(null, null, true, 4)
        '5 月 ago',
        // Carbon::now()->subYears(2)->subMonths(3)->subDay()->subSecond()->diffForHumans(null, null, true, 4)
        '2 年 3 月 1 白天 1 秒 ago',
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        '1 周 10 小时',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 周 6 白天',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 周 6 白天',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(["join" => true, "parts" => 2])
        '1 周 and 6 白天 from now',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        '2 周 1 小时',
        // Carbon::now()->addHour()->diffForHumans(["aUnit" => true])
        '1 小时 from now',
        // CarbonInterval::days(2)->forHumans()
        '2 白天',
        // CarbonInterval::create('P1DT3H')->forHumans(true)
        '1 白天 3 小时',
    ];
}
