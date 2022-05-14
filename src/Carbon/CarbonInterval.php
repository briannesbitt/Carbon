<?php

/**
 * This file is part of the Carbon package.
 *
 * (c) Brian Nesbitt <brian@nesbot.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Carbon;

use Carbon\Exceptions\BadFluentConstructorException;
use Carbon\Exceptions\BadFluentSetterException;
use Carbon\Exceptions\InvalidCastException;
use Carbon\Exceptions\InvalidIntervalException;
use Carbon\Exceptions\ParseErrorException;
use Carbon\Exceptions\UnitNotConfiguredException;
use Carbon\Exceptions\UnknownGetterException;
use Carbon\Exceptions\UnknownSetterException;
use Carbon\Exceptions\UnknownUnitException;
use Carbon\Traits\IntervalRounding;
use Carbon\Traits\IntervalStep;
use Carbon\Traits\Mixin;
use Carbon\Traits\Options;
use Closure;
use DateInterval;
use DateTimeInterface;
use DateTimeZone;
use Exception;
use ReflectionException;
use ReturnTypeWillChange;
use Throwable;

/**
 * A simple API extension for DateInterval.
 * The implementation provides helpers to handle weeks but only days are saved.
 * Weeks are calculated based on the total days of the current instance.
 *
 * @property int $years Total years of the current interval.
 * @property int $months Total months of the current interval.
 * @property int $weeks Total weeks of the current interval calculated from the days.
 * @property int $dayz Total days of the current interval (weeks * 7 + days).
 * @property int $hours Total hours of the current interval.
 * @property int $minutes Total minutes of the current interval.
 * @property int $seconds Total seconds of the current interval.
 * @property int $microseconds Total microseconds of the current interval.
 * @property int $milliseconds Total microseconds of the current interval.
 * @property int $microExcludeMilli Remaining microseconds without the milliseconds.
 * @property int $dayzExcludeWeeks Total days remaining in the final week of the current instance (days % 7).
 * @property int $daysExcludeWeeks alias of dayzExcludeWeeks
 * @property-read float $totalYears Number of years equivalent to the interval.
 * @property-read float $totalMonths Number of months equivalent to the interval.
 * @property-read float $totalWeeks Number of weeks equivalent to the interval.
 * @property-read float $totalDays Number of days equivalent to the interval.
 * @property-read float $totalDayz Alias for totalDays.
 * @property-read float $totalHours Number of hours equivalent to the interval.
 * @property-read float $totalMinutes Number of minutes equivalent to the interval.
 * @property-read float $totalSeconds Number of seconds equivalent to the interval.
 * @property-read float $totalMilliseconds Number of milliseconds equivalent to the interval.
 * @property-read float $totalMicroseconds Number of microseconds equivalent to the interval.
 * @property-read string $locale locale of the current instance
 *
 * @method static CarbonInterval years($years = 1) Create instance specifying a number of years or modify the number of years if called on an instance.
 * @method static CarbonInterval year($years = 1) Alias for years()
 * @method static CarbonInterval months($months = 1) Create instance specifying a number of months or modify the number of months if called on an instance.
 * @method static CarbonInterval month($months = 1) Alias for months()
 * @method static CarbonInterval weeks($weeks = 1) Create instance specifying a number of weeks or modify the number of weeks if called on an instance.
 * @method static CarbonInterval week($weeks = 1) Alias for weeks()
 * @method static CarbonInterval days($days = 1) Create instance specifying a number of days or modify the number of days if called on an instance.
 * @method static CarbonInterval dayz($days = 1) Alias for days()
 * @method static CarbonInterval daysExcludeWeeks($days = 1) Create instance specifying a number of days or modify the number of days (keeping the current number of weeks) if called on an instance.
 * @method static CarbonInterval dayzExcludeWeeks($days = 1) Alias for daysExcludeWeeks()
 * @method static CarbonInterval day($days = 1) Alias for days()
 * @method static CarbonInterval hours($hours = 1) Create instance specifying a number of hours or modify the number of hours if called on an instance.
 * @method static CarbonInterval hour($hours = 1) Alias for hours()
 * @method static CarbonInterval minutes($minutes = 1) Create instance specifying a number of minutes or modify the number of minutes if called on an instance.
 * @method static CarbonInterval minute($minutes = 1) Alias for minutes()
 * @method static CarbonInterval seconds($seconds = 1) Create instance specifying a number of seconds or modify the number of seconds if called on an instance.
 * @method static CarbonInterval second($seconds = 1) Alias for seconds()
 * @method static CarbonInterval milliseconds($milliseconds = 1) Create instance specifying a number of milliseconds or modify the number of milliseconds if called on an instance.
 * @method static CarbonInterval millisecond($milliseconds = 1) Alias for milliseconds()
 * @method static CarbonInterval microseconds($microseconds = 1) Create instance specifying a number of microseconds or modify the number of microseconds if called on an instance.
 * @method static CarbonInterval microsecond($microseconds = 1) Alias for microseconds()
 * @method $this addYears(int $years) Add given number of years to the current interval
 * @method $this subYears(int $years) Subtract given number of years to the current interval
 * @method $this addMonths(int $months) Add given number of months to the current interval
 * @method $this subMonths(int $months) Subtract given number of months to the current interval
 * @method $this addWeeks(int|float $weeks) Add given number of weeks to the current interval
 * @method $this subWeeks(int|float $weeks) Subtract given number of weeks to the current interval
 * @method $this addDays(int|float $days) Add given number of days to the current interval
 * @method $this subDays(int|float $days) Subtract given number of days to the current interval
 * @method $this addHours(int|float $hours) Add given number of hours to the current interval
 * @method $this subHours(int|float $hours) Subtract given number of hours to the current interval
 * @method $this addMinutes(int|float $minutes) Add given number of minutes to the current interval
 * @method $this subMinutes(int|float $minutes) Subtract given number of minutes to the current interval
 * @method $this addSeconds(int|float $seconds) Add given number of seconds to the current interval
 * @method $this subSeconds(int|float $seconds) Subtract given number of seconds to the current interval
 * @method $this addMilliseconds(int|float $milliseconds) Add given number of milliseconds to the current interval
 * @method $this subMilliseconds(int|float $milliseconds) Subtract given number of milliseconds to the current interval
 * @method $this addMicroseconds(int|float $microseconds) Add given number of microseconds to the current interval
 * @method $this subMicroseconds(int|float $microseconds) Subtract given number of microseconds to the current interval
 * @method $this roundYear(int|float $precision = 1, string $function = "round") Round the current instance year with given precision using the given function.
 * @method $this roundYears(int|float $precision = 1, string $function = "round") Round the current instance year with given precision using the given function.
 * @method $this floorYear(int|float $precision = 1) Truncate the current instance year with given precision.
 * @method $this floorYears(int|float $precision = 1) Truncate the current instance year with given precision.
 * @method $this ceilYear(int|float $precision = 1) Ceil the current instance year with given precision.
 * @method $this ceilYears(int|float $precision = 1) Ceil the current instance year with given precision.
 * @method $this roundMonth(int|float $precision = 1, string $function = "round") Round the current instance month with given precision using the given function.
 * @method $this roundMonths(int|float $precision = 1, string $function = "round") Round the current instance month with given precision using the given function.
 * @method $this floorMonth(int|float $precision = 1) Truncate the current instance month with given precision.
 * @method $this floorMonths(int|float $precision = 1) Truncate the current instance month with given precision.
 * @method $this ceilMonth(int|float $precision = 1) Ceil the current instance month with given precision.
 * @method $this ceilMonths(int|float $precision = 1) Ceil the current instance month with given precision.
 * @method $this roundWeek(int|float $precision = 1, string $function = "round") Round the current instance day with given precision using the given function.
 * @method $this roundWeeks(int|float $precision = 1, string $function = "round") Round the current instance day with given precision using the given function.
 * @method $this floorWeek(int|float $precision = 1) Truncate the current instance day with given precision.
 * @method $this floorWeeks(int|float $precision = 1) Truncate the current instance day with given precision.
 * @method $this ceilWeek(int|float $precision = 1) Ceil the current instance day with given precision.
 * @method $this ceilWeeks(int|float $precision = 1) Ceil the current instance day with given precision.
 * @method $this roundDay(int|float $precision = 1, string $function = "round") Round the current instance day with given precision using the given function.
 * @method $this roundDays(int|float $precision = 1, string $function = "round") Round the current instance day with given precision using the given function.
 * @method $this floorDay(int|float $precision = 1) Truncate the current instance day with given precision.
 * @method $this floorDays(int|float $precision = 1) Truncate the current instance day with given precision.
 * @method $this ceilDay(int|float $precision = 1) Ceil the current instance day with given precision.
 * @method $this ceilDays(int|float $precision = 1) Ceil the current instance day with given precision.
 * @method $this roundHour(int|float $precision = 1, string $function = "round") Round the current instance hour with given precision using the given function.
 * @method $this roundHours(int|float $precision = 1, string $function = "round") Round the current instance hour with given precision using the given function.
 * @method $this floorHour(int|float $precision = 1) Truncate the current instance hour with given precision.
 * @method $this floorHours(int|float $precision = 1) Truncate the current instance hour with given precision.
 * @method $this ceilHour(int|float $precision = 1) Ceil the current instance hour with given precision.
 * @method $this ceilHours(int|float $precision = 1) Ceil the current instance hour with given precision.
 * @method $this roundMinute(int|float $precision = 1, string $function = "round") Round the current instance minute with given precision using the given function.
 * @method $this roundMinutes(int|float $precision = 1, string $function = "round") Round the current instance minute with given precision using the given function.
 * @method $this floorMinute(int|float $precision = 1) Truncate the current instance minute with given precision.
 * @method $this floorMinutes(int|float $precision = 1) Truncate the current instance minute with given precision.
 * @method $this ceilMinute(int|float $precision = 1) Ceil the current instance minute with given precision.
 * @method $this ceilMinutes(int|float $precision = 1) Ceil the current instance minute with given precision.
 * @method $this roundSecond(int|float $precision = 1, string $function = "round") Round the current instance second with given precision using the given function.
 * @method $this roundSeconds(int|float $precision = 1, string $function = "round") Round the current instance second with given precision using the given function.
 * @method $this floorSecond(int|float $precision = 1) Truncate the current instance second with given precision.
 * @method $this floorSeconds(int|float $precision = 1) Truncate the current instance second with given precision.
 * @method $this ceilSecond(int|float $precision = 1) Ceil the current instance second with given precision.
 * @method $this ceilSeconds(int|float $precision = 1) Ceil the current instance second with given precision.
 * @method $this roundMillennium(int|float $precision = 1, string $function = "round") Round the current instance millennium with given precision using the given function.
 * @method $this roundMillennia(int|float $precision = 1, string $function = "round") Round the current instance millennium with given precision using the given function.
 * @method $this floorMillennium(int|float $precision = 1) Truncate the current instance millennium with given precision.
 * @method $this floorMillennia(int|float $precision = 1) Truncate the current instance millennium with given precision.
 * @method $this ceilMillennium(int|float $precision = 1) Ceil the current instance millennium with given precision.
 * @method $this ceilMillennia(int|float $precision = 1) Ceil the current instance millennium with given precision.
 * @method $this roundCentury(int|float $precision = 1, string $function = "round") Round the current instance century with given precision using the given function.
 * @method $this roundCenturies(int|float $precision = 1, string $function = "round") Round the current instance century with given precision using the given function.
 * @method $this floorCentury(int|float $precision = 1) Truncate the current instance century with given precision.
 * @method $this floorCenturies(int|float $precision = 1) Truncate the current instance century with given precision.
 * @method $this ceilCentury(int|float $precision = 1) Ceil the current instance century with given precision.
 * @method $this ceilCenturies(int|float $precision = 1) Ceil the current instance century with given precision.
 * @method $this roundDecade(int|float $precision = 1, string $function = "round") Round the current instance decade with given precision using the given function.
 * @method $this roundDecades(int|float $precision = 1, string $function = "round") Round the current instance decade with given precision using the given function.
 * @method $this floorDecade(int|float $precision = 1) Truncate the current instance decade with given precision.
 * @method $this floorDecades(int|float $precision = 1) Truncate the current instance decade with given precision.
 * @method $this ceilDecade(int|float $precision = 1) Ceil the current instance decade with given precision.
 * @method $this ceilDecades(int|float $precision = 1) Ceil the current instance decade with given precision.
 * @method $this roundQuarter(int|float $precision = 1, string $function = "round") Round the current instance quarter with given precision using the given function.
 * @method $this roundQuarters(int|float $precision = 1, string $function = "round") Round the current instance quarter with given precision using the given function.
 * @method $this floorQuarter(int|float $precision = 1) Truncate the current instance quarter with given precision.
 * @method $this floorQuarters(int|float $precision = 1) Truncate the current instance quarter with given precision.
 * @method $this ceilQuarter(int|float $precision = 1) Ceil the current instance quarter with given precision.
 * @method $this ceilQuarters(int|float $precision = 1) Ceil the current instance quarter with given precision.
 * @method $this roundMillisecond(int|float $precision = 1, string $function = "round") Round the current instance millisecond with given precision using the given function.
 * @method $this roundMilliseconds(int|float $precision = 1, string $function = "round") Round the current instance millisecond with given precision using the given function.
 * @method $this floorMillisecond(int|float $precision = 1) Truncate the current instance millisecond with given precision.
 * @method $this floorMilliseconds(int|float $precision = 1) Truncate the current instance millisecond with given precision.
 * @method $this ceilMillisecond(int|float $precision = 1) Ceil the current instance millisecond with given precision.
 * @method $this ceilMilliseconds(int|float $precision = 1) Ceil the current instance millisecond with given precision.
 * @method $this roundMicrosecond(int|float $precision = 1, string $function = "round") Round the current instance microsecond with given precision using the given function.
 * @method $this roundMicroseconds(int|float $precision = 1, string $function = "round") Round the current instance microsecond with given precision using the given function.
 * @method $this floorMicrosecond(int|float $precision = 1) Truncate the current instance microsecond with given precision.
 * @method $this floorMicroseconds(int|float $precision = 1) Truncate the current instance microsecond with given precision.
 * @method $this ceilMicrosecond(int|float $precision = 1) Ceil the current instance microsecond with given precision.
 * @method $this ceilMicroseconds(int|float $precision = 1) Ceil the current instance microsecond with given precision.
 */
