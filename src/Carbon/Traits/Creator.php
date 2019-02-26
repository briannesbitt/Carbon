<?php

/**
 * This file is part of the Carbon package.
 *
 * (c) Brian Nesbitt <brian@nesbot.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Carbon\Traits;

use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Carbon\CarbonInterface;
use Carbon\CarbonTimeZone;
use Carbon\Exceptions\InvalidDateException;
use DateTimeInterface;
use InvalidArgumentException;

/**
 * Trait Creator.
 *
 * Static creators.
 *
 * Depends on the following methods:
 *
 * @method static Carbon|CarbonImmutable getTestNow()
 */
trait Creator
{
    /**
     * The errors that can occur.
     *
     * @var array
     */
    protected static $lastErrors;

    /**
     * Create a new Carbon instance.
     *
     * Please see the testing aids section (specifically static::setTestNow())
     * for more on the possibility of this constructor returning a test instance.
     *
     * @param string|null               $time
     * @param \DateTimeZone|string|null $tz
     */
    public function __construct($time = null, $tz = null)
    {
        if (is_int($time)) {
            $time = "@$time";
        }

        $originalTz = $tz;

        // If the class has a test now set and we are trying to create a now()
        // instance then override as required
        $isNow = empty($time) || $time === 'now';
        if (method_exists(static::class, 'hasTestNow') &&
            method_exists(static::class, 'getTestNow') &&
            static::hasTestNow() &&
            ($isNow || static::hasRelativeKeywords($time))
        ) {
            static::mockConstructorParameters($time, $tz);
        }

        /** @var CarbonTimeZone $timezone */
        $timezone = $this->autoDetectTimeZone($tz, $originalTz);

        // Work-around for PHP bug https://bugs.php.net/bug.php?id=67127
        if (strpos((string) .1, '.') === false) {
            $locale = setlocale(LC_NUMERIC, '0');
            setlocale(LC_NUMERIC, 'C');
        }
        parent::__construct($time, $timezone);
        if (isset($locale)) {
            setlocale(LC_NUMERIC, $locale);
        }
        static::setLastErrors(parent::getLastErrors());
    }

    /**
     * Create a Carbon instance from a DateTime one.
     *
     * @param \DateTimeInterface $date
     *
     * @return static|CarbonInterface
     */
    public static function instance($date)
    {
        if ($date instanceof static) {
            return clone $date;
        }

        static::expectDateTime($date);

        $instance = new static($date->format('Y-m-d H:i:s.u'), $date->getTimezone());

        if ($date instanceof CarbonInterface || $date instanceof Options) {
            $instance->settings($date->getSettings());
        }

        return $instance;
    }

    /**
     * Create a carbon instance from a string.
     *
     * This is an alias for the constructor that allows better fluent syntax
     * as it allows you to do Carbon::parse('Monday next week')->fn() rather
     * than (new Carbon('Monday next week'))->fn().
     *
     * @param string|null               $time
     * @param \DateTimeZone|string|null $tz
     *
     * @return static|CarbonInterface
     */
    public static function parse($time = null, $tz = null)
    {
        if ($time instanceof DateTimeInterface) {
            return static::instance($time);
        }

        return new static($time, $tz);
    }

    /**
     * Get a Carbon instance for the current date and time.
     *
     * @param \DateTimeZone|string|null $tz
     *
     * @return static|CarbonInterface
     */
    public static function now($tz = null)
    {
        return new static(null, $tz);
    }

    /**
     * Create a Carbon instance for today.
     *
     * @param \DateTimeZone|string|null $tz
     *
     * @return static|CarbonInterface
     */
    public static function today($tz = null)
    {
        return static::parse('today', $tz);
    }

    /**
     * Create a Carbon instance for tomorrow.
     *
     * @param \DateTimeZone|string|null $tz
     *
     * @return static|CarbonInterface
     */
    public static function tomorrow($tz = null)
    {
        return static::parse('tomorrow', $tz);
    }

    /**
     * Create a Carbon instance for yesterday.
     *
     * @param \DateTimeZone|string|null $tz
     *
     * @return static|CarbonInterface
     */
    public static function yesterday($tz = null)
    {
        return static::parse('yesterday', $tz);
    }

    /**
     * Create a Carbon instance for the greatest supported date.
     *
     * @return static|CarbonInterface
     */
    public static function maxValue()
    {
        if (self::$PHPIntSize === 4) {
            // 32 bit
            return static::createFromTimestamp(PHP_INT_MAX); // @codeCoverageIgnore
        }

        // 64 bit
        return static::create(9999, 12, 31, 23, 59, 59);
    }

    /**
     * Create a Carbon instance for the lowest supported date.
     *
     * @return static|CarbonInterface
     */
    public static function minValue()
    {
        if (self::$PHPIntSize === 4) {
            // 32 bit
            return static::createFromTimestamp(~PHP_INT_MAX); // @codeCoverageIgnore
        }

        // 64 bit
        return static::create(1, 1, 1, 0, 0, 0);
    }

