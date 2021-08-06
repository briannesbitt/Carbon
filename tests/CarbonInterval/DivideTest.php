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

class DivideTest extends AbstractTestCase
{
    public function testDivideSimple()
    {
        $ci = CarbonInterval::hours(3)->minutes(43)->divide(0.25);
        $this->assertCarbonInterval($ci, 0, 0, 0, 14, 52, 00);
    }

    public function testDivideMoreThanOne()
    {
        $ci = CarbonInterval::create(4, 3, 2, 5, 5, 10, 11)->divide(1 / 2.75);
        $this->assertCarbonInterval($ci, 11, 10, 3, 20, 13, 0);
    }

    public function testDivideOne()
    {
        $ci = CarbonInterval::create(4, 3, 2, 5, 5, 10, 11)->divide(1);
        $this->assertCarbonInterval($ci, 4, 3, 19, 5, 10, 11);
    }

    public function testDivideLessThanOne()
    {
        $ci = CarbonInterval::create(4, 3, 2, 5, 5, 10, 11)->divide(3);
        $this->assertCarbonInterval($ci, 1, 5, 6, 9, 43, 23);
    }

    public function testDivideLessThanZero()
    {
        $ci = CarbonInterval::create(4, 3, 2, 5, 5, 10, 11)->divide(-1);
        $this->assertCarbonInterval($ci, 4, 3, 19, 5, 10, 11);
        $this->assertSame(1, $ci->invert);
    }

    public function testDivideLessThanZeroWithInvertedInterval()
    {
        $ci = CarbonInterval::create(4, 3, 2, 5, 5, 10, 11);
        $ci->invert = 1;
        $ci->divide(-1);
        $this->assertCarbonInterval($ci, 4, 3, 19, 5, 10, 11);
        $this->assertSame(0, $ci->invert);
    }
}
