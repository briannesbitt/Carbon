<?php

namespace Carbon\Traits;

use DateTime;

trait Immutable
{
    /**
     * Create a Carbon instance from a DateTime object.
     *
     * @param DateTime $dateTime
     *
     * @return static
     */
    public static function createFromMutable(DateTime $dateTime)
    {
        return static::instance($dateTime);
    }
}
