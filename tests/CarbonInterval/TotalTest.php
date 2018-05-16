<?php

namespace Tests\CarbonInterval;

use Carbon\Carbon;
use Carbon\CarbonInterval;
use Tests\AbstractTestCase;

class TotalTest extends AbstractTestCase
{
    /**
     * @dataProvider provideIntervalSpecs
     */
    public function testReturnsTotalValue($spec, $unit, $expected)
    {
        $this->assertSame(
            $expected, CarbonInterval::fromString($spec)->total($unit)
        );
    }

    public function provideIntervalSpecs()
    {
        return array(
            array('10s',                'seconds', 10),
            array('100s',               'seconds', 100),
            array('2d 4h 17m 35s',      'seconds', ((2 * 24 + 4) * 60 + 17) * 60 + 35),
            array('1y',                 'Seconds', 12 * 4 * 7 * 24 * 60 * 60),
            array('1000y',              'SECONDS', 1000 * 12 * 4 * 7 * 24 * 60 * 60),
            array('235s',               'minutes', 235 / 60),
            array('3h 14m 235s',        'minutes', 3 * 60 + 14 + 235 / 60),
            array('27h 150m 4960s',     'hours',   27 + (150 + 4960 / 60) / 60),
            array('5mo 54d 185h 7680m', 'days',    5 * 4 * 7 + 54 + (185 + 7680 / 60) / 24),
            array('4y 2mo',             'days',    (4 * 12 + 2) * 4 * 7),
            array('165d',               'weeks',   165 / 7),
            array('5mo',                'weeks',   5 * 4),
            array('6897d',              'months',  6897 / 7 / 4),
            array('35mo',               'years',   35 / 12),
        );
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testThrowsExceptionForInvalidUnits()
    {
        CarbonInterval::create()->total('foo');
    }

    public function testGetTotalsViaGetters()
    {
        $interval = CarbonInterval::create(0, 0, 0, 0, 150, 0, 0);

        $this->assertSame(150 * 60 * 60, $interval->totalSeconds);
        $this->assertSame(150 * 60, $interval->totalMinutes);
        $this->assertSame(150, $interval->totalHours);
        $this->assertSame(150 / 24, $interval->totalDays);
        $this->assertSame(150 / 24 / 7, $interval->totalWeeks);
        $this->assertSame(150 / 24 / 7 / 4, $interval->totalMonths);
        $this->assertSame(150 / 24 / 7 / 4 / 12, $interval->totalYears);
    }

    public function testGetTotalsViaGettersWithCustomFactors()
    {
        $cascades = CarbonInterval::getCascadeFactors();
        CarbonInterval::setCascadeFactors(array(
            'minutes' => array(Carbon::SECONDS_PER_MINUTE, 'seconds'),
            'hours' => array(Carbon::MINUTES_PER_HOUR, 'minutes'),
            'days' => array(8, 'hours'),
            'weeks' => array(5, 'days'),
        ));
        $interval = CarbonInterval::create(0, 0, 0, 0, 150, 0, 0);
        $totalSeconds = $interval->totalSeconds;
        $totalMinutes = $interval->totalMinutes;
        $totalHours = $interval->totalHours;
        $totalDays = $interval->totalDays;
        $totalWeeks = $interval->totalWeeks;
        $monthsError = null;
        try {
            $interval->totalMonths;
        } catch (\InvalidArgumentException $exception) {
            $monthsError = $exception->getMessage();
        }
        $yearsError = null;
        try {
            $interval->totalYears;
        } catch (\InvalidArgumentException $exception) {
            $yearsError = $exception->getMessage();
        }
        CarbonInterval::setCascadeFactors($cascades);

        $this->assertSame(150 * 60 * 60, $totalSeconds);
        $this->assertSame(150 * 60, $totalMinutes);
        $this->assertSame(150, $totalHours);
        $this->assertSame(150 / 8, $totalDays);
        $this->assertSame(150 / 8 / 5, $totalWeeks);
        $this->assertSame('Unit months have no configuration to get total from other units.', $monthsError);
        $this->assertSame('Unit years have no configuration to get total from other units.', $yearsError);
    }

    public function testGetTotalsViaGettersWithFalseFactor()
    {
        $cascades = CarbonInterval::getCascadeFactors();
        CarbonInterval::setCascadeFactors(array(
            'minutes' => array(Carbon::SECONDS_PER_MINUTE, 'seconds'),
            'hours' => array(Carbon::MINUTES_PER_HOUR, 'minutes'),
            'days' => array(false, 'hours'), // soft break
            'months' => array(30, 'days'),
            'years' => array(Carbon::MONTHS_PER_YEAR, 'months'),
        ));
        $interval = CarbonInterval::create(3, 2, 0, 6, 150, 0, 0);
        $totalSeconds = $interval->totalSeconds;
        $totalMinutes = $interval->totalMinutes;
        $totalHours = $interval->totalHours;
        $totalDays = $interval->totalDays;
        $totalMonths = $interval->totalMonths;
        $totalYears = $interval->totalYears;
        CarbonInterval::setCascadeFactors($cascades);

        $this->assertSame(150 * 60 * 60, $totalSeconds);
        $this->assertSame(150 * 60, $totalMinutes);
        $this->assertSame(150, $totalHours);
        $this->assertSame(1146, $totalDays);
        $this->assertSame(1146 / 30, $totalMonths);
        $this->assertSame(1146 / 30 / 12, $totalYears);
    }
}
