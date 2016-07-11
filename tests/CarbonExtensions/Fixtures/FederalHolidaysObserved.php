<?php

/*
 * This file is part of the Carbon package.
 *
 * (c) Brian Nesbitt <brian@nesbot.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tests\CarbonExtensions\Fixtures;

use Carbon\Carbon;

class FederalHolidaysObserved extends FederalHolidays
{
    /**
     * @return Carbon
     */
    protected function getNewYearsDay()
    {
        return $this->observedOn(parent::getNewYearsDay());
    }

    /**
     * @return Carbon
     */
    protected function getIndependenceDay()
    {
        return $this->observedOn(parent::getIndependenceDay());
    }

    /**
     * @return Carbon
     */
    protected function getVeteransDay()
    {
        return $this->observedOn(parent::getVeteransDay());
    }

    /**
     * @return Carbon
     */
    protected function getChristmasDay()
    {
        return $this->observedOn(parent::getChristmasDay());
    }

    /**
     * @param Carbon $date
     *
     * @return Carbon
     */
    protected function observedOn(Carbon $date)
    {
        if ($date->isWeekend()) {
            $date->next(Carbon::MONDAY);
        }

        return $date;
    }
}
