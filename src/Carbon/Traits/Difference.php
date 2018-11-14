<?php

/*
 * This file is part of the Carbon package.
 *
 * (c) Brian Nesbitt <brian@nesbot.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Carbon\Traits;

use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Carbon\CarbonInterface;
use Carbon\CarbonInterval;
use Carbon\CarbonPeriod;
use Carbon\Translator;
use Closure;
use DateInterval;
use DateTimeInterface;

/**
 * Trait Difference.
 *
 * Depends on the following methods:
 *
 * @method bool lessThan($date)
 * @method DateInterval diff(\DateTimeInterface $date)
 * @method CarbonInterface copy()
 * @method static Translator translator()
 */
trait Difference
{
    /**
     * @param DateInterval $diff
     * @param bool         $absolute
     *
     * @return CarbonInterval
     */
    protected static function fixDiffInterval(DateInterval $diff, $absolute)
    {
        $diff = CarbonInterval::instance($diff);
        // Work-around for https://bugs.php.net/bug.php?id=77145
        // @codeCoverageIgnoreStart
        if ($diff->f > 0 && $diff->y === -1 && $diff->m === 11 && $diff->d >= 27 && $diff->h === 23 && $diff->i === 59 && $diff->s === 59) {
            $diff->y = 0;
            $diff->m = 0;
            $diff->d = 0;
            $diff->h = 0;
            $diff->i = 0;
            $diff->s = 0;
            $diff->f = (1000000 - round($diff->f * 1000000)) / 1000000;
            $diff->invert();
        } elseif ($diff->f < 0) {
            if ($diff->s !== 0 || $diff->i !== 0 || $diff->h !== 0 || $diff->d !== 0 || $diff->m !== 0 || $diff->y !== 0) {
                $diff->f = (round($diff->f * 1000000) + 1000000) / 1000000;
                $diff->s--;

                if ($diff->s < 0) {
                    $diff->s += 60;
                    $diff->i--;

                    if ($diff->i < 0) {
                        $diff->i += 60;
                        $diff->h--;

                        if ($diff->h < 0) {
                            $diff->i += 24;
                            $diff->d--;

                            if ($diff->d < 0) {
                                $diff->d += 30;
                                $diff->m--;

                                if ($diff->m < 0) {
                                    $diff->m += 12;
                                    $diff->y--;
                                }
                            }
                        }
                    }
                }
            } else {
                $diff->f *= -1;
                $diff->invert();
            }
        }
        // @codeCoverageIgnoreEnd

        if ($absolute && $diff->invert) {
            $diff->invert();
        }

        return $diff;
    }

    /**
     * Get the difference as a CarbonInterval instance
     *
     * @param \Carbon\Carbon|\DateTimeInterface|string|null $date
     * @param bool                                          $absolute Get the absolute of the difference
     *
     * @return CarbonInterval
     */
    public function diffAsCarbonInterval($date = null, $absolute = true)
    {
        return static::fixDiffInterval($this->diff($this->resolveCarbon($date), $absolute), $absolute);
    }

    /**
     * Get the difference in years
     *
     * @param \Carbon\Carbon|\DateTimeInterface|string|null $date
     * @param bool                                          $absolute Get the absolute of the difference
     *
     * @return int
     */
    public function diffInYears($date = null, $absolute = true)
    {
        return (int) $this->diff($this->resolveCarbon($date), $absolute)->format('%r%y');
    }

    /**
     * Get the difference in months
     *
     * @param \Carbon\Carbon|\DateTimeInterface|string|null $date
     * @param bool                                          $absolute Get the absolute of the difference
     *
     * @return int
     */
    public function diffInMonths($date = null, $absolute = true)
    {
        $date = $this->resolveCarbon($date);

        return $this->diffInYears($date, $absolute) * static::MONTHS_PER_YEAR + (int) $this->diff($date, $absolute)->format('%r%m');
    }

