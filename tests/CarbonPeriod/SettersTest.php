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

namespace Tests\CarbonPeriod;

use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Carbon\CarbonInterval;
use DateInterval;
use DateTime;
use InvalidArgumentException;
use Tests\AbstractTestCase;
use Tests\CarbonPeriod\Fixtures\AbstractCarbon;

class SettersTest extends AbstractTestCase
{
    public function testSetStartDate()
    {
        $periodClass = static::$periodClass;
        $period = new $periodClass();

        $period = $period->setStartDate('2018-03-25');

        $this->assertSame('2018-03-25', $period->getStartDate()->toDateString());
    }

    public function testSetEndDate()
    {
        $periodClass = static::$periodClass;
        $period = new $periodClass();

        $period = $period->setEndDate('2018-04-25');

        $this->assertSame('2018-04-25', $period->getEndDate()->toDateString());
    }

    public function testSetDateInterval()
    {
        $periodClass = static::$periodClass;
        $period = new $periodClass();

        $period = $period->setDateInterval('P3D');

        $this->assertSame('P3D', $period->getDateInterval()->spec());
    }

    public function testSetDateIntervalFromStringFormat()
    {
        $periodClass = static::$periodClass;
        $period = new $periodClass();

        $period = $period->setDateInterval('1w 3d 4h 32m 23s');

        $this->assertSame('P10DT4H32M23S', $period->getDateInterval()->spec());
    }

    public function testSetRecurrences()
    {
        $periodClass = static::$periodClass;
        $period = new $periodClass();

        $period = $period->setRecurrences(5);

        $this->assertSame(5, $period->getRecurrences());
    }

    public function testSetDates()
    {
        $periodClass = static::$periodClass;
        $period = new $periodClass();

        $period = $period->setDates('2019-04-12', '2019-04-19');

        $this->assertSame('2019-04-12', $period->getStartDate()->toDateString());
        $this->assertSame('2019-04-19', $period->getEndDate()->toDateString());
    }

    public function testSetOptions()
    {
        $periodClass = static::$periodClass;
        $period = new $periodClass();

        $period = $period->setOptions($options = $periodClass::EXCLUDE_START_DATE | $periodClass::EXCLUDE_END_DATE);

        $this->assertSame($options, $period->getOptions());
    }

    public function testSetDateClass()
    {
        $periodClass = static::$periodClass;
        $period = new $periodClass('2001-01-01', '2001-01-02');

        $period = $period->setDateClass(CarbonImmutable::class);

        $this->assertSame($periodClass::IMMUTABLE, $period->getOptions());
        $this->assertInstanceOf(CarbonImmutable::class, $period->toArray()[0]);

        $period = $period->setDateClass(Carbon::class);

        $this->assertSame(0, $period->getOptions());
        $this->assertInstanceOf(Carbon::class, $period->toArray()[0]);

        $period = $period->toggleOptions($periodClass::IMMUTABLE, true);
        $this->assertSame(CarbonImmutable::class, $period->getDateClass());
        $this->assertInstanceOf(CarbonImmutable::class, $period->toArray()[0]);

        $period = $period->toggleOptions($periodClass::IMMUTABLE, false);
        $this->assertSame(Carbon::class, $period->getDateClass());
        $this->assertInstanceOf(Carbon::class, $period->toArray()[0]);

        if (PHP_VERSION < 8.4) {
            $period = $period->setDateClass(AbstractCarbon::class);
            $this->assertSame(AbstractCarbon::class, $period->getDateClass());
        }
    }

    public function testSetDateClassInvalidArgumentException()
    {
        $this->expectExceptionObject(new InvalidArgumentException(
            'Given class does not implement Carbon\CarbonInterface: Carbon\CarbonInterval',
        ));

        $periodClass = static::$periodClass;
        $period = new $periodClass('2001-01-01', '2001-01-02');

        $period->setDateClass(CarbonInterval::class);
    }

