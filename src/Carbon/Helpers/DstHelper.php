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

namespace Carbon\Helpers;

use Carbon\Carbon;
use Carbon\CarbonInterface;
use DateTimeZone;
use Exception;

/**
 * Helper class for handling DST (Daylight Saving Time) transitions and timezone edge cases.
 */
class DstHelper
{
    /**
     * Safely create a Carbon instance handling DST transitions.
     *
     * @param int                          $year
     * @param int                          $month
     * @param int                          $day
     * @param int                          $hour
     * @param int                          $minute
     * @param int                          $second
     * @param DateTimeZone|string|int|null $timezone
     * @param string                       $strategy 'safe', 'forward', 'backward', 'utc'
     *
     * @return CarbonInterface|null
     */
    public static function createSafeDst(
        int $year,
        int $month,
        int $day,
        int $hour,
        int $minute = 0,
        int $second = 0,
        $timezone = null,
        string $strategy = 'safe'
    ): ?CarbonInterface {
        try {
            // First try normal creation
            $date = Carbon::create($year, $month, $day, $hour, $minute, $second, $timezone);

            // Check if the created date matches what we requested
            if ($date->year === $year &&
                $date->month === $month &&
                $date->day === $day &&
                $date->hour === $hour &&
                $date->minute === $minute &&
                $date->second === $second) {
                return $date;
            }

            // If not, we hit a DST transition
            return static::handleDstTransition($year, $month, $day, $hour, $minute, $second, $timezone, $strategy);

        } catch (Exception $e) {
            return static::handleDstTransition($year, $month, $day, $hour, $minute, $second, $timezone, $strategy);
        }
    }

    /**
     * Handle DST transition based on strategy.
     */
    protected static function handleDstTransition(
        int $year,
        int $month,
        int $day,
        int $hour,
        int $minute,
        int $second,
        $timezone,
        string $strategy
    ): ?CarbonInterface {
        switch ($strategy) {
            case 'safe':
                return null; // Return null for invalid times

            case 'forward':
                // Move forward to the next valid time
                return static::findNextValidTime($year, $month, $day, $hour, $minute, $second, $timezone);

            case 'backward':
                // Move backward to the previous valid time
                return static::findPreviousValidTime($year, $month, $day, $hour, $minute, $second, $timezone);

            case 'utc':
                // Create in UTC with the same time components
                return Carbon::create($year, $month, $day, $hour, $minute, $second, 'UTC');

            default:
                return null;
        }
    }

    /**
     * Find the next valid time after a DST gap.
     */
    protected static function findNextValidTime(
        int $year,
        int $month,
        int $day,
        int $hour,
        int $minute,
        int $second,
        $timezone
    ): ?CarbonInterface {
        // Try incrementing by minutes until we find a valid time
        for ($i = 0; $i < 120; $i++) { // Max 2 hours search
            try {
                $testMinute = $minute + $i;
                $testHour = $hour;

                if ($testMinute >= 60) {
                    $testHour += (int) ($testMinute / 60);
                    $testMinute = $testMinute % 60;
                }

                if ($testHour >= 24) {
                    break; // Don't go to next day
                }

                $date = Carbon::create($year, $month, $day, $testHour, $testMinute, $second, $timezone);

                if ($date->year === $year && $date->month === $month && $date->day === $day) {
                    return $date;
                }
            } catch (Exception $e) {
                continue;
            }
        }

        return null;
    }

