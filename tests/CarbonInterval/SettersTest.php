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

use Carbon\CarbonInterval;
use Tests\AbstractTestCase;

class SettersTest extends AbstractTestCase
{
    public function testYearsSetter()
    {
        $ci = CarbonInterval::create(4, 5, 6, 5, 8, 9, 10);
        $ci->years = 2;
        $this->assertSame(2, $ci->years);
        $ci->years(5);
        $this->assertSame(5, $ci->years);
    }

    public function testMonthsSetter()
    {
        $ci = CarbonInterval::create(4, 5, 6, 5, 8, 9, 10);
        $ci->months = 11;
        $this->assertSame(11, $ci->months);
        $ci->months(8);
        $this->assertSame(8, $ci->months);
    }

    public function testWeeksSetter()
    {
        $ci = CarbonInterval::create(4, 5, 6, 5, 8, 9, 10);
        $ci->weeks = 11;
        $this->assertSame(11, $ci->weeks);
        $this->assertSame(7 * 11, $ci->dayz);
        $ci->weeks(4);
        $this->assertSame(4, $ci->weeks);
    }

    public function testDayzSetter()
    {
        $ci = CarbonInterval::create(4, 5, 6, 5, 8, 9, 10);
        $ci->dayz = 11;
        $this->assertSame(11, $ci->dayz);
        $this->assertSame(1, $ci->weeks);
        $this->assertSame(4, $ci->dayzExcludeWeeks);
        $ci->days(1);
        $this->assertSame(1, $ci->dayz);
        $ci->day(3);
        $this->assertSame(3, $ci->dayz);
    }

    public function testHoursSetter()
    {
        $ci = CarbonInterval::create(4, 5, 6, 5, 8, 9, 10);
        $ci->hours = 12;
        $this->assertSame(12, $ci->hours);
        $ci->hours(0);
        $this->assertSame(0, $ci->hours);
    }

    public function testMinutesSetter()
    {
        $ci = CarbonInterval::create(4, 5, 6, 5, 8, 9, 10);
        $ci->minutes = 11;
        $this->assertSame(11, $ci->minutes);
        $ci->minutes(9);
        $this->assertSame(9, $ci->minutes);
    }

    public function testSecondsSetter()
    {
        $ci = CarbonInterval::create(4, 5, 6, 5, 8, 9, 10);
        $ci->seconds = 34;
        $this->assertSame(34, $ci->seconds);
        $ci->seconds(59);
        $this->assertSame(59, $ci->seconds);
        $ci->second(1);
        $this->assertSame(1, $ci->seconds);
    }

    public function testFluentSetters()
    {
        $ci = CarbonInterval::years(4)->months(2)->dayz(5)->hours(3)->minute()->seconds(59);
        $this->assertInstanceOfCarbonInterval($ci);
        $this->assertCarbonInterval($ci, 4, 2, 5, 3, 1, 59);

        $ci = CarbonInterval::years(4)->months(2)->weeks(2)->hours(3)->minute()->seconds(59);
        $this->assertInstanceOfCarbonInterval($ci);
        $this->assertCarbonInterval($ci, 4, 2, 14, 3, 1, 59);
    }

    public function testFluentSettersDaysOverwritesWeeks()
    {
        $ci = CarbonInterval::weeks(3)->days(5);
        $this->assertCarbonInterval($ci, 0, 0, 5, 0, 0, 0);
    }

    public function testFluentSettersWeeksOverwritesDays()
    {
        $ci = CarbonInterval::days(5)->weeks(3);
        $this->assertCarbonInterval($ci, 0, 0, 3 * 7, 0, 0, 0);
    }

    public function testFluentSettersWeeksAndDaysIsCumulative()
    {
        $ci = CarbonInterval::year(5)->weeksAndDays(2, 6);
        $this->assertCarbonInterval($ci, 5, 0, 20, 0, 0, 0);
        $this->assertSame(20, $ci->dayz);
        $this->assertSame(2, $ci->weeks);
        $this->assertSame(6, $ci->dayzExcludeWeeks);
    }

    public function testInvert()
    {
        $ci = new CarbonInterval;

        $this->assertSame($ci, $ci->invert());
        $this->assertSame(1, $ci->invert);

        $this->assertSame($ci, $ci->invert());
        $this->assertSame(0, $ci->invert);
    }
}
