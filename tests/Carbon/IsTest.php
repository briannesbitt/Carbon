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

use \DateTime;
use Carbon\Carbon;
use Tests\AbstractTestCase;

class IsTest extends AbstractTestCase
{
    public function testIsWeekdayTrue()
    {
        $this->assertTrue(Carbon::createFromDate(2012, 1, 2)->isWeekday());
    }

    public function testIsWeekdayFalse()
    {
        $this->assertFalse(Carbon::createFromDate(2012, 1, 1)->isWeekday());
    }

    public function testIsWeekendTrue()
    {
        $this->assertTrue(Carbon::createFromDate(2012, 1, 1)->isWeekend());
    }

    public function testIsWeekendFalse()
    {
        $this->assertFalse(Carbon::createFromDate(2012, 1, 2)->isWeekend());
    }

    public function testIsYesterdayTrue()
    {
        $this->assertTrue(Carbon::now()->subDay()->isYesterday());
    }

    public function testIsYesterdayFalseWithToday()
    {
        $this->assertFalse(Carbon::now()->endOfDay()->isYesterday());
    }

    public function testIsYesterdayFalseWith2Days()
    {
        $this->assertFalse(Carbon::now()->subDays(2)->startOfDay()->isYesterday());
    }

    public function testIsTodayTrue()
    {
        $this->assertTrue(Carbon::now()->isToday());
    }

    public function testIsNextWeekTrue()
    {
        $this->assertTrue(Carbon::now()->addWeek()->isNextWeek());
    }

    public function testIsLastWeekTrue()
    {
        $this->assertTrue(Carbon::now()->subWeek()->isLastWeek());
    }

    public function testIsNextWeekFalse()
    {
        $this->assertFalse(Carbon::now()->addWeek(2)->isNextWeek());
    }

    public function testIsLastWeekFalse()
    {
        $this->assertFalse(Carbon::now()->subWeek(2)->isLastWeek());
    }

    public function testIsNextQuarterTrue()
    {
        $this->assertTrue(Carbon::now()->addQuarter()->isNextQuarter());
    }

    public function testIsLastQuarterTrue()
    {
        $this->assertTrue(Carbon::now()->subQuarter()->isLastQuarter());
    }

    public function testIsNextQuarterFalse()
    {
        $this->assertFalse(Carbon::now()->addQuarters(2)->isNextQuarter());
    }

    public function testIsLastQuarterFalse()
    {
        $this->assertFalse(Carbon::now()->subQuarters(2)->isLastQuarter());
    }

    public function testIsNextMonthTrue()
    {
        $this->assertTrue(Carbon::now()->addMonthNoOverflow()->isNextMonth());
    }

    public function testIsLastMonthTrue()
    {
        $this->assertTrue(Carbon::now()->subMonthNoOverflow()->isLastMonth());
    }

    public function testIsNextMonthFalse()
    {
        $this->assertFalse(Carbon::now()->addMonthsNoOverflow(2)->isNextMonth());
    }

    public function testIsLastMonthFalse()
    {
        $this->assertFalse(Carbon::now()->subMonthsNoOverflow(2)->isLastMonth());
    }

    public function testIsNextYearTrue()
    {
        $this->assertTrue(Carbon::now()->addYear()->isNextYear());
    }

    public function testIsLastYearTrue()
    {
        $this->assertTrue(Carbon::now()->subYear()->isLastYear());
    }

    public function testIsNextYearFalse()
    {
        $this->assertFalse(Carbon::now()->addYear(2)->isNextYear());
    }

    public function testIsLastYearFalse()
    {
        $this->assertFalse(Carbon::now()->subYear(2)->isLastYear());
    }

    public function testIsTodayFalseWithYesterday()
    {
        $this->assertFalse(Carbon::now()->subDay()->endOfDay()->isToday());
    }

    public function testIsTodayFalseWithTomorrow()
    {
        $this->assertFalse(Carbon::now()->addDay()->startOfDay()->isToday());
    }

    public function testIsTodayWithTimezone()
    {
        $this->assertTrue(Carbon::now('Asia/Tokyo')->isToday());
    }

    public function testIsTomorrowTrue()
    {
        $this->assertTrue(Carbon::now()->addDay()->isTomorrow());
    }

