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
     * @group i
     * @throws \ReflectionException
     */
    public function testCreate()
    {
        $period = new \DatePeriod('R4/2012-07-01T00:00:00Z/P7D');
        var_dump($period[0], get_class_methods($period));
        exit;
        /** @var CarbonPeriod $period */
        $period = CarbonPeriod::create('R4/2012-07-01T00:00:00Z/P7D');
        foreach ($period as $key => $date) {
            echo $date."\n";
        }
        echo "\n\n";
        exit;
    }
}
