<?php

namespace Carbon;

use DateTimeInterface;
use InvalidArgumentException;
use DateTimeZone;
use Symfony\Component\Translation\TranslatorInterface;
use Closure;


/**
 * A simple API extension for DateTimeInterface
 *
 * @property      integer $year
 * @property      integer $yearIso
 * @property      integer $month
 * @property      integer $day
 * @property      integer $hour
 * @property      integer $minute
 * @property      integer $second
 * @property      integer $timestamp seconds since the Unix Epoch
 * @property      DateTimeZone $timezone the current timezone
 * @property      DateTimeZone $tz alias of timezone
 * @property-read integer $micro
 * @property-read integer $dayOfWeek 0 (for Sunday) through 6 (for Saturday)
 * @property-read integer $dayOfYear 0 through 365
 * @property-read integer $weekOfMonth 1 through 5
 * @property-read integer $weekOfYear ISO-8601 week number of year, weeks starting on Monday
 * @property-read integer $daysInMonth number of days in the given month
 * @property-read integer $age does a diffInYears() with default parameters
 * @property-read integer $quarter the quarter of this instance, 1 - 4
 * @property-read integer $offset the timezone offset in seconds from UTC
 * @property-read integer $offsetHours the timezone offset in hours from UTC
 * @property-read boolean $dst daylight savings time indicator, true if DST, false otherwise
 * @property-read boolean $local checks if the timezone is local, true if local, false otherwise
 * @property-read boolean $utc checks if the timezone is UTC, true if UTC, false otherwise
 * @property-read string  $timezoneName
 * @property-read string  $tzName
 */
interface CarbonInterface extends DateTimeInterface
{

    /**
     * The day constants
     */
    const SUNDAY = 0;
    const MONDAY = 1;
    const TUESDAY = 2;
    const WEDNESDAY = 3;
    const THURSDAY = 4;
    const FRIDAY = 5;
    const SATURDAY = 6;

    /**
     * Number of X in Y
     */
    const YEARS_PER_CENTURY  = 100;
    const YEARS_PER_DECADE   = 10;
    const MONTHS_PER_YEAR    = 12;
    const WEEKS_PER_YEAR     = 52;
    const DAYS_PER_WEEK      = 7;
    const HOURS_PER_DAY      = 24;
    const MINUTES_PER_HOUR   = 60;
    const SECONDS_PER_MINUTE = 60;

    /**
     * Default format to use for __toString method when type juggling occurs.
     *
     * @var string
     */
    const DEFAULT_TO_STRING_FORMAT = 'Y-m-d H:i:s';

    /**
     * Create a CarbonInterface instance from a DateTimeInterface one
     *
     * @param DateTimeInterface $dt
     *
     * @return static
     */
    public static function instance(DateTimeInterface $dt);

    /**
     * Create a CarbonInterface instance from a string.  This is an alias for the
     * constructor that allows better fluent syntax as it allows you to do
     * CarbonInterface::parse('Monday next week')->fn() rather than
     * (new Carbon('Monday next week'))->fn()
     *
     * @param string $time
     * @param DateTimeZone|string $tz
     *
     * @return static
     */
    public static function parse($time = null, $tz = null);

    /**
     * Get a CarbonInterface instance for the current date and time
     *
     * @param DateTimeZone|string $tz
     *
     * @return static
     */
    public static function now($tz = null);

    /**
     * Create a CarbonInterface instance for today
     *
     * @param DateTimeZone|string $tz
     *
     * @return static
     */
    public static function today($tz = null);

    /**
     * Create a CarbonInterface instance for tomorrow
     *
     * @param DateTimeZone|string $tz
     *
     * @return static
     */
    public static function tomorrow($tz = null);

    /**
     * Create a CarbonInterface instance for yesterday
     *
     * @param DateTimeZone|string $tz
     *
     * @return static
     */
    public static function yesterday($tz = null);

    /**
     * Create a CarbonInterface instance for the greatest supported date.
     *
     * @return Carbon
     */
    public static function maxValue();

