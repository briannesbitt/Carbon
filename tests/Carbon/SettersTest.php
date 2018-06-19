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
use DateTimeZone;
use Tests\AbstractTestCase;

class SettersTest extends AbstractTestCase
{
    public function testSingularUnit()
    {
        $this->assertSame('year', Carbon::singularUnit('year'));
        $this->assertSame('year', Carbon::singularUnit('Years'));
        $this->assertSame('century', Carbon::singularUnit('centuries'));
        $this->assertSame('millennium', Carbon::singularUnit('Millennia'));
        $this->assertSame('millennium', Carbon::singularUnit('millenniums'));
    }

    public function testPluralUnit()
    {
        $this->assertSame('years', Carbon::pluralUnit('year'));
        $this->assertSame('years', Carbon::pluralUnit('Years'));
        $this->assertSame('centuries', Carbon::pluralUnit('century'));
        $this->assertSame('centuries', Carbon::pluralUnit('centuries'));
        $this->assertSame('millennia', Carbon::pluralUnit('Millennia'));
        $this->assertSame('millennia', Carbon::pluralUnit('millenniums'));
        $this->assertSame('millennia', Carbon::pluralUnit('millennium'));
    }

    public function testSet()
    {
        $d = Carbon::create(2000, 1, 12);
        $d->set([
            'year' => 1995,
            'month' => 4,
        ]);
        $this->assertSame(1995, $d->year);
        $this->assertSame(4, $d->month);
        $this->assertSame(12, $d->day);
    }

    public function testYearSetter()
    {
        $d = Carbon::now();
        $d->year = 1995;
        $this->assertSame(1995, $d->year);
    }

    public function testMonthSetter()
    {
        $d = Carbon::now();
        $d->month = 3;
        $this->assertSame(3, $d->month);
    }

    public function testMonthSetterWithWrap()
    {
        $d = Carbon::now();
        $d->month = 13;
        $this->assertSame(1, $d->month);
    }

    public function testDaySetter()
    {
        $d = Carbon::now();
        $d->day = 2;
        $this->assertSame(2, $d->day);
    }

    public function testDaySetterWithWrap()
    {
        $d = Carbon::createFromDate(2012, 8, 5);
        $d->day = 32;
        $this->assertSame(1, $d->day);
    }

    public function testHourSetter()
    {
        $d = Carbon::now();
        $d->hour = 2;
        $this->assertSame(2, $d->hour);
    }

    public function testHourSetterWithWrap()
    {
        $d = Carbon::now();
        $d->hour = 25;
        $this->assertSame(1, $d->hour);
    }

    public function testMinuteSetter()
    {
        $d = Carbon::now();
        $d->minute = 2;
        $this->assertSame(2, $d->minute);
    }

    public function testMinuteSetterWithWrap()
    {
        $d = Carbon::now();
        $d->minute = 65;
        $this->assertSame(5, $d->minute);
    }

    public function testSecondSetter()
    {
        $d = Carbon::now();
        $d->second = 2;
        $this->assertSame(2, $d->second);
    }

    public function testTimeSetter()
    {
        $d = Carbon::now();
        $d->setTime(1, 1, 1);
        $this->assertSame(1, $d->second);
        $d->setTime(1, 1);
        $this->assertSame(0, $d->second);
    }

    public function testTimeSetterWithChaining()
    {
        $d = Carbon::now();
        $d->setTime(2, 2, 2)->setTime(1, 1, 1);
        $this->assertInstanceOfCarbon($d);
        $this->assertSame(1, $d->second);
        $d->setTime(2, 2, 2)->setTime(1, 1);
        $this->assertInstanceOfCarbon($d);
        $this->assertSame(0, $d->second);
    }

    public function testTimeSetterWithZero()
    {
        $d = Carbon::now();
        $d->setTime(1, 1);
        $this->assertSame(0, $d->second);
    }

    public function testDateTimeSetter()
    {
        $d = Carbon::now();
        $d->setDateTime($d->year, $d->month, $d->day, 1, 1, 1);
        $this->assertSame(1, $d->second);
    }

    public function testDateTimeSetterWithZero()
    {
        $d = Carbon::now();
        $d->setDateTime($d->year, $d->month, $d->day, 1, 1);
        $this->assertSame(0, $d->second);
    }

    public function testDateTimeSetterWithChaining()
    {
        $d = Carbon::now();
        $d->setDateTime(2013, 9, 24, 17, 4, 29);
        $this->assertInstanceOfCarbon($d);
        $d->setDateTime(2014, 10, 25, 18, 5, 30);
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
        $d->setDate($d->year, $d->month, 12);
        $this->assertSame(12, $d->day);
    }

    public function testSecondSetterWithWrap()
    {
        $d = Carbon::now();
        $d->second = 65;
        $this->assertSame(5, $d->second);
    }

