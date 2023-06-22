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
use DateInterval;
use DateTime;
use InvalidArgumentException;
use Tests\AbstractTestCase;

class ToDateIntervalTest extends AbstractTestCase
{
    public function testConvertToDateInterval()
    {
        $interval = CarbonInterval::days(5)->hours(3)->minutes(50)->microseconds(123456)->invert()->toDateInterval();

        $this->assertSame(DateInterval::class, \get_class($interval));

        $this->assertSame(1, $interval->invert);
        $this->assertSame(5, $interval->d);
        $this->assertSame(3, $interval->h);
        $this->assertSame(50, $interval->i);
        $this->assertSame(0, $interval->s);
        $this->assertSame(0.123456, $interval->f);
    }

    public function testCastToDateInterval()
    {
        $interval = CarbonInterval::days(5)->hours(3)->minutes(50)->microseconds(123456)->invert()->cast(DateInterval::class);

        $this->assertSame(DateInterval::class, \get_class($interval));

        $this->assertSame(1, $interval->invert);
        $this->assertSame(5, $interval->d);
        $this->assertSame(3, $interval->h);
        $this->assertSame(50, $interval->i);
        $this->assertSame(0, $interval->s);
        $this->assertSame(0.123456, $interval->f);
    }

    public function testBadCast()
    {
        $this->expectExceptionObject(new InvalidArgumentException(
            'DateTime is not a sub-class of DateInterval.',
        ));

        CarbonInterval::days(5)->hours(3)->minutes(50)->microseconds(123456)->invert()->cast(DateTime::class);
    }
}
