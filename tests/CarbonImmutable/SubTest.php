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

class SubTest extends AbstractTestCase
{
    public function testSubMethod(): void
    {
        $this->assertSame(1973, Carbon::createFromDate(1975)->sub(2, 'year')->year);
        $this->assertSame(1973, Carbon::createFromDate(1975)->sub('year', 2)->year);
        $this->assertSame(1973, Carbon::createFromDate(1975)->sub('2 years')->year);
        $lastNegated = null;
        $date = Carbon::createFromDate(1975)->sub(
            function (DateTimeImmutable $date, bool $negated = false) use (&$lastNegated): DateTimeImmutable {
                $lastNegated = $negated;

                return new DateTimeImmutable($date->format('Y-m-d H:i:s').' - 2 years');
            }
        );
        $this->assertInstanceOf(Carbon::class, $date);
        $this->assertSame(1973, $date->year);
        $this->assertTrue($lastNegated);
        $this->assertSame(1973, Carbon::createFromDate(1975)->subtract(2, 'year')->year);
        $this->assertSame(1973, Carbon::createFromDate(1975)->subtract('year', 2)->year);
        $this->assertSame(1973, Carbon::createFromDate(1975)->subtract('2 years')->year);
        $lastNegated = null;
        $this->assertSame(1973, Carbon::createFromDate(1975)->subtract(
            function (DateTimeImmutable $date, bool $negated = false) use (&$lastNegated): DateTimeImmutable {
                $lastNegated = $negated;

                return new DateTimeImmutable($date->format('Y-m-d H:i:s').' - 2 years');
            }
        )->year);
        $this->assertTrue($lastNegated);
        /** @var CarbonInterval $interval */
        $interval = include __DIR__.'/../Fixtures/dynamicInterval.php';
        $originalDate = Carbon::parse('2020-06-08');
        $date = $originalDate->sub($interval);
        $this->assertInstanceOf(Carbon::class, $date);
        $this->assertSame('2020-05-31', $date->format('Y-m-d'));
        $this->assertNotSame($originalDate, $date);
        $date = Carbon::parse('2020-07-16')->subtract($interval);
        $this->assertInstanceOf(Carbon::class, $date);
        $this->assertSame('2020-06-30', $date->format('Y-m-d'));
    }

    public function testSubYearsPositive(): void
    {
        $this->assertSame(1974, Carbon::createFromDate(1975)->subYears(1)->year);
    }

    public function testSubYearsZero(): void
    {
        $this->assertSame(1975, Carbon::createFromDate(1975)->subYears(0)->year);
    }

    public function testSubYearsNegative(): void
    {
        $this->assertSame(1976, Carbon::createFromDate(1975)->subYears(-1)->year);
    }

    public function testSubYear(): void
    {
        $this->assertSame(1974, Carbon::createFromDate(1975)->subYear()->year);
        $this->assertSame(1973, Carbon::createFromDate(1975)->sub(2, 'year')->year);
        $this->assertSame(1973, Carbon::createFromDate(1975)->sub(2, 'years')->year);
        $this->assertSame(1973, Carbon::createFromDate(1975)->sub(CarbonInterval::years(2))->year);
    }

    public function testSubMonthsPositive(): void
    {
        $this->assertSame(12, Carbon::createFromDate(1975, 1, 1)->subMonths(1)->month);
    }

    public function testSubMonthsZero(): void
    {
        $this->assertSame(1, Carbon::createFromDate(1975, 1, 1)->subMonths(0)->month);
    }

    public function testSubMonthsNegative(): void
    {
        $this->assertSame(2, Carbon::createFromDate(1975, 1, 1)->subMonths(-1)->month);
    }

    public function testSubMonth(): void
    {
        $this->assertSame(12, Carbon::createFromDate(1975, 1, 1)->subMonth()->month);
    }

    public function testSubDaysPositive(): void
    {
        $this->assertSame(30, Carbon::createFromDate(1975, 5, 1)->subDays(1)->day);
    }

    public function testSubDaysZero(): void
    {
        $this->assertSame(1, Carbon::createFromDate(1975, 5, 1)->subDays(0)->day);
    }

    public function testSubDaysNegative(): void
    {
        $this->assertSame(2, Carbon::createFromDate(1975, 5, 1)->subDays(-1)->day);
    }

    public function testSubDay(): void
    {
        $this->assertSame(30, Carbon::createFromDate(1975, 5, 1)->subDay()->day);
    }

    public function testSubWeekdaysPositive(): void
    {
        $this->assertSame(22, Carbon::createFromDate(2012, 1, 4)->subWeekdays(9)->day);
    }

    public function testSubWeekdaysZero(): void
    {
        $this->assertSame(4, Carbon::createFromDate(2012, 1, 4)->subWeekdays(0)->day);
    }

    public function testSubWeekdaysNegative(): void
    {
        $this->assertSame(13, Carbon::createFromDate(2012, 1, 31)->subWeekdays(-9)->day);
    }

    public function testSubWeekday(): void
    {
        $this->assertSame(6, Carbon::createFromDate(2012, 1, 9)->subWeekday()->day);
    }

    public function testSubWeekdayDuringWeekend(): void
    {
        $this->assertSame(6, Carbon::createFromDate(2012, 1, 8)->subWeekday()->day);
    }

    public function testSubWeeksPositive(): void
    {
        $this->assertSame(14, Carbon::createFromDate(1975, 5, 21)->subWeeks(1)->day);
    }

    public function testSubWeeksZero(): void
    {
        $this->assertSame(21, Carbon::createFromDate(1975, 5, 21)->subWeeks(0)->day);
    }

