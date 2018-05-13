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

class SwTest extends AbstractTestCase
{
    public function testDiffForHumansLocalizedInSwahili()
    {
        Carbon::setLocale('sw');

        $scope = $this;
        $this->wrapWithNonDstDate(function () use ($scope) {
            $d = Carbon::now()->subSeconds(1);
            $scope->assertSame('sekunde 1 ziliyopita', $d->diffForHumans());

            $d = Carbon::now()->subSeconds(2);
            $scope->assertSame('sekunde 2 ziliyopita', $d->diffForHumans());

            $d = Carbon::now()->subMinutes(1);
            $scope->assertSame('dakika 1 ziliyopita', $d->diffForHumans());

            $d = Carbon::now()->subMinutes(2);
            $scope->assertSame('dakika 2 ziliyopita', $d->diffForHumans());

            $d = Carbon::now()->subHours(1);
            $scope->assertSame('saa 1 ziliyopita', $d->diffForHumans());

            $d = Carbon::now()->subHours(2);
            $scope->assertSame('masaa 2 ziliyopita', $d->diffForHumans());

            $d = Carbon::now()->subDays(1);
            $scope->assertSame('siku 1 ziliyopita', $d->diffForHumans());

            $d = Carbon::now()->subDays(2);
            $scope->assertSame('siku 2 ziliyopita', $d->diffForHumans());

            $d = Carbon::now()->subWeeks(1);
            $scope->assertSame('wiki 1 ziliyopita', $d->diffForHumans());

            $d = Carbon::now()->subWeeks(2);
            $scope->assertSame('wiki 2 ziliyopita', $d->diffForHumans());

            $d = Carbon::now()->subMonths(1);
            $scope->assertSame('mwezi 1 ziliyopita', $d->diffForHumans());

            $d = Carbon::now()->subMonths(2);
            $scope->assertSame('miezi 2 ziliyopita', $d->diffForHumans());

            $d = Carbon::now()->subYears(1);
            $scope->assertSame('mwaka 1 ziliyopita', $d->diffForHumans());

            $d = Carbon::now()->subYears(2);
            $scope->assertSame('miaka 2 ziliyopita', $d->diffForHumans());

            $d = Carbon::now()->addSecond();
            $scope->assertSame('sekunde 1 kwanzia sasa', $d->diffForHumans());

            $d = Carbon::now()->addSecond();
            $d2 = Carbon::now();
            $scope->assertSame('sekunde 1 baada', $d->diffForHumans($d2));
            $scope->assertSame('sekunde 1 kabla', $d2->diffForHumans($d));

            $scope->assertSame('sekunde 1', $d->diffForHumans($d2, true));
            $scope->assertSame('sekunde 2', $d2->diffForHumans($d->addSecond(), true));
        });
    }
}
