<?php
declare(strict_types = 1);

/**
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
use DatePeriod;
use Tests\AbstractTestCase;

class ComparisonTest extends AbstractTestCase
{
    public function testEqualToTrue()
    {
        $period = CarbonPeriod::create('2010-01-01', '2010-02-01');

        $this->assertTrue($period->equalTo($period));
        $this->assertTrue($period->eq($period));
        $this->assertTrue($period->eq(CarbonPeriod::create('2010-01-01', '2010-02-01')));
        $this->assertTrue($period->eq(CarbonPeriod::create('R3/2010-01-01/P1D/2010-02-01')));
        $this->assertTrue($period->eq(Carbon::parse('2010-01-01')->daysUntil('2010-02-01')));
        $this->assertTrue($period->eq(new DatePeriod(Carbon::parse('2010-01-01'), CarbonInterval::day(), Carbon::parse('2010-02-01'))));

        $period = CarbonPeriod::create('2010-01-01', '2010-02-01', 'P2D');

        $this->assertTrue($period->eq(CarbonPeriod::create('2010-01-01', '2010-02-01', 'P2D')));
        $this->assertTrue($period->eq(CarbonPeriod::create('2010-01-01', '2010-02-01', CarbonInterval::day(2))));
        $this->assertTrue($period->eq(CarbonPeriod::create('2010-01-01', '2010-02-01')->setDateInterval('P2D')));
        $this->assertTrue($period->eq(CarbonPeriod::create('R3/2010-01-01/P2D/2010-02-01')));

        $period = CarbonPeriod::create('2010-01-01', '2010-02-01', CarbonPeriod::EXCLUDE_START_DATE);

        $this->assertTrue($period->eq(CarbonPeriod::create('2010-01-01', '2010-02-01', CarbonPeriod::EXCLUDE_START_DATE)));
        $this->assertTrue($period->eq(CarbonPeriod::create('2010-01-01', '2010-02-01')->setOptions(CarbonPeriod::EXCLUDE_START_DATE)));
    }

    public function testEqualToFalse()
    {
        $period = CarbonPeriod::create('2010-01-01', '2010-02-01');

        $this->assertFalse($period->equalTo(CarbonPeriod::create('2010-01-02', '2010-02-01')));
        $this->assertFalse($period->eq(CarbonPeriod::create('2010-01-02', '2010-02-01')));
        $this->assertFalse($period->eq(CarbonPeriod::create('2010-01-01', '2010-02-02')));
        $this->assertFalse($period->eq(CarbonPeriod::create('2010-01-01', '2010-02-02', 'P2D')));
        $this->assertFalse($period->eq(CarbonPeriod::create('2010-01-01', '2010-02-02', CarbonPeriod::EXCLUDE_START_DATE)));
    }

    public function testNotEqualToTrue()
    {
        $period = CarbonPeriod::create('2010-01-01', '2010-02-01');

        $this->assertTrue($period->notEqualTo(CarbonPeriod::create('2010-01-02', '2010-02-01')));
        $this->assertTrue($period->ne(CarbonPeriod::create('2010-01-02', '2010-02-01')));
        $this->assertTrue($period->ne(CarbonPeriod::create('2010-01-01', '2010-02-02')));
        $this->assertTrue($period->ne(CarbonPeriod::create('2010-01-01', '2010-02-02', 'P2D')));
        $this->assertTrue($period->ne(CarbonPeriod::create('2010-01-01', '2010-02-02', CarbonPeriod::EXCLUDE_START_DATE)));
    }

    public function testNotEqualToFalse()
    {
        $period = CarbonPeriod::create('2010-01-01', '2010-02-01');

        $this->assertFalse($period->notEqualTo($period));
        $this->assertFalse($period->ne($period));
        $this->assertFalse($period->ne(CarbonPeriod::create('2010-01-01', '2010-02-01')));
        $this->assertFalse($period->ne(CarbonPeriod::create('R3/2010-01-01/P1D/2010-02-01')));
        $this->assertFalse($period->ne(Carbon::parse('2010-01-01')->daysUntil('2010-02-01')));
        $this->assertFalse($period->ne(new DatePeriod(Carbon::parse('2010-01-01'), CarbonInterval::day(), Carbon::parse('2010-02-01'))));

        $period = CarbonPeriod::create('2010-01-01', '2010-02-01', 'P2D');

        $this->assertFalse($period->ne(CarbonPeriod::create('2010-01-01', '2010-02-01', 'P2D')));
        $this->assertFalse($period->ne(CarbonPeriod::create('2010-01-01', '2010-02-01', CarbonInterval::day(2))));
        $this->assertFalse($period->ne(CarbonPeriod::create('2010-01-01', '2010-02-01')->setDateInterval('P2D')));
        $this->assertFalse($period->ne(CarbonPeriod::create('R3/2010-01-01/P2D/2010-02-01')));

        $period = CarbonPeriod::create('2010-01-01', '2010-02-01', CarbonPeriod::EXCLUDE_START_DATE);

        $this->assertFalse($period->ne(CarbonPeriod::create('2010-01-01', '2010-02-01', CarbonPeriod::EXCLUDE_START_DATE)));
        $this->assertFalse($period->ne(CarbonPeriod::create('2010-01-01', '2010-02-01')->setOptions(CarbonPeriod::EXCLUDE_START_DATE)));
    }

    public function testStartComparisons()
    {
        Carbon::setTestNow('2020-01-01');

        $this->assertFalse(CarbonPeriod::create('2020-01-05', '2020-02-01')->startsBefore(CarbonPeriod::create('2019-12-05', '2020-02-01')));
        $this->assertTrue(CarbonPeriod::create('2020-01-05', '2020-02-01')->startsBefore(CarbonPeriod::create('2020-01-07', '2020-01-08')));

        $this->assertFalse(CarbonPeriod::create('2020-01-05', '2020-02-01')->startsBefore(CarbonInterval::days(2)));
        $this->assertFalse(CarbonPeriod::create('2020-01-05', '2020-02-01')->startsBefore(CarbonInterval::days(4)));
        $this->assertTrue(CarbonPeriod::create('2020-01-05', '2020-02-01')->startsBeforeOrAt(CarbonInterval::days(4)));
        $this->assertTrue(CarbonPeriod::create('2020-01-05', '2020-02-01')->startsBefore(CarbonInterval::days(5)));

        $this->assertTrue(CarbonPeriod::create('2020-01-05', '2020-02-01')->startsAfter(CarbonPeriod::create('2019-12-05', '2020-02-01')));
        $this->assertFalse(CarbonPeriod::create('2020-01-05', '2020-02-01')->startsAfter(CarbonPeriod::create('2020-01-07', '2020-01-08')));

        $this->assertTrue(CarbonPeriod::create('2020-01-05', '2020-02-01')->startsAfter(CarbonInterval::days(2)));
        $this->assertFalse(CarbonPeriod::create('2020-01-05', '2020-02-01')->startsAfter(CarbonInterval::days(4)));
        $this->assertTrue(CarbonPeriod::create('2020-01-05', '2020-02-01')->startsAfterOrAt(CarbonInterval::days(4)));
        $this->assertFalse(CarbonPeriod::create('2020-01-05', '2020-02-01')->startsAfter(CarbonInterval::days(5)));

        $this->assertFalse(CarbonPeriod::create('2020-01-05', '2020-02-01')->startsAt('2020-02-01'));
        $this->assertTrue(CarbonPeriod::create('2020-01-05', '2020-02-01')->startsAt('2020-01-05'));
    }

    public function testEndComparisons()
    {
        Carbon::setTestNow('2020-02-05');

        $this->assertFalse(CarbonPeriod::create('2020-01-05', '2020-02-01')->endsBefore(CarbonPeriod::create('2019-12-05', '2020-02-01')));
        $this->assertFalse(CarbonPeriod::create('2020-01-05', '2020-02-01')->endsBefore(CarbonPeriod::create('2020-01-07', '2020-01-08')));
        $this->assertFalse(CarbonPeriod::create('2020-01-05', '2020-02-01')->endsBefore(CarbonPeriod::create('2020-02-01', '2020-02-08')));
        $this->assertTrue(CarbonPeriod::create('2020-01-05', '2020-02-01')->endsBeforeOrAt(CarbonPeriod::create('2020-02-01', '2020-02-08')));
        $this->assertTrue(CarbonPeriod::create('2020-01-05', '2020-02-01')->endsBefore(CarbonPeriod::create('2020-02-03', '2020-02-08')));

        $this->assertTrue(CarbonPeriod::create('2020-01-05', '2020-02-01')->endsBefore(CarbonInterval::days(2)->invert()));
        $this->assertFalse(CarbonPeriod::create('2020-01-05', '2020-02-01')->endsBefore(CarbonInterval::days(4)->invert()));
        $this->assertTrue(CarbonPeriod::create('2020-01-05', '2020-02-01')->endsBeforeOrAt(CarbonInterval::days(4)->invert()));
        $this->assertFalse(CarbonPeriod::create('2020-01-05', '2020-02-01')->endsBefore(CarbonInterval::days(5)->invert()));

        $this->assertTrue(CarbonPeriod::create('2020-01-05', '2020-02-01')->endsAfter(CarbonPeriod::create('2019-12-05', '2020-02-01')));
        $this->assertTrue(CarbonPeriod::create('2020-01-05', '2020-02-01')->endsAfter(CarbonPeriod::create('2020-01-07', '2020-01-08')));
        $this->assertTrue(CarbonPeriod::create('2020-01-05', '2020-02-01')->endsAfterOrAt(CarbonPeriod::create('2020-02-01', '2020-01-08')));
        $this->assertFalse(CarbonPeriod::create('2020-01-05', '2020-02-01')->endsAfter(CarbonPeriod::create('2020-02-01', '2020-01-08')));
        $this->assertFalse(CarbonPeriod::create('2020-01-05', '2020-02-01')->endsAfter(CarbonPeriod::create('2020-02-02', '2020-01-08')));

        $this->assertFalse(CarbonPeriod::create('2020-01-05', '2020-02-01')->endsAfter(CarbonInterval::days(2)->invert()));
        $this->assertFalse(CarbonPeriod::create('2020-01-05', '2020-02-01')->endsAfter(CarbonInterval::days(4)->invert()));
        $this->assertTrue(CarbonPeriod::create('2020-01-05', '2020-02-01')->endsAfterOrAt(CarbonInterval::days(4)->invert()));
        $this->assertTrue(CarbonPeriod::create('2020-01-05', '2020-02-01')->endsAfter(CarbonInterval::days(5)->invert()));

        $this->assertTrue(CarbonPeriod::create('2020-01-05', '2020-02-01')->endsAt('2020-02-01'));
        $this->assertFalse(CarbonPeriod::create('2020-01-05', '2020-02-01')->endsAt('2020-01-05'));
    }
}
