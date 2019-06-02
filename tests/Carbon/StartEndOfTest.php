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

class StartEndOfTest extends AbstractTestCase
{
    public function testStartOfDay()
    {
        $dt = Carbon::now();
        $this->assertInstanceOfCarbon($dt->startOfDay());
        $this->assertCarbon($dt, $dt->year, $dt->month, $dt->day, 0, 0, 0, 0);
    }

    public function testEndOfDay()
    {
        // @TODO Fix this feature for PHP 7.1.3 => 7.1.5
        $this->excludePhpVersionsRange('7.1.3', '7.1.5');

        $dt = Carbon::now();
        $this->assertInstanceOfCarbon($dt->endOfDay());
        $this->assertCarbon($dt, $dt->year, $dt->month, $dt->day, 23, 59, 59, 999999);
    }

    public function testStartOfMonthIsFluid()
    {
        $dt = Carbon::now();
        $this->assertInstanceOfCarbon($dt->startOfMonth());
    }

    public function testStartOfMonthFromNow()
    {
        $dt = Carbon::now()->startOfMonth();
        $this->assertCarbon($dt, $dt->year, $dt->month, 1, 0, 0, 0);
    }

    public function testStartOfMonthFromLastDay()
    {
        $dt = Carbon::create(2000, 1, 31, 2, 3, 4)->startOfMonth();
        $this->assertCarbon($dt, 2000, 1, 1, 0, 0, 0);
    }

    public function testStartOfYearIsFluid()
    {
        $dt = Carbon::now();
        $this->assertInstanceOfCarbon($dt->startOfYear());
    }

    public function testStartOfYearFromNow()
    {
        $dt = Carbon::now()->startOfYear();
        $this->assertCarbon($dt, $dt->year, 1, 1, 0, 0, 0);
    }

    public function testStartOfYearFromFirstDay()
    {
        $dt = Carbon::create(2000, 1, 1, 1, 1, 1)->startOfYear();
        $this->assertCarbon($dt, 2000, 1, 1, 0, 0, 0);
    }

    public function testStartOfYearFromLastDay()
    {
        $dt = Carbon::create(2000, 12, 31, 23, 59, 59)->startOfYear();
        $this->assertCarbon($dt, 2000, 1, 1, 0, 0, 0);
    }

    public function testEndOfMonthIsFluid()
    {
        $dt = Carbon::now();
        $this->assertInstanceOfCarbon($dt->endOfMonth());
    }

    public function testEndOfMonth()
    {
        $dt = Carbon::create(2000, 1, 1, 2, 3, 4)->endOfMonth();
        $this->assertCarbon($dt, 2000, 1, 31, 23, 59, 59, 999999);
    }

    public function testEndOfMonthFromLastDay()
    {
        // @TODO Fix this feature for PHP 7.1.3 => 7.1.5
        $this->excludePhpVersionsRange('7.1.3', '7.1.5');

        $dt = Carbon::create(2000, 1, 31, 2, 3, 4)->endOfMonth();
        $this->assertCarbon($dt, 2000, 1, 31, 23, 59, 59, 999999);
    }

    public function testEndOfYearIsFluid()
    {
        $dt = Carbon::now();
        $this->assertInstanceOfCarbon($dt->endOfYear());
    }

    public function testEndOfYearFromNow()
    {
        $dt = Carbon::now()->endOfYear();
        $this->assertCarbon($dt, $dt->year, 12, 31, 23, 59, 59, 999999);
    }

    public function testEndOfYearFromFirstDay()
    {
        // @TODO Fix this feature for PHP 7.1.3 => 7.1.5
        $this->excludePhpVersionsRange('7.1.3', '7.1.5');

        $dt = Carbon::create(2000, 1, 1, 1, 1, 1)->endOfYear();
        $this->assertCarbon($dt, 2000, 12, 31, 23, 59, 59, 999999);
    }

    public function testEndOfYearFromLastDay()
    {
        // @TODO Fix this feature for PHP 7.1.3 => 7.1.5
        $this->excludePhpVersionsRange('7.1.3', '7.1.5');

        $dt = Carbon::create(2000, 12, 31, 23, 59, 59)->endOfYear();
        $this->assertCarbon($dt, 2000, 12, 31, 23, 59, 59, 999999);
    }

