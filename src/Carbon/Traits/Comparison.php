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

use BadMethodCallException;
use Carbon\CarbonInterface;
use Carbon\Exceptions\BadComparisonUnitException;
use InvalidArgumentException;

/**
 * Trait Comparison.
 *
 * Comparison utils and testers. All the following methods return booleans.
 * nowWithSameTz
 *
 * Depends on the following methods:
 *
 * @method static        resolveCarbon($date)
 * @method static        copy()
 * @method static        nowWithSameTz()
 * @method static static yesterday($timezone = null)
 * @method static static tomorrow($timezone = null)
 */
trait Comparison
{
    /**
     * Determines if the instance is equal to another
     *
     * @example
     * ```
     * Carbon::parse('2018-07-25 12:45:16')->eq('2018-07-25 12:45:16'); // true
     * Carbon::parse('2018-07-25 12:45:16')->eq(Carbon::parse('2018-07-25 12:45:16')); // true
     * Carbon::parse('2018-07-25 12:45:16')->eq('2018-07-25 12:45:17'); // false
     * ```
     *
     * @param \Carbon\Carbon|\DateTimeInterface|mixed $date
     *
     * @see equalTo()
     *
     * @return bool
     */
    public function eq($date): bool
    {
        return $this->equalTo($date);
    }

    /**
     * Determines if the instance is equal to another
     *
     * @example
     * ```
     * Carbon::parse('2018-07-25 12:45:16')->equalTo('2018-07-25 12:45:16'); // true
     * Carbon::parse('2018-07-25 12:45:16')->equalTo(Carbon::parse('2018-07-25 12:45:16')); // true
     * Carbon::parse('2018-07-25 12:45:16')->equalTo('2018-07-25 12:45:17'); // false
     * ```
     *
     * @param \Carbon\Carbon|\DateTimeInterface|mixed $date
     *
     * @return bool
     */
    public function equalTo($date): bool
    {
        return $this == $date;
    }

    /**
     * Determines if the instance is not equal to another
     *
     * @example
     * ```
     * Carbon::parse('2018-07-25 12:45:16')->ne('2018-07-25 12:45:16'); // false
     * Carbon::parse('2018-07-25 12:45:16')->ne(Carbon::parse('2018-07-25 12:45:16')); // false
     * Carbon::parse('2018-07-25 12:45:16')->ne('2018-07-25 12:45:17'); // true
     * ```
     *
     * @param \Carbon\Carbon|\DateTimeInterface|mixed $date
     *
     * @see notEqualTo()
     *
     * @return bool
     */
    public function ne($date): bool
    {
        return $this->notEqualTo($date);
    }

    /**
     * Determines if the instance is not equal to another
     *
     * @example
     * ```
     * Carbon::parse('2018-07-25 12:45:16')->notEqualTo('2018-07-25 12:45:16'); // false
     * Carbon::parse('2018-07-25 12:45:16')->notEqualTo(Carbon::parse('2018-07-25 12:45:16')); // false
     * Carbon::parse('2018-07-25 12:45:16')->notEqualTo('2018-07-25 12:45:17'); // true
     * ```
     *
     * @param \Carbon\Carbon|\DateTimeInterface|mixed $date
     *
     * @return bool
     */
    public function notEqualTo($date): bool
    {
        return !$this->equalTo($date);
    }

    /**
     * Determines if the instance is greater (after) than another
     *
     * @example
     * ```
     * Carbon::parse('2018-07-25 12:45:16')->gt('2018-07-25 12:45:15'); // true
     * Carbon::parse('2018-07-25 12:45:16')->gt('2018-07-25 12:45:16'); // false
     * Carbon::parse('2018-07-25 12:45:16')->gt('2018-07-25 12:45:17'); // false
     * ```
     *
     * @param \Carbon\Carbon|\DateTimeInterface|mixed $date
     *
     * @see greaterThan()
     *
     * @return bool
     */
    public function gt($date): bool
    {
        return $this->greaterThan($date);
    }

