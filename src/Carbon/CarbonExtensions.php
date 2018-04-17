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

/**
 * Class CarbonExtensions
 */
class CarbonExtensions
{
    /**
     * Checks the date to see if it is a business day
     *
     * @author Christopher McGinnis <cmcginnis@tuition.io>
     *
     * @param Carbon                                $date
     * @param HolidaySchedule|BusinessSchedule|null $schedule
     *
     * @return bool
     */
    public static function isBusinessDay(Carbon $date, $schedule = null)
    {
        $isHoliday = $schedule instanceof HolidaySchedule
            ? $schedule->isHoliday($date)
            : false
        ;

        $isBusinessDay = $schedule instanceof BusinessSchedule
            ? $schedule->isBusinessDay($date)
            : $date->isWeekday()
        ;

        return $isBusinessDay && !$isHoliday;
    }

    /**
     * Sets the date to the next business day
     *
     * @author Christopher McGinnis <cmcginnis@tuition.io>
     *
     * @param Carbon                                $date
     * @param HolidaySchedule|BusinessSchedule|null $schedule
     *
     * @return Carbon
     */
    public static function nextBusinessDay(Carbon $date, $schedule = null)
    {
        do {
            $date->addDay();
        } while (!self::isBusinessDay($date, $schedule));

        return $date;
    }

    /**
     * Sets the date to the current or next business day
     *
     * @author Christopher McGinnis <cmcginnis@tuition.io>
     *
     * @param Carbon                                $date
     * @param HolidaySchedule|BusinessSchedule|null $schedule
     *
     * @return Carbon
     */
    public static function currentOrNextBusinessDay(Carbon $date, $schedule = null)
    {
        if (!self::isBusinessDay($date, $schedule)) {
            self::nextBusinessDay($date, $schedule);
        }

        return $date;
    }

    /**
     * Sets the date to the previous business day
     *
     * @author Christopher McGinnis <cmcginnis@tuition.io>
     *
     * @param Carbon                                $date
     * @param HolidaySchedule|BusinessSchedule|null $schedule
     *
     * @return Carbon
     */
    public static function previousBusinessDay(Carbon $date, $schedule = null)
    {
        do {
            $date->subDay();
        } while (!self::isBusinessDay($date, $schedule));

        return $date;
    }

    /**
     * Sets the date to the current or previous business day
     *
     * @author Christopher McGinnis <cmcginnis@tuition.io>
     *
     * @param Carbon                                $date
     * @param HolidaySchedule|BusinessSchedule|null $schedule
     *
     * @return Carbon
     */
    public static function currentOrPreviousBusinessDay(Carbon $date, $schedule = null)
    {
        if (!self::isBusinessDay($date, $schedule)) {
            self::previousBusinessDay($date, $schedule);
        }

        return $date;
    }

    /**
     * Sets the date to that corresponds to the number of business days after the starting date
     *
     * @author Christopher McGinnis <cmcginnis@tuition.io>
     *
     * @param Carbon                                $date
     * @param int                                   $days
     * @param HolidaySchedule|BusinessSchedule|null $schedule
     *
     * @return Carbon
     */
    public static function addBusinessDays(Carbon $date, $days, $schedule = null)
    {
        while ($days != 0) {
            if ($days > 0) {
                $date = self::nextBusinessDay($date, $schedule);
                $days--;
            } else {
                $date = self::previousBusinessDay($date, $schedule);
                $days++;
            }
        }

        return $date;
    }

    /**
     * Sets the date to that corresponds to the number of business days prior the starting date
     *
     * @author Christopher McGinnis <cmcginnis@tuition.io>
     *
     * @param Carbon                                $date
     * @param int                                   $days
     * @param HolidaySchedule|BusinessSchedule|null $schedule
     *
     * @return Carbon
     */
    public static function subBusinessDays(Carbon $date, $days, $schedule = null)
    {
        return self::addBusinessDays($date, -$days, $schedule);
    }
}
