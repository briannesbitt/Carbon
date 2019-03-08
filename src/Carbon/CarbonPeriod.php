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
use Carbon\Traits\Options;
use Closure;
use Countable;
use DateInterval;
use DateTime;
use DateTimeInterface;
use InvalidArgumentException;
use Iterator;
use ReflectionClass;
use ReflectionMethod;
use RuntimeException;

/**
 * Substitution of DatePeriod with some modifications and many more features.
 *
 * @method static CarbonPeriod start($date, $inclusive = null) Create instance specifying start date.
 * @method static CarbonPeriod since($date, $inclusive = null) Alias for start().
 * @method static CarbonPeriod sinceNow($inclusive = null) Create instance with start date set to now.
 * @method static CarbonPeriod end($date = null, $inclusive = null) Create instance specifying end date.
 * @method static CarbonPeriod until($date = null, $inclusive = null) Alias for end().
 * @method static CarbonPeriod untilNow($inclusive = null) Create instance with end date set to now.
 * @method static CarbonPeriod dates($start, $end = null) Create instance with start and end date.
 * @method static CarbonPeriod between($start, $end = null) Create instance with start and end date.
 * @method static CarbonPeriod recurrences($recurrences = null) Create instance with maximum number of recurrences.
 * @method static CarbonPeriod times($recurrences = null) Alias for recurrences().
 * @method static CarbonPeriod options($options = null) Create instance with options.
 * @method static CarbonPeriod toggle($options, $state = null) Create instance with options toggled on or off.
 * @method static CarbonPeriod filter($callback, $name = null) Create instance with filter added to the stack.
 * @method static CarbonPeriod push($callback, $name = null) Alias for filter().
 * @method static CarbonPeriod prepend($callback, $name = null) Create instance with filter prepened to the stack.
 * @method static CarbonPeriod filters(array $filters) Create instance with filters stack.
 * @method static CarbonPeriod interval($interval) Create instance with given date interval.
 * @method static CarbonPeriod each($interval) Create instance with given date interval.
 * @method static CarbonPeriod every($interval) Create instance with given date interval.
 * @method static CarbonPeriod step($interval) Create instance with given date interval.
 * @method static CarbonPeriod stepBy($interval) Create instance with given date interval.
 * @method static CarbonPeriod invert() Create instance with inverted date interval.
 * @method static CarbonPeriod years($years = 1) Create instance specifying a number of years for date interval.
 * @method static CarbonPeriod year($years = 1) Alias for years().
 * @method static CarbonPeriod months($months = 1) Create instance specifying a number of months for date interval.
 * @method static CarbonPeriod month($months = 1) Alias for months().
 * @method static CarbonPeriod weeks($weeks = 1) Create instance specifying a number of weeks for date interval.
 * @method static CarbonPeriod week($weeks = 1) Alias for weeks().
 * @method static CarbonPeriod days($days = 1) Create instance specifying a number of days for date interval.
 * @method static CarbonPeriod dayz($days = 1) Alias for days().
 * @method static CarbonPeriod day($days = 1) Alias for days().
 * @method static CarbonPeriod hours($hours = 1) Create instance specifying a number of hours for date interval.
 * @method static CarbonPeriod hour($hours = 1) Alias for hours().
 * @method static CarbonPeriod minutes($minutes = 1) Create instance specifying a number of minutes for date interval.
 * @method static CarbonPeriod minute($minutes = 1) Alias for minutes().
 * @method static CarbonPeriod seconds($seconds = 1) Create instance specifying a number of seconds for date interval.
 * @method static CarbonPeriod second($seconds = 1) Alias for seconds().
 * @method CarbonPeriod start($date, $inclusive = null) Change the period start date.
 * @method CarbonPeriod since($date, $inclusive = null) Alias for start().
 * @method CarbonPeriod sinceNow($inclusive = null) Change the period start date to now.
 * @method CarbonPeriod end($date = null, $inclusive = null) Change the period end date.
 * @method CarbonPeriod until($date = null, $inclusive = null) Alias for end().
 * @method CarbonPeriod untilNow($inclusive = null) Change the period end date to now.
 * @method CarbonPeriod dates($start, $end = null) Change the period start and end date.
 * @method CarbonPeriod recurrences($recurrences = null) Change the maximum number of recurrences.
 * @method CarbonPeriod times($recurrences = null) Alias for recurrences().
 * @method CarbonPeriod options($options = null) Change the period options.
 * @method CarbonPeriod toggle($options, $state = null) Toggle given options on or off.
 * @method CarbonPeriod filter($callback, $name = null) Add a filter to the stack.
 * @method CarbonPeriod push($callback, $name = null) Alias for filter().
 * @method CarbonPeriod prepend($callback, $name = null) Prepend a filter to the stack.
 * @method CarbonPeriod filters(array $filters = []) Set filters stack.
 * @method CarbonPeriod interval($interval) Change the period date interval.
 * @method CarbonPeriod invert() Invert the period date interval.
 * @method CarbonPeriod years($years = 1) Set the years portion of the date interval.
 * @method CarbonPeriod year($years = 1) Alias for years().
 * @method CarbonPeriod months($months = 1) Set the months portion of the date interval.
 * @method CarbonPeriod month($months = 1) Alias for months().
 * @method CarbonPeriod weeks($weeks = 1) Set the weeks portion of the date interval.
 * @method CarbonPeriod week($weeks = 1) Alias for weeks().
 * @method CarbonPeriod days($days = 1) Set the days portion of the date interval.
 * @method CarbonPeriod dayz($days = 1) Alias for days().
 * @method CarbonPeriod day($days = 1) Alias for days().
 * @method CarbonPeriod hours($hours = 1) Set the hours portion of the date interval.
 * @method CarbonPeriod hour($hours = 1) Alias for hours().
 * @method CarbonPeriod minutes($minutes = 1) Set the minutes portion of the date interval.
 * @method CarbonPeriod minute($minutes = 1) Alias for minutes().
 * @method CarbonPeriod seconds($seconds = 1) Set the seconds portion of the date interval.
 * @method CarbonPeriod second($seconds = 1) Alias for seconds().
 */
