<?php

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
