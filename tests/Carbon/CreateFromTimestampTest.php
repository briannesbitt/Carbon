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

class CreateFromTimestampTest extends AbstractTestCase
{
    public function testCreateReturnsDatingInstance()
    {
        $d = Carbon::createFromTimestamp(Carbon::create(1975, 5, 21, 22, 32, 5)->timestamp);
        $this->assertCarbon($d, 1975, 5, 21, 22, 32, 5);
    }

    public function testCreateFromTimestampMS()
    {
        $baseTimestamp = Carbon::create(1975, 5, 21, 22, 32, 5)->timestamp * 1000;

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

    public function testComaDecimalSeparatorLocale()
    {
        $date = new Carbon('2017-07-29T13:57:27.123456Z');
        $this->assertSame('2017-07-29 13:57:27.123456 Z', $date->format('Y-m-d H:i:s.u e'));

        $date = Carbon::createFromFormat('Y-m-d\TH:i:s.uT', '2017-07-29T13:57:27.123456Z');
        $this->assertSame('2017-07-29 13:57:27.123456 Z', $date->format('Y-m-d H:i:s.u e'));
        $timestamp = Carbon::create(1975, 5, 21, 22, 32, 5)->timestamp * 1000 + 321;
        $d = Carbon::createFromTimestampMs($timestamp);
        $this->assertCarbon($d, 1975, 5, 21, 22, 32, 5, 321000);

        $locale = setlocale(LC_ALL, '0');
        if (setlocale(LC_ALL, 'fr_FR.UTF-8') === false) {
            $this->markTestSkipped('testComaDecimalSeparatorLocale test need fr_FR.UTF-8.');
        }

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

    public function testCreateFromTimestampWithTimezone()
    {
        $carbon = Carbon::createFromTimestamp('468370800', '+0100');

        $this->assertSame(468370800, $carbon->getTimestamp());
        $this->assertSame('+01:00', $carbon->tzName);
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

    /**
     * Ensures DST php bug does not affect createFromTimestamp in DST change.
     *
     * @see https://github.com/briannesbitt/Carbon/issues/1951
     */
    public function testCreateFromTimestampInDstChange()
    {
        $this->assertSame(
            '2019-11-03T01:00:00-04:00',
            Carbon::createFromTimestamp(1572757200, 'America/New_York')->toIso8601String()
        );
        $this->assertSame(
            '2019-11-03T01:00:00-05:00',
            Carbon::createFromTimestamp(1572757200 + 3600, 'America/New_York')->toIso8601String()
        );
        $this->assertSame(
            '2019-11-03T01:00:00-04:00',
            Carbon::createFromTimestampMs(1572757200000, 'America/New_York')->toIso8601String()
        );
        $this->assertSame(
            '2019-11-03T01:00:00-05:00',
            Carbon::createFromTimestampMs(1572757200000 + 3600000, 'America/New_York')->toIso8601String()
        );
    }
}
