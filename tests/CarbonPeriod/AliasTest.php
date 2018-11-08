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

class AliasTest extends AbstractTestCase
{
    public function testSetStartDate()
    {
        $period = CarbonPeriod::start($date = '2017-09-13 12:30:45', false);
        $this->assertEquals(Carbon::parse($date), $period->getStartDate());
        $this->assertSame(CarbonPeriod::EXCLUDE_START_DATE, $period->getOptions());

        $period->since($date = '2014-10-12 15:42:34', true);
        $this->assertEquals(Carbon::parse($date), $period->getStartDate());
        $this->assertEmpty($period->getOptions());

        $period->sinceNow(false);
        $this->assertEquals(Carbon::now(), $period->getStartDate());
        $this->assertSame(CarbonPeriod::EXCLUDE_START_DATE, $period->getOptions());
    }

    public function testSetEndDate()
    {
        $period = CarbonPeriod::end($date = '2017-09-13 12:30:45', false);
        $this->assertEquals(Carbon::parse($date), $period->getEndDate());
        $this->assertSame(CarbonPeriod::EXCLUDE_END_DATE, $period->getOptions());

        $period->until($date = '2014-10-12 15:42:34', true);
        $this->assertEquals(Carbon::parse($date), $period->getEndDate());
        $this->assertEmpty($period->getOptions());

        $period->untilNow(false);
        $this->assertEquals(Carbon::now(), $period->getEndDate());
        $this->assertSame(CarbonPeriod::EXCLUDE_END_DATE, $period->getOptions());

        $period->end();
        $this->assertNull($period->getEndDate());
    }

    public function testManageFilters()
    {
        $filter = function () {
            return true;
        };

        $period = CarbonPeriod::filter($filter, 'foo');
        $this->assertSame(array(array($filter, 'foo')), $period->getFilters());

        $period = $period->push($filter, 'bar');
        $this->assertSame(array(array($filter, 'foo'), array($filter, 'bar')), $period->getFilters());

        $period = $period->prepend($filter, 'pre');
        $this->assertSame(array(array($filter, 'pre'), array($filter, 'foo'), array($filter, 'bar')), $period->getFilters());

        $period = $period->filters();
        $this->assertEmpty($period->getFilters());

        $period = $period->filters($filters = array(array($filter, null)));
        $this->assertSame($filters, $period->getFilters());
    }

    public function testSetRecurrences()
    {
        $period = CarbonPeriod::recurrences(5);
        $this->assertSame(5, $period->getRecurrences());

        $period->times(3);
        $this->assertSame(3, $period->getRecurrences());

        $period->recurrences();
        $this->assertNull($period->getRecurrences());
    }

    public function testManageOptions()
    {
        $start = CarbonPeriod::EXCLUDE_START_DATE;
        $end = CarbonPeriod::EXCLUDE_END_DATE;

        $period = CarbonPeriod::options($start);
        $this->assertSame($start, $period->getOptions());

        $period = $period->toggle($start | $end);
        $this->assertSame($start | $end, $period->getOptions());

        $period = $period->toggle($end, false);
        $this->assertSame($start, $period->getOptions());

        $period = $period->options();
        $this->assertEmpty($period->getOptions());
    }

    public function testSetDates()
    {
        $period = CarbonPeriod::dates($start = '2014-10-12 15:42:34', $end = '2017-09-13 12:30:45');
        $this->assertEquals(Carbon::parse($start), $period->getStartDate());
        $this->assertEquals(Carbon::parse($end), $period->getEndDate());

        $period->dates(Carbon::now());
        $this->assertEquals(Carbon::now(), $period->getStartDate());
        $this->assertNull($period->getEndDate());
    }

    public function testManageInterval()
    {
        $period = CarbonPeriod::interval('PT6H');
        $this->assertEquals(CarbonInterval::create('PT6H'), $period->getDateInterval());
    }

    public function testInvertInterval()
    {
        $period = CarbonPeriod::invert();
        $this->assertEquals(CarbonInterval::create('P1D')->invert(), $period->getDateInterval());
    }

    public function testModifyIntervalPlural()
    {
        $period = CarbonPeriod::weeks(2);
        $this->assertSame('P14D', $period->getDateInterval()->spec());

        $period->years(2)->months(3)->days(4)->hours(5)->minutes(30)->seconds(15);
        $this->assertSame('P2Y3M4DT5H30M15S', $period->getDateInterval()->spec());

        $period->years(0)->months(0)->dayz(0)->hours(0)->minutes(0)->seconds(1);
        $this->assertSame('PT1S', $period->getDateInterval()->spec());
    }

    public function testModifyIntervalSingular()
    {
        $period = CarbonPeriod::week();
        $this->assertSame('P7D', $period->getDateInterval()->spec());

        $period->year()->month()->day()->hour()->minute()->second();
        $this->assertSame('P1Y1M1DT1H1M1S', $period->getDateInterval()->spec());

        $period->year(2)->month(3)->day(4)->hour(5)->minute(6)->second(7);
        $this->assertSame('P2Y3M4DT5H6M7S', $period->getDateInterval()->spec());
    }

    public function testChainAliases()
    {
        Carbon::setTestNow('2018-05-15');
        $period = CarbonPeriod::days(3)->hours(5)->invert()
            ->sinceNow()->until(Carbon::now()->subDays(10))
            ->options(CarbonPeriod::EXCLUDE_START_DATE)
            ->times(2);

        $this->assertSame(
            $this->standardizeDates(array(
                Carbon::now()->subDays(3)->subHours(5), Carbon::now()->subDays(6)->subHours(10),
            )),
            $this->standardizeDates($period)
        );
    }

    /**
     * @expectedException \BadMethodCallException
     * @expectedExceptionMessage Method foobar does not exist.
     */
    public function testCallInvalidAlias()
    {
        CarbonPeriod::foobar();
    }

    public function testOverrideDefaultInterval()
    {
        $period = CarbonPeriod::hours(5);
        $this->assertSame('PT5H', $period->getDateInterval()->spec());

        $period = CarbonPeriod::create()->hours(5);
        $this->assertSame('PT5H', $period->getDateInterval()->spec());

        $period = CarbonPeriod::create('P1D')->hours(5);
        $this->assertSame('P1DT5H', $period->getDateInterval()->spec());
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Empty interval is not accepted.
     */
    public function testModifyIntoEmptyDateInterval()
    {
        CarbonPeriod::days(0);
    }
}
