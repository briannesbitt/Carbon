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
use Carbon\CarbonInterval;
use Carbon\CarbonPeriod;
use Closure;
use DateTime;
use DateTimeImmutable;

/**
 * Trait Converter.
 *
 * Change date into different string formats and types and
 * handle the string cast.
 *
 * Depends on the following methods:
 *
 * @method Carbon|CarbonImmutable copy()
 */
trait Converter
{
    /**
     * Format to use for __toString method when type juggling occurs.
     *
     * @var string|Closure|null
     */
    protected static $toStringFormat = null;

    /**
     * Reset the format used to the default when type juggling a Carbon instance to a string
     *
     * @return void
     */
    public static function resetToStringFormat()
    {
        static::setToStringFormat(null);
    }

    /**
     * @deprecated To avoid conflict between different third-party libraries, static setters should not be used.
     *             You should rather let Carbon object being casted to string with DEFAULT_TO_STRING_FORMAT, and
     *             use other method or custom format passed to format() method if you need to dump an other string
     *             format.
     *
     * Set the default format used when type juggling a Carbon instance to a string
     *
     * @param string|Closure|null $format
     *
     * @return void
     */
    public static function setToStringFormat($format)
    {
        static::$toStringFormat = $format;
    }

    /**
     * Returns the formatted date string on success or FALSE on failure.
     *
     * @see https://php.net/manual/en/datetime.format.php
     *
     * @param string $format
     *
     * @return string
     */
    public function format($format)
    {
        $function = $this->localFormatFunction ?: static::$formatFunction;

        if (!$function) {
            return $this->rawFormat($format);
        }

        if (is_string($function) && method_exists($this, $function)) {
            $function = [$this, $function];
        }

        return $function(...func_get_args());
    }

    /**
     * @see https://php.net/manual/en/datetime.format.php
     *
     * @param string $format
     *
     * @return string
     */
    public function rawFormat($format)
    {
        return parent::format($format);
    }

    /**
     * Format the instance as a string using the set format
     *
     * @example
     * ```
     * echo Carbon::now(); // Carbon instances can be casted to string
     * ```
     *
     * @return string
     */
    public function __toString()
    {
        $format = $this->localToStringFormat ?? static::$toStringFormat;

        return $format instanceof Closure
            ? $format($this)
            : $this->rawFormat($format ?: (
                defined('static::DEFAULT_TO_STRING_FORMAT')
                    ? static::DEFAULT_TO_STRING_FORMAT
                    : CarbonInterface::DEFAULT_TO_STRING_FORMAT
            ));
    }

    /**
     * Format the instance as date
     *
     * @example
     * ```
     * echo Carbon::now()->toDateString();
     * ```
     *
     * @return string
     */
    public function toDateString()
    {
        return $this->rawFormat('Y-m-d');
    }

    /**
     * Format the instance as a readable date
     *
     * @example
     * ```
     * echo Carbon::now()->toFormattedDateString();
     * ```
     *
     * @return string
     */
    public function toFormattedDateString()
    {
        return $this->rawFormat('M j, Y');
    }

    /**
     * Format the instance as time
     *
     * @example
     * ```
     * echo Carbon::now()->toTimeString();
     * ```
     *
     * @return string
     */
    public function toTimeString()
    {
        return $this->rawFormat('H:i:s');
    }

    /**
     * Format the instance as date and time
     *
     * @example
     * ```
     * echo Carbon::now()->toDateTimeString();
     * ```
     *
     * @return string
     */
    public function toDateTimeString()
    {
        return $this->rawFormat('Y-m-d H:i:s');
    }

    /**
     * Format the instance as date and time T-separated with no timezone
     *
     * @example
     * ```
     * echo Carbon::now()->toDateTimeLocalString();
     * ```
     *
     * @return string
     */
    public function toDateTimeLocalString()
    {
        return $this->rawFormat('Y-m-d\TH:i:s');
    }

    /**
     * Format the instance with day, date and time
     *
     * @example
     * ```
     * echo Carbon::now()->toDayDateTimeString();
     * ```
     *
     * @return string
     */
    public function toDayDateTimeString()
    {
        return $this->rawFormat('D, M j, Y g:i A');
    }

    /**
     * Format the instance as ATOM
     *
     * @example
     * ```
     * echo Carbon::now()->toAtomString();
     * ```
     *
     * @return string
     */
    public function toAtomString()
    {
        return $this->rawFormat(DateTime::ATOM);
    }

