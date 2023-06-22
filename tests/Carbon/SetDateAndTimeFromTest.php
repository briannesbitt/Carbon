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

namespace Tests\Carbon;

use Carbon\Carbon;
use Tests\AbstractTestCase;

class SetDateAndTimeFromTest extends AbstractTestCase
{
    public function testSetDateFrom()
    {
        $source = Carbon::now();
        $target = $source->copy()
            ->addDays(rand(1, 6))
            ->addHours(rand(1, 23))
            ->addMinutes(rand(1, 59))
            ->addSeconds(rand(1, 59));

        $this->assertCarbon(
            $target->copy()->setDateFrom($source),
            $source->year,
            $source->month,
            $source->day,
            $target->hour,
            $target->minute,
            $target->second,
        );
    }

    public function testSetTimeFrom()
    {
        $source = Carbon::now();
        $target = $source->copy()
            ->addDays(rand(1, 6))
            ->addHours(rand(1, 23))
            ->addMinutes(rand(1, 59))
            ->addSeconds(rand(1, 59));

        $this->assertCarbon(
            $target->copy()->setTimeFrom($source),
            $target->year,
            $target->month,
            $target->day,
            $source->hour,
            $source->minute,
            $source->second,
        );
    }
}