    /**
     * Create a CarbonInterface instance for the lowest supported date.
     *
     * @return Carbon
     */
    public static function minValue();

    /**
     * Create a new CarbonInterface instance from a specific date and time.
     *
     * If any of $year, $month or $day are set to null their now() values
     * will be used.
     *
     * If $hour is null it will be set to its now() value and the default values
     * for $minute and $second will be their now() values.
     * If $hour is not null then the default values for $minute and $second
     * will be 0.
     *
     * @param integer $year
     * @param integer $month
     * @param integer $day
     * @param integer $hour
     * @param integer $minute
     * @param integer $second
     * @param DateTimeZone|string $tz
     *
     * @return static
     */
    public static function create(
        $year = null,
        $month = null,
        $day = null,
        $hour = null,
        $minute = null,
        $second = null,
        $tz = null
    );

    /**
     * Create a CarbonInterface instance from just a date. The time portion is set to now.
     *
     * @param integer $year
     * @param integer $month
     * @param integer $day
     * @param DateTimeZone|string $tz
     *
     * @return static
     */
    public static function createFromDate($year = null, $month = null, $day = null, $tz = null);

    /**
     * Create a CarbonInterface instance from just a time. The date portion is set to today.
     *
     * @param integer $hour
     * @param integer $minute
     * @param integer $second
     * @param DateTimeZone|string $tz
     *
     * @return static
     */
    public static function createFromTime($hour = null, $minute = null, $second = null, $tz = null);

    /**
     * Create a CarbonInterface instance from a specific format
     *
     * @param string $format
     * @param string $time
     * @param DateTimeZone|string $tz
     *
     * @return static
     *
     * @throws InvalidArgumentException
     */
    public static function createFromFormat($format, $time, $tz = null);

    /**
     * Create a CarbonInterface instance from a timestamp
     *
     * @param integer $timestamp
     * @param DateTimeZone|string $tz
     *
     * @return static
     */
    public static function createFromTimestamp($timestamp, $tz = null);

    /**
     * Create a CarbonInterface instance from an UTC timestamp
     *
     * @param integer $timestamp
     *
     * @return static
     */
    public static function createFromTimestampUTC($timestamp);

    /**
     * Get a copy of the instance
     *
     * @return static
     */
    public function copy();

    /**
     * Set the instance's year
     *
     * @param integer $value
     *
     * @return static
     */
    public function year($value);

    /**
     * Set the instance's month
     *
     * @param integer $value
     *
     * @return static
     */
    public function month($value);

    /**
     * Set the instance's day
     *
     * @param integer $value
     *
     * @return static
     */
    public function day($value);

    /**
     * Set the instance's hour
     *
     * @param integer $value
     *
     * @return static
     */
    public function hour($value);

    /**
     * Set the instance's minute
     *
     * @param integer $value
     *
     * @return static
     */
    public function minute($value);

    /**
     * Set the instance's second
     *
     * @param integer $value
     *
     * @return static
     */
    public function second($value);

    /**
     * Set the date and time all together
     *
     * @param integer $year
     * @param integer $month
     * @param integer $day
     * @param integer $hour
     * @param integer $minute
     * @param integer $second
     *
     * @return static
     */
    public function setDateTime($year, $month, $day, $hour, $minute, $second = 0);

    /**
     * Set the instance's timestamp
     *
     * @param integer $value
     *
     * @return static
     */
    public function timestamp($value);

    /**
     * Alias for setTimezone()
     *
     * @param DateTimeZone|string $value
     *
     * @return static
     */
    public function timezone($value);

    /**
     * Alias for setTimezone()
     *
     * @param DateTimeZone|string $value
     *
     * @return static
     */
    public function tz($value);

    /**
     * Set the instance's timezone from a string or object
     *
     * @param DateTimeZone|string $value
     *
     * @return static
     */
    public function setTimezone($value);

    /**
     * Get the first day of week
     *
     * @return int
     */
    public static function getWeekStartsAt();

