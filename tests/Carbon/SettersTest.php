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

namespace Tests\Carbon;

use Carbon\Carbon;
use Carbon\Exceptions\UnitException;
use DateTimeZone;
use Exception;
use Generator;
use InvalidArgumentException;
use Tests\AbstractTestCase;

class SettersTest extends AbstractTestCase
{
    public const SET_UNIT_NO_OVERFLOW_SAMPLE = 200;

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
        $d->microsecond = 3123456;
        $this->assertSame(123456, $d->micro);
        $this->assertSame((Carbon::now()->second + 2) % 60, $d->second);
        $d->micro -= 12123400;
        $this->assertSame(56, $d->micro);
        $this->assertSame((Carbon::now()->second + 50) % 60, $d->second);
        $d->micro = -12600000;
        $this->assertSame(400000, $d->micro);
        $this->assertSame((Carbon::now()->second + 37) % 60, $d->second);
        $d->millisecond = 123;
        $this->assertSame(123, $d->milli);
        $this->assertSame(123000, $d->micro);
        $d->milli = 456;
        $this->assertSame(456, $d->millisecond);
        $this->assertSame(456000, $d->microsecond);
        $d->microseconds(567);
        $this->assertSame(567, $d->microsecond);
        $d->setMicroseconds(678);
        $this->assertSame(678, $d->microsecond);
        $d->milliseconds(567);
        $this->assertSame(567, $d->millisecond);
        $this->assertSame(567000, $d->microsecond);
        $d->setMilliseconds(678);
        $this->assertSame(678, $d->millisecond);
        $this->assertSame(678000, $d->microsecond);
    }

    public function testTimestampSetter()
    {
        $d = Carbon::now();
        $d->timestamp = 10;
        $this->assertSame(10, $d->timestamp);

        $d->setTimestamp(11);
        $this->assertSame(11, $d->timestamp);

        $d->timestamp = 1600887164.88952298;
        $this->assertSame('2020-09-23 14:52:44.889523', $d->format('Y-m-d H:i:s.u'));

        $d->setTimestamp(1599828571.23561248);
        $this->assertSame('2020-09-11 08:49:31.235612', $d->format('Y-m-d H:i:s.u'));

        $d->timestamp = '0.88951247 1600887164';
        $this->assertSame('2020-09-23 14:52:44.889512', $d->format('Y-m-d H:i:s.u'));

        $d->setTimestamp('0.23561248 1599828571');
        $this->assertSame('2020-09-11 08:49:31.235612', $d->format('Y-m-d H:i:s.u'));

        $d->timestamp = '0.88951247/1600887164/12.56';
        $this->assertSame('2020-09-23 14:52:57.449512', $d->format('Y-m-d H:i:s.u'));

        $d->setTimestamp('0.00561248/1599828570--1.23');
        $this->assertSame('2020-09-11 08:49:31.235612', $d->format('Y-m-d H:i:s.u'));
    }

    public function testSetTimezoneWithInvalidTimezone()
    {
        $this->expectExceptionObject(new InvalidArgumentException(
            'Unknown or bad timezone (sdf)'
        ));

        $d = Carbon::now();
        $d->setTimezone('sdf');
    }

    public function testTimezoneWithInvalidTimezone()
    {
        $this->expectExceptionObject(new InvalidArgumentException(
            'Unknown or bad timezone (sdf)'
        ));

        /** @var mixed $d */
        $d = Carbon::now();
        $d->timezone = 'sdf';
    }

    public function testTimeZoneOfUnserialized()
    {
        $date = new Carbon('2020-01-01', 'America/Vancouver');

        $new = unserialize(serialize($date));

        $this->assertSame('America/Vancouver', $date->getTimezone()->getName());

        $date->cleanupDumpProperties()->timezone = 'UTC';

        $this->assertSame('UTC', $date->getTimezone()->getName());

        $this->assertSame('America/Vancouver', $new->getTimezone()->getName());

        $new->timezone = 'UTC';

        $this->assertSame('UTC', $new->getTimezone()->getName());

        /** @var mixed $date */
        $date = new Carbon('2020-01-01', 'America/Vancouver');

        $new = clone $date;

        $this->assertSame('America/Vancouver', $date->getTimezone()->getName());

        $date->timezone = 'UTC';

        $this->assertSame('UTC', $date->getTimezone()->getName());

        $this->assertSame('America/Vancouver', $new->getTimezone()->getName());

        $new->timezone = 'UTC';

        $this->assertSame('UTC', $new->getTimezone()->getName());

        $date = new Carbon('2020-01-01', 'America/Vancouver');

        $this->assertSame('America/Vancouver', $date->getTimezone()->getName());

        var_export($date, true);

        $date->cleanupDumpProperties()->timezone = 'UTC';

        $this->assertSame('UTC', $date->getTimezone()->getName());

        $date = new Carbon('2020-01-01', 'America/Vancouver');

        $this->assertSame('America/Vancouver', $date->getTimezone()->getName());

        /** @var array $array */
        $array = $date;

        foreach ($array as $_) {
        }

        $date->cleanupDumpProperties()->timezone = 'UTC';

        $this->assertSame('UTC', $date->getTimezone()->getName());

        $date = new Carbon('2020-01-01', 'America/Vancouver');

        $this->assertSame('America/Vancouver', $date->getTimezone()->getName());

        get_object_vars($date);

        $date->cleanupDumpProperties()->timezone = 'UTC';

        $this->assertSame('UTC', $date->getTimezone()->getName());
    }

    public function testTimezoneWithInvalidTimezoneSetter()
    {
        $this->expectExceptionObject(new InvalidArgumentException(
            'Unknown or bad timezone (sdf)'
        ));

        $d = Carbon::now();
        $d->timezone('sdf');
    }

    public function testTzWithInvalidTimezone()
    {
        $this->expectExceptionObject(new InvalidArgumentException(
            'Unknown or bad timezone (sdf)'
        ));

        /** @var mixed $d */
        $d = Carbon::now();
        $d->tz = 'sdf';
    }

    public function testTzWithInvalidTimezoneSetter()
    {
        $this->expectExceptionObject(new InvalidArgumentException(
            'Unknown or bad timezone (sdf)'
        ));

        $d = Carbon::now();
        $d->tz('sdf');
    }

    public function testSetTimezoneUsingString()
    {
        $d = Carbon::now();
        $d->setTimezone('America/Toronto');
        $this->assertSame('America/Toronto', $d->tzName);
    }

    public function testShiftTimezone()
    {
        $d = Carbon::parse('2018-08-13 10:53:12', 'Europe/Paris');
        $d2 = $d->copy()->setTimezone('America/Toronto');
        $this->assertSame(0, $d2->getTimestamp() - $d->getTimestamp());
        $this->assertSame('04:53:12', $d2->format('H:i:s'));

        $d = Carbon::parse('2018-08-13 10:53:12.321654', 'Europe/Paris');
        $d2 = $d->copy()->shiftTimezone('America/Toronto');
        $this->assertSame(21600, $d2->getTimestamp() - $d->getTimestamp());
        $this->assertSame('America/Toronto', $d2->tzName);
        $this->assertSame('10:53:12.321654', $d2->format('H:i:s.u'));

        $d = Carbon::parse('2018-03-25 00:53:12.321654 America/Toronto')->shiftTimezone('Europe/Oslo');
        $this->assertSame('2018-03-25 00:53:12.321654 Europe/Oslo', $d->format('Y-m-d H:i:s.u e'));
    }

    public function testTimezoneUsingString()
    {
        /** @var mixed $d */
        $d = Carbon::now();
        $d->timezone = 'America/Toronto';
        $this->assertSame('America/Toronto', $d->tzName);

        $d->timezone('America/Vancouver');
        $this->assertSame('America/Vancouver', $d->tzName);
    }

    public function testTzUsingString()
    {
        /** @var mixed $d */
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

        $d->utcOffset(330);
        $this->assertSame(330, $d->utcOffset());
    }

    public function testSetTimezoneUsingDateTimeZone()
    {
        $d = Carbon::now();
        $d->setTimezone(new DateTimeZone('America/Toronto'));
        $this->assertSame('America/Toronto', $d->tzName);
    }

    public function testTimezoneUsingDateTimeZone()
    {
        /** @var mixed $d */
        $d = Carbon::now();
        $d->timezone = new DateTimeZone('America/Toronto');
        $this->assertSame('America/Toronto', $d->tzName);

        $d->timezone(new DateTimeZone('America/Vancouver'));
        $this->assertSame('America/Vancouver', $d->tzName);
    }

    public function testTzUsingDateTimeZone()
    {
        /** @var mixed $d */
        $d = Carbon::now();
        $d->tz = new DateTimeZone('America/Toronto');
        $this->assertSame('America/Toronto', $d->tzName);

        $d->tz(new DateTimeZone('America/Vancouver'));
        $this->assertSame('America/Vancouver', $d->tzName);
    }

    public function testInvalidSetter()
    {
        $this->expectExceptionObject(new InvalidArgumentException(
            "Unknown setter 'doesNotExit'"
        ));

        /** @var mixed $date */
        $date = Carbon::now();
        $date->doesNotExit = 'bb';
    }

    /**
     * @dataProvider \Tests\Carbon\SettersTest::dataForTestSetTimeFromTimeString
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

    public static function dataForTestSetTimeFromTimeString(): Generator
    {
        yield [9, 15, 30, '09:15:30'];
        yield [9, 15, 0, '09:15'];
        yield [9, 0, 0, '09'];
        yield [9, 5, 3, '9:5:3'];
        yield [9, 5, 0, '9:5'];
        yield [9, 0, 0, '9'];
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

    public function testSetUnitNoOverflow()
    {
        $results = [
            'current' => 0,
            'start' => 0,
            'end' => 0,
            'failure' => 0,
        ];

        for ($i = 0; $i < static::SET_UNIT_NO_OVERFLOW_SAMPLE; $i++) {
            $year = mt_rand(2000, 2500);
            $month = mt_rand(1, 12);
            $day = mt_rand(1, 28);
            $hour = mt_rand(0, 23);
            $minute = mt_rand(0, 59);
            $second = mt_rand(0, 59);
            $microsecond = mt_rand(0, 999999);
            $units = ['millennium', 'century', 'decade', 'year', 'quarter', 'month', 'day', 'hour', 'minute', 'second', 'week'];
            $overflowUnit = $units[mt_rand(0, \count($units) - 1)];
            $units = [
                'year' => 10,
                'month' => 12,
                'day' => 9999,
                'hour' => 24,
                'minute' => 60,
                'second' => 60,
                'microsecond' => 1000000,
            ];
            $valueUnit = array_keys($units)[mt_rand(0, \count($units) - 1)];
            $value = mt_rand() > 0.5 ?
                mt_rand(-9999, 9999) :
                mt_rand(-60, 60);

            $date = Carbon::create($year, $month, $day, $hour, $minute, $second + $microsecond / 1000000);
            $original = $date->copy();
            $date->setUnitNoOverflow($valueUnit, $value, $overflowUnit);
            $start = $original->copy()->startOf($overflowUnit);
            $end = $original->copy()->endOf($overflowUnit);

            if ($date < $start || $date > $end) {
                $results['failure']++;

                continue;
            }

            $unit = ucfirst(Carbon::pluralUnit($valueUnit));
            $modulo = $value % $units[$valueUnit];
            if ($modulo < 0) {
                $modulo += $units[$valueUnit];
            }
            if ($value === $date->$valueUnit ||
                $modulo === $date->$valueUnit ||
                (method_exists($date, "diffInReal$unit") && $$valueUnit - $date->{"diffInReal$unit"}($original, false) === $value) ||
                $$valueUnit - $date->{"diffIn$unit"}($original, false) === $value
            ) {
                $results['current']++;

                continue;
            }

            if ($date->$valueUnit === $start->$valueUnit) {
                $results['start']++;

                continue;
            }

            if ($date->$valueUnit === $end->$valueUnit) {
                $results['end']++;

                continue;
            }

            $this->failOperation(
                $original,
                $date,
                $start,
                $end,
                'setUnitNoOverflow',
                $valueUnit,
                $value,
                $overflowUnit,
                $unit,
                $modulo,
                $$valueUnit
            );
        }

        $minimum = static::SET_UNIT_NO_OVERFLOW_SAMPLE / 100;
        $this->assertSame(0, $results['failure']);
        $this->assertGreaterThan($minimum, $results['start']);
        $this->assertGreaterThan($minimum, $results['end']);
        $this->assertGreaterThan($minimum, $results['current']);
        $this->assertSame(static::SET_UNIT_NO_OVERFLOW_SAMPLE, $results['end'] + $results['start'] + $results['current']);
    }

    public function testSetUnitNoOverflowInputUnitException()
    {
        $this->expectExceptionObject(new InvalidArgumentException(
            'Unknown unit \'anyUnit\''
        ));

        Carbon::now()->setUnitNoOverflow('anyUnit', 1, 'year');
    }

    public function testSetUnitNoOverflowOverflowUnitException()
    {
        $this->expectExceptionObject(new InvalidArgumentException(
            'Unknown unit \'anyUnit\''
        ));

        Carbon::now()->setUnitNoOverflow('minute', 1, 'anyUnit');
    }

    public function testAddUnitError()
    {
        $this->expectExceptionObject(new UnitException(implode("\n", [
            'Unable to add unit array (',
            "  0 => 'foobar',",
            '  1 => 1,',
            ')',
        ])));

        $date = Carbon::parse('2021-09-13');
        @$date->addUnit('foobar', 1);
    }

    public function testAddUnitNoOverflow()
    {
        $results = [
            'current' => 0,
            'start' => 0,
            'end' => 0,
            'failure' => 0,
        ];

        for ($i = 0; $i < static::SET_UNIT_NO_OVERFLOW_SAMPLE; $i++) {
            $year = mt_rand(2000, 2500);
            $month = mt_rand(1, 12);
            $day = mt_rand(1, 28);
            $hour = mt_rand(0, 23);
            $minute = mt_rand(0, 59);
            $second = mt_rand(0, 59);
            $microsecond = mt_rand(0, 999999);
            $units = ['millennium', 'century', 'decade', 'year', 'quarter', 'month', 'day', 'hour', 'minute', 'second', 'week'];
            $overflowUnit = $units[mt_rand(0, \count($units) - 1)];
            $units = [
                'year' => 10,
                'month' => 12,
                'day' => 9999,
                'hour' => 24,
                'minute' => 60,
                'second' => 60,
                'microsecond' => 1000000,
            ];
            $valueUnit = array_keys($units)[mt_rand(0, \count($units) - 1)];
            $value = mt_rand() > 0.5 ?
                mt_rand(-9999, 9999) :
                mt_rand(-60, 60);

            $date = Carbon::create($year, $month, $day, $hour, $minute, $second + $microsecond / 1000000);
            $original = $date->copy();
            $date->addUnitNoOverflow($valueUnit, $value, $overflowUnit);
            $start = $original->copy()->startOf($overflowUnit);
            $end = $original->copy()->endOf($overflowUnit);

            if ($date < $start || $date > $end) {
                $results['failure']++;

                continue;
            }

            $unit = ucfirst(Carbon::pluralUnit($valueUnit));
            $modulo = ($$valueUnit + $value) % $units[$valueUnit];
            if ($modulo < 0) {
                $modulo += $units[$valueUnit];
            }
            if ($value === $date->$valueUnit ||
                $modulo === $date->$valueUnit ||
                (method_exists($date, "diffInReal$unit") && -$date->{"diffInReal$unit"}($original, false) === $value) ||
                -$date->{"diffIn$unit"}($original, false) === $value
            ) {
                $results['current']++;

                continue;
            }

            if ($date->$valueUnit === $start->$valueUnit) {
                $results['start']++;

                continue;
            }

            if ($date->$valueUnit === $end->$valueUnit) {
                $results['end']++;

                continue;
            }

            $this->failOperation(
                $original,
                $date,
                $start,
                $end,
                'addUnitNoOverflow',
                $valueUnit,
                $value,
                $overflowUnit,
                $unit,
                $modulo,
                $$valueUnit
            );
        }

        $minimum = static::SET_UNIT_NO_OVERFLOW_SAMPLE / 100;
        $this->assertSame(0, $results['failure']);
        $this->assertGreaterThan($minimum, $results['start']);
        $this->assertGreaterThan($minimum, $results['end']);
        $this->assertGreaterThan($minimum, $results['current']);
        $this->assertSame(static::SET_UNIT_NO_OVERFLOW_SAMPLE, $results['end'] + $results['start'] + $results['current']);
    }

    public function testSubUnitNoOverflow()
    {
        $results = [
            'current' => 0,
            'start' => 0,
            'end' => 0,
            'failure' => 0,
        ];

        for ($i = 0; $i < static::SET_UNIT_NO_OVERFLOW_SAMPLE; $i++) {
            $year = mt_rand(2000, 2500);
            $month = mt_rand(1, 12);
            $day = mt_rand(1, 28);
            $hour = mt_rand(0, 23);
            $minute = mt_rand(0, 59);
            $second = mt_rand(0, 59);
            $microsecond = mt_rand(0, 999999);
            $units = ['millennium', 'century', 'decade', 'year', 'quarter', 'month', 'day', 'hour', 'minute', 'second', 'week'];
            $overflowUnit = $units[mt_rand(0, \count($units) - 1)];
            $units = [
                'year' => 10,
                'month' => 12,
                'day' => 9999,
                'hour' => 24,
                'minute' => 60,
                'second' => 60,
                'microsecond' => 1000000,
            ];
            $valueUnit = array_keys($units)[mt_rand(0, \count($units) - 1)];
            $value = mt_rand() > 0.5 ?
                mt_rand(-9999, 9999) :
                mt_rand(-60, 60);

            $date = Carbon::create($year, $month, $day, $hour, $minute, $second + $microsecond / 1000000);
            $original = $date->copy();
            $date->subUnitNoOverflow($valueUnit, $value, $overflowUnit);
            $start = $original->copy()->startOf($overflowUnit);
            $end = $original->copy()->endOf($overflowUnit);

            if ($date < $start || $date > $end) {
                $results['failure']++;

                continue;
            }

            $unit = ucfirst(Carbon::pluralUnit($valueUnit));
            $modulo = ($$valueUnit - $value) % $units[$valueUnit];

            if ($modulo < 0) {
                $modulo += $units[$valueUnit];
            }

            if ($value === $date->$valueUnit ||
                $modulo === $date->$valueUnit ||
                (method_exists($date, "diffInReal$unit") && $value === $date->{"diffInReal$unit"}($original, false)) ||
                $value === $date->{"diffIn$unit"}($original, false)
            ) {
                $results['current']++;

                continue;
            }

            if ($date->$valueUnit === $start->$valueUnit) {
                $results['start']++;

                continue;
            }

            if ($date->$valueUnit === $end->$valueUnit) {
                $results['end']++;

                continue;
            }

            $this->failOperation(
                $original,
                $date,
                $start,
                $end,
                'subUnitNoOverflow',
                $valueUnit,
                $value,
                $overflowUnit,
                $unit,
                $modulo,
                $$valueUnit
            );
        }

        $minimum = static::SET_UNIT_NO_OVERFLOW_SAMPLE / 100;
        $this->assertSame(0, $results['failure']);
        $this->assertGreaterThan($minimum, $results['start']);
        $this->assertGreaterThan($minimum, $results['end']);
        $this->assertGreaterThan($minimum, $results['current']);
        $this->assertSame(static::SET_UNIT_NO_OVERFLOW_SAMPLE, $results['end'] + $results['start'] + $results['current']);
    }

    private function failOperation(
        Carbon $original,
        Carbon $date,
        Carbon $start,
        Carbon $end,
        string $method,
        string $valueUnit,
        int $value,
        string $overflowUnit,
        string $unit,
        int $modulo,
        int $variableValue
    ): void {
        throw new Exception(implode("\n", [
            'Unhandled result for: '.
            'Carbon::parse('.var_export($original->format('Y-m-d H:i:s.u'), true).', '.
            var_export($original->timezoneName, true).
            ")->$method(".implode(', ', array_map(function ($value) {
                return var_export($value, true);
            }, [$valueUnit, $value, $overflowUnit])).');',
            'Getting: '.$date->format('Y-m-d H:i:s.u e'),
            "Current $valueUnit: ".$date->$valueUnit,
            'Is neither '.$start->$valueUnit." (from $start)",
            'Nor '.$end->$valueUnit." (from $end)",
            "Nor $value (from value)",
            "Nor $modulo (from modulo)",
            method_exists($date, "diffInReal$unit")
                ? "diffInReal$unit() exists and returns ".$date->{"diffInReal$unit"}($original, false)
                    ." while expecting $variableValue"
                : "diffInReal$unit() does not exist",
            "diffIn$unit() exists and returns ".$date->{"diffIn$unit"}($original, false)
            ." while expecting $variableValue",
        ]));
    }
}