    /**
     * Get the difference in weeks
     *
     * @param \Carbon\Carbon|\DateTimeInterface|string|null $date
     * @param bool                                          $absolute Get the absolute of the difference
     *
     * @return int
     */
    public function diffInWeeks($date = null, $absolute = true)
    {
        return (int) ($this->diffInDays($date, $absolute) / static::DAYS_PER_WEEK);
    }

    /**
     * Get the difference in days
     *
     * @param \Carbon\Carbon|\DateTimeInterface|string|null $date
     * @param bool                                          $absolute Get the absolute of the difference
     *
     * @return int
     */
    public function diffInDays($date = null, $absolute = true)
    {
        return (int) $this->diff($this->resolveCarbon($date), $absolute)->format('%r%a');
    }

    /**
     * Get the difference in days using a filter closure
     *
     * @param Closure                                       $callback
     * @param \Carbon\Carbon|\DateTimeInterface|string|null $date
     * @param bool                                          $absolute Get the absolute of the difference
     *
     * @return int
     */
    public function diffInDaysFiltered(Closure $callback, $date = null, $absolute = true)
    {
        return $this->diffFiltered(CarbonInterval::day(), $callback, $date, $absolute);
    }

    /**
     * Get the difference in hours using a filter closure
     *
     * @param Closure                                       $callback
     * @param \Carbon\Carbon|\DateTimeInterface|string|null $date
     * @param bool                                          $absolute Get the absolute of the difference
     *
     * @return int
     */
    public function diffInHoursFiltered(Closure $callback, $date = null, $absolute = true)
    {
        return $this->diffFiltered(CarbonInterval::hour(), $callback, $date, $absolute);
    }

    /**
     * Get the difference by the given interval using a filter closure
     *
     * @param CarbonInterval                                $ci       An interval to traverse by
     * @param Closure                                       $callback
     * @param \Carbon\Carbon|\DateTimeInterface|string|null $date
     * @param bool                                          $absolute Get the absolute of the difference
     *
     * @return int
     */
    public function diffFiltered(CarbonInterval $ci, Closure $callback, $date = null, $absolute = true)
    {
        $start = $this;
        $end = $this->resolveCarbon($date);
        $inverse = false;

        if ($end < $start) {
            $start = $end;
            $end = $this;
            $inverse = true;
        }

        $options = CarbonPeriod::EXCLUDE_END_DATE | ($this->isMutable() ? 0 : CarbonPeriod::IMMUTABLE);
        $diff = $ci->toPeriod($start, $end, $options)->filter($callback)->count();

        return $inverse && !$absolute ? -$diff : $diff;
    }

    /**
     * Get the difference in weekdays
     *
     * @param \Carbon\Carbon|\DateTimeInterface|string|null $date
     * @param bool                                          $absolute Get the absolute of the difference
     *
     * @return int
     */
    public function diffInWeekdays($date = null, $absolute = true)
    {
        return $this->diffInDaysFiltered(function (CarbonInterface $date) {
            return $date->isWeekday();
        }, $date, $absolute);
    }

    /**
     * Get the difference in weekend days using a filter
     *
     * @param \Carbon\Carbon|\DateTimeInterface|string|null $date
     * @param bool                                          $absolute Get the absolute of the difference
     *
     * @return int
     */
    public function diffInWeekendDays($date = null, $absolute = true)
    {
        return $this->diffInDaysFiltered(function (CarbonInterface $date) {
            return $date->isWeekend();
        }, $date, $absolute);
    }

    /**
     * Get the difference in hours.
     *
     * @param \Carbon\Carbon|\DateTimeInterface|string|null $date
     * @param bool                                          $absolute Get the absolute of the difference
     *
     * @return int
     */
    public function diffInHours($date = null, $absolute = true)
    {
        return (int) ($this->diffInSeconds($date, $absolute) / static::SECONDS_PER_MINUTE / static::MINUTES_PER_HOUR);
    }

