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

        $this->assertSame(
            $this->standardizeDates(array('2012-07-04', '2012-07-10', '2012-07-16')),
            $this->standardizeDates($result)
        );
    }

    public function testCountByMethod()
    {
        $period = CarbonPeriodFactory::withEvenDaysFilter();

        $this->assertSame(3, $period->count());
    }

    public function testCountByFunction()
    {
        $period = CarbonPeriodFactory::withEvenDaysFilter();

        $this->assertSame(3, count($period));
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
        $result = CarbonPeriod::create(0)->toArray();

        $this->assertInternalType('array', $result);
        $this->assertEmpty($result);
    }

    public function testCountOfEmptyPeriod()
    {
        $period = CarbonPeriod::create(0);

        $this->assertSame(0, $period->count());
    }

    public function testFirstOfEmptyPeriod()
    {
        $period = CarbonPeriod::create(0);

        $this->assertNull($period->first());
    }

    public function testLastOfEmptyPeriod()
    {
        $period = CarbonPeriod::create(0);

        $this->assertNull($period->last());
    }

    public function testRestoreIterationStateAfterCallingToArray()
    {
        $period = CarbonPeriodFactory::withEvenDaysFilter();

        $key = $period->key();
        $current = $period->current();

        $this->assertSame(0, $key);
        $this->assertEquals(new Carbon('2012-07-04'), $current);

        $period->next();

        $this->assertSame(
            $this->standardizeDates(array('2012-07-04', '2012-07-10', '2012-07-16')),
            $this->standardizeDates($period->toArray())
        );

        $this->assertSame(1, $period->key());
        $this->assertEquals(new Carbon('2012-07-10'), $period->current());

        $period->next();

        $this->assertSame(2, $period->key());
        $this->assertEquals(new Carbon('2012-07-16'), $period->current());
    }

    public function testToArrayResultsAreInTheExpectedTimezone()
    {
        $period = CarbonPeriod::create('2018-05-13 12:00 Asia/Kabul', 'PT1H', 3);

        $expected = array(
            '2018-05-13 12:00:00 +04:30',
            '2018-05-13 13:00:00 +04:30',
            '2018-05-13 14:00:00 +04:30',
        );

        $this->assertSame($expected, $this->standardizeDates($period->toArray()));
    }
}
