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
            $d = Carbon::now()->subSecond();
            $scope->assertSame('1 másodperce', $d->diffForHumans());

            $d = Carbon::now()->subSeconds(2);
            $scope->assertSame('2 másodperce', $d->diffForHumans());

            $d = Carbon::now()->subMinute();
            $scope->assertSame('1 perce', $d->diffForHumans());

            $d = Carbon::now()->subMinutes(2);
            $scope->assertSame('2 perce', $d->diffForHumans());

            $d = Carbon::now()->subHour();
            $scope->assertSame('1 órája', $d->diffForHumans());

            $d = Carbon::now()->subHours(2);
            $scope->assertSame('2 órája', $d->diffForHumans());

            $d = Carbon::now()->subDay();
            $scope->assertSame('1 napja', $d->diffForHumans());

            $d = Carbon::now()->subDays(2);
            $scope->assertSame('2 napja', $d->diffForHumans());

            $d = Carbon::now()->subWeek();
            $scope->assertSame('1 hete', $d->diffForHumans());

            $d = Carbon::now()->subWeeks(2);
            $scope->assertSame('2 hete', $d->diffForHumans());

            $d = Carbon::now()->subMonth();
            $scope->assertSame('1 hónapja', $d->diffForHumans());

            $d = Carbon::now()->subMonths(2);
            $scope->assertSame('2 hónapja', $d->diffForHumans());

            $d = Carbon::now()->subYear();
            $scope->assertSame('1 éve', $d->diffForHumans());

            $d = Carbon::now()->subYears(2);
            $scope->assertSame('2 éve', $d->diffForHumans());

            $d = Carbon::now()->addSecond();
            $scope->assertSame('1 másodperc múlva', $d->diffForHumans());

            $d = Carbon::now()->addSeconds(2);
            $scope->assertSame('2 másodperc múlva', $d->diffForHumans());

            $d = Carbon::now()->addMinute();
            $scope->assertSame('1 perc múlva', $d->diffForHumans());

            $d = Carbon::now()->addMinutes(2);
            $scope->assertSame('2 perc múlva', $d->diffForHumans());

            $d = Carbon::now()->addHour();
            $scope->assertSame('1 óra múlva', $d->diffForHumans());

            $d = Carbon::now()->addHours(2);
            $scope->assertSame('2 óra múlva', $d->diffForHumans());

            $d = Carbon::now()->addDay();
            $scope->assertSame('1 nap múlva', $d->diffForHumans());

            $d = Carbon::now()->addDays(2);
            $scope->assertSame('2 nap múlva', $d->diffForHumans());

            $d = Carbon::now()->addWeek();
            $scope->assertSame('1 hét múlva', $d->diffForHumans());

            $d = Carbon::now()->addWeeks(2);
            $scope->assertSame('2 hét múlva', $d->diffForHumans());

            $d = Carbon::now()->addMonth();
            $scope->assertSame('1 hónap múlva', $d->diffForHumans());

            $d = Carbon::now()->addMonths(2);
            $scope->assertSame('2 hónap múlva', $d->diffForHumans());

            $d = Carbon::now()->addYear();
            $scope->assertSame('1 év múlva', $d->diffForHumans());

            $d = Carbon::now()->addYears(2);
            $scope->assertSame('2 év múlva', $d->diffForHumans());

            $d = Carbon::now()->addSecond();
            $d2 = Carbon::now();
            $scope->assertSame('1 másodperccel később', $d->diffForHumans($d2));
            $scope->assertSame('1 másodperccel korábban', $d2->diffForHumans($d));
            $d = Carbon::now()->addSecond(2);
            $d2 = Carbon::now();
            $scope->assertSame('2 másodperccel később', $d->diffForHumans($d2));
            $scope->assertSame('2 másodperccel korábban', $d2->diffForHumans($d));

            $d = Carbon::now()->addMinute();
            $d2 = Carbon::now();
            $scope->assertSame('1 perccel később', $d->diffForHumans($d2));
            $scope->assertSame('1 perccel korábban', $d2->diffForHumans($d));
            $d = Carbon::now()->addMinute(2);
            $d2 = Carbon::now();
            $scope->assertSame('2 perccel később', $d->diffForHumans($d2));
            $scope->assertSame('2 perccel korábban', $d2->diffForHumans($d));

            $d = Carbon::now()->addHour();
            $d2 = Carbon::now();
            $scope->assertSame('1 órával később', $d->diffForHumans($d2));
            $scope->assertSame('1 órával korábban', $d2->diffForHumans($d));
            $d = Carbon::now()->addHour(2);
            $d2 = Carbon::now();
            $scope->assertSame('2 órával később', $d->diffForHumans($d2));
            $scope->assertSame('2 órával korábban', $d2->diffForHumans($d));

            $d = Carbon::now()->addDay();
            $d2 = Carbon::now();
            $scope->assertSame('1 nappal később', $d->diffForHumans($d2));
            $scope->assertSame('1 nappal korábban', $d2->diffForHumans($d));
            $d = Carbon::now()->addDay(2);
            $d2 = Carbon::now();
            $scope->assertSame('2 nappal később', $d->diffForHumans($d2));
            $scope->assertSame('2 nappal korábban', $d2->diffForHumans($d));

            $d = Carbon::now()->addWeek();
            $d2 = Carbon::now();
            $scope->assertSame('1 héttel később', $d->diffForHumans($d2));
            $scope->assertSame('1 héttel korábban', $d2->diffForHumans($d));
            $d = Carbon::now()->addWeek(2);
            $d2 = Carbon::now();
            $scope->assertSame('2 héttel később', $d->diffForHumans($d2));
            $scope->assertSame('2 héttel korábban', $d2->diffForHumans($d));

            $d = Carbon::now()->addMonth();
            $d2 = Carbon::now();
            $scope->assertSame('1 hónappal később', $d->diffForHumans($d2));
            $scope->assertSame('1 hónappal korábban', $d2->diffForHumans($d));
            $d = Carbon::now()->addMonth(2);
            $d2 = Carbon::now();
            $scope->assertSame('2 hónappal később', $d->diffForHumans($d2));
            $scope->assertSame('2 hónappal korábban', $d2->diffForHumans($d));

            $d = Carbon::now()->addYear();
            $d2 = Carbon::now();
            $scope->assertSame('1 évvel később', $d->diffForHumans($d2));
            $scope->assertSame('1 évvel korábban', $d2->diffForHumans($d));
            $d = Carbon::now()->addYear(2);
            $d2 = Carbon::now();
            $scope->assertSame('2 évvel később', $d->diffForHumans($d2));
            $scope->assertSame('2 évvel korábban', $d2->diffForHumans($d));

            $d = Carbon::now()->addSecond();
            $d2 = Carbon::now();
            $scope->assertSame('1 másodperc', $d->diffForHumans($d2, true));
            $scope->assertSame('2 másodperc', $d2->diffForHumans($d->addSecond(), true));

            $d = Carbon::now()->addMinute();
            $d2 = Carbon::now();
            $scope->assertSame('1 perc', $d->diffForHumans($d2, true));
            $scope->assertSame('2 perc', $d2->diffForHumans($d->addMinute(), true));

            $d = Carbon::now()->addHour();
            $d2 = Carbon::now();
            $scope->assertSame('1 óra', $d->diffForHumans($d2, true));
            $scope->assertSame('2 óra', $d2->diffForHumans($d->addHour(), true));

            $d = Carbon::now()->addDay();
            $d2 = Carbon::now();
            $scope->assertSame('1 nap', $d->diffForHumans($d2, true));
            $scope->assertSame('2 nap', $d2->diffForHumans($d->addDay(), true));

            $d = Carbon::now()->addWeek();
            $d2 = Carbon::now();
            $scope->assertSame('1 hét', $d->diffForHumans($d2, true));
            $scope->assertSame('2 hét', $d2->diffForHumans($d->addWeek(), true));

            $d = Carbon::now()->addMonth();
            $d2 = Carbon::now();
            $scope->assertSame('1 hónap', $d->diffForHumans($d2, true));
            $scope->assertSame('2 hónap', $d2->diffForHumans($d->addMonth(), true));

            $d = Carbon::now()->addYear();
            $d2 = Carbon::now();
            $scope->assertSame('1 év', $d->diffForHumans($d2, true));
            $scope->assertSame('2 év', $d2->diffForHumans($d->addYear(), true));
        });
    }
}
