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

class ItTest extends AbstractTestCase
{
    public function testDiffForHumansLocalizedInItalian()
    {
        Carbon::setLocale('it');

        $scope = $this;
        $this->wrapWithNonDstDate(function () use ($scope) {
            $d = Carbon::now()->subSeconds(1);
            $scope->assertSame('1 secondo fa', $d->diffForHumans());

            $d = Carbon::now()->subSeconds(2);
            $scope->assertSame('2 secondi fa', $d->diffForHumans());

            $d = Carbon::now()->subMinutes(1);
            $scope->assertSame('1 minuto fa', $d->diffForHumans());

            $d = Carbon::now()->subMinutes(2);
            $scope->assertSame('2 minuti fa', $d->diffForHumans());

            $d = Carbon::now()->subHours(1);
            $scope->assertSame('1 ora fa', $d->diffForHumans());

            $d = Carbon::now()->subHours(2);
            $scope->assertSame('2 ore fa', $d->diffForHumans());

            $d = Carbon::now()->subDays(1);
            $scope->assertSame('1 giorno fa', $d->diffForHumans());

            $d = Carbon::now()->subDays(2);
            $scope->assertSame('2 giorni fa', $d->diffForHumans());

            $d = Carbon::now()->subWeeks(1);
            $scope->assertSame('1 settimana fa', $d->diffForHumans());

            $d = Carbon::now()->subWeeks(2);
            $scope->assertSame('2 settimane fa', $d->diffForHumans());

            $d = Carbon::now()->subMonths(1);
            $scope->assertSame('1 mese fa', $d->diffForHumans());

            $d = Carbon::now()->subMonths(2);
            $scope->assertSame('2 mesi fa', $d->diffForHumans());

            $d = Carbon::now()->subYears(1);
            $scope->assertSame('1 anno fa', $d->diffForHumans());

            $d = Carbon::now()->subYears(2);
            $scope->assertSame('2 anni fa', $d->diffForHumans());

            $d = Carbon::now()->addSecond();
            $scope->assertSame('tra 1 secondo', $d->diffForHumans());

            $d = Carbon::now()->addSecond();
            $d2 = Carbon::now();
            $scope->assertSame('1 secondo dopo', $d->diffForHumans($d2));
            $scope->assertSame('1 secondo prima', $d2->diffForHumans($d));

            $scope->assertSame('1 secondo', $d->diffForHumans($d2, true));
            $scope->assertSame('2 secondi', $d2->diffForHumans($d->addSecond(), true));
        });
    }
}
