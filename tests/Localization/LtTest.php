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
        $this->wrapWithTestNow(function () use ($scope) {
            $d = Carbon::now()->subSecond();
            $scope->assertSame('prieš 1 sekundę', $d->diffForHumans());

            $d = Carbon::now()->subSeconds(2);
            $scope->assertSame('prieš 2 sekundes', $d->diffForHumans());

            $d = Carbon::now()->subSeconds(21);
            $scope->assertSame('prieš 21 sekundę', $d->diffForHumans());

            $d = Carbon::now()->subSeconds(40);
            $scope->assertSame('prieš 40 sekundžių', $d->diffForHumans());

            $d = Carbon::now()->subMinute();
            $scope->assertSame('prieš 1 minutę', $d->diffForHumans());

            $d = Carbon::now()->subMinutes(2);
            $scope->assertSame('prieš 2 minutes', $d->diffForHumans());

            $d = Carbon::now()->subMinutes(21);
            $scope->assertSame('prieš 21 minutę', $d->diffForHumans());

            $d = Carbon::now()->subHour();
            $scope->assertSame('prieš 1 valandą', $d->diffForHumans());

            $d = Carbon::now()->subHours(2);
            $scope->assertSame('prieš 2 valandas', $d->diffForHumans());

            $d = Carbon::now()->subHours(20);
            $scope->assertSame('prieš 20 valandų', $d->diffForHumans());

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

            $d = Carbon::now()->subMonths(11);
            $scope->assertSame('prieš 11 mėnesių', $d->diffForHumans());

            $d = Carbon::now()->subYear();
            $scope->assertSame('prieš 1 metus', $d->diffForHumans());

            $d = Carbon::now()->subYears(2);
            $scope->assertSame('prieš 2 metus', $d->diffForHumans());

            $d = Carbon::now()->subYears(10);
            $scope->assertSame('prieš 10 metų', $d->diffForHumans());

            $d = Carbon::now()->subYears(21);
            $scope->assertSame('prieš 21 metus', $d->diffForHumans());

            $d = Carbon::now()->addSecond();
            $scope->assertSame('už 1 sekundę', $d->diffForHumans());
        });
    }
}
