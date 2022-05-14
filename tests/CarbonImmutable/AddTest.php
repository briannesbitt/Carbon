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
use Carbon\CarbonInterval;
use DateTimeImmutable;
use Tests\AbstractTestCase;

class AddTest extends AbstractTestCase
{
    public function testAddMethod(): void
    {
        $this->assertSame(1977, Carbon::createFromDate(1975)->add(2, 'year')->year);
        $this->assertSame(1977, Carbon::createFromDate(1975)->add('year', 2)->year);
        $this->assertSame(1977, Carbon::createFromDate(1975)->add('2 years')->year);
        $lastNegated = null;
        $date = Carbon::createFromDate(1975)->add(
            function (DateTimeImmutable $date, bool $negated = false) use (&$lastNegated): DateTimeImmutable {
                $lastNegated = $negated;

                return new DateTimeImmutable($date->format('Y-m-d H:i:s').' + 2 years');
            }
        );
        $this->assertInstanceOf(Carbon::class, $date);
        $this->assertSame(1977, $date->year);
        $this->assertFalse($lastNegated);
        /** @var CarbonInterval $interval */
        $interval = include __DIR__.'/../Fixtures/dynamicInterval.php';
        $originalDate = Carbon::parse('2020-06-04');
        $date = $originalDate->add($interval);
        $this->assertInstanceOf(Carbon::class, $date);
        $this->assertSame('2020-06-08', $date->format('Y-m-d'));
        $this->assertNotSame($date, $originalDate);
        $date = Carbon::parse('2020-06-23')->add($interval);
        $this->assertInstanceOf(Carbon::class, $date);
        $this->assertSame('2020-07-16', $date->format('Y-m-d'));
    }

    public function testAddYearsPositive(): void
    {
        $this->assertSame(1976, Carbon::createFromDate(1975)->addYears(1)->year);
    }

    public function testAddYearsZero(): void
    {
        $this->assertSame(1975, Carbon::createFromDate(1975)->addYears(0)->year);
    }

    public function testAddYearsNegative(): void
    {
        $this->assertSame(1974, Carbon::createFromDate(1975)->addYears(-1)->year);
    }

    public function testAddYear(): void
    {
        $this->assertSame(1976, Carbon::createFromDate(1975)->addYear()->year);
        $this->assertSame(1977, Carbon::createFromDate(1975)->add(2, 'year')->year);
        $this->assertSame(1977, Carbon::createFromDate(1975)->add(2, 'years')->year);
        $this->assertSame(1977, Carbon::createFromDate(1975)->add(CarbonInterval::years(2))->year);
    }

    public function testAddDaysPositive(): void
    {
        $this->assertSame(1, Carbon::createFromDate(1975, 5, 31)->addDays(1)->day);
    }

    public function testAddDaysZero(): void
    {
        $this->assertSame(31, Carbon::createFromDate(1975, 5, 31)->addDays(0)->day);
    }

    public function testAddDaysNegative(): void
    {
        $this->assertSame(30, Carbon::createFromDate(1975, 5, 31)->addDays(-1)->day);
    }

    public function testAddDay(): void
    {
        $this->assertSame(1, Carbon::createFromDate(1975, 5, 31)->addDay()->day);
    }

    public function testAddOverflow(): void
    {
        $this->assertSame(
            '2021-03-03',
            Carbon::parse('2021-01-31')->add(1, 'months', true)->format('Y-m-d')
        );
        $this->assertSame(
            '2021-03-03',
            Carbon::parse('2021-01-31')->add(1, 'months')->format('Y-m-d')
        );
        $this->assertSame(
            '2021-02-28',
            Carbon::parse('2021-01-31')->add(1, 'months', false)->format('Y-m-d')
        );
    }

    public function testAddWeekdaysPositive(): void
    {
        $dt = Carbon::create(2012, 1, 4, 13, 2, 1)->addWeekdays(9);

        $this->assertSame(17, $dt->day);

        // test for https://bugs.php.net/bug.php?id=54909
        $this->assertSame(13, $dt->hour);
        $this->assertSame(2, $dt->minute);
        $this->assertSame(1, $dt->second);
    }

    public function testAddWeekdaysZero(): void
    {
        $this->assertSame(4, Carbon::createFromDate(2012, 1, 4)->addWeekdays(0)->day);
    }

    public function testAddWeekdaysNegative(): void
    {
        $this->assertSame(18, Carbon::createFromDate(2012, 1, 31)->addWeekdays(-9)->day);
    }

    public function testAddWeekday(): void
    {
        $this->assertSame(9, Carbon::createFromDate(2012, 1, 6)->addWeekday()->day);
    }

    public function testAddWeekdayDuringWeekend(): void
    {
        $this->assertSame(9, Carbon::createFromDate(2012, 1, 7)->addWeekday()->day);
    }

    public function testAddWeeksPositive(): void
    {
        $this->assertSame(28, Carbon::createFromDate(1975, 5, 21)->addWeeks(1)->day);
    }

