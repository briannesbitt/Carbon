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

class AddTest extends AbstractTestCase
{
    public function testAddYearsPositive()
    {
        $this->assertSame(1976, Carbon::createFromDate(1975)->addYears(1)->year);
    }

    public function testAddYearsZero()
    {
        $this->assertSame(1975, Carbon::createFromDate(1975)->addYears(0)->year);
    }

    public function testAddYearsNegative()
    {
        $this->assertSame(1974, Carbon::createFromDate(1975)->addYears(-1)->year);
    }

    public function testAddYear()
    {
        $this->assertSame(1976, Carbon::createFromDate(1975)->addYear()->year);
    }

    public function testAddDaysPositive()
    {
        $this->assertSame(1, Carbon::createFromDate(1975, 5, 31)->addDays(1)->day);
    }

    public function testAddDaysZero()
    {
        $this->assertSame(31, Carbon::createFromDate(1975, 5, 31)->addDays(0)->day);
    }

    public function testAddDaysNegative()
    {
        $this->assertSame(30, Carbon::createFromDate(1975, 5, 31)->addDays(-1)->day);
    }

    public function testAddDay()
    {
        $this->assertSame(1, Carbon::createFromDate(1975, 5, 31)->addDay()->day);
    }

    public function testAddWeekdaysPositive()
    {
        $dt = Carbon::create(2012, 1, 4, 13, 2, 1)->addWeekdays(9);

        $this->assertSame(17, $dt->day);

        // test for https://bugs.php.net/bug.php?id=54909
        $this->assertSame(13, $dt->hour);
        $this->assertSame(2, $dt->minute);
        $this->assertSame(1, $dt->second);
    }

    public function testAddWeekdaysZero()
    {
        $this->assertSame(4, Carbon::createFromDate(2012, 1, 4)->addWeekdays(0)->day);
    }

    public function testAddWeekdaysNegative()
    {
        $this->assertSame(18, Carbon::createFromDate(2012, 1, 31)->addWeekdays(-9)->day);
    }

    public function testAddWeekday()
    {
        $this->assertSame(9, Carbon::createFromDate(2012, 1, 6)->addWeekday()->day);
    }

    public function testAddWeekdayDuringWeekend()
    {
        $this->assertSame(9, Carbon::createFromDate(2012, 1, 7)->addWeekday()->day);
    }

    public function testAddWeeksPositive()
    {
        $this->assertSame(28, Carbon::createFromDate(1975, 5, 21)->addWeeks(1)->day);
    }

    public function testAddWeeksZero()
    {
        $this->assertSame(21, Carbon::createFromDate(1975, 5, 21)->addWeeks(0)->day);
    }

    public function testAddWeeksNegative()
    {
        $this->assertSame(14, Carbon::createFromDate(1975, 5, 21)->addWeeks(-1)->day);
    }

    public function testAddWeek()
    {
        $this->assertSame(28, Carbon::createFromDate(1975, 5, 21)->addWeek()->day);
    }

    public function testAddHoursPositive()
    {
        $this->assertSame(1, Carbon::createFromTime(0)->addHours(1)->hour);
    }

    public function testAddHoursZero()
    {
        $this->assertSame(0, Carbon::createFromTime(0)->addHours(0)->hour);
    }

    public function testAddHoursNegative()
    {
        $this->assertSame(23, Carbon::createFromTime(0)->addHours(-1)->hour);
    }

    public function testAddHour()
    {
        $this->assertSame(1, Carbon::createFromTime(0)->addHour()->hour);
    }

    public function testAddMinutesPositive()
    {
        $this->assertSame(1, Carbon::createFromTime(0, 0)->addMinutes(1)->minute);
    }

    public function testAddMinutesZero()
    {
        $this->assertSame(0, Carbon::createFromTime(0, 0)->addMinutes(0)->minute);
    }

    public function testAddMinutesNegative()
    {
        $this->assertSame(59, Carbon::createFromTime(0, 0)->addMinutes(-1)->minute);
    }

    public function testAddMinute()
    {
        $this->assertSame(1, Carbon::createFromTime(0, 0)->addMinute()->minute);
    }

    public function testAddSecondsPositive()
    {
        $this->assertSame(1, Carbon::createFromTime(0, 0, 0)->addSeconds(1)->second);
    }

    public function testAddSecondsZero()
    {
        $this->assertSame(0, Carbon::createFromTime(0, 0, 0)->addSeconds(0)->second);
    }

    public function testAddSecondsNegative()
    {
        $this->assertSame(59, Carbon::createFromTime(0, 0, 0)->addSeconds(-1)->second);
    }

    public function testAddSecond()
    {
        $this->assertSame(1, Carbon::createFromTime(0, 0, 0)->addSecond()->second);
    }

    /**
     * Test non plural methods with non default args.
     */
    public function testAddYearPassingArg()
    {
        $this->assertSame(1977, Carbon::createFromDate(1975)->addYear(2)->year);
    }

    public function testAddDayPassingArg()
    {
        $this->assertSame(12, Carbon::createFromDate(1975, 5, 10)->addDay(2)->day);
    }

    public function testAddHourPassingArg()
    {
        $this->assertSame(12, Carbon::createFromTime(10)->addHour(2)->hour);
    }

    public function testAddMinutePassingArg()
    {
        $this->assertSame(2, Carbon::createFromTime(0)->addMinute(2)->minute);
    }

