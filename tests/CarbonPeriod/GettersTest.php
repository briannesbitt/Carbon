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
use DateTime;
use Tests\AbstractTestCase;
use Tests\CarbonPeriod\Fixtures\CarbonPeriodFactory;

class GettersTest extends AbstractTestCase
{
    public function testGetStartDate()
    {
        $period = CarbonPeriodFactory::withStartIntervalEnd();

        $date = $period->getStartDate();

        $this->assertInstanceOfCarbon($date);

        $this->assertSame('2012-07-01 17:30:00', $date->format('Y-m-d H:i:s'));
    }

    public function testGetEndDate()
    {
        $period = CarbonPeriodFactory::withStartIntervalEnd();

        $date = $period->getEndDate();

        $this->assertInstanceOfCarbon($date);

        $this->assertSame('2012-07-15 11:15:00', $date->format('Y-m-d H:i:s'));
    }

    public function testGetDateInterval()
    {
        $period = CarbonPeriodFactory::withStartIntervalEnd();

        $interval = $period->getDateInterval();

        $this->assertInstanceOfCarbonInterval($interval);

        $this->assertSame('P3DT5H', $interval->spec());
    }

    public function testGetRecurrences()
    {
        $recurrences = CarbonPeriod::create(new DateTime, 5)->getRecurrences();

        $this->assertSame(5, $recurrences);
    }

    public function testGetDefaultDateInterval()
    {
        $period = CarbonPeriod::create(Carbon::parse('2015-09-30'), Carbon::parse('2015-10-03'));

        $this->assertInstanceOfCarbonInterval($period->getDateInterval());

        $this->assertSame('P1D', $period->getDateInterval()->spec());
    }

    public function testModifyStartDate()
    {
        $period = CarbonPeriodFactory::withStartIntervalEnd();

        $period->getStartDate()->subDays(3);

        $this->assertSame('2012-07-01', $period->getStartDate()->format('Y-m-d'));
    }

    public function testModifyEndDate()
    {
        $period = CarbonPeriodFactory::withStartIntervalEnd();

        $period->getEndDate()->addDays(3);

        $this->assertSame('2012-07-15', $period->getEndDate()->format('Y-m-d'));
    }

    public function testModifyDateInterval()
    {
        $period = CarbonPeriodFactory::withStartIntervalEnd();

        $period->getDateInterval()->days(5)->hours(0);

        $this->assertSame('P3DT5H', $period->getDateInterval()->spec());
    }

    public function testGetOptions()
    {
        $period = new CarbonPeriod;

        $this->assertSame(0, $period->getOptions());

        $period = new CarbonPeriod(new DateTime, new DateTime, $options = CarbonPeriod::EXCLUDE_START_DATE | CarbonPeriod::EXCLUDE_END_DATE);

        $this->assertSame($options, $period->getOptions());
    }
}
