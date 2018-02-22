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

class LvTest extends AbstractTestCase
{
    public function testDiffForHumansLocalizedInLatvian()
    {
        Carbon::setLocale('lv');

        $scope = $this;
        $this->wrapWithNonDstDate(function () use ($scope) {
            $d = Carbon::now()->subSeconds(1);
            $scope->assertSame('pirms 1 sekundes', $d->diffForHumans());

            $d = Carbon::now()->subSeconds(2);
            $scope->assertSame('pirms 2 sekundēm', $d->diffForHumans());

            $d = Carbon::now()->subMinutes(1);
            $scope->assertSame('pirms 1 minūtes', $d->diffForHumans());

            $d = Carbon::now()->subMinutes(2);
            $scope->assertSame('pirms 2 minūtēm', $d->diffForHumans());

            $d = Carbon::now()->subHours(1);
            $scope->assertSame('pirms 1 stundas', $d->diffForHumans());

            $d = Carbon::now()->subHours(2);
            $scope->assertSame('pirms 2 stundām', $d->diffForHumans());

            $d = Carbon::now()->subDays(1);
            $scope->assertSame('pirms 1 dienas', $d->diffForHumans());

            $d = Carbon::now()->subDays(2);
            $scope->assertSame('pirms 2 dienām', $d->diffForHumans());

            $d = Carbon::now()->subWeeks(1);
            $scope->assertSame('pirms 1 nedēļas', $d->diffForHumans());

            $d = Carbon::now()->subWeeks(2);
            $scope->assertSame('pirms 2 nedēļām', $d->diffForHumans());

            $d = Carbon::now()->subMonths(1);
            $scope->assertSame('pirms 1 mēneša', $d->diffForHumans());

            $d = Carbon::now()->subMonths(2);
            $scope->assertSame('pirms 2 mēnešiem', $d->diffForHumans());

            $d = Carbon::now()->subYears(1);
            $scope->assertSame('pirms 1 gada', $d->diffForHumans());

            $d = Carbon::now()->subYears(2);
            $scope->assertSame('pirms 2 gadiem', $d->diffForHumans());

            $d = Carbon::now()->addSecond();
            $scope->assertSame('pēc 1 sekundes', $d->diffForHumans());

            $d = Carbon::now()->addSecond();
            $d2 = Carbon::now();
            $scope->assertSame('1 sekundi vēlāk', $d->diffForHumans($d2));
            $scope->assertSame('1 sekundi pirms', $d2->diffForHumans($d));

            $scope->assertSame('1 sekundes', $d->diffForHumans($d2, true));
            $scope->assertSame('2 sekundēm', $d2->diffForHumans($d->addSecond(), true));
        });
    }
}
