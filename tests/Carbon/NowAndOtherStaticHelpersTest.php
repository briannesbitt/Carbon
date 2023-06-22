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
use DateTime;
use DateTimeZone;
use Tests\AbstractTestCase;

class NowAndOtherStaticHelpersTest extends AbstractTestCase
{
    public function testNow()
    {
        $dt = Carbon::now();
        $this->assertSame($this->now->getTimestamp(), $dt->timestamp);
        $this->assertSame($this->now->unix(), $dt->timestamp);

        Carbon::setTestNow();
        $before = $this->getTimestamp();
        $dt = Carbon::now();
        $after = $this->getTimestamp();
        $this->assertGreaterThanOrEqual($before, $dt->timestamp);
        $this->assertLessThanOrEqual($after, $dt->timestamp);
    }

    public function testGetPreciseTimestamp()
    {
        $dt = Carbon::parse('2018-01-06 12:34:10.987126');
        $this->assertSame(1515260.0, $dt->getPreciseTimestamp(-3));
        $this->assertSame(151526005.0, $dt->getPreciseTimestamp(-1));
        $this->assertSame(1515260051.0, $dt->getPreciseTimestamp(0));
        $this->assertSame(15152600510.0, $dt->getPreciseTimestamp(1));
        $this->assertSame(151526005099.0, $dt->getPreciseTimestamp(2));
        $this->assertSame(1515260050987.0, $dt->valueOf());
        $this->assertSame(15152600509871.0, $dt->getPreciseTimestamp(4));
        $this->assertSame(151526005098713.0, $dt->getPreciseTimestamp(5));
        $this->assertSame(1515260050987126.0, $dt->getPreciseTimestamp(6));
        $this->assertSame(151526005098712600.0, $dt->getPreciseTimestamp(8));
        $this->assertSame(1515260050987126000.0, $dt->getPreciseTimestamp(9));
    }

    public function testGetTimestampMs()
    {
        $dt = Carbon::parse('2018-01-06 12:34:10.987126');
        $this->assertSame(1515260050987, $dt->getTimestampMs());
    }

    public function testNowWithTimezone()
    {
        $dt = Carbon::now('Europe/London');
        $this->assertSame($this->now->getTimestamp(), $dt->timestamp);

        Carbon::setTestNow();
        $before = $this->getTimestamp();
        $dt = Carbon::now('Europe/London');
        $after = $this->getTimestamp();
        $this->assertGreaterThanOrEqual($before, $dt->timestamp);
        $this->assertLessThanOrEqual($after, $dt->timestamp);
        $this->assertSame('Europe/London', $dt->tzName);
    }

    public function testToday()
    {
        $dt = Carbon::today();
        $this->assertSame(date('Y-m-d 00:00:00'), $dt->toDateTimeString());
    }

    public function testTodayWithTimezone()
    {
        $dt = Carbon::today('Europe/London');
        $dt2 = new DateTime('now', new DateTimeZone('Europe/London'));
        $this->assertSame($dt2->format('Y-m-d 00:00:00'), $dt->toDateTimeString());
    }

    public function testTomorrow()
    {
        $dt = Carbon::tomorrow();
        $dt2 = new DateTime('tomorrow');
        $this->assertSame($dt2->format('Y-m-d 00:00:00'), $dt->toDateTimeString());
    }

    public function testTomorrowWithTimezone()
    {
        $dt = Carbon::tomorrow('Europe/London');
        $dt2 = new DateTime('tomorrow', new DateTimeZone('Europe/London'));
        $this->assertSame($dt2->format('Y-m-d 00:00:00'), $dt->toDateTimeString());
    }

    public function testYesterday()
    {
        $dt = Carbon::yesterday();
        $dt2 = new DateTime('yesterday');
        $this->assertSame($dt2->format('Y-m-d 00:00:00'), $dt->toDateTimeString());
    }

    public function testYesterdayWithTimezone()
    {
        $dt = Carbon::yesterday('Europe/London');
        $dt2 = new DateTime('yesterday', new DateTimeZone('Europe/London'));
        $this->assertSame($dt2->format('Y-m-d 00:00:00'), $dt->toDateTimeString());
    }
}
