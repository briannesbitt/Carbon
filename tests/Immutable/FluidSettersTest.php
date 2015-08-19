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
        $d = $d->year(1995);
        $this->assertTrue($d instanceof CarbonImmutable);
        $this->assertSame(1995, $d->year);
    }

    public function testFluidMonthSetter()
    {
        $d = CarbonImmutable::now();
        $d = $d->month(3);
        $this->assertTrue($d instanceof CarbonImmutable);
        $this->assertSame(3, $d->month);
    }

    public function testFluidMonthSetterWithWrap()
    {
        $d = CarbonImmutable::createFromDate(2012, 8, 21);
        $d = $d->month(13);
        $this->assertTrue($d instanceof CarbonImmutable);
        $this->assertSame(1, $d->month);
    }

    public function testFluidDaySetter()
    {
        $d = CarbonImmutable::now();
        $d = $d->day(2);
        $this->assertTrue($d instanceof CarbonImmutable);
        $this->assertSame(2, $d->day);
    }

    public function testFluidDaySetterWithWrap()
    {
        $d = CarbonImmutable::createFromDate(2000, 1, 1);
        $d = $d->day(32);
        $this->assertTrue($d instanceof CarbonImmutable);
        $this->assertSame(1, $d->day);
    }

    public function testFluidSetDate()
    {
        $d = CarbonImmutable::createFromDate(2000, 1, 1);
        $d = $d->setDate(1995, 13, 32);
        $this->assertTrue($d instanceof CarbonImmutable);
        $this->assertCarbonImmutable($d, 1996, 2, 1);
    }

    public function testFluidHourSetter()
    {
        $d = CarbonImmutable::now();
        $d = $d->hour(2);
        $this->assertTrue($d instanceof CarbonImmutable);
        $this->assertSame(2, $d->hour);
    }

    public function testFluidHourSetterWithWrap()
    {
        $d = CarbonImmutable::now();
        $d = $d->hour(25);
        $this->assertTrue($d instanceof CarbonImmutable);
        $this->assertSame(1, $d->hour);
    }

    public function testFluidMinuteSetter()
    {
        $d = CarbonImmutable::now();
        $d = $d->minute(2);
        $this->assertTrue($d instanceof CarbonImmutable);
        $this->assertSame(2, $d->minute);
    }

    public function testFluidMinuteSetterWithWrap()
    {
        $d = CarbonImmutable::now();
        $d = $d->minute(61);
        $this->assertTrue($d instanceof CarbonImmutable);
        $this->assertSame(1, $d->minute);
    }

    public function testFluidSecondSetter()
    {
        $d = CarbonImmutable::now();
        $d = $d->second(2);
        $this->assertTrue($d instanceof CarbonImmutable);
        $this->assertSame(2, $d->second);
    }

    public function testFluidSecondSetterWithWrap()
    {
        $d = CarbonImmutable::now();
        $d = $d->second(62);
        $this->assertTrue($d instanceof CarbonImmutable);
        $this->assertSame(2, $d->second);
    }

    public function testFluidSetTime()
    {
        $d = CarbonImmutable::createFromDate(2000, 1, 1);
        $d = $d->setTime(25, 61, 61);
        $this->assertTrue($d instanceof CarbonImmutable);
        $this->assertCarbonImmutable($d, 2000, 1, 2, 2, 2, 1);
    }

    public function testFluidTimestampSetter()
    {
        $d = CarbonImmutable::now();
        $d = $d->timestamp(10);
        $this->assertTrue($d instanceof CarbonImmutable);
        $this->assertSame(10, $d->timestamp);
    }
}
