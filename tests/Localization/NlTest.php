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

class NlTest extends AbstractTestCase
{
    public function testDiffForHumansLocalizedInDutch()
    {
        Carbon::setLocale('nl');

        $scope = $this;
        $this->wrapWithNonDstDate(function () use ($scope) {
            $d = Carbon::now()->subSeconds(1);
            $scope->assertSame('1 seconde geleden', $d->diffForHumans());

            $d = Carbon::now()->subSeconds(2);
            $scope->assertSame('2 seconden geleden', $d->diffForHumans());

            $d = Carbon::now()->subMinutes(1);
            $scope->assertSame('1 minuut geleden', $d->diffForHumans());

            $d = Carbon::now()->subMinutes(2);
            $scope->assertSame('2 minuten geleden', $d->diffForHumans());

            $d = Carbon::now()->subHours(1);
            $scope->assertSame('1 uur geleden', $d->diffForHumans());

            $d = Carbon::now()->subHours(2);
            $scope->assertSame('2 uur geleden', $d->diffForHumans());

            $d = Carbon::now()->subDays(1);
            $scope->assertSame('1 dag geleden', $d->diffForHumans());

            $d = Carbon::now()->subDays(2);
            $scope->assertSame('2 dagen geleden', $d->diffForHumans());

            $d = Carbon::now()->subWeeks(1);
            $scope->assertSame('1 week geleden', $d->diffForHumans());

            $d = Carbon::now()->subWeeks(2);
            $scope->assertSame('2 weken geleden', $d->diffForHumans());

            $d = Carbon::now()->subMonths(1);
            $scope->assertSame('1 maand geleden', $d->diffForHumans());

            $d = Carbon::now()->subMonths(2);
            $scope->assertSame('2 maanden geleden', $d->diffForHumans());

            $d = Carbon::now()->subYears(1);
            $scope->assertSame('1 jaar geleden', $d->diffForHumans());

            $d = Carbon::now()->subYears(2);
            $scope->assertSame('2 jaar geleden', $d->diffForHumans());

            $d = Carbon::now()->addSecond();
            $scope->assertSame('over 1 seconde', $d->diffForHumans());

            $d = Carbon::now()->addSecond();
            $d2 = Carbon::now();
            $scope->assertSame('1 seconde later', $d->diffForHumans($d2));
            $scope->assertSame('1 seconde eerder', $d2->diffForHumans($d));

            $scope->assertSame('1 seconde', $d->diffForHumans($d2, true));
            $scope->assertSame('2 seconden', $d2->diffForHumans($d->addSecond(), true));
        });
    }
}
