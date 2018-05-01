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

use DateTime;
use DateInterval;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Carbon\CarbonInterval;
use Tests\AbstractTestCase;

class FilterTest extends AbstractTestCase
{
    public function dummyPeriod()
    {
        return new CarbonPeriod(
            new DateTime('2018-04-16'), new DateTime('2018-07-15')
        );
    }

    public function testGetAndSetFilters()
    {
        $period = $this->dummyPeriod();

        $this->assertSame(array(), $period->getFilters());
        $this->assertSame($period, $period->setFilters($filters = array(
            array(function () {}, null)
        )));
        $this->assertSame($filters, $period->getFilters());
        $this->assertSame($period, $period->resetFilters());
        $this->assertSame(array(), $period->getFilters());
    }

    public function testAddAndPrependFilters()
    {
        $period = $this->dummyPeriod();

        $period->addFilter($filter1 = function () {})
            ->addFilter($filter2 = function () {})
            ->prependFilter($filter3 = function () {});

        $this->assertSame(array(
            array($filter3, null),
            array($filter1, null),
            array($filter2, null),
        ), $period->getFilters());
    }

    public function testRemoveFilterByInstance()
    {
        $period = $this->dummyPeriod();

        $period->addFilter($filter1 = function () {})
            ->addFilter($filter2 = function () {})
            ->addFilter($filter3 = function () {});

        $period->removeFilter($filter2);

        $this->assertSame(array(
            array($filter1, null),
            array($filter3, null),
        ), $period->getFilters());
    }

    public function testRemoveFilterByName()
    {
        $period = $this->dummyPeriod();

        $period->addFilter($filter1 = function () {})
            ->addFilter($filter2 = function () {}, 'foo')
            ->addFilter($filter3 = function () {})
            ->addFilter($filter4 = function () {}, 'foo')
            ->addFilter($filter5 = function () {});

        $period->removeFilter('foo');

        $this->assertSame(array(
            array($filter1, null),
            array($filter3, null),
            array($filter5, null),
        ), $period->getFilters());
    }

    /**
     * @throws \ReflectionException
     */
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
            $this->standarizeDates(array('2018-04-18', '2018-04-26', '2018-04-30')),
            $this->standarizeDates($period)
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
            $this->standarizeDates(array('2018-02-16', '2018-07-16', '2018-12-16')),
            $this->standarizeDates($period)
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
            $this->standarizeDates(array('2012-07-04', '2012-07-10')),
            $this->standarizeDates($period)
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
            $this->standarizeDates(array('2018-04-16', '2018-04-19', '2018-04-22', '2018-04-25', '2018-04-28')),
            $this->standarizeDates($period)
        );
    }

    public function testRecurrences()
    {
        $period = new CarbonPeriod(
            new DateTime('2018-04-16'), new DateTime('2018-07-15')
        );

        $period->recurrences(2);

        $this->assertEquals(
            $this->standarizeDates(array('2018-04-16', '2018-04-17', '2018-04-18')),
            $this->standarizeDates($period)
        );
    }

    public function testChangeNumberOfRecurrences()
    {
        $period = new CarbonPeriod(
            new DateTime('2018-04-16'), new DateTime('2018-07-15')
        );

        $period->recurrences(7)->recurrences(1)->recurrences(3);

        $this->assertEquals(
            $this->standarizeDates(array('2018-04-16', '2018-04-17', '2018-04-18', '2018-04-19')),
            $this->standarizeDates($period)
        );
    }

    public function testCallbackArguments()
    {
        $period = new CarbonPeriod(
            new DateTime('2018-04-16'), 0
        );

        $wasCalled = false;

        $period->addFilter(function ($current, $key, $iterator) use (&$wasCalled, $period) {
            $this->assertInstanceOfCarbon($current);
            $this->assertInternalType('int', $key);
            $this->assertSame($period, $iterator);

            $wasCalled = true;
        });

        iterator_to_array($period);

        $this->assertTrue($wasCalled);
    }
}
