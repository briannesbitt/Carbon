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

class OcTest extends AbstractTestCase
{
    public function testDiffForHumansLocalizedInOccitan()
    {
        Carbon::setLocale('oc');

        $scope = $this;
        $this->wrapWithNonDstDate(function () use ($scope) {
            $d = Carbon::now()->subSeconds(1);
            $scope->assertSame('fa 1 segonda', $d->diffForHumans());

            $d = Carbon::now()->subSeconds(2);
            $scope->assertSame('fa 2 segondas', $d->diffForHumans());

            $d = Carbon::now()->subMinutes(1);
            $scope->assertSame('fa 1 minuta', $d->diffForHumans());

            $d = Carbon::now()->subMinutes(2);
            $scope->assertSame('fa 2 minutas', $d->diffForHumans());

            $d = Carbon::now()->subHours(1);
            $scope->assertSame('fa 1 ora', $d->diffForHumans());

            $d = Carbon::now()->subHours(2);
            $scope->assertSame('fa 2 oras', $d->diffForHumans());

            $d = Carbon::now()->subDays(1);
            $scope->assertSame('fa 1 jorn', $d->diffForHumans());

            $d = Carbon::now()->subDays(2);
            $scope->assertSame('fa 2 jorns', $d->diffForHumans());

            $d = Carbon::now()->subWeeks(1);
            $scope->assertSame('fa 1 setmana', $d->diffForHumans());

            $d = Carbon::now()->subWeeks(2);
            $scope->assertSame('fa 2 setmanas', $d->diffForHumans());

            $d = Carbon::now()->subMonths(1);
            $scope->assertSame('fa 1 mes', $d->diffForHumans());

            $d = Carbon::now()->subMonths(2);
            $scope->assertSame('fa 2 meses', $d->diffForHumans());

            $d = Carbon::now()->subYears(1);
            $scope->assertSame('fa 1 an', $d->diffForHumans());

            $d = Carbon::now()->subYears(2);
            $scope->assertSame('fa 2 ans', $d->diffForHumans());

            $d = Carbon::now()->addSecond();
            $scope->assertSame('dins 1 segonda', $d->diffForHumans());

            $d = Carbon::now()->addSecond();
            $d2 = Carbon::now();
            $scope->assertSame('1 segonda aprèp', $d->diffForHumans($d2));
            $scope->assertSame('1 segonda abans', $d2->diffForHumans($d));

            $scope->assertSame('1 segonda', $d->diffForHumans($d2, true));
            $scope->assertSame('2 segondas', $d2->diffForHumans($d->addSecond(), true));
        });
    }
}
