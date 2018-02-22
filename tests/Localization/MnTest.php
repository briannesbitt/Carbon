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

class MnTest extends AbstractTestCase
{
    public function testDiffForHumansLocalizedInMongolian()
    {
        Carbon::setLocale('mn');
        $scope = $this;
        $this->wrapWithNonDstDate(function () use ($scope) {
            $d = Carbon::now()->subSeconds(1);
            $scope->assertSame('1 секундын өмнө', $d->diffForHumans());

            $d = Carbon::now()->subSeconds(2);
            $scope->assertSame('2 секундын өмнө', $d->diffForHumans());

            $d = Carbon::now()->subMinutes(1);
            $scope->assertSame('1 минутын өмнө', $d->diffForHumans());

            $d = Carbon::now()->subMinutes(2);
            $scope->assertSame('2 минутын өмнө', $d->diffForHumans());

            $d = Carbon::now()->subHours(1);
            $scope->assertSame('1 цагийн өмнө', $d->diffForHumans());

            $d = Carbon::now()->subHours(2);
            $scope->assertSame('2 цагийн өмнө', $d->diffForHumans());

            $d = Carbon::now()->subDays(1);
            $scope->assertSame('1 хоногийн өмнө', $d->diffForHumans());

            $d = Carbon::now()->subDays(2);
            $scope->assertSame('2 хоногийн өмнө', $d->diffForHumans());

            $d = Carbon::now()->subWeeks(1);
            $scope->assertSame('1 долоо хоногн өмнө', $d->diffForHumans());

            $d = Carbon::now()->subWeeks(2);
            $scope->assertSame('2 долоо хоногн өмнө', $d->diffForHumans());

            $d = Carbon::now()->subMonths(1);
            $scope->assertSame('1 сарын өмнө', $d->diffForHumans());

            $d = Carbon::now()->subMonths(2);
            $scope->assertSame('2 сарын өмнө', $d->diffForHumans());

            $d = Carbon::now()->subYears(1);
            $scope->assertSame('1 жилийн өмнө', $d->diffForHumans());

            $d = Carbon::now()->subYears(2);
            $scope->assertSame('2 жилийн өмнө', $d->diffForHumans());

            $d = Carbon::now()->addSecond();
            $scope->assertSame('одоогоос 1 секундын дараа', $d->diffForHumans());
            $d = Carbon::now()->addSecond();
            $d2 = Carbon::now();
            $scope->assertSame('1 секундын дараа', $d->diffForHumans($d2));
            $scope->assertSame('1 секундын өмнө', $d2->diffForHumans($d));
            $scope->assertSame('1 секунд', $d->diffForHumans($d2, true));
            $scope->assertSame('2 секунд', $d2->diffForHumans($d->addSecond(), true));
        });
    }
}
