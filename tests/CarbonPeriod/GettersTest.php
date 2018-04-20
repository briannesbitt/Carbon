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

use Carbon\Carbon;
use Carbon\CarbonPeriod;
use DateInterval;
use DateTime;
use Tests\AbstractTestCase;

class GettersTest extends AbstractTestCase
{
    protected function makePeriod()
    {
        return CarbonPeriod::create(
            new DateTime('2012-07-01 17:30:00'),
            new DateInterval('P3DT5H'),
            new DateTime('2012-07-15 11:15:00')
        );
    }

    /**
     * @throws \ReflectionException
     */
    public function testGetStartDate()
    {
        $date = $this->makePeriod()->getStartDate();

        $this->assertInstanceOfCarbon($date);

        $this->assertSame('2012-07-01 17:30:00', $date->format('Y-m-d H:i:s'));
    }

    /**
     * @throws \ReflectionException
     */
    public function testGetEndDate()
    {
        $date = $this->makePeriod()->getEndDate();

        $this->assertInstanceOfCarbon($date);

        $this->assertSame('2012-07-15 11:15:00', $date->format('Y-m-d H:i:s'));
    }

    /**
     * @throws \ReflectionException
     */
    public function testGetDateInterval()
    {
        $interval = $this->makePeriod()->getDateInterval();

        $this->assertInstanceOfCarbonInterval($interval);

        $this->assertSame('P3DT5H', $interval->spec());
    }

    /**
     * @throws \ReflectionException
     */
    public function testGetRecurrences()
    {
        $recurrences = CarbonPeriod::create(new DateTime, 5)->getRecurrences();

        $this->assertSame(5, $recurrences);
    }

    /**
     * @throws \ReflectionException
     */
    public function testGetDateIntervalFromDefault()
    {
        $period = CarbonPeriod::create(Carbon::parse('2015-09-30'), Carbon::parse('2015-10-03'));

        $this->assertInstanceOf('Carbon\CarbonInterval', $period->getDateInterval());

        $this->assertSame('1 day', $period->getDateInterval()->forHumans());
    }

    /**
     * @throws \ReflectionException
     */
    public function testGetEndDateFromCarbons()
    {
        $period = CarbonPeriod::create(Carbon::parse('2015-09-30'), Carbon::parse('2015-10-03'));

        $period->getEndDate()->addDays(3);

        $this->assertSame('2015-10-06', $period->getEndDate()->format('Y-m-d'));
    }

    /**
     * @throws \ReflectionException
     */
    public function testGetStartDateFromCarbons()
    {
        $period = CarbonPeriod::create(Carbon::parse('2015-09-30'), Carbon::parse('2015-10-03'));

        $period->getStartDate()->subDays(3);

        $this->assertSame('2015-09-27', $period->getStartDate()->format('Y-m-d'));
    }

    /**
     * @throws \ReflectionException
     */
    public function testGetDatePeriod()
    {
        $period = CarbonPeriod::create(Carbon::parse('2015-09-30'), Carbon::parse('2015-10-03'));

        $this->assertInstanceOf('DatePeriod', $period->getDatePeriod());
    }

    /**
     * @throws \ReflectionException
     */
    public function testGetIterator()
    {
        $period = CarbonPeriod::create(Carbon::parse('2015-09-30'), Carbon::parse('2015-10-03'));
        $results = array();
        foreach ($period->getIterator() as $date) {
            $this->assertInstanceOf('DateTime', $date);
            $this->assertInstanceOf('Carbon\Carbon', $date);
            $results[] = $date->format('Y-m-d');
        }
        $this->assertSame(array(
            '2015-09-30',
            '2015-10-01',
            '2015-10-02',
        ), $results);

        $period = CarbonPeriod::create(new DateTime('2015-09-30'), new DateTime('2015-10-03'));
        $results = array();
        foreach ($period->getIterator() as $date) {
            $this->assertInstanceOf('DateTime', $date);
            $this->assertNotInstanceOf('Carbon\Carbon', $date);
            $results[] = $date->format('Y-m-d');
        }
        $this->assertSame(array(
            '2015-09-30',
            '2015-10-01',
            '2015-10-02',
        ), $results);
    }

    /**
     * @throws \ReflectionException
     */
    public function testGetEndDateMutable()
    {
        if (version_compare(phpversion(), '5.6.5', '<')) {
            $this->markTestSkipped('DatePeriod getters not available before PHP 5.6.5');
        }

        $period = CarbonPeriod::create(Carbon::parse('2015-09-30'), Carbon::parse('2015-10-03'));
        $period->getEndDate()->addDays(3);
        $this->assertSame('2015-10-06', $period->getEndDate()->format('Y-m-d'));
        $this->assertSame('2015-10-03', $period->getDatePeriod()->getEndDate()->format('Y-m-d'), 'the dates should remains immutable inside the original period');
        $period->getDatePeriod()->getEndDate()->modify('+3 days');
        $this->assertSame('2015-10-03', $period->getDatePeriod()->getEndDate()->format('Y-m-d'), 'the dates should remains immutable inside the original period');
        $results = array();
        foreach ($period as $date) {
            $results[] = $date->format('Y-m-d');
        }
        $this->assertSame(array(
            '2015-09-30',
            '2015-10-01',
            '2015-10-02',
        ), $results);
    }
}
