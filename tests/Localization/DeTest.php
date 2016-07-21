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

class DeTest extends AbstractTestCase
{
    public function testDiffForHumansLocalizedInGerman()
    {
        Carbon::setLocale('de');

        $scope = $this;
        $this->wrapWithNonDstDate(function () use ($scope) {
            $d = Carbon::now()->addYear();
            $scope->assertSame('in 1 Jahr', $d->diffForHumans());

            $d = Carbon::now()->addYears(2);
            $scope->assertSame('in 2 Jahren', $d->diffForHumans());

            $d = Carbon::now()->subYear();
            $scope->assertSame('1 Jahr später', Carbon::now()->diffForHumans($d));

            $d = Carbon::now()->subYears(2);
            $scope->assertSame('2 Jahre später', Carbon::now()->diffForHumans($d));

            $d = Carbon::now()->addYear();
            $scope->assertSame('1 Jahr zuvor', Carbon::now()->diffForHumans($d));

            $d = Carbon::now()->addYears(2);
            $scope->assertSame('2 Jahre zuvor', Carbon::now()->diffForHumans($d));

            $d = Carbon::now()->subYear();
            $scope->assertSame('vor 1 Jahr', $d->diffForHumans());

            $d = Carbon::now()->subYears(2);
            $scope->assertSame('vor 2 Jahren', $d->diffForHumans());
        });
    }
}