    public function testStartOfDecadeIsFluid()
    {
        $dt = Carbon::now();
        $this->assertInstanceOfCarbon($dt->startOfDecade());
    }

    public function testStartOfDecadeFromNow()
    {
        $dt = Carbon::now()->startOfDecade();
        $this->assertCarbon($dt, $dt->year - $dt->year % 10, 1, 1, 0, 0, 0);
    }

    public function testStartOfDecadeFromFirstDay()
    {
        $dt = Carbon::create(2000, 1, 1, 1, 1, 1)->startOfDecade();
        $this->assertCarbon($dt, 2000, 1, 1, 0, 0, 0);
    }

    public function testStartOfDecadeFromLastDay()
    {
        $dt = Carbon::create(2009, 12, 31, 23, 59, 59)->startOfDecade();
        $this->assertCarbon($dt, 2000, 1, 1, 0, 0, 0);
    }

    public function testEndOfDecadeIsFluid()
    {
        $dt = Carbon::now();
        $this->assertInstanceOfCarbon($dt->endOfDecade());
    }

    public function testEndOfDecadeFromNow()
    {
        // @TODO Fix this feature for PHP 7.1.3 => 7.1.5
        $this->excludePhpVersionsRange('7.1.3', '7.1.5');

        $dt = Carbon::now()->endOfDecade();
        $this->assertCarbon($dt, $dt->year - $dt->year % 10 + 9, 12, 31, 23, 59, 59, 999999);
    }

    public function testEndOfDecadeFromFirstDay()
    {
        $dt = Carbon::create(2000, 1, 1, 1, 1, 1)->endOfDecade();
        $this->assertCarbon($dt, 2009, 12, 31, 23, 59, 59, 999999);
    }

    public function testEndOfDecadeFromLastDay()
    {
        // @TODO Fix this feature for PHP 7.1.3 => 7.1.5
        $this->excludePhpVersionsRange('7.1.3', '7.1.5');

        $dt = Carbon::create(2009, 12, 31, 23, 59, 59)->endOfDecade();
        $this->assertCarbon($dt, 2009, 12, 31, 23, 59, 59, 999999);
    }

    public function testStartOfCenturyIsFluid()
    {
        $dt = Carbon::now();
        $this->assertInstanceOfCarbon($dt->startOfCentury());
    }

    public function testStartOfCenturyFromNow()
    {
        $now = Carbon::now();
        $dt = Carbon::now()->startOfCentury();
        $this->assertCarbon($dt, $now->year - $now->year % 100 + 1, 1, 1, 0, 0, 0);
    }

    public function testStartOfCenturyFromFirstDay()
    {
        $dt = Carbon::create(2001, 1, 1, 1, 1, 1)->startOfCentury();
        $this->assertCarbon($dt, 2001, 1, 1, 0, 0, 0);
    }

    public function testStartOfCenturyFromLastDay()
    {
        $dt = Carbon::create(2100, 12, 31, 23, 59, 59)->startOfCentury();
        $this->assertCarbon($dt, 2001, 1, 1, 0, 0, 0);
    }

    public function testStartOfMillenniumIsFluid()
    {
        $dt = Carbon::now();
        $this->assertInstanceOfCarbon($dt->startOfMillennium());
    }

    public function testStartOfMillenniumFromNow()
    {
        $now = Carbon::now();
        $dt = Carbon::now()->startOfMillennium();
        $this->assertCarbon($dt, $now->year - $now->year % 1000 + 1, 1, 1, 0, 0, 0);
    }

    public function testStartOfMillenniumFromFirstDay()
    {
        $dt = Carbon::create(2001, 1, 1, 1, 1, 1)->startOfMillennium();
        $this->assertCarbon($dt, 2001, 1, 1, 0, 0, 0);
    }

    public function testStartOfMillenniumFromLastDay()
    {
        $dt = Carbon::create(3000, 12, 31, 23, 59, 59)->startOfMillennium();
        $this->assertCarbon($dt, 2001, 1, 1, 0, 0, 0);
    }

