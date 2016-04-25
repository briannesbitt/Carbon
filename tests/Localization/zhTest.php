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

class ZhTest extends AbstractTestCase
{
    public function testDiffForHumansLocalizedInTurkish()
    {
        Carbon::setLocale('zh');

        $scope = $this;
        $this->wrapWithTestNow(function () use ($scope) {
            Carbon::now()->addSeconds(5)->diffForHumans();
        });
    }
}
