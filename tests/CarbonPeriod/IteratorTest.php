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
use Tests\AbstractTestCase;
use Tests\CarbonPeriod\Fixtures\CarbonPeriodFactory;

class IteratorTest extends AbstractTestCase
{
    protected $iterationLimit = 100;

    public function testKeyAndCurrentAreCorrectlyInstantiated()
    {
        $period = CarbonPeriodFactory::withEvenDaysFilter();

        $this->assertSame(0, $period->key());
        $this->assertInstanceOfCarbon($period->current());
        $this->assertSame('2012-07-04 00:00:00', $period->current()->format('Y-m-d H:i:s'));
        $this->assertTrue($period->valid());
    }

    public function testValidIsCorrectlyInstantiated()
    {
        $period = CarbonPeriodFactory::withEvenDaysFilter();

        $this->assertTrue($period->valid());
    }

    public function testCurrentIsAlwaysCarbonInstance()
    {
        $period = CarbonPeriodFactory::withEvenDaysFilter();

        foreach ($period as $key => $current) {
            $this->assertInstanceOfCarbon($current);
            $this->assertEquals($current, $period->current());
        }
    }

    public function testKeysAreSequential()
    {
        $keys = array();

        $period = CarbonPeriodFactory::withEvenDaysFilter();

        foreach ($period as $key => $current) {
            $this->assertInternalType('int', $keys[] = $key);
            $this->assertSame($key, $period->key());
        }

        $this->assertSame(array_keys($keys), $keys);
    }

    public function testElementsInLoopAreAlwaysValid()
    {
        $period = CarbonPeriodFactory::withEvenDaysFilter();

        foreach ($period as $key => $current) {
            $this->assertTrue($period->valid());
        }
    }

    public function testKeyAndCurrentAreCorrectlyIterated()
    {
        $period = CarbonPeriodFactory::withEvenDaysFilter();

        $period->next();

        $this->assertEquals(1, $period->key());
        $this->assertEquals('2012-07-10 00:00:00', $period->current()->format('Y-m-d H:i:s'));
        $this->assertTrue($period->valid());
    }

    public function testKeyAndCurrentAreCorrectlyRewound()
    {
        $period = CarbonPeriodFactory::withEvenDaysFilter();

        $period->next();
        $period->rewind();

        $this->assertEquals(0, $period->key());
        $this->assertEquals('2012-07-04 00:00:00', $period->current()->format('Y-m-d H:i:s'));
        $this->assertTrue($period->valid());
    }

    public function testKeyAndCurrentAreNullAfterIteration()
    {
        $period = CarbonPeriodFactory::withEvenDaysFilter();

        foreach ($period as $key => $current) {
            //
        }

        $this->assertNull($period->key());
        $this->assertNull($period->current());
        $this->assertFalse($period->valid());
    }

    /**
     * @dataProvider provideIterateBackwardsArguments
     */
    public function testIterateBackwards($arguments, $expected)
    {
        $period = call_user_func_array('Carbon\CarbonPeriod::create', $arguments);

        $interval = new CarbonInterval('P3D');
        $interval->invert = 1;

        $period->setDateInterval($interval);

        $this->assertEquals(
            $this->standardizeDates($expected),
            $this->standardizeDates($period)
        );
    }

    public function provideIterateBackwardsArguments()
    {
        return array(
            array(
                array('2015-10-15', '2015-10-06'),
                array('2015-10-15', '2015-10-12', '2015-10-09', '2015-10-06'),
            ),
            array(
                array('2015-10-15', '2015-10-06', CarbonPeriod::EXCLUDE_START_DATE),
                array('2015-10-12', '2015-10-09', '2015-10-06'),
            ),
            array(
                array('2015-10-15', '2015-10-06', CarbonPeriod::EXCLUDE_END_DATE),
                array('2015-10-15', '2015-10-12', '2015-10-09'),
            ),
            array(
                array('2015-10-15', '2015-10-06', CarbonPeriod::EXCLUDE_START_DATE | CarbonPeriod::EXCLUDE_END_DATE),
                array('2015-10-12', '2015-10-09'),
            ),
            array(
                array('2015-10-15', 3),
                array('2015-10-15', '2015-10-12', '2015-10-09'),
            ),
        );
    }

