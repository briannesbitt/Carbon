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

class UrTest extends AbstractTestCase
{
    public function testDiffForHumansLocalizedInUrdu()
    {
        Carbon::setLocale('ur');

        $scope = $this;
        $this->wrapWithNonDstDate(function () use ($scope) {
            $d = Carbon::now()->subSeconds(1);
            $scope->assertSame('1 سیکنڈ پہلے', $d->diffForHumans());

            $d = Carbon::now()->subSeconds(2);
            $scope->assertSame('2 سیکنڈ پہلے', $d->diffForHumans());

            $d = Carbon::now()->subMinutes(1);
            $scope->assertSame('1 منٹ پہلے', $d->diffForHumans());

            $d = Carbon::now()->subMinutes(2);
            $scope->assertSame('2 منٹ پہلے', $d->diffForHumans());

            $d = Carbon::now()->subHours(1);
            $scope->assertSame('1 گھنٹے پہلے', $d->diffForHumans());

            $d = Carbon::now()->subHours(2);
            $scope->assertSame('2 گھنٹے پہلے', $d->diffForHumans());

            $d = Carbon::now()->subDays(1);
            $scope->assertSame('1 روز پہلے', $d->diffForHumans());

            $d = Carbon::now()->subDays(2);
            $scope->assertSame('2 روز پہلے', $d->diffForHumans());

            $d = Carbon::now()->subWeeks(1);
            $scope->assertSame('1 ہفتے پہلے', $d->diffForHumans());

            $d = Carbon::now()->subWeeks(2);
            $scope->assertSame('2 ہفتے پہلے', $d->diffForHumans());

            $d = Carbon::now()->subMonths(1);
            $scope->assertSame('1 ماه پہلے', $d->diffForHumans());

            $d = Carbon::now()->subMonths(2);
            $scope->assertSame('2 ماه پہلے', $d->diffForHumans());

            $d = Carbon::now()->subYears(1);
            $scope->assertSame('1 سال پہلے', $d->diffForHumans());

            $d = Carbon::now()->subYears(2);
            $scope->assertSame('2 سال پہلے', $d->diffForHumans());

            $d = Carbon::now()->addSecond();
            $scope->assertSame('1 سیکنڈ بعد', $d->diffForHumans());

            $d = Carbon::now()->addSecond();
            $d2 = Carbon::now();
            $scope->assertSame('1 سیکنڈ بعد', $d->diffForHumans($d2));
            $scope->assertSame('1 سیکنڈ پہلے', $d2->diffForHumans($d));

            $scope->assertSame('1 سیکنڈ', $d->diffForHumans($d2, true));
            $scope->assertSame('2 سیکنڈ', $d2->diffForHumans($d->addSecond(), true));
        });
    }
}