    /**
     * Create a new Carbon instance from a specific date and time.
     *
     * If any of $year, $month or $day are set to null their now() values will
     * be used.
     *
     * If $hour is null it will be set to its now() value and the default
     * values for $minute and $second will be their now() values.
     *
     * If $hour is not null then the default values for $minute and $second
     * will be 0.
     *
     * @param int|null                  $year
     * @param int|null                  $month
     * @param int|null                  $day
     * @param int|null                  $hour
     * @param int|null                  $minute
     * @param int|null                  $second
     * @param \DateTimeZone|string|null $tz
     *
     * @throws \InvalidArgumentException
     *
     * @return static|CarbonInterface
     */
    public static function create($year = 0, $month = 1, $day = 1, $hour = 0, $minute = 0, $second = 0, $tz = null)
    {
        if (is_string($year) && !is_numeric($year)) {
            return static::parse($year, $tz);
        }

        $defaults = null;
        $getDefault = function ($unit) use ($tz, &$defaults) {
            if ($defaults === null) {
                $now = static::hasTestNow() ? static::getTestNow() : static::now($tz);

                $defaults = array_combine([
                    'year',
                    'month',
                    'day',
                    'hour',
                    'minute',
                    'second',
                ], explode('-', $now->format('Y-n-j-G-i-s.u')));
            }

            return $defaults[$unit];
        };

        $year = $year === null ? $getDefault('year') : $year;
        $month = $month === null ? $getDefault('month') : $month;
        $day = $day === null ? $getDefault('day') : $day;
        $hour = $hour === null ? $getDefault('hour') : $hour;
        $minute = $minute === null ? $getDefault('minute') : $minute;
        $second = $second === null ? $getDefault('second') : $second;

        $fixYear = null;

        if ($year < 0) {
            $fixYear = $year;
            $year = 0;
        } elseif ($year > 9999) {
            $fixYear = $year - 9999;
            $year = 9999;
        }

        $second = ($second < 10 ? '0' : '').number_format($second, 6);
        /** @var CarbonImmutable|Carbon $instance */
        $instance = static::createFromFormat('!Y-n-j G:i:s.u', sprintf('%s-%s-%s %s:%02s:%02s', $year, $month, $day, $hour, $minute, $second), $tz);

        if ($fixYear !== null) {
            $instance = $instance->addYears($fixYear);
        }

        return $instance;
    }

    /**
     * Create a new safe Carbon instance from a specific date and time.
     *
     * If any of $year, $month or $day are set to null their now() values will
     * be used.
     *
     * If $hour is null it will be set to its now() value and the default
     * values for $minute and $second will be their now() values.
     *
     * If $hour is not null then the default values for $minute and $second
     * will be 0.
     *
     * If one of the set values is not valid, an \InvalidArgumentException
     * will be thrown.
     *
     * @param int|null                  $year
     * @param int|null                  $month
     * @param int|null                  $day
     * @param int|null                  $hour
     * @param int|null                  $minute
     * @param int|null                  $second
     * @param \DateTimeZone|string|null $tz
     *
     * @throws \Carbon\Exceptions\InvalidDateException|\InvalidArgumentException
     *
     * @return static|CarbonInterface|false
     */
    public static function createSafe($year = null, $month = null, $day = null, $hour = null, $minute = null, $second = null, $tz = null)
    {
        $fields = static::getRangesByUnit();

        foreach ($fields as $field => $range) {
            if ($$field !== null && (!is_int($$field) || $$field < $range[0] || $$field > $range[1])) {
                if (static::isStrictModeEnabled()) {
                    throw new InvalidDateException($field, $$field);
                }

                return false;
            }
        }

        $instance = static::create($year, $month, $day, $hour, $minute, $second, $tz);

        foreach (array_reverse($fields) as $field => $range) {
            if ($$field !== null && (!is_int($$field) || $$field !== $instance->$field)) {
                if (static::isStrictModeEnabled()) {
                    throw new InvalidDateException($field, $$field);
                }

                return false;
            }
        }

        return $instance;
    }

    /**
     * Create a Carbon instance from just a date. The time portion is set to now.
     *
     * @param int|null                  $year
     * @param int|null                  $month
     * @param int|null                  $day
     * @param \DateTimeZone|string|null $tz
     *
     * @throws \InvalidArgumentException
     *
     * @return static|CarbonInterface
     */
    public static function createFromDate($year = null, $month = null, $day = null, $tz = null)
    {
        return static::create($year, $month, $day, null, null, null, $tz);
    }

    /**
     * Create a Carbon instance from just a date. The time portion is set to midnight.
     *
     * @param int|null                  $year
     * @param int|null                  $month
     * @param int|null                  $day
     * @param \DateTimeZone|string|null $tz
     *
     * @return static|CarbonInterface
     */
    public static function createMidnightDate($year = null, $month = null, $day = null, $tz = null)
    {
        return static::create($year, $month, $day, 0, 0, 0, $tz);
    }

