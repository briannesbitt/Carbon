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


use Carbon\CarbonInterval;
use Carbon\Exceptions\InvalidIntervalException;
use Tests\AbstractTestCase;
use Time\Duration;

class FromDurationTest extends AbstractTestCase
{
    public function testCreateIntervalFromDuration()
    {
        $interval = CarbonInterval::fromDuration(Duration::fromSeconds(3661, 500_000_000));

        $this->assertSame(CarbonInterval::class, \get_class($interval));
        $this->assertSame(1, $interval->hours);
        $this->assertSame(1, $interval->minutes);
        $this->assertSame(1, $interval->seconds);
        $this->assertSame(500000, $interval->microseconds);
        $this->assertSame(0, $interval->invert);
        $this->assertSame('PT1H1M1S', $interval->spec());
    }

    public function testCreateIntervalFromNegativeDuration()
    {
        $interval = CarbonInterval::fromDuration(Duration::fromSeconds(5)->negate());

        $this->assertSame(5, $interval->seconds);
        $this->assertSame(-5000000.0, $interval->totalMicroseconds);
        $this->assertSame(1, $interval->invert);
    }

    public function testCreateIntervalFromSubMicrosecondDuration()
    {
        // Nanoseconds below microsecond precision are truncated.
        $interval = CarbonInterval::fromDuration(Duration::fromSeconds(1, 500_999_999));

        $this->assertSame(1, $interval->seconds);
        $this->assertSame(500999, $interval->microseconds);
    }

    public function testCreateIntervalFromMinimum()
    {
        $interval = CarbonInterval::fromDuration(Duration::fromSeconds(9_223_372_035, 999_999_999)->negate());

        $this->assertSame(-9_223_372_035.999999, $interval->totalSeconds);
        $this->assertSame(2_562_047, $interval->hours);
        $this->assertSame(47, $interval->minutes);
        $this->assertSame(15, $interval->seconds);
        $this->assertSame(999_999, $interval->microseconds);
        $this->assertSame(1, $interval->invert);
    }

    public function testCreateIntervalFromZero()
    {
        // Nanoseconds below microsecond precision are truncated.
        $interval = CarbonInterval::fromDuration(Duration::fromSeconds(0));

        $this->assertSame(0, $interval->seconds);
        $this->assertSame(0, $interval->microseconds);
        $this->assertSame(0, $interval->invert);
    }

    public function testCreateIntervalFromMaximum()
    {
        $interval = CarbonInterval::fromDuration(Duration::fromSeconds(9_223_372_035, 999_999_999));

        $this->assertSame(9_223_372_035.999999, $interval->totalSeconds);
        $this->assertSame(2_562_047, $interval->hours);
        $this->assertSame(47, $interval->minutes);
        $this->assertSame(15, $interval->seconds);
        $this->assertSame(999_999, $interval->microseconds);
        $this->assertSame(0, $interval->invert);
    }

    public function testRoundtrip()
    {
        $interval = CarbonInterval::hours(25)->minutes(59)->seconds(59)->microseconds(999_999);

        $this->assertTrue($interval->eq(CarbonInterval::fromDuration($interval->toDuration())));
    }
}