class CarbonPeriod implements Iterator, Countable
{
    use Options;

    /**
     * Built-in filters.
     *
     * @var string
     */
    const RECURRENCES_FILTER = 'Carbon\CarbonPeriod::filterRecurrences';
    const END_DATE_FILTER = 'Carbon\CarbonPeriod::filterEndDate';

    /**
     * Special value which can be returned by filters to end iteration. Also a filter.
     *
     * @var string
     */
    const END_ITERATION = 'Carbon\CarbonPeriod::endIteration';

    /**
     * Available options.
     *
     * @var int
     */
    const EXCLUDE_START_DATE = 1;
    const EXCLUDE_END_DATE = 2;
    const IMMUTABLE = 4;

    /**
     * Number of maximum attempts before giving up on finding next valid date.
     *
     * @var int
     */
    const NEXT_MAX_ATTEMPTS = 1000;

    /**
     * The registered macros.
     *
     * @var array
     */
    protected static $macros = [];

    /**
     * Date class of iteration items.
     *
     * @var string
     */
    protected $dateClass = Carbon::class;

    /**
     * Underlying date interval instance. Always present, one day by default.
     *
     * @var CarbonInterval
     */
    protected $dateInterval;

    /**
     * Whether current date interval was set by default.
     *
     * @var bool
     */
    protected $isDefaultInterval;

    /**
     * The filters stack.
     *
     * @var array
     */
    protected $filters = [];

    /**
     * Period start date. Applied on rewind. Always present, now by default.
     *
     * @var CarbonInterface
     */
    protected $startDate;

    /**
     * Period end date. For inverted interval should be before the start date. Applied via a filter.
     *
     * @var CarbonInterface|null
     */
    protected $endDate;

    /**
     * Limit for number of recurrences. Applied via a filter.
     *
     * @var int|null
     */
    protected $recurrences;

    /**
     * Iteration options.
     *
     * @var int
     */
    protected $options;

    /**
     * Index of current date. Always sequential, even if some dates are skipped by filters.
     * Equal to null only before the first iteration.
     *
     * @var int
     */
    protected $key;

    /**
     * Current date. May temporarily hold unaccepted value when looking for a next valid date.
     * Equal to null only before the first iteration.
     *
     * @var CarbonInterface
     */
    protected $current;

    /**
     * Timezone of current date. Taken from the start date.
     *
     * @var \DateTimeZone|null
     */
    protected $timezone;

    /**
     * The cached validation result for current date.
     *
     * @var bool|string|null
     */
    protected $validationResult;

    /**
     * Timezone handler for settings() method.
     *
     * @var mixed
     */
    protected $tzName;

    /**
     * Create a new instance.
     *
     * @return static
     */
    public static function create(...$params)
    {
        return static::createFromArray($params);
    }

    /**
     * Create a new instance from an array of parameters.
     *
     * @param array $params
     *
     * @return static
     */
    public static function createFromArray(array $params)
    {
        return new static(...$params);
    }

