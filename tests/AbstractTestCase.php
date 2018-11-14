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
use Carbon\Translator;
use Closure;
use DateTime;
use PHPUnit\Framework\TestCase;

abstract class AbstractTestCase extends TestCase
{
    /**
     * @var \Carbon\Carbon
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
    }

    protected function requirePhpVersion($version)
    {
        if (version_compare(PHP_VERSION, "$version-dev", '<')) {
            $this->markTestSkipped("PHP $version or higher required for this test");
        }
    }

    protected function excludePhpVersionsRange($from, $to)
    {
        if (version_compare(PHP_VERSION, "$from-dev", '>=') && version_compare(PHP_VERSION, $to, '<=')) {
            $this->markTestSkipped("Test disabled for PHP from version $from to $to");
        }
    }

    protected function tearDown()
    {
        date_default_timezone_set($this->saveTz);
        Carbon::setTestNow();
        Carbon::resetMonthsOverflow();
        Carbon::setTranslator(new Translator('en'));
        Carbon::setLocale('en');
        /** @var Translator $translator */
        $translator = Carbon::getTranslator();
        $translator->resetMessages();
    }

    public function assertCarbon(Carbon $d, $year, $month, $day, $hour = null, $minute = null, $second = null, $micro = null)
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

        if (version_compare(PHP_VERSION, '7.1.0-dev', '>=') && $micro !== null) {
            $expected['micro'] = $d->micro;
            $actual['micro'] = $micro;
        }

        $this->assertSame($expected, $actual);
    }

    public function assertCarbonTime(Carbon $d, $hour = null, $minute = null, $second = null, $micro = null)
    {
        $actual = array();

        $expected = array();

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
        $this->assertInstanceOf('Carbon\Carbon', $d);
    }

    public function assertCarbonInterval(CarbonInterval $ci, $years, $months = null, $days = null, $hours = null, $minutes = null, $seconds = null)
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

    public function assertInstanceOfCarbonInterval($d)
    {
        $this->assertInstanceOf('Carbon\CarbonInterval', $d);
    }

    public function wrapWithTestNow(Closure $func, Carbon $dt = null)
    {
        $test = Carbon::getTestNow();
        Carbon::setTestNow($dt ?: Carbon::now());
        $func();
        Carbon::setTestNow($test);
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
        $result = array();

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
