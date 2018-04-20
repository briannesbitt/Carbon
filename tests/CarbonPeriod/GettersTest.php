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

use DateTime;
use DateInterval;
use Carbon\CarbonPeriod;
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

    /**
     * @throws \ReflectionException
     */
    public function testGetStartDate()
    {
        $date = $this->makePeriod()->getStartDate();

        $this->assertInstanceOfCarbon($date);

        $this->assertSame('2012-07-01 17:30:00', $date->format('Y-m-d H:i:s'));
    }

    /**
     * @throws \ReflectionException
     */
    public function testGetEndDate()
    {
        $date = $this->makePeriod()->getEndDate();

        $this->assertInstanceOfCarbon($date);

        $this->assertSame('2012-07-15 11:15:00', $date->format('Y-m-d H:i:s'));
    }

    /**
     * @throws \ReflectionException
     */
    public function testGetDateInterval()
    {
        $interval = $this->makePeriod()->getDateInterval();

        $this->assertInstanceOfCarbonInterval($interval);

        $this->assertSame('P3DT5H', $interval->spec());
    }

    /**
     * @throws \ReflectionException
     */
    public function testGetRecurrences()
    {
        $recurrences = CarbonPeriod::create(new DateTime, 5)->getRecurrences();

        $this->assertSame(5, $recurrences);
    }
}
