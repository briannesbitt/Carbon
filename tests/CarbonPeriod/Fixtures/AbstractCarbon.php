<?php

declare(strict_types=1);

/**
 * This file is part of the Carbon package.
 *
 * (c) Brian Nesbitt <brian@nesbot.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tests\CarbonPeriod\Fixtures;

use Carbon\CarbonInterface;
use DateTime;
use ReturnTypeWillChange;

abstract class AbstractCarbon extends DateTime implements CarbonInterface
{
    public function __construct($time = null, $tz = null)
    {
        parent::__construct($time, $tz);
    }

    public static function __set_state($dump): self
    {
        return new static($dump);
    }

    #[ReturnTypeWillChange]
    public function add($unit, $value = 1, $overflow = null)
    {
        return parent::add($unit);
    }

    #[ReturnTypeWillChange]
    public function sub($unit, $value = 1, $overflow = null)
    {
        return parent::sub($unit);
    }

    #[ReturnTypeWillChange]
    public function modify($modify)
    {
        return parent::modify($modify);
    }

    #[ReturnTypeWillChange]
    public function setDate($year, $month, $day)
    {
        return parent::setDate($year, $month, $day);
    }

    #[ReturnTypeWillChange]
    public function setISODate($year, $month, $day = 1)
    {
        return parent::setISODate($year, $month, $day = 1);
    }

    #[ReturnTypeWillChange]
    public function setTime($hour, $minute, $second = 0, $microseconds = 0)
    {
        return parent::setTime($hour, $minute, $second, $microseconds);
    }

    #[ReturnTypeWillChange]
    public function setTimestamp($unixTimestamp)
    {
        return parent::setTimestamp($unixTimestamp);
    }

    #[ReturnTypeWillChange]
    public function setTimezone($value)
    {
        return parent::setTimezone($value);
    }

    #[ReturnTypeWillChange]
    public static function createFromFormat($format, $time, $tz = null)
    {
        return parent::createFromFormat($format, $time, $tz);
    }

    #[ReturnTypeWillChange]
    public static function createFromTimestamp($timestamp, $tz = null)
    {
        return parent::createFromTimestamp($timestamp, $tz);
    }
}
