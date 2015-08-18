<?php

/*
 * This file is part of the Carbon package.
 *
 * (c) Brian Nesbitt <brian@nesbot.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Immutable;

use Carbon\CarbonImmutable;
use TestFixture;

class FluidSettersTest extends TestFixture
{

    public function testFluidYearSetter()
    {
        $d = CarbonImmutable::now();
        $this->assertTrue($d->year(1995) instanceof Carbon);
        $this->assertSame(1995, $d->year);
    }

    public function testFluidMonthSetter()
    {
        $d = CarbonImmutable::now();
        $this->assertTrue($d->month(3) instanceof Carbon);
        $this->assertSame(3, $d->month);
    }

    public function testFluidMonthSetterWithWrap()
    {
        $d = CarbonImmutable::createFromDate(2012, 8, 21);
        $this->assertTrue($d->month(13) instanceof Carbon);
        $this->assertSame(1, $d->month);
    }

    public function testFluidDaySetter()
    {
        $d = CarbonImmutable::now();
        $this->assertTrue($d->day(2) instanceof Carbon);
        $this->assertSame(2, $d->day);
    }

    public function testFluidDaySetterWithWrap()
    {
        $d = CarbonImmutable::createFromDate(2000, 1, 1);
        $this->assertTrue($d->day(32) instanceof Carbon);
        $this->assertSame(1, $d->day);
    }

    public function testFluidSetDate()
    {
        $d = CarbonImmutable::createFromDate(2000, 1, 1);
        $this->assertTrue($d->setDate(1995, 13, 32) instanceof Carbon);
        $this->assertCarbon($d, 1996, 2, 1);
    }

    public function testFluidHourSetter()
    {
        $d = CarbonImmutable::now();
        $this->assertTrue($d->hour(2) instanceof Carbon);
        $this->assertSame(2, $d->hour);
    }

    public function testFluidHourSetterWithWrap()
    {
        $d = CarbonImmutable::now();
        $this->assertTrue($d->hour(25) instanceof Carbon);
        $this->assertSame(1, $d->hour);
    }

    public function testFluidMinuteSetter()
    {
        $d = CarbonImmutable::now();
        $this->assertTrue($d->minute(2) instanceof Carbon);
        $this->assertSame(2, $d->minute);
    }

    public function testFluidMinuteSetterWithWrap()
    {
        $d = CarbonImmutable::now();
        $this->assertTrue($d->minute(61) instanceof Carbon);
        $this->assertSame(1, $d->minute);
    }

    public function testFluidSecondSetter()
    {
        $d = CarbonImmutable::now();
        $this->assertTrue($d->second(2) instanceof Carbon);
        $this->assertSame(2, $d->second);
    }

    public function testFluidSecondSetterWithWrap()
    {
        $d = CarbonImmutable::now();
        $this->assertTrue($d->second(62) instanceof Carbon);
        $this->assertSame(2, $d->second);
    }

    public function testFluidSetTime()
    {
        $d = CarbonImmutable::createFromDate(2000, 1, 1);
        $this->assertTrue($d->setTime(25, 61, 61) instanceof Carbon);
        $this->assertCarbon($d, 2000, 1, 2, 2, 2, 1);
    }

    public function testFluidTimestampSetter()
    {
        $d = CarbonImmutable::now();
        $this->assertTrue($d->timestamp(10) instanceof Carbon);
        $this->assertSame(10, $d->timestamp);
    }
}
