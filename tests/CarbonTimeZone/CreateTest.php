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
use Carbon\Exceptions\InvalidTimeZoneException;
use DateTimeZone;
use Tests\AbstractTestCase;
use Tests\CarbonTimeZone\Fixtures\UnknownZone;

class CreateTest extends AbstractTestCase
{
    public function testCreate()
    {
        $tz = new CarbonTimeZone(6);

        $this->assertInstanceOf(CarbonTimeZone::class, $tz);
        $this->assertInstanceOf(DateTimeZone::class, $tz);
        $this->assertSame('+06:00', $tz->getName());

        $tz = CarbonTimeZone::create(6);

        $this->assertSame('+06:00', $tz->getName());

        $tz = CarbonTimeZone::create('+01');

        $this->assertSame('+01:00', $tz->getName());

        $tz = new CarbonTimeZone('+01');

        $this->assertSame('+01:00', $tz->getName());

        $tz = CarbonTimeZone::create('-01');

        $this->assertSame('-01:00', $tz->getName());

        $tz = new CarbonTimeZone('-01');

        $this->assertSame('-01:00', $tz->getName());
    }

    public function testInstance()
    {
        $tz = new CarbonTimeZone('UTC');

        $this->assertSame($tz, CarbonTimeZone::instance($tz));
    }

    public function testUnknown()
    {
        $tz = new UnknownZone('UTC');

        $this->assertSame('unknown', $tz->getAbbreviatedName());
    }

    public function testSafeCreateDateTimeZoneWithoutStrictMode()
    {
        $this->expectExceptionObject(new InvalidTimeZoneException(
            'Absolute timezone offset cannot be greater than 99.',
        ));

        new CarbonTimeZone(-15e15);
    }
}
