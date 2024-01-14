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
use DateTimeZone;
use Tests\AbstractTestCase;

class CreateFromTimestampTest extends AbstractTestCase
{
    public function testCreateReturnsDatingInstance()
    {
        $d = Carbon::createFromTimestamp(Carbon::create(1975, 5, 21, 22, 32, 5, 'UTC')->timestamp);
        $this->assertCarbon($d, 1975, 5, 21, 22, 32, 5);
    }

    public function testCreateFromTimestampMs()
    {
        $baseTimestamp = Carbon::create(1975, 5, 21, 22, 32, 5, 'UTC')->timestamp * 1000;

        $timestamp = $baseTimestamp + 321;
        $d = Carbon::createFromTimestampMs($timestamp);
        $this->assertCarbon($d, 1975, 5, 21, 22, 32, 5, 321000);

        $timestamp = $baseTimestamp + 321.8;
        $d = Carbon::createFromTimestampMs($timestamp);
        $this->assertCarbon($d, 1975, 5, 21, 22, 32, 5, 321800);

        $timestamp = $baseTimestamp + 321.84;
        $d = Carbon::createFromTimestampMs($timestamp);
        $this->assertCarbon($d, 1975, 5, 21, 22, 32, 5, 321840);

        $timestamp = $baseTimestamp + 321.847;
        $d = Carbon::createFromTimestampMs($timestamp);
        $this->assertCarbon($d, 1975, 5, 21, 22, 32, 5, 321847);

        $timestamp = $baseTimestamp + 321.8474;
        $d = Carbon::createFromTimestampMs($timestamp);
        $this->assertCarbon($d, 1975, 5, 21, 22, 32, 5, 321847);

        $timestamp = $baseTimestamp + 321.8479;
        $d = Carbon::createFromTimestampMs($timestamp);
        $this->assertCarbon($d, 1975, 5, 21, 22, 32, 5, 321848);
    }

    public function testCreateFromTimestampMsUTC()
    {
        // Toronto is GMT-04:00 in May
        $baseTimestamp = Carbon::create(1975, 5, 21, 22, 32, 5)->timestamp * 1000;

        $timestamp = $baseTimestamp + 321;
        $d = Carbon::createFromTimestampMsUTC($timestamp);
        $this->assertCarbon($d, 1975, 5, 22, 2, 32, 5, 321000);

        $timestamp = $baseTimestamp + 321.8;
        $d = Carbon::createFromTimestampMsUTC($timestamp);
        $this->assertCarbon($d, 1975, 5, 22, 2, 32, 5, 321800);

        $timestamp = $baseTimestamp + 321.84;
        $d = Carbon::createFromTimestampMsUTC($timestamp);
        $this->assertCarbon($d, 1975, 5, 22, 2, 32, 5, 321840);

        $timestamp = $baseTimestamp + 321.847;
        $d = Carbon::createFromTimestampMsUTC($timestamp);
        $this->assertCarbon($d, 1975, 5, 22, 2, 32, 5, 321847);

        $timestamp = $baseTimestamp + 321.8474;
        $d = Carbon::createFromTimestampMsUTC($timestamp);
        $this->assertCarbon($d, 1975, 5, 22, 2, 32, 5, 321847);

        $timestamp = $baseTimestamp + 321.8479;
        $d = Carbon::createFromTimestampMsUTC($timestamp);
        $this->assertCarbon($d, 1975, 5, 22, 2, 32, 5, 321848);

        $d = Carbon::createFromTimestampMsUTC(1);
        $this->assertCarbon($d, 1970, 1, 1, 0, 0, 0, 1000);

        $d = Carbon::createFromTimestampMsUTC(60);
        $this->assertCarbon($d, 1970, 1, 1, 0, 0, 0, 60000);

        $d = Carbon::createFromTimestampMsUTC(1000);
        $this->assertCarbon($d, 1970, 1, 1, 0, 0, 1, 0);

        $d = Carbon::createFromTimestampMsUTC(-0.04);
        $this->assertCarbon($d, 1969, 12, 31, 23, 59, 59, 999960);
    }

