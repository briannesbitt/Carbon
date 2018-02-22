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

class DeTest extends AbstractTestCase
{
    public function testDiffForHumansLocalizedInGerman()
    {
        Carbon::setLocale('de');

        $scope = $this;
        $this->wrapWithNonDstDate(function () use ($scope) {
            $d = Carbon::now()->subSeconds(1);
            $scope->assertSame('vor 1 Sekunde', $d->diffForHumans());

            $d = Carbon::now()->subSeconds(2);
            $scope->assertSame('vor 2 Sekunden', $d->diffForHumans());

            $d = Carbon::now()->subMinutes(1);
            $scope->assertSame('vor 1 Minute', $d->diffForHumans());

            $d = Carbon::now()->subMinutes(2);
            $scope->assertSame('vor 2 Minuten', $d->diffForHumans());

            $d = Carbon::now()->subHours(1);
            $scope->assertSame('vor 1 Stunde', $d->diffForHumans());

            $d = Carbon::now()->subHours(2);
            $scope->assertSame('vor 2 Stunden', $d->diffForHumans());

            $d = Carbon::now()->subDays(1);
            $scope->assertSame('vor 1 Tag', $d->diffForHumans());

            $d = Carbon::now()->subDays(2);
            $scope->assertSame('vor 2 Tagen', $d->diffForHumans());

            $d = Carbon::now()->subWeeks(1);
            $scope->assertSame('vor 1 Woche', $d->diffForHumans());

            $d = Carbon::now()->subWeeks(2);
            $scope->assertSame('vor 2 Wochen', $d->diffForHumans());

            $d = Carbon::now()->subMonths(1);
            $scope->assertSame('vor 1 Monat', $d->diffForHumans());

            $d = Carbon::now()->subMonths(2);
            $scope->assertSame('vor 2 Monaten', $d->diffForHumans());

            $d = Carbon::now()->subYears(1);
            $scope->assertSame('vor 1 Jahr', $d->diffForHumans());

            $d = Carbon::now()->subYears(2);
            $scope->assertSame('vor 2 Jahren', $d->diffForHumans());

            $d = Carbon::now()->addSecond();
            $scope->assertSame('in 1 Sekunde', $d->diffForHumans());

            $d = Carbon::now()->addSecond();
            $d2 = Carbon::now();
            $scope->assertSame('1 Sekunde später', $d->diffForHumans($d2));
            $scope->assertSame('1 Sekunde zuvor', $d2->diffForHumans($d));

            $scope->assertSame('1 Sekunde', $d->diffForHumans($d2, true));
            $scope->assertSame('2 Sekunden', $d2->diffForHumans($d->addSecond(), true));
        });
    }
}
