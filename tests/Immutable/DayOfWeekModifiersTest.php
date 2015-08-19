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

class DayOfWeekModifiersTest extends TestFixture
{

    public function testStartOfWeek()
    {
        $d = CarbonImmutable::create(1980, 8, 7, 12, 11, 9)->startOfWeek();
        $this->assertCarbonImmutable($d, 1980, 8, 4, 0, 0, 0);
    }

    public function testStartOfWeekFromWeekStart()
    {
        $d = CarbonImmutable::createFromDate(1980, 8, 4)->startOfWeek();
        $this->assertCarbonImmutable($d, 1980, 8, 4, 0, 0, 0);
    }

    public function testStartOfWeekCrossingYearBoundary()
    {
        $d = CarbonImmutable::createFromDate(2013, 12, 31, 'GMT');
        $d = $d->startOfWeek();
        $this->assertCarbonImmutable($d, 2013, 12, 30, 0, 0, 0);
    }

    public function testEndOfWeek()
    {
        $d = CarbonImmutable::create(1980, 8, 7, 11, 12, 13)->endOfWeek();
        $this->assertCarbonImmutable($d, 1980, 8, 10, 23, 59, 59);
    }

    public function testEndOfWeekFromWeekEnd()
    {
        $d = CarbonImmutable::createFromDate(1980, 8, 9)->endOfWeek();
        $this->assertCarbonImmutable($d, 1980, 8, 10, 23, 59, 59);
    }

    public function testEndOfWeekCrossingYearBoundary()
    {
        $d = CarbonImmutable::createFromDate(2013, 12, 31, 'GMT');
        $d = $d->endOfWeek();
        $this->assertCarbonImmutable($d, 2014, 1, 5, 23, 59, 59);
    }

    public function testNext()
    {
        $d = CarbonImmutable::createFromDate(1975, 5, 21)->next();
        $this->assertCarbonImmutable($d, 1975, 5, 28, 0, 0, 0);
    }

    public function testNextMonday()
    {
        $d = CarbonImmutable::createFromDate(1975, 5, 21)->next(CarbonImmutable::MONDAY);
        $this->assertCarbonImmutable($d, 1975, 5, 26, 0, 0, 0);
    }

    public function testNextSaturday()
    {
        $d = CarbonImmutable::createFromDate(1975, 5, 21)->next(6);
        $this->assertCarbonImmutable($d, 1975, 5, 24, 0, 0, 0);
    }

    public function testNextTimestamp()
    {
        $d = CarbonImmutable::createFromDate(1975, 11, 14)->next();
        $this->assertCarbonImmutable($d, 1975, 11, 21, 0, 0, 0);
    }

    public function testPrevious()
    {
        $d = CarbonImmutable::createFromDate(1975, 5, 21)->previous();
        $this->assertCarbonImmutable($d, 1975, 5, 14, 0, 0, 0);
    }

    public function testPreviousMonday()
    {
        $d = CarbonImmutable::createFromDate(1975, 5, 21)->previous(CarbonImmutable::MONDAY);
        $this->assertCarbonImmutable($d, 1975, 5, 19, 0, 0, 0);
    }

    public function testPreviousSaturday()
    {
        $d = CarbonImmutable::createFromDate(1975, 5, 21)->previous(6);
        $this->assertCarbonImmutable($d, 1975, 5, 17, 0, 0, 0);
    }

    public function testPreviousTimestamp()
    {
        $d = CarbonImmutable::createFromDate(1975, 11, 28)->previous();
        $this->assertCarbonImmutable($d, 1975, 11, 21, 0, 0, 0);
    }

    public function testFirstDayOfMonth()
    {
        $d = CarbonImmutable::createFromDate(1975, 11, 21)->firstOfMonth();
        $this->assertCarbonImmutable($d, 1975, 11, 1, 0, 0, 0);
    }

    public function testFirstWednesdayOfMonth()
    {
        $d = CarbonImmutable::createFromDate(1975, 11, 21)->firstOfMonth(CarbonImmutable::WEDNESDAY);
        $this->assertCarbonImmutable($d, 1975, 11, 5, 0, 0, 0);
    }