    public function testChangingParametersShouldNotCauseInfiniteLoop()
    {
        $period = CarbonPeriod::create()
            ->setStartDate($start = '2012-07-01')
            ->setEndDate($end = '2012-07-20')
            ->setDateInterval($interval = 'P1D')
            ->setRecurrences($recurrences = 10)
            ->setOptions($options = CarbonPeriod::EXCLUDE_START_DATE | CarbonPeriod::EXCLUDE_END_DATE)
            ->addFilter($filter = function () {
                return true;
            });

        $counter = 0;

        foreach ($period as $current) {
            if (++$counter >= $this->iterationLimit) {
                break;
            }

            $period->removeFilter($filter)
                ->prependFilter($filter)
                ->setFilters(array())
                ->setStartDate($start)
                ->setEndDate($end)
                ->invertDateInterval()
                ->setDateInterval($interval)
                ->setRecurrences($recurrences)
                ->setOptions($options)
                ->resetFilters()
                ->addFilter($filter);
        }

        $this->assertLessThan($this->iterationLimit, $counter, 'Changing parameters during the iteration caused an infinite loop.');
    }

    public function testChangeEndDateDuringIteration()
    {
        $period = CarbonPeriodFactory::withEvenDaysFilter();

        $results = array();

        foreach ($period as $key => $current) {
            $results[] = sprintf('%s => %s', $key, $current->toDateString());

            if ($current->toDateString() === '2012-07-16') {
                $period->setEndDate($current);

                // Note: Current is no longer valid, because it is now equal to end, which is excluded.
                $this->assertNull($period->key());
                $this->assertNull($period->current());
                $this->assertFalse($period->valid());
            }

            if (count($results) >= $this->iterationLimit) {
                $this->fail('Infinite loop detected when traversing the period.');
            }
        }

        $this->assertEquals(
            array('0 => 2012-07-04', '1 => 2012-07-10', '2 => 2012-07-16'),
            $results
        );
    }

    public function testKeepIncreasingRecurrencesDuringIteration()
    {
        $period = new CarbonPeriod('2012-07-01', $recurrences = 1);

        $results = array();

        foreach ($period as $key => $current) {
            $results[] = sprintf('%s => %s', $key, $current->toDateString());

            if ($recurrences < 4) {
                $period->setRecurrences(++$recurrences);

                // Note: Current is still valid, because we simply extended the period.
                $this->assertEquals($key, $period->key());
                $this->assertEquals($current, $period->current());
                $this->assertTrue($period->valid());
            }

            if (count($results) >= $this->iterationLimit) {
                $this->fail('Infinite loop detected when traversing the period.');
            }
        }

        $this->assertEquals(
            array('0 => 2012-07-01', '1 => 2012-07-02', '2 => 2012-07-03', '3 => 2012-07-04'), $results
        );
    }

    public function testChangeStartDateDuringIteration()
    {
        $period = new CarbonPeriod('2012-07-01', '2012-07-10');

        $results = array();

        $minimum = new Carbon('2012-07-08');

        foreach ($period as $key => $current) {
            $results[] = sprintf('%s => %s', $key, $current->toDateString());

            if ($current < $minimum) {
                $period->setStartDate($minimum);

                // Note: Current is no longer valid, because it is now before start.
                $this->assertNull($period->key());
                $this->assertNull($period->current());
                $this->assertFalse($period->valid());
            }

            if (count($results) >= $this->iterationLimit) {
                $this->fail('Infinite loop detected when traversing the period.');
            }
        }

        $this->assertEquals(
            array('0 => 2012-07-01', '1 => 2012-07-08', '2 => 2012-07-09', '3 => 2012-07-10'), $results
        );
    }

    public function testChangeDateIntervalDuringIteration()
    {
        $period = new CarbonPeriod('2012-07-01', 3);

        $results = array();

        foreach ($period as $key => $current) {
            $results[] = sprintf('%s => %s', $key, $current->toDateString());

            $period->setDateInterval('P3D');

            // Note: Current is still valid, because changed interval changes only subsequent items.
            $this->assertEquals($key, $period->key());
            $this->assertEquals($current, $period->current());
            $this->assertTrue($period->valid());

            if (count($results) >= $this->iterationLimit) {
                $this->fail('Infinite loop detected when traversing the period.');
            }
        }

        $this->assertEquals(
            array('0 => 2012-07-01', '1 => 2012-07-04', '2 => 2012-07-07'), $results
        );
    }

    public function testRewindAfterRemovingStartDate()
    {
        $period = CarbonPeriodFactory::withEvenDaysFilter();

        $period->current();

        $period->setStartDate(null);

        $period->rewind();

        $this->assertNull($period->key());
        $this->assertNull($period->current());
        $this->assertFalse($period->valid());
    }

