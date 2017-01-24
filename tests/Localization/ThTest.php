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

use Carbon\Carbon;
use Tests\AbstractTestCase;

class ThTest extends AbstractTestCase
{
    public function testDiffForHumansLocalizedInThai()
    {
        Carbon::setLocale('th');

        $scope = $this;
        $this->wrapWithNonDstDate(function () use ($scope) {
            $d = Carbon::now()->subSecond();
            $scope->assertSame('1 วินาทีที่แล้ว', $d->diffForHumans());

            $d = Carbon::now()->subSeconds(2);
            $scope->assertSame('2 วินาทีที่แล้ว', $d->diffForHumans());

            $d = Carbon::now()->subMinute();
            $scope->assertSame('1 นาทีที่แล้ว', $d->diffForHumans());

            $d = Carbon::now()->subMinutes(2);
            $scope->assertSame('2 นาทีที่แล้ว', $d->diffForHumans());

            $d = Carbon::now()->subHour();
            $scope->assertSame('1 ชั่วโมงที่แล้ว', $d->diffForHumans());

            $d = Carbon::now()->subHours(2);
            $scope->assertSame('2 ชั่วโมงที่แล้ว', $d->diffForHumans());

            $d = Carbon::now()->subDay();
            $scope->assertSame('1 วันที่แล้ว', $d->diffForHumans());

            $d = Carbon::now()->subDays(2);
            $scope->assertSame('2 วันที่แล้ว', $d->diffForHumans());

            $d = Carbon::now()->subWeek();
            $scope->assertSame('1 สัปดาห์ที่แล้ว', $d->diffForHumans());

            $d = Carbon::now()->subWeeks(2);
            $scope->assertSame('2 สัปดาห์ที่แล้ว', $d->diffForHumans());

            $d = Carbon::now()->subMonth();
            $scope->assertSame('1 เดือนที่แล้ว', $d->diffForHumans());

            $d = Carbon::now()->subMonths(2);
            $scope->assertSame('2 เดือนที่แล้ว', $d->diffForHumans());

            $d = Carbon::now()->subYear();
            $scope->assertSame('1 ปีที่แล้ว', $d->diffForHumans());

            $d = Carbon::now()->subYears(2);
            $scope->assertSame('2 ปีที่แล้ว', $d->diffForHumans());

            $d = Carbon::now()->addSecond();
            $scope->assertSame('1 วินาทีต่อจากนี้', $d->diffForHumans());

            $d = Carbon::now()->addSeconds(2);
            $scope->assertSame('2 วินาทีต่อจากนี้', $d->diffForHumans());

            $d = Carbon::now()->addMinute();
            $scope->assertSame('1 นาทีต่อจากนี้', $d->diffForHumans());

            $d = Carbon::now()->addMinutes(2);
            $scope->assertSame('2 นาทีต่อจากนี้', $d->diffForHumans());

            $d = Carbon::now()->addHour();
            $scope->assertSame('1 ชั่วโมงต่อจากนี้', $d->diffForHumans());

            $d = Carbon::now()->addHours(2);
            $scope->assertSame('2 ชั่วโมงต่อจากนี้', $d->diffForHumans());

            $d = Carbon::now()->addDay();
            $scope->assertSame('1 วันต่อจากนี้', $d->diffForHumans());

            $d = Carbon::now()->addDays(2);
            $scope->assertSame('2 วันต่อจากนี้', $d->diffForHumans());

            $d = Carbon::now()->addWeek();
            $scope->assertSame('1 สัปดาห์ต่อจากนี้', $d->diffForHumans());

            $d = Carbon::now()->addWeeks(2);
            $scope->assertSame('2 สัปดาห์ต่อจากนี้', $d->diffForHumans());

            $d = Carbon::now()->addMonth();
            $scope->assertSame('1 เดือนต่อจากนี้', $d->diffForHumans());

            $d = Carbon::now()->addMonths(2);
            $scope->assertSame('2 เดือนต่อจากนี้', $d->diffForHumans());

            $d = Carbon::now()->addYear();
            $scope->assertSame('1 ปีต่อจากนี้', $d->diffForHumans());

            $d = Carbon::now()->addYears(2);
            $scope->assertSame('2 ปีต่อจากนี้', $d->diffForHumans());

            $d = Carbon::now()->addSecond();
            $d2 = Carbon::now();
            $scope->assertSame('1 วินาทีหลังจากนี้', $d->diffForHumans($d2));
            $scope->assertSame('1 วินาทีก่อน', $d2->diffForHumans($d));
            $d = Carbon::now()->addSecond(2);
            $d2 = Carbon::now();
            $scope->assertSame('2 วินาทีหลังจากนี้', $d->diffForHumans($d2));
            $scope->assertSame('2 วินาทีก่อน', $d2->diffForHumans($d));

            $d = Carbon::now()->addMinute();
            $d2 = Carbon::now();
            $scope->assertSame('1 นาทีหลังจากนี้', $d->diffForHumans($d2));
            $scope->assertSame('1 นาทีก่อน', $d2->diffForHumans($d));
            $d = Carbon::now()->addMinute(2);
            $d2 = Carbon::now();
            $scope->assertSame('2 นาทีหลังจากนี้', $d->diffForHumans($d2));
            $scope->assertSame('2 นาทีก่อน', $d2->diffForHumans($d));

            $d = Carbon::now()->addHour();
            $d2 = Carbon::now();
            $scope->assertSame('1 ชั่วโมงหลังจากนี้', $d->diffForHumans($d2));
            $scope->assertSame('1 ชั่วโมงก่อน', $d2->diffForHumans($d));
            $d = Carbon::now()->addHour(2);
            $d2 = Carbon::now();
            $scope->assertSame('2 ชั่วโมงหลังจากนี้', $d->diffForHumans($d2));
            $scope->assertSame('2 ชั่วโมงก่อน', $d2->diffForHumans($d));

            $d = Carbon::now()->addDay();
            $d2 = Carbon::now();
            $scope->assertSame('1 วันหลังจากนี้', $d->diffForHumans($d2));
            $scope->assertSame('1 วันก่อน', $d2->diffForHumans($d));
            $d = Carbon::now()->addDay(2);
            $d2 = Carbon::now();
            $scope->assertSame('2 วันหลังจากนี้', $d->diffForHumans($d2));
            $scope->assertSame('2 วันก่อน', $d2->diffForHumans($d));

            $d = Carbon::now()->addWeek();
            $d2 = Carbon::now();
            $scope->assertSame('1 สัปดาห์หลังจากนี้', $d->diffForHumans($d2));
            $scope->assertSame('1 สัปดาห์ก่อน', $d2->diffForHumans($d));
            $d = Carbon::now()->addWeek(2);
            $d2 = Carbon::now();
            $scope->assertSame('2 สัปดาห์หลังจากนี้', $d->diffForHumans($d2));
            $scope->assertSame('2 สัปดาห์ก่อน', $d2->diffForHumans($d));

            $d = Carbon::now()->addMonth();
            $d2 = Carbon::now();
            $scope->assertSame('1 เดือนหลังจากนี้', $d->diffForHumans($d2));
            $scope->assertSame('1 เดือนก่อน', $d2->diffForHumans($d));
            $d = Carbon::now()->addMonth(2);
            $d2 = Carbon::now();
            $scope->assertSame('2 เดือนหลังจากนี้', $d->diffForHumans($d2));
            $scope->assertSame('2 เดือนก่อน', $d2->diffForHumans($d));

            $d = Carbon::now()->addYear();
            $d2 = Carbon::now();
            $scope->assertSame('1 ปีหลังจากนี้', $d->diffForHumans($d2));
            $scope->assertSame('1 ปีก่อน', $d2->diffForHumans($d));
            $d = Carbon::now()->addYear(2);
            $d2 = Carbon::now();
            $scope->assertSame('2 ปีหลังจากนี้', $d->diffForHumans($d2));
            $scope->assertSame('2 ปีก่อน', $d2->diffForHumans($d));

            $d = Carbon::now()->addSecond();
            $d2 = Carbon::now();
            $scope->assertSame('1 วินาที', $d->diffForHumans($d2, true));
            $scope->assertSame('2 วินาที', $d2->diffForHumans($d->addSecond(), true));

            $d = Carbon::now()->addMinute();
            $d2 = Carbon::now();
            $scope->assertSame('1 นาที', $d->diffForHumans($d2, true));
            $scope->assertSame('2 นาที', $d2->diffForHumans($d->addMinute(), true));

            $d = Carbon::now()->addHour();
            $d2 = Carbon::now();
            $scope->assertSame('1 ชั่วโมง', $d->diffForHumans($d2, true));
            $scope->assertSame('2 ชั่วโมง', $d2->diffForHumans($d->addHour(), true));

            $d = Carbon::now()->addDay();
            $d2 = Carbon::now();
            $scope->assertSame('1 วัน', $d->diffForHumans($d2, true));
            $scope->assertSame('2 วัน', $d2->diffForHumans($d->addDay(), true));

            $d = Carbon::now()->addWeek();
            $d2 = Carbon::now();
            $scope->assertSame('1 สัปดาห์', $d->diffForHumans($d2, true));
            $scope->assertSame('2 สัปดาห์', $d2->diffForHumans($d->addWeek(), true));

            $d = Carbon::now()->addMonth();
            $d2 = Carbon::now();
            $scope->assertSame('1 เดือน', $d->diffForHumans($d2, true));
            $scope->assertSame('2 เดือน', $d2->diffForHumans($d->addMonth(), true));

            $d = Carbon::now()->addYear();
            $d2 = Carbon::now();
            $scope->assertSame('1 ปี', $d->diffForHumans($d2, true));
            $scope->assertSame('2 ปี', $d2->diffForHumans($d->addYear(), true));
        });
    }
}
