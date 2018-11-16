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
use DateTimeZone;
use Tests\AbstractTestCase;

class CreateFromTimestampTest extends AbstractTestCase
{
    public function testCreateReturnsDatingInstance()
    {
        $d = Carbon::createFromTimestamp(Carbon::create(1975, 5, 21, 22, 32, 5)->timestamp);
        $this->assertCarbon($d, 1975, 5, 21, 22, 32, 5);
    }

    public function testCreateFromTimestampMS()
    {
        $timestamp = Carbon::create(1975, 5, 21, 22, 32, 5)->timestamp * 1000 + 321;
        $d = Carbon::createFromTimestampMs($timestamp);
        $this->assertCarbon($d, 1975, 5, 21, 22, 32, 5, 321000);
    }

    public function testComaDecimalSeparatorLocale()
    {
        // @TODO Fix this feature for PHP 7.1.3 => 7.1.5
        $this->excludePhpVersionsRange('7.1.3', '7.1.5');

        $date = new Carbon('2017-07-29T13:57:27.123456Z');
        $this->assertSame('2017-07-29 13:57:27.123456 Z', $date->format('Y-m-d H:i:s.u e'));

        $date = Carbon::createFromFormat('Y-m-d\TH:i:s.uT', '2017-07-29T13:57:27.123456Z');
        $this->assertSame('2017-07-29 13:57:27.123456 Z', $date->format('Y-m-d H:i:s.u e'));
        $timestamp = Carbon::create(1975, 5, 21, 22, 32, 5)->timestamp * 1000 + 321;
        $d = Carbon::createFromTimestampMs($timestamp);
        $this->assertCarbon($d, 1975, 5, 21, 22, 32, 5, 321000);

        $locale = setlocale(LC_ALL, '0');
        setlocale(LC_ALL, 'fr_FR.UTF-8');

        $timestamp = Carbon::create(1975, 5, 21, 22, 32, 5)->timestamp * 1000 + 321;
        $d = Carbon::createFromTimestampMs($timestamp);
        $this->assertCarbon($d, 1975, 5, 21, 22, 32, 5, 321000);

        $date = new Carbon('2017-07-29T13:57:27.123456Z');
        $this->assertSame('2017-07-29 13:57:27.123456 Z', $date->format('Y-m-d H:i:s.u e'));

        $date = Carbon::createFromFormat('Y-m-d\TH:i:s.uT', '2017-07-29T13:57:27.123456Z');
        $this->assertSame('2017-07-29 13:57:27.123456 Z', $date->format('Y-m-d H:i:s.u e'));
        $timestamp = Carbon::create(1975, 5, 21, 22, 32, 5)->timestamp * 1000 + 321;
        $d = Carbon::createFromTimestampMs($timestamp);
        $this->assertCarbon($d, 1975, 5, 21, 22, 32, 5, 321000);

        setlocale(LC_ALL, $locale);
    }

    public function testCreateFromTimestampUsesDefaultTimezone()
    {
        $d = Carbon::createFromTimestamp(0);

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
}
