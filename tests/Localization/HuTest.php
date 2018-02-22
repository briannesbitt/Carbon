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

class HuTest extends AbstractTestCase
{
    public function testDiffForHumansLocalizedInHungarian()
    {
        Carbon::setLocale('hu');

        $scope = $this;
        $this->wrapWithNonDstDate(function () use ($scope) {
            $d = Carbon::now()->subSeconds(1);
            $scope->assertSame('1 másodperce', $d->diffForHumans());

            $d = Carbon::now()->subSeconds(2);
            $scope->assertSame('2 másodperce', $d->diffForHumans());

            $d = Carbon::now()->subMinutes(1);
            $scope->assertSame('1 perce', $d->diffForHumans());

            $d = Carbon::now()->subMinutes(2);
            $scope->assertSame('2 perce', $d->diffForHumans());

            $d = Carbon::now()->subHours(1);
            $scope->assertSame('1 órája', $d->diffForHumans());

            $d = Carbon::now()->subHours(2);
            $scope->assertSame('2 órája', $d->diffForHumans());

            $d = Carbon::now()->subDays(1);
            $scope->assertSame('1 napja', $d->diffForHumans());

            $d = Carbon::now()->subDays(2);
            $scope->assertSame('2 napja', $d->diffForHumans());

            $d = Carbon::now()->subWeeks(1);
            $scope->assertSame('1 hete', $d->diffForHumans());

            $d = Carbon::now()->subWeeks(2);
            $scope->assertSame('2 hete', $d->diffForHumans());

            $d = Carbon::now()->subMonths(1);
            $scope->assertSame('1 hónapja', $d->diffForHumans());

            $d = Carbon::now()->subMonths(2);
            $scope->assertSame('2 hónapja', $d->diffForHumans());

            $d = Carbon::now()->subYears(1);
            $scope->assertSame('1 éve', $d->diffForHumans());

            $d = Carbon::now()->subYears(2);
            $scope->assertSame('2 éve', $d->diffForHumans());

            $d = Carbon::now()->addSecond();
            $scope->assertSame('1 másodperc múlva', $d->diffForHumans());

            $d = Carbon::now()->addSecond();
            $d2 = Carbon::now();
            $scope->assertSame('1 másodperccel később', $d->diffForHumans($d2));
            $scope->assertSame('1 másodperccel korábban', $d2->diffForHumans($d));

            $scope->assertSame('1 másodperc', $d->diffForHumans($d2, true));
            $scope->assertSame('2 másodperc', $d2->diffForHumans($d->addSecond(), true));
        });
    }
}