    public function testIsTomorrowFalseWithToday()
    {
        $this->assertFalse(Carbon::now()->endOfDay()->isTomorrow());
    }

    public function testIsTomorrowFalseWith2Days()
    {
        $this->assertFalse(Carbon::now()->addDays(2)->startOfDay()->isTomorrow());
    }

    public function testIsFutureTrue()
    {
        $this->assertTrue(Carbon::now()->addSecond()->isFuture());
    }

    public function testIsFutureFalse()
    {
        $this->assertFalse(Carbon::now()->isFuture());
    }

    public function testIsFutureFalseInThePast()
    {
        $this->assertFalse(Carbon::now()->subSecond()->isFuture());
    }

    public function testIsPastTrue()
    {
        $this->assertTrue(Carbon::now()->subSecond()->isPast());
    }

    public function testIsPastFalse()
    {
        $this->assertFalse(Carbon::now()->addSecond()->isPast());
    }

    public function testNowIsPastFalse()
    {
        $this->assertFalse(Carbon::now()->isPast());
    }

    public function testIsLeapYearTrue()
    {
        $this->assertTrue(Carbon::createFromDate(2016, 1, 1)->isLeapYear());
    }

    public function testIsLeapYearFalse()
    {
        $this->assertFalse(Carbon::createFromDate(2014, 1, 1)->isLeapYear());
    }

    public function testIsCurrentYearTrue()
    {
        $this->assertTrue(Carbon::now()->isCurrentYear());
    }

    public function testIsCurrentYearFalse()
    {
        $this->assertFalse(Carbon::now()->subYear()->isCurrentYear());
    }

    public function testIsSameYearTrue()
    {
        $this->assertTrue(Carbon::now()->isSameYear(Carbon::now()));
    }

    public function testIsSameYearFalse()
    {
        $this->assertFalse(Carbon::now()->isSameYear(Carbon::now()->subYear()));
    }

    public function testIsCurrentQuarterTrue()
    {
        $this->assertTrue(Carbon::now()->isCurrentQuarter());
    }

    public function testIsCurrentQuarterFalse()
    {
        $this->assertFalse(Carbon::now()->subQuarter()->isCurrentQuarter());
    }

    public function testIsSameQuarterTrue()
    {
        $this->assertTrue(Carbon::now()->isSameQuarter(Carbon::now()));
    }

    public function testIsSameQuarterTrueWithDateTime()
    {
        $this->assertTrue(Carbon::now()->isSameQuarter(new DateTime()));
    }

    public function testIsSameQuarterFalse()
    {
        $this->assertFalse(Carbon::now()->isSameQuarter(Carbon::now()->subQuarter()));
    }

    public function testIsSameQuarterFalseWithDateTime()
    {
        $dt = new DateTime();
        $dt->modify((Carbon::MONTHS_PER_QUARTER * -1).' month');
        $this->assertFalse(Carbon::now()->isSameQuarter($dt));
    }

    public function testIsSameQuarterAndYearTrue()
    {
        $this->assertTrue(Carbon::now()->isSameQuarter(Carbon::now(), true));
    }

    public function testIsSameQuarterAndYearTrueWithDateTime()
    {
        $this->assertTrue(Carbon::now()->isSameQuarter(new DateTime(), true));
    }

    public function testIsSameQuarterAndYearFalse()
    {
        $this->assertFalse(Carbon::now()->isSameQuarter(Carbon::now()->subYear(), true));
    }

    public function testIsSameQuarterAndYearFalseWithDateTime()
    {
        $dt = new DateTime();
        $dt->modify('-1 year');
        $this->assertFalse(Carbon::now()->isSameQuarter($dt, true));
    }

    public function testIsCurrentMonthTrue()
    {
        $this->assertTrue(Carbon::now()->isCurrentMonth());
        $dt = Carbon::now();
        for ($year = 1990; $year < 2200; $year++) {
            $dt->modify($year.$dt->format('-m-').'01');
            $this->assertTrue($dt->isCurrentMonth());
            $dt->modify($year.$dt->format('-m-').'28');
            $this->assertTrue($dt->isCurrentMonth());
        }

        // Not the same year but the same month.
        $year = '1970';
        $dt->modify($year.$dt->format('-m-').'01');
        $this->assertTrue($dt->isCurrentMonth(false));
        $dt->modify($year.$dt->format('-m-').'28');
        $this->assertTrue($dt->isCurrentMonth(false));
    }

