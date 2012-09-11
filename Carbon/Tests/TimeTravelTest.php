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

    public function testConsecutiveTimeTravellingIsRelativeToTimeTravelTime()
    {
        Carbon::timeTravelTo("2 years ago");
        Carbon::timeTravelTo("+5 years");
        $this->assertSame(date("Y") + 3, Carbon::now()->year);
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

    public function testTimeTravelToWithClosureGetsReturnValue()
    {
        $ret = Carbon::timeTravelTo("1999-10-10", function() {
            return 123;
        });
        $this->assertSame(123, $ret);
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

    public function testJumpWithClosure()
    {
        $that = $this;
        Carbon::jump(-63072000, function() use ($that) {
            $that->assertSame(date("Y") - 2, Carbon::now()->year);
        });
        $this->assertSame(intval(date("Y")), Carbon::now()->year);
    }

    public function testJumpWithClosureGetsReturnValue()
    {
        $ret = Carbon::jump(123, function() {
            return 123;
        });
        $this->assertSame(123, $ret);
    }

    public function testJumpWithClosureRestoresDespiteException()
    {
        try {
            Carbon::jump(123, function() {
                throw new \Exception("waaa");
            });
        } catch (\Exception $e) { 
            // noop
        }
        $this->assertSame(intval(date("Y")), Carbon::now()->year);
    }

    public function testJumpIsRelativeToTimeTravelTime()
    {
        Carbon::jump(-63072000);
        Carbon::jump(-63072000);
        $this->assertSame(date("Y") - 4, Carbon::now()->year);
    }



}
