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

class JaTest extends AbstractTestCase
{
    public function testDiffForHumansLocalizedInJapanese()
    {
        Carbon::setLocale('ja');

        $scope = $this;
        $this->wrapWithNonDstDate(function () use ($scope) {
            $d = Carbon::now()->subSecond();
            $scope->assertSame('1 秒 前', $d->diffForHumans());

            $d = Carbon::now()->subSeconds(2);
            $scope->assertSame('2 秒 前', $d->diffForHumans());

            $d = Carbon::now()->subMinute();
            $scope->assertSame('1 分 前', $d->diffForHumans());

            $d = Carbon::now()->subMinutes(2);
            $scope->assertSame('2 分 前', $d->diffForHumans());

            $d = Carbon::now()->subHour();
            $scope->assertSame('1 時間 前', $d->diffForHumans());

            $d = Carbon::now()->subHours(2);
            $scope->assertSame('2 時間 前', $d->diffForHumans());

            $d = Carbon::now()->subDay();
            $scope->assertSame('1 日 前', $d->diffForHumans());

            $d = Carbon::now()->subDays(2);
            $scope->assertSame('2 日 前', $d->diffForHumans());

            $d = Carbon::now()->subWeek();
            $scope->assertSame('1 週間 前', $d->diffForHumans());

            $d = Carbon::now()->subWeeks(2);
            $scope->assertSame('2 週間 前', $d->diffForHumans());

            $d = Carbon::now()->subMonth();
            $scope->assertSame('1 ヶ月 前', $d->diffForHumans());

            $d = Carbon::now()->subMonths(2);
            $scope->assertSame('2 ヶ月 前', $d->diffForHumans());

            $d = Carbon::now()->subYear();
            $scope->assertSame('1 年 前', $d->diffForHumans());

            $d = Carbon::now()->subYears(2);
            $scope->assertSame('2 年 前', $d->diffForHumans());

            $d = Carbon::now()->addSecond();
            $scope->assertSame('今から 1 秒', $d->diffForHumans());

            $d = Carbon::now()->addSecond();
            $d2 = Carbon::now();
            $scope->assertSame('1 秒 後', $d->diffForHumans($d2));
            $scope->assertSame('1 秒 前', $d2->diffForHumans($d));

            $scope->assertSame('1 秒', $d->diffForHumans($d2, true));
            $scope->assertSame('2 秒', $d2->diffForHumans($d->addSecond(), true));
        });
    }
}
