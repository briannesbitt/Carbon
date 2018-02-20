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

class EoTest extends AbstractTestCase
{
    public function testDiffForHumansLocalizedInEsperanto()
    {
        Carbon::setLocale('eo');

        $scope = $this;
        $this->wrapWithNonDstDate(function () use ($scope) {
            $d = Carbon::now()->subSeconds(1);
            $scope->assertSame('antaŭ 1 sekundo', $d->diffForHumans());

            $d = Carbon::now()->subSeconds(2);
            $scope->assertSame('antaŭ 2 sekundoj', $d->diffForHumans());

            $d = Carbon::now()->subMinutes(1);
            $scope->assertSame('antaŭ 1 minuto', $d->diffForHumans());

            $d = Carbon::now()->subMinutes(2);
            $scope->assertSame('antaŭ 2 minutoj', $d->diffForHumans());

            $d = Carbon::now()->subHours(1);
            $scope->assertSame('antaŭ 1 horo', $d->diffForHumans());

            $d = Carbon::now()->subHours(2);
            $scope->assertSame('antaŭ 2 horoj', $d->diffForHumans());

            $d = Carbon::now()->subDays(1);
            $scope->assertSame('antaŭ 1 tago', $d->diffForHumans());

            $d = Carbon::now()->subDays(2);
            $scope->assertSame('antaŭ 2 tagoj', $d->diffForHumans());

            $d = Carbon::now()->subWeeks(1);
            $scope->assertSame('antaŭ 1 semajno', $d->diffForHumans());

            $d = Carbon::now()->subWeeks(2);
            $scope->assertSame('antaŭ 2 semajnoj', $d->diffForHumans());

            $d = Carbon::now()->subMonths(1);
            $scope->assertSame('antaŭ 1 monato', $d->diffForHumans());

            $d = Carbon::now()->subMonths(2);
            $scope->assertSame('antaŭ 2 monatoj', $d->diffForHumans());

            $d = Carbon::now()->subYears(1);
            $scope->assertSame('antaŭ 1 jaro', $d->diffForHumans());

            $d = Carbon::now()->subYears(2);
            $scope->assertSame('antaŭ 2 jaroj', $d->diffForHumans());

            $d = Carbon::now()->addSecond();
            $scope->assertSame('je 1 sekundo', $d->diffForHumans());

            $d = Carbon::now()->addSecond();
            $d2 = Carbon::now();
            $scope->assertSame('1 sekundo poste', $d->diffForHumans($d2));
            $scope->assertSame('1 sekundo antaŭe', $d2->diffForHumans($d));

            $scope->assertSame('1 sekundo', $d->diffForHumans($d2, true));
            $scope->assertSame('2 sekundoj', $d2->diffForHumans($d->addSecond(), true));
        });
    }
}