    public function testSubWeeksNegative(): void
    {
        $this->assertSame(28, Carbon::createFromDate(1975, 5, 21)->subWeeks(-1)->day);
    }

    public function testSubWeek(): void
    {
        $this->assertSame(14, Carbon::createFromDate(1975, 5, 21)->subWeek()->day);
    }

    public function testSubHoursPositive(): void
    {
        $this->assertSame(23, Carbon::createFromTime(0)->subHours(1)->hour);
    }

    public function testSubHoursZero(): void
    {
        $this->assertSame(0, Carbon::createFromTime(0)->subHours(0)->hour);
    }

    public function testSubHoursNegative(): void
    {
        $this->assertSame(1, Carbon::createFromTime(0)->subHours(-1)->hour);
    }

    public function testSubHour(): void
    {
        $this->assertSame(23, Carbon::createFromTime(0)->subHour()->hour);
    }

    public function testSubMinutesPositive(): void
    {
        $this->assertSame(59, Carbon::createFromTime(0, 0)->subMinutes(1)->minute);
    }

    public function testSubMinutesZero(): void
    {
        $this->assertSame(0, Carbon::createFromTime(0, 0)->subMinutes(0)->minute);
    }

    public function testSubMinutesNegative(): void
    {
        $this->assertSame(1, Carbon::createFromTime(0, 0)->subMinutes(-1)->minute);
    }

    public function testSubMinute(): void
    {
        $this->assertSame(59, Carbon::createFromTime(0, 0)->subMinute()->minute);
    }

    public function testSubSecondsPositive(): void
    {
        $this->assertSame(59, Carbon::createFromTime(0, 0, 0)->subSeconds(1)->second);
    }

    public function testSubSecondsZero(): void
    {
        $this->assertSame(0, Carbon::createFromTime(0, 0, 0)->subSeconds(0)->second);
    }

    public function testSubSecondsNegative(): void
    {
        $this->assertSame(1, Carbon::createFromTime(0, 0, 0)->subSeconds(-1)->second);
    }

    public function testSubSecond(): void
    {
        $this->assertSame(59, Carbon::createFromTime(0, 0, 0)->subSecond()->second);
    }

    public function testSubMillisecondsPositive(): void
    {
        $this->assertSame(999, Carbon::createFromTime(0, 0, 0)->subMilliseconds(1)->millisecond);
    }

    public function testSubMillisecondsZero(): void
    {
        $this->assertSame(100, Carbon::createFromTime(0, 0, 0.1)->subMilliseconds(0)->millisecond);
    }

    public function testSubMillisecondsNegative(): void
    {
        $this->assertSame(1, Carbon::createFromTime(0, 0, 0)->subMilliseconds(-1)->millisecond);
        $this->assertSame(101, Carbon::createFromTime(0, 0, 0.1)->subMilliseconds(-1)->millisecond);
    }

    public function testSubMillisecond(): void
    {
        $this->assertSame(99, Carbon::createFromTime(0, 0, 0.1)->subMillisecond()->millisecond);
    }

    public function testSubMicrosecondsPositive(): void
    {
        $this->assertSame(999999, Carbon::createFromTime(0, 0, 0)->subMicroseconds(1)->microsecond);
    }

    public function testSubMicrosecondsZero(): void
    {
        $this->assertSame(100000, Carbon::createFromTime(0, 0, 0.1)->subMicroseconds(0)->microsecond);
    }

    public function testSubMicrosecondsNegative(): void
    {
        $this->assertSame(1, Carbon::createFromTime(0, 0, 0)->subMicroseconds(-1)->microsecond);
        $this->assertSame(100001, Carbon::createFromTime(0, 0, 0.1)->subMicroseconds(-1)->microsecond);
    }

    public function testSubMicrosecond(): void
    {
        $this->assertSame(99999, Carbon::createFromTime(0, 0, 0.1)->subMicrosecond()->microsecond);
    }

    /**
     * Test non plural methods with non default args.
     */
    public function testSubYearPassingArg(): void
    {
        /** @var mixed $date */
        $date = Carbon::createFromDate(1975);

        $this->assertSame(1973, $date->subYear(2)->year);
    }

    public function testSubMonthPassingArg(): void
    {
        /** @var mixed $date */
        $date = Carbon::createFromDate(1975, 5, 1);

        $this->assertSame(3, $date->subMonth(2)->month);
    }

    public function testSubMonthNoOverflowPassingArg(): void
    {
        /** @var mixed $date */
        $date = Carbon::createFromDate(2011, 4, 30);
        $date = $date->subMonthNoOverflow(2);

        $this->assertSame(2, $date->month);
        $this->assertSame(28, $date->day);
    }

    public function testSubDayPassingArg(): void
    {
        /** @var mixed $date */
        $date = Carbon::createFromDate(1975, 5, 10);

        $this->assertSame(8, $date->subDay(2)->day);
    }

    public function testSubHourPassingArg(): void
    {
        /** @var mixed $date */
        $date = Carbon::createFromTime(0);

        $this->assertSame(22, $date->subHour(2)->hour);
    }

    public function testSubMinutePassingArg(): void
    {
        /** @var mixed $date */
        $date = Carbon::createFromTime(0);

        $this->assertSame(58, $date->subMinute(2)->minute);
    }

    public function testSubSecondPassingArg(): void
    {
        /** @var mixed $date */
        $date = Carbon::createFromTime(0);

        $this->assertSame(58, $date->subSecond(2)->second);
    }
}
