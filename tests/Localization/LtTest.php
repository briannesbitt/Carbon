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
            $d = Carbon::now()->subSeconds(1);
            $scope->assertSame('prieš 1 sekundę', $d->diffForHumans());

            $d = Carbon::now()->subSeconds(2);
            $scope->assertSame('prieš 2 sekundes', $d->diffForHumans());

            $d = Carbon::now()->subMinutes(1);
            $scope->assertSame('prieš 1 minutę', $d->diffForHumans());

            $d = Carbon::now()->subMinutes(2);
            $scope->assertSame('prieš 2 minutes', $d->diffForHumans());

            $d = Carbon::now()->subHours(1);
            $scope->assertSame('prieš 1 valandą', $d->diffForHumans());

            $d = Carbon::now()->subHours(2);
            $scope->assertSame('prieš 2 valandas', $d->diffForHumans());

            $d = Carbon::now()->subDays(1);
            $scope->assertSame('prieš 1 dieną', $d->diffForHumans());

            $d = Carbon::now()->subDays(2);
            $scope->assertSame('prieš 2 dienas', $d->diffForHumans());

            $d = Carbon::now()->subWeeks(1);
            $scope->assertSame('prieš 1 savaitę', $d->diffForHumans());

            $d = Carbon::now()->subWeeks(2);
            $scope->assertSame('prieš 2 savaites', $d->diffForHumans());

            $d = Carbon::now()->subMonths(1);
            $scope->assertSame('prieš 1 mėnesį', $d->diffForHumans());

            $d = Carbon::now()->subMonths(2);
            $scope->assertSame('prieš 2 mėnesius', $d->diffForHumans());

            $d = Carbon::now()->subYears(1);
            $scope->assertSame('prieš 1 metus', $d->diffForHumans());

            $d = Carbon::now()->subYears(2);
            $scope->assertSame('prieš 2 metus', $d->diffForHumans());

            $d = Carbon::now()->addSecond();
            $scope->assertSame('už 1 sekundės', $d->diffForHumans());

            $d = Carbon::now()->addSecond();
            $d2 = Carbon::now();
            $scope->assertSame('po 1 sekundę', $d->diffForHumans($d2));
            $scope->assertSame('1 sekundę nuo dabar', $d2->diffForHumans($d));

            $scope->assertSame('1 sekundę', $d->diffForHumans($d2, true));
            $scope->assertSame('2 sekundes', $d2->diffForHumans($d->addSecond(), true));
        });
    }
}
