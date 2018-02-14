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

class ArTest extends AbstractTestCase
{
    public function testDiffForHumansLocalizedInAr()
    {
        Carbon::setLocale('ar');

        $scope = $this;
        $this->wrapWithNonDstDate(function () use ($scope) {
            $d = Carbon::now()->subSecond();
            $scope->assertSame('منذ ثانية', $d->diffForHumans());

            $d = Carbon::now()->subSeconds(2);
            $scope->assertSame('منذ ثانيتين', $d->diffForHumans());

            $d = Carbon::now()->subMinute();
            $scope->assertSame('منذ دقيقة', $d->diffForHumans());

            $d = Carbon::now()->subMinutes(2);
            $scope->assertSame('منذ دقيقتين', $d->diffForHumans());

            $d = Carbon::now()->subHour();
            $scope->assertSame('منذ ساعة', $d->diffForHumans());

            $d = Carbon::now()->subHours(2);
            $scope->assertSame('منذ ساعتين', $d->diffForHumans());

            $d = Carbon::now()->subDay();
            $scope->assertSame('منذ يوم', $d->diffForHumans());

            $d = Carbon::now()->subDays(2);
            $scope->assertSame('منذ يومين', $d->diffForHumans());

            $d = Carbon::now()->subWeek();
            $scope->assertSame('منذ أسبوع', $d->diffForHumans());

            $d = Carbon::now()->subWeeks(2);
            $scope->assertSame('منذ أسبوعين', $d->diffForHumans());

            $d = Carbon::now()->subMonth();
            $scope->assertSame('منذ شهر', $d->diffForHumans());

            $d = Carbon::now()->subMonths(2);
            $scope->assertSame('منذ شهرين', $d->diffForHumans());

            $d = Carbon::now()->subYear();
            $scope->assertSame('منذ سنة', $d->diffForHumans());

            $d = Carbon::now()->subYears(2);
            $scope->assertSame('منذ سنتين', $d->diffForHumans());

            $d = Carbon::now()->addSecond();
            $scope->assertSame('ثانية من الآن', $d->diffForHumans());

            $d = Carbon::now()->addSecond();
            $d2 = Carbon::now();
            $scope->assertSame('بعد ثانية', $d->diffForHumans($d2));
            $scope->assertSame('قبل ثانية', $d2->diffForHumans($d));

            $scope->assertSame('ثانية', $d->diffForHumans($d2, true));
            $scope->assertSame('ثانيتين', $d2->diffForHumans($d->addSecond(), true));
        });
    }
}
