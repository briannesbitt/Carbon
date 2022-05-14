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

class StartEndOfTest extends AbstractTestCase
{
    public function testStartOfDay(): void
    {
        $dt = Carbon::now();
        $this->assertInstanceOfCarbon($dt2 = $dt->startOfDay());
        $this->assertCarbon($dt2, $dt->year, $dt->month, $dt->day, 0, 0, 0, 0);
    }

    public function testEndOfDay(): void
    {
        $dt = Carbon::now();
        $this->assertInstanceOfCarbon($dt2 = $dt->endOfDay());
        $this->assertCarbon($dt2, $dt->year, $dt->month, $dt->day, 23, 59, 59, 999999);
    }

    public function testStartOfMonthIsFluid(): void
    {
        $dt = Carbon::now();
        $this->assertInstanceOfCarbon($dt->startOfMonth());
    }

    public function testStartOfMonthFromNow(): void
    {
        $dt = Carbon::now()->startOfMonth();
        $this->assertCarbon($dt, $dt->year, $dt->month, 1, 0, 0, 0);
    }

    public function testStartOfMonthFromLastDay(): void
    {
        $dt = Carbon::create(2000, 1, 31, 2, 3, 4)->startOfMonth();
        $this->assertCarbon($dt, 2000, 1, 1, 0, 0, 0);
    }

    public function testStartOfYearIsFluid(): void
    {
        $dt = Carbon::now();
        $this->assertInstanceOfCarbon($dt->startOfYear());
    }

    public function testStartOfYearFromNow(): void
    {
        $dt = Carbon::now()->startOfYear();
        $this->assertCarbon($dt, $dt->year, 1, 1, 0, 0, 0);
    }

    public function testStartOfYearFromFirstDay(): void
    {
        $dt = Carbon::create(2000, 1, 1, 1, 1, 1)->startOfYear();
        $this->assertCarbon($dt, 2000, 1, 1, 0, 0, 0);
    }

    public function testStartOfYearFromLastDay(): void
    {
        $dt = Carbon::create(2000, 12, 31, 23, 59, 59)->startOfYear();
        $this->assertCarbon($dt, 2000, 1, 1, 0, 0, 0);
    }

    public function testEndOfMonthIsFluid(): void
    {
        $dt = Carbon::now();
        $this->assertInstanceOfCarbon($dt->endOfMonth());
    }

    public function testEndOfMonth(): void
    {
        $dt = Carbon::create(2000, 1, 1, 2, 3, 4)->endOfMonth();
        $this->assertCarbon($dt, 2000, 1, 31, 23, 59, 59);
    }

    public function testEndOfMonthFromLastDay(): void
    {
        $dt = Carbon::create(2000, 1, 31, 2, 3, 4)->endOfMonth();
        $this->assertCarbon($dt, 2000, 1, 31, 23, 59, 59);
    }

    public function testEndOfYearIsFluid(): void
    {
        $dt = Carbon::now();
        $this->assertInstanceOfCarbon($dt->endOfYear());
    }

    public function testEndOfYearFromNow(): void
    {
        $dt = Carbon::now()->endOfYear();
        $this->assertCarbon($dt, $dt->year, 12, 31, 23, 59, 59);
    }

    public function testEndOfYearFromFirstDay(): void
    {
        $dt = Carbon::create(2000, 1, 1, 1, 1, 1)->endOfYear();
        $this->assertCarbon($dt, 2000, 12, 31, 23, 59, 59);
    }

    public function testEndOfYearFromLastDay(): void
    {
        $dt = Carbon::create(2000, 12, 31, 23, 59, 59)->endOfYear();
        $this->assertCarbon($dt, 2000, 12, 31, 23, 59, 59);
    }

    public function testStartOfDecadeIsFluid(): void
    {
        $dt = Carbon::now();
        $this->assertInstanceOfCarbon($dt->startOfDecade());
    }

    public function testStartOfDecadeFromNow(): void
    {
        $dt = Carbon::now()->startOfDecade();
        $this->assertCarbon($dt, $dt->year - $dt->year % 10, 1, 1, 0, 0, 0);
    }

