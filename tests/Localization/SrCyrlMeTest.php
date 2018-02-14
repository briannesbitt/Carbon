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

class SrCyrlMeTest extends AbstractTestCase
{
    public function testDiffForHumansLocalizedInSrCyrlMe()
    {
        Carbon::setLocale('sr_Cyrl_ME');

        $scope = $this;
        $this->wrapWithNonDstDate(function () use ($scope) {
            $d = Carbon::now()->subSecond();
            $scope->assertSame('прије 1 секунд', $d->diffForHumans());

            $d = Carbon::now()->subSeconds(2);
            $scope->assertSame('прије 2 секунде', $d->diffForHumans());

            $d = Carbon::now()->subMinute();
            $scope->assertSame('прије 1 минут', $d->diffForHumans());

            $d = Carbon::now()->subMinutes(2);
            $scope->assertSame('прије 2 минута', $d->diffForHumans());

            $d = Carbon::now()->subHour();
            $scope->assertSame('прије 1 сат', $d->diffForHumans());

            $d = Carbon::now()->subHours(2);
            $scope->assertSame('прије 2 сата', $d->diffForHumans());

            $d = Carbon::now()->subDay();
            $scope->assertSame('прије 1 дан', $d->diffForHumans());

            $d = Carbon::now()->subDays(2);
            $scope->assertSame('прије 2 дана', $d->diffForHumans());

            $d = Carbon::now()->subWeek();
            $scope->assertSame('прије 1 недјељу', $d->diffForHumans());

            $d = Carbon::now()->subWeeks(2);
            $scope->assertSame('прије 2 недјеље', $d->diffForHumans());

            $d = Carbon::now()->subMonth();
            $scope->assertSame('прије 1 мјесец', $d->diffForHumans());

            $d = Carbon::now()->subMonths(2);
            $scope->assertSame('прије 2 мјесеца', $d->diffForHumans());

            $d = Carbon::now()->subYear();
            $scope->assertSame('прије 1 годину', $d->diffForHumans());

            $d = Carbon::now()->subYears(2);
            $scope->assertSame('прије 2 године', $d->diffForHumans());

            $d = Carbon::now()->addSecond();
            $scope->assertSame('за 1 секунд', $d->diffForHumans());

            $d = Carbon::now()->addSecond();
            $d2 = Carbon::now();
            $scope->assertSame('1 секунд након', $d->diffForHumans($d2));
            $scope->assertSame('1 секунд прије', $d2->diffForHumans($d));

            $scope->assertSame('1 секунд', $d->diffForHumans($d2, true));
            $scope->assertSame('2 секунде', $d2->diffForHumans($d->addSecond(), true));
        });
    }
}
