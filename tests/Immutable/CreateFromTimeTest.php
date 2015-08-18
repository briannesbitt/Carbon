<?php

/*
 * This file is part of the Carbon package.
 *
 * (c) Brian Nesbitt <brian@nesbot.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Immutable;

use Carbon\CarbonImmutable;
use TestFixture;

class CreateFromTimeTest extends TestFixture
{

    public function testCreateFromDateWithDefaults()
    {
        $d = CarbonImmutable::createFromTime();
        $this->assertSame($d->timestamp, CarbonImmutable::create(null, null, null, null, null, null)->timestamp);
    }

    public function testCreateFromDate()
    {
        $d = CarbonImmutable::createFromTime(23, 5, 21);
        $this->assertCarbon($d, CarbonImmutable::now()->year, CarbonImmutable::now()->month, CarbonImmutable::now()->day, 23, 5, 21);
    }

    public function testCreateFromTimeWithHour()
    {
        $d = CarbonImmutable::createFromTime(22);
        $this->assertSame(22, $d->hour);
        $this->assertSame(0, $d->minute);
        $this->assertSame(0, $d->second);
    }

    public function testCreateFromTimeWithMinute()
    {
        $d = CarbonImmutable::createFromTime(null, 5);
        $this->assertSame(5, $d->minute);
    }

    public function testCreateFromTimeWithSecond()
    {
        $d = CarbonImmutable::createFromTime(null, null, 21);
        $this->assertSame(21, $d->second);
    }

    public function testCreateFromTimeWithDateTimeZone()
    {
        $d = CarbonImmutable::createFromTime(12, 0, 0, new \DateTimeZone('Europe/London'));
        $this->assertCarbon($d, CarbonImmutable::now()->year, CarbonImmutable::now()->month, CarbonImmutable::now()->day, 12, 0, 0);
        $this->assertSame('Europe/London', $d->tzName);
    }

    public function testCreateFromTimeWithTimeZoneString()
    {
        $d = CarbonImmutable::createFromTime(12, 0, 0, 'Europe/London');
        $this->assertCarbon($d, CarbonImmutable::now()->year, CarbonImmutable::now()->month, CarbonImmutable::now()->day, 12, 0, 0);
        $this->assertSame('Europe/London', $d->tzName);
    }
}