    /**
     * Set the first day of week
     *
     * @param int
     */
    public static function setWeekStartsAt($day);

    /**
     * Get the last day of week
     *
     * @return int
     */
    public static function getWeekEndsAt();

    /**
     * Set the first day of week
     *
     * @param int
     */
    public static function setWeekEndsAt($day);

    /**
     * Get weekend days
     *
     * @return array
     */
    public static function getWeekendDays();

    /**
     * Set weekend days
     *
     * @param array
     */
    public static function setWeekendDays($days);

    /**
     * Set a CarbonInterface instance (real or mock) to be returned when a "now"
     * instance is created.  The provided instance will be returned
     * specifically under the following conditions:
     *   - A call to the static now() method, ex. CarbonInterface::now()
     *   - When a null (or blank string) is passed to the constructor or parse(), ex. new Carbon(null)
     *   - When the string "now" is passed to the constructor or parse(), ex. new Carbon('now')
     *
     * Note the timezone parameter was left out of the examples above and
     * has no affect as the mock value will be returned regardless of its value.
     *
     * To clear the test instance call this method using the default
     * parameter of null.
     *
     * @param CarbonInterface $testNow
     */
    public static function setTestNow(CarbonInterface $testNow = null);

    /**
     * Get the CarbonInterface instance (real or mock) to be returned when a "now"
     * instance is created.
     *
     * @return static the current instance used for testing
     */
    public static function getTestNow();

    /**
     * Determine if there is a valid test instance set. A valid test instance
     * is anything that is not null.
     *
     * @return boolean true if there is a test instance, otherwise false
     */
    public static function hasTestNow();

    /**
     * Determine if there is a relative keyword in the time string, this is to
     * create dates relative to now for test instances. e.g.: next tuesday
     *
     * @param string $time
     *
     * @return boolean true if there is a keyword, otherwise false
     */
    public static function hasRelativeKeywords($time);

    /**
     * Get the translator instance in use
     *
     * @return TranslatorInterface
     */
    public static function getTranslator();

    /**
     * Set the translator instance to use
     *
     * @param TranslatorInterface $translator
     */
    public static function setTranslator(TranslatorInterface $translator);

    /**
     * Get the current translator locale
     *
     * @return string
     */
    public static function getLocale();

    /**
     * Set the current translator locale
     *
     * @param string $locale
     */
    public static function setLocale($locale);

    /**
     * Format the instance with the current locale.  You can set the current
     * locale using setlocale() http://php.net/setlocale.
     *
     * @param string $format
     *
     * @return string
     */
    public function formatLocalized($format);

    /**
     * Reset the format used to the default when type juggling a CarbonInterface instance to a string
     *
     */
    public static function resetToStringFormat();

    /**
     * Set the default format used when type juggling a CarbonInterface instance to a string
     *
     * @param string $format
     */
    public static function setToStringFormat($format);

    /**
     * Format the instance as date
     *
     * @return string
     */
    public function toDateString();

    /**
     * Format the instance as a readable date
     *
     * @return string
     */
    public function toFormattedDateString();

    /**
     * Format the instance as time
     *
     * @return string
     */
    public function toTimeString();

    /**
     * Format the instance as date and time
     *
     * @return string
     */
    public function toDateTimeString();

    /**
     * Format the instance with day, date and time
     *
     * @return string
     */
    public function toDayDateTimeString();

    /**
     * Format the instance as ATOM
     *
     * @return string
     */
    public function toAtomString();

    /**
     * Format the instance as COOKIE
     *
     * @return string
     */
    public function toCookieString();

    /**
     * Format the instance as ISO8601
     *
     * @return string
     */
    public function toIso8601String();

    /**
     * Format the instance as RFC822
     *
     * @return string
     */
    public function toRfc822String();

    /**
     * Format the instance as RFC850
     *
     * @return string
     */
    public function toRfc850String();

    /**
     * Format the instance as RFC1036
     *
     * @return string
     */
    public function toRfc1036String();

