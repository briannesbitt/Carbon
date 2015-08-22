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

class SubTest extends TestFixture
{

    public function testSubYearsPositive()
    {
        $this->assertSame(1974, CarbonImmutable::createFromDate(1975)->subYears(1)->year);
    }

    public function testSubYearsZero()
    {
        $this->assertSame(1975, CarbonImmutable::createFromDate(1975)->subYears(0)->year);
    }

    public function testSubYearsNegative()
    {
        $this->assertSame(1976, CarbonImmutable::createFromDate(1975)->subYears(-1)->year);
    }

    public function testSubYear()
    {
        $this->assertSame(1974, CarbonImmutable::createFromDate(1975)->subYear()->year);
    }

    public function testSubMonthsPositive()
    {
        $this->assertSame(12, CarbonImmutable::createFromDate(1975, 1, 1)->subMonths(1)->month);
    }

    public function testSubMonthsZero()
    {
        $this->assertSame(1, CarbonImmutable::createFromDate(1975, 1, 1)->subMonths(0)->month);
    }

    public function testSubMonthsNegative()
    {
        $this->assertSame(2, CarbonImmutable::createFromDate(1975, 1, 1)->subMonths(-1)->month);
    }

    public function testSubMonth()
    {
        $this->assertSame(12, CarbonImmutable::createFromDate(1975, 1, 1)->subMonth()->month);
    }

    public function testSubDaysPositive()
    {
        $this->assertSame(30, CarbonImmutable::createFromDate(1975, 5, 1)->subDays(1)->day);
    }

    public function testSubDaysZero()
    {
        $this->assertSame(1, CarbonImmutable::createFromDate(1975, 5, 1)->subDays(0)->day);
    }

    public function testSubDaysNegative()
    {
        $this->assertSame(2, CarbonImmutable::createFromDate(1975, 5, 1)->subDays(-1)->day);
    }

    public function testSubDay()
    {
        $this->assertSame(30, CarbonImmutable::createFromDate(1975, 5, 1)->subDay()->day);
    }

    public function testSubWeekdaysPositive()
    {
        $this->assertSame(22, CarbonImmutable::createFromDate(2012, 1, 4)->subWeekdays(9)->day);
    }

    public function testSubWeekdaysZero()
    {
        $this->assertSame(4, CarbonImmutable::createFromDate(2012, 1, 4)->subWeekdays(0)->day);
    }

    public function testSubWeekdaysNegative()
    {
        $this->assertSame(13, CarbonImmutable::createFromDate(2012, 1, 31)->subWeekdays(-9)->day);
    }

    public function testSubWeekday()
    {
        $this->assertSame(6, CarbonImmutable::createFromDate(2012, 1, 9)->subWeekday()->day);
    }

    public function testSubWeeksPositive()
    {
        $this->assertSame(14, CarbonImmutable::createFromDate(1975, 5, 21)->subWeeks(1)->day);
    }

    public function testSubWeeksZero()
    {
        $this->assertSame(21, CarbonImmutable::createFromDate(1975, 5, 21)->subWeeks(0)->day);
    }

    public function testSubWeeksNegative()
    {
        $this->assertSame(28, CarbonImmutable::createFromDate(1975, 5, 21)->subWeeks(-1)->day);
    }

    public function testSubWeek()
    {
        $this->assertSame(14, CarbonImmutable::createFromDate(1975, 5, 21)->subWeek()->day);
    }

    public function testSubHoursPositive()
    {
        $this->assertSame(23, CarbonImmutable::createFromTime(0)->subHours(1)->hour);
    }

    public function testSubHoursZero()
    {
        $this->assertSame(0, CarbonImmutable::createFromTime(0)->subHours(0)->hour);
    }

    public function testSubHoursNegative()
    {
        $this->assertSame(1, CarbonImmutable::createFromTime(0)->subHours(-1)->hour);
    }

    public function testSubHour()
    {
        $this->assertSame(23, CarbonImmutable::createFromTime(0)->subHour()->hour);
    }

    public function testSubMinutesPositive()
    {
        $this->assertSame(59, CarbonImmutable::createFromTime(0, 0)->subMinutes(1)->minute);
    }

    public function testSubMinutesZero()
    {
        $this->assertSame(0, CarbonImmutable::createFromTime(0, 0)->subMinutes(0)->minute);
    }

    public function testSubMinutesNegative()
    {
        $this->assertSame(1, CarbonImmutable::createFromTime(0, 0)->subMinutes(-1)->minute);
    }

    public function testSubMinute()
    {
        $this->assertSame(59, CarbonImmutable::createFromTime(0, 0)->subMinute()->minute);
    }

    public function testSubSecondsPositive()
    {
        $this->assertSame(59, CarbonImmutable::createFromTime(0, 0, 0)->subSeconds(1)->second);
    }

    public function testSubSecondsZero()
    {
        $this->assertSame(0, CarbonImmutable::createFromTime(0, 0, 0)->subSeconds(0)->second);
    }

    public function testSubSecondsNegative()
    {
        $this->assertSame(1, CarbonImmutable::createFromTime(0, 0, 0)->subSeconds(-1)->second);
    }

    public function testSubSecond()
    {
        $this->assertSame(59, CarbonImmutable::createFromTime(0, 0, 0)->subSecond()->second);
    }

    /***** Test non plural methods with non default args *****/

    public function testSubYearPassingArg()
    {
        $this->assertSame(1973, CarbonImmutable::createFromDate(1975)->subYear(2)->year);
    }

    public function testSubMonthPassingArg()
    {
        $this->assertSame(3, CarbonImmutable::createFromDate(1975, 5, 1)->subMonth(2)->month);
    }

    public function testSubMonthNoOverflowPassingArg()
    {
        $dt = CarbonImmutable::createFromDate(2011, 4, 30)->subMonthNoOverflow(2);
        $this->assertSame(2, $dt->month);
        $this->assertSame(28, $dt->day);
    }

    public function testSubDayPassingArg()
    {
        $this->assertSame(8, CarbonImmutable::createFromDate(1975, 5, 10)->subDay(2)->day);
    }

    public function testSubHourPassingArg()
    {
        $this->assertSame(22, CarbonImmutable::createFromTime(0)->subHour(2)->hour);
    }

    public function testSubMinutePassingArg()
    {
        $this->assertSame(58, CarbonImmutable::createFromTime(0)->subMinute(2)->minute);
    }

    public function testSubSecondPassingArg()
    {
        $this->assertSame(58, CarbonImmutable::createFromTime(0)->subSecond(2)->second);
    }
}
