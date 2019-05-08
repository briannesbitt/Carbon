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
use Carbon\CarbonPeriod;
use DateInterval;
use DateTime;
use Tests\AbstractTestCase;

class SettersTest extends AbstractTestCase
{
    public function testSetStartDate()
    {
        $period = new CarbonPeriod;

        $period->setStartDate('2018-03-25');

        $this->assertSame('2018-03-25', $period->getStartDate()->toDateString());
    }

    public function testSetEndDate()
    {
        $period = new CarbonPeriod;

        $period->setEndDate('2018-04-25');

        $this->assertSame('2018-04-25', $period->getEndDate()->toDateString());
    }

    public function testSetDateInterval()
    {
        $period = new CarbonPeriod;

        $period->setDateInterval('P3D');

        $this->assertSame('P3D', $period->getDateInterval()->spec());
    }

    public function testSetDateIntervalFromStringFormat()
    {
        $period = new CarbonPeriod;

        $period->setDateInterval('1w 3d 4h 32m 23s');

        $this->assertSame('P10DT4H32M23S', $period->getDateInterval()->spec());
    }

    public function testSetRecurrences()
    {
        $period = new CarbonPeriod;

        $period->setRecurrences(5);

        $this->assertSame(5, $period->getRecurrences());
    }

    public function testSetDates()
    {
        $period = new CarbonPeriod;

        $period->setDates('2019-04-12', '2019-04-19');

        $this->assertSame('2019-04-12', $period->getStartDate()->toDateString());
        $this->assertSame('2019-04-19', $period->getEndDate()->toDateString());
    }

    public function testSetOptions()
    {
        $period = new CarbonPeriod;

        $period->setOptions($options = CarbonPeriod::EXCLUDE_START_DATE | CarbonPeriod::EXCLUDE_END_DATE);

        $this->assertSame($options, $period->getOptions());
    }

    public function testSetDateClass()
    {
        $period = new CarbonPeriod('2001-01-01', '2001-01-02');

        $period->setDateClass(CarbonImmutable::class);

        $this->assertNotSame(0, $period->getOptions() & CarbonPeriod::IMMUTABLE);
        $this->assertInstanceOf(CarbonImmutable::class, $period->toArray()[0]);

        $period->setDateClass(Carbon::class);

        $this->assertSame(0, $period->getOptions() & CarbonPeriod::IMMUTABLE);
        $this->assertInstanceOf(Carbon::class, $period->toArray()[0]);

        $period->toggleOptions(CarbonPeriod::IMMUTABLE, true);
        $this->assertSame(CarbonImmutable::class, $period->getDateClass());
        $this->assertInstanceOf(CarbonImmutable::class, $period->toArray()[0]);

        $period->toggleOptions(CarbonPeriod::IMMUTABLE, false);
        $this->assertSame(Carbon::class, $period->getDateClass());
        $this->assertInstanceOf(Carbon::class, $period->toArray()[0]);
    }

    public function testSetDateClassInvalidArgumentException()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage(
            'Given class does not implement Carbon\CarbonInterface: Carbon\CarbonInterval'
        );

        $period = new CarbonPeriod('2001-01-01', '2001-01-02');