    /**
     * Create a Carbon instance from just a time. The date portion is set to today.
     *
     * @param int|null                  $hour
     * @param int|null                  $minute
     * @param int|null                  $second
     * @param \DateTimeZone|string|null $tz
     *
     * @throws \InvalidArgumentException
     *
     * @return static|CarbonInterface
     */
    public static function createFromTime($hour = 0, $minute = 0, $second = 0, $tz = null)
    {
        return static::create(null, null, null, $hour, $minute, $second, $tz);
    }

    /**
     * Create a Carbon instance from a time string. The date portion is set to today.
     *
     * @param string                    $time
     * @param \DateTimeZone|string|null $tz
     *
     * @throws \InvalidArgumentException
     *
     * @return static|CarbonInterface
     */
    public static function createFromTimeString($time, $tz = null)
    {
        return static::today($tz)->setTimeFromTimeString($time);
    }

    private static function createFromFormatAndTimezone($format, $time, $originalTz)
    {
        // Work-around for https://bugs.php.net/bug.php?id=75577
        // @codeCoverageIgnoreStart
        if (version_compare(PHP_VERSION, '7.3.0-dev', '<')) {
            $format = str_replace('.v', '.u', $format);
        }
        // @codeCoverageIgnoreEnd

        if ($originalTz === null) {
            return parent::createFromFormat($format, $time);
        }

        $tz = is_int($originalTz)
            ? @timezone_name_from_abbr(null, floatval($originalTz * 3600), 1)
            : $originalTz;

        $tz = static::safeCreateDateTimeZone($tz, $originalTz);

        if ($tz === false) {
            return false;
        }

        return parent::createFromFormat($format, $time, $tz);
    }

    /**
     * Create a Carbon instance from a specific format.
     *
     * @param string                          $format Datetime format
     * @param string                          $time
     * @param \DateTimeZone|string|false|null $tz
     *
     * @throws InvalidArgumentException
     *
     * @return static|CarbonInterface|false
     */
    public static function createFromFormat($format, $time, $tz = null)
    {
        // First attempt to create an instance, so that error messages are based on the unmodified format.
        $date = self::createFromFormatAndTimezone($format, $time, $tz);
        $lastErrors = parent::getLastErrors();

        if (($mock = static::getTestNow()) && $date instanceof DateTimeInterface) {
            // Set timezone from mock if custom timezone was neither given directly nor as a part of format.
            // First let's skip the part that will be ignored by the parser.
            $nonEscaped = '(?<!\\\\)(\\\\{2})*';

            $nonIgnored = preg_replace("/^.*{$nonEscaped}!/s", '', $format);

            if ($tz === null && !preg_match("/{$nonEscaped}[eOPT]/", $nonIgnored)) {
                $tz = $mock->getTimezone();
            }

            // Prepend mock datetime only if the format does not contain non escaped unix epoch reset flag.
            if (!preg_match("/{$nonEscaped}[!|]/", $format)) {
                $format = static::MOCK_DATETIME_FORMAT.' '.$format;
                $time = $mock->format(static::MOCK_DATETIME_FORMAT).' '.$time;
            }

            // Regenerate date from the modified format to base result on the mocked instance instead of now.
            $date = self::createFromFormatAndTimezone($format, $time, $tz);
        }

        if ($date instanceof DateTimeInterface) {
            $instance = static::instance($date);
            $instance::setLastErrors($lastErrors);

            return $instance;
        }

        if (static::isStrictModeEnabled()) {
            throw new InvalidArgumentException(implode(PHP_EOL, $lastErrors['errors']));
        }

        return false;
    }

    /**
     * Make a Carbon instance from given variable if possible.
     *
     * Always return a new instance. Parse only strings and only these likely to be dates (skip intervals
     * and recurrences). Throw an exception for invalid format, but otherwise return null.
     *
     * @param mixed $var
     *
     * @return static|CarbonInterface|null
     */
    public static function make($var)
    {
        if ($var instanceof DateTimeInterface) {
            return static::instance($var);
        }

        $date = null;

        if (is_string($var)) {
            $var = trim($var);
            $first = substr($var, 0, 1);

            if (is_string($var) && $first !== 'P' && $first !== 'R' && preg_match('/[a-z0-9]/i', $var)) {
                $date = static::parse($var);
            }
        }

        return $date;
    }

    /**
     * Set last errors.
     *
     * @param array $lastErrors
     *
     * @return void
     */
    private static function setLastErrors(array $lastErrors)
    {
        static::$lastErrors = $lastErrors;
    }

    /**
     * {@inheritdoc}
     */
    public static function getLastErrors()
    {
        return static::$lastErrors;
    }
}