    /**
     * Get the difference in hours using timestamps.
     *
     * @param \Carbon\Carbon|\DateTimeInterface|string|null $date
     * @param bool                                          $absolute Get the absolute of the difference
     *
     * @return int
     */
    public function diffInRealHours($date = null, $absolute = true)
    {
        return (int) ($this->diffInRealSeconds($date, $absolute) / static::SECONDS_PER_MINUTE / static::MINUTES_PER_HOUR);
    }

    /**
     * Get the difference in minutes.
     *
     * @param \Carbon\Carbon|\DateTimeInterface|string|null $date
     * @param bool                                          $absolute Get the absolute of the difference
     *
     * @return int
     */
    public function diffInMinutes($date = null, $absolute = true)
    {
        return (int) ($this->diffInSeconds($date, $absolute) / static::SECONDS_PER_MINUTE);
    }

    /**
     * Get the difference in minutes using timestamps.
     *
     * @param \Carbon\Carbon|\DateTimeInterface|string|null $date
     * @param bool                                          $absolute Get the absolute of the difference
     *
     * @return int
     */
    public function diffInRealMinutes($date = null, $absolute = true)
    {
        return (int) ($this->diffInRealSeconds($date, $absolute) / static::SECONDS_PER_MINUTE);
    }

    /**
     * Get the difference in seconds.
     *
     * @param \Carbon\Carbon|\DateTimeInterface|string|null $date
     * @param bool                                          $absolute Get the absolute of the difference
     *
     * @return int
     */
    public function diffInSeconds($date = null, $absolute = true)
    {
        $diff = $this->diff($this->resolveCarbon($date));
        if ($diff->days === 0) {
            $diff = static::fixDiffInterval($diff, $absolute);
        }
        $value = ((($diff->days * static::HOURS_PER_DAY) +
            $diff->h) * static::MINUTES_PER_HOUR +
            $diff->i) * static::SECONDS_PER_MINUTE +
            $diff->s;

        return $absolute || !$diff->invert ? $value : -$value;
    }

    /**
     * Get the difference in microseconds.
     *
     * @param \Carbon\Carbon|\DateTimeInterface|string|null $date
     * @param bool                                          $absolute Get the absolute of the difference
     *
     * @return int
     */
    public function diffInMicroseconds($date = null, $absolute = true)
    {
        $diff = $this->diff($this->resolveCarbon($date));
        $value = (int) round((((($diff->days * static::HOURS_PER_DAY) +
            $diff->h) * static::MINUTES_PER_HOUR +
            $diff->i) * static::SECONDS_PER_MINUTE +
            ($diff->f + $diff->s)) * static::MICROSECONDS_PER_SECOND);

        return $absolute || !$diff->invert ? $value : -$value;
    }

    /**
     * Get the difference in seconds using timestamps.
     *
     * @param \Carbon\Carbon|\DateTimeInterface|string|null $date
     * @param bool                                          $absolute Get the absolute of the difference
     *
     * @return int
     */
    public function diffInRealSeconds($date = null, $absolute = true)
    {
        /** @var CarbonInterface $date */
        $date = $this->resolveCarbon($date);
        $value = $date->getTimestamp() - $this->getTimestamp();

        return $absolute ? abs($value) : $value;
    }

    /**
     * Get the difference in microseconds using timestamps.
     *
     * @param \Carbon\Carbon|\DateTimeInterface|string|null $date
     * @param bool                                          $absolute Get the absolute of the difference
     *
     * @return int
     */
    public function diffInRealMicroseconds($date = null, $absolute = true)
    {
        /** @var CarbonInterface $date */
        $date = $this->resolveCarbon($date);
        $value = ($date->timestamp - $this->timestamp) * static::MICROSECONDS_PER_SECOND +
            $date->micro - $this->micro;

        return $absolute ? abs($value) : $value;
    }

