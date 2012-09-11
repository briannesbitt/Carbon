<?php

/*
 * This file is part of the Carbon package.
 *
 * (c) Brian Nesbitt <brian@nesbot.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Carbon\Tests;

use Carbon\Carbon;

class TimeTravelTest extends TestFixture
{
    public function teardown()
    {
        Carbon::backToThePresent();
    }

    public function testTimeTravel()
    {
        Carbon::timeTravelTo("2 years ago");
        $this->assertSame(date("Y") - 2, Carbon::now()->year);
    }

    public function testTimeTravelWithAbsolute()
    {
        Carbon::timeTravelTo("1999-12-31");
        $this->assertSame(1999, Carbon::now()->year);
    }

    public function testConsecutiveTimeTravellingIsRelativeToThePresent()
    {
        Carbon::timeTravelTo("2 years ago");
        Carbon::timeTravelTo("+5 years");
        $this->assertSame(date("Y") + 5, Carbon::now()->year);
    }

    public function testRestorePreviousTime()
    {
        Carbon::timeTravelTo("2 years ago");
        Carbon::timeTravelTo("+5 years");
        Carbon::timeTravelTo("+7 years");
        Carbon::restorePreviousTime();
        Carbon::restorePreviousTime();
        $this->assertSame(date("Y") - 2, Carbon::now()->year);
    }

    public function testTimeTravelToWithClosure()
    {
        $that = $this;
        Carbon::timeTravelTo("1999-10-10", function() use ($that) {
            $that->assertSame(1999, Carbon::now()->year);
        });
        $this->assertSame(intval(date("Y")), Carbon::now()->year);
    }

    public function testTimeTravelToWithClosureRestoresDespiteException()
    {
        try {
            Carbon::timeTravelTo("1999-10-10", function() {
                throw new \Exception("waaa");
            });
        } catch (\Exception $e) { 
            // noop
        }
        $this->assertSame(intval(date("Y")), Carbon::now()->year);
    }

    public function testJump()
    {
        Carbon::jump(-63072000); // 2 years in seconds
        $this->assertSame(date("Y") - 2, Carbon::now()->year);
    }


}
