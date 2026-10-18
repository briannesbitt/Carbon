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

use Carbon\CarbonInterval;
use Carbon\Exceptions\InvalidIntervalException;
use Tests\AbstractTestCase;
use Time\Duration;

class ToDurationTest extends AbstractTestCase
{
    public function testConvertTimeOnlyIntervalToDuration()
    {
        $duration = CarbonInterval::hours(1)->minutes(1)->seconds(1)->toDuration();

        $this->assertSame(Duration::class, \get_class($duration));
        $this->assertSame(3661, $duration->seconds);
        $this->assertSame(0, $duration->nanoseconds);
        $this->assertFalse($duration->negative);
    }

    public function testConvertMicrosecondsToDurationNanoseconds()
    {
        $duration = CarbonInterval::seconds(1)->microseconds(500000)->toDuration();

        $this->assertSame(1, $duration->seconds);
        $this->assertSame(500000000, $duration->nanoseconds);
        $this->assertFalse($duration->negative);
    }

    public function testTruncateSubMicrosecondRemainder()
    {
        // CarbonInterval stores microseconds; nanosecond remainder is truncated.
        $duration = CarbonInterval::seconds(2)->microseconds(123456)->toDuration();

        $this->assertSame(2, $duration->seconds);
        $this->assertSame(123456000, $duration->nanoseconds);
    }

    public function testConvertNegativeIntervalToDuration()
    {
        $duration = CarbonInterval::seconds(-5)->toDuration();

        $this->assertTrue($duration->negative);
        $this->assertSame(5, $duration->seconds);
    }

    public function testConvertNegativeMillisecondsIntervalToDuration()
    {
        $duration = CarbonInterval::create(seconds: -5, microseconds: -300_000)->toDuration();

        $this->assertTrue($duration->negative);
        $this->assertSame(5, $duration->seconds);
        $this->assertSame(300_000_000, $duration->nanoseconds);

        $duration = CarbonInterval::create(seconds: -5, microseconds: 300_000)->toDuration();

        $this->assertTrue($duration->negative);
        $this->assertSame(4, $duration->seconds);
        $this->assertSame(700_000_000, $duration->nanoseconds);
    }

    public function testConvertInvertedIntervalToDuration()
    {
        $duration = CarbonInterval::minutes(3)->invert()->toDuration();

        $this->assertTrue($duration->negative);
        $this->assertSame(180, $duration->seconds);
    }

    public function testCastIntervalToDuration()
    {
        $duration = CarbonInterval::minutes(3)->invert()->cast(Duration::class);

        $this->assertTrue($duration->negative);
        $this->assertSame(180, $duration->seconds);
    }

    public function testConvertDateBearingIntervalToDurationThrows()
    {
        $this->expectException(InvalidIntervalException::class);

        CarbonInterval::days(1)->toDuration();
    }

    public function testConvertMonthsBearingIntervalToDurationThrows()
    {
        $this->expectException(InvalidIntervalException::class);

        CarbonInterval::months(2)->toDuration();
    }

    public function testMaximumMicrosedondsForConversion()
    {
        $this->expectException(InvalidIntervalException::class);

        CarbonInterval::create(seconds: -5, microseconds: 1_300_000)->toDuration();
    }

    public function testRoundtrip()
    {
        $interval = CarbonInterval::hours(25)->minutes(59)->seconds(59)->microseconds(999999);

        $this->assertTrue($interval->eq(CarbonInterval::fromDuration($interval->toDuration())));
    }
}
