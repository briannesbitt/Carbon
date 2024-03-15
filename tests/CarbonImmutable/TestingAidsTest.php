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
use Carbon\CarbonInterface;
use Closure;
use DateTime;
use DateTimeZone;
use Exception;
use stdClass;
use Tests\AbstractTestCase;

class TestingAidsTest extends AbstractTestCase
{
    public function wrapWithTestNow(Closure $func, ?CarbonInterface $dt = null): void
    {
        Carbon::setTestNow($dt ?: Carbon::now());
        $func();
        Carbon::setTestNow();
    }

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
        $this->assertSame($yesterday->format('Y-m-d H:i:s.u e'), Carbon::getTestNow()->format('Y-m-d H:i:s.u e'));
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

    public function testNowWithDateTime()
    {
        Carbon::setTestNow(new DateTime('2021-05-26 08:41:59'));

        $this->assertSame('2021-05-26 08:41:59', Carbon::now()->format('Y-m-d H:i:s'));
    }

    public function testNowWithClosureValue()
    {
        $mockedNow = Carbon::parse('2019-09-21 12:34:56.123456');
        $delta = 0;

        Carbon::setTestNow(function (Carbon $now) use (&$mockedNow, &$delta) {
            $this->assertInstanceOfCarbon($now);

            return $mockedNow->copy()->tz($now->tz)->addMicroseconds($delta);
        });

        $this->assertSame('2019-09-21 12:34:56.123456', Carbon::now()->format('Y-m-d H:i:s.u'));
        $this->assertSame('2019-09-21 00:00:00.000000', Carbon::today()->format('Y-m-d H:i:s.u'));
        $this->assertSame('2019-09-22 00:00:00.000000', Carbon::create('tomorrow')->format('Y-m-d H:i:s.u'));
        $this->assertSame('2018-06-15 12:34:00.000000', Carbon::create(2018, 6, 15, null, null)->format('Y-m-d H:i:s.u'));

        $delta = 11111111;

        $date = Carbon::now();
        $this->assertSame('America/Toronto', $date->tzName);
        $this->assertSame('2019-09-21 12:35:07.234567', $date->format('Y-m-d H:i:s.u'));
        $date = Carbon::today();
        $this->assertSame('America/Toronto', $date->tzName);
        $this->assertSame('2019-09-21 00:00:00.000000', $date->format('Y-m-d H:i:s.u'));
        $date = Carbon::create('tomorrow');
        $this->assertSame('America/Toronto', $date->tzName);
        $this->assertSame('2019-09-22 00:00:00.000000', $date->format('Y-m-d H:i:s.u'));
        $date = Carbon::create(2018, 6, 15, null, null);
        $this->assertSame('America/Toronto', $date->tzName);
        $this->assertSame('2018-06-15 12:35:00.000000', $date->format('Y-m-d H:i:s.u'));

        date_default_timezone_set('UTC');

        $date = Carbon::now();
        $this->assertSame('UTC', $date->tzName);
        $this->assertSame('2019-09-21 16:35:07.234567', $date->format('Y-m-d H:i:s.u'));
        $date = Carbon::today();
        $this->assertSame('UTC', $date->tzName);
        $this->assertSame('2019-09-21 00:00:00.000000', $date->format('Y-m-d H:i:s.u'));
        $date = Carbon::create('tomorrow');
        $this->assertSame('UTC', $date->tzName);
        $this->assertSame('2019-09-22 00:00:00.000000', $date->format('Y-m-d H:i:s.u'));
        $date = Carbon::create(2018, 6, 15, null, null);
        $this->assertSame('UTC', $date->tzName);
        $this->assertSame('2018-06-15 16:35:00.000000', $date->format('Y-m-d H:i:s.u'));

        date_default_timezone_set('America/Toronto');
    }

    public function testParseWithTestValueSet()
    {
        $testNow = Carbon::yesterday();

        $this->wrapWithTestNow(function () use ($testNow) {
            $this->assertEquals($testNow, Carbon::parse(null));
            $this->assertEquals($testNow, Carbon::parse(''));
            $this->assertEquals($testNow, Carbon::parse('now'));
        }, $testNow);
    }

