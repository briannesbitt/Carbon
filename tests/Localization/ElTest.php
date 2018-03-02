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

class ElTest extends AbstractTestCase
{
    public function testDiffForHumansLocalizedInGreek()
    {
        Carbon::setLocale('el');

        $scope = $this;
        $this->wrapWithNonDstDate(function () use ($scope) {
            $d = Carbon::now()->subSeconds(1);
            $scope->assertSame('πριν από 1 δευτερόλεπτο', $d->diffForHumans());

            $d = Carbon::now()->subSeconds(2);
            $scope->assertSame('πριν από 2 δευτερόλεπτα', $d->diffForHumans());

            $d = Carbon::now()->subMinutes(1);
            $scope->assertSame('πριν από 1 λεπτό', $d->diffForHumans());

            $d = Carbon::now()->subMinutes(2);
            $scope->assertSame('πριν από 2 λεπτά', $d->diffForHumans());

            $d = Carbon::now()->subHours(1);
            $scope->assertSame('πριν από 1 ώρα', $d->diffForHumans());

            $d = Carbon::now()->subHours(2);
            $scope->assertSame('πριν από 2 ώρες', $d->diffForHumans());

            $d = Carbon::now()->subDays(1);
            $scope->assertSame('πριν από 1 μέρα', $d->diffForHumans());

            $d = Carbon::now()->subDays(2);
            $scope->assertSame('πριν από 2 μέρες', $d->diffForHumans());

            $d = Carbon::now()->subWeeks(1);
            $scope->assertSame('πριν από 1 εβδομάδα', $d->diffForHumans());

            $d = Carbon::now()->subWeeks(2);
            $scope->assertSame('πριν από 2 εβδομάδες', $d->diffForHumans());

            $d = Carbon::now()->subMonths(1);
            $scope->assertSame('πριν από 1 μήνας', $d->diffForHumans());

            $d = Carbon::now()->subMonths(2);
            $scope->assertSame('πριν από 2 μήνες', $d->diffForHumans());

            $d = Carbon::now()->subYears(1);
            $scope->assertSame('πριν από 1 χρόνος', $d->diffForHumans());

            $d = Carbon::now()->subYears(2);
            $scope->assertSame('πριν από 2 χρόνια', $d->diffForHumans());

            $d = Carbon::now()->addSecond();
            $scope->assertSame('σε 1 δευτερόλεπτο από τώρα', $d->diffForHumans());

            $d = Carbon::now()->addSecond();
            $d2 = Carbon::now();
            $scope->assertSame('1 δευτερόλεπτο μετά', $d->diffForHumans($d2));
            $scope->assertSame('1 δευτερόλεπτο πριν', $d2->diffForHumans($d));

            $scope->assertSame('1 δευτερόλεπτο', $d->diffForHumans($d2, true));
            $scope->assertSame('2 δευτερόλεπτα', $d2->diffForHumans($d->addSecond(), true));
        });
    }
}
