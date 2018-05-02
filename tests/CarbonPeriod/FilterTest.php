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

class FilterTest extends AbstractTestCase
{
    public function dummyPeriod()
    {
        $period = new CarbonPeriod(
            new DateTime('2018-04-16'), new DateTime('2018-07-15')
        );

        $period->setFilters(array());

        return $period;
    }

    public function dummyFilter()
    {
        return function () {
            return true;
        };
    }

    public function testGetAndSetFilters()
    {
        $period = $this->dummyPeriod();

        $this->assertSame(array(), $period->getFilters());
        $this->assertSame($period, $period->setFilters($filters = array(
            array($this->dummyFilter(), null),
        )));
        $this->assertSame($filters, $period->getFilters());
    }

    public function testUpdateInternalStateWhenBuiltInFiltersAreRemoved()
    {
        $period = new CarbonPeriod(
            $start = new DateTime('2018-04-16'), $end = new DateTime('2018-07-15')
        );

        $period->setRecurrences($recurrences = 3);

        $period->setFilters($period->getFilters());

        $this->assertEquals($start, $period->getStartDate());
        $this->assertEquals($end, $period->getEndDate());
        $this->assertEquals($recurrences, $period->getRecurrences());

        $period->setFilters(array());

        $this->assertNull($period->getStartDate());
        $this->assertNull($period->getEndDate());
        $this->assertNull($period->getRecurrences());
    }

    public function testResetFilters()
    {
        $period = new CarbonPeriod(
            $start = new DateTime('2018-04-16'), $end = new DateTime('2018-07-15')
        );

        $period->addFilter($this->dummyFilter())
            ->prependFilter($this->dummyFilter());

        $this->assertSame($period, $period->resetFilters());

        $this->assertSame(array(
            array(CarbonPeriod::START_DATE_FILTER, null),
            array(CarbonPeriod::END_DATE_FILTER, null),
        ), $period->getFilters());
    }

    public function testAddAndPrependFilters()
    {
        $period = $this->dummyPeriod();

        $period->addFilter($filter1 = $this->dummyFilter())
            ->addFilter($filter2 = $this->dummyFilter())
            ->prependFilter($filter3 = $this->dummyFilter());

        $this->assertSame(array(
            array($filter3, null),
            array($filter1, null),
            array($filter2, null),
        ), $period->getFilters());
    }

    public function testRemoveFilterByInstance()
    {
        $period = $this->dummyPeriod();

        $period->addFilter($filter1 = $this->dummyFilter())
            ->addFilter($filter2 = $this->dummyFilter())
            ->addFilter($filter3 = $this->dummyFilter());

        $period->removeFilter($filter2);

        $this->assertSame(array(
            array($filter1, null),
            array($filter3, null),
        ), $period->getFilters());
    }

    public function testRemoveFilterByName()
    {
        $period = $this->dummyPeriod();

        $period->addFilter($filter1 = $this->dummyFilter())
            ->addFilter($filter2 = $this->dummyFilter(), 'foo')
            ->addFilter($filter3 = $this->dummyFilter())
            ->addFilter($filter4 = $this->dummyFilter(), 'foo')
            ->addFilter($filter5 = $this->dummyFilter());

        $period->removeFilter('foo');

        $this->assertSame(array(
            array($filter1, null),
            array($filter3, null),
            array($filter5, null),
        ), $period->getFilters());
    }

    public function testAcceptOnlyWeekdays()
    {
        Carbon::setWeekendDays(array(
            Carbon::SATURDAY,
            Carbon::SUNDAY,
        ));

        $period = CarbonPeriod::create('R4/2018-04-14T00:00:00/P4D');

        $period->addFilter(function ($date) {
            return $date->isWeekday();
        });

        $this->assertEquals(
            $this->standardizeDates(array('2018-04-18', '2018-04-26', '2018-04-30', '2018-05-04')),
            $this->standardizeDates($period)
        );
    }

    /**
     * @throws \Exception
     */
    public function testAcceptOnlySingleYear()
    {
        $period = new CarbonPeriod(
            new DateTime('2017-04-16'), new DateInterval('P5M'), new DateTime('2019-07-15')
        );

        $period->addFilter(function ($date) {
            return $date->year === 2018;
        });

        $this->assertEquals(
            // Note: an hour of difference caused by DST change.
            $this->standardizeDates(array('2018-02-15 23:00', '2018-07-16 00:00', '2018-12-15 23:00')),
            $this->standardizeDates($period)
        );
    }

