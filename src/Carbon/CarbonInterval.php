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

use BadMethodCallException;
use Carbon\Exceptions\ParseErrorException;
use Carbon\Traits\Mixin;
use Carbon\Traits\Options;
use Closure;
use DateInterval;
use Exception;
use InvalidArgumentException;

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
 * @property-read int $dayzExcludeWeeks Total days remaining in the final week of the current instance (days % 7).
 * @property-read int $daysExcludeWeeks alias of dayzExcludeWeeks
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
 * @method static CarbonInterval years($years = 1) Create instance specifying a number of years.
 * @method static CarbonInterval year($years = 1) Alias for years()
 * @method static CarbonInterval months($months = 1) Create instance specifying a number of months.
 * @method static CarbonInterval month($months = 1) Alias for months()
 * @method static CarbonInterval weeks($weeks = 1) Create instance specifying a number of weeks.
 * @method static CarbonInterval week($weeks = 1) Alias for weeks()
 * @method static CarbonInterval days($days = 1) Create instance specifying a number of days.
 * @method static CarbonInterval dayz($days = 1) Alias for days()
 * @method static CarbonInterval day($days = 1) Alias for days()
 * @method static CarbonInterval hours($hours = 1) Create instance specifying a number of hours.
 * @method static CarbonInterval hour($hours = 1) Alias for hours()
 * @method static CarbonInterval minutes($minutes = 1) Create instance specifying a number of minutes.
 * @method static CarbonInterval minute($minutes = 1) Alias for minutes()
 * @method static CarbonInterval seconds($seconds = 1) Create instance specifying a number of seconds.
 * @method static CarbonInterval second($seconds = 1) Alias for seconds()
 * @method static CarbonInterval milliseconds($milliseconds = 1) Create instance specifying a number of milliseconds.
 * @method static CarbonInterval millisecond($milliseconds = 1) Alias for milliseconds()
 * @method static CarbonInterval microseconds($microseconds = 1) Create instance specifying a number of microseconds.
 * @method static CarbonInterval microsecond($microseconds = 1) Alias for microseconds()
 * @method $this years($years = 1) Set the years portion of the current interval.
 * @method $this year($years = 1) Alias for years().
 * @method $this months($months = 1) Set the months portion of the current interval.
 * @method $this month($months = 1) Alias for months().
 * @method $this weeks($weeks = 1) Set the weeks portion of the current interval.  Will overwrite dayz value.
 * @method $this week($weeks = 1) Alias for weeks().
 * @method $this days($days = 1) Set the days portion of the current interval.
 * @method $this dayz($days = 1) Alias for days().
 * @method $this day($days = 1) Alias for days().
 * @method $this hours($hours = 1) Set the hours portion of the current interval.
 * @method $this hour($hours = 1) Alias for hours().
 * @method $this minutes($minutes = 1) Set the minutes portion of the current interval.
 * @method $this minute($minutes = 1) Alias for minutes().
 * @method $this seconds($seconds = 1) Set the seconds portion of the current interval.
 * @method $this second($seconds = 1) Alias for seconds().
 * @method $this milliseconds($seconds = 1) Set the seconds portion of the current interval.
 * @method $this millisecond($seconds = 1) Alias for seconds().
 * @method $this microseconds($seconds = 1) Set the seconds portion of the current interval.
 * @method $this microsecond($seconds = 1) Alias for seconds().
 * @method $this roundYear(float $precision = 1, string $function = "round") Round the current instance year with given precision using the given function.
 * @method $this roundYears(float $precision = 1, string $function = "round") Round the current instance year with given precision using the given function.
 * @method $this floorYear(float $precision = 1) Truncate the current instance year with given precision.
 * @method $this floorYears(float $precision = 1) Truncate the current instance year with given precision.
 * @method $this ceilYear(float $precision = 1) Ceil the current instance year with given precision.
 * @method $this ceilYears(float $precision = 1) Ceil the current instance year with given precision.
 * @method $this roundMonth(float $precision = 1, string $function = "round") Round the current instance month with given precision using the given function.
 * @method $this roundMonths(float $precision = 1, string $function = "round") Round the current instance month with given precision using the given function.
 * @method $this floorMonth(float $precision = 1) Truncate the current instance month with given precision.
 * @method $this floorMonths(float $precision = 1) Truncate the current instance month with given precision.
 * @method $this ceilMonth(float $precision = 1) Ceil the current instance month with given precision.
 * @method $this ceilMonths(float $precision = 1) Ceil the current instance month with given precision.
 * @method $this roundWeek(float $precision = 1, string $function = "round") Round the current instance day with given precision using the given function.
 * @method $this roundWeeks(float $precision = 1, string $function = "round") Round the current instance day with given precision using the given function.
 * @method $this floorWeek(float $precision = 1) Truncate the current instance day with given precision.
 * @method $this floorWeeks(float $precision = 1) Truncate the current instance day with given precision.
 * @method $this ceilWeek(float $precision = 1) Ceil the current instance day with given precision.
 * @method $this ceilWeeks(float $precision = 1) Ceil the current instance day with given precision.
 * @method $this roundDay(float $precision = 1, string $function = "round") Round the current instance day with given precision using the given function.
 * @method $this roundDays(float $precision = 1, string $function = "round") Round the current instance day with given precision using the given function.
 * @method $this floorDay(float $precision = 1) Truncate the current instance day with given precision.
 * @method $this floorDays(float $precision = 1) Truncate the current instance day with given precision.
 * @method $this ceilDay(float $precision = 1) Ceil the current instance day with given precision.
 * @method $this ceilDays(float $precision = 1) Ceil the current instance day with given precision.
 * @method $this roundHour(float $precision = 1, string $function = "round") Round the current instance hour with given precision using the given function.
 * @method $this roundHours(float $precision = 1, string $function = "round") Round the current instance hour with given precision using the given function.
 * @method $this floorHour(float $precision = 1) Truncate the current instance hour with given precision.
 * @method $this floorHours(float $precision = 1) Truncate the current instance hour with given precision.
 * @method $this ceilHour(float $precision = 1) Ceil the current instance hour with given precision.
 * @method $this ceilHours(float $precision = 1) Ceil the current instance hour with given precision.
 * @method $this roundMinute(float $precision = 1, string $function = "round") Round the current instance minute with given precision using the given function.
 * @method $this roundMinutes(float $precision = 1, string $function = "round") Round the current instance minute with given precision using the given function.
 * @method $this floorMinute(float $precision = 1) Truncate the current instance minute with given precision.
 * @method $this floorMinutes(float $precision = 1) Truncate the current instance minute with given precision.
 * @method $this ceilMinute(float $precision = 1) Ceil the current instance minute with given precision.
 * @method $this ceilMinutes(float $precision = 1) Ceil the current instance minute with given precision.
 * @method $this roundSecond(float $precision = 1, string $function = "round") Round the current instance second with given precision using the given function.
 * @method $this roundSeconds(float $precision = 1, string $function = "round") Round the current instance second with given precision using the given function.
 * @method $this floorSecond(float $precision = 1) Truncate the current instance second with given precision.
 * @method $this floorSeconds(float $precision = 1) Truncate the current instance second with given precision.
 * @method $this ceilSecond(float $precision = 1) Ceil the current instance second with given precision.
 * @method $this ceilSeconds(float $precision = 1) Ceil the current instance second with given precision.
 * @method $this roundMillennium(float $precision = 1, string $function = "round") Round the current instance millennium with given precision using the given function.
 * @method $this roundMillennia(float $precision = 1, string $function = "round") Round the current instance millennium with given precision using the given function.
 * @method $this floorMillennium(float $precision = 1) Truncate the current instance millennium with given precision.
 * @method $this floorMillennia(float $precision = 1) Truncate the current instance millennium with given precision.
 * @method $this ceilMillennium(float $precision = 1) Ceil the current instance millennium with given precision.
 * @method $this ceilMillennia(float $precision = 1) Ceil the current instance millennium with given precision.
 * @method $this roundCentury(float $precision = 1, string $function = "round") Round the current instance century with given precision using the given function.
 * @method $this roundCenturies(float $precision = 1, string $function = "round") Round the current instance century with given precision using the given function.
 * @method $this floorCentury(float $precision = 1) Truncate the current instance century with given precision.
 * @method $this floorCenturies(float $precision = 1) Truncate the current instance century with given precision.
 * @method $this ceilCentury(float $precision = 1) Ceil the current instance century with given precision.
 * @method $this ceilCenturies(float $precision = 1) Ceil the current instance century with given precision.
 * @method $this roundDecade(float $precision = 1, string $function = "round") Round the current instance decade with given precision using the given function.
 * @method $this roundDecades(float $precision = 1, string $function = "round") Round the current instance decade with given precision using the given function.
 * @method $this floorDecade(float $precision = 1) Truncate the current instance decade with given precision.
 * @method $this floorDecades(float $precision = 1) Truncate the current instance decade with given precision.
 * @method $this ceilDecade(float $precision = 1) Ceil the current instance decade with given precision.
 * @method $this ceilDecades(float $precision = 1) Ceil the current instance decade with given precision.
 * @method $this roundQuarter(float $precision = 1, string $function = "round") Round the current instance quarter with given precision using the given function.
 * @method $this roundQuarters(float $precision = 1, string $function = "round") Round the current instance quarter with given precision using the given function.
 * @method $this floorQuarter(float $precision = 1) Truncate the current instance quarter with given precision.
 * @method $this floorQuarters(float $precision = 1) Truncate the current instance quarter with given precision.
 * @method $this ceilQuarter(float $precision = 1) Ceil the current instance quarter with given precision.
 * @method $this ceilQuarters(float $precision = 1) Ceil the current instance quarter with given precision.
 * @method $this roundMillisecond(float $precision = 1, string $function = "round") Round the current instance millisecond with given precision using the given function.
 * @method $this roundMilliseconds(float $precision = 1, string $function = "round") Round the current instance millisecond with given precision using the given function.
 * @method $this floorMillisecond(float $precision = 1) Truncate the current instance millisecond with given precision.
 * @method $this floorMilliseconds(float $precision = 1) Truncate the current instance millisecond with given precision.
 * @method $this ceilMillisecond(float $precision = 1) Ceil the current instance millisecond with given precision.
 * @method $this ceilMilliseconds(float $precision = 1) Ceil the current instance millisecond with given precision.
 * @method $this roundMicrosecond(float $precision = 1, string $function = "round") Round the current instance microsecond with given precision using the given function.
 * @method $this roundMicroseconds(float $precision = 1, string $function = "round") Round the current instance microsecond with given precision using the given function.
 * @method $this floorMicrosecond(float $precision = 1) Truncate the current instance microsecond with given precision.
 * @method $this floorMicroseconds(float $precision = 1) Truncate the current instance microsecond with given precision.
 * @method $this ceilMicrosecond(float $precision = 1) Ceil the current instance microsecond with given precision.
 * @method $this ceilMicroseconds(float $precision = 1) Ceil the current instance microsecond with given precision.
 */
