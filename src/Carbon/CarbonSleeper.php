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

use InvalidArgumentException;

/**
 * A shim between system sleep and Carbon
 */
class CarbonSleeper
{
    /**
     * Delay execution
     *
     * When Carbon's testing time is set, it will fake sleeping
     *
     * Like PHP's sleep function, this will accept zero without error. Unlike
     * PHP's sleep function, negative sleep will throw an exception.
     *
     * @param int $seconds Halt time in seconds
     *
     * @throws InvalidArgumentException
     *
     * @return int
     */
    public static function sleep($seconds)
    {
        if (Carbon::hasTestNow()) {
            $seconds = (int) $seconds;

            if ($seconds < 0) {
                throw new InvalidArgumentException(
                    'sleep(): Number of seconds must be greater than or equal to 0'
                );
            }

            Carbon::setTestNow(Carbon::getTestNow()->modify("+{$seconds} seconds"));

            return 0;
        }

        return sleep($seconds);
    }
}
