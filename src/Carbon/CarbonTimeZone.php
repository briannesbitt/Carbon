<?php

/**
 * This file is part of the Carbon package.
 *
 * (c) Brian Nesbitt <brian@nesbot.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Carbon;

use Carbon\Exceptions\InvalidCastException;
use Carbon\Exceptions\InvalidTimeZoneException;
use DateTimeInterface;
use DateTimeZone;

class CarbonTimeZone extends DateTimeZone
{
    public const MAXIMUM_TIMEZONE_OFFSET = 99;

    public function __construct($timezone = null)
    {
        parent::__construct(static::getDateTimeZoneNameFromMixed($timezone));
    }

    protected static function parseNumericTimezone($timezone): string
    {
        if (abs($timezone) > static::MAXIMUM_TIMEZONE_OFFSET) {
            throw new InvalidTimeZoneException(
                'Absolute timezone offset cannot be greater than '.
                static::MAXIMUM_TIMEZONE_OFFSET.'.',
            );
        }

        return ($timezone >= 0 ? '+' : '').$timezone.':00';
    }

    protected static function getDateTimeZoneNameFromMixed($timezone): string
    {
        if (\is_null($timezone)) {
            return date_default_timezone_get();
        }

        if (\is_string($timezone)) {
            $timezone = preg_replace('/^\s*([+-]\d+)(\d{2})\s*$/', '$1:$2', $timezone);
        }

        if (is_numeric($timezone)) {
            return static::parseNumericTimezone($timezone);
        }

        return $timezone;
    }

    protected static function getDateTimeZoneFromName(&$name): ?DateTimeZone
    {
        return @timezone_open($name = static::getDateTimeZoneNameFromMixed($name)) ?: null;
    }

    /**
     * Cast the current instance into the given class.
     *
     * @param string $className The $className::instance() method will be called to cast the current object.
     *
     * @return DateTimeZone|mixed
     */
    public function cast(string $className)
    {
        if (!method_exists($className, 'instance')) {
            if (is_a($className, DateTimeZone::class, true)) {
                return new $className($this->getName());
            }

            throw new InvalidCastException("$className has not the instance() method needed to cast the date.");
        }

        return $className::instance($this);
    }

    /**
     * Create a CarbonTimeZone from mixed input.
     *
     * @param DateTimeZone|string|int|null $object     original value to get CarbonTimeZone from it.
     * @param DateTimeZone|string|int|null $objectDump dump of the object for error messages.
     *
     * @throws InvalidTimeZoneException
     *
     * @return static|null
     */
    public static function instance($object = null, $objectDump = null): ?self
    {
        $tz = $object;

        if ($tz instanceof static) {
            return $tz;
        }

        if ($tz === null) {
            return new static();
        }

        if (!$tz instanceof DateTimeZone) {
            $tz = static::getDateTimeZoneFromName($object);
        }

        if ($tz === null) {
            if (Carbon::isStrictModeEnabled()) {
                throw new InvalidTimeZoneException('Unknown or bad timezone ('.($objectDump ?: $object).')');
            }

            return null;
        }

        return new static($tz->getName());
    }

    /**
     * Returns abbreviated name of the current timezone according to DST setting.
     *
     * @param bool $dst
     *
     * @return string
     */
    public function getAbbreviatedName(bool $dst = false): string
    {
        $name = $this->getName();

        foreach ($this->listAbbreviations() as $abbreviation => $zones) {
            foreach ($zones as $zone) {
                if ($zone['timezone_id'] === $name && $zone['dst'] == $dst) {
                    return $abbreviation;
                }
            }
        }

        return 'unknown';
    }

    /**
     * @alias getAbbreviatedName
     *
     * Returns abbreviated name of the current timezone according to DST setting.
     *
     * @param bool $dst
     *
     * @return string
     */
    public function getAbbr(bool $dst = false): string
    {
        return $this->getAbbreviatedName($dst);
    }

    /**
     * Get the offset as string "sHH:MM" (such as "+00:00" or "-12:30").
     *
     * @param DateTimeInterface|null $date
     *
     * @return string
     */
    public function toOffsetName(DateTimeInterface $date = null): string
    {
        return static::getOffsetNameFromMinuteOffset(
            $this->getOffset($date ?: Carbon::now($this)) / 60,
        );
    }

    /**
     * Returns a new CarbonTimeZone object using the offset string instead of region string.
     *
     * @param DateTimeInterface|null $date
     *
     * @return CarbonTimeZone
     */
    public function toOffsetTimeZone(DateTimeInterface $date = null): self
    {
        return new static($this->toOffsetName($date));
    }

    /**
     * Returns the first region string (such as "America/Toronto") that matches the current timezone or
     * false if no match is found.
     *
     * @see timezone_name_from_abbr native PHP function.
     *
     * @param DateTimeInterface|null $date
     * @param int                    $isDST
     *
     * @return string|null
     */
    public function toRegionName(?DateTimeInterface $date = null, int $isDST = 1): ?string
    {
        $name = $this->getName();
        $firstChar = substr($name, 0, 1);

        if ($firstChar !== '+' && $firstChar !== '-') {
            return $name;
        }

        $date = $date ?: Carbon::now($this);

        // Integer construction no longer supported since PHP 8
        // @codeCoverageIgnoreStart
        try {
            $offset = @$this->getOffset($date) ?: 0;
        } catch (\Throwable $e) {
            $offset = 0;
        }
        // @codeCoverageIgnoreEnd

        $name = @timezone_name_from_abbr('', $offset, $isDST);

        if ($name) {
            return $name;
        }

        foreach (timezone_identifiers_list() as $timezone) {
            if (Carbon::instance($date)->tz($timezone)->getOffset() === $offset) {
                return $timezone;
            }
        }

        return null;
    }

    /**
     * Returns a new CarbonTimeZone object using the region string instead of offset string.
     *
     * @param DateTimeInterface|null $date
     *
     * @return static|null
     */
    public function toRegionTimeZone(DateTimeInterface $date = null): ?self
    {
        $tz = $this->toRegionName($date);

        if ($tz === null) {
            if (Carbon::isStrictModeEnabled()) {
                throw new InvalidTimeZoneException('Unknown timezone for offset '.$this->getOffset($date ?: Carbon::now($this)).' seconds.');
            }

            return null;
        }

        return new static($tz);
    }

    /**
     * Cast to string (get timezone name).
     *
     * @return string
     */
    public function __toString()
    {
        return $this->getName();
    }

    /**
     * Create a CarbonTimeZone from mixed input.
     *
     * @param DateTimeZone|string|int|null $object
     *
     * @return false|static
     */
    public static function create($object = null)
    {
        return static::instance($object);
    }

    /**
     * Create a CarbonTimeZone from int/float hour offset.
     *
     * @param float $hourOffset number of hour of the timezone shift (can be decimal).
     *
     * @return false|static
     */
    public static function createFromHourOffset(float $hourOffset)
    {
        return static::createFromMinuteOffset($hourOffset * Carbon::MINUTES_PER_HOUR);
    }

    /**
     * Create a CarbonTimeZone from int/float minute offset.
     *
     * @param float $minuteOffset number of total minutes of the timezone shift.
     *
     * @return false|static
     */
    public static function createFromMinuteOffset(float $minuteOffset)
    {
        return static::instance(static::getOffsetNameFromMinuteOffset($minuteOffset));
    }

    /**
     * Convert a total minutes offset into a standardized timezone offset string.
     *
     * @param float $minutes number of total minutes of the timezone shift.
     *
     * @return string
     */
    public static function getOffsetNameFromMinuteOffset(float $minutes): string
    {
        $minutes = round($minutes);
        $unsignedMinutes = abs($minutes);

        return ($minutes < 0 ? '-' : '+').
            str_pad((string) floor($unsignedMinutes / 60), 2, '0', STR_PAD_LEFT).
            ':'.
            str_pad((string) ($unsignedMinutes % 60), 2, '0', STR_PAD_LEFT);
    }
}
