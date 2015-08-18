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

class CreateFromDateTest extends TestFixture
{

    public function testCreateFromDateWithDefaults()
    {
        $d = CarbonImmutable::createFromDate();
        $this->assertSame($d->timestamp, CarbonImmutable::create(null, null, null, null, null, null)->timestamp);
    }

    public function testCreateFromDate()
    {
        $d = CarbonImmutable::createFromDate(1975, 5, 21);
        $this->assertCarbon($d, 1975, 5, 21);
    }

    public function testCreateFromDateWithYear()
    {
        $d = CarbonImmutable::createFromDate(1975);
        $this->assertSame(1975, $d->year);
    }

    public function testCreateFromDateWithMonth()
    {
        $d = CarbonImmutable::createFromDate(null, 5);
        $this->assertSame(5, $d->month);
    }

    public function testCreateFromDateWithDay()
    {
        $d = CarbonImmutable::createFromDate(null, null, 21);
        $this->assertSame(21, $d->day);
    }

    public function testCreateFromDateWithTimezone()
    {
        $d = CarbonImmutable::createFromDate(1975, 5, 21, 'Europe/London');
        $this->assertCarbon($d, 1975, 5, 21);
        $this->assertSame('Europe/London', $d->tzName);
    }

    public function testCreateFromDateWithDateTimeZone()
    {
        $d = CarbonImmutable::createFromDate(1975, 5, 21, new \DateTimeZone('Europe/London'));
        $this->assertCarbon($d, 1975, 5, 21);
        $this->assertSame('Europe/London', $d->tzName);
    }
}
