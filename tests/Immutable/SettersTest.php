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
use InvalidArgumentException;
use TestFixture;

class SettersTest extends TestFixture
{

    public function testMagicSetter()
    {
        $this->setExpectedException('LogicException');
        $d       = CarbonImmutable::now();
        $d->year = 1995;
    }

    public function testTimeSetter()
    {
        $d = CarbonImmutable::now();
        $d = $d->setTime(1, 1, 1);
        $this->assertSame(1, $d->second);
        $d = $d->setTime(1, 1);
        $this->assertSame(0, $d->second);
    }

    public function testTimeSetterWithChaining()
    {
        $d = CarbonImmutable::now();
        $d = $d->setTime(2, 2, 2)->setTime(1, 1, 1);
        $this->assertInstanceOf('Carbon\CarbonImmutable', $d);
        $this->assertSame(1, $d->second);
        $d = $d->setTime(2, 2, 2)->setTime(1, 1);
        $this->assertInstanceOf('Carbon\CarbonImmutable', $d);
        $this->assertSame(0, $d->second);
    }

    public function testTimeSetterWithZero()
    {
        $d = CarbonImmutable::now();
        $d = $d->setTime(1, 1);
        $this->assertSame(0, $d->second);
    }

    public function testDateTimeSetter()
    {
        $d = CarbonImmutable::now();
        $d = $d->setDateTime($d->year, $d->month, $d->day, 1, 1, 1);
        $this->assertSame(1, $d->second);
    }

    public function testDateTimeSetterWithZero()
    {
        $d = CarbonImmutable::now();
        $d = $d->setDateTime($d->year, $d->month, $d->day, 1, 1);
        $this->assertSame(0, $d->second);
    }

    public function testDateTimeSetterWithChaining()
    {
        $d = CarbonImmutable::now();
        $d = $d->setDateTime(2013, 9, 24, 17, 4, 29);
        $this->assertInstanceOf('Carbon\CarbonImmutable', $d);
        $d = $d->setDateTime(2014, 10, 25, 18, 5, 30);
        $this->assertInstanceOf('Carbon\CarbonImmutable', $d);
        $this->assertCarbonImmutable($d, 2014, 10, 25, 18, 5, 30);
    }

    public function testTimestampSetter()
    {
        $d            = CarbonImmutable::now();
        $d = $d->setTimestamp(11);
        $this->assertSame(11, $d->timestamp);
    }

    public function testSetTimezoneWithInvalidTimezone()
    {
        $this->setExpectedException('InvalidArgumentException');
        $d = CarbonImmutable::now();
        $d->setTimezone('sdf');
    }

    public function testTimezoneWithInvalidTimezone()
    {
        $d = CarbonImmutable::now();

        try {
            $d->timezone('sdf');
            $this->fail('InvalidArgumentException was not been raised.');
        } catch (InvalidArgumentException $expected) {
        }
    }

    public function testTzWithInvalidTimezone()
    {
        $d = CarbonImmutable::now();

        try {
            $d->tz('sdf');
            $this->fail('InvalidArgumentException was not been raised.');
        } catch (InvalidArgumentException $expected) {
        }
    }

    public function testSetTimezoneUsingString()
    {
        $d = CarbonImmutable::now();
        $d = $d = $d->setTimezone('America/Toronto');
        $this->assertSame('America/Toronto', $d->tzName);
    }

    public function testTimezoneUsingString()
    {
        $d = CarbonImmutable::now();
        $d = $d->timezone('America/Vancouver');
        $this->assertSame('America/Vancouver', $d->tzName);
    }

    public function testTzUsingString()
    {
        $d = CarbonImmutable::now();
        $d = $d->tz('America/Vancouver');
        $this->assertSame('America/Vancouver', $d->tzName);
    }

    public function testSetTimezoneUsingDateTimeZone()
    {
        $d = CarbonImmutable::now();
        $d = $d->setTimezone(new \DateTimeZone('America/Toronto'));
        $this->assertSame('America/Toronto', $d->tzName);
    }

    public function testTimezoneUsingDateTimeZone()
    {
        $d = CarbonImmutable::now();
        $d = $d->timezone(new \DateTimeZone('America/Vancouver'));
        $this->assertSame('America/Vancouver', $d->tzName);
    }

    public function testTzUsingDateTimeZone()
    {
        $d = CarbonImmutable::now();
        $d = $d->tz(new \DateTimeZone('America/Vancouver'));
        $this->assertSame('America/Vancouver', $d->tzName);
    }

    public function testInvalidSetter()
    {
        $this->setExpectedException('LogicException');
        $d = CarbonImmutable::now();
        $d->doesNotExit = 'bb';
    }
}
