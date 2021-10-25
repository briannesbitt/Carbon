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

use Carbon\CarbonImmutable;
use Tests\AbstractTestCase;

class RandomTest extends AbstractTestCase
{
    public function testRandomWithTimezone(): void
    {
        $carbon = CarbonImmutable::random(CarbonImmutable::yesterday(), null, $tz= 'Europe/Berlin');

        $this->assertSame($tz, $carbon->timezoneName);
    }

    public function testRandomWithoutTimezone(): void
    {
        $carbon = CarbonImmutable::random(CarbonImmutable::yesterday());

        $this->assertSame('America/Toronto', $carbon->timezoneName);
    }

    public function testRandomGreaterThanAfter(): void
    {
        $carbon = CarbonImmutable::random($after = CarbonImmutable::yesterday());

        $this->assertTrue($carbon->between($after, CarbonImmutable::maxValue()));
    }

    public function testRandomLowerThanBefore(): void
    {
        $carbon = CarbonImmutable::random(null, $before = CarbonImmutable::tomorrow());

        $this->assertTrue($carbon->between(CarbonImmutable::minValue(), $before));
    }

    public function testRandomBetweenBeforeAndAfter(): void
    {
        $carbon = CarbonImmutable::random($after = CarbonImmutable::yesterday(), $before = CarbonImmutable::tomorrow());

        $this->assertTrue($carbon->between($before, $after));
    }
}
