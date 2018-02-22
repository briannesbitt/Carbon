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

class SlTest extends AbstractTestCase
{
    public function testDiffForHumansLocalizedInSlovenian()
    {
        Carbon::setLocale('sl');

        $scope = $this;
        $this->wrapWithNonDstDate(function () use ($scope) {
            $d = Carbon::now()->subSeconds(1);
            $scope->assertSame('pred 1 sekundo', $d->diffForHumans());

            $d = Carbon::now()->subSeconds(2);
            $scope->assertSame('pred 2 sekundama', $d->diffForHumans());

            $d = Carbon::now()->subMinutes(1);
            $scope->assertSame('pred 1 minuto', $d->diffForHumans());

            $d = Carbon::now()->subMinutes(2);
            $scope->assertSame('pred 2 minutama', $d->diffForHumans());

            $d = Carbon::now()->subHours(1);
            $scope->assertSame('pred 1 uro', $d->diffForHumans());

            $d = Carbon::now()->subHours(2);
            $scope->assertSame('pred 2 urama', $d->diffForHumans());

            $d = Carbon::now()->subDays(1);
            $scope->assertSame('pred 1 dnem', $d->diffForHumans());

            $d = Carbon::now()->subDays(2);
            $scope->assertSame('pred 2 dnevoma', $d->diffForHumans());

            $d = Carbon::now()->subWeeks(1);
            $scope->assertSame('pred 1 tednom', $d->diffForHumans());

            $d = Carbon::now()->subWeeks(2);
            $scope->assertSame('pred 2 tednoma', $d->diffForHumans());

            $d = Carbon::now()->subMonths(1);
            $scope->assertSame('pred 1 mesecem', $d->diffForHumans());

            $d = Carbon::now()->subMonths(2);
            $scope->assertSame('pred 2 meseci', $d->diffForHumans());

            $d = Carbon::now()->subYears(1);
            $scope->assertSame('pred 1 letom', $d->diffForHumans());

            $d = Carbon::now()->subYears(2);
            $scope->assertSame('pred 2 leti', $d->diffForHumans());

            $d = Carbon::now()->addSecond();
            $scope->assertSame('čez 1 sekundo', $d->diffForHumans());

            $d = Carbon::now()->addSecond();
            $d2 = Carbon::now();
            $scope->assertSame('čez 1 sekundo', $d->diffForHumans($d2));
            $scope->assertSame('pred 1 sekundo', $d2->diffForHumans($d));

            $scope->assertSame('1 sekundo', $d->diffForHumans($d2, true));
            $scope->assertSame('2 sekundi', $d2->diffForHumans($d->addSecond(), true));
        });
    }
}
