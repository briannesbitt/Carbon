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

use Carbon\CarbonImmutable as Carbon;
use Carbon\Exceptions\InvalidFormatException;
use DateTimeZone;
use Tests\AbstractTestCase;

class CreateFromTimeTest extends AbstractTestCase
{
    public function testCreateWithTestNow()
    {
        Carbon::setTestNow($testNow = Carbon::create(2011, 1, 1, 12, 13, 14));
        $dt = Carbon::create(null, null, null, null, null, null);

        $this->assertCarbon($dt, 2011, 1, 1, 12, 13, 14);
        $this->assertTrue($testNow->eq($dt));
    }

    public function testCreateFromDateWithDefaults()
    {
        $d = Carbon::createFromTime();
        $this->assertSame($d->timestamp, Carbon::create(null, null, null, 0, 0, 0)->timestamp);
    }

    public function testCreateFromDateWithNull()
    {
        $d = Carbon::createFromTime(null, null, null);
        $this->assertSame($d->timestamp, Carbon::create(null, null, null, null, null, null)->timestamp);
    }

    public function testCreateFromDate()
    {
        $d = Carbon::createFromTime(23, 5, 21);
        $this->assertCarbon($d, Carbon::now()->year, Carbon::now()->month, Carbon::now()->day, 23, 5, 21);
    }

    public function testCreateFromTimeWithHour()
    {
        $d = Carbon::createFromTime(22);
        $this->assertSame(22, $d->hour);
        $this->assertSame(0, $d->minute);
        $this->assertSame(0, $d->second);
    }

    public function testCreateFromTimeWithMinute()
    {
        $d = Carbon::createFromTime(null, 5);
        $this->assertSame(5, $d->minute);
    }

    public function testCreateFromTimeWithSecond()
    {
        $d = Carbon::createFromTime(null, null, 21);
        $this->assertSame(21, $d->second);
    }

    public function testCreateFromTimeWithDateTimeZone()
    {
        $d = Carbon::createFromTime(12, 0, 0, new DateTimeZone('Europe/London'));
        $this->assertCarbon($d, Carbon::now('Europe/London')->year, Carbon::now('Europe/London')->month, Carbon::now('Europe/London')->day, 12, 0, 0);
        $this->assertSame('Europe/London', $d->tzName);
    }

    public function testCreateFromTimeWithTimeZoneString()
    {
        $d = Carbon::createFromTime(12, 0, 0, 'Europe/London');
        $this->assertCarbon($d, Carbon::now('Europe/London')->year, Carbon::now('Europe/London')->month, Carbon::now('Europe/London')->day, 12, 0, 0);
        $this->assertSame('Europe/London', $d->tzName);
    }

    public function testCreateFromTime()
    {
        // disable test for now
        // because we need Carbon::now() in Carbon::create() to work with given TZ
        $test = Carbon::getTestNow();
        Carbon::setTestNow();

        $tz = 'Etc/GMT+12';

        try {
            $now = Carbon::now($tz);
        } catch (InvalidFormatException $exception) {
            if ($exception->getMessage() !== 'Unknown or bad timezone (Etc/GMT+12)') {
                throw $exception;
            }

            $tz = 'GMT+12';
            $now = Carbon::now($tz);
        }

        $dt = Carbon::createFromTime($now->hour, $now->minute, $now->second, $tz);

        // re-enable test
        Carbon::setTestNow($test);

        // tested without microseconds
        // because they appear within calls to Carbon
        $this->assertSame($now->format('c'), $dt->format('c'));
    }
}
