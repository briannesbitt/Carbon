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
    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Day of a week should be greater than or equal to 0 and less than or equal to 6.
     */
    public function testSetStartOfWeekLessThanMin()
    {
        Carbon::setWeekStartsAt(Carbon::SUNDAY - 1);
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Day of a week should be greater than or equal to 0 and less than or equal to 6.
     */
    public function testSetStartOfWeekMoreThanMax()
    {
        Carbon::setWeekStartsAt(Carbon::SATURDAY + 1);
    }

    public function testSetStartOfWeekValid()
    {
        for ($i = Carbon::SUNDAY; $i < Carbon::SATURDAY; $i++) {
            Carbon::setWeekStartsAt($i);
            $this->assertSame($i, Carbon::getWeekStartsAt());
        }
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Day of a week should be greater than or equal to 0 and less than or equal to 6.
     */
    public function testSetEndOfWeekLessThanMin()
    {
        Carbon::setWeekEndsAt(Carbon::SUNDAY - 1);
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Day of a week should be greater than or equal to 0 and less than or equal to 6.
     */
    public function testSetEndOfWeekMoreThanMax()
    {
        Carbon::setWeekEndsAt(Carbon::SATURDAY + 1);
    }

    public function testSetEndOfWeekValid()
    {
        for ($i = Carbon::SUNDAY; $i < Carbon::SATURDAY; $i++) {
            Carbon::setWeekEndsAt($i);
            $this->assertSame($i, Carbon::getWeekEndsAt());
        }
    }
}
