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

class SqTest extends AbstractTestCase
{
    public function testDiffForHumansLocalizedInSq()
    {
        Carbon::setLocale('sq');

        $scope = $this;
        $this->wrapWithNonDstDate(function () use ($scope) {
            $d = Carbon::now()->subSecond();
            $scope->assertSame('1 sekondë më parë', $d->diffForHumans());

            $d = Carbon::now()->subSeconds(2);
            $scope->assertSame('2 sekonda më parë', $d->diffForHumans());

            $d = Carbon::now()->subMinute();
            $scope->assertSame('1 minutë më parë', $d->diffForHumans());

            $d = Carbon::now()->subMinutes(2);
            $scope->assertSame('2 minuta më parë', $d->diffForHumans());

            $d = Carbon::now()->subHour();
            $scope->assertSame('1 orë më parë', $d->diffForHumans());

            $d = Carbon::now()->subHours(2);
            $scope->assertSame('2 orë më parë', $d->diffForHumans());

            $d = Carbon::now()->subDay();
            $scope->assertSame('1 ditë më parë', $d->diffForHumans());

            $d = Carbon::now()->subDays(2);
            $scope->assertSame('2 ditë më parë', $d->diffForHumans());

            $d = Carbon::now()->subWeek();
            $scope->assertSame('1 javë më parë', $d->diffForHumans());

            $d = Carbon::now()->subWeeks(2);
            $scope->assertSame('2 javë më parë', $d->diffForHumans());

            $d = Carbon::now()->subMonth();
            $scope->assertSame('1 muaj më parë', $d->diffForHumans());

            $d = Carbon::now()->subMonths(2);
            $scope->assertSame('2 muaj më parë', $d->diffForHumans());

            $d = Carbon::now()->subYear();
            $scope->assertSame('1 vit më parë', $d->diffForHumans());

            $d = Carbon::now()->subYears(2);
            $scope->assertSame('2 vjet më parë', $d->diffForHumans());

            $d = Carbon::now()->addSecond();
            $scope->assertSame('1 sekondë nga tani', $d->diffForHumans());

            $d = Carbon::now()->addSecond();
            $d2 = Carbon::now();
            $scope->assertSame('1 sekondë pas', $d->diffForHumans($d2));
            $scope->assertSame('1 sekondë para', $d2->diffForHumans($d));

            $scope->assertSame('1 sekondë', $d->diffForHumans($d2, true));
            $scope->assertSame('2 sekonda', $d2->diffForHumans($d->addSecond(), true));
        });
    }
}
