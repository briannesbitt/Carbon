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

class PsTest extends AbstractTestCase
{
    public function testDiffForHumansLocalizedInPashto()
    {
        Carbon::setLocale('ps');

        $scope = $this;
        $this->wrapWithNonDstDate(function () use ($scope) {
            $d = Carbon::now()->subSecond();
            $scope->assertSame('1ثانيه دمخه', $d->diffForHumans(null, false, true));

            $d = Carbon::now()->subSeconds(2);
            $scope->assertSame('2ثانيې دمخه', $d->diffForHumans(null, false, true));

            $d = Carbon::now()->subMinute();
            $scope->assertSame('1دقيقه دمخه', $d->diffForHumans(null, false, true));

            $d = Carbon::now()->subMinutes(2);
            $scope->assertSame('2دقيقې دمخه', $d->diffForHumans(null, false, true));

            $d = Carbon::now()->subHour();
            $scope->assertSame('1ساعت دمخه', $d->diffForHumans(null, false, true));

            $d = Carbon::now()->subHours(2);
            $scope->assertSame('2ساعته دمخه', $d->diffForHumans(null, false, true));

            $d = Carbon::now()->subDay();
            $scope->assertSame('1ورځ دمخه', $d->diffForHumans(null, false, true));

            $d = Carbon::now()->subDays(2);
            $scope->assertSame('2ورځي دمخه', $d->diffForHumans(null, false, true));

            $d = Carbon::now()->subWeek();
            $scope->assertSame('1اونۍ دمخه', $d->diffForHumans(null, false, true));

            $d = Carbon::now()->subWeeks(2);
            $scope->assertSame('2اونۍ دمخه', $d->diffForHumans(null, false, true));

            $d = Carbon::now()->subMonth();
            $scope->assertSame('1مياشت دمخه', $d->diffForHumans(null, false, true));

            $d = Carbon::now()->subMonths(2);
            $scope->assertSame('2مياشتي دمخه', $d->diffForHumans(null, false, true));

            $d = Carbon::now()->subYear();
            $scope->assertSame('1کال دمخه', $d->diffForHumans(null, false, true));

            $d = Carbon::now()->subYears(2);
            $scope->assertSame('2کاله دمخه', $d->diffForHumans(null, false, true));

            $d = Carbon::now()->addSecond();
            $scope->assertSame('1ثانيه له اوس څخه', $d->diffForHumans(null, false, true));

            $d = Carbon::now()->addSecond();
            $d2 = Carbon::now();
            $scope->assertSame('1ثانيه وروسته', $d->diffForHumans($d2, false, true));
            $scope->assertSame('1ثانيه دمخه', $d2->diffForHumans($d, false, true));

            $scope->assertSame('1ثانيه', $d->diffForHumans($d2, true, true));
            $scope->assertSame('2ثانيې', $d2->diffForHumans($d->addSecond(), true, true));
        });
    }
}
