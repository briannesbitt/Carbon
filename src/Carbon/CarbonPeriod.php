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

use DateInterval;
use DateTime;
use DateTimeInterface;
use InvalidArgumentException;
use Iterator;
use ReflectionClass;
use RuntimeException;

/**
 * Class CarbonPeriod, DatePeriod equivalent fully compatible with PHP 5.3+,
 * and with many more features.
 */
class CarbonPeriod implements Iterator
{
    /**
     * Built-in filters.
     *
     * @var string
     */
    const RECURRENCES_FILTER = 'Carbon\CarbonPeriod::filterRecurrences';
    const START_DATE_FILTER = 'Carbon\CarbonPeriod::filterStartDate';
    const END_DATE_FILTER = 'Carbon\CarbonPeriod::filterEndDate';

    /**
     * Options for built-in filters.
     *
     * @var int
     */
    const EXCLUDE_START_DATE = 1;
    const EXCLUDE_END_DATE = 2;

    /**
     * Special value which can be returned by filters to end iteration.
     *
     * @var string
     */
    const END_ITERATION = 'Carbon\CarbonPeriod::END_ITERATION';

    /**
     * Number of maximum attempts before giving up on finding next valid date.
     *
     * @var int
     */
    const NEXT_MAX_ATTEMPTS = 1000;

    /**
     * @var CarbonInterval
     */
    protected $dateInterval;

    /**
     * @var array
     */
    protected $filters = array();

    /**
     * @var Carbon|null
     */
    protected $startDate;

    /**
     * @var Carbon|null
     */
    protected $endDate;

    /**
     * @var int|null
     */
    protected $recurrences;

    /**
     * @var int
     */
    protected $options;

    /**
     * @var \DateTimeZone
     */
    protected $timezone;

    /**
     * @var Carbon|null
     */
    protected $current;

    /**
     * @var int|null
     */
    protected $key;

    /**
     * Create a new instance statically.
     *
     * @return static
     */
    public static function create()
    {
        // PHP 5.3 equivalent for:
        // return new static(...$arguments);

        $reflection = new ReflectionClass(get_class());
        // Cannot throw ReflectionException as get_class() is always
        // an existing class.

        return $reflection->newInstanceArgs(func_get_args()); // Returns instance of current class as get_class() used.
    }

    /**
     * Make a Carbon object from given variable if possible.
     *
     * @param mixed $var
     *
     * @return Carbon|null
     */
    protected static function makeCarbon($var)
    {
        if ($var instanceof DateTime || $var instanceof DateTimeInterface) {
            return Carbon::instance($var);
        }
        if (is_string($var) && !is_numeric($var)) {
            return new Carbon($var);
        }
    }

    /**
     * Make a CarbonInterval object from given variable if possible.
     *
     * @param mixed $var
     *
     * @return CarbonInterval|null
     */
    protected static function makeCarbonInterval($var)
    {
        if ($var instanceof DateInterval) {
            return CarbonInterval::instance($var);
        }
        if (is_string($var) && substr($var, 0, 1) == 'P') {
            return new CarbonInterval($var);
        }
    }

    /**
     * CarbonPeriod constructor.
     *
     * @throws InvalidArgumentException
     */
    public function __construct()
    {
        $arguments = func_get_args();

        // Split ISO 8601 string into parts.
        if (isset($arguments[0]) && is_string($arguments[0]) && strpos($arguments[0], '/')) {
            $options = isset($arguments[1]) && is_int($arguments[1]) ? $arguments[1] : null;

            $arguments = array_map(function ($arg) {
                // Convert "Rnn" recurrences to "nn".
                return is_string($arg) && substr($arg, 0, 1) == 'R' ? substr($arg, 1) : $arg;
            }, explode('/', $arguments[0]));

            if ($options) {
                $arguments[] = $options;
            }
        }

        // Define defaults.
        $interval = null;
        $start = null;
        $end = null;
        $recurrences = null;
        $options = null;

        // Parse and assign arguments one by one.
        foreach ($arguments as $argument) {
            if ($parsed = static::makeCarbonInterval($argument)) {
                $interval = $parsed;
            } elseif ($start === null && $parsed = static::makeCarbon($argument)) {
                $start = $parsed;
            } elseif ($end === null && $parsed = static::makeCarbon($argument)) {
                $end = $parsed;
            } elseif (is_numeric($argument) && $recurrences === null && $end === null) {
                $recurrences = $argument;
            } elseif ((is_int($argument) || $argument === null) && $options === null) {
                $options = $argument;
            } else {
                throw new InvalidArgumentException('Invalid constructor parameters.');
            }
        }

        // Finally build an instance.
        $this->setDateInterval($interval ?: CarbonInterval::day());
        $this->setStartDate($start);
        $this->setEndDate($end);
        $this->setRecurrences($recurrences);
        $this->setOptions($options);
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
        if (!$interval = static::makeCarbonInterval($interval)) {
            throw new InvalidArgumentException('Invalid interval.');
        }
        if ($interval->spec() === 'PT0S') {
            throw new InvalidArgumentException('Empty interval is not accepted.');
        }

        $this->dateInterval = $interval;

        $this->rewind();

        return $this;
    }