    /**
     * Format the instance as RFC1123
     *
     * @return string
     */
    public function toRfc1123String();

    /**
     * Format the instance as RFC2822
     *
     * @return string
     */
    public function toRfc2822String();

    /**
     * Format the instance as RFC3339
     *
     * @return string
     */
    public function toRfc3339String();

    /**
     * Format the instance as RSS
     *
     * @return string
     */
    public function toRssString();

    /**
     * Format the instance as W3C
     *
     * @return string
     */
    public function toW3cString();

    /**
     * Determines if the instance is equal to another
     *
     * @param CarbonInterface $dt
     *
     * @return boolean
     */
    public function eq(CarbonInterface $dt);

    /**
     * Determines if the instance is not equal to another
     *
     * @param CarbonInterface $dt
     *
     * @return boolean
     */
    public function ne(CarbonInterface $dt);

    /**
     * Determines if the instance is greater (after) than another
     *
     * @param CarbonInterface $dt
     *
     * @return boolean
     */
    public function gt(CarbonInterface $dt);

    /**
     * Determines if the instance is greater (after) than or equal to another
     *
     * @param CarbonInterface $dt
     *
     * @return boolean
     */
    public function gte(CarbonInterface $dt);

    /**
     * Determines if the instance is less (before) than another
     *
     * @param CarbonInterface $dt
     *
     * @return boolean
     */
    public function lt(CarbonInterface $dt);

    /**
     * Determines if the instance is less (before) or equal to another
     *
     * @param CarbonInterface $dt
     *
     * @return boolean
     */
    public function lte(CarbonInterface $dt);

    /**
     * Determines if the instance is between two others
     *
     * @param  CarbonInterface $dt1
     * @param  CarbonInterface $dt2
     * @param  boolean $equal Indicates if a > and < comparison should be used or <= or >=
     *
     * @return boolean
     */
    public function between(CarbonInterface $dt1, CarbonInterface $dt2, $equal = true);

    /**
     * Get the minimum instance between a given instance (default now) and the current instance.
     *
     * @param CarbonInterface $dt
     *
     * @return static
     */
    public function min(CarbonInterface $dt = null);

    /**
     * Get the maximum instance between a given instance (default now) and the current instance.
     *
     * @param CarbonInterface $dt
     *
     * @return static
     */
    public function max(CarbonInterface $dt = null);

    /**
     * Determines if the instance is a weekday
     *
     * @return boolean
     */
    public function isWeekday();

    /**
     * Determines if the instance is a weekend day
     *
     * @return boolean
     */
    public function isWeekend();

    /**
     * Determines if the instance is yesterday
     *
     * @return boolean
     */
    public function isYesterday();

    /**
     * Determines if the instance is today
     *
     * @return boolean
     */
    public function isToday();

    /**
     * Determines if the instance is tomorrow
     *
     * @return boolean
     */
    public function isTomorrow();

    /**
     * Determines if the instance is in the future, ie. greater (after) than now
     *
     * @return boolean
     */
    public function isFuture();

    /**
     * Determines if the instance is in the past, ie. less (before) than now
     *
     * @return boolean
     */
    public function isPast();

    /**
     * Determines if the instance is a leap year
     *
     * @return boolean
     */
    public function isLeapYear();

    /**
     * Checks if the passed in date is the same day as the instance current day.
     *
     * @param  CarbonInterface $dt
     * @return boolean
     */
    public function isSameDay(CarbonInterface $dt);

    /**
     * Checks if this day is a Sunday.
     *
     * @return boolean
     */
    public function isSunday();

    /**
     * Checks if this day is a Monday.
     *
     * @return boolean
     */
    public function isMonday();

    /**
     * Checks if this day is a Tuesday.
     *
     * @return boolean
     */
    public function isTuesday();

    /**
     * Checks if this day is a Wednesday.
     *
     * @return boolean
     */
    public function isWednesday();

    /**
     * Checks if this day is a Thursday.
     *
     * @return boolean
     */
    public function isThursday();

