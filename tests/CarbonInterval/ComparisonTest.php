<?php
declare(strict_types = 1);

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

class ComparisonTest extends AbstractTestCase
{
    public function testEqualToTrue()
    {
        $this->assertTrue(CarbonInterval::day()->eq(CarbonInterval::hours(24)));
    }

    public function testEqualToFalse()
    {
        $this->assertFalse(CarbonInterval::day()->eq(CarbonInterval::hours(23)));
    }
}
