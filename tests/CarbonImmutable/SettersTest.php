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
use Carbon\Exceptions\UnitException;
use Carbon\Month;
use DateTimeZone;
use InvalidArgumentException;
use PHPUnit\Framework\Attributes\TestWith;
use RuntimeException;
use Tests\AbstractTestCase;

class SettersTest extends AbstractTestCase
{
    public function testYearSetter()
    {
        $this->expectExceptionObject(new RuntimeException(
            'Carbon\CarbonImmutable class is immutable.',
        ));

        $d = Carbon::now();
        $d->year = 1995;
    }

    public function testMonthSetter()
    {
        $this->expectExceptionObject(new RuntimeException(
            'Carbon\CarbonImmutable class is immutable.',
        ));

        $d = Carbon::now();
        $d->month = 3;
    }

    public function testMonthEnumOnWrongUnit()
    {
        $this->expectExceptionObject(new UnitException(
            'Month enum cannot be used to set hour',
        ));

        $d = Carbon::now();
        $d->setHours(Month::February);
    }

    public function testMonthEnum()
    {
        $d = Carbon::parse('2023-10-25 21:14:51');
        $result = $d->setMonth(Month::February);

        $this->assertSame('2023-02-25 21:14:51', $result->format('Y-m-d H:i:s'));

        $result = $d->setMonth(Month::July);

        $this->assertSame('2023-07-25 21:14:51', $result->format('Y-m-d H:i:s'));
    }

    public function testMonthFloatFailWithDecimalPart()
    {
        $this->expectExceptionObject(new InvalidArgumentException(
            'month cannot be changed to float value 2.5, integer expected',
        ));

        $d = Carbon::parse('2023-10-25 21:14:51');
        $d->setMonth(2.5);
    }

    public function testMonthFloatPassWithZeroDecimalPart()
    {
        $d = Carbon::parse('2023-10-25 21:14:51');
        $result = $d->setMonth(2.0);

        $this->assertSame('2023-02-25 21:14:51', $result->format('Y-m-d H:i:s'));
    }

    public function testMonthSetterWithWrap()
    {
        $this->expectExceptionObject(new RuntimeException(
            'Carbon\CarbonImmutable class is immutable.',
        ));

        $d = Carbon::now();
        $d->month = 13;
    }

    public function testDaySetter()
    {
        $this->expectExceptionObject(new RuntimeException(
            'Carbon\CarbonImmutable class is immutable.',
        ));

        $d = Carbon::now();
        $d->day = 2;
    }

    public function testDaySetterWithWrap()
    {
        $this->expectExceptionObject(new RuntimeException(
            'Carbon\CarbonImmutable class is immutable.',
        ));

        $d = Carbon::createFromDate(2012, 8, 5);
        $d->day = 32;
    }

    public function testHourSetter()
    {
        $this->expectExceptionObject(new RuntimeException(
            'Carbon\CarbonImmutable class is immutable.',
        ));

        $d = Carbon::now();
        $d->hour = 2;
    }

    public function testHourSetterWithWrap()
    {
        $this->expectExceptionObject(new RuntimeException(
            'Carbon\CarbonImmutable class is immutable.',
        ));

        $d = Carbon::now();
        $d->hour = 25;
    }

    public function testMinuteSetter()
    {
        $this->expectExceptionObject(new RuntimeException(
            'Carbon\CarbonImmutable class is immutable.',
        ));

        $d = Carbon::now();
        $d->minute = 2;
    }

    public function testMinuteSetterWithWrap()
    {
        $this->expectExceptionObject(new RuntimeException(
            'Carbon\CarbonImmutable class is immutable.',
        ));

        $d = Carbon::now();
        $d->minute = 65;
    }