    public function testIsCurrentMonthFalse()
    {
        $this->assertFalse(Carbon::now()->day(15)->subMonth()->isCurrentMonth());

        // Not the same year but the same month.
        $year = '1970';
        $dt = Carbon::now();
        $dt->modify($year.$dt->format('-m-').'01');
        $this->assertFalse($dt->isCurrentMonth(true));
    }

    public function testIsSameMonthTrue()
    {
        $this->assertTrue(Carbon::now()->isSameMonth(Carbon::now()));
        $dt = Carbon::now();
        for ($year = 1990; $year < 2200; $year++) {
            $dt->modify($year.$dt->format('-m-').'01');
            $this->assertTrue(Carbon::now()->isSameMonth($dt));
            $dt->modify($year.$dt->format('-m-').'28');
            $this->assertTrue(Carbon::now()->isSameMonth($dt));
        }
    }

    public function testIsSameMonthTrueWithDateTime()
    {
        $this->assertTrue(Carbon::now()->isSameMonth(new DateTime()));
        $dt = new DateTime();
        for ($year = 1990; $year < 2200; $year++) {
            $dt->modify($year.$dt->format('-m-').'01');
            $this->assertTrue(Carbon::now()->isSameMonth($dt));
            $dt->modify($year.$dt->format('-m-').'28');
            $this->assertTrue(Carbon::now()->isSameMonth($dt));
        }
    }

    public function testIsSameMonthFalse()
    {
        $this->assertFalse(Carbon::now()->isSameMonth(Carbon::now()->day(15)->subMonth()));
    }

    public function testIsSameMonthFalseWithDateTime()
    {
        $dt = new DateTime();
        $dt->modify('-1 month');
        $this->assertFalse(Carbon::now()->isSameMonth($dt));
    }

    public function testIsSameMonthAndYearTrue()
    {
        $this->assertTrue(Carbon::now()->isSameMonth(Carbon::now(), true));
        $dt = Carbon::now();
        $dt->modify($dt->format('Y-m-').'01');
        $this->assertTrue(Carbon::now()->isSameMonth($dt, true));
        $dt->modify($dt->format('Y-m-').'28');
        $this->assertTrue(Carbon::now()->isSameMonth($dt, true));
    }

    public function testIsSameMonthAndYearTrueWithDateTime()
    {
        $this->assertTrue(Carbon::now()->isSameMonth(new DateTime(), true));
        $dt = new DateTime();
        $dt->modify($dt->format('Y-m-').'01');
        $this->assertTrue(Carbon::now()->isSameMonth($dt, true));
        $dt->modify($dt->format('Y-m-').'28');
        $this->assertTrue(Carbon::now()->isSameMonth($dt, true));
    }

    public function testCompareYearWithMonth()
    {
        $this->assertFalse(Carbon::shouldCompareYearWithMonth());
        $this->assertTrue(Carbon::create(2000, 1, 3)->isSameMonth(Carbon::create(2000, 1, 22)));
        $this->assertTrue(Carbon::create(2000, 1, 3)->isSameQuarter(Carbon::create(2000, 1, 22)));
        $this->assertTrue(Carbon::create(2000, 1, 3)->isSameMonth(Carbon::create(2012, 1, 22)));
        $this->assertTrue(Carbon::create(2000, 1, 3)->isSameQuarter(Carbon::create(2012, 1, 22)));
        $this->assertTrue(Carbon::now()->subYear()->isCurrentMonth());
        $this->assertTrue(Carbon::now()->subYear()->isSameQuarter());
        Carbon::compareYearWithMonth();
        $this->assertTrue(Carbon::shouldCompareYearWithMonth());
        $this->assertTrue(Carbon::create(2000, 1, 3)->isSameMonth(Carbon::create(2000, 1, 22)));
        $this->assertTrue(Carbon::create(2000, 1, 3)->isSameQuarter(Carbon::create(2000, 1, 22)));
        $this->assertFalse(Carbon::create(2000, 1, 3)->isSameMonth(Carbon::create(2012, 1, 22)));
        $this->assertFalse(Carbon::create(2000, 1, 3)->isSameQuarter(Carbon::create(2012, 1, 22)));
        $this->assertFalse(Carbon::now()->subYear()->isCurrentMonth());
        $this->assertFalse(Carbon::now()->subYear()->isSameQuarter());
        Carbon::compareYearWithMonth(false);
        $this->assertFalse(Carbon::shouldCompareYearWithMonth());
        $this->assertTrue(Carbon::create(2000, 1, 3)->isSameMonth(Carbon::create(2000, 1, 22)));
        $this->assertTrue(Carbon::create(2000, 1, 3)->isSameQuarter(Carbon::create(2000, 1, 22)));
        $this->assertTrue(Carbon::create(2000, 1, 3)->isSameMonth(Carbon::create(2012, 1, 22)));
        $this->assertTrue(Carbon::create(2000, 1, 3)->isSameQuarter(Carbon::create(2012, 1, 22)));
        $this->assertTrue(Carbon::now()->subYear()->isCurrentMonth());
        $this->assertTrue(Carbon::now()->subYear()->isSameQuarter());
    }