    public function testAddWeeksZero(): void
    {
        $this->assertSame(21, Carbon::createFromDate(1975, 5, 21)->addWeeks(0)->day);
    }

    public function testAddWeeksNegative(): void
    {
        $this->assertSame(14, Carbon::createFromDate(1975, 5, 21)->addWeeks(-1)->day);
    }

    public function testAddWeek(): void
    {
        $this->assertSame(28, Carbon::createFromDate(1975, 5, 21)->addWeek()->day);
    }

    public function testAddHoursPositive(): void
    {
        $this->assertSame(1, Carbon::createFromTime(0)->addHours(1)->hour);
    }

    public function testAddHoursZero(): void
    {
        $this->assertSame(0, Carbon::createFromTime(0)->addHours(0)->hour);
    }

    public function testAddHoursNegative(): void
    {
        $this->assertSame(23, Carbon::createFromTime(0)->addHours(-1)->hour);
    }

    public function testAddHour(): void
    {
        $this->assertSame(1, Carbon::createFromTime(0)->addHour()->hour);
    }

    public function testAddMinutesPositive(): void
    {
        $this->assertSame(1, Carbon::createFromTime(0, 0)->addMinutes(1)->minute);
    }

    public function testAddMinutesZero(): void
    {
        $this->assertSame(0, Carbon::createFromTime(0, 0)->addMinutes(0)->minute);
    }

    public function testAddMinutesNegative(): void
    {
        $this->assertSame(59, Carbon::createFromTime(0, 0)->addMinutes(-1)->minute);
    }

    public function testAddMinute(): void
    {
        $this->assertSame(1, Carbon::createFromTime(0, 0)->addMinute()->minute);
    }

    public function testAddSecondsPositive(): void
    {
        $this->assertSame(1, Carbon::createFromTime(0, 0, 0)->addSeconds(1)->second);
    }

    public function testAddSecondsZero(): void
    {
        $this->assertSame(0, Carbon::createFromTime(0, 0, 0)->addSeconds(0)->second);
    }

    public function testAddSecondsNegative(): void
    {
        $this->assertSame(59, Carbon::createFromTime(0, 0, 0)->addSeconds(-1)->second);
    }

    public function testAddSecond(): void
    {
        $this->assertSame(1, Carbon::createFromTime(0, 0, 0)->addSecond()->second);
    }

    public function testAddMillisecondsPositive(): void
    {
        $this->assertSame(1, Carbon::createFromTime(0, 0, 0)->addMilliseconds(1)->millisecond);
    }

    public function testAddMillisecondsZero(): void
    {
        $this->assertSame(100, Carbon::createFromTime(0, 0, 0.1)->addMilliseconds(0)->millisecond);
    }

    public function testAddMillisecondsNegative(): void
    {
        $this->assertSame(999, Carbon::createFromTime(0, 0, 0)->addMilliseconds(-1)->millisecond);
        $this->assertSame(99, Carbon::createFromTime(0, 0, 0.1)->addMilliseconds(-1)->millisecond);
    }

    public function testAddMillisecond(): void
    {
        $this->assertSame(101, Carbon::createFromTime(0, 0, 0.1)->addMillisecond()->millisecond);
    }

    public function testAddMicrosecondsPositive(): void
    {
        $this->assertSame(1, Carbon::createFromTime(0, 0, 0)->addMicroseconds(1)->microsecond);
    }

    public function testAddMicrosecondsZero(): void
    {
        $this->assertSame(100000, Carbon::createFromTime(0, 0, 0.1)->addMicroseconds(0)->microsecond);
    }

    public function testAddMicrosecondsNegative(): void
    {
        $this->assertSame(999999, Carbon::createFromTime(0, 0, 0)->addMicroseconds(-1)->microsecond);
        $this->assertSame(99999, Carbon::createFromTime(0, 0, 0.1)->addMicroseconds(-1)->microsecond);
    }

    public function testAddMicrosecond(): void
    {
        $this->assertSame(100001, Carbon::createFromTime(0, 0, 0.1)->addMicrosecond()->microsecond);
    }

    /**
     * Test non plural methods with non default args.
     */
    public function testAddYearPassingArg(): void
    {
        /** @var mixed $date */
        $date = Carbon::createFromDate(1975);
        $this->assertSame(1977, $date->addYear(2)->year);
    }

    public function testAddDayPassingArg(): void
    {
        /** @var mixed $date */
        $date = Carbon::createFromDate(1975, 5, 10);
        $this->assertSame(12, $date->addDay(2)->day);
    }

    public function testAddHourPassingArg(): void
    {
        /** @var mixed $date */
        $date = Carbon::createFromTime(10);
        $this->assertSame(12, $date->addHour(2)->hour);
    }

    public function testAddMinutePassingArg(): void
    {
        /** @var mixed $date */
        $date = Carbon::createFromTime(0);
        $this->assertSame(2, $date->addMinute(2)->minute);
    }

    public function testAddSecondPassingArg(): void
    {
        /** @var mixed $date */
        $date = Carbon::createFromTime(0);
        $this->assertSame(2, $date->addSecond(2)->second);
    }

