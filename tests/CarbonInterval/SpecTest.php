<?php

/*
 * This file is part of the Carbon package.
 *
 * (c) Brian Nesbitt <brian@nesbot.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tests\CarbonInterval;

use Carbon\CarbonInterval;
use DateInterval;
use Tests\AbstractTestCase;

class SpecTest extends AbstractTestCase
{
    public function testZeroInterval()
    {
        $ci = new CarbonInterval(0, 0, 0, 0, 0, 0, 0);
        $this->assertEquals('PT0S', $ci->spec());
    }

    public function testYearInterval()
    {
        $ci = new CarbonInterval();
        $this->assertEquals('P1Y', $ci->spec());
    }

    public function testMonthInterval()
    {
        $ci = new CarbonInterval(0, 1);
        $this->assertEquals('P1M', $ci->spec());
    }

    public function testWeekInterval()
    {
        $ci = new CarbonInterval(0, 0, 1);
        $this->assertEquals('P7D', $ci->spec());
    }

    public function testDayInterval()
    {
        $ci = new CarbonInterval(0, 0, 0, 1);
        $this->assertEquals('P1D', $ci->spec());
    }

    public function testMixedDateInterval()
    {
        $ci = new CarbonInterval(1, 2, 0, 3);
        $this->assertEquals('P1Y2M3D', $ci->spec());
    }

    public function testHourInterval()
    {
        $ci = new CarbonInterval(0, 0, 0, 0, 1);
        $this->assertEquals('PT1H', $ci->spec());
    }

    public function testMinuteInterval()
    {
        $ci = new CarbonInterval(0, 0, 0, 0, 0, 1);
        $this->assertEquals('PT1M', $ci->spec());
    }

    public function testSecondInterval()
    {
        $ci = new CarbonInterval(0, 0, 0, 0, 0, 0, 1);
        $this->assertEquals('PT1S', $ci->spec());
    }

    public function testMixedTimeInterval()
    {
        $ci = new CarbonInterval(0, 0, 0, 0, 1, 2, 3);
        $this->assertEquals('PT1H2M3S', $ci->spec());
    }

    public function testMixedDateAndTimeInterval()
    {
        $ci = new CarbonInterval(1, 2, 0, 3, 4, 5, 6);
        $this->assertEquals('P1Y2M3DT4H5M6S', $ci->spec());
    }

    public function testCreatingInstanceEquals()
    {
        $ci = new CarbonInterval(1, 2, 0, 3, 4, 5, 6);
        $this->assertEquals($ci, CarbonInterval::instance(new DateInterval($ci->spec())));
    }
}
