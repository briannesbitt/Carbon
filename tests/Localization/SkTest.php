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
        Carbon::setUtf8(true);

        $scope = $this;
        $this->wrapWithNonDstDate(function () use ($scope) {
            $d = Carbon::now()->subSeconds(1);
            $scope->assertSame('pred sekundou', $d->diffForHumans());

            $d = Carbon::now()->subSeconds(2);
            $scope->assertSame('pred 2 sekundami', $d->diffForHumans());

            $d = Carbon::now()->subMinutes(1);
            $scope->assertSame('pred minútou', $d->diffForHumans());

            $d = Carbon::now()->subMinutes(2);
            $scope->assertSame('pred 2 minútami', $d->diffForHumans());

            $d = Carbon::now()->subHours(1);
            $scope->assertSame('pred hodinou', $d->diffForHumans());

            $d = Carbon::now()->subHours(2);
            $scope->assertSame('pred 2 hodinami', $d->diffForHumans());

            $d = Carbon::now()->subDays(1);
            $scope->assertSame('pred dňom', $d->diffForHumans());

            $d = Carbon::now()->subDays(2);
            $scope->assertSame('pred 2 dňami', $d->diffForHumans());

            $d = Carbon::now()->subWeeks(1);
            $scope->assertSame('pred týždňom', $d->diffForHumans());

            $d = Carbon::now()->subWeeks(2);
            $scope->assertSame('pred 2 týždňami', $d->diffForHumans());

            $d = Carbon::now()->subMonths(1);
            $scope->assertSame('pred mesiacom', $d->diffForHumans());

            $d = Carbon::now()->subMonths(2);
            $scope->assertSame('pred 2 mesiacmi', $d->diffForHumans());

            $d = Carbon::now()->subYears(1);
            $scope->assertSame('pred rokom', $d->diffForHumans());

            $d = Carbon::now()->subYears(2);
            $scope->assertSame('pred 2 rokmi', $d->diffForHumans());

            $d = Carbon::now()->addSecond();
            $scope->assertSame('za sekundu', $d->diffForHumans());

            $d = Carbon::now()->addSeconds(2);
            $scope->assertSame('za 2 sekundy', $d->diffForHumans());

            $d = Carbon::now()->addSeconds(5);
            $scope->assertSame('za 5 sekúnd', $d->diffForHumans());

            $d = Carbon::now()->addYear();
            $scope->assertSame('za rok', $d->diffForHumans());

            $d = Carbon::now()->addYear(2);
            $scope->assertSame('za 2 roky', $d->diffForHumans());

            $d = Carbon::now()->addYear(5);
            $scope->assertSame('za 5 rokov', $d->diffForHumans());

            $d = Carbon::now()->addSecond();
            $d2 = Carbon::now();
            $scope->assertSame('o sekundu neskôr', $d->diffForHumans($d2));
            $scope->assertSame('sekundu predtým', $d2->diffForHumans($d));

            $d = Carbon::now()->addSecond(2);
            $d2 = Carbon::now();
            $scope->assertSame('o 2 sekundy neskôr', $d->diffForHumans($d2));
            $scope->assertSame('2 sekundy predtým', $d2->diffForHumans($d));

            $d = Carbon::now()->addSecond(5);
            $d2 = Carbon::now();
            $scope->assertSame('o 5 sekúnd neskôr', $d->diffForHumans($d2));
            $scope->assertSame('5 sekúnd predtým', $d2->diffForHumans($d));

            $d = Carbon::now()->addSecond();
            $d2 = Carbon::now();
            $scope->assertSame('sekundu', $d->diffForHumans($d2, true));
            $scope->assertSame('2 sekundy', $d2->diffForHumans($d->addSecond(), true));
        });
    }
}
