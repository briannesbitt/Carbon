<?php

/*
 * This file is part of the Carbon package.
 *
 * (c) Brian Nesbitt <brian@nesbot.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Carbon\Carbon;

class IssetTest extends TestFixture
{
    public function testIssetReturnFalseForUnknownProperty()
    {
        $this->assertFalse(isset(Carbon::create(1234, 5, 6, 7, 8, 9)->sdfsdfss));
    }

    public function testIssetReturnTrueForProperties()
    {
        $properties = array(
            'year',
            'month',
            'day',
            'hour',
            'minute',
            'second',
            'micro',
            'dayOfWeek',
            'dayOfYear',
            'weekOfYear',
            'daysInMonth',
            'timestamp',
            'weekOfMonth',
            'age',
            'quarter',
            'offset',
            'offsetHours',
            'dst',
            'local',
            'utc',
            'timezone',
            'timezoneName',
            'tz',
            'tzName',
        );

        foreach ($properties as $property) {
            $this->assertTrue(isset(Carbon::create(1234, 5, 6, 7, 8, 9)->$property));
        }
    }
}
