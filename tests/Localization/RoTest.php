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

class RoTest extends AbstractTestCase
{
    public function testDiffForHumansLocalizedInRomanian()
    {
        Carbon::setLocale('ro');

        $scope = $this;
        $this->wrapWithNonDstDate(function () use ($scope) {
            $d = Carbon::now()->subSeconds(1);
            $scope->assertSame('acum o secundă', $d->diffForHumans());

            $d = Carbon::now()->subSeconds(2);
            $scope->assertSame('acum 2 secunde', $d->diffForHumans());

            $d = Carbon::now()->subMinutes(1);
            $scope->assertSame('acum un minut', $d->diffForHumans());

            $d = Carbon::now()->subMinutes(2);
            $scope->assertSame('acum 2 minute', $d->diffForHumans());

            $d = Carbon::now()->subHours(1);
            $scope->assertSame('acum o oră', $d->diffForHumans());

            $d = Carbon::now()->subHours(2);
            $scope->assertSame('acum 2 ore', $d->diffForHumans());

            $d = Carbon::now()->subDays(1);
            $scope->assertSame('acum o zi', $d->diffForHumans());

            $d = Carbon::now()->subDays(2);
            $scope->assertSame('acum 2 zile', $d->diffForHumans());

            $d = Carbon::now()->subWeeks(1);
            $scope->assertSame('acum o săptămână', $d->diffForHumans());

            $d = Carbon::now()->subWeeks(2);
            $scope->assertSame('acum 2 săptămâni', $d->diffForHumans());

            $d = Carbon::now()->subMonths(1);
            $scope->assertSame('acum o lună', $d->diffForHumans());

            $d = Carbon::now()->subMonths(2);
            $scope->assertSame('acum 2 luni', $d->diffForHumans());

            $d = Carbon::now()->subYears(1);
            $scope->assertSame('acum un an', $d->diffForHumans());

            $d = Carbon::now()->subYears(2);
            $scope->assertSame('acum 2 ani', $d->diffForHumans());

            $d = Carbon::now()->addSecond();
            $scope->assertSame('o secundă de acum', $d->diffForHumans());

            $d = Carbon::now()->addSecond();
            $d2 = Carbon::now();
            $scope->assertSame('peste o secundă', $d->diffForHumans($d2));
            $scope->assertSame('acum o secundă', $d2->diffForHumans($d));

            $scope->assertSame('o secundă', $d->diffForHumans($d2, true));
            $scope->assertSame('2 secunde', $d2->diffForHumans($d->addSecond(), true));
        });
    }
}
