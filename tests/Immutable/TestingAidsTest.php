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

class TestingAidsTest extends TestFixture
{

    public function testTestingAidsWithTestNowNotSet()
    {
        CarbonImmutable::setTestNow();

        $this->assertFalse(CarbonImmutable::hasTestNow());
        $this->assertNull(CarbonImmutable::getTestNow());
    }

    public function testTestingAidsWithTestNowSet()
    {
        $notNow = CarbonImmutable::yesterday();
        CarbonImmutable::setTestNow($notNow);

        $this->assertTrue(CarbonImmutable::hasTestNow());
        $this->assertSame($notNow, CarbonImmutable::getTestNow());
    }

    public function testConstructorWithTestValueSet()
    {
        $notNow = CarbonImmutable::yesterday();
        CarbonImmutable::setTestNow($notNow);

        $this->assertEquals($notNow, new CarbonImmutable());
        $this->assertEquals($notNow, new CarbonImmutable(null));
        $this->assertEquals($notNow, new CarbonImmutable(''));
        $this->assertEquals($notNow, new CarbonImmutable('now'));
    }

    public function testNowWithTestValueSet()
    {
        $notNow = CarbonImmutable::yesterday();
        CarbonImmutable::setTestNow($notNow);

        $this->assertEquals($notNow, CarbonImmutable::now());
    }

    public function testParseWithTestValueSet()
    {
        $notNow = CarbonImmutable::yesterday();
        CarbonImmutable::setTestNow($notNow);

        $this->assertEquals($notNow, CarbonImmutable::parse());
        $this->assertEquals($notNow, CarbonImmutable::parse(null));
        $this->assertEquals($notNow, CarbonImmutable::parse(''));
        $this->assertEquals($notNow, CarbonImmutable::parse('now'));
    }

    public function testParseRelativeWithTestValueSet()
    {
        $notNow = CarbonImmutable::parse('2013-09-01 05:15:05');
        CarbonImmutable::setTestNow($notNow);

        $this->assertSame('2013-09-01 05:10:05', CarbonImmutable::parse('5 minutes ago')->toDateTimeString());

        $this->assertSame('2013-08-25 05:15:05', CarbonImmutable::parse('1 week ago')->toDateTimeString());

        $this->assertSame('2013-09-02 00:00:00', CarbonImmutable::parse('tomorrow')->toDateTimeString());
        $this->assertSame('2013-08-31 00:00:00', CarbonImmutable::parse('yesterday')->toDateTimeString());

        $this->assertSame('2013-09-02 05:15:05', CarbonImmutable::parse('+1 day')->toDateTimeString());
        $this->assertSame('2013-08-31 05:15:05', CarbonImmutable::parse('-1 day')->toDateTimeString());

        $this->assertSame('2013-09-02 00:00:00', CarbonImmutable::parse('next monday')->toDateTimeString());
        $this->assertSame('2013-09-03 00:00:00', CarbonImmutable::parse('next tuesday')->toDateTimeString());
        $this->assertSame('2013-09-04 00:00:00', CarbonImmutable::parse('next wednesday')->toDateTimeString());
        $this->assertSame('2013-09-05 00:00:00', CarbonImmutable::parse('next thursday')->toDateTimeString());
        $this->assertSame('2013-09-06 00:00:00', CarbonImmutable::parse('next friday')->toDateTimeString());
        $this->assertSame('2013-09-07 00:00:00', CarbonImmutable::parse('next saturday')->toDateTimeString());
        $this->assertSame('2013-09-08 00:00:00', CarbonImmutable::parse('next sunday')->toDateTimeString());

        $this->assertSame('2013-08-26 00:00:00', CarbonImmutable::parse('last monday')->toDateTimeString());
        $this->assertSame('2013-08-27 00:00:00', CarbonImmutable::parse('last tuesday')->toDateTimeString());
        $this->assertSame('2013-08-28 00:00:00', CarbonImmutable::parse('last wednesday')->toDateTimeString());
        $this->assertSame('2013-08-29 00:00:00', CarbonImmutable::parse('last thursday')->toDateTimeString());
        $this->assertSame('2013-08-30 00:00:00', CarbonImmutable::parse('last friday')->toDateTimeString());
        $this->assertSame('2013-08-31 00:00:00', CarbonImmutable::parse('last saturday')->toDateTimeString());
        $this->assertSame('2013-08-25 00:00:00', CarbonImmutable::parse('last sunday')->toDateTimeString());

        $this->assertSame('2013-09-02 00:00:00', CarbonImmutable::parse('this monday')->toDateTimeString());
        $this->assertSame('2013-09-03 00:00:00', CarbonImmutable::parse('this tuesday')->toDateTimeString());
        $this->assertSame('2013-09-04 00:00:00', CarbonImmutable::parse('this wednesday')->toDateTimeString());
        $this->assertSame('2013-09-05 00:00:00', CarbonImmutable::parse('this thursday')->toDateTimeString());
        $this->assertSame('2013-09-06 00:00:00', CarbonImmutable::parse('this friday')->toDateTimeString());
        $this->assertSame('2013-09-07 00:00:00', CarbonImmutable::parse('this saturday')->toDateTimeString());
        $this->assertSame('2013-09-01 00:00:00', CarbonImmutable::parse('this sunday')->toDateTimeString());

        $this->assertSame('2013-10-01 05:15:05', CarbonImmutable::parse('first day of next month')->toDateTimeString());
        $this->assertSame('2013-09-30 05:15:05', CarbonImmutable::parse('last day of this month')->toDateTimeString());
    }

    public function testParseRelativeWithMinusSignsInDate()
    {
        $notNow = CarbonImmutable::parse('2013-09-01 05:15:05');
        CarbonImmutable::setTestNow($notNow);

        $this->assertSame('2000-01-03 00:00:00', CarbonImmutable::parse('2000-1-3')->toDateTimeString());
        $this->assertSame('2000-10-10 00:00:00', CarbonImmutable::parse('2000-10-10')->toDateTimeString());
    }

    public function testTimeZoneWithTestValueSet()
    {
        $notNow = CarbonImmutable::parse('2013-07-01 12:00:00', 'America/New_York');
        CarbonImmutable::setTestNow($notNow);

        $this->assertSame('2013-07-01T12:00:00-0400', CarbonImmutable::parse('now')->toIso8601String());
        $this->assertSame('2013-07-01T11:00:00-0500', CarbonImmutable::parse('now', 'America/Mexico_City')->toIso8601String());
        $this->assertSame('2013-07-01T09:00:00-0700', CarbonImmutable::parse('now', 'America/Vancouver')->toIso8601String());
    }
}
