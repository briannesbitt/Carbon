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
use DateTimeZone;
use Tests\AbstractTestCase;

class CreateFromTimeStringTest extends AbstractTestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Carbon::setTestNow();
    }

    public function testCreateFromTimeString()
    {
        $d = Carbon::createFromTimeString('22:45');
        $this->assertSame(22, $d->hour);
        $this->assertSame(45, $d->minute);
        $this->assertSame(0, $d->second);
        $this->assertSame(0, $d->micro);
    }

    public function testCreateFromTimeStringWithSecond()
    {
        $d = Carbon::createFromTimeString('22:45:12');
        $this->assertSame(22, $d->hour);
        $this->assertSame(45, $d->minute);
        $this->assertSame(12, $d->second);
        $this->assertSame(0, $d->micro);
    }

    public function testCreateFromTimeStringWithMicroSecond()
    {
        $d = Carbon::createFromTimeString('22:45:00.625341');
        $this->assertSame(22, $d->hour);
        $this->assertSame(45, $d->minute);
        $this->assertSame(0, $d->second);
        $this->assertSame(625341, $d->micro);
    }

    public function testCreateFromTimeStringWithDateTimeZone()
    {
        $d = Carbon::createFromTimeString('12:20:30', new DateTimeZone('Europe/London'));
        $this->assertCarbonTime($d, 12, 20, 30, 0);
        $this->assertSame('Europe/London', $d->tzName);
    }

    public function testCreateFromTimeStringWithTimeZoneString()
    {
        $d = Carbon::createFromTimeString('12:20:30', 'Europe/London');
        $this->assertCarbonTime($d, 12, 20, 30, 0);
        $this->assertSame('Europe/London', $d->tzName);
    }
}
