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

class IsTest extends AbstractTestCase
{
    public function testDiffForHumansLocalizedInIcelandic()
    {
        Carbon::setLocale('is');

        $scope = $this;
        $this->wrapWithNonDstDate(function () use ($scope) {
            $d = Carbon::now()->subSeconds(1);
            $scope->assertSame('1 sekúnda síðan', $d->diffForHumans());

            $d = Carbon::now()->subSeconds(2);
            $scope->assertSame('2 sekúndur síðan', $d->diffForHumans());

            $d = Carbon::now()->subMinutes(1);
            $scope->assertSame('1 mínúta síðan', $d->diffForHumans());

            $d = Carbon::now()->subMinutes(2);
            $scope->assertSame('2 mínútur síðan', $d->diffForHumans());

            $d = Carbon::now()->subHours(1);
            $scope->assertSame('1 klukkutími síðan', $d->diffForHumans());

            $d = Carbon::now()->subHours(2);
            $scope->assertSame('2 klukkutímar síðan', $d->diffForHumans());

            $d = Carbon::now()->subDays(1);
            $scope->assertSame('1 dagur síðan', $d->diffForHumans());

            $d = Carbon::now()->subDays(2);
            $scope->assertSame('2 dagar síðan', $d->diffForHumans());

            $d = Carbon::now()->subWeeks(1);
            $scope->assertSame('1 vika síðan', $d->diffForHumans());

            $d = Carbon::now()->subWeeks(2);
            $scope->assertSame('2 vikur síðan', $d->diffForHumans());

            $d = Carbon::now()->subMonths(1);
            $scope->assertSame('1 mánuður síðan', $d->diffForHumans());

            $d = Carbon::now()->subMonths(2);
            $scope->assertSame('2 mánuðir síðan', $d->diffForHumans());

            $d = Carbon::now()->subYears(1);
            $scope->assertSame('1 ár síðan', $d->diffForHumans());

            $d = Carbon::now()->subYears(2);
            $scope->assertSame('2 ár síðan', $d->diffForHumans());

            $d = Carbon::now()->addSecond();
            $scope->assertSame('1 sekúnda síðan', $d->diffForHumans());

            $d = Carbon::now()->addSecond();
            $d2 = Carbon::now();
            $scope->assertSame('1 sekúnda eftir', $d->diffForHumans($d2));
            $scope->assertSame('1 sekúnda fyrir', $d2->diffForHumans($d));

            $scope->assertSame('1 sekúnda', $d->diffForHumans($d2, true));
            $scope->assertSame('2 sekúndur', $d2->diffForHumans($d->addSecond(), true));
        });
    }
}