    /**
     * Get the difference in seconds as float (microsecond-precision).
     *
     * @param \Carbon\Carbon|\DateTimeInterface|string|null $date
     * @param bool                                          $absolute Get the absolute of the difference
     *
     * @return float
     */
    public function floatDiffInSeconds($date = null, $absolute = true)
    {
        return $this->diffInMicroseconds($date, $absolute) / static::MICROSECONDS_PER_SECOND;
    }

    /**
     * Get the difference in minutes as float (microsecond-precision).
     *
     * @param \Carbon\Carbon|\DateTimeInterface|string|null $date
     * @param bool                                          $absolute Get the absolute of the difference
     *
     * @return float
     */
    public function floatDiffInMinutes($date = null, $absolute = true)
    {
        return $this->floatDiffInSeconds($date, $absolute) / static::SECONDS_PER_MINUTE;
    }

    /**
     * Get the difference in hours as float (microsecond-precision).
     *
     * @param \Carbon\Carbon|\DateTimeInterface|string|null $date
     * @param bool                                          $absolute Get the absolute of the difference
     *
     * @return float
     */
    public function floatDiffInHours($date = null, $absolute = true)
    {
        return $this->floatDiffInMinutes($date, $absolute) / static::MINUTES_PER_HOUR;
    }

    /**
     * Get the difference in days as float (microsecond-precision).
     *
     * @param \Carbon\Carbon|\DateTimeInterface|string|null $date
     * @param bool                                          $absolute Get the absolute of the difference
     *
     * @return float
     */
    public function floatDiffInDays($date = null, $absolute = true)
    {
        $hoursDiff = $this->floatDiffInHours($date, $absolute);

        return ($hoursDiff < 0 ? -1 : 1) * $this->diffInDays($date) + ($hoursDiff % static::HOURS_PER_DAY) / static::HOURS_PER_DAY;
    }

    /**
     * Get the difference in months as float (microsecond-precision).
     *
     * @param \Carbon\Carbon|\DateTimeInterface|string|null $date
     * @param bool                                          $absolute Get the absolute of the difference
     *
     * @return float
     */
    public function floatDiffInMonths($date = null, $absolute = true)
    {
        $start = $this;
        $end = $this->resolveCarbon($date);
        $ascending = ($start <= $end);
        $sign = $absolute || $ascending ? 1 : -1;
        if (!$ascending) {
            $_end = $start;
            $start = $end;
            $end = $_end;
            unset($_end);
        }
        $monthsDiff = $start->diffInMonths($end);
        /** @var Carbon|CarbonImmutable $floorEnd */
        $floorEnd = $start->copy()->addMonths($monthsDiff);

        if ($floorEnd >= $end) {
            return $sign * $monthsDiff;
        }

        /** @var Carbon|CarbonImmutable $startOfMonthAfterFloorEnd */
        $startOfMonthAfterFloorEnd = $floorEnd->copy()->addMonth()->startOfMonth();

        if ($startOfMonthAfterFloorEnd > $end) {
            return $sign * ($monthsDiff + $floorEnd->floatDiffInDays($end) / $floorEnd->daysInMonth);
        }

        return $sign * ($monthsDiff + $floorEnd->floatDiffInDays($startOfMonthAfterFloorEnd) / $floorEnd->daysInMonth + $startOfMonthAfterFloorEnd->floatDiffInDays($end) / $end->daysInMonth);
    }