    public function testStartOfDecadeFromFirstDay(): void
    {
        $dt = Carbon::create(2000, 1, 1, 1, 1, 1)->startOfDecade();
        $this->assertCarbon($dt, 2000, 1, 1, 0, 0, 0);
    }

    public function testStartOfDecadeFromLastDay(): void
    {
        $dt = Carbon::create(2009, 12, 31, 23, 59, 59)->startOfDecade();
        $this->assertCarbon($dt, 2000, 1, 1, 0, 0, 0);
    }

    public function testEndOfDecadeIsFluid(): void
    {
        $dt = Carbon::now();
        $this->assertInstanceOfCarbon($dt->endOfDecade());
    }

    public function testEndOfDecadeFromNow(): void
    {
        $dt = Carbon::now()->endOfDecade();
        $this->assertCarbon($dt, $dt->year - $dt->year % 10 + 9, 12, 31, 23, 59, 59);
    }

    public function testEndOfDecadeFromFirstDay(): void
    {
        $dt = Carbon::create(2000, 1, 1, 1, 1, 1)->endOfDecade();
        $this->assertCarbon($dt, 2009, 12, 31, 23, 59, 59);
    }

    public function testEndOfDecadeFromLastDay(): void
    {
        $dt = Carbon::create(2009, 12, 31, 23, 59, 59)->endOfDecade();
        $this->assertCarbon($dt, 2009, 12, 31, 23, 59, 59);
    }

    public function testStartOfCenturyIsFluid(): void
    {
        $dt = Carbon::now();
        $this->assertInstanceOfCarbon($dt->startOfCentury());
    }

    public function testStartOfCenturyFromNow(): void
    {
        $now = Carbon::now();
        $dt = Carbon::now()->startOfCentury();
        $this->assertCarbon($dt, $now->year - $now->year % 100 + 1, 1, 1, 0, 0, 0);
    }

    public function testStartOfCenturyFromFirstDay(): void
    {
        $dt = Carbon::create(2001, 1, 1, 1, 1, 1)->startOfCentury();
        $this->assertCarbon($dt, 2001, 1, 1, 0, 0, 0);
    }

    public function testStartOfCenturyFromLastDay(): void
    {
        $dt = Carbon::create(2100, 12, 31, 23, 59, 59)->startOfCentury();
        $this->assertCarbon($dt, 2001, 1, 1, 0, 0, 0);
    }

    public function testStartOfMillenniumIsFluid(): void
    {
        $dt = Carbon::now();
        $this->assertInstanceOfCarbon($dt->startOfMillennium());
    }

    public function testStartOfMillenniumFromNow(): void
    {
        $now = Carbon::now();
        $dt = Carbon::now()->startOfMillennium();
        $this->assertCarbon($dt, $now->year - $now->year % 1000 + 1, 1, 1, 0, 0, 0);
    }

    public function testStartOfMillenniumFromFirstDay(): void
    {
        $dt = Carbon::create(2001, 1, 1, 1, 1, 1)->startOfMillennium();
        $this->assertCarbon($dt, 2001, 1, 1, 0, 0, 0);
    }

    public function testStartOfMillenniumFromLastDay(): void
    {
        $dt = Carbon::create(3000, 12, 31, 23, 59, 59)->startOfMillennium();
        $this->assertCarbon($dt, 2001, 1, 1, 0, 0, 0);
    }

    public function testStartOfHourIsFluid(): void
    {
        $dt = Carbon::now();
        $this->assertInstanceOfCarbon($dt->startOfHour());
    }

    public function testStartOfHourFromNow(): void
    {
        $now = Carbon::now();
        $dt = Carbon::now()->startOfHour();
        $this->assertCarbon($dt, $now->year, $now->month, $now->day, $now->hour, 0, 0);
    }

    public function testStartOfHourFromFirstMinute(): void
    {
        $dt = Carbon::create(2001, 1, 1, 1, 1, 1)->startOfHour();
        $this->assertCarbon($dt, $dt->year, $dt->month, $dt->day, $dt->hour, 0, 0);
    }

    public function testStartOfHourFromLastMinute(): void
    {
        $dt = Carbon::create(2100, 12, 31, 23, 59, 59)->startOfHour();
        $this->assertCarbon($dt, $dt->year, $dt->month, $dt->day, $dt->hour, 0, 0);
    }

