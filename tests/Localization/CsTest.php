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

class CsTest extends AbstractTestCase
{
    public function testDiffForHumansLocalizedInCzech()
    {
        Carbon::setLocale('cs');

        $scope = $this;
        $this->wrapWithNonDstDate(function () use ($scope) {
            $d = Carbon::now()->subSeconds(1);
            $scope->assertSame('1 sekundu nazpět', $d->diffForHumans());

            $d = Carbon::now()->subSeconds(2);
            $scope->assertSame('2 sekundy nazpět', $d->diffForHumans());

            $d = Carbon::now()->subMinutes(1);
            $scope->assertSame('1 minutu nazpět', $d->diffForHumans());

            $d = Carbon::now()->subMinutes(2);
            $scope->assertSame('2 minuty nazpět', $d->diffForHumans());

            $d = Carbon::now()->subHours(1);
            $scope->assertSame('1 hodinu nazpět', $d->diffForHumans());

            $d = Carbon::now()->subHours(2);
            $scope->assertSame('2 hodiny nazpět', $d->diffForHumans());

            $d = Carbon::now()->subDays(1);
            $scope->assertSame('1 den nazpět', $d->diffForHumans());

            $d = Carbon::now()->subDays(2);
            $scope->assertSame('2 dny nazpět', $d->diffForHumans());

            $d = Carbon::now()->subWeeks(1);
            $scope->assertSame('1 týden nazpět', $d->diffForHumans());

            $d = Carbon::now()->subWeeks(2);
            $scope->assertSame('2 týdny nazpět', $d->diffForHumans());

            $d = Carbon::now()->subMonths(1);
            $scope->assertSame('1 měsíc nazpět', $d->diffForHumans());

            $d = Carbon::now()->subMonths(2);
            $scope->assertSame('2 měsíce nazpět', $d->diffForHumans());

            $d = Carbon::now()->subYears(1);
            $scope->assertSame('1 rok nazpět', $d->diffForHumans());

            $d = Carbon::now()->subYears(2);
            $scope->assertSame('2 roky nazpět', $d->diffForHumans());

            $d = Carbon::now()->addSecond();
            $scope->assertSame('za 1 sekundu', $d->diffForHumans());

            $d = Carbon::now()->addSecond();
            $d2 = Carbon::now();
            $scope->assertSame('1 sekundu později', $d->diffForHumans($d2));
            $scope->assertSame('1 sekundu předtím', $d2->diffForHumans($d));

            $scope->assertSame('1 sekundu', $d->diffForHumans($d2, true));
            $scope->assertSame('2 sekundy', $d2->diffForHumans($d->addSecond(), true));
        });
    }
}
