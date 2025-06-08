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

        $this->assertSame('BST', $tz->getAbbr(true));
        $this->assertSame('GMT', $tz->getAbbr(false));
    }

    public function testGetAbbreviatedName(): void
    {
        $tz = new CarbonTimeZone('Europe/London');

        $this->assertSame('BST', $tz->getAbbreviatedName(true));
        $this->assertSame('GMT', $tz->getAbbreviatedName(false));

        $tz = CarbonTimeZone::create('Europe/Athens');

        $this->assertSame('EEST', $tz->getAbbreviatedName(true));
        $this->assertSame('EET', $tz->getAbbreviatedName(false));

        $tz = CarbonTimeZone::create('Pacific/Auckland');

        $this->assertSame('NZST', $tz->getAbbreviatedName(true));
        $this->assertSame('NZMT', $tz->getAbbreviatedName(false));

        $tz = CarbonTimeZone::create('America/Toronto');

        $this->assertSame('EDT', $tz->getAbbreviatedName(true));
        $this->assertSame('EST', $tz->getAbbreviatedName(false));

        $tz = CarbonTimeZone::create('Arctic/Longyearbyen');

        $this->assertSame('CEST', $tz->getAbbreviatedName(true));
        $this->assertSame('CET', $tz->getAbbreviatedName(false));

        $tz = CarbonTimeZone::create('Atlantic/Faroe');

        $this->assertSame('WEST', $tz->getAbbreviatedName(true));
        $this->assertSame('WET', $tz->getAbbreviatedName(false));

        $tz = CarbonTimeZone::create('Africa/Ceuta');

        $this->assertSame('CEST', $tz->getAbbreviatedName(true));
        $this->assertSame('CET', $tz->getAbbreviatedName(false));

        $tz = CarbonTimeZone::create('Canada/Yukon');

        $this->assertSame('PDT', $tz->getAbbreviatedName(true));
        $this->assertSame('PST', $tz->getAbbreviatedName(false));

        $tz = CarbonTimeZone::create('Asia/Pontianak');

        $this->assertSame('unknown', $tz->getAbbreviatedName(true));
        $this->assertSame('WIB', $tz->getAbbreviatedName(false));
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