    public function testStartOfHourIsFluid()
    {
        $dt = Carbon::now();
        $this->assertInstanceOfCarbon($dt->startOfHour());
    }

    public function testStartOfHourFromNow()
    {
        $now = Carbon::now();
        $dt = Carbon::now()->startOfHour();
        $this->assertCarbon($dt, $now->year, $now->month, $now->day, $now->hour, 0, 0);
    }

    public function testStartOfHourFromFirstMinute()
    {
        $dt = Carbon::create(2001, 1, 1, 1, 1, 1)->startOfHour();
        $this->assertCarbon($dt, $dt->year, $dt->month, $dt->day, $dt->hour, 0, 0);
    }

    public function testStartOfHourFromLastMinute()
    {
        $dt = Carbon::create(2100, 12, 31, 23, 59, 59)->startOfHour();
        $this->assertCarbon($dt, $dt->year, $dt->month, $dt->day, $dt->hour, 0, 0);
    }

    public function testEndOfHourIsFluid()
    {
        $dt = Carbon::now();
        $this->assertInstanceOfCarbon($dt->endOfHour());
    }

    public function testEndOfHourFromNow()
    {
        // @TODO Fix this feature for PHP 7.1.3 => 7.1.5
        $this->excludePhpVersionsRange('7.1.3', '7.1.5');

        $now = Carbon::now();
        $dt = Carbon::now()->endOfHour();
        $this->assertCarbon($dt, $now->year, $now->month, $now->day, $now->hour, 59, 59, 999999);
    }

    public function testEndOfHourFromFirstMinute()
    {
        // @TODO Fix this feature for PHP 7.1.3 => 7.1.5
        $this->excludePhpVersionsRange('7.1.3', '7.1.5');

        $dt = Carbon::create(2001, 1, 1, 1, 1, rand(0, 59))->endOfHour();
        $this->assertCarbon($dt, $dt->year, $dt->month, $dt->day, $dt->hour, 59, 59, 999999);
    }

    public function testEndOfHourFromLastMinute()
    {
        // @TODO Fix this feature for PHP 7.1.3 => 7.1.5
        $this->excludePhpVersionsRange('7.1.3', '7.1.5');

        $dt = Carbon::create(2100, 12, 31, 23, 59, rand(0, 59))->endOfHour();
        $this->assertCarbon($dt, $dt->year, $dt->month, $dt->day, $dt->hour, 59, 59, 999999);
    }

    public function testStartOfMinuteIsFluid()
    {
        $dt = Carbon::now();
        $this->assertInstanceOfCarbon($dt->startOfMinute());
    }

    public function testStartOfMinuteFromNow()
    {
        $now = Carbon::now();
        $dt = Carbon::now()->startOfMinute();
        $this->assertCarbon($dt, $now->year, $now->month, $now->day, $now->hour, $now->minute, 0);
    }

    public function testStartOfMinuteFromFirstSecond()
    {
        $dt = Carbon::create(2001, 1, 1, 1, 1, 1)->startOfMinute();
        $this->assertCarbon($dt, $dt->year, $dt->month, $dt->day, $dt->hour, $dt->minute, 0);
    }

    public function testStartOfMinuteFromLastSecond()
    {
        $dt = Carbon::create(2100, 12, 31, 23, 59, 59)->startOfMinute();
        $this->assertCarbon($dt, $dt->year, $dt->month, $dt->day, $dt->hour, $dt->minute, 0);
    }

    public function testEndOfMinuteIsFluid()
    {
        $dt = Carbon::now();
        $this->assertInstanceOfCarbon($dt->endOfMinute());
    }

    public function testEndOfMinuteFromNow()
    {
        // @TODO Fix this feature for PHP 7.1.3 => 7.1.5
        $this->excludePhpVersionsRange('7.1.3', '7.1.5');

        $now = Carbon::now();
        $dt = Carbon::now()->endOfMinute();
        $this->assertCarbon($dt, $now->year, $now->month, $now->day, $now->hour, $now->minute, 59, 999999);
    }

