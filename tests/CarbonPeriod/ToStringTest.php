<?php

/*
 * This file is part of the Carbon package.
 *
 * (c) Brian Nesbitt <brian@nesbot.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tests\CarbonPeriod;

use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Tests\AbstractTestCase;

class ToStringTest extends AbstractTestCase
{
    /**
     * @throws \ReflectionException
     */
    public function testToString()
    {
        $period = CarbonPeriod::create(Carbon::parse('2015-09-30'), Carbon::parse('2015-10-03'));
        self::assertSame('2015-09-30 00:00:00 → 2015-10-03 00:00:00', strval($period));
    }
}