    /**
     * Determines if the instance is greater (after) than another
     *
     * @example
     * ```
     * Carbon::parse('2018-07-25 12:45:16')->greaterThan('2018-07-25 12:45:15'); // true
     * Carbon::parse('2018-07-25 12:45:16')->greaterThan('2018-07-25 12:45:16'); // false
     * Carbon::parse('2018-07-25 12:45:16')->greaterThan('2018-07-25 12:45:17'); // false
     * ```
     *
     * @param \Carbon\Carbon|\DateTimeInterface|mixed $date
     *
     * @return bool
     */
    public function greaterThan($date): bool
    {
        return $this > $date;
    }

    /**
     * Determines if the instance is greater (after) than another
     *
     * @example
     * ```
     * Carbon::parse('2018-07-25 12:45:16')->isAfter('2018-07-25 12:45:15'); // true
     * Carbon::parse('2018-07-25 12:45:16')->isAfter('2018-07-25 12:45:16'); // false
     * Carbon::parse('2018-07-25 12:45:16')->isAfter('2018-07-25 12:45:17'); // false
     * ```
     *
     * @param \Carbon\Carbon|\DateTimeInterface|mixed $date
     *
     * @see greaterThan()
     *
     * @return bool
     */
    public function isAfter($date): bool
    {
        return $this->greaterThan($date);
    }

    /**
     * Determines if the instance is greater (after) than or equal to another
     *
     * @example
     * ```
     * Carbon::parse('2018-07-25 12:45:16')->gte('2018-07-25 12:45:15'); // true
     * Carbon::parse('2018-07-25 12:45:16')->gte('2018-07-25 12:45:16'); // true
     * Carbon::parse('2018-07-25 12:45:16')->gte('2018-07-25 12:45:17'); // false
     * ```
     *
     * @param \Carbon\Carbon|\DateTimeInterface|mixed $date
     *
     * @see greaterThanOrEqualTo()
     *
     * @return bool
     */
    public function gte($date): bool
    {
        return $this->greaterThanOrEqualTo($date);
    }

    /**
     * Determines if the instance is greater (after) than or equal to another
     *
     * @example
     * ```
     * Carbon::parse('2018-07-25 12:45:16')->greaterThanOrEqualTo('2018-07-25 12:45:15'); // true
     * Carbon::parse('2018-07-25 12:45:16')->greaterThanOrEqualTo('2018-07-25 12:45:16'); // true
     * Carbon::parse('2018-07-25 12:45:16')->greaterThanOrEqualTo('2018-07-25 12:45:17'); // false
     * ```
     *
     * @param \Carbon\Carbon|\DateTimeInterface|mixed $date
     *
     * @return bool
     */
    public function greaterThanOrEqualTo($date): bool
    {
        return $this >= $date;
    }

    /**
     * Determines if the instance is less (before) than another
     *
     * @example
     * ```
     * Carbon::parse('2018-07-25 12:45:16')->lt('2018-07-25 12:45:15'); // false
     * Carbon::parse('2018-07-25 12:45:16')->lt('2018-07-25 12:45:16'); // false
     * Carbon::parse('2018-07-25 12:45:16')->lt('2018-07-25 12:45:17'); // true
     * ```
     *
     * @param \Carbon\Carbon|\DateTimeInterface|mixed $date
     *
     * @see lessThan()
     *
     * @return bool
     */
    public function lt($date): bool
    {
        return $this->lessThan($date);
    }

    /**
     * Determines if the instance is less (before) than another
     *
     * @example
     * ```
     * Carbon::parse('2018-07-25 12:45:16')->lessThan('2018-07-25 12:45:15'); // false
     * Carbon::parse('2018-07-25 12:45:16')->lessThan('2018-07-25 12:45:16'); // false
     * Carbon::parse('2018-07-25 12:45:16')->lessThan('2018-07-25 12:45:17'); // true
     * ```
     *
     * @param \Carbon\Carbon|\DateTimeInterface|mixed $date
     *
     * @return bool
     */
    public function lessThan($date): bool
    {
        return $this < $date;
    }

