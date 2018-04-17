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
use DatePeriod;
use DateTime;
use DateTimeInterface;
use Iterator;
use ReflectionClass;

class CarbonPeriod implements Iterator
{
    /**
     * @var DatePeriod
     */
    protected $period;

    /**
     * @var array
     */
    protected $dates;

    /**
     * CarbonPeriod constructor.
     *
     * @throws \ReflectionException
     */
    public function __construct()
    {
        $arguments = func_get_args();
        $reflection = new ReflectionClass('DatePeriod');
        if (count($arguments) > 1 && self::isDate($arguments[0]) && self::isDate($arguments[1])) {
            array_splice($arguments, 1, 0, CarbonInterval::day());
        }

        $this->period = $reflection->newInstanceArgs($arguments);
        $this->dates = iterator_to_array($this->period);
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
            throw new \BadMethodCallException("Method $method does not exist.");
        }

        return self::carbonify(call_user_func_array(array($this->period, $method), $arguments));
    }

    /**
     * @throws \ReflectionException
     *
     * @return object
     */
    public static function create()
    {
        $reflection = new ReflectionClass('Carbon\CarbonPeriod');

        return $reflection->newInstanceArgs(func_get_args());
    }

    /**
     * Return the current element
     * @link  http://php.net/manual/en/iterator.current.php
     * @since 5.0.0
     *
     * @return mixed Can return any type.
     */
    public function current()
    {
        return self::carbonify(current($this->dates));
    }

    /**
     * Move forward to next element
     * @link  http://php.net/manual/en/iterator.next.php
     * @since 5.0.0
     *
     * @return void Any returned value is ignored.
     */
    public function next()
    {
        next($this->dates);
    }

    /**
     * Return the key of the current element
     * @link  http://php.net/manual/en/iterator.key.php
     * @since 5.0.0
     *
     * @return mixed scalar on success, or null on failure.
     */
    public function key()
    {
        return key($this->dates);
    }

    /**
     * Checks if current position is valid
     * @link  http://php.net/manual/en/iterator.valid.php
     * @since 5.0.0
     *
     * @return boolean The return value will be casted to boolean and then evaluated.
     */
    public function valid()
    {
        return $this->key() !== null;
    }

    /**
     * Rewind the Iterator to the first element
     * @link  http://php.net/manual/en/iterator.rewind.php
     * @since 5.0.0
     *
     * @return void Any returned value is ignored.
     */
    public function rewind()
    {
        reset($this->dates);
    }
}
