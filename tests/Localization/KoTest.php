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

class KoTest extends AbstractTestCase
{
    public function testDiffForHumansLocalizedInKorean()
    {
        Carbon::setLocale('ko');

        $scope = $this;
        $this->wrapWithNonDstDate(function () use ($scope) {
            $d = Carbon::now()->subSeconds(1);
            $scope->assertSame('1 초 전', $d->diffForHumans());

            $d = Carbon::now()->subSeconds(2);
            $scope->assertSame('2 초 전', $d->diffForHumans());

            $d = Carbon::now()->subMinutes(1);
            $scope->assertSame('1 분 전', $d->diffForHumans());

            $d = Carbon::now()->subMinutes(2);
            $scope->assertSame('2 분 전', $d->diffForHumans());

            $d = Carbon::now()->subHours(1);
            $scope->assertSame('1 시간 전', $d->diffForHumans());

            $d = Carbon::now()->subHours(2);
            $scope->assertSame('2 시간 전', $d->diffForHumans());

            $d = Carbon::now()->subDays(1);
            $scope->assertSame('1 일 전', $d->diffForHumans());

            $d = Carbon::now()->subDays(2);
            $scope->assertSame('2 일 전', $d->diffForHumans());

            $d = Carbon::now()->subWeeks(1);
            $scope->assertSame('1 주일 전', $d->diffForHumans());

            $d = Carbon::now()->subWeeks(2);
            $scope->assertSame('2 주일 전', $d->diffForHumans());

            $d = Carbon::now()->subMonths(1);
            $scope->assertSame('1 개월 전', $d->diffForHumans());

            $d = Carbon::now()->subMonths(2);
            $scope->assertSame('2 개월 전', $d->diffForHumans());

            $d = Carbon::now()->subYears(1);
            $scope->assertSame('1 년 전', $d->diffForHumans());

            $d = Carbon::now()->subYears(2);
            $scope->assertSame('2 년 전', $d->diffForHumans());

            $d = Carbon::now()->addSecond();
            $scope->assertSame('1 초 후', $d->diffForHumans());

            $d = Carbon::now()->addSecond();
            $d2 = Carbon::now();
            $scope->assertSame('1 초 이후', $d->diffForHumans($d2));
            $scope->assertSame('1 초 이전', $d2->diffForHumans($d));

            $scope->assertSame('1 초', $d->diffForHumans($d2, true));
            $scope->assertSame('2 초', $d2->diffForHumans($d->addSecond(), true));
        });
    }
}
