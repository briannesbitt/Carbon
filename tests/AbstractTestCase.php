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
     * @var \Carbon\CarbonImmutable
     */
    protected $immutableNow;

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
        CarbonImmutable::setTestNow($this->immutableNow = CarbonImmutable::now());
    }

    protected function tearDown()
    {
        date_default_timezone_set($this->saveTz);
        Carbon::setTestNow();
        Carbon::resetToStringFormat();
        Carbon::resetMonthsOverflow();
        Carbon::setTranslator(new Translator('en'));
        Carbon::setLocale('en');
        /** @var Translator $translator */
        $translator = Carbon::getTranslator();
        $translator->resetMessages();
        CarbonImmutable::setTestNow();
        CarbonImmutable::resetToStringFormat();
        CarbonImmutable::resetMonthsOverflow();
        CarbonImmutable::setTranslator(new Translator('en'));
        Carbon::setLocale('en');
        /** @var Translator $translator */
        $translator = CarbonImmutable::getTranslator();
        $translator->resetMessages();
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

    public function assertInstanceOfCarbon($d)
    {
        $this->assertInstanceOf(CarbonInterface::class, $d);
    }

    public function assertCarbonInterval(CarbonInterval $ci, $years, $months = null, $days = null, $hours = null, $minutes = null, $seconds = null)
    {
        $actual = ['years' => $ci->years];

        $expected = ['years' => $years];

        if ($months !== null) {
            $actual['months'] = $ci->months;
            $expected['months'] = $months;
        }

        if ($days !== null) {
            $actual['days'] = $ci->dayz;
            $expected['days'] = $days;
        }

        if ($hours !== null) {
            $actual['hours'] = $ci->hours;
            $expected['hours'] = $hours;
        }

        if ($minutes !== null) {
            $actual['minutes'] = $ci->minutes;
            $expected['minutes'] = $minutes;
        }

        if ($seconds !== null) {
            $actual['seconds'] = $ci->seconds;
            $expected['seconds'] = $seconds;
        }

        $this->assertSame($expected, $actual);
    }

    public function assertInstanceOfCarbonInterval($d)
    {
        $this->assertInstanceOf('Carbon\CarbonInterval', $d);
    }

    public function wrapWithTestNow(Closure $func, CarbonInterface $dt = null)
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
