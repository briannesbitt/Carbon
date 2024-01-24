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
use Carbon\CarbonInterval;
use DateTime;
use ReturnTypeWillChange;

abstract class AbstractCarbon extends DateTime implements CarbonInterface
{
    public function __construct($time = null, $timezone = null)
    {
        parent::__construct($time, $timezone);
    }

    public static function __set_state($dump): static
    {
        return new static($dump);
    }

    #[ReturnTypeWillChange]
    public function add($unit, $value = 1, ?bool $overflow = null): static
    {
        return parent::add($unit);
    }

    #[ReturnTypeWillChange]
    public function sub($unit, $value = 1, ?bool $overflow = null): static
    {
        return parent::sub($unit);
    }

    #[ReturnTypeWillChange]
    public function diff($date = null, $absolute = false): CarbonInterval
    {
        return CarbonInterval::instance(parent::diff($date, $absolute));
    }

    #[ReturnTypeWillChange]
    public function modify($modify)
    {
        return parent::modify($modify);
    }

    public function setDate(int $year, int $month, int $day): static
    {
        return parent::setDate($year, $month, $day);
    }

    public function setISODate(int $year, int $week, int $day = 1): static
    {
        return parent::setISODate($year, $week, $day);
    }

    public function setTime($hour, $minute, $second = 0, $microsecond = 0): static
    {
        return parent::setTime($hour, $minute, $second, $microsecond);
    }

    public function setTimestamp(int|string|float $timestamp): static
    {
        return parent::setTimestamp($timestamp);
    }

    public function setTimezone(\DateTimeZone|string|int $timeZone): static
    {
        return parent::setTimezone($timeZone);
    }

    public static function createFromFormat($format, $time, $tz = null): static
    {
        return parent::createFromFormat($format, $time, $tz);
    }
}
