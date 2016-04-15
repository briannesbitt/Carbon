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

class StartEndOfTest extends AbstractTestCase
{
    public function testStartOfDay()
    {
        $dt = Carbon::now();
        $this->assertInstanceOfCarbon($dt->startOfDay());
        $this->assertCarbon($dt, $dt->year, $dt->month, $dt->day, 0, 0, 0);
    }

    public function testEndOfDay()
    {
        $dt = Carbon::now();
        $this->assertInstanceOfCarbon($dt->endOfDay());
        $this->assertCarbon($dt, $dt->year, $dt->month, $dt->day, 23, 59, 59);
    }

    public function testStartOfMonthIsFluid()
    {
        $dt = Carbon::now();
        $this->assertInstanceOfCarbon($dt->startOfMonth());
    }

    public function testStartOfMonthFromNow()
    {
        $dt = Carbon::now()->startOfMonth();
        $this->assertCarbon($dt, $dt->year, $dt->month, 1, 0, 0, 0);
    }

    public function testStartOfMonthFromLastDay()
    {
        $dt = Carbon::create(2000, 1, 31, 2, 3, 4)->startOfMonth();
        $this->assertCarbon($dt, 2000, 1, 1, 0, 0, 0);
    }

    public function testStartOfYearIsFluid()
    {
        $dt = Carbon::now();
        $this->assertInstanceOfCarbon($dt->startOfYear());
    }

    public function testStartOfYearFromNow()
    {
        $dt = Carbon::now()->startOfYear();
        $this->assertCarbon($dt, $dt->year, 1, 1, 0, 0, 0);
    }

    public function testStartOfYearFromFirstDay()
    {
        $dt = Carbon::create(2000, 1, 1, 1, 1, 1)->startOfYear();
        $this->assertCarbon($dt, 2000, 1, 1, 0, 0, 0);
    }

    public function testStartOfYearFromLastDay()
    {
        $dt = Carbon::create(2000, 12, 31, 23, 59, 59)->startOfYear();
        $this->assertCarbon($dt, 2000, 1, 1, 0, 0, 0);
    }

    public function testEndOfMonthIsFluid()
    {
        $dt = Carbon::now();
        $this->assertInstanceOfCarbon($dt->endOfMonth());
    }

    public function testEndOfMonth()
    {
        $dt = Carbon::create(2000, 1, 1, 2, 3, 4)->endOfMonth();
        $this->assertCarbon($dt, 2000, 1, 31, 23, 59, 59);
    }

    public function testEndOfMonthFromLastDay()
    {
        $dt = Carbon::create(2000, 1, 31, 2, 3, 4)->endOfMonth();
        $this->assertCarbon($dt, 2000, 1, 31, 23, 59, 59);
    }

    public function testEndOfYearIsFluid()
    {
        $dt = Carbon::now();
        $this->assertInstanceOfCarbon($dt->endOfYear());
    }

    public function testEndOfYearFromNow()
    {
        $dt = Carbon::now()->endOfYear();
        $this->assertCarbon($dt, $dt->year, 12, 31, 23, 59, 59);
    }

    public function testEndOfYearFromFirstDay()
    {
        $dt = Carbon::create(2000, 1, 1, 1, 1, 1)->endOfYear();
        $this->assertCarbon($dt, 2000, 12, 31, 23, 59, 59);
    }

    public function testEndOfYearFromLastDay()
    {
        $dt = Carbon::create(2000, 12, 31, 23, 59, 59)->endOfYear();
        $this->assertCarbon($dt, 2000, 12, 31, 23, 59, 59);
    }

    public function testStartOfSemesterIsFluid()
    {
        $dt = Carbon::now()->startOfSemester();
        $this->assertInstanceOfCarbon($dt);
    }

    public function dataProviderTestStartOfSemester()
    {
        return array(
            array(1, 1),
            array(2, 1),
            array(3, 1),
            array(4, 1),
            array(5, 1),
            array(6, 1),
            array(7, 7),
            array(8, 7),
            array(9, 7),
            array(10, 7),
            array(11, 7),
            array(12, 7),
        );
    }