    /**
     * Get the difference in year as float (microsecond-precision).
     *
     * @param \Carbon\Carbon|\DateTimeInterface|string|null $date
     * @param bool                                          $absolute Get the absolute of the difference
     *
     * @return float
     */
    public function floatDiffInYears($date = null, $absolute = true)
    {
        $start = $this;
        $end = $this->resolveCarbon($date);
        $ascending = ($start <= $end);
        $sign = $absolute || $ascending ? 1 : -1;
        if (!$ascending) {
            $_end = $start;
            $start = $end;
            $end = $_end;
            unset($_end);
        }
        $yearsDiff = $start->diffInYears($end);
        /** @var Carbon|CarbonImmutable $floorEnd */
        $floorEnd = $start->copy()->addYears($yearsDiff);

        if ($floorEnd >= $end) {
            return $sign * $yearsDiff;
        }

        /** @var Carbon|CarbonImmutable $startOfYearAfterFloorEnd */
        $startOfYearAfterFloorEnd = $floorEnd->copy()->addYear()->startOfYear();

        if ($startOfYearAfterFloorEnd > $end) {
            return $sign * ($yearsDiff + $floorEnd->floatDiffInDays($end) / $floorEnd->daysInYear);
        }

        return $sign * ($yearsDiff + $floorEnd->floatDiffInDays($startOfYearAfterFloorEnd) / $floorEnd->daysInYear + $startOfYearAfterFloorEnd->floatDiffInDays($end) / $end->daysInYear);
    }

    /**
     * Get the difference in seconds as float (microsecond-precision) using timestamps.
     *
     * @param \Carbon\Carbon|\DateTimeInterface|string|null $date
     * @param bool                                          $absolute Get the absolute of the difference
     *
     * @return float
     */
    public function floatDiffInRealSeconds($date = null, $absolute = true)
    {
        return $this->diffInRealMicroseconds($date, $absolute) / static::MICROSECONDS_PER_SECOND;
    }

    /**
     * Get the difference in minutes as float (microsecond-precision) using timestamps.
     *
     * @param \Carbon\Carbon|\DateTimeInterface|string|null $date
     * @param bool                                          $absolute Get the absolute of the difference
     *
     * @return float
     */
    public function floatDiffInRealMinutes($date = null, $absolute = true)
    {
        return $this->floatDiffInRealSeconds($date, $absolute) / static::SECONDS_PER_MINUTE;
    }

    /**
     * Get the difference in hours as float (microsecond-precision) using timestamps.
     *
     * @param \Carbon\Carbon|\DateTimeInterface|string|null $date
     * @param bool                                          $absolute Get the absolute of the difference
     *
     * @return float
     */
    public function floatDiffInRealHours($date = null, $absolute = true)
    {
        return $this->floatDiffInRealMinutes($date, $absolute) / static::MINUTES_PER_HOUR;
    }

    /**
     * Get the difference in days as float (microsecond-precision).
     *
     * @param \Carbon\Carbon|\DateTimeInterface|string|null $date
     * @param bool                                          $absolute Get the absolute of the difference
     *
     * @return float
     */
    public function floatDiffInRealDays($date = null, $absolute = true)
    {
        $hoursDiff = $this->floatDiffInRealHours($date, $absolute);

        return ($hoursDiff < 0 ? -1 : 1) * $this->diffInDays($date) + ($hoursDiff % static::HOURS_PER_DAY) / static::HOURS_PER_DAY;
    }

    /**
     * Get the difference in months as float (microsecond-precision) using timestamps.
     *
     * @param \Carbon\Carbon|\DateTimeInterface|string|null $date
     * @param bool                                          $absolute Get the absolute of the difference
     *
     * @return float
     */
    public function floatDiffInRealMonths($date = null, $absolute = true)
    {
        $start = $this;
        $end = $this->resolveCarbon($date);
        $ascending = ($start <= $end);
        $sign = $absolute || $ascending ? 1 : -1;
        if (!$ascending) {
            $_end = $start;
            $start = $end;
            $end = $_end;
            unset($_end);
        }
        $monthsDiff = $start->diffInMonths($end);
        /** @var Carbon|CarbonImmutable $floorEnd */
        $floorEnd = $start->copy()->addMonths($monthsDiff);

        if ($floorEnd >= $end) {
            return $sign * $monthsDiff;
        }

        /** @var Carbon|CarbonImmutable $startOfMonthAfterFloorEnd */
        $startOfMonthAfterFloorEnd = $floorEnd->copy()->addMonth()->startOfMonth();

        if ($startOfMonthAfterFloorEnd > $end) {
            return $sign * ($monthsDiff + $floorEnd->floatDiffInRealDays($end) / $floorEnd->daysInMonth);
        }

        return $sign * ($monthsDiff + $floorEnd->floatDiffInRealDays($startOfMonthAfterFloorEnd) / $floorEnd->daysInMonth + $startOfMonthAfterFloorEnd->floatDiffInRealDays($end) / $end->daysInMonth);
    }

