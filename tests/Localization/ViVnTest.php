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
class ViVnTest extends LocalizationTestCase
{
    public const LOCALE = 'vi_VN'; // Vietnamese

    public const CASES = [
        // Carbon::parse('2018-01-04 00:00:00')->addDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Ngày mai lúc 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'thứ bảy tuần tới lúc 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'chủ nhật tuần tới lúc 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'thứ hai tuần tới lúc 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'thứ ba tuần tới lúc 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'thứ tư tuần tới lúc 00:00',
        // Carbon::parse('2018-01-05 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-05 00:00:00'))
        'thứ năm tuần tới lúc 00:00',
        // Carbon::parse('2018-01-06 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-06 00:00:00'))
        'thứ sáu tuần tới lúc 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'thứ ba tuần tới lúc 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'thứ tư tuần tới lúc 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(4)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'thứ năm tuần tới lúc 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(5)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'thứ sáu tuần tới lúc 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(6)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'thứ bảy tuần tới lúc 00:00',
        // Carbon::now()->subDays(2)->calendar()
        'chủ nhật tuần trước lúc 20:49',
        // Carbon::parse('2018-01-04 00:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Hôm qua lúc 22:00',
        // Carbon::parse('2018-01-04 12:00:00')->subHours(2)->calendar(Carbon::parse('2018-01-04 12:00:00'))
        'Hôm nay lúc 10:00',
        // Carbon::parse('2018-01-04 00:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Hôm nay lúc 02:00',
        // Carbon::parse('2018-01-04 23:00:00')->addHours(2)->calendar(Carbon::parse('2018-01-04 23:00:00'))
        'Ngày mai lúc 01:00',
        // Carbon::parse('2018-01-07 00:00:00')->addDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'thứ ba tuần tới lúc 00:00',
        // Carbon::parse('2018-01-08 00:00:00')->subDay()->calendar(Carbon::parse('2018-01-08 00:00:00'))
        'Hôm qua lúc 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(1)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'Hôm qua lúc 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'thứ ba tuần trước lúc 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(3)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'thứ hai tuần trước lúc 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(4)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'chủ nhật tuần trước lúc 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(5)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'thứ bảy tuần trước lúc 00:00',
        // Carbon::parse('2018-01-04 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-04 00:00:00'))
        'thứ sáu tuần trước lúc 00:00',
        // Carbon::parse('2018-01-03 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-03 00:00:00'))
        'thứ năm tuần trước lúc 00:00',
        // Carbon::parse('2018-01-02 00:00:00')->subDays(6)->calendar(Carbon::parse('2018-01-02 00:00:00'))
        'thứ tư tuần trước lúc 00:00',
        // Carbon::parse('2018-01-07 00:00:00')->subDays(2)->calendar(Carbon::parse('2018-01-07 00:00:00'))
        'thứ sáu tuần trước lúc 00:00',
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
        '12:00 sa CET',
        // Carbon::parse('2018-02-10 00:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 SA, 12:00 sa',
        // Carbon::parse('2018-02-10 01:30:00')->isoFormat('h:mm A, h:mm a')
        '1:30 SA, 1:30 sa',
        // Carbon::parse('2018-02-10 02:00:00')->isoFormat('h:mm A, h:mm a')
        '2:00 SA, 2:00 sa',
        // Carbon::parse('2018-02-10 06:00:00')->isoFormat('h:mm A, h:mm a')
        '6:00 SA, 6:00 sa',
        // Carbon::parse('2018-02-10 10:00:00')->isoFormat('h:mm A, h:mm a')
        '10:00 SA, 10:00 sa',
        // Carbon::parse('2018-02-10 12:00:00')->isoFormat('h:mm A, h:mm a')
        '12:00 CH, 12:00 ch',
        // Carbon::parse('2018-02-10 17:00:00')->isoFormat('h:mm A, h:mm a')
        '5:00 CH, 5:00 ch',
        // Carbon::parse('2018-02-10 21:30:00')->isoFormat('h:mm A, h:mm a')
        '9:30 CH, 9:30 ch',
        // Carbon::parse('2018-02-10 23:00:00')->isoFormat('h:mm A, h:mm a')
        '11:00 CH, 11:00 ch',
        // Carbon::parse('2018-01-01 00:00:00')->ordinal('hour')
        '0',
        // Carbon::now()->subSeconds(1)->diffForHumans()
        '1 giây trước',
        // Carbon::now()->subSeconds(1)->diffForHumans(null, false, true)
        '1 giây trước',
        // Carbon::now()->subSeconds(2)->diffForHumans()
        '2 giây trước',
        // Carbon::now()->subSeconds(2)->diffForHumans(null, false, true)
        '2 giây trước',
        // Carbon::now()->subMinutes(1)->diffForHumans()
        '1 phút trước',
        // Carbon::now()->subMinutes(1)->diffForHumans(null, false, true)
        '1 phút trước',
        // Carbon::now()->subMinutes(2)->diffForHumans()
        '2 phút trước',
        // Carbon::now()->subMinutes(2)->diffForHumans(null, false, true)
        '2 phút trước',
        // Carbon::now()->subHours(1)->diffForHumans()
        '1 giờ trước',
        // Carbon::now()->subHours(1)->diffForHumans(null, false, true)
        '1 giờ trước',
        // Carbon::now()->subHours(2)->diffForHumans()
        '2 giờ trước',
        // Carbon::now()->subHours(2)->diffForHumans(null, false, true)
        '2 giờ trước',
        // Carbon::now()->subDays(1)->diffForHumans()
        '1 ngày trước',
        // Carbon::now()->subDays(1)->diffForHumans(null, false, true)
        '1 ngày trước',
        // Carbon::now()->subDays(2)->diffForHumans()
        '2 ngày trước',
        // Carbon::now()->subDays(2)->diffForHumans(null, false, true)
        '2 ngày trước',
        // Carbon::now()->subWeeks(1)->diffForHumans()
        '1 tuần trước',
        // Carbon::now()->subWeeks(1)->diffForHumans(null, false, true)
        '1 tuần trước',
        // Carbon::now()->subWeeks(2)->diffForHumans()
        '2 tuần trước',
        // Carbon::now()->subWeeks(2)->diffForHumans(null, false, true)
        '2 tuần trước',
        // Carbon::now()->subMonths(1)->diffForHumans()
        '1 tháng trước',
        // Carbon::now()->subMonths(1)->diffForHumans(null, false, true)
        '1 tháng trước',
        // Carbon::now()->subMonths(2)->diffForHumans()
        '2 tháng trước',
        // Carbon::now()->subMonths(2)->diffForHumans(null, false, true)
        '2 tháng trước',
        // Carbon::now()->subYears(1)->diffForHumans()
        '1 năm trước',
        // Carbon::now()->subYears(1)->diffForHumans(null, false, true)
        '1 năm trước',
        // Carbon::now()->subYears(2)->diffForHumans()
        '2 năm trước',
        // Carbon::now()->subYears(2)->diffForHumans(null, false, true)
        '2 năm trước',
        // Carbon::now()->addSecond()->diffForHumans()
        '1 giây tới',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true)
        '1 giây tới',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now())
        '1 giây sau',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), false, true)
        '1 giây sau',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond())
        '1 giây trước',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond(), false, true)
        '1 giây trước',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true)
        '1 giây',
        // Carbon::now()->addSecond()->diffForHumans(Carbon::now(), true, true)
        '1 giây',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true)
        '2 giây',
        // Carbon::now()->diffForHumans(Carbon::now()->addSecond()->addSecond(), true, true)
        '2 giây',
        // Carbon::now()->addSecond()->diffForHumans(null, false, true, 1)
        '1 giây tới',
        // Carbon::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)
        '1 phút 1 giây',
        // Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)
        '2 năm 3 tháng 1 ngày 1 giây',
        // Carbon::now()->addYears(3)->diffForHumans(null, null, false, 4)
        '3 năm tới',
        // Carbon::now()->subMonths(5)->diffForHumans(null, null, true, 4)
        '5 tháng trước',
        // Carbon::now()->subYears(2)->subMonths(3)->subDay()->subSecond()->diffForHumans(null, null, true, 4)
        '2 năm 3 tháng 1 ngày 1 giây trước',
        // Carbon::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)
        '1 tuần 10 giờ',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 tuần 6 ngày',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)
        '1 tuần 6 ngày',
        // Carbon::now()->addWeek()->addDays(6)->diffForHumans(["join" => true, "parts" => 2])
        '1 tuần và 6 ngày tới',
        // Carbon::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)
        '2 tuần 1 giờ',
        // Carbon::now()->addHour()->diffForHumans(["aUnit" => true])
        'một giờ tới',
        // CarbonInterval::days(2)->forHumans()
        '2 ngày',
        // CarbonInterval::create('P1DT3H')->forHumans(true)
        '1 ngày 3 giờ',
    ];
}