class CarbonInterval extends DateInterval implements CarbonConverterInterface
{
    use IntervalRounding;
    use IntervalStep;
    use Mixin {
        Mixin::mixin as baseMixin;
    }
    use Options;

    /**
     * Interval spec period designators
     */
    public const PERIOD_PREFIX = 'P';
    public const PERIOD_YEARS = 'Y';
    public const PERIOD_MONTHS = 'M';
    public const PERIOD_DAYS = 'D';
    public const PERIOD_TIME_PREFIX = 'T';
    public const PERIOD_HOURS = 'H';
    public const PERIOD_MINUTES = 'M';
    public const PERIOD_SECONDS = 'S';

    /**
     * A translator to ... er ... translate stuff
     *
     * @var \Symfony\Component\Translation\TranslatorInterface
     */
    protected static $translator;

    /**
     * @var array|null
     */
    protected static $cascadeFactors;

    /**
     * @var array
     */
    protected static $formats = [
        'y' => 'y',
        'Y' => 'y',
        'o' => 'y',
        'm' => 'm',
        'n' => 'm',
        'W' => 'weeks',
        'd' => 'd',
        'j' => 'd',
        'z' => 'd',
        'h' => 'h',
        'g' => 'h',
        'H' => 'h',
        'G' => 'h',
        'i' => 'i',
        's' => 's',
        'u' => 'micro',
        'v' => 'milli',
    ];

    /**
     * @var array|null
     */
    private static $flipCascadeFactors;

    /**
     * The registered macros.
     *
     * @var array
     */
    protected static $macros = [];

    /**
     * Timezone handler for settings() method.
     *
     * @var mixed
     */
    protected $tzName;

    /**
     * Set the instance's timezone from a string or object.
     *
     * @param \DateTimeZone|string $tzName
     *
     * @return static
     */
    public function setTimezone($tzName)
    {
        $this->tzName = $tzName;

        return $this;
    }

    /**
     * @internal
     *
     * Set the instance's timezone from a string or object and add/subtract the offset difference.
     *
     * @param \DateTimeZone|string $tzName
     *
     * @return static
     */
    public function shiftTimezone($tzName)
    {
        $this->tzName = $tzName;

        return $this;
    }

    /**
     * Mapping of units and factors for cascading.
     *
     * Should only be modified by changing the factors or referenced constants.
     *
     * @return array
     */
    public static function getCascadeFactors()
    {
        return static::$cascadeFactors ?: [
            'milliseconds' => [Carbon::MICROSECONDS_PER_MILLISECOND, 'microseconds'],
            'seconds' => [Carbon::MILLISECONDS_PER_SECOND, 'milliseconds'],
            'minutes' => [Carbon::SECONDS_PER_MINUTE, 'seconds'],
            'hours' => [Carbon::MINUTES_PER_HOUR, 'minutes'],
            'dayz' => [Carbon::HOURS_PER_DAY, 'hours'],
            'weeks' => [Carbon::DAYS_PER_WEEK, 'dayz'],
            'months' => [Carbon::WEEKS_PER_MONTH, 'weeks'],
            'years' => [Carbon::MONTHS_PER_YEAR, 'months'],
        ];
    }

    private static function standardizeUnit($unit)
    {
        $unit = rtrim($unit, 'sz').'s';

        return $unit === 'days' ? 'dayz' : $unit;
    }

    private static function getFlipCascadeFactors()
    {
        if (!self::$flipCascadeFactors) {
            self::$flipCascadeFactors = [];

            foreach (static::getCascadeFactors() as $to => [$factor, $from]) {
                self::$flipCascadeFactors[self::standardizeUnit($from)] = [self::standardizeUnit($to), $factor];
            }
        }

        return self::$flipCascadeFactors;
    }

    /**
     * Set default cascading factors for ->cascade() method.
     *
     * @param array $cascadeFactors
     */
    public static function setCascadeFactors(array $cascadeFactors)
    {
        self::$flipCascadeFactors = null;
        static::$cascadeFactors = $cascadeFactors;
    }

    ///////////////////////////////////////////////////////////////////
    //////////////////////////// CONSTRUCTORS /////////////////////////
    ///////////////////////////////////////////////////////////////////

    /**
     * Create a new CarbonInterval instance.
     *
     * @param Closure|DateInterval|string|int|null $years
     * @param int|null                             $months
     * @param int|null                             $weeks
     * @param int|null                             $days
     * @param int|null                             $hours
     * @param int|null                             $minutes
     * @param int|null                             $seconds
     * @param int|null                             $microseconds
     *
     * @throws Exception when the interval_spec (passed as $years) cannot be parsed as an interval.
     */
    public function __construct($years = 1, $months = null, $weeks = null, $days = null, $hours = null, $minutes = null, $seconds = null, $microseconds = null)
    {
        if ($years instanceof Closure) {
            $this->step = $years;
            $years = null;
        }

        if ($years instanceof DateInterval) {
            parent::__construct(static::getDateIntervalSpec($years));
            $this->f = $years->f;
            self::copyNegativeUnits($years, $this);

            return;
        }

        $spec = $years;

        if (!\is_string($spec) || (float) $years || preg_match('/^[\d.]/', $years)) {
            $spec = static::PERIOD_PREFIX;

            $spec .= $years > 0 ? $years.static::PERIOD_YEARS : '';
            $spec .= $months > 0 ? $months.static::PERIOD_MONTHS : '';

            $specDays = 0;
            $specDays += $weeks > 0 ? $weeks * static::getDaysPerWeek() : 0;
            $specDays += $days > 0 ? $days : 0;

            $spec .= $specDays > 0 ? $specDays.static::PERIOD_DAYS : '';

            if ($hours > 0 || $minutes > 0 || $seconds > 0) {
                $spec .= static::PERIOD_TIME_PREFIX;
                $spec .= $hours > 0 ? $hours.static::PERIOD_HOURS : '';
                $spec .= $minutes > 0 ? $minutes.static::PERIOD_MINUTES : '';
                $spec .= $seconds > 0 ? $seconds.static::PERIOD_SECONDS : '';
            }

            if ($spec === static::PERIOD_PREFIX) {
                // Allow the zero interval.
                $spec .= '0'.static::PERIOD_YEARS;
            }
        }

        parent::__construct($spec);

        if ($microseconds !== null) {
            $this->f = $microseconds / Carbon::MICROSECONDS_PER_SECOND;
        }
    }

