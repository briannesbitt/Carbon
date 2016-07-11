<?php

/*
 * This file is part of the Carbon package.
 *
 * (c) Brian Nesbitt <brian@nesbot.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tests\Carbon;

use Carbon\Carbon;
use Carbon\CarbonExtensions;
use Tests\AbstractTestCase;
use Tests\CarbonExtensions\Fixtures\FederalHolidays;
use Tests\CarbonExtensions\Fixtures\FederalHolidaysObserved;
use Tests\CarbonExtensions\Fixtures\OperatingSchedule;

class BusinessDayTest extends AbstractTestCase
{
    public function testIsBusinessDay()
    {
        $date = Carbon::create(2016, 7, 4, 0, 0, 0);
        $this->assertTrue(CarbonExtensions::isBusinessDay($date));

        $date = Carbon::create(2016, 7, 9, 0, 0, 0);
        $this->assertFalse(CarbonExtensions::isBusinessDay($date));

        $schedule = new OperatingSchedule(2016);
        $this->assertFalse(CarbonExtensions::isBusinessDay($date->copy()->subDay(2), $schedule));
        $this->assertTrue(CarbonExtensions::isBusinessDay($date->copy()->subDay(), $schedule));
        $this->assertTrue(CarbonExtensions::isBusinessDay($date, $schedule));
        $this->assertTrue(CarbonExtensions::isBusinessDay($date->copy()->addDay(), $schedule));
        $this->assertTrue(CarbonExtensions::isBusinessDay($date->copy()->addDay(2), $schedule));
        $this->assertFalse(CarbonExtensions::isBusinessDay($date->copy()->addDay(3), $schedule));
    }

    public function testIsBusinessDayObservingHolidays()
    {
        $year = 2016;
        $holidays = new FederalHolidays($year);
        $observedHolidays = new FederalHolidaysObserved($year);

        $this->assertTrue($holidays->christmasDay->isSunday());
        $this->assertFalse(CarbonExtensions::isBusinessDay($holidays->christmasDay));
        $this->assertFalse(CarbonExtensions::isBusinessDay($holidays->christmasDay->copy()->addDay(), $observedHolidays));
        $this->assertTrue(CarbonExtensions::isBusinessDay($holidays->christmasDay->copy()->addDay(2), $observedHolidays));

        $this->assertTrue($holidays->independenceDay->isMonday());
        $this->assertFalse(CarbonExtensions::isBusinessDay($holidays->independenceDay, $holidays));
        $this->assertTrue(CarbonExtensions::isBusinessDay($holidays->independenceDay->copy()->addDay(), $observedHolidays));
        $this->assertTrue(CarbonExtensions::isBusinessDay($holidays->independenceDay->copy()->addDay(2), $observedHolidays));

        $this->assertTrue($holidays->veteransDay->isFriday());
        $this->assertFalse(CarbonExtensions::isBusinessDay($holidays->veteransDay, $holidays));
        $this->assertFalse(CarbonExtensions::isBusinessDay($holidays->veteransDay->copy()->addDay(), $observedHolidays));
        $this->assertFalse(CarbonExtensions::isBusinessDay($holidays->veteransDay->copy()->addDay(2), $observedHolidays));
        $this->assertTrue(CarbonExtensions::isBusinessDay($holidays->veteransDay->copy()->addDay(3), $observedHolidays));
    }

    public function testIsBusinessDayExcludingSomeHolidays()
    {
        $year = 2016;
        $holidays = new FederalHolidays($year);
        $excludedHolidays = new FederalHolidays($year);
        $excludedHolidays->observedHolidays = FederalHolidays::ALL_HOLIDAYS ^ FederalHolidays::COLUMBUS_DAY;

        $this->assertFalse(CarbonExtensions::isBusinessDay($holidays->columbusDay, $holidays));
        $this->assertTrue(CarbonExtensions::isBusinessDay($holidays->columbusDay, $excludedHolidays));
    }

    public function testGetNextBusinessDay()
    {
        $year = 2016;
        $holidays = new FederalHolidays($year);
        $observedHolidays = new FederalHolidaysObserved($year);

        $date = $holidays->christmasDay->copy()->subDay();
        $this->assertTrue($date->isSaturday());
        CarbonExtensions::nextBusinessDay($date, $holidays);
        $this->assertTrue($date->isMonday());
        $this->assertTrue($date->isSameDay(Carbon::create($year, 12, 26, 0, 0, 0)));

        $date = $holidays->christmasDay->copy()->subDay();
        CarbonExtensions::nextBusinessDay($date, $observedHolidays);
        $this->assertTrue($date->isTuesday());
        $this->assertTrue($date->isSameDay(Carbon::create($year, 12, 27, 0, 0, 0)));

        $date = $holidays->veteransDay->copy()->subDay();
        $this->assertTrue($date->isThursday());
        CarbonExtensions::nextBusinessDay($date, $holidays);
        $this->assertTrue($date->isMonday());
        $this->assertTrue($date->isSameDay(Carbon::create($year, 11, 14, 0, 0, 0)));

        $date = $holidays->veteransDay->copy()->subDay();
        $this->assertTrue($date->isThursday());
        CarbonExtensions::nextBusinessDay($date, $observedHolidays);
        $this->assertTrue($date->isMonday());
        $this->assertTrue($date->isSameDay(Carbon::create($year, 11, 14, 0, 0, 0)));

        $date = $holidays->thanksgivingDay->copy()->subDay();
        $this->assertTrue($date->isWednesday());
        CarbonExtensions::nextBusinessDay($date, $holidays);
        $this->assertTrue($date->isFriday());
        $this->assertTrue($date->isSameDay(Carbon::create($year, 11, 25, 0, 0, 0)));
    }

    public function testGetPreviousBusinessDay()
    {
        $year = 2016;
        $holidays = new FederalHolidays($year);
        $observedHolidays = new FederalHolidaysObserved($year);

        $date = $holidays->christmasDay->copy()->addDay();
        $this->assertTrue($date->isMonday());
        CarbonExtensions::previousBusinessDay($date, $holidays);
        $this->assertTrue($date->isFriday());
        $this->assertTrue($date->isSameDay(Carbon::create($year, 12, 23, 0, 0, 0)));

        $date = $holidays->christmasDay->copy()->addDay();
        CarbonExtensions::previousBusinessDay($date, $observedHolidays);
        $this->assertTrue($date->isFriday());
        $this->assertTrue($date->isSameDay(Carbon::create($year, 12, 23, 0, 0, 0)));

        $date = $holidays->veteransDay->copy()->addDay();
        $this->assertTrue($date->isSaturday());
        CarbonExtensions::previousBusinessDay($date, $holidays);
        $this->assertTrue($date->isThursday());
        $this->assertTrue($date->isSameDay(Carbon::create($year, 11, 10, 0, 0, 0)));

        $date = $holidays->veteransDay->copy()->addDay();
        $this->assertTrue($date->isSaturday());
        CarbonExtensions::previousBusinessDay($date, $observedHolidays);
        $this->assertTrue($date->isThursday());
        $this->assertTrue($date->isSameDay(Carbon::create($year, 11, 10, 0, 0, 0)));

        $date = $holidays->thanksgivingDay->copy()->addDay();
        $this->assertTrue($date->isFriday());
        CarbonExtensions::previousBusinessDay($date, $holidays);
        $this->assertTrue($date->isWednesday());
        $this->assertTrue($date->isSameDay(Carbon::create($year, 11, 23, 0, 0, 0)));
    }
}
