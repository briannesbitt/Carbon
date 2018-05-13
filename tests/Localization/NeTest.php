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

class NeTest extends AbstractTestCase
{
    public function testDiffForHumansLocalizedInNepali()
    {
        Carbon::setLocale('ne');

        $scope = $this;
        $this->wrapWithNonDstDate(function () use ($scope) {
            $d = Carbon::now()->subSeconds(0);
            $scope->assertSame('1 सेकेण्ड पहिले', $d->diffForHumans());

            $d = Carbon::now()->subSeconds(1);
            $scope->assertSame('1 सेकेण्ड पहिले', $d->diffForHumans());

            $d = Carbon::now()->subSeconds(2);
            $scope->assertSame('2 सेकेण्ड पहिले', $d->diffForHumans());

            $d = Carbon::now()->subMinutes(0);
            $scope->assertSame('1 सेकेण्ड पहिले', $d->diffForHumans());

            $d = Carbon::now()->subMinutes(1);
            $scope->assertSame('1 मिनेट पहिले', $d->diffForHumans());

            $d = Carbon::now()->subMinutes(2);
            $scope->assertSame('2 मिनेट पहिले', $d->diffForHumans());

            $d = Carbon::now()->subHours(0);
            $scope->assertSame('1 सेकेण्ड पहिले', $d->diffForHumans());

            $d = Carbon::now()->subHours(1);
            $scope->assertSame('1 घण्टा पहिले', $d->diffForHumans());

            $d = Carbon::now()->subHours(2);
            $scope->assertSame('2 घण्टा पहिले', $d->diffForHumans());

            $d = Carbon::now()->subDays(0);
            $scope->assertSame('1 सेकेण्ड पहिले', $d->diffForHumans());

            $d = Carbon::now()->subDays(1);
            $scope->assertSame('1 दिन पहिले', $d->diffForHumans());

            $d = Carbon::now()->subDays(2);
            $scope->assertSame('2 दिन पहिले', $d->diffForHumans());

            $d = Carbon::now()->subWeeks(0);
            $scope->assertSame('1 सेकेण्ड पहिले', $d->diffForHumans());

            $d = Carbon::now()->subWeeks(1);
            $scope->assertSame('1 हप्ता पहिले', $d->diffForHumans());

            $d = Carbon::now()->subWeeks(2);
            $scope->assertSame('2 हप्ता पहिले', $d->diffForHumans());

            $d = Carbon::now()->subMonths(0);
            $scope->assertSame('1 सेकेण्ड पहिले', $d->diffForHumans());

            $d = Carbon::now()->subMonths(1);
            $scope->assertSame('1 महिना पहिले', $d->diffForHumans());

            $d = Carbon::now()->subMonths(2);
            $scope->assertSame('2 महिना पहिले', $d->diffForHumans());

            $d = Carbon::now()->subYears(0);
            $scope->assertSame('1 सेकेण्ड पहिले', $d->diffForHumans());

            $d = Carbon::now()->subYears(1);
            $scope->assertSame('1 वर्ष पहिले', $d->diffForHumans());

            $d = Carbon::now()->subYears(2);
            $scope->assertSame('2 वर्ष पहिले', $d->diffForHumans());

            $d = Carbon::now()->addSecond();
            $scope->assertSame('1 सेकेण्ड देखि', $d->diffForHumans());

            $d = Carbon::now()->addSecond();
            $d2 = Carbon::now();
            $scope->assertSame('1 सेकेण्ड पछि', $d->diffForHumans($d2));
            $scope->assertSame('1 सेकेण्ड अघि', $d2->diffForHumans($d));

            $scope->assertSame('1 सेकेण्ड', $d->diffForHumans($d2, true));
            $scope->assertSame('2 सेकेण्ड', $d2->diffForHumans($d->addSecond(), true));
        });
    }
}
