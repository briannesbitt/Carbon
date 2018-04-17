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
use Carbon\CarbonInterval;
use Carbon\CarbonPeriod;
use Tests\AbstractTestCase;

class FilterTest extends AbstractTestCase
{
    public function testFilter()
    {
        $period = CarbonPeriod::create('R4/2018-04-14T00:00:00Z/P4D');

        $period->filter(function ($date) {
            return $date->isWeekday();
        });

        $results = array();
        foreach ($period as $date) {
            $results[] = $date->format('Y-m-d H:i:s');
        }

        self::assertEquals(array(
            '2018-04-18 00:00:00',
            '2018-04-26 00:00:00',
            '2018-04-30 00:00:00',
        ), $results);
    }
}