    /**
     * Create CarbonPeriod from ISO 8601 string.
     *
     * @param string   $iso
     * @param int|null $options
     *
     * @return static
     */
    public static function createFromIso($iso, $options = null)
    {
        $params = static::parseIso8601($iso);

        $instance = static::createFromArray($params);

        if ($options !== null) {
            $instance->setOptions($options);
        }

        return $instance;
    }

    /**
     * Return whether given interval contains non zero value of any time unit.
     *
     * @param \DateInterval $interval
     *
     * @return bool
     */
    protected static function intervalHasTime(DateInterval $interval)
    {
        // The array_key_exists and get_object_vars are used as a workaround to check microsecond support.
        // Both isset and property_exists will fail on PHP 7.0.14 - 7.0.21 due to the following bug:
        // https://bugs.php.net/bug.php?id=74852
        return $interval->h || $interval->i || $interval->s || array_key_exists('f', get_object_vars($interval)) && $interval->f;
    }

    /**
     * Return whether given variable is an ISO 8601 specification.
     *
     * Note: Check is very basic, as actual validation will be done later when parsing.
     * We just want to ensure that variable is not any other type of a valid parameter.
     *
     * @param mixed $var
     *
     * @return bool
     */
    protected static function isIso8601($var)
    {
        if (!is_string($var)) {
            return false;
        }

        // Match slash but not within a timezone name.
        $part = '[a-z]+(?:[_-][a-z]+)*';

        preg_match("#\b$part/$part\b|(/)#i", $var, $match);

        return isset($match[1]);
    }

    /**
     * Parse given ISO 8601 string into an array of arguments.
     *
     * @param string $iso
     *
     * @return array
     */
    protected static function parseIso8601($iso)
    {
        $result = [];

        $interval = null;
        $start = null;
        $end = null;

        foreach (explode('/', $iso) as $key => $part) {
            if ($key === 0 && preg_match('/^R([0-9]*)$/', $part, $match)) {
                $parsed = strlen($match[1]) ? (int) $match[1] : null;
            } elseif ($interval === null && $parsed = CarbonInterval::make($part)) {
                $interval = $part;
            } elseif ($start === null && $parsed = Carbon::make($part)) {
                $start = $part;
            } elseif ($end === null && $parsed = Carbon::make(static::addMissingParts($start, $part))) {
                $end = $part;
            } else {
                throw new InvalidArgumentException("Invalid ISO 8601 specification: $iso.");
            }

            $result[] = $parsed;
        }

        return $result;
    }

    /**
     * Add missing parts of the target date from the soure date.
     *
     * @param string $source
     * @param string $target
     *
     * @return string
     */
    protected static function addMissingParts($source, $target)
    {
        $pattern = '/'.preg_replace('/[0-9]+/', '[0-9]+', preg_quote($target, '/')).'$/';

        $result = preg_replace($pattern, $target, $source, 1, $count);

        return $count ? $result : $target;
    }

    /**
     * Register a custom macro.
     *
     * @example
     * ```
     * CarbonPeriod::macro('middle', function () {
     *   return $this->getStartDate()->average($this->getEndDate());
     * });
     * echo CarbonPeriod::since('2011-05-12')->until('2011-06-03')->middle();
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
     * CarbonPeriod::mixin(new class {
     *   public function addDays() {
     *     return function ($count = 1) {
     *       return $this->setStartDate(
     *         $this->getStartDate()->addDays($count)
     *       )->setEndDate(
     *         $this->getEndDate()->addDays($count)
     *       );
     *     };
     *   }
     *   public function subDays() {
     *     return function ($count = 1) {
     *       return $this->setStartDate(
     *         $this->getStartDate()->subDays($count)
     *       )->setEndDate(
     *         $this->getEndDate()->subDays($count)
     *       );
     *     };
     *   }
     * });
     * echo CarbonPeriod::create('2000-01-01', '2000-02-01')->addDays(5)->subDays(3);
     * ```
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
     * Provide static proxy for instance aliases.
     *
     * @param string $method
     * @param array  $parameters
     *
     * @return mixed
     */
    public static function __callStatic($method, $parameters)
    {
        return (new static)->$method(...$parameters);
    }

