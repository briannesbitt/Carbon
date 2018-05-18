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
use Tests\AbstractTestCase;
use Tests\CarbonPeriod\Fixtures\CarbonPeriodFactory;

class ToArrayTest extends AbstractTestCase
{
    public function testToArrayIsNotEmptyArray()
    {
        $result = CarbonPeriodFactory::withEvenDaysFilter()->toArray();

        $this->assertInternalType('array', $result);
        $this->assertNotEmpty($result);
    }

    public function testToArrayHasCorrectCount()
    {
        $period = CarbonPeriodFactory::withEvenDaysFilter();

        $this->assertCount(3, $period->toArray());
    }

    public function testToArrayValuesAreCarbonInstances()
    {
        $result = CarbonPeriodFactory::withEvenDaysFilter()->toArray();

        foreach ($result as $key => $current) {
            $this->assertInstanceOfCarbon($current);
        }
    }

    public function testToArrayKeysAreSequential()
    {
        $result = CarbonPeriodFactory::withEvenDaysFilter()->toArray();

        $this->assertSame(array(0, 1, 2), array_keys($result));
    }

    public function testToArrayHasCorrectValues()
    {
        $result = CarbonPeriodFactory::withEvenDaysFilter()->toArray();

        $this->assertEquals(
            $this->standardizeDates(array('2012-07-04', '2012-07-10', '2012-07-16')),
            $this->standardizeDates($result)
        );
    }

    public function testCountByMethod()
    {
        $period = CarbonPeriodFactory::withEvenDaysFilter();

        $this->assertEquals(3, $period->count());
    }

    public function testCountByFunction()
    {
        $period = CarbonPeriodFactory::withEvenDaysFilter();

        $this->assertEquals(3, count($period));
    }

    public function testFirst()
    {
        $period = CarbonPeriodFactory::withEvenDaysFilter();

        $this->assertEquals(new Carbon('2012-07-04'), $period->first());
    }

    public function testLast()
    {
        $period = CarbonPeriodFactory::withEvenDaysFilter();

        $this->assertEquals(new Carbon('2012-07-16'), $period->last());
    }

    public function testToArrayOfEmptyPeriod()
    {
        $result = CarbonPeriod::create()->toArray();

        $this->assertInternalType('array', $result);
        $this->assertEmpty($result);
    }

    public function testCountOfEmptyPeriod()
    {
        $period = CarbonPeriod::create();

        $this->assertEquals(0, $period->count());
    }

    public function testFirstOfEmptyPeriod()
    {
        $period = CarbonPeriod::create();

        $this->assertNull($period->first());
    }

    public function testLastOfEmptyPeriod()
    {
        $period = CarbonPeriod::create();

        $this->assertNull($period->last());
    }

    public function testClearCachedArrayWhenPropertiesAreChanged()
    {
        $period = CarbonPeriod::create('2012-10-01', 3);

        $this->assertCount(3, $period->toArray());

        $period->addFilter(CarbonPeriod::END_ITERATION);

        $this->assertCount(0, $period->toArray());
    }

    public function testRestartInterruptedIteration()
    {
        $period = CarbonPeriodFactory::withCounter($counter);

        $period->next();
        $period->setStartDate($period->getStartDate());
        $this->assertEquals(2, $counter);

        $period->toArray();
        $this->assertEquals(5, $counter);
    }

    public function testRestoreIterationStateAfterCallingToArray()
    {
        $period = CarbonPeriodFactory::withEvenDaysFilter();

        $period->next();

        $key = $period->key();
        $current = $period->current();

        $this->assertEquals(
            $this->standardizeDates(array('2012-07-04', '2012-07-10', '2012-07-16')),
            $this->standardizeDates($period->toArray())
        );

        $this->assertEquals(1, $period->key());
        $this->assertEquals(new Carbon('2012-07-10'), $period->current());

        $period->next();

        $this->assertEquals(2, $period->key());
        $this->assertEquals(new Carbon('2012-07-16'), $period->current());
    }

    public function testIterationResultsCannotBeIndirectlyModified()
    {
        $period = CarbonPeriod::create('2012-10-01', '2012-10-02');

        foreach ($period->toArray() as $date) {
            $date->addDay();
        }

        $this->assertEquals(
            $this->standardizeDates(array('2012-10-01', '2012-10-02')),
            $this->standardizeDates($period->toArray())
        );
    }

    public function testToArrayResultsAreInTheExpectedTimezone()
    {
        $period = CarbonPeriod::create('2018-05-13 12:00 Asia/Kabul', 'PT1H', 3);

        $expected = array(
            '2018-05-13 12:00:00 +04:30',
            '2018-05-13 13:00:00 +04:30',
            '2018-05-13 14:00:00 +04:30',
        );

        $this->assertEquals($expected, $this->standardizeDates($period->toArray()));
    }

    public function testRefreshToArrayResultsAfterChangingProperties()
    {
        $period = CarbonPeriod::create('2018-05-13 22:00', 'PT1H');

        $results = array();

        while ($current = $period->current()) {
            $results[] = $current;

            if ($current->format('Y-m-d') != '2018-05-13') {
                $period->interval('P1D')->end('2018-05-15');
            }

            $period->next();
        }

        $this->assertEquals(
            $this->standardizeDates(array('2018-05-13 22:00', '2018-05-13 23:00', '2018-05-14 00:00', '2018-05-15 00:00')),
            $this->standardizeDates($results)
        );

        $this->assertEquals(
            $this->standardizeDates(array('2018-05-13 22:00', '2018-05-14 22:00')),
            $this->standardizeDates($period->toArray())
        );
    }
}