    /**
     * Checks if this day is a Friday.
     *
     * @return boolean
     */
    public function isFriday();

    /**
     * Checks if this day is a Saturday.
     *
     * @return boolean
     */
    public function isSaturday();

    /**
     * Add years to the instance. Positive $value travel forward while
     * negative $value travel into the past.
     *
     * @param integer $value
     *
     * @return static
     */
    public function addYears($value);

    /**
     * Add a year to the instance
     *
     * @param integer $value
     *
     * @return static
     */
    public function addYear($value = 1);

    /**
     * Remove a year from the instance
     *
     * @param integer $value
     *
     * @return static
     */
    public function subYear($value = 1);

    /**
     * Remove years from the instance.
     *
     * @param integer $value
     *
     * @return static
     */
    public function subYears($value);

    /**
     * Add months to the instance. Positive $value travels forward while
     * negative $value travels into the past.
     *
     * @param integer $value
     *
     * @return static
     */
    public function addMonths($value);

    /**
     * Add a month to the instance
     *
     * @param integer $value
     *
     * @return static
     */
    public function addMonth($value = 1);

    /**
     * Remove a month from the instance
     *
     * @param integer $value
     *
     * @return static
     */
    public function subMonth($value = 1);

    /**
     * Remove months from the instance
     *
     * @param integer $value
     *
     * @return static
     */
    public function subMonths($value);

    /**
     * Add months without overflowing to the instance. Positive $value
     * travels forward while negative $value travels into the past.
     *
     * @param integer $value
     *
     * @return static
     */
    public function addMonthsNoOverflow($value);

    /**
     * Add a month with no overflow to the instance
     *
     * @param integer $value
     *
     * @return static
     */
    public function addMonthNoOverflow($value = 1);

    /**
     * Remove a month with no overflow from the instance
     *
     * @param integer $value
     *
     * @return static
     */
    public function subMonthNoOverflow($value = 1);

    /**
     * Remove months with no overflow from the instance
     *
     * @param integer $value
     *
     * @return static
     */
    public function subMonthsNoOverflow($value);

    /**
     * Add days to the instance. Positive $value travels forward while
     * negative $value travels into the past.
     *
     * @param integer $value
     *
     * @return static
     */
    public function addDays($value);

    /**
     * Add a day to the instance
     *
     * @param integer $value
     *
     * @return static
     */
    public function addDay($value = 1);

    /**
     * Remove a day from the instance
     *
     * @param integer $value
     *
     * @return static
     */
    public function subDay($value = 1);

    /**
     * Remove days from the instance
     *
     * @param integer $value
     *
     * @return static
     */
    public function subDays($value);

    /**
     * Add weekdays to the instance. Positive $value travels forward while
     * negative $value travels into the past.
     *
     * @param integer $value
     *
     * @return static
     */
    public function addWeekdays($value);

    /**
     * Add a weekday to the instance
     *
     * @param integer $value
     *
     * @return static
     */
    public function addWeekday($value = 1);

    /**
     * Remove a weekday from the instance
     *
     * @param integer $value
     *
     * @return static
     */
    public function subWeekday($value = 1);

    /**
     * Remove weekdays from the instance
     *
     * @param integer $value
     *
     * @return static
     */
    public function subWeekdays($value);

    /**
     * Add weeks to the instance. Positive $value travels forward while
     * negative $value travels into the past.
     *
     * @param integer $value
     *
     * @return static
     */
    public function addWeeks($value);

    /**
     * Add a week to the instance
     *
     * @param integer $value
     *
     * @return static
     */
    public function addWeek($value = 1);

    /**
     * Remove a week from the instance
     *
     * @param integer $value
     *
     * @return static
     */
    public function subWeek($value = 1);

    /**
     * Remove weeks to the instance
     *
     * @param integer $value
     *
     * @return static
     */
    public function subWeeks($value);

    /**
     * Add hours to the instance. Positive $value travels forward while
     * negative $value travels into the past.
     *
     * @param integer $value
     *
     * @return static
     */
    public function addHours($value);