    public function testIsSameMonthAndYearFalse()
    {
        $this->assertFalse(Carbon::now()->isSameMonth(Carbon::now()->subYear(), true));
    }

    public function testIsSameMonthAndYearFalseWithDateTime()
    {
        $dt = new DateTime();
        $dt->modify('-1 year');
        $this->assertFalse(Carbon::now()->isSameMonth($dt, true));
    }

    public function testIsSameDayTrue()
    {
        $current = Carbon::createFromDate(2012, 1, 2);
        $this->assertTrue($current->isSameDay(Carbon::createFromDate(2012, 1, 2)));
        $this->assertTrue($current->isSameDay(Carbon::create(2012, 1, 2, 23, 59, 59)));
    }

    public function testIsSameDayTrueWithDateTime()
    {
        $current = Carbon::createFromDate(2012, 1, 2);
        $this->assertTrue($current->isSameDay(new DateTime('2012-01-02')));
        $this->assertTrue($current->isSameDay(new DateTime('2012-01-02 23:59:59')));
    }

    public function testIsSameDayFalse()
    {
        $current = Carbon::createFromDate(2012, 1, 2);
        $this->assertFalse($current->isSameDay(Carbon::createFromDate(2012, 1, 3)));
        $this->assertFalse($current->isSameDay(Carbon::createFromDate(2012, 6, 2)));
    }

    public function testIsSameDayFalseWithDateTime()
    {
        $current = Carbon::createFromDate(2012, 1, 2);
        $this->assertFalse($current->isSameDay(new DateTime('2012-01-03')));
        $this->assertFalse($current->isSameDay(new DateTime('2012-05-02')));
    }

    public function testIsCurrentDayTrue()
    {
        $this->assertTrue(Carbon::now()->isCurrentDay());
        $this->assertTrue(Carbon::now()->hour(0)->isCurrentDay());
        $this->assertTrue(Carbon::now()->hour(23)->isCurrentDay());
    }

    public function testIsCurrentDayFalse()
    {
        $this->assertFalse(Carbon::now()->subDay()->isCurrentDay());
        $this->assertFalse(Carbon::now()->subMonth()->isCurrentDay());
    }

    public function testIsSameHourTrue()
    {
        $current = Carbon::create(2018, 5, 6, 12);
        $this->assertTrue($current->isSameHour(Carbon::create(2018, 5, 6, 12)));
        $this->assertTrue($current->isSameHour(Carbon::create(2018, 5, 6, 12, 59, 59)));
    }

    public function testIsSameHourTrueWithDateTime()
    {
        $current = Carbon::create(2018, 5, 6, 12);
        $this->assertTrue($current->isSameHour(new DateTime('2018-05-06T12:00:00')));
        $this->assertTrue($current->isSameHour(new DateTime('2018-05-06T12:59:59')));
    }

    public function testIsSameHourFalse()
    {
        $current = Carbon::create(2018, 5, 6, 12);
        $this->assertFalse($current->isSameHour(Carbon::create(2018, 5, 6, 13)));
        $this->assertFalse($current->isSameHour(Carbon::create(2018, 5, 5, 12)));
    }

