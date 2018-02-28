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

class HrTest extends AbstractTestCase
{
    public function testDiffForHumansLocalizedInCroatian()
    {
        Carbon::setLocale('hr');

        $scope = $this;
        $this->wrapWithNonDstDate(function () use ($scope) {
            $d = Carbon::now()->subSeconds(1);
            $scope->assertSame('prije 1 sekundu', $d->diffForHumans());

            $d = Carbon::now()->subSeconds(2);
            $scope->assertSame('prije 2 sekunde', $d->diffForHumans());

            $d = Carbon::now()->subMinutes(1);
            $scope->assertSame('prije 1 minutu', $d->diffForHumans());

            $d = Carbon::now()->subMinutes(2);
            $scope->assertSame('prije 2 minute', $d->diffForHumans());

            $d = Carbon::now()->subHours(1);
            $scope->assertSame('prije 1 sat', $d->diffForHumans());

            $d = Carbon::now()->subHours(2);
            $scope->assertSame('prije 2 sata', $d->diffForHumans());

            $d = Carbon::now()->subDays(1);
            $scope->assertSame('prije 1 dan', $d->diffForHumans());

            $d = Carbon::now()->subDays(2);
            $scope->assertSame('prije 2 dana', $d->diffForHumans());

            $d = Carbon::now()->subWeeks(1);
            $scope->assertSame('prije 1 tjedan', $d->diffForHumans());

            $d = Carbon::now()->subWeeks(2);
            $scope->assertSame('prije 2 tjedna', $d->diffForHumans());

            $d = Carbon::now()->subMonths(1);
            $scope->assertSame('prije 1 mjesec', $d->diffForHumans());

            $d = Carbon::now()->subMonths(2);
            $scope->assertSame('prije 2 mjeseca', $d->diffForHumans());

            $d = Carbon::now()->subYears(1);
            $scope->assertSame('prije 1 godinu', $d->diffForHumans());

            $d = Carbon::now()->subYears(2);
            $scope->assertSame('prije 2 godine', $d->diffForHumans());

            $d = Carbon::now()->addSecond();
            $scope->assertSame('za 1 sekundu', $d->diffForHumans());

            $d = Carbon::now()->addSecond();
            $d2 = Carbon::now();
            $scope->assertSame('za 1 sekundu', $d->diffForHumans($d2));
            $scope->assertSame('prije 1 sekundu', $d2->diffForHumans($d));

            $scope->assertSame('1 sekundu', $d->diffForHumans($d2, true));
            $scope->assertSame('2 sekunde', $d2->diffForHumans($d->addSecond(), true));
        });
    }
}
