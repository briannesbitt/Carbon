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

class GettersTest extends TestFixture
{

    public function testGettersThrowExceptionOnUnknownGetter()
    {
        $this->setExpectedException('InvalidArgumentException');
        CarbonImmutable::create(1234, 5, 6, 7, 8, 9)->sdfsdfss;
    }

    public function testYearGetter()
    {
        $d = CarbonImmutable::create(1234, 5, 6, 7, 8, 9);
        $this->assertSame(1234, $d->year);
    }

    public function testYearIsoGetter()
    {
        $d = CarbonImmutable::createFromDate(2012, 12, 31);
        $this->assertSame(2013, $d->yearIso);
    }

    public function testMonthGetter()
    {
        $d = CarbonImmutable::create(1234, 5, 6, 7, 8, 9);
        $this->assertSame(5, $d->month);
    }

    public function testDayGetter()
    {
        $d = CarbonImmutable::create(1234, 5, 6, 7, 8, 9);
        $this->assertSame(6, $d->day);
    }

    public function testHourGetter()
    {
        $d = CarbonImmutable::create(1234, 5, 6, 7, 8, 9);
        $this->assertSame(7, $d->hour);
    }

    public function testMinuteGetter()
    {
        $d = CarbonImmutable::create(1234, 5, 6, 7, 8, 9);
        $this->assertSame(8, $d->minute);
    }

    public function testSecondGetter()
    {
        $d = CarbonImmutable::create(1234, 5, 6, 7, 8, 9);
        $this->assertSame(9, $d->second);
    }

    public function testMicroGetter()
    {
        $micro = 345678;
        $d     = CarbonImmutable::parse('2014-01-05 12:34:11.' . $micro);
        $this->assertSame($micro, $d->micro);
    }

    public function testMicroGetterWithDefaultNow()
    {
        $d = CarbonImmutable::now();
        $this->assertSame(0, $d->micro);
    }

    public function testDayOfWeeGetter()
    {
        $d = CarbonImmutable::create(2012, 5, 7, 7, 8, 9);
        $this->assertSame(CarbonImmutable::MONDAY, $d->dayOfWeek);
    }

    public function testDayOfYearGetter()
    {
        $d = CarbonImmutable::createFromDate(2012, 5, 7);
        $this->assertSame(127, $d->dayOfYear);
    }

    public function testDaysInMonthGetter()
    {
        $d = CarbonImmutable::createFromDate(2012, 5, 7);
        $this->assertSame(31, $d->daysInMonth);
    }

    public function testTimestampGetter()
    {
        $d = CarbonImmutable::create();
        $d = $d->setTimezone('GMT');
        $this->assertSame(0, $d->setDateTime(1970, 1, 1, 0, 0, 0)->timestamp);
    }

    public function testGetAge()
    {
        $d = CarbonImmutable::now();
        $this->assertSame(0, $d->age);
    }

    public function testGetAgeWithRealAge()
    {
        $d   = CarbonImmutable::createFromDate(1975, 5, 21);
        $age = intval(substr(date('Ymd') - date('Ymd', $d->timestamp), 0, -4));

        $this->assertSame($age, $d->age);
    }

    public function testGetQuarterFirst()
    {
        $d = CarbonImmutable::createFromDate(2012, 1, 1);
        $this->assertSame(1, $d->quarter);
    }

    public function testGetQuarterFirstEnd()
    {
        $d = CarbonImmutable::createFromDate(2012, 3, 31);
        $this->assertSame(1, $d->quarter);
    }

    public function testGetQuarterSecond()
    {
        $d = CarbonImmutable::createFromDate(2012, 4, 1);
        $this->assertSame(2, $d->quarter);
    }

    public function testGetQuarterThird()
    {
        $d = CarbonImmutable::createFromDate(2012, 7, 1);
        $this->assertSame(3, $d->quarter);
    }

    public function testGetQuarterFourth()
    {
        $d = CarbonImmutable::createFromDate(2012, 10, 1);
        $this->assertSame(4, $d->quarter);
    }

    public function testGetQuarterFirstLast()
    {
        $d = CarbonImmutable::createFromDate(2012, 12, 31);
        $this->assertSame(4, $d->quarter);
    }

    public function testGetLocalTrue()
    {
        // Default timezone has been set to America/Toronto in TestFixture.php
        // @see : http://en.wikipedia.org/wiki/List_of_UTC_time_offsets
        $this->assertTrue(CarbonImmutable::createFromDate(2012, 1, 1, 'America/Toronto')->local);
        $this->assertTrue(CarbonImmutable::createFromDate(2012, 1, 1, 'America/New_York')->local);
    }

    public function testGetLocalFalse()
    {
        $this->assertFalse(CarbonImmutable::createFromDate(2012, 7, 1, 'UTC')->local);
        $this->assertFalse(CarbonImmutable::createFromDate(2012, 7, 1, 'Europe/London')->local);
    }

    public function testGetUtcFalse()
    {
        $this->assertFalse(CarbonImmutable::createFromDate(2013, 1, 1, 'America/Toronto')->utc);
        $this->assertFalse(CarbonImmutable::createFromDate(2013, 1, 1, 'Europe/Paris')->utc);
    }

