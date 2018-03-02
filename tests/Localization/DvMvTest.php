<?php

/*
 * This file is part of the Carbon package.
 *
 * (c) Ahmed Ali <ajaaibu@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tests\Localization;

use Carbon\Carbon;
use Tests\AbstractTestCase;

class DvMvTest extends AbstractTestCase
{
    public function testDiffForHumansLocalizedInDvMv()
    {
        Carbon::setLocale('dv_MV');

        $scope = $this;
        $this->wrapWithNonDstDate(function () use ($scope) {
            $d = Carbon::now()->subSecond();
            $scope->assertSame('1 ސިކުންތު ކުރިން', $d->diffForHumans(null, false, true));

            $d = Carbon::now()->subSeconds(2);
            $scope->assertSame('2 ސިކުންތު ކުރިން', $d->diffForHumans(null, false, true));

            $d = Carbon::now()->subMinute();
            $scope->assertSame('1 މިނެޓް ކުރިން', $d->diffForHumans(null, false, true));

            $d = Carbon::now()->subMinutes(2);
            $scope->assertSame('2 މިނެޓް ކުރިން', $d->diffForHumans(null, false, true));

            $d = Carbon::now()->subHour();
            $scope->assertSame('1 ގަޑި ކުރިން', $d->diffForHumans(null, false, true));

            $d = Carbon::now()->subHours(2);
            $scope->assertSame('2 ގަޑި ކުރިން', $d->diffForHumans(null, false, true));

            $d = Carbon::now()->subDay();
            $scope->assertSame('1 ދުވަސް ކުރިން', $d->diffForHumans(null, false, true));

            $d = Carbon::now()->subDays(2);
            $scope->assertSame('2 ދުވަސް ކުރިން', $d->diffForHumans(null, false, true));

            $d = Carbon::now()->subWeek();
            $scope->assertSame('1 ހަފްތާ ކުރިން', $d->diffForHumans(null, false, true));

            $d = Carbon::now()->subWeeks(2);
            $scope->assertSame('2 ހަފްތާ ކުރިން', $d->diffForHumans(null, false, true));

            $d = Carbon::now()->subMonth();
            $scope->assertSame('1 މަސް ކުރިން', $d->diffForHumans(null, false, true));

            $d = Carbon::now()->subMonths(2);
            $scope->assertSame('2 މަސް ކުރިން', $d->diffForHumans(null, false, true));

            $d = Carbon::now()->subYear();
            $scope->assertSame('1 އަހަރު ކުރިން', $d->diffForHumans(null, false, true));

            $d = Carbon::now()->subYears(2);
            $scope->assertSame('2 އަހަރު ކުރިން', $d->diffForHumans(null, false, true));

            $d = Carbon::now()->addSecond();
            $scope->assertSame('1 ސިކުންތު ފަހުން', $d->diffForHumans(null, false, true));

            $d = Carbon::now()->addSecond();
            $d2 = Carbon::now();
            $scope->assertSame('1 ސިކުންތު ފަހުން', $d->diffForHumans($d2, false, true));
            $scope->assertSame('1 ސިކުންތު ކުރި', $d2->diffForHumans($d, false, true));

            $scope->assertSame('1 ސިކުންތު', $d->diffForHumans($d2, true, true));
            $scope->assertSame('2 ސިކުންތު', $d2->diffForHumans($d->addSecond(), true, true));

            $d = Carbon::now()->addSecond();
            $scope->assertSame('1 ސިކުންތު ފަހުން', $d->diffForHumans(null, false, true, 1));

            $d = Carbon::now()->addMinute()->addSecond();
            $scope->assertSame('1 މިނެޓް 1 ސިކުންތު', $d->diffForHumans(null, true, false, 2));

            $d = Carbon::now()->addYears(2)->addMonths(3)->addDay()->addSecond();
            $scope->assertSame('2 އަހަރު 3 މަސް 1 ދުވަސް 1 ސިކުންތު', $d->diffForHumans(null, true, true, 4));

            $d = Carbon::now()->addWeek()->addHours(10);
            $scope->assertSame('1 ހަފްތާ 10 ގަޑި', $d->diffForHumans(null, true, false, 2));

            $d = Carbon::now()->addWeek()->addDays(6);
            $scope->assertSame('1 ހަފްތާ 6 ދުވަސް', $d->diffForHumans(null, true, false, 2));

            $d = Carbon::now()->addWeeks(3)->addDays(3);
            $scope->assertSame('3 ހަފްތާ 3 ދުވަސް', $d->diffForHumans(null, true, false, 2));

            $d = Carbon::now()->addWeeks(2)->addHour(1);
            $scope->assertSame('2 ހަފްތާ 1 ގަޑި', $d->diffForHumans(null, true, false, 2));
        });
    }
}
