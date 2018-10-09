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
use DateInterval;
use Tests\AbstractTestCase;

class ConstructTest extends AbstractTestCase
{
    public function testInheritedConstruct()
    {
        $ci = new CarbonInterval('PT0S');
        $this->assertSame('PT0S', $ci->spec());
        $ci = new CarbonInterval('P1Y2M3D');
        $this->assertSame('P1Y2M3D', $ci->spec());
        $ci = CarbonInterval::create('PT0S');
        $this->assertSame('PT0S', $ci->spec());
        $ci = CarbonInterval::create('P1Y2M3D');
        $this->assertSame('P1Y2M3D', $ci->spec());
    }

    public function testDefaults()
    {
        $ci = new CarbonInterval();
        $this->assertInstanceOfCarbonInterval($ci);
        $this->assertCarbonInterval($ci, 1, 0, 0, 0, 0, 0);
    }

    public function testNulls()
    {
        $ci = new CarbonInterval(null, null, null, null, null, null);
        $this->assertCarbonInterval($ci, 0, 0, 0, 0, 0, 0);
        $ci = CarbonInterval::days(null);
        $this->assertInstanceOfCarbonInterval($ci);
        $this->assertCarbonInterval($ci, 0, 0, 0, 0, 0, 0);
    }

    public function testZeroes()
    {
        $ci = new CarbonInterval(0, 0, 0, 0, 0, 0);
        $this->assertCarbonInterval($ci, 0, 0, 0, 0, 0, 0);

        $ci = CarbonInterval::days(0);
        $this->assertInstanceOfCarbonInterval($ci);
        $this->assertCarbonInterval($ci, 0, 0, 0, 0, 0, 0);
    }

    public function testZeroesChained()
    {
        $ci = CarbonInterval::days(0)->week(0)->minutes(0);
        $this->assertInstanceOfCarbonInterval($ci);
        $this->assertCarbonInterval($ci, 0, 0, 0, 0, 0, 0);
    }

    public function testYears()
    {
        $ci = new CarbonInterval(1);
        $this->assertInstanceOfCarbonInterval($ci);
        $this->assertCarbonInterval($ci, 1, 0, 0, 0, 0, 0);

        $ci = CarbonInterval::years(2);
        $this->assertInstanceOfCarbonInterval($ci);
        $this->assertCarbonInterval($ci, 2, 0, 0, 0, 0, 0);

        $ci = CarbonInterval::year();
        $this->assertInstanceOfCarbonInterval($ci);
        $this->assertCarbonInterval($ci, 1, 0, 0, 0, 0, 0);

        $ci = CarbonInterval::year(3);
        $this->assertInstanceOfCarbonInterval($ci);
        $this->assertCarbonInterval($ci, 3, 0, 0, 0, 0, 0);
    }

    public function testMonths()
    {
        $ci = new CarbonInterval(0, 1);
        $this->assertInstanceOfCarbonInterval($ci);
        $this->assertCarbonInterval($ci, 0, 1, 0, 0, 0, 0);

        $ci = CarbonInterval::months(2);
        $this->assertInstanceOfCarbonInterval($ci);
        $this->assertCarbonInterval($ci, 0, 2, 0, 0, 0, 0);

        $ci = CarbonInterval::month();
        $this->assertInstanceOfCarbonInterval($ci);
        $this->assertCarbonInterval($ci, 0, 1, 0, 0, 0, 0);

        $ci = CarbonInterval::month(3);
        $this->assertInstanceOfCarbonInterval($ci);
        $this->assertCarbonInterval($ci, 0, 3, 0, 0, 0, 0);
    }

