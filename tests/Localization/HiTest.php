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

class HiTest extends AbstractTestCase
{
    public function testDiffForHumansLocalizedInHindi()
    {
        Carbon::setLocale('hi');

        $scope = $this;
        $this->wrapWithNonDstDate(function () use ($scope) {
            $d = Carbon::now()->subSeconds(0);
            $scope->assertSame('1 सेकंड पूर्व', $d->diffForHumans());

            $d = Carbon::now()->subSeconds(1);
            $scope->assertSame('1 सेकंड पूर्व', $d->diffForHumans());

            $d = Carbon::now()->subSeconds(2);
            $scope->assertSame('2 सेकंड पूर्व', $d->diffForHumans());

            $d = Carbon::now()->subMinutes(0);
            $scope->assertSame('1 सेकंड पूर्व', $d->diffForHumans());

            $d = Carbon::now()->subMinutes(1);
            $scope->assertSame('1 मिनट पूर्व', $d->diffForHumans());

            $d = Carbon::now()->subMinutes(2);
            $scope->assertSame('2 मिनटों पूर्व', $d->diffForHumans());

            $d = Carbon::now()->subHours(0);
            $scope->assertSame('1 सेकंड पूर्व', $d->diffForHumans());

            $d = Carbon::now()->subHours(1);
            $scope->assertSame('1 घंटा पूर्व', $d->diffForHumans());

            $d = Carbon::now()->subHours(2);
            $scope->assertSame('2 घंटे पूर्व', $d->diffForHumans());

            $d = Carbon::now()->subDays(0);
            $scope->assertSame('1 सेकंड पूर्व', $d->diffForHumans());

            $d = Carbon::now()->subDays(1);
            $scope->assertSame('1 दिन पूर्व', $d->diffForHumans());

            $d = Carbon::now()->subDays(2);
            $scope->assertSame('2 दिनों पूर्व', $d->diffForHumans());

            $d = Carbon::now()->subWeeks(0);
            $scope->assertSame('1 सेकंड पूर्व', $d->diffForHumans());

            $d = Carbon::now()->subWeeks(1);
            $scope->assertSame('1 सप्ताह पूर्व', $d->diffForHumans());

            $d = Carbon::now()->subWeeks(2);
            $scope->assertSame('2 सप्ताह पूर्व', $d->diffForHumans());

            $d = Carbon::now()->subMonths(0);
            $scope->assertSame('1 सेकंड पूर्व', $d->diffForHumans());

            $d = Carbon::now()->subMonths(1);
            $scope->assertSame('1 माह पूर्व', $d->diffForHumans());

            $d = Carbon::now()->subMonths(2);
            $scope->assertSame('2 महीने पूर्व', $d->diffForHumans());

            $d = Carbon::now()->subYears(0);
            $scope->assertSame('1 सेकंड पूर्व', $d->diffForHumans());

            $d = Carbon::now()->subYears(1);
            $scope->assertSame('1 वर्ष पूर्व', $d->diffForHumans());

            $d = Carbon::now()->subYears(2);
            $scope->assertSame('2 वर्षों पूर्व', $d->diffForHumans());

            $d = Carbon::now()->addSecond();
            $scope->assertSame('1 सेकंड से', $d->diffForHumans());

            $d = Carbon::now()->addSecond();
            $d2 = Carbon::now();
            $scope->assertSame('1 सेकंड के बाद', $d->diffForHumans($d2));
            $scope->assertSame('1 सेकंड के पहले', $d2->diffForHumans($d));

            $scope->assertSame('1 सेकंड', $d->diffForHumans($d2, true));
            $scope->assertSame('2 सेकंड', $d2->diffForHumans($d->addSecond(), true));
        });
    }
}
