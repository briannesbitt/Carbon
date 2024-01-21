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

namespace Tests\CarbonTimeZone;

use Carbon\CarbonTimeZone;
use Carbon\FactoryImmutable;
use DateTimeImmutable;
use Tests\AbstractTestCase;

class GettersTest extends AbstractTestCase
{
    public function testGetAbbr(): void
    {
        $tz = new CarbonTimeZone('Europe/London');

        $this->assertSame('bdst', $tz->getAbbr(true));
        $this->assertSame('bst', $tz->getAbbr(false));
    }

    public function testGetAbbreviatedName(): void
    {
        $tz = new CarbonTimeZone('Europe/London');

        $this->assertSame('bdst', $tz->getAbbreviatedName(true));
        $this->assertSame('bst', $tz->getAbbreviatedName(false));
    }

    public function testToRegionName(): void
    {
        $summer = new DateTimeImmutable('2024-08-19 12:00 UTC');
        $tz = new CarbonTimeZone('Europe/London');

        $this->assertSame('Europe/London', $tz->toRegionName($summer));

        $tz = new CarbonTimeZone('+05:00');

        $this->assertSame('Antarctica/Mawson', $tz->toRegionName($summer));

        $tz = new CarbonTimeZone('+05:00');

        $this->assertSame('Antarctica/Mawson', $tz->toRegionName($summer));

        $factory = new FactoryImmutable();
        $factory->setTestNowAndTimezone('2024-01-19 12:00 UTC');

        $this->assertSame('-06:00', $factory->now('America/Chicago')->getTimezone()->toOffsetName());

        // The 2 assertions below are the current behavior
        // but it's questionable, as current time is in winter, -6 should give Chicago
        // @TODO Check this deeper
        $this->assertSame('America/Chicago', $factory->now('-05:00')->getTimezone()->toRegionName());
        $this->assertSame('America/Denver', $factory->now('-06:00')->getTimezone()->toRegionName());

        $factory->setTestNowAndTimezone('2024-08-19 12:00 UTC');

        $this->assertSame('-05:00', $factory->now('America/Chicago')->getTimezone()->toOffsetName());
        $this->assertSame('America/Chicago', $factory->now('-05:00')->getTimezone()->toRegionName());
    }
}
