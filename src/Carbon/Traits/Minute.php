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
 * Depends on the following properties:
 *
 * @property int $hour
 * @property int $minute
 *
 * Depends on the following methods:
 *
 * @method set($name, $value = null)
 */
trait Minute
{
    /**
     * Get/set minute of day from 0 to 1439 (00:00 to 23:59th minute).
     * If set value is greater than 1439, then appropriate days will be added
     * If set value is less than zero then, no update happens.
     *
     * @param null $val*
     *
     * @return int
     */
    public function minuteOfDay($val = null): int
    {
        if(is_numeric($val) && $val >= 0) {
            $max = ((CarbonInterface::HOURS_PER_DAY * CarbonInterface::MINUTES_PER_HOUR) - 1);
            if($val > $max) {
                $days = (int) floor($val / ($max + 1));
                $this->addDays($days);
                $val = $val - (($max + 1) * $days);
            }
            $this->set('hour', (int) floor($val / CarbonInterface::MINUTES_PER_HOUR));
            $this->set('minute', $val % CarbonInterface::MINUTES_PER_HOUR);
        }

        return ($this->hour * CarbonInterface::MINUTES_PER_HOUR) + $this->minute;
    }
}