    public function testParseRelativeWithTestValueSet()
    {
        $testNow = Carbon::parse('2013-09-01 05:15:05');

        $this->wrapWithTestNow(function () {
            $this->assertSame('2013-09-01 05:10:05', Carbon::parse('5 minutes ago')->toDateTimeString());
            $this->assertSame('2013-08-25 05:15:05', Carbon::parse('1 week ago')->toDateTimeString());

            $this->assertSame('2013-09-02 00:00:00', Carbon::parse('tomorrow')->toDateTimeString());
            $this->assertSame('2013-09-01 00:00:00', Carbon::parse('today')->toDateTimeString());
            $this->assertSame('2013-08-31 00:00:00', Carbon::parse('yesterday')->toDateTimeString());

            $this->assertSame('2013-09-02 05:15:05', Carbon::parse('+1 day')->toDateTimeString());
            $this->assertSame('2013-08-31 05:15:05', Carbon::parse('-1 day')->toDateTimeString());

            $this->assertSame('2013-09-02 00:00:00', Carbon::parse('next monday')->toDateTimeString());
            $this->assertSame('2013-09-03 00:00:00', Carbon::parse('next tuesday')->toDateTimeString());
            $this->assertSame('2013-09-04 00:00:00', Carbon::parse('next wednesday')->toDateTimeString());
            $this->assertSame('2013-09-05 00:00:00', Carbon::parse('next thursday')->toDateTimeString());
            $this->assertSame('2013-09-06 00:00:00', Carbon::parse('next friday')->toDateTimeString());
            $this->assertSame('2013-09-07 00:00:00', Carbon::parse('next saturday')->toDateTimeString());
            $this->assertSame('2013-09-08 00:00:00', Carbon::parse('next sunday')->toDateTimeString());

            $this->assertSame('2013-08-26 00:00:00', Carbon::parse('last monday')->toDateTimeString());
            $this->assertSame('2013-08-27 00:00:00', Carbon::parse('last tuesday')->toDateTimeString());
            $this->assertSame('2013-08-28 00:00:00', Carbon::parse('last wednesday')->toDateTimeString());
            $this->assertSame('2013-08-29 00:00:00', Carbon::parse('last thursday')->toDateTimeString());
            $this->assertSame('2013-08-30 00:00:00', Carbon::parse('last friday')->toDateTimeString());
            $this->assertSame('2013-08-31 00:00:00', Carbon::parse('last saturday')->toDateTimeString());
            $this->assertSame('2013-08-25 00:00:00', Carbon::parse('last sunday')->toDateTimeString());

            $this->assertSame('2013-09-02 00:00:00', Carbon::parse('this monday')->toDateTimeString());
            $this->assertSame('2013-09-03 00:00:00', Carbon::parse('this tuesday')->toDateTimeString());
            $this->assertSame('2013-09-04 00:00:00', Carbon::parse('this wednesday')->toDateTimeString());
            $this->assertSame('2013-09-05 00:00:00', Carbon::parse('this thursday')->toDateTimeString());
            $this->assertSame('2013-09-06 00:00:00', Carbon::parse('this friday')->toDateTimeString());
            $this->assertSame('2013-09-07 00:00:00', Carbon::parse('this saturday')->toDateTimeString());
            $this->assertSame('2013-09-01 00:00:00', Carbon::parse('this sunday')->toDateTimeString());

            $this->assertSame('2013-10-01 05:15:05', Carbon::parse('first day of next month')->toDateTimeString());
            $this->assertSame('2013-09-30 05:15:05', Carbon::parse('last day of this month')->toDateTimeString());
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

        $this->wrapWithTestNow(function () {
            $this->assertSame('2000-01-03 00:00:00', Carbon::parse('2000-1-3')->toDateTimeString());
            $this->assertSame('2000-10-10 00:00:00', Carbon::parse('2000-10-10')->toDateTimeString());
        }, $testNow);

        $this->assertSame('2000-01-03 00:00:00', Carbon::parse('2000-1-3')->toDateTimeString());
        $this->assertSame('2000-10-10 00:00:00', Carbon::parse('2000-10-10')->toDateTimeString());
    }

    public function testTimeZoneWithTestValueSet()
    {
        $testNow = Carbon::parse('2013-07-01 12:00:00', 'America/New_York');

        $this->wrapWithTestNow(function () {
            $this->assertSame('2013-07-01T12:00:00-04:00', Carbon::parse('now')->toIso8601String());
            $this->assertSame('2013-07-01T11:00:00-05:00', Carbon::parse('now', 'America/Mexico_City')->toIso8601String());
            $this->assertSame('2013-07-01T09:00:00-07:00', Carbon::parse('now', 'America/Vancouver')->toIso8601String());
        }, $testNow);
    }

    public function testCreateFromPartialFormat()
    {
        Carbon::setTestNowAndTimezone(Carbon::parse('2013-09-01 05:10:15', 'America/Vancouver'));

        // Simple partial time.
        $this->assertSame('2018-05-06T05:10:15-07:00', Carbon::createFromFormat('Y-m-d', '2018-05-06')->toIso8601String());
        $this->assertSame('2013-09-01T10:20:30-07:00', Carbon::createFromFormat('H:i:s', '10:20:30')->toIso8601String());

        // Custom timezone.
        $this->assertSame('2013-09-01T10:20:00+03:00', Carbon::createFromFormat('H:i e', '10:20 Europe/Kiev')->toIso8601String());
        $this->assertSame('2013-09-01T10:20:00+01:00', Carbon::createFromFormat('H:i', '10:20', 'Europe/London')->toIso8601String());
        $this->assertSame('2013-09-01T11:30:00+07:00', Carbon::createFromFormat('H:i:s e', '11:30:00+07:00')->toIso8601String());
        $this->assertSame('2013-09-01T11:30:00+05:00', Carbon::createFromFormat('H:i:s', '11:30:00', '+05:00')->toIso8601String());

        // Escaped timezone.
        $this->assertSame('2013-09-01T05:10:15-07:00', Carbon::createFromFormat('\e', 'e')->toIso8601String());

        // Weird format, naive modify would fail here.
        $this->assertSame('2005-08-09T05:10:15-07:00', Carbon::createFromFormat('l jS \of F Y', 'Tuesday 9th of August 2005')->toIso8601String());
        $this->assertSame('2013-09-01T00:12:13-07:00', Carbon::createFromFormat('i:s', '12:13')->toIso8601String());
        $this->assertSame('2018-09-05T05:10:15-07:00', Carbon::createFromFormat('Y/d', '2018/5')->toIso8601String());

        // Resetting to epoch.
        $this->assertSame('2018-05-06T00:00:00-07:00', Carbon::createFromFormat('!Y-m-d', '2018-05-06')->toIso8601String());
        $this->assertSame('1970-01-01T10:20:30-08:00', Carbon::createFromFormat('Y-m-d! H:i:s', '2018-05-06 10:20:30')->toIso8601String());
        $this->assertSame('2018-05-06T00:00:00-07:00', Carbon::createFromFormat('Y-m-d|', '2018-05-06')->toIso8601String());
        $this->assertSame('1970-01-01T10:20:30-08:00', Carbon::createFromFormat('|H:i:s', '10:20:30')->toIso8601String());

        $kyiv = $this->firstValidTimezoneAmong(['Europe/Kyiv', 'Europe/Kiev'])->getName();
        // Resetting to epoch (timezone fun).
        $this->assertSame('1970-01-01T00:00:00-08:00', Carbon::createFromFormat('|', '')->toIso8601String());
        $this->assertSame('1970-01-01T00:00:00+03:00', Carbon::createFromFormat('e|', $kyiv)->toIso8601String());
        $this->assertSame('1970-01-01T00:00:00+01:00', Carbon::createFromFormat('|', '', 'Europe/London')->toIso8601String());
        $this->assertSame('1970-01-01T00:00:00-08:00', Carbon::createFromFormat('!', '')->toIso8601String());
        $this->assertSame('1970-01-01T00:00:00+03:00', Carbon::createFromFormat('!e', $kyiv)->toIso8601String());
        $this->assertSame('1970-01-01T00:00:00+01:00', Carbon::createFromFormat('!', '', 'Europe/London')->toIso8601String());
        $this->assertSame('1970-01-01T00:00:00-08:00', Carbon::createFromFormat('e!', $kyiv)->toIso8601String());

        // Escaped epoch resets.
        $this->assertSame('2013-09-01T05:10:15-07:00', Carbon::createFromFormat('\|', '|')->toIso8601String());
        $this->assertSame('2013-09-01T05:10:15-07:00', Carbon::createFromFormat('\!', '!')->toIso8601String());
        $this->assertSame('2013-09-01T05:10:15+03:00', Carbon::createFromFormat('e \!', $kyiv.' !')->toIso8601String());

        Carbon::setTestNow('2023-12-05 21:09:54');
        $this->assertSame('2023-12-05 15:00:00.000000', Carbon::createFromFormat('H', '15')->format('Y-m-d H:i:s.u'));
    }

    public function testCreateFromPartialFormatWithMicroseconds()
    {
        Carbon::setTestNowAndTimezone(Carbon::parse('2013-09-01 05:10:15.123456', 'America/Vancouver'));

        $this->assertSame('2018-05-06 05:10:15.123456', Carbon::createFromFormat('Y-m-d', '2018-05-06')->format('Y-m-d H:i:s.u'));
        $this->assertSame('2013-09-01 10:20:30.654321', Carbon::createFromFormat('H:i:s.u', '10:20:30.654321')->format('Y-m-d H:i:s.u'));
    }

    public function testCreateFromDateTimeInterface()
    {
        Carbon::setTestNowAndTimezone(date_create_immutable('2013-09-01 05:10:15.123456', new DateTimeZone('America/Vancouver')));

        $this->assertSame('2018-05-06 05:10:15.123456', Carbon::createFromFormat('Y-m-d', '2018-05-06')->format('Y-m-d H:i:s.u'));
        $this->assertSame('2013-09-01 10:20:30.654321', Carbon::createFromFormat('H:i:s.u', '10:20:30.654321')->format('Y-m-d H:i:s.u'));
    }

    public function testWithTestNow()
    {
        $self = $this;
        $testNow = '2020-09-16 10:20:00';
        $object = new stdClass();

        $result = Carbon::withTestNow($testNow, static function () use ($self, $testNow, $object) {
            $currentTime = Carbon::now();
            $self->assertSame($testNow, $currentTime->format('Y-m-d H:i:s'));

            return $object;
        });

        $this->assertSame($object, $result);

        $currentTime = Carbon::now();
        $this->assertNotEquals($testNow, $currentTime->format('Y-m-d H:i:s'));
    }

    public function testWithTestNowWithException()
    {
        $testNow = '2020-09-16 10:20:00';

        try {
            Carbon::withTestNow($testNow, static function () {
                throw new Exception();
            });
        } catch (Exception $e) {
            // ignore
        }

        $currentTime = Carbon::now();
        $this->assertNotEquals($testNow, $currentTime->format('Y-m-d H:i:s'));
    }
}
