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

class CyTest extends AbstractTestCase
{
    public function testDiffForHumansLocalizedInWelsh()
    {
        Carbon::setLocale('cy');

        $scope = $this;
        $this->wrapWithNonDstDate(function () use ($scope) {
            $d = Carbon::now()->subSeconds(1);
            $scope->assertSame('1 eiliad yn ôl', $d->diffForHumans());

            $d = Carbon::now()->subSeconds(2);
            $scope->assertSame('2 eiliad yn ôl', $d->diffForHumans());

            $d = Carbon::now()->subMinutes(1);
            $scope->assertSame('1 munud yn ôl', $d->diffForHumans());

            $d = Carbon::now()->subMinutes(2);
            $scope->assertSame('2 munud yn ôl', $d->diffForHumans());

            $d = Carbon::now()->subHours(1);
            $scope->assertSame('1 awr yn ôl', $d->diffForHumans());

            $d = Carbon::now()->subHours(2);
            $scope->assertSame('2 awr yn ôl', $d->diffForHumans());

            $d = Carbon::now()->subDays(1);
            $scope->assertSame('1 diwrnod yn ôl', $d->diffForHumans());

            $d = Carbon::now()->subDays(2);
            $scope->assertSame('2 diwrnod yn ôl', $d->diffForHumans());

            $d = Carbon::now()->subWeeks(1);
            $scope->assertSame('1 wythnos yn ôl', $d->diffForHumans());

            $d = Carbon::now()->subWeeks(2);
            $scope->assertSame('2 wythnos yn ôl', $d->diffForHumans());

            $d = Carbon::now()->subMonths(1);
            $scope->assertSame('1 mis yn ôl', $d->diffForHumans());

            $d = Carbon::now()->subMonths(2);
            $scope->assertSame('2 fis yn ôl', $d->diffForHumans());

            $d = Carbon::now()->subYears(1);
            $scope->assertSame('1 flwyddyn yn ôl', $d->diffForHumans());

            $d = Carbon::now()->subYears(2);
            $scope->assertSame('2 blynedd yn ôl', $d->diffForHumans());

            $d = Carbon::now()->addSecond();
            $scope->assertSame('1 eiliad o hyn ymlaen', $d->diffForHumans());

            $d = Carbon::now()->addSecond();
            $d2 = Carbon::now();
            $scope->assertSame('1 eiliad ar ôl', $d->diffForHumans($d2));
            $scope->assertSame('1 eiliad o\'r blaen', $d2->diffForHumans($d));

            $scope->assertSame('1 eiliad', $d->diffForHumans($d2, true));
            $scope->assertSame('2 eiliad', $d2->diffForHumans($d->addSecond(), true));
        });
    }

    public function testDiffForHumansUsingShortUnitsWelsh()
    {
        Carbon::setLocale('cy');

        $scope = $this;
        $this->wrapWithNonDstDate(function () use ($scope) {
            $d = Carbon::now()->subSecond();
            $scope->assertSame('1s yn ôl', $d->diffForHumans(null, false, true));

            $d = Carbon::now()->subSeconds(2);
            $scope->assertSame('2s yn ôl', $d->diffForHumans(null, false, true));

            $d = Carbon::now()->subMinute();
            $scope->assertSame('1m yn ôl', $d->diffForHumans(null, false, true));

            $d = Carbon::now()->subMinutes(2);
            $scope->assertSame('2m yn ôl', $d->diffForHumans(null, false, true));

            $d = Carbon::now()->subHour();
            $scope->assertSame('1h yn ôl', $d->diffForHumans(null, false, true));

            $d = Carbon::now()->subHours(2);
            $scope->assertSame('2h yn ôl', $d->diffForHumans(null, false, true));

            $d = Carbon::now()->subDay();
            $scope->assertSame('1d yn ôl', $d->diffForHumans(null, false, true));

            $d = Carbon::now()->subDays(2);
            $scope->assertSame('2d yn ôl', $d->diffForHumans(null, false, true));

            $d = Carbon::now()->subWeek();
            $scope->assertSame('1w yn ôl', $d->diffForHumans(null, false, true));

            $d = Carbon::now()->subWeeks(2);
            $scope->assertSame('2w yn ôl', $d->diffForHumans(null, false, true));

            $d = Carbon::now()->subMonth();
            $scope->assertSame('1mi yn ôl', $d->diffForHumans(null, false, true));

            $d = Carbon::now()->subMonths(2);
            $scope->assertSame('2mi yn ôl', $d->diffForHumans(null, false, true));

            $d = Carbon::now()->subYear();
            $scope->assertSame('1bl yn ôl', $d->diffForHumans(null, false, true));

            $d = Carbon::now()->subYears(2);
            $scope->assertSame('2bl yn ôl', $d->diffForHumans(null, false, true));

            $d = Carbon::now()->addSecond();
            $scope->assertSame('1s o hyn ymlaen', $d->diffForHumans(null, false, true));

            $d = Carbon::now()->addSecond();
            $d2 = Carbon::now();
            $scope->assertSame('1s ar ôl', $d->diffForHumans($d2, false, true));
            $scope->assertSame('1s o\'r blaen', $d2->diffForHumans($d, false, true));

            $scope->assertSame('1s', $d->diffForHumans($d2, true, true));
            $scope->assertSame('2s', $d2->diffForHumans($d->addSecond(), true, true));

            $d = Carbon::now()->addSecond();
            $scope->assertSame('1s o hyn ymlaen', $d->diffForHumans(null, false, true, 1));

            $d = Carbon::now()->addMinute()->addSecond();
            $scope->assertSame('1 munud 1 eiliad', $d->diffForHumans(null, true, false, 2));

            $d = Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond();
            $scope->assertSame('2bl 3mi 1d 1s', $d->diffForHumans(null, true, true, 4));

            $d = Carbon::now()->addWeek()->addHours(10);
            $scope->assertSame('1 wythnos 10 awr', $d->diffForHumans(null, true, false, 2));

            $d = Carbon::now()->addWeek()->addDays(6);
            $scope->assertSame('1 wythnos 6 diwrnod', $d->diffForHumans(null, true, false, 2));

            $d = Carbon::now()->addWeeks(3)->addDays(3);
            $scope->assertSame('3 wythnos 3 diwrnod', $d->diffForHumans(null, true, false, 2));

            $d = Carbon::now()->addWeeks(2)->addHour(1);
            $scope->assertSame('2 wythnos 1 awr', $d->diffForHumans(null, true, false, 2));
        });
    }
}