    public function testEndOfHourIsFluid(): void
    {
        $dt = Carbon::now();
        $this->assertInstanceOfCarbon($dt->endOfHour());
    }

    public function testEndOfHourFromNow(): void
    {
        $now = Carbon::now();
        $dt = Carbon::now()->endOfHour();
        $this->assertCarbon($dt, $now->year, $now->month, $now->day, $now->hour, 59, 59);
    }

    public function testEndOfHourFromFirstMinute(): void
    {
        $dt = Carbon::create(2001, 1, 1, 1, 1, rand(0, 59))->endOfHour();
        $this->assertCarbon($dt, $dt->year, $dt->month, $dt->day, $dt->hour, 59, 59);
    }

    public function testEndOfHourFromLastMinute(): void
    {
        $dt = Carbon::create(2100, 12, 31, 23, 59, rand(0, 59))->endOfHour();
        $this->assertCarbon($dt, $dt->year, $dt->month, $dt->day, $dt->hour, 59, 59);
    }

    public function testStartOfMinuteIsFluid(): void
    {
        $dt = Carbon::now();
        $this->assertInstanceOfCarbon($dt->startOfMinute());
    }

    public function testStartOfMinuteFromNow(): void
    {
        $now = Carbon::now();
        $dt = Carbon::now()->startOfMinute();
        $this->assertCarbon($dt, $now->year, $now->month, $now->day, $now->hour, $now->minute, 0);
    }

    public function testStartOfMinuteFromFirstSecond(): void
    {
        $dt = Carbon::create(2001, 1, 1, 1, 1, 1)->startOfMinute();
        $this->assertCarbon($dt, $dt->year, $dt->month, $dt->day, $dt->hour, $dt->minute, 0);
    }

    public function testStartOfMinuteFromLastSecond(): void
    {
        $dt = Carbon::create(2100, 12, 31, 23, 59, 59)->startOfMinute();
        $this->assertCarbon($dt, $dt->year, $dt->month, $dt->day, $dt->hour, $dt->minute, 0);
    }

    public function testEndOfMinuteIsFluid(): void
    {
        $dt = Carbon::now();
        $this->assertInstanceOfCarbon($dt->endOfMinute());
    }

    public function testEndOfMinuteFromNow(): void
    {
        $now = Carbon::now();
        $dt = Carbon::now()->endOfMinute();
        $this->assertCarbon($dt, $now->year, $now->month, $now->day, $now->hour, $now->minute, 59);
    }

    public function testEndOfMinuteFromFirstSecond(): void
    {
        $dt = Carbon::create(2001, 1, 1, 1, 1, 1)->endOfMinute();
        $this->assertCarbon($dt, $dt->year, $dt->month, $dt->day, $dt->hour, $dt->minute, 59);
    }

    public function testEndOfMinuteFromLastSecond(): void
    {
        $dt = Carbon::create(2100, 12, 31, 23, 59, 59)->endOfHour();
        $this->assertCarbon($dt, $dt->year, $dt->month, $dt->day, $dt->hour, $dt->minute, 59);
    }

    public function testMidDayIsFluid(): void
    {
        $dt = Carbon::now();
        $this->assertInstanceOfCarbon($dt->midDay());
    }

    public function testMidDayFromNow(): void
    {
        $now = Carbon::now();
        $dt = Carbon::now()->midDay();
        $this->assertCarbon($dt, $now->year, $now->month, $now->day, 12, 0, 0);
    }

    public function testEndOfCenturyIsFluid(): void
    {
        $dt = Carbon::now();
        $this->assertInstanceOfCarbon($dt->endOfCentury());
    }

    public function testEndOfCenturyFromNow(): void
    {
        $now = Carbon::now();
        $dt = Carbon::now()->endOfCentury();
        $this->assertCarbon($dt, $now->year - $now->year % 100 + 100, 12, 31, 23, 59, 59);
    }

    public function testEndOfCenturyFromFirstDay(): void
    {
        $dt = Carbon::create(2001, 1, 1, 1, 1, 1)->endOfCentury();
        $this->assertCarbon($dt, 2100, 12, 31, 23, 59, 59);
    }

