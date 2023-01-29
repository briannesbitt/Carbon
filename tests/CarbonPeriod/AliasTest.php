<?php

declare(strict_types=1);

/**
 * This file is part of the Carbon package.
 *
 * (c) Brian Nesbitt <brian@nesbot.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tests\CarbonPeriod;

use BadMethodCallException;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use Carbon\CarbonPeriod;
use InvalidArgumentException;
use Tests\AbstractTestCase;

class AliasTest extends AbstractTestCase
{
    public function testSetStartDate()
    {
        $periodClass = $this->periodClass;
        $period = $periodClass::start($date = '2017-09-13 12:30:45', false);
        $this->assertEquals(Carbon::parse($date), $period->getStartDate());
        $this->assertEquals(Carbon::parse($date), $period->start);
        $this->assertSame($periodClass::EXCLUDE_START_DATE, $period->getOptions());

        $period = $period->since($date = '2014-10-12 15:42:34', true);
        $this->assertEquals(Carbon::parse($date), $period->getStartDate());
        $this->assertEmpty($period->getOptions());

        $period = $period->sinceNow(false);
        $this->assertEquals(Carbon::now(), $period->getStartDate());
        $this->assertSame($periodClass::EXCLUDE_START_DATE, $period->getOptions());
    }

    public function testSetStartDateWithNamedParameters()
    {
        if (version_compare(PHP_VERSION, '8.0.0-dev', '<')) {
            $this->markTestSkipped('This tests needs PHP 8 named arguments syntax.');
        }

        $periodClass = $this->periodClass;
        $date = '2017-09-13 12:30:45';
        $period = eval('return \\'.$periodClass.'::start(date: $date, inclusive: false);');
        $this->assertEquals(Carbon::parse($date), $period->getStartDate());
        $this->assertEquals(Carbon::parse($date), $period->start);
        $this->assertSame(CarbonPeriod::EXCLUDE_START_DATE, $period->getOptions());

        $period = eval('return \\'.$periodClass.'::start(date: $date);');
        $this->assertEquals(Carbon::parse($date), $period->getStartDate());
        $this->assertEquals(Carbon::parse($date), $period->start);
        $this->assertEmpty($period->getOptions());

        $date = '2014-10-12 15:42:34';
        $period = eval('return $period->since(date: $date, inclusive: true);');
        $this->assertEquals(Carbon::parse($date), $period->getStartDate());
        $this->assertEmpty($period->getOptions());

        $period = eval('return $period->sinceNow(inclusive: false);');
        $this->assertEquals(Carbon::now(), $period->getStartDate());
        $this->assertSame($periodClass::EXCLUDE_START_DATE, $period->getOptions());

        $period = $periodClass::sinceNow();
        $this->assertEquals(Carbon::now(), $period->getStartDate());
        $this->assertEmpty($period->getOptions());
    }

    public function testSetEndDate()
    {
        $periodClass = $this->periodClass;
        $period = $periodClass::end($date = '2017-09-13 12:30:45', false);
        $this->assertEquals(Carbon::parse($date), $period->getEndDate());
        $this->assertEquals(Carbon::parse($date), $period->end);
        $this->assertSame($periodClass::EXCLUDE_END_DATE, $period->getOptions());

        $period = $period->until($date = '2014-10-12 15:42:34', true);
        $this->assertEquals(Carbon::parse($date), $period->getEndDate());
        $this->assertEmpty($period->getOptions());

        $period = $period->untilNow(false);
        $this->assertEquals(Carbon::now(), $period->getEndDate());
        $this->assertSame($periodClass::EXCLUDE_END_DATE, $period->getOptions());

        $period = $period->end();
        $this->assertNull($period->getEndDate());
    }

    public function testSetEndDateWithNamedParameters()
    {
        if (version_compare(PHP_VERSION, '8.0.0-dev', '<')) {
            $this->markTestSkipped('This tests needs PHP 8 named arguments syntax.');
        }

        $periodClass = $this->periodClass;
        $date = '2017-09-13 12:30:45';
        $period = eval('return \\'.$periodClass.'::end(date: $date, inclusive: false);');
        $this->assertEquals(Carbon::parse($date), $period->getEndDate());
        $this->assertEquals(Carbon::parse($date), $period->end);
        $this->assertSame($periodClass::EXCLUDE_END_DATE, $period->getOptions());

        $date = '2014-10-12 15:42:34';
        $period = eval('return $period->until(date: $date, inclusive: true);');
        $this->assertEquals(Carbon::parse($date), $period->getEndDate());
        $this->assertEmpty($period->getOptions());

        $period = eval('return $period->untilNow(inclusive: false);');
        $this->assertEquals(Carbon::now(), $period->getEndDate());
        $this->assertSame($periodClass::EXCLUDE_END_DATE, $period->getOptions());
    }

    public function testManageFilters()
    {
        $filter = function () {
            return true;
        };

        $periodClass = $this->periodClass;
        $period = $periodClass::filter($filter, 'foo');
        $this->assertSame([[$filter, 'foo']], $period->getFilters());

        $period = $period->push($filter, 'bar');
        $this->assertSame([[$filter, 'foo'], [$filter, 'bar']], $period->getFilters());

        $period = $period->prepend($filter, 'pre');
        $this->assertSame([[$filter, 'pre'], [$filter, 'foo'], [$filter, 'bar']], $period->getFilters());

        $period = $period->filters();
        $this->assertEmpty($period->getFilters());

        $period = $period->filters($filters = [[$filter, null]]);
        $this->assertSame($filters, $period->getFilters());
    }

    public function testSetRecurrences()
    {
        $periodClass = $this->periodClass;
        $period = $periodClass::recurrences(5);
        $this->assertSame(5, $period->getRecurrences());
        $this->assertSame(5, $period->recurrences);

        $period = $period->times(3);
        $this->assertSame(3, $period->getRecurrences());

        $period = $period->recurrences();
        $this->assertNull($period->getRecurrences());
    }

    public function testManageOptions()
    {
        $periodClass = $this->periodClass;
        $start = $periodClass::EXCLUDE_START_DATE;
        $end = $periodClass::EXCLUDE_END_DATE;

        $period = $periodClass::options($start);
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
        $periodClass = $this->periodClass;
        $period = $periodClass::dates($start = '2014-10-12 15:42:34', $end = '2017-09-13 12:30:45');
        $this->assertEquals(Carbon::parse($start), $period->getStartDate());
        $this->assertEquals(Carbon::parse($end), $period->getEndDate());

        $period = $period->dates(Carbon::now());
        $this->assertEquals(Carbon::now(), $period->getStartDate());
        $this->assertNull($period->getEndDate());
    }

    public function testManageInterval()
    {
        $periodClass = $this->periodClass;
        $period = $periodClass::interval('PT6H');
        $this->assertEquals(CarbonInterval::create('PT6H'), $period->getDateInterval());
        $this->assertEquals(CarbonInterval::create('PT6H'), $period->interval);
    }

    public function testInvertInterval()
    {
        $periodClass = $this->periodClass;
        $period = $periodClass::invert();
        $this->assertEquals(CarbonInterval::create('P1D')->invert(), $period->getDateInterval());
    }

    public function testModifyIntervalPlural()
    {
        $periodClass = $this->periodClass;
        $period = $periodClass::weeks(2);
        $this->assertSame('P14D', $period->getDateInterval()->spec());

        $period = $period->years(2)->months(3)->days(4)->hours(5)->minutes(30)->seconds(15);
        $this->assertSame('P2Y3M4DT5H30M15S', $period->getDateInterval()->spec());

        $period = $period->years(0)->months(0)->dayz(0)->hours(0)->minutes(0)->seconds(1);
        $this->assertSame('PT1S', $period->getDateInterval()->spec());
    }

    public function testModifyIntervalSingular()
    {
        $periodClass = $this->periodClass;
        $period = $periodClass::week();
        $this->assertSame('P7D', $period->getDateInterval()->spec());

        $period = $period->year()->month()->day()->hour()->minute()->second();
        $this->assertSame('P1Y1M1DT1H1M1S', $period->getDateInterval()->spec());

        $period = $period->year(2)->month(3)->day(4)->hour(5)->minute(6)->second(7);
        $this->assertSame('P2Y3M4DT5H6M7S', $period->getDateInterval()->spec());
    }

    public function testChainAliases()
    {
        $periodClass = $this->periodClass;
        Carbon::setTestNow('2018-05-15');
        $period = $periodClass::days(3)->hours(5)->invert()
            ->sinceNow()->until(Carbon::now()->subDays(10))
            ->options($periodClass::EXCLUDE_START_DATE)
            ->times(2);

        $this->assertSame(
            $this->standardizeDates([
                Carbon::now()->subDays(3)->subHours(5), Carbon::now()->subDays(6)->subHours(10),
            ]),
            $this->standardizeDates($period)
        );
    }

    public function testCallInvalidAlias()
    {
        $this->expectExceptionObject(new BadMethodCallException(
            'Method foobar does not exist.'
        ));

        $periodClass = $this->periodClass;
        $periodClass::foobar();
    }

    public function testOverrideDefaultInterval()
    {
        $periodClass = $this->periodClass;
        $period = $periodClass::hours(5);
        $this->assertSame('PT5H', $period->getDateInterval()->spec());

        $period = $periodClass::create()->hours(5);
        $this->assertSame('PT5H', $period->getDateInterval()->spec());

        $period = $periodClass::create('P1D')->hours(5);
        $this->assertSame('P1DT5H', $period->getDateInterval()->spec());
    }

    public function testModifyIntoEmptyDateInterval()
    {
        $this->expectExceptionObject(new InvalidArgumentException(
            'Empty interval is not accepted.'
        ));

        $periodClass = $this->periodClass;
        $periodClass::days(0);
    }

    public function testNamedParameters()
    {
        if (version_compare(PHP_VERSION, '8.0.0-dev', '<')) {
            $this->markTestSkipped('This tests needs PHP 8 named arguments syntax.');
        }

        $periodClass = $this->periodClass;
        $period = eval("return \\$periodClass::between(start: '2022-09-13', end: '2022-10-12');");
        $this->assertEquals('2022-09-13', $period->getStartDate()->format('Y-m-d'));
        $this->assertEquals('2022-10-12', $period->getEndDate()->format('Y-m-d'));

        $period = eval('return $period->years(years: 5);');
        $this->assertEquals('5 years', (string) $period->getDateInterval());

        $period = eval('return $period->interval(interval: \Carbon\CarbonInterval::year(years: 3));');
        $this->assertEquals('3 years', (string) $period->getDateInterval());

        $period = eval("return \\$periodClass::between(start: '2022-09-13', end: '2022-10-12')->months(months: 5);");
        $this->assertEquals('5 months', (string) $period->getDateInterval());

        $period = eval("return \\$periodClass::between(start: '2022-09-13', end: '2022-10-12')->weeks(weeks: 5);");
        $this->assertEquals('5 weeks', (string) $period->getDateInterval());

        $period = eval("return \\$periodClass::between(start: '2022-09-13', end: '2022-10-12')->days(days: 5);");
        $this->assertEquals('5 days', (string) $period->getDateInterval());

        $period = eval("return \\$periodClass::between(start: '2022-09-13', end: '2022-10-12')->hours(hours: 5);");
        $this->assertEquals('5 hours', (string) $period->getDateInterval());

        $period = eval("return \\$periodClass::between(start: '2022-09-13', end: '2022-10-12')->minutes(minutes: 5);");
        $this->assertEquals('5 minutes', (string) $period->getDateInterval());

        $period = eval("return \\$periodClass::between(start: '2022-09-13', end: '2022-10-12')->seconds(seconds: 5);");
        $this->assertEquals('5 seconds', (string) $period->getDateInterval());

        $period = eval("return \\$periodClass::between(start: '2022-09-13', end: '2022-10-12')
            ->days(days: 5)
            ->floorDays(precision: 2);");
        $this->assertEquals('4 days', (string) $period->getDateInterval());

        $period = eval("return \\$periodClass::between(start: '2022-09-13', end: '2022-10-12')
            ->days(days: 5)
            ->roundDays(precision: 7);");
        $this->assertEquals('1 week', (string) $period->getDateInterval());

        $period = eval("return \\$periodClass::between(start: '2022-09-13', end: '2022-10-12')
            ->days(days: 5)
            ->ceilDays(precision: 2);");
        $this->assertEquals('6 days', (string) $period->getDateInterval());
    }
}