    /**
     * Determines if the instance is less (before) than another
     *
     * @example
     * ```
     * Carbon::parse('2018-07-25 12:45:16')->isBefore('2018-07-25 12:45:15'); // false
     * Carbon::parse('2018-07-25 12:45:16')->isBefore('2018-07-25 12:45:16'); // false
     * Carbon::parse('2018-07-25 12:45:16')->isBefore('2018-07-25 12:45:17'); // true
     * ```
     *
     * @param \Carbon\Carbon|\DateTimeInterface|mixed $date
     *
     * @see lessThan()
     *
     * @return bool
     */
    public function isBefore($date): bool
    {
        return $this->lessThan($date);
    }

    /**
     * Determines if the instance is less (before) or equal to another
     *
     * @example
     * ```
     * Carbon::parse('2018-07-25 12:45:16')->lte('2018-07-25 12:45:15'); // false
     * Carbon::parse('2018-07-25 12:45:16')->lte('2018-07-25 12:45:16'); // true
     * Carbon::parse('2018-07-25 12:45:16')->lte('2018-07-25 12:45:17'); // true
     * ```
     *
     * @param \Carbon\Carbon|\DateTimeInterface|mixed $date
     *
     * @see lessThanOrEqualTo()
     *
     * @return bool
     */
    public function lte($date): bool
    {
        return $this->lessThanOrEqualTo($date);
    }

    /**
     * Determines if the instance is less (before) or equal to another
     *
     * @example
     * ```
     * Carbon::parse('2018-07-25 12:45:16')->lessThanOrEqualTo('2018-07-25 12:45:15'); // false
     * Carbon::parse('2018-07-25 12:45:16')->lessThanOrEqualTo('2018-07-25 12:45:16'); // true
     * Carbon::parse('2018-07-25 12:45:16')->lessThanOrEqualTo('2018-07-25 12:45:17'); // true
     * ```
     *
     * @param \Carbon\Carbon|\DateTimeInterface|mixed $date
     *
     * @return bool
     */
    public function lessThanOrEqualTo($date): bool
    {
        return $this <= $date;
    }

    /**
     * Determines if the instance is between two others.
     *
     * The third argument allow you to specify if bounds are included or not (true by default)
     * but for when you including/excluding bounds may produce different results in your application,
     * we recommend to use the explicit methods ->betweenIncluded() or ->betweenExcluded() instead.
     *
     * @example
     * ```
     * Carbon::parse('2018-07-25')->between('2018-07-14', '2018-08-01'); // true
     * Carbon::parse('2018-07-25')->between('2018-08-01', '2018-08-20'); // false
     * Carbon::parse('2018-07-25')->between('2018-07-25', '2018-08-01'); // true
     * Carbon::parse('2018-07-25')->between('2018-07-25', '2018-08-01', false); // false
     * ```
     *
     * @param \Carbon\Carbon|\DateTimeInterface|mixed $date1
     * @param \Carbon\Carbon|\DateTimeInterface|mixed $date2
     * @param bool                                    $equal Indicates if an equal to comparison should be done
     *
     * @return bool
     */
    public function between($date1, $date2, $equal = true): bool
    {
        $date1 = $this->resolveCarbon($date1);
        $date2 = $this->resolveCarbon($date2);

        if ($date1->greaterThan($date2)) {
            [$date1, $date2] = [$date2, $date1];
        }

        if ($equal) {
            return $this->greaterThanOrEqualTo($date1) && $this->lessThanOrEqualTo($date2);
        }

        return $this->greaterThan($date1) && $this->lessThan($date2);
    }

    /**
     * Determines if the instance is between two others, bounds included.
     *
     * @example
     * ```
     * Carbon::parse('2018-07-25')->betweenIncluded('2018-07-14', '2018-08-01'); // true
     * Carbon::parse('2018-07-25')->betweenIncluded('2018-08-01', '2018-08-20'); // false
     * Carbon::parse('2018-07-25')->betweenIncluded('2018-07-25', '2018-08-01'); // true
     * ```
     *
     * @param \Carbon\Carbon|\DateTimeInterface|mixed $date1
     * @param \Carbon\Carbon|\DateTimeInterface|mixed $date2
     *
     * @return bool
     */
    public function betweenIncluded($date1, $date2): bool
    {
        return $this->between($date1, $date2, true);
    }