    /**
     * Set start and end date.
     *
     * @param DateTime|DateTimeInterface|string $startDate
     * @param DateTime|DateTimeInterface|string $endDate
     *
     * @return $this
     */
    public function setDates($startDate, $endDate)
    {
        $this->setStartDate($startDate);
        $this->setEndDate($endDate);

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

        $this->rewind();

        return $this;
    }

    /**
     * @return CarbonInterval|null
     */
    public function getDateInterval()
    {
        return $this->dateInterval->copy();
    }

    /**
     * Get start date of the period.
     *
     * @return Carbon|null
     */
    public function getStartDate()
    {
        if ($this->startDate) {
            return $this->startDate->copy();
        }
    }

    /**
     * Get end date of the period.
     *
     * @return Carbon|null
     */
    public function getEndDate()
    {
        if ($this->endDate) {
            return $this->endDate->copy();
        }
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
     * Returns true if the exclude_start_date option is set.
     *
     * @return bool
     */
    public function isStartExcluded()
    {
        return ($this->options & static::EXCLUDE_START_DATE) !== 0;
    }

    /**
     * Returns true if the exclude_start_date option is set.
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
        $this->filters[] = array($callback, $name);

        $this->rewind();

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
        array_unshift($this->filters, array($callback, $name));

        $this->rewind();

        return $this;
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

        $this->updateInernalState();

        $this->rewind();

        return $this;
    }

    /**
     * Return filter is in the stack given either instance or name.
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

        $this->updateInernalState();

        $this->rewind();

        return $this;
    }

    /**
     * Reset filters stack.
     *
     * @return $this
     */
    public function resetFilters()
    {
        $this->filters = array();

        if ($this->startDate !== null) {
            $this->filters[] = array(static::START_DATE_FILTER, null);
        }

        if ($this->endDate !== null) {
            $this->filters[] = array(static::END_DATE_FILTER, null);
        }

        if ($this->recurrences !== null) {
            $this->filters[] = array(static::RECURRENCES_FILTER, null);
        }

        $this->rewind();

        return $this;
    }

    /**
     * Update properties after removing built-in filters.
     *
     * @return void
     */
    protected function updateInernalState()
    {
        if (!$this->hasFilter(static::START_DATE_FILTER)) {
            $this->startDate = null;
        }

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

        $this->rewind();

        return $this;
    }

    /**
     * Recurrences filter callback (limits number of recurrences).
     *
     * @param \Carbon\Carbon $current
     * @param int            $key
     *
     * @return bool
     */
    protected function filterRecurrences($current, $key)
    {
        if ($key >= $this->recurrences) {
            return static::END_ITERATION;
        }

        return true;
    }

    /**
     * Change the period start date.
     *
     * @param DateTime|DateTimeInterface|string|null $date
     *
     * @throws \InvalidArgumentException
     *
     * @return $this
     */
    public function setStartDate($date)
    {
        if (!is_null($date) && !$date = static::makeCarbon($date)) {
            throw new InvalidArgumentException('Invalid start date.');
        }

        if (!$date) {
            return $this->removeFilter(static::START_DATE_FILTER);
        }

        $this->startDate = $date;

        if (!$this->hasFilter(static::START_DATE_FILTER)) {
            return $this->addFilter(static::START_DATE_FILTER);
        }

        $this->rewind();

        return $this;
    }

    /**
     * Start date filter callback.
     *
     * @param \Carbon\Carbon $current
     * @param int            $key
     *
     * @return bool
     */
    protected function filterStartDate($current, $key)
    {
        if ($this->isStartExcluded() ? $current <= $this->startDate : $current < $this->startDate) {
            return false;
        }

        return true;
    }

    /**
     * Change the period end date.
     *
     * @param DateTime|DateTimeInterface|string|null $date
     *
     * @throws \InvalidArgumentException
     *
     * @return $this
     */
    public function setEndDate($date)
    {
        if (!is_null($date) && !$date = static::makeCarbon($date)) {
            throw new InvalidArgumentException('Invalid end date.');
        }

        if (!$date) {
            return $this->removeFilter(static::END_DATE_FILTER);
        }

        $this->endDate = $date;

        if (!$this->hasFilter(static::END_DATE_FILTER)) {
            return $this->addFilter(static::END_DATE_FILTER);
        }

        $this->rewind();

        return $this;
    }

    /**
     * Start date filter callback.
     *
     * @param \Carbon\Carbon $current
     * @param int            $key
     *
     * @return bool
     */
    protected function filterEndDate($current, $key)
    {
        if ($this->isEndExcluded() ? $current >= $this->endDate : $current > $this->endDate) {
            return static::END_ITERATION;
        }

        return true;
    }

    /**
     * Validate current date and stop iteration when necessary.
     *
     * @return bool
     */
    protected function validateCurrentDate()
    {
        $result = $this->checkFilters();

        if ($result === static::END_ITERATION) {
            $this->key = null;
            $this->current = null;
        }

        return (bool) $result;
    }

    /**
     * Returns true if the current value pass all the filters.
     *
     * @return bool|static::END_ITERATION
     */
    protected function checkFilters()
    {
        foreach ($this->filters as $tuple) {
            list($filter) = $tuple;

            $result = call_user_func($filter, $this->current(), $this->key(), $this);

            if ($result === static::END_ITERATION || !$result) {
                return $result;
            }
        }

        return true;
    }

    /**
     * Return the current element.
     *
     * @return Carbon|null
     */
    public function current()
    {
        if ($this->current) {
            return $this->current->copy()->setTimezone($this->timezone);
        }
    }

    /**
     * Return the key of the current element.
     *
     * @return int|null
     */
    public function key()
    {
        return $this->key;
    }

    /**
     * Move forward to next element.
     *
     * @throws \RuntimeException
     *
     * @return void
     */
    public function next()
    {
        $attempt = 0;

        $this->key++;

        do {
            if (++$attempt > static::NEXT_MAX_ATTEMPTS) {
                throw new RuntimeException('Could not find next valid date.');
            }

            $this->current->add($this->dateInterval);
        } while (!$this->validateCurrentDate());
    }

    /**
     * Checks if current position is valid.
     *
     * @return bool
     */
    public function valid()
    {
        return $this->key !== null;
    }

    /**
     * Rewind the Iterator to the first element.
     *
     * Iterating over a date in the UTC timezone avoids bug during backward DST change.
     *
     * @see https://bugs.php.net/bug.php?id=72255
     * @see https://bugs.php.net/bug.php?id=74274
     * @see https://wiki.php.net/rfc/datetime_and_daylight_saving_time
     *
     * @return void
     */
    public function rewind()
    {
        if (!$this->startDate || !$this->dateInterval) {
            return;
        }

        $this->key = 0;
        $this->current = clone $this->startDate;
        $this->timezone = $this->current->getTimezone();

        $this->current->setTimezone('UTC');

        if (!$this->validateCurrentDate()) {
            $this->key--;

            $this->next();
        }
    }

    /**
     * Format the instance as ISO 8601.
     *
     * @return string
     */
    public function toIso8601String()
    {
        $parts = array();

        if ($this->recurrences !== null) {
            $parts[] = 'R'.$this->recurrences;
        }

        if ($this->startDate !== null) {
            $parts[] = $this->startDate->toIso8601String();
        }

        if ($this->dateInterval !== null) {
            $parts[] = $this->dateInterval->spec();
        }

        if ($this->endDate !== null) {
            $parts[] = $this->endDate->toIso8601String();
        }

        return implode('/', $parts);
    }

    /**
     * Convert into string.
     *
     * @return string
     */
    public function toString()
    {
        if ($this->recurrences !== null) {
            return sprintf('%s times %s from %s', $this->recurrences, $this->dateInterval, $this->startDate);
        }

        return sprintf('Every %s from %s to %s', $this->dateInterval, $this->startDate, $this->endDate);
    }

    /**
     * Format the instance as ISO 8601.
     *
     * @return string
     */
    public function spec()
    {
        return $this->toIso8601String();
    }

    /**
     * Convert into string.
     *
     * @return string
     */
    public function __toString()
    {
        return $this->toString();
    }
}
