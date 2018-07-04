<?php

/*
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
        $this->expectException(\InvalidArgumentException::class);
        Carbon::setWeekStartsAt(Carbon::SUNDAY-1);
    }

    public function testSetStartOfWeekMoreThanMax()
    {
        $this->expectException(\InvalidArgumentException::class);
        Carbon::setWeekStartsAt(Carbon::SATURDAY+1);
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
        $this->expectException(\InvalidArgumentException::class);
        Carbon::setWeekEndsAt(Carbon::SUNDAY-1);
    }

    public function testSetEndOfWeekMoreThanMax()
    {
        $this->expectException(\InvalidArgumentException::class);
        Carbon::setWeekEndsAt(Carbon::SATURDAY+1);
    }

    public function testSetEndOfWeekValid()
    {
        for ($i = Carbon::SUNDAY; $i < Carbon::SATURDAY; $i++) {
            Carbon::setWeekEndsAt($i);
            $this->assertSame($i, Carbon::getWeekEndsAt());
        }
    }
}