    /**
     * Returns the factor for a given source-to-target couple.
     *
     * @param string $source
     * @param string $target
     *
     * @return int|null
     */
    public static function getFactor($source, $target)
    {
        $source = self::standardizeUnit($source);
        $target = self::standardizeUnit($target);
        $factors = self::getFlipCascadeFactors();

        if (isset($factors[$source])) {
            [$to, $factor] = $factors[$source];

            if ($to === $target) {
                return $factor;
            }

            return $factor * static::getFactor($to, $target);
        }

        return null;
    }

    /**
     * Returns the factor for a given source-to-target couple if set,
     * else try to find the appropriate constant as the factor, such as Carbon::DAYS_PER_WEEK.
     *
     * @param string $source
     * @param string $target
     *
     * @return int|null
     */
    public static function getFactorWithDefault($source, $target)
    {
        $factor = self::getFactor($source, $target);

        if ($factor) {
            return $factor;
        }

        static $defaults = [
            'month' => ['year' => Carbon::MONTHS_PER_YEAR],
            'week' => ['month' => Carbon::WEEKS_PER_MONTH],
            'day' => ['week' => Carbon::DAYS_PER_WEEK],
            'hour' => ['day' => Carbon::HOURS_PER_DAY],
            'minute' => ['hour' => Carbon::MINUTES_PER_HOUR],
            'second' => ['minute' => Carbon::SECONDS_PER_MINUTE],
            'millisecond' => ['second' => Carbon::MILLISECONDS_PER_SECOND],
            'microsecond' => ['millisecond' => Carbon::MICROSECONDS_PER_MILLISECOND],
        ];

        return $defaults[$source][$target] ?? null;
    }

    /**
     * Returns current config for days per week.
     *
     * @return int
     */
    public static function getDaysPerWeek()
    {
        return static::getFactor('dayz', 'weeks') ?: Carbon::DAYS_PER_WEEK;
    }

    /**
     * Returns current config for hours per day.
     *
     * @return int
     */
    public static function getHoursPerDay()
    {
        return static::getFactor('hours', 'dayz') ?: Carbon::HOURS_PER_DAY;
    }

    /**
     * Returns current config for minutes per hour.
     *
     * @return int
     */
    public static function getMinutesPerHour()
    {
        return static::getFactor('minutes', 'hours') ?: Carbon::MINUTES_PER_HOUR;
    }

    /**
     * Returns current config for seconds per minute.
     *
     * @return int
     */
    public static function getSecondsPerMinute()
    {
        return static::getFactor('seconds', 'minutes') ?: Carbon::SECONDS_PER_MINUTE;
    }

    /**
     * Returns current config for microseconds per second.
     *
     * @return int
     */
    public static function getMillisecondsPerSecond()
    {
        return static::getFactor('milliseconds', 'seconds') ?: Carbon::MILLISECONDS_PER_SECOND;
    }

    /**
     * Returns current config for microseconds per second.
     *
     * @return int
     */
    public static function getMicrosecondsPerMillisecond()
    {
        return static::getFactor('microseconds', 'milliseconds') ?: Carbon::MICROSECONDS_PER_MILLISECOND;
    }

    /**
     * Create a new CarbonInterval instance from specific values.
     * This is an alias for the constructor that allows better fluent
     * syntax as it allows you to do CarbonInterval::create(1)->fn() rather than
     * (new CarbonInterval(1))->fn().
     *
     * @param int $years
     * @param int $months
     * @param int $weeks
     * @param int $days
     * @param int $hours
     * @param int $minutes
     * @param int $seconds
     * @param int $microseconds
     *
     * @throws Exception when the interval_spec (passed as $years) cannot be parsed as an interval.
     *
     * @return static
     */
    public static function create($years = 1, $months = null, $weeks = null, $days = null, $hours = null, $minutes = null, $seconds = null, $microseconds = null)
    {
        return new static($years, $months, $weeks, $days, $hours, $minutes, $seconds, $microseconds);
    }

    /**
     * Parse a string into a new CarbonInterval object according to the specified format.
     *
     * @example
     * ```
     * echo Carboninterval::createFromFormat('H:i', '1:30');
     * ```
     *
     * @param string      $format   Format of the $interval input string
     * @param string|null $interval Input string to convert into an interval
     *
     * @throws \Carbon\Exceptions\ParseErrorException when the $interval cannot be parsed as an interval.
     *
     * @return static
     */
    public static function createFromFormat(string $format, ?string $interval)
    {
        $instance = new static(0);
        $length = mb_strlen($format);

        if (preg_match('/s([,.])([uv])$/', $format, $match)) {
            $interval = explode($match[1], $interval);
            $index = \count($interval) - 1;
            $interval[$index] = str_pad($interval[$index], $match[2] === 'v' ? 3 : 6, '0');
            $interval = implode($match[1], $interval);
        }

        $interval = $interval ?? '';

        for ($index = 0; $index < $length; $index++) {
            $expected = mb_substr($format, $index, 1);
            $nextCharacter = mb_substr($interval, 0, 1);
            $unit = static::$formats[$expected] ?? null;

            if ($unit) {
                if (!preg_match('/^-?\d+/', $interval, $match)) {
                    throw new ParseErrorException('number', $nextCharacter);
                }

                $interval = mb_substr($interval, mb_strlen($match[0]));
                $instance->$unit += (int) ($match[0]);

                continue;
            }

            if ($nextCharacter !== $expected) {
                throw new ParseErrorException(
                    "'$expected'",
                    $nextCharacter,
                    'Allowed substitutes for interval formats are '.implode(', ', array_keys(static::$formats))."\n".
                    'See https://php.net/manual/en/function.date.php for their meaning'
                );
            }

            $interval = mb_substr($interval, 1);
        }

        if ($interval !== '') {
            throw new ParseErrorException(
                'end of string',
                $interval
            );
        }

        return $instance;
    }

    /**
     * Get a copy of the instance.
     *
     * @return static
     */
    public function copy()
    {
        $date = new static(0);
        $date->copyProperties($this);
        $date->step = $this->step;

        return $date;
    }

    /**
     * Get a copy of the instance.
     *
     * @return static
     */
    public function clone()
    {
        return $this->copy();
    }

    /**
     * Provide static helpers to create instances.  Allows CarbonInterval::years(3).
     *
     * Note: This is done using the magic method to allow static and instance methods to
     *       have the same names.
     *
     * @param string $method     magic method name called
     * @param array  $parameters parameters list
     *
     * @return static|null
     */
    public static function __callStatic($method, $parameters)
    {
        try {
            $interval = new static(0);
            $localStrictModeEnabled = $interval->localStrictModeEnabled;
            $interval->localStrictModeEnabled = true;

            $result = static::hasMacro($method)
                ? static::bindMacroContext(null, function () use (&$method, &$parameters, &$interval) {
                    return $interval->callMacro($method, $parameters);
                })
                : $interval->$method(...$parameters);

            $interval->localStrictModeEnabled = $localStrictModeEnabled;

            return $result;
        } catch (BadFluentSetterException $exception) {
            if (Carbon::isStrictModeEnabled()) {
                throw new BadFluentConstructorException($method, 0, $exception);
            }

            return null;
        }
    }

    /**
     * Return the current context from inside a macro callee or a new one if static.
     *
     * @return static
     */
    protected static function this()
    {
        return end(static::$macroContextStack) ?: new static(0);
    }

    /**
     * Creates a CarbonInterval from string.
     *
     * Format:
     *
     * Suffix | Unit    | Example | DateInterval expression
     * -------|---------|---------|------------------------
     * y      | years   |   1y    | P1Y
     * mo     | months  |   3mo   | P3M
     * w      | weeks   |   2w    | P2W
     * d      | days    |  28d    | P28D
     * h      | hours   |   4h    | PT4H
     * m      | minutes |  12m    | PT12M
     * s      | seconds |  59s    | PT59S
     *
     * e. g. `1w 3d 4h 32m 23s` is converted to 10 days 4 hours 32 minutes and 23 seconds.
     *
     * Special cases:
     *  - An empty string will return a zero interval
     *  - Fractions are allowed for weeks, days, hours and minutes and will be converted
     *    and rounded to the next smaller value (caution: 0.5w = 4d)
     *
     * @param string $intervalDefinition
     *
     * @return static
     */
    public static function fromString($intervalDefinition)
    {
        if (empty($intervalDefinition)) {
            return new static(0);
        }

        $years = 0;
        $months = 0;
        $weeks = 0;
        $days = 0;
        $hours = 0;
        $minutes = 0;
        $seconds = 0;
        $milliseconds = 0;
        $microseconds = 0;

        $pattern = '/(\d+(?:\.\d+)?)\h*([^\d\h]*)/i';
        preg_match_all($pattern, $intervalDefinition, $parts, PREG_SET_ORDER);

        while ([$part, $value, $unit] = array_shift($parts)) {
            $intValue = (int) $value;
            $fraction = (float) $value - $intValue;

            // Fix calculation precision
            switch (round($fraction, 6)) {
                case 1:
                    $fraction = 0;
                    $intValue++;

                    break;
                case 0:
                    $fraction = 0;

                    break;
            }

            switch ($unit === 'µs' ? 'µs' : strtolower($unit)) {
                case 'millennia':
                case 'millennium':
                    $years += $intValue * CarbonInterface::YEARS_PER_MILLENNIUM;

                    break;

                case 'century':
                case 'centuries':
                    $years += $intValue * CarbonInterface::YEARS_PER_CENTURY;

                    break;

                case 'decade':
                case 'decades':
                    $years += $intValue * CarbonInterface::YEARS_PER_DECADE;

                    break;

                case 'year':
                case 'years':
                case 'y':
                    $years += $intValue;

                    break;

                case 'quarter':
                case 'quarters':
                    $months += $intValue * CarbonInterface::MONTHS_PER_QUARTER;

                    break;

                case 'month':
                case 'months':
                case 'mo':
                    $months += $intValue;

                    break;

                case 'week':
                case 'weeks':
                case 'w':
                    $weeks += $intValue;

                    if ($fraction) {
                        $parts[] = [null, $fraction * static::getDaysPerWeek(), 'd'];
                    }

                    break;

                case 'day':
                case 'days':
                case 'd':
                    $days += $intValue;

                    if ($fraction) {
                        $parts[] = [null, $fraction * static::getHoursPerDay(), 'h'];
                    }

                    break;

                case 'hour':
                case 'hours':
                case 'h':
                    $hours += $intValue;

                    if ($fraction) {
                        $parts[] = [null, $fraction * static::getMinutesPerHour(), 'm'];
                    }

                    break;

                case 'minute':
                case 'minutes':
                case 'm':
                    $minutes += $intValue;

                    if ($fraction) {
                        $parts[] = [null, $fraction * static::getSecondsPerMinute(), 's'];
                    }

                    break;

                case 'second':
                case 'seconds':
                case 's':
                    $seconds += $intValue;

                    if ($fraction) {
                        $parts[] = [null, $fraction * static::getMillisecondsPerSecond(), 'ms'];
                    }

                    break;

                case 'millisecond':
                case 'milliseconds':
                case 'milli':
                case 'ms':
                    $milliseconds += $intValue;

                    if ($fraction) {
                        $microseconds += round($fraction * static::getMicrosecondsPerMillisecond());
                    }

                    break;

                case 'microsecond':
                case 'microseconds':
                case 'micro':
                case 'µs':
                    $microseconds += $intValue;

                    break;

                default:
                    throw new InvalidIntervalException(
                        sprintf('Invalid part %s in definition %s', $part, $intervalDefinition)
                    );
            }
        }

        return new static($years, $months, $weeks, $days, $hours, $minutes, $seconds, $milliseconds * Carbon::MICROSECONDS_PER_MILLISECOND + $microseconds);
    }