    public function testInvalidInterval()
    {
        $this->expectExceptionObject(new InvalidArgumentException(
            'Invalid interval.',
        ));

        $periodClass = static::$periodClass;
        $periodClass::create()->setDateInterval(new DateTime());
    }

    public function testEmptyInterval()
    {
        $this->expectExceptionObject(new InvalidArgumentException(
            'Empty interval is not accepted.',
        ));

        $periodClass = static::$periodClass;
        $periodClass::create()->setDateInterval(new DateInterval('P0D'));
    }

    public function testInvalidNegativeNumberOfRecurrences()
    {
        $this->expectExceptionObject(new InvalidArgumentException(
            'Invalid number of recurrences.',
        ));

        $periodClass = static::$periodClass;
        $periodClass::create()->setRecurrences(-4);
    }

    public function testInvalidConstructorParameters()
    {
        $this->expectExceptionObject(new InvalidArgumentException(
            'Invalid constructor parameters.',
        ));

        $periodClass = static::$periodClass;
        $periodClass::create([]);
    }

    public function testInvalidStartDate()
    {
        $this->expectExceptionObject(new InvalidArgumentException(
            'Invalid start date.',
        ));

        $periodClass = static::$periodClass;
        $periodClass::create()->setStartDate(new DateInterval('P1D'));
    }

    public function testInvalidEndDate()
    {
        $this->expectExceptionObject(new InvalidArgumentException(
            'Invalid end date.',
        ));

        $periodClass = static::$periodClass;
        $periodClass::create()->setEndDate(new DateInterval('P1D'));
    }

    public function testToggleOptions()
    {
        $periodClass = static::$periodClass;
        $start = $periodClass::EXCLUDE_START_DATE;
        $end = $periodClass::EXCLUDE_END_DATE;

        $period = new $periodClass();

        $period = $period->toggleOptions($start, true);
        $this->assertPeriodOptions($start, $period);

        $period = $period->toggleOptions($end, true);
        $this->assertPeriodOptions($start | $end, $period);

        $period = $period->toggleOptions($start, false);
        $this->assertPeriodOptions($end, $period);

        $period = $period->toggleOptions($end, false);
        $this->assertPeriodOptions(0, $period);
    }

    public function testToggleOptionsOnAndOff()
    {
        $periodClass = static::$periodClass;
        $start = $periodClass::EXCLUDE_START_DATE;
        $end = $periodClass::EXCLUDE_END_DATE;

        $period = new $periodClass();

        $period = $period->toggleOptions($start);
        $this->assertPeriodOptions($start, $period);

        $period = $period->toggleOptions($start);
        $this->assertPeriodOptions(0, $period);

        $period = $period->setOptions($start);
        $period = $period->toggleOptions($start | $end);
        $this->assertSame($start | $end, $period->getOptions());

        $period = $period->toggleOptions($end);
        $this->assertSame($start, $period->getOptions());

        $period = $period->toggleOptions($end);
        $this->assertSame($start | $end, $period->getOptions());

        $period = $period->toggleOptions($start | $end);
        $this->assertSame(0, $period->getOptions());
    }

    public function testSetStartDateInclusiveOrExclusive()
    {
        $periodClass = static::$periodClass;
        $period = new $periodClass();

        $period = $period->setStartDate('2018-03-25');
        $this->assertFalse($period->isStartExcluded());

        $period = $period->setStartDate('2018-03-25', false);
        $this->assertTrue($period->isStartExcluded());

        $period = $period->setStartDate('2018-03-25', true);
        $this->assertFalse($period->isStartExcluded());
    }

    public function testSetEndDateInclusiveOrExclusive()
    {
        $periodClass = static::$periodClass;
        $period = new $periodClass();

        $period = $period->setEndDate('2018-04-25');
        $this->assertFalse($period->isEndExcluded());

        $period = $period->setEndDate('2018-04-25', false);
        $this->assertTrue($period->isEndExcluded());

        $period = $period->setEndDate('2018-04-25', true);
        $this->assertFalse($period->isEndExcluded());
    }