    public function testIsSameHourFalseWithDateTime()
    {
        $current = Carbon::create(2018, 5, 6, 12);
        $this->assertFalse($current->isSameHour(new DateTime('2018-05-06T13:00:00')));
        $this->assertFalse($current->isSameHour(new DateTime('2018-06-06T12:00:00')));
    }

    public function testIsCurrentHourTrue()
    {
        $this->assertTrue(Carbon::now()->isCurrentHour());
        $this->assertTrue(Carbon::now()->second(1)->isCurrentHour());
        $this->assertTrue(Carbon::now()->second(12)->isCurrentHour());
        $this->assertTrue(Carbon::now()->minute(0)->isCurrentHour());
        $this->assertTrue(Carbon::now()->minute(59)->second(59)->isCurrentHour());
    }

    public function testIsCurrentHourFalse()
    {
        $this->assertFalse(Carbon::now()->subHour()->isCurrentHour());
        $this->assertFalse(Carbon::now()->subDay()->isCurrentHour());
    }

    public function testIsSameMinuteTrue()
    {
        $current = Carbon::create(2018, 5, 6, 12, 30);
        $this->assertTrue($current->isSameMinute(Carbon::create(2018, 5, 6, 12, 30)));
        $current = Carbon::create(2018, 5, 6, 12, 30, 15);
        $this->assertTrue($current->isSameMinute(Carbon::create(2018, 5, 6, 12, 30, 45)));
    }

    public function testIsSameMinuteTrueWithDateTime()
    {
        $current = Carbon::create(2018, 5, 6, 12, 30);
        $this->assertTrue($current->isSameMinute(new DateTime('2018-05-06T12:30:00')));
        $current = Carbon::create(2018, 5, 6, 12, 30, 20);
        $this->assertTrue($current->isSameMinute(new DateTime('2018-05-06T12:30:40')));
    }

    public function testIsSameMinuteFalse()
    {
        $current = Carbon::create(2018, 5, 6, 12, 30);
        $this->assertFalse($current->isSameMinute(Carbon::create(2018, 5, 6, 13, 31)));
        $this->assertFalse($current->isSameMinute(Carbon::create(2019, 5, 6, 13, 30)));
    }

    public function testIsSameMinuteFalseWithDateTime()
    {
        $current = Carbon::create(2018, 5, 6, 12, 30);
        $this->assertFalse($current->isSameMinute(new DateTime('2018-05-06T13:31:00')));
        $this->assertFalse($current->isSameMinute(new DateTime('2018-05-06T17:30:00')));
    }

    public function testIsCurrentMinuteTrue()
    {
        $this->assertTrue(Carbon::now()->isCurrentMinute());
        $this->assertTrue(Carbon::now()->second(0)->isCurrentMinute());
        $this->assertTrue(Carbon::now()->second(59)->isCurrentMinute());
    }

    public function testIsCurrentMinuteFalse()
    {
        $this->assertFalse(Carbon::now()->subMinute()->isCurrentMinute());
        $this->assertFalse(Carbon::now()->subHour()->isCurrentMinute());
    }

    public function testIsSameSecondTrue()
    {
        $current = Carbon::create(2018, 5, 6, 12, 30, 13);
        $other = Carbon::create(2018, 5, 6, 12, 30, 13);
        $this->assertTrue($current->isSameSecond($other));
        $this->assertTrue($current->modify($current->hour.':'.$current->minute.':'.$current->second.'.0')->isSameSecond($other));
        $this->assertTrue($current->modify($current->hour.':'.$current->minute.':'.$current->second.'.999999')->isSameSecond($other));
    }

    public function testIsSameSecondTrueWithDateTime()
    {
        $current = Carbon::create(2018, 5, 6, 12, 30, 13);
        $this->assertTrue($current->isSameSecond(new DateTime('2018-05-06T12:30:13')));
    }

    public function testIsSameSecondFalse()
    {
        $current = Carbon::create(2018, 5, 6, 12, 30, 13);
        $this->assertFalse($current->isSameSecond(Carbon::create(2018, 5, 6, 12, 30, 55)));
        $this->assertFalse($current->isSameSecond(Carbon::create(2018, 5, 6, 14, 30, 13)));
    }

    public function testIsSameSecondFalseWithDateTime()
    {
        $current = Carbon::create(2018, 5, 6, 12, 30, 13);
        $this->assertFalse($current->isSameSecond(new DateTime('2018-05-06T13:30:54')));
        $this->assertFalse($current->isSameSecond(new DateTime('2018-05-06T13:36:13')));
    }

