<?php

/*
 * This file is part of the Carbon package.
 *
 * (c) Brian Nesbitt <brian@nesbot.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

require __DIR__.'/../vendor/autoload.php';

use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Carbon\CarbonInterval;

class TestFixture extends \PHPUnit_Framework_TestCase
{
    private $saveTz;

    protected function setUp()
    {
        //save current timezone
        $this->saveTz = date_default_timezone_get();

        date_default_timezone_set('America/Toronto');
    }

    protected function tearDown()
    {
        date_default_timezone_set($this->saveTz);
    }

    protected function assertCarbon(Carbon $d, $year, $month, $day, $hour = null, $minute = null, $second = null)
    {
        $this->assertSame($year, $d->year, 'Carbon->year');
        $this->assertSame($month, $d->month, 'Carbon->month');
        $this->assertSame($day, $d->day, 'Carbon->day');

        if ($hour !== null) {
            $this->assertSame($hour, $d->hour, 'Carbon->hour');
        }

        if ($minute !== null) {
            $this->assertSame($minute, $d->minute, 'Carbon->minute');
        }

        if ($second !== null) {
            $this->assertSame($second, $d->second, 'Carbon->second');
        }
    }

    protected function assertInstanceOfCarbon($d)
    {
        $this->assertInstanceOf('Carbon\Carbon', $d);
    }

    protected function assertCarbonImmutable(CarbonImmutable $d, $year, $month, $day, $hour = null, $minute = null, $second = null)
    {
        $this->assertSame($year, $d->year, 'CarbonImmutable->year');
        $this->assertSame($month, $d->month, 'CarbonImmutable->month');
        $this->assertSame($day, $d->day, 'CarbonImmutable->day');

        if ($hour !== null) {
            $this->assertSame($hour, $d->hour, 'CarbonImmutable->hour');
        }

        if ($minute !== null) {
            $this->assertSame($minute, $d->minute, 'CarbonImmutable->minute');
        }

        if ($second !== null) {
            $this->assertSame($second, $d->second, 'CarbonImmutable->second');
        }
    }

    protected function assertInstanceOfCarbonImmutable($d)
    {
        $this->assertInstanceOf('Carbon\CarbonImmutable', $d);
    }

    protected function assertCarbonInterval(CarbonInterval $ci, $years, $months = null, $days = null, $hours = null, $minutes = null, $seconds = null)
    {
        $this->assertSame($years, $ci->years, 'CarbonInterval->years');

        if ($months !== null) {
            $this->assertSame($months, $ci->months, 'CarbonInterval->months');
        }

        if ($days !== null) {
            $this->assertSame($days, $ci->dayz, 'CarbonInterval->dayz');
        }

        if ($hours !== null) {
            $this->assertSame($hours, $ci->hours, 'CarbonInterval->hours');
        }

        if ($minutes !== null) {
            $this->assertSame($minutes, $ci->minutes, 'CarbonInterval->minutes');
        }

        if ($seconds !== null) {
            $this->assertSame($seconds, $ci->seconds, 'CarbonInterval->seconds');
        }
    }

    protected function assertInstanceOfCarbonInterval($d)
    {
        $this->assertInstanceOf('Carbon\CarbonInterval', $d);
    }

    protected function wrapWithTestNow(Closure $func, Carbon $dt = null)
    {
        Carbon::setTestNow(($dt === null) ? Carbon::now() : $dt);
        $func();
        Carbon::setTestNow();
    }

    protected function wrapWithTestNowImmutable(Closure $func, CarbonImmutable $dt = null)
    {
        CarbonImmutable::setTestNow(($dt === null) ? CarbonImmutable::now() : $dt);
        $func();
        CarbonImmutable::setTestNow();
    }
}
