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
use Carbon\CarbonInterface;
use Carbon\CarbonInterval;
use Carbon\CarbonPeriod;
use Carbon\Translator;
use Closure;
use DateTimeInterface;

/**
 * Trait Difference.
 *
 * Depends on the following methods:
 *
 * @method \DateInterval diff(\DateTimeInterface $date)
 * @method CarbonInterface copy()
 * @method static Translator translator()
 */
trait Difference
{
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
        return CarbonInterval::instance($this->diff($this->resolveCarbon($date), $absolute));
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
        $value = $diff->days * static::HOURS_PER_DAY * static::MINUTES_PER_HOUR * static::SECONDS_PER_MINUTE +
            $diff->h * static::MINUTES_PER_HOUR * static::SECONDS_PER_MINUTE +
            $diff->i * static::SECONDS_PER_MINUTE +
            $diff->s;

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
     * Get the difference in a human readable format in the current locale.
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
     * @param bool        $absolute removes time difference modifiers ago, after, etc
     * @param bool        $short    displays short format of time units
     * @param int         $parts    displays number of parts in the interval
     *
     * @return string
     */
    public function diffForHumans($other = null, $absolute = false, $short = false, $parts = 1)
    {
        /* @var CarbonInterface $this */
        $isNow = $other === null;
        $interval = [];

        $parts = min(6, max(1, (int) $parts));
        $count = 1;
        $unit = $short ? 's' : 'second';

        if ($isNow) {
            $other = $this->nowWithSameTz();
        } elseif (!$other instanceof DateTimeInterface) {
            $other = static::parse($other);
        }

        $diffInterval = $this->diff($other);

        $diffIntervalArray = [
            ['value' => $diffInterval->y, 'unit' => 'year',    'unitShort' => 'y'],
            ['value' => $diffInterval->m, 'unit' => 'month',   'unitShort' => 'm'],
            ['value' => $diffInterval->d, 'unit' => 'day',     'unitShort' => 'd'],
            ['value' => $diffInterval->h, 'unit' => 'hour',    'unitShort' => 'h'],
            ['value' => $diffInterval->i, 'unit' => 'minute',  'unitShort' => 'min'],
            ['value' => $diffInterval->s, 'unit' => 'second',  'unitShort' => 's'],
        ];

        foreach ($diffIntervalArray as $diffIntervalData) {
            if ($diffIntervalData['value'] > 0) {
                $unit = $short ? $diffIntervalData['unitShort'] : $diffIntervalData['unit'];
                $count = $diffIntervalData['value'];

                if ($diffIntervalData['unit'] === 'day' && $count >= static::DAYS_PER_WEEK) {
                    $unit = $short ? 'w' : 'week';
                    $count = (int) ($count / static::DAYS_PER_WEEK);

                    $interval[] = static::translator()->transChoice($unit, $count, [':count' => $count]);

                    // get the count days excluding weeks (might be zero)
                    $numOfDaysCount = (int) ($diffIntervalData['value'] - ($count * static::DAYS_PER_WEEK));

                    if ($numOfDaysCount > 0 && count($interval) < $parts) {
                        $unit = $short ? 'd' : 'day';
                        $count = $numOfDaysCount;
                        $interval[] = static::translator()->transChoice($unit, $count, [':count' => $count]);
                    }
                } else {
                    $interval[] = static::translator()->transChoice($unit, $count, [':count' => $count]);
                }
            }

            // break the loop after we get the required number of parts in array
            if (count($interval) >= $parts) {
                break;
            }
        }

        if (count($interval) === 0) {
            if ($isNow && static::getHumanDiffOptions() & self::JUST_NOW) {
                $key = 'diff_now';
                $translation = static::translator()->trans($key);
                if ($translation !== $key) {
                    return $translation;
                }
            }
            $count = static::getHumanDiffOptions() & self::NO_ZERO_DIFF ? 1 : 0;
            $unit = $short ? 's' : 'second';
            $interval[] = static::translator()->transChoice($unit, $count, [':count' => $count]);
        }

        // join the interval parts by a space
        $time = implode(' ', $interval);

        unset($diffIntervalArray, $interval);

        if ($absolute) {
            return $time;
        }

        $isFuture = $diffInterval->invert === 1;

        $transId = $isNow ? ($isFuture ? 'from_now' : 'ago') : ($isFuture ? 'after' : 'before');

        if ($parts === 1) {
            if ($isNow && $unit === 'day') {
                if ($count === 1 && static::getHumanDiffOptions() & self::ONE_DAY_WORDS) {
                    $key = $isFuture ? 'diff_tomorrow' : 'diff_yesterday';
                    $translation = static::translator()->trans($key);
                    if ($translation !== $key) {
                        return $translation;
                    }
                }
                if ($count === 2 && static::getHumanDiffOptions() & self::TWO_DAY_WORDS) {
                    $key = $isFuture ? 'diff_after_tomorrow' : 'diff_before_yesterday';
                    $translation = static::translator()->trans($key);
                    if ($translation !== $key) {
                        return $translation;
                    }
                }
            }
            // Some langs have special pluralization for past and future tense.
            $key = $unit.'_'.$transId;
            $count = $count ?: 1;
            if ($key !== static::translator()->transChoice($key, $count)) {
                $time = static::translator()->transChoice($key, $count, [':count' => $count]);
            }
        }

        return static::translator()->trans($transId, [':time' => $time]);
    }
}