    public function testIsCurrentSecondTrue()
    {
        $this->assertTrue(Carbon::now()->isCurrentSecond());
        $now = Carbon::now();
        $this->assertTrue($now->modify($now->hour.':'.$now->minute.':'.$now->second.'.0')->isCurrentSecond());
        $this->assertTrue($now->modify($now->hour.':'.$now->minute.':'.$now->second.'.999999')->isCurrentSecond());
    }

    public function testIsCurrentSecondFalse()
    {
        $this->assertFalse(Carbon::now()->subSecond()->isCurrentSecond());
        $this->assertFalse(Carbon::now()->subDay()->isCurrentSecond());
    }

    public function testIsDayOfWeek()
    {
        // True in the past past
        $this->assertTrue(Carbon::createFromDate(2015, 5, 31)->isDayOfWeek(0));
        $this->assertTrue(Carbon::createFromDate(2015, 6, 21)->isDayOfWeek(0));
        $this->assertTrue(Carbon::now()->subWeek()->previous(Carbon::SUNDAY)->isDayOfWeek(0));

        // True in the future
        $this->assertTrue(Carbon::now()->addWeek()->previous(Carbon::SUNDAY)->isDayOfWeek(0));
        $this->assertTrue(Carbon::now()->addMonth()->previous(Carbon::SUNDAY)->isDayOfWeek(0));

        // False in the past
        $this->assertFalse(Carbon::now()->subWeek()->previous(Carbon::MONDAY)->isDayOfWeek(0));
        $this->assertFalse(Carbon::now()->subMonth()->previous(Carbon::MONDAY)->isDayOfWeek(0));

        // False in the future
        $this->assertFalse(Carbon::now()->addWeek()->previous(Carbon::MONDAY)->isDayOfWeek(0));
        $this->assertFalse(Carbon::now()->addMonth()->previous(Carbon::MONDAY)->isDayOfWeek(0));
    }