    public function testEndOfMinuteFromFirstSecond()
    {
        // @TODO Fix this feature for PHP 7.1.3 => 7.1.5
        $this->excludePhpVersionsRange('7.1.3', '7.1.5');

        $dt = Carbon::create(2001, 1, 1, 1, 1, 1)->endOfMinute();
        $this->assertCarbon($dt, $dt->year, $dt->month, $dt->day, $dt->hour, $dt->minute, 59, 999999);
    }

    public function testEndOfMinuteFromLastSecond()
    {
        // @TODO Fix this feature for PHP 7.1.3 => 7.1.5
        $this->excludePhpVersionsRange('7.1.3', '7.1.5');

        $dt = Carbon::create(2100, 12, 31, 23, 59, 59)->endOfMinute();
        $this->assertCarbon($dt, $dt->year, $dt->month, $dt->day, $dt->hour, $dt->minute, 59, 999999);
    }

    public function testStartOfSecondIsFluid()
    {
        $dt = Carbon::now();
        $this->assertInstanceOfCarbon($dt->startOfSecond());
    }

    public function testStartOfSecondFromNow()
    {
        $now = Carbon::now();
        $dt = Carbon::now()->startOfSecond();
        $this->assertCarbon($dt, $now->year, $now->month, $now->day, $now->hour, $now->minute, $now->second, 0);
    }

    public function testStartOfSecondFromFirstSecond()
    {
        $dt = Carbon::create(2001, 1, 1, 1, 1, 1)->startOfSecond();
        $this->assertCarbon($dt, $dt->year, $dt->month, $dt->day, $dt->hour, $dt->minute, $dt->second, 0);
    }

    public function testStartOfSecondFromLastSecond()
    {
        $dt = Carbon::create(2100, 12, 31, 23, 59, 59)->startOfSecond();
        $this->assertCarbon($dt, $dt->year, $dt->month, $dt->day, $dt->hour, $dt->minute, $dt->second, 0);
    }

    public function testEndOfSecondIsFluid()
    {
        $dt = Carbon::now();
        $this->assertInstanceOfCarbon($dt->endOfSecond());
    }

    public function testEndOfSecondFromNow()
    {
        // @TODO Fix this feature for PHP 7.1.3 => 7.1.5
        $this->excludePhpVersionsRange('7.1.3', '7.1.5');

        $now = Carbon::now();
        $dt = Carbon::now()->endOfSecond();
        $this->assertCarbon($dt, $now->year, $now->month, $now->day, $now->hour, $now->minute, $now->second, 999999);
    }

    public function testEndOfSecondFromFirstSecond()
    {
        // @TODO Fix this feature for PHP 7.1.3 => 7.1.5
        $this->excludePhpVersionsRange('7.1.3', '7.1.5');

        $dt = Carbon::create(2001, 1, 1, 1, 1, 1)->modify('01:01:01.1')->endOfSecond();
        $this->assertCarbon($dt, $dt->year, $dt->month, $dt->day, $dt->hour, $dt->minute, $dt->second, 999999);
    }

    public function testEndOfSecondFromLastSecond()
    {
        // @TODO Fix this feature for PHP 7.1.3 => 7.1.5
        $this->excludePhpVersionsRange('7.1.3', '7.1.5');

        $dt = Carbon::create(2100, 12, 31, 23, 59, 59)->modify('23:59:59.1')->endOfSecond();
        $this->assertCarbon($dt, $dt->year, $dt->month, $dt->day, $dt->hour, $dt->minute, $dt->second, 999999);
    }

    public function testMidDayIsFluid()
    {
        $dt = Carbon::now();
        $this->assertInstanceOfCarbon($dt->midDay());
    }

    public function testMidDayFromNow()
    {
        $now = Carbon::now();
        $dt = Carbon::now()->midDay();
        $this->assertCarbon($dt, $now->year, $now->month, $now->day, 12, 0, 0);
    }

    public function testEndOfCenturyIsFluid()
    {
        $dt = Carbon::now();
        $this->assertInstanceOfCarbon($dt->endOfCentury());
    }

    public function testEndOfCenturyFromNow()
    {
        // @TODO Fix this feature for PHP 7.1.3 => 7.1.5
        $this->excludePhpVersionsRange('7.1.3', '7.1.5');

        $now = Carbon::now();
        $dt = Carbon::now()->endOfCentury();
        $this->assertCarbon($dt, $now->year - $now->year % 100 + 100, 12, 31, 23, 59, 59, 999999);
    }