    /**
     * Add an hour to the instance
     *
     * @param integer $value
     *
     * @return static
     */
    public function addHour($value = 1);

    /**
     * Remove an hour from the instance
     *
     * @param integer $value
     *
     * @return static
     */
    public function subHour($value = 1);

    /**
     * Remove hours from the instance
     *
     * @param integer $value
     *
     * @return static
     */
    public function subHours($value);

    /**
     * Add minutes to the instance. Positive $value travels forward while
     * negative $value travels into the past.
     *
     * @param integer $value
     *
     * @return static
     */
    public function addMinutes($value);

    /**
     * Add a minute to the instance
     *
     * @param integer $value
     *
     * @return static
     */
    public function addMinute($value = 1);

    /**
     * Remove a minute from the instance
     *
     * @param integer $value
     *
     * @return static
     */
    public function subMinute($value = 1);

    /**
     * Remove minutes from the instance
     *
     * @param integer $value
     *
     * @return static
     */
    public function subMinutes($value);

    /**
     * Add seconds to the instance. Positive $value travels forward while
     * negative $value travels into the past.
     *
     * @param integer $value
     *
     * @return static
     */
    public function addSeconds($value);

    /**
     * Add a second to the instance
     *
     * @param integer $value
     *
     * @return static
     */
    public function addSecond($value = 1);

    /**
     * Remove a second from the instance
     *
     * @param integer $value
     *
     * @return static
     */
    public function subSecond($value = 1);

    /**
     * Remove seconds from the instance
     *
     * @param integer $value
     *
     * @return static
     */
    public function subSeconds($value);

    /**
     * Get the difference in years
     *
     * @param CarbonInterface $dt
     * @param boolean $abs Get the absolute of the difference
     *
     * @return integer
     */
    public function diffInYears(CarbonInterface $dt = null, $abs = true);

    /**
     * Get the difference in months
     *
     * @param CarbonInterface $dt
     * @param boolean $abs Get the absolute of the difference
     *
     * @return integer
     */
    public function diffInMonths(CarbonInterface $dt = null, $abs = true);

    /**
     * Get the difference in weeks
     *
     * @param CarbonInterface $dt
     * @param boolean $abs Get the absolute of the difference
     *
     * @return integer
     */
    public function diffInWeeks(CarbonInterface $dt = null, $abs = true);

    /**
     * Get the difference in days
     *
     * @param CarbonInterface $dt
     * @param boolean $abs Get the absolute of the difference
     *
     * @return integer
     */
    public function diffInDays(CarbonInterface $dt = null, $abs = true);

    /**
     * Get the difference in days using a filter closure
     *
     * @param Closure $callback
     * @param CarbonInterface $dt
     * @param boolean $abs Get the absolute of the difference
     *
     * @return int
     */
    public function diffInDaysFiltered(Closure $callback, CarbonInterface $dt = null, $abs = true);

    /**
     * Get the difference in hours using a filter closure
     *
     * @param Closure $callback
     * @param CarbonInterface $dt
     * @param boolean $abs Get the absolute of the difference
     *
     * @return int
     */
    public function diffInHoursFiltered(Closure $callback, CarbonInterface $dt = null, $abs = true);

    /**
     * Get the difference by the given interval using a filter closure
     *
     * @param CarbonInterval $ci An interval to traverse by
     * @param Closure $callback
     * @param CarbonInterface $dt
     * @param boolean $abs Get the absolute of the difference
     *
     * @return int
     */
    public function diffFiltered(CarbonInterval $ci, Closure $callback, CarbonInterface $dt = null, $abs = true);

    /**
     * Get the difference in weekdays
     *
     * @param CarbonInterface $dt
     * @param boolean $abs Get the absolute of the difference
     *
     * @return int
     */
    public function diffInWeekdays(CarbonInterface $dt = null, $abs = true);

    /**
     * Get the difference in weekend days using a filter
     *
     * @param CarbonInterface $dt
     * @param boolean $abs Get the absolute of the difference
     *
     * @return int
     */
    public function diffInWeekendDays(CarbonInterface $dt = null, $abs = true);

