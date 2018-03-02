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

class KkTest extends AbstractTestCase
{
    public function testDiffForHumansLocalizedInKazakh()
    {
        Carbon::setLocale('kk');
        $scope = $this;
        $this->wrapWithNonDstDate(function () use ($scope) {
            $d = Carbon::now()->subSeconds(1);
            $scope->assertSame('1 секунд бұрын', $d->diffForHumans());

            $d = Carbon::now()->subSeconds(2);
            $scope->assertSame('2 секунд бұрын', $d->diffForHumans());

            $d = Carbon::now()->subMinutes(1);
            $scope->assertSame('1 минут бұрын', $d->diffForHumans());

            $d = Carbon::now()->subMinutes(2);
            $scope->assertSame('2 минут бұрын', $d->diffForHumans());

            $d = Carbon::now()->subHours(1);
            $scope->assertSame('1 сағат бұрын', $d->diffForHumans());

            $d = Carbon::now()->subHours(2);
            $scope->assertSame('2 сағат бұрын', $d->diffForHumans());

            $d = Carbon::now()->subDays(1);
            $scope->assertSame('1 күн бұрын', $d->diffForHumans());

            $d = Carbon::now()->subDays(2);
            $scope->assertSame('2 күн бұрын', $d->diffForHumans());

            $d = Carbon::now()->subWeeks(1);
            $scope->assertSame('1 апта бұрын', $d->diffForHumans());

            $d = Carbon::now()->subWeeks(2);
            $scope->assertSame('2 апта бұрын', $d->diffForHumans());

            $d = Carbon::now()->subMonths(1);
            $scope->assertSame('1 ай бұрын', $d->diffForHumans());

            $d = Carbon::now()->subMonths(2);
            $scope->assertSame('2 ай бұрын', $d->diffForHumans());

            $d = Carbon::now()->subYears(1);
            $scope->assertSame('1 жыл бұрын', $d->diffForHumans());

            $d = Carbon::now()->subYears(2);
            $scope->assertSame('2 жыл бұрын', $d->diffForHumans());

            $d = Carbon::now()->addSecond();
            $scope->assertSame('1 секунд кейін', $d->diffForHumans());
            $d = Carbon::now()->addSecond();
            $d2 = Carbon::now();
            $scope->assertSame('1 секунд кейін', $d->diffForHumans($d2));
            $scope->assertSame('1 секунд бұрын', $d2->diffForHumans($d));
            $scope->assertSame('1 секунд', $d->diffForHumans($d2, true));
            $scope->assertSame('2 секунд', $d2->diffForHumans($d->addSecond(), true));
        });
    }
}
