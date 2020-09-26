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

/**
 * Trait Timestamp.
 */
trait Timestamp
{
    /**
     * Create a Carbon instance from a timestamp and set the timezone (use default one if not specified).
     *
     * Timestamp input can be given as int, float or a string containing one or more numbers.
     *
     * @param float|int|string          $timestamp
     * @param \DateTimeZone|string|null $tz
     *
     * @return static
     */
    public static function createFromTimestamp($timestamp, $tz = null)
    {
        return static::createFromTimestampUTC($timestamp)->setTimezone($tz);
    }

    /**
     * Create a Carbon instance from an timestamp keeping the timezone to UTC.
     *
     * Timestamp input can be given as int, float or a string containing one or more numbers.
     *
     * @param float|int|string $timestamp
     *
     * @return static
     */
    public static function createFromTimestampUTC($timestamp)
    {
        return static::rawCreateFromFormat('U.u', self::formatNumber($timestamp));
    }

    /**
     * Create a Carbon instance from a timestamp in milliseconds.
     *
     * Timestamp input can be given as int, float or a string containing one or more numbers.
     *
     * @param float|int|string          $timestamp
     * @param \DateTimeZone|string|null $tz
     *
     * @return static
     */
    public static function createFromTimestampMsUTC($timestamp)
    {
        [$milliseconds, $microseconds] = self::getNumberIntegerAndDecimalParts($timestamp, 3);
        $seconds = substr($milliseconds, 0, -3);
        $microseconds = substr($milliseconds, -3).$microseconds;

        return static::rawCreateFromFormat('U.u', "$seconds.$microseconds");
    }

    /**
     * Create a Carbon instance from a timestamp in milliseconds.
     *
     * Timestamp input can be given as int, float or a string containing one or more numbers.
     *
     * @param float|int|string          $timestamp
     * @param \DateTimeZone|string|null $tz
     *
     * @return static
     */
    public static function createFromTimestampMs($timestamp, $tz = null)
    {
        return static::createFromTimestampMsUTC($timestamp)
            ->setTimezone($tz);
    }

    /**
     * Set the instance's timestamp.
     *
     * Timestamp input can be given as int, float or a string containing one or more numbers.
     *
     * @param float|int|string $unixTimestamp
     *
     * @return static
     */
    public function timestamp($unixTimestamp)
    {
        [$timestamp, $microseconds] = self::getNumberIntegerAndDecimalParts($unixTimestamp);

        return $this->setTimestamp((int) $timestamp)->setMicroseconds((int) $microseconds);
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

    /**
     * Return an array with integer part digits and decimals digits split from one or more numbers
     * (such as timestamps) as float, int or string with the given number of decimals (6 by default).
     *
     * By splitting integer and decimal, this method obtain a better precision than
     * number_format when the input is a string.
     *
     * @param float|int|string $numbers  one or more numbers
     * @param int              $decimals number of decimals precision (6 by default)
     *
     * @return array 0-index is integer part, 1-index is decimal part digits
     */
    private static function getNumberIntegerAndDecimalParts($numbers, $decimals = 6)
    {
        if (is_float($numbers) || is_int($numbers)) {
            return explode('.', number_format($numbers, $decimals, '.', ''));
        }

        return self::getIntegerAndDecimalPartsFromString($numbers, $decimals);
    }

    /**
     * Return an array with integer part digits and decimals digits split from one or more numbers
     * (such as timestamps) as string with the given number of decimals (6 by default).
     *
     * By splitting integer and decimal, this method obtain a better precision than
     * number_format when the input is a string.
     *
     * @param string $numbers  one or more numbers
     * @param int    $decimals number of decimals precision (6 by default)
     *
     * @return array 0-index is integer part, 1-index is decimal part digits
     */
    private static function getIntegerAndDecimalPartsFromString($numbers, $decimals = 6)
    {
        $integer = 0;
        $decimal = 0;

        foreach (preg_split('`[^0-9.]+`', $numbers) as $chunk) {
            [$integerPart, $decimalPart] = explode('.', "$chunk.");

            $integer += intval($integerPart);
            $decimal += floatval("0.$decimalPart");
        }

        $overflow = floor($decimal);
        $integer += $overflow;
        $decimal -= $overflow;

        return [$integer, round($decimal * pow(10, $decimals))];
    }

    /**
     * Return a string representation of one or more numbers (such as timestamps)
     * with the given number of decimals (6 by default).
     *
     * By splitting integer and decimal, this method obtain a better precision than
     * number_format when the input is a string.
     *
     * @param float|int|string $numbers  one or more numbers
     * @param int              $decimals number of decimals precision (6 by default)
     *
     * @return string
     */
    private static function formatNumber($numbers, $decimals = 6)
    {
        if (is_float($numbers) || is_int($numbers)) {
            return number_format($numbers, $decimals, '.', '');
        }

        [$integer, $decimal] = self::getIntegerAndDecimalPartsFromString($numbers, $decimals);

        return "$integer.".str_pad($decimal, $decimals, '0', STR_PAD_LEFT);
    }
}
