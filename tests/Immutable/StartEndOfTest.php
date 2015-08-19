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

class StartEndOfTest extends TestFixture
{

    public function testStartOfDay()
    {
        $dt = CarbonImmutable::now();
        $dt = $dt->startOfDay();
        $this->assertTrue($dt instanceof CarbonImmutable);
        $this->assertCarbonImmutable($dt, $dt->year, $dt->month, $dt->day, 0, 0, 0);
    }

    public function testEndOfDay()
    {
        $dt = CarbonImmutable::now();
        $dt = $dt->endOfDay();
        $this->assertTrue($dt instanceof CarbonImmutable);
        $this->assertCarbonImmutable($dt, $dt->year, $dt->month, $dt->day, 23, 59, 59);
    }

    public function testStartOfMonthIsFluid()
    {
        $dt = CarbonImmutable::now();
        $dt = $dt->startOfMonth();
        $this->assertTrue($dt instanceof CarbonImmutable);
    }

    public function testStartOfMonthFromNow()
    {
        $dt = CarbonImmutable::now()->startOfMonth();
        $this->assertCarbonImmutable($dt, $dt->year, $dt->month, 1, 0, 0, 0);
    }

    public function testStartOfMonthFromLastDay()
    {
        $dt = CarbonImmutable::create(2000, 1, 31, 2, 3, 4)->startOfMonth();
        $this->assertCarbonImmutable($dt, 2000, 1, 1, 0, 0, 0);
    }

    public function testStartOfYearIsFluid()
    {
        $dt = CarbonImmutable::now();
        $this->assertTrue($dt->startOfYear() instanceof CarbonImmutable);
    }

    public function testStartOfYearFromNow()
    {
        $dt = CarbonImmutable::now()->startOfYear();
        $this->assertCarbonImmutable($dt, $dt->year, 1, 1, 0, 0, 0);
    }

    public function testStartOfYearFromFirstDay()
    {
        $dt = CarbonImmutable::create(2000, 1, 1, 1, 1, 1)->startOfYear();
        $this->assertCarbonImmutable($dt, 2000, 1, 1, 0, 0, 0);
    }

    public function testStartOfYearFromLastDay()
    {
        $dt = CarbonImmutable::create(2000, 12, 31, 23, 59, 59)->startOfYear();
        $this->assertCarbonImmutable($dt, 2000, 1, 1, 0, 0, 0);
    }

    public function testEndOfMonthIsFluid()
    {
        $dt = CarbonImmutable::now();
        $this->assertTrue($dt->endOfMonth() instanceof CarbonImmutable);
    }

    public function testEndOfMonth()
    {
        $dt = CarbonImmutable::create(2000, 1, 1, 2, 3, 4)->endOfMonth();
        $this->assertCarbonImmutable($dt, 2000, 1, 31, 23, 59, 59);
    }

    public function testEndOfMonthFromLastDay()
    {
        $dt = CarbonImmutable::create(2000, 1, 31, 2, 3, 4)->endOfMonth();
        $this->assertCarbonImmutable($dt, 2000, 1, 31, 23, 59, 59);
    }

    public function testEndOfYearIsFluid()
    {
        $dt = CarbonImmutable::now();
        $this->assertTrue($dt->endOfYear() instanceof CarbonImmutable);
    }

    public function testEndOfYearFromNow()
    {
        $dt = CarbonImmutable::now()->endOfYear();
        $this->assertCarbonImmutable($dt, $dt->year, 12, 31, 23, 59, 59);
    }

    public function testEndOfYearFromFirstDay()
    {
        $dt = CarbonImmutable::create(2000, 1, 1, 1, 1, 1)->endOfYear();
        $this->assertCarbonImmutable($dt, 2000, 12, 31, 23, 59, 59);
    }

    public function testEndOfYearFromLastDay()
    {
        $dt = CarbonImmutable::create(2000, 12, 31, 23, 59, 59)->endOfYear();
        $this->assertCarbonImmutable($dt, 2000, 12, 31, 23, 59, 59);
    }

    public function testStartOfDecadeIsFluid()
    {
        $dt = CarbonImmutable::now();
        $this->assertTrue($dt->startOfDecade() instanceof CarbonImmutable);
    }

    public function testStartOfDecadeFromNow()
    {
        $dt = CarbonImmutable::now()->startOfDecade();
        $this->assertCarbonImmutable($dt, $dt->year - $dt->year % 10, 1, 1, 0, 0, 0);
    }

