<?php

/*
 * This file is part of the Carbon package.
 *
 * (c) Brian Nesbitt <brian@nesbot.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tests\CarbonPeriod;

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

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Invalid interval.
     */
    public function testInvalidInterval()
    {
        CarbonPeriod::create()->setDateInterval(new DateTime);
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Empty interval is not accepted.
     */
    public function testEmptyInterval()
    {
        CarbonPeriod::create()->setDateInterval(new DateInterval('P0D'));
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Invalid number of recurrences.
     */
    public function testInvalidNumberOfRecurrencesString()
    {
        CarbonPeriod::create()->setRecurrences('foo');
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Invalid number of recurrences.
     */
    public function testInvalidNegativeNumberOfRecurrences()
    {
        CarbonPeriod::create()->setRecurrences(-4);
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Invalid options.
     */
    public function testInvalidOptions()
    {
        CarbonPeriod::create()->setOptions('1');
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Invalid constructor parameters.
     */
    public function testInvalidConstructorParameters()
    {
        CarbonPeriod::create(array());
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Invalid start date.
     */
    public function testInvalidStartDate()
    {
        CarbonPeriod::create()->setStartDate(new DateInterval('P1D'));
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Invalid end date.
     */
    public function testInvalidEndDate()
    {
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
}
