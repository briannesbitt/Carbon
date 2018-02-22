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

class ZhTest extends AbstractTestCase
{
    public function testDiffForHumansLocalizedInChinese()
    {
        Carbon::setLocale('zh');

        $scope = $this;
        $this->wrapWithNonDstDate(function () use ($scope) {
            $d = Carbon::now()->subSeconds(1);
            $scope->assertSame('1秒前', $d->diffForHumans());

            $d = Carbon::now()->subSeconds(2);
            $scope->assertSame('2秒前', $d->diffForHumans());

            $d = Carbon::now()->subMinutes(1);
            $scope->assertSame('1分钟前', $d->diffForHumans());

            $d = Carbon::now()->subMinutes(2);
            $scope->assertSame('2分钟前', $d->diffForHumans());

            $d = Carbon::now()->subHours(1);
            $scope->assertSame('1小时前', $d->diffForHumans());

            $d = Carbon::now()->subHours(2);
            $scope->assertSame('2小时前', $d->diffForHumans());

            $d = Carbon::now()->subDays(1);
            $scope->assertSame('1天前', $d->diffForHumans());

            $d = Carbon::now()->subDays(2);
            $scope->assertSame('2天前', $d->diffForHumans());

            $d = Carbon::now()->subWeeks(1);
            $scope->assertSame('1周前', $d->diffForHumans());

            $d = Carbon::now()->subWeeks(2);
            $scope->assertSame('2周前', $d->diffForHumans());

            $d = Carbon::now()->subMonths(1);
            $scope->assertSame('1个月前', $d->diffForHumans());

            $d = Carbon::now()->subMonths(2);
            $scope->assertSame('2个月前', $d->diffForHumans());

            $d = Carbon::now()->subYears(1);
            $scope->assertSame('1年前', $d->diffForHumans());

            $d = Carbon::now()->subYears(2);
            $scope->assertSame('2年前', $d->diffForHumans());

            $d = Carbon::now()->addSecond();
            $scope->assertSame('距现在1秒', $d->diffForHumans());

            $d = Carbon::now()->addSecond();
            $d2 = Carbon::now();
            $scope->assertSame('1秒后', $d->diffForHumans($d2));
            $scope->assertSame('1秒前', $d2->diffForHumans($d));

            $scope->assertSame('1秒', $d->diffForHumans($d2, true));
            $scope->assertSame('2秒', $d2->diffForHumans($d->addSecond(), true));
        });
    }
}
