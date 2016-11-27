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

class DeTest extends AbstractTestCase
{
    public function testDiffForHumansLocalizedInGerman()
    {
        Carbon::setLocale('de');

        $scope = $this;
        $this->wrapWithNonDstDate(function () use ($scope) {
            $d = Carbon::now()->addYear();
            $scope->assertSame('in 1 Jahr', $d->diffForHumans());
            $scope->assertSame('1J', $d->diffForHumans(null, true, true));

            $d = Carbon::now()->addYears(2);
            $scope->assertSame('in 2 Jahren', $d->diffForHumans());
            $scope->assertSame('2J', $d->diffForHumans(null, true, true));
            $scope->assertSame('in 2J', $d->diffForHumans(null, false, true));

            $d = Carbon::now()->subYear();
            $scope->assertSame('1 Jahr später', Carbon::now()->diffForHumans($d));

            $d = Carbon::now()->subYears(2);
            $scope->assertSame('2 Jahre später', Carbon::now()->diffForHumans($d));

            $d = Carbon::now()->addYear();
            $scope->assertSame('1 Jahr zuvor', Carbon::now()->diffForHumans($d));

            $d = Carbon::now()->addYears(2);
            $scope->assertSame('2 Jahre zuvor', Carbon::now()->diffForHumans($d));

            $d = Carbon::now()->subYear();
            $scope->assertSame('vor 1 Jahr', $d->diffForHumans());

            $d = Carbon::now()->subYears(2);
            $scope->assertSame('vor 2 Jahren', $d->diffForHumans());

            $d = Carbon::now()->subMinute();
            $scope->assertSame('1Min', $d->diffForHumans(null, true, true));

            $d = Carbon::now()->subHours(2);
            $scope->assertSame('vor 2Std', $d->diffForHumans(null, false, true));

            $d = Carbon::now()->subDay();
            $scope->assertSame('vor 1Tg', $d->diffForHumans(null, false, true));

            $d = Carbon::now()->subWeeks(2);
            $scope->assertSame('vor 2Wo', $d->diffForHumans(null, false, true));

            $d = Carbon::now()->subMonths(2);
            $scope->assertSame('vor 2Mon', $d->diffForHumans(null, false, true));

            $d = Carbon::now()->addYear();
            $scope->assertSame('in 1J', $d->diffForHumans(null, false, true));

            $d = Carbon::now()->subSeconds(2);
            $scope->assertSame('vor 2Sek', $d->diffForHumans(null, false, true));
        });
    }
}
