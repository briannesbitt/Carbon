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

        $inverted = (bool) $interval->invert;
        $seconds = (($interval->h * UnitValue::MINUTES_PER_HOUR) + $interval->i) * UnitValue::SECONDS_PER_MINUTE + $interval->s;
        $nanoseconds = (int) ($interval->f * 1_000_000_000);

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
