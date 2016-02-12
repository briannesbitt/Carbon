<?php

/*
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

class MacroTest extends AbstractTestCase
{
    public function testMacroIsFluid()
    {
        Carbon::macro('foo', function () {
            return 'bar';
        });
        $d = Carbon::now();
        $this->assertInstanceOfCarbon($d);
    }

    public function testHasMacro()
    {
        Carbon::macro('foo', function () {
            return 'bar';
        });
        $this->assertTrue(Carbon::hasMacro('foo'));
    }

    public function testHasNotMacro()
    {
        $this->assertFalse(Carbon::hasMacro('bar'));
    }

    public function testFlushMacro()
    {
        Carbon::macro('foo', function () {
            return 'bar';
        });
        Carbon::flushMacros();
        $this->assertFalse(Carbon::hasMacro('foo'));
    }

    public function testExecuteMacro()
    {
        Carbon::setTestNow(Carbon::create(2015, 12, 15));

        $c = new Carbon();

        Carbon::macro('theDayBeforeYesterday', function ($tz = null) use ($c) {
            return $c->today($tz)->subDays(2);
        });

        $this->assertCarbon($c->theDayBeforeYesterday(), 2015, 12, 13);

        Carbon::setTestNow();
    }

    public function testExecuteStaticMacro()
    {
        Carbon::setTestNow(Carbon::create(2015, 12, 15));

        Carbon::macro('todayAtNoon', function ($tz = null) {
            return Carbon::today($tz)->setTime(12, 0, 0);
        });

        $this->assertCarbon(Carbon::todayAtNoon(), 2015, 12, 15, 12, 0, 0);

        Carbon::setTestNow();
    }

    /**
     * @expectedException \BadMethodCallException
     * @expectedExceptionMessage Method nonExistingMacro does not exist.
     */
    public function testNonExistingMacroThrowsException()
    {
        $c = new Carbon();

        Carbon::macro('foo', function () use ($c) {
            return $c->startOfCentury();
        });

        $c->nonExistingMacro();
    }

    /**
     * @expectedException \BadMethodCallException
     * @expectedExceptionMessage Method nonExistingStaticMacro does not exist.
     */
    public function testNonExistingStaticMacroThrowsException()
    {
        Carbon::macro('foo', function () {
            return Carbon::now();
        });

        Carbon::nonExistingStaticMacro();
    }
}
