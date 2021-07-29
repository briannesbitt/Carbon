<?php
declare(strict_types=1);

/**
 * This file is part of the Carbon package.
 *
 * (c) Brian Nesbitt <brian@nesbot.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Tests\CarbonImmutable;

use Carbon\CarbonImmutable as Carbon;
use Tests\AbstractTestCase;

class DayOfWeekModifiersTest extends AbstractTestCase
{
    public function testGetWeekendDays(): void
    {
        $this->assertSame([Carbon::SATURDAY, Carbon::SUNDAY], Carbon::getWeekendDays());
    }

    public function testSetWeekendDays(): void
    {
        Carbon::setWeekendDays([Carbon::THURSDAY, Carbon::FRIDAY]);
        $this->assertSame([Carbon::THURSDAY, Carbon::FRIDAY], Carbon::getWeekendDays());
        $this->assertTrue(Carbon::createFromDate(2018, 2, 16)->isWeekend());
        Carbon::setWeekendDays([Carbon::SATURDAY, Carbon::SUNDAY]);
        $this->assertSame([Carbon::SATURDAY, Carbon::SUNDAY], Carbon::getWeekendDays());
        $this->assertFalse(Carbon::createFromDate(2018, 2, 16)->isWeekend());
    }

    public function testGetWeekEndsAt(): void
    {
        Carbon::setWeekEndsAt(Carbon::SATURDAY);
        $this->assertSame(Carbon::SATURDAY, Carbon::getWeekEndsAt());
        Carbon::setWeekEndsAt(Carbon::SUNDAY);
    }

    public function testGetWeekStartsAt(): void
    {
        Carbon::setWeekStartsAt(Carbon::TUESDAY);
        $this->assertSame(Carbon::TUESDAY, Carbon::getWeekStartsAt());
        Carbon::setWeekStartsAt(Carbon::MONDAY);
    }

    public function testStartOfWeek(): void
    {
        $d = Carbon::create(1980, 8, 7, 12, 11, 9)->startOfWeek();
        $this->assertCarbon($d, 1980, 8, 4, 0, 0, 0);
    }

    public function testStartOfWeekFromWeekStart(): void
    {
        $d = Carbon::createFromDate(1980, 8, 4)->startOfWeek();
        $this->assertCarbon($d, 1980, 8, 4, 0, 0, 0);
    }

    public function testStartOfWeekCrossingYearBoundary(): void
    {
        $d = Carbon::createFromDate(2013, 12, 31, 'GMT');
        $d2 = $d->startOfWeek();
        $this->assertCarbon($d, 2013, 12, 31);
        $this->assertCarbon($d2, 2013, 12, 30, 0, 0, 0);
    }

    public function testEndOfWeek(): void
    {
        $d = Carbon::create(1980, 8, 7, 11, 12, 13)->endOfWeek();
        $this->assertCarbon($d, 1980, 8, 10, 23, 59, 59);
    }

    public function testEndOfWeekFromWeekEnd(): void
    {
        $d = Carbon::createFromDate(1980, 8, 9)->endOfWeek();
        $this->assertCarbon($d, 1980, 8, 10, 23, 59, 59);
    }

    public function testEndOfWeekCrossingYearBoundary(): void
    {
        $d = Carbon::createFromDate(2013, 12, 31, 'GMT');
        $d2 = $d->endOfWeek();
        $this->assertCarbon($d, 2013, 12, 31);
        $this->assertCarbon($d2, 2014, 1, 5, 23, 59, 59);
    }

    /**
     * @see https://github.com/briannesbitt/Carbon/issues/735
     */
    public function testStartOrEndOfWeekFromWeekWithUTC(): void
    {
        $d = Carbon::create(2016, 7, 27, 17, 13, 7, 'UTC');
        $this->assertCarbon($d->copy()->startOfWeek(), 2016, 7, 25, 0, 0, 0);
        $this->assertCarbon($d->copy()->endOfWeek(), 2016, 7, 31, 23, 59, 59);
    }

    /**
     * @see https://github.com/briannesbitt/Carbon/issues/735
     */
    public function testStartOrEndOfWeekFromWeekWithOtherTimezone(): void
    {
        $d = Carbon::create(2016, 7, 27, 17, 13, 7, 'America/New_York');
        $this->assertCarbon($d->copy()->startOfWeek(), 2016, 7, 25, 0, 0, 0);
        $this->assertCarbon($d->copy()->endOfWeek(), 2016, 7, 31, 23, 59, 59);
    }

    public function testNext(): void
    {
        $d = Carbon::createFromDate(1975, 5, 21)->next();
        $this->assertCarbon($d, 1975, 5, 28, 0, 0, 0);
    }

    public function testNextMonday(): void
    {
        $d = Carbon::createFromDate(1975, 5, 21)->next(Carbon::MONDAY);
        $this->assertCarbon($d, 1975, 5, 26, 0, 0, 0);
    }

    public function testNextSaturday(): void
    {
        $d = Carbon::createFromDate(1975, 5, 21)->next(6);
        $this->assertCarbon($d, 1975, 5, 24, 0, 0, 0);
    }

    public function testNextTimestamp(): void
    {
        $d = Carbon::createFromDate(1975, 11, 14)->next();
        $this->assertCarbon($d, 1975, 11, 21, 0, 0, 0);
    }

    public function testPrevious(): void
    {
        $d = Carbon::createFromDate(1975, 5, 21)->previous();
        $this->assertCarbon($d, 1975, 5, 14, 0, 0, 0);
    }

    public function testPreviousMonday(): void
    {
        $d = Carbon::createFromDate(1975, 5, 21)->previous(Carbon::MONDAY);
        $this->assertCarbon($d, 1975, 5, 19, 0, 0, 0);
    }

    public function testPreviousSaturday(): void
    {
        $d = Carbon::createFromDate(1975, 5, 21)->previous(6);
        $this->assertCarbon($d, 1975, 5, 17, 0, 0, 0);
    }

    public function testPreviousTimestamp(): void
    {
        $d = Carbon::createFromDate(1975, 11, 28)->previous();
        $this->assertCarbon($d, 1975, 11, 21, 0, 0, 0);
    }

    public function testFirstDayOfMonth(): void
    {
        $d = Carbon::createFromDate(1975, 11, 21)->firstOfMonth();
        $this->assertCarbon($d, 1975, 11, 1, 0, 0, 0);
    }

    public function testFirstWednesdayOfMonth(): void
    {
        $d = Carbon::createFromDate(1975, 11, 21)->firstOfMonth(Carbon::WEDNESDAY);
        $this->assertCarbon($d, 1975, 11, 5, 0, 0, 0);
    }

    public function testFirstFridayOfMonth(): void
    {
        $d = Carbon::createFromDate(1975, 11, 21)->firstOfMonth(5);
        $this->assertCarbon($d, 1975, 11, 7, 0, 0, 0);
    }

    public function testLastDayOfMonth(): void
    {
        $d = Carbon::createFromDate(1975, 12, 5)->lastOfMonth();
        $this->assertCarbon($d, 1975, 12, 31, 0, 0, 0);
    }

    public function testLastTuesdayOfMonth(): void
    {
        $d = Carbon::createFromDate(1975, 12, 1)->lastOfMonth(Carbon::TUESDAY);
        $this->assertCarbon($d, 1975, 12, 30, 0, 0, 0);
    }

    public function testLastFridayOfMonth(): void
    {
        $d = Carbon::createFromDate(1975, 12, 5)->lastOfMonth(5);
        $this->assertCarbon($d, 1975, 12, 26, 0, 0, 0);
    }

    public function testNthOfMonthOutsideScope(): void
    {
        $this->assertFalse(Carbon::createFromDate(1975, 12, 5)->nthOfMonth(6, Carbon::MONDAY));
    }

    public function testNthOfMonthOutsideYear(): void
    {
        $this->assertFalse(Carbon::createFromDate(1975, 12, 5)->nthOfMonth(55, Carbon::MONDAY));
    }

    public function test2ndMondayOfMonth(): void
    {
        $d = Carbon::createFromDate(1975, 12, 5)->nthOfMonth(2, Carbon::MONDAY);
        $this->assertCarbon($d, 1975, 12, 8, 0, 0, 0);
    }

    public function test3rdWednesdayOfMonth(): void
    {
        $d = Carbon::createFromDate(1975, 12, 5)->nthOfMonth(3, 3);
        $this->assertCarbon($d, 1975, 12, 17, 0, 0, 0);
    }

    public function testFirstDayOfQuarter(): void
    {
        $d = Carbon::createFromDate(1975, 11, 21)->firstOfQuarter();
        $this->assertCarbon($d, 1975, 10, 1, 0, 0, 0);
    }

    public function testFirstWednesdayOfQuarter(): void
    {
        $d = Carbon::createFromDate(1975, 11, 21)->firstOfQuarter(Carbon::WEDNESDAY);
        $this->assertCarbon($d, 1975, 10, 1, 0, 0, 0);
    }

    public function testFirstFridayOfQuarter(): void
    {
        $d = Carbon::createFromDate(1975, 11, 21)->firstOfQuarter(5);
        $this->assertCarbon($d, 1975, 10, 3, 0, 0, 0);
    }

    public function testFirstOfQuarterFromADayThatWillNotExistInTheFirstMonth(): void
    {
        $d = Carbon::createFromDate(2014, 5, 31)->firstOfQuarter();
        $this->assertCarbon($d, 2014, 4, 1, 0, 0, 0);
    }

    public function testLastDayOfQuarter(): void
    {
        $d = Carbon::createFromDate(1975, 8, 5)->lastOfQuarter();
        $this->assertCarbon($d, 1975, 9, 30, 0, 0, 0);
    }

    public function testLastTuesdayOfQuarter(): void
    {
        $d = Carbon::createFromDate(1975, 8, 1)->lastOfQuarter(Carbon::TUESDAY);
        $this->assertCarbon($d, 1975, 9, 30, 0, 0, 0);
    }

    public function testLastFridayOfQuarter(): void
    {
        $d = Carbon::createFromDate(1975, 7, 5)->lastOfQuarter(5);
        $this->assertCarbon($d, 1975, 9, 26, 0, 0, 0);
    }

    public function testLastOfQuarterFromADayThatWillNotExistInTheLastMonth(): void
    {
        $d = Carbon::createFromDate(2014, 5, 31)->lastOfQuarter();
        $this->assertCarbon($d, 2014, 6, 30, 0, 0, 0);
    }

    public function testNthOfQuarterOutsideScope(): void
    {
        $this->assertFalse(Carbon::createFromDate(1975, 1, 5)->nthOfQuarter(20, Carbon::MONDAY));
    }

    public function testNthOfQuarterOutsideYear(): void
    {
        $this->assertFalse(Carbon::createFromDate(1975, 1, 5)->nthOfQuarter(55, Carbon::MONDAY));
    }

    public function testNthOfQuarterFromADayThatWillNotExistInTheFirstMonth(): void
    {
        $d = Carbon::createFromDate(2014, 5, 31)->nthOfQuarter(2, Carbon::MONDAY);
        $this->assertCarbon($d, 2014, 4, 14, 0, 0, 0);
    }

    public function test2ndMondayOfQuarter(): void
    {
        $d = Carbon::createFromDate(1975, 8, 5)->nthOfQuarter(2, Carbon::MONDAY);
        $this->assertCarbon($d, 1975, 7, 14, 0, 0, 0);
    }

    public function test3rdWednesdayOfQuarter(): void
    {
        $d = Carbon::createFromDate(1975, 8, 5)->nthOfQuarter(3, 3);
        $this->assertCarbon($d, 1975, 7, 16, 0, 0, 0);
    }

    public function testFirstDayOfYear(): void
    {
        $d = Carbon::createFromDate(1975, 11, 21)->firstOfYear();
        $this->assertCarbon($d, 1975, 1, 1, 0, 0, 0);
    }

    public function testFirstWednesdayOfYear(): void
    {
        $d = Carbon::createFromDate(1975, 11, 21)->firstOfYear(Carbon::WEDNESDAY);
        $this->assertCarbon($d, 1975, 1, 1, 0, 0, 0);
    }

    public function testFirstFridayOfYear(): void
    {
        $d = Carbon::createFromDate(1975, 11, 21)->firstOfYear(5);
        $this->assertCarbon($d, 1975, 1, 3, 0, 0, 0);
    }

    public function testLastDayOfYear(): void
    {
        $d = Carbon::createFromDate(1975, 8, 5)->lastOfYear();
        $this->assertCarbon($d, 1975, 12, 31, 0, 0, 0);
    }

    public function testLastTuesdayOfYear(): void
    {
        $d = Carbon::createFromDate(1975, 8, 1)->lastOfYear(Carbon::TUESDAY);
        $this->assertCarbon($d, 1975, 12, 30, 0, 0, 0);
    }

    public function testLastFridayOfYear(): void
    {
        $d = Carbon::createFromDate(1975, 7, 5)->lastOfYear(5);
        $this->assertCarbon($d, 1975, 12, 26, 0, 0, 0);
    }

    public function testNthOfYearOutsideScope(): void
    {
        $this->assertFalse(Carbon::createFromDate(1975, 1, 5)->nthOfYear(55, Carbon::MONDAY));
    }

    public function test2ndMondayOfYear(): void
    {
        $d = Carbon::createFromDate(1975, 8, 5)->nthOfYear(2, Carbon::MONDAY);
        $this->assertCarbon($d, 1975, 1, 13, 0, 0, 0);
    }

    public function test3rdWednesdayOfYear(): void
    {
        $d = Carbon::createFromDate(1975, 8, 5)->nthOfYear(3, 3);
        $this->assertCarbon($d, 1975, 1, 15, 0, 0, 0);
    }

    public function testNextWeekday(): void
    {
        // Friday to Monday
        $d = Carbon::create(2016, 7, 15)->nextWeekday();
        $this->assertCarbon($d, 2016, 7, 18);

        // Saturday to Monday
        $d = Carbon::create(2016, 7, 16)->nextWeekday();
        $this->assertCarbon($d, 2016, 7, 18);

        // Sunday to Monday
        $d = Carbon::create(2016, 7, 16)->nextWeekday();
        $this->assertCarbon($d, 2016, 7, 18);

        // Monday to Tuesday
        $d = Carbon::create(2016, 7, 17)->nextWeekday();
        $this->assertCarbon($d, 2016, 7, 18);
    }

    public function testPreviousWeekday(): void
    {
        // Tuesday to Monday
        $d = Carbon::create(2016, 7, 19)->previousWeekday();
        $this->assertCarbon($d, 2016, 7, 18);

        // Monday to Friday
        $d = Carbon::create(2016, 7, 18)->previousWeekday();
        $this->assertCarbon($d, 2016, 7, 15);

        // Sunday to Friday
        $d = Carbon::create(2016, 7, 17)->previousWeekday();
        $this->assertCarbon($d, 2016, 7, 15);

        // Saturday to Friday
        $d = Carbon::create(2016, 7, 16)->previousWeekday();
        $this->assertCarbon($d, 2016, 7, 15);
    }

    public function testNextWeekendDay(): void
    {
        // Thursday to Saturday
        $d = Carbon::create(2016, 7, 14)->nextWeekendDay();
        $this->assertCarbon($d, 2016, 7, 16);

        // Friday to Saturday
        $d = Carbon::create(2016, 7, 15)->nextWeekendDay();
        $this->assertCarbon($d, 2016, 7, 16);

        // Saturday to Sunday
        $d = Carbon::create(2016, 7, 16)->nextWeekendDay();
        $this->assertCarbon($d, 2016, 7, 17);

        // Sunday to Saturday
        $d = Carbon::create(2016, 7, 17)->nextWeekendDay();
        $this->assertCarbon($d, 2016, 7, 23);
    }

    public function testPreviousWeekendDay(): void
    {
        // Thursday to Sunday
        $d = Carbon::create(2016, 7, 14)->previousWeekendDay();
        $this->assertCarbon($d, 2016, 7, 10);

        // Friday to Sunday
        $d = Carbon::create(2016, 7, 15)->previousWeekendDay();
        $this->assertCarbon($d, 2016, 7, 10);

        // Saturday to Sunday
        $d = Carbon::create(2016, 7, 16)->previousWeekendDay();
        $this->assertCarbon($d, 2016, 7, 10);

        // Sunday to Saturday
        $d = Carbon::create(2016, 7, 17)->previousWeekendDay();
        $this->assertCarbon($d, 2016, 7, 16);
    }

    public function testWeekStartAndEndWithAutoMode(): void
    {
        $this->assertSame('Monday', Carbon::now()->startOfWeek()->dayName);

        Carbon::setWeekStartsAt('auto');

        $this->assertSame('Sunday', Carbon::now()->startOfWeek()->dayName);
        Carbon::setLocale('en_UM');
        $this->assertSame('Sunday', Carbon::now()->startOfWeek()->dayName);
        Carbon::setLocale('en_US');
        $this->assertSame('Sunday', Carbon::now()->startOfWeek()->dayName);
        Carbon::setLocale('en');
        $this->assertSame('Sunday', Carbon::now()->startOfWeek()->dayName);
        Carbon::setLocale('es_US');
        $this->assertSame('domingo', Carbon::now()->startOfWeek()->dayName);
        Carbon::setLocale('en_GB');
        $this->assertSame('Monday', Carbon::now()->startOfWeek()->dayName);

        Carbon::setWeekEndsAt('auto');

        Carbon::setLocale('en_UM');
        $this->assertSame('Saturday', Carbon::now()->endOfWeek()->dayName);
        Carbon::setLocale('en_US');
        $this->assertSame('Saturday', Carbon::now()->endOfWeek()->dayName);
        Carbon::setLocale('en');
        $this->assertSame('Saturday', Carbon::now()->endOfWeek()->dayName);
        Carbon::setLocale('es_US');
        $this->assertSame('sábado', Carbon::now()->endOfWeek()->dayName);
        Carbon::setLocale('en_GB');
        $this->assertSame('Sunday', Carbon::now()->endOfWeek()->dayName);

        Carbon::setWeekStartsAt(Carbon::MONDAY);
        Carbon::setWeekEndsAt(Carbon::SUNDAY);
    }
}
