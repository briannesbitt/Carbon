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

use DateTimeInterface;
use DateTimeZone;
use InvalidArgumentException;

class CarbonTimeZone extends DateTimeZone
{
    public function __construct($timezone = null)
    {
        parent::__construct(static::getDateTimeZoneNameFromMixed($timezone));
    }

    protected static function getDateTimeZoneNameFromMixed($timezone)
    {
        if (is_null($timezone)) {
            $timezone = date_default_timezone_get();
        } elseif (is_numeric($timezone)) {
            if ($timezone <= -100 || $timezone >= 100) {
                throw new InvalidArgumentException('Absolute timezone offset cannot be greater than 100.');
            }

            $timezone = ($timezone >= 0 ? '+' : '').$timezone.':00';
        }

        return $timezone;
    }

    protected static function getDateTimeZoneFromName(&$name)
    {
        return @timezone_open($name = (string) static::getDateTimeZoneNameFromMixed($name));
    }

    /**
     * Cast the current instance into the given class.
     *
     * @param string $className The $className::instance() method will be called to cast the current object.
     *
     * @return DateTimeZone
     */
    public function cast(string $className)
    {
        if (!method_exists($className, 'instance')) {
            if (is_a($className, DateTimeZone::class, true)) {
                return new $className($this->getName());
            }

            throw new InvalidArgumentException("$className has not the instance() method needed to cast the date.");
        }

        return $className::instance($this);
    }

    /**
     * Create a CarbonTimeZone from mixed input.
     *
     * @param DateTimeZone|string|int|null $object     original value to get CarbonTimeZone from it.
     * @param DateTimeZone|string|int|null $objectDump dump of the object for error messages.
     *
     * @return false|static
     */
    public static function instance($object = null, $objectDump = null)
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

        if ($tz === false) {
            if (Carbon::isStrictModeEnabled()) {
                throw new InvalidArgumentException('Unknown or bad timezone ('.($objectDump ?: $object).')');
            }

            return false;
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
    public function getAbbreviatedName($dst = false)
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
    public function getAbbr($dst = false)
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
    public function toOffsetName(DateTimeInterface $date = null)
    {
        $minutes = floor($this->getOffset($date ?: Carbon::now($this)) / 60);

        $hours = floor($minutes / 60);

        $minutes = str_pad((string) (abs($minutes) % 60), 2, '0', STR_PAD_LEFT);

        return ($hours < 0 ? '-' : '+').str_pad((string) abs($hours), 2, '0', STR_PAD_LEFT).":$minutes";
    }

    /**
     * Returns a new CarbonTimeZone object using the offset string instead of region string.
     *
     * @param DateTimeInterface|null $date
     *
     * @return CarbonTimeZone
     */
    public function toOffsetTimeZone(DateTimeInterface $date = null)
    {
        return new static($this->toOffsetName($date));
    }

    /**
     * Returns the first region string (such as "America/Toronto") that matches the current timezone.
     *
     * @see timezone_name_from_abbr native PHP function.
     *
     * @param DateTimeInterface|null $date
     * @param int                    $isDst
     *
     * @return string
     */
    public function toRegionName(DateTimeInterface $date = null, $isDst = 1)
    {
        $name = $this->getName();
        $firstChar = substr($name, 0, 1);

        if ($firstChar !== '+' && $firstChar !== '-') {
            return $name;
        }

        // Integer construction no longer supported since PHP 8
        // @codeCoverageIgnoreStart
        try {
            $offset = @$this->getOffset($date ?: Carbon::now($this)) ?: 0;
        } catch (\Throwable $e) {
            $offset = 0;
        }
        // @codeCoverageIgnoreEnd

        return @timezone_name_from_abbr('', $offset, $isDst);
    }

    /**
     * Returns a new CarbonTimeZone object using the region string instead of offset string.
     *
     * @param DateTimeInterface|null $date
     *
     * @return CarbonTimeZone|false
     */
    public function toRegionTimeZone(DateTimeInterface $date = null)
    {
        $tz = $this->toRegionName($date);

        if ($tz === false) {
            if (Carbon::isStrictModeEnabled()) {
                throw new InvalidArgumentException('Unknown timezone for offset '.$this->getOffset($date ?: Carbon::now($this)).' seconds.');
            }

            return false;
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
}
