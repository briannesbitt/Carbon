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

use InvalidArgumentException;

/**
 * Trait Boundaries.
 *
 * startOf, endOf and derived method for each unit.
 *
 * Depends on the following properties:
 *
 * @property int $year
 * @property int $month
 * @property int $daysInMonth
 * @property int $quarter
 *
 * Depends on the following methods:
 *
 * @method $this setTime(int $hour, int $minute, int $second = 0, int $microseconds = 0)
 * @method $this setDate(int $year, int $month, int $day)
 * @method $this addMonths(int $value = 1)
 */
trait Boundaries
{
    /**
     * Resets the time to 00:00:00 start of day
     *
     * @example
     * ```
     * echo Carbon::parse('2018-07-25 12:45:16')->startOfDay();
     * ```
     *
     * @return static
     */
    public function startOfDay()
    {
        return $this->setTime(0, 0, 0, 0);
    }

    /**
     * Resets the time to 23:59:59.999999 end of day
     *
     * @example
     * ```
     * echo Carbon::parse('2018-07-25 12:45:16')->endOfDay();
     * ```
     *
     * @return static
     */
    public function endOfDay()
    {
        return $this->setTime(static::HOURS_PER_DAY - 1, static::MINUTES_PER_HOUR - 1, static::SECONDS_PER_MINUTE - 1, static::MICROSECONDS_PER_SECOND - 1);
    }

    /**
     * Resets the date to the first day of the month and the time to 00:00:00
     *
     * @example
     * ```
     * echo Carbon::parse('2018-07-25 12:45:16')->startOfMonth();
     * ```
     *
     * @return static
     */
    public function startOfMonth()
    {
        return $this->setDate($this->year, $this->month, 1)->startOfDay();
    }

    /**
     * Resets the date to end of the month and time to 23:59:59.999999
     *
     * @example
     * ```
     * echo Carbon::parse('2018-07-25 12:45:16')->endOfMonth();
     * ```
     *
     * @return static
     */
    public function endOfMonth()
    {
        return $this->setDate($this->year, $this->month, $this->daysInMonth)->endOfDay();
    }

    /**
     * Resets the date to the first day of the quarter and the time to 00:00:00
     *
     * @example
     * ```
     * echo Carbon::parse('2018-07-25 12:45:16')->startOfQuarter();
     * ```
     *
     * @return static
     */
    public function startOfQuarter()
    {
        $month = ($this->quarter - 1) * static::MONTHS_PER_QUARTER + 1;

        return $this->setDate($this->year, $month, 1)->startOfDay();
    }

    /**
     * Resets the date to end of the quarter and time to 23:59:59.999999
     *
     * @example
     * ```
     * echo Carbon::parse('2018-07-25 12:45:16')->endOfQuarter();
     * ```
     *
     * @return static
     */
    public function endOfQuarter()
    {
        return $this->startOfQuarter()->addMonths(static::MONTHS_PER_QUARTER - 1)->endOfMonth();
    }

    /**
     * Resets the date to the first day of the year and the time to 00:00:00
     *
     * @example
     * ```
     * echo Carbon::parse('2018-07-25 12:45:16')->startOfYear();
     * ```
     *
     * @return static
     */
    public function startOfYear()
    {
        return $this->setDate($this->year, 1, 1)->startOfDay();
    }

    /**
     * Resets the date to end of the year and time to 23:59:59.999999
     *
     * @example
     * ```
     * echo Carbon::parse('2018-07-25 12:45:16')->endOfYear();
     * ```
     *
     * @return static
     */
    public function endOfYear()
    {
        return $this->setDate($this->year, 12, 31)->endOfDay();
    }

    /**
     * Resets the date to the first day of the decade and the time to 00:00:00
     *
     * @example
     * ```
     * echo Carbon::parse('2018-07-25 12:45:16')->startOfDecade();
     * ```
     *
     * @return static
     */
    public function startOfDecade()
    {
        $year = $this->year - $this->year % static::YEARS_PER_DECADE;

        return $this->setDate($year, 1, 1)->startOfDay();
    }