    /**
     * CarbonPeriod constructor.
     *
     * @throws InvalidArgumentException
     */
    public function __construct(...$arguments)
    {
        // Parse and assign arguments one by one. First argument may be an ISO 8601 spec,
        // which will be first parsed into parts and then processed the same way.

        if (count($arguments) && static::isIso8601($iso = $arguments[0])) {
            array_splice($arguments, 0, 1, static::parseIso8601($iso));
        }

        foreach ($arguments as $argument) {
            if ($this->dateInterval === null &&
                (
                    is_string($argument) && preg_match('/^(\d.*|P[T0-9].*|(?:\h*\d+(?:\.\d+)?\h*[a-z]+)+)$/i', $argument) ||
                    $argument instanceof DateInterval
                ) &&
                $parsed = CarbonInterval::make($argument)
            ) {
                $this->setDateInterval($parsed);
            } elseif ($this->startDate === null && $parsed = Carbon::make($argument)) {
                $this->setStartDate($parsed);
            } elseif ($this->endDate === null && $parsed = Carbon::make($argument)) {
                $this->setEndDate($parsed);
            } elseif ($this->recurrences === null && $this->endDate === null && is_numeric($argument)) {
                $this->setRecurrences($argument);
            } elseif ($this->options === null && (is_int($argument) || $argument === null)) {
                $this->setOptions($argument);
            } else {
                throw new InvalidArgumentException('Invalid constructor parameters.');
            }
        }

        if ($this->startDate === null) {
            $this->setStartDate(Carbon::now());
        }

        if ($this->dateInterval === null) {
            $this->setDateInterval(CarbonInterval::day());

            $this->isDefaultInterval = true;
        }

        if ($this->options === null) {
            $this->setOptions(0);
        }
    }

    /**
     * Return whether given callable is a string pointing to one of Carbon's is* methods
     * and should be automatically converted to a filter callback.
     *
     * @param callable $callable
     *
     * @return bool
     */
    protected function isCarbonPredicateMethod($callable)
    {
        return is_string($callable) && substr($callable, 0, 2) === 'is' && (method_exists($this->dateClass, $callable) || call_user_func([$this->dateClass, 'hasMacro'], $callable));
    }

    /**
     * Set the iteration item class.
     *
     * @param string $dateClass
     *
     * @return $this
     */
    public function setDateClass(string $dateClass)
    {
        if (!is_a($dateClass, CarbonInterface::class, true)) {
            throw new InvalidArgumentException(sprintf(
                'Given class does not implement %s: %s', CarbonInterface::class, $dateClass
            ));
        }

        $this->dateClass = $dateClass;

        if (is_a($dateClass, Carbon::class, true)) {
            $this->toggleOptions(static::IMMUTABLE, false);
        } elseif (is_a($dateClass, CarbonImmutable::class, true)) {
            $this->toggleOptions(static::IMMUTABLE, true);
        }

        return $this;
    }

    /**
     * Returns iteration item date class.
     *
     * @return string
     */
    public function getDateClass(): string
    {
        return $this->dateClass;
    }

    /**
     * Change the period date interval.
     *
     * @param DateInterval|string $interval
     *
     * @throws \InvalidArgumentException
     *
     * @return $this
     */
    public function setDateInterval($interval)
    {
        if (!$interval = CarbonInterval::make($interval)) {
            throw new InvalidArgumentException('Invalid interval.');
        }

        if ($interval->spec() === 'PT0S') {
            throw new InvalidArgumentException('Empty interval is not accepted.');
        }

        $this->dateInterval = $interval;

        $this->isDefaultInterval = false;

        $this->handleChangedParameters();

        return $this;
    }

    /**
     * Invert the period date interval.
     *
     * @return $this
     */
    public function invertDateInterval()
    {
        $interval = $this->dateInterval->invert();

        return $this->setDateInterval($interval);
    }

    /**
     * Set start and end date.
     *
     * @param DateTime|DateTimeInterface|string      $start
     * @param DateTime|DateTimeInterface|string|null $end
     *
     * @return $this
     */
    public function setDates($start, $end)
    {
        $this->setStartDate($start);
        $this->setEndDate($end);

        return $this;
    }

    /**
     * Change the period options.
     *
     * @param int|null $options
     *
     * @throws \InvalidArgumentException
     *
     * @return $this
     */
    public function setOptions($options)
    {
        if (!is_int($options) && !is_null($options)) {
            throw new InvalidArgumentException('Invalid options.');
        }

        $this->options = $options ?: 0;

        $this->handleChangedParameters();

        return $this;
    }

    /**
     * Get the period options.
     *
     * @return int
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * Toggle given options on or off.
     *
     * @param int       $options
     * @param bool|null $state
     *
     * @throws \InvalidArgumentException
     *
     * @return $this
     */
    public function toggleOptions($options, $state = null)
    {
        if ($state === null) {
            $state = ($this->options & $options) !== $options;
        }

        return $this->setOptions(
            $state ?
            $this->options | $options :
            $this->options & ~$options
        );
    }

