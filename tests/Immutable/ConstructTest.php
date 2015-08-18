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

class ConstructTest extends TestFixture
{

    public function testCreatesAnInstanceDefaultToNow()
    {
        $c   = new CarbonImmutable();
        $now = CarbonImmutable::now();
        $this->assertInstanceOfCarbon($c);
        $this->assertSame($now->tzName, $c->tzName);
        $this->assertCarbon($c, $now->year, $now->month, $now->day, $now->hour, $now->minute, $now->second);
    }

    public function testParseCreatesAnInstanceDefaultToNow()
    {
        $c   = CarbonImmutable::parse();
        $now = CarbonImmutable::now();
        $this->assertInstanceOfCarbon($c);
        $this->assertSame($now->tzName, $c->tzName);
        $this->assertCarbon($c, $now->year, $now->month, $now->day, $now->hour, $now->minute, $now->second);
    }

    public function testWithFancyString()
    {
        $c = new CarbonImmutable('first day of January 2008');
        $this->assertCarbon($c, 2008, 1, 1, 0, 0, 0);
    }

    public function testParseWithFancyString()
    {
        $c = CarbonImmutable::parse('first day of January 2008');
        $this->assertCarbon($c, 2008, 1, 1, 0, 0, 0);
    }

    public function testDefaultTimezone()
    {
        $c = new CarbonImmutable('now');
        $this->assertSame('America/Toronto', $c->tzName);
    }

    public function testParseWithDefaultTimezone()
    {
        $c = CarbonImmutable::parse('now');
        $this->assertSame('America/Toronto', $c->tzName);
    }

    public function testSettingTimezone()
    {
        $timezone                 = 'Europe/London';
        $dtz                      = new \DateTimeZone($timezone);
        $dt                       = new \DateTime('now', $dtz);
        $dayLightSavingTimeOffset = $dt->format('I');

        $c = new CarbonImmutable('now', $dtz);
        $this->assertSame($timezone, $c->tzName);
        $this->assertSame(0 + $dayLightSavingTimeOffset, $c->offsetHours);
    }

    public function testParseSettingTimezone()
    {
        $timezone                 = 'Europe/London';
        $dtz                      = new \DateTimeZone($timezone);
        $dt                       = new \DateTime('now', $dtz);
        $dayLightSavingTimeOffset = $dt->format('I');

        $c = CarbonImmutable::parse('now', $dtz);
        $this->assertSame($timezone, $c->tzName);
        $this->assertSame(0 + $dayLightSavingTimeOffset, $c->offsetHours);
    }

    public function testSettingTimezoneWithString()
    {
        $timezone                 = 'Asia/Tokyo';
        $dtz                      = new \DateTimeZone($timezone);
        $dt                       = new \DateTime('now', $dtz);
        $dayLightSavingTimeOffset = $dt->format('I');

        $c = new CarbonImmutable('now', $timezone);
        $this->assertSame($timezone, $c->tzName);
        $this->assertSame(9 + $dayLightSavingTimeOffset, $c->offsetHours);
    }

    public function testParseSettingTimezoneWithString()
    {
        $timezone                 = 'Asia/Tokyo';
        $dtz                      = new \DateTimeZone($timezone);
        $dt                       = new \DateTime('now', $dtz);
        $dayLightSavingTimeOffset = $dt->format('I');

        $c = CarbonImmutable::parse('now', $timezone);
        $this->assertSame($timezone, $c->tzName);
        $this->assertSame(9 + $dayLightSavingTimeOffset, $c->offsetHours);
    }
}
