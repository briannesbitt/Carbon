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

class EuTest extends AbstractTestCase
{
    public function testDiffForHumansLocalizedInBasque()
    {
        Carbon::setLocale('eu');

        $scope = $this;
        $this->wrapWithNonDstDate(function () use ($scope) {
            $d = Carbon::now()->subSeconds(1);
            $scope->assertSame('Orain dela Segundu 1', $d->diffForHumans());

            $d = Carbon::now()->subSeconds(2);
            $scope->assertSame('Orain dela 2 segundu', $d->diffForHumans());

            $d = Carbon::now()->subMinutes(1);
            $scope->assertSame('Orain dela Minutu 1', $d->diffForHumans());

            $d = Carbon::now()->subMinutes(2);
            $scope->assertSame('Orain dela 2 minutu', $d->diffForHumans());

            $d = Carbon::now()->subHours(1);
            $scope->assertSame('Orain dela Ordu 1', $d->diffForHumans());

            $d = Carbon::now()->subHours(2);
            $scope->assertSame('Orain dela 2 ordu', $d->diffForHumans());

            $d = Carbon::now()->subDays(1);
            $scope->assertSame('Orain dela Egun 1', $d->diffForHumans());

            $d = Carbon::now()->subDays(2);
            $scope->assertSame('Orain dela 2 egun', $d->diffForHumans());

            $d = Carbon::now()->subWeeks(1);
            $scope->assertSame('Orain dela Aste 1', $d->diffForHumans());

            $d = Carbon::now()->subWeeks(2);
            $scope->assertSame('Orain dela 2 aste', $d->diffForHumans());

            $d = Carbon::now()->subMonths(1);
            $scope->assertSame('Orain dela Hile 1', $d->diffForHumans());

            $d = Carbon::now()->subMonths(2);
            $scope->assertSame('Orain dela 2 hile', $d->diffForHumans());

            $d = Carbon::now()->subYears(1);
            $scope->assertSame('Orain dela Urte 1', $d->diffForHumans());

            $d = Carbon::now()->subYears(2);
            $scope->assertSame('Orain dela 2 urte', $d->diffForHumans());

            $d = Carbon::now()->addSecond();
            $scope->assertSame('Segundu 1 barru', $d->diffForHumans());

            $d = Carbon::now()->addSecond();
            $d2 = Carbon::now();
            $scope->assertSame('Segundu 1 geroago', $d->diffForHumans($d2));
            $scope->assertSame('Segundu 1 lehenago', $d2->diffForHumans($d));

            $scope->assertSame('Segundu 1', $d->diffForHumans($d2, true));
            $scope->assertSame('2 segundu', $d2->diffForHumans($d->addSecond(), true));
        });
    }
}