    /**
     * Toggle EXCLUDE_START_DATE option.
     *
     * @param bool $state
     *
     * @return $this
     */
    public function excludeStartDate($state = true)
    {
        return $this->toggleOptions(static::EXCLUDE_START_DATE, $state);
    }

    /**
     * Toggle EXCLUDE_END_DATE option.
     *
     * @param bool $state
     *
     * @return $this
     */
    public function excludeEndDate($state = true)
    {
        return $this->toggleOptions(static::EXCLUDE_END_DATE, $state);
    }

    /**
     * Get the underlying date interval.
     *
     * @return CarbonInterval
     */
    public function getDateInterval()
    {
        return $this->dateInterval->copy();
    }

    /**
     * Get start date of the period.
     *
     * @return CarbonInterface
     */
    public function getStartDate()
    {
        return $this->startDate->copy();
    }

    /**
     * Get end date of the period.
     *
     * @return CarbonInterface|null
     */
    public function getEndDate()
    {
        return $this->endDate ? $this->endDate->copy() : null;
    }

    /**
     * Get number of recurrences.
     *
     * @return int|null
     */
    public function getRecurrences()
    {
        return $this->recurrences;
    }

    /**
     * Returns true if the start date should be excluded.
     *
     * @return bool
     */
    public function isStartExcluded()
    {
        return ($this->options & static::EXCLUDE_START_DATE) !== 0;
    }

    /**
     * Returns true if the end date should be excluded.
     *
     * @return bool
     */
    public function isEndExcluded()
    {
        return ($this->options & static::EXCLUDE_END_DATE) !== 0;
    }

    /**
     * Add a filter to the stack.
     *
     * @param callable $callback
     * @param string   $name
     *
     * @return $this
     */
    public function addFilter($callback, $name = null)
    {
        $tuple = $this->createFilterTuple(func_get_args());

        $this->filters[] = $tuple;

        $this->handleChangedParameters();

        return $this;
    }

    /**
     * Prepend a filter to the stack.
     *
     * @param callable $callback
     * @param string   $name
     *
     * @return $this
     */
    public function prependFilter($callback, $name = null)
    {
        $tuple = $this->createFilterTuple(func_get_args());

        array_unshift($this->filters, $tuple);

        $this->handleChangedParameters();

        return $this;
    }

    /**
     * Create a filter tuple from raw parameters.
     *
     * Will create an automatic filter callback for one of Carbon's is* methods.
     *
     * @param array $parameters
     *
     * @return array
     */
    protected function createFilterTuple(array $parameters)
    {
        $method = array_shift($parameters);

        if (!$this->isCarbonPredicateMethod($method)) {
            return [$method, array_shift($parameters)];
        }

        return [function ($date) use ($method, $parameters) {
            return call_user_func_array([$date, $method], $parameters);
        }, $method];
    }

    /**
     * Remove a filter by instance or name.
     *
     * @param callable|string $filter
     *
     * @return $this
     */
    public function removeFilter($filter)
    {
        $key = is_callable($filter) ? 0 : 1;

        $this->filters = array_values(array_filter(
            $this->filters,
            function ($tuple) use ($key, $filter) {
                return $tuple[$key] !== $filter;
            }
        ));

        $this->updateInternalState();

        $this->handleChangedParameters();

        return $this;
    }

    /**
     * Return whether given instance or name is in the filter stack.
     *
     * @param callable|string $filter
     *
     * @return bool
     */
    public function hasFilter($filter)
    {
        $key = is_callable($filter) ? 0 : 1;

        foreach ($this->filters as $tuple) {
            if ($tuple[$key] === $filter) {
                return true;
            }
        }

        return false;
    }

    /**
     * Get filters stack.
     *
     * @return array
     */
    public function getFilters()
    {
        return $this->filters;
    }

    /**
     * Set filters stack.
     *
     * @param array $filters
     *
     * @return $this
     */
    public function setFilters(array $filters)
    {
        $this->filters = $filters;

        $this->updateInternalState();

        $this->handleChangedParameters();

        return $this;
    }

    /**
     * Reset filters stack.
     *
     * @return $this
     */
    public function resetFilters()
    {
        $this->filters = [];

        if ($this->endDate !== null) {
            $this->filters[] = [static::END_DATE_FILTER, null];
        }

        if ($this->recurrences !== null) {
            $this->filters[] = [static::RECURRENCES_FILTER, null];
        }

        $this->handleChangedParameters();

        return $this;
    }