    /**
     * Get the difference in hours
     *
     * @param CarbonInterface $dt
     * @param boolean $abs Get the absolute of the difference
     *
     * @return integer
     */
    public function diffInHours(CarbonInterface $dt = null, $abs = true);

    /**
     * Get the difference in minutes
     *
     * @param CarbonInterface $dt
     * @param boolean $abs Get the absolute of the difference
     *
     * @return integer
     */
    public function diffInMinutes(CarbonInterface $dt = null, $abs = true);

    /**
     * Get the difference in seconds
     *
     * @param CarbonInterface $dt
     * @param boolean $abs Get the absolute of the difference
     *
     * @return integer
     */
    public function diffInSeconds(CarbonInterface $dt = null, $abs = true);

    /**
     * The number of seconds since midnight.
     *
     * @return integer
     */
    public function secondsSinceMidnight();

    /**
     * The number of seconds until 23:23:59.
     *
     * @return integer
     */
    public function secondsUntilEndOfDay();

    /**
     * Get the difference in a human readable format in the current locale.
     *
     * When comparing a value in the past to default now:
     * 1 hour ago
     * 5 months ago
     *
     * When comparing a value in the future to default now:
     * 1 hour from now
     * 5 months from now
     *
     * When comparing a value in the past to another value:
     * 1 hour before
     * 5 months before
     *
     * When comparing a value in the future to another value:
     * 1 hour after
     * 5 months after
     *
     * @param CarbonInterface $other
     * @param bool $absolute removes time difference modifiers ago, after, etc
     *
     * @return string
     */
    public function diffForHumans(CarbonInterface $other = null, $absolute = false);

    /**
     * Resets the time to 00:00:00
     *
     * @return static
     */
    public function startOfDay();

    /**
     * Resets the time to 23:59:59
     *
     * @return static
     */
    public function endOfDay();

    /**
     * Resets the date to the first day of the month and the time to 00:00:00
     *
     * @return static
     */
    public function startOfMonth();

    /**
     * Resets the date to end of the month and time to 23:59:59
     *
     * @return static
     */
    public function endOfMonth();

    /**
     * Resets the date to the first day of the year and the time to 00:00:00
     *
     * @return static
     */
    public function startOfYear();

    /**
     * Resets the date to end of the year and time to 23:59:59
     *
     * @return static
     */
    public function endOfYear();

    /**
     * Resets the date to the first day of the decade and the time to 00:00:00
     *
     * @return static
     */
    public function startOfDecade();

    /**
     * Resets the date to end of the decade and time to 23:59:59
     *
     * @return static
     */
    public function endOfDecade();

    /**
     * Resets the date to the first day of the century and the time to 00:00:00
     *
     * @return static
     */
    public function startOfCentury();

    /**
     * Resets the date to end of the century and time to 23:59:59
     *
     * @return static
     */
    public function endOfCentury();

    /**
     * Resets the date to the first day of week (defined in $weekStartsAt) and the time to 00:00:00
     *
     * @return static
     */
    public function startOfWeek();

    /**
     * Resets the date to end of week (defined in $weekEndsAt) and time to 23:59:59
     *
     * @return static
     */
    public function endOfWeek();

    /**
     * Modify to the next occurrence of a given day of the week.
     * If no dayOfWeek is provided, modify to the next occurrence
     * of the current day of the week.  Use the supplied consts
     * to indicate the desired dayOfWeek, ex. static::MONDAY.
     *
     * @param int $dayOfWeek
     *
     * @return mixed
     */
    public function next($dayOfWeek = null);

    /**
     * Modify to the previous occurrence of a given day of the week.
     * If no dayOfWeek is provided, modify to the previous occurrence
     * of the current day of the week.  Use the supplied consts
     * to indicate the desired dayOfWeek, ex. static::MONDAY.
     *
     * @param int $dayOfWeek
     *
     * @return mixed
     */
    public function previous($dayOfWeek = null);

