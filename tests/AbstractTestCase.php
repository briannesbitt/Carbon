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

namespace Tests;

use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Carbon\CarbonInterface;
use Carbon\CarbonInterval;
use Carbon\CarbonPeriod;
use Carbon\Translator;
use Closure;
use DateTime;
use PHPUnit\Framework\TestCase;
use ReflectionProperty;
use Throwable;

/**
 * @SuppressWarnings(PHPMD.NumberOfChildren)
 */
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
     * @var bool
     */
    protected $oldNow = false;

    /**
     * @var bool
     */
    protected $oldImmutableNow = false;

    /**
     * @var string
     */
    private $saveTz;

    /**
     * @var class-string<CarbonPeriod>
     */
    protected $periodClass = CarbonPeriod::class;

    protected function getTimestamp()
    {
        return (new DateTime())->getTimestamp();
    }

    protected function setUp(): void
    {
        //save current timezone
        $this->saveTz = date_default_timezone_get();

        date_default_timezone_set('America/Toronto');

        /** @var Carbon $now */
        $now = $this->oldNow
            ? Carbon::create(2017, 6, 27, 13, 14, 15, 'UTC')
            : Carbon::now();

        /** @var CarbonImmutable $immutableNow */
        $immutableNow = $this->oldImmutableNow
            ? CarbonImmutable::create(2017, 6, 27, 13, 14, 15, 'UTC')
            : CarbonImmutable::now();

        Carbon::setTestNowAndTimezone($this->now = $now);
        CarbonImmutable::setTestNowAndTimezone($this->immutableNow = $immutableNow);

        Carbon::useStrictMode(true);
        CarbonImmutable::useStrictMode(true);
    }

    protected function tearDown(): void
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
        CarbonImmutable::setLocale('en');
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

    public function assertCarbonInterval(CarbonInterval $ci, $years, $months = null, $days = null, $hours = null, $minutes = null, $seconds = null, $microseconds = null, $inverted = null)
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

        if ($microseconds !== null) {
            $actual['microseconds'] = $ci->microseconds;
            $expected['microseconds'] = $microseconds;
        }

        $this->assertSame($expected, $actual);

        if ($inverted !== null) {
            $this->assertSame((bool) $inverted, (bool) $ci->invert);
        }
    }

    public function assertInstanceOfCarbonInterval($d)
    {
        $this->assertInstanceOf(CarbonInterval::class, $d);
    }

    public function wrapWithTestNow(Closure $func, CarbonInterface $dt = null)
    {
        $test = Carbon::getTestNow();
        $immutableTest = CarbonImmutable::getTestNow();
        $dt = $dt ?: Carbon::now();
        Carbon::setTestNowAndTimezone($dt);
        CarbonImmutable::setTestNowAndTimezone($dt);
        $func();
        Carbon::setTestNowAndTimezone($test);
        CarbonImmutable::setTestNowAndTimezone($immutableTest);
    }

    public function wrapWithNonDstDate(Closure $func)
    {
        $this->wrapWithTestNow($func, Carbon::now()->startOfYear());
    }

    public function wrapWithUtf8LcTimeLocale($locale, Closure $func)
    {
        $currentLocale = setlocale(LC_TIME, '0');
        $locales = ["$locale.UTF-8", "$locale.utf8"];
        $mapping = [
            'fr_FR' => 'French_France',
        ];
        $windowsLocale = $mapping[$locale] ?? null;

        if ($windowsLocale) {
            $locales[] = "$windowsLocale.UTF8";
        }

        if (setlocale(LC_TIME, ...$locales) === false) {
            $this->markTestSkipped("UTF-8 test need $locale.UTF-8 (a locale with accents).");
        }

        $exception = null;

        try {
            $func();
        } catch (Throwable $e) {
            $exception = $e;
        }

        setlocale(LC_TIME, $currentLocale);

        if ($exception) {
            throw $exception;
        }
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
            } elseif (\is_string($date)) {
                $date = Carbon::parse($date);
            }

            $result[] = $date->format('Y-m-d H:i:s P');
        }

        return $result;
    }

    protected function areSameLocales($a, $b)
    {
        static $aliases = null;

        if ($aliases === null) {
            $property = new ReflectionProperty(Translator::class, 'aliases');
            $property->setAccessible(true);
            $aliases = $property->getValue(Translator::get());
        }

        $a = $aliases[$a] ?? $a;
        $b = $aliases[$b] ?? $b;

        return $a === $b;
    }
}
