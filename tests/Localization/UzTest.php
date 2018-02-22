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

class UzTest extends AbstractTestCase
{
    public function testDiffForHumansLocalizedInUzbek()
    {
        Carbon::setLocale('uz');

        $scope = $this;
        $this->wrapWithNonDstDate(function () use ($scope) {
            $d = Carbon::now()->subSeconds(1);
            $scope->assertSame('1 soniya avval', $d->diffForHumans());

            $d = Carbon::now()->subSeconds(2);
            $scope->assertSame('2 soniya avval', $d->diffForHumans());

            $d = Carbon::now()->subMinutes(1);
            $scope->assertSame('1 daqiqa avval', $d->diffForHumans());

            $d = Carbon::now()->subMinutes(2);
            $scope->assertSame('2 daqiqa avval', $d->diffForHumans());

            $d = Carbon::now()->subHours(1);
            $scope->assertSame('1 soat avval', $d->diffForHumans());

            $d = Carbon::now()->subHours(2);
            $scope->assertSame('2 soat avval', $d->diffForHumans());

            $d = Carbon::now()->subDays(1);
            $scope->assertSame('1 kun avval', $d->diffForHumans());

            $d = Carbon::now()->subDays(2);
            $scope->assertSame('2 kun avval', $d->diffForHumans());

            $d = Carbon::now()->subWeeks(1);
            $scope->assertSame('1 hafta avval', $d->diffForHumans());

            $d = Carbon::now()->subWeeks(2);
            $scope->assertSame('2 hafta avval', $d->diffForHumans());

            $d = Carbon::now()->subMonths(1);
            $scope->assertSame('1 oy avval', $d->diffForHumans());

            $d = Carbon::now()->subMonths(2);
            $scope->assertSame('2 oy avval', $d->diffForHumans());

            $d = Carbon::now()->subYears(1);
            $scope->assertSame('1 yil avval', $d->diffForHumans());

            $d = Carbon::now()->subYears(2);
            $scope->assertSame('2 yil avval', $d->diffForHumans());

            $d = Carbon::now()->addSecond();
            $scope->assertSame('1 soniya dan keyin', $d->diffForHumans());
            $d = Carbon::now()->addSecond();
            $d2 = Carbon::now();
            $scope->assertSame('1 soniya keyin', $d->diffForHumans($d2));
            $scope->assertSame('1 soniya oldin', $d2->diffForHumans($d));
            $scope->assertSame('1 soniya', $d->diffForHumans($d2, true));
            $scope->assertSame('2 soniya', $d2->diffForHumans($d->addSecond(), true));
        });
    }
}
