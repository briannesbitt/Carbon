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

class TrTest extends AbstractTestCase
{
    public function testDiffForHumansLocalizedInTurkish()
    {
        Carbon::setLocale('tr');

        $scope = $this;
        $this->wrapWithNonDstDate(function () use ($scope) {
            $d = Carbon::now()->subSecond();
            $scope->assertSame('1 saniye önce', $d->diffForHumans());

            $d = Carbon::now()->subSeconds(2);
            $scope->assertSame('2 saniye önce', $d->diffForHumans());

            $d = Carbon::now()->subMinute();
            $scope->assertSame('1 dakika önce', $d->diffForHumans());

            $d = Carbon::now()->subMinutes(2);
            $scope->assertSame('2 dakika önce', $d->diffForHumans());

            $d = Carbon::now()->subHour();
            $scope->assertSame('1 saat önce', $d->diffForHumans());

            $d = Carbon::now()->subHours(2);
            $scope->assertSame('2 saat önce', $d->diffForHumans());

            $d = Carbon::now()->subDay();
            $scope->assertSame('1 gün önce', $d->diffForHumans());

            $d = Carbon::now()->subDays(2);
            $scope->assertSame('2 gün önce', $d->diffForHumans());

            $d = Carbon::now()->subWeek();
            $scope->assertSame('1 hafta önce', $d->diffForHumans());

            $d = Carbon::now()->subWeeks(2);
            $scope->assertSame('2 hafta önce', $d->diffForHumans());

            $d = Carbon::now()->subMonth();
            $scope->assertSame('1 ay önce', $d->diffForHumans());

            $d = Carbon::now()->subMonths(2);
            $scope->assertSame('2 ay önce', $d->diffForHumans());

            $d = Carbon::now()->subYear();
            $scope->assertSame('1 yıl önce', $d->diffForHumans());

            $d = Carbon::now()->subYears(2);
            $scope->assertSame('2 yıl önce', $d->diffForHumans());

            $d = Carbon::now()->addSecond();
            $scope->assertSame('1 saniye sonra', $d->diffForHumans());

            $d = Carbon::now()->addSecond();
            $d2 = Carbon::now();
            $scope->assertSame('1 saniye sonra', $d->diffForHumans($d2));
            $scope->assertSame('1 saniye önce', $d2->diffForHumans($d));

            $scope->assertSame('1 saniye', $d->diffForHumans($d2, true));
            $scope->assertSame('2 saniye', $d2->diffForHumans($d->addSecond(), true));
        });
    }
}