    /**
     * Determines if the instance is between two others, bounds excluded.
     *
     * @example
     * ```
     * Carbon::parse('2018-07-25')->betweenExcluded('2018-07-14', '2018-08-01'); // true
     * Carbon::parse('2018-07-25')->betweenExcluded('2018-08-01', '2018-08-20'); // false
     * Carbon::parse('2018-07-25')->betweenExcluded('2018-07-25', '2018-08-01'); // false
     * ```
     *
     * @param \Carbon\Carbon|\DateTimeInterface|mixed $date1
     * @param \Carbon\Carbon|\DateTimeInterface|mixed $date2
     *
     * @return bool
     */
    public function betweenExcluded($date1, $date2): bool
    {
        return $this->between($date1, $date2, false);
    }

    /**
     * Determines if the instance is between two others
     *
     * @example
     * ```
     * Carbon::parse('2018-07-25')->isBetween('2018-07-14', '2018-08-01'); // true
     * Carbon::parse('2018-07-25')->isBetween('2018-08-01', '2018-08-20'); // false
     * Carbon::parse('2018-07-25')->isBetween('2018-07-25', '2018-08-01'); // true
     * Carbon::parse('2018-07-25')->isBetween('2018-07-25', '2018-08-01', false); // false
     * ```
     *
     * @param \Carbon\Carbon|\DateTimeInterface|mixed $date1
     * @param \Carbon\Carbon|\DateTimeInterface|mixed $date2
     * @param bool                                    $equal Indicates if an equal to comparison should be done
     *
     * @return bool
     */
    public function isBetween($date1, $date2, $equal = true): bool
    {
        return $this->between($date1, $date2, $equal);
    }

    /**
     * Determines if the instance is a weekday.
     *
     * @example
     * ```
     * Carbon::parse('2019-07-14')->isWeekday(); // false
     * Carbon::parse('2019-07-15')->isWeekday(); // true
     * ```
     *
     * @return bool
     */
    public function isWeekday()
    {
        return !$this->isWeekend();
    }

    /**
     * Determines if the instance is a weekend day.
     *
     * @example
     * ```
     * Carbon::parse('2019-07-14')->isWeekend(); // true
     * Carbon::parse('2019-07-15')->isWeekend(); // false
     * ```
     *
     * @return bool
     */
    public function isWeekend()
    {
        return in_array($this->dayOfWeek, static::$weekendDays);
    }

    /**
     * Determines if the instance is yesterday.
     *
     * @example
     * ```
     * Carbon::yesterday()->isYesterday(); // true
     * Carbon::tomorrow()->isYesterday(); // false
     * ```
     *
     * @return bool
     */
    public function isYesterday()
    {
        return $this->toDateString() === static::yesterday($this->getTimezone())->toDateString();
    }

    /**
     * Determines if the instance is today.
     *
     * @example
     * ```
     * Carbon::today()->isToday(); // true
     * Carbon::tomorrow()->isToday(); // false
     * ```
     *
     * @return bool
     */
    public function isToday()
    {
        return $this->toDateString() === $this->nowWithSameTz()->toDateString();
    }

    /**
     * Determines if the instance is tomorrow.
     *
     * @example
     * ```
     * Carbon::tomorrow()->isTomorrow(); // true
     * Carbon::yesterday()->isTomorrow(); // false
     * ```
     *
     * @return bool
     */
    public function isTomorrow()
    {
        return $this->toDateString() === static::tomorrow($this->getTimezone())->toDateString();
    }

    /**
     * Determines if the instance is in the future, ie. greater (after) than now.
     *
     * @example
     * ```
     * Carbon::now()->addHours(5)->isFuture(); // true
     * Carbon::now()->subHours(5)->isFuture(); // false
     * ```
     *
     * @return bool
     */
    public function isFuture()
    {
        return $this->greaterThan($this->nowWithSameTz());
    }

    /**
     * Determines if the instance is in the past, ie. less (before) than now.
     *
     * @example
     * ```
     * Carbon::now()->subHours(5)->isPast(); // true
     * Carbon::now()->addHours(5)->isPast(); // false
     * ```
     *
     * @return bool
     */
    public function isPast()
    {
        return $this->lessThan($this->nowWithSameTz());
    }

