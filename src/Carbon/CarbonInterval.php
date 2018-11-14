<?php

/*
 * This file is part of the Carbon package.
 *
 * (c) Brian Nesbitt <brian@nesbot.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Carbon;

use Closure;
use DateInterval;
use InvalidArgumentException;
use ReflectionClass;
use ReflectionFunction;
use ReflectionMethod;
use Symfony\Component\Translation\TranslatorInterface;

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
 * @method CarbonInterval years($years = 1) Set the years portion of the current interval.
 * @method CarbonInterval year($years = 1) Alias for years().
 * @method CarbonInterval months($months = 1) Set the months portion of the current interval.
 * @method CarbonInterval month($months = 1) Alias for months().
 * @method CarbonInterval weeks($weeks = 1) Set the weeks portion of the current interval.  Will overwrite dayz value.
 * @method CarbonInterval week($weeks = 1) Alias for weeks().
 * @method CarbonInterval days($days = 1) Set the days portion of the current interval.
 * @method CarbonInterval dayz($days = 1) Alias for days().
 * @method CarbonInterval day($days = 1) Alias for days().
 * @method CarbonInterval hours($hours = 1) Set the hours portion of the current interval.
 * @method CarbonInterval hour($hours = 1) Alias for hours().
 * @method CarbonInterval minutes($minutes = 1) Set the minutes portion of the current interval.
 * @method CarbonInterval minute($minutes = 1) Alias for minutes().
 * @method CarbonInterval seconds($seconds = 1) Set the seconds portion of the current interval.
 * @method CarbonInterval second($seconds = 1) Alias for seconds().
 */
class CarbonInterval extends DateInterval
{
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
     * @var array|null
     */
    private static $flipCascadeFactors;

    /**
     * The registered macros.
     *
     * @var array
     */
    protected static $macros = array();

    /**
     * Before PHP 5.4.20/5.5.4 instead of FALSE days will be set to -99999 when the interval instance
     * was created by DateTime::diff().
     */
    const PHP_DAYS_FALSE = -99999;

    /**
     * Mapping of units and factors for cascading.
     *
     * Should only be modified by changing the factors or referenced constants.
     *
     * @return array
     */
    public static function getCascadeFactors()
    {
        return static::$cascadeFactors ?: array(
            'minutes' => array(Carbon::SECONDS_PER_MINUTE, 'seconds'),
            'hours' => array(Carbon::MINUTES_PER_HOUR, 'minutes'),
            'dayz' => array(Carbon::HOURS_PER_DAY, 'hours'),
            'months' => array(Carbon::DAYS_PER_WEEK * Carbon::WEEKS_PER_MONTH, 'dayz'),
            'years' => array(Carbon::MONTHS_PER_YEAR, 'months'),
        );
    }

    private static function standardizeUnit($unit)
    {
        $unit = rtrim($unit, 'sz').'s';

        return $unit === 'days' ? 'dayz' : $unit;
    }

    private static function getFlipCascadeFactors()
    {
        if (!self::$flipCascadeFactors) {
            self::$flipCascadeFactors = array();
            foreach (static::getCascadeFactors() as $to => $tuple) {
                list($factor, $from) = $tuple;

                self::$flipCascadeFactors[self::standardizeUnit($from)] = array(self::standardizeUnit($to), $factor);
            }
        }

        return self::$flipCascadeFactors;
    }

    /**
     * @param array $cascadeFactors
     */
    public static function setCascadeFactors(array $cascadeFactors)
    {
        self::$flipCascadeFactors = null;
        static::$cascadeFactors = $cascadeFactors;
    }

    /**
     * Determine if the interval was created via DateTime:diff() or not.
     *
     * @param DateInterval $interval
     *
     * @return bool
     */
    private static function wasCreatedFromDiff(DateInterval $interval)
    {
        return $interval->days !== false && $interval->days !== static::PHP_DAYS_FALSE;
    }

    ///////////////////////////////////////////////////////////////////
    //////////////////////////// CONSTRUCTORS /////////////////////////
    ///////////////////////////////////////////////////////////////////

    /**
     * Create a new CarbonInterval instance.
     *
     * @param int $years
     * @param int $months
     * @param int $weeks
     * @param int $days
     * @param int $hours
     * @param int $minutes
     * @param int $seconds
     */
    public function __construct($years = 1, $months = null, $weeks = null, $days = null, $hours = null, $minutes = null, $seconds = null)
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
            list($to, $factor) = $factors[$source];
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
    public static function getMinutesPerHours()
    {
        return static::getFactor('minutes', 'hours') ?: Carbon::MINUTES_PER_HOUR;
    }

