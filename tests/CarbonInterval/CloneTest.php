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

class CloneTest extends AbstractTestCase
{
    public function testClone()
    {
        $first = CarbonInterval::minute();
        $second = $first->clone();
        $result = $first->compare($second);
        $this->assertSame(0, $result);
        $this->assertNotSame($second, $first);
        $this->assertEquals($second, $first);
    }

    public function testCopy()
    {
        $first = CarbonInterval::minute();
        $second = $first->copy();
        $result = $first->compare($second);
        $this->assertSame(0, $result);
        $this->assertNotSame($second, $first);
        $this->assertEquals($second, $first);
    }
}
