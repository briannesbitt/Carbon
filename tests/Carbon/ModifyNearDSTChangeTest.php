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

class ModifyNearDSTChangeTest extends AbstractTestCase
{
    /**
     * Tests transition through DST change hour in non default timezone
     *
     * @param string $dateString
     * @param int    $addHours
     * @param string $expected
     * @dataProvider getTransitionTests
     */
    public function testTransitionInNonDefaultTimezone($dateString, $addHours, $expected)
    {
        date_default_timezone_set('Europe/london');
        $date = Carbon::parse($dateString, 'America/New_York');
        $date->addHours($addHours);
        $this->assertSame($expected, $date->format('c'));
    }

    /**
     * Tests transition through DST change hour in default timezone
     *
     * @param string $dateString
     * @param int    $addHours
     * @param string $expected
     * @dataProvider getTransitionTests
     */
    public function testTransitionInDefaultTimezone($dateString, $addHours, $expected)
    {
        date_default_timezone_set('America/New_York');
        $date = Carbon::parse($dateString, 'America/New_York');
        $date->addHours($addHours);
        $this->assertSame($expected, $date->format('c'));
    }

    public function getTransitionTests()
    {

        // arguments:
        // - Date string to Carbon::parse in America/New_York.
        // - Hours to add
        // - Resulting string in 'c' format
        $tests = array(
            // testForwardTransition
            // When standard time was about to reach 2010-03-14T02:00:00-05:00 clocks were turned forward 1 hour to
            // 2010-03-14T03:00:00-04:00 local daylight time instead
            array('2010-03-14T00:00:00', 24, '2010-03-15T00:00:00-04:00'),

            // testBackwardTransition
            // When local daylight time was about to reach 2010-11-07T02:00:00-04:00 clocks were turned backward 1 hour
            // to 2010-11-07T01:00:00-05:00 local standard time instead
            array('2010-11-07T00:00:00', 24, '2010-11-08T00:00:00-05:00'),
        );

        return $tests;
    }
}
