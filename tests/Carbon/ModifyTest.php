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

class ModifyTest extends AbstractTestCase
{
    public function testSimpleModify()
    {
        $a = new Carbon('2014-03-30 00:00:00');
        $b = $a->copy();
        $b->addHours(24);
        $this->assertSame(24, $a->diffInHours($b));
    }

    public function testTimezoneModify()
    {
        $a = new Carbon('2014-03-30 00:00:00', 'Europe/London');
        $b = $a->copy();
        $b->addHours(24);
        $this->assertSame(24, $a->diffInHours($b));
    }

    /**
     * Tests that daylight saving hours counts in the right way to different modify arguments
     *
     * @param string $dateString date string wich should be modified
     * @param string $timezone   timezone string in wich $dateString is
     * @param string $modify     modify argument
     * @param string $expected   date, that shoud be maked after modifying $dateString in the format: 'Y-m-d H:i:s P'
     *
     * @dataProvider getDealWithDayLightTests
     */
    public function testDealWithDayLight($dateString, $timezone, $modify, $expected)
    {
        $date = new Carbon($dateString, $timezone);
        $date->modify($modify);
        $this->assertSame($expected, $date->format('Y-m-d H:i:s P'));
        $this->assertInstanceOfCarbon($date);
    }

    /**
     * Provider for testDealWithDayLight
     *
     * DayLight saving hours should be counted only if date is modifying by hours or smaller units.
     */
    public function getDealWithDayLightTests()
    {
        return array(
            array('2014-03-30 00:00:00', 'UTC'          , '+86400 sec'   , '2014-03-31 00:00:00 +00:00'),
            array('2014-03-30 00:00:00', 'Europe/London', '+86400 sec'   , '2014-03-31 01:00:00 +01:00'),
            array('2014-03-30 00:00:00', 'UTC'          , '+1400 minutes', '2014-03-30 23:20:00 +00:00'),
            array('2014-03-30 00:00:00', 'Europe/London', '+1400 minutes', '2014-03-31 00:20:00 +01:00'),
            array('2014-03-30 00:00:00', 'UTC'          , '+24 hours'    , '2014-03-31 00:00:00 +00:00'),
            array('2014-03-30 00:00:00', 'Europe/London', '+24 hours'    , '2014-03-31 01:00:00 +01:00'),
            array('2014-03-30 00:00:00', 'UTC'          , '+1 day'       , '2014-03-31 00:00:00 +00:00'),
            array('2014-03-30 00:00:00', 'Europe/London', '+1 day'       , '2014-03-31 00:00:00 +01:00'),
            array('2014-03-31 10:00:00', 'UTC'          , 'midnight'     , '2014-03-31 00:00:00 +00:00'),
            array('2014-03-31 10:00:00', 'Europe/London', 'midnight'     , '2014-03-31 00:00:00 +01:00'),
            // should work with any symbols case
            array('2014-03-30 00:00:00', 'Europe/London', '+86400 Secs'  , '2014-03-31 01:00:00 +01:00'),
        );
    }
}
