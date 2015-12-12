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

class FluidSettersTest extends AbstractTestCase
{
    public function testFluidYearSetter()
    {
        $d = Carbon::now();
        $this->assertInstanceOfCarbon($d->year(1995));
        $this->assertSame(1995, $d->year);
    }

    public function testFluidMonthSetter()
    {
        $d = Carbon::now();
        $this->assertInstanceOfCarbon($d->month(3));
        $this->assertSame(3, $d->month);
    }

    public function testFluidMonthSetterWithWrap()
    {
        $d = Carbon::createFromDate(2012, 8, 21);
        $this->assertInstanceOfCarbon($d->month(13));
        $this->assertSame(1, $d->month);
    }

    public function testFluidDaySetter()
    {
        $d = Carbon::now();
        $this->assertInstanceOfCarbon($d->day(2));
        $this->assertSame(2, $d->day);
    }

    public function testFluidDaySetterWithWrap()
    {
        $d = Carbon::createFromDate(2000, 1, 1);
        $this->assertInstanceOfCarbon($d->day(32));
        $this->assertSame(1, $d->day);
    }

    public function testFluidSetDate()
    {
        $d = Carbon::createFromDate(2000, 1, 1);
        $this->assertInstanceOfCarbon($d->setDate(1995, 13, 32));
        $this->assertCarbon($d, 1996, 2, 1);
    }

    public function testFluidHourSetter()
    {
        $d = Carbon::now();
        $this->assertInstanceOfCarbon($d->hour(2));
        $this->assertSame(2, $d->hour);
    }

    public function testFluidHourSetterWithWrap()
    {
        $d = Carbon::now();
        $this->assertInstanceOfCarbon($d->hour(25));
        $this->assertSame(1, $d->hour);
    }

    public function testFluidMinuteSetter()
    {
        $d = Carbon::now();
        $this->assertInstanceOfCarbon($d->minute(2));
        $this->assertSame(2, $d->minute);
    }

    public function testFluidMinuteSetterWithWrap()
    {
        $d = Carbon::now();
        $this->assertInstanceOfCarbon($d->minute(61));
        $this->assertSame(1, $d->minute);
    }

    public function testFluidSecondSetter()
    {
        $d = Carbon::now();
        $this->assertInstanceOfCarbon($d->second(2));
        $this->assertSame(2, $d->second);
    }

    public function testFluidSecondSetterWithWrap()
    {
        $d = Carbon::now();
        $this->assertInstanceOfCarbon($d->second(62));
        $this->assertSame(2, $d->second);
    }

    public function testFluidSetTime()
    {
        $d = Carbon::createFromDate(2000, 1, 1);
        $this->assertInstanceOfCarbon($d->setTime(25, 61, 61));
        $this->assertCarbon($d, 2000, 1, 2, 2, 2, 1);
    }

    public function testFluidTimestampSetter()
    {
        $d = Carbon::now();
        $this->assertInstanceOfCarbon($d->timestamp(10));
        $this->assertSame(10, $d->timestamp);
    }
}