    public function testInvertDateInterval()
    {
        $periodClass = static::$periodClass;
        $period = new $periodClass();

        $period = $period->invertDateInterval();
        $this->assertSame(1, $period->getDateInterval()->invert);

        $period = $period->invertDateInterval();
        $this->assertSame(0, $period->getDateInterval()->invert);

        $period = $periodClass::create('2018-04-29', 7);
        $dates = [];
        foreach ($period as $key => $date) {
            if ($key === 3) {
                $period->invert()->start($date);
            }
            $dates[] = $date->format('m-d');
        }

        $this->assertSame([
            '04-29', '04-30', '05-01', '05-02', '05-01', '04-30', '04-29',
        ], $dates);
    }

    public function testExcludeStartDate()
    {
        $periodClass = static::$periodClass;
        $period = new $periodClass();

        $period = $period->excludeStartDate();
        $this->assertPeriodOptions($periodClass::EXCLUDE_START_DATE, $period);

        $period = $period->excludeStartDate(true);
        $this->assertPeriodOptions($periodClass::EXCLUDE_START_DATE, $period);

        $period = $period->excludeStartDate(false);
        $this->assertPeriodOptions(0, $period);
    }

    public function testExcludeEndDate()
    {
        $periodClass = static::$periodClass;
        $period = new $periodClass();

        $period = $period->excludeEndDate();
        $this->assertPeriodOptions($periodClass::EXCLUDE_END_DATE, $period);

        $period = $period->excludeEndDate(true);
        $this->assertPeriodOptions($periodClass::EXCLUDE_END_DATE, $period);

        $period = $period->excludeEndDate(false);
        $this->assertPeriodOptions(0, $period);
    }

    public function testSetRelativeDates()
    {
        $periodClass = static::$periodClass;
        $period = new $periodClass();

        $period = $period->setDates('first monday of may 2018', 'last day of may 2018 noon');

        $this->assertSame('2018-05-07 00:00:00', $period->getStartDate()->toDateTimeString());
        $this->assertSame('2018-05-31 12:00:00', $period->getEndDate()->toDateTimeString());
    }

    public function testFluentSetters()
    {
        $periodClass = static::$periodClass;
        Carbon::setTestNowAndTimezone(Carbon::now('UTC'));

        $period = CarbonInterval::days(3)->toPeriod()->since('2018-04-21')->until('2018-04-27');
        $dates = [];
        foreach ($period as $date) {
            $dates[] = $date->format('m-d');
        }

        $this->assertSame(['04-21', '04-24', '04-27'], $dates);

        $period = CarbonInterval::days(3)->toPeriod('2018-04-21', '2018-04-27');
        $dates = [];
        foreach ($period as $date) {
            $dates[] = $date->format('m-d');
        }

        $this->assertSame(['04-21', '04-24', '04-27'], $dates);

        $someDateTime = new DateTime('2010-05-06 02:00:00');
        $someCarbon = new Carbon('2010-05-06 13:00:00');

        $period = $periodClass::every('2 hours')->between($someDateTime, $someCarbon)->options($periodClass::EXCLUDE_START_DATE);
        $hours = [];
        foreach ($period as $date) {
            $hours[] = $date->format('H');
        }

        $this->assertSame(['04', '06', '08', '10', '12'], $hours);

        $period = $periodClass::options($periodClass::EXCLUDE_START_DATE)->stepBy(CarbonInterval::hours(2))->since('yesterday 19:00')->until('tomorrow 03:30');
        $hours = [];
        foreach ($period as $date) {
            $hours[] = $date->format('j H');
        }
        $d1 = Carbon::yesterday()->day;
        $d2 = Carbon::today()->day;
        $d3 = Carbon::tomorrow()->day;

        $this->assertSame([
            "$d1 21",
            "$d1 23",
            "$d2 01",
            "$d2 03",
            "$d2 05",
            "$d2 07",
            "$d2 09",
            "$d2 11",
            "$d2 13",
            "$d2 15",
            "$d2 17",
            "$d2 19",
            "$d2 21",
            "$d2 23",
            "$d3 01",
            "$d3 03",
        ], $hours);

        $period = $periodClass::between('first day of january this year', 'first day of next month')->interval('1 week');

        $this->assertEquals(new Carbon('first day of january this year'), $period->getStartDate());
        $this->assertEquals(new Carbon('first day of next month'), $period->getEndDate());
        $this->assertSame('1 week', $period->getDateInterval()->forHumans());

        $opt = $periodClass::EXCLUDE_START_DATE;
        $int = '20 days';
        $start = '2000-01-03';
        $end = '2000-03-15';
        $inclusive = false;
        $period = $periodClass::options($opt)->setDateInterval($int)->setStartDate($start, $inclusive)->setEndDate($end, $inclusive);

        $this->assertSame($start, $period->getStartDate()->format('Y-m-d'));
        $this->assertSame($end, $period->getEndDate()->format('Y-m-d'));
        $this->assertSame(20, $period->getDateInterval()->dayz);
        $this->assertSame($periodClass::EXCLUDE_START_DATE | $periodClass::EXCLUDE_END_DATE, $period->getOptions());

        $inclusive = true;
        $period = $periodClass::options($opt)->setDateInterval($int)->setStartDate($start, $inclusive)->setEndDate($end, $inclusive);

        $this->assertSame($start, $period->getStartDate()->format('Y-m-d'));
        $this->assertSame($end, $period->getEndDate()->format('Y-m-d'));
        $this->assertSame(20, $period->getDateInterval()->dayz);
        $this->assertSame(0, $period->getOptions());

        $period = $periodClass::options($opt)->setDateInterval($int)->setDates($start, $end);

        $this->assertSame($start, $period->getStartDate()->format('Y-m-d'));
        $this->assertSame($end, $period->getEndDate()->format('Y-m-d'));
        $this->assertSame(20, $period->getDateInterval()->dayz);
        $this->assertSame($opt, $period->getOptions());
    }