    public function testValidateOncePerIteration()
    {
        $period = CarbonPeriodFactory::withCounter($counter);

        $period->key();
        $period->current();
        $period->valid();
        $this->assertEquals(1, $counter);

        $period->next();
        $this->assertEquals(2, $counter);

        $period->key();
        $period->current();
        $period->valid();
        $this->assertEquals(2, $counter);
    }

    public function testClearCachedValidationResultWhenPropertiesAreChanged()
    {
        $period = CarbonPeriod::create('2012-10-01');

        $this->assertInstanceOfCarbon($period->current());

        $period->addFilter(CarbonPeriod::END_ITERATION);

        $this->assertNull($period->current());
    }

    public function testClearInvalidIterationResultsBeforeSubsequentIteration()
    {
        $period = CarbonPeriodFactory::withCounter($counter);

        $results = array();

        foreach ($period as $key => $current) {
            $results[$key] = $current;

            if ($key === 1) {
                $period->setStartDate('2012-09-15');
            }
        }

        $this->assertEquals(
            $this->standardizeDates(array('2012-10-01', '2012-10-02', '2012-10-03')),
            $this->standardizeDates($results)
        );
        $this->assertEquals(3, $counter);

        $this->assertEquals(
            $this->standardizeDates(array('2012-09-15', '2012-09-16', '2012-09-17')),
            $this->standardizeDates(iterator_to_array($period))
        );
        $this->assertEquals(6, $counter);
    }

    public function testTraversePeriodDynamically()
    {
        $period = CarbonPeriodFactory::withEvenDaysFilter();

        $results = array();

        while ($current = $period->current()) {
            $results[] = $current;

            $period->next();

            if (count($results) >= $this->iterationLimit) {
                $this->fail('Infinite loop detected when traversing the period.');
            }
        }

        $this->assertEquals(
            $this->standardizeDates(array('2012-07-04', '2012-07-10', '2012-07-16')),
            $this->standardizeDates($results)
        );
    }

    public function testHandleDstBackwardChangeWhenReusingPartialResults()
    {
        $period = CarbonPeriod::create(
            '2018-10-28 1:30 Europe/Oslo', 'PT30M', '2018-10-28 3:30 Europe/Oslo'
        );

        $expected = array(
            '2018-10-28 01:30:00 +02:00',
            // Note: it would be logical if the two following offsets were +02:00 as it is still DST.
            '2018-10-28 02:00:00 +01:00',
            '2018-10-28 02:30:00 +01:00',
            '2018-10-28 02:00:00 +01:00',
            '2018-10-28 02:30:00 +01:00',
            '2018-10-28 03:00:00 +01:00',
            '2018-10-28 03:30:00 +01:00',
        );

        $period->next();
        $this->assertEquals($expected, $this->standardizeDates(iterator_to_array($period)));
    }

    public function testExtendCompletedIteration()
    {
        $period = CarbonPeriod::create('2018-10-10', '2018-10-11');

        $results = array();

        while ($period->valid()) {
            $results[] = $period->current();

            $period->next();
        }

        $period->setEndDate('2018-10-13');

        while ($period->valid()) {
            $results[] = $period->current();

            $period->next();
        }

        $this->assertEquals(
            $this->standardizeDates(array('2018-10-10', '2018-10-11', '2018-10-12', '2018-10-13')),
            $this->standardizeDates($results)
        );
    }

    public function testRevalidateCurrentAfterChangeOfParameters()
    {
        $period = CarbonPeriod::create()->setStartDate($start = new Carbon('2018-10-28'));
        $this->assertEquals($start, $period->current());

        $period->toggleOptions(CarbonPeriod::EXCLUDE_START_DATE, true);
        $this->assertNull($period->current());

        $period->toggleOptions(CarbonPeriod::EXCLUDE_START_DATE, false);
        $this->assertEquals($start, $period->current());
    }

    public function testRevalidateCurrentAfterEndOfIteration()
    {
        $period = CarbonPeriod::create()->setStartDate($start = new Carbon('2018-10-28'));
        $this->assertEquals($start, $period->current());

        $period->addFilter(CarbonPeriod::END_ITERATION);
        $this->assertNull($period->current());

        $period->removeFilter(CarbonPeriod::END_ITERATION);
        $this->assertEquals($start, $period->current());
    }
}
