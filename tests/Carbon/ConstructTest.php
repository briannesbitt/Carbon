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
use Carbon\Exceptions\InvalidTimeZoneException;
use DateTime;
use DateTimeInterface;
use DateTimeZone;
use SubCarbon;
use Tests\AbstractTestCase;

class ConstructTest extends AbstractTestCase
{
    public function testCreatesAnInstanceDefaultToNow()
    {
        $c = new Carbon();
        $now = Carbon::now();
        $this->assertInstanceOfCarbon($c);
        $this->assertInstanceOf(DateTime::class, $c);
        $this->assertInstanceOf(DateTimeInterface::class, $c);
        $this->assertSame($now->tzName, $c->tzName);
        $this->assertCarbon($c, $now->year, $now->month, $now->day, $now->hour, $now->minute, $now->second);
    }

    public function testCreatesAnInstanceFromADateTime()
    {
        $c = new Carbon(Carbon::parse('2009-09-09 09:09:09'));

        $this->assertSame('2009-09-09 09:09:09 America/Toronto', $c->format('Y-m-d H:i:s e'));

        $c = new Carbon(new DateTime('2009-09-09 09:09:09'));

        $this->assertSame('2009-09-09 09:09:09 America/Toronto', $c->format('Y-m-d H:i:s e'));

        $c = new Carbon(new DateTime('2009-09-09 09:09:09', new DateTimeZone('Europe/Paris')));

        $this->assertSame('2009-09-09 09:09:09 Europe/Paris', $c->format('Y-m-d H:i:s e'));

        $c = new Carbon(new DateTime('2009-09-09 09:09:09'), 'Europe/Paris');

        $this->assertSame('2009-09-09 15:09:09 Europe/Paris', $c->format('Y-m-d H:i:s e'));

        $c = new Carbon(new DateTime('2009-09-09 09:09:09', new DateTimeZone('Asia/Tokyo')), 'Europe/Paris');

        $this->assertSame('2009-09-09 02:09:09 Europe/Paris', $c->format('Y-m-d H:i:s e'));
    }

    public function testCreatesAnInstanceFromADateTimeException()
    {
        $this->expectException(InvalidTimeZoneException::class);

        Carbon::useStrictMode(false);

        new Carbon(
            new DateTime('2009-09-09 09:09:09', new DateTimeZone('Asia/Tokyo')),
            '¤¤ Incorrect Timezone ¤¤',
        );
    }

    public function testParseCreatesAnInstanceDefaultToNow()
    {
        $c = Carbon::parse('');
        $now = Carbon::now();
        $this->assertInstanceOfCarbon($c);
        $this->assertSame($now->tzName, $c->tzName);
        $this->assertCarbon($c, $now->year, $now->month, $now->day, $now->hour, $now->minute, $now->second);
    }

    public function testWithFancyString()
    {
        Carbon::setTestNowAndTimezone(Carbon::today());
        $c = new Carbon('first day of January 2008');
        $this->assertCarbon($c, 2008, 1, 1, 0, 0, 0);
    }

    public function testParseWithFancyString()
    {
        Carbon::setTestNowAndTimezone(Carbon::today());
        $c = Carbon::parse('first day of January 2008');
        $this->assertCarbon($c, 2008, 1, 1, 0, 0, 0);
    }

    public function testParseWithYYYMMDD()
    {
        $c = Carbon::parse('20201128');
        $this->assertCarbon($c, 2020, 11, 28, 0, 0, 0);
    }

    public function testParseWithYYYMMDDHHMMSS()
    {
        $c = Carbon::parse('20201128192533');
        $this->assertCarbon($c, 2020, 11, 28, 19, 25, 33);
    }

    public function testDefaultTimezone()
    {
        $c = new Carbon('now');
        $this->assertSame('America/Toronto', $c->tzName);
    }

    public function testParseWithDefaultTimezone()
    {
        $c = Carbon::parse('now');
        $this->assertSame('America/Toronto', $c->tzName);
    }

    public function testSettingTimezone()
    {
        $timezone = 'Europe/London';
        $dtz = new DateTimeZone($timezone);
        $dt = new DateTime('now', $dtz);
        $dayLightSavingTimeOffset = (int) $dt->format('I');

        $c = new Carbon('now', $dtz);
        $this->assertSame($timezone, $c->tzName);
        $this->assertSame($dayLightSavingTimeOffset, $c->offsetHours);
    }

    public function testParseSettingTimezone()
    {
        $timezone = 'Europe/London';
        $dtz = new DateTimeZone($timezone);
        $dt = new DateTime('now', $dtz);
        $dayLightSavingTimeOffset = (int) $dt->format('I');

        $c = Carbon::parse('now', $dtz);
        $this->assertSame($timezone, $c->tzName);
        $this->assertSame($dayLightSavingTimeOffset, $c->offsetHours);
    }

    public function testSettingTimezoneWithString()
    {
        $timezone = 'Asia/Tokyo';
        $dtz = new DateTimeZone($timezone);
        $dt = new DateTime('now', $dtz);
        $dayLightSavingTimeOffset = (int) $dt->format('I');

        $c = new Carbon('now', $timezone);
        $this->assertSame($timezone, $c->tzName);
        $this->assertSame(9 + $dayLightSavingTimeOffset, $c->offsetHours);
    }

    public function testParseSettingTimezoneWithString()
    {
        $timezone = 'Asia/Tokyo';
        $dtz = new DateTimeZone($timezone);
        $dt = new DateTime('now', $dtz);
        $dayLightSavingTimeOffset = (int) $dt->format('I');

        $c = Carbon::parse('now', $timezone);
        $this->assertSame($timezone, $c->tzName);
        $this->assertSame(9 + $dayLightSavingTimeOffset, $c->offsetHours);
    }

    public function testSettingTimezoneWithInteger()
    {
        Carbon::useStrictMode(false);
        $timezone = 5;
        $c = new Carbon('2019-02-12 23:00:00', $timezone);
        $this->assertSame('+05:00', $c->tzName);
    }

    public function testMockingWithMicroseconds()
    {
        $c = new Carbon(Carbon::now()->toDateTimeString().'.123456');
        Carbon::setTestNow($c);

        $mockedC = Carbon::now();
        $this->assertTrue($c->eq($mockedC));

        Carbon::setTestNow();
    }

    public function testTimestamp()
    {
        $date = new Carbon(1367186296);
        $this->assertSame('Sunday 28 April 2013 21:58:16.000000', $date->format('l j F Y H:i:s.u'));

        $date = new Carbon(123);
        $this->assertSame('Thursday 1 January 1970 00:02:03.000000', $date->format('l j F Y H:i:s.u'));
    }

    public function testFloatTimestamp()
    {
        $date = new Carbon(1367186296.654321);
        $this->assertSame('Sunday 28 April 2013 21:58:16.654321', $date->format('l j F Y H:i:s.u'));

        $date = new Carbon(123.5);
        $this->assertSame('Thursday 1 January 1970 00:02:03.500000', $date->format('l j F Y H:i:s.u'));
    }

    public function testDifferentType()
    {
        require_once __DIR__.'/../Fixtures/SubCarbon.php';

        $subCarbon = new SubCarbon('2024-01-24 00:00');
        $carbon = new Carbon('2024-01-24 00:00');
        $this->assertTrue($subCarbon->equalTo($carbon));
        $this->assertTrue($carbon->equalTo($subCarbon));
    }
}
