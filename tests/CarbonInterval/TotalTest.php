<?php

namespace Tests\CarbonInterval;

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

    public function provideIntervalSpecs() {
        return array(
            array('10s',                'seconds', 10),
            array('100s',               'seconds', 100),
            array('2d 4h 17m 35s',      'seconds', ((2 * 24 + 4) * 60 + 17) * 60 + 35),
            array('1y',                 'Seconds', 12 * 30 * 24 * 60 * 60),
            array('1000y',              'SECONDS', 1000 * 12 * 30 * 24 * 60 * 60),
            array('235s',               'minutes', 235 / 60),
            array('3h 14m 235s',        'minutes', 3 * 60 + 14 + 235 / 60),
            array('27h 150m 4960s',     'hours',   27 + (150 + 4960 / 60) / 60),
            array('5mo 54d 185h 7680m', 'days',    5 * 30 + 54 + (185 + 7680 / 60) / 24),
            array('4y 2mo',             'days',    (4 * 12 + 2) * 30),
            array('165d',               'weeks',   165 / 7),
            array('5mo',                'weeks',   5 * 30 / 7),
            array('6897d',              'months',  6897/30),
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

        $this->assertSame(150 * 60 * 60,      $interval->totalSeconds);
        $this->assertSame(150 * 60,           $interval->totalMinutes);
        $this->assertSame(150,                $interval->totalHours);
        $this->assertSame(150 / 24,           $interval->totalDays);
        $this->assertSame(150 / 24 / 7,       $interval->totalWeeks);
        $this->assertSame(150 / 24 / 30,      $interval->totalMonths);
        $this->assertSame(150 / 24 / 30 / 12, $interval->totalYears);
    }
}
