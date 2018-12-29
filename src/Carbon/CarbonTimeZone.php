<?php

namespace Carbon;

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
     * Create a CarbonTimeZone from mixed input.
     *
     * @param DateTimeZone|string|int|null $object
     *
     * @return false|static
     */
    public static function instance($object = null)
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
                throw new InvalidArgumentException('Unknown or bad timezone ('.$object.')');
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
