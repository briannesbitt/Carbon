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

namespace Tests\CarbonInterval;

use Carbon\CarbonInterval;
use DateInterval;
use Tests\AbstractTestCase;

class SpecTest extends AbstractTestCase
{
    public function testZeroInterval()
    {
        $ci = new CarbonInterval(0, 0, 0, 0, 0, 0, 0);
        $this->assertSame('PT0S', $ci->spec());
        $ci = new CarbonInterval();
        $this->assertSame('PT0S', $ci->spec());
        $ci = CarbonInterval::create();
        $this->assertSame('PT0S', $ci->spec());
    }

    public function testYearInterval()
    {
        $ci = new CarbonInterval(1);
        $this->assertSame('P1Y', $ci->spec());
        $ci = CarbonInterval::create(1);
        $this->assertSame('P1Y', $ci->spec());
    }

    public function testMonthInterval()
    {
        $ci = new CarbonInterval(0, 1);
        $this->assertSame('P1M', $ci->spec());
    }

    public function testWeekInterval()
    {
        $ci = new CarbonInterval(0, 0, 1);
        $this->assertSame('P7D', $ci->spec());
    }

    public function testDayInterval()
    {
        $ci = new CarbonInterval(0, 0, 0, 1);
        $this->assertSame('P1D', $ci->spec());
    }

    public function testMixedDateInterval()
    {
        $ci = new CarbonInterval(1, 2, 0, 3);
        $this->assertSame('P1Y2M3D', $ci->spec());
    }

    public function testHourInterval()
    {
        $ci = new CarbonInterval(0, 0, 0, 0, 1);
        $this->assertSame('PT1H', $ci->spec());
    }

    public function testMinuteInterval()
    {
        $ci = new CarbonInterval(0, 0, 0, 0, 0, 1);
        $this->assertSame('PT1M', $ci->spec());
    }

    public function testSecondInterval()
    {
        $ci = new CarbonInterval(0, 0, 0, 0, 0, 0, 1);
        $this->assertSame('PT1S', $ci->spec());
    }

    public function testMicrosecondsInterval()
    {
        $ci = new CarbonInterval(0, 0, 0, 0, 0, 0, 0, 12300);
        $this->assertSame('PT0.012300S', $ci->spec(true));
    }

    public function testMixedTimeInterval()
    {
        $ci = new CarbonInterval(0, 0, 0, 0, 1, 2, 3);
        $this->assertSame('PT1H2M3S', $ci->spec());
    }

    public function testMixedDateAndTimeInterval()
    {
        $ci = new CarbonInterval(1, 2, 0, 3, 4, 5, 6);
        $this->assertSame('P1Y2M3DT4H5M6S', $ci->spec());
    }

    public function testCreatingInstanceEquals()
    {
        $ci = new CarbonInterval(1, 2, 0, 3, 4, 5, 6);
        $this->assertEquals($ci->optimize(), CarbonInterval::instance(new DateInterval($ci->spec()))->optimize());
    }
}
