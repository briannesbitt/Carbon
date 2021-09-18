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

class SharesTest extends AbstractTestCase
{
    public function testSharesMoreThanOne()
    {
        $ci = CarbonInterval::create(4, 3, 2, 5, 5, 10, 11)->shares(1 / 2.75);
        $this->assertCarbonInterval($ci, 11, 8, 52, 14, 28, 30);
    }

    public function testSharesOne()
    {
        $ci = CarbonInterval::create(4, 3, 2, 5, 5, 10, 11)->shares(1);
        $this->assertCarbonInterval($ci, 4, 3, 19, 5, 10, 11);
    }

    public function testSharesLessThanOne()
    {
        $ci = CarbonInterval::create(4, 3, 2, 5, 5, 10, 11)->shares(3);
        $this->assertCarbonInterval($ci, 1, 1, 6, 2, 3, 4);
    }

    public function testSharesLessThanZero()
    {
        $ci = CarbonInterval::create(4, 3, 2, 5, 5, 10, 11)->shares(-1);
        $this->assertCarbonInterval($ci, 4, 3, 19, 5, 10, 11);
        $this->assertSame(1, $ci->invert);
    }

    public function testSharesLessThanZeroWithInvertedInterval()
    {
        $ci = CarbonInterval::create(4, 3, 2, 5, 5, 10, 11);
        $ci->invert = 1;
        $ci->shares(-1);
        $this->assertCarbonInterval($ci, 4, 3, 19, 5, 10, 11);
        $this->assertSame(0, $ci->invert);
    }
}
