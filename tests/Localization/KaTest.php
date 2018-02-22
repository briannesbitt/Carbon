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

class KaTest extends AbstractTestCase
{
    public function testDiffForHumansLocalizedInGeorgian()
    {
        Carbon::setLocale('ka');

        $scope = $this;
        $this->wrapWithNonDstDate(function () use ($scope) {
            $d = Carbon::now()->subSeconds(1);
            $scope->assertSame('1 წამის უკან', $d->diffForHumans());

            $d = Carbon::now()->subSeconds(2);
            $scope->assertSame('2 წამის უკან', $d->diffForHumans());

            $d = Carbon::now()->subMinutes(1);
            $scope->assertSame('1 წუთის უკან', $d->diffForHumans());

            $d = Carbon::now()->subMinutes(2);
            $scope->assertSame('2 წუთის უკან', $d->diffForHumans());

            $d = Carbon::now()->subHours(1);
            $scope->assertSame('1 საათის უკან', $d->diffForHumans());

            $d = Carbon::now()->subHours(2);
            $scope->assertSame('2 საათის უკან', $d->diffForHumans());

            $d = Carbon::now()->subDays(1);
            $scope->assertSame('1 დღის უკან', $d->diffForHumans());

            $d = Carbon::now()->subDays(2);
            $scope->assertSame('2 დღის უკან', $d->diffForHumans());

            $d = Carbon::now()->subWeeks(1);
            $scope->assertSame('1 კვირის უკან', $d->diffForHumans());

            $d = Carbon::now()->subWeeks(2);
            $scope->assertSame('2 კვირის უკან', $d->diffForHumans());

            $d = Carbon::now()->subMonths(1);
            $scope->assertSame('1 თვის უკან', $d->diffForHumans());

            $d = Carbon::now()->subMonths(2);
            $scope->assertSame('2 თვის უკან', $d->diffForHumans());

            $d = Carbon::now()->subYears(1);
            $scope->assertSame('1 წლის უკან', $d->diffForHumans());

            $d = Carbon::now()->subYears(2);
            $scope->assertSame('2 წლის უკან', $d->diffForHumans());

            $d = Carbon::now()->addSecond();
            $scope->assertSame('1 წამის შემდეგ', $d->diffForHumans());

            $d = Carbon::now()->addSecond();
            $d2 = Carbon::now();
            $scope->assertSame('1 წამის შემდეგ', $d->diffForHumans($d2));
            $scope->assertSame('1 წამის უკან', $d2->diffForHumans($d));

            $scope->assertSame('1 წამის', $d->diffForHumans($d2, true));
            $scope->assertSame('2 წამის', $d2->diffForHumans($d->addSecond(), true));
        });
    }
}
