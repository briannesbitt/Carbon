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

class AfTest extends AbstractTestCase
{
    public function testDiffForHumansLocalizedInAfrikaans()
    {
        Carbon::setLocale('af');

        $scope = $this;
        $this->wrapWithNonDstDate(function () use ($scope) {
            $d = Carbon::now()->subSeconds(1);
            $scope->assertSame('1 sekond terug', $d->diffForHumans());

            $d = Carbon::now()->subSeconds(2);
            $scope->assertSame('2 sekondes terug', $d->diffForHumans());

            $d = Carbon::now()->subMinutes(1);
            $scope->assertSame('1 minuut terug', $d->diffForHumans());

            $d = Carbon::now()->subMinutes(2);
            $scope->assertSame('2 minute terug', $d->diffForHumans());

            $d = Carbon::now()->subHours(1);
            $scope->assertSame('1 uur terug', $d->diffForHumans());

            $d = Carbon::now()->subHours(2);
            $scope->assertSame('2 ure terug', $d->diffForHumans());

            $d = Carbon::now()->subDays(1);
            $scope->assertSame('1 dag terug', $d->diffForHumans());

            $d = Carbon::now()->subDays(2);
            $scope->assertSame('2 dae terug', $d->diffForHumans());

            $d = Carbon::now()->subWeeks(1);
            $scope->assertSame('1 week terug', $d->diffForHumans());

            $d = Carbon::now()->subWeeks(2);
            $scope->assertSame('2 weke terug', $d->diffForHumans());

            $d = Carbon::now()->subMonths(1);
            $scope->assertSame('1 maand terug', $d->diffForHumans());

            $d = Carbon::now()->subMonths(2);
            $scope->assertSame('2 maande terug', $d->diffForHumans());

            $d = Carbon::now()->subYears(1);
            $scope->assertSame('1 jaar terug', $d->diffForHumans());

            $d = Carbon::now()->subYears(2);
            $scope->assertSame('2 jare terug', $d->diffForHumans());

            $d = Carbon::now()->addSecond();
            $scope->assertSame('1 sekond van nou af', $d->diffForHumans());

            $d = Carbon::now()->addSecond();
            $d2 = Carbon::now();
            $scope->assertSame('1 sekond na', $d->diffForHumans($d2));
            $scope->assertSame('1 sekond voor', $d2->diffForHumans($d));

            $scope->assertSame('1 sekond', $d->diffForHumans($d2, true));
            $scope->assertSame('2 sekondes', $d2->diffForHumans($d->addSecond(), true));
        });
    }
}
