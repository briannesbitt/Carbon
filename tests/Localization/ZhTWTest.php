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

class ZhTWTest extends AbstractTestCase
{
    public function testDiffForHumansLocalizedInZhTW()
    {
        Carbon::setLocale('zh_TW');

        $scope = $this;
        $this->wrapWithNonDstDate(function () use ($scope) {
            $d = Carbon::now()->subSecond();
            $scope->assertSame('1秒前', $d->diffForHumans());

            $d = Carbon::now()->subSeconds(2);
            $scope->assertSame('2秒前', $d->diffForHumans());

            $d = Carbon::now()->subMinute();
            $scope->assertSame('1分鐘前', $d->diffForHumans());

            $d = Carbon::now()->subMinutes(2);
            $scope->assertSame('2分鐘前', $d->diffForHumans());

            $d = Carbon::now()->subHour();
            $scope->assertSame('1小時前', $d->diffForHumans());

            $d = Carbon::now()->subHours(2);
            $scope->assertSame('2小時前', $d->diffForHumans());

            $d = Carbon::now()->subDay();
            $scope->assertSame('1天前', $d->diffForHumans());

            $d = Carbon::now()->subDays(2);
            $scope->assertSame('2天前', $d->diffForHumans());

            $d = Carbon::now()->subWeek();
            $scope->assertSame('1周前', $d->diffForHumans());

            $d = Carbon::now()->subWeeks(2);
            $scope->assertSame('2周前', $d->diffForHumans());

            $d = Carbon::now()->subMonth();
            $scope->assertSame('1個月前', $d->diffForHumans());

            $d = Carbon::now()->subMonths(2);
            $scope->assertSame('2個月前', $d->diffForHumans());

            $d = Carbon::now()->subYear();
            $scope->assertSame('1年前', $d->diffForHumans());

            $d = Carbon::now()->subYears(2);
            $scope->assertSame('2年前', $d->diffForHumans());

            $d = Carbon::now()->addSecond();
            $scope->assertSame('距現在1秒', $d->diffForHumans());

            $d = Carbon::now()->addSecond();
            $d2 = Carbon::now();
            $scope->assertSame('1秒後', $d->diffForHumans($d2));
            $scope->assertSame('1秒前', $d2->diffForHumans($d));

            $scope->assertSame('1秒', $d->diffForHumans($d2, true));
            $scope->assertSame('2秒', $d2->diffForHumans($d->addSecond(), true));
        });
    }
}
