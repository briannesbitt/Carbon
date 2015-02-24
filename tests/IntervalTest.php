<?php

/*
 * This file is part of the Carbon package.
 *
 * (c) Ben Glassman <bglassman@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Carbon\CarbonInterval;

class IntervalTest extends TestFixture
{
    /**
     * @dataProvider provideTestCreateTests
     */
    public function testCreate(CarbonInterval $interval, $expected)
    {
        $this->assertSame($expected, $interval->format('%y years %m months %d days %h hours %i minutes %s seconds'));
    }

    public function provideTestCreateTests()
    {
        return array(
            array(CarbonInterval::create(1), '1 years 0 months 0 days 0 hours 0 minutes 0 seconds'),
            array(CarbonInterval::create(null, 1), '0 years 1 months 0 days 0 hours 0 minutes 0 seconds'),
            array(CarbonInterval::create(null, null, 1), '0 years 0 months 7 days 0 hours 0 minutes 0 seconds'),
            array(CarbonInterval::create(null, null, null, 1), '0 years 0 months 1 days 0 hours 0 minutes 0 seconds'),
            array(CarbonInterval::create(null, null, null, null, 1), '0 years 0 months 0 days 1 hours 0 minutes 0 seconds'),
            array(CarbonInterval::create(null, null, null, null, null, 1), '0 years 0 months 0 days 0 hours 1 minutes 0 seconds'),
            array(CarbonInterval::create(null, null, null, null, null, null, 1), '0 years 0 months 0 days 0 hours 0 minutes 1 seconds'),
            array(CarbonInterval::create(1, 1, 1, 1, 1, 1, 1), '1 years 1 months 8 days 1 hours 1 minutes 1 seconds'),
        );
    }

    public function testCreateWeeks()
    {
        $interval = CarbonInterval::create(null, null, 2, 3);
        $this->assertSame('17 days', $interval->format('%d days'));
        $interval = CarbonInterval::create(null, null, 5);
        $this->assertSame('35 days', $interval->format('%d days'));
    }

    /**
     * @dataProvider provideTestIntervalForHumans
     */
    public function testIntervalForHumans(CarbonInterval $interval, $expected)
    {
        $this->assertSame($expected, $interval->intervalForHumans());
    }

    public function provideTestIntervalForHumans()
    {
        return array(
            array(CarbonInterval::create(1), '1 year'),
            array(CarbonInterval::create(2), '2 years'),
            array(CarbonInterval::create(3, 1), '3 years 1 month'),
            array(CarbonInterval::create(3, null, 3), '3 years 3 weeks'),
            array(CarbonInterval::create(3, 1, 3, 1), '3 years 1 month 3 weeks 1 day'),
            array(CarbonInterval::create(6, null, 3, null, 1, 30), '6 years 3 weeks 1 hour 30 minutes'),
            array(CarbonInterval::create(null, null, null, null, 3, 30, 1), '3 hours 30 minutes 1 second'),
        );
    }
}