class CarbonInterval extends DateInterval
{
    use Options, Mixin {
        Mixin::mixin as baseMixin;
    }

    /**
     * Interval spec period designators
     */
    const PERIOD_PREFIX = 'P';
    const PERIOD_YEARS = 'Y';
    const PERIOD_MONTHS = 'M';
    const PERIOD_DAYS = 'D';
    const PERIOD_TIME_PREFIX = 'T';
    const PERIOD_HOURS = 'H';
    const PERIOD_MINUTES = 'M';
    const PERIOD_SECONDS = 'S';

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
            'months' => [Carbon::DAYS_PER_WEEK * Carbon::WEEKS_PER_MONTH, 'dayz'],
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
     * @param int|null $years
     * @param int|null $months
     * @param int|null $weeks
     * @param int|null $days
     * @param int|null $hours
     * @param int|null $minutes
     * @param int|null $seconds
     * @param int|null $microseconds
     *
     * @throws Exception when the interval_spec (passed as $years) cannot be parsed as an interval.
     */
    public function __construct($years = 1, $months = null, $weeks = null, $days = null, $hours = null, $minutes = null, $seconds = null, $microseconds = null)
    {
        $spec = $years;

        if (!is_string($spec) || floatval($years) || preg_match('/^[0-9.]/', $years)) {
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

        if (!is_null($microseconds)) {
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
        $factors = static::getFlipCascadeFactors();
        if (isset($factors[$source])) {
            [$to, $factor] = $factors[$source];
            if ($to === $target) {
                return $factor;
            }
        }

        return null;
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
     * @param string $format   Format of the $interval input string
     * @param string $interval Input string to convert into an interval
     *
     * @throws Exception when the $interval cannot be parsed as an interval.
     *
     * @return static
     */
    public static function createFromFormat(string $format, ?string $interval)
    {
        $instance = new static(0);
        $length = mb_strlen($format);

        if (preg_match('/s([,.])([uv])$/', $format, $match)) {
            $interval = explode($match[1], $interval);
            $index = count($interval) - 1;
            $interval[$index] = str_pad($interval[$index], $match[2] === 'v' ? 3 : 6, '0');
            $interval = implode($match[1], $interval);
        }

        for ($index = 0; $index < $length; $index++) {
            $expected = mb_substr($format, $index, 1);
            $nextCharacter = mb_substr($interval, 0, 1);
            $unit = static::$formats[$expected] ?? null;

            if ($unit) {
                if (!preg_match('/^-?\d+/', $interval, $match)) {
                    throw new ParseErrorException('number', $nextCharacter);
                }

                $interval = mb_substr($interval, mb_strlen($match[0]));
                $instance->$unit += intval($match[0]);

                continue;
            }

            if ($nextCharacter !== $expected) {
                throw new ParseErrorException(
                    "'$expected'",
                    $nextCharacter,
                    'Allowed substitutes for interval formats are '.implode(', ', array_keys(static::$formats))."\n".
                    'See https://www.php.net/manual/en/function.date.php for their meaning'
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
        $date = new static($this->spec());
        $date->invert = $this->invert;
        $date->f = $this->f;

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
        $arg = count($parameters) === 0 ? 1 : $parameters[0];

        switch (Carbon::singularUnit(rtrim($method, 'z'))) {
            case 'year':
                return new static($arg);

            case 'month':
                return new static(null, $arg);

            case 'week':
                return new static(null, null, $arg);

            case 'day':
                return new static(null, null, null, $arg);

            case 'hour':
                return new static(null, null, null, null, $arg);

            case 'minute':
                return new static(null, null, null, null, null, $arg);

            case 'second':
                return new static(null, null, null, null, null, null, $arg);

            case 'millisecond':
            case 'milli':
                return new static(null, null, null, null, null, null, null, $arg * Carbon::MICROSECONDS_PER_MILLISECOND);

            case 'microsecond':
            case 'micro':
                return new static(null, null, null, null, null, null, null, $arg);
        }

        if (static::hasMacro($method)) {
            return (new static(0))->$method(...$parameters);
        }

        if (Carbon::isStrictModeEnabled()) {
            throw new BadMethodCallException(sprintf("Unknown fluent constructor '%s'.", $method));
        }

        return null;
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
            $intValue = intval($value);
            $fraction = floatval($value) - $intValue;

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
                    throw new InvalidArgumentException(
                        sprintf('Invalid part %s in definition %s', $part, $intervalDefinition)
                    );
            }
        }

        return new static($years, $months, $weeks, $days, $hours, $minutes, $seconds, $milliseconds * Carbon::MICROSECONDS_PER_MILLISECOND + $microseconds);
    }

    /**
     * Creates a CarbonInterval from string using a different locale.
     *
     * @param string $interval
     * @param string $locale
     *
     * @return static
     */
    public static function parseFromLocale($interval, $locale)
    {
        return static::fromString(Carbon::translateTimeString($interval, $locale, 'en'));
    }

    private static function castIntervalToClass(DateInterval $interval, string $className)
    {
        $mainClass = DateInterval::class;

        if (!is_a($className, $mainClass, true)) {
            throw new InvalidArgumentException("$className is not a sub-class of $mainClass.");
        }

        $microseconds = $interval->f;
        $instance = new $className(static::getDateIntervalSpec($interval));
        if ($microseconds) {
            $instance->f = $microseconds;
        }
        $instance->invert = $interval->invert;
        foreach (['y', 'm', 'd', 'h', 'i', 's'] as $unit) {
            if ($interval->$unit < 0) {
                $instance->$unit *= -1;
            }
        }

        return $instance;
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
     * @param mixed $var
     *
     * @return static|null
     */
    public static function make($var)
    {
        if ($var instanceof DateInterval) {
            return static::instance($var);
        }

        if (!is_string($var)) {
            return null;
        }

        $var = trim($var);

        if (preg_match('/^P[T0-9]/', $var)) {
            return new static($var);
        }

        if (preg_match('/^(?:\h*\d+(?:\.\d+)?\h*[a-z]+)+$/i', $var)) {
            return static::fromString($var);
        }

        /** @var static $interval */
        $interval = static::createFromDateString($var);

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
     * @link http://php.net/manual/en/dateinterval.createfromdatestring.php
     */
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
     * @throws InvalidArgumentException
     *
     * @return int|float|string
     */
    public function __get($name)
    {
        if (substr($name, 0, 5) === 'total') {
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
                return (int) floor(round($this->f * Carbon::MICROSECONDS_PER_SECOND) / Carbon::MICROSECONDS_PER_MILLISECOND);

            case 'micro':
            case 'microseconds':
                return (int) round($this->f * Carbon::MICROSECONDS_PER_SECOND);

            case 'weeks':
                return (int) floor($this->d / static::getDaysPerWeek());

            case 'daysExcludeWeeks':
            case 'dayzExcludeWeeks':
                return $this->d % static::getDaysPerWeek();

            case 'locale':
                return $this->getLocalTranslator()->getLocale();

            default:
                throw new InvalidArgumentException(sprintf("Unknown getter '%s'", $name));
        }
    }

    /**
     * Set a part of the CarbonInterval object.
     *
     * @param string $name
     * @param int    $value
     *
     * @throws InvalidArgumentException
     */
    public function __set($name, $value)
    {
        switch (Carbon::singularUnit(rtrim($name, 'z'))) {
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
                    throw new InvalidArgumentException(sprintf("Unknown setter '%s'", $name));
                }

                $this->$name = $value;
        }
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
     * @throws \ReflectionException
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

            return call_user_func_array($boundMacro ?: $macro, $parameters);
        }

        return call_user_func_array($macro, $parameters);
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
     * @return static
     */
    public function __call($method, $parameters)
    {
        if (static::hasMacro($method)) {
            return static::bindMacroContext($this, function () use (&$method, &$parameters) {
                return $this->callMacro($method, $parameters);
            });
        }

        $action = substr($method, 0, 4);

        if ($action !== 'ceil') {
            $action = substr($method, 0, 5);
        }

        if (in_array($action, ['round', 'floor', 'ceil'])) {
            return $this->{$action.'Unit'}(substr($method, strlen($action)), ...$parameters);
        }

        $arg = count($parameters) === 0 ? 1 : $parameters[0];

        switch (Carbon::singularUnit(rtrim($method, 'z'))) {
            case 'year':
                $this->years = $arg;

                break;

            case 'month':
                $this->months = $arg;

                break;

            case 'week':
                $this->dayz = $arg * static::getDaysPerWeek();

                break;

            case 'day':
                $this->dayz = $arg;

                break;

            case 'hour':
                $this->hours = $arg;

                break;

            case 'minute':
                $this->minutes = $arg;

                break;

            case 'second':
                $this->seconds = $arg;

                break;

            case 'milli':
            case 'millisecond':
                $this->milliseconds = $arg;

                break;

            case 'micro':
            case 'microsecond':
                $this->microseconds = $arg;

                break;

            default:
                if ($this->localStrictModeEnabled ?? Carbon::isStrictModeEnabled()) {
                    throw new BadMethodCallException(sprintf("Unknown fluent setter '%s'", $method));
                }
        }

        return $this;
    }

    /**
     * @SuppressWarnings(PHPMD.ElseExpression)
     *
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

        if (is_array($syntax)) {
            extract($syntax);
        } else {
            if (is_int($short)) {
                $parts = $short;
                $short = false;
            }

            if (is_bool($syntax)) {
                $short = $syntax;
                $syntax = CarbonInterface::DIFF_ABSOLUTE;
            }
        }

        if (is_null($syntax)) {
            $syntax = CarbonInterface::DIFF_ABSOLUTE;
        }

        if ($parts === -1) {
            $parts = INF;
        }

        if (is_null($options)) {
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

        if ($altNumbers) {
            if ($altNumbers !== true) {
                $language = new Language($this->locale);
                $altNumbers = in_array($language->getCode(), (array) $altNumbers);
            }
        }

        if (is_array($join)) {
            [$default, $last] = $join;

            if ($default !== ' ') {
                $optionalSpace = '';
            }

            $join = function ($list) use ($default, $last) {
                if (count($list) < 2) {
                    return implode('', $list);
                }

                $end = array_pop($list);

                return implode($default, $list).$last.$end;
            };
        }

        if (is_string($join)) {
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

        return [$syntax, $short, $parts, $options, $join, $aUnit, $altNumbers, $interpolations];
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
        $lastKey = $keys[count($keys) - 1];
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
     * ```
     *
     * @param int|array $syntax  if array passed, parameters will be extracted from it, the array may contains:
     *                           - 'syntax' entry (see below)
     *                           - 'short' entry (see below)
     *                           - 'parts' entry (see below)
     *                           - 'options' entry (see below)
     *                           - 'aUnit' entry, prefer "an hour" over "1 hour" if true
     *                           - 'join' entry determines how to join multiple parts of the string
     *                           `  - if $join is a string, it's used as a joiner glue
     *                           `  - if $join is a callable/closure, it get the list of string and should return a string
     *                           `  - if $join is an array, the first item will be the default glue, and the second item
     *                           `    will be used instead of the glue for the last item
     *                           `  - if $join is true, it will be guessed from the locale ('list' translation file entry)
     *                           `  - if $join is missing, a space will be used as glue
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
     * @return string
     */
    public function forHumans($syntax = null, $short = false, $parts = -1, $options = null)
    {
        [$syntax, $short, $parts, $options, $join, $aUnit, $altNumbers, $interpolations] = $this->getForHumansParameters($syntax, $short, $parts, $options);

        $interval = [];

        $syntax = (int) ($syntax === null ? CarbonInterface::DIFF_ABSOLUTE : $syntax);
        $absolute = $syntax === CarbonInterface::DIFF_ABSOLUTE;
        $relativeToNow = $syntax === CarbonInterface::DIFF_RELATIVE_TO_NOW;
        $count = 1;
        $unit = $short ? 's' : 'second';
        $isFuture = $this->invert === 1;
        $transId = $relativeToNow ? ($isFuture ? 'from_now' : 'ago') : ($isFuture ? 'after' : 'before');

        /** @var \Symfony\Component\Translation\Translator $translator */
        $translator = $this->getLocalTranslator();

        $handleDeclensions = function ($unit, $count) use ($interpolations, $transId, $translator, $altNumbers) {
            // Some languages have special pluralization for past and future tense.
            $key = $unit.'_'.$transId;
            $result = $this->translate($key, $interpolations, $count, $translator, $altNumbers);

            if ($result !== $key) {
                return $result;
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
            while (
                count($intervalValues->getNonZeroValues()) > $parts &&
                ($count = count($keys = array_keys($intervalValues->getValuesSequence()))) > 1
            ) {
                $intervalValues = $this->copy()->roundUnit($keys[$count - 2], 1, $method);
            }
        }

        $diffIntervalArray = [
            ['value' => $intervalValues->years,            'unit' => 'year',   'unitShort' => 'y'],
            ['value' => $intervalValues->months,           'unit' => 'month',  'unitShort' => 'm'],
            ['value' => $intervalValues->weeks,            'unit' => 'week',   'unitShort' => 'w'],
            ['value' => $intervalValues->daysExcludeWeeks, 'unit' => 'day',    'unitShort' => 'd'],
            ['value' => $intervalValues->hours,            'unit' => 'hour',   'unitShort' => 'h'],
            ['value' => $intervalValues->minutes,          'unit' => 'minute', 'unitShort' => 'min'],
            ['value' => $intervalValues->seconds,          'unit' => 'second', 'unitShort' => 's'],
        ];

        $transChoice = function ($short, $unitData) use ($handleDeclensions, $translator, $aUnit, $altNumbers, $interpolations) {
            $count = $unitData['value'];

            if ($short) {
                $result = $handleDeclensions($unitData['unitShort'], $count);

                if ($result !== null) {
                    return $result;
                }
            } elseif ($aUnit) {
                $result = $handleDeclensions('a_'.$unitData['unit'], $count);

                if ($result !== null) {
                    return $result;
                }
            }

            return $this->translate($unitData['unit'], $interpolations, $count, $translator, $altNumbers);
        };

        foreach ($diffIntervalArray as $diffIntervalData) {
            if ($diffIntervalData['value'] > 0) {
                $unit = $short ? $diffIntervalData['unitShort'] : $diffIntervalData['unit'];
                $count = $diffIntervalData['value'];
                $interval[] = $transChoice($short, $diffIntervalData);
            } elseif ($options & CarbonInterface::SEQUENTIAL_PARTS_ONLY && count($interval) > 0) {
                break;
            }

            // break the loop after we get the required number of parts in array
            if (count($interval) >= $parts) {
                break;
            }
        }

        if (count($interval) === 0) {
            if ($relativeToNow && $options & CarbonInterface::JUST_NOW) {
                $key = 'diff_now';
                $translation = $this->translate($key, $interpolations, null, $translator);

                if ($translation !== $key) {
                    return $translation;
                }
            }

            $count = $options & CarbonInterface::NO_ZERO_DIFF ? 1 : 0;
            $unit = $short ? 's' : 'second';
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

            $aTime = $aUnit ? $handleDeclensions('a_'.$unit.'_'.$transId, $count) : null;

            $time = $aTime ?: $handleDeclensions($unit.'_'.$transId, $count) ?: $time;
        }

        $time = [':time' => $time];

        return $this->translate($transId, array_merge($time, $interpolations, $time), null, $translator);
    }

    /**
     * Format the instance as a string using the forHumans() function.
     *
     * @return string
     */
    public function __toString()
    {
        return $this->forHumans();
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
     * @return CarbonPeriod
     */
    public function toPeriod(...$params)
    {
        return CarbonPeriod::create($this, ...$params);
    }

    /**
     * Invert the interval.
     *
     * @return $this
     */
    public function invert()
    {
        $this->invert = $this->invert ? 0 : 1;

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
     * @param int                 $value
     *
     * @return static
     */
    public function add($unit, $value = 1)
    {
        if (is_numeric($unit)) {
            [$value, $unit] = [$unit, $value];
        }

        if (is_string($unit) && !preg_match('/^\s*\d/', $unit)) {
            $unit = "$value $unit";
            $value = 1;
        }

        $interval = static::make($unit);

        if (!$interval) {
            throw new InvalidArgumentException('This type of data cannot be added/subtracted.');
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
     * @param int                 $value
     *
     * @return static
     */
    public function sub($unit, $value = 1)
    {
        if (is_numeric($unit)) {
            [$value, $unit] = [$unit, $value];
        }

        return $this->add($unit, -floatval($value));
    }

    /**
     * Subtract the passed interval to the current instance.
     *
     * @param string|DateInterval $unit
     * @param int                 $value
     *
     * @return static
     */
    public function subtract($unit, $value = 1)
    {
        return $this->sub($unit, $value);
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
            static::__callStatic('years', [$yearPart])
                ->microseconds($this->totalMicroseconds * $factor)
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

        if (count($time) > 0) {
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
        $passed = $current->copy()->add($second);
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

    /**
     * Convert overflowed values into bigger units.
     *
     * @return $this
     */
    public function cascade()
    {
        foreach (static::getFlipCascadeFactors() as $source => [$target, $factor]) {
            if ($source === 'dayz' && $target === 'weeks') {
                continue;
            }

            $value = $this->$source;
            $this->$source = $modulo = ($factor + ($value % $factor)) % $factor;
            $this->$target += ($value - $modulo) / $factor;
            if ($this->$source > 0 && $this->$target < 0) {
                $this->$source -= $factor;
                $this->$target++;
            }
        }

        return $this->solveNegativeInterval();
    }

    /**
     * Get amount of given unit equivalent to the interval.
     *
     * @param string $unit
     *
     * @throws InvalidArgumentException
     *
     * @return float
     */
    public function total($unit)
    {
        $realUnit = $unit = strtolower($unit);

        if (in_array($unit, ['days', 'weeks'])) {
            $realUnit = 'dayz';
        } elseif (!in_array($unit, ['microseconds', 'milliseconds', 'seconds', 'minutes', 'hours', 'dayz', 'months', 'years'])) {
            throw new InvalidArgumentException("Unknown unit '$unit'.");
        }

        $result = 0;
        $cumulativeFactor = 0;
        $unitFound = false;
        $factors = static::getFlipCascadeFactors();

        foreach ($factors as $source => [$target, $factor]) {
            if ($source === $realUnit) {
                $unitFound = true;
                $value = $this->$source;
                if ($source === 'microseconds' && isset($factors['milliseconds'])) {
                    $value %= Carbon::MICROSECONDS_PER_MILLISECOND;
                }
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
                $result += $this->$target * $cumulativeFactor;

                continue;
            }

            $value = $this->$source;

            if ($source === 'microseconds' && isset($factors['milliseconds'])) {
                $value %= Carbon::MICROSECONDS_PER_MILLISECOND;
            }

            $result = ($result + $value) / $factor;
        }

        if (isset($target) && !$cumulativeFactor) {
            $result += $this->$target;
        }

        if (!$unitFound) {
            throw new InvalidArgumentException("Unit $unit have no configuration to get total from other units.");
        }

        if ($unit === 'weeks') {
            return $result / static::getDaysPerWeek();
        }

        return $result;
    }

    /**
     * Determines if the instance is equal to another
     *
     * @param \Carbon\CarbonInterval|DateInterval|mixed $interval
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
     * @param \Carbon\CarbonInterval|DateInterval|mixed $interval
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
     * @param \Carbon\CarbonInterval|DateInterval|mixed $interval
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
     * @param \Carbon\CarbonInterval|DateInterval|mixed $interval
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
     * @param \Carbon\CarbonInterval|DateInterval|mixed $interval
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
     * @param \Carbon\CarbonInterval|DateInterval|mixed $interval
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
     * @param \Carbon\CarbonInterval|DateInterval|mixed $interval
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
     * @param \Carbon\CarbonInterval|DateInterval|mixed $interval
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
     * @param \Carbon\CarbonInterval|DateInterval|mixed $interval
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
     * @param \Carbon\CarbonInterval|DateInterval|mixed $interval
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
     * @param \Carbon\CarbonInterval|DateInterval|mixed $interval
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
     * @param \Carbon\CarbonInterval|DateInterval|mixed $interval
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
     * @example
     * ```
     * CarbonInterval::hours(48)->between(CarbonInterval::day(), CarbonInterval::days(3)); // true
     * CarbonInterval::hours(48)->between(CarbonInterval::day(), CarbonInterval::hours(36)); // false
     * CarbonInterval::hours(48)->between(CarbonInterval::day(), CarbonInterval::days(2)); // true
     * CarbonInterval::hours(48)->between(CarbonInterval::day(), CarbonInterval::days(2), false); // false
     * ```
     *
     * @param \Carbon\CarbonInterval|\DateInterval|mixed $interval1
     * @param \Carbon\CarbonInterval|\DateInterval|mixed $interval2
     * @param bool                                       $equal     Indicates if an equal to comparison should be done
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
     * CarbonInterval::hours(48)->betweenExcluded(CarbonInterval::day(), CarbonInterval::days(2)); // false
     * ```
     *
     * @param \Carbon\CarbonInterval|\DateInterval|mixed $interval1
     * @param \Carbon\CarbonInterval|\DateInterval|mixed $interval2
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
     * @param \Carbon\CarbonInterval|\DateInterval|mixed $interval1
     * @param \Carbon\CarbonInterval|\DateInterval|mixed $interval2
     * @param bool                                       $equal     Indicates if an equal to comparison should be done
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
     * @param string                              $unit
     * @param float|int|string|\DateInterval|null $precision
     * @param string                              $function
     *
     * @return $this
     */
    public function roundUnit($unit, $precision = 1, $function = 'round')
    {
        $base = CarbonImmutable::parse('2000-01-01 00:00:00', 'UTC')
            ->roundUnit($unit, $precision, $function);

        return $this->copyProperties(
            $base->add($this)
                ->roundUnit($unit, $precision, $function)
                ->diffAsCarbonInterval($base)
        );
    }

    /**
     * Truncate the current instance at the given unit with given precision if specified.
     *
     * @param string                              $unit
     * @param float|int|string|\DateInterval|null $precision
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
     * @param string                              $unit
     * @param float|int|string|\DateInterval|null $precision
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
     * @param float|int|string|\DateInterval|null $precision
     * @param string                              $function
     *
     * @return $this
     */
    public function round($precision = 1, $function = 'round')
    {
        $unit = 'second';

        if ($precision instanceof DateInterval) {
            $precision = (string) self::instance($precision);
        }

        if (is_string($precision) && preg_match('/^\s*(?<precision>\d+)?\s*(?<unit>\w+)(?<other>\W.*)?$/', $precision, $match)) {
            if (trim($match['other'] ?? '') !== '') {
                throw new InvalidArgumentException('Rounding is only possible with single unit intervals.');
            }

            $precision = (int) ($match['precision'] ?: 1);
            $unit = $match['unit'];
        }

        return $this->roundUnit($unit, $precision, $function);
    }

    /**
     * Round the current instance second with given precision if specified.
     *
     * @param float|int|string|\DateInterval|null $precision
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
     * @param float|int|string|\DateInterval|null $precision
     *
     * @return $this
     */
    public function ceil($precision = 1)
    {
        return $this->round($precision, 'ceil');
    }
}
