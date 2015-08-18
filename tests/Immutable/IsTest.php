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

class IsTest extends TestFixture
{

    public function testIsWeekdayTrue()
    {
        $this->assertTrue(CarbonImmutable::createFromDate(2012, 1, 2)->isWeekday());
    }

    public function testIsWeekdayFalse()
    {
        $this->assertFalse(CarbonImmutable::createFromDate(2012, 1, 1)->isWeekday());
    }

    public function testIsWeekendTrue()
    {
        $this->assertTrue(CarbonImmutable::createFromDate(2012, 1, 1)->isWeekend());
    }

    public function testIsWeekendFalse()
    {
        $this->assertFalse(CarbonImmutable::createFromDate(2012, 1, 2)->isWeekend());
    }

    public function testIsYesterdayTrue()
    {
        $this->assertTrue(CarbonImmutable::now()->subDay()->isYesterday());
    }

    public function testIsYesterdayFalseWithToday()
    {
        $this->assertFalse(CarbonImmutable::now()->endOfDay()->isYesterday());
    }

    public function testIsYesterdayFalseWith2Days()
    {
        $this->assertFalse(CarbonImmutable::now()->subDays(2)->startOfDay()->isYesterday());
    }

    public function testIsTodayTrue()
    {
        $this->assertTrue(CarbonImmutable::now()->isToday());
    }

    public function testIsTodayFalseWithYesterday()
    {
        $this->assertFalse(CarbonImmutable::now()->subDay()->endOfDay()->isToday());
    }

    public function testIsTodayFalseWithTomorrow()
    {
        $this->assertFalse(CarbonImmutable::now()->addDay()->startOfDay()->isToday());
    }

    public function testIsTodayWithTimezone()
    {
        $this->assertTrue(CarbonImmutable::now('Asia/Tokyo')->isToday());
    }

    public function testIsTomorrowTrue()
    {
        $this->assertTrue(CarbonImmutable::now()->addDay()->isTomorrow());
    }

    public function testIsTomorrowFalseWithToday()
    {
        $this->assertFalse(CarbonImmutable::now()->endOfDay()->isTomorrow());
    }

    public function testIsTomorrowFalseWith2Days()
    {
        $this->assertFalse(CarbonImmutable::now()->addDays(2)->startOfDay()->isTomorrow());
    }

    public function testIsFutureTrue()
    {
        $this->assertTrue(CarbonImmutable::now()->addSecond()->isFuture());
    }

    public function testIsFutureFalse()
    {
        $this->assertFalse(CarbonImmutable::now()->isFuture());
    }

    public function testIsFutureFalseInThePast()
    {
        $this->assertFalse(CarbonImmutable::now()->subSecond()->isFuture());
    }

    public function testIsPastTrue()
    {
        $this->assertTrue(CarbonImmutable::now()->subSecond()->isPast());
    }

    public function testIsPastFalse()
    {
        $this->assertFalse(CarbonImmutable::now()->addSecond()->isPast());
        $this->assertFalse(CarbonImmutable::now()->isPast());
    }

    public function testIsLeapYearTrue()
    {
        $this->assertTrue(CarbonImmutable::createFromDate(2016, 1, 1)->isLeapYear());
    }

    public function testIsLeapYearFalse()
    {
        $this->assertFalse(CarbonImmutable::createFromDate(2014, 1, 1)->isLeapYear());
    }

    public function testIsSameDayTrue()
    {
        $current = CarbonImmutable::createFromDate(2012, 1, 2);
        $this->assertTrue($current->isSameDay(CarbonImmutable::createFromDate(2012, 1, 2)));
    }

    public function testIsSameDayFalse()
    {
        $current = CarbonImmutable::createFromDate(2012, 1, 2);
        $this->assertFalse($current->isSameDay(CarbonImmutable::createFromDate(2012, 1, 3)));
    }