    /**
     * @throws \Exception
     */
    public function testAcceptOnlyEvenDays()
    {
        $period = CarbonPeriod::create(
            new Carbon('2012-07-01'),
            new CarbonInterval('P3D'),
            new Carbon('2012-07-16'),
            CarbonPeriod::EXCLUDE_END_DATE
        );

        $period->addFilter(function ($date) {
            return $date->day % 2 == 0;
        });

        $this->assertEquals(
            $this->standardizeDates(array('2012-07-04', '2012-07-10')),
            $this->standardizeDates($period)
        );
    }

    /**
     * @throws \Exception
     */
    public function testEndIteration()
    {
        $period = new CarbonPeriod(
            new DateTime('2018-04-16'), new DateInterval('P3D'), new DateTime('2018-07-15')
        );

        $period->addFilter(function ($date) {
            return $date->month === 5 ? CarbonPeriod::END_ITERATION : true;
        });

        $this->assertEquals(
            $this->standardizeDates(array('2018-04-16', '2018-04-19', '2018-04-22', '2018-04-25', '2018-04-28')),
            $this->standardizeDates($period)
        );
    }

    public function testRecurrences()
    {
        $period = new CarbonPeriod(
            new DateTime('2018-04-16'), new DateTime('2018-07-15')
        );

        $period->setRecurrences(2);

        $this->assertEquals(
            $this->standardizeDates(array('2018-04-16', '2018-04-17')),
            $this->standardizeDates($period)
        );

        $period->setOptions(CarbonPeriod::EXCLUDE_START_DATE);

        $this->assertEquals(
            $this->standardizeDates(array('2018-04-17', '2018-04-18')),
            $this->standardizeDates($period)
        );

        $period->setOptions(CarbonPeriod::EXCLUDE_END_DATE);

        $this->assertEquals(
            $this->standardizeDates(array('2018-04-16', '2018-04-17')),
            $this->standardizeDates($period)
        );
    }

    public function testChangeNumberOfRecurrences()
    {
        $period = new CarbonPeriod(
            new DateTime('2018-04-16'), new DateTime('2018-07-15')
        );

        $period->setRecurrences(7)
            ->setRecurrences(1)
            ->setRecurrences(3);

        $this->assertEquals(
            $this->standardizeDates(array('2018-04-16', '2018-04-17', '2018-04-18')),
            $this->standardizeDates($period)
        );
    }

    public function testResetNumberOfRecurrences()
    {
        $period = new CarbonPeriod(
            new DateTime('2018-04-16'), new DateTime('2018-07-15')
        );

        $period->setRecurrences(1)
            ->resetFilters()
            ->setRecurrences(3);

        $this->assertEquals(
            $this->standardizeDates(array('2018-04-16', '2018-04-17', '2018-04-18')),
            $this->standardizeDates($period)
        );
    }

    public function testCallbackArguments()
    {
        $period = new CarbonPeriod(
            new DateTime('2018-04-16'), 1
        );

        $wasCalled = false;

        $test = $this;
        $period->addFilter(function ($current, $key, $iterator) use (&$wasCalled, $period, $test) {
            $test->assertInstanceOfCarbon($current);
            $test->assertInternalType('int', $key);
            $test->assertSame($period, $iterator);

            return $wasCalled = true;
        });

        iterator_to_array($period);

        $this->assertTrue($wasCalled);
    }

    /**
     * @expectedException \RuntimeException
     * @expectedExceptionMessage Could not find next valid date.
     */
    public function testGrumpyFilter()
    {
        $period = CarbonPeriod::create(
            new Carbon('2000-01-01'), new CarbonInterval('PT1S'), new Carbon('2000-12-31')
        );

        $period->addFilter(function () {
            return false;
        });

        iterator_to_array($period);
    }

    public function testRemoveBuildInFilters()
    {
        $period = CarbonPeriod::create(new DateTime('2018-04-16'), new DateTime('2018-07-15'))->setRecurrences(3);

        $period->setStartDate(null);
        $period->setEndDate(null);
        $period->setRecurrences(null);

        $this->assertEmpty($period->getFilters());
    }
}
