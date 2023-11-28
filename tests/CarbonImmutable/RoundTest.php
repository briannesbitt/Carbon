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

namespace Tests\CarbonImmutable;

use Carbon\CarbonImmutable as Carbon;
use InvalidArgumentException;
use Tests\AbstractTestCase;

class RoundTest extends AbstractTestCase
{
    public function testRoundWithDefaultUnit()
    {
        $dt = Carbon::create(2315, 7, 18, 22, 42, 17.643971);
        $copy = $dt->copy();
        $ref = $copy->round();
        $this->assertNotEquals($ref, $copy);
        $this->assertNotSame($ref, $copy);
        $this->assertCarbon($ref, 2315, 7, 18, 22, 42, 18, 0);

        $this->assertCarbon($dt->copy()->round(5), 2315, 7, 18, 22, 42, 20, 0);
        $this->assertCarbon($dt->copy()->floor()->round(5), 2315, 7, 18, 22, 42, 15, 0);
        $this->assertCarbon($dt->copy()->round(3), 2315, 7, 18, 22, 42, 18, 0);
        $this->assertCarbon($dt->copy()->round(4), 2315, 7, 18, 22, 42, 16, 0);
        $this->assertCarbon($dt->copy()->round(10), 2315, 7, 18, 22, 42, 20, 0);
        $this->assertCarbon($dt->copy()->round(0.5), 2315, 7, 18, 22, 42, 17, 500000);
        $this->assertCarbon($dt->copy()->round(0.25), 2315, 7, 18, 22, 42, 17, 750000);
        $this->assertCarbon($dt->copy()->round(3.8), 2315, 7, 18, 22, 42, 19, 800000);

        $this->assertCarbon($dt->copy()->floor(5), 2315, 7, 18, 22, 42, 15, 0);
        $this->assertCarbon($dt->copy()->floor()->floor(5), 2315, 7, 18, 22, 42, 15, 0);
        $this->assertCarbon($dt->copy()->floor(3), 2315, 7, 18, 22, 42, 15, 0);
        $this->assertCarbon($dt->copy()->floor(4), 2315, 7, 18, 22, 42, 16, 0);
        $this->assertCarbon($dt->copy()->floor(10), 2315, 7, 18, 22, 42, 10, 0);
        $this->assertCarbon($dt->copy()->floor(0.5), 2315, 7, 18, 22, 42, 17, 500000);
        $this->assertCarbon($dt->copy()->floor(0.25), 2315, 7, 18, 22, 42, 17, 500000);
        $this->assertCarbon($dt->copy()->floor(3.8), 2315, 7, 18, 22, 42, 15, 0);

        $this->assertCarbon($dt->copy()->ceil(5), 2315, 7, 18, 22, 42, 20, 0);
        $this->assertCarbon($dt->copy()->floor()->ceil(5), 2315, 7, 18, 22, 42, 20, 0);
        $this->assertCarbon($dt->copy()->ceil(3), 2315, 7, 18, 22, 42, 18, 0);
        $this->assertCarbon($dt->copy()->ceil(4), 2315, 7, 18, 22, 42, 20, 0);
        $this->assertCarbon($dt->copy()->ceil(10), 2315, 7, 18, 22, 42, 20, 0);
        $this->assertCarbon($dt->copy()->ceil(0.5), 2315, 7, 18, 22, 42, 18, 0);
        $this->assertCarbon($dt->copy()->ceil(0.25), 2315, 7, 18, 22, 42, 17, 750000);
        $this->assertCarbon($dt->copy()->ceil(3.8), 2315, 7, 18, 22, 42, 19, 800000);
    }

