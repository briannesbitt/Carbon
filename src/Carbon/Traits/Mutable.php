<?php

namespace Carbon\Traits;

use DateTimeImmutable;

trait Mutable
{
    /**
     * Create a Carbon instance from a DateTimeImmutable object.
     *
     * @param DateTimeImmutable $dateTime
     *
     * @return static
     */
    public static function createFromImmutable($dateTime)
    {
        return static::instance($dateTime);
    }
}