    public function testComaDecimalSeparatorLocale()
    {
        $date = new Carbon('2017-07-29T13:57:27.123456Z');
        $this->assertSame('2017-07-29 13:57:27.123456 Z', $date->format('Y-m-d H:i:s.u e'));

        $date = Carbon::createFromFormat('Y-m-d\TH:i:s.uT', '2017-07-29T13:57:27.123456Z');
        $this->assertSame('2017-07-29 13:57:27.123456 Z', $date->format('Y-m-d H:i:s.u e'));
        $timestamp = Carbon::create(1975, 5, 21, 22, 32, 5, 'UTC')->timestamp * 1000 + 321;
        $d = Carbon::createFromTimestampMs($timestamp);
        $this->assertCarbon($d, 1975, 5, 21, 22, 32, 5, 321000);

        $locale = setlocale(LC_ALL, '0');
        if (setlocale(LC_ALL, 'fr_FR.UTF-8', 'fr_FR.utf8', 'French_France.UTF8') === false) {
            $this->markTestSkipped('testComaDecimalSeparatorLocale test need fr_FR.UTF-8.');
        }

        $timestamp = Carbon::create(1975, 5, 21, 22, 32, 5, 'UTC')->timestamp * 1000 + 321;
        $d = Carbon::createFromTimestampMs($timestamp);
        $this->assertCarbon($d, 1975, 5, 21, 22, 32, 5, 321000);

        $date = new Carbon('2017-07-29T13:57:27.123456Z');
        $this->assertSame('2017-07-29 13:57:27.123456 Z', $date->format('Y-m-d H:i:s.u e'));

        $date = Carbon::createFromFormat('Y-m-d\TH:i:s.uT', '2017-07-29T13:57:27.123456Z');
        $this->assertSame('2017-07-29 13:57:27.123456 Z', $date->format('Y-m-d H:i:s.u e'));
        $timestamp = Carbon::create(1975, 5, 21, 22, 32, 5, 'UTC')->timestamp * 1000 + 321;
        $d = Carbon::createFromTimestampMs($timestamp);
        $this->assertCarbon($d, 1975, 5, 21, 22, 32, 5, 321000);

        setlocale(LC_ALL, $locale);
    }

    public function testCreateFromTimestampUsesNoTimezone()
    {
        $d = Carbon::createFromTimestamp(0);

        // UTC by default
        $this->assertSame(1970, $d->year);
        $this->assertSame(0, $d->offset);
    }

    public function testCreateFromTimestampUsesDefaultTimezone()
    {
        $d = Carbon::createFromTimestamp(0, 'America/Toronto');

        // We know Toronto is -5 since no DST in Jan
        $this->assertSame(1969, $d->year);
        $this->assertSame(-5 * 3600, $d->offset);
    }

    public function testCreateFromTimestampWithDateTimeZone()
    {
        $d = Carbon::createFromTimestamp(0, new DateTimeZone('UTC'));
        $this->assertSame('UTC', $d->tzName);
        $this->assertCarbon($d, 1970, 1, 1, 0, 0, 0);
    }

    public function testCreateFromTimestampWithString()
    {
        $d = Carbon::createFromTimestamp(0, 'UTC');
        $this->assertCarbon($d, 1970, 1, 1, 0, 0, 0);
        $this->assertSame(0, $d->offset);
        $this->assertSame('UTC', $d->tzName);
    }

    public function testCreateFromTimestampGMTDoesNotUseDefaultTimezone()
    {
        $d = Carbon::createFromTimestampUTC(0);
        $this->assertCarbon($d, 1970, 1, 1, 0, 0, 0);
        $this->assertSame(0, $d->offset);
    }

    /**
     * Ensures DST php bug does not affect createFromTimestamp in DST change.
     *
     * @see https://github.com/briannesbitt/Carbon/issues/1951
     */
    public function testCreateFromTimestampInDstChange()
    {
        $this->assertSame(
            '2019-11-03T01:00:00-04:00',
            Carbon::createFromTimestamp(1572757200, 'America/New_York')->toIso8601String(),
        );
        $this->assertSame(
            '2019-11-03T01:00:00-05:00',
            Carbon::createFromTimestamp(1572757200 + 3600, 'America/New_York')->toIso8601String(),
        );
        $this->assertSame(
            '2019-11-03T01:00:00-04:00',
            Carbon::createFromTimestampMs(1572757200000, 'America/New_York')->toIso8601String(),
        );
        $this->assertSame(
            '2019-11-03T01:00:00-05:00',
            Carbon::createFromTimestampMs(1572757200000 + 3600000, 'America/New_York')->toIso8601String(),
        );
    }