    public function testIsSameAs()
    {
        $current = Carbon::createFromDate(2012, 1, 2);
        $this->assertTrue($current->isSameAs('c', $current));
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testIsSameAsWithInvalidArgument()
    {
        $current = Carbon::createFromDate(2012, 1, 2);
        $current->isSameAs('Y-m-d', 'abc');
    }

    public function testIsSunday()
    {
        // True in the past past
        $this->assertTrue(Carbon::createFromDate(2015, 5, 31)->isSunday());
        $this->assertTrue(Carbon::createFromDate(2015, 6, 21)->isSunday());
        $this->assertTrue(Carbon::now()->subWeek()->previous(Carbon::SUNDAY)->isSunday());

        // True in the future
        $this->assertTrue(Carbon::now()->addWeek()->previous(Carbon::SUNDAY)->isSunday());
        $this->assertTrue(Carbon::now()->addMonth()->previous(Carbon::SUNDAY)->isSunday());

        // False in the past
        $this->assertFalse(Carbon::now()->subWeek()->previous(Carbon::MONDAY)->isSunday());
        $this->assertFalse(Carbon::now()->subMonth()->previous(Carbon::MONDAY)->isSunday());

        // False in the future
        $this->assertFalse(Carbon::now()->addWeek()->previous(Carbon::MONDAY)->isSunday());
        $this->assertFalse(Carbon::now()->addMonth()->previous(Carbon::MONDAY)->isSunday());
    }

    public function testIsMonday()
    {
        // True in the past past
        $this->assertTrue(Carbon::createFromDate(2015, 6, 1)->isMonday());
        $this->assertTrue(Carbon::now()->subWeek()->previous(Carbon::MONDAY)->isMonday());

        // True in the future
        $this->assertTrue(Carbon::now()->addWeek()->previous(Carbon::MONDAY)->isMonday());
        $this->assertTrue(Carbon::now()->addMonth()->previous(Carbon::MONDAY)->isMonday());

        // False in the past
        $this->assertFalse(Carbon::now()->subWeek()->previous(Carbon::TUESDAY)->isMonday());
        $this->assertFalse(Carbon::now()->subMonth()->previous(Carbon::TUESDAY)->isMonday());

        // False in the future
        $this->assertFalse(Carbon::now()->addWeek()->previous(Carbon::TUESDAY)->isMonday());
        $this->assertFalse(Carbon::now()->addMonth()->previous(Carbon::TUESDAY)->isMonday());
    }

    public function testIsTuesday()
    {
        // True in the past past
        $this->assertTrue(Carbon::createFromDate(2015, 6, 2)->isTuesday());
        $this->assertTrue(Carbon::now()->subWeek()->previous(Carbon::TUESDAY)->isTuesday());

        // True in the future
        $this->assertTrue(Carbon::now()->addWeek()->previous(Carbon::TUESDAY)->isTuesday());
        $this->assertTrue(Carbon::now()->addMonth()->previous(Carbon::TUESDAY)->isTuesday());

        // False in the past
        $this->assertFalse(Carbon::now()->subWeek()->previous(Carbon::WEDNESDAY)->isTuesday());
        $this->assertFalse(Carbon::now()->subMonth()->previous(Carbon::WEDNESDAY)->isTuesday());

        // False in the future
        $this->assertFalse(Carbon::now()->addWeek()->previous(Carbon::WEDNESDAY)->isTuesday());
        $this->assertFalse(Carbon::now()->addMonth()->previous(Carbon::WEDNESDAY)->isTuesday());
    }

    public function testIsWednesday()
    {
        // True in the past past
        $this->assertTrue(Carbon::createFromDate(2015, 6, 3)->isWednesday());
        $this->assertTrue(Carbon::now()->subWeek()->previous(Carbon::WEDNESDAY)->isWednesday());

        // True in the future
        $this->assertTrue(Carbon::now()->addWeek()->previous(Carbon::WEDNESDAY)->isWednesday());
        $this->assertTrue(Carbon::now()->addMonth()->previous(Carbon::WEDNESDAY)->isWednesday());

        // False in the past
        $this->assertFalse(Carbon::now()->subWeek()->previous(Carbon::THURSDAY)->isWednesday());
        $this->assertFalse(Carbon::now()->subMonth()->previous(Carbon::THURSDAY)->isWednesday());

        // False in the future
        $this->assertFalse(Carbon::now()->addWeek()->previous(Carbon::THURSDAY)->isWednesday());
        $this->assertFalse(Carbon::now()->addMonth()->previous(Carbon::THURSDAY)->isWednesday());
    }

    public function testIsThursday()
    {
        // True in the past past
        $this->assertTrue(Carbon::createFromDate(2015, 6, 4)->isThursday());
        $this->assertTrue(Carbon::now()->subWeek()->previous(Carbon::THURSDAY)->isThursday());

        // True in the future
        $this->assertTrue(Carbon::now()->addWeek()->previous(Carbon::THURSDAY)->isThursday());
        $this->assertTrue(Carbon::now()->addMonth()->previous(Carbon::THURSDAY)->isThursday());

        // False in the past
        $this->assertFalse(Carbon::now()->subWeek()->previous(Carbon::FRIDAY)->isThursday());
        $this->assertFalse(Carbon::now()->subMonth()->previous(Carbon::FRIDAY)->isThursday());

        // False in the future
        $this->assertFalse(Carbon::now()->addWeek()->previous(Carbon::FRIDAY)->isThursday());
        $this->assertFalse(Carbon::now()->addMonth()->previous(Carbon::FRIDAY)->isThursday());
    }

    public function testIsFriday()
    {
        // True in the past past
        $this->assertTrue(Carbon::createFromDate(2015, 6, 5)->isFriday());
        $this->assertTrue(Carbon::now()->subWeek()->previous(Carbon::FRIDAY)->isFriday());

        // True in the future
        $this->assertTrue(Carbon::now()->addWeek()->previous(Carbon::FRIDAY)->isFriday());
        $this->assertTrue(Carbon::now()->addMonth()->previous(Carbon::FRIDAY)->isFriday());

        // False in the past
        $this->assertFalse(Carbon::now()->subWeek()->previous(Carbon::SATURDAY)->isFriday());
        $this->assertFalse(Carbon::now()->subMonth()->previous(Carbon::SATURDAY)->isFriday());

        // False in the future
        $this->assertFalse(Carbon::now()->addWeek()->previous(Carbon::SATURDAY)->isFriday());
        $this->assertFalse(Carbon::now()->addMonth()->previous(Carbon::SATURDAY)->isFriday());
    }

    public function testIsSaturday()
    {
        // True in the past past
        $this->assertTrue(Carbon::createFromDate(2015, 6, 6)->isSaturday());
        $this->assertTrue(Carbon::now()->subWeek()->previous(Carbon::SATURDAY)->isSaturday());

        // True in the future
        $this->assertTrue(Carbon::now()->addWeek()->previous(Carbon::SATURDAY)->isSaturday());
        $this->assertTrue(Carbon::now()->addMonth()->previous(Carbon::SATURDAY)->isSaturday());

        // False in the past
        $this->assertFalse(Carbon::now()->subWeek()->previous(Carbon::SUNDAY)->isSaturday());
        $this->assertFalse(Carbon::now()->subMonth()->previous(Carbon::SUNDAY)->isSaturday());

        // False in the future
        $this->assertFalse(Carbon::now()->addWeek()->previous(Carbon::SUNDAY)->isSaturday());
        $this->assertFalse(Carbon::now()->addMonth()->previous(Carbon::SUNDAY)->isSaturday());
    }

    public function testIsStartOfDay()
    {
        $this->assertTrue(Carbon::parse('00:00:00')->isStartOfDay());
        $this->assertTrue(Carbon::parse('00:00:00.999999')->isStartOfDay());
        $this->assertTrue(Carbon::now()->startOfDay()->isStartOfDay());

        $this->assertFalse(Carbon::parse('15:30:45')->isStartOfDay());
        $this->assertFalse(Carbon::now()->endOfDay()->isStartOfDay());
    }

    public function testIsStartOfDayWithMicroseconds()
    {
        $this->requirePhpVersion('7.1.8');

        $this->assertTrue(Carbon::parse('00:00:00')->isStartOfDay(true));
        $this->assertTrue(Carbon::now()->startOfDay()->isStartOfDay(true));

        $this->assertFalse(Carbon::parse('00:00:00.000001')->isStartOfDay(true));
    }

    public function testIsEndOfDay()
    {
        $this->assertTrue(Carbon::parse('23:59:59')->isEndOfDay());
        $this->assertTrue(Carbon::parse('23:59:59.000000')->isEndOfDay());
        $this->assertTrue(Carbon::now()->endOfDay()->isEndOfDay());

        $this->assertFalse(Carbon::parse('15:30:45')->isEndOfDay());
        $this->assertFalse(Carbon::now()->startOfDay()->isEndOfDay());
    }

    public function testIsEndOfDayWithMicroseconds()
    {
        $this->requirePhpVersion('7.1.8');

        $this->assertTrue(Carbon::parse('23:59:59.999999')->isEndOfDay(true));
        $this->assertTrue(Carbon::now()->endOfDay()->isEndOfDay(true));

        $this->assertFalse(Carbon::parse('23:59:59')->isEndOfDay(true));
        $this->assertFalse(Carbon::parse('23:59:59.999998')->isEndOfDay(true));
    }

    public function testIsMidnight()
    {
        $this->assertTrue(Carbon::parse('00:00:00')->isMidnight());

        $this->assertFalse(Carbon::parse('15:30:45')->isMidnight());
    }

    public function testIsMidday()
    {
        $this->assertTrue(Carbon::parse('12:00:00')->isMidday());

        $this->assertFalse(Carbon::parse('15:30:45')->isMidday());
    }

    public function testHasFormat()
    {
        $this->assertTrue(Carbon::hasFormat('1975-05-01', 'Y-m-d'));
        $this->assertTrue(Carbon::hasFormat('Sun 21st', 'D jS'));

        // Format failure
        $this->assertFalse(Carbon::hasFormat('1975-05-01', 'd m Y'));
        $this->assertFalse(Carbon::hasFormat('Foo 21st', 'D jS'));
        $this->assertFalse(Carbon::hasFormat('Sun 51st', 'D jS'));
        $this->assertFalse(Carbon::hasFormat('Sun 21xx', 'D jS'));

        // Regex failure
        $this->assertFalse(Carbon::hasFormat('1975-5-1', 'Y-m-d'));
        $this->assertFalse(Carbon::hasFormat('19-05-01', 'Y-m-d'));
    }
}
