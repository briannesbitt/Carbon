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

    public function testAddMonthsPositive()
    {
        $this->assertSame(1, Carbon::createFromDate(1975, 12)->addMonths(1)->month);
    }

    public function testAddMonthsZero()
    {
        $this->assertSame(12, Carbon::createFromDate(1975, 12)->addMonths(0)->month);
    }

    public function testAddMonthsNegative()
    {
        $this->assertSame(11, Carbon::createFromDate(1975, 12, 1)->addMonths(-1)->month);
    }

    public function testAddMonth()
    {
        $this->assertSame(1, Carbon::createFromDate(1975, 12)->addMonth()->month);
    }

    public function testAddMonthWithOverflow()
    {
        $this->assertSame(3, Carbon::createFromDate(2012, 1, 31)->addMonth()->month);
    }

    public function testAddMonthsNoOverflowPositive()
    {
        $this->assertCarbon(Carbon::create(2012, 1, 31, 1, 1, 1)->addMonthNoOverflow(), 2012, 2, 29, 1, 1, 1);
        $this->assertCarbon(Carbon::create(2012, 1, 31, 1, 1, 1)->addMonthsNoOverflow(2), 2012, 3, 31, 1, 1, 1);
        $this->assertCarbon(Carbon::create(2012, 2, 29, 1, 1, 1)->addMonthNoOverflow(), 2012, 3, 29, 1, 1, 1);
        $this->assertCarbon(Carbon::create(2011, 12, 31, 1, 1, 1)->addMonthNoOverflow(2), 2012, 2, 29, 1, 1, 1);
    }

    public function testAddMonthsNoOverflowZero()
    {
        $this->assertSame(12, Carbon::createFromDate(1975, 12)->addMonths(0)->month);
    }

    public function testAddMonthsNoOverflowNegative()
    {
        $this->assertCarbon(Carbon::create(2012, 2, 29, 1, 1, 1)->addMonthsNoOverflow(-1), 2012, 1, 29, 1, 1, 1);
        $this->assertCarbon(Carbon::create(2012, 3, 31, 1, 1, 1)->addMonthsNoOverflow(-2), 2012, 1, 31, 1, 1, 1);
        $this->assertCarbon(Carbon::create(2012, 3, 31, 1, 1, 1)->addMonthsNoOverflow(-1), 2012, 2, 29, 1, 1, 1);
        $this->assertCarbon(Carbon::create(2012, 1, 31, 1, 1, 1)->addMonthsNoOverflow(-1), 2011, 12, 31, 1, 1, 1);
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

    public function testAddMonthPassingArg()
    {
        $this->assertSame(7, Carbon::createFromDate(1975, 5, 1)->addMonth(2)->month);
    }

    public function testAddMonthNoOverflowPassingArg()
    {
        $this->assertCarbon(Carbon::create(2010, 12, 31, 1, 1, 1, 1)->addMonthNoOverflow(2), 2011, 2, 28, 1, 1, 1);
    }

    public function testAddDayPassingArg()
    {
        $this->assertSame(12, Carbon::createFromDate(1975, 5, 10)->addDay(2)->day);
    }

    public function testAddHourPassingArg()
    {
        $this->assertSame(2, Carbon::createFromTime(0)->addHour(2)->hour);
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
        $c = Carbon::createFromDate(1975, 5, 6)->subQuarters(2);
        $this->assertSame(1974, $c->year);
        $this->assertSame(9, $c->month);
    }
}
