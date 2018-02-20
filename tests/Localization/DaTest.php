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

class DaTest extends AbstractTestCase
{
    public function testDiffForHumansLocalizedInDanish()
    {
        Carbon::setLocale('da');

        $scope = $this;
        $this->wrapWithNonDstDate(function () use ($scope) {
            $d = Carbon::now()->subSeconds(1);
            $scope->assertSame('1 sekund siden', $d->diffForHumans());

            $d = Carbon::now()->subSeconds(2);
            $scope->assertSame('2 sekunder siden', $d->diffForHumans());

            $d = Carbon::now()->subMinutes(1);
            $scope->assertSame('1 minut siden', $d->diffForHumans());

            $d = Carbon::now()->subMinutes(2);
            $scope->assertSame('2 minutter siden', $d->diffForHumans());

            $d = Carbon::now()->subHours(1);
            $scope->assertSame('1 time siden', $d->diffForHumans());

            $d = Carbon::now()->subHours(2);
            $scope->assertSame('2 timer siden', $d->diffForHumans());

            $d = Carbon::now()->subDays(1);
            $scope->assertSame('1 dag siden', $d->diffForHumans());

            $d = Carbon::now()->subDays(2);
            $scope->assertSame('2 dage siden', $d->diffForHumans());

            $d = Carbon::now()->subWeeks(1);
            $scope->assertSame('1 uge siden', $d->diffForHumans());

            $d = Carbon::now()->subWeeks(2);
            $scope->assertSame('2 uger siden', $d->diffForHumans());

            $d = Carbon::now()->subMonths(1);
            $scope->assertSame('1 måned siden', $d->diffForHumans());

            $d = Carbon::now()->subMonths(2);
            $scope->assertSame('2 måneder siden', $d->diffForHumans());

            $d = Carbon::now()->subYears(1);
            $scope->assertSame('1 år siden', $d->diffForHumans());

            $d = Carbon::now()->subYears(2);
            $scope->assertSame('2 år siden', $d->diffForHumans());

            $d = Carbon::now()->addSecond();
            $scope->assertSame('om 1 sekund', $d->diffForHumans());

            $d = Carbon::now()->addSecond();
            $d2 = Carbon::now();
            $scope->assertSame('1 sekund efter', $d->diffForHumans($d2));
            $scope->assertSame('1 sekund før', $d2->diffForHumans($d));

            $scope->assertSame('1 sekund', $d->diffForHumans($d2, true));
            $scope->assertSame('2 sekunder', $d2->diffForHumans($d->addSecond(), true));
        });
    }
}
