<?php

/*
 * This file is part of the Carbon package.
 *
 * (c) Brian Nesbitt <brian@nesbot.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tests\Carbon;

use Carbon\Carbon;
use Tests\AbstractTestCase;

class TestingAidsTest extends AbstractTestCase
{
    public function testTestingAidsWithTestNowNotSet()
    {
        Carbon::setTestNow();

        $this->assertFalse(Carbon::hasTestNow());
        $this->assertNull(Carbon::getTestNow());
    }

    public function testTestingAidsWithTestNowSet()
    {
        Carbon::setTestNow($yesterday = Carbon::yesterday());

        $this->assertTrue(Carbon::hasTestNow());
        $this->assertSame($yesterday, Carbon::getTestNow());
    }

    public function testTestingAidsWithTestNowSetToString()
    {
        Carbon::setTestNow('2016-11-23');
        $this->assertTrue(Carbon::hasTestNow());
        $this->assertEquals(Carbon::getTestNow(), Carbon::parse('2016-11-23'));
    }

    public function testConstructorWithTestValueSet()
    {
        Carbon::setTestNow($yesterday = Carbon::yesterday());

        $this->assertEquals($yesterday, new Carbon());
        $this->assertEquals($yesterday, new Carbon(null));
        $this->assertEquals($yesterday, new Carbon(''));
        $this->assertEquals($yesterday, new Carbon('now'));
    }

    public function testNowWithTestValueSet()
    {
        Carbon::setTestNow($yesterday = Carbon::yesterday());

        $this->assertEquals($yesterday, Carbon::now());
    }

    public function testParseWithTestValueSet()
    {
        $testNow = Carbon::yesterday();

        $scope = $this;
        $this->wrapWithTestNow(function () use ($scope, $testNow) {
            $scope->assertEquals($testNow, Carbon::parse());
            $scope->assertEquals($testNow, Carbon::parse(null));
            $scope->assertEquals($testNow, Carbon::parse(''));
            $scope->assertEquals($testNow, Carbon::parse('now'));
        }, $testNow);
    }

    public function testParseRelativeWithTestValueSet()
    {
        $testNow = Carbon::parse('2013-09-01 05:15:05');

        $scope = $this;
        $this->wrapWithTestNow(function () use ($scope) {
            $scope->assertSame('2013-09-01 05:10:05', Carbon::parse('5 minutes ago')->toDateTimeString());
            $scope->assertSame('2013-08-25 05:15:05', Carbon::parse('1 week ago')->toDateTimeString());

            $scope->assertSame('2013-09-02 00:00:00', Carbon::parse('tomorrow')->toDateTimeString());
            $scope->assertSame('2013-09-01 00:00:00', Carbon::parse('today')->toDateTimeString());
            $scope->assertSame('2013-08-31 00:00:00', Carbon::parse('yesterday')->toDateTimeString());

            $scope->assertSame('2013-09-02 05:15:05', Carbon::parse('+1 day')->toDateTimeString());
            $scope->assertSame('2013-08-31 05:15:05', Carbon::parse('-1 day')->toDateTimeString());

            $scope->assertSame('2013-09-02 00:00:00', Carbon::parse('next monday')->toDateTimeString());
            $scope->assertSame('2013-09-03 00:00:00', Carbon::parse('next tuesday')->toDateTimeString());
            $scope->assertSame('2013-09-04 00:00:00', Carbon::parse('next wednesday')->toDateTimeString());
            $scope->assertSame('2013-09-05 00:00:00', Carbon::parse('next thursday')->toDateTimeString());
            $scope->assertSame('2013-09-06 00:00:00', Carbon::parse('next friday')->toDateTimeString());
            $scope->assertSame('2013-09-07 00:00:00', Carbon::parse('next saturday')->toDateTimeString());
            $scope->assertSame('2013-09-08 00:00:00', Carbon::parse('next sunday')->toDateTimeString());

            $scope->assertSame('2013-08-26 00:00:00', Carbon::parse('last monday')->toDateTimeString());
            $scope->assertSame('2013-08-27 00:00:00', Carbon::parse('last tuesday')->toDateTimeString());
            $scope->assertSame('2013-08-28 00:00:00', Carbon::parse('last wednesday')->toDateTimeString());
            $scope->assertSame('2013-08-29 00:00:00', Carbon::parse('last thursday')->toDateTimeString());
            $scope->assertSame('2013-08-30 00:00:00', Carbon::parse('last friday')->toDateTimeString());
            $scope->assertSame('2013-08-31 00:00:00', Carbon::parse('last saturday')->toDateTimeString());
            $scope->assertSame('2013-08-25 00:00:00', Carbon::parse('last sunday')->toDateTimeString());

            $scope->assertSame('2013-09-02 00:00:00', Carbon::parse('this monday')->toDateTimeString());
            $scope->assertSame('2013-09-03 00:00:00', Carbon::parse('this tuesday')->toDateTimeString());
            $scope->assertSame('2013-09-04 00:00:00', Carbon::parse('this wednesday')->toDateTimeString());
            $scope->assertSame('2013-09-05 00:00:00', Carbon::parse('this thursday')->toDateTimeString());
            $scope->assertSame('2013-09-06 00:00:00', Carbon::parse('this friday')->toDateTimeString());
            $scope->assertSame('2013-09-07 00:00:00', Carbon::parse('this saturday')->toDateTimeString());
            $scope->assertSame('2013-09-01 00:00:00', Carbon::parse('this sunday')->toDateTimeString());

            $scope->assertSame('2013-10-01 05:15:05', Carbon::parse('first day of next month')->toDateTimeString());
            $scope->assertSame('2013-09-30 05:15:05', Carbon::parse('last day of this month')->toDateTimeString());
        }, $testNow);
    }

    public function testHasRelativeKeywords()
    {
        $this->assertFalse(Carbon::hasRelativeKeywords('sunday 2015-02-23'));
        $this->assertTrue(Carbon::hasRelativeKeywords('today +2014 days'));
        $this->assertTrue(Carbon::hasRelativeKeywords('next sunday -3600 seconds'));
        $this->assertTrue(Carbon::hasRelativeKeywords('last day of this month'));
        $this->assertFalse(Carbon::hasRelativeKeywords('last day of december 2015'));
        $this->assertTrue(Carbon::hasRelativeKeywords('first sunday of next month'));
        $this->assertFalse(Carbon::hasRelativeKeywords('first sunday of January 2017'));
    }

    public function testParseRelativeWithMinusSignsInDate()
    {
        $testNow = Carbon::parse('2013-09-01 05:15:05');

        $scope = $this;
        $this->wrapWithTestNow(function () use ($scope) {
            $scope->assertSame('2000-01-03 00:00:00', Carbon::parse('2000-1-3')->toDateTimeString());
            $scope->assertSame('2000-10-10 00:00:00', Carbon::parse('2000-10-10')->toDateTimeString());
        }, $testNow);

        $scope->assertSame('2000-01-03 00:00:00', Carbon::parse('2000-1-3')->toDateTimeString());
        $scope->assertSame('2000-10-10 00:00:00', Carbon::parse('2000-10-10')->toDateTimeString());
    }

    public function testTimeZoneWithTestValueSet()
    {
        $testNow = Carbon::parse('2013-07-01 12:00:00', 'America/New_York');

        $scope = $this;
        $this->wrapWithTestNow(function () use ($scope) {
            $scope->assertSame('2013-07-01T12:00:00-04:00', Carbon::parse('now')->toIso8601String());
            $scope->assertSame('2013-07-01T11:00:00-05:00', Carbon::parse('now', 'America/Mexico_City')->toIso8601String());
            $scope->assertSame('2013-07-01T09:00:00-07:00', Carbon::parse('now', 'America/Vancouver')->toIso8601String());
        }, $testNow);
    }

    public function testCreateFromPartialFormat()
    {
        Carbon::setTestNow($now = Carbon::parse('2013-09-01 05:10:15', 'America/Vancouver'));

        // Simple partial time.
        $this->assertSame('2018-05-06T05:10:15-07:00', Carbon::createFromFormat('Y-m-d', '2018-05-06')->toIso8601String());
        $this->assertSame('2013-09-01T10:20:30-07:00', Carbon::createFromFormat('H:i:s', '10:20:30')->toIso8601String());

        // Custom timezone.
        $this->assertSame('2013-09-01T10:20:15+03:00', Carbon::createFromFormat('H:i e', '10:20 Europe/Kiev')->toIso8601String());
        $this->assertSame('2013-09-01T10:20:15+01:00', Carbon::createFromFormat('H:i', '10:20', 'Europe/London')->toIso8601String());
        $this->assertSame('2013-09-01T11:30:00+07:00', Carbon::createFromFormat('H:i:s e', '11:30:00+07:00')->toIso8601String());
        $this->assertSame('2013-09-01T11:30:00+05:00', Carbon::createFromFormat('H:i:s', '11:30:00', '+05:00')->toIso8601String());

        // Escaped timezone.
        $this->assertSame('2013-09-01T05:10:15-07:00', Carbon::createFromFormat('\e', 'e')->toIso8601String());

        // Weird format, naive modify would fail here.
        $this->assertSame('2005-08-09T05:10:15-07:00', Carbon::createFromFormat('l jS \of F Y', 'Tuesday 9th of August 2005')->toIso8601String());
        $this->assertSame('2013-09-01T05:12:13-07:00', Carbon::createFromFormat('i:s', '12:13')->toIso8601String());
        $this->assertSame('2018-09-05T05:10:15-07:00', Carbon::createFromFormat('Y/d', '2018/5')->toIso8601String());

        // Resetting to epoch.
        $this->assertSame('2018-05-06T00:00:00-07:00', Carbon::createFromFormat('!Y-m-d', '2018-05-06')->toIso8601String());
        $this->assertSame('1970-01-01T10:20:30-08:00', Carbon::createFromFormat('Y-m-d! H:i:s', '2018-05-06 10:20:30')->toIso8601String());
        $this->assertSame('2018-05-06T00:00:00-07:00', Carbon::createFromFormat('Y-m-d|', '2018-05-06')->toIso8601String());
        $this->assertSame('1970-01-01T10:20:30-08:00', Carbon::createFromFormat('|H:i:s', '10:20:30')->toIso8601String());

        // Resetting to epoch (timezone fun).
        $this->assertSame('1970-01-01T00:00:00-08:00', Carbon::createFromFormat('|', '')->toIso8601String());
        $this->assertSame('1970-01-01T00:00:00+03:00', Carbon::createFromFormat('e|', 'Europe/Kiev')->toIso8601String());
        $this->assertSame('1970-01-01T00:00:00+01:00', Carbon::createFromFormat('|', '', 'Europe/London')->toIso8601String());
        $this->assertSame('1970-01-01T00:00:00-08:00', Carbon::createFromFormat('!', '')->toIso8601String());
        $this->assertSame('1970-01-01T00:00:00+03:00', Carbon::createFromFormat('!e', 'Europe/Kiev')->toIso8601String());
        $this->assertSame('1970-01-01T00:00:00+01:00', Carbon::createFromFormat('!', '', 'Europe/London')->toIso8601String());
        $this->assertSame('1970-01-01T00:00:00-08:00', Carbon::createFromFormat('e!', 'Europe/Kiev')->toIso8601String());

        // Escaped epoch resets.
        $this->assertSame('2013-09-01T05:10:15-07:00', Carbon::createFromFormat('\|', '|')->toIso8601String());
        $this->assertSame('2013-09-01T05:10:15-07:00', Carbon::createFromFormat('\!', '!')->toIso8601String());
        $this->assertSame('2013-09-01T05:10:15+03:00', Carbon::createFromFormat('e \!', 'Europe/Kiev !')->toIso8601String());
    }

    public function testCreateFromPartialFormatWithMicroseconds()
    {
        Carbon::setTestNow($now = Carbon::parse('2013-09-01 05:10:15.123456', 'America/Vancouver'));

        $this->assertSame('2018-05-06 05:10:15.123456', Carbon::createFromFormat('Y-m-d', '2018-05-06')->format('Y-m-d H:i:s.u'));
        $this->assertSame('2013-09-01 10:20:30.654321', Carbon::createFromFormat('H:i:s.u', '10:20:30.654321')->format('Y-m-d H:i:s.u'));
    }
}