    public function testIsSunday()
    {
        // True in the past past
        $this->assertTrue(CarbonImmutable::createFromDate(2015, 5, 31)->isSunday());
        $this->assertTrue(CarbonImmutable::createFromDate(2015, 6, 21)->isSunday());
        $this->assertTrue(CarbonImmutable::now()->subWeek()->previous(CarbonImmutable::SUNDAY)->isSunday());

        // True in the future
        $this->assertTrue(CarbonImmutable::now()->addWeek()->previous(CarbonImmutable::SUNDAY)->isSunday());
        $this->assertTrue(CarbonImmutable::now()->addMonth()->previous(CarbonImmutable::SUNDAY)->isSunday());

        // False in the past
        $this->assertFalse(CarbonImmutable::now()->subWeek()->previous(CarbonImmutable::MONDAY)->isSunday());
        $this->assertFalse(CarbonImmutable::now()->subMonth()->previous(CarbonImmutable::MONDAY)->isSunday());

        // False in the future
        $this->assertFalse(CarbonImmutable::now()->addWeek()->previous(CarbonImmutable::MONDAY)->isSunday());
        $this->assertFalse(CarbonImmutable::now()->addMonth()->previous(CarbonImmutable::MONDAY)->isSunday());
    }

    public function testIsMonday()
    {
        // True in the past past
        $this->assertTrue(CarbonImmutable::createFromDate(2015, 6, 1)->isMonday());
        $this->assertTrue(CarbonImmutable::now()->subWeek()->previous(CarbonImmutable::MONDAY)->isMonday());

        // True in the future
        $this->assertTrue(CarbonImmutable::now()->addWeek()->previous(CarbonImmutable::MONDAY)->isMonday());
        $this->assertTrue(CarbonImmutable::now()->addMonth()->previous(CarbonImmutable::MONDAY)->isMonday());

        // False in the past
        $this->assertFalse(CarbonImmutable::now()->subWeek()->previous(CarbonImmutable::TUESDAY)->isMonday());
        $this->assertFalse(CarbonImmutable::now()->subMonth()->previous(CarbonImmutable::TUESDAY)->isMonday());

        // False in the future
        $this->assertFalse(CarbonImmutable::now()->addWeek()->previous(CarbonImmutable::TUESDAY)->isMonday());
        $this->assertFalse(CarbonImmutable::now()->addMonth()->previous(CarbonImmutable::TUESDAY)->isMonday());
    }

    public function testIsTuesday()
    {
        // True in the past past
        $this->assertTrue(CarbonImmutable::createFromDate(2015, 6, 2)->isTuesday());
        $this->assertTrue(CarbonImmutable::now()->subWeek()->previous(CarbonImmutable::TUESDAY)->isTuesday());

        // True in the future
        $this->assertTrue(CarbonImmutable::now()->addWeek()->previous(CarbonImmutable::TUESDAY)->isTuesday());
        $this->assertTrue(CarbonImmutable::now()->addMonth()->previous(CarbonImmutable::TUESDAY)->isTuesday());

        // False in the past
        $this->assertFalse(CarbonImmutable::now()->subWeek()->previous(CarbonImmutable::WEDNESDAY)->isTuesday());
        $this->assertFalse(CarbonImmutable::now()->subMonth()->previous(CarbonImmutable::WEDNESDAY)->isTuesday());

        // False in the future
        $this->assertFalse(CarbonImmutable::now()->addWeek()->previous(CarbonImmutable::WEDNESDAY)->isTuesday());
        $this->assertFalse(CarbonImmutable::now()->addMonth()->previous(CarbonImmutable::WEDNESDAY)->isTuesday());
    }

    public function testIsWednesday()
    {
        // True in the past past
        $this->assertTrue(CarbonImmutable::createFromDate(2015, 6, 3)->isWednesday());
        $this->assertTrue(CarbonImmutable::now()->subWeek()->previous(CarbonImmutable::WEDNESDAY)->isWednesday());

        // True in the future
        $this->assertTrue(CarbonImmutable::now()->addWeek()->previous(CarbonImmutable::WEDNESDAY)->isWednesday());
        $this->assertTrue(CarbonImmutable::now()->addMonth()->previous(CarbonImmutable::WEDNESDAY)->isWednesday());

        // False in the past
        $this->assertFalse(CarbonImmutable::now()->subWeek()->previous(CarbonImmutable::THURSDAY)->isWednesday());
        $this->assertFalse(CarbonImmutable::now()->subMonth()->previous(CarbonImmutable::THURSDAY)->isWednesday());

        // False in the future
        $this->assertFalse(CarbonImmutable::now()->addWeek()->previous(CarbonImmutable::THURSDAY)->isWednesday());
        $this->assertFalse(CarbonImmutable::now()->addMonth()->previous(CarbonImmutable::THURSDAY)->isWednesday());
    }

