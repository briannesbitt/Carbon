<?php

/*
 * This file is part of the Carbon package.
 *
 * (c) Brian Nesbitt <brian@nesbot.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tests\Carbon;

use Carbon\Carbon;
use Tests\AbstractTestCase;

class IssetTest extends AbstractTestCase
{
    public function testIssetReturnFalseForUnknownProperty()
    {
        $this->assertFalse(isset(Carbon::create(1234, 5, 6, 7, 8, 9)->sdfsdfss));
    }

    public function providerTestIssetReturnTrueForProperties()
    {
        return array(
            array('age'),
            array('day'),
            array('dayOfWeek'),
            array('dayOfYear'),
            array('daysInMonth'),
            array('dst'),
            array('hour'),
            array('local'),
            array('micro'),
            array('minute'),
            array('month'),
            array('offset'),
            array('offsetHours'),
            array('quarter'),
            array('second'),
            array('timestamp'),
            array('timezone'),
            array('timezoneName'),
            array('tz'),
            array('tzName'),
            array('utc'),
            array('weekOfMonth'),
            array('weekOfYear'),
            array('year'),
        );
    }

    /**
     * @dataProvider \Tests\Carbon\IssetTest::providerTestIssetReturnTrueForProperties
     *
     * @param string $property
     */
    public function testIssetReturnTrueForProperties($property)
    {
        $this->assertTrue(isset(Carbon::now()->$property));
    }
}
