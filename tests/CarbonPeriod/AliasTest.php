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
        $periodClass = static::$periodClass;
        $period = $periodClass::start($date = '2017-09-13 12:30:45', false);
        $this->assertEquals(Carbon::parse($date), $period->getStartDate());
        $this->assertEquals(Carbon::parse($date), $period->start());

        if (PHP_VERSION < 8.2) {
            $this->assertEquals(Carbon::parse($date), $period->start);
        }

        $this->assertPeriodOptions($periodClass::EXCLUDE_START_DATE, $period);

        $period = $period->since($date = '2014-10-12 15:42:34', true);
        $this->assertEquals(Carbon::parse($date), $period->getStartDate());
        $this->assertPeriodOptions(0, $period);

        $period = $period->sinceNow(false);
        $this->assertEquals(Carbon::now(), $period->getStartDate());
        $this->assertPeriodOptions($periodClass::EXCLUDE_START_DATE, $period);
    }

    public function testSetStartDateWithNamedParameters()
    {
        $periodClass = static::$periodClass;
        $date = '2017-09-13 12:30:45';
        /** @var CarbonPeriod $period */
        $period = $periodClass::start(date: $date, inclusive: false);
        $this->assertEquals(Carbon::parse($date), $period->getStartDate());
        $this->assertEquals(Carbon::parse($date), $period->start());

        if (PHP_VERSION < 8.2) {
            $this->assertEquals(Carbon::parse($date), $period->start);
        }

        $this->assertPeriodOptions(CarbonPeriod::EXCLUDE_START_DATE, $period);

        /** @var CarbonPeriod $period */
        $period = $periodClass::start(date: $date);
        $this->assertEquals(Carbon::parse($date), $period->getStartDate());
        $this->assertEquals(Carbon::parse($date), $period->start());

        if (PHP_VERSION < 8.2) {
            $this->assertEquals(Carbon::parse($date), $period->start);
        }

        $this->assertPeriodOptions(0, $period);

        $date = '2014-10-12 15:42:34';
        $period = $period->since(date: $date, inclusive: true);
        $this->assertEquals(Carbon::parse($date), $period->getStartDate());
        $this->assertPeriodOptions(0, $period);

        $period = $period->sinceNow(inclusive: false);
        $this->assertEquals(Carbon::now(), $period->getStartDate());
        $this->assertPeriodOptions($periodClass::EXCLUDE_START_DATE, $period);

        $period = $periodClass::sinceNow();
        $this->assertEquals(Carbon::now(), $period->getStartDate());
        $this->assertPeriodOptions(0, $period);
    }

    public function testSetEndDate()
    {
        $periodClass = static::$periodClass;
        $period = $periodClass::end($date = '2017-09-13 12:30:45', false);
        $this->assertEquals(Carbon::parse($date), $period->getEndDate());
        $this->assertEquals(Carbon::parse($date), $period->end());

        if (PHP_VERSION < 8.2) {
            $this->assertEquals(Carbon::parse($date), $period->end);
        }

        $this->assertPeriodOptions(CarbonPeriod::EXCLUDE_END_DATE, $period);

        $period = $period->until($date = '2014-10-12 15:42:34', true);
        $this->assertEquals(Carbon::parse($date), $period->getEndDate());
        $this->assertPeriodOptions(0, $period);

        $period = $period->untilNow(false);
        $this->assertEquals(Carbon::now(), $period->getEndDate());
        $this->assertPeriodOptions($periodClass::EXCLUDE_END_DATE, $period);

        $period = $period->end(null);
        $this->assertNull($period->getEndDate());
    }

    public function testSetEndDateWithNamedParameters()
    {
        $periodClass = static::$periodClass;
        $date = '2017-09-13 12:30:45';
        /** @var CarbonPeriod $period */
        $period = $periodClass::end(date: $date, inclusive: false);
        $this->assertEquals(Carbon::parse($date), $period->getEndDate());
        $this->assertEquals(Carbon::parse($date), $period->end());

        if (PHP_VERSION < 8.2) {
            $this->assertEquals(Carbon::parse($date), $period->end);
        }

        $this->assertPeriodOptions(CarbonPeriod::EXCLUDE_END_DATE, $period);

        $date = '2014-10-12 15:42:34';
        $period = $period->until(date: $date, inclusive: true);
        $this->assertEquals(Carbon::parse($date), $period->getEndDate());
        $this->assertPeriodOptions(0, $period);

        $period = $period->untilNow(inclusive: false);
        $this->assertEquals(Carbon::now(), $period->getEndDate());
        $this->assertPeriodOptions($periodClass::EXCLUDE_END_DATE, $period);
    }

    public function testManageFilters()
    {
        $filter = function () {
            return true;
        };

        $periodClass = static::$periodClass;
        $period = $periodClass::filter($filter, 'foo');
        $this->assertSame([[$filter, 'foo']], $period->getFilters());
        $this->assertSame([[$filter, 'foo']], $period->filters());

        $period = $period->push($filter, 'bar');
        $this->assertSame([[$filter, 'foo'], [$filter, 'bar']], $period->getFilters());

        $period = $period->prepend($filter, 'pre');
        $this->assertSame([[$filter, 'pre'], [$filter, 'foo'], [$filter, 'bar']], $period->getFilters());

        $period = $period->filters([]);
        $this->assertSame([], $period->getFilters());

        $period = $period->filters($filters = [[$filter, null]]);
        $this->assertSame($filters, $period->getFilters());
    }

    public function testSetRecurrences()
    {
        $periodClass = static::$periodClass;
        $period = $periodClass::recurrences(5);
        $this->assertSame(5, $period->getRecurrences());
        $this->assertSame(5, $period->recurrences());

        if (PHP_VERSION < 8.2) {
            $this->assertSame(5, $period->recurrences);
        }

        $period = $period->times(3);
        $this->assertSame(3, $period->getRecurrences());

        $period = $period->recurrences(null);
        $this->assertNull($period->getRecurrences());
    }

    public function testManageOptions()
    {
        $periodClass = static::$periodClass;
        $start = $periodClass::EXCLUDE_START_DATE;
        $end = $periodClass::EXCLUDE_END_DATE;

        $period = $periodClass::options($start);
        $this->assertSame($start, $period->getOptions());

        $period = $period->toggle($start | $end);
        $this->assertSame($start | $end, $period->getOptions());

        $period = $period->toggle($end, false);
        $this->assertSame($start, $period->getOptions());
        $this->assertSame($start, $period->options());

        $period = $period->options(null);
        $this->assertPeriodOptions(0, $period);
    }

    public function testSetDates()
    {
        $periodClass = static::$periodClass;
        $period = $periodClass::dates($start = '2014-10-12 15:42:34', $end = '2017-09-13 12:30:45');
        $this->assertEquals(Carbon::parse($start), $period->getStartDate());
        $this->assertEquals(Carbon::parse($end), $period->getEndDate());

        $period = $period->dates(Carbon::now());
        $this->assertEquals(Carbon::now(), $period->getStartDate());
        $this->assertNull($period->getEndDate());
    }

    public function testManageInterval()
    {
        $periodClass = static::$periodClass;
        $period = $periodClass::interval('PT6H');
        $this->assertEquals(CarbonInterval::create('PT6H')->optimize(), $period->getDateInterval()->optimize());
        $this->assertEquals(CarbonInterval::create('PT6H')->optimize(), $period->interval()->optimize());

        if (PHP_VERSION < 8.2) {
            $this->assertEquals(CarbonInterval::create('PT6H')->optimize(), $period->interval->optimize());
        }
    }

    public function testInvertInterval()
    {
        $periodClass = static::$periodClass;
        $period = $periodClass::invert();
        $this->assertEquals(
            CarbonInterval::create('P1D')->invert()->optimize(),
            $period->getDateInterval()->optimize(),
        );
    }

    public function testModifyIntervalPlural()
    {
        $periodClass = static::$periodClass;
        $period = $periodClass::weeks(2);
        $this->assertSame('P14D', $period->getDateInterval()->spec());

        $period = $period->years(2)->months(3)->days(4)->hours(5)->minutes(30)->seconds(15);
        $this->assertSame('P2Y3M4DT5H30M15S', $period->getDateInterval()->spec());

        $period = $period->years(0)->months(0)->dayz(0)->hours(0)->minutes(0)->seconds(1);
        $this->assertSame('PT1S', $period->getDateInterval()->spec());

        $period = $periodClass::create();
        $this->assertSame('P1D', $period->getDateInterval()->spec());

        $period = $periodClass::create()->hours(12);
        $this->assertSame('PT12H', $period->getDateInterval()->spec());

        $period = $periodClass::day()->hours(12);
        $this->assertSame('P1DT12H', $period->getDateInterval()->spec());

        $period = $periodClass::day()->resetDateInterval()->hours(12);
        $this->assertSame('PT12H', $period->getDateInterval()->spec());
    }

    public function testModifyIntervalSingular()
    {
        $periodClass = static::$periodClass;
        $period = $periodClass::week();
        $this->assertSame('P7D', $period->getDateInterval()->spec());

        $period = $period->year()->month()->day()->hour()->minute()->second();
        $this->assertSame('P1Y1M1DT1H1M1S', $period->getDateInterval()->spec());

        $period = $period->year(2)->month(3)->day(4)->hour(5)->minute(6)->second(7);
        $this->assertSame('P2Y3M4DT5H6M7S', $period->getDateInterval()->spec());
    }

    public function testChainAliases()
    {
        $periodClass = static::$periodClass;
        Carbon::setTestNow('2018-05-15');
        $period = $periodClass::days(3)->hours(5)->invert()
            ->sinceNow()->until(Carbon::now()->subDays(10))
            ->options($periodClass::EXCLUDE_START_DATE)
            ->times(2);

        $this->assertSame(
            $this->standardizeDates([
                Carbon::now()->subDays(3)->subHours(5), Carbon::now()->subDays(6)->subHours(10),
            ]),
            $this->standardizeDates($period),
        );
    }

    public function testCallInvalidAlias()
    {
        $this->expectExceptionObject(new BadMethodCallException(
            'Method foobar does not exist.',
        ));

        $periodClass = static::$periodClass;
        $periodClass::foobar();
    }

    public function testOverrideDefaultInterval()
    {
        $periodClass = static::$periodClass;
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
            'Empty interval is not accepted.',
        ));

        $periodClass = static::$periodClass;
        $periodClass::days(0);
    }

    public function testNamedParameters()
    {
        $periodClass = static::$periodClass;
        $period = $periodClass::between(start: '2022-09-13', end: '2022-10-12');
        $this->assertEquals('2022-09-13', $period->getStartDate()->format('Y-m-d'));
        $this->assertEquals('2022-10-12', $period->getEndDate()->format('Y-m-d'));

        $period = $period->years(years: 5);
        $this->assertEquals('5 years', (string) $period->getDateInterval());

        $period = $period->interval(interval: \Carbon\CarbonInterval::year(years: 3));
        $this->assertEquals('3 years', (string) $period->getDateInterval());

        $period = $periodClass::between(start: '2022-09-13', end: '2022-10-12')->months(months: 5);
        $this->assertEquals('5 months', (string) $period->getDateInterval());

        $period = $periodClass::between(start: '2022-09-13', end: '2022-10-12')->weeks(weeks: 5);
        $this->assertEquals('5 weeks', (string) $period->getDateInterval());

        $period = $periodClass::between(start: '2022-09-13', end: '2022-10-12')->days(days: 5);
        $this->assertEquals('5 days', (string) $period->getDateInterval());

        $period = $periodClass::between(start: '2022-09-13', end: '2022-10-12')->hours(hours: 5);
        $this->assertEquals('5 hours', (string) $period->getDateInterval());

        $period = $periodClass::between(start: '2022-09-13', end: '2022-10-12')->minutes(minutes: 5);
        $this->assertEquals('5 minutes', (string) $period->getDateInterval());

        $period = $periodClass::between(start: '2022-09-13', end: '2022-10-12')->seconds(seconds: 5);
        $this->assertEquals('5 seconds', (string) $period->getDateInterval());

        $period = $periodClass::between(start: '2022-09-13', end: '2022-10-12')
            ->days(days: 5)
            ->floorDays(precision: 2);
        $this->assertEquals('4 days', (string) $period->getDateInterval());

        $period = $periodClass::between(start: '2022-09-13', end: '2022-10-12')
            ->days(days: 5)
            ->roundDays(precision: 7);
        $this->assertEquals('1 week', (string) $period->getDateInterval());

        $period = $periodClass::between(start: '2022-09-13', end: '2022-10-12')
            ->days(days: 5)
            ->ceilDays(precision: 2);
        $this->assertEquals('6 days', (string) $period->getDateInterval());
    }
}
