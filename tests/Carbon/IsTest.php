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

    public function testIsCurrentMonthTrue()
    {
        $this->assertTrue(Carbon::now()->isCurrentMonth());
    }

    public function testIsCurrentMonthFalse()
    {
        $this->assertFalse(Carbon::now()->subMonth()->isCurrentMonth());
    }

    public function testIsSameMonthTrue()
    {
        $this->assertTrue(Carbon::now()->isSameMonth(Carbon::now()));
    }

    public function testIsSameMonthTrueWithDateTime()
    {
        $this->assertTrue(Carbon::now()->isSameMonth(new DateTime()));
    }

    public function testIsSameMonthFalse()
    {
        $this->assertFalse(Carbon::now()->isSameMonth(Carbon::now()->subMonth()));
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
    }

    public function testIsSameMonthAndYearTrueWithDateTime()
    {
        $this->assertTrue(Carbon::now()->isSameMonth(new DateTime(), true));
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
    }

    public function T_testIsSameDayTrueWithDateTime()
    {
        $current = Carbon::createFromDate(2012, 1, 2);
        $this->assertTrue($current->isSameDay(new DateTime('2012-01-02')));
    }

    public function testIsSameDayFalse()
    {
        $current = Carbon::createFromDate(2012, 1, 2);
        $this->assertFalse($current->isSameDay(Carbon::createFromDate(2012, 1, 3)));
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

    public function testIsSameDayFalseWithDateTime()
    {
        $current = Carbon::createFromDate(2012, 1, 2);
        $this->assertFalse($current->isSameDay(new DateTime('2012-01-03')));
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
    }
}
