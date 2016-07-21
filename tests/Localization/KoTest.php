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

class KoTest extends AbstractTestCase
{
    public function testDiffForHumansLocalizedInKorean()
    {
        Carbon::setLocale('ko');

        $scope = $this;
        $this->wrapWithNonDstDate(function () use ($scope) {
            $d = Carbon::now()->addYear();
            $scope->assertSame('1 년 후', $d->diffForHumans());

            $d = Carbon::now()->addYears(2);
            $scope->assertSame('2 년 후', $d->diffForHumans());
        });
    }
}