    /**
     * Determines if the instance is a leap year.
     *
     * @example
     * ```
     * Carbon::parse('2020-01-01')->isLeapYear(); // true
     * Carbon::parse('2019-01-01')->isLeapYear(); // false
     * ```
     *
     * @return bool
     */
    public function isLeapYear()
    {
        return $this->rawFormat('L') === '1';
    }

    /**
     * Determines if the instance is a long year
     *
     * @example
     * ```
     * Carbon::parse('2015-01-01')->isLongYear(); // true
     * Carbon::parse('2016-01-01')->isLongYear(); // false
     * ```
     *
     * @see https://en.wikipedia.org/wiki/ISO_8601#Week_dates
     *
     * @return bool
     */
    public function isLongYear()
    {
        return static::create($this->year, 12, 28, 0, 0, 0, $this->tz)->weekOfYear === 53;
    }

    /**
     * Compares the formatted values of the two dates.
     *
     * @example
     * ```
     * Carbon::parse('2019-06-13')->isSameAs('Y-d', Carbon::parse('2019-12-13')); // true
     * Carbon::parse('2019-06-13')->isSameAs('Y-d', Carbon::parse('2019-06-14')); // false
     * ```
     *
     * @param string                                        $format date formats to compare.
     * @param \Carbon\Carbon|\DateTimeInterface|string|null $date   instance to compare with or null to use current day.
     *
     * @return bool
     */
    public function isSameAs($format, $date = null)
    {
        return $this->rawFormat($format) === $this->resolveCarbon($date)->rawFormat($format);
    }

    /**
     * Determines if the instance is in the current unit given.
     *
     * @example
     * ```
     * Carbon::parse('2019-01-13')->isSameUnit('year', Carbon::parse('2019-12-25')); // true
     * Carbon::parse('2018-12-13')->isSameUnit('year', Carbon::parse('2019-12-25')); // false
     * ```
     *
     * @param string                                 $unit singular unit string
     * @param \Carbon\Carbon|\DateTimeInterface|null $date instance to compare with or null to use current day.
     *
     * @throws BadComparisonUnitException
     *
     * @return bool
     */
    public function isSameUnit($unit, $date = null)
    {
        $units = [
            // @call isSameUnit
            'year' => 'Y',
            // @call isSameUnit
            'week' => 'o-W',
            // @call isSameUnit
            'day' => 'Y-m-d',
            // @call isSameUnit
            'hour' => 'Y-m-d H',
            // @call isSameUnit
            'minute' => 'Y-m-d H:i',
            // @call isSameUnit
            'second' => 'Y-m-d H:i:s',
            // @call isSameUnit
            'micro' => 'Y-m-d H:i:s.u',
            // @call isSameUnit
            'microsecond' => 'Y-m-d H:i:s.u',
        ];

        if (!isset($units[$unit])) {
            if (isset($this->$unit)) {
                return $this->$unit === $this->resolveCarbon($date)->$unit;
            }

            if ($this->localStrictModeEnabled ?? static::isStrictModeEnabled()) {
                throw new BadComparisonUnitException($unit);
            }

            return false;
        }

        return $this->isSameAs($units[$unit], $date);
    }

    /**
     * Determines if the instance is in the current unit given.
     *
     * @example
     * ```
     * Carbon::now()->isCurrentUnit('hour'); // true
     * Carbon::now()->subHours(2)->isCurrentUnit('hour'); // false
     * ```
     *
     * @param string $unit The unit to test.
     *
     * @throws BadMethodCallException
     *
     * @return bool
     */
    public function isCurrentUnit($unit)
    {
        return $this->{'isSame'.ucfirst($unit)}();
    }

    /**
     * Checks if the passed in date is in the same quarter as the instance quarter (and year if needed).
     *
     * @example
     * ```
     * Carbon::parse('2019-01-12')->isSameQuarter(Carbon::parse('2019-03-01')); // true
     * Carbon::parse('2019-01-12')->isSameQuarter(Carbon::parse('2019-04-01')); // false
     * Carbon::parse('2019-01-12')->isSameQuarter(Carbon::parse('2018-03-01')); // false
     * Carbon::parse('2019-01-12')->isSameQuarter(Carbon::parse('2018-03-01'), false); // true
     * ```
     *
     * @param \Carbon\Carbon|\DateTimeInterface|string|null $date       The instance to compare with or null to use current day.
     * @param bool                                          $ofSameYear Check if it is the same month in the same year.
     *
     * @return bool
     */
    public function isSameQuarter($date = null, $ofSameYear = true)
    {
        $date = $this->resolveCarbon($date);

        return $this->quarter === $date->quarter && (!$ofSameYear || $this->isSameYear($date));
    }

