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

class BgTest extends AbstractTestCase
{
    public function testDiffForHumansLocalizedInBulgarian()
    {
        Carbon::setLocale('bg');

        $scope = $this;
        $this->wrapWithNonDstDate(function () use ($scope) {
            $d = Carbon::now()->subSeconds(1);
            $scope->assertSame('преди 1 секунда', $d->diffForHumans());

            $d = Carbon::now()->subSeconds(2);
            $scope->assertSame('преди 2 секунди', $d->diffForHumans());

            $d = Carbon::now()->subMinutes(1);
            $scope->assertSame('преди 1 минута', $d->diffForHumans());

            $d = Carbon::now()->subMinutes(2);
            $scope->assertSame('преди 2 минути', $d->diffForHumans());

            $d = Carbon::now()->subHours(1);
            $scope->assertSame('преди 1 час', $d->diffForHumans());

            $d = Carbon::now()->subHours(2);
            $scope->assertSame('преди 2 часа', $d->diffForHumans());

            $d = Carbon::now()->subDays(1);
            $scope->assertSame('преди 1 ден', $d->diffForHumans());

            $d = Carbon::now()->subDays(2);
            $scope->assertSame('преди 2 дни', $d->diffForHumans());

            $d = Carbon::now()->subWeeks(1);
            $scope->assertSame('преди 1 седмица', $d->diffForHumans());

            $d = Carbon::now()->subWeeks(2);
            $scope->assertSame('преди 2 седмици', $d->diffForHumans());

            $d = Carbon::now()->subMonths(1);
            $scope->assertSame('преди 1 месец', $d->diffForHumans());

            $d = Carbon::now()->subMonths(2);
            $scope->assertSame('преди 2 месеца', $d->diffForHumans());

            $d = Carbon::now()->subYears(1);
            $scope->assertSame('преди 1 година', $d->diffForHumans());

            $d = Carbon::now()->subYears(2);
            $scope->assertSame('преди 2 години', $d->diffForHumans());

            $d = Carbon::now()->addSecond();
            $scope->assertSame('1 секунда от сега', $d->diffForHumans());

            $d = Carbon::now()->addSecond();
            $d2 = Carbon::now();
            $scope->assertSame('след 1 секунда', $d->diffForHumans($d2));
            $scope->assertSame('преди 1 секунда', $d2->diffForHumans($d));

            $scope->assertSame('1 секунда', $d->diffForHumans($d2, true));
            $scope->assertSame('2 секунди', $d2->diffForHumans($d->addSecond(), true));
        });
    }
}
