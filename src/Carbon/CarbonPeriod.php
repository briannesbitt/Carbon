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

/**
 * Class CarbonPeriod, DatePeriod equivalent fully compatible with PHP 5.3+,
 * and with many more features.
 */
class CarbonPeriod implements Iterator
{
    const EXCLUDE_START_DATE = 1;
    const EXCLUDE_END_DATE = 2;
    const END_ITERATION = 'Carbon\CarbonPeriod::END_ITERATION';
    const RECURRENCES_FILTER = 'Carbon\CarbonPeriod::filterRecurrences';

    /**
     * @var Carbon
     */
    protected $startDate;

    /**
     * @var Carbon|null
     */
    protected $endDate;

    /**
     * @var CarbonInterval
     */
    protected $dateInterval;

    /**
     * @var Carbon
     */
    protected $currentDate;

    /**
     * @var int|null
     */
    protected $key;

    /**
     * @var int
     */
    protected $options;

    /**
     * @var array
     */
    protected $filters = array();

    /**
     * @var int|null
     */
    protected $recurrences;

    /**
     * CarbonPeriod constructor.
     *
     * @throws \ReflectionException
     */
    public function __construct()
    {
        $arguments = func_get_args();
        if (isset($arguments[0]) && is_string($arguments[0])) {
            call_user_func_array(array($this, 'modify'), $arguments);
        } elseif (count($arguments) > 1) {
            $interval = null;
            $arguments = array_values(array_filter($arguments, function ($argument) use (&$interval) {
                if ($argument instanceof DateInterval) {
                    $interval = $argument;

                    return false;
                }

                return true;
            }));
            $this->setDateInterval($interval ?: CarbonInterval::day());
            call_user_func_array(array($this, 'setDates'), $arguments);
        }

        $this->rewind();
    }

    /**
     * Change the current period according to given ISO-8601 spec string.
     *
     * @param string $spec
     * @param int    $options
     *
     * @return $this
     */
    public function modify($spec, $options = 0)
    {
        $this->resetFilters();
        $this->endDate = null;
        $recurrences = 1;
        $interval = null;
        foreach (explode('/', $spec) as $specPart) {
            $specPart = trim($specPart);
            if (preg_match('/^R(\d+)$/i', $specPart, $match)) {
                $recurrences = intval($match[1]);

                continue;
            }
            if (preg_match('/^P[A-Z0-9]+$/i', $specPart, $match)) {
                $interval = new CarbonInterval($specPart);

                continue;
            }

            $this->startDate = new Carbon($specPart);
        }
        $this->dateInterval = $interval ?: CarbonInterval::day();
        $this->options = $options;
        $this->recurrences($recurrences);

        return $this;
    }

    /**
     * Change the period date interval.
     *
     * @param DateInterval $dateInterval
     *
     * @return $this
     */
    public function setDateInterval(DateInterval $dateInterval)
    {
        if ($dateInterval->format('%y%m%d%h%i%s') == '000000') {
            throw new InvalidArgumentException('Empty interval cannot be converted into a period.');
        }

        $this->dateInterval = self::carbonify($dateInterval);

        return $this;
    }

    /**
     * Change the period start date.
     *
     * @param DateTime|DateTimeInterface $startDate
     */
    public function setStartDate($startDate)
    {
        if (static::isDate($startDate)) {
            $this->startDate = self::carbonify($startDate);
        }
    }

    /**
     * Change the period end date or set a recurrences filter if number given.
     *
     * @param DateTime|DateTimeInterface|int $endDate
     */
    public function setEndDate($endDate)
    {
        if (static::isDate($endDate)) {
            $this->endDate = self::carbonify($endDate);

            return;
        }

        $this->recurrences($endDate);
    }

    /**
     * Set start and end date (or recurrences) and options of the current period.
     *
     * @param DateTime|DateTimeInterface     $startDate
     * @param DateTime|DateTimeInterface|int $endDate
     * @param int                            $options
     */
    public function setDates($startDate, $endDate, $options = 0)
    {
        $this->setStartDate($startDate);
        $this->setEndDate($endDate);
        $this->options = $options;

        return $this;
    }

    private static function isDate($date)
    {
        return $date instanceof DateTime || $date instanceof DateTimeInterface;
    }

    private static function carbonify($object)
    {
        if (($object instanceof DateTime || $object instanceof DateTimeInterface) && !($object instanceof Carbon)) {
            $object = Carbon::instance($object);
        } elseif ($object instanceof DateInterval && !($object instanceof CarbonInterval)) {
            $object = CarbonInterval::instance($object);
        }

        return $object;
    }

    /**
     * @return CarbonInterval
     */
    public function getDateInterval()
    {
        return $this->dateInterval;
    }