    /**
     * Checks if the passed in date is in the same month as the instance´s month.
     *
     * @example
     * ```
     * Carbon::parse('2019-01-12')->isSameMonth(Carbon::parse('2019-01-01')); // true
     * Carbon::parse('2019-01-12')->isSameMonth(Carbon::parse('2019-02-01')); // false
     * Carbon::parse('2019-01-12')->isSameMonth(Carbon::parse('2018-01-01')); // false
     * Carbon::parse('2019-01-12')->isSameMonth(Carbon::parse('2018-01-01'), false); // true
     * ```
     *
     * @param \Carbon\Carbon|\DateTimeInterface|null $date       The instance to compare with or null to use the current date.
     * @param bool                                   $ofSameYear Check if it is the same month in the same year.
     *
     * @return bool
     */
    public function isSameMonth($date = null, $ofSameYear = true)
    {
        return $this->isSameAs($ofSameYear ? 'Y-m' : 'm', $date);
    }

    /**
     * Checks if this day is a specific day of the week.
     *
     * @example
     * ```
     * Carbon::parse('2019-07-17')->isDayOfWeek(Carbon::WEDNESDAY); // true
     * Carbon::parse('2019-07-17')->isDayOfWeek(Carbon::FRIDAY); // false
     * Carbon::parse('2019-07-17')->isDayOfWeek('Wednesday'); // true
     * Carbon::parse('2019-07-17')->isDayOfWeek('Friday'); // false
     * ```
     *
     * @param int $dayOfWeek
     *
     * @return bool
     */
    public function isDayOfWeek($dayOfWeek)
    {
        if (is_string($dayOfWeek) && defined($constant = static::class.'::'.strtoupper($dayOfWeek))) {
            $dayOfWeek = constant($constant);
        }

        return $this->dayOfWeek === $dayOfWeek;
    }

    /**
     * Check if its the birthday. Compares the date/month values of the two dates.
     *
     * @example
     * ```
     * Carbon::now()->subYears(5)->isBirthday(); // true
     * Carbon::now()->subYears(5)->subDay()->isBirthday(); // false
     * Carbon::parse('2019-06-05')->isBirthday(Carbon::parse('2001-06-05')); // true
     * Carbon::parse('2019-06-05')->isBirthday(Carbon::parse('2001-06-06')); // false
     * ```
     *
     * @param \Carbon\Carbon|\DateTimeInterface|null $date The instance to compare with or null to use current day.
     *
     * @return bool
     */
    public function isBirthday($date = null)
    {
        return $this->isSameAs('md', $date);
    }

    /**
     * Check if today is the last day of the Month
     *
     * @example
     * ```
     * Carbon::parse('2019-02-28')->isLastOfMonth(); // true
     * Carbon::parse('2019-03-28')->isLastOfMonth(); // false
     * Carbon::parse('2019-03-30')->isLastOfMonth(); // false
     * Carbon::parse('2019-03-31')->isLastOfMonth(); // true
     * Carbon::parse('2019-04-30')->isLastOfMonth(); // true
     * ```
     *
     * @return bool
     */
    public function isLastOfMonth()
    {
        return $this->day === $this->daysInMonth;
    }

    /**
     * Check if the instance is start of day / midnight.
     *
     * @example
     * ```
     * Carbon::parse('2019-02-28 00:00:00')->isStartOfDay(); // true
     * Carbon::parse('2019-02-28 00:00:00.999999')->isStartOfDay(); // true
     * Carbon::parse('2019-02-28 00:00:01')->isStartOfDay(); // false
     * Carbon::parse('2019-02-28 00:00:00.000000')->isStartOfDay(true); // true
     * Carbon::parse('2019-02-28 00:00:00.000012')->isStartOfDay(true); // false
     * ```
     *
     * @param bool $checkMicroseconds check time at microseconds precision
     *
     * @return bool
     */
    public function isStartOfDay($checkMicroseconds = false)
    {
        /* @var CarbonInterface $this */
        return $checkMicroseconds
            ? $this->rawFormat('H:i:s.u') === '00:00:00.000000'
            : $this->rawFormat('H:i:s') === '00:00:00';
    }

