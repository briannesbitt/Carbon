<?php

/*
 * This file is part of the Carbon package.
 *
 * (c) Brian Nesbitt <brian@nesbot.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tests\CarbonImmutable;

use Carbon\CarbonImmutable as Carbon;
use DateTimeZone;
use Tests\AbstractTestCase;

class SettersTest extends AbstractTestCase
{
    /**
     * @expectedException \RuntimeException
     * @expectedExceptionMessage Carbon\CarbonImmutable class is immutable.
     */
    public function testYearSetter()
    {
        $d = Carbon::now();
        $d->year = 1995;
    }

    /**
     * @expectedException \RuntimeException
     * @expectedExceptionMessage Carbon\CarbonImmutable class is immutable.
     */
    public function testMonthSetter()
    {
        $d = Carbon::now();
        $d->month = 3;
    }

    /**
     * @expectedException \RuntimeException
     * @expectedExceptionMessage Carbon\CarbonImmutable class is immutable.
     */
    public function testMonthSetterWithWrap()
    {
        $d = Carbon::now();
        $d->month = 13;
    }

    /**
     * @expectedException \RuntimeException
     * @expectedExceptionMessage Carbon\CarbonImmutable class is immutable.
     */
    public function testDaySetter()
    {
        $d = Carbon::now();
        $d->day = 2;
    }

    /**
     * @expectedException \RuntimeException
     * @expectedExceptionMessage Carbon\CarbonImmutable class is immutable.
     */
    public function testDaySetterWithWrap()
    {
        $d = Carbon::createFromDate(2012, 8, 5);
        $d->day = 32;
    }

    /**
     * @expectedException \RuntimeException
     * @expectedExceptionMessage Carbon\CarbonImmutable class is immutable.
     */
    public function testHourSetter()
    {
        $d = Carbon::now();
        $d->hour = 2;
    }

    /**
     * @expectedException \RuntimeException
     * @expectedExceptionMessage Carbon\CarbonImmutable class is immutable.
     */
    public function testHourSetterWithWrap()
    {
        $d = Carbon::now();
        $d->hour = 25;
    }

    /**
     * @expectedException \RuntimeException
     * @expectedExceptionMessage Carbon\CarbonImmutable class is immutable.
     */
    public function testMinuteSetter()
    {
        $d = Carbon::now();
        $d->minute = 2;
    }

    /**
     * @expectedException \RuntimeException
     * @expectedExceptionMessage Carbon\CarbonImmutable class is immutable.
     */
    public function testMinuteSetterWithWrap()
    {
        $d = Carbon::now();
        $d->minute = 65;
    }

    /**
     * @expectedException \RuntimeException
     * @expectedExceptionMessage Carbon\CarbonImmutable class is immutable.
     */
    public function testSecondSetter()
    {
        $d = Carbon::now();
        $d->second = 2;
    }

    public function testTimeSetter()
    {
        $d = Carbon::now();
        $d = $d->setTime(1, 1, 1);
        $this->assertSame(1, $d->second);
        $d = $d->setTime(1, 1);
        $this->assertSame(0, $d->second);
    }

    public function testTimeSetterWithChaining()
    {
        $d = Carbon::now();
        $d = $d->setTime(2, 2, 2)->setTime(1, 1, 1);
        $this->assertInstanceOfCarbon($d);
        $this->assertSame(1, $d->second);
        $d = $d->setTime(2, 2, 2)->setTime(1, 1);
        $this->assertInstanceOfCarbon($d);
        $this->assertSame(0, $d->second);
    }

    public function testTimeSetterWithZero()
    {
        $d = Carbon::now();
        $d = $d->setTime(1, 1);
        $this->assertSame(0, $d->second);
    }

    public function testDateTimeSetter()
    {
        $d = Carbon::now();
        $d = $d->setDateTime($d->year, $d->month, $d->day, 1, 1, 1);
        $this->assertSame(1, $d->second);
    }

    public function testDateTimeSetterWithZero()
    {
        $d = Carbon::now();
        $d = $d->setDateTime($d->year, $d->month, $d->day, 1, 1);
        $this->assertSame(0, $d->second);
    }

    public function testDateTimeSetterWithChaining()
    {
        $d = Carbon::now();
        $d = $d->setDateTime(2013, 9, 24, 17, 4, 29);
        $this->assertInstanceOfCarbon($d);
        $d = $d->setDateTime(2014, 10, 25, 18, 5, 30);
        $this->assertInstanceOfCarbon($d);
        $this->assertCarbon($d, 2014, 10, 25, 18, 5, 30);
    }

    /**
     * @link https://github.com/briannesbitt/Carbon/issues/539
     */
    public function testSetDateAfterStringCreation()
    {
        $d = new Carbon('first day of this month');
        $this->assertSame(1, $d->day);
        $d = $d->setDate($d->year, $d->month, 12);
        $this->assertSame(12, $d->day);
    }

    /**
     * @expectedException \RuntimeException
     * @expectedExceptionMessage Carbon\CarbonImmutable class is immutable.
     */
    public function testSecondSetterWithWrap()
    {
        $d = Carbon::now();
        $d->second = 65;
    }

    /**
     * @expectedException \RuntimeException
     * @expectedExceptionMessage Carbon\CarbonImmutable class is immutable.
     */
    public function testTimestampSetter()
    {
        $d = Carbon::now();
        $d->timestamp = 10;
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testSetTimezoneWithInvalidTimezone()
    {
        $d = Carbon::now();
        $d->setTimezone('sdf');
    }

    /**
     * @expectedException \RuntimeException
     * @expectedExceptionMessage Carbon\CarbonImmutable class is immutable.
     */
    public function testTimezoneWithInvalidTimezone()
    {
        $d = Carbon::now();
        $d->timezone = 'sdf';
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Unknown or bad timezone (sdf)
     */
    public function testTimezoneWithInvalidTimezoneSetter()
    {
        $d = Carbon::now();
        $d->timezone('sdf');
    }

    /**
     * @expectedException \RuntimeException
     * @expectedExceptionMessage Carbon\CarbonImmutable class is immutable.
     */
    public function testTzWithInvalidTimezone()
    {
        $d = Carbon::now();
        $d->tz = 'sdf';
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Unknown or bad timezone (sdf)
     */
    public function testTzWithInvalidTimezoneSetter()
    {
        $d = Carbon::now();
        $d->tz('sdf');
    }

    public function testSetTimezoneUsingString()
    {
        $d = Carbon::now();
        $d = $d->setTimezone('America/Toronto');
        $this->assertSame('America/Toronto', $d->tzName);
    }

    /**
     * @expectedException \RuntimeException
     * @expectedExceptionMessage Carbon\CarbonImmutable class is immutable.
     */
    public function testTimezoneUsingString()
    {
        $d = Carbon::now();
        $d->timezone = 'America/Toronto';
    }

    /**
     * @expectedException \RuntimeException
     * @expectedExceptionMessage Carbon\CarbonImmutable class is immutable.
     */
    public function testTzUsingString()
    {
        $d = Carbon::now();
        $d->tz = 'America/Toronto';
    }

    public function testSetTimezoneUsingDateTimeZone()
    {
        $d = Carbon::now();
        $d = $d->setTimezone(new DateTimeZone('America/Toronto'));
        $this->assertSame('America/Toronto', $d->tzName);
    }

    /**
     * @expectedException \RuntimeException
     * @expectedExceptionMessage Carbon\CarbonImmutable class is immutable.
     */
    public function testTimezoneUsingDateTimeZone()
    {
        $d = Carbon::now();
        $d->timezone = new DateTimeZone('America/Toronto');
    }

    /**
     * @expectedException \RuntimeException
     * @expectedExceptionMessage Carbon\CarbonImmutable class is immutable.
     */
    public function testTzUsingDateTimeZone()
    {
        $d = Carbon::now();
        $d->tz = new DateTimeZone('America/Toronto');
    }

    /**
     * @expectedException \RuntimeException
     * @expectedExceptionMessage Carbon\CarbonImmutable class is immutable.
     */
    public function testInvalidSetter()
    {
        $d = Carbon::now();
        $d->doesNotExit = 'bb';
    }

    /**
     * @dataProvider \Tests\Carbon\SettersTest::dataProviderTestSetTimeFromTimeString
     *
     * @param int    $hour
     * @param int    $minute
     * @param int    $second
     * @param string $time
     */
    public function testSetTimeFromTimeString($hour, $minute, $second, $time)
    {
        Carbon::setTestNow(Carbon::create(2016, 2, 12, 1, 2, 3));
        $d = Carbon::now()->setTimeFromTimeString($time);
        $this->assertCarbon($d, 2016, 2, 12, $hour, $minute, $second);
    }

    public function dataProviderTestSetTimeFromTimeString()
    {
        return [
            [9, 15, 30, '09:15:30'],
            [9, 15, 0, '09:15'],
            [9, 0, 0, '09'],
            [9, 5, 3, '9:5:3'],
            [9, 5, 0, '9:5'],
            [9, 0, 0, '9'],
        ];
    }

    public function testWeekendDaysSetter()
    {
        $weekendDays = [Carbon::FRIDAY, Carbon::SATURDAY];
        $d = Carbon::now();
        $d->setWeekendDays($weekendDays);
        $this->assertSame($weekendDays, $d->getWeekendDays());
        Carbon::setWeekendDays([Carbon::SATURDAY, Carbon::SUNDAY]);
    }

    public function testMidDayAtSetter()
    {
        $d = Carbon::now();
        $d->setMidDayAt(12);
        $this->assertSame(12, $d->getMidDayAt());
    }
}
