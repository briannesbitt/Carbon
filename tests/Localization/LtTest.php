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

class LtTest extends AbstractTestCase
{
    public function testDiffForHumansLocalizedInLithuanian()
    {
        Carbon::setLocale('lt');

        $scope = $this;
        $this->wrapWithNonDstDate(function () use ($scope) {
            $d = Carbon::now()->subSecond();
            $scope->assertSame('prieš 1 sekundę', $d->diffForHumans());

            $d = Carbon::now()->subSeconds(2);
            $scope->assertSame('prieš 2 sekundes', $d->diffForHumans());

            $d = Carbon::now()->subSeconds(21);
            $scope->assertSame('prieš 21 sekundę', $d->diffForHumans());

            $d = Carbon::now()->subMinute();
            $scope->assertSame('prieš 1 minutę', $d->diffForHumans());

            $d = Carbon::now()->subMinutes(2);
            $scope->assertSame('prieš 2 minutes', $d->diffForHumans());

            $d = Carbon::now()->subHour();
            $scope->assertSame('prieš 1 valandą', $d->diffForHumans());

            $d = Carbon::now()->subHours(2);
            $scope->assertSame('prieš 2 valandas', $d->diffForHumans());

            $d = Carbon::now()->subHours(21);
            $scope->assertSame('prieš 21 valandą', $d->diffForHumans());

            $d = Carbon::now()->subDay();
            $scope->assertSame('prieš 1 dieną', $d->diffForHumans());

            $d = Carbon::now()->subDays(2);
            $scope->assertSame('prieš 2 dienas', $d->diffForHumans());

            $d = Carbon::now()->subWeek();
            $scope->assertSame('prieš 1 savaitę', $d->diffForHumans());

            $d = Carbon::now()->subWeeks(2);
            $scope->assertSame('prieš 2 savaites', $d->diffForHumans());

            $d = Carbon::now()->subMonth();
            $scope->assertSame('prieš 1 mėnesį', $d->diffForHumans());

            $d = Carbon::now()->subMonths(2);
            $scope->assertSame('prieš 2 mėnesius', $d->diffForHumans());

            $d = Carbon::now()->subYear();
            $scope->assertSame('prieš 1 metus', $d->diffForHumans());

            $d = Carbon::now()->subYears(2);
            $scope->assertSame('prieš 2 metus', $d->diffForHumans());

            $d = Carbon::now()->addSecond();
            $scope->assertSame('už 1 sekundės', $d->diffForHumans());

            $d = Carbon::now()->addSeconds(21);
            $scope->assertSame('už 21 sekundės', $d->diffForHumans());

            $d = Carbon::now()->addSeconds(15);
            $scope->assertSame('už 15 sekundžių', $d->diffForHumans());

            $d = Carbon::now()->addMinute();
            $scope->assertSame('už 1 minutės', $d->diffForHumans());

            $d = Carbon::now()->addMinutes(15);
            $scope->assertSame('už 15 minučių', $d->diffForHumans());

            $d = Carbon::now()->addMinutes(21);
            $scope->assertSame('už 21 minutės', $d->diffForHumans());

            $d = Carbon::now()->addHour();
            $scope->assertSame('už 1 valandos', $d->diffForHumans());

            $d = Carbon::now()->addHours(15);
            $scope->assertSame('už 15 valandų', $d->diffForHumans());

            $d = Carbon::now()->addHours(21);
            $scope->assertSame('už 21 valandos', $d->diffForHumans());

            $d = Carbon::now()->addDay();
            $scope->assertSame('už 1 dienos', $d->diffForHumans());

            $d = Carbon::now()->addDays(2);
            $scope->assertSame('už 2 dienų', $d->diffForHumans());

            $d = Carbon::now()->addWeek();
            $scope->assertSame('už 1 savaitės', $d->diffForHumans());

            $d = Carbon::now()->addWeek(2);
            $scope->assertSame('už 2 savaičių', $d->diffForHumans());

            $d = Carbon::now()->addMonth();
            $scope->assertSame('už 1 mėnesio', $d->diffForHumans());

            $d = Carbon::now()->addMonths(2);
            $scope->assertSame('už 2 mėnesių', $d->diffForHumans());

            $d = Carbon::now()->addMonths(11);
            $scope->assertSame('už 11 mėnesių', $d->diffForHumans());

            $d = Carbon::now()->addYear();
            $scope->assertSame('už 1 metų', $d->diffForHumans());

            $d = Carbon::now()->addYears(10);
            $scope->assertSame('už 10 metų', $d->diffForHumans());
        });
    }
}
