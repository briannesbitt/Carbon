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

class JaTest extends LocalizationTestCase
{
    const LOCALE = 'ja'; // Japanese

    const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        '土曜日 00:00',
        // Carbon::now()->subDays(2)->calendar()
        '来週日曜日 20:49',
        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        '明日 22:00',
        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        '今日 10:00',
        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        '今日 02:00',
        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        '昨日 01:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        '先週火曜日 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        '火曜日 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        '金曜日 00:00',
        // Carbon::now()->subSeconds(1)->diffForHumans()
        '数秒前',
        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        '1秒前',
        // Carbon::now()->subSeconds(2)->diffForHumans()
        '2秒前',
        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        '2秒前',
        // Carbon::now()->subMinutes(1)->diffForHumans()
        '1分前',
        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        '1分前',
        // Carbon::now()->subMinutes(2)->diffForHumans()
        '2分前',
        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        '2分前',
        // Carbon::now()->subHours(1)->diffForHumans()
        '1時間前',
        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        '1時間前',
        // Carbon::now()->subHours(2)->diffForHumans()
        '2時間前',
        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        '2時間前',
        // Carbon::now()->subDays(1)->diffForHumans()
        '1日前',
        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        '1日前',
        // Carbon::now()->subDays(2)->diffForHumans()
        '2日前',
        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        '2日前',
        // Carbon::now()->subWeeks(1)->diffForHumans()
        '1週間前',
        // Carbon::now()->subWeeks(1)->diffForHumans(null, false, true)
        '1週間前',
        // Carbon::now()->subWeeks(2)->diffForHumans()
        '2週間前',
        // Carbon::now()->subWeeks(2)->diffForHumans(null, false, true)
        '2週間前',
        // Carbon::now()->subMonths(1)->diffForHumans()
        '1ヶ月前',
        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        '1ヶ月前',
        // Carbon::now()->subMonths(2)->diffForHumans()
        '2ヶ月前',
        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        '2ヶ月前',
        // Carbon::now()->subYears(1)->diffForHumans()
        '1年前',
        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        '1年前',
        // Carbon::now()->subYears(2)->diffForHumans()
        '2年前',
        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        '2年前',
        // Carbon::now()->addSecond()->diffForHumans()
        '数秒後',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        '1秒後',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now())
        '数秒後',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), false, true)
        '1秒後',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond())
        '数秒前',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond(), false, true)
        '1秒前',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true)
        '数秒',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true, true)
        '1秒',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        '2秒',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        '2秒',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        '1秒後',
        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        '1分 数秒',
        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        '2年 3ヶ月 1日 1秒',
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        '1週間 10時間',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1週間 6日',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1週間 6日',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        '2週間 1時間',
    ];
}
