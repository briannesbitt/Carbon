<?php

/*
 * This file is part of the Carbon package.
 *
 * (c) Brian Nesbitt <brian@nesbot.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tests\Carbon\Fixtures;

use Carbon\Carbon;

/**
 * Class MyCarbon
 * @package Tests\Carbon\Fixtures
 */
class MyCarbon extends Carbon
{
    /**
     * Get a Carbon instance for the current date and microTime
     * @return static
     */
    public static function currentMicroTime()
    {
        list($micro, $timestamp) = explode(" ", microtime());
        $microTime = date('Y-m-d H:i:', $timestamp) . (date('s', $timestamp) + $micro);
        return Carbon::parse($microTime);
    }
}
