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

use Carbon\CarbonPeriod;

class CarbonPeriodFactory
{
    /**
     * @template T of CarbonPeriod
     *
     * @param class-string<T> $periodClass
     *
     * @return T
     */
    public static function withStartIntervalEnd(string $periodClass)
    {
        return $periodClass::create(
            '2012-07-01 17:30:00',
            'P3DT5H',
            '2012-07-15 11:15:00',
        );
    }

    /**
     * @template T of CarbonPeriod
     *
     * @param class-string<T> $periodClass
     *
     * @return T
     */
    public static function withEvenDaysFilter(string $periodClass)
    {
        $period = $periodClass::create(
            '2012-07-01',
            'P3D',
            '2012-07-22',
            $periodClass::EXCLUDE_END_DATE,
        );

        return $period->addFilter(function ($date) {
            return $date->day % 2 == 0;
        });
    }

    /**
     * @template T of CarbonPeriod
     *
     * @param class-string<T> $periodClass
     *
     * @return T
     */
    public static function withCounter(string $periodClass, &$counter)
    {
        $counter = 0;

        $period = $periodClass::create(
            '2012-10-01',
            3,
        );

        return $period->addFilter(function () use (&$counter) {
            $counter++;

            return true;
        });
    }

    /**
     * @template T of CarbonPeriod
     *
     * @param class-string<T> $periodClass
     *
     * @return T
     */
    public static function withStackFilter(string $periodClass)
    {
        $period = $periodClass::create(
            '2001-01-01',
        );

        $stack = [
            true, false, true, $periodClass::END_ITERATION,
            false, false, true, true, $periodClass::END_ITERATION,
        ];

        return $period->addFilter(function () use (&$stack) {
            return array_shift($stack);
        });
    }
}