    public function testAddQuarter(): void
    {
        $this->assertSame(8, Carbon::createFromDate(1975, 5, 6)->addQuarter()->month);
    }

    public function testAddQuarterNegative(): void
    {
        /** @var mixed $date */
        $date = Carbon::createFromDate(1975, 5, 6);
        $this->assertSame(2, $date->addQuarter(-1)->month);
    }

    public function testSubQuarter(): void
    {
        $this->assertSame(2, Carbon::createFromDate(1975, 5, 6)->subQuarter()->month);
    }

    public function testSubQuarterNegative(): void
    {
        $this->assertCarbon(Carbon::createFromDate(1975, 5, 6)->subQuarters(2), 1974, 11, 6);
    }

    public function testAddCentury(): void
    {
        $this->assertSame(2075, Carbon::createFromDate(1975)->addCentury()->year);
        /** @var mixed $date */
        $date = Carbon::createFromDate(1975);
        $this->assertSame(2075, $date->addCentury(1)->year);
        /** @var mixed $date */
        $date = Carbon::createFromDate(1975);
        $this->assertSame(2175, $date->addCentury(2)->year);
    }

    public function testAddCenturyNegative(): void
    {
        /** @var mixed $date */
        $date = Carbon::createFromDate(1975);
        $this->assertSame(1875, $date->addCentury(-1)->year);
        /** @var mixed $date */
        $date = Carbon::createFromDate(1975);
        $this->assertSame(1775, $date->addCentury(-2)->year);
    }

    public function testAddCenturies(): void
    {
        $this->assertSame(2075, Carbon::createFromDate(1975)->addCenturies(1)->year);
        $this->assertSame(2175, Carbon::createFromDate(1975)->addCenturies(2)->year);
    }

    public function testAddCenturiesNegative(): void
    {
        $this->assertSame(1875, Carbon::createFromDate(1975)->addCenturies(-1)->year);
        $this->assertSame(1775, Carbon::createFromDate(1975)->addCenturies(-2)->year);
    }

    public function testSubCentury(): void
    {
        $this->assertSame(1875, Carbon::createFromDate(1975)->subCentury()->year);
        /** @var mixed $date */
        $date = Carbon::createFromDate(1975);
        $this->assertSame(1875, $date->subCentury(1)->year);
        /** @var mixed $date */
        $date = Carbon::createFromDate(1975);
        $this->assertSame(1775, $date->subCentury(2)->year);
    }

    public function testSubCenturyNegative(): void
    {
        /** @var mixed $date */
        $date = Carbon::createFromDate(1975);
        $this->assertSame(2075, $date->subCentury(-1)->year);
        /** @var mixed $date */
        $date = Carbon::createFromDate(1975);
        $this->assertSame(2175, $date->subCentury(-2)->year);
    }

    public function testSubCenturies(): void
    {
        $this->assertSame(1875, Carbon::createFromDate(1975)->subCenturies(1)->year);
        $this->assertSame(1775, Carbon::createFromDate(1975)->subCenturies(2)->year);
    }

    public function testSubCenturiesNegative(): void
    {
        $this->assertSame(2075, Carbon::createFromDate(1975)->subCenturies(-1)->year);
        $this->assertSame(2175, Carbon::createFromDate(1975)->subCenturies(-2)->year);
    }

    public function testAddYearNoOverflow(): void
    {
        $this->assertCarbon(Carbon::createFromDate(2016, 2, 29)->addYearNoOverflow(), 2017, 2, 28);
    }

    public function testAddYearWithOverflow(): void
    {
        $this->assertCarbon(Carbon::createFromDate(2016, 2, 29)->addYearWithOverflow(), 2017, 3, 1);
    }

    public function testAddYearNoOverflowPassingArg(): void
    {
        $this->assertCarbon(Carbon::createFromDate(2016, 2, 29)->addYearsNoOverflow(2), 2018, 2, 28);
    }

    public function testAddYearWithOverflowPassingArg(): void
    {
        $this->assertCarbon(Carbon::createFromDate(2016, 2, 29)->addYearsWithOverflow(2), 2018, 3, 1);
    }

    public function testSubYearNoOverflowPassingArg(): void
    {
        $this->assertCarbon(Carbon::createFromDate(2016, 2, 29)->subYearsNoOverflow(2), 2014, 2, 28);
    }

    public function testSubYearWithOverflowPassingArg(): void
    {
        $this->assertCarbon(Carbon::createFromDate(2016, 2, 29)->subYearsWithOverflow(2), 2014, 3, 1);
    }

    public function testSubYearNoOverflow(): void
    {
        $this->assertCarbon(Carbon::createFromDate(2016, 2, 29)->subYearNoOverflow(), 2015, 2, 28);
    }

    public function testSubYearWithOverflow(): void
    {
        $this->assertCarbon(Carbon::createFromDate(2016, 2, 29)->subYearWithOverflow(), 2015, 3, 1);
    }

    public function testUseYearsOverflow(): void
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