    public function testFirstFridayOfMonth()
    {
        $d = CarbonImmutable::createFromDate(1975, 11, 21)->firstOfMonth(5);
        $this->assertCarbonImmutable($d, 1975, 11, 7, 0, 0, 0);
    }

    public function testLastDayOfMonth()
    {
        $d = CarbonImmutable::createFromDate(1975, 12, 5)->lastOfMonth();
        $this->assertCarbonImmutable($d, 1975, 12, 31, 0, 0, 0);
    }

    public function testLastTuesdayOfMonth()
    {
        $d = CarbonImmutable::createFromDate(1975, 12, 1)->lastOfMonth(CarbonImmutable::TUESDAY);
        $this->assertCarbonImmutable($d, 1975, 12, 30, 0, 0, 0);
    }

    public function testLastFridayOfMonth()
    {
        $d = CarbonImmutable::createFromDate(1975, 12, 5)->lastOfMonth(5);
        $this->assertCarbonImmutable($d, 1975, 12, 26, 0, 0, 0);
    }

    public function testNthOfMonthOutsideScope()
    {
        $this->assertFalse(CarbonImmutable::createFromDate(1975, 12, 5)->nthOfMonth(6, CarbonImmutable::MONDAY));
    }

    public function testNthOfMonthOutsideYear()
    {
        $this->assertFalse(CarbonImmutable::createFromDate(1975, 12, 5)->nthOfMonth(55, CarbonImmutable::MONDAY));
    }

    public function test2ndMondayOfMonth()
    {
        $d = CarbonImmutable::createFromDate(1975, 12, 5)->nthOfMonth(2, CarbonImmutable::MONDAY);
        $this->assertCarbonImmutable($d, 1975, 12, 8, 0, 0, 0);
    }

    public function test3rdWednesdayOfMonth()
    {
        $d = CarbonImmutable::createFromDate(1975, 12, 5)->nthOfMonth(3, 3);
        $this->assertCarbonImmutable($d, 1975, 12, 17, 0, 0, 0);
    }

    public function testFirstDayOfQuarter()
    {
        $d = CarbonImmutable::createFromDate(1975, 11, 21)->firstOfQuarter();
        $this->assertCarbonImmutable($d, 1975, 10, 1, 0, 0, 0);
    }

    public function testFirstWednesdayOfQuarter()
    {
        $d = CarbonImmutable::createFromDate(1975, 11, 21)->firstOfQuarter(CarbonImmutable::WEDNESDAY);
        $this->assertCarbonImmutable($d, 1975, 10, 1, 0, 0, 0);
    }

    public function testFirstFridayOfQuarter()
    {
        $d = CarbonImmutable::createFromDate(1975, 11, 21)->firstOfQuarter(5);
        $this->assertCarbonImmutable($d, 1975, 10, 3, 0, 0, 0);
    }

    public function testFirstOfQuarterFromADayThatWillNotExistIntheFirstMonth()
    {
        $d = CarbonImmutable::createFromDate(2014, 5, 31)->firstOfQuarter();
        $this->assertCarbonImmutable($d, 2014, 4, 1, 0, 0, 0);
    }

    public function testLastDayOfQuarter()
    {
        $d = CarbonImmutable::createFromDate(1975, 8, 5)->lastOfQuarter();
        $this->assertCarbonImmutable($d, 1975, 9, 30, 0, 0, 0);
    }

    public function testLastTuesdayOfQuarter()
    {
        $d = CarbonImmutable::createFromDate(1975, 8, 1)->lastOfQuarter(CarbonImmutable::TUESDAY);
        $this->assertCarbonImmutable($d, 1975, 9, 30, 0, 0, 0);
    }

    public function testLastFridayOfQuarter()
    {
        $d = CarbonImmutable::createFromDate(1975, 7, 5)->lastOfQuarter(5);
        $this->assertCarbonImmutable($d, 1975, 9, 26, 0, 0, 0);
    }

