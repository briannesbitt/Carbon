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

class LtTest extends AbstractTestCase
{
    public function testDiffForHumansLocalizedInLithuanian()
    {
        Carbon::setLocale('lt');

        $scope = $this;
        $this->wrapWithTestNow(function () use ($scope) {
            $d = Carbon::now()->addYear();
            $scope->assertSame('už 1 metus', $d->diffForHumans());

            $d = Carbon::now()->addYears(2);
            $scope->assertSame('už 2 metus', $d->diffForHumans());
        });
    }
}
