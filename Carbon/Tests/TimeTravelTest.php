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

    public function testConsecutiveTimeTravellingWithRelativeToTimeTravelTime()
    {
        Carbon::timeTravelTo("2 years ago");
        Carbon::timeTravelTo("+5 years");
        $this->assertSame(date("Y") + 3, Carbon::now()->year);
    }

    public function testTimeTravelWithConstructorAndNow()
    {
        Carbon::timeTravelTo("2 years ago");
        $c = new Carbon("now");
        $this->assertSame(date("Y") - 2, $c->year);
    }

    public function testTimeTravelWithConstructorAndAbsolute()
    {
        Carbon::timeTravelTo("2 years ago");
        $c = new Carbon("1999/12/12");
        $this->assertSame(1999, $c->year);
    }

    public function testTimeTravelWithConstructorAndRelative()
    {
        Carbon::timeTravelTo("2 years ago");
        $c = new Carbon("2 years ago");
        $this->assertSame(date("Y") - 4, $c->year);
    }

    public function testTimeTravelWithConstructorAndComplex()
    {
        Carbon::timeTravelTo("2 years ago");
        $c = new Carbon("first day of january 2008");
        $this->assertCarbon($c, 2008, 1, 1, 0, 0, 0);
    }

    public function testTimeTravelWithConstructorAndComplexToday()
    {
        Carbon::timeTravelTo("2 years ago");
        $c = new Carbon("today");
        $this->assertCarbon($c, $c->year, $c->month, $c->day, 0, 0, 0);
    }

    public function testTimeTravelWithConstructorAndComplexNoon()
    {
        Carbon::timeTravelTo("2 years ago");
        $c = new Carbon("noon");
        $this->assertCarbon($c, $c->year, $c->month, $c->day, 12, 0, 0);
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

    public function testBackToThePresent()
    {
        Carbon::timeTravelTo("2 years ago");
        Carbon::backToThePresent();
        $this->assertSame(intval(date("Y")), Carbon::now()->year);
    }

    public function testBackToThePresentAfterNoJumps()
    {
        Carbon::backToThePresent();
        $this->assertSame(intval(date("Y")), Carbon::now()->year);
    }

    public function testBackToThePresentAfterSeveralJumps()
    {
        Carbon::timeTravelTo("2 years ago");
        Carbon::timeTravelTo("+5 years");
        Carbon::timeTravelTo("+7 years");
        Carbon::backToThePresent();
        $this->assertSame(intval(date("Y")), Carbon::now()->year);
    }

}