    public function testSecondSetter()
    {
        $this->expectExceptionObject(new RuntimeException(
            'Carbon\CarbonImmutable class is immutable.',
        ));

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

    public function testSecondSetterWithWrap()
    {
        $this->expectExceptionObject(new RuntimeException(
            'Carbon\CarbonImmutable class is immutable.',
        ));

        $d = Carbon::now();
        $d->second = 65;
    }

    public function testTimestampSetter()
    {
        $this->expectExceptionObject(new RuntimeException(
            'Carbon\CarbonImmutable class is immutable.',
        ));

        $d = Carbon::now();
        $d->timestamp = 10;
    }

    public function testSetTimezoneWithInvalidTimezone()
    {
        $this->expectExceptionObject(new InvalidArgumentException(
            'Unknown or bad timezone (sdf)',
        ));

        $d = Carbon::now();
        $d->setTimezone('sdf');
    }

    public function testTimezoneWithInvalidTimezone()
    {
        $this->expectExceptionObject(new RuntimeException(
            'Carbon\CarbonImmutable class is immutable.',
        ));

        /** @var mixed $d */
        $d = Carbon::now();
        $d->timezone = 'sdf';
    }

    public function testTimezoneWithInvalidTimezoneSetter()
    {
        $this->expectExceptionObject(new InvalidArgumentException(
            'Unknown or bad timezone (sdf)',
        ));

        $d = Carbon::now();
        $d->timezone('sdf');
    }

    public function testTzWithInvalidTimezone()
    {
        $this->expectExceptionObject(new RuntimeException(
            'Carbon\CarbonImmutable class is immutable.',
        ));

        /** @var mixed $d */
        $d = Carbon::now();
        $d->tz = 'sdf';
    }

    public function testTzWithInvalidTimezoneSetter()
    {
        $this->expectExceptionObject(new InvalidArgumentException(
            'Unknown or bad timezone (sdf)',
        ));

        $d = Carbon::now();
        $d->tz('sdf');
    }

    public function testSetTimezoneUsingString()
    {
        $d = Carbon::now();
        $d = $d->setTimezone('America/Toronto');
        $this->assertSame('America/Toronto', $d->tzName);
    }

    public function testShiftTimezone()
    {
        $d = Carbon::parse('2018-08-13 10:53:12', 'Europe/Paris');
        $d2 = $d->copy()->setTimezone('America/Toronto');
        $this->assertSame(0, $d2->getTimestamp() - $d->getTimestamp());
        $this->assertSame('04:53:12', $d2->format('H:i:s'));

        $d = Carbon::parse('2018-08-13 10:53:12', 'Europe/Paris');
        $d2 = $d->copy()->shiftTimezone('America/Toronto');
        $this->assertSame(21600, $d2->getTimestamp() - $d->getTimestamp());
        $this->assertSame('America/Toronto', $d2->tzName);
        $this->assertSame('10:53:12', $d2->format('H:i:s'));

        $d = Carbon::parse('2018-03-25 00:53:12.321654 America/Toronto')->shiftTimezone('Europe/Oslo');
        $this->assertSame('2018-03-25 00:53:12.321654 Europe/Oslo', $d->format('Y-m-d H:i:s.u e'));
    }

    public function testTimezoneUsingString()
    {
        $this->expectExceptionObject(new RuntimeException(
            'Carbon\CarbonImmutable class is immutable.',
        ));

        /** @var mixed $d */
        $d = Carbon::now();
        $d->timezone = 'America/Toronto';
    }

    public function testTzUsingString()
    {
        $this->expectExceptionObject(new RuntimeException(
            'Carbon\CarbonImmutable class is immutable.',
        ));

        /** @var mixed $d */
        $d = Carbon::now();
        $d->tz = 'America/Toronto';
    }

    public function testSetTimezoneUsingDateTimeZone()
    {
        $d = Carbon::now();
        $d = $d->setTimezone(new DateTimeZone('America/Toronto'));
        $this->assertSame('America/Toronto', $d->tzName);
    }

    public function testTimezoneUsingDateTimeZone()
    {
        $this->expectExceptionObject(new RuntimeException(
            'Carbon\CarbonImmutable class is immutable.',
        ));

        /** @var mixed $d */
        $d = Carbon::now();
        $d->timezone = new DateTimeZone('America/Toronto');
    }

    public function testTzUsingDateTimeZone()
    {
        $this->expectExceptionObject(new RuntimeException(
            'Carbon\CarbonImmutable class is immutable.',
        ));

        /** @var mixed $d */
        $d = Carbon::now();
        $d->tz = new DateTimeZone('America/Toronto');
    }

    public function testInvalidSetter()
    {
        $this->expectExceptionObject(new RuntimeException(
            'Carbon\CarbonImmutable class is immutable.',
        ));

        /** @var mixed $d */
        $d = Carbon::now();
        $d->doesNotExit = 'bb';
    }

    #[TestWith([9, 15, 30, '09:15:30'])]
    #[TestWith([9, 15, 0, '09:15'])]
    #[TestWith([9, 0, 0, '09'])]
    #[TestWith([9, 5, 3, '9:5:3'])]
    #[TestWith([9, 5, 0, '9:5'])]
    #[TestWith([9, 0, 0, '9'])]
    public function testSetTimeFromTimeString(int $hour, int $minute, int $second, string $time)
    {
        Carbon::setTestNow(Carbon::create(2016, 2, 12, 1, 2, 3));
        $d = Carbon::now()->setTimeFromTimeString($time);
        $this->assertCarbon($d, 2016, 2, 12, $hour, $minute, $second);
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
        $d->setMidDayAt(11);
        $this->assertSame(11, $d->getMidDayAt());
        $d->setMidDayAt(12);
        $this->assertSame(12, $d->getMidDayAt());
    }

    public function testSetter()
    {
        $d = Carbon::now();
        $d->setMidDayAt(11);
        $this->assertSame(11, $d->getMidDayAt());
        $d->setMidDayAt(12);
        $this->assertSame(12, $d->getMidDayAt());
    }

    public function testSetUnitNoOverflowFebruary()
    {
        $d = Carbon::parse('2024-02-29')->setUnitNoOverFlow('day', 31, 'month');

        $this->assertInstanceOf(Carbon::class, $d);
        $this->assertSame('2024-02-29 23:59:59.999999', $d->format('Y-m-d H:i:s.u'));
    }
}
