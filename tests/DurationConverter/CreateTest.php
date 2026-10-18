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

namespace Tests\DurationConverter;

use Carbon\DurationConverter;
use DateInterval;
use Tests\AbstractTestCase;
use Time\Duration;

class CreateTest extends AbstractTestCase
{
    public function testCreate(): void
    {
        $duration = Duration::fromSeconds(mt_rand(99, 999_999_999), mt_rand(0, 999_999_999));
        $copy = DurationConverter::createDurationFromInterval($duration);

        $this->assertNotSame($duration, $copy);
        $this->assertEquals($duration, $copy);

        $interval = new DateInterval('PT2H30M23S');
        $interval->f = 0.567_123;
        $duration = DurationConverter::createDurationFromInterval($interval);
        $this->assertSame(9_023, $duration->seconds);
        $this->assertSame(567_123_000, $duration->nanoseconds);
        $this->assertFalse($duration->negative);

        $interval->invert = 1;
        $duration = DurationConverter::createDurationFromInterval($interval);
        $this->assertSame(9_023, $duration->seconds);
        $this->assertSame(567_123_000, $duration->nanoseconds);
        $this->assertTrue($duration->negative);
    }
}
