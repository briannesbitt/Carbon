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

use DateTime;

/**
 * Trait Timestamp.
 */
trait Timestamp
{
    /**
     * Create a Carbon instance from a timestamp.
     *
     * @param int                       $timestamp
     * @param \DateTimeZone|string|null $tz
     *
     * @return static
     */
    public static function createFromTimestamp($timestamp, $tz = null)
    {
        $date = new DateTime('@'.((int) $timestamp));
        $tz = static::safeCreateDateTimeZone($tz);

        if ($tz) {
            $date->setTimezone($tz);
        }

        return (new static($date->format(DateTime::ATOM)))->tz($tz);
    }

    /**
     * Create a Carbon instance from a timestamp in milliseconds.
     *
     * @param float                     $timestamp
     * @param \DateTimeZone|string|null $tz
     *
     * @return static
     */
    public static function createFromTimestampMs($timestamp, $tz = null)
    {
        return static::rawCreateFromFormat('U.u', sprintf('%F', $timestamp / 1000))
            ->setTimezone($tz);
    }

    /**
     * Create a Carbon instance from an UTC timestamp.
     *
     * @param int $timestamp
     *
     * @return static
     */
    public static function createFromTimestampUTC($timestamp)
    {
        return new static('@'.$timestamp);
    }

    /**
     * Set the instance's timestamp.
     *
     * @param int $value
     *
     * @return static
     */
    public function timestamp($value)
    {
        return $this->setTimestamp((int) $value);
    }

    /**
     * Returns a timestamp rounded with the given precision (6 by default).
     *
     * @example getPreciseTimestamp()   1532087464437474 (microsecond maximum precision)
     * @example getPreciseTimestamp(6)  1532087464437474
     * @example getPreciseTimestamp(5)  153208746443747  (1/100000 second precision)
     * @example getPreciseTimestamp(4)  15320874644375   (1/10000 second precision)
     * @example getPreciseTimestamp(3)  1532087464437    (millisecond precision)
     * @example getPreciseTimestamp(2)  153208746444     (1/100 second precision)
     * @example getPreciseTimestamp(1)  15320874644      (1/10 second precision)
     * @example getPreciseTimestamp(0)  1532087464       (second precision)
     * @example getPreciseTimestamp(-1) 153208746        (10 second precision)
     * @example getPreciseTimestamp(-2) 15320875         (100 second precision)
     *
     * @param int $precision
     *
     * @return float
     */
    public function getPreciseTimestamp($precision = 6)
    {
        return round($this->rawFormat('Uu') / pow(10, 6 - $precision));
    }

    /**
     * Returns the milliseconds timestamps used amongst other by Date javascript objects.
     *
     * @return float
     */
    public function valueOf()
    {
        return $this->getPreciseTimestamp(3);
    }

    /**
     * @alias getTimestamp
     *
     * Returns the UNIX timestamp for the current date.
     *
     * @return int
     */
    public function unix()
    {
        return $this->getTimestamp();
    }
}