    /**
     * Returns current config for seconds per minute.
     *
     * @return int
     */
    public static function getSecondsPerMinutes()
    {
        return static::getFactor('seconds', 'minutes') ?: Carbon::SECONDS_PER_MINUTE;
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
     *
     * @return static
     */
    public static function create($years = 1, $months = null, $weeks = null, $days = null, $hours = null, $minutes = null, $seconds = null)
    {
        return new static($years, $months, $weeks, $days, $hours, $minutes, $seconds);
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

        return $date;
    }

    /**
     * Provide static helpers to create instances.  Allows CarbonInterval::years(3).
     *
     * Note: This is done using the magic method to allow static and instance methods to
     *       have the same names.
     *
     * @param string $name
     * @param array  $args
     *
     * @return static
     */
    public static function __callStatic($name, $args)
    {
        $arg = count($args) === 0 ? 1 : $args[0];

        switch ($name) {
            case 'years':
            case 'year':
                return new static($arg);

            case 'months':
            case 'month':
                return new static(null, $arg);

            case 'weeks':
            case 'week':
                return new static(null, null, $arg);

            case 'days':
            case 'dayz':
            case 'day':
                return new static(null, null, null, $arg);

            case 'hours':
            case 'hour':
                return new static(null, null, null, null, $arg);

            case 'minutes':
            case 'minute':
                return new static(null, null, null, null, null, $arg);

            case 'seconds':
            case 'second':
                return new static(null, null, null, null, null, null, $arg);
        }

        if (static::hasMacro($name)) {
            return call_user_func_array(
                array(new static(0), $name), $args
            );
        }
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

        $pattern = '/(\d+(?:\.\d+)?)\h*([^\d\h]*)/i';
        preg_match_all($pattern, $intervalDefinition, $parts, PREG_SET_ORDER);
        while ($match = array_shift($parts)) {
            list($part, $value, $unit) = $match;
            $intValue = intval($value);
            $fraction = floatval($value) - $intValue;
            switch (strtolower($unit)) {
                case 'year':
                case 'years':
                case 'y':
                    $years += $intValue;
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
                        $parts[] = array(null, $fraction * static::getDaysPerWeek(), 'd');
                    }
                    break;

                case 'day':
                case 'days':
                case 'd':
                    $days += $intValue;
                    if ($fraction) {
                        $parts[] = array(null, $fraction * static::getHoursPerDay(), 'h');
                    }
                    break;

                case 'hour':
                case 'hours':
                case 'h':
                    $hours += $intValue;
                    if ($fraction) {
                        $parts[] = array(null, $fraction * static::getMinutesPerHours(), 'm');
                    }
                    break;

                case 'minute':
                case 'minutes':
                case 'm':
                    $minutes += $intValue;
                    if ($fraction) {
                        $seconds += round($fraction * static::getSecondsPerMinutes());
                    }
                    break;

                case 'second':
                case 'seconds':
                case 's':
                    $seconds += $intValue;
                    break;

                default:
                    throw new InvalidArgumentException(
                        sprintf('Invalid part %s in definition %s', $part, $intervalDefinition)
                    );
            }
        }

        return new static($years, $months, $weeks, $days, $hours, $minutes, $seconds);
    }

    /**
     * Create a CarbonInterval instance from a DateInterval one.  Can not instance
     * DateInterval objects created from DateTime::diff() as you can't externally
     * set the $days field.
     *
     * Pass false as second argument to get a microseconds-precise interval. Else
     * microseconds in the original interval will not be kept.
     *
     * @param DateInterval $di
     * @param bool         $trimMicroseconds (true by default)
     *
     * @return static
     */
    public static function instance(DateInterval $di, $trimMicroseconds = true)
    {
        $microseconds = $trimMicroseconds || version_compare(PHP_VERSION, '7.1.0-dev', '<') ? 0 : $di->f;
        $instance = new static(static::getDateIntervalSpec($di));
        if ($microseconds) {
            $instance->f = $microseconds;
        }
        $instance->invert = $di->invert;
        foreach (array('y', 'm', 'd', 'h', 'i', 's') as $unit) {
            if ($di->$unit < 0) {
                $instance->$unit *= -1;
            }
        }

        return $instance;
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

        if (is_string($var)) {
            $var = trim($var);

            if (substr($var, 0, 1) === 'P') {
                return new static($var);
            }

            if (preg_match('/^(?:\h*\d+(?:\.\d+)?\h*[a-z]+)+$/i', $var)) {
                return static::fromString($var);
            }
        }
    }

