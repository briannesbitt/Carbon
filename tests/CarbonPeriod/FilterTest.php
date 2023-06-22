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
use Carbon\CarbonInterval;
use Carbon\CarbonPeriod;
use DateInterval;
use DateTime;
use RuntimeException;
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
        $periodClass = $this->periodClass;
        $period = new $periodClass();

        $this->assertSame([], $period->getFilters());
        $this->assertSame($period, $period->setFilters($filters = [
            [$this->dummyFilter(), null],
        ]));
        $this->assertSame($filters, $period->getFilters());
    }

    public function testUpdateInternalStateWhenBuiltInFiltersAreRemoved()
    {
        $periodClass = $this->periodClass;
        $period = new $periodClass(
            $start = new DateTime('2018-04-16'),
            $end = new DateTime('2018-07-15')
        );

        $period->setRecurrences($recurrences = 3);
        $period->setFilters($period->getFilters());

        $this->assertEquals($end, $period->getEndDate());
        $this->assertSame($recurrences, $period->getRecurrences());

        $period->setFilters([]);

        $this->assertNull($period->getEndDate());
        $this->assertNull($period->getRecurrences());
    }

    public function testResetFilters()
    {
        $periodClass = $this->periodClass;
        $period = new $periodClass(
            $start = new DateTime('2018-04-16'),
            $end = new DateTime('2018-07-15')
        );

        $period->addFilter($this->dummyFilter())
            ->prependFilter($this->dummyFilter());

        $this->assertSame($period, $period->resetFilters());

        $this->assertSame([
            [$periodClass::END_DATE_FILTER, null],
        ], $period->getFilters());
    }

    public function testAddAndPrependFilters()
    {
        $periodClass = $this->periodClass;
        $period = new $periodClass();

        $period->addFilter($filter1 = $this->dummyFilter())
            ->addFilter($filter2 = $this->dummyFilter())
            ->prependFilter($filter3 = $this->dummyFilter());

        $this->assertSame([
            [$filter3, null],
            [$filter1, null],
            [$filter2, null],
        ], $period->getFilters());
    }

    public function testRemoveFilterByInstance()
    {
        $periodClass = $this->periodClass;
        $period = new $periodClass();

        $period->addFilter($filter1 = $this->dummyFilter())
            ->addFilter($filter2 = $this->dummyFilter())
            ->addFilter($filter3 = $this->dummyFilter());

        $period->removeFilter($filter2);

        $this->assertSame([
            [$filter1, null],
            [$filter3, null],
        ], $period->getFilters());
    }

    public function testRemoveFilterByName()
    {
        $periodClass = $this->periodClass;
        $period = new $periodClass();

        $period->addFilter($filter1 = $this->dummyFilter())
            ->addFilter($filter2 = $this->dummyFilter(), 'foo')
            ->addFilter($filter3 = $this->dummyFilter())
            ->addFilter($filter4 = $this->dummyFilter(), 'foo')
            ->addFilter($filter5 = $this->dummyFilter());

        $period->removeFilter('foo');

        $this->assertSame([
            [$filter1, null],
            [$filter3, null],
            [$filter5, null],
        ], $period->getFilters());
    }

    public function testAcceptOnlyWeekdays()
    {
        $periodClass = $this->periodClass;

        Carbon::setWeekendDays([
            Carbon::SATURDAY,
            Carbon::SUNDAY,
        ]);

        $period = $periodClass::create('R4/2018-04-14T00:00:00/P4D');

        $period->addFilter(function ($date) {
            return $date->isWeekday();
        });

        $this->assertSame(
            $this->standardizeDates(['2018-04-18', '2018-04-26', '2018-04-30', '2018-05-04']),
            $this->standardizeDates($period)
        );
    }

    /**
     * @throws \Exception
     */
    public function testAcceptOnlySingleYear()
    {
        $periodClass = $this->periodClass;
        $period = new $periodClass(
            new DateTime('2017-04-16'),
            new DateInterval('P5M'),
            new DateTime('2019-07-15')
        );

        $period->addFilter(function ($date) {
            return $date->year === 2018;
        });

        $this->assertSame(
            $this->standardizeDates(['2018-02-16', '2018-07-16', '2018-12-16']),
            $this->standardizeDates($period)
        );
    }

    /**
     * @throws \Exception
     */
    public function testEndIteration()
    {
        $periodClass = $this->periodClass;
        $period = new $periodClass(
            new DateTime('2018-04-16'),
            new DateInterval('P3D'),
            new DateTime('2018-07-15')
        );

        $period->addFilter(function ($date) use ($periodClass) {
            return $date->month === 5 ? $periodClass::END_ITERATION : true;
        });

        $this->assertSame(
            $this->standardizeDates(['2018-04-16', '2018-04-19', '2018-04-22', '2018-04-25', '2018-04-28']),
            $this->standardizeDates($period)
        );
    }

    public function testRecurrences()
    {
        $periodClass = $this->periodClass;
        $period = new $periodClass(
            new DateTime('2018-04-16'),
            new DateTime('2018-07-15')
        );

        $period = $period->setRecurrences(2);

        $this->assertSame(
            $this->standardizeDates(['2018-04-16', '2018-04-17']),
            $this->standardizeDates($period)
        );

        $period = $period->setOptions($periodClass::EXCLUDE_START_DATE);

        $this->assertSame(
            $this->standardizeDates(['2018-04-17', '2018-04-18']),
            $this->standardizeDates($period)
        );

        $period = $period->setOptions($periodClass::EXCLUDE_END_DATE);

        $this->assertSame(
            $this->standardizeDates(['2018-04-16', '2018-04-17']),
            $this->standardizeDates($period)
        );
    }

    public function testChangeNumberOfRecurrences()
    {
        $periodClass = $this->periodClass;
        $period = new $periodClass(
            new DateTime('2018-04-16'),
            new DateTime('2018-07-15')
        );

        $period = $period->setRecurrences(7)
            ->setRecurrences(1)
            ->setRecurrences(3);

        $this->assertSame(
            $this->standardizeDates(['2018-04-16', '2018-04-17', '2018-04-18']),
            $this->standardizeDates($period)
        );
    }

    public function testCallbackArguments()
    {
        $periodClass = $this->periodClass;
        $period = new $periodClass(
            new DateTime('2018-04-16'),
            1
        );

        $wasCalled = false;

        $test = $this;
        $period = $period->addFilter(function ($current, $key, $iterator) use (&$wasCalled, $period, $test) {
            $test->assertInstanceOfCarbon($current);
            $test->assertIsInt($key);
            $test->assertSame($period, $iterator);

            return $wasCalled = true;
        });

        iterator_to_array($period);

        $this->assertTrue($wasCalled);
    }

    public function testThrowExceptionWhenNextValidDateCannotBeFound()
    {
        $this->expectExceptionObject(new RuntimeException(
            'Could not find next valid date.'
        ));

        $periodClass = $this->periodClass;
        $period = $periodClass::create(
            new Carbon('2000-01-01'),
            new CarbonInterval('PT1S'),
            new Carbon('2000-12-31')
        );

        $period = $period->addFilter(function () {
            return false;
        });

        iterator_to_array($period);
    }

    public function testRemoveBuildInFilters()
    {
        $periodClass = $this->periodClass;
        $period = $periodClass::create(new DateTime('2018-04-16'), new DateTime('2018-07-15'))->setRecurrences(3);

        $period->setEndDate(null);
        $period->setRecurrences(null);

        $this->assertEmpty($period->getFilters());
    }

    public function testAcceptEveryOther()
    {
        $periodClass = $this->periodClass;
        $period = new $periodClass(
            new DateTime('2018-04-16'),
            new DateTime('2018-04-20')
        );

        // Note: Without caching validation results the dates would be unpredictable
        // as we cannot know how many calls to the filter will occur per iteration.
        $period = $period->addFilter(function ($date) {
            static $accept;

            return $accept = !$accept;
        });

        $this->assertSame(
            $this->standardizeDates(['2018-04-16', '2018-04-18', '2018-04-20']),
            $this->standardizeDates($period)
        );
    }

    public function testEndIterationFilter()
    {
        $periodClass = $this->periodClass;
        $period = new $periodClass('2018-04-16', 5);

        $period->addFilter($periodClass::END_ITERATION);

        $this->assertEmpty($this->standardizeDates($period));
    }

    public function testAcceptOnlyEvenDays()
    {
        $period = CarbonPeriodFactory::withEvenDaysFilter($this->periodClass);

        $this->assertSame(
            $this->standardizeDates(['2012-07-04', '2012-07-10', '2012-07-16']),
            $this->standardizeDates($period)
        );
    }

    public function testAddFilterFromCarbonMethod()
    {
        $periodClass = $this->periodClass;
        $period = $periodClass::create('2018-01-01', '2018-06-01');

        $period->addFilter('isLastOfMonth');

        $this->assertSame(
            $this->standardizeDates(['2018-01-31', '2018-02-28', '2018-03-31', '2018-04-30', '2018-05-31']),
            $this->standardizeDates($period)
        );
    }

    public function testAddFilterFromCarbonMacro()
    {
        $periodClass = $this->periodClass;
        $period = $periodClass::create('2018-01-01', '2018-06-01');

        Carbon::macro('isTenDay', function () {
            /** @var Carbon $date */
            $date = $this;

            return $date->day === 10;
        });

        $period->addFilter('isTenDay');

        $this->assertSame(
            $this->standardizeDates(['2018-01-10', '2018-02-10', '2018-03-10', '2018-04-10', '2018-05-10']),
            $this->standardizeDates($period)
        );
    }

    public function testAddFilterFromCarbonMethodWithArguments()
    {
        $period = CarbonPeriod::create('2017-01-01', 'P2M16D', '2018-12-31');

        $period->addFilter('isSameAs', 'm', new Carbon('2018-06-01'));

        $this->assertSame(
            $this->standardizeDates(['2017-06-02', '2018-06-20']),
            $this->standardizeDates($period)
        );
    }

    public function testRemoveFilterFromCarbonMethod()
    {
        $period = CarbonPeriod::create('1970-01-01', '1970-01-03')->addFilter('isFuture');

        $period->removeFilter('isFuture');

        $this->assertSame(
            $this->standardizeDates(['1970-01-01', '1970-01-02', '1970-01-03']),
            $this->standardizeDates($period)
        );
    }

    public function testInvalidCarbonMethodShouldNotBeConvertedToCallback()
    {
        $period = new CarbonPeriod();

        $period->addFilter('toDateTimeString');

        $this->assertSame([
            ['toDateTimeString', null],
        ], $period->getFilters());
    }

    public function testAddCallableFilters()
    {
        $period = new CarbonPeriod();

        $period->addFilter($string = 'date_offset_get')
            ->addFilter($array = [new DateTime(), 'getOffset']);

        $this->assertSame([
            [$string, null],
            [$array, null],
        ], $period->getFilters());
    }

    public function testRemoveCallableFilters()
    {
        $period = new CarbonPeriod();

        $period->setFilters([
            [$string = 'date_offset_get', null],
            [$array = [new DateTime(), 'getOffset'], null],
        ]);

        $period->removeFilter($string)->removeFilter($array);

        $this->assertEmpty($period->getFilters());
    }

    public function testRunCallableFilters()
    {
        include_once 'Fixtures/filters.php';

        $period = new CarbonPeriod('2017-03-10', '2017-03-19');
        $callable = [new FooFilters(), 'bar'];

        $this->assertFalse($period->hasFilter($callable));
        $this->assertFalse($period->hasFilter('foobar_filter'));
        $this->assertFalse($period->hasFilter('not_callable'));
        $period->addFilter($callable);
        $period->addFilter('foobar_filter');
        $this->assertTrue($period->hasFilter($callable));
        $this->assertTrue($period->hasFilter('foobar_filter'));
        $this->assertFalse($period->hasFilter('not_callable'));

        $this->assertSame(
            $this->standardizeDates(['2017-03-10', '2017-03-12', '2017-03-16', '2017-03-18']),
            $this->standardizeDates($period)
        );
    }
}
