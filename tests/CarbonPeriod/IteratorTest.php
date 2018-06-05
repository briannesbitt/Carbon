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

        $this->assertSame(1, $period->key());
        $this->assertSame('2012-07-10 00:00:00', $period->current()->format('Y-m-d H:i:s'));
        $this->assertTrue($period->valid());
    }

    public function testKeyAndCurrentAreCorrectlyRewound()
    {
        $period = CarbonPeriodFactory::withEvenDaysFilter();

        $period->next();
        $period->rewind();

        $this->assertSame(0, $period->key());
        $this->assertSame('2012-07-04 00:00:00', $period->current()->format('Y-m-d H:i:s'));
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

        $this->assertSame(
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

        $this->assertSame(
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
                $this->assertSame($key, $period->key());
                $this->assertEquals($current, $period->current());
                $this->assertTrue($period->valid());
            }

            if (count($results) >= $this->iterationLimit) {
                $this->fail('Infinite loop detected when traversing the period.');
            }
        }

        $this->assertSame(
            array('0 => 2012-07-01', '1 => 2012-07-02', '2 => 2012-07-03', '3 => 2012-07-04'), $results
        );
    }

    public function testChangeStartDateDuringIteration()
    {
        $period = new CarbonPeriod('2012-07-01', '2012-07-04');

        $results = array();

        $newStart = new Carbon('2012-07-03');

        foreach ($period as $key => $current) {
            $results[] = sprintf('%s => %s', $key, $current->toDateString());

            if ($current < $newStart) {
                $period->setStartDate($newStart);

                // Note: Current is still valid, because start date is used only for initialization.
                $this->assertEquals($key, $period->key());
                $this->assertEquals($current, $period->current());
                $this->assertTrue($period->valid());
            }

            if (count($results) >= $this->iterationLimit) {
                $this->fail('Infinite loop detected when traversing the period.');
            }
        }

        $this->assertSame(
            // Note: Results are not affected, because start date is used only for initialization.
            array('0 => 2012-07-01', '1 => 2012-07-02', '2 => 2012-07-03', '3 => 2012-07-04'), $results
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
            $this->assertSame($key, $period->key());
            $this->assertEquals($current, $period->current());
            $this->assertTrue($period->valid());

            if (count($results) >= $this->iterationLimit) {
                $this->fail('Infinite loop detected when traversing the period.');
            }
        }

        $this->assertSame(
            array('0 => 2012-07-01', '1 => 2012-07-04', '2 => 2012-07-07'), $results
        );
    }

    public function testValidateOncePerIteration()
    {
        $period = CarbonPeriodFactory::withCounter($counter);

        $period->key();
        $period->current();
        $period->valid();
        $this->assertSame(1, $counter);

        $period->next();
        $this->assertSame(2, $counter);

        $period->key();
        $period->current();
        $period->valid();
        $this->assertSame(2, $counter);
    }

    public function testInvalidateCurrentAfterChangingParameters()
    {
        $period = CarbonPeriod::create('2012-10-01');

        $this->assertInstanceOfCarbon($period->current());

        $period->addFilter(CarbonPeriod::END_ITERATION);

        $this->assertNull($period->current());
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

        $this->assertSame(
            $this->standardizeDates(array('2012-07-04', '2012-07-10', '2012-07-16')),
            $this->standardizeDates($results)
        );
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

        $this->assertSame(
            $this->standardizeDates(array('2018-10-10', '2018-10-11', '2018-10-12', '2018-10-13')),
            $this->standardizeDates($results)
        );
    }

    public function testRevalidateCurrentAfterChangeOfParameters()
    {
        $period = CarbonPeriod::create()->setStartDate($start = new Carbon('2018-10-28'));
        $this->assertEquals($start, $period->current());
        $this->assertNotSame($start, $period->current());

        $period->addFilter($excludeStart = function ($date) use ($start) {
            return $date != $start;
        });
        $this->assertNull($period->current());

        $period->removeFilter($excludeStart);
        $this->assertEquals($start, $period->current());
        $this->assertNotSame($start, $period->current());
    }

    public function testRevalidateCurrentAfterEndOfIteration()
    {
        $period = CarbonPeriod::create()->setStartDate($start = new Carbon('2018-10-28'));
        $this->assertEquals($start, $period->current());
        $this->assertNotSame($start, $period->current());

        $period->addFilter(CarbonPeriod::END_ITERATION);
        $this->assertNull($period->current());

        $period->removeFilter(CarbonPeriod::END_ITERATION);
        $this->assertEquals($start, $period->current());
        $this->assertNotSame($start, $period->current());
    }

    public function testChangeStartDateBeforeIteration()
    {
        $period = CarbonPeriod::create(new Carbon('2018-10-05'), 3);

        $period->setStartDate(new Carbon('2018-10-13'));
        $period->toggleOptions(CarbonPeriod::EXCLUDE_START_DATE, true);

        $this->assertEquals(new Carbon('2018-10-14'), $period->current());
    }

    public function testChangeStartDateAfterStartedIteration()
    {
        $period = CarbonPeriod::create(new Carbon('2018-10-05'), 3);

        $current = $period->current();

        $period->toggleOptions(CarbonPeriod::EXCLUDE_START_DATE, true);
        $period->setStartDate(new Carbon('2018-10-13'));

        $this->assertEquals($current, $period->current());
    }

    public function testInvertDateIntervalDuringIteration()
    {
        $period = new CarbonPeriod('2018-04-11', 5);

        $results = array();

        foreach ($period as $key => $date) {
            $results[] = $date;

            if ($key === 2) {
                $period->invertDateInterval();
            }
        }

        $this->assertSame(
            $this->standardizeDates(array('2018-04-11', '2018-04-12', '2018-04-13', '2018-04-12', '2018-04-11')),
            $this->standardizeDates($results)
        );
    }

    public function testManualIteration()
    {
        $period = CarbonPeriodFactory::withStackFilter();
        $period->rewind();
        $str = '';
        while ($period->valid()) {
            if ($period->key()) {
                $str .= ', ';
            }
            $str .= $period->current()->format('m-d');
            $period->next();
        }

        $this->assertSame('01-01, 01-03', $str);
    }

    public function testSkip()
    {
        $period = CarbonPeriod::create('2018-05-30', '2018-07-13');
        $output = array();

        foreach ($period as $day) {
            /* @var Carbon $day */
            $output[] = $day->format('Y-m-d');

            if ($day->isSunday()) {
                $this->assertTrue($period->skip(7));
                $output[] = '...';
            }
        }

        $this->assertSame(array(
            '2018-05-30',
            '2018-05-31',
            '2018-06-01',
            '2018-06-02',
            '2018-06-03',
            '...',
            '2018-06-11',
            '2018-06-12',
            '2018-06-13',
            '2018-06-14',
            '2018-06-15',
            '2018-06-16',
            '2018-06-17',
            '...',
            '2018-06-25',
            '2018-06-26',
            '2018-06-27',
            '2018-06-28',
            '2018-06-29',
            '2018-06-30',
            '2018-07-01',
            '...',
            '2018-07-09',
            '2018-07-10',
            '2018-07-11',
            '2018-07-12',
            '2018-07-13',
        ), $output);

        $this->assertFalse($period->skip());
        $this->assertFalse($period->skip(7));
    }
}