    /**
     * Update properties after removing built-in filters.
     *
     * @return void
     */
    protected function updateInternalState()
    {
        if (!$this->hasFilter(static::END_DATE_FILTER)) {
            $this->endDate = null;
        }

        if (!$this->hasFilter(static::RECURRENCES_FILTER)) {
            $this->recurrences = null;
        }
    }

    /**
     * Add a recurrences filter (set maximum number of recurrences).
     *
     * @param int|null $recurrences
     *
     * @throws \InvalidArgumentException
     *
     * @return $this
     */
    public function setRecurrences($recurrences)
    {
        if (!is_numeric($recurrences) && !is_null($recurrences) || $recurrences < 0) {
            throw new InvalidArgumentException('Invalid number of recurrences.');
        }

        if ($recurrences === null) {
            return $this->removeFilter(static::RECURRENCES_FILTER);
        }

        $this->recurrences = (int) $recurrences;

        if (!$this->hasFilter(static::RECURRENCES_FILTER)) {
            return $this->addFilter(static::RECURRENCES_FILTER);
        }

        $this->handleChangedParameters();

        return $this;
    }

    /**
     * Recurrences filter callback (limits number of recurrences).
     *
     * @param \Carbon\Carbon $current
     * @param int            $key
     *
     * @return bool|string
     */
    protected function filterRecurrences($current, $key)
    {
        if ($key < $this->recurrences) {
            return true;
        }

        return static::END_ITERATION;
    }

    /**
     * Change the period start date.
     *
     * @param DateTime|DateTimeInterface|string $date
     * @param bool|null                         $inclusive
     *
     * @throws \InvalidArgumentException
     *
     * @return $this
     */
    public function setStartDate($date, $inclusive = null)
    {
        if (!$date = call_user_func([$this->dateClass, 'make'], $date)) {
            throw new InvalidArgumentException('Invalid start date.');
        }

        $this->startDate = $date;

        if ($inclusive !== null) {
            $this->toggleOptions(static::EXCLUDE_START_DATE, !$inclusive);
        }

        return $this;
    }

    /**
     * Change the period end date.
     *
     * @param DateTime|DateTimeInterface|string|null $date
     * @param bool|null                              $inclusive
     *
     * @throws \InvalidArgumentException
     *
     * @return $this
     */
    public function setEndDate($date, $inclusive = null)
    {
        if (!is_null($date) && !$date = call_user_func([$this->dateClass, 'make'], $date)) {
            throw new InvalidArgumentException('Invalid end date.');
        }

        if (!$date) {
            return $this->removeFilter(static::END_DATE_FILTER);
        }

        $this->endDate = $date;

        if ($inclusive !== null) {
            $this->toggleOptions(static::EXCLUDE_END_DATE, !$inclusive);
        }

        if (!$this->hasFilter(static::END_DATE_FILTER)) {
            return $this->addFilter(static::END_DATE_FILTER);
        }

        $this->handleChangedParameters();

        return $this;
    }

    /**
     * End date filter callback.
     *
     * @param \Carbon\Carbon $current
     *
     * @return bool|string
     */
    protected function filterEndDate($current)
    {
        if (!$this->isEndExcluded() && $current == $this->endDate) {
            return true;
        }

        if ($this->dateInterval->invert ? $current > $this->endDate : $current < $this->endDate) {
            return true;
        }

        return static::END_ITERATION;
    }

    /**
     * End iteration filter callback.
     *
     * @return string
     */
    protected function endIteration()
    {
        return static::END_ITERATION;
    }

    /**
     * Handle change of the parameters.
     */
    protected function handleChangedParameters()
    {
        if (($this->getOptions() & static::IMMUTABLE) && $this->dateClass === Carbon::class) {
            $this->setDateClass(CarbonImmutable::class);
        } elseif (!($this->getOptions() & static::IMMUTABLE) && $this->dateClass === CarbonImmutable::class) {
            $this->setDateClass(Carbon::class);
        }

        $this->validationResult = null;
    }

    /**
     * Validate current date and stop iteration when necessary.
     *
     * Returns true when current date is valid, false if it is not, or static::END_ITERATION
     * when iteration should be stopped.
     *
     * @return bool|string
     */
    protected function validateCurrentDate()
    {
        if ($this->current === null) {
            $this->rewind();
        }

        // Check after the first rewind to avoid repeating the initial validation.
        if ($this->validationResult !== null) {
            return $this->validationResult;
        }

        return $this->validationResult = $this->checkFilters();
    }

