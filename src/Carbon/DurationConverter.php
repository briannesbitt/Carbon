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

namespace Carbon;

use Carbon\Constants\UnitValue;
use Carbon\Exceptions\InvalidIntervalException;
use DateInterval;
use Time\Duration;

/** @internal */
final class DurationConverter
{
    public static function getDurationUnits(Duration $duration): array
    {
        $microseconds = intdiv($duration->nanoseconds, 1000);
        $seconds = $duration->seconds;
        $minutes = intdiv($seconds, UnitValue::SECONDS_PER_MINUTE);
        $seconds %= UnitValue::SECONDS_PER_MINUTE;
        $hours = intdiv($minutes, UnitValue::MINUTES_PER_HOUR);
        $minutes %= UnitValue::MINUTES_PER_HOUR;

        return [$hours, $minutes, $seconds, $microseconds];
    }

    public static function getDurationIsoSpec(Duration $duration): string
    {
        [$hours, $minutes, $seconds] = self::getDurationUnits($duration);

        return "PT{$hours}H{$minutes}M{$seconds}S";
    }

    public static function createDurationFromInterval(DateInterval|Duration $interval): Duration
    {
        if ($interval instanceof Duration) {
            return clone $interval;
        }

        if ($interval->y || $interval->m || $interval->days || $interval->d) {
            throw new InvalidIntervalException(
                'Date units (years, months, weeks and days) cannot be converted to '.Duration::class.
                ' because they cannot be unambiguously converted to elapsed time.'
            );
        }

        if (abs($interval->f) >= 1) {
            throw new InvalidIntervalException(
                "Interval with number of microseconds higher than 999'999 cannot be converted to ".
                Duration::class,
            );
        }

        return self::createDurationFromSeconds(
            (($interval->h * UnitValue::MINUTES_PER_HOUR) + $interval->i) * UnitValue::SECONDS_PER_MINUTE + $interval->s,
            (int) ($interval->f * 1_000_000_000),
            (bool) $interval->invert,
        );
    }

    public static function createDurationFromSeconds(int $seconds, int $nanoseconds = 0, bool $inverted = false): Duration
    {
        if ($seconds < 0) {
            $seconds = abs($seconds);
            $inverted = !$inverted;
            $nanoseconds *= -1;
        }

        if ($nanoseconds < 0) {
            $seconds--;
            $nanoseconds += 1_000_000_000;
        }

        $duration = Duration::fromSeconds($seconds, $nanoseconds);

        return $inverted ? $duration->negate() : $duration;
    }
}
