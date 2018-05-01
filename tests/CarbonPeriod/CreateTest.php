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
     * @dataProvider provideIso8601String
     * @throws \ReflectionException
     */
    public function testCreateFromIso8601String($arguments, $expected)
    {
        list($iso, $options) = array_pad($arguments, 2, null);

        $period = CarbonPeriod::create($iso, $options);

        $this->assertEquals(
            $this->standarizeDates($expected),
            $this->standarizeDates($period)
        );
    }

    public function provideIso8601String()
    {
        return array(
            // Recurrences / start date / interval.
            array(
                array('R4/2012-07-01T00:00:00/P7D'),
                array('2012-07-01', '2012-07-08', '2012-07-15', '2012-07-22', '2012-07-29'),
            ),
            array(
                array('R4/2012-07-01T00:00:00/P7D', CarbonPeriod::EXCLUDE_START_DATE),
                array('2012-07-08', '2012-07-15', '2012-07-22', '2012-07-29'),
            ),
            array(
                // Note: EXCLUDE_END_DATE should only matter if end date is specified, recurrences should not be altered.
                array('R4/2012-07-01T00:00:00/P7D', CarbonPeriod::EXCLUDE_END_DATE),
                array('2012-07-01', '2012-07-08', '2012-07-15', '2012-07-22', '2012-07-29'),
            ),
            array(
                array('R4/2012-07-01T00:00:00/P7D', CarbonPeriod::EXCLUDE_START_DATE | CarbonPeriod::EXCLUDE_END_DATE),
                array('2012-07-08', '2012-07-15', '2012-07-22', '2012-07-29'),
            ),
            array(
                array('R0/2012-07-01T00:00:00/P7D', CarbonPeriod::EXCLUDE_START_DATE),
                array(),
            ),
            // @todo Unbounded or omitted number of repetitions.
            // @todo Recurrences / interval / end date.
            // @todo Start date / end date.
            // @todo Start date / interval / end date.
            // @todo Invalid input.
            // @todo Move testing options to a separate test.
        );
    }

    /**
     * @dataProvider provideStartDateAndEndDate
     * @throws \ReflectionException
     */
    public function testCreateFromStartDateAndEndDate($arguments, $expected)
    {
        list($start, $end, $options) = array_pad($arguments, 3, null);

        $start = Carbon::parse($start);
        $end = Carbon::parse($end);

        $period = CarbonPeriod::create($start, $end, $options);

        $this->assertEquals(
            $this->standarizeDates($expected),
            $this->standarizeDates($period)
        );
    }

    public function provideStartDateAndEndDate()
    {
        return array(
            array(
                array('2015-09-30', '2015-10-03'),
                array('2015-09-30', '2015-10-01', '2015-10-02', '2015-10-03'),
            ),
            array(
                array('2015-09-30', '2015-10-03', CarbonPeriod::EXCLUDE_START_DATE),
                array('2015-10-01', '2015-10-02', '2015-10-03'),
            ),
            array(
                array('2015-09-30', '2015-10-03', CarbonPeriod::EXCLUDE_END_DATE),
                array('2015-09-30', '2015-10-01', '2015-10-02'),
            ),
            array(
                array('2015-09-30', '2015-10-03', CarbonPeriod::EXCLUDE_START_DATE | CarbonPeriod::EXCLUDE_END_DATE),
                array('2015-10-01', '2015-10-02'),
            ),
            array(
                array('2015-10-02', '2015-10-03', CarbonPeriod::EXCLUDE_START_DATE | CarbonPeriod::EXCLUDE_END_DATE),
                array(),
            ),
            array(
                array('2015-10-02', '2015-10-02'),
                array('2015-10-02'),
            ),
            array(
                array('2015-10-02', '2015-10-02', CarbonPeriod::EXCLUDE_START_DATE),
                array(),
            ),
            array(
                array('2015-10-02', '2015-10-02', CarbonPeriod::EXCLUDE_END_DATE),
                array(),
            ),
            // @todo Invalid input.
            // @todo Move testing options to a separate test.
        );
    }

    /**
     * @dataProvider provideStartDateAndIntervalAndEndDate
     * @throws \ReflectionException
     */
    public function testCreateFromStartDateAndIntervalAndEndDate($arguments, $expected)
    {
        list($start, $interval, $end, $options) = array_pad($arguments, 4, null);

        $start = Carbon::parse($start);
        $interval = CarbonInterval::create($interval);
        $end = Carbon::parse($end);

        $period = CarbonPeriod::create($start, $interval, $end, $options);

        $this->assertEquals(
            $this->standarizeDates($expected),
            $this->standarizeDates($period)
        );
    }

    public function provideStartDateAndIntervalAndEndDate()
    {
        return array(
            array(
                array('2018-04-21', 'P3D', '2018-04-26'),
                array('2018-04-21', '2018-04-24'),
            ),
            array(
                array('2018-04-21 16:15', 'PT15M', '2018-04-21 16:59:59'),
                array('2018-04-21 16:15', '2018-04-21 16:30', '2018-04-21 16:45'),
            ),
            array(
                array('2018-04-21 16:15', 'PT15M', '2018-04-21 17:00'),
                array('2018-04-21 16:15', '2018-04-21 16:30', '2018-04-21 16:45', '2018-04-21 17:00'),
            ),
            array(
                array('2018-04-21 17:00', 'PT45S', '2018-04-21 17:02', CarbonPeriod::EXCLUDE_START_DATE),
                array('2018-04-21 17:00:45', '2018-04-21 17:01:30'),
            ),
            array(
                array('2017-12-31 22:00', 'PT2H', '2018-01-01 4:00', CarbonPeriod::EXCLUDE_END_DATE),
                array('2017-12-31 22:00', '2018-01-01 0:00', '2018-01-01 2:00'),
            ),
            array(
                array('2017-12-31 23:59', 'PT30S', '2018-01-01 0:01', CarbonPeriod::EXCLUDE_START_DATE | CarbonPeriod::EXCLUDE_END_DATE),
                array('2017-12-31 23:59:30', '2018-01-01 0:00', '2018-01-01 0:00:30'),
            ),
            array(
                array('2018-04-21', 'P1D', '2018-04-21'),
                array('2018-04-21'),
            ),
            array(
                array('2018-04-21', 'P1D', '2018-04-20 23:59:59'),
                array(),
            ),
        );
    }

    /**
     * @dataProvider provideStartDateAndIntervalAndRecurrences
     * @throws \ReflectionException
     */
    public function testCreateFromStartDateAndIntervalAndRecurrences($arguments, $expected)
    {
        list($start, $interval, $recurrences, $options) = array_pad($arguments, 4, null);

        $start = Carbon::parse($start);
        $interval = CarbonInterval::create($interval);

        $period = CarbonPeriod::create($start, $interval, $recurrences, $options);

        $this->assertEquals(
            $this->standarizeDates($expected),
            $this->standarizeDates($period)
        );
    }

    public function provideStartDateAndIntervalAndRecurrences()
    {
        return array(
            array(
                array('2018-04-16', 'P2D', 3),
                array('2018-04-16', '2018-04-18', '2018-04-20', '2018-04-22'),
            ),
            array(
                array('2018-04-30', 'P2M', 2, CarbonPeriod::EXCLUDE_START_DATE),
                array('2018-06-30', '2018-08-30'),
            ),
            array(
                // Note: EXCLUDE_END_DATE should only matter if end date is specified, recurrences should not be altered.
                array('2018-05-30', 'P3Y', 3, CarbonPeriod::EXCLUDE_END_DATE),
                array('2018-05-30', '2021-05-30', '2024-05-30', '2027-05-30'),
            ),
            array(
                array('2018-05-30 17:35', 'PT5H', 2, CarbonPeriod::EXCLUDE_START_DATE | CarbonPeriod::EXCLUDE_END_DATE),
                array('2018-05-30 22:35', '2018-05-31 3:35'),
            ),
        );
    }

    /**
     * @dataProvider provideStartDateAndRecurrences
     * @throws \ReflectionException
     */
    public function testCreateFromStartDateAndRecurrences($arguments, $expected)
    {
        list($start, $recurrences, $options) = array_pad($arguments, 4, null);

        $start = Carbon::parse($start);

        $period = CarbonPeriod::create($start, $recurrences, $options);

        $this->assertEquals(
            $this->standarizeDates($expected),
            $this->standarizeDates($period)
        );
    }

    public function provideStartDateAndRecurrences()
    {
        return array(
            array(
                array('2018-04-16', 2),
                array('2018-04-16', '2018-04-17', '2018-04-18'),
            ),
            array(
                array('2018-04-30', 1),
                array('2018-04-30', '2018-05-01'),
            ),
            array(
                // Note: EXCLUDE_END_DATE should only matter if end date is specified, recurrences should not be altered.
                array('2018-04-30', 1, CarbonPeriod::EXCLUDE_END_DATE),
                array('2018-04-30', '2018-05-01'),
            ),
            array(
                array('2018-04-30', 1, CarbonPeriod::EXCLUDE_START_DATE),
                array('2018-05-01'),
            ),
            array(
                array('2018-04-30', 1, CarbonPeriod::EXCLUDE_START_DATE | CarbonPeriod::EXCLUDE_END_DATE),
                array(),
            ),
            array(
                array('2018-05-17', 0),
                array('2018-05-17'),
            ),
            array(
                array('2018-05-17', -1),
                array(),
            ),
        );
    }

    /**
     * @throws \ReflectionException
     */
    public function testCreateFromBaseClasses()
    {
        $period = CarbonPeriod::create(
            new DateTime('2018-04-16'), new DateInterval('P1M'), new DateTime('2018-07-15')
        );

        $this->assertEquals(
            $this->standarizeDates(array('2018-04-16', '2018-05-16', '2018-06-16')),
            $this->standarizeDates($period)
        );
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

    public function testCreateOnDstForwardChange()
    {
        $period = CarbonPeriod::create(
            Carbon::parse('2018-03-25 1:30 Europe/Oslo'),
            CarbonInterval::create('PT30M'),
            Carbon::parse('2018-03-25 3:30 Europe/Oslo')
        );

        $this->assertEquals(
            array(
                '2018-03-25 01:30:00 +01:00',
                '2018-03-25 03:00:00 +02:00',
                '2018-03-25 03:30:00 +02:00',
            ),
            $this->standarizeDates($period)
        );
    }

    public function testCreateOnDstBackwardChange()
    {
        $period = CarbonPeriod::create(
            Carbon::parse('2018-10-28 1:30 Europe/Oslo'),
            CarbonInterval::create('PT30M'),
            Carbon::parse('2018-10-28 3:30 Europe/Oslo')
        );

        $this->assertEquals(
            array(
                // @todo Is that how it works?
                '2018-10-28 01:30:00 +02:00',
                '2018-10-28 02:00:00 +02:00',
                '2018-10-28 02:30:00 +02:00',
                '2018-10-28 02:00:00 +01:00',
                '2018-10-28 02:30:00 +01:00',
                '2018-10-28 03:00:00 +01:00',
                '2018-10-28 03:30:00 +01:00',
            ),
            $this->standarizeDates($period)
        );
    }
}