    public function testEndOfCenturyFromLastDay(): void
    {
        $dt = Carbon::create(2100, 12, 31, 23, 59, 59)->endOfCentury();
        $this->assertCarbon($dt, 2100, 12, 31, 23, 59, 59);
    }

    public function testStartOfQuarterIsFluid(): void
    {
        $dt = Carbon::now();
        $this->assertInstanceOfCarbon($dt->startOfQuarter());
    }

    public static function dataForTestStartOfQuarter()
    {
        return [
            [1, 1],
            [2, 1],
            [3, 1],
            [4, 4],
            [5, 4],
            [6, 4],
            [7, 7],
            [8, 7],
            [9, 7],
            [10, 10],
            [11, 10],
            [12, 10],
        ];
    }

    /**
     * @dataProvider \Tests\CarbonImmutable\StartEndOfTest::dataForTestStartOfQuarter
     *
     * @param int $month
     * @param int $startOfQuarterMonth
     */
    public function testStartOfQuarter($month, $startOfQuarterMonth): void
    {
        $dt = Carbon::create(2015, $month, 15, 1, 2, 3);
        $this->assertCarbon($dt->startOfQuarter(), 2015, $startOfQuarterMonth, 1, 0, 0, 0);
    }

    public function testEndOfQuarterIsFluid(): void
    {
        $dt = Carbon::now();
        $this->assertInstanceOfCarbon($dt->endOfQuarter());
    }

    public static function dataForTestEndOfQuarter()
    {
        return [
            [1, 3, 31],
            [2, 3, 31],
            [3, 3, 31],
            [4, 6, 30],
            [5, 6, 30],
            [6, 6, 30],
            [7, 9, 30],
            [8, 9, 30],
            [9, 9, 30],
            [10, 12, 31],
            [11, 12, 31],
            [12, 12, 31],
        ];
    }

    /**
     * @dataProvider \Tests\CarbonImmutable\StartEndOfTest::dataForTestEndOfQuarter
     *
     * @param int $month
     * @param int $endOfQuarterMonth
     * @param int $endOfQuarterDay
     */
    public function testEndOfQuarter($month, $endOfQuarterMonth, $endOfQuarterDay): void
    {
        $dt = Carbon::create(2015, $month, 15, 1, 2, 3);
        $this->assertCarbon($dt->endOfQuarter(), 2015, $endOfQuarterMonth, $endOfQuarterDay, 23, 59, 59);
    }

    public function testAverageIsFluid(): void
    {
        $dt = Carbon::now()->average();
        $this->assertInstanceOfCarbon($dt);
    }

    public function testAverageFromSame(): void
    {
        $dt1 = Carbon::create(2000, 1, 31, 2, 3, 4);
        $dt2 = Carbon::create(2000, 1, 31, 2, 3, 4)->average($dt1);
        $this->assertCarbon($dt2, 2000, 1, 31, 2, 3, 4);
    }

    public function testAverageFromGreater(): void
    {
        $dt1 = Carbon::create(2000, 1, 1, 1, 1, 1);
        $dt2 = Carbon::create(2009, 12, 31, 23, 59, 59)->average($dt1);
        $this->assertCarbon($dt2, 2004, 12, 31, 12, 30, 30);
    }

    public function testAverageFromLower(): void
    {
        $dt1 = Carbon::create(2009, 12, 31, 23, 59, 59);
        $dt2 = Carbon::create(2000, 1, 1, 1, 1, 1)->average($dt1);
        $this->assertCarbon($dt2, 2004, 12, 31, 12, 30, 30);
    }

    public function testAverageWithCloseDates(): void
    {
        $dt1 = Carbon::parse('2004-01-24 09:46:56.500000');
        $dt2 = Carbon::parse('2004-01-24 09:46:56.600000');

        $this->assertSame('2004-01-24 09:46:56.550000', $dt1->average($dt2)->format('Y-m-d H:i:s.u'));
    }

    public function testAverageWithFarDates(): void
    {
        $dt1 = Carbon::parse('-2018-05-07 12:34:46.500000', 'UTC');
        $dt2 = Carbon::parse('6025-10-11 20:59:06.600000', 'UTC');

        $this->assertSame('2004-01-24 04:46:56.550000', $dt1->average($dt2)->format('Y-m-d H:i:s.u'));
    }
}
