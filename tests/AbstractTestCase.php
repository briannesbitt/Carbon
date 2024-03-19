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
use Carbon\CarbonPeriodImmutable;
use Carbon\CarbonTimeZone;
use Carbon\Translator;
use Closure;
use DateTime;
use ErrorException;
use PHPUnit\Framework\TestCase;
use ReflectionProperty;
use Tests\PHPUnit\AssertObjectHasPropertyTrait;
use Throwable;

/**
 * @SuppressWarnings(PHPMD.NumberOfChildren)
 */
abstract class AbstractTestCase extends TestCase
{
    use AssertObjectHasPropertyTrait;

    private ?string $saveTz = null;
    protected ?Carbon $now = null;
    protected ?CarbonImmutable $immutableNow = null;
    protected bool $oldNow = false;
    protected bool $oldImmutableNow = false;

    /** @var class-string<CarbonPeriod> */
    protected static string $periodClass = CarbonPeriod::class;
    protected int $initialOptions = 0;

    protected function getTimestamp(): int
    {
        return (new DateTime())->getTimestamp();
    }

    protected function setUp(): void
    {
        $this->initialOptions = static::$periodClass === CarbonPeriodImmutable::class ? CarbonPeriod::IMMUTABLE : 0;

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

    public function assertCarbon(CarbonInterface $d, $year, $month, $day, $hour = null, $minute = null, $second = null, $micro = null): void
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

    public function assertCarbonTime(CarbonInterface $d, $hour = null, $minute = null, $second = null, $micro = null): void
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

    /**
     * @phpstan-assert CarbonInterface $d
     */
    public function assertInstanceOfCarbon($d): void
    {
        $this->assertInstanceOf(CarbonInterface::class, $d);
    }

    public function assertCarbonInterval(CarbonInterval $ci, $years, $months = null, $days = null, $hours = null, $minutes = null, $seconds = null, $microseconds = null, $inverted = null): void
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

    /**
     * @phpstan-assert CarbonInterval $d
     */
    public function assertInstanceOfCarbonInterval($d): void
    {
        $this->assertInstanceOf(CarbonInterval::class, $d);
    }

    public function wrapWithTestNow(Closure $func, ?CarbonInterface $dt = null): void
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

    public function wrapWithNonDstDate(Closure $func): void
    {
        $this->wrapWithTestNow($func, Carbon::now()->startOfYear());
    }

    public function wrapWithUtf8LcTimeLocale($locale, Closure $func): void
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

        try {
            $func();
        } finally {
            setlocale(LC_TIME, $currentLocale);
        }
    }

    public function withErrorAsException(Closure $func): void
    {
        $previous = set_error_handler(static function (int $code, string $message, string $file, int $line) {
            throw new ErrorException($message, $code, $code, $file, $line);
        });

        $errorReporting = error_reporting();

        try {
            error_reporting(E_ALL);

            $func();
        } finally {
            error_reporting($errorReporting);
            restore_error_handler();
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

    protected function areSameLocales($a, $b): bool
    {
        static $aliases = null;

        if ($aliases === null) {
            $property = new ReflectionProperty(Translator::class, 'aliases');
            $aliases = $property->getValue(Translator::get());
        }

        $a = $aliases[$a] ?? $a;
        $b = $aliases[$b] ?? $b;

        return $a === $b;
    }

    protected function firstValidTimezoneAmong(array $timezones): CarbonTimeZone
    {
        $firstError = null;

        foreach ($timezones as $timezone) {
            try {
                return new CarbonTimeZone($timezone);
            } catch (Throwable $exception) {
                $firstError = $firstError ?? $exception;
            }
        }

        throw $firstError;
    }

    protected function assertPeriodOptions(int $options, CarbonPeriod $period): void
    {
        $this->assertSame($this->initialOptions | $options, $period->getOptions());
    }

    protected function assertVeryClose(mixed $expected, mixed $actual, string $message = ''): void
    {
        $this->assertEqualsWithDelta(
            $expected,
            $actual,
            0.000000000000001,
            $message,
        );
    }
}