    public function testAddSecondPassingArg()
    {
        $this->assertSame(2, Carbon::createFromTime(0)->addSecond(2)->second);
    }

    public function testAddQuarter()
    {
        $this->assertSame(8, Carbon::createFromDate(1975, 5, 6)->addQuarter()->month);
    }

    public function testAddQuarterNegative()
    {
        $this->assertSame(2, Carbon::createFromDate(1975, 5, 6)->addQuarter(-1)->month);
    }

    public function testSubQuarter()
    {
        $this->assertSame(2, Carbon::createFromDate(1975, 5, 6)->subQuarter()->month);
    }

    public function testSubQuarterNegative()
    {
        $this->assertCarbon(Carbon::createFromDate(1975, 5, 6)->subQuarters(2), 1974, 11, 6);
    }

    public function testAddCentury()
    {
        $this->assertSame(2075, Carbon::createFromDate(1975)->addCentury()->year);
        $this->assertSame(2075, Carbon::createFromDate(1975)->addCentury(1)->year);
        $this->assertSame(2175, Carbon::createFromDate(1975)->addCentury(2)->year);
    }

    public function testAddCenturyNegative()
    {
        $this->assertSame(1875, Carbon::createFromDate(1975)->addCentury(-1)->year);
        $this->assertSame(1775, Carbon::createFromDate(1975)->addCentury(-2)->year);
    }

    public function testAddCenturies()
    {
        $this->assertSame(2075, Carbon::createFromDate(1975)->addCenturies(1)->year);
        $this->assertSame(2175, Carbon::createFromDate(1975)->addCenturies(2)->year);
    }

    public function testAddCenturiesNegative()
    {
        $this->assertSame(1875, Carbon::createFromDate(1975)->addCenturies(-1)->year);
        $this->assertSame(1775, Carbon::createFromDate(1975)->addCenturies(-2)->year);
    }

    public function testSubCentury()
    {
        $this->assertSame(1875, Carbon::createFromDate(1975)->subCentury()->year);
        $this->assertSame(1875, Carbon::createFromDate(1975)->subCentury(1)->year);
        $this->assertSame(1775, Carbon::createFromDate(1975)->subCentury(2)->year);
    }

    public function testSubCenturyNegative()
    {
        $this->assertSame(2075, Carbon::createFromDate(1975)->subCentury(-1)->year);
        $this->assertSame(2175, Carbon::createFromDate(1975)->subCentury(-2)->year);
    }

    public function testSubCenturies()
    {
        $this->assertSame(1875, Carbon::createFromDate(1975)->subCenturies(1)->year);
        $this->assertSame(1775, Carbon::createFromDate(1975)->subCenturies(2)->year);
    }

    public function testSubCenturiesNegative()
    {
        $this->assertSame(2075, Carbon::createFromDate(1975)->subCenturies(-1)->year);
        $this->assertSame(2175, Carbon::createFromDate(1975)->subCenturies(-2)->year);
    }

    public function testAddYearNoOverflow()
    {
        $this->assertCarbon(Carbon::createFromDate(2016, 2, 29)->addYearNoOverflow(), 2017, 2, 28);
    }

    public function testAddYearWithOverflow()
    {
        $this->assertCarbon(Carbon::createFromDate(2016, 2, 29)->addYearWithOverflow(), 2017, 3, 1);
    }

    public function testAddYearNoOverflowPassingArg()
    {
        $this->assertCarbon(Carbon::createFromDate(2016, 2, 29)->addYearsNoOverflow(2), 2018, 2, 28);
    }

    public function testAddYearWithOverflowPassingArg()
    {
        $this->assertCarbon(Carbon::createFromDate(2016, 2, 29)->addYearsWithOverflow(2), 2018, 3, 1);
    }

    public function testSubYearNoOverflowPassingArg()
    {
        $this->assertCarbon(Carbon::createFromDate(2016, 2, 29)->subYearsNoOverflow(2), 2014, 2, 28);
    }

    public function testSubYearWithOverflowPassingArg()
    {
        $this->assertCarbon(Carbon::createFromDate(2016, 2, 29)->subYearsWithOverflow(2), 2014, 3, 1);
    }

    public function testSubYearNoOverflow()
    {
        $this->assertCarbon(Carbon::createFromDate(2016, 2, 29)->subYearNoOverflow(), 2015, 2, 28);
    }

    public function testSubYearWithOverflow()
    {
        $this->assertCarbon(Carbon::createFromDate(2016, 2, 29)->subYearWithOverflow(), 2015, 3, 1);
    }

    public function testUseYearsOverflow()
    {
        $this->assertTrue(Carbon::shouldOverflowYears());
        $this->assertCarbon(Carbon::createFromDate(2016, 2, 29)->addYears(2), 2018, 3, 1);
        Carbon::useYearsOverflow(false);
        $this->assertFalse(Carbon::shouldOverflowYears());
        $this->assertCarbon(Carbon::createFromDate(2016, 2, 29)->addYears(2), 2018, 2, 28);
        Carbon::resetYearsOverflow();
        $this->assertTrue(Carbon::shouldOverflowYears());
        $this->assertCarbon(Carbon::createFromDate(2016, 2, 29)->addYears(2), 2018, 3, 1);
    }
}
