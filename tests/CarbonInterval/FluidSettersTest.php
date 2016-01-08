<?php

/*
 * This file is part of the Carbon package.
 *
 * (c) Brian Nesbitt <brian@nesbot.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tests\CarbonInterval;

use Carbon\CarbonInterval;
use Tests\AbstractTestCase;

class FluidSettersTest extends AbstractTestCase
{

    public function testFluidYearSetter()
    {
        $d = CarbonInterval::create(4, 5, 6, 5, 8, 9, 10);
        $this->assertInstanceOfCarbonInterval($d->year(1995));
        $this->assertSame(1995, $d->years);
    }

    public function testFluidYearsSetter()
    {
        $d = CarbonInterval::create(4, 5, 6, 5, 8, 9, 10);
        $this->assertInstanceOfCarbonInterval($d->years(2000));
        $this->assertSame(2000, $d->years);
    }

    public function testFluidMonthSetter()
    {
        $d = CarbonInterval::create(4, 5, 6, 5, 8, 9, 10);
        $this->assertInstanceOfCarbonInterval($d->month(12));
        $this->assertSame(12, $d->months);
    }

    public function testFluidMonthsSetter()
    {
        $d = CarbonInterval::create(4, 5, 6, 5, 8, 9, 10);
        $this->assertInstanceOfCarbonInterval($d->month(10));
        $this->assertSame(10, $d->months);
    }

    public function testFluidWeekSetter()
    {
        $d = CarbonInterval::create(4, 5, 6, 5, 8, 9, 10);
        $this->assertInstanceOfCarbonInterval($d->week(10));
        $this->assertSame(70, $d->dayz);
    }

    public function testFluidWeeksSetter()
    {
        $d = CarbonInterval::create(4, 5, 6, 5, 8, 9, 10);
        $this->assertInstanceOfCarbonInterval($d->weeks(1));
        $this->assertSame(7, $d->dayz);
    }

    public function testFluidDaySetter()
    {
        $d = CarbonInterval::create(4, 5, 6, 5, 8, 9, 10);
        $this->assertInstanceOfCarbonInterval($d->day(4));
        $this->assertSame(4, $d->dayz);
    }

    public function testFluidDaysSetter()
    {
        $d = CarbonInterval::create(4, 5, 6, 5, 8, 9, 10);
        $this->assertInstanceOfCarbonInterval($d->days(6));
        $this->assertSame(6, $d->dayz);
    }

    public function testFluidDayzSetter()
    {
        $d = CarbonInterval::create(4, 5, 6, 5, 8, 9, 10);
        $this->assertInstanceOfCarbonInterval($d->dayz(8));
        $this->assertSame(8, $d->dayz);
    }

    public function testFluidHourSetter()
    {
        $d = CarbonInterval::create(4, 5, 6, 5, 8, 9, 10);
        $this->assertInstanceOfCarbonInterval($d->hour(10));
        $this->assertSame(10, $d->hours);
    }

    public function testFluidHoursSetter()
    {
        $d = CarbonInterval::create(4, 5, 6, 5, 8, 9, 10);
        $this->assertInstanceOfCarbonInterval($d->hours(12));
        $this->assertSame(12, $d->hours);
    }

    public function testFluidMinuteSetter()
    {
        $d = CarbonInterval::create(4, 5, 6, 5, 8, 9, 10);
        $this->assertInstanceOfCarbonInterval($d->minute(14));
        $this->assertSame(14, $d->minutes);
    }

    public function testFluidMinutesSetter()
    {
        $d = CarbonInterval::create(4, 5, 6, 5, 8, 9, 10);
        $this->assertInstanceOfCarbonInterval($d->minutes(16));
        $this->assertSame(16, $d->minutes);
    }

    public function testFluidSecondSetter()
    {
        $d = CarbonInterval::create(4, 5, 6, 5, 8, 9, 10);
        $this->assertInstanceOfCarbonInterval($d->second(18));
        $this->assertSame(18, $d->seconds);
    }

    public function testFluidSecondsSetter()
    {
        $d = CarbonInterval::create(4, 5, 6, 5, 8, 9, 10);
        $this->assertInstanceOfCarbonInterval($d->seconds(20));
        $this->assertSame(20, $d->seconds);
    }
}
