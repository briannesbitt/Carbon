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

class CaTest extends AbstractTestCase
{
    public function testDiffForHumansLocalizedInCatalan()
    {
        Carbon::setLocale('ca');

        $scope = $this;
        $this->wrapWithNonDstDate(function () use ($scope) {
            $d = Carbon::now()->subSeconds(1);
            $scope->assertSame('fa 1 segon', $d->diffForHumans());

            $d = Carbon::now()->subSeconds(2);
            $scope->assertSame('fa 2 segons', $d->diffForHumans());

            $d = Carbon::now()->subMinutes(1);
            $scope->assertSame('fa 1 minut', $d->diffForHumans());

            $d = Carbon::now()->subMinutes(2);
            $scope->assertSame('fa 2 minuts', $d->diffForHumans());

            $d = Carbon::now()->subHours(1);
            $scope->assertSame('fa 1 hora', $d->diffForHumans());

            $d = Carbon::now()->subHours(2);
            $scope->assertSame('fa 2 hores', $d->diffForHumans());

            $d = Carbon::now()->subDays(1);
            $scope->assertSame('fa 1 dia', $d->diffForHumans());

            $d = Carbon::now()->subDays(2);
            $scope->assertSame('fa 2 dies', $d->diffForHumans());

            $d = Carbon::now()->subWeeks(1);
            $scope->assertSame('fa 1 setmana', $d->diffForHumans());

            $d = Carbon::now()->subWeeks(2);
            $scope->assertSame('fa 2 setmanes', $d->diffForHumans());

            $d = Carbon::now()->subMonths(1);
            $scope->assertSame('fa 1 mes', $d->diffForHumans());

            $d = Carbon::now()->subMonths(2);
            $scope->assertSame('fa 2 mesos', $d->diffForHumans());

            $d = Carbon::now()->subYears(1);
            $scope->assertSame('fa 1 any', $d->diffForHumans());

            $d = Carbon::now()->subYears(2);
            $scope->assertSame('fa 2 anys', $d->diffForHumans());

            $d = Carbon::now()->addSecond();
            $scope->assertSame('d\'aquí 1 segon', $d->diffForHumans());

            $d = Carbon::now()->addSecond();
            $d2 = Carbon::now();
            $scope->assertSame('1 segon després', $d->diffForHumans($d2));
            $scope->assertSame('1 segon abans', $d2->diffForHumans($d));

            $scope->assertSame('1 segon', $d->diffForHumans($d2, true));
            $scope->assertSame('2 segons', $d2->diffForHumans($d->addSecond(), true));
        });
    }
}