    ///////////////////////////////////////////////////////////////////
    /////////////////////// LOCALIZATION //////////////////////////////
    ///////////////////////////////////////////////////////////////////

    /**
     * Initialize the translator instance if necessary.
     *
     * @return \Symfony\Component\Translation\TranslatorInterface
     */
    protected static function translator()
    {
        if (static::$translator === null) {
            static::$translator = Translator::get();
        }

        return static::$translator;
    }

    /**
     * Get the translator instance in use.
     *
     * @return \Symfony\Component\Translation\TranslatorInterface
     */
    public static function getTranslator()
    {
        return static::translator();
    }

    /**
     * Set the translator instance to use.
     *
     * @param TranslatorInterface $translator
     */
    public static function setTranslator(TranslatorInterface $translator)
    {
        static::$translator = $translator;
    }

    /**
     * Get the current translator locale.
     *
     * @return string
     */
    public static function getLocale()
    {
        return static::translator()->getLocale();
    }

    /**
     * Set the current translator locale.
     *
     * @param string $locale
     */
    public static function setLocale($locale)
    {
        return static::translator()->setLocale($locale) !== false;
    }

    ///////////////////////////////////////////////////////////////////
    ///////////////////////// GETTERS AND SETTERS /////////////////////
    ///////////////////////////////////////////////////////////////////

