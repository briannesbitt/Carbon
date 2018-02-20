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

class SkTest extends AbstractTestCase
{
    public function testDiffForHumansLocalizedInSlovak()
    {
        Carbon::setLocale('sk');

        $scope = $this;
        $this->wrapWithNonDstDate(function () use ($scope) {
            $d = Carbon::now()->subSeconds(1);
            $scope->assertSame('pred sekundu', $d->diffForHumans());

            $d = Carbon::now()->subSeconds(2);
            $scope->assertSame('pred 2 sekundy', $d->diffForHumans());

            $d = Carbon::now()->subMinutes(1);
            $scope->assertSame('pred minútu', $d->diffForHumans());

            $d = Carbon::now()->subMinutes(2);
            $scope->assertSame('pred 2 minúty', $d->diffForHumans());

            $d = Carbon::now()->subHours(1);
            $scope->assertSame('pred hodinu', $d->diffForHumans());

            $d = Carbon::now()->subHours(2);
            $scope->assertSame('pred 2 hodiny', $d->diffForHumans());

            $d = Carbon::now()->subDays(1);
            $scope->assertSame('pred deň', $d->diffForHumans());

            $d = Carbon::now()->subDays(2);
            $scope->assertSame('pred 2 dni', $d->diffForHumans());

            $d = Carbon::now()->subWeeks(1);
            $scope->assertSame('pred týždeň', $d->diffForHumans());

            $d = Carbon::now()->subWeeks(2);
            $scope->assertSame('pred 2 týždne', $d->diffForHumans());

            $d = Carbon::now()->subMonths(1);
            $scope->assertSame('pred mesiac', $d->diffForHumans());

            $d = Carbon::now()->subMonths(2);
            $scope->assertSame('pred 2 mesiace', $d->diffForHumans());

            $d = Carbon::now()->subYears(1);
            $scope->assertSame('pred rok', $d->diffForHumans());

            $d = Carbon::now()->subYears(2);
            $scope->assertSame('pred 2 roky', $d->diffForHumans());

            $d = Carbon::now()->addSecond();
            $scope->assertSame('za sekundu', $d->diffForHumans());

            $d = Carbon::now()->addSecond();
            $d2 = Carbon::now();
            $scope->assertSame('sekundu neskôr', $d->diffForHumans($d2));
            $scope->assertSame('sekundu predtým', $d2->diffForHumans($d));

            $scope->assertSame('sekundu', $d->diffForHumans($d2, true));
            $scope->assertSame('2 sekundy', $d2->diffForHumans($d->addSecond(), true));
        });
    }
}
