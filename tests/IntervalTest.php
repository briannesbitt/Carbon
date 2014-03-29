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
     * @dataProvider providerTestCreateTests
     */
    public function testCreate($years, $months, $weeks, $days, $hours, $minutes, $seconds, $expected)
    {
        $interval = CarbonInterval::create($years, $months, $weeks, $days, $hours, $minutes, $seconds);

        $this->assertSame($expected, $interval->format('%y years %m months %d days %h hours %i minutes %s seconds'));
    }

    public function providerTestCreateTests()
    {
        return array(
            array(1, null, null, null, null, null, null, '1 years 0 months 0 days 0 hours 0 minutes 0 seconds'),
            array(null, 1, null, null, null, null, null, '0 years 1 months 0 days 0 hours 0 minutes 0 seconds'),
            array(null, null, 1, null, null, null, null, '0 years 0 months 7 days 0 hours 0 minutes 0 seconds'),
            array(null, null, null, 1, null, null, null, '0 years 0 months 1 days 0 hours 0 minutes 0 seconds'),
            array(null, null, null, null, 1, null, null, '0 years 0 months 0 days 1 hours 0 minutes 0 seconds'),
            array(null, null, null, null, null, 1, null, '0 years 0 months 0 days 0 hours 1 minutes 0 seconds'),
            array(null, null, null, null, null, null, 1, '0 years 0 months 0 days 0 hours 0 minutes 1 seconds'),
            array(1, 1, 1, 1, 1, 1, 1, '1 years 1 months 8 days 1 hours 1 minutes 1 seconds'),
        );
    }

    public function testCreateWeeks()
    {
        $interval = CarbonInterval::create(null, null, 2, 3);
        $this->assertSame('17 days', $interval->format('%d days'));
        $interval = CarbonInterval::create(null, null, 5);
        $this->assertSame('35 days', $interval->format('%d days'));
    }
}