    /**
     * Creates a CarbonInterval from string using a different locale.
     *
     * @param string      $interval interval string in the given language (may also contain English).
     * @param string|null $locale   if locale is null or not specified, current global locale will be used instead.
     *
     * @return static
     */
    public static function parseFromLocale($interval, $locale = null)
    {
        return static::fromString(Carbon::translateTimeString($interval, $locale ?: static::getLocale(), 'en'));
    }

    private static function castIntervalToClass(DateInterval $interval, string $className)
    {
        $mainClass = DateInterval::class;

        if (!is_a($className, $mainClass, true)) {
            throw new InvalidCastException("$className is not a sub-class of $mainClass.");
        }

        $microseconds = $interval->f;
        $instance = new $className(static::getDateIntervalSpec($interval));

        if ($microseconds) {
            $instance->f = $microseconds;
        }

        if ($interval instanceof self && is_a($className, self::class, true)) {
            self::copyStep($interval, $instance);
        }

        self::copyNegativeUnits($interval, $instance);

        return $instance;
    }

    private static function copyNegativeUnits(DateInterval $from, DateInterval $to): void
    {
        $to->invert = $from->invert;

        foreach (['y', 'm', 'd', 'h', 'i', 's'] as $unit) {
            if ($from->$unit < 0) {
                $to->$unit *= -1;
            }
        }
    }

    private static function copyStep(self $from, self $to): void
    {
        $to->setStep($from->getStep());
    }

    /**
     * Cast the current instance into the given class.
     *
     * @param string $className The $className::instance() method will be called to cast the current object.
     *
     * @return DateInterval
     */
    public function cast(string $className)
    {
        return self::castIntervalToClass($this, $className);
    }

    /**
     * Create a CarbonInterval instance from a DateInterval one.  Can not instance
     * DateInterval objects created from DateTime::diff() as you can't externally
     * set the $days field.
     *
     * @param DateInterval $interval
     *
     * @return static
     */
    public static function instance(DateInterval $interval)
    {
        return self::castIntervalToClass($interval, static::class);
    }

    /**
     * Make a CarbonInterval instance from given variable if possible.
     *
     * Always return a new instance. Parse only strings and only these likely to be intervals (skip dates
     * and recurrences). Throw an exception for invalid format, but otherwise return null.
     *
     * @param mixed|int|DateInterval|string|Closure|null $interval interval or number of the given $unit
     * @param string|null                                $unit     if specified, $interval must be an integer
     *
     * @return static|null
     */
    public static function make($interval, $unit = null)
    {
        if ($unit) {
            $interval = "$interval ".Carbon::pluralUnit($unit);
        }

        if ($interval instanceof DateInterval) {
            return static::instance($interval);
        }

        if ($interval instanceof Closure) {
            return new static($interval);
        }

        if (!\is_string($interval)) {
            return null;
        }

        return static::makeFromString($interval);
    }

    protected static function makeFromString(string $interval)
    {
        $interval = preg_replace('/\s+/', ' ', trim($interval));

        if (preg_match('/^P[T\d]/', $interval)) {
            return new static($interval);
        }

        if (preg_match('/^(?:\h*\d+(?:\.\d+)?\h*[a-z]+)+$/i', $interval)) {
            return static::fromString($interval);
        }

        /** @var static $interval */
        $interval = static::createFromDateString($interval);

        return !$interval || $interval->isEmpty() ? null : $interval;
    }

    protected function resolveInterval($interval)
    {
        if (!($interval instanceof self)) {
            return self::make($interval);
        }

        return $interval;
    }

    /**
     * Sets up a DateInterval from the relative parts of the string.
     *
     * @param string $time
     *
     * @return static
     *
     * @link https://php.net/manual/en/dateinterval.createfromdatestring.php
     */
    #[ReturnTypeWillChange]
    public static function createFromDateString($time)
    {
        $interval = @parent::createFromDateString(strtr($time, [
            ',' => ' ',
            ' and ' => ' ',
        ]));

        if ($interval instanceof DateInterval) {
            $interval = static::instance($interval);
        }

        return $interval;
    }

    ///////////////////////////////////////////////////////////////////
    ///////////////////////// GETTERS AND SETTERS /////////////////////
    ///////////////////////////////////////////////////////////////////

    /**
     * Get a part of the CarbonInterval object.
     *
     * @param string $name
     *
     * @throws UnknownGetterException
     *
     * @return int|float|string
     */
    public function get($name)
    {
        if (str_starts_with($name, 'total')) {
            return $this->total(substr($name, 5));
        }

        switch ($name) {
            case 'years':
                return $this->y;

            case 'months':
                return $this->m;

            case 'dayz':
                return $this->d;

            case 'hours':
                return $this->h;

            case 'minutes':
                return $this->i;

            case 'seconds':
                return $this->s;

            case 'milli':
            case 'milliseconds':
                return (int) (round($this->f * Carbon::MICROSECONDS_PER_SECOND) / Carbon::MICROSECONDS_PER_MILLISECOND);

            case 'micro':
            case 'microseconds':
                return (int) round($this->f * Carbon::MICROSECONDS_PER_SECOND);

            case 'microExcludeMilli':
                return (int) round($this->f * Carbon::MICROSECONDS_PER_SECOND) % Carbon::MICROSECONDS_PER_MILLISECOND;

            case 'weeks':
                return (int) ($this->d / static::getDaysPerWeek());

            case 'daysExcludeWeeks':
            case 'dayzExcludeWeeks':
                return $this->d % static::getDaysPerWeek();

            case 'locale':
                return $this->getTranslatorLocale();

            default:
                throw new UnknownGetterException($name);
        }
    }

    /**
     * Get a part of the CarbonInterval object.
     *
     * @param string $name
     *
     * @throws UnknownGetterException
     *
     * @return int|float|string
     */
    public function __get($name)
    {
        return $this->get($name);
    }

    /**
     * Set a part of the CarbonInterval object.
     *
     * @param string|array $name
     * @param int          $value
     *
     * @throws UnknownSetterException
     *
     * @return $this
     */
    public function set($name, $value = null)
    {
        $properties = \is_array($name) ? $name : [$name => $value];

        foreach ($properties as $key => $value) {
            switch (Carbon::singularUnit(rtrim($key, 'z'))) {
                case 'year':
                    $this->y = $value;

                    break;

                case 'month':
                    $this->m = $value;

                    break;

                case 'week':
                    $this->d = $value * static::getDaysPerWeek();

                    break;

                case 'day':
                    $this->d = $value;

                    break;

                case 'daysexcludeweek':
                case 'dayzexcludeweek':
                    $this->d = $this->weeks * static::getDaysPerWeek() + $value;

                    break;

                case 'hour':
                    $this->h = $value;

                    break;

                case 'minute':
                    $this->i = $value;

                    break;

                case 'second':
                    $this->s = $value;

                    break;

                case 'milli':
                case 'millisecond':
                    $this->microseconds = $value * Carbon::MICROSECONDS_PER_MILLISECOND + $this->microseconds % Carbon::MICROSECONDS_PER_MILLISECOND;

                    break;

                case 'micro':
                case 'microsecond':
                    $this->f = $value / Carbon::MICROSECONDS_PER_SECOND;

                    break;

                default:
                    if ($this->localStrictModeEnabled ?? Carbon::isStrictModeEnabled()) {
                        throw new UnknownSetterException($key);
                    }

                    $this->$key = $value;
            }
        }

        return $this;
    }

    /**
     * Set a part of the CarbonInterval object.
     *
     * @param string $name
     * @param int    $value
     *
     * @throws UnknownSetterException
     */
    public function __set($name, $value)
    {
        $this->set($name, $value);
    }

    /**
     * Allow setting of weeks and days to be cumulative.
     *
     * @param int $weeks Number of weeks to set
     * @param int $days  Number of days to set
     *
     * @return static
     */
    public function weeksAndDays($weeks, $days)
    {
        $this->dayz = ($weeks * static::getDaysPerWeek()) + $days;

        return $this;
    }

    /**
     * Returns true if the interval is empty for each unit.
     *
     * @return bool
     */
    public function isEmpty()
    {
        return $this->years === 0 &&
            $this->months === 0 &&
            $this->dayz === 0 &&
            !$this->days &&
            $this->hours === 0 &&
            $this->minutes === 0 &&
            $this->seconds === 0 &&
            $this->microseconds === 0;
    }

    /**
     * Register a custom macro.
     *
     * @example
     * ```
     * CarbonInterval::macro('twice', function () {
     *   return $this->times(2);
     * });
     * echo CarbonInterval::hours(2)->twice();
     * ```
     *
     * @param string          $name
     * @param object|callable $macro
     *
     * @return void
     */
    public static function macro($name, $macro)
    {
        static::$macros[$name] = $macro;
    }

