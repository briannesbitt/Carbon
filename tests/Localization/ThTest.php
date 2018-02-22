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
            $d = Carbon::now()->subSeconds(1);
            $scope->assertSame('1 วินาทีที่แล้ว', $d->diffForHumans());

            $d = Carbon::now()->subSeconds(2);
            $scope->assertSame('2 วินาทีที่แล้ว', $d->diffForHumans());

            $d = Carbon::now()->subMinutes(1);
            $scope->assertSame('1 นาทีที่แล้ว', $d->diffForHumans());

            $d = Carbon::now()->subMinutes(2);
            $scope->assertSame('2 นาทีที่แล้ว', $d->diffForHumans());

            $d = Carbon::now()->subHours(1);
            $scope->assertSame('1 ชั่วโมงที่แล้ว', $d->diffForHumans());

            $d = Carbon::now()->subHours(2);
            $scope->assertSame('2 ชั่วโมงที่แล้ว', $d->diffForHumans());

            $d = Carbon::now()->subDays(1);
            $scope->assertSame('1 วันที่แล้ว', $d->diffForHumans());

            $d = Carbon::now()->subDays(2);
            $scope->assertSame('2 วันที่แล้ว', $d->diffForHumans());

            $d = Carbon::now()->subWeeks(1);
            $scope->assertSame('1 สัปดาห์ที่แล้ว', $d->diffForHumans());

            $d = Carbon::now()->subWeeks(2);
            $scope->assertSame('2 สัปดาห์ที่แล้ว', $d->diffForHumans());

            $d = Carbon::now()->subMonths(1);
            $scope->assertSame('1 เดือนที่แล้ว', $d->diffForHumans());

            $d = Carbon::now()->subMonths(2);
            $scope->assertSame('2 เดือนที่แล้ว', $d->diffForHumans());

            $d = Carbon::now()->subYears(1);
            $scope->assertSame('1 ปีที่แล้ว', $d->diffForHumans());

            $d = Carbon::now()->subYears(2);
            $scope->assertSame('2 ปีที่แล้ว', $d->diffForHumans());

            $d = Carbon::now()->addSecond();
            $scope->assertSame('1 วินาทีต่อจากนี้', $d->diffForHumans());

            $d = Carbon::now()->addSecond();
            $d2 = Carbon::now();
            $scope->assertSame('1 วินาทีหลังจากนี้', $d->diffForHumans($d2));
            $scope->assertSame('1 วินาทีก่อน', $d2->diffForHumans($d));

            $scope->assertSame('1 วินาที', $d->diffForHumans($d2, true));
            $scope->assertSame('2 วินาที', $d2->diffForHumans($d->addSecond(), true));
        });
    }
}