    /**
     * Check if the instance is end of day.
     *
     * @example
     * ```
     * Carbon::parse('2019-02-28 23:59:59.999999')->isEndOfDay(); // true
     * Carbon::parse('2019-02-28 23:59:59.123456')->isEndOfDay(); // true
     * Carbon::parse('2019-02-28 23:59:59')->isEndOfDay(); // true
     * Carbon::parse('2019-02-28 23:59:58.999999')->isEndOfDay(); // false
     * Carbon::parse('2019-02-28 23:59:59.999999')->isEndOfDay(true); // true
     * Carbon::parse('2019-02-28 23:59:59.123456')->isEndOfDay(true); // false
     * Carbon::parse('2019-02-28 23:59:59')->isEndOfDay(true); // false
     * ```
     *
     * @param bool $checkMicroseconds check time at microseconds precision
     *
     * @return bool
     */
    public function isEndOfDay($checkMicroseconds = false)
    {
        /* @var CarbonInterface $this */
        return $checkMicroseconds
            ? $this->rawFormat('H:i:s.u') === '23:59:59.999999'
            : $this->rawFormat('H:i:s') === '23:59:59';
    }

    /**
     * Check if the instance is start of day / midnight.
     *
     * @example
     * ```
     * Carbon::parse('2019-02-28 00:00:00')->isMidnight(); // true
     * Carbon::parse('2019-02-28 00:00:00.999999')->isMidnight(); // true
     * Carbon::parse('2019-02-28 00:00:01')->isMidnight(); // false
     * ```
     *
     * @return bool
     */
    public function isMidnight()
    {
        return $this->isStartOfDay();
    }

    /**
     * Check if the instance is midday.
     *
     * @example
     * ```
     * Carbon::parse('2019-02-28 11:59:59.999999')->isMidday(); // false
     * Carbon::parse('2019-02-28 12:00:00')->isMidday(); // true
     * Carbon::parse('2019-02-28 12:00:00.999999')->isMidday(); // true
     * Carbon::parse('2019-02-28 12:00:01')->isMidday(); // false
     * ```
     *
     * @return bool
     */
    public function isMidday()
    {
        /* @var CarbonInterface $this */
        return $this->rawFormat('G:i:s') === static::$midDayAt.':00:00';
    }

    /**
     * Checks if the (date)time string is in a given format.
     *
     * @example
     * ```
     * Carbon::hasFormat('11:12:45', 'h:i:s'); // true
     * Carbon::hasFormat('13:12:45', 'h:i:s'); // false
     * ```
     *
     * @param string $date
     * @param string $format
     *
     * @return bool
     */
    public static function hasFormat($date, $format)
    {
        // createFromFormat() is known to handle edge cases silently.
        // E.g. "1975-5-1" (Y-n-j) will still be parsed correctly when "Y-m-d" is supplied as the format.
        // To ensure we're really testing against our desired format, perform an additional regex validation.

        // Preg quote, but remove escaped backslashes since we'll deal with escaped characters in the format string.
        $quotedFormat = str_replace('\\\\', '\\', preg_quote($format, '/'));

        // Build the regex string
        $regex = '';

        for ($i = 0; $i < strlen($quotedFormat); ++$i) {
            // Backslash – the next character does not represent a date token so add it on as-is and continue.
            // We're doing an extra ++$i here to increment the loop by 2.
            if ($quotedFormat[$i] === '\\') {
                $char = $quotedFormat[++$i];
                $regex .= $char === '\\' ? '\\\\' : $char;

                continue;
            }

            $regex .= strtr($quotedFormat[$i], static::$regexFormats);
        }

        $regex = preg_replace('#(?<!\\\\)((?:\\\\{2})*)/#', '$1\\/', $regex);

        return (bool) @preg_match('/^'.$regex.'$/', $date);
    }

