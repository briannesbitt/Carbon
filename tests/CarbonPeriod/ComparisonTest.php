<?php
declare(strict_types = 1);

/**
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
use DatePeriod;
use Tests\AbstractTestCase;

class ComparisonTest extends AbstractTestCase
{
    public function testEqualToTrue()
    {
        $period = CarbonPeriod::create('2010-01-01', '2010-02-01');

        $this->assertTrue($period->equalTo($period));
        $this->assertTrue($period->eq($period));
        $this->assertTrue($period->eq(CarbonPeriod::create('2010-01-01', '2010-02-01')));
        $this->assertTrue($period->eq(CarbonPeriod::create('R3/2010-01-01/P1D/2010-02-01')));
        $this->assertTrue($period->eq(Carbon::parse('2010-01-01')->daysUntil('2010-02-01')));
        $this->assertTrue($period->eq(new DatePeriod(Carbon::parse('2010-01-01'), CarbonInterval::day(), Carbon::parse('2010-02-01'))));

        $period = CarbonPeriod::create('2010-01-01', '2010-02-01', 'P2D');

        $this->assertTrue($period->eq(CarbonPeriod::create('2010-01-01', '2010-02-01', 'P2D')));
        $this->assertTrue($period->eq(CarbonPeriod::create('2010-01-01', '2010-02-01', CarbonInterval::day(2))));
        $this->assertTrue($period->eq(CarbonPeriod::create('2010-01-01', '2010-02-01')->setDateInterval('P2D')));
        $this->assertTrue($period->eq(CarbonPeriod::create('R3/2010-01-01/P2D/2010-02-01')));

        $period = CarbonPeriod::create('2010-01-01', '2010-02-01', CarbonPeriod::EXCLUDE_START_DATE);

        $this->assertTrue($period->eq(CarbonPeriod::create('2010-01-01', '2010-02-01', CarbonPeriod::EXCLUDE_START_DATE)));
        $this->assertTrue($period->eq(CarbonPeriod::create('2010-01-01', '2010-02-01')->setOptions(CarbonPeriod::EXCLUDE_START_DATE)));
    }

    public function testEqualToFalse()
    {
        $period = CarbonPeriod::create('2010-01-01', '2010-02-01');

        $this->assertFalse($period->equalTo(CarbonPeriod::create('2010-01-02', '2010-02-01')));
        $this->assertFalse($period->eq(CarbonPeriod::create('2010-01-02', '2010-02-01')));
        $this->assertFalse($period->eq(CarbonPeriod::create('2010-01-01', '2010-02-02')));
        $this->assertFalse($period->eq(CarbonPeriod::create('2010-01-01', '2010-02-02', 'P2D')));
        $this->assertFalse($period->eq(CarbonPeriod::create('2010-01-01', '2010-02-02', CarbonPeriod::EXCLUDE_START_DATE)));
    }
}