        $period->setDateClass(CarbonInterval::class);
    }

    public function testInvalidInterval()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage(
            'Invalid interval.'
        );

        CarbonPeriod::create()->setDateInterval(new DateTime);
    }

    public function testEmptyInterval()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage(
            'Empty interval is not accepted.'
        );

        CarbonPeriod::create()->setDateInterval(new DateInterval('P0D'));
    }

    public function testInvalidNumberOfRecurrencesString()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage(
            'Invalid number of recurrences.'
        );

        CarbonPeriod::create()->setRecurrences('foo');
    }

    public function testInvalidNegativeNumberOfRecurrences()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage(
            'Invalid number of recurrences.'
        );

        CarbonPeriod::create()->setRecurrences(-4);
    }

    public function testInvalidOptions()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage(
            'Invalid options.'
        );

        CarbonPeriod::create()->setOptions('1');
    }

    public function testInvalidConstructorParameters()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage(
            'Invalid constructor parameters.'
        );

        CarbonPeriod::create([]);
    }

    public function testInvalidStartDate()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage(
            'Invalid start date.'
        );

        CarbonPeriod::create()->setStartDate(new DateInterval('P1D'));
    }

    public function testInvalidEndDate()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage(
            'Invalid end date.'
        );

        CarbonPeriod::create()->setEndDate(new DateInterval('P1D'));
    }

    public function testToggleOptions()
    {
        $start = CarbonPeriod::EXCLUDE_START_DATE;
        $end = CarbonPeriod::EXCLUDE_END_DATE;

        $period = new CarbonPeriod;

        $period->toggleOptions($start, true);
        $this->assertSame($start, $period->getOptions());

        $period->toggleOptions($end, true);
        $this->assertSame($start | $end, $period->getOptions());

        $period->toggleOptions($start, false);
        $this->assertSame($end, $period->getOptions());

        $period->toggleOptions($end, false);
        $this->assertEmpty($period->getOptions());
    }

    public function testToggleOptionsOnAndOff()
    {
        $start = CarbonPeriod::EXCLUDE_START_DATE;
        $end = CarbonPeriod::EXCLUDE_END_DATE;

        $period = new CarbonPeriod;

        $period->toggleOptions($start);
        $this->assertSame($start, $period->getOptions());

        $period->toggleOptions($start);
        $this->assertEmpty($period->getOptions());

        $period->setOptions($start);
        $period->toggleOptions($start | $end);
        $this->assertSame($start | $end, $period->getOptions());

        $period->toggleOptions($end);
        $this->assertSame($start, $period->getOptions());

        $period->toggleOptions($end);
        $this->assertSame($start | $end, $period->getOptions());

        $period->toggleOptions($start | $end);
        $this->assertEmpty($period->getOptions());
    }

    public function testSetStartDateInclusiveOrExclusive()
    {
        $period = new CarbonPeriod;

        $period->setStartDate('2018-03-25');
        $this->assertFalse($period->isStartExcluded());

        $period->setStartDate('2018-03-25', false);
        $this->assertTrue($period->isStartExcluded());

        $period->setStartDate('2018-03-25', true);
        $this->assertFalse($period->isStartExcluded());
    }

    public function testSetEndDateInclusiveOrExclusive()
    {
        $period = new CarbonPeriod;

        $period->setEndDate('2018-04-25');
        $this->assertFalse($period->isEndExcluded());

        $period->setEndDate('2018-04-25', false);
        $this->assertTrue($period->isEndExcluded());

        $period->setEndDate('2018-04-25', true);
        $this->assertFalse($period->isEndExcluded());
    }

    public function testInvertDateInterval()
    {
        $period = new CarbonPeriod;

        $period->invertDateInterval();
        $this->assertSame(1, $period->getDateInterval()->invert);

        $period->invertDateInterval();
        $this->assertSame(0, $period->getDateInterval()->invert);

        $period = CarbonPeriod::create('2018-04-29', 7);
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
        $period = new CarbonPeriod;

        $period->excludeStartDate();
        $this->assertSame(CarbonPeriod::EXCLUDE_START_DATE, $period->getOptions());

        $period->excludeStartDate(true);
        $this->assertSame(CarbonPeriod::EXCLUDE_START_DATE, $period->getOptions());

        $period->excludeStartDate(false);
        $this->assertEmpty($period->getOptions());
    }

    public function testExcludeEndDate()
    {
        $period = new CarbonPeriod;

        $period->excludeEndDate();
        $this->assertSame(CarbonPeriod::EXCLUDE_END_DATE, $period->getOptions());

        $period->excludeEndDate(true);
        $this->assertSame(CarbonPeriod::EXCLUDE_END_DATE, $period->getOptions());

        $period->excludeEndDate(false);
        $this->assertEmpty($period->getOptions());
    }

    public function testSetRelativeDates()
    {
        $period = new CarbonPeriod;

        $period->setDates('first monday of may 2018', 'last day of may 2018 noon');

        $this->assertSame('2018-05-07 00:00:00', $period->getStartDate()->toDateTimeString());
        $this->assertSame('2018-05-31 12:00:00', $period->getEndDate()->toDateTimeString());
    }

    public function testFluentSetters()
    {
        Carbon::setTestNow(Carbon::now('UTC'));

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

        $period = CarbonPeriod::every('2 hours')->between($someDateTime, $someCarbon)->options(CarbonPeriod::EXCLUDE_START_DATE);
        $hours = [];
        foreach ($period as $date) {
            $hours[] = $date->format('H');
        }

        $this->assertSame(['04', '06', '08', '10', '12'], $hours);

        $period = CarbonPeriod::options(CarbonPeriod::EXCLUDE_START_DATE)->stepBy(CarbonInterval::hours(2))->since('yesterday 19:00')->until('tomorrow 03:30');
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

        $period = CarbonPeriod::between('first day of january this year', 'first day of next month')->interval('1 week');

        $this->assertEquals(new Carbon('first day of january this year'), $period->getStartDate());
        $this->assertEquals(new Carbon('first day of next month'), $period->getEndDate());
        $this->assertSame('1 week', $period->getDateInterval()->forHumans());

        $opt = CarbonPeriod::EXCLUDE_START_DATE;
        $int = '20 days';
        $start = '2000-01-03';
        $end = '2000-03-15';
        $inclusive = false;
        $period = CarbonPeriod::options($opt)->setDateInterval($int)->setStartDate($start, $inclusive)->setEndDate($end, $inclusive);

        $this->assertEquals($start, $period->getStartDate()->format('Y-m-d'));
        $this->assertEquals($end, $period->getEndDate()->format('Y-m-d'));
        $this->assertSame(20, $period->getDateInterval()->dayz);
        $this->assertSame(CarbonPeriod::EXCLUDE_START_DATE | CarbonPeriod::EXCLUDE_END_DATE, $period->getOptions());

        $inclusive = true;
        $period = CarbonPeriod::options($opt)->setDateInterval($int)->setStartDate($start, $inclusive)->setEndDate($end, $inclusive);

        $this->assertEquals($start, $period->getStartDate()->format('Y-m-d'));
        $this->assertEquals($end, $period->getEndDate()->format('Y-m-d'));
        $this->assertSame(20, $period->getDateInterval()->dayz);
        $this->assertSame(0, $period->getOptions());

        $period = CarbonPeriod::options($opt)->setDateInterval($int)->setDates($start, $end);

        $this->assertEquals($start, $period->getStartDate()->format('Y-m-d'));
        $this->assertEquals($end, $period->getEndDate()->format('Y-m-d'));
        $this->assertSame(20, $period->getDateInterval()->dayz);
        $this->assertSame($opt, $period->getOptions());
    }
}
