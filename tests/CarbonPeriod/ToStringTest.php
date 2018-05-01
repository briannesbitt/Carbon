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

class ToStringTest extends AbstractTestCase
{
    /**
     * @throws \ReflectionException
     */
    public function testToString()
    {
        $this->assertSame(
            '4 times 1 week from 2012-07-01 00:00:00',
            CarbonPeriod::create('R4/2012-07-01T00:00:00/P7D')->toString()
        );

        $this->assertSame(
            'Every 1 day from 2015-09-30 00:00:00 to 2015-10-03 00:00:00',
            CarbonPeriod::create(Carbon::parse('2015-09-30'), Carbon::parse('2015-10-03'))->toString()
        );

        $this->assertSame(
            'Every 3 days 5 hours from 2015-09-30 12:50:00 to 2015-10-03 19:00:00',
            CarbonPeriod::create(Carbon::parse('2015-09-30 12:50'), CarbonInterval::days(3)->hours(5), Carbon::parse('2015-10-03 19:00'))->toString()
        );
    }

    public function testToIso8601String()
    {
        $this->assertSame(
            'R4/2012-07-01T00:00:00-04:00/P7D',
            CarbonPeriod::create('R4/2012-07-01T00:00:00/P7D')->toIso8601String()
        );

        $this->assertSame(
            '2015-09-30T00:00:00-04:00/P1D/2015-10-03T00:00:00-04:00',
            CarbonPeriod::create(Carbon::parse('2015-09-30'), Carbon::parse('2015-10-03'))->toIso8601String()
        );

        $this->assertSame(
            '2015-09-30T00:00:00-04:00/P3DT5H/2015-10-03T00:00:00-04:00',
            CarbonPeriod::create(Carbon::parse('2015-09-30'), CarbonInterval::days(3)->hours(5), Carbon::parse('2015-10-03'))->toIso8601String()
        );
    }
}
