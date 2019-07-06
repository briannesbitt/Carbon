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

use Carbon\CarbonPeriod;
use Tests\AbstractTestCase;

class CloneTest extends AbstractTestCase
{
    public function testClone()
    {
        $period = CarbonPeriod::create('R4/2012-07-01T00:00:00/P7D');
        $clone = $period->clone();

        $this->assertSame(strval($period), strval($clone));
        $this->assertNotSame($period, $clone);
        $this->assertEquals($period, $clone);
    }

    public function testCopy()
    {
        $period = CarbonPeriod::create('R4/2012-07-01T00:00:00/P7D');
        $clone = $period->copy();

        $this->assertSame(strval($period), strval($clone));
        $this->assertNotSame($period, $clone);
        $this->assertEquals($period, $clone);
    }
}
