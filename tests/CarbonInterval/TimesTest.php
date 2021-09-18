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

namespace Tests\CarbonInterval;

use Carbon\CarbonInterval;
use Tests\AbstractTestCase;

class TimesTest extends AbstractTestCase
{
    public function testTimesMoreThanOne()
    {
        $ci = CarbonInterval::create(4, 3, 2, 5, 5, 10, 11)->times(2.75);
        $this->assertCarbonInterval($ci, 11, 8, 52, 14, 28, 30);
    }

    public function testTimesOne()
    {
        $ci = CarbonInterval::create(4, 3, 2, 5, 5, 10, 11)->times(1);
        $this->assertCarbonInterval($ci, 4, 3, 19, 5, 10, 11);
    }

    public function testTimesLessThanOne()
    {
        $ci = CarbonInterval::create(4, 3, 2, 5, 5, 10, 11)->times(0.333);
        $this->assertCarbonInterval($ci, 1, 1, 6, 2, 3, 4);
    }

    public function testTimesZero()
    {
        $ci = CarbonInterval::create(4, 3, 2, 5, 5, 10, 11)->times(0);
        $this->assertCarbonInterval($ci, 0, 0, 0, 0, 0, 0);
    }

    public function testTimesLessThanZero()
    {
        $ci = CarbonInterval::create(4, 3, 2, 5, 5, 10, 11)->times(-1);
        $this->assertCarbonInterval($ci, 4, 3, 19, 5, 10, 11);
        $this->assertSame(1, $ci->invert);
    }

    public function testTimesLessThanZeroWithInvertedInterval()
    {
        $ci = CarbonInterval::create(4, 3, 2, 5, 5, 10, 11);
        $ci->invert = 1;
        $ci->times(-1);
        $this->assertCarbonInterval($ci, 4, 3, 19, 5, 10, 11);
        $this->assertSame(0, $ci->invert);
    }
}