    public function testIsThursday()
    {
        // True in the past past
        $this->assertTrue(CarbonImmutable::createFromDate(2015, 6, 4)->isThursday());
        $this->assertTrue(CarbonImmutable::now()->subWeek()->previous(CarbonImmutable::THURSDAY)->isThursday());

        // True in the future
        $this->assertTrue(CarbonImmutable::now()->addWeek()->previous(CarbonImmutable::THURSDAY)->isThursday());
        $this->assertTrue(CarbonImmutable::now()->addMonth()->previous(CarbonImmutable::THURSDAY)->isThursday());

        // False in the past
        $this->assertFalse(CarbonImmutable::now()->subWeek()->previous(CarbonImmutable::FRIDAY)->isThursday());
        $this->assertFalse(CarbonImmutable::now()->subMonth()->previous(CarbonImmutable::FRIDAY)->isThursday());

        // False in the future
        $this->assertFalse(CarbonImmutable::now()->addWeek()->previous(CarbonImmutable::FRIDAY)->isThursday());
        $this->assertFalse(CarbonImmutable::now()->addMonth()->previous(CarbonImmutable::FRIDAY)->isThursday());
    }

    public function testIsFriday()
    {
        // True in the past past
        $this->assertTrue(CarbonImmutable::createFromDate(2015, 6, 5)->isFriday());
        $this->assertTrue(CarbonImmutable::now()->subWeek()->previous(CarbonImmutable::FRIDAY)->isFriday());

        // True in the future
        $this->assertTrue(CarbonImmutable::now()->addWeek()->previous(CarbonImmutable::FRIDAY)->isFriday());
        $this->assertTrue(CarbonImmutable::now()->addMonth()->previous(CarbonImmutable::FRIDAY)->isFriday());

        // False in the past
        $this->assertFalse(CarbonImmutable::now()->subWeek()->previous(CarbonImmutable::SATURDAY)->isFriday());
        $this->assertFalse(CarbonImmutable::now()->subMonth()->previous(CarbonImmutable::SATURDAY)->isFriday());

        // False in the future
        $this->assertFalse(CarbonImmutable::now()->addWeek()->previous(CarbonImmutable::SATURDAY)->isFriday());
        $this->assertFalse(CarbonImmutable::now()->addMonth()->previous(CarbonImmutable::SATURDAY)->isFriday());
    }

    public function testIsSaturday()
    {
        // True in the past past
        $this->assertTrue(CarbonImmutable::createFromDate(2015, 6, 6)->isSaturday());
        $this->assertTrue(CarbonImmutable::now()->subWeek()->previous(CarbonImmutable::SATURDAY)->isSaturday());

        // True in the future
        $this->assertTrue(CarbonImmutable::now()->addWeek()->previous(CarbonImmutable::SATURDAY)->isSaturday());
        $this->assertTrue(CarbonImmutable::now()->addMonth()->previous(CarbonImmutable::SATURDAY)->isSaturday());

        // False in the past
        $this->assertFalse(CarbonImmutable::now()->subWeek()->previous(CarbonImmutable::SUNDAY)->isSaturday());
        $this->assertFalse(CarbonImmutable::now()->subMonth()->previous(CarbonImmutable::SUNDAY)->isSaturday());

        // False in the future
        $this->assertFalse(CarbonImmutable::now()->addWeek()->previous(CarbonImmutable::SUNDAY)->isSaturday());
        $this->assertFalse(CarbonImmutable::now()->addMonth()->previous(CarbonImmutable::SUNDAY)->isSaturday());
    }
}
