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

class BsBaTest extends AbstractTestCase
{
    public function testDiffForHumansLocalizedInBsBa()
    {
        Carbon::setLocale('bs_BA');

        $scope = $this;
        $this->wrapWithNonDstDate(function () use ($scope) {
            $d = Carbon::now()->subSeconds(1);
            $scope->assertSame('prije 1 sekund', $d->diffForHumans());

            $d = Carbon::now()->subSeconds(2);
            $scope->assertSame('prije 2 sekunda', $d->diffForHumans());

            $d = Carbon::now()->subMinutes(1);
            $scope->assertSame('prije 1 minut', $d->diffForHumans());

            $d = Carbon::now()->subMinutes(2);
            $scope->assertSame('prije 2 minuta', $d->diffForHumans());

            $d = Carbon::now()->subHours(1);
            $scope->assertSame('prije 1 sat', $d->diffForHumans());

            $d = Carbon::now()->subHours(2);
            $scope->assertSame('prije 2 sata', $d->diffForHumans());

            $d = Carbon::now()->subDays(1);
            $scope->assertSame('prije 1 dan', $d->diffForHumans());

            $d = Carbon::now()->subDays(2);
            $scope->assertSame('prije 2 dana', $d->diffForHumans());

            $d = Carbon::now()->subWeeks(1);
            $scope->assertSame('prije 1 nedjelja', $d->diffForHumans());

            $d = Carbon::now()->subWeeks(2);
            $scope->assertSame('prije 2 nedjelje', $d->diffForHumans());

            $d = Carbon::now()->subMonths(1);
            $scope->assertSame('prije 1 mjesec', $d->diffForHumans());

            $d = Carbon::now()->subMonths(2);
            $scope->assertSame('prije 2 mjeseca', $d->diffForHumans());

            $d = Carbon::now()->subYears(1);
            $scope->assertSame('prije 1 godina', $d->diffForHumans());

            $d = Carbon::now()->subYears(2);
            $scope->assertSame('prije 2 godine', $d->diffForHumans());

            $d = Carbon::now()->addSecond();
            $scope->assertSame('za 1 sekund', $d->diffForHumans());

            $d = Carbon::now()->addSecond();
            $d2 = Carbon::now();
            $scope->assertSame('nakon 1 sekund', $d->diffForHumans($d2));
            $scope->assertSame('1 sekund ranije', $d2->diffForHumans($d));

            $scope->assertSame('1 sekund', $d->diffForHumans($d2, true));
            $scope->assertSame('2 sekunda', $d2->diffForHumans($d->addSecond(), true));
        });
    }
}
