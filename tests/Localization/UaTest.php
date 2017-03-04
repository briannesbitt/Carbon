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
class UaTest extends AbstractTestCase
{
    public function testDiffForHumansLocalizedInUkrainian()
    {
        Carbon::setLocale('ua');
        $scope = $this;
        $this->wrapWithNonDstDate(function () use ($scope) {
            $d = Carbon::now()->subSecond();
            $scope->assertSame('1 секунду тому', $d->diffForHumans());
            $d = Carbon::now()->subSeconds(2);
            $scope->assertSame('2 секунди тому', $d->diffForHumans());
            $d = Carbon::now()->subSeconds(21);
            $scope->assertSame('21 секунду тому', $d->diffForHumans());
            $d = Carbon::now()->subMinute();
            $scope->assertSame('1 хвилину тому', $d->diffForHumans());
            $d = Carbon::now()->subMinutes(2);
            $scope->assertSame('2 хвилини тому', $d->diffForHumans());
            $d = Carbon::now()->subHour();
            $scope->assertSame('1 годину тому', $d->diffForHumans());
            $d = Carbon::now()->subHours(2);
            $scope->assertSame('2 години тому', $d->diffForHumans());
            $d = Carbon::now()->subHours(21);
            $scope->assertSame('21 годину тому', $d->diffForHumans());
            $d = Carbon::now()->subDay();
            $scope->assertSame('1 день тому', $d->diffForHumans());
            $d = Carbon::now()->subDays(2);
            $scope->assertSame('2 дні тому', $d->diffForHumans());
            $d = Carbon::now()->subWeek();
            $scope->assertSame('1 тиждень тому', $d->diffForHumans());
            $d = Carbon::now()->subWeeks(2);
            $scope->assertSame('2 тижня тому', $d->diffForHumans());
            $d = Carbon::now()->subMonth();
            $scope->assertSame('1 місяць тому', $d->diffForHumans());
            $d = Carbon::now()->subMonths(2);
            $scope->assertSame('2 місяця тому', $d->diffForHumans());
            $d = Carbon::now()->subYear();
            $scope->assertSame('1 рік тому', $d->diffForHumans());
            $d = Carbon::now()->subYears(2);
            $scope->assertSame('2 роки тому', $d->diffForHumans());
            $d = Carbon::now()->addSecond();
            $scope->assertSame('через 1 секунду', $d->diffForHumans());
            $d = Carbon::now()->addSeconds(21);
            $scope->assertSame('через 21 секунду', $d->diffForHumans());
            $d = Carbon::now()->addSeconds(15);
            $scope->assertSame('через 15 секунд', $d->diffForHumans());
            $d = Carbon::now()->addMinute();
            $scope->assertSame('через 1 хвилину', $d->diffForHumans());
            $d = Carbon::now()->addMinutes(15);
            $scope->assertSame('через 15 хвилин', $d->diffForHumans());
            $d = Carbon::now()->addMinutes(21);
            $scope->assertSame('через 21 хвилину', $d->diffForHumans());
            $d = Carbon::now()->addHour();
            $scope->assertSame('через 1 годину', $d->diffForHumans());
            $d = Carbon::now()->addHours(15);
            $scope->assertSame('через 15 годин', $d->diffForHumans());
            $d = Carbon::now()->addHours(21);
            $scope->assertSame('через 21 годину', $d->diffForHumans());
            $d = Carbon::now()->addDay();
            $scope->assertSame('через 1 день', $d->diffForHumans());
            $d = Carbon::now()->addDays(2);
            $scope->assertSame('через 2 дні', $d->diffForHumans());
            $d = Carbon::now()->addWeek();
            $scope->assertSame('через 1 тиждень', $d->diffForHumans());
            $d = Carbon::now()->addWeek(2);
            $scope->assertSame('через 2 тижня', $d->diffForHumans());
            $d = Carbon::now()->addMonth();
            $scope->assertSame('через 1 місяць', $d->diffForHumans());
            $d = Carbon::now()->addMonths(2);
            $scope->assertSame('через 2 місяця', $d->diffForHumans());
            $d = Carbon::now()->addMonths(11);
            $scope->assertSame('через 11 місяців', $d->diffForHumans());
            $d = Carbon::now()->addYear();
            $scope->assertSame('через 1 рік', $d->diffForHumans());
            $d = Carbon::now()->addYears(10);
            $scope->assertSame('через 10 років', $d->diffForHumans());
        });
    }
}
