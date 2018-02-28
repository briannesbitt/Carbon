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

class FaTest extends AbstractTestCase
{
    public function testDiffForHumansLocalizedInPersian()
    {
        Carbon::setLocale('fa');

        $scope = $this;
        $this->wrapWithNonDstDate(function () use ($scope) {
            $d = Carbon::now()->subSeconds(1);
            $scope->assertSame('1 ثانیه پیش', $d->diffForHumans());

            $d = Carbon::now()->subSeconds(2);
            $scope->assertSame('2 ثانیه پیش', $d->diffForHumans());

            $d = Carbon::now()->subMinutes(1);
            $scope->assertSame('1 دقیقه پیش', $d->diffForHumans());

            $d = Carbon::now()->subMinutes(2);
            $scope->assertSame('2 دقیقه پیش', $d->diffForHumans());

            $d = Carbon::now()->subHours(1);
            $scope->assertSame('1 ساعت پیش', $d->diffForHumans());

            $d = Carbon::now()->subHours(2);
            $scope->assertSame('2 ساعت پیش', $d->diffForHumans());

            $d = Carbon::now()->subDays(1);
            $scope->assertSame('1 روز پیش', $d->diffForHumans());

            $d = Carbon::now()->subDays(2);
            $scope->assertSame('2 روز پیش', $d->diffForHumans());

            $d = Carbon::now()->subWeeks(1);
            $scope->assertSame('1 هفته پیش', $d->diffForHumans());

            $d = Carbon::now()->subWeeks(2);
            $scope->assertSame('2 هفته پیش', $d->diffForHumans());

            $d = Carbon::now()->subMonths(1);
            $scope->assertSame('1 ماه پیش', $d->diffForHumans());

            $d = Carbon::now()->subMonths(2);
            $scope->assertSame('2 ماه پیش', $d->diffForHumans());

            $d = Carbon::now()->subYears(1);
            $scope->assertSame('1 سال پیش', $d->diffForHumans());

            $d = Carbon::now()->subYears(2);
            $scope->assertSame('2 سال پیش', $d->diffForHumans());

            $d = Carbon::now()->addSecond();
            $scope->assertSame('1 ثانیه بعد', $d->diffForHumans());

            $d = Carbon::now()->addSecond();
            $d2 = Carbon::now();
            $scope->assertSame('1 ثانیه پس از', $d->diffForHumans($d2));
            $scope->assertSame('1 ثانیه پیش از', $d2->diffForHumans($d));

            $scope->assertSame('1 ثانیه', $d->diffForHumans($d2, true));
            $scope->assertSame('2 ثانیه', $d2->diffForHumans($d->addSecond(), true));
        });
    }
}
