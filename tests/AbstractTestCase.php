<?php

/*
 * This file is part of the Carbon package.
 *
 * (c) Brian Nesbitt <brian@nesbot.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tests;

use Carbon\Carbon;
use Carbon\CarbonInterval;
use Closure;
use PHPUnit_Framework_TestCase;

abstract class AbstractTestCase extends PHPUnit_Framework_TestCase
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
        Carbon::setTestNow();
        Carbon::resetMonthsOverflow();
    }

    protected function assertCarbon(Carbon $d, $year, $month, $day, $hour = null, $minute = null, $second = null)
    {
        $actual = array(
            'years' => $year,
            'months' => $month,
            'day' => $day,
        );

        $expected = array(
            'years' => $d->year,
            'months' => $d->month,
            'day' => $d->day,
        );

        if ($hour !== null) {
            $expected['hours'] = $d->hour;
            $actual['hours'] = $hour;
        }

        if ($minute !== null) {
            $expected['minutes'] = $d->minute;
            $actual['minutes'] = $minute;
        }

        if ($second !== null) {
            $expected['seconds'] = $d->second;
            $actual['seconds'] = $second;
        }

        $this->assertSame($expected, $actual);
    }

    protected function assertInstanceOfCarbon($d)
    {
        $this->assertInstanceOf('Carbon\Carbon', $d);
    }

    protected function assertCarbonInterval(CarbonInterval $ci, $years, $months = null, $days = null, $hours = null, $minutes = null, $seconds = null)
    {
        $expected = array('years' => $ci->years);

        $actual = array('years' => $years);

        if ($months !== null) {
            $expected['months'] = $ci->months;
            $actual['months'] = $months;
        }

        if ($days !== null) {
            $expected['days'] = $ci->dayz;
            $actual['days'] = $days;
        }

        if ($hours !== null) {
            $expected['hours'] = $ci->hours;
            $actual['hours'] = $hours;
        }

        if ($minutes !== null) {
            $expected['minutes'] = $ci->minutes;
            $actual['minutes'] = $minutes;
        }

        if ($seconds !== null) {
            $expected['seconds'] = $ci->seconds;
            $actual['seconds'] = $seconds;
        }

        $this->assertSame($expected, $actual);
    }

    protected function assertInstanceOfCarbonInterval($d)
    {
        $this->assertInstanceOf('Carbon\CarbonInterval', $d);
    }

    protected function wrapWithTestNow(Closure $func, Carbon $dt = null)
    {
        Carbon::setTestNow($dt ?: Carbon::now());
        $func();
        Carbon::setTestNow();
    }

    protected function wrapWithNonDstDate(Closure $func)
    {
        static::wrapWithTestNow($func, Carbon::now()->startOfYear());
    }
}