    /**
     * Register macros from a mixin object.
     *
     * @example
     * ```
     * CarbonInterval::mixin(new class {
     *   public function daysToHours() {
     *     return function () {
     *       $this->hours += $this->days;
     *       $this->days = 0;
     *
     *       return $this;
     *     };
     *   }
     *   public function hoursToDays() {
     *     return function () {
     *       $this->days += $this->hours;
     *       $this->hours = 0;
     *
     *       return $this;
     *     };
     *   }
     * });
     * echo CarbonInterval::hours(5)->hoursToDays() . "\n";
     * echo CarbonInterval::days(5)->daysToHours() . "\n";
     * ```
     *
     * @param object|string $mixin
     *
     * @throws ReflectionException
     *
     * @return void
     */
    public static function mixin($mixin)
    {
        static::baseMixin($mixin);
    }

    /**
     * Check if macro is registered.
     *
     * @param string $name
     *
     * @return bool
     */
    public static function hasMacro($name)
    {
        return isset(static::$macros[$name]);
    }

    /**
     * Call given macro.
     *
     * @param string $name
     * @param array  $parameters
     *
     * @return mixed
     */
    protected function callMacro($name, $parameters)
    {
        $macro = static::$macros[$name];

        if ($macro instanceof Closure) {
            $boundMacro = @$macro->bindTo($this, static::class) ?: @$macro->bindTo(null, static::class);

            return ($boundMacro ?: $macro)(...$parameters);
        }

        return $macro(...$parameters);
    }

    /**
     * Allow fluent calls on the setters... CarbonInterval::years(3)->months(5)->day().
     *
     * Note: This is done using the magic method to allow static and instance methods to
     *       have the same names.
     *
     * @param string $method     magic method name called
     * @param array  $parameters parameters list
     *
     * @throws BadFluentSetterException|Throwable
     *
     * @return static
     */
    public function __call($method, $parameters)
    {
        if (static::hasMacro($method)) {
            return static::bindMacroContext($this, function () use (&$method, &$parameters) {
                return $this->callMacro($method, $parameters);
            });
        }

        $roundedValue = $this->callRoundMethod($method, $parameters);

        if ($roundedValue !== null) {
            return $roundedValue;
        }

        if (preg_match('/^(?<method>add|sub)(?<unit>[A-Z].*)$/', $method, $match)) {
            return $this->{$match['method']}($parameters[0], $match['unit']);
        }

        try {
            $this->set($method, \count($parameters) === 0 ? 1 : $parameters[0]);
        } catch (UnknownSetterException $exception) {
            if ($this->localStrictModeEnabled ?? Carbon::isStrictModeEnabled()) {
                throw new BadFluentSetterException($method, 0, $exception);
            }
        }

        return $this;
    }

    protected function getForHumansInitialVariables($syntax, $short)
    {
        if (\is_array($syntax)) {
            return $syntax;
        }

        if (\is_int($short)) {
            return [
                'parts' => $short,
                'short' => false,
            ];
        }

        if (\is_bool($syntax)) {
            return [
                'short' => $syntax,
                'syntax' => CarbonInterface::DIFF_ABSOLUTE,
            ];
        }

        return [];
    }

    /**
     * @param mixed $syntax
     * @param mixed $short
     * @param mixed $parts
     * @param mixed $options
     *
     * @return array
     */
    protected function getForHumansParameters($syntax = null, $short = false, $parts = -1, $options = null)
    {
        $optionalSpace = ' ';
        $default = $this->getTranslationMessage('list.0') ?? $this->getTranslationMessage('list') ?? ' ';
        $join = $default === '' ? '' : ' ';
        $altNumbers = false;
        $aUnit = false;
        $minimumUnit = 's';
        $skip = [];
        extract($this->getForHumansInitialVariables($syntax, $short));
        $skip = array_filter((array) $skip, static function ($value) {
            return \is_string($value) && $value !== '';
        });

        if ($syntax === null) {
            $syntax = CarbonInterface::DIFF_ABSOLUTE;
        }

        if ($parts === -1) {
            $parts = INF;
        }

        if ($options === null) {
            $options = static::getHumanDiffOptions();
        }

        if ($join === false) {
            $join = ' ';
        } elseif ($join === true) {
            $join = [
                $default,
                $this->getTranslationMessage('list.1') ?? $default,
            ];
        }

        if ($altNumbers && $altNumbers !== true) {
            $language = new Language($this->locale);
            $altNumbers = \in_array($language->getCode(), (array) $altNumbers, true);
        }

        if (\is_array($join)) {
            [$default, $last] = $join;

            if ($default !== ' ') {
                $optionalSpace = '';
            }

            $join = function ($list) use ($default, $last) {
                if (\count($list) < 2) {
                    return implode('', $list);
                }

                $end = array_pop($list);

                return implode($default, $list).$last.$end;
            };
        }

        if (\is_string($join)) {
            if ($join !== ' ') {
                $optionalSpace = '';
            }

            $glue = $join;
            $join = function ($list) use ($glue) {
                return implode($glue, $list);
            };
        }

        $interpolations = [
            ':optional-space' => $optionalSpace,
        ];

        return [$syntax, $short, $parts, $options, $join, $aUnit, $altNumbers, $interpolations, $minimumUnit, $skip];
    }

    protected static function getRoundingMethodFromOptions(int $options): ?string
    {
        if ($options & CarbonInterface::ROUND) {
            return 'round';
        }

        if ($options & CarbonInterface::CEIL) {
            return 'ceil';
        }

        if ($options & CarbonInterface::FLOOR) {
            return 'floor';
        }

        return null;
    }

    /**
     * Returns interval values as an array where key are the unit names and values the counts.
     *
     * @return int[]
     */
    public function toArray()
    {
        return [
            'years' => $this->years,
            'months' => $this->months,
            'weeks' => $this->weeks,
            'days' => $this->daysExcludeWeeks,
            'hours' => $this->hours,
            'minutes' => $this->minutes,
            'seconds' => $this->seconds,
            'microseconds' => $this->microseconds,
        ];
    }

    /**
     * Returns interval non-zero values as an array where key are the unit names and values the counts.
     *
     * @return int[]
     */
    public function getNonZeroValues()
    {
        return array_filter($this->toArray(), 'intval');
    }

    /**
     * Returns interval values as an array where key are the unit names and values the counts
     * from the biggest non-zero one the the smallest non-zero one.
     *
     * @return int[]
     */
    public function getValuesSequence()
    {
        $nonZeroValues = $this->getNonZeroValues();

        if ($nonZeroValues === []) {
            return [];
        }

        $keys = array_keys($nonZeroValues);
        $firstKey = $keys[0];
        $lastKey = $keys[\count($keys) - 1];
        $values = [];
        $record = false;

        foreach ($this->toArray() as $unit => $count) {
            if ($unit === $firstKey) {
                $record = true;
            }

            if ($record) {
                $values[$unit] = $count;
            }

            if ($unit === $lastKey) {
                $record = false;
            }
        }

        return $values;
    }

