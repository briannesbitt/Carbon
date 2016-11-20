<?php

/*
 * This file is part of the Carbon package.
 *
 * (c) Brian Nesbitt <brian@nesbot.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tests\Carbon;

use Carbon\Carbon;
use Tests\AbstractTestCase;

class UzTest extends AbstractTestCase
{
    public function testDiffForHumansUsingShortUnitsUzbek()
    {
        Carbon::setLocale('uz');

        $scope = $this;
        $this->wrapWithNonDstDate(function () use ($scope) {
            $d = Carbon::now()->subSecond();
            $scope->assertSame('1 sekund avval', $d->diffForHumans(null, false, true));

            $d = Carbon::now()->subSeconds(2);
            $scope->assertSame('2 sekund avval', $d->diffForHumans(null, false, true));

            $d = Carbon::now()->subMinute();
            $scope->assertSame('1 minut avval', $d->diffForHumans(null, false, true));

            $d = Carbon::now()->subMinutes(2);
            $scope->assertSame('2 minut avval', $d->diffForHumans(null, false, true));

            $d = Carbon::now()->subHour();
            $scope->assertSame('1 soat avval', $d->diffForHumans(null, false, true));

            $d = Carbon::now()->subHours(2);
            $scope->assertSame('2 soat avval', $d->diffForHumans(null, false, true));

            $d = Carbon::now()->subDay();
            $scope->assertSame('1 kun avval', $d->diffForHumans(null, false, true));

            $d = Carbon::now()->subDays(2);
            $scope->assertSame('2 kun avval', $d->diffForHumans(null, false, true));

            $d = Carbon::now()->subWeek();
            $scope->assertSame('1 hafta avval', $d->diffForHumans(null, false, true));

            $d = Carbon::now()->subWeeks(2);
            $scope->assertSame('2 hafta avval', $d->diffForHumans(null, false, true));

            $d = Carbon::now()->subMonth();
            $scope->assertSame('1 oy avval', $d->diffForHumans(null, false, true));

            $d = Carbon::now()->subMonths(2);
            $scope->assertSame('2 oy avval', $d->diffForHumans(null, false, true));

            $d = Carbon::now()->subYear();
            $scope->assertSame('1 yil avval', $d->diffForHumans(null, false, true));

            $d = Carbon::now()->subYears(2);
            $scope->assertSame('2 yil avval', $d->diffForHumans(null, false, true));

            $d = Carbon::now()->addSecond();
            $scope->assertSame('1 sekund keyin', $d->diffForHumans(null, false, true));

            $d = Carbon::now()->addSecond();
            $d2 = Carbon::now();
            $scope->assertSame('1 sekund keyin', $d->diffForHumans($d2, false, true));
            $scope->assertSame('1 sekund oldin', $d2->diffForHumans($d, false, true));

            $scope->assertSame('1 sekund', $d->diffForHumans($d2, true, true));
            $scope->assertSame('2 sekund', $d2->diffForHumans($d->addSecond(), true, true));
        });
    }
}
