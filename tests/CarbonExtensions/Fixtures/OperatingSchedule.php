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
use Carbon\BusinessSchedule;

class OperatingSchedule extends FederalHolidaysObserved implements BusinessSchedule
{
    public function __construct($year)
    {
        parent::__construct($year, self::ALL_HOLIDAYS ^ self::MEMORIAL_DAY);
    }

    public function isBusinessDay(Carbon $date)
    {
        $operatingDays = array(Carbon::FRIDAY, Carbon::SATURDAY, Carbon::SUNDAY, Carbon::MONDAY);

        return in_array($date->dayOfWeek, $operatingDays);
    }
}