    /**
     * Check whether current value and key pass all the filters.
     *
     * @return bool|string
     */
    protected function checkFilters()
    {
        $current = $this->prepareForReturn($this->current);

        foreach ($this->filters as $tuple) {
            $result = call_user_func(
                $tuple[0],
                $current->copy(),
                $this->key,
                $this
            );

            if ($result === static::END_ITERATION) {
                return static::END_ITERATION;
            }

            if (!$result) {
                return false;
            }
        }

        return true;
    }

    /**
     * Prepare given date to be returned to the external logic.
     *
     * @param CarbonInterface $date
     *
     * @return Carbon
     */
    protected function prepareForReturn(CarbonInterface $date)
    {
        $date = call_user_func([$this->dateClass, 'make'], $date);

        if ($this->timezone) {
            $date = $date->setTimezone($this->timezone);
        }

        return $date;
    }

    /**
     * Check if the current position is valid.
     *
     * @return bool
     */
    public function valid()
    {
        return $this->validateCurrentDate() === true;
    }

    /**
     * Return the current key.
     *
     * @return int|null
     */
    public function key()
    {
        if ($this->valid()) {
            return $this->key;
        }
    }

    /**
     * Return the current date.
     *
     * @return Carbon|null
     */
    public function current()
    {
        if ($this->valid()) {
            return $this->prepareForReturn($this->current);
        }
    }

    /**
     * Move forward to the next date.
     *
     * @throws \RuntimeException
     *
     * @return void
     */
    public function next()
    {
        if ($this->current === null) {
            $this->rewind();
        }

        if ($this->validationResult !== static::END_ITERATION) {
            $this->key++;

            $this->incrementCurrentDateUntilValid();
        }
    }

    /**
     * Rewind to the start date.
     *
     * Iterating over a date in the UTC timezone avoids bug during backward DST change.
     *
     * @see https://bugs.php.net/bug.php?id=72255
     * @see https://bugs.php.net/bug.php?id=74274
     * @see https://wiki.php.net/rfc/datetime_and_daylight_saving_time
     *
     * @throws \RuntimeException
     *
     * @return void
     */
    public function rewind()
    {
        $this->key = 0;
        $this->current = call_user_func([$this->dateClass, 'make'], $this->startDate);
        $settings = $this->getSettings();
        $locale = $this->getLocalTranslator()->getLocale();
        if ($locale) {
            $settings['locale'] = $locale;
        }
        $this->current->settings($settings);
        $this->timezone = static::intervalHasTime($this->dateInterval) ? $this->current->getTimezone() : null;

        if ($this->timezone) {
            $this->current = $this->current->utc();
        }

        $this->validationResult = null;

        if ($this->isStartExcluded() || $this->validateCurrentDate() === false) {
            $this->incrementCurrentDateUntilValid();
        }
    }

    /**
     * Skip iterations and returns iteration state (false if ended, true if still valid).
     *
     * @param int $count steps number to skip (1 by default)
     *
     * @return bool
     */
    public function skip($count = 1)
    {
        for ($i = $count; $this->valid() && $i > 0; $i--) {
            $this->next();
        }

        return $this->valid();
    }

    /**
     * Keep incrementing the current date until a valid date is found or the iteration is ended.
     *
     * @throws \RuntimeException
     *
     * @return void
     */
    protected function incrementCurrentDateUntilValid()
    {
        $attempts = 0;

        do {
            $this->current = $this->current->add($this->dateInterval);

            $this->validationResult = null;

            if (++$attempts > static::NEXT_MAX_ATTEMPTS) {
                throw new RuntimeException('Could not find next valid date.');
            }
        } while ($this->validateCurrentDate() === false);
    }

    /**
     * Format the date period as ISO 8601.
     *
     * @return string
     */
    public function toIso8601String()
    {
        $parts = [];

        if ($this->recurrences !== null) {
            $parts[] = 'R'.$this->recurrences;
        }

        $parts[] = $this->startDate->toIso8601String();

        $parts[] = $this->dateInterval->spec();

        if ($this->endDate !== null) {
            $parts[] = $this->endDate->toIso8601String();
        }

        return implode('/', $parts);
    }

