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
use Carbon\CarbonInterval;
use Carbon\CarbonPeriod;
use DateInterval;
use DateTime;
use Tests\AbstractTestCase;

class CreateTest extends AbstractTestCase
{
    /**
     * @throws \ReflectionException
     */
    public function testCreateWithString()
    {
        $period = CarbonPeriod::create('R4/2012-07-01T00:00:00Z/P7D');
        $results = array();
        foreach ($period as $date) {
            self::assertInstanceOf('Carbon\Carbon', $date);
            $results[] = $date->format('Y-m-d H:i:s');
        }
        self::assertSame(array(
            '2012-07-01 00:00:00',
            '2012-07-08 00:00:00',
            '2012-07-15 00:00:00',
            '2012-07-22 00:00:00',
            '2012-07-29 00:00:00',
        ), $results);
        $period = CarbonPeriod::create('R4/2012-07-01T00:00:00Z/P7D', CarbonPeriod::EXCLUDE_START_DATE);
        $results = array();
        foreach ($period as $date) {
            self::assertInstanceOf('Carbon\Carbon', $date);
            $results[] = $date->format('Y-m-d H:i:s');
        }
        self::assertSame(array(
            '2012-07-08 00:00:00',
            '2012-07-15 00:00:00',
            '2012-07-22 00:00:00',
            '2012-07-29 00:00:00',
        ), $results);

        // Note: EXCLUDE_END_DATE should only matter if end date is specified, recurrences should not be altered
        $period = CarbonPeriod::create('R4/2012-07-01T00:00:00Z/P7D', CarbonPeriod::EXCLUDE_END_DATE);
        $results = array();
        foreach ($period as $date) {
            self::assertInstanceOf('Carbon\Carbon', $date);
            $results[] = $date->format('Y-m-d H:i:s');
        }
        self::assertSame(array(
            '2012-07-01 00:00:00',
            '2012-07-08 00:00:00',
            '2012-07-15 00:00:00',
            '2012-07-22 00:00:00',
            '2012-07-29 00:00:00',
        ), $results);
        $period = CarbonPeriod::create('R4/2012-07-01T00:00:00Z/P7D', CarbonPeriod::EXCLUDE_START_DATE | CarbonPeriod::EXCLUDE_END_DATE);
        $results = array();
        foreach ($period as $date) {
            self::assertInstanceOf('Carbon\Carbon', $date);
            $results[] = $date->format('Y-m-d H:i:s');
        }
        self::assertSame(array(
            '2012-07-08 00:00:00',
            '2012-07-15 00:00:00',
            '2012-07-22 00:00:00',
            '2012-07-29 00:00:00',
        ), $results);

        $period = CarbonPeriod::create('R0/2012-07-01T00:00:00Z/P7D', CarbonPeriod::EXCLUDE_START_DATE);
        $results = array();
        foreach ($period as $date) {
            self::assertInstanceOf('Carbon\Carbon', $date);
            $results[] = $date->format('Y-m-d H:i:s');
        }
        self::assertSame(array(
        ), $results);
    }