    /**
     * Checks if the (date)time string is in a given format and valid to create a
     * new instance.
     *
     * @example
     * ```
     * Carbon::canBeCreatedFromFormat('11:12:45', 'h:i:s'); // true
     * Carbon::canBeCreatedFromFormat('13:12:45', 'h:i:s'); // false
     * ```
     *
     * @param string $date
     * @param string $format
     *
     * @return bool
     */
    public static function canBeCreatedFromFormat($date, $format)
    {
        try {
            // Try to create a DateTime object. Throws an InvalidArgumentException if the provided time string
            // doesn't match the format in any way.
            if (!static::rawCreateFromFormat($format, $date)) {
                return false;
            }
        } catch (InvalidArgumentException $e) {
            return false;
        }

        return static::hasFormat($date, $format);
    }

    /**
     * Returns true if the current date matches the given string.
     *
     * @example
     * ```
     * var_dump(Carbon::parse('2019-06-02 12:23:45')->is('2019')); // true
     * var_dump(Carbon::parse('2019-06-02 12:23:45')->is('2018')); // false
     * var_dump(Carbon::parse('2019-06-02 12:23:45')->is('2019-06')); // true
     * var_dump(Carbon::parse('2019-06-02 12:23:45')->is('06-02')); // true
     * var_dump(Carbon::parse('2019-06-02 12:23:45')->is('2019-06-02')); // true
     * var_dump(Carbon::parse('2019-06-02 12:23:45')->is('Sunday')); // true
     * var_dump(Carbon::parse('2019-06-02 12:23:45')->is('June')); // true
     * var_dump(Carbon::parse('2019-06-02 12:23:45')->is('12:23')); // true
     * var_dump(Carbon::parse('2019-06-02 12:23:45')->is('12:23:45')); // true
     * var_dump(Carbon::parse('2019-06-02 12:23:45')->is('12:23:00')); // false
     * var_dump(Carbon::parse('2019-06-02 12:23:45')->is('12h')); // true
     * var_dump(Carbon::parse('2019-06-02 15:23:45')->is('3pm')); // true
     * var_dump(Carbon::parse('2019-06-02 15:23:45')->is('3am')); // false
     * ```
     *
     * @param string $tester day name, month name, hour, date, etc. as string
     *
     * @return bool
     */
    public function is(string $tester)
    {
        $tester = trim($tester);

        if (preg_match('/^\d+$/', $tester)) {
            return $this->year === intval($tester);
        }

        if (preg_match('/^\d{3,}-\d{1,2}$/', $tester)) {
            return $this->isSameMonth(static::parse($tester));
        }

        if (preg_match('/^\d{1,2}-\d{1,2}$/', $tester)) {
            return $this->isSameDay(static::parse($this->year.'-'.$tester));
        }

        $modifier = preg_replace('/(\d)h$/i', '$1:00', $tester);

        /* @var CarbonInterface $max */
        $median = static::parse('5555-06-15 12:30:30.555555')->modify($modifier);
        $current = $this->copy();
        /* @var CarbonInterface $other */
        $other = $this->copy()->modify($modifier);

        if ($current->eq($other)) {
            return true;
        }

        if (preg_match('/\d:\d{1,2}:\d{1,2}$/', $tester)) {
            return $current->startOfSecond()->eq($other);
        }

        if (preg_match('/\d:\d{1,2}$/', $tester)) {
            return $current->startOfMinute()->eq($other);
        }

        if (preg_match('/\d(h|am|pm)$/', $tester)) {
            return $current->startOfHour()->eq($other);
        }

        if (preg_match(
            '/^(january|february|march|april|may|june|july|august|september|october|november|december)\s+\d+$/i',
            $tester
        )) {
            return $current->startOfMonth()->eq($other->startOfMonth());
        }

        $units = [
            'month' => [1, 'year'],
            'day' => [1, 'month'],
            'hour' => [0, 'day'],
            'minute' => [0, 'hour'],
            'second' => [0, 'minute'],
            'microsecond' => [0, 'second'],
        ];

        foreach ($units as $unit => [$minimum, $startUnit]) {
            if ($median->$unit === $minimum) {
                $current = $current->startOf($startUnit);

                break;
            }
        }

        return $current->eq($other);
    }
}