    public function testWeeks()
    {
        $ci = new CarbonInterval(0, 0, 1);
        $this->assertInstanceOfCarbonInterval($ci);
        $this->assertCarbonInterval($ci, 0, 0, 7, 0, 0, 0);

        $ci = CarbonInterval::weeks(2);
        $this->assertInstanceOfCarbonInterval($ci);
        $this->assertCarbonInterval($ci, 0, 0, 14, 0, 0, 0);

        $ci = CarbonInterval::week();
        $this->assertInstanceOfCarbonInterval($ci);
        $this->assertCarbonInterval($ci, 0, 0, 7, 0, 0, 0);

        $ci = CarbonInterval::week(3);
        $this->assertInstanceOfCarbonInterval($ci);
        $this->assertCarbonInterval($ci, 0, 0, 21, 0, 0, 0);
    }

    public function testDays()
    {
        $ci = new CarbonInterval(0, 0, 0, 1);
        $this->assertInstanceOfCarbonInterval($ci);
        $this->assertCarbonInterval($ci, 0, 0, 1, 0, 0, 0);

        $ci = CarbonInterval::days(2);
        $this->assertInstanceOfCarbonInterval($ci);
        $this->assertCarbonInterval($ci, 0, 0, 2, 0, 0, 0);

        $ci = CarbonInterval::dayz(2);
        $this->assertInstanceOfCarbonInterval($ci);
        $this->assertCarbonInterval($ci, 0, 0, 2, 0, 0, 0);

        $ci = CarbonInterval::day();
        $this->assertInstanceOfCarbonInterval($ci);
        $this->assertCarbonInterval($ci, 0, 0, 1, 0, 0, 0);

        $ci = CarbonInterval::day(3);
        $this->assertInstanceOfCarbonInterval($ci);
        $this->assertCarbonInterval($ci, 0, 0, 3, 0, 0, 0);
    }

    public function testHours()
    {
        $ci = new CarbonInterval(0, 0, 0, 0, 1);
        $this->assertInstanceOfCarbonInterval($ci);
        $this->assertCarbonInterval($ci, 0, 0, 0, 1, 0, 0);

        $ci = CarbonInterval::hours(2);
        $this->assertInstanceOfCarbonInterval($ci);
        $this->assertCarbonInterval($ci, 0, 0, 0, 2, 0, 0);

        $ci = CarbonInterval::hour();
        $this->assertInstanceOfCarbonInterval($ci);
        $this->assertCarbonInterval($ci, 0, 0, 0, 1, 0, 0);

        $ci = CarbonInterval::hour(3);
        $this->assertInstanceOfCarbonInterval($ci);
        $this->assertCarbonInterval($ci, 0, 0, 0, 3, 0, 0);
    }

    public function testMinutes()
    {
        $ci = new CarbonInterval(0, 0, 0, 0, 0, 1);
        $this->assertInstanceOfCarbonInterval($ci);
        $this->assertCarbonInterval($ci, 0, 0, 0, 0, 1, 0);

        $ci = CarbonInterval::minutes(2);
        $this->assertInstanceOfCarbonInterval($ci);
        $this->assertCarbonInterval($ci, 0, 0, 0, 0, 2, 0);

        $ci = CarbonInterval::minute();
        $this->assertInstanceOfCarbonInterval($ci);
        $this->assertCarbonInterval($ci, 0, 0, 0, 0, 1, 0);

        $ci = CarbonInterval::minute(3);
        $this->assertInstanceOfCarbonInterval($ci);
        $this->assertCarbonInterval($ci, 0, 0, 0, 0, 3, 0);
    }

    public function testSeconds()
    {
        $ci = new CarbonInterval(0, 0, 0, 0, 0, 0, 1);
        $this->assertInstanceOfCarbonInterval($ci);
        $this->assertCarbonInterval($ci, 0, 0, 0, 0, 0, 1);

        $ci = CarbonInterval::seconds(2);
        $this->assertInstanceOfCarbonInterval($ci);
        $this->assertCarbonInterval($ci, 0, 0, 0, 0, 0, 2);

        $ci = CarbonInterval::second();
        $this->assertInstanceOfCarbonInterval($ci);
        $this->assertCarbonInterval($ci, 0, 0, 0, 0, 0, 1);

        $ci = CarbonInterval::second(3);
        $this->assertInstanceOfCarbonInterval($ci);
        $this->assertCarbonInterval($ci, 0, 0, 0, 0, 0, 3);
    }

