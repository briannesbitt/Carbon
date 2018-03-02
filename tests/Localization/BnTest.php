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

class BnTest extends AbstractTestCase
{
    public function testDiffForHumansLocalizedInBengali()
    {
        Carbon::setLocale('bn');

        $scope = $this;
        $this->wrapWithNonDstDate(function () use ($scope) {
            $d = Carbon::now()->subSeconds(1);
            $scope->assertSame('১ সেকেন্ড পূর্বে', $d->diffForHumans());

            $d = Carbon::now()->subSeconds(2);
            $scope->assertSame('2 সেকেন্ড পূর্বে', $d->diffForHumans());

            $d = Carbon::now()->subMinutes(1);
            $scope->assertSame('১ মিনিট পূর্বে', $d->diffForHumans());

            $d = Carbon::now()->subMinutes(2);
            $scope->assertSame('2 মিনিট পূর্বে', $d->diffForHumans());

            $d = Carbon::now()->subHours(1);
            $scope->assertSame('১ ঘন্টা পূর্বে', $d->diffForHumans());

            $d = Carbon::now()->subHours(2);
            $scope->assertSame('2 ঘন্টা পূর্বে', $d->diffForHumans());

            $d = Carbon::now()->subDays(1);
            $scope->assertSame('১ দিন পূর্বে', $d->diffForHumans());

            $d = Carbon::now()->subDays(2);
            $scope->assertSame('2 দিন পূর্বে', $d->diffForHumans());

            $d = Carbon::now()->subWeeks(1);
            $scope->assertSame('১ সপ্তাহ পূর্বে', $d->diffForHumans());

            $d = Carbon::now()->subWeeks(2);
            $scope->assertSame('2 সপ্তাহ পূর্বে', $d->diffForHumans());

            $d = Carbon::now()->subMonths(1);
            $scope->assertSame('১ মাস পূর্বে', $d->diffForHumans());

            $d = Carbon::now()->subMonths(2);
            $scope->assertSame('2 মাস পূর্বে', $d->diffForHumans());

            $d = Carbon::now()->subYears(1);
            $scope->assertSame('১ বছর পূর্বে', $d->diffForHumans());

            $d = Carbon::now()->subYears(2);
            $scope->assertSame('2 বছর পূর্বে', $d->diffForHumans());

            $d = Carbon::now()->addSecond();
            $scope->assertSame('এখন থেকে ১ সেকেন্ড', $d->diffForHumans());

            $d = Carbon::now()->addSecond();
            $d2 = Carbon::now();
            $scope->assertSame('১ সেকেন্ড পরে', $d->diffForHumans($d2));
            $scope->assertSame('১ সেকেন্ড আগে', $d2->diffForHumans($d));

            $scope->assertSame('১ সেকেন্ড', $d->diffForHumans($d2, true));
            $scope->assertSame('2 সেকেন্ড', $d2->diffForHumans($d->addSecond(), true));
        });
    }
}
