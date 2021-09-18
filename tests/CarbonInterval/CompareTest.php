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

class CompareTest extends AbstractTestCase
{
    public function testNegative()
    {
        $first = CarbonInterval::minute();
        $second = CarbonInterval::minutes(2);
        $result = $first->compare($second);
        $this->assertSame(-1, $result);
    }

    public function testPositive()
    {
        $first = CarbonInterval::day();
        $second = CarbonInterval::hour();
        $result = $first->compare($second);
        $this->assertSame(1, $result);
    }

    public function testEqual()
    {
        $first = CarbonInterval::year();
        $second = CarbonInterval::year();
        $result = $first->compare($second);
        $this->assertSame(0, $result);
    }
}