    public function testYearsAndHours()
    {
        $ci = new CarbonInterval(5, 0, 0, 0, 3, 0, 0);
        $this->assertInstanceOfCarbonInterval($ci);
        $this->assertCarbonInterval($ci, 5, 0, 0, 3, 0, 0);
    }

    public function testAll()
    {
        $ci = new CarbonInterval(5, 6, 2, 5, 9, 10, 11);
        $this->assertInstanceOfCarbonInterval($ci);
        $this->assertCarbonInterval($ci, 5, 6, 19, 9, 10, 11);
    }

    public function testAllWithCreate()
    {
        $ci = CarbonInterval::create(5, 6, 2, 5, 9, 10, 11);
        $this->assertInstanceOfCarbonInterval($ci);
        $this->assertCarbonInterval($ci, 5, 6, 19, 9, 10, 11);
    }

    public function testInstance()
    {
        $ci = CarbonInterval::instance(new DateInterval('P2Y1M5DT22H33M44S'));
        $this->assertInstanceOfCarbonInterval($ci);
        $this->assertCarbonInterval($ci, 2, 1, 5, 22, 33, 44);
        $this->assertTrue($ci->days === false || $ci->days === CarbonInterval::PHP_DAYS_FALSE);
    }

    public function testInstanceWithNegativeDateInterval()
    {
        $di = new DateInterval('P2Y1M5DT22H33M44S');
        $di->invert = 1;
        $ci = CarbonInterval::instance($di);
        $this->assertInstanceOfCarbonInterval($ci);
        $this->assertCarbonInterval($ci, 2, 1, 5, 22, 33, 44);
        $this->assertTrue($ci->days === false || $ci->days === CarbonInterval::PHP_DAYS_FALSE);
        $this->assertSame(1, $ci->invert);
    }

    public function testInstanceWithDays()
    {
        $ci = CarbonInterval::instance(Carbon::now()->diff(Carbon::now()->addWeeks(3)));
        $this->assertCarbonInterval($ci, 0, 0, 21, 0, 0, 0);
    }

    public function testCopy()
    {
        $one = CarbonInterval::days(10);
        $two = $one->hours(6)->copy()->hours(3);
        $this->assertCarbonInterval($one, 0, 0, 10, 6, 0, 0);
        $this->assertCarbonInterval($two, 0, 0, 10, 3, 0, 0);
    }

    public function testMake()
    {
        $this->assertCarbonInterval(CarbonInterval::make('3 hours 30 m'), 0, 0, 0, 3, 30, 0);
        $this->assertCarbonInterval(CarbonInterval::make('PT5H'), 0, 0, 0, 5, 0, 0);
        $this->assertCarbonInterval(CarbonInterval::make(new DateInterval('P1D')), 0, 0, 1, 0, 0, 0);
        $this->assertCarbonInterval(CarbonInterval::make(new CarbonInterval('P2M')), 0, 2, 0, 0, 0, 0);
        $this->assertNull(CarbonInterval::make(3));
    }

    public function testCallInvalidStaticMethod()
    {
        $this->assertNull(CarbonInterval::anything());
    }

    public function testNegativeHour()
    {
        $before = new Carbon('2018-10-08 14:53:00', 'UTC');
        $after = new Carbon('2018-11-15 14:00:00', 'UTC');

        $this->assertCarbonInterval($after->diffAsCarbonInterval($before, false), 0, 1, 6, 23, 7, 0);

        $before = new Carbon('2018-10-08 14:53:00', 'Europe/Prague');
        $after = new Carbon('2018-11-15 14:00:00', 'Europe/Prague');

        $this->assertSame(23, (24 + $after->diffAsCarbonInterval($before, false)->h) % 24);
    }
}
