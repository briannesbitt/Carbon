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
use Tests\CarbonPeriod\Fixtures\CarbonPeriodFactory;
use Tests\CarbonPeriod\Fixtures\FooFilters;

class FilterTest extends AbstractTestCase
{
    public function dummyFilter()
    {
        return function () {
            return true;
        };
    }

    public function testGetAndSetFilters()
    {
        $period = new CarbonPeriod;

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

        $this->assertEquals($end, $period->getEndDate());
        $this->assertSame($recurrences, $period->getRecurrences());

        $period->setFilters(array());

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
            array(CarbonPeriod::END_DATE_FILTER, null),
        ), $period->getFilters());
    }

    public function testAddAndPrependFilters()
    {
        $period = new CarbonPeriod;

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
        $period = new CarbonPeriod;

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
        $period = new CarbonPeriod;

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

        $this->assertSame(
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

        $this->assertSame(
            $this->standardizeDates(array('2018-02-16', '2018-07-16', '2018-12-16')),
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

        $this->assertSame(
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

        $this->assertSame(
            $this->standardizeDates(array('2018-04-16', '2018-04-17')),
            $this->standardizeDates($period)
        );

        $period->setOptions(CarbonPeriod::EXCLUDE_START_DATE);

        $this->assertSame(
            $this->standardizeDates(array('2018-04-17', '2018-04-18')),
            $this->standardizeDates($period)
        );

        $period->setOptions(CarbonPeriod::EXCLUDE_END_DATE);

        $this->assertSame(
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

        $this->assertSame(
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
    public function testThrowExceptionWhenNextValidDateCannotBeFound()
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

        $period->setEndDate(null);
        $period->setRecurrences(null);

        $this->assertEmpty($period->getFilters());
    }

    public function testAcceptEveryOther()
    {
        $period = new CarbonPeriod(
            new DateTime('2018-04-16'), new DateTime('2018-04-20')
        );

        // Note: Without caching validation results the dates would be unpredictable
        // as we cannot know how many calls to the filter will occur per iteration.
        $period->addFilter(function ($date) {
            static $accept;

            return $accept = !$accept;
        });

        $this->assertSame(
            $this->standardizeDates(array('2018-04-16', '2018-04-18', '2018-04-20')),
            $this->standardizeDates($period)
        );
    }

    public function testEndIterationFilter()
    {
        $period = new CarbonPeriod('2018-04-16', 5);

        $period->addFilter(CarbonPeriod::END_ITERATION);

        $this->assertEmpty($this->standardizeDates($period));
    }

    public function testAcceptOnlyEvenDays()
    {
        $period = CarbonPeriodFactory::withEvenDaysFilter();

        $this->assertSame(
            $this->standardizeDates(array('2012-07-04', '2012-07-10', '2012-07-16')),
            $this->standardizeDates($period)
        );
    }

    public function testAddFilterFromCarbonMethod()
    {
        $period = CarbonPeriod::create('2018-01-01', '2018-06-01');

        $period->addFilter('isLastOfMonth');

        $this->assertSame(
            $this->standardizeDates(array('2018-01-31', '2018-02-28', '2018-03-31', '2018-04-30', '2018-05-31')),
            $this->standardizeDates($period)
        );
    }

    public function testAddFilterFromCarbonMacro()
    {
        $period = CarbonPeriod::create('2018-01-01', '2018-06-01');

        Carbon::macro('isTenDay', function ($self) {
            return $self->day === 10;
        });

        $period->addFilter('isTenDay');

        $this->assertSame(
            $this->standardizeDates(array('2018-01-10', '2018-02-10', '2018-03-10', '2018-04-10', '2018-05-10')),
            $this->standardizeDates($period)
        );
    }

    public function testAddFilterFromCarbonMethodWithArguments()
    {
        $period = CarbonPeriod::create('2017-01-01', 'P2M16D', '2018-12-31');

        $period->addFilter('isSameAs', 'm', new Carbon('2018-06-01'));

        $this->assertSame(
            $this->standardizeDates(array('2017-06-02', '2018-06-20')),
            $this->standardizeDates($period)
        );
    }

    public function testRemoveFilterFromCarbonMethod()
    {
        $period = CarbonPeriod::create('1970-01-01', '1970-01-03')->addFilter('isFuture');

        $period->removeFilter('isFuture');

        $this->assertSame(
            $this->standardizeDates(array('1970-01-01', '1970-01-02', '1970-01-03')),
            $this->standardizeDates($period)
        );
    }

    public function testInvalidCarbonMethodShouldNotBeConvertedToCallback()
    {
        $period = new CarbonPeriod;

        $period->addFilter('toDateTimeString');

        $this->assertSame(array(
            array('toDateTimeString', null),
        ), $period->getFilters());
    }

    public function testAddCallableFilters()
    {
        $period = new CarbonPeriod;

        $period->addFilter($string = 'date_offset_get')
            ->addFilter($array = array(new DateTime, 'getOffset'));

        $this->assertSame(array(
            array($string, null),
            array($array, null),
        ), $period->getFilters());
    }

    public function testRemoveCallableFilters()
    {
        $period = new CarbonPeriod;

        $period->setFilters(array(
            array($string = 'date_offset_get', null),
            array($array = array(new DateTime, 'getOffset'), null),
        ));

        $period->removeFilter($string)->removeFilter($array);

        $this->assertEmpty($period->getFilters());
    }

    public function testRunCallableFilters()
    {
        include_once 'Fixtures/filters.php';

        $period = new CarbonPeriod('2017-03-10', '2017-03-19');

        $period->addFilter(array(new FooFilters, 'bar'));
        $period->addFilter('foobar_filter');

        $this->assertSame(
            $this->standardizeDates(array('2017-03-10', '2017-03-12', '2017-03-16', '2017-03-18')),
            $this->standardizeDates($period)
        );
    }
}
