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

class HeTest extends AbstractTestCase
{
    public function testDiffForHumansLocalizedInHebrew()
    {
        Carbon::setLocale('he');

        $scope = $this;
        $this->wrapWithNonDstDate(function () use ($scope) {
            $d = Carbon::now()->subSeconds(1);
            $scope->assertSame('לפני שניה', $d->diffForHumans());

            $d = Carbon::now()->subSeconds(2);
            $scope->assertSame('לפני 2 שניות', $d->diffForHumans());

            $d = Carbon::now()->subMinutes(1);
            $scope->assertSame('לפני דקה', $d->diffForHumans());

            $d = Carbon::now()->subMinutes(2);
            $scope->assertSame('לפני דקותיים', $d->diffForHumans());

            $d = Carbon::now()->subHours(1);
            $scope->assertSame('לפני שעה', $d->diffForHumans());

            $d = Carbon::now()->subHours(2);
            $scope->assertSame('לפני שעתיים', $d->diffForHumans());

            $d = Carbon::now()->subDays(1);
            $scope->assertSame('לפני יום', $d->diffForHumans());

            $d = Carbon::now()->subDays(2);
            $scope->assertSame('לפני יומיים', $d->diffForHumans());

            $d = Carbon::now()->subWeeks(1);
            $scope->assertSame('לפני שבוע', $d->diffForHumans());

            $d = Carbon::now()->subWeeks(2);
            $scope->assertSame('לפני שבועיים', $d->diffForHumans());

            $d = Carbon::now()->subMonths(1);
            $scope->assertSame('לפני חודש', $d->diffForHumans());

            $d = Carbon::now()->subMonths(2);
            $scope->assertSame('לפני חודשיים', $d->diffForHumans());

            $d = Carbon::now()->subYears(1);
            $scope->assertSame('לפני שנה', $d->diffForHumans());

            $d = Carbon::now()->subYears(2);
            $scope->assertSame('לפני שנתיים', $d->diffForHumans());

            $d = Carbon::now()->addSecond();
            $scope->assertSame('בעוד שניה', $d->diffForHumans());

            $d = Carbon::now()->addSecond();
            $d2 = Carbon::now();
            $scope->assertSame('אחרי שניה', $d->diffForHumans($d2));
            $scope->assertSame('לפני שניה', $d2->diffForHumans($d));

            $scope->assertSame('שניה', $d->diffForHumans($d2, true));
            $scope->assertSame('2 שניות', $d2->diffForHumans($d->addSecond(), true));
        });
    }
}