    /**
     * @dataProvider \Tests\Carbon\StartEndOfTest::dataProviderTestStartOfSemester
     *
     * @param int $month
     * @param int $firstMonthOfSemester
     */
    public function testStartOfSemesterFromStartOfMonth($month, $firstMonthOfSemester)
    {
        $dt = Carbon::create(2016, $month, 1)->startOfSemester();
        $this->assertCarbon($dt, 2016, $firstMonthOfSemester, 1, 0, 0, 0);
    }

    /**
     * @dataProvider \Tests\Carbon\StartEndOfTest::dataProviderTestStartOfSemester
     *
     * @param int $month
     * @param int $firstMonthOfSemester
     */
    public function testStartOfSemesterFromMiddleOfMonth($month, $firstMonthOfSemester)
    {
        $dt = Carbon::create(2016, $month, 15, 20, 21, 22)->startOfSemester();
        $this->assertCarbon($dt, 2016, $firstMonthOfSemester, 1, 0, 0, 0);
    }

    /**
     * @dataProvider \Tests\Carbon\StartEndOfTest::dataProviderTestStartOfSemester
     *
     * @param int $month
     * @param int $firstMonthOfSemester
     */
    public function testStartOfSemesterFromEndOfMonth($month, $firstMonthOfSemester)
    {
        $dt = Carbon::create(2016, $month)->endOfMonth()->startOfSemester();
        $this->assertCarbon($dt, 2016, $firstMonthOfSemester, 1, 0, 0, 0);
    }

    public function testEndOfSemesterIsFluid()
    {
        $dt = Carbon::now()->endOfSemester();
        $this->assertInstanceOfCarbon($dt);
    }

    public function dataProviderTestEndOfSemester()
    {
        return array(
            array(1, 6, 30),
            array(2, 6, 30),
            array(3, 6, 30),
            array(4, 6, 30),
            array(5, 6, 30),
            array(6, 6, 30),
            array(7, 12, 31),
            array(8, 12, 31),
            array(9, 12, 31),
            array(10, 12, 31),
            array(11, 12, 31),
            array(12, 12, 31),
        );
    }

    /**
     * @dataProvider \Tests\Carbon\StartEndOfTest::dataProviderTestEndOfSemester
     *
     * @param int $month
     * @param int $lastMonthOfSemester
     * @param int $lastDayOfSemester
     */
    public function testEndOfSemesterFromStartOfMonth($month, $lastMonthOfSemester, $lastDayOfSemester)
    {
        $dt = Carbon::create(2016, $month)->startOfMonth()->endOfSemester();
        $this->assertCarbon($dt, 2016, $lastMonthOfSemester, $lastDayOfSemester, 23, 59, 59);
    }

    /**
     * @dataProvider \Tests\Carbon\StartEndOfTest::dataProviderTestEndOfSemester
     *
     * @param int $month
     * @param int $lastMonthOfSemester
     * @param int $lastDayOfSemester
     */
    public function testEndOfSemesterFromMiddleOfMonth($month, $lastMonthOfSemester, $lastDayOfSemester)
    {
        $dt = Carbon::create(2016, $month, 15, 20, 21, 22)->endOfSemester();
        $this->assertCarbon($dt, 2016, $lastMonthOfSemester, $lastDayOfSemester, 23, 59, 59);
    }

    /**
     * @dataProvider \Tests\Carbon\StartEndOfTest::dataProviderTestEndOfSemester
     *
     * @param int $month
     * @param int $lastMonthOfSemester
     * @param int $lastDayOfSemester
     */
    public function testEndOfSemesterFromEndOfMonth($month, $lastMonthOfSemester, $lastDayOfSemester)
    {
        $dt = Carbon::create(2016, $month)->endOfMonth()->endOfSemester();
        $this->assertCarbon($dt, 2016, $lastMonthOfSemester, $lastDayOfSemester, 23, 59, 59);
    }

    public function testStartOfDecadeIsFluid()
    {
        $dt = Carbon::now();
        $this->assertInstanceOfCarbon($dt->startOfDecade());
    }

    public function testStartOfDecadeFromNow()
    {
        $dt = Carbon::now()->startOfDecade();
        $this->assertCarbon($dt, $dt->year - $dt->year % 10, 1, 1, 0, 0, 0);
    }

