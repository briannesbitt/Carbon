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

use Carbon\CarbonInterface;
use Carbon\CarbonInterval;
use DateInterval;
use InvalidArgumentException;

/**
 * Trait Rounding.
 *
 * Round, ceil, floor units.
 *
 * Depends on the following methods:
 *
 * @method CarbonInterface copy()
 * @method CarbonInterface startOfWeek()
 */
trait Rounding
{
    /**
     * Round the current instance at the given unit with given precision if specified and the given function.
     *
     * @param string    $unit
     * @param float|int $precision
     * @param string    $function
     *
     * @return CarbonInterface
     */
    public function roundUnit($unit, $precision = 1, $function = 'round')
    {
        $metaUnits = [
            // @call roundUnit
            'millennium' => [static::YEARS_PER_MILLENNIUM, 'year'],
            // @call roundUnit
            'century' => [static::YEARS_PER_CENTURY, 'year'],
            // @call roundUnit
            'decade' => [static::YEARS_PER_DECADE, 'year'],
            // @call roundUnit
            'quarter' => [static::MONTHS_PER_QUARTER, 'month'],
            // @call roundUnit
            'millisecond' => [1000, 'microsecond'],
        ];
        $normalizedUnit = static::singularUnit($unit);
        $ranges = array_merge(static::getRangesByUnit(), [
            // @call roundUnit
            'microsecond' => [0, 999999],
        ]);
        $factor = 1;

        if ($normalizedUnit === 'week') {
            $normalizedUnit = 'day';
            $precision *= static::DAYS_PER_WEEK;
        }

        if (isset($metaUnits[$normalizedUnit])) {
            [$factor, $normalizedUnit] = $metaUnits[$normalizedUnit];
        }

        $precision *= $factor;

        if (!isset($ranges[$normalizedUnit])) {
            throw new InvalidArgumentException("Unknown unit '$unit' to floor");
        }

        $found = false;
        $fraction = 0;
        $arguments = null;
        $factor = $this->year < 0 ? -1 : 1;
        $changes = [];

        foreach ($ranges as $unit => [$minimum, $maximum]) {
            if ($normalizedUnit === $unit) {
                $arguments = [$this->$unit, $minimum];
                $fraction = $precision - floor($precision);
                $found = true;

                continue;
            }

            if ($found) {
                $delta = $maximum + 1 - $minimum;
                $factor /= $delta;
                $fraction *= $delta;
                $arguments[0] += $this->$unit * $factor;
                $changes[$unit] = round($minimum + ($fraction ? $fraction * call_user_func($function, ($this->$unit - $minimum) / $fraction) : 0));

                // Cannot use modulo as it lose double precision
                while ($changes[$unit] >= $delta) {
                    $changes[$unit] -= $delta;
                }

                $fraction -= floor($fraction);
            }
        }

        [$value, $minimum] = $arguments;
        /** @var CarbonInterface $result */
        $result = $this->$normalizedUnit(floor(call_user_func($function, ($value - $minimum) / $precision) * $precision + $minimum));

        foreach ($changes as $unit => $value) {
            $result = $result->$unit($value);
        }

        return $result;
    }

    /**
     * Truncate the current instance at the given unit with given precision if specified.
     *
     * @param string    $unit
     * @param float|int $precision
     *
     * @return CarbonInterface
     */
    public function floorUnit($unit, $precision = 1)
    {
        return $this->roundUnit($unit, $precision, 'floor');
    }

    /**
     * Ceil the current instance at the given unit with given precision if specified.
     *
     * @param string    $unit
     * @param float|int $precision
     *
     * @return CarbonInterface
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
     * @return CarbonInterface
     */
    public function round($precision = 1, $function = 'round')
    {
        $unit = 'second';

        if ($precision instanceof DateInterval) {
            $precision = (string) CarbonInterval::instance($precision);
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
     * @return CarbonInterface
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
     * @return CarbonInterface
     */
    public function ceil($precision = 1)
    {
        return $this->round($precision, 'ceil');
    }

    /**
     * Round the current instance week.
     *
     * @param int $weekStartsAt optional start allow you to specify the day of week to use to start the week
     *
     * @return CarbonInterface
     */
    public function roundWeek($weekStartsAt = null)
    {
        return $this->closest($this->copy()->floorWeek($weekStartsAt), $this->copy()->ceilWeek($weekStartsAt));
    }

    /**
     * Truncate the current instance week.
     *
     * @param int $weekStartsAt optional start allow you to specify the day of week to use to start the week
     *
     * @return CarbonInterface
     */
    public function floorWeek($weekStartsAt = null)
    {
        return $this->startOfWeek($weekStartsAt);
    }

    /**
     * Ceil the current instance week.
     *
     * @param int $weekStartsAt optional start allow you to specify the day of week to use to start the week
     *
     * @return CarbonInterface
     */
    public function ceilWeek($weekStartsAt = null)
    {
        if ($this->isMutable()) {
            $startOfWeek = $this->copy()->startOfWeek($weekStartsAt);

            return $startOfWeek != $this ?
                $this->startOfWeek($weekStartsAt)->addWeek() :
                $this;
        }

        $startOfWeek = $this->startOfWeek($weekStartsAt);

        return $startOfWeek != $this ?
            $startOfWeek->addWeek() :
            $this->copy();
    }
}
