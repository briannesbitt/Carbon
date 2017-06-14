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

class PSTest extends AbstractTestCase
{
    public function testDiffForHumansLocalizedInPashto()
    {
        Carbon::setLocale('ps');

        $scope = $this;
        $this->wrapWithNonDstDate(function () use ($scope) {
            $d = Carbon::now()->subSecond();
            $scope->assertSame('1 ثانيه دمخه', $d->diffForHumans());

            $d = Carbon::now()->subSeconds(2);
            $scope->assertSame('2 ثانيې دمخه', $d->diffForHumans());

            $d = Carbon::now()->subMinute();
            $scope->assertSame('1 دقيقه دمخه', $d->diffForHumans());

            $d = Carbon::now()->subMinutes(2);
            $scope->assertSame('2 دقيقې دمخه', $d->diffForHumans());
            
            $d = Carbon::now()->subHour();
            $scope->assertSame('1 ساعت دمخه', $d->diffForHumans());
            
            $d = Carbon::now()->subHours(2);
            $scope->assertSame('2 ساعته دمخه', $d->diffForHumans());

            $d = Carbon::now()->subDay();
            $scope->assertSame('1 ورځ دمخه', $d->diffForHumans());

            $d = Carbon::now()->subDays(2);
            $scope->assertSame('2 ورځي دمخه', $d->diffForHumans());

            $d = Carbon::now()->subWeek();
            $scope->assertSame('1 اونۍ دمخه', $d->diffForHumans());

            $d = Carbon::now()->subWeeks(2);
            $scope->assertSame('2 اونۍ دمخه', $d->diffForHumans());

            $d = Carbon::now()->subMonth();
            $scope->assertSame('1 مياشت دمخه', $d->diffForHumans());

            $d = Carbon::now()->subMonths(2);
            $scope->assertSame('2 مياشتي دمخه', $d->diffForHumans());

            $d = Carbon::now()->subYear();
            $scope->assertSame('1 کال دمخه', $d->diffForHumans());

            $d = Carbon::now()->subYears(2);
            $scope->assertSame('2 کاله دمخه', $d->diffForHumans());

            $d = Carbon::now()->addSecond();
            $scope->assertSame('1 ثانيه له اوس څخه', $d->diffForHumans());

            $d = Carbon::now()->addSecond();
            $d2 = Carbon::now();
            $scope->assertSame('1 ثانيه وروسته', $d->diffForHumans($d2));
            $scope->assertSame('1 ثانيه دمخه', $d2->diffForHumans($d));

            $d = Carbon::now()->addSecond();
            $d2 = Carbon::now();
            $scope->assertSame('1 ثانيه وروسته', $d->diffForHumans($d2));
            $scope->assertSame('1 ثانيه دمخه', $d2->diffForHumans($d));

            $scope->assertSame('1 ثانيه', $d->diffForHumans($d2, true));
            $scope->assertSame('2 ثانيې', $d2->diffForHumans($d->addSecond(), true));
        });
    }
}
