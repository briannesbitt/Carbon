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

namespace Tests\CarbonPeriod;

use Tests\AbstractTestCase;

class CloneTest extends AbstractTestCase
{
    public function testClone()
    {
        $periodClass = static::$periodClass;
        $period = $periodClass::create('R4/2012-07-01T00:00:00/P7D');
        $clone = $period->clone();

        $this->assertSame((string) $period, (string) $clone);
        $this->assertNotSame($period, $clone);
        $this->assertEquals($period, $clone);
    }

    public function testCopy()
    {
        $periodClass = static::$periodClass;
        $period = $periodClass::create('R4/2012-07-01T00:00:00/P7D');
        $clone = $period->copy();

        $this->assertSame((string) $period, (string) $clone);
        $this->assertNotSame($period, $clone);
        $this->assertEquals($period, $clone);
    }
}