    /**
     * Resets the date to end of the decade and time to 23:59:59.999999
     *
     * @example
     * ```
     * echo Carbon::parse('2018-07-25 12:45:16')->endOfDecade();
     * ```
     *
     * @return static
     */
    public function endOfDecade()
    {
        $year = $this->year - $this->year % static::YEARS_PER_DECADE + static::YEARS_PER_DECADE - 1;

        return $this->setDate($year, 12, 31)->endOfDay();
    }

    /**
     * Resets the date to the first day of the century and the time to 00:00:00
     *
     * @example
     * ```
     * echo Carbon::parse('2018-07-25 12:45:16')->startOfCentury();
     * ```
     *
     * @return static
     */
    public function startOfCentury()
    {
        $year = $this->year - ($this->year - 1) % static::YEARS_PER_CENTURY;

        return $this->setDate($year, 1, 1)->startOfDay();
    }

    /**
     * Resets the date to end of the century and time to 23:59:59.999999
     *
     * @example
     * ```
     * echo Carbon::parse('2018-07-25 12:45:16')->endOfCentury();
     * ```
     *
     * @return static
     */
    public function endOfCentury()
    {
        $year = $this->year - 1 - ($this->year - 1) % static::YEARS_PER_CENTURY + static::YEARS_PER_CENTURY;

        return $this->setDate($year, 12, 31)->endOfDay();
    }

    /**
     * Resets the date to the first day of the millennium and the time to 00:00:00
     *
     * @example
     * ```
     * echo Carbon::parse('2018-07-25 12:45:16')->startOfMillennium();
     * ```
     *
     * @return static
     */
    public function startOfMillennium()
    {
        $year = $this->year - ($this->year - 1) % static::YEARS_PER_MILLENNIUM;

        return $this->setDate($year, 1, 1)->startOfDay();
    }

    /**
     * Resets the date to end of the millennium and time to 23:59:59.999999
     *
     * @example
     * ```
     * echo Carbon::parse('2018-07-25 12:45:16')->endOfMillennium();
     * ```
     *
     * @return static
     */
    public function endOfMillennium()
    {
        $year = $this->year - 1 - ($this->year - 1) % static::YEARS_PER_MILLENNIUM + static::YEARS_PER_MILLENNIUM;

        return $this->setDate($year, 12, 31)->endOfDay();
    }

    /**
     * Resets the date to the first day of week (defined in $weekStartsAt) and the time to 00:00:00
     *
     * @example
     * ```
     * echo Carbon::parse('2018-07-25 12:45:16')->startOfWeek() . "\n";
     * echo Carbon::parse('2018-07-25 12:45:16')->locale('ar')->startOfWeek() . "\n";
     * echo Carbon::parse('2018-07-25 12:45:16')->startOfWeek(Carbon::SUNDAY) . "\n";
     * ```
     *
     * @param int $weekStartsAt optional start allow you to specify the day of week to use to start the week
     *
     * @return static
     */
    public function startOfWeek($weekStartsAt = null)
    {
        $date = $this;
        while ($date->dayOfWeek !== ($weekStartsAt ?? $this->firstWeekDay)) {
            $date = $date->subDay();
        }

        return $date->startOfDay();
    }

    /**
     * Resets the date to end of week (defined in $weekEndsAt) and time to 23:59:59.999999
     *
     * @example
     * ```
     * echo Carbon::parse('2018-07-25 12:45:16')->endOfWeek() . "\n";
     * echo Carbon::parse('2018-07-25 12:45:16')->locale('ar')->endOfWeek() . "\n";
     * echo Carbon::parse('2018-07-25 12:45:16')->endOfWeek(Carbon::SATURDAY) . "\n";
     * ```
     *
     * @param int $weekEndsAt optional start allow you to specify the day of week to use to end the week
     *
     * @return static
     */
    public function endOfWeek($weekEndsAt = null)
    {
        $date = $this;
        while ($date->dayOfWeek !== ($weekEndsAt ?? $this->lastWeekDay)) {
            $date = $date->addDay();
        }

        return $date->endOfDay();
    }

