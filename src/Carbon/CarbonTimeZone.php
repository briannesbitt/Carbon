<?php

namespace Carbon;

use DateTimeZone;
use InvalidArgumentException;

class CarbonTimeZone extends DateTimeZone
{
    public function __construct($timezone = null)
    {
        if (is_null($timezone)) {
            $timezone = date_default_timezone_get();
        } elseif (is_int($timezone)) {
            $timezone = timezone_name_from_abbr(null, floatval($timezone) * 3600, true);
        }

        parent::__construct($timezone);
    }

    protected static function getDateTimeZoneFromName(&$name)
    {
        if (is_numeric($name)) {
            $tzName = timezone_name_from_abbr(null, floatval($name) * 3600, true);

            if ($tzName === false) {
                return false;
            }

            $name = $tzName;
        }

        return @timezone_open($name = (string) $name);
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
