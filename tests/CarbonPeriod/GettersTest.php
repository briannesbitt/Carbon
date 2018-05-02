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
use DateInterval;
use DateTime;
use Tests\AbstractTestCase;

class GettersTest extends AbstractTestCase
{
    protected function makePeriod()
    {
        return CarbonPeriod::create(
            new DateTime('2012-07-01 17:30:00'),
            new DateInterval('P3DT5H'),
            new DateTime('2012-07-15 11:15:00')
        );
    }

    public function testGetStartDate()
    {
        $date = $this->makePeriod()->getStartDate();

        $this->assertInstanceOfCarbon($date);

        $this->assertSame('2012-07-01 17:30:00', $date->format('Y-m-d H:i:s'));
    }

    public function testGetEndDate()
    {
        $date = $this->makePeriod()->getEndDate();

        $this->assertInstanceOfCarbon($date);

        $this->assertSame('2012-07-15 11:15:00', $date->format('Y-m-d H:i:s'));
    }

    public function testGetDateInterval()
    {
        $interval = $this->makePeriod()->getDateInterval();

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
        $period = $this->makePeriod();

        $period->getStartDate()->subDays(3);

        $this->assertSame('2012-07-01', $period->getStartDate()->format('Y-m-d'));
    }

    public function testModifyEndDate()
    {
        $period = $this->makePeriod();

        $period->getEndDate()->addDays(3);

        $this->assertSame('2012-07-15', $period->getEndDate()->format('Y-m-d'));
    }

    public function testModifyDateInterval()
    {
        $period = $this->makePeriod();

        $period->getDateInterval()->days(5)->hours(0);

        $this->assertSame('P3DT5H', $period->getDateInterval()->spec());
    }
}
