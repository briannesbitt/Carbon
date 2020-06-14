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

use Carbon\CarbonConverterInterface;
use Carbon\CarbonInterface;
use Carbon\CarbonInterval;
use Carbon\Exceptions\UnitException;
use Closure;
use DateInterval;

/**
 * Trait Units.
 *
 * Add, subtract and set units.
 */
trait Units
{
    /**
     * Add seconds to the instance using timestamp. Positive $value travels
     * forward while negative $value travels into the past.
     *
     * @param string $unit
     * @param int    $value
     *
     * @return static
     */
    public function addRealUnit($unit, $value = 1)
    {
        switch ($unit) {
            // @call addRealUnit
            case 'micro':

            // @call addRealUnit
            case 'microsecond':
                /* @var CarbonInterface $this */
                $diff = $this->microsecond + $value;
                $time = $this->getTimestamp();
                $seconds = (int) floor($diff / static::MICROSECONDS_PER_SECOND);
                $time += $seconds;
                $diff -= $seconds * static::MICROSECONDS_PER_SECOND;
                $microtime = str_pad("$diff", 6, '0', STR_PAD_LEFT);
                $tz = $this->tz;

                return $this->tz('UTC')->modify("@$time.$microtime")->tz($tz);

            // @call addRealUnit
            case 'milli':
            // @call addRealUnit
            case 'millisecond':
                return $this->addRealUnit('microsecond', $value * static::MICROSECONDS_PER_MILLISECOND);

                break;

            // @call addRealUnit
            case 'second':
                break;

            // @call addRealUnit
            case 'minute':
                $value *= static::SECONDS_PER_MINUTE;

                break;

            // @call addRealUnit
            case 'hour':
                $value *= static::MINUTES_PER_HOUR * static::SECONDS_PER_MINUTE;

                break;

            // @call addRealUnit
            case 'day':
                $value *= static::HOURS_PER_DAY * static::MINUTES_PER_HOUR * static::SECONDS_PER_MINUTE;

                break;

            // @call addRealUnit
            case 'week':
                $value *= static::DAYS_PER_WEEK * static::HOURS_PER_DAY * static::MINUTES_PER_HOUR * static::SECONDS_PER_MINUTE;

                break;

            // @call addRealUnit
            case 'month':
                $value *= 30 * static::HOURS_PER_DAY * static::MINUTES_PER_HOUR * static::SECONDS_PER_MINUTE;

                break;

            // @call addRealUnit
            case 'quarter':
                $value *= static::MONTHS_PER_QUARTER * 30 * static::HOURS_PER_DAY * static::MINUTES_PER_HOUR * static::SECONDS_PER_MINUTE;

                break;

            // @call addRealUnit
            case 'year':
                $value *= 365 * static::HOURS_PER_DAY * static::MINUTES_PER_HOUR * static::SECONDS_PER_MINUTE;

                break;

            // @call addRealUnit
            case 'decade':
                $value *= static::YEARS_PER_DECADE * 365 * static::HOURS_PER_DAY * static::MINUTES_PER_HOUR * static::SECONDS_PER_MINUTE;

                break;

            // @call addRealUnit
            case 'century':
                $value *= static::YEARS_PER_CENTURY * 365 * static::HOURS_PER_DAY * static::MINUTES_PER_HOUR * static::SECONDS_PER_MINUTE;

                break;

            // @call addRealUnit
            case 'millennium':
                $value *= static::YEARS_PER_MILLENNIUM * 365 * static::HOURS_PER_DAY * static::MINUTES_PER_HOUR * static::SECONDS_PER_MINUTE;

                break;

            default:
                if ($this->localStrictModeEnabled ?? static::isStrictModeEnabled()) {
                    throw new UnitException("Invalid unit for real timestamp add/sub: '$unit'");
                }

                return $this;
        }

        /* @var CarbonInterface $this */
        return $this->setTimestamp((int) ($this->getTimestamp() + $value));
    }

    public function subRealUnit($unit, $value = 1)
    {
        return $this->addRealUnit($unit, -$value);
    }

    /**
     * Returns true if a property can be changed via setter.
     *
     * @param string $unit
     *
     * @return bool
     */
    public static function isModifiableUnit($unit)
    {
        static $modifiableUnits = [
            // @call addUnit
            'millennium',
            // @call addUnit
            'century',
            // @call addUnit
            'decade',
            // @call addUnit
            'quarter',
            // @call addUnit
            'week',
            // @call addUnit
            'weekday',
        ];

        return in_array($unit, $modifiableUnits) || in_array($unit, static::$units);
    }

    /**
     * Call native PHP DateTime/DateTimeImmutable add() method.
     *
     * @param DateInterval $interval
     *
     * @return static
     */
    public function rawAdd(DateInterval $interval)
    {
        return parent::add($interval);
    }

    /**
     * Add given units or interval to the current instance.
     *
     * @example $date->add('hour', 3)
     * @example $date->add(15, 'days')
     * @example $date->add(CarbonInterval::days(4))
     *
     * @param string|DateInterval|Closure|CarbonConverterInterface $unit
     * @param int                                                  $value
     * @param bool|null                                            $overflow
     *
     * @return static
     */
    public function add($unit, $value = 1, $overflow = null)
    {
        if (is_string($unit) && func_num_args() === 1) {
            $unit = CarbonInterval::make($unit);
        }

        if ($unit instanceof CarbonConverterInterface) {
            return $this->resolveCarbon($unit->convertDate($this, false));
        }

        if ($unit instanceof Closure) {
            return $this->resolveCarbon($unit($this, false));
        }

        if ($unit instanceof DateInterval) {
            return parent::add($unit);
        }

        if (is_numeric($unit)) {
            [$value, $unit] = [$unit, $value];
        }

        return $this->addUnit($unit, $value, $overflow);
    }

