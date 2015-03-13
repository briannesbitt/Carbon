<?php

/*
 * This file is part of the Carbon package.
 *
 * (c) Brian Nesbitt <brian@nesbot.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Carbon\CarbonInterval;

class CarbonIntervalGettersTest extends TestFixture
{
    public function testGettersThrowExceptionOnUnknownGetter()
    {
        $this->setExpectedException('InvalidArgumentException');
        CarbonInterval::year()->sdfsdfss;
    }

    public function testYearsGetter()
    {
        $d = CarbonInterval::create(4, 5, 6, 5, 8, 9, 10);
        $this->assertSame(4, $d->years);
    }

    public function testMonthsGetter()
    {
        $d = CarbonInterval::create(4, 5, 6, 5, 8, 9, 10);
        $this->assertSame(5, $d->months);
    }

    public function testWeeksGetter()
    {
        $d = CarbonInterval::create(4, 5, 6, 5, 8, 9, 10);
        $this->assertSame(6, $d->weeks);
    }

    public function testDayzExcludingWeeksGetter()
    {
        $d = CarbonInterval::create(4, 5, 6, 5, 8, 9, 10);
        $this->assertSame(5, $d->daysExcludeWeeks);
        $this->assertSame(5, $d->dayzExcludeWeeks);
    }

    public function testDayzGetter()
    {
        $d = CarbonInterval::create(4, 5, 6, 5, 8, 9, 10);
        $this->assertSame(6 * 7 + 5, $d->dayz);
    }

    public function testHoursGetter()
    {
        $d = CarbonInterval::create(4, 5, 6, 5, 8, 9, 10);
        $this->assertSame(8, $d->hours);
    }

    public function testMinutesGetter()
    {
        $d = CarbonInterval::create(4, 5, 6, 5, 8, 9, 10);
        $this->assertSame(9, $d->minutes);
    }

    public function testSecondsGetter()
    {
        $d = CarbonInterval::create(4, 5, 6, 5, 8, 9, 10);
        $this->assertSame(10, $d->seconds);
    }
}
