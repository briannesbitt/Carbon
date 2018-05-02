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

use Carbon\CarbonPeriod;
use DateInterval;
use DateTime;
use Tests\AbstractTestCase;

class SettersTest extends AbstractTestCase
{
    public function testCreateFluently()
    {
        $period = CarbonPeriod::create();

        $this->assertNull($period->getStartDate());
        $this->assertSame('P1D', $period->getDateInterval()->spec());
        $this->assertNull($period->getEndDate());
        $this->assertNull($period->getRecurrences());

        $period->setStartDate('2018-03-25')
            ->setDateInterval('P3D')
            ->setEndDate('2018-04-25')
            ->setRecurrences(5);

        $this->assertSame('2018-03-25', $period->getStartDate()->toDateString());
        $this->assertSame('P3D', $period->getDateInterval()->spec());
        $this->assertSame('2018-04-25', $period->getEndDate()->toDateString());
        $this->assertSame(5, $period->getRecurrences());

        $period->setDates('2019-04-12', '2019-04-19');

        $this->assertSame('2019-04-12', $period->getStartDate()->toDateString());
        $this->assertSame('P3D', $period->getDateInterval()->spec());
        $this->assertSame('2019-04-19', $period->getEndDate()->toDateString());
        $this->assertSame(5, $period->getRecurrences());
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Invalid interval.
     */
    public function testInvalidInterval()
    {
        CarbonPeriod::create()->setDateInterval(new DateTime());
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Invalid number of recurrences.
     */
    public function testInvalidNumberOfRecurrencesString()
    {
        CarbonPeriod::create()->setRecurrences('foo');
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Invalid number of recurrences.
     */
    public function testInvalidNegativeNumberOfRecurrences()
    {
        CarbonPeriod::create()->setRecurrences(-4);
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Invalid options.
     */
    public function testInvalidOptions()
    {
        CarbonPeriod::create()->setOptions('1');
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Invalid constructor parameters.
     */
    public function testInvalidConstructorParameters()
    {
        CarbonPeriod::create(array());
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Invalid start date.
     */
    public function testInvalidStartDate()
    {
        CarbonPeriod::create()->setStartDate(new DateInterval('P1D'));
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Invalid end date.
     */
    public function testInvalidEndDate()
    {
        CarbonPeriod::create()->setEndDate(new DateInterval('P1D'));
    }
}