    /**
     * Add given units to the current instance.
     *
     * @param string    $unit
     * @param int       $value
     * @param bool|null $overflow
     *
     * @return static
     */
    public function addUnit($unit, $value = 1, $overflow = null)
    {
        $date = $this;

        if (!is_numeric($value) || !floatval($value)) {
            return $date->isMutable() ? $date : $date->copy();
        }

        $metaUnits = [
            'millennium' => [static::YEARS_PER_MILLENNIUM, 'year'],
            'century' => [static::YEARS_PER_CENTURY, 'year'],
            'decade' => [static::YEARS_PER_DECADE, 'year'],
            'quarter' => [static::MONTHS_PER_QUARTER, 'month'],
        ];

        if (isset($metaUnits[$unit])) {
            [$factor, $unit] = $metaUnits[$unit];
            $value *= $factor;
        }

        if ($unit === 'weekday') {
            $weekendDays = static::getWeekendDays();

            if ($weekendDays !== [static::SATURDAY, static::SUNDAY]) {
                $absoluteValue = abs($value);
                $sign = $value / max(1, $absoluteValue);
                $weekDaysCount = 7 - min(6, count(array_unique($weekendDays)));
                $weeks = floor($absoluteValue / $weekDaysCount);

                for ($diff = $absoluteValue % $weekDaysCount; $diff; $diff--) {
                    /** @var static $date */
                    $date = $date->addDays($sign);

                    while (in_array($date->dayOfWeek, $weekendDays)) {
                        $date = $date->addDays($sign);
                    }
                }

                $value = $weeks * $sign;
                $unit = 'week';
            }

            $timeString = $date->toTimeString();
        } elseif ($canOverflow = in_array($unit, [
                'month',
                'year',
            ]) && ($overflow === false || (
                $overflow === null &&
                ($ucUnit = ucfirst($unit).'s') &&
                !($this->{'local'.$ucUnit.'Overflow'} ?? static::{'shouldOverflow'.$ucUnit}())
            ))) {
            $day = $date->day;
        }

        $value = (int) $value;

        if ($unit === 'milli' || $unit === 'millisecond') {
            $unit = 'microsecond';
            $value *= static::MICROSECONDS_PER_MILLISECOND;
        }

        // Work-around for bug https://bugs.php.net/bug.php?id=75642
        if ($unit === 'micro' || $unit === 'microsecond') {
            $microseconds = $this->micro + $value;
            $second = (int) floor($microseconds / static::MICROSECONDS_PER_SECOND);
            $microseconds %= static::MICROSECONDS_PER_SECOND;
            if ($microseconds < 0) {
                $microseconds += static::MICROSECONDS_PER_SECOND;
            }
            $date = $date->microseconds($microseconds);
            $unit = 'second';
            $value = $second;
        }
        $date = $date->modify("$value $unit");

        if (isset($timeString)) {
            return $date->setTimeFromTimeString($timeString);
        }

        if (isset($canOverflow, $day) && $canOverflow && $day !== $date->day) {
            $date = $date->modify('last day of previous month');
        }

        return $date;
    }

    /**
     * Subtract given units to the current instance.
     *
     * @param string    $unit
     * @param int       $value
     * @param bool|null $overflow
     *
     * @return static
     */
    public function subUnit($unit, $value = 1, $overflow = null)
    {
        return $this->addUnit($unit, -$value, $overflow);
    }

    /**
     * Call native PHP DateTime/DateTimeImmutable sub() method.
     *
     * @param DateInterval $interval
     *
     * @return static
     */
    public function rawSub(DateInterval $interval)
    {
        return parent::sub($interval);
    }

    /**
     * Subtract given units or interval to the current instance.
     *
     * @example $date->sub('hour', 3)
     * @example $date->sub(15, 'days')
     * @example $date->sub(CarbonInterval::days(4))
     *
     * @param string|DateInterval|Closure|CarbonConverterInterface $unit
     * @param int                                                  $value
     * @param bool|null                                            $overflow
     *
     * @return static
     */
    public function sub($unit, $value = 1, $overflow = null)
    {
        if (is_string($unit) && func_num_args() === 1) {
            $unit = CarbonInterval::make($unit);
        }

        if ($unit instanceof CarbonConverterInterface) {
            return $this->resolveCarbon($unit->convertDate($this, true));
        }

        if ($unit instanceof Closure) {
            return $this->resolveCarbon($unit($this, true));
        }

        if ($unit instanceof DateInterval) {
            return parent::sub($unit);
        }

        if (is_numeric($unit)) {
            [$value, $unit] = [$unit, $value];
        }

        return $this->addUnit($unit, -floatval($value), $overflow);
    }

    /**
     * Subtract given units or interval to the current instance.
     *
     * @see sub()
     *
     * @param string|DateInterval $unit
     * @param int                 $value
     * @param bool|null           $overflow
     *
     * @return static
     */
    public function subtract($unit, $value = 1, $overflow = null)
    {
        if (is_string($unit) && func_num_args() === 1) {
            $unit = CarbonInterval::make($unit);
        }

        return $this->sub($unit, $value, $overflow);
    }
}
