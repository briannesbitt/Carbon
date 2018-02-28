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

class ViTest extends AbstractTestCase
{
    public function testDiffForHumansLocalizedInVietNamese()
    {
        Carbon::setLocale('vi');

        $scope = $this;
        $this->wrapWithNonDstDate(function () use ($scope) {
            $d = Carbon::now()->subSeconds(1);
            $scope->assertSame('1 giây trước', $d->diffForHumans());

            $d = Carbon::now()->subSeconds(2);
            $scope->assertSame('2 giây trước', $d->diffForHumans());

            $d = Carbon::now()->subMinutes(1);
            $scope->assertSame('1 phút trước', $d->diffForHumans());

            $d = Carbon::now()->subMinutes(2);
            $scope->assertSame('2 phút trước', $d->diffForHumans());

            $d = Carbon::now()->subHours(1);
            $scope->assertSame('1 giờ trước', $d->diffForHumans());

            $d = Carbon::now()->subHours(2);
            $scope->assertSame('2 giờ trước', $d->diffForHumans());

            $d = Carbon::now()->subDays(1);
            $scope->assertSame('1 ngày trước', $d->diffForHumans());

            $d = Carbon::now()->subDays(2);
            $scope->assertSame('2 ngày trước', $d->diffForHumans());

            $d = Carbon::now()->subWeeks(1);
            $scope->assertSame('1 tuần trước', $d->diffForHumans());

            $d = Carbon::now()->subWeeks(2);
            $scope->assertSame('2 tuần trước', $d->diffForHumans());

            $d = Carbon::now()->subMonths(1);
            $scope->assertSame('1 tháng trước', $d->diffForHumans());

            $d = Carbon::now()->subMonths(2);
            $scope->assertSame('2 tháng trước', $d->diffForHumans());

            $d = Carbon::now()->subYears(1);
            $scope->assertSame('1 năm trước', $d->diffForHumans());

            $d = Carbon::now()->subYears(2);
            $scope->assertSame('2 năm trước', $d->diffForHumans());

            $d = Carbon::now()->addSecond();
            $scope->assertSame('1 giây từ bây giờ', $d->diffForHumans());

            $d = Carbon::now()->addSecond();
            $d2 = Carbon::now();
            $scope->assertSame('1 giây sau', $d->diffForHumans($d2));
            $scope->assertSame('1 giây trước', $d2->diffForHumans($d));

            $scope->assertSame('1 giây', $d->diffForHumans($d2, true));
            $scope->assertSame('2 giây', $d2->diffForHumans($d->addSecond(), true));
        });
    }
}