    /**
     * Get a part of the CarbonInterval object.
     *
     * @param string $name
     *
     * @throws \InvalidArgumentException
     *
     * @return int|float
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

            case 'weeks':
                return (int) floor($this->d / static::getDaysPerWeek());

            case 'daysExcludeWeeks':
            case 'dayzExcludeWeeks':
                return $this->d % static::getDaysPerWeek();

            default:
                throw new InvalidArgumentException(sprintf("Unknown getter '%s'", $name));
        }
    }

    /**
     * Set a part of the CarbonInterval object.
     *
     * @param string $name
     * @param int    $val
     *
     * @throws \InvalidArgumentException
     */
    public function __set($name, $val)
    {
        switch ($name) {
            case 'years':
                $this->y = $val;
                break;

            case 'months':
                $this->m = $val;
                break;

            case 'weeks':
                $this->d = $val * static::getDaysPerWeek();
                break;

            case 'dayz':
                $this->d = $val;
                break;

            case 'hours':
                $this->h = $val;
                break;

            case 'minutes':
                $this->i = $val;
                break;

            case 'seconds':
                $this->s = $val;
                break;
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
     * Register a custom macro.
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
     * @param object $mixin
     *
     * @throws \ReflectionException
     *
     * @return void
     */
    public static function mixin($mixin)
    {
        $reflection = new ReflectionClass($mixin);

        $methods = $reflection->getMethods(
            ReflectionMethod::IS_PUBLIC | ReflectionMethod::IS_PROTECTED
        );

        foreach ($methods as $method) {
            $method->setAccessible(true);

            static::macro($method->name, $method->invoke($mixin));
        }
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

        $reflection = new ReflectionFunction($macro);

        $reflectionParameters = $reflection->getParameters();

        $expectedCount = count($reflectionParameters);
        $actualCount = count($parameters);

        if ($expectedCount > $actualCount && $reflectionParameters[$expectedCount - 1]->name === 'self') {
            for ($i = $actualCount; $i < $expectedCount - 1; $i++) {
                $parameters[] = $reflectionParameters[$i]->getDefaultValue();
            }

            $parameters[] = $this;
        }

        if ($macro instanceof Closure && method_exists($macro, 'bindTo')) {
            $macro = $macro->bindTo($this, get_class($this));
        }

        return call_user_func_array($macro, $parameters);
    }

    /**
     * Allow fluent calls on the setters... CarbonInterval::years(3)->months(5)->day().
     *
     * Note: This is done using the magic method to allow static and instance methods to
     *       have the same names.
     *
     * @param string $name
     * @param array  $args
     *
     * @return static
     */
    public function __call($name, $args)
    {
        if (static::hasMacro($name)) {
            return $this->callMacro($name, $args);
        }

        $arg = count($args) === 0 ? 1 : $args[0];

        switch ($name) {
            case 'years':
            case 'year':
                $this->years = $arg;
                break;

            case 'months':
            case 'month':
                $this->months = $arg;
                break;

            case 'weeks':
            case 'week':
                $this->dayz = $arg * static::getDaysPerWeek();
                break;

            case 'days':
            case 'dayz':
            case 'day':
                $this->dayz = $arg;
                break;

            case 'hours':
            case 'hour':
                $this->hours = $arg;
                break;

            case 'minutes':
            case 'minute':
                $this->minutes = $arg;
                break;

            case 'seconds':
            case 'second':
                $this->seconds = $arg;
                break;
        }

        return $this;
    }

    /**
     * Get the current interval in a human readable format in the current locale.
     *
     * @param bool $short (false by default), returns short units if true
     *
     * @return string
     */
    public function forHumans($short = false)
    {
        $periods = array(
            'year' => array('y', $this->years),
            'month' => array('m', $this->months),
            'week' => array('w', $this->weeks),
            'day' => array('d', $this->daysExcludeWeeks),
            'hour' => array('h', $this->hours),
            'minute' => array('min', $this->minutes),
            'second' => array('s', $this->seconds),
        );

        $parts = array();
        foreach ($periods as $unit => $options) {
            list($shortUnit, $count) = $options;
            if ($count > 0) {
                $parts[] = static::translator()->transChoice($short ? $shortUnit : $unit, $count, array(':count' => $count));
            }
        }

        return implode(' ', $parts);
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
     * Convert the interval to a CarbonPeriod.
     *
     * @return CarbonPeriod
     */
    public function toPeriod()
    {
        return CarbonPeriod::createFromArray(
            array_merge(array($this), func_get_args())
        );
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

    /**
     * Add the passed interval to the current instance.
     *
     * @param DateInterval $interval
     *
     * @return static
     */
    public function add(DateInterval $interval)
    {
        $sign = $interval->invert === 1 ? -1 : 1;

        if (static::wasCreatedFromDiff($interval)) {
            $this->dayz += $interval->days * $sign;
        } else {
            $this->years += $interval->y * $sign;
            $this->months += $interval->m * $sign;
            $this->dayz += $interval->d * $sign;
            $this->hours += $interval->h * $sign;
            $this->minutes += $interval->i * $sign;
            $this->seconds += $interval->s * $sign;
        }

        return $this;
    }

    /**
     * Multiply current instance given number of times
     *
     * @param float $factor
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

        return $this;
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
        $date = array_filter(array(
            static::PERIOD_YEARS => abs($interval->y),
            static::PERIOD_MONTHS => abs($interval->m),
            static::PERIOD_DAYS => abs($interval->d),
        ));

        $time = array_filter(array(
            static::PERIOD_HOURS => abs($interval->h),
            static::PERIOD_MINUTES => abs($interval->i),
            static::PERIOD_SECONDS => abs($interval->s),
        ));

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
     * @param DateInterval $a
     * @param DateInterval $b
     *
     * @return int
     */
    public static function compareDateIntervals(DateInterval $a, DateInterval $b)
    {
        $current = Carbon::now();
        $passed = $current->copy()->add($b);
        $current->add($a);

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
        foreach (static::getFlipCascadeFactors() as $source => $cascade) {
            list($target, $factor) = $cascade;

            if ($source === 'dayz' && $target === 'weeks') {
                continue;
            }

            $value = $this->$source;
            $this->$source = $modulo = $value % $factor;
            $this->$target += ($value - $modulo) / $factor;
        }

        return $this;
    }

    /**
     * Get amount of given unit equivalent to the interval.
     *
     * @param string $unit
     *
     * @throws \InvalidArgumentException
     *
     * @return float
     */
    public function total($unit)
    {
        $realUnit = $unit = strtolower($unit);

        if (in_array($unit, array('days', 'weeks'))) {
            $realUnit = 'dayz';
        } elseif (!in_array($unit, array('seconds', 'minutes', 'hours', 'dayz', 'months', 'years'))) {
            throw new InvalidArgumentException("Unknown unit '$unit'.");
        }

        $result = 0;
        $cumulativeFactor = 0;
        $unitFound = false;

        foreach (static::getFlipCascadeFactors() as $source => $cascade) {
            list($target, $factor) = $cascade;

            if ($source === $realUnit) {
                $unitFound = true;
                $result += $this->$source;
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

            $result = ($result + $this->$source) / $factor;
        }

        if (isset($target) && !$cumulativeFactor) {
            $result += $this->$target;
        }

        if (!$unitFound) {
            throw new \InvalidArgumentException("Unit $unit have no configuration to get total from other units.");
        }

        if ($unit === 'weeks') {
            return $result / static::getDaysPerWeek();
        }

        return $result;
    }
}