    /**
     * @throws \ReflectionException
     */
    public function testCreateWithTwoDates()
    {
        $period = CarbonPeriod::create(Carbon::parse('2015-09-30'), Carbon::parse('2015-10-03'));
        $results = array();
        foreach ($period as $key => $date) {
            self::assertInstanceOf('Carbon\Carbon', $date);
            $results[] = $key.':'.$date->format('Y-m-d');
        }
        self::assertSame(array(
            '0:2015-09-30',
            '1:2015-10-01',
            '2:2015-10-02',
            '3:2015-10-03',
        ), $results);
        self::assertInstanceOf('Carbon\CarbonInterval', $period->getDateInterval());
        self::assertSame('1 day', $period->getDateInterval()->forHumans());

        $period = CarbonPeriod::create(Carbon::parse('2015-09-30'), Carbon::parse('2015-10-03'), CarbonPeriod::EXCLUDE_START_DATE);
        $results = array();
        foreach ($period as $key => $date) {
            self::assertInstanceOf('Carbon\Carbon', $date);
            $results[] = $key.':'.$date->format('Y-m-d');
        }
        self::assertSame(array(
            '0:2015-10-01',
            '1:2015-10-02',
            '2:2015-10-03',
        ), $results);

        $period = CarbonPeriod::create(Carbon::parse('2015-09-30'), Carbon::parse('2015-10-03'), CarbonPeriod::EXCLUDE_END_DATE);
        $results = array();
        foreach ($period as $key => $date) {
            self::assertInstanceOf('Carbon\Carbon', $date);
            $results[] = $key.':'.$date->format('Y-m-d');
        }
        self::assertSame(array(
            '0:2015-09-30',
            '1:2015-10-01',
            '2:2015-10-02',
        ), $results);

        $period = CarbonPeriod::create(Carbon::parse('2015-09-30'), Carbon::parse('2015-10-02'), CarbonPeriod::EXCLUDE_START_DATE | CarbonPeriod::EXCLUDE_END_DATE);
        $results = array();
        foreach ($period as $key => $date) {
            self::assertInstanceOf('Carbon\Carbon', $date);
            $results[] = $key.':'.$date->format('Y-m-d');
        }
        self::assertSame(array(
            '0:2015-10-01',
        ), $results);

        $period = CarbonPeriod::create(Carbon::parse('2015-10-02'), Carbon::parse('2015-10-03'), CarbonPeriod::EXCLUDE_START_DATE | CarbonPeriod::EXCLUDE_END_DATE);
        $results = array();
        foreach ($period as $key => $date) {
            self::assertInstanceOf('Carbon\Carbon', $date);
            $results[] = $key.':'.$date->format('Y-m-d');
        }
        self::assertSame(array(), $results);

        $period = CarbonPeriod::create(Carbon::parse('2015-10-02'), Carbon::parse('2015-10-02'), CarbonPeriod::EXCLUDE_START_DATE | CarbonPeriod::EXCLUDE_END_DATE);
        $results = array();
        foreach ($period as $key => $date) {
            self::assertInstanceOf('Carbon\Carbon', $date);
            $results[] = $key.':'.$date->format('Y-m-d');
        }
        self::assertSame(array(), $results);

        $period = CarbonPeriod::create(Carbon::parse('2015-10-02'), Carbon::parse('2015-10-02'), CarbonPeriod::EXCLUDE_START_DATE);
        $results = array();
        foreach ($period as $key => $date) {
            self::assertInstanceOf('Carbon\Carbon', $date);
            $results[] = $key.':'.$date->format('Y-m-d');
        }
        self::assertSame(array(), $results);

        $period = CarbonPeriod::create(Carbon::parse('2015-10-02'), Carbon::parse('2015-10-02'), CarbonPeriod::EXCLUDE_END_DATE);
        $results = array();
        foreach ($period as $key => $date) {
            self::assertInstanceOf('Carbon\Carbon', $date);
            $results[] = $key.':'.$date->format('Y-m-d');
        }
        self::assertSame(array(), $results);
    }

    /**
     * @throws \ReflectionException
     */
    public function testCreateWithDateAndIntervalAndRecurrences()
    {
        $period = CarbonPeriod::create(Carbon::parse('2018-04-16'), CarbonInterval::days(2), 3);
        $results = array();
        foreach ($period as $date) {
            $results[] = $date->format('Y-m-d');
        }
        $this->assertSame(array(
            '2018-04-16',
            '2018-04-18',
            '2018-04-20',
            '2018-04-22',
        ), $results);
    }

    /**
     * @throws \ReflectionException
     */
    public function testCreateWithDateAndRecurrences()
    {
        $period = CarbonPeriod::create(Carbon::parse('2018-04-16'), 2);
        $results = array();
        foreach ($period as $date) {
            $results[] = $date->format('Y-m-d');
        }
        $this->assertSame(array(
            '2018-04-16',
            '2018-04-17',
            '2018-04-18',
        ), $results);
    }

    /**
     * @throws \ReflectionException
     */
    public function testCreateWithBaseClasses()
    {
        $period = new CarbonPeriod(
            new DateTime('2018-04-16'), new DateInterval('P1M'), new DateTime('2018-07-15')
        );

        $results = array();
        foreach ($period as $date) {
            $results[] = $date->format('Y-m-d');
        }
        $this->assertSame(array(
            '2018-04-16',
            '2018-05-16',
            '2018-06-16',
        ), $results);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testCreateFromEmptyInterval()
    {
        CarbonPeriod::create(
            Carbon::now(),
            CarbonInterval::days(0),
            Carbon::tomorrow()
        );
    }
}
