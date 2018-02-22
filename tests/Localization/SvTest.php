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

class SvTest extends AbstractTestCase
{
    public function testDiffForHumansLocalizedInSwedish()
    {
        Carbon::setLocale('sv');

        $scope = $this;
        $this->wrapWithNonDstDate(function () use ($scope) {
            $d = Carbon::now()->subSeconds(1);
            $scope->assertSame('1 sekund sedan', $d->diffForHumans());

            $d = Carbon::now()->subSeconds(2);
            $scope->assertSame('2 sekunder sedan', $d->diffForHumans());

            $d = Carbon::now()->subMinutes(1);
            $scope->assertSame('1 minut sedan', $d->diffForHumans());

            $d = Carbon::now()->subMinutes(2);
            $scope->assertSame('2 minuter sedan', $d->diffForHumans());

            $d = Carbon::now()->subHours(1);
            $scope->assertSame('1 timme sedan', $d->diffForHumans());

            $d = Carbon::now()->subHours(2);
            $scope->assertSame('2 timmar sedan', $d->diffForHumans());

            $d = Carbon::now()->subDays(1);
            $scope->assertSame('1 dag sedan', $d->diffForHumans());

            $d = Carbon::now()->subDays(2);
            $scope->assertSame('2 dagar sedan', $d->diffForHumans());

            $d = Carbon::now()->subWeeks(1);
            $scope->assertSame('1 vecka sedan', $d->diffForHumans());

            $d = Carbon::now()->subWeeks(2);
            $scope->assertSame('2 veckor sedan', $d->diffForHumans());

            $d = Carbon::now()->subMonths(1);
            $scope->assertSame('1 månad sedan', $d->diffForHumans());

            $d = Carbon::now()->subMonths(2);
            $scope->assertSame('2 månader sedan', $d->diffForHumans());

            $d = Carbon::now()->subYears(1);
            $scope->assertSame('1 år sedan', $d->diffForHumans());

            $d = Carbon::now()->subYears(2);
            $scope->assertSame('2 år sedan', $d->diffForHumans());

            $d = Carbon::now()->addSecond();
            $scope->assertSame('om 1 sekund', $d->diffForHumans());

            $d = Carbon::now()->addSecond();
            $d2 = Carbon::now();
            $scope->assertSame('1 sekund efter', $d->diffForHumans($d2));
            $scope->assertSame('1 sekund före', $d2->diffForHumans($d));

            $scope->assertSame('1 sekund', $d->diffForHumans($d2, true));
            $scope->assertSame('2 sekunder', $d2->diffForHumans($d->addSecond(), true));
        });
    }
}
