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

class MultiplyTest extends AbstractTestCase
{
    public function testMultiplySimple()
    {
        $ci = CarbonInterval::hours(3)->minutes(43)->multiply(4);
        $this->assertCarbonInterval($ci, 0, 0, 0, 14, 52, 00);
    }

    public function testMultiplyMoreThanOne()
    {
        $ci = CarbonInterval::create(4, 3, 2, 5, 5, 10, 11)->multiply(2.75);
        $this->assertCarbonInterval($ci, 11, 10, 3, 20, 13, 0);
    }

    public function testMultiplyOne()
    {
        $ci = CarbonInterval::create(4, 3, 2, 5, 5, 10, 11)->multiply(1);
        $this->assertCarbonInterval($ci, 4, 3, 19, 5, 10, 11);
    }

    public function testMultiplyLessThanOne()
    {
        $ci = CarbonInterval::create(4, 3, 2, 5, 5, 10, 11)->multiply(0.333);
        $this->assertCarbonInterval($ci, 1, 1, 6, 8, 53, 51);
    }

    public function testMultiplyZero()
    {
        $ci = CarbonInterval::create(4, 3, 2, 5, 5, 10, 11)->multiply(0);
        $this->assertCarbonInterval($ci, 0, 0, 0, 0, 0, 0);
    }

    public function testMultiplyLessThanZero()
    {
        $ci = CarbonInterval::create(4, 3, 2, 5, 5, 10, 11)->multiply(-1);
        $this->assertCarbonInterval($ci, 4, 3, 19, 5, 10, 11);
        $this->assertSame(1, $ci->invert);
    }

    public function testMultiplyLessThanZeroWithInvertedInterval()
    {
        $ci = CarbonInterval::create(4, 3, 2, 5, 5, 10, 11);
        $ci->invert = 1;
        $ci->multiply(-1);
        $this->assertCarbonInterval($ci, 4, 3, 19, 5, 10, 11);
        $this->assertSame(0, $ci->invert);
    }
}