    /**
     * Format the instance as COOKIE
     *
     * @example
     * ```
     * echo Carbon::now()->toCookieString();
     * ```
     *
     * @return string
     */
    public function toCookieString()
    {
        return $this->rawFormat(DateTime::COOKIE);
    }

    /**
     * Format the instance as ISO8601
     *
     * @example
     * ```
     * echo Carbon::now()->toIso8601String();
     * ```
     *
     * @return string
     */
    public function toIso8601String()
    {
        return $this->toAtomString();
    }

    /**
     * Format the instance as RFC822
     *
     * @example
     * ```
     * echo Carbon::now()->toRfc822String();
     * ```
     *
     * @return string
     */
    public function toRfc822String()
    {
        return $this->rawFormat(DateTime::RFC822);
    }

    /**
     * Convert the instance to UTC and return as Zulu ISO8601
     *
     * @example
     * ```
     * echo Carbon::now()->toIso8601ZuluString();
     * ```
     *
     * @return string
     */
    public function toIso8601ZuluString()
    {
        return $this->copy()->utc()->rawFormat('Y-m-d\TH:i:s\Z');
    }

    /**
     * Format the instance as RFC850
     *
     * @example
     * ```
     * echo Carbon::now()->toRfc850String();
     * ```
     *
     * @return string
     */
    public function toRfc850String()
    {
        return $this->rawFormat(DateTime::RFC850);
    }

    /**
     * Format the instance as RFC1036
     *
     * @example
     * ```
     * echo Carbon::now()->toRfc1036String();
     * ```
     *
     * @return string
     */
    public function toRfc1036String()
    {
        return $this->rawFormat(DateTime::RFC1036);
    }

    /**
     * Format the instance as RFC1123
     *
     * @example
     * ```
     * echo Carbon::now()->toRfc1123String();
     * ```
     *
     * @return string
     */
    public function toRfc1123String()
    {
        return $this->rawFormat(DateTime::RFC1123);
    }

    /**
     * Format the instance as RFC2822
     *
     * @example
     * ```
     * echo Carbon::now()->toRfc2822String();
     * ```
     *
     * @return string
     */
    public function toRfc2822String()
    {
        return $this->rawFormat(DateTime::RFC2822);
    }

    /**
     * Format the instance as RFC3339
     *
     * @example
     * ```
     * echo Carbon::now()->toRfc3339String();
     * ```
     *
     * @return string
     */
    public function toRfc3339String()
    {
        return $this->rawFormat(DateTime::RFC3339);
    }

    /**
     * Format the instance as RSS
     *
     * @example
     * ```
     * echo Carbon::now()->toRssString();
     * ```
     *
     * @return string
     */
    public function toRssString()
    {
        return $this->rawFormat(DateTime::RSS);
    }

    /**
     * Format the instance as W3C
     *
     * @example
     * ```
     * echo Carbon::now()->toW3cString();
     * ```
     *
     * @return string
     */
    public function toW3cString()
    {
        return $this->rawFormat(DateTime::W3C);
    }

    /**
     * Format the instance as RFC7231
     *
     * @example
     * ```
     * echo Carbon::now()->toRfc7231String();
     * ```
     *
     * @return string
     */
    public function toRfc7231String()
    {
        return $this->copy()
            ->setTimezone('GMT')
            ->rawFormat(defined('static::RFC7231_FORMAT') ? static::RFC7231_FORMAT : CarbonInterface::RFC7231_FORMAT);
    }

    /**
     * Get default array representation.
     *
     * @example
     * ```
     * var_dump(Carbon::now()->toArray());
     * ```
     *
     * @return array
     */
    public function toArray()
    {
        return [
            'year' => $this->year,
            'month' => $this->month,
            'day' => $this->day,
            'dayOfWeek' => $this->dayOfWeek,
            'dayOfYear' => $this->dayOfYear,
            'hour' => $this->hour,
            'minute' => $this->minute,
            'second' => $this->second,
            'micro' => $this->micro,
            'timestamp' => $this->timestamp,
            'formatted' => $this->rawFormat(defined('static::DEFAULT_TO_STRING_FORMAT') ? static::DEFAULT_TO_STRING_FORMAT : CarbonInterface::DEFAULT_TO_STRING_FORMAT),
            'timezone' => $this->timezone,
        ];
    }