    /**
     * Modify to start of current hour, minutes and seconds become 0
     *
     * @example
     * ```
     * echo Carbon::parse('2018-07-25 12:45:16')->startOfHour();
     * ```
     *
     * @return static
     */
    public function startOfHour()
    {
        return $this->setTime($this->hour, 0, 0, 0);
    }

    /**
     * Modify to end of current hour, minutes and seconds become 59
     *
     * @example
     * ```
     * echo Carbon::parse('2018-07-25 12:45:16')->endOfHour();
     * ```
     *
     * @return static
     */
    public function endOfHour()
    {
        return $this->setTime($this->hour, static::MINUTES_PER_HOUR - 1, static::SECONDS_PER_MINUTE - 1, static::MICROSECONDS_PER_SECOND - 1);
    }

    /**
     * Modify to start of current minute, seconds become 0
     *
     * @example
     * ```
     * echo Carbon::parse('2018-07-25 12:45:16')->startOfMinute();
     * ```
     *
     * @return static
     */
    public function startOfMinute()
    {
        return $this->setTime($this->hour, $this->minute, 0, 0);
    }

    /**
     * Modify to end of current minute, seconds become 59
     *
     * @example
     * ```
     * echo Carbon::parse('2018-07-25 12:45:16')->endOfMinute();
     * ```
     *
     * @return static
     */
    public function endOfMinute()
    {
        return $this->setTime($this->hour, $this->minute, static::SECONDS_PER_MINUTE - 1, static::MICROSECONDS_PER_SECOND - 1);
    }

    /**
     * Modify to start of current second, microseconds become 0
     *
     * @example
     * ```
     * echo Carbon::parse('2018-07-25 12:45:16.334455')
     *   ->startOfSecond()
     *   ->format('H:i:s.u');
     * ```
     *
     * @return static
     */
    public function startOfSecond()
    {
        return $this->setTime($this->hour, $this->minute, $this->second, 0);
    }

    /**
     * Modify to end of current second, microseconds become 999999
     *
     * @example
     * ```
     * echo Carbon::parse('2018-07-25 12:45:16.334455')
     *   ->endOfSecond()
     *   ->format('H:i:s.u');
     * ```
     *
     * @return static
     */
    public function endOfSecond()
    {
        return $this->setTime($this->hour, $this->minute, $this->second, static::MICROSECONDS_PER_SECOND - 1);
    }

    /**
     * Modify to start of current given unit.
     *
     * @example
     * ```
     * echo Carbon::parse('2018-07-25 12:45:16.334455')
     *   ->startOf('month')
     *   ->endOf('week', Carbon::FRIDAY);
     * ```
     *
     * @param string            $unit
     * @param array<int, mixed> $params
     *
     * @return static
     */
    public function startOf($unit, ...$params)
    {
        $ucfUnit = ucfirst(static::singularUnit($unit));
        $method = "startOf$ucfUnit";
        if (!method_exists($this, $method)) {
            throw new InvalidArgumentException("Unknown unit '$unit'");
        }

        return $this->$method(...$params);
    }

    /**
     * Modify to end of current given unit.
     *
     * @example
     * ```
     * echo Carbon::parse('2018-07-25 12:45:16.334455')
     *   ->startOf('month')
     *   ->endOf('week', Carbon::FRIDAY);
     * ```
     *
     * @param string            $unit
     * @param array<int, mixed> $params
     *
     * @return static
     */
    public function endOf($unit, ...$params)
    {
        $ucfUnit = ucfirst(static::singularUnit($unit));
        $method = "endOf$ucfUnit";
        if (!method_exists($this, $method)) {
            throw new InvalidArgumentException("Unknown unit '$unit'");
        }

        return $this->$method(...$params);
    }
}
