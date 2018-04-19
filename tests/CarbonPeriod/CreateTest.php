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

class CreateTest extends AbstractTestCase
{
    /**
     * @throws \ReflectionException
     */
    public function testCreateWithString()
    {
        $period = CarbonPeriod::create('R4/2012-07-01T00:00:00Z/P7D');
        $results = array();
        foreach ($period as $date) {
            self::assertInstanceOf('Carbon\Carbon', $date);
            $results[] = $date->format('Y-m-d H:i:s');
        }
        self::assertSame(array(
            '2012-07-01 00:00:00',
            '2012-07-08 00:00:00',
            '2012-07-15 00:00:00',
            '2012-07-22 00:00:00',
            '2012-07-29 00:00:00',
        ), $results);
    }

    /**
     * @throws \ReflectionException
     */
    public function testCreateWithTwoDates()
    {
        $period = CarbonPeriod::create(Carbon::parse('2015-09-30'), Carbon::parse('2015-10-03'));
        $results = array();
        foreach ($period as $key => $date) {
            self::assertInstanceOf('Carbon\Carbon', $date);
            $results[] = $key.':'.$date->format('Y-m-d');
        }
        self::assertSame(array(
            '0:2015-09-30',
            '1:2015-10-01',
            '2:2015-10-02',
        ), $results);
        self::assertInstanceOf('Carbon\CarbonInterval', $period->getDateInterval());
        self::assertSame('1 day', $period->getDateInterval()->forHumans());
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testCreateFromEmptyInterval()
    {
        CarbonPeriod::create(
            Carbon::now(),
            CarbonInterval::days(0),
            Carbon::tomorrow()
        );
    }
}
