<?php
declare(strict_types=1);

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
            $expected,
            CarbonInterval::fromString($spec)->total($unit),
            "$spec as $unit did not get the expected total"
        );
    }

    public function provideIntervalSpecs()
    {
        return [
            ['10s',                'seconds', 10],
            ['100s',               'seconds', 100],
            ['2d 4h 17m 35s',      'seconds', ((2 * 24 + 4) * 60 + 17) * 60 + 35],
            ['1y',                 'Seconds', 12 * 4 * 7 * 24 * 60 * 60],
            ['1000y',              'SECONDS', 1000 * 12 * 4 * 7 * 24 * 60 * 60],
            ['235s',               'minutes', 235 / 60],
            ['3h 14m 235s',        'minutes', 3 * 60 + 14 + 235 / 60],
            ['27h 150m 4960s',     'hours',   27 + (150 + 4960 / 60) / 60],
            ['1w',                 'days',    7],
            ['2w 15d',             'weeks',   29 / 7],
            ['5mo 54d 185h 7680m', 'days',    5 * 4 * 7 + 54 + (185 + 7680 / 60) / 24],
            ['4y 2mo',             'days',    (4 * 12 + 2) * 4 * 7],
            ['165d',               'weeks',   165 / 7],
            ['5mo',                'weeks',   5 * 4],
            ['6897d',              'months',  6897 / 7 / 4],
            ['35mo',               'years',   35 / 12],
        ];
    }

    public function testThrowsExceptionForInvalidUnits()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage(
            'Unknown unit \'foo\'.'
        );

        CarbonInterval::create()->total('foo');
    }

    public function testGetTotalsViaGetters()
    {
        $interval = CarbonInterval::create(0, 0, 0, 0, 150, 0, 0);

        $this->assertSame(150 * 60 * 60 * 1000 * 1000, $interval->totalMicroseconds);
        $this->assertSame(150 * 60 * 60 * 1000, $interval->totalMilliseconds);
        $this->assertSame(150 * 60 * 60, $interval->totalSeconds);
        $this->assertSame(150 * 60, $interval->totalMinutes);
        $this->assertSame(150, $interval->totalHours);
        $this->assertSame(150 / 24, $interval->totalDays);
        $this->assertSame(150 / 24 / 7, $interval->totalWeeks);
        $this->assertSame(150 / 24 / 7 / 4, $interval->totalMonths);
        $this->assertSame(150 / 24 / 7 / 4 / 12, $interval->totalYears);

        $interval = CarbonInterval::milliseconds(12312);

        $this->assertSame(12312000, $interval->totalMicroseconds);
        $this->assertSame(12312, $interval->totalMilliseconds);

        $interval = CarbonInterval::milliseconds(-12312);

        $this->assertSame(-12312000, $interval->totalMicroseconds);
        $this->assertSame(-12312, $interval->totalMilliseconds);
    }

    public function getNegativeIntervals()
    {
        return [
            [-1, CarbonInterval::hours(0)->hours(-150)],
            [-1, CarbonInterval::hours(150)->invert()],
            [1, CarbonInterval::hours(0)->hours(-150)->invert()],
        ];
    }

    /**
     * @dataProvider getNegativeIntervals
     */
    public function testGetNegativeTotalsViaGetters($factor, $interval)
    {
        $this->assertSame($factor * 150 * 60 * 60 * 1000 * 1000, $interval->totalMicroseconds);
        $this->assertSame($factor * 150 * 60 * 60 * 1000, $interval->totalMilliseconds);
        $this->assertSame($factor * 150 * 60 * 60, $interval->totalSeconds);
        $this->assertSame($factor * 150 * 60, $interval->totalMinutes);
        $this->assertSame($factor * 150, $interval->totalHours);
        $this->assertSame($factor * 150 / 24, $interval->totalDays);
        $this->assertSame($factor * 150 / 24 / 7, $interval->totalWeeks);
        $this->assertSame($factor * 150 / 24 / 7 / 4, $interval->totalMonths);
        $this->assertSame($factor * 150 / 24 / 7 / 4 / 12, $interval->totalYears);
    }

    public function testTotalsWithCustomFactors()
    {
        $factors = CarbonInterval::getCascadeFactors();
        CarbonInterval::setCascadeFactors([
            'minute' => [60, 'seconds'],
            'hour' => [60, 'minutes'],
            'day' => [8, 'hours'],
            'week' => [5, 'days'],
        ]);

        $this->assertSame(1, CarbonInterval::make('1d')->totalDays);
        $this->assertSame(5, CarbonInterval::make('1w')->totalDays);
        $this->assertSame(1, CarbonInterval::make('1w')->totalWeeks);

        CarbonInterval::setCascadeFactors($factors);
    }

    public function testGetTotalsViaGettersWithCustomFactors()
    {
        $cascades = CarbonInterval::getCascadeFactors();
        CarbonInterval::setCascadeFactors([
            'minutes' => [Carbon::SECONDS_PER_MINUTE, 'seconds'],
            'hours' => [Carbon::MINUTES_PER_HOUR, 'minutes'],
            'days' => [8, 'hours'],
            'weeks' => [5, 'days'],
        ]);
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
        CarbonInterval::setCascadeFactors([
            'minutes' => [Carbon::SECONDS_PER_MINUTE, 'seconds'],
            'hours' => [Carbon::MINUTES_PER_HOUR, 'minutes'],
            'days' => [false, 'hours'], // soft break
            'months' => [30, 'days'],
            'years' => [Carbon::MONTHS_PER_YEAR, 'months'],
        ]);
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

    public function testMicrosecondsInterval()
    {
        $interval = CarbonInterval::milliseconds(500);

        $this->assertSame(0.5, $interval->totalSeconds);
        $this->assertSame(1 / 2 / 60, $interval->totalMinutes);
        $this->assertSame(1 / 2 / 3600, $interval->totalHours);

        $interval = CarbonInterval::milliseconds(600000)->cascade();

        $this->assertSame(600000000, $interval->totalMicroseconds);
        $this->assertSame(600000, $interval->totalMilliseconds);
        $this->assertSame(600, $interval->totalSeconds);
        $this->assertSame(10, $interval->totalMinutes);
        $this->assertSame(1 / 6, $interval->totalHours);
    }
}
