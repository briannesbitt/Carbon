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

use CallbackFilterIterator;
use DateInterval;
use DatePeriod;
use DateTime;
use DateTimeInterface;
use InvalidArgumentException;
use Iterator;
use IteratorIterator;
use ReflectionClass;

/**
 * Class CarbonPeriod.
 *
 * @method CarbonInterval getDateInterval() Get the original interval (as CarbonInterval if DateInterval given)
 * @method Carbon         getEndDate()      Get the original start date (as Carbon if DateTime given)
 * @method Carbon         getStartDate()    Get the original end date (as Carbon if DateTime given)
 */
class CarbonPeriod implements Iterator
{
    /**
     * @var DatePeriod
     */
    protected $period;

    /**
     * @var CarbonInterval
     */
    protected $interval;

    /**
     * @var IteratorIterator
     */
    protected $dates;

    /**
     * @var array
     */
    protected $filters = array();

    /**
     * CarbonPeriod constructor.
     *
     * @throws \ReflectionException
     */
    public function __construct()
    {
        $arguments = func_get_args();
        $reflection = new ReflectionClass('DatePeriod');
        if (count($arguments) > 1) {
            if (self::isDate($arguments[0]) && self::isDate($arguments[1])) {
                array_splice($arguments, 1, 0, array(CarbonInterval::day()));
            }

            if ($arguments[1] instanceof DateInterval && $arguments[1]->format('%y%m%d%h%i%s') == '000000') {
                throw new InvalidArgumentException('Empty interval cannot be converted into a period.');
            }

            // copy interval for getDateInterval PHP < 5.6 compatibility
            if ($arguments[1] instanceof DateInterval) {
                $this->interval = self::carbonify($arguments[1]);
            }
        }

        $this->period = $reflection->newInstanceArgs($arguments);
        $self = $this;
        $this->dates = new CallbackFilterIterator(
            new IteratorIterator($this->period),
            function ($current, $key, $iterator) use ($self) {
                return $self->passFilters($current, $key, $iterator);
            }
        );
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

    public function __call($method, $arguments)
    {
        if (!method_exists($this->period, $method)) {
            //@codeCoverageIgnoreStart
            if ($method === 'getDateInterval') {
                return $this->interval;
            }
            //@codeCoverageIgnoreEnd
            throw new \BadMethodCallException("Method $method does not exist.");
        }

        return self::carbonify(call_user_func_array(array($this->period, $method), $arguments));
    }

    /**
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
     * @param mixed      $current
     * @param string|int $key
     * @param Iterator   $iterator
     *
     * @return bool
     */
    public function passFilters($current, $key, $iterator)
    {
        foreach ($this->filters as $filter) {
            if (!call_user_func($filter, static::carbonify($current), $key, $iterator)) {
                return false;
            }
        }

        return true;
    }

    /**
     * @param callable $callback
     */
    public function filter($callback)
    {
        $this->filters[] = $callback;
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
        return self::carbonify($this->dates->current());
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
        $this->dates->next();
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
        return $this->dates->key();
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
        return $this->dates->valid();
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
        $this->dates->rewind();
    }
}