    public function testCreateFromMicrotimeFloat()
    {
        $microtime = 1600887164.88952298;
        $d = Carbon::createFromTimestamp($microtime);
        $this->assertSame('+00:00', $d->tzName);
        $this->assertSame('2020-09-23 18:52:44.889523', $d->format('Y-m-d H:i:s.u'));
        $this->assertSame('1600887164.889523', $d->format('U.u'));

        $d = Carbon::createFromTimestamp($microtime, 'America/Toronto');
        $this->assertSame('America/Toronto', $d->tzName);
        $this->assertSame('2020-09-23 14:52:44.889523', $d->format('Y-m-d H:i:s.u'));
        $this->assertSame('1600887164.889523', $d->format('U.u'));

        $microtime = 1600887164.0603;
        $d = Carbon::createFromTimestamp($microtime);
        $this->assertSame('+00:00', $d->tzName);
        $this->assertSame('2020-09-23 18:52:44.060300', $d->format('Y-m-d H:i:s.u'));
        $this->assertSame('1600887164.060300', $d->format('U.u'));

        $d = Carbon::createFromTimestamp($microtime, 'America/Toronto');
        $this->assertSame('America/Toronto', $d->tzName);
        $this->assertSame('2020-09-23 14:52:44.060300', $d->format('Y-m-d H:i:s.u'));
        $this->assertSame('1600887164.060300', $d->format('U.u'));

        $this->assertSame('010000', Carbon::createFromTimestamp(0.01)->format('u'));
    }

    public function testCreateFromMicrotimeStrings()
    {
        $microtime = '0.88951247 1600887164';
        $d = Carbon::createFromTimestamp($microtime, 'America/Toronto');
        $this->assertSame('America/Toronto', $d->tzName);
        $this->assertSame('2020-09-23 14:52:44.889512', $d->format('Y-m-d H:i:s.u'));
        $this->assertSame('1600887164.889512', $d->format('U.u'));

        $d = Carbon::createFromTimestamp($microtime);
        $this->assertSame('+00:00', $d->tzName);
        $this->assertSame('2020-09-23 18:52:44.889512', $d->format('Y-m-d H:i:s.u'));
        $this->assertSame('1600887164.889512', $d->format('U.u'));

        $microtime = '0.88951247/1600887164/12.56';
        $d = Carbon::createFromTimestamp($microtime, 'America/Toronto');
        $this->assertSame('America/Toronto', $d->tzName);
        $this->assertSame('2020-09-23 14:52:57.449512', $d->format('Y-m-d H:i:s.u'));
        $this->assertSame('1600887177.449512', $d->format('U.u'));

        $d = Carbon::createFromTimestamp($microtime);
        $this->assertSame('+00:00', $d->tzName);
        $this->assertSame('2020-09-23 18:52:57.449512', $d->format('Y-m-d H:i:s.u'));
        $this->assertSame('1600887177.449512', $d->format('U.u'));

        $d = Carbon::createFromTimestamp('-10.6', 'America/Toronto');
        $this->assertSame('1969-12-31 18:59:49.400000 -05:00', $d->format('Y-m-d H:i:s.u P'));

        $d = Carbon::createFromTimestamp('-10.6');
        $this->assertSame('1969-12-31 23:59:49.400000 +00:00', $d->format('Y-m-d H:i:s.u P'));

        $d = new Carbon('@-10.6');
        $this->assertSame('1969-12-31 23:59:49.400000 +00:00', $d->format('Y-m-d H:i:s.u P'));
    }

    public function testCreateFromMicrotimeUTCFloat()
    {
        $microtime = 1600887164.88952298;
        $d = Carbon::createFromTimestampUTC($microtime);
        $this->assertSame('+00:00', $d->tzName);
        $this->assertSame('2020-09-23 18:52:44.889523', $d->format('Y-m-d H:i:s.u'));
        $this->assertSame('1600887164.889523', $d->format('U.u'));
    }

    public function testCreateFromMicrotimeUTCStrings()
    {
        $microtime = '0.88951247 1600887164';
        $d = Carbon::createFromTimestampUTC($microtime);
        $this->assertSame('+00:00', $d->tzName);
        $this->assertSame('2020-09-23 18:52:44.889512', $d->format('Y-m-d H:i:s.u'));
        $this->assertSame('1600887164.889512', $d->format('U.u'));

        $microtime = '0.88951247/1600887164/12.56';
        $d = Carbon::createFromTimestampUTC($microtime);
        $this->assertSame('+00:00', $d->tzName);
        $this->assertSame('2020-09-23 18:52:57.449512', $d->format('Y-m-d H:i:s.u'));
        $this->assertSame('1600887177.449512', $d->format('U.u'));
    }

    public function testNegativeIntegerTimestamp()
    {
        $this->assertSame(
            '1969-12-31 18:59:59.000000 -05:00',
            Carbon::createFromTimestamp(-1, 'America/Toronto')->format('Y-m-d H:i:s.u P'),
        );
        $this->assertSame(
            '1969-12-31 23:59:59.000000 +00:00',
            Carbon::createFromTimestamp(-1)->format('Y-m-d H:i:s.u P'),
        );
    }
}
