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

class IdTest extends AbstractTestCase
{
    public function testDiffForHumansLocalizedInId()
    {
        Carbon::setLocale('id');

        $scope = $this;
        $this->wrapWithNonDstDate(function () use ($scope) {
            $d = Carbon::now()->subSecond();
            $scope->assertSame('1 detik yang lalu', $d->diffForHumans());

            $d = Carbon::now()->subSeconds(2);
            $scope->assertSame('2 detik yang lalu', $d->diffForHumans());

            $d = Carbon::now()->subMinute();
            $scope->assertSame('1 menit yang lalu', $d->diffForHumans());

            $d = Carbon::now()->subMinutes(2);
            $scope->assertSame('2 menit yang lalu', $d->diffForHumans());

            $d = Carbon::now()->subHour();
            $scope->assertSame('1 jam yang lalu', $d->diffForHumans());

            $d = Carbon::now()->subHours(2);
            $scope->assertSame('2 jam yang lalu', $d->diffForHumans());

            $d = Carbon::now()->subDay();
            $scope->assertSame('1 hari yang lalu', $d->diffForHumans());

            $d = Carbon::now()->subDays(2);
            $scope->assertSame('2 hari yang lalu', $d->diffForHumans());

            $d = Carbon::now()->subWeek();
            $scope->assertSame('1 minggu yang lalu', $d->diffForHumans());

            $d = Carbon::now()->subWeeks(2);
            $scope->assertSame('2 minggu yang lalu', $d->diffForHumans());

            $d = Carbon::now()->subMonth();
            $scope->assertSame('1 bulan yang lalu', $d->diffForHumans());

            $d = Carbon::now()->subMonths(2);
            $scope->assertSame('2 bulan yang lalu', $d->diffForHumans());

            $d = Carbon::now()->subYear();
            $scope->assertSame('1 tahun yang lalu', $d->diffForHumans());

            $d = Carbon::now()->subYears(2);
            $scope->assertSame('2 tahun yang lalu', $d->diffForHumans());

            $d = Carbon::now()->addSecond();
            $scope->assertSame('1 detik dari sekarang', $d->diffForHumans());

            $d = Carbon::now()->addSecond();
            $d2 = Carbon::now();
            $scope->assertSame('1 detik setelah', $d->diffForHumans($d2));
            $scope->assertSame('1 detik sebelum', $d2->diffForHumans($d));

            $scope->assertSame('1 detik', $d->diffForHumans($d2, true));
            $scope->assertSame('2 detik', $d2->diffForHumans($d->addSecond(), true));
        });
    }
}