    public function testLastOfQuarterFromADayThatWillNotExistIntheLastMonth()
    {
        $d = CarbonImmutable::createFromDate(2014, 5, 31)->lastOfQuarter();
        $this->assertCarbonImmutable($d, 2014, 6, 30, 0, 0, 0);
    }

    public function testNthOfQuarterOutsideScope()
    {
        $this->assertFalse(CarbonImmutable::createFromDate(1975, 1, 5)->nthOfQuarter(20, CarbonImmutable::MONDAY));
    }

    public function testNthOfQuarterOutsideYear()
    {
        $this->assertFalse(CarbonImmutable::createFromDate(1975, 1, 5)->nthOfQuarter(55, CarbonImmutable::MONDAY));
    }

    public function testNthOfQuarterFromADayThatWillNotExistIntheFirstMonth()
    {
        $d = CarbonImmutable::createFromDate(2014, 5, 31)->nthOfQuarter(2, CarbonImmutable::MONDAY);
        $this->assertCarbonImmutable($d, 2014, 4, 14, 0, 0, 0);
    }

    public function test2ndMondayOfQuarter()
    {
        $d = CarbonImmutable::createFromDate(1975, 8, 5)->nthOfQuarter(2, CarbonImmutable::MONDAY);
        $this->assertCarbonImmutable($d, 1975, 7, 14, 0, 0, 0);
    }

    public function test3rdWednesdayOfQuarter()
    {
        $d = CarbonImmutable::createFromDate(1975, 8, 5)->nthOfQuarter(3, 3);
        $this->assertCarbonImmutable($d, 1975, 7, 16, 0, 0, 0);
    }

    public function testFirstDayOfYear()
    {
        $d = CarbonImmutable::createFromDate(1975, 11, 21)->firstOfYear();
        $this->assertCarbonImmutable($d, 1975, 1, 1, 0, 0, 0);
    }

    public function testFirstWednesdayOfYear()
    {
        $d = CarbonImmutable::createFromDate(1975, 11, 21)->firstOfYear(CarbonImmutable::WEDNESDAY);
        $this->assertCarbonImmutable($d, 1975, 1, 1, 0, 0, 0);
    }

    public function testFirstFridayOfYear()
    {
        $d = CarbonImmutable::createFromDate(1975, 11, 21)->firstOfYear(5);
        $this->assertCarbonImmutable($d, 1975, 1, 3, 0, 0, 0);
    }

    public function testLastDayOfYear()
    {
        $d = CarbonImmutable::createFromDate(1975, 8, 5)->lastOfYear();
        $this->assertCarbonImmutable($d, 1975, 12, 31, 0, 0, 0);
    }

    public function testLastTuesdayOfYear()
    {
        $d = CarbonImmutable::createFromDate(1975, 8, 1)->lastOfYear(CarbonImmutable::TUESDAY);
        $this->assertCarbonImmutable($d, 1975, 12, 30, 0, 0, 0);
    }

    public function testLastFridayOfYear()
    {
        $d = CarbonImmutable::createFromDate(1975, 7, 5)->lastOfYear(5);
        $this->assertCarbonImmutable($d, 1975, 12, 26, 0, 0, 0);
    }

    public function testNthOfYearOutsideScope()
    {
        $this->assertFalse(CarbonImmutable::createFromDate(1975, 1, 5)->nthOfYear(55, CarbonImmutable::MONDAY));
    }

    public function test2ndMondayOfYear()
    {
        $d = CarbonImmutable::createFromDate(1975, 8, 5)->nthOfYear(2, CarbonImmutable::MONDAY);
        $this->assertCarbonImmutable($d, 1975, 1, 13, 0, 0, 0);
    }

    public function test3rdWednesdayOfYear()
    {
        $d = CarbonImmutable::createFromDate(1975, 8, 5)->nthOfYear(3, 3);
        $this->assertCarbonImmutable($d, 1975, 1, 15, 0, 0, 0);
    }
}
