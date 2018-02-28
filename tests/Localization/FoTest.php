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

class FoTest extends AbstractTestCase
{
    public function testDiffForHumansLocalizedInFaroese()
    {
        Carbon::setLocale('fo');

        $scope = $this;
        $this->wrapWithNonDstDate(function () use ($scope) {
            $d = Carbon::now()->subSeconds(1);
            $scope->assertSame('1 sekund síðan', $d->diffForHumans());

            $d = Carbon::now()->subSeconds(2);
            $scope->assertSame('2 sekundir síðan', $d->diffForHumans());

            $d = Carbon::now()->subMinutes(1);
            $scope->assertSame('1 minutt síðan', $d->diffForHumans());

            $d = Carbon::now()->subMinutes(2);
            $scope->assertSame('2 minuttir síðan', $d->diffForHumans());

            $d = Carbon::now()->subHours(1);
            $scope->assertSame('1 tími síðan', $d->diffForHumans());

            $d = Carbon::now()->subHours(2);
            $scope->assertSame('2 tímar síðan', $d->diffForHumans());

            $d = Carbon::now()->subDays(1);
            $scope->assertSame('1 dag síðan', $d->diffForHumans());

            $d = Carbon::now()->subDays(2);
            $scope->assertSame('2 dagar síðan', $d->diffForHumans());

            $d = Carbon::now()->subWeeks(1);
            $scope->assertSame('1 vika síðan', $d->diffForHumans());

            $d = Carbon::now()->subWeeks(2);
            $scope->assertSame('2 vikur síðan', $d->diffForHumans());

            $d = Carbon::now()->subMonths(1);
            $scope->assertSame('1 mánaður síðan', $d->diffForHumans());

            $d = Carbon::now()->subMonths(2);
            $scope->assertSame('2 mánaðir síðan', $d->diffForHumans());

            $d = Carbon::now()->subYears(1);
            $scope->assertSame('1 ár síðan', $d->diffForHumans());

            $d = Carbon::now()->subYears(2);
            $scope->assertSame('2 ár síðan', $d->diffForHumans());

            $d = Carbon::now()->addSecond();
            $scope->assertSame('um 1 sekund', $d->diffForHumans());

            $d = Carbon::now()->addSecond();
            $d2 = Carbon::now();
            $scope->assertSame('1 sekund aftaná', $d->diffForHumans($d2));
            $scope->assertSame('1 sekund áðrenn', $d2->diffForHumans($d));

            $scope->assertSame('1 sekund', $d->diffForHumans($d2, true));
            $scope->assertSame('2 sekundir', $d2->diffForHumans($d->addSecond(), true));
        });
    }
}
