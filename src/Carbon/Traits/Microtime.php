<?php

namespace Carbon\Traits;

/**
 * @author userator
 */
trait Microtime
{
    /**
     * Create a Carbon instance from a microtime as float, format XXXXXXXXXX.XXXX.
     *
     * @param float $microtime
     * @param \DateTimeZone|string|null $tz
     *
     * @return static
     */
    public static function createFromMicrotimeFloat(float $microtime, $tz = null)
    {
        return static::rawCreateFromFormat('U.u', number_format($microtime, 6, '.', ''))
                ->setTimezone($tz);
    }

    /**
     * Create a Carbon instance from a microtime as string, format X.XXXXXXXX XXXXXXXXXX.
     *
     * @param string $microtime
     * @param \DateTimeZone|string|null $tz
     *
     * @return static
     */
    public static function createFromMicrotimeWhitespace(string $microtime, $tz = null)
    {
        return static::rawCreateFromFormat('0.u?? U', $microtime)
                ->setTimezone($tz);
    }
}
