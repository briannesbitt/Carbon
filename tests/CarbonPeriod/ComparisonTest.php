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
use DateInterval;
use DatePeriod;
use DateTimeImmutable;
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

    public function testContains()
    {
        $period = CarbonPeriod::create('2019-08-01', '2019-08-10');

        $this->assertFalse($period->contains('2019-07-31 23:59:59'));
        $this->assertTrue($period->contains('2019-08-01'));
        $this->assertTrue($period->contains('2019-08-02'));
        $this->assertTrue($period->contains('2019-08-10'));
        $this->assertFalse($period->contains('2019-08-10 00:00:01'));

        $period = CarbonPeriod::create('2019-08-01', '2019-08-10', CarbonPeriod::EXCLUDE_START_DATE | CarbonPeriod::EXCLUDE_END_DATE);

        $this->assertFalse($period->contains('2019-08-01'));
        $this->assertTrue($period->contains('2019-08-01 00:00:01'));
        $this->assertTrue($period->contains('2019-08-02'));
        $this->assertTrue($period->contains('2019-08-09 23:59:59'));
        $this->assertFalse($period->contains('2019-08-10'));
    }

    public function testConsecutivePeriods()
    {
        $july = CarbonPeriod::create('2019-07-29', '2019-07-31');
        $august = CarbonPeriod::create('2019-08-01', '2019-08-12');

        $this->assertFalse($july->follows($august));
        $this->assertTrue($august->follows($july));

        $this->assertTrue($july->isFollowedBy($august));
        $this->assertFalse($august->isFollowedBy($july));

        $this->assertTrue($july->isConsecutiveWith($august));
        $this->assertTrue($august->isConsecutiveWith($july));

        $this->assertFalse($july->follows('2019-08-01', '2019-08-12'));
        $this->assertTrue($august->follows('2019-07-29', '2019-07-31'));

        $this->assertTrue($july->isFollowedBy('2019-08-01', '2019-08-12'));
        $this->assertFalse($august->isFollowedBy('2019-07-29', '2019-07-31'));

        $this->assertTrue($july->isConsecutiveWith('2019-08-01', '2019-08-12'));
        $this->assertTrue($august->isConsecutiveWith('2019-07-29', '2019-07-31'));

        $july2 = new DatePeriod(
            new DateTimeImmutable('2019-07-29'),
            new DateInterval('P1D'),
            new DateTimeImmutable('2019-07-31')
        );
        $august2 = new DatePeriod(
            new DateTimeImmutable('2019-08-01'),
            new DateInterval('P1D'),
            new DateTimeImmutable('2019-08-12')
        );

        $this->assertFalse($july->follows($august2));
        $this->assertTrue($august->follows($july2));

        $this->assertTrue($july->isFollowedBy($august2));
        $this->assertFalse($august->isFollowedBy($july2));

        $this->assertTrue($july->isConsecutiveWith($august2));
        $this->assertTrue($august->isConsecutiveWith($july2));

        $july = CarbonPeriod::create('2019-07-29', '2019-08-01');
        $august = CarbonPeriod::create('2019-08-01', '2019-08-12');

        $this->assertFalse($july->follows($august));
        $this->assertFalse($august->follows($july));

        $this->assertFalse($july->isFollowedBy($august));
        $this->assertFalse($august->isFollowedBy($july));

        $this->assertFalse($july->isConsecutiveWith($august));
        $this->assertFalse($august->isConsecutiveWith($july));

        $july = CarbonPeriod::create('2019-07-29', '2019-07-31', CarbonPeriod::EXCLUDE_END_DATE);
        $august = CarbonPeriod::create('2019-08-01', '2019-08-12', CarbonPeriod::EXCLUDE_START_DATE);

        $this->assertFalse($july->follows($august));
        $this->assertFalse($august->follows($july));

        $this->assertFalse($july->isFollowedBy($august));
        $this->assertFalse($august->isFollowedBy($july));

        $this->assertFalse($july->isConsecutiveWith($august));
        $this->assertFalse($august->isConsecutiveWith($july));
    }

    public function testConsecutivePeriodsWithExclusion()
    {
        $july = CarbonPeriod::create('2019-07-29', '2019-08-01', CarbonPeriod::EXCLUDE_END_DATE);
        $august = CarbonPeriod::create('2019-07-31', '2019-08-12', CarbonPeriod::EXCLUDE_START_DATE);

        $this->assertFalse($july->follows($august));
        $this->assertTrue($august->follows($july));

        $this->assertTrue($july->isFollowedBy($august));
        $this->assertFalse($august->isFollowedBy($july));

        $this->assertTrue($july->isConsecutiveWith($august));
        $this->assertTrue($august->isConsecutiveWith($july));
    }

    public function testConsecutivePeriodsWithDynamicEnd()
    {
        $july = CarbonPeriod::create('2019-07-29', '1 day', 4);
        $august = CarbonPeriod::create('2019-08-02', '2019-08-12');

        $this->assertFalse($july->follows($august));
        $this->assertTrue($august->follows($july));

        $this->assertTrue($july->isFollowedBy($august));
        $this->assertFalse($august->isFollowedBy($july));

        $this->assertTrue($july->isConsecutiveWith($august));
        $this->assertTrue($august->isConsecutiveWith($july));
    }
}