    /**
     * Get the current interval in a human readable format in the current locale.
     *
     * @example
     * ```
     * echo CarbonInterval::fromString('4d 3h 40m')->forHumans() . "\n";
     * echo CarbonInterval::fromString('4d 3h 40m')->forHumans(['parts' => 2]) . "\n";
     * echo CarbonInterval::fromString('4d 3h 40m')->forHumans(['parts' => 3, 'join' => true]) . "\n";
     * echo CarbonInterval::fromString('4d 3h 40m')->forHumans(['short' => true]) . "\n";
     * echo CarbonInterval::fromString('1d 24h')->forHumans(['join' => ' or ']) . "\n";
     * echo CarbonInterval::fromString('1d 24h')->forHumans(['minimumUnit' => 'hour']) . "\n";
     * ```
     *
     * @param int|array $syntax  if array passed, parameters will be extracted from it, the array may contains:
     *                           - 'syntax' entry (see below)
     *                           - 'short' entry (see below)
     *                           - 'parts' entry (see below)
     *                           - 'options' entry (see below)
     *                           - 'skip' entry, list of units to skip (array of strings or a single string,
     *                           ` it can be the unit name (singular or plural) or its shortcut
     *                           ` (y, m, w, d, h, min, s, ms, µs).
     *                           - 'aUnit' entry, prefer "an hour" over "1 hour" if true
     *                           - 'join' entry determines how to join multiple parts of the string
     *                           `  - if $join is a string, it's used as a joiner glue
     *                           `  - if $join is a callable/closure, it get the list of string and should return a string
     *                           `  - if $join is an array, the first item will be the default glue, and the second item
     *                           `    will be used instead of the glue for the last item
     *                           `  - if $join is true, it will be guessed from the locale ('list' translation file entry)
     *                           `  - if $join is missing, a space will be used as glue
     *                           - 'minimumUnit' entry determines the smallest unit of time to display can be long or
     *                           `  short form of the units, e.g. 'hour' or 'h' (default value: s)
     *                           if int passed, it add modifiers:
     *                           Possible values:
     *                           - CarbonInterface::DIFF_ABSOLUTE          no modifiers
     *                           - CarbonInterface::DIFF_RELATIVE_TO_NOW   add ago/from now modifier
     *                           - CarbonInterface::DIFF_RELATIVE_TO_OTHER add before/after modifier
     *                           Default value: CarbonInterface::DIFF_ABSOLUTE
     * @param bool      $short   displays short format of time units
     * @param int       $parts   maximum number of parts to display (default value: -1: no limits)
     * @param int       $options human diff options
     *
     * @throws Exception
     *
     * @return string
     */
    public function forHumans($syntax = null, $short = false, $parts = -1, $options = null)
    {
        [$syntax, $short, $parts, $options, $join, $aUnit, $altNumbers, $interpolations, $minimumUnit, $skip] = $this
            ->getForHumansParameters($syntax, $short, $parts, $options);

        $interval = [];

        $syntax = (int) ($syntax ?? CarbonInterface::DIFF_ABSOLUTE);
        $absolute = $syntax === CarbonInterface::DIFF_ABSOLUTE;
        $relativeToNow = $syntax === CarbonInterface::DIFF_RELATIVE_TO_NOW;
        $count = 1;
        $unit = $short ? 's' : 'second';
        $isFuture = $this->invert === 1;
        $transId = $relativeToNow ? ($isFuture ? 'from_now' : 'ago') : ($isFuture ? 'after' : 'before');
        $declensionMode = null;

        /** @var \Symfony\Component\Translation\Translator $translator */
        $translator = $this->getLocalTranslator();

        $handleDeclensions = function ($unit, $count, $index = 0, $parts = 1) use ($interpolations, $transId, $translator, $altNumbers, $absolute, &$declensionMode) {
            if (!$absolute) {
                $declensionMode = $declensionMode ?? $this->translate($transId.'_mode');

                if ($this->needsDeclension($declensionMode, $index, $parts)) {
                    // Some languages have special pluralization for past and future tense.
                    $key = $unit.'_'.$transId;
                    $result = $this->translate($key, $interpolations, $count, $translator, $altNumbers);

                    if ($result !== $key) {
                        return $result;
                    }
                }
            }

            $result = $this->translate($unit, $interpolations, $count, $translator, $altNumbers);

            if ($result !== $unit) {
                return $result;
            }

            return null;
        };

        $intervalValues = $this;
        $method = static::getRoundingMethodFromOptions($options);

        if ($method) {
            $previousCount = INF;

            while (
                \count($intervalValues->getNonZeroValues()) > $parts &&
                ($count = \count($keys = array_keys($intervalValues->getValuesSequence()))) > 1
            ) {
                $index = min($count, $previousCount - 1) - 2;

                if ($index < 0) {
                    break;
                }

                $intervalValues = $this->copy()->roundUnit(
                    $keys[$index],
                    1,
                    $method
                );
                $previousCount = $count;
            }
        }

        $diffIntervalArray = [
            ['value' => $intervalValues->years,             'unit' => 'year',        'unitShort' => 'y'],
            ['value' => $intervalValues->months,            'unit' => 'month',       'unitShort' => 'm'],
            ['value' => $intervalValues->weeks,             'unit' => 'week',        'unitShort' => 'w'],
            ['value' => $intervalValues->daysExcludeWeeks,  'unit' => 'day',         'unitShort' => 'd'],
            ['value' => $intervalValues->hours,             'unit' => 'hour',        'unitShort' => 'h'],
            ['value' => $intervalValues->minutes,           'unit' => 'minute',      'unitShort' => 'min'],
            ['value' => $intervalValues->seconds,           'unit' => 'second',      'unitShort' => 's'],
            ['value' => $intervalValues->milliseconds,      'unit' => 'millisecond', 'unitShort' => 'ms'],
            ['value' => $intervalValues->microExcludeMilli, 'unit' => 'microsecond', 'unitShort' => 'µs'],
        ];

        if (!empty($skip)) {
            foreach ($diffIntervalArray as $index => &$unitData) {
                $nextIndex = $index + 1;

                if ($unitData['value'] &&
                    isset($diffIntervalArray[$nextIndex]) &&
                    \count(array_intersect([$unitData['unit'], $unitData['unit'].'s', $unitData['unitShort']], $skip))
                ) {
                    $diffIntervalArray[$nextIndex]['value'] += $unitData['value'] *
                        self::getFactorWithDefault($diffIntervalArray[$nextIndex]['unit'], $unitData['unit']);
                    $unitData['value'] = 0;
                }
            }
        }

        $transChoice = function ($short, $unitData, $index, $parts) use ($absolute, $handleDeclensions, $translator, $aUnit, $altNumbers, $interpolations) {
            $count = $unitData['value'];

            if ($short) {
                $result = $handleDeclensions($unitData['unitShort'], $count, $index, $parts);

                if ($result !== null) {
                    return $result;
                }
            } elseif ($aUnit) {
                $result = $handleDeclensions('a_'.$unitData['unit'], $count, $index, $parts);

                if ($result !== null) {
                    return $result;
                }
            }

            if (!$absolute) {
                return $handleDeclensions($unitData['unit'], $count, $index, $parts);
            }

            return $this->translate($unitData['unit'], $interpolations, $count, $translator, $altNumbers);
        };

        $fallbackUnit = ['second', 's'];

        foreach ($diffIntervalArray as $diffIntervalData) {
            if ($diffIntervalData['value'] > 0) {
                $unit = $short ? $diffIntervalData['unitShort'] : $diffIntervalData['unit'];
                $count = $diffIntervalData['value'];
                $interval[] = [$short, $diffIntervalData];
            } elseif ($options & CarbonInterface::SEQUENTIAL_PARTS_ONLY && \count($interval) > 0) {
                break;
            }

            // break the loop after we get the required number of parts in array
            if (\count($interval) >= $parts) {
                break;
            }

            // break the loop after we have reached the minimum unit
            if (\in_array($minimumUnit, [$diffIntervalData['unit'], $diffIntervalData['unitShort']], true)) {
                $fallbackUnit = [$diffIntervalData['unit'], $diffIntervalData['unitShort']];

                break;
            }
        }

        $actualParts = \count($interval);

        foreach ($interval as $index => &$item) {
            $item = $transChoice($item[0], $item[1], $index, $actualParts);
        }

        if (\count($interval) === 0) {
            if ($relativeToNow && $options & CarbonInterface::JUST_NOW) {
                $key = 'diff_now';
                $translation = $this->translate($key, $interpolations, null, $translator);

                if ($translation !== $key) {
                    return $translation;
                }
            }

            $count = $options & CarbonInterface::NO_ZERO_DIFF ? 1 : 0;
            $unit = $fallbackUnit[$short ? 1 : 0];
            $interval[] = $this->translate($unit, $interpolations, $count, $translator, $altNumbers);
        }

        // join the interval parts by a space
        $time = $join($interval);

        unset($diffIntervalArray, $interval);

        if ($absolute) {
            return $time;
        }

        $isFuture = $this->invert === 1;

        $transId = $relativeToNow ? ($isFuture ? 'from_now' : 'ago') : ($isFuture ? 'after' : 'before');

        if ($parts === 1) {
            if ($relativeToNow && $unit === 'day') {
                if ($count === 1 && $options & CarbonInterface::ONE_DAY_WORDS) {
                    $key = $isFuture ? 'diff_tomorrow' : 'diff_yesterday';
                    $translation = $this->translate($key, $interpolations, null, $translator);

                    if ($translation !== $key) {
                        return $translation;
                    }
                }

                if ($count === 2 && $options & CarbonInterface::TWO_DAY_WORDS) {
                    $key = $isFuture ? 'diff_after_tomorrow' : 'diff_before_yesterday';
                    $translation = $this->translate($key, $interpolations, null, $translator);

                    if ($translation !== $key) {
                        return $translation;
                    }
                }
            }

            $aTime = $aUnit ? $handleDeclensions('a_'.$unit, $count) : null;

            $time = $aTime ?: $handleDeclensions($unit, $count) ?: $time;
        }

        $time = [':time' => $time];

        return $this->translate($transId, array_merge($time, $interpolations, $time), null, $translator);
    }

    /**
     * Format the instance as a string using the forHumans() function.
     *
     * @throws Exception
     *
     * @return string
     */
    public function __toString()
    {
        $format = $this->localToStringFormat;

        if (!$format) {
            return $this->forHumans();
        }

        if ($format instanceof Closure) {
            return $format($this);
        }

        return $this->format($format);
    }

    /**
     * Return native DateInterval PHP object matching the current instance.
     *
     * @example
     * ```
     * var_dump(CarbonInterval::hours(2)->toDateInterval());
     * ```
     *
     * @return DateInterval
     */
    public function toDateInterval()
    {
        return self::castIntervalToClass($this, DateInterval::class);
    }

    /**
     * Convert the interval to a CarbonPeriod.
     *
     * @param DateTimeInterface|string|int ...$params Start date, [end date or recurrences] and optional settings.
     *
     * @return CarbonPeriod
     */
    public function toPeriod(...$params)
    {
        if ($this->tzName) {
            $tz = \is_string($this->tzName) ? new DateTimeZone($this->tzName) : $this->tzName;

            if ($tz instanceof DateTimeZone) {
                array_unshift($params, $tz);
            }
        }

        return CarbonPeriod::create($this, ...$params);
    }

    /**
     * Invert the interval.
     *
     * @param bool|int $inverted if a parameter is passed, the passed value casted as 1 or 0 is used
     *                           as the new value of the ->invert property.
     *
     * @return $this
     */
    public function invert($inverted = null)
    {
        $this->invert = (\func_num_args() === 0 ? !$this->invert : $inverted) ? 1 : 0;

        return $this;
    }

    protected function solveNegativeInterval()
    {
        if (!$this->isEmpty() && $this->years <= 0 && $this->months <= 0 && $this->dayz <= 0 && $this->hours <= 0 && $this->minutes <= 0 && $this->seconds <= 0 && $this->microseconds <= 0) {
            $this->years *= -1;
            $this->months *= -1;
            $this->dayz *= -1;
            $this->hours *= -1;
            $this->minutes *= -1;
            $this->seconds *= -1;
            $this->microseconds *= -1;
            $this->invert();
        }

        return $this;
    }

    /**
     * Add the passed interval to the current instance.
     *
     * @param string|DateInterval $unit
     * @param int|float           $value
     *
     * @return $this
     */
    public function add($unit, $value = 1)
    {
        if (is_numeric($unit)) {
            [$value, $unit] = [$unit, $value];
        }

        if (\is_string($unit) && !preg_match('/^\s*\d/', $unit)) {
            $unit = "$value $unit";
            $value = 1;
        }

        $interval = static::make($unit);

        if (!$interval) {
            throw new InvalidIntervalException('This type of data cannot be added/subtracted.');
        }

        if ($value !== 1) {
            $interval->times($value);
        }

        $sign = ($this->invert === 1) !== ($interval->invert === 1) ? -1 : 1;
        $this->years += $interval->y * $sign;
        $this->months += $interval->m * $sign;
        $this->dayz += ($interval->days === false ? $interval->d : $interval->days) * $sign;
        $this->hours += $interval->h * $sign;
        $this->minutes += $interval->i * $sign;
        $this->seconds += $interval->s * $sign;
        $this->microseconds += $interval->microseconds * $sign;

        $this->solveNegativeInterval();

        return $this;
    }