    /**
     * Get default object representation.
     *
     * @example
     * ```
     * var_dump(Carbon::now()->toObject());
     * ```
     *
     * @return object
     */
    public function toObject()
    {
        return (object) $this->toArray();
    }

    /**
     * Returns english human readable complete date string.
     *
     * @example
     * ```
     * echo Carbon::now()->toString();
     * ```
     *
     * @return string
     */
    public function toString()
    {
        return $this->copy()->locale('en')->isoFormat('ddd MMM DD YYYY HH:mm:ss [GMT]ZZ');
    }

    /**
     * Return the ISO-8601 string (ex: 1977-04-22T06:00:00Z, if $keepOffset truthy, offset will be kept:
     * 1977-04-22T01:00:00-05:00).
     *
     * @example
     * ```
     * echo Carbon::now('America/Toronto')->toISOString() . "\n";
     * echo Carbon::now('America/Toronto')->toISOString(true) . "\n";
     * ```
     *
     * @param bool $keepOffset Pass true to keep the date offset. Else forced to UTC.
     *
     * @return null|string
     */
    public function toISOString($keepOffset = false)
    {
        if (!$this->isValid()) {
            return null;
        }

        $yearFormat = $this->year < 0 || $this->year > 9999 ? 'YYYYYY' : 'YYYY';
        $tzFormat = $keepOffset ? 'Z' : '[Z]';
        $date = $keepOffset ? $this : $this->copy()->utc();

        return $date->isoFormat("$yearFormat-MM-DD[T]HH:mm:ss.SSSSSS$tzFormat");
    }

    /**
     * Return the ISO-8601 string (ex: 1977-04-22T06:00:00Z) with UTC timezone.
     *
     * @example
     * ```
     * echo Carbon::now('America/Toronto')->toJSON();
     * ```
     *
     * @return null|string
     */
    public function toJSON()
    {
        return $this->toISOString();
    }

    /**
     * Return native DateTime PHP object matching the current instance.
     *
     * @example
     * ```
     * var_dump(Carbon::now()->toDateTime());
     * ```
     *
     * @return DateTime
     */
    public function toDateTime()
    {
        return new DateTime($this->rawFormat('Y-m-d H:i:s.u'), $this->getTimezone());
    }

    /**
     * Return native toDateTimeImmutable PHP object matching the current instance.
     *
     * @example
     * ```
     * var_dump(Carbon::now()->toDateTimeImmutable());
     * ```
     *
     * @return DateTimeImmutable
     */
    public function toDateTimeImmutable()
    {
        return new DateTimeImmutable($this->rawFormat('Y-m-d H:i:s.u'), $this->getTimezone());
    }

    /**
     * @alias toDateTime
     *
     * Return native DateTime PHP object matching the current instance.
     *
     * @example
     * ```
     * var_dump(Carbon::now()->toDate());
     * ```
     *
     * @return DateTime
     */
    public function toDate()
    {
        return $this->toDateTime();
    }

    /**
     * Create a iterable CarbonPeriod object from current date to a given end date (and optional interval).
     *
     * @param \DateTimeInterface|Carbon|CarbonImmutable|int|null $end      period end date or recurrences count if int
     * @param int|\DateInterval|string|null                      $interval period default interval or number of the given $unit
     * @param string|null                                        $unit     if specified, $interval must be an integer
     *
     * @return CarbonPeriod
     */
    public function toPeriod($end = null, $interval = null, $unit = null)
    {
        if ($unit) {
            $interval = CarbonInterval::make("$interval ".static::pluralUnit($unit));
        }

        $period = (new CarbonPeriod())->setDateClass(static::class)->setStartDate($this);

        if ($interval) {
            $period->setDateInterval($interval);
        }

        if (is_int($end) || is_string($end) && ctype_digit($end)) {
            $period->setRecurrences($end);
        } elseif ($end) {
            $period->setEndDate($end);
        }

        return $period;
    }

    /**
     * Create a iterable CarbonPeriod object from current date to a given end date (and optional interval).
     *
     * @param \DateTimeInterface|Carbon|CarbonImmutable|null $end      period end date
     * @param int|\DateInterval|string|null                  $interval period default interval or number of the given $unit
     * @param string|null                                    $unit     if specified, $interval must be an integer
     *
     * @return CarbonPeriod
     */
    public function range($end = null, $interval = null, $unit = null)
    {
        return $this->toPeriod($end, $interval, $unit);
    }
}
