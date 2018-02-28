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

class PlTest extends AbstractTestCase
{
    public function testDiffForHumansLocalizedInPolish()
    {
        Carbon::setLocale('pl');

        $scope = $this;
        $this->wrapWithNonDstDate(function () use ($scope) {
            $d = Carbon::now()->subSeconds(1);
            $scope->assertSame('1 sekunda temu', $d->diffForHumans());

            $d = Carbon::now()->subSeconds(2);
            $scope->assertSame('2 sekundy temu', $d->diffForHumans());

            $d = Carbon::now()->subMinutes(1);
            $scope->assertSame('1 minuta temu', $d->diffForHumans());

            $d = Carbon::now()->subMinutes(2);
            $scope->assertSame('2 minuty temu', $d->diffForHumans());

            $d = Carbon::now()->subHours(1);
            $scope->assertSame('1 godzina temu', $d->diffForHumans());

            $d = Carbon::now()->subHours(2);
            $scope->assertSame('2 godziny temu', $d->diffForHumans());

            $d = Carbon::now()->subDays(1);
            $scope->assertSame('1 dzień temu', $d->diffForHumans());

            $d = Carbon::now()->subDays(2);
            $scope->assertSame('2 dni temu', $d->diffForHumans());

            $d = Carbon::now()->subWeeks(1);
            $scope->assertSame('1 tydzień temu', $d->diffForHumans());

            $d = Carbon::now()->subWeeks(2);
            $scope->assertSame('2 tygodnie temu', $d->diffForHumans());

            $d = Carbon::now()->subMonths(1);
            $scope->assertSame('1 miesiąc temu', $d->diffForHumans());

            $d = Carbon::now()->subMonths(2);
            $scope->assertSame('2 miesiące temu', $d->diffForHumans());

            $d = Carbon::now()->subYears(1);
            $scope->assertSame('1 rok temu', $d->diffForHumans());

            $d = Carbon::now()->subYears(2);
            $scope->assertSame('2 lata temu', $d->diffForHumans());

            $d = Carbon::now()->addSecond();
            $scope->assertSame('1 sekunda od teraz', $d->diffForHumans());

            $d = Carbon::now()->addSecond();
            $d2 = Carbon::now();
            $scope->assertSame('1 sekunda po', $d->diffForHumans($d2));
            $scope->assertSame('1 sekunda przed', $d2->diffForHumans($d));

            $scope->assertSame('1 sekunda', $d->diffForHumans($d2, true));
            $scope->assertSame('2 sekundy', $d2->diffForHumans($d->addSecond(), true));
        });
    }
}
