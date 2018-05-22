<?php

/*
 * This file is part of the Carbon package.
 *
 * (c) Brian Nesbitt <brian@nesbot.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tests\CarbonPeriod\Fixtures;

use Carbon\CarbonPeriod;

class CarbonPeriodFactory
{
    /**
     * @return CarbonPeriod
     */
    public static function withStartIntervalEnd()
    {
        $period = CarbonPeriod::create(
            '2012-07-01 17:30:00', 'P3DT5H', '2012-07-15 11:15:00'
        );

        return $period;
    }

    /**
     * @return CarbonPeriod
     */
    public static function withEvenDaysFilter()
    {
        $period = CarbonPeriod::create(
            '2012-07-01', 'P3D', '2012-07-22', CarbonPeriod::EXCLUDE_END_DATE
        );

        $period->addFilter(function ($date) {
            return $date->day % 2 == 0;
        });

        return $period;
    }

    /**
     * @return CarbonPeriod
     */
    public static function withCounter(&$counter)
    {
        $counter = 0;

        $period = CarbonPeriod::create(
            '2012-10-01', 3
        );

        $period->addFilter(function () use (&$counter) {
            $counter++;

            return true;
        });

        return $period;
    }

    /**
     * @return CarbonPeriod
     */
    public static function withStackFilter()
    {
        $period = CarbonPeriod::create(
            '2001-01-01'
        );

        $stack = array(
            true, false, true, CarbonPeriod::END_ITERATION,
            false, false, true, true, CarbonPeriod::END_ITERATION,
        );

        $period->addFilter(function () use (&$stack) {
            return array_shift($stack);
        });

        return $period;
    }
}
