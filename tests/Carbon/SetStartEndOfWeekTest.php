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

class SetStartEndOfWeekTest extends AbstractTestCase
{
    public function testSetStartOfWeekLessThanMin()
    {
        Carbon::setWeekStartsAt(Carbon::SUNDAY - 1);

        $this->assertSame(Carbon::SATURDAY, Carbon::getWeekStartsAt());
    }

    public function testSetStartOfWeekMoreThanMax()
    {
        Carbon::setWeekStartsAt(Carbon::SATURDAY + 1);

        $this->assertSame(Carbon::SUNDAY, Carbon::getWeekStartsAt());
    }

    public function testSetStartOfWeekValid()
    {
        for ($i = Carbon::SUNDAY; $i < Carbon::SATURDAY; $i++) {
            Carbon::setWeekStartsAt($i);
            $this->assertSame($i, Carbon::getWeekStartsAt());
        }
    }

    public function testSetEndOfWeekLessThanMin()
    {
        Carbon::setWeekEndsAt(Carbon::SUNDAY - 1);

        $this->assertSame(Carbon::SATURDAY, Carbon::getWeekEndsAt());
    }

    public function testSetEndOfWeekMoreThanMax()
    {
        Carbon::setWeekEndsAt(Carbon::SATURDAY + 1);

        $this->assertSame(Carbon::SUNDAY, Carbon::getWeekEndsAt());
    }

    public function testSetEndOfWeekValid()
    {
        for ($i = Carbon::SUNDAY; $i < Carbon::SATURDAY; $i++) {
            Carbon::setWeekEndsAt($i);
            $this->assertSame($i, Carbon::getWeekEndsAt());
        }
    }
}
