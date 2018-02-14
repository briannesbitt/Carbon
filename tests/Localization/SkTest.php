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

class SkTest extends AbstractTestCase
{
    public function testDiffForHumansLocalizedInSlovak()
    {
        Carbon::setLocale('sk');
        \Carbon\Carbon::setUtf8(true);

        $scope = $this;
        $this->wrapWithNonDstDate(function () use ($scope) {
            $d = Carbon::now()->subSecond();
            $scope->assertSame('pred sekundu', $d->diffForHumans());

            $d = Carbon::now()->subMinute();
            $scope->assertSame('pred minútu', $d->diffForHumans());
        });
    }
}
