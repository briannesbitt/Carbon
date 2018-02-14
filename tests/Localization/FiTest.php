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

class FiTest extends AbstractTestCase
{
    public function testDiffForHumansLocalizedInFi()
    {
        Carbon::setLocale('fi');

        $scope = $this;
        $this->wrapWithNonDstDate(function () use ($scope) {
            $d = Carbon::now()->subSecond();
            $scope->assertSame('1 sekunti sitten', $d->diffForHumans());

            $d = Carbon::now()->subSeconds(2);
            $scope->assertSame('2 sekuntia sitten', $d->diffForHumans());

            $d = Carbon::now()->subMinute();
            $scope->assertSame('1 minuutti sitten', $d->diffForHumans());

            $d = Carbon::now()->subMinutes(2);
            $scope->assertSame('2 minuuttia sitten', $d->diffForHumans());

            $d = Carbon::now()->subHour();
            $scope->assertSame('1 tunti sitten', $d->diffForHumans());

            $d = Carbon::now()->subHours(2);
            $scope->assertSame('2 tuntia sitten', $d->diffForHumans());

            $d = Carbon::now()->subDay();
            $scope->assertSame('1 päivä sitten', $d->diffForHumans());

            $d = Carbon::now()->subDays(2);
            $scope->assertSame('2 päivää sitten', $d->diffForHumans());

            $d = Carbon::now()->subWeek();
            $scope->assertSame('1 viikko sitten', $d->diffForHumans());

            $d = Carbon::now()->subWeeks(2);
            $scope->assertSame('2 viikkoa sitten', $d->diffForHumans());

            $d = Carbon::now()->subMonth();
            $scope->assertSame('1 kuukausi sitten', $d->diffForHumans());

            $d = Carbon::now()->subMonths(2);
            $scope->assertSame('2 kuukautta sitten', $d->diffForHumans());

            $d = Carbon::now()->subYear();
            $scope->assertSame('1 vuosi sitten', $d->diffForHumans());

            $d = Carbon::now()->subYears(2);
            $scope->assertSame('2 vuotta sitten', $d->diffForHumans());

            $d = Carbon::now()->addSecond();
            $scope->assertSame('1 sekunti tästä hetkestä', $d->diffForHumans());

            $d = Carbon::now()->addSecond();
            $d2 = Carbon::now();
            $scope->assertSame('1 sekunti sen jälkeen', $d->diffForHumans($d2));
            $scope->assertSame('1 sekunti ennen', $d2->diffForHumans($d));

            $scope->assertSame('1 sekunti', $d->diffForHumans($d2, true));
            $scope->assertSame('2 sekuntia', $d2->diffForHumans($d->addSecond(), true));
        });
    }
}
