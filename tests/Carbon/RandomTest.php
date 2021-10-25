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

namespace Tests\Carbon;

use Carbon\Carbon;
use Tests\AbstractTestCase;

class RandomTest extends AbstractTestCase
{
    public function testRandomWithTimezone(): void
    {
        $carbon  = Carbon::random(Carbon::yesterday(), null, $tz = 'Europe/Berlin');

        $this->assertSame($tz, $carbon->timezoneName);
    }

    public function testRandomWithoutTimezone(): void
    {
        $carbon = Carbon::random(Carbon::yesterday());

        $this->assertSame('America/Toronto', $carbon->timezoneName);
    }

    public function testRandomGreaterThanAfter(): void
    {
        $carbon = Carbon::random($after = Carbon::yesterday());

        $this->assertTrue($carbon->between($after, Carbon::maxValue()));
    }

    public function testRandomLowerThanBefore(): void
    {
        $carbon = Carbon::random(null, $before = Carbon::tomorrow());

        $this->assertTrue($carbon->between(Carbon::minValue(), $before));
    }

    public function testRandomBetweenBeforeAndAfter(): void
    {
        $carbon = Carbon::random($after = Carbon::yesterday(), $before = Carbon::tomorrow());

        $this->assertTrue($carbon->between($before, $after));
    }
}
