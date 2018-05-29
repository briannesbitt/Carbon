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
use Carbon\CarbonImmutable;
use Carbon\CarbonInterface;
use Carbon\CarbonInterval;
use Closure;
use DateTime;
use PHPUnit\Framework\TestCase;

abstract class AbstractTestCase extends TestCase
{
    /**
     * @var \Carbon\CarbonInterface
     */
    protected $now;

    /**
     * @var string
     */
    private $saveTz;

    protected function setUp()
    {
        //save current timezone
        $this->saveTz = date_default_timezone_get();

        date_default_timezone_set('America/Toronto');

        Carbon::setTestNow($this->now = Carbon::now());
        CarbonImmutable::setTestNow($this->now = CarbonImmutable::now());
    }

    protected function tearDown()
    {
        date_default_timezone_set($this->saveTz);
        Carbon::setTestNow();
        Carbon::resetMonthsOverflow();
        CarbonImmutable::setTestNow();
        CarbonImmutable::resetMonthsOverflow();
    }

    public function assertCarbon(CarbonInterface $d, $year, $month, $day, $hour = null, $minute = null, $second = null, $micro = null)
    {
        $expected = [
            'years' => $year,
            'months' => $month,
            'day' => $day,
        ];

        $actual = [
            'years' => $d->year,
            'months' => $d->month,
            'day' => $d->day,
        ];

        if ($hour !== null) {
            $actual['hours'] = $d->hour;
            $expected['hours'] = $hour;
        }

        if ($minute !== null) {
            $actual['minutes'] = $d->minute;
            $expected['minutes'] = $minute;
        }

        if ($second !== null) {
            $actual['seconds'] = $d->second;
            $expected['seconds'] = $second;
        }

        if ($micro !== null) {
            $actual['micro'] = $d->micro;
            $expected['micro'] = $micro;
        }

        $this->assertSame($expected, $actual);
    }

    public function assertCarbonTime(CarbonInterface $d, $hour = null, $minute = null, $second = null, $micro = null)
    {
        $actual = [];

        $expected = [];

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

        if ($micro !== null) {
            $expected['micro'] = $d->micro;
            $actual['micro'] = $micro;
        }

        $this->assertSame($expected, $actual);
    }

    public function assertInstanceOfCarbon($d)
    {
        $this->assertInstanceOf(CarbonInterface::class, $d);
    }

    public function assertCarbonInterval(CarbonInterval $ci, $years, $months = null, $days = null, $hours = null, $minutes = null, $seconds = null)
    {
        $expected = ['years' => $ci->years];

        $actual = ['years' => $years];

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

    public function assertInstanceOfCarbonInterval($d)
    {
        $this->assertInstanceOf('Carbon\CarbonInterval', $d);
    }

    public function wrapWithTestNow(Closure $func, CarbonInterface $dt = null)
    {
        Carbon::setTestNow($dt ?: Carbon::now());
        $func();
        Carbon::setTestNow();
    }

    public function wrapWithNonDstDate(Closure $func)
    {
        $this->wrapWithTestNow($func, Carbon::now()->startOfYear());
    }

    /**
     * Standardize given set of dates (or period) before assertion.
     *
     * @param array|\DatePeriod $dates
     *
     * @return array
     */
    public function standardizeDates($dates)
    {
        $result = [];

        foreach ($dates as $date) {
            if ($date instanceof DateTime) {
                $date = Carbon::instance($date);
            } elseif (is_string($date)) {
                $date = Carbon::parse($date);
            }

            $result[] = $date->format('Y-m-d H:i:s P');
        }

        return $result;
    }
}