    public function testSetTimezone(): void
    {
        $periodClass = static::$periodClass;
        $period = $periodClass::create(
            '2018-03-25 00:00 America/Toronto',
            'PT1H',
            '2018-03-25 12:00 Europe/London',
        )->setTimezone('Europe/Oslo');

        $this->assertSame('2018-03-25 06:00 Europe/Oslo', $period->getStartDate()->format('Y-m-d H:i e'));
        $this->assertSame('2018-03-25 13:00 Europe/Oslo', $period->getEndDate()->format('Y-m-d H:i e'));

        $period = $periodClass::create(
            '2018-03-25 00:00 America/Toronto',
            'PT1H',
            5,
        )->setTimezone('Europe/Oslo');

        $this->assertSame('2018-03-25 06:00 Europe/Oslo', $period->getStartDate()->format('Y-m-d H:i e'));
        $this->assertNull($period->getEndDate());
        $this->assertSame('2018-03-25 10:00 Europe/Oslo', $period->calculateEnd()->format('Y-m-d H:i e'));
    }

    public function testShiftTimezone(): void
    {
        $periodClass = static::$periodClass;
        $period = $periodClass::create(
            '2018-03-25 00:00 America/Toronto',
            'PT1H',
            '2018-03-25 12:00 Europe/London',
        )->shiftTimezone('Europe/Oslo');

        $this->assertSame('2018-03-25 00:00 Europe/Oslo', $period->getStartDate()->format('Y-m-d H:i e'));
        $this->assertSame('2018-03-25 12:00 Europe/Oslo', $period->getEndDate()->format('Y-m-d H:i e'));

        $period = $periodClass::create(
            '2018-03-26 00:00 America/Toronto',
            'PT1H',
            5,
        )->shiftTimezone('Europe/Oslo');

        $this->assertSame('2018-03-26 00:00 Europe/Oslo', $period->getStartDate()->format('Y-m-d H:i e'));
        $this->assertNull($period->getEndDate());
        $this->assertSame('2018-03-26 04:00 Europe/Oslo', $period->calculateEnd()->format('Y-m-d H:i e'));
    }
}