    public function testStartOfDecadeFromFirstDay()
    {
        $dt = Carbon::create(2000, 1, 1, 1, 1, 1)->startOfDecade();
        $this->assertCarbon($dt, 2000, 1, 1, 0, 0, 0);
    }

    public function testStartOfDecadeFromLastDay()
    {
        $dt = Carbon::create(2009, 12, 31, 23, 59, 59)->startOfDecade();
        $this->assertCarbon($dt, 2000, 1, 1, 0, 0, 0);
    }

    public function testEndOfDecadeIsFluid()
    {
        $dt = Carbon::now();
        $this->assertInstanceOfCarbon($dt->endOfDecade());
    }

    public function testEndOfDecadeFromNow()
    {
        $dt = Carbon::now()->endOfDecade();
        $this->assertCarbon($dt, $dt->year - $dt->year % 10 + 9, 12, 31, 23, 59, 59);
    }

    public function testEndOfDecadeFromFirstDay()
    {
        $dt = Carbon::create(2000, 1, 1, 1, 1, 1)->endOfDecade();
        $this->assertCarbon($dt, 2009, 12, 31, 23, 59, 59);
    }

    public function testEndOfDecadeFromLastDay()
    {
        $dt = Carbon::create(2009, 12, 31, 23, 59, 59)->endOfDecade();
        $this->assertCarbon($dt, 2009, 12, 31, 23, 59, 59);
    }

    public function testStartOfCenturyIsFluid()
    {
        $dt = Carbon::now();
        $this->assertInstanceOfCarbon($dt->startOfCentury());
    }

    public function testStartOfCenturyFromNow()
    {
        $now = Carbon::now();
        $dt = Carbon::now()->startOfCentury();
        $this->assertCarbon($dt, $now->year - $now->year % 100 + 1, 1, 1, 0, 0, 0);
    }

    public function testStartOfCenturyFromFirstDay()
    {
        $dt = Carbon::create(2001, 1, 1, 1, 1, 1)->startOfCentury();
        $this->assertCarbon($dt, 2001, 1, 1, 0, 0, 0);
    }

    public function testStartOfCenturyFromLastDay()
    {
        $dt = Carbon::create(2100, 12, 31, 23, 59, 59)->startOfCentury();
        $this->assertCarbon($dt, 2001, 1, 1, 0, 0, 0);
    }

    public function testEndOfCenturyIsFluid()
    {
        $dt = Carbon::now();
        $this->assertInstanceOfCarbon($dt->endOfCentury());
    }

    public function testEndOfCenturyFromNow()
    {
        $now = Carbon::now();
        $dt = Carbon::now()->endOfCentury();
        $this->assertCarbon($dt, $now->year - $now->year % 100 + 100, 12, 31, 23, 59, 59);
    }

    public function testEndOfCenturyFromFirstDay()
    {
        $dt = Carbon::create(2001, 1, 1, 1, 1, 1)->endOfCentury();
        $this->assertCarbon($dt, 2100, 12, 31, 23, 59, 59);
    }

    public function testEndOfCenturyFromLastDay()
    {
        $dt = Carbon::create(2100, 12, 31, 23, 59, 59)->endOfCentury();
        $this->assertCarbon($dt, 2100, 12, 31, 23, 59, 59);
    }

    public function testAverageIsFluid()
    {
        $dt = Carbon::now()->average();
        $this->assertInstanceOfCarbon($dt);
    }

    public function testAverageFromSame()
    {
        $dt1 = Carbon::create(2000, 1, 31, 2, 3, 4);
        $dt2 = Carbon::create(2000, 1, 31, 2, 3, 4)->average($dt1);
        $this->assertCarbon($dt2, 2000, 1, 31, 2, 3, 4);
    }

    public function testAverageFromGreater()
    {
        $dt1 = Carbon::create(2000, 1, 1, 1, 1, 1);
        $dt2 = Carbon::create(2009, 12, 31, 23, 59, 59)->average($dt1);
        $this->assertCarbon($dt2, 2004, 12, 31, 12, 30, 30);
    }

    public function testAverageFromLower()
    {
        $dt1 = Carbon::create(2009, 12, 31, 23, 59, 59);
        $dt2 = Carbon::create(2000, 1, 1, 1, 1, 1)->average($dt1);
        $this->assertCarbon($dt2, 2004, 12, 31, 12, 30, 30);
    }
}
