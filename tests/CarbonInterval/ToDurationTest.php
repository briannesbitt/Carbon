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
    protected function setUp(): void
    {
        if (!class_exists(Duration::class)) {
            $this->markTestSkipped('Requires PHP 8.6 native Time\Duration class.');
        }

        parent::setUp();
    }

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

    public function testConvertInvertedIntervalToDuration()
    {
        $duration = CarbonInterval::minutes(3)->invert()->toDuration();

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

    public function testCreateIntervalFromDuration()
    {
        $interval = CarbonInterval::fromDuration(Duration::fromSeconds(3661, 500000000));

        $this->assertSame(CarbonInterval::class, \get_class($interval));
        $this->assertSame(1, $interval->hours);
        $this->assertSame(1, $interval->minutes);
        $this->assertSame(1, $interval->seconds);
        $this->assertEquals(500000, $interval->microseconds);
        $this->assertSame(0, $interval->invert);
        $this->assertSame('PT1H1M1S', $interval->spec());
    }

    public function testCreateIntervalFromNegativeDuration()
    {
        $interval = CarbonInterval::fromDuration(Duration::fromSeconds(5)->negate());

        $this->assertSame(-5000000.0, $interval->totalMicroseconds);
        $this->assertSame(0, $interval->invert);
    }

    public function testCreateIntervalFromSubMicrosecondDuration()
    {
        // Nanoseconds below microsecond precision are truncated.
        $interval = CarbonInterval::fromDuration(Duration::fromSeconds(1, 500999999));

        $this->assertSame(1, $interval->seconds);
        $this->assertEquals(500999, $interval->microseconds);
    }

    public function testRoundtrip()
    {
        $interval = CarbonInterval::hours(25)->minutes(59)->seconds(59)->microseconds(999999);

        $this->assertTrue($interval->eq(CarbonInterval::fromDuration($interval->toDuration())));
    }
}