    /**
     * Subtract the passed interval to the current instance.
     *
     * @param string|DateInterval $unit
     * @param int|float           $value
     *
     * @return $this
     */
    public function sub($unit, $value = 1)
    {
        if (is_numeric($unit)) {
            [$value, $unit] = [$unit, $value];
        }

        return $this->add($unit, -(float) $value);
    }

    /**
     * Subtract the passed interval to the current instance.
     *
     * @param string|DateInterval $unit
     * @param int|float           $value
     *
     * @return $this
     */
    public function subtract($unit, $value = 1)
    {
        return $this->sub($unit, $value);
    }

    /**
     * Add given parameters to the current interval.
     *
     * @param int       $years
     * @param int       $months
     * @param int|float $weeks
     * @param int|float $days
     * @param int|float $hours
     * @param int|float $minutes
     * @param int|float $seconds
     * @param int|float $microseconds
     *
     * @return $this
     */
    public function plus(
        $years = 0,
        $months = 0,
        $weeks = 0,
        $days = 0,
        $hours = 0,
        $minutes = 0,
        $seconds = 0,
        $microseconds = 0
    ): self {
        return $this->add("
            $years years $months months $weeks weeks $days days
            $hours hours $minutes minutes $seconds seconds $microseconds microseconds
        ");
    }

    /**
     * Add given parameters to the current interval.
     *
     * @param int       $years
     * @param int       $months
     * @param int|float $weeks
     * @param int|float $days
     * @param int|float $hours
     * @param int|float $minutes
     * @param int|float $seconds
     * @param int|float $microseconds
     *
     * @return $this
     */
    public function minus(
        $years = 0,
        $months = 0,
        $weeks = 0,
        $days = 0,
        $hours = 0,
        $minutes = 0,
        $seconds = 0,
        $microseconds = 0
    ): self {
        return $this->sub("
            $years years $months months $weeks weeks $days days
            $hours hours $minutes minutes $seconds seconds $microseconds microseconds
        ");
    }

    /**
     * Multiply current instance given number of times. times() is naive, it multiplies each unit
     * (so day can be greater than 31, hour can be greater than 23, etc.) and the result is rounded
     * separately for each unit.
     *
     * Use times() when you want a fast and approximated calculation that does not cascade units.
     *
     * For a precise and cascaded calculation,
     *
     * @see multiply()
     *
     * @param float|int $factor
     *
     * @return $this
     */
    public function times($factor)
    {
        if ($factor < 0) {
            $this->invert = $this->invert ? 0 : 1;
            $factor = -$factor;
        }

        $this->years = (int) round($this->years * $factor);
        $this->months = (int) round($this->months * $factor);
        $this->dayz = (int) round($this->dayz * $factor);
        $this->hours = (int) round($this->hours * $factor);
        $this->minutes = (int) round($this->minutes * $factor);
        $this->seconds = (int) round($this->seconds * $factor);
        $this->microseconds = (int) round($this->microseconds * $factor);

        return $this;
    }

    /**
     * Divide current instance by a given divider. shares() is naive, it divides each unit separately
     * and the result is rounded for each unit. So 5 hours and 20 minutes shared by 3 becomes 2 hours
     * and 7 minutes.
     *
     * Use shares() when you want a fast and approximated calculation that does not cascade units.
     *
     * For a precise and cascaded calculation,
     *
     * @see divide()
     *
     * @param float|int $divider
     *
     * @return $this
     */
    public function shares($divider)
    {
        return $this->times(1 / $divider);
    }

    protected function copyProperties(self $interval, $ignoreSign = false)
    {
        $this->years = $interval->years;
        $this->months = $interval->months;
        $this->dayz = $interval->dayz;
        $this->hours = $interval->hours;
        $this->minutes = $interval->minutes;
        $this->seconds = $interval->seconds;
        $this->microseconds = $interval->microseconds;

        if (!$ignoreSign) {
            $this->invert = $interval->invert;
        }

        return $this;
    }

    /**
     * Multiply and cascade current instance by a given factor.
     *
     * @param float|int $factor
     *
     * @return $this
     */
    public function multiply($factor)
    {
        if ($factor < 0) {
            $this->invert = $this->invert ? 0 : 1;
            $factor = -$factor;
        }

        $yearPart = (int) floor($this->years * $factor); // Split calculation to prevent imprecision

        if ($yearPart) {
            $this->years -= $yearPart / $factor;
        }

        return $this->copyProperties(
            static::create($yearPart)
                ->microseconds(abs($this->totalMicroseconds) * $factor)
                ->cascade(),
            true
        );
    }

    /**
     * Divide and cascade current instance by a given divider.
     *
     * @param float|int $divider
     *
     * @return $this
     */
    public function divide($divider)
    {
        return $this->multiply(1 / $divider);
    }

    /**
     * Get the interval_spec string of a date interval.
     *
     * @param DateInterval $interval
     *
     * @return string
     */
    public static function getDateIntervalSpec(DateInterval $interval)
    {
        $date = array_filter([
            static::PERIOD_YEARS => abs($interval->y),
            static::PERIOD_MONTHS => abs($interval->m),
            static::PERIOD_DAYS => abs($interval->d),
        ]);

        $time = array_filter([
            static::PERIOD_HOURS => abs($interval->h),
            static::PERIOD_MINUTES => abs($interval->i),
            static::PERIOD_SECONDS => abs($interval->s),
        ]);

        $specString = static::PERIOD_PREFIX;

        foreach ($date as $key => $value) {
            $specString .= $value.$key;
        }

        if (\count($time) > 0) {
            $specString .= static::PERIOD_TIME_PREFIX;
            foreach ($time as $key => $value) {
                $specString .= $value.$key;
            }
        }

        return $specString === static::PERIOD_PREFIX ? 'PT0S' : $specString;
    }

    /**
     * Get the interval_spec string.
     *
     * @return string
     */
    public function spec()
    {
        return static::getDateIntervalSpec($this);
    }

    /**
     * Comparing 2 date intervals.
     *
     * @param DateInterval $first
     * @param DateInterval $second
     *
     * @return int
     */
    public static function compareDateIntervals(DateInterval $first, DateInterval $second)
    {
        $current = Carbon::now();
        $passed = $current->avoidMutation()->add($second);
        $current->add($first);

        if ($current < $passed) {
            return -1;
        }
        if ($current > $passed) {
            return 1;
        }

        return 0;
    }

    /**
     * Comparing with passed interval.
     *
     * @param DateInterval $interval
     *
     * @return int
     */
    public function compare(DateInterval $interval)
    {
        return static::compareDateIntervals($this, $interval);
    }

    private function invertCascade(array $values)
    {
        return $this->set(array_map(function ($value) {
            return -$value;
        }, $values))->doCascade(true)->invert();
    }

    private function doCascade(bool $deep)
    {
        $originalData = $this->toArray();
        $originalData['milliseconds'] = (int) ($originalData['microseconds'] / static::getMicrosecondsPerMillisecond());
        $originalData['microseconds'] = $originalData['microseconds'] % static::getMicrosecondsPerMillisecond();
        $originalData['daysExcludeWeeks'] = $originalData['days'];
        unset($originalData['days']);
        $newData = $originalData;

        foreach (self::getFlipCascadeFactors() as $source => [$target, $factor]) {
            foreach (['source', 'target'] as $key) {
                if ($$key === 'dayz') {
                    $$key = 'daysExcludeWeeks';
                }
            }

            $value = $newData[$source];
            $modulo = ($factor + ($value % $factor)) % $factor;
            $newData[$source] = $modulo;
            $newData[$target] += ($value - $modulo) / $factor;
        }

        $positive = null;

        if (!$deep) {
            foreach ($newData as $value) {
                if ($value) {
                    if ($positive === null) {
                        $positive = ($value > 0);

                        continue;
                    }

                    if (($value > 0) !== $positive) {
                        return $this->invertCascade($originalData)
                            ->solveNegativeInterval();
                    }
                }
            }
        }

        return $this->set($newData)
            ->solveNegativeInterval();
    }

    /**
     * Convert overflowed values into bigger units.
     *
     * @return $this
     */
    public function cascade()
    {
        return $this->doCascade(false);
    }

    public function hasNegativeValues(): bool
    {
        foreach ($this->toArray() as $value) {
            if ($value < 0) {
                return true;
            }
        }

        return false;
    }

    public function hasPositiveValues(): bool
    {
        foreach ($this->toArray() as $value) {
            if ($value > 0) {
                return true;
            }
        }

        return false;
    }

    /**
     * Get amount of given unit equivalent to the interval.
     *
     * @param string $unit
     *
     * @throws UnknownUnitException|UnitNotConfiguredException
     *
     * @return float
     */
    public function total($unit)
    {
        $realUnit = $unit = strtolower($unit);

        if (\in_array($unit, ['days', 'weeks'])) {
            $realUnit = 'dayz';
        } elseif (!\in_array($unit, ['microseconds', 'milliseconds', 'seconds', 'minutes', 'hours', 'dayz', 'months', 'years'])) {
            throw new UnknownUnitException($unit);
        }

        $result = 0;
        $cumulativeFactor = 0;
        $unitFound = false;
        $factors = self::getFlipCascadeFactors();
        $daysPerWeek = static::getDaysPerWeek();

        $values = [
            'years' => $this->years,
            'months' => $this->months,
            'weeks' => (int) ($this->d / $daysPerWeek),
            'dayz' => $this->d % $daysPerWeek,
            'hours' => $this->hours,
            'minutes' => $this->minutes,
            'seconds' => $this->seconds,
            'milliseconds' => (int) ($this->microseconds / Carbon::MICROSECONDS_PER_MILLISECOND),
            'microseconds' => $this->microseconds % Carbon::MICROSECONDS_PER_MILLISECOND,
        ];

        if (isset($factors['dayz']) && $factors['dayz'][0] !== 'weeks') {
            $values['dayz'] += $values['weeks'] * $daysPerWeek;
            $values['weeks'] = 0;
        }

        foreach ($factors as $source => [$target, $factor]) {
            if ($source === $realUnit) {
                $unitFound = true;
                $value = $values[$source];
                $result += $value;
                $cumulativeFactor = 1;
            }

            if ($factor === false) {
                if ($unitFound) {
                    break;
                }

                $result = 0;
                $cumulativeFactor = 0;

                continue;
            }

            if ($target === $realUnit) {
                $unitFound = true;
            }

            if ($cumulativeFactor) {
                $cumulativeFactor *= $factor;
                $result += $values[$target] * $cumulativeFactor;

                continue;
            }

            $value = $values[$source];

            $result = ($result + $value) / $factor;
        }

        if (isset($target) && !$cumulativeFactor) {
            $result += $values[$target];
        }

        if (!$unitFound) {
            throw new UnitNotConfiguredException($unit);
        }

        if ($this->invert) {
            $result *= -1;
        }

        if ($unit === 'weeks') {
            return $result / $daysPerWeek;
        }

        return $result;
    }

    /**
     * Determines if the instance is equal to another
     *
     * @param CarbonInterval|DateInterval|mixed $interval
     *
     * @see equalTo()
     *
     * @return bool
     */
    public function eq($interval): bool
    {
        return $this->equalTo($interval);
    }

    /**
     * Determines if the instance is equal to another
     *
     * @param CarbonInterval|DateInterval|mixed $interval
     *
     * @return bool
     */
    public function equalTo($interval): bool
    {
        $interval = $this->resolveInterval($interval);

        return $interval !== null && $this->totalMicroseconds === $interval->totalMicroseconds;
    }

    /**
     * Determines if the instance is not equal to another
     *
     * @param CarbonInterval|DateInterval|mixed $interval
     *
     * @see notEqualTo()
     *
     * @return bool
     */
    public function ne($interval): bool
    {
        return $this->notEqualTo($interval);
    }

    /**
     * Determines if the instance is not equal to another
     *
     * @param CarbonInterval|DateInterval|mixed $interval
     *
     * @return bool
     */
    public function notEqualTo($interval): bool
    {
        return !$this->eq($interval);
    }

    /**
     * Determines if the instance is greater (longer) than another
     *
     * @param CarbonInterval|DateInterval|mixed $interval
     *
     * @see greaterThan()
     *
     * @return bool
     */
    public function gt($interval): bool
    {
        return $this->greaterThan($interval);
    }

    /**
     * Determines if the instance is greater (longer) than another
     *
     * @param CarbonInterval|DateInterval|mixed $interval
     *
     * @return bool
     */
    public function greaterThan($interval): bool
    {
        $interval = $this->resolveInterval($interval);

        return $interval === null || $this->totalMicroseconds > $interval->totalMicroseconds;
    }

    /**
     * Determines if the instance is greater (longer) than or equal to another
     *
     * @param CarbonInterval|DateInterval|mixed $interval
     *
     * @see greaterThanOrEqualTo()
     *
     * @return bool
     */
    public function gte($interval): bool
    {
        return $this->greaterThanOrEqualTo($interval);
    }

    /**
     * Determines if the instance is greater (longer) than or equal to another
     *
     * @param CarbonInterval|DateInterval|mixed $interval
     *
     * @return bool
     */
    public function greaterThanOrEqualTo($interval): bool
    {
        return $this->greaterThan($interval) || $this->equalTo($interval);
    }

    /**
     * Determines if the instance is less (shorter) than another
     *
     * @param CarbonInterval|DateInterval|mixed $interval
     *
     * @see lessThan()
     *
     * @return bool
     */
    public function lt($interval): bool
    {
        return $this->lessThan($interval);
    }

    /**
     * Determines if the instance is less (shorter) than another
     *
     * @param CarbonInterval|DateInterval|mixed $interval
     *
     * @return bool
     */
    public function lessThan($interval): bool
    {
        $interval = $this->resolveInterval($interval);

        return $interval !== null && $this->totalMicroseconds < $interval->totalMicroseconds;
    }

    /**
     * Determines if the instance is less (shorter) than or equal to another
     *
     * @param CarbonInterval|DateInterval|mixed $interval
     *
     * @see lessThanOrEqualTo()
     *
     * @return bool
     */
    public function lte($interval): bool
    {
        return $this->lessThanOrEqualTo($interval);
    }

    /**
     * Determines if the instance is less (shorter) than or equal to another
     *
     * @param CarbonInterval|DateInterval|mixed $interval
     *
     * @return bool
     */
    public function lessThanOrEqualTo($interval): bool
    {
        return $this->lessThan($interval) || $this->equalTo($interval);
    }

    /**
     * Determines if the instance is between two others.
     *
     * The third argument allow you to specify if bounds are included or not (true by default)
     * but for when you including/excluding bounds may produce different results in your application,
     * we recommend to use the explicit methods ->betweenIncluded() or ->betweenExcluded() instead.
     *
     * @example
     * ```
     * CarbonInterval::hours(48)->between(CarbonInterval::day(), CarbonInterval::days(3)); // true
     * CarbonInterval::hours(48)->between(CarbonInterval::day(), CarbonInterval::hours(36)); // false
     * CarbonInterval::hours(48)->between(CarbonInterval::day(), CarbonInterval::days(2)); // true
     * CarbonInterval::hours(48)->between(CarbonInterval::day(), CarbonInterval::days(2), false); // false
     * ```
     *
     * @param CarbonInterval|DateInterval|mixed $interval1
     * @param CarbonInterval|DateInterval|mixed $interval2
     * @param bool                              $equal     Indicates if an equal to comparison should be done
     *
     * @return bool
     */
    public function between($interval1, $interval2, $equal = true): bool
    {
        return $equal
            ? $this->greaterThanOrEqualTo($interval1) && $this->lessThanOrEqualTo($interval2)
            : $this->greaterThan($interval1) && $this->lessThan($interval2);
    }

    /**
     * Determines if the instance is between two others, bounds excluded.
     *
     * @example
     * ```
     * CarbonInterval::hours(48)->betweenExcluded(CarbonInterval::day(), CarbonInterval::days(3)); // true
     * CarbonInterval::hours(48)->betweenExcluded(CarbonInterval::day(), CarbonInterval::hours(36)); // false
     * CarbonInterval::hours(48)->betweenExcluded(CarbonInterval::day(), CarbonInterval::days(2)); // true
     * ```
     *
     * @param CarbonInterval|DateInterval|mixed $interval1
     * @param CarbonInterval|DateInterval|mixed $interval2
     *
     * @return bool
     */
    public function betweenIncluded($interval1, $interval2): bool
    {
        return $this->between($interval1, $interval2, true);
    }

    /**
     * Determines if the instance is between two others, bounds excluded.
     *
     * @example
     * ```
     * CarbonInterval::hours(48)->betweenExcluded(CarbonInterval::day(), CarbonInterval::days(3)); // true
     * CarbonInterval::hours(48)->betweenExcluded(CarbonInterval::day(), CarbonInterval::hours(36)); // false
     * CarbonInterval::hours(48)->betweenExcluded(CarbonInterval::day(), CarbonInterval::days(2)); // false
     * ```
     *
     * @param CarbonInterval|DateInterval|mixed $interval1
     * @param CarbonInterval|DateInterval|mixed $interval2
     *
     * @return bool
     */
    public function betweenExcluded($interval1, $interval2): bool
    {
        return $this->between($interval1, $interval2, false);
    }

    /**
     * Determines if the instance is between two others
     *
     * @example
     * ```
     * CarbonInterval::hours(48)->isBetween(CarbonInterval::day(), CarbonInterval::days(3)); // true
     * CarbonInterval::hours(48)->isBetween(CarbonInterval::day(), CarbonInterval::hours(36)); // false
     * CarbonInterval::hours(48)->isBetween(CarbonInterval::day(), CarbonInterval::days(2)); // true
     * CarbonInterval::hours(48)->isBetween(CarbonInterval::day(), CarbonInterval::days(2), false); // false
     * ```
     *
     * @param CarbonInterval|DateInterval|mixed $interval1
     * @param CarbonInterval|DateInterval|mixed $interval2
     * @param bool                              $equal     Indicates if an equal to comparison should be done
     *
     * @return bool
     */
    public function isBetween($interval1, $interval2, $equal = true): bool
    {
        return $this->between($interval1, $interval2, $equal);
    }

    /**
     * Round the current instance at the given unit with given precision if specified and the given function.
     *
     * @param string                             $unit
     * @param float|int|string|DateInterval|null $precision
     * @param string                             $function
     *
     * @throws Exception
     *
     * @return $this
     */
    public function roundUnit($unit, $precision = 1, $function = 'round')
    {
        $base = CarbonImmutable::parse('2000-01-01 00:00:00', 'UTC')
            ->roundUnit($unit, $precision, $function);
        $next = $base->add($this);
        $inverted = $next < $base;

        if ($inverted) {
            $next = $base->sub($this);
        }

        $this->copyProperties(
            $next
                ->roundUnit($unit, $precision, $function)
                ->diffAsCarbonInterval($base)
        );

        return $this->invert($inverted);
    }

    /**
     * Truncate the current instance at the given unit with given precision if specified.
     *
     * @param string                             $unit
     * @param float|int|string|DateInterval|null $precision
     *
     * @throws Exception
     *
     * @return $this
     */
    public function floorUnit($unit, $precision = 1)
    {
        return $this->roundUnit($unit, $precision, 'floor');
    }

    /**
     * Ceil the current instance at the given unit with given precision if specified.
     *
     * @param string                             $unit
     * @param float|int|string|DateInterval|null $precision
     *
     * @throws Exception
     *
     * @return $this
     */
    public function ceilUnit($unit, $precision = 1)
    {
        return $this->roundUnit($unit, $precision, 'ceil');
    }

    /**
     * Round the current instance second with given precision if specified.
     *
     * @param float|int|string|DateInterval|null $precision
     * @param string                             $function
     *
     * @throws Exception
     *
     * @return $this
     */
    public function round($precision = 1, $function = 'round')
    {
        return $this->roundWith($precision, $function);
    }

    /**
     * Round the current instance second with given precision if specified.
     *
     * @param float|int|string|DateInterval|null $precision
     *
     * @throws Exception
     *
     * @return $this
     */
    public function floor($precision = 1)
    {
        return $this->round($precision, 'floor');
    }

    /**
     * Ceil the current instance second with given precision if specified.
     *
     * @param float|int|string|DateInterval|null $precision
     *
     * @throws Exception
     *
     * @return $this
     */
    public function ceil($precision = 1)
    {
        return $this->round($precision, 'ceil');
    }

    private function needsDeclension(string $mode, int $index, int $parts): bool
    {
        switch ($mode) {
            case 'last':
                return $index === $parts - 1;
            default:
                return true;
        }
    }
}
