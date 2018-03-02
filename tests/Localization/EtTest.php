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

class EtTest extends AbstractTestCase
{
    public function testDiffForHumansLocalizedInEstonian()
    {
        Carbon::setLocale('et');

        $scope = $this;
        $this->wrapWithNonDstDate(function () use ($scope) {
            $d = Carbon::now()->subSeconds(1);
            $scope->assertSame('1 sekund tagasi', $d->diffForHumans());

            $d = Carbon::now()->subSeconds(2);
            $scope->assertSame('2 sekundit tagasi', $d->diffForHumans());

            $d = Carbon::now()->subMinutes(1);
            $scope->assertSame('1 minut tagasi', $d->diffForHumans());

            $d = Carbon::now()->subMinutes(2);
            $scope->assertSame('2 minutit tagasi', $d->diffForHumans());

            $d = Carbon::now()->subHours(1);
            $scope->assertSame('1 tund tagasi', $d->diffForHumans());

            $d = Carbon::now()->subHours(2);
            $scope->assertSame('2 tundi tagasi', $d->diffForHumans());

            $d = Carbon::now()->subDays(1);
            $scope->assertSame('1 päev tagasi', $d->diffForHumans());

            $d = Carbon::now()->subDays(2);
            $scope->assertSame('2 päeva tagasi', $d->diffForHumans());

            $d = Carbon::now()->subWeeks(1);
            $scope->assertSame('1 nädal tagasi', $d->diffForHumans());

            $d = Carbon::now()->subWeeks(2);
            $scope->assertSame('2 nädalat tagasi', $d->diffForHumans());

            $d = Carbon::now()->subMonths(1);
            $scope->assertSame('1 kuu tagasi', $d->diffForHumans());

            $d = Carbon::now()->subMonths(2);
            $scope->assertSame('2 kuud tagasi', $d->diffForHumans());

            $d = Carbon::now()->subYears(1);
            $scope->assertSame('1 aasta tagasi', $d->diffForHumans());

            $d = Carbon::now()->subYears(2);
            $scope->assertSame('2 aastat tagasi', $d->diffForHumans());

            $d = Carbon::now()->addSecond();
            $scope->assertSame('1 sekundi pärast', $d->diffForHumans());

            $d = Carbon::now()->addSecond();
            $d2 = Carbon::now();
            $scope->assertSame('1 sekund pärast', $d->diffForHumans($d2));
            $scope->assertSame('1 sekund enne', $d2->diffForHumans($d));

            $scope->assertSame('1 sekund', $d->diffForHumans($d2, true));
            $scope->assertSame('2 sekundit', $d2->diffForHumans($d->addSecond(), true));
        });
    }
}
