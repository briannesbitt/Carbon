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

/**
 * Trait Week.
 *
 * week and ISO week number, year and count in year.
 *
 * Depends on the following properties:
 *
 * @property int $daysInYear
 * @property int $dayOfWeek
 * @property int $dayOfYear
 * @property int $year
 *
 * Depends on the following methods:
 *
 * @method CarbonInterface|static addWeeks(int $weeks = 1)
 * @method CarbonInterface|static copy()
 * @method CarbonInterface|static dayOfYear(int $dayOfYear)
 * @method string                 getTranslationMessage(string $key)
 * @method CarbonInterface|static next(int $day)
 * @method CarbonInterface|static startOfWeek(int $day = 1)
 * @method CarbonInterface|static subWeeks(int $weeks = 1)
 * @method CarbonInterface|static year(int $year = null)
 */
trait Week
{
    /**
     * Set/get the week number of year using given first day of week and first
     * day of year included in the first week. Or use ISO format if no settings
     * given.
     *
     * @param int|null $year      if null, act as a getter, if not null, set the year and return current instance.
     * @param int|null $dayOfWeek first date of week from 0 (Sunday) to 6 (Saturday)
     * @param int|null $dayOfYear first day of year included in the week #1
     *
     * @return int|static
     */
    public function isoWeekYear($year = null, $dayOfWeek = null, $dayOfYear = null)
    {
        return $this->weekYear(
            $year,
            $dayOfWeek ?? 1,
            $dayOfYear ?? 4
        );
    }

    /**
     * Set/get the week number of year using given first day of week and first
     * day of year included in the first week. Or use US format if no settings
     * given (Sunday / Jan 6).
     *
     * @param int|null $year      if null, act as a getter, if not null, set the year and return current instance.
     * @param int|null $dayOfWeek first date of week from 0 (Sunday) to 6 (Saturday)
     * @param int|null $dayOfYear first day of year included in the week #1
     *
     * @return int|static|CarbonInterface
     */
    public function weekYear($year = null, $dayOfWeek = null, $dayOfYear = null)
    {
        $dayOfWeek = $dayOfWeek ?? $this->getTranslationMessage('first_day_of_week') ?? 0;
        $dayOfYear = $dayOfYear ?? $this->getTranslationMessage('day_of_first_week_of_year') ?? 1;

        if ($year !== null) {
            $year = (int) round($year);

            if ($this->weekYear(null, $dayOfWeek, $dayOfYear) === $year) {
                return $this->copy();
            }

            $week = $this->week(null, $dayOfWeek, $dayOfYear);
            $day = $this->dayOfWeek;
            $date = $this->year($year);
            switch ($date->weekYear(null, $dayOfWeek, $dayOfYear) - $year) {
                case 1:
                    $date = $date->subWeeks(26);
                    break;
                case -1:
                    $date = $date->addWeeks(26);
                    break;
            }

            $date = $date->addWeeks($week - $date->week(null, $dayOfWeek, $dayOfYear))->startOfWeek($dayOfWeek);

            if ($date->dayOfWeek === $day) {
                return $date;
            }

            return $date->next($day);
        }

        $year = $this->year;
        $day = $this->dayOfYear;
        $date = $this->copy()->dayOfYear($dayOfYear)->startOfWeek($dayOfWeek);

        if ($date->year === $year && $day < $date->dayOfYear) {
            return $year - 1;
        }

        $date = $this->copy()->addYear()->dayOfYear($dayOfYear)->startOfWeek($dayOfWeek);

        if ($date->year === $year && $day >= $date->dayOfYear) {
            return $year + 1;
        }

        return $year;
    }

    /**
     * Get the number of weeks of the current week-year using given first day of week and first
     * day of year included in the first week. Or use ISO format if no settings
     * given.
     *
     * @param int|null $dayOfWeek first date of week from 0 (Sunday) to 6 (Saturday)
     * @param int|null $dayOfYear first day of year included in the week #1
     *
     * @return int
     */
    public function isoWeeksInYear($dayOfWeek = null, $dayOfYear = null)
    {
        return $this->weeksInYear(
            $dayOfWeek ?? 1,
            $dayOfYear ?? 4
        );
    }

    /**
     * Get the number of weeks of the current week-year using given first day of week and first
     * day of year included in the first week. Or use US format if no settings
     * given (Sunday / Jan 6).
     *
     * @param int|null $dayOfWeek first date of week from 0 (Sunday) to 6 (Saturday)
     * @param int|null $dayOfYear first day of year included in the week #1
     *
     * @return int
     */
    public function weeksInYear($dayOfWeek = null, $dayOfYear = null)
    {
        $dayOfWeek = $dayOfWeek ?? $this->getTranslationMessage('first_day_of_week') ?? 0;
        $dayOfYear = $dayOfYear ?? $this->getTranslationMessage('day_of_first_week_of_year') ?? 1;
        $year = $this->year;
        $start = $this->copy()->dayOfYear($dayOfYear)->startOfWeek($dayOfWeek);
        $startDay = $start->dayOfYear;
        if ($start->year !== $year) {
            $startDay -= $start->daysInYear;
        }
        $end = $this->copy()->addYear()->dayOfYear($dayOfYear)->startOfWeek($dayOfWeek);
        $endDay = $end->dayOfYear;
        if ($end->year !== $year) {
            $endDay += $this->daysInYear;
        }

        return (int) round(($endDay - $startDay) / 7);
    }

    /**
     * Get/set the week number using given first day of week and first
     * day of year included in the first week. Or use US format if no settings
     * given (Sunday / Jan 6).
     *
     * @param int|null $week
     * @param int|null $dayOfWeek
     * @param int|null $dayOfYear
     *
     * @return int|static
     */
    public function week($week = null, $dayOfWeek = null, $dayOfYear = null)
    {
        $date = $this;
        $dayOfWeek = $dayOfWeek ?? $this->getTranslationMessage('first_day_of_week') ?? 0;
        $dayOfYear = $dayOfYear ?? $this->getTranslationMessage('day_of_first_week_of_year') ?? 1;

        if ($week !== null) {
            return $date->addWeeks(round($week) - $this->week(null, $dayOfWeek, $dayOfYear));
        }

        $start = $date->copy()->dayOfYear($dayOfYear)->startOfWeek($dayOfWeek);
        $end = $date->copy()->startOfWeek($dayOfWeek);
        if ($start > $end) {
            $start = $start->subWeeks(26)->dayOfYear($dayOfYear)->startOfWeek($dayOfWeek);
        }
        $week = (int) ($start->diffInDays($end) / 7 + 1);

        return $week > $end->weeksInYear($dayOfWeek, $dayOfYear) ? 1 : $week;
    }

    /**
     * Get/set the week number using given first day of week and first
     * day of year included in the first week. Or use ISO format if no settings
     * given.
     *
     * @param int|null $week
     * @param int|null $dayOfWeek
     * @param int|null $dayOfYear
     *
     * @return int|static
     */
    public function isoWeek($week = null, $dayOfWeek = null, $dayOfYear = null)
    {
        return $this->week(
            $week,
            $dayOfWeek ?? 1,
            $dayOfYear ?? 4
        );
    }
}