    public function testEndOfCenturyFromFirstDay()
    {
        // @TODO Fix this feature for PHP 7.1.3 => 7.1.5
        $this->excludePhpVersionsRange('7.1.3', '7.1.5');

        $dt = Carbon::create(2001, 1, 1, 1, 1, 1)->endOfCentury();
        $this->assertCarbon($dt, 2100, 12, 31, 23, 59, 59, 999999);
    }

    public function testEndOfCenturyFromLastDay()
    {
        // @TODO Fix this feature for PHP 7.1.3 => 7.1.5
        $this->excludePhpVersionsRange('7.1.3', '7.1.5');

        $dt = Carbon::create(2100, 12, 31, 23, 59, 59)->endOfCentury();
        $this->assertCarbon($dt, 2100, 12, 31, 23, 59, 59, 999999);
    }

    public function testEndOfMillenniumIsFluid()
    {
        $dt = Carbon::now();
        $this->assertInstanceOfCarbon($dt->endOfMillennium());
    }

    public function testEndOfMillenniumFromNow()
    {
        $now = Carbon::now();
        $dt = Carbon::now()->endOfMillennium();
        $this->assertCarbon($dt, $now->year - $now->year % 1000 + 1000, 12, 31, 23, 59, 59);
    }

    public function testEndOfMillenniumFromFirstDay()
    {
        $dt = Carbon::create(2001, 1, 1, 1, 1, 1)->endOfMillennium();
        $this->assertCarbon($dt, 3000, 12, 31, 23, 59, 59);
    }

    public function testEndOfMillenniumFromLastDay()
    {
        $dt = Carbon::create(2100, 12, 31, 23, 59, 59)->endOfMillennium();
        $this->assertCarbon($dt, 3000, 12, 31, 23, 59, 59);
    }

    public function testStartOfQuarterIsFluid()
    {
        $dt = Carbon::now();
        $this->assertInstanceOfCarbon($dt->startOfQuarter());
    }

    public function dataProviderTestStartOfQuarter()
    {
        return array(
            array(1, 1),
            array(2, 1),
            array(3, 1),
            array(4, 4),
            array(5, 4),
            array(6, 4),
            array(7, 7),
            array(8, 7),
            array(9, 7),
            array(10, 10),
            array(11, 10),
            array(12, 10),
        );
    }

    /**
     * @dataProvider \Tests\Carbon\StartEndOfTest::dataProviderTestStartOfQuarter
     *
     * @param int $month
     * @param int $startOfQuarterMonth
     */
    public function testStartOfQuarter($month, $startOfQuarterMonth)
    {
        $dt = Carbon::create(2015, $month, 15, 1, 2, 3);
        $this->assertCarbon($dt->startOfQuarter(), 2015, $startOfQuarterMonth, 1, 0, 0, 0);
    }

    public function testEndOfQuarterIsFluid()
    {
        $dt = Carbon::now();
        $this->assertInstanceOfCarbon($dt->endOfQuarter());
    }

    public function dataProviderTestEndOfQuarter()
    {
        return array(
            array(1, 3, 31),
            array(2, 3, 31),
            array(3, 3, 31),
            array(4, 6, 30),
            array(5, 6, 30),
            array(6, 6, 30),
            array(7, 9, 30),
            array(8, 9, 30),
            array(9, 9, 30),
            array(10, 12, 31),
            array(11, 12, 31),
            array(12, 12, 31),
        );
    }

    /**
     * @dataProvider \Tests\Carbon\StartEndOfTest::dataProviderTestEndOfQuarter
     *
     * @param int $month
     * @param int $endOfQuarterMonth
     * @param int $endOfQuarterDay
     */
    public function testEndOfQuarter($month, $endOfQuarterMonth, $endOfQuarterDay)
    {
        // @TODO Fix this feature for PHP 7.1.3 => 7.1.5
        $this->excludePhpVersionsRange('7.1.3', '7.1.5');

        $dt = Carbon::create(2015, $month, 15, 1, 2, 3);
        $this->assertCarbon($dt->endOfQuarter(), 2015, $endOfQuarterMonth, $endOfQuarterDay, 23, 59, 59, 999999);
    }