    /**
     * Get the difference in year as float (microsecond-precision) using timestamps.
     *
     * @param \Carbon\Carbon|\DateTimeInterface|string|null $date
     * @param bool                                          $absolute Get the absolute of the difference
     *
     * @return float
     */
    public function floatDiffInRealYears($date = null, $absolute = true)
    {
        $start = $this;
        $end = $this->resolveCarbon($date);
        $ascending = ($start <= $end);
        $sign = $absolute || $ascending ? 1 : -1;
        if (!$ascending) {
            $_end = $start;
            $start = $end;
            $end = $_end;
            unset($_end);
        }
        $yearsDiff = $start->diffInYears($end);
        /** @var Carbon|CarbonImmutable $floorEnd */
        $floorEnd = $start->copy()->addYears($yearsDiff);

        if ($floorEnd >= $end) {
            return $sign * $yearsDiff;
        }

        /** @var Carbon|CarbonImmutable $startOfYearAfterFloorEnd */
        $startOfYearAfterFloorEnd = $floorEnd->copy()->addYear()->startOfYear();

        if ($startOfYearAfterFloorEnd > $end) {
            return $sign * ($yearsDiff + $floorEnd->floatDiffInRealDays($end) / $floorEnd->daysInYear);
        }

        return $sign * ($yearsDiff + $floorEnd->floatDiffInRealDays($startOfYearAfterFloorEnd) / $floorEnd->daysInYear + $startOfYearAfterFloorEnd->floatDiffInRealDays($end) / $end->daysInYear);
    }

    /**
     * The number of seconds since midnight.
     *
     * @return int
     */
    public function secondsSinceMidnight()
    {
        return $this->diffInSeconds($this->copy()->startOfDay());
    }

    /**
     * The number of seconds until 23:59:59.
     *
     * @return int
     */
    public function secondsUntilEndOfDay()
    {
        return $this->diffInSeconds($this->copy()->endOfDay());
    }

    /**
     * Get the difference in a human readable format in the current locale from current instance to an other
     * instance given (or now if null given).
     *
     * When comparing a value in the past to default now:
     * 1 hour ago
     * 5 months ago
     *
     * When comparing a value in the future to default now:
     * 1 hour from now
     * 5 months from now
     *
     * When comparing a value in the past to another value:
     * 1 hour before
     * 5 months before
     *
     * When comparing a value in the future to another value:
     * 1 hour after
     * 5 months after
     *
     * @param Carbon|null $other
     * @param int         $syntax  difference modifiers (ago, after, etc) rules
     *                             Possible values:
     *                             - CarbonInterface::DIFF_ABSOLUTE
     *                             - CarbonInterface::DIFF_RELATIVE_AUTO
     *                             - CarbonInterface::DIFF_RELATIVE_TO_NOW
     *                             - CarbonInterface::DIFF_RELATIVE_TO_OTHER
     *                             Default value: CarbonInterface::DIFF_RELATIVE_AUTO
     * @param bool        $short   displays short format of time units
     * @param int         $parts   displays number of parts in the interval
     * @param int         $options human diff options
     *
     * @return string
     */
    public function diffForHumans($other = null, $syntax = null, $short = false, $parts = 1, $options = null)
    {
        /* @var CarbonInterface $this */
        $syntax = (int) ($syntax === null ? static::DIFF_RELATIVE_AUTO : $syntax);
        $syntax = $syntax === static::DIFF_RELATIVE_AUTO && $other === null ? static::DIFF_RELATIVE_TO_NOW : $syntax;

        $parts = min(7, max(1, (int) $parts));

        if ($other === null) {
            $other = $this->nowWithSameTz();
        } elseif (!$other instanceof DateTimeInterface) {
            $other = static::parse($other);
        }

        if (is_null($options)) {
            $options = $this->localHumanDiffOptions ?? static::getHumanDiffOptions();
        }

        return $this->diffAsCarbonInterval($other, false)
            ->setLocalTranslator($this->getLocalTranslator())
            ->forHumans($syntax, (bool) $short, $parts, $options);
    }