    public function testStartOfDecadeFromFirstDay()
    {
        $dt = CarbonImmutable::create(2000, 1, 1, 1, 1, 1)->startOfDecade();
        $this->assertCarbonImmutable($dt, 2000, 1, 1, 0, 0, 0);
    }

    public function testStartOfDecadeFromLastDay()
    {
        $dt = CarbonImmutable::create(2009, 12, 31, 23, 59, 59)->startOfDecade();
        $this->assertCarbonImmutable($dt, 2000, 1, 1, 0, 0, 0);
    }

    public function testEndOfDecadeIsFluid()
    {
        $dt = CarbonImmutable::now();
        $this->assertTrue($dt->endOfDecade() instanceof CarbonImmutable);
    }

    public function testEndOfDecadeFromNow()
    {
        $dt = CarbonImmutable::now()->endOfDecade();
        $this->assertCarbonImmutable($dt, $dt->year - $dt->year % 10 + 9, 12, 31, 23, 59, 59);
    }

    public function testEndOfDecadeFromFirstDay()
    {
        $dt = CarbonImmutable::create(2000, 1, 1, 1, 1, 1)->endOfDecade();
        $this->assertCarbonImmutable($dt, 2009, 12, 31, 23, 59, 59);
    }

    public function testEndOfDecadeFromLastDay()
    {
        $dt = CarbonImmutable::create(2009, 12, 31, 23, 59, 59)->endOfDecade();
        $this->assertCarbonImmutable($dt, 2009, 12, 31, 23, 59, 59);
    }

    public function testStartOfCenturyIsFluid()
    {
        $dt = CarbonImmutable::now();
        $this->assertTrue($dt->startOfCentury() instanceof CarbonImmutable);
    }

    public function testStartOfCenturyFromNow()
    {
        $dt = CarbonImmutable::now()->startOfCentury();
        $this->assertCarbonImmutable($dt, $dt->year - $dt->year % 100, 1, 1, 0, 0, 0);
    }

    public function testStartOfCenturyFromFirstDay()
    {
        $dt = CarbonImmutable::create(2000, 1, 1, 1, 1, 1)->startOfCentury();
        $this->assertCarbonImmutable($dt, 2000, 1, 1, 0, 0, 0);
    }

    public function testStartOfCenturyFromLastDay()
    {
        $dt = CarbonImmutable::create(2009, 12, 31, 23, 59, 59)->startOfCentury();
        $this->assertCarbonImmutable($dt, 2000, 1, 1, 0, 0, 0);
    }

    public function testEndOfCenturyIsFluid()
    {
        $dt = CarbonImmutable::now();
        $this->assertTrue($dt->endOfCentury() instanceof CarbonImmutable);
    }

    public function testEndOfCenturyFromNow()
    {
        $dt = CarbonImmutable::now()->endOfCentury();
        $this->assertCarbonImmutable($dt, $dt->year - $dt->year % 100 + 99, 12, 31, 23, 59, 59);
    }

    public function testEndOfCenturyFromFirstDay()
    {
        $dt = CarbonImmutable::create(2000, 1, 1, 1, 1, 1)->endOfCentury();
        $this->assertCarbonImmutable($dt, 2099, 12, 31, 23, 59, 59);
    }

    public function testEndOfCenturyFromLastDay()
    {
        $dt = CarbonImmutable::create(2099, 12, 31, 23, 59, 59)->endOfCentury();
        $this->assertCarbonImmutable($dt, 2099, 12, 31, 23, 59, 59);
    }

    public function testAverageIsFluid()
    {
        $dt = CarbonImmutable::now()->average();
        $this->assertTrue($dt instanceof CarbonImmutable);
    }

    public function testAverageFromSame()
    {
        $dt1 = CarbonImmutable::create(2000, 1, 31, 2, 3, 4);
        $dt2 = CarbonImmutable::create(2000, 1, 31, 2, 3, 4)->average($dt1);
        $this->assertCarbonImmutable($dt2, 2000, 1, 31, 2, 3, 4);
    }

    public function testAverageFromGreater()
    {
        $dt1 = CarbonImmutable::create(2000, 1, 1, 1, 1, 1);
        $dt2 = CarbonImmutable::create(2009, 12, 31, 23, 59, 59)->average($dt1);
        $this->assertCarbonImmutable($dt2, 2004, 12, 31, 12, 30, 30);
    }

    public function testAverageFromLower()
    {
        $dt1 = CarbonImmutable::create(2009, 12, 31, 23, 59, 59);
        $dt2 = CarbonImmutable::create(2000, 1, 1, 1, 1, 1)->average($dt1);
        $this->assertCarbonImmutable($dt2, 2004, 12, 31, 12, 30, 30);
    }
}