    public function testMicrosecondSetterWithWrap()
    {
        $d = Carbon::now();
        $d->micro = -4;
        $this->assertSame(999996, $d->micro);
        $this->assertSame((Carbon::now()->second + 59) % 60, $d->second);
        $d->micro = 3123456;
        $this->assertSame(123456, $d->micro);
        $this->assertSame((Carbon::now()->second + 2) % 60, $d->second);
        $d->micro -= 12123400;
        $this->assertSame(56, $d->micro);
        $this->assertSame((Carbon::now()->second + 50) % 60, $d->second);
        $d->micro = -12600000;
        $this->assertSame(400000, $d->micro);
        $this->assertSame((Carbon::now()->second + 37) % 60, $d->second);
        $d->milliseconds = 123;
        $this->assertSame(123, $d->milli);
        $this->assertSame(123000, $d->micro);
    }

    public function testTimestampSetter()
    {
        $d = Carbon::now();
        $d->timestamp = 10;
        $this->assertSame(10, $d->timestamp);

        $d->setTimestamp(11);
        $this->assertSame(11, $d->timestamp);
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
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Unknown or bad timezone (sdf)
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
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Unknown or bad timezone (sdf)
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
        $d->setTimezone('America/Toronto');
        $this->assertSame('America/Toronto', $d->tzName);
    }

    public function testTimezoneUsingString()
    {
        $d = Carbon::now();
        $d->timezone = 'America/Toronto';
        $this->assertSame('America/Toronto', $d->tzName);

        $d->timezone('America/Vancouver');
        $this->assertSame('America/Vancouver', $d->tzName);
    }

    public function testTzUsingString()
    {
        $d = Carbon::now();
        $d->tz = 'America/Toronto';
        $this->assertSame('America/Toronto', $d->tzName);
        $this->assertSame('America/Toronto', $d->tz());

        $d->tz('America/Vancouver');
        $this->assertSame('America/Vancouver', $d->tzName);
        $this->assertSame('America/Vancouver', $d->tz());
    }

    public function testTzUsingOffset()
    {
        $d = Carbon::create(2000, 8, 1, 0, 0, 0);
        $d->offset = 7200;
        $this->assertSame(7200, $d->offset);
        $this->assertSame(120, $d->offsetMinutes);
        $this->assertSame(2, $d->offsetHours);
        $this->assertSame(120, $d->utcOffset());

        $d->utcOffset(-180);
        $this->assertSame(-10800, $d->offset);
        $this->assertSame(-180, $d->offsetMinutes);
        $this->assertSame(-3, $d->offsetHours);
        $this->assertSame(-180, $d->utcOffset());

        $d->offsetMinutes = -240;
        $this->assertSame(-14400, $d->offset);
        $this->assertSame(-240, $d->offsetMinutes);
        $this->assertSame(-4, $d->offsetHours);
        $this->assertSame(-240, $d->utcOffset());

        $d->offsetHours = 1;
        $this->assertSame(3600, $d->offset);
        $this->assertSame(60, $d->offsetMinutes);
        $this->assertSame(1, $d->offsetHours);
        $this->assertSame(60, $d->utcOffset());
    }

    public function testSetTimezoneUsingDateTimeZone()
    {
        $d = Carbon::now();
        $d->setTimezone(new DateTimeZone('America/Toronto'));
        $this->assertSame('America/Toronto', $d->tzName);
    }

    public function testTimezoneUsingDateTimeZone()
    {
        $d = Carbon::now();
        $d->timezone = new DateTimeZone('America/Toronto');
        $this->assertSame('America/Toronto', $d->tzName);

        $d->timezone(new DateTimeZone('America/Vancouver'));
        $this->assertSame('America/Vancouver', $d->tzName);
    }

    public function testTzUsingDateTimeZone()
    {
        $d = Carbon::now();
        $d->tz = new DateTimeZone('America/Toronto');
        $this->assertSame('America/Toronto', $d->tzName);

        $d->tz(new DateTimeZone('America/Vancouver'));
        $this->assertSame('America/Vancouver', $d->tzName);
    }

    /**
     * @expectedException \InvalidArgumentException
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
        $weekendDays = [Carbon::FRIDAY,Carbon::SATURDAY];
        $d = Carbon::now();
        $d->setWeekendDays($weekendDays);
        $this->assertSame($weekendDays, $d->getWeekendDays());
        Carbon::setWeekendDays([Carbon::SATURDAY, Carbon::SUNDAY]);
    }

    public function testMidDayAtSetter()
    {
        $d = Carbon::now();
        $d->setMidDayAt(11);
        $this->assertSame(11, $d->getMidDayAt());
        $d->setMidDayAt(12);
        $this->assertSame(12, $d->getMidDayAt());
    }
}