    /**
     * @alias diffForHumans
     *
     * Get the difference in a human readable format in the current locale from current instance to an other
     * instance given (or now if null given).
     *
     * @param Carbon|null $other
     * @param int         $syntax  difference modifiers (ago, after, etc) rules
     *                             Possible values:
     *                             - CarbonInterface::DIFF_ABSOLUTE
     *                             - CarbonInterface::DIFF_RELATIVE_AUTO
     *                             - CarbonInterface::DIFF_RELATIVE_TO_NOW
     *                             - CarbonInterface::DIFF_RELATIVE_TO_OTHER
     *                             Default value: CarbonInterface::DIFF_RELATIVE_AUTO
     * @param bool        $short   displays short format of time units
     * @param int         $parts   displays number of parts in the interval
     * @param int         $options human diff options
     *
     * @return string
     */
    public function from($other = null, $syntax = null, $short = false, $parts = 1, $options = null)
    {
        return $this->diffForHumans($other, $syntax, $short, $parts, $options);
    }

    /**
     * @alias diffForHumans
     *
     * Get the difference in a human readable format in the current locale from current instance to an other
     * instance given (or now if null given).
     */
    public function since($other = null, $syntax = null, $short = false, $parts = 1, $options = null)
    {
        return $this->diffForHumans($other, $syntax, $short, $parts, $options);
    }

    /**
     * Get the difference in a human readable format in the current locale from an other
     * instance given (or now if null given) to current instance.
     *
     * When comparing a value in the past to default now:
     * 1 hour from now
     * 5 months from now
     *
     * When comparing a value in the future to default now:
     * 1 hour ago
     * 5 months ago
     *
     * When comparing a value in the past to another value:
     * 1 hour after
     * 5 months after
     *
     * When comparing a value in the future to another value:
     * 1 hour before
     * 5 months before
     *
     * @param Carbon|null $other
     * @param int         $syntax  difference modifiers (ago, after, etc) rules
     *                             Possible values:
     *                             - CarbonInterface::DIFF_ABSOLUTE
     *                             - CarbonInterface::DIFF_RELATIVE_AUTO
     *                             - CarbonInterface::DIFF_RELATIVE_TO_NOW
     *                             - CarbonInterface::DIFF_RELATIVE_TO_OTHER
     *                             Default value: CarbonInterface::DIFF_RELATIVE_AUTO
     * @param bool        $short   displays short format of time units
     * @param int         $parts   displays number of parts in the interval
     * @param int         $options human diff options
     *
     * @return string
     */
    public function to($other = null, $syntax = null, $short = false, $parts = 1, $options = null)
    {
        if (!$syntax && !$other) {
            $syntax = CarbonInterface::DIFF_RELATIVE_TO_NOW;
        }

        return $this->resolveCarbon($other)->diffForHumans($this, $syntax, $short, $parts, $options);
    }

