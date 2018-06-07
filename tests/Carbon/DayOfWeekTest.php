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

class DayOfWeekTest extends AbstractTestCase
{
    public function testDayOfWeekReturnsString()
    {
        $d = Carbon::createFromDate(2018, 6, 3)->dayOfWeek(); //Sunday
        $this->assertSame($d, 'Sunday');
        $d = Carbon::createFromDate(2018, 6, 4)->dayOfWeek(); //Monday
        $this->assertSame($d, 'Monday');
        $d = Carbon::createFromDate(2018, 6, 5)->dayOfWeek(); //Tuesday
        $this->assertSame($d, 'Tuesday');
        $d = Carbon::createFromDate(2018, 6, 6)->dayOfWeek(); //Wednesday
        $this->assertSame($d, 'Wednesday');
        $d = Carbon::createFromDate(2018, 6, 7)->dayOfWeek(); //Thursday
        $this->assertSame($d, 'Thursday');
        $d = Carbon::createFromDate(2018, 6, 8)->dayOfWeek(); //Friday
        $this->assertSame($d, 'Friday');
        $d = Carbon::createFromDate(2018, 6, 9)->dayOfWeek(); //Saturday
        $this->assertSame($d, 'Saturday');
    }
}
