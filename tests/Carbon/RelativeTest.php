<?php

declare(strict_types=1);

/**
 * This file is part of the Carbon package.
 *
 * (c) Brian Nesbitt <brian@nesbot.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tests\Carbon;

use Carbon\Carbon;
use Tests\AbstractTestCase;

class RelativeTest extends AbstractTestCase
{
    public function testSecondsSinceMidnight()
    {
        $d = Carbon::today()->addSeconds(30);
        $this->assertSame(30.0, $d->secondsSinceMidnight());

        $d = Carbon::today()->addDays(1);
        $this->assertSame(0.0, $d->secondsSinceMidnight());

        $d = Carbon::today()->addDays(1)->addSeconds(120);
        $this->assertSame(120.0, $d->secondsSinceMidnight());

        $d = Carbon::today()->addMonths(3)->addSeconds(42);
        $this->assertSame(42.0, $d->secondsSinceMidnight());
    }

    public function testSecondsUntilEndOfDay()
    {
        $d = Carbon::today()->endOfDay();
        $this->assertSame(0.0, $d->secondsUntilEndOfDay());

        $d = Carbon::today()->endOfDay()->subSeconds(60);
        $this->assertSame(60.0, $d->secondsUntilEndOfDay());

        $d = Carbon::create(2014, 10, 24, 12, 34, 56);
        $this->assertVeryClose(41103.999999, $d->secondsUntilEndOfDay());

        $d = Carbon::create(2014, 10, 24, 0, 0, 0);
        $this->assertVeryClose(86399.99999899999, $d->secondsUntilEndOfDay());
    }
}