    /**
     * @alias to
     *
     * Get the difference in a human readable format in the current locale from an other
     * instance given (or now if null given) to current instance.
     *
     * @param Carbon|null $other
     * @param int         $syntax  difference modifiers (ago, after, etc) rules
     *                             Possible values:
     *                             - CarbonInterface::DIFF_ABSOLUTE
     *                             - CarbonInterface::DIFF_RELATIVE_AUTO
     *                             - CarbonInterface::DIFF_RELATIVE_TO_NOW
     *                             - CarbonInterface::DIFF_RELATIVE_TO_OTHER
     *                             Default value: CarbonInterface::DIFF_RELATIVE_AUTO
     * @param bool        $short   displays short format of time units
     * @param int         $parts   displays number of parts in the interval
     * @param int         $options human diff options
     *
     * @return string
     */
    public function until($other = null, $syntax = null, $short = false, $parts = 1, $options = null)
    {
        return $this->to($other, $syntax, $short, $parts, $options);
    }

    /**
     * Get the difference in a human readable format in the current locale from current
     * instance to now.
     *
     * @param int  $syntax  difference modifiers (ago, after, etc) rules
     *                      Possible values:
     *                      - CarbonInterface::DIFF_ABSOLUTE
     *                      - CarbonInterface::DIFF_RELATIVE_AUTO
     *                      - CarbonInterface::DIFF_RELATIVE_TO_NOW
     *                      - CarbonInterface::DIFF_RELATIVE_TO_OTHER
     *                      Default value: CarbonInterface::DIFF_RELATIVE_AUTO
     * @param bool $short   displays short format of time units
     * @param int  $parts   displays number of parts in the interval
     * @param int  $options human diff options
     *
     * @return string
     */
    public function fromNow($syntax = null, $short = false, $parts = 1, $options = null)
    {
        return $this->from(null, $syntax, $short, $parts, $options);
    }

    /**
     * Get the difference in a human readable format in the current locale from an other
     * instance given to now
     *
     * @param int  $syntax  difference modifiers (ago, after, etc) rules
     *                      Possible values:
     *                      - CarbonInterface::DIFF_ABSOLUTE
     *                      - CarbonInterface::DIFF_RELATIVE_AUTO
     *                      - CarbonInterface::DIFF_RELATIVE_TO_NOW
     *                      - CarbonInterface::DIFF_RELATIVE_TO_OTHER
     *                      Default value: CarbonInterface::DIFF_RELATIVE_AUTO
     * @param bool $short   displays short format of time units
     * @param int  $parts   displays number of parts in the interval
     * @param int  $options human diff options
     *
     * @return string
     */
    public function toNow($syntax = null, $short = false, $parts = 1, $options = null)
    {
        return $this->to(null, $syntax, $short, $parts, $options);
    }

    /**
     * Returns either the close date "Friday 15h30", or a calendar date "10/09/2017" is farthest than 7 days from now.
     *
     * @param \Carbon\Carbon|\DateTimeInterface|string|null $referenceTime
     * @param array                                         $formats
     *
     * @return string
     */
    public function calendar($referenceTime = null, array $formats = [])
    {
        /** @var CarbonInterface $current */
        $current = $this->copy()->startOfDay();
        /** @var CarbonInterface $other */
        $other = $this->resolveCarbon($referenceTime)->copy()->setTimezone($this->getTimezone())->startOfDay();
        $diff = $other->diffInDays($current, false);
        $format = $diff < -6 ? 'sameElse' : (
            $diff < -1 ? 'lastWeek' : (
                $diff < 0 ? 'lastDay' : (
                    $diff < 1 ? 'sameDay' : (
                        $diff < 2 ? 'nextDay' : (
                            $diff < 7 ? 'nextWeek' : 'sameElse'
                        )
                    )
                )
            )
        );
        $format = array_merge($this->getCalendarFormats(), $formats)[$format];
        if ($format instanceof Closure) {
            $format = $format($current, $other) ?? '';
        }

        return $this->isoFormat(strval($format));
    }
}