    public function testGetUtcTrue()
    {
        $this->assertTrue(CarbonImmutable::createFromDate(2013, 1, 1, 'Atlantic/Reykjavik')->utc);
        $this->assertTrue(CarbonImmutable::createFromDate(2013, 1, 1, 'Europe/Lisbon')->utc);
        $this->assertTrue(CarbonImmutable::createFromDate(2013, 1, 1, 'Africa/Casablanca')->utc);
        $this->assertTrue(CarbonImmutable::createFromDate(2013, 1, 1, 'Africa/Dakar')->utc);
        $this->assertTrue(CarbonImmutable::createFromDate(2013, 1, 1, 'Europe/Dublin')->utc);
        $this->assertTrue(CarbonImmutable::createFromDate(2013, 1, 1, 'Europe/London')->utc);
        $this->assertTrue(CarbonImmutable::createFromDate(2013, 1, 1, 'UTC')->utc);
        $this->assertTrue(CarbonImmutable::createFromDate(2013, 1, 1, 'GMT')->utc);
    }

    public function testGetDstFalse()
    {
        $this->assertFalse(CarbonImmutable::createFromDate(2012, 1, 1, 'America/Toronto')->dst);
    }

    public function testGetDstTrue()
    {
        $this->assertTrue(CarbonImmutable::createFromDate(2012, 7, 1, 'America/Toronto')->dst);
    }

    public function testOffsetForTorontoWithDST()
    {
        $this->assertSame(-18000, CarbonImmutable::createFromDate(2012, 1, 1, 'America/Toronto')->offset);
    }

    public function testOffsetForTorontoNoDST()
    {
        $this->assertSame(-14400, CarbonImmutable::createFromDate(2012, 6, 1, 'America/Toronto')->offset);
    }

    public function testOffsetForGMT()
    {
        $this->assertSame(0, CarbonImmutable::createFromDate(2012, 6, 1, 'GMT')->offset);
    }

    public function testOffsetHoursForTorontoWithDST()
    {
        $this->assertSame(-5, CarbonImmutable::createFromDate(2012, 1, 1, 'America/Toronto')->offsetHours);
    }

    public function testOffsetHoursForTorontoNoDST()
    {
        $this->assertSame(-4, CarbonImmutable::createFromDate(2012, 6, 1, 'America/Toronto')->offsetHours);
    }

    public function testOffsetHoursForGMT()
    {
        $this->assertSame(0, CarbonImmutable::createFromDate(2012, 6, 1, 'GMT')->offsetHours);
    }

    public function testIsLeapYearTrue()
    {
        $this->assertTrue(CarbonImmutable::createFromDate(2012, 1, 1)->isLeapYear());
    }

    public function testIsLeapYearFalse()
    {
        $this->assertFalse(CarbonImmutable::createFromDate(2011, 1, 1)->isLeapYear());
    }

    public function testWeekOfMonth()
    {
        $this->assertSame(5, CarbonImmutable::createFromDate(2012, 9, 30)->weekOfMonth);
        $this->assertSame(4, CarbonImmutable::createFromDate(2012, 9, 28)->weekOfMonth);
        $this->assertSame(3, CarbonImmutable::createFromDate(2012, 9, 20)->weekOfMonth);
        $this->assertSame(2, CarbonImmutable::createFromDate(2012, 9, 8)->weekOfMonth);
        $this->assertSame(1, CarbonImmutable::createFromDate(2012, 9, 1)->weekOfMonth);
    }

    public function testWeekOfYearFirstWeek()
    {
        $this->assertSame(52, CarbonImmutable::createFromDate(2012, 1, 1)->weekOfYear);
        $this->assertSame(1, CarbonImmutable::createFromDate(2012, 1, 2)->weekOfYear);
    }

    public function testWeekOfYearLastWeek()
    {
        $this->assertSame(52, CarbonImmutable::createFromDate(2012, 12, 30)->weekOfYear);
        $this->assertSame(1, CarbonImmutable::createFromDate(2012, 12, 31)->weekOfYear);
    }

    public function testGetTimezone()
    {
        $dt = CarbonImmutable::createFromDate(2000, 1, 1, 'America/Toronto');
        $this->assertSame('America/Toronto', $dt->timezone->getName());
    }

    public function testGetTz()
    {
        $dt = CarbonImmutable::createFromDate(2000, 1, 1, 'America/Toronto');
        $this->assertSame('America/Toronto', $dt->tz->getName());
    }

    public function testGetTimezoneName()
    {
        $dt = CarbonImmutable::createFromDate(2000, 1, 1, 'America/Toronto');
        $this->assertSame('America/Toronto', $dt->timezoneName);
    }

    public function testGetTzName()
    {
        $dt = CarbonImmutable::createFromDate(2000, 1, 1, 'America/Toronto');
        $this->assertSame('America/Toronto', $dt->tzName);
    }

    public function testInvalidGetter()
    {
        $this->setExpectedException('InvalidArgumentException');
        $d  = CarbonImmutable::now();
        $bb = $d->doesNotExit;
    }
}