    /**
     * Get start date of the period.
     *
     * @return Carbon
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * Get end date of the period.
     *
     * @return Carbon|null
     */
    public function getEndDate()
    {
        return $this->endDate;
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
    public function hasStartExcluded()
    {
        return ($this->options & static::EXCLUDE_START_DATE) !== 0;
    }

    /**
     * Returns true if the exclude_start_date option is set.
     *
     * @return bool
     */
    public function hasEndExcluded()
    {
        return ($this->options & static::EXCLUDE_END_DATE) !== 0;
    }

    /**
     * Create a new instance statically.
     *
     * @throws \ReflectionException
     *
     * @return self
     */
    public static function create()
    {
        $reflection = new ReflectionClass(get_class());

        return $reflection->newInstanceArgs(func_get_args());
    }

    /**
     * Returns true if the current value pass all the filters.
     *
     * @param mixed      $current
     * @param string|int $key
     * @param Iterator   $iterator
     *
     * @return bool|static::END_ITERATION
     */
    public function checkFilters($current, $key, $iterator)
    {
        foreach ($this->filters as $tuple) {
            list($filter) = $tuple;

            $result = call_user_func($filter, static::carbonify($current), $key, $iterator);

            if ($result === static::END_ITERATION || !$result) {
                return $result;
            }
        }

        return true;
    }

    /**
     * Recurrences filter callback (limits number of recurrences).
     *
     * @param \Carbon\Carbon $current
     * @param int $key
     * @return bool
     */
    private function filterRecurrences($current, $key)
    {
        $max = $this->hasStartExcluded() ? $this->recurrences - 1 : $this->recurrences;

        if ($key > $max) {
            return static::END_ITERATION;
        }

        return true;
    }

    /**
     * Add a filter to the stack.
     *
     * @param callable $callback
     * @param string $name
     *
     * @return $this
     */
    public function addFilter($callback, $name = null)
    {
        $this->filters[] = [$callback, $name];

        return $this;
    }

    /**
     * Prepend a filter to the stack.
     *
     * @param callable $callback
     * @param string $name
     *
     * @return $this
     */
    public function prependFilter($callback, $name = null)
    {
        array_unshift($this->filters, [$callback, $name]);

        return $this;
    }

    /**
     * Remove a filter by instance or name.
     * 
     * @param callable|string $filter
     *
     * @return $this
     */
    public function removeFilter($remove)
    {
        $key = is_callable($remove) ? 0 : 1;

        $this->filters = array_values(array_filter(
            $this->filters,
            function ($tuple) use ($key, $remove) {
                return $tuple[$key] !== $remove;
            }
        ));

        if ($remove === static::RECURRENCES_FILTER) {
            $this->recurrences = null;
        }

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

        return $this;
    }

    /**
     * Add a recurrences filter (set maximum number of recurrences).
     *
     * @param int $recurrences
     *
     * @return $this
     */
    public function recurrences($recurrences)
    {
        $this->removeFilter(static::RECURRENCES_FILTER);
        $this->addFilter(static::RECURRENCES_FILTER);

        $this->recurrences = $recurrences;

        return $this;
    }

    /**
     * Return the current element.
     *
     * @link  http://php.net/manual/en/iterator.current.php
     * @since 5.0.0
     *
     * @return mixed Can return any type.
     */
    public function current()
    {
        return $this->currentDate;
    }

    protected function checkValidDate($currentDate, $key)
    {
        $result = $this->checkFilters($currentDate, $key, $this);
        if ($result === static::END_ITERATION || ($this->endDate && ($this->hasEndExcluded()
                ? $currentDate >= $this->endDate
                : $currentDate > $this->endDate
            ))) {
            $this->key = null;

            return static::END_ITERATION;
        }

        return $result;
    }

    /**
     * Move forward to next element.
     *
     * @link  http://php.net/manual/en/iterator.next.php
     * @since 5.0.0
     *
     * @return void Any returned value is ignored.
     */
    public function next()
    {
        if ($this->key !== null) {
            $currentDate = clone $this->currentDate;
            $key = $this->key;
            while (true) {
                $currentDate = $currentDate->add($this->dateInterval);
                $result = $this->checkValidDate($currentDate, ++$key);
                if ($result === static::END_ITERATION) {
                    return;
                }
                if ($result) {
                    break;
                }
            }

            $this->currentDate = $currentDate;
            $this->key = $key;
        }
    }

    /**
     * Return the key of the current element.
     *
     * @link  http://php.net/manual/en/iterator.key.php
     * @since 5.0.0
     *
     * @return mixed scalar on success, or null on failure.
     */
    public function key()
    {
        return $this->key;
    }

    /**
     * Checks if current position is valid.
     *
     * @link  http://php.net/manual/en/iterator.valid.php
     * @since 5.0.0
     *
     * @return bool The return value will be casted to boolean and then evaluated.
     */
    public function valid()
    {
        return $this->key !== null;
    }

    /**
     * Rewind the Iterator to the first element.
     *
     * @link  http://php.net/manual/en/iterator.rewind.php
     * @since 5.0.0
     *
     * @return void Any returned value is ignored.
     */
    public function rewind()
    {
        $this->key = 0;
        $this->currentDate = clone $this->startDate;

        if ($this->hasStartExcluded()) {
            $this->next();
            $this->key--;

            return;
        }

        $result = $this->checkValidDate($this->currentDate, $this->key);

        if (!$result) {
            $this->next();
        }
    }

    /**
     * Convert into string.
     *
     * @return string
     */
    public function __toString()
    {
        return $this->getStartDate().' → '.$this->getEndDate();
    }
}