    public function testAverageIsFluid()
    {
        $dt = Carbon::now()->average();
        $this->assertInstanceOfCarbon($dt);
    }

    public function testAverageFromSame()
    {
        $dt1 = Carbon::create(2000, 1, 31, 2, 3, 4);
        $dt2 = Carbon::create(2000, 1, 31, 2, 3, 4)->average($dt1);
        $this->assertCarbon($dt2, 2000, 1, 31, 2, 3, 4);
    }

    public function testAverageFromGreater()
    {
        $dt1 = Carbon::create(2000, 1, 1, 1, 1, 1);
        $dt2 = Carbon::create(2009, 12, 31, 23, 59, 59)->average($dt1);
        $this->assertCarbon($dt2, 2004, 12, 31, 12, 30, 30);
    }

    public function testAverageFromLower()
    {
        $dt1 = Carbon::create(2009, 12, 31, 23, 59, 59);
        $dt2 = Carbon::create(2000, 1, 1, 1, 1, 1)->average($dt1);
        $this->assertCarbon($dt2, 2004, 12, 31, 12, 30, 30);
    }

    public function testAverageWithCloseDates()
    {
        $this->requirePhpVersion('7.1.8');

        $dt1 = Carbon::parse('2004-01-24 09:46:56.500000');
        $dt2 = Carbon::parse('2004-01-24 09:46:56.600000');

        $this->assertSame('2004-01-24 09:46:56.550000', $dt1->average($dt2)->format('Y-m-d H:i:s.u'));

        $dt1 = Carbon::parse('2004-01-24 09:46:56.500000');
        $dt2 = Carbon::parse('2004-01-24 09:46:56.600000');

        $this->assertSame('2004-01-24 09:46:56.550000', $dt2->average($dt1)->format('Y-m-d H:i:s.u'));

        $dt1 = Carbon::parse('2018-05-07 12:34:46.960000');
        $dt2 = Carbon::parse('2018-05-07 12:34:47.330000');

        $this->assertSame('2018-05-07 12:34:47.145000', $dt1->average($dt2)->format('Y-m-d H:i:s.u'));

        $dt1 = Carbon::parse('2018-05-07 12:34:46.960000');
        $dt2 = Carbon::parse('2018-05-07 12:34:47.330000');

        $this->assertSame('2018-05-07 12:34:47.145000', $dt2->average($dt1)->format('Y-m-d H:i:s.u'));

        $dt1 = Carbon::parse('2018-05-07 12:34:46.060000');
        $dt2 = Carbon::parse('2018-05-07 12:34:48.000000');

        $this->assertSame('2018-05-07 12:34:47.030000', $dt1->average($dt2)->format('Y-m-d H:i:s.u'));

        $dt1 = Carbon::parse('2018-05-07 12:34:46.060000');
        $dt2 = Carbon::parse('2018-05-07 12:34:48.000000');

        $this->assertSame('2018-05-07 12:34:47.030000', $dt2->average($dt1)->format('Y-m-d H:i:s.u'));

        $dt1 = Carbon::parse('2018-05-07 12:34:49.490000');
        $dt2 = Carbon::parse('2018-05-07 12:34:47.000000');

        $this->assertSame('2018-05-07 12:34:48.245000', $dt1->average($dt2)->format('Y-m-d H:i:s.u'));
    }

    public function testAverageWithFarDates()
    {
        $this->requirePhpVersion('7.1.8');

        $dt1 = Carbon::parse('-2018-05-07 12:34:46.500000', 'UTC');
        $dt2 = Carbon::parse('6025-10-11 20:59:06.600000', 'UTC');

        $this->assertSame('2004-01-24 04:46:56.550000', $dt1->average($dt2)->format('Y-m-d H:i:s.u'));

        $dt1 = Carbon::parse('-2018-05-07 12:34:46.500000', 'UTC');
        $dt2 = Carbon::parse('6025-10-11 20:59:06.600000', 'UTC');

        $this->assertSame('2004-01-24 04:46:56.550000', $dt2->average($dt1)->format('Y-m-d H:i:s.u'));
    }
}
