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

class ZhTwTest extends AbstractTestCase
{
    public function testDiffForHumansLocalizedInZhTw()
    {
        Carbon::setLocale('zh_TW');

        $scope = $this;
        $this->wrapWithNonDstDate(function () use ($scope) {
            $d = Carbon::now()->subSecond();
            $scope->assertSame('1 秒前', $d->diffForHumans());

            $d = Carbon::now()->subSeconds(2);
            $scope->assertSame('2 秒前', $d->diffForHumans());

            $d = Carbon::now()->subMinute();
            $scope->assertSame('1 分鐘前', $d->diffForHumans());

            $d = Carbon::now()->subMinutes(2);
            $scope->assertSame('2 分鐘前', $d->diffForHumans());

            $d = Carbon::now()->subHour();
            $scope->assertSame('1 小時前', $d->diffForHumans());

            $d = Carbon::now()->subHours(2);
            $scope->assertSame('2 小時前', $d->diffForHumans());

            $d = Carbon::now()->subDay();
            $scope->assertSame('1 天前', $d->diffForHumans());

            $d = Carbon::now()->subDays(2);
            $scope->assertSame('2 天前', $d->diffForHumans());

            $d = Carbon::now()->subWeek();
            $scope->assertSame('1 週前', $d->diffForHumans());

            $d = Carbon::now()->subWeeks(2);
            $scope->assertSame('2 週前', $d->diffForHumans());

            $d = Carbon::now()->subMonth();
            $scope->assertSame('1 月前', $d->diffForHumans());

            $d = Carbon::now()->subMonths(2);
            $scope->assertSame('2 月前', $d->diffForHumans());

            $d = Carbon::now()->subYear();
            $scope->assertSame('1 年前', $d->diffForHumans());

            $d = Carbon::now()->subYears(2);
            $scope->assertSame('2 年前', $d->diffForHumans());

            $d = Carbon::now()->addSecond();
            $scope->assertSame('距現在 1 秒', $d->diffForHumans());

            $d = Carbon::now()->addSecond();
            $d2 = Carbon::now();
            $scope->assertSame('1 秒後', $d->diffForHumans($d2));
            $scope->assertSame('1 秒前', $d2->diffForHumans($d));

            $scope->assertSame('1 秒', $d->diffForHumans($d2, true));
            $scope->assertSame('2 秒', $d2->diffForHumans($d->addSecond(), true));
        });
    }
}
