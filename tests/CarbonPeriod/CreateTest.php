<?php

/*
 * This file is part of the Carbon package.
 *
 * (c) Brian Nesbitt <brian@nesbot.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tests\CarbonInterval;

use Carbon\Carbon;
use Carbon\CarbonInterval;
use Carbon\CarbonPeriod;
use Tests\AbstractTestCase;

class CreateTest extends AbstractTestCase
{
    /**
     * @throws \ReflectionException
     */
    public function testCreate()
    {
        /** @var CarbonPeriod $period */
        $period = CarbonPeriod::create('R4/2012-07-01T00:00:00Z/P7D');
        $results = array();
        foreach ($period as $date) {
            self::assertInstanceOf('Carbon\Carbon', $date);
            $results[] = $date->format('Y-m-d H:i:s');
        }
        self::assertSame(array(
            '2012-07-01 00:00:00',
            '2012-07-08 00:00:00',
            '2012-07-15 00:00:00',
            '2012-07-22 00:00:00',
            '2012-07-29 00:00:00',
        ), $results);
    }
}
