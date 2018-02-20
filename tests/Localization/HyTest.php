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

class HyTest extends AbstractTestCase
{
    public function testDiffForHumansLocalizedInArmenian()
    {
        Carbon::setLocale('hy');

        $scope = $this;
        $this->wrapWithNonDstDate(function () use ($scope) {
            $d = Carbon::now()->subSeconds(1);
            $scope->assertSame('1 վայրկյան առաջ', $d->diffForHumans());

            $d = Carbon::now()->subSeconds(2);
            $scope->assertSame('2 վայրկյան առաջ', $d->diffForHumans());

            $d = Carbon::now()->subMinutes(1);
            $scope->assertSame('1 րոպե առաջ', $d->diffForHumans());

            $d = Carbon::now()->subMinutes(2);
            $scope->assertSame('2 րոպե առաջ', $d->diffForHumans());

            $d = Carbon::now()->subHours(1);
            $scope->assertSame('1 ժամ առաջ', $d->diffForHumans());

            $d = Carbon::now()->subHours(2);
            $scope->assertSame('2 ժամ առաջ', $d->diffForHumans());

            $d = Carbon::now()->subDays(1);
            $scope->assertSame('1 օր առաջ', $d->diffForHumans());

            $d = Carbon::now()->subDays(2);
            $scope->assertSame('2 օր առաջ', $d->diffForHumans());

            $d = Carbon::now()->subWeeks(1);
            $scope->assertSame('1 շաբաթ առաջ', $d->diffForHumans());

            $d = Carbon::now()->subWeeks(2);
            $scope->assertSame('2 շաբաթ առաջ', $d->diffForHumans());

            $d = Carbon::now()->subMonths(1);
            $scope->assertSame('1 ամիս առաջ', $d->diffForHumans());

            $d = Carbon::now()->subMonths(2);
            $scope->assertSame('2 ամիս առաջ', $d->diffForHumans());

            $d = Carbon::now()->subYears(1);
            $scope->assertSame('1 տարի առաջ', $d->diffForHumans());

            $d = Carbon::now()->subYears(2);
            $scope->assertSame('2 տարի առաջ', $d->diffForHumans());

            $d = Carbon::now()->addSecond();
            $scope->assertSame('1 վայրկյան հետո', $d->diffForHumans());

            $d = Carbon::now()->addSecond();
            $d2 = Carbon::now();
            $scope->assertSame('1 վայրկյան հետո', $d->diffForHumans($d2));
            $scope->assertSame('1 վայրկյան առաջ', $d2->diffForHumans($d));

            $scope->assertSame('1 վայրկյան', $d->diffForHumans($d2, true));
            $scope->assertSame('2 վայրկյան', $d2->diffForHumans($d->addSecond(), true));
        });
    }
}
