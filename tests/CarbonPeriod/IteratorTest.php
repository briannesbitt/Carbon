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

class IteratorTest extends AbstractTestCase
{
    /**
     * @see \Tests\CarbonPeriod\FilterTest::testAcceptOnlyEvenDays
     */
    protected function makePeriod()
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

        return $period;
    }

    public function testKeyAndCurrentAreCorrectlyInstantiated()
    {
        $period = $this->makePeriod();

        $this->assertSame(0, $period->key());
        $this->assertInstanceOfCarbon($period->current());
        $this->assertSame('2012-07-04 00:00:00', $period->current()->format('Y-m-d H:i:s'));
    }

    public function testCurrentIsAlwaysCarbonInstance()
    {
        $period = $this->makePeriod();

        foreach ($period as $key => $current) {
            $this->assertInstanceOfCarbon($current);
            $this->assertEquals($current, $period->current());
        }
    }

    public function testKeysAreSequential()
    {
        $expected = 0;

        $period = $this->makePeriod();

        foreach ($period as $key => $current) {
            $this->assertSame($expected++, $key);
            $this->assertSame($key, $period->key());
        }
    }

    public function testKeyAndCurrentAreCorrectlyIncremented()
    {
        $period = $this->makePeriod();

        $period->next();

        $this->assertEquals(1, $period->key());
        $this->assertEquals('2012-07-10 00:00:00', $period->current()->format('Y-m-d H:i:s'));
    }

    public function testKeyAndCurrentAreCorrectlyRewinded()
    {
        $period = $this->makePeriod();

        $period->next();
        $period->rewind();

        $this->assertEquals(0, $period->key());
        $this->assertEquals('2012-07-04 00:00:00', $period->current()->format('Y-m-d H:i:s'));
    }

    public function testKeyAndCurrentAreNullAfterIteration()
    {
        $period = $this->makePeriod();

        foreach ($period as $key => $current) {
        }

        $this->assertNull($period->key());
        $this->assertNull($period->current());
    }
}
