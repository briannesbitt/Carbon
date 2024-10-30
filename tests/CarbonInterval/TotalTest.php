<?php

declare(strict_types=1);

/**
 * This file is part of the Carbon package.
 *
 * (c) Brian Nesbitt <brian@nesbot.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tests\CarbonInterval;

use Carbon\Carbon;
use Carbon\CarbonInterval;
use DateTimeImmutable;
use Generator;
use InvalidArgumentException;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\AbstractTestCase;

class TotalTest extends AbstractTestCase
{
    #[DataProvider('dataForIntervalSpecs')]
    public function testReturnsTotalValue($spec, $unit, $expected)
    {
        $this->assertSame(
            (float) $expected,
            CarbonInterval::fromString($spec)->total($unit),
            "$spec as $unit did not get the expected total",
        );
    }

    public static function dataForIntervalSpecs(): Generator
    {
        yield ['10s',                'seconds', 10];
        yield ['100s',               'seconds', 100];
        yield ['2d 4h 17m 35s',      'seconds', ((2 * 24 + 4) * 60 + 17) * 60 + 35];
        yield ['1y',                 'Seconds', 12 * 4 * 7 * 24 * 60 * 60];
        yield ['1000y',              'SECONDS', 1000 * 12 * 4 * 7 * 24 * 60 * 60];
        yield ['235s',               'minutes', 235 / 60];
        yield ['3h 14m 235s',        'minutes', 3 * 60 + 14 + 235 / 60];
        yield ['27h 150m 4960s',     'hours',   27 + (150 + 4960 / 60) / 60];
        yield ['1w',                 'days',    7];
        yield ['2w 15d',             'weeks',   29 / 7];
        yield ['5mo 54d 185h 7680m', 'days',    5 * 4 * 7 + 54 + (185 + 7680 / 60) / 24];
        yield ['4y 2mo',             'days',    (4 * 12 + 2) * 4 * 7];
        yield ['165d',               'weeks',   165 / 7];
        yield ['5mo',                'weeks',   5 * 4];
        yield ['6897d',              'months',  6897 / 7 / 4];
        yield ['35mo',               'years',   35 / 12];
    }

    public function testThrowsExceptionForInvalidUnits()
    {
        $this->expectExceptionObject(new InvalidArgumentException(
            'Unknown unit \'foo\'.',
        ));

        CarbonInterval::create()->total('foo');
    }

    public function testGetTotalsViaGetters()
    {
        $interval = CarbonInterval::create(0, 0, 0, 0, 150, 0, 0);

        $this->assertSame(150.0 * 60 * 60 * 1000 * 1000, $interval->totalMicroseconds);
        $this->assertSame(150.0 * 60 * 60 * 1000, $interval->totalMilliseconds);
        $this->assertSame(150.0 * 60 * 60, $interval->totalSeconds);
        $this->assertSame(150.0 * 60, $interval->totalMinutes);
        $this->assertSame(150.0, $interval->totalHours);
        $this->assertSame(150.0 / 24, $interval->totalDays);
        $this->assertSame(150.0 / 24 / 7, $interval->totalWeeks);
        $this->assertSame(150.0 / 24 / 7 / 4, $interval->totalMonths);
        $this->assertSame(150.0 / 24 / 7 / 4 / 12, $interval->totalYears);

        $interval = CarbonInterval::milliseconds(12312);

        $this->assertSame(12312000.0, $interval->totalMicroseconds);
        $this->assertSame(12312.0, $interval->totalMilliseconds);

        $interval = CarbonInterval::milliseconds(-12312);

        $this->assertSame(-12312000.0, $interval->totalMicroseconds);
        $this->assertSame(-12312.0, $interval->totalMilliseconds);
    }

    public static function dataForNegativeIntervals(): Generator
    {
        yield [-1, CarbonInterval::hours(0)->hours(-150)];
        yield [-1, CarbonInterval::hours(150)->invert()];
        yield [1, CarbonInterval::hours(0)->hours(-150)->invert()];
    }

    #[DataProvider('dataForNegativeIntervals')]
    public function testGetNegativeTotalsViaGetters($factor, $interval)
    {
        $this->assertSame($factor * 150.0 * 60 * 60 * 1000 * 1000, $interval->totalMicroseconds);
        $this->assertSame($factor * 150.0 * 60 * 60 * 1000, $interval->totalMilliseconds);
        $this->assertSame($factor * 150.0 * 60 * 60, $interval->totalSeconds);
        $this->assertSame($factor * 150.0 * 60, $interval->totalMinutes);
        $this->assertSame($factor * 150.0, $interval->totalHours);
        $this->assertSame($factor * 150.0 / 24, $interval->totalDays);
        $this->assertSame($factor * 150.0 / 24 / 7, $interval->totalWeeks);
        $this->assertSame($factor * 150.0 / 24 / 7 / 4, $interval->totalMonths);
        $this->assertSame($factor * 150.0 / 24 / 7 / 4 / 12, $interval->totalYears);
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

        $this->assertSame(1.0, CarbonInterval::make('1d')->totalDays);
        $this->assertSame(5.0, CarbonInterval::make('1w')->totalDays);
        $this->assertSame(1.0, CarbonInterval::make('1w')->totalWeeks);

        CarbonInterval::setCascadeFactors($factors);
    }

    public function testFloatHoursFactors()
    {
        $factors = CarbonInterval::getCascadeFactors();
        CarbonInterval::setCascadeFactors([
            'minute' => [60, 'seconds'],
            'hour' => [60, 'minutes'],
            'day' => [7.5, 'hours'],
            'week' => [5, 'days'],
        ]);

        $this->assertSame(
            '2 weeks 1 day 5 hours 45 minutes',
            CarbonInterval::minutes(11 * (7.5 * 60) + (5 * 60) + 45)->cascade()->forHumans()
        );

        CarbonInterval::setCascadeFactors($factors);
    }

    public function testFloatDaysFactors()
    {
        $factors = CarbonInterval::getCascadeFactors();
        CarbonInterval::setCascadeFactors([
            'minute' => [60, 'seconds'],
            'hour' => [60, 'minutes'],
            'day' => [8, 'hours'],
            'week' => [5.5, 'days'],
        ]);

        $this->assertSame(
            '3 weeks 1 day 5 hours 45 minutes',
            CarbonInterval::minutes(17.5 * (8 * 60) + (5 * 60) + 45)->cascade()->forHumans()
        );

        CarbonInterval::setCascadeFactors($factors);
    }

    public function testFloatInMultipleFactors()
    {
        $factors = CarbonInterval::getCascadeFactors();
        CarbonInterval::setCascadeFactors([
            'minute' => [23.2, 'seconds'],
            'hour' => [25.662, 'minutes'],
            'day' => [10 / 3, 'hours'],
            'week' => [pi(), 'days'],
        ]);

        $interval = CarbonInterval::minutes(50000)->cascade();

        $this->assertSame(
            '185 weeks 2 days 3 hours 35 minutes 35 seconds',
            $interval->forHumans()
        );
        // Show how we (approximately) get back to initial values
        $this->assertEqualsWithDelta(
            50000 * 23.2,
            35 + (35 * 23.2) + (3 * 25.662 * 23.2) + (2 * (10 / 3) * 25.662 * 23.2) + (185 * pi() * (10 / 3) * 25.662 * 23.2),
            3
        );
        // Show how total uncascade
        $this->assertEqualsWithDelta(50000 / 25.662, $interval->totalHours, 0.05);
        $this->assertEqualsWithDelta(50000, $interval->totalMinutes, 0.1);
        $this->assertEqualsWithDelta(50000 * 23.2, $interval->totalSeconds, 1);

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
        } catch (InvalidArgumentException $exception) {
            $monthsError = $exception->getMessage();
        }

        $yearsError = null;

        try {
            $interval->totalYears;
        } catch (InvalidArgumentException $exception) {
            $yearsError = $exception->getMessage();
        }

        CarbonInterval::setCascadeFactors($cascades);

        $this->assertSame(150.0 * 60 * 60, $totalSeconds);
        $this->assertSame(150.0 * 60, $totalMinutes);
        $this->assertSame(150.0, $totalHours);
        $this->assertSame(150.0 / 8, $totalDays);
        $this->assertSame(150.0 / 8 / 5, $totalWeeks);
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

        $this->assertSame(150.0 * 60 * 60, $totalSeconds);
        $this->assertSame(150.0 * 60, $totalMinutes);
        $this->assertSame(150.0, $totalHours);
        $this->assertSame(1146.0, $totalDays);
        $this->assertSame(1146.0 / 30, $totalMonths);
        $this->assertSame(1146.0 / 30 / 12, $totalYears);
    }

    public function testMicrosecondsInterval()
    {
        $interval = CarbonInterval::milliseconds(500);

        $this->assertSame(0.5, $interval->totalSeconds);
        $this->assertSame(1 / 2 / 60, $interval->totalMinutes);
        $this->assertSame(1 / 2 / 3600, $interval->totalHours);

        $interval = CarbonInterval::milliseconds(600000)->cascade();

        $this->assertSame(600000000.0, $interval->totalMicroseconds);
        $this->assertSame(600000.0, $interval->totalMilliseconds);
        $this->assertSame(600.0, $interval->totalSeconds);
        $this->assertSame(10.0, $interval->totalMinutes);
        $this->assertSame(1 / 6, $interval->totalHours);
    }

    public function testWithDiffInterval()
    {
        $this->assertSame(51.0, Carbon::parse('2020-08-10')->diff('2020-09-30')->totalDays);
    }

    public function testAlterationAfterDiff()
    {
        $t1 = Carbon::now();
        $t2 = $t1->copy()->addMinutes(2);

        $p = $t1->diffAsCarbonInterval($t2);
        $p->addSeconds(10);

        $this->assertSame(130.0, $p->totalSeconds);
    }

    public function testAbsoluteDiff()
    {
        Carbon::setTestNowAndTimezone(new DateTimeImmutable('now UTC'));

        $diff = Carbon::now()->addDays(15)->diff('now');

        $this->assertSame(-1296000000000.0, $diff->totalMicroseconds);
        $this->assertTrue($diff->lte(CarbonInterval::minutes(30)));

        $diff = Carbon::now()->addDays(15)->diff('now', true);

        $this->assertSame(1296000000000.0, $diff->totalMicroseconds);
        $this->assertFalse($diff->lte(CarbonInterval::minutes(30)));
    }
}