    /**
     * Find the previous valid time before a DST gap.
     */
    protected static function findPreviousValidTime(
        int $year,
        int $month,
        int $day,
        int $hour,
        int $minute,
        int $second,
        $timezone
    ): ?CarbonInterface {
        // For DST spring forward, go back to the last valid time before the gap
        // For 2:30 AM during spring forward, go back to 1:59:59
        try {
            // Try going back one hour first
            $testHour = $hour - 1;
            if ($testHour >= 0) {
                $date = Carbon::create($year, $month, $day, $testHour, $minute, $second, $timezone);
                if ($date->year === $year && $date->month === $month && $date->day === $day && $date->hour === $testHour) {
                    return $date;
                }
            }

            // If that doesn't work, try minute by minute backwards
            for ($i = 1; $i <= 120; $i++) { // Max 2 hours search
                $testMinute = $minute - $i;
                $testHour = $hour;

                if ($testMinute < 0) {
                    $testHour -= (int) (abs($testMinute) / 60) + 1;
                    $testMinute = 60 + ($testMinute % 60);
                }

                if ($testHour < 0) {
                    break; // Don't go to previous day
                }

                $date = Carbon::create($year, $month, $day, $testHour, $testMinute, $second, $timezone);

                if ($date->year === $year && $date->month === $month && $date->day === $day && $date->hour === $testHour) {
                    return $date;
                }
            }
        } catch (Exception $e) {
            // Continue to return null
        }

        return null;
    }

    /**
     * Check if a given time falls within a DST transition.
     */
    public static function isDstTransition(
        int $year,
        int $month,
        int $day,
        int $hour,
        int $minute = 0,
        int $second = 0,
        $timezone = null
    ): bool {
        try {
            $created = Carbon::create($year, $month, $day, $hour, $minute, $second, $timezone);

            // Check if the created date matches what we requested
            $matches = ($created->year === $year &&
                       $created->month === $month &&
                       $created->day === $day &&
                       $created->hour === $hour &&
                       $created->minute === $minute &&
                       $created->second === $second);

            return !$matches;
        } catch (Exception $e) {
            return true;
        }
    }

    /**
     * Get DST transition information for a specific date and timezone.
     */
    public static function getDstTransitions(int $year, $timezone): array
    {
        try {
            $tz = $timezone instanceof DateTimeZone ? $timezone : new DateTimeZone($timezone);
            $transitions = $tz->getTransitions(
                mktime(0, 0, 0, 1, 1, $year),
                mktime(0, 0, 0, 12, 31, $year)
            );

            return array_map(function ($transition) {
                return [
                    'time' => Carbon::createFromTimestamp($transition['ts']),
                    'offset' => $transition['offset'],
                    'isdst' => $transition['isdst'],
                    'abbr' => $transition['abbr'],
                ];
            }, $transitions);
        } catch (Exception $e) {
            return [];
        }
    }

    /**
     * Safely convert between timezones preserving the exact moment in time.
     */
    public static function safeTimezoneConversion(CarbonInterface $date, $targetTimezone): CarbonInterface
    {
        // Store the exact timestamp to preserve the moment in time
        $timestamp = $date->getTimestamp();
        $microseconds = $date->microsecond;

        // Create new instance in target timezone
        $converted = Carbon::createFromTimestamp($timestamp, $targetTimezone);
        $converted = $converted->microsecond($microseconds);

        return $converted;
    }

    /**
     * Check if two dates represent the same moment in time across different timezones.
     */
    public static function isSameMoment(CarbonInterface $date1, CarbonInterface $date2): bool
    {
        return $date1->getTimestamp() === $date2->getTimestamp() &&
               $date1->microsecond === $date2->microsecond;
    }

    /**
     * Get all timezone transitions for a date range.
     */
    public static function getTransitionsInRange(
        CarbonInterface $start,
        CarbonInterface $end,
        $timezone
    ): array {
        try {
            $tz = $timezone instanceof DateTimeZone ? $timezone : new DateTimeZone($timezone);
            $transitions = $tz->getTransitions($start->getTimestamp(), $end->getTimestamp());

            return array_map(function ($transition) {
                return [
                    'time' => Carbon::createFromTimestamp($transition['ts']),
                    'offset' => $transition['offset'],
                    'isdst' => $transition['isdst'],
                    'abbr' => $transition['abbr'],
                ];
            }, $transitions);
        } catch (Exception $e) {
            return [];
        }
    }
}
