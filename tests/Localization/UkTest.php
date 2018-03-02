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

class UkTest extends AbstractTestCase
{
    public function testDiffForHumansLocalizedInUkrainian()
    {
        Carbon::setLocale('uk');

        $scope = $this;
        $this->wrapWithNonDstDate(function () use ($scope) {
            $d = Carbon::now()->subSeconds(1);
            $scope->assertSame('1 секунду тому', $d->diffForHumans());

            $d = Carbon::now()->subSeconds(2);
            $scope->assertSame('2 секунди тому', $d->diffForHumans());

            $d = Carbon::now()->subMinutes(1);
            $scope->assertSame('1 хвилину тому', $d->diffForHumans());

            $d = Carbon::now()->subMinutes(2);
            $scope->assertSame('2 хвилини тому', $d->diffForHumans());

            $d = Carbon::now()->subHours(1);
            $scope->assertSame('1 година тому', $d->diffForHumans());

            $d = Carbon::now()->subHours(2);
            $scope->assertSame('2 години тому', $d->diffForHumans());

            $d = Carbon::now()->subDays(1);
            $scope->assertSame('1 день тому', $d->diffForHumans());

            $d = Carbon::now()->subDays(2);
            $scope->assertSame('2 дні тому', $d->diffForHumans());

            $d = Carbon::now()->subWeeks(1);
            $scope->assertSame('1 тиждень тому', $d->diffForHumans());

            $d = Carbon::now()->subWeeks(2);
            $scope->assertSame('2 тижні тому', $d->diffForHumans());

            $d = Carbon::now()->subMonths(1);
            $scope->assertSame('1 місяць тому', $d->diffForHumans());

            $d = Carbon::now()->subMonths(2);
            $scope->assertSame('2 місяці тому', $d->diffForHumans());

            $d = Carbon::now()->subYears(1);
            $scope->assertSame('1 рік тому', $d->diffForHumans());

            $d = Carbon::now()->subYears(2);
            $scope->assertSame('2 роки тому', $d->diffForHumans());

            $d = Carbon::now()->addSecond();
            $scope->assertSame('через 1 секунду', $d->diffForHumans());

            $d = Carbon::now()->addSecond();
            $d2 = Carbon::now();
            $scope->assertSame('1 секунду після', $d->diffForHumans($d2));
            $scope->assertSame('1 секунду до', $d2->diffForHumans($d));

            $scope->assertSame('1 секунду', $d->diffForHumans($d2, true));
            $scope->assertSame('2 секунди', $d2->diffForHumans($d->addSecond(), true));
        });
    }
}