    public function testRoundWithBaseUnit()
    {
        $dt = Carbon::create(2315, 7, 18, 22, 42, 17.643971);
        $copy = $dt->copy();
        $ref = $copy->roundSecond();
        $this->assertNotEquals($ref, $copy);
        $this->assertNotSame($ref, $copy);
        $this->assertCarbon($ref, 2315, 7, 18, 22, 42, 18, 0);

        $this->assertCarbon($dt->copy()->roundDay(), 2315, 7, 19, 0, 0, 0, 0);
        $this->assertCarbon($dt->copy()->roundDay(5), 2315, 7, 21, 0, 0, 0, 0);
        $this->assertCarbon($dt->copy()->ceilDay(), 2315, 7, 19, 0, 0, 0, 0);
        $this->assertCarbon($dt->copy()->floorDay(), 2315, 7, 18, 0, 0, 0, 0);

        $this->assertCarbon($dt->copy()->roundYear(), 2316, 1, 1, 0, 0, 0, 0);
        $this->assertCarbon($dt->copy()->subMonths(2)->roundYear(), 2315, 1, 1, 0, 0, 0, 0);
        $this->assertCarbon($dt->copy()->roundYear(2), 2315, 1, 1, 0, 0, 0, 0);
        $this->assertCarbon($dt->copy()->floorYear(2), 2315, 1, 1, 0, 0, 0, 0);
        $this->assertCarbon($dt->copy()->ceilYear(2), 2317, 1, 1, 0, 0, 0, 0);

        $this->assertCarbon($dt->copy()->roundMonth(), 2315, 8, 1, 0, 0, 0, 0);
        $this->assertCarbon($dt->copy()->floorMonth(), 2315, 7, 1, 0, 0, 0, 0);
    }

    public function testRoundWithMetaUnit()
    {
        $dt = Carbon::create(2315, 7, 18, 22, 42, 17.643971);
        $copy = $dt->copy();
        $ref = $copy->roundSecond();
        $this->assertNotEquals($ref, $copy);
        $this->assertNotSame($ref, $copy);
        $this->assertCarbon($ref, 2315, 7, 18, 22, 42, 18, 0);

        $this->assertCarbon($dt->copy()->roundMillisecond(), 2315, 7, 18, 22, 42, 17, 644000);
        $this->assertCarbon($dt->copy()->roundMillennium(), 2001, 1, 1, 0, 0, 0, 0);
        $this->assertCarbon($dt->copy()->roundQuarter(), 2315, 7, 1, 0, 0, 0, 0);
        $this->assertCarbon($dt->copy()->roundQuarters(2), 2315, 7, 1, 0, 0, 0, 0);
        $this->assertCarbon($dt->copy()->subMonth()->floorQuarter(), 2315, 4, 1, 0, 0, 0, 0);
        $this->assertCarbon($dt->copy()->subMonth()->floorQuarters(2), 2315, 1, 1, 0, 0, 0, 0);
    }

    public function testRoundWeek()
    {
        $dt = Carbon::create(2315, 7, 18, 22, 42, 17.643971);
        $copy = $dt->copy();
        $ref = $copy->roundSecond();
        $this->assertNotEquals($ref, $copy);
        $this->assertNotSame($ref, $copy);
        $this->assertCarbon($ref, 2315, 7, 18, 22, 42, 18, 0);

        $this->assertCarbon($dt->copy()->floorWeek(), 2315, 7, 12, 0, 0, 0, 0);
        $this->assertCarbon($dt->copy()->ceilWeek(), 2315, 7, 19, 0, 0, 0, 0);
        $this->assertCarbon($dt->copy()->roundWeek(), 2315, 7, 19, 0, 0, 0, 0);

        $dt = Carbon::create(2315, 7, 19, 0, 0, 0, 0);
        $this->assertCarbon($dt->copy()->floorWeek(), 2315, 7, 19, 0, 0, 0, 0);
        $this->assertCarbon($dt->copy()->ceilWeek(), 2315, 7, 19, 0, 0, 0, 0);
        $this->assertCarbon($dt->copy()->roundWeek(), 2315, 7, 19, 0, 0, 0, 0);
    }

    public function testCeilMonth()
    {
        $this->assertCarbon(Carbon::parse('2021-01-29')->ceilMonth(), 2021, 2, 1, 0, 0, 0);
        $this->assertCarbon(Carbon::parse('2021-01-31')->ceilMonth(), 2021, 2, 1, 0, 0, 0);
        $this->assertCarbon(Carbon::parse('2021-12-17')->ceilMonth(), 2022, 1, 1, 0, 0, 0);
    }

    public function testFloorMonth()
    {
        $this->assertCarbon(Carbon::parse('2021-05-31')->floorMonth(3), 2021, 4, 1, 0, 0, 0);
    }

    public function testRoundInvalidArgument()
    {
        $this->expectExceptionObject(new InvalidArgumentException(
            'Unknown unit \'foobar\'.',
        ));

        Carbon::now()->roundUnit('foobar');
    }
}