    /**
     * Modify to the first occurrence of a given day of the week
     * in the current month. If no dayOfWeek is provided, modify to the
     * first day of the current month.  Use the supplied consts
     * to indicate the desired dayOfWeek, ex. static::MONDAY.
     *
     * @param int $dayOfWeek
     *
     * @return mixed
     */
    public function firstOfMonth($dayOfWeek = null);

    /**
     * Modify to the last occurrence of a given day of the week
     * in the current month. If no dayOfWeek is provided, modify to the
     * last day of the current month.  Use the supplied consts
     * to indicate the desired dayOfWeek, ex. static::MONDAY.
     *
     * @param int $dayOfWeek
     *
     * @return mixed
     */
    public function lastOfMonth($dayOfWeek = null);

    /**
     * Modify to the given occurrence of a given day of the week
     * in the current month. If the calculated occurrence is outside the scope
     * of the current month, then return false and no modifications are made.
     * Use the supplied consts to indicate the desired dayOfWeek, ex. static::MONDAY.
     *
     * @param int $nth
     * @param int $dayOfWeek
     *
     * @return mixed
     */
    public function nthOfMonth($nth, $dayOfWeek);

    /**
     * Modify to the first occurrence of a given day of the week
     * in the current quarter. If no dayOfWeek is provided, modify to the
     * first day of the current quarter.  Use the supplied consts
     * to indicate the desired dayOfWeek, ex. static::MONDAY.
     *
     * @param int $dayOfWeek
     *
     * @return mixed
     */
    public function firstOfQuarter($dayOfWeek = null);

    /**
     * Modify to the last occurrence of a given day of the week
     * in the current quarter. If no dayOfWeek is provided, modify to the
     * last day of the current quarter.  Use the supplied consts
     * to indicate the desired dayOfWeek, ex. static::MONDAY.
     *
     * @param int $dayOfWeek
     *
     * @return mixed
     */
    public function lastOfQuarter($dayOfWeek = null);

    /**
     * Modify to the given occurrence of a given day of the week
     * in the current quarter. If the calculated occurrence is outside the scope
     * of the current quarter, then return false and no modifications are made.
     * Use the supplied consts to indicate the desired dayOfWeek, ex. static::MONDAY.
     *
     * @param int $nth
     * @param int $dayOfWeek
     *
     * @return mixed
     */
    public function nthOfQuarter($nth, $dayOfWeek);

    /**
     * Modify to the first occurrence of a given day of the week
     * in the current year. If no dayOfWeek is provided, modify to the
     * first day of the current year.  Use the supplied consts
     * to indicate the desired dayOfWeek, ex. static::MONDAY.
     *
     * @param int $dayOfWeek
     *
     * @return mixed
     */
    public function firstOfYear($dayOfWeek = null);

    /**
     * Modify to the last occurrence of a given day of the week
     * in the current year. If no dayOfWeek is provided, modify to the
     * last day of the current year.  Use the supplied consts
     * to indicate the desired dayOfWeek, ex. static::MONDAY.
     *
     * @param int $dayOfWeek
     *
     * @return mixed
     */
    public function lastOfYear($dayOfWeek = null);

    /**
     * Modify to the given occurrence of a given day of the week
     * in the current year. If the calculated occurrence is outside the scope
     * of the current year, then return false and no modifications are made.
     * Use the supplied consts to indicate the desired dayOfWeek, ex. static::MONDAY.
     *
     * @param int $nth
     * @param int $dayOfWeek
     *
     * @return mixed
     */
    public function nthOfYear($nth, $dayOfWeek);

    /**
     * Modify the current instance to the average of a given instance (default now) and the current instance.
     *
     * @param CarbonInterface $dt
     *
     * @return static
     */
    public function average(CarbonInterface $dt = null);

    /**
     * Check if its the birthday. Compares the date/month values of the two dates.
     *
     * @param CarbonInterface $dt
     *
     * @return boolean
     */
    public function isBirthday(CarbonInterface $dt);
}
