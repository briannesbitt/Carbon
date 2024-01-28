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

use Carbon\Carbon;
use PHPUnit\Framework\Attributes\Group;

#[Group('localization')]
class JaTest extends LocalizationTestCase
{
    public const LOCALE = 'ja'; // Japanese

    public const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        '明日 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        '土曜日 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        '来週日曜日 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        '来週月曜日 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        '来週火曜日 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        '来週水曜日 00:00',
        // Carbon::parse('2018-01-05 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-05 00:00:00'))
        '来週木曜日 00:00',
        // Carbon::parse('2018-01-06 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-06 00:00:00'))
        '来週金曜日 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        '火曜日 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        '水曜日 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        '木曜日 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        '金曜日 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        '土曜日 00:00',
        // Carbon::now()->subDays(2)->calendar()
        '日曜日 20:49',
        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        '昨日 22:00',
        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        '今日 10:00',
        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        '今日 02:00',
        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        '明日 01:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        '火曜日 00:00',
        // Carbon::parse('2018-01-08 00:00:00')->subDay()->calendar(Carbon::parse('2018-01-08 00:00:00'))
        '昨日 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        '昨日 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        '火曜日 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        '月曜日 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        '日曜日 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        '先週土曜日 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        '先週金曜日 00:00',
        // Carbon::parse('2018-01-03 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-03 00:00:00'))
        '先週木曜日 00:00',
        // Carbon::parse('2018-01-02 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-02 00:00:00'))
        '先週水曜日 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        '先週金曜日 00:00',
        // Carbon::parse('2018-01-01 00:00:00')->isoFormat('Qo Mo Do Wo wo')
        '1 1 1日 1 1',
        // Carbon::parse('2018-01-02 00:00:00')->isoFormat('Do wo')
        '2日 1',
        // Carbon::parse('2018-01-03 00:00:00')->isoFormat('Do wo')
        '3日 1',
        // Carbon::parse('2018-01-04 00:00:00')->isoFormat('Do wo')
        '4日 1',
        // Carbon::parse('2018-01-05 00:00:00')->isoFormat('Do wo')
        '5日 1',
        // Carbon::parse('2018-01-06 00:00:00')->isoFormat('Do wo')
        '6日 1',
        // Carbon::parse('2018-01-07 00:00:00')->isoFormat('Do wo')
        '7日 2',
        // Carbon::parse('2018-01-11 00:00:00')->isoFormat('Do wo')
        '11日 2',
        // Carbon::parse('2018-02-09 00:00:00')->isoFormat('DDDo')
        '40日',
        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('DDDo')
        '41日',
        // Carbon::parse('2018-04-10 00:00:00')->isoFormat('DDDo')
        '100日',
        // Carbon::parse('2018-02-10 00:00:00', 'Europe/Paris')->isoFormat('h:mm a z')
        '12:00 午前 CET',
        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 午前, 12:00 午前',
        // Carbon::parse('2018-02-10 01:30:00')->isoFormat('h:mm A, h:mm a')
        '1:30 午前, 1:30 午前',
        // Carbon::parse('2018-02-10 02:00:00')->isoFormat('h:mm A, h:mm a')
        '2:00 午前, 2:00 午前',
        // Carbon::parse('2018-02-10 06:00:00')->isoFormat('h:mm A, h:mm a')
        '6:00 午前, 6:00 午前',
        // Carbon::parse('2018-02-10 10:00:00')->isoFormat('h:mm A, h:mm a')
        '10:00 午前, 10:00 午前',
        // Carbon::parse('2018-02-10 12:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 午後, 12:00 午後',
        // Carbon::parse('2018-02-10 17:00:00')->isoFormat('h:mm A, h:mm a')
        '5:00 午後, 5:00 午後',
        // Carbon::parse('2018-02-10 21:30:00')->isoFormat('h:mm A, h:mm a')
        '9:30 午後, 9:30 午後',
        // Carbon::parse('2018-02-10 23:00:00')->isoFormat('h:mm A, h:mm a')
        '11:00 午後, 11:00 午後',
        // Carbon::parse('2018-01-01 00:00:00')->ordinal('hour')
        '0',
        // Carbon::now()->subSeconds(1)->diffForHumans()
        '1秒前',
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
        '1秒後',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        '1秒後',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now())
        '1秒後',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), false, true)
        '1秒後',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond())
        '1秒前',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond(), false, true)
        '1秒前',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true)
        '1秒',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true, true)
        '1秒',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        '2秒',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        '2秒',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        '1秒後',
        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        '1分 1秒',
        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        '2年 3ヶ月 1日 1秒',
        // Carbon::now()->addYears(3)->diffForHumans(null, null, false, 4)
        '3年後',
        // Carbon::now()->subMonths(5)->diffForHumans(null, null, true, 4)
        '5ヶ月前',
        // Carbon::now()->subYears(2)->subMonths(3)->subDay()->subSecond()->diffForHumans(null, null, true, 4)
        '2年 3ヶ月 1日 1秒前',
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        '1週間 10時間',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1週間 6日',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1週間 6日',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(["join" => true, "parts" => 2])
        '1週間、6日後',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        '2週間 1時間',
        // Carbon::now()->addHour()->diffForHumans(["aUnit" => true])
        '1時間後',
        // CarbonInterval::days(2)->forHumans()
        '2日',
        // CarbonInterval::create('P1DT3H')->forHumans(true)
        '1日 3時間',
    ];

    public function testYearWithJapaneseNumbers()
    {
        $this->assertSame('二千十五', Carbon::parse('2015-12-23 00:00:00')->locale('ja')->getAltNumber('year'));
    }
}