    /**
     * Convert the date period into a string.
     *
     * @return string
     */
    public function toString()
    {
        $translator = call_user_func([$this->dateClass, 'getTranslator']);

        $parts = [];

        $format = !$this->startDate->isStartOfDay() || $this->endDate && !$this->endDate->isStartOfDay()
            ? 'Y-m-d H:i:s'
            : 'Y-m-d';

        if ($this->recurrences !== null) {
            $parts[] = $this->translate('period_recurrences', [], $this->recurrences, $translator);
        }

        $parts[] = $this->translate('period_interval', [':interval' => $this->dateInterval->forHumans([
            'join' => true,
        ])], null, $translator);

        $parts[] = $this->translate('period_start_date', [':date' => $this->startDate->rawFormat($format)], null, $translator);

        if ($this->endDate !== null) {
            $parts[] = $this->translate('period_end_date', [':date' => $this->endDate->rawFormat($format)], null, $translator);
        }

        $result = implode(' ', $parts);

        return mb_strtoupper(mb_substr($result, 0, 1)).mb_substr($result, 1);
    }

    /**
     * Format the date period as ISO 8601.
     *
     * @return string
     */
    public function spec()
    {
        return $this->toIso8601String();
    }

    /**
     * Convert the date period into an array without changing current iteration state.
     *
     * @return array
     */
    public function toArray()
    {
        $state = [
            $this->key,
            $this->current ? $this->current->copy() : null,
            $this->validationResult,
        ];

        $result = iterator_to_array($this);

        [
            $this->key,
            $this->current,
            $this->validationResult
        ] = $state;

        return $result;
    }

    /**
     * Count dates in the date period.
     *
     * @return int
     */
    public function count()
    {
        return count($this->toArray());
    }

    /**
     * Return the first date in the date period.
     *
     * @return Carbon|null
     */
    public function first()
    {
        if ($array = $this->toArray()) {
            return $array[0];
        }
    }

    /**
     * Return the last date in the date period.
     *
     * @return Carbon|null
     */
    public function last()
    {
        if ($array = $this->toArray()) {
            return $array[count($array) - 1];
        }
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
            return call_user_func_array($macro->bindTo($this, static::class), $parameters);
        }

        return call_user_func_array($macro, $parameters);
    }

    /**
     * Convert the date period into a string.
     *
     * @return string
     */
    public function __toString()
    {
        return $this->toString();
    }

    /**
     * Add aliases for setters.
     *
     * CarbonPeriod::days(3)->hours(5)->invert()
     *     ->sinceNow()->until('2010-01-10')
     *     ->filter(...)
     *     ->count()
     *
     * Note: We use magic method to let static and instance aliases with the same names.
     *
     * @param string $method
     * @param array  $parameters
     *
     * @return mixed
     */
    public function __call($method, $parameters)
    {
        if (static::hasMacro($method)) {
            return $this->callMacro($method, $parameters);
        }

        $first = count($parameters) >= 1 ? $parameters[0] : null;
        $second = count($parameters) >= 2 ? $parameters[1] : null;

        switch ($method) {
            case 'start':
            case 'since':
                return $this->setStartDate($first, $second);

            case 'sinceNow':
                return $this->setStartDate(new Carbon, $first);

            case 'end':
            case 'until':
                return $this->setEndDate($first, $second);

            case 'untilNow':
                return $this->setEndDate(new Carbon, $first);

            case 'dates':
            case 'between':
                return $this->setDates($first, $second);

            case 'recurrences':
            case 'times':
                return $this->setRecurrences($first);

            case 'options':
                return $this->setOptions($first);

            case 'toggle':
                return $this->toggleOptions($first, $second);

            case 'filter':
            case 'push':
                return $this->addFilter($first, $second);

            case 'prepend':
                return $this->prependFilter($first, $second);

            case 'filters':
                return $this->setFilters($first ?: []);

            case 'interval':
            case 'each':
            case 'every':
            case 'step':
            case 'stepBy':
                return $this->setDateInterval($first);

            case 'invert':
                return $this->invertDateInterval();

            case 'years':
            case 'year':
            case 'months':
            case 'month':
            case 'weeks':
            case 'week':
            case 'days':
            case 'dayz':
            case 'day':
            case 'hours':
            case 'hour':
            case 'minutes':
            case 'minute':
            case 'seconds':
            case 'second':
                return $this->setDateInterval(call_user_func(
                    // Override default P1D when instantiating via fluent setters.
                    [$this->isDefaultInterval ? new CarbonInterval('PT0S') : $this->dateInterval, $method],
                    count($parameters) === 0 ? 1 : $first
                ));
        }

        if ($this->localStrictModeEnabled ?? Carbon::isStrictModeEnabled()) {
            throw new BadMethodCallException("Method $method does not exist.");
        }

        return $this;
    }

    public function shiftTimezone($timezone)
    {
        $this->tzName = $timezone;
        $this->timezone = $timezone;

        return $this;
    }
}
