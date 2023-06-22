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

use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Carbon\CarbonInterval;
use DateInterval;
use DatePeriod;
use DateTime;
use DateTimeImmutable;
use Tests\AbstractTestCase;

class ComparisonTest extends AbstractTestCase
{
    public function testEqualToTrue()
    {
        $periodClass = static::$periodClass;
        $period = $periodClass::create('2010-01-01', '2010-02-01');

        $this->assertTrue($period->equalTo($period));
        $this->assertTrue($period->eq($period));
        $this->assertTrue($period->eq($periodClass::create('2010-01-01', '2010-02-01')));
        $this->assertTrue($period->eq($periodClass::create('R3/2010-01-01/P1D/2010-02-01')));
        $this->assertTrue($period->eq(Carbon::parse('2010-01-01')->daysUntil('2010-02-01')));
        $this->assertTrue($period->eq(
            new DatePeriod(new DateTime('2010-01-01'), CarbonInterval::day(), new DateTime('2010-02-01'))
        ));

        $period = $periodClass::create('2010-01-01', '2010-02-01', 'P2D');

        $this->assertTrue($period->eq($periodClass::create('2010-01-01', '2010-02-01', 'P2D')));
        $this->assertTrue($period->eq($periodClass::create('2010-01-01', '2010-02-01', CarbonInterval::day(2))));
        $this->assertTrue($period->eq($periodClass::create('2010-01-01', '2010-02-01')->setDateInterval('P2D')));
        $this->assertTrue($period->eq($periodClass::create('R3/2010-01-01/P2D/2010-02-01')));

        $period = $periodClass::create('2010-01-01', '2010-02-01', $periodClass::EXCLUDE_START_DATE);

        $this->assertTrue($period->eq($periodClass::create('2010-01-01', '2010-02-01', $periodClass::EXCLUDE_START_DATE)));
        $this->assertTrue($period->eq($periodClass::create('2010-01-01', '2010-02-01')->setOptions($periodClass::EXCLUDE_START_DATE)));
    }

    public function testEqualToFalse()
    {
        $periodClass = static::$periodClass;
        $period = $periodClass::create('2010-01-01', '2010-02-01');

        $this->assertFalse($period->equalTo($periodClass::create('2010-01-02', '2010-02-01')));
        $this->assertFalse($period->eq($periodClass::create('2010-01-02', '2010-02-01')));
        $this->assertFalse($period->eq($periodClass::create('2010-01-01', '2010-02-02')));
        $this->assertFalse($period->eq($periodClass::create('2010-01-01', '2010-02-02', 'P2D')));
        $this->assertFalse($period->eq($periodClass::create('2010-01-01', '2010-02-02', $periodClass::EXCLUDE_START_DATE)));
    }

    public function testNotEqualToTrue()
    {
        $periodClass = static::$periodClass;
        $period = $periodClass::create('2010-01-01', '2010-02-01');

        $this->assertTrue($period->notEqualTo($periodClass::create('2010-01-02', '2010-02-01')));
        $this->assertTrue($period->ne($periodClass::create('2010-01-02', '2010-02-01')));
        $this->assertTrue($period->ne($periodClass::create('2010-01-01', '2010-02-02')));
        $this->assertTrue($period->ne($periodClass::create('2010-01-01', '2010-02-02', 'P2D')));
        $this->assertTrue($period->ne($periodClass::create('2010-01-01', '2010-02-02', $periodClass::EXCLUDE_START_DATE)));
    }

    public function testNotEqualToFalse()
    {
        $periodClass = static::$periodClass;
        $period = $periodClass::create('2010-01-01', '2010-02-01');

        $this->assertFalse($period->notEqualTo($period));
        $this->assertFalse($period->ne($period));
        $this->assertFalse($period->ne($periodClass::create('2010-01-01', '2010-02-01')));
        $this->assertFalse($period->ne($periodClass::create('R3/2010-01-01/P1D/2010-02-01')));
        $this->assertFalse($period->ne(Carbon::parse('2010-01-01')->daysUntil('2010-02-01')));
        $this->assertFalse($period->ne(
            new DatePeriod(new DateTime('2010-01-01'), CarbonInterval::day(), new DateTime('2010-02-01'))
        ));

        $period = $periodClass::create('2010-01-01', '2010-02-01', 'P2D');

        $this->assertFalse($period->ne($periodClass::create('2010-01-01', '2010-02-01', 'P2D')));
        $this->assertFalse($period->ne($periodClass::create('2010-01-01', '2010-02-01', CarbonInterval::day(2))));
        $this->assertFalse($period->ne($periodClass::create('2010-01-01', '2010-02-01')->setDateInterval('P2D')));
        $this->assertFalse($period->ne($periodClass::create('R3/2010-01-01/P2D/2010-02-01')));

        $period = $periodClass::create('2010-01-01', '2010-02-01', $periodClass::EXCLUDE_START_DATE);

        $this->assertFalse($period->ne($periodClass::create('2010-01-01', '2010-02-01', $periodClass::EXCLUDE_START_DATE)));
        $this->assertFalse($period->ne($periodClass::create('2010-01-01', '2010-02-01')->setOptions($periodClass::EXCLUDE_START_DATE)));
    }

    public function testStartComparisons()
    {
        $periodClass = static::$periodClass;
        Carbon::setTestNow('2020-01-01');
        CarbonImmutable::setTestNow('2020-01-01');

        $this->assertFalse($periodClass::create('2020-01-05', '2020-02-01')->startsBefore($periodClass::create('2019-12-05', '2020-02-01')));
        $this->assertTrue($periodClass::create('2020-01-05', '2020-02-01')->startsBefore($periodClass::create('2020-01-07', '2020-01-08')));

        $this->assertFalse($periodClass::create('2020-01-05', '2020-02-01')->startsBefore(CarbonInterval::days(2)));
        $this->assertFalse($periodClass::create('2020-01-05', '2020-02-01')->startsBefore(CarbonInterval::days(4)));
        $this->assertTrue($periodClass::create('2020-01-05', '2020-02-01')->startsBeforeOrAt(CarbonInterval::days(4)));
        $this->assertTrue($periodClass::create('2020-01-05', '2020-02-01')->startsBefore(CarbonInterval::days(5)));

        $this->assertTrue($periodClass::create('2020-01-05', '2020-02-01')->startsAfter($periodClass::create('2019-12-05', '2020-02-01')));
        $this->assertFalse($periodClass::create('2020-01-05', '2020-02-01')->startsAfter($periodClass::create('2020-01-07', '2020-01-08')));

        $this->assertTrue($periodClass::create('2020-01-05', '2020-02-01')->startsAfter(CarbonInterval::days(2)));
        $this->assertFalse($periodClass::create('2020-01-05', '2020-02-01')->startsAfter(CarbonInterval::days(4)));
        $this->assertTrue($periodClass::create('2020-01-05', '2020-02-01')->startsAfterOrAt(CarbonInterval::days(4)));
        $this->assertFalse($periodClass::create('2020-01-05', '2020-02-01')->startsAfter(CarbonInterval::days(5)));

        $this->assertFalse($periodClass::create('2020-01-05', '2020-02-01')->startsAt('2020-02-01'));
        $this->assertTrue($periodClass::create('2020-01-05', '2020-02-01')->startsAt('2020-01-05'));
    }

    public function testEndComparisons()
    {
        $periodClass = static::$periodClass;
        Carbon::setTestNow('2020-02-05');
        CarbonImmutable::setTestNow('2020-02-05');

        $this->assertFalse($periodClass::create('2020-01-05', '2020-02-01')->endsBefore($periodClass::create('2019-12-05', '2020-02-01')));
        $this->assertFalse($periodClass::create('2020-01-05', '2020-02-01')->endsBefore($periodClass::create('2020-01-07', '2020-01-08')));
        $this->assertFalse($periodClass::create('2020-01-05', '2020-02-01')->endsBefore($periodClass::create('2020-02-01', '2020-02-08')));
        $this->assertTrue($periodClass::create('2020-01-05', '2020-02-01')->endsBeforeOrAt($periodClass::create('2020-02-01', '2020-02-08')));
        $this->assertTrue($periodClass::create('2020-01-05', '2020-02-01')->endsBefore($periodClass::create('2020-02-03', '2020-02-08')));

        $this->assertTrue($periodClass::create('2020-01-05', '2020-02-01')->endsBefore(CarbonInterval::days(2)->invert()));
        $this->assertFalse($periodClass::create('2020-01-05', '2020-02-01')->endsBefore(CarbonInterval::days(4)->invert()));
        $this->assertTrue($periodClass::create('2020-01-05', '2020-02-01')->endsBeforeOrAt(CarbonInterval::days(4)->invert()));
        $this->assertFalse($periodClass::create('2020-01-05', '2020-02-01')->endsBefore(CarbonInterval::days(5)->invert()));

        $this->assertTrue($periodClass::create('2020-01-05', '2020-02-01')->endsAfter($periodClass::create('2019-12-05', '2020-02-01')));
        $this->assertTrue($periodClass::create('2020-01-05', '2020-02-01')->endsAfter($periodClass::create('2020-01-07', '2020-01-08')));
        $this->assertTrue($periodClass::create('2020-01-05', '2020-02-01')->endsAfterOrAt($periodClass::create('2020-02-01', '2020-01-08')));
        $this->assertFalse($periodClass::create('2020-01-05', '2020-02-01')->endsAfter($periodClass::create('2020-02-01', '2020-01-08')));
        $this->assertFalse($periodClass::create('2020-01-05', '2020-02-01')->endsAfter($periodClass::create('2020-02-02', '2020-01-08')));

        $this->assertFalse($periodClass::create('2020-01-05', '2020-02-01')->endsAfter(CarbonInterval::days(2)->invert()));
        $this->assertFalse($periodClass::create('2020-01-05', '2020-02-01')->endsAfter(CarbonInterval::days(4)->invert()));
        $this->assertTrue($periodClass::create('2020-01-05', '2020-02-01')->endsAfterOrAt(CarbonInterval::days(4)->invert()));
        $this->assertTrue($periodClass::create('2020-01-05', '2020-02-01')->endsAfter(CarbonInterval::days(5)->invert()));

        $this->assertTrue($periodClass::create('2020-01-05', '2020-02-01')->endsAt('2020-02-01'));
        $this->assertFalse($periodClass::create('2020-01-05', '2020-02-01')->endsAt('2020-01-05'));
    }

    public function testContains()
    {
        $periodClass = static::$periodClass;
        $period = $periodClass::create('2019-08-01', '2019-08-10');

        $this->assertFalse($period->contains('2019-07-31 23:59:59'));
        $this->assertTrue($period->contains('2019-08-01'));
        $this->assertTrue($period->contains('2019-08-02'));
        $this->assertTrue($period->contains('2019-08-10'));
        $this->assertFalse($period->contains('2019-08-10 00:00:01'));

        $period = $periodClass::create('2019-08-01', '2019-08-10', $periodClass::EXCLUDE_START_DATE | $periodClass::EXCLUDE_END_DATE);

        $this->assertFalse($period->contains('2019-08-01'));
        $this->assertTrue($period->contains('2019-08-01 00:00:01'));
        $this->assertTrue($period->contains('2019-08-02'));
        $this->assertTrue($period->contains('2019-08-09 23:59:59'));
        $this->assertFalse($period->contains('2019-08-10'));
    }

    public function testConsecutivePeriods()
    {
        $periodClass = static::$periodClass;
        $july = $periodClass::create('2019-07-29', '2019-07-31');
        $august = $periodClass::create('2019-08-01', '2019-08-12');

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
            new DateTimeImmutable('2019-07-31'),
        );
        $august2 = new DatePeriod(
            new DateTimeImmutable('2019-08-01'),
            new DateInterval('P1D'),
            new DateTimeImmutable('2019-08-12'),
        );

        $this->assertFalse($july->follows($august2));
        $this->assertTrue($august->follows($july2));

        $this->assertTrue($july->isFollowedBy($august2));
        $this->assertFalse($august->isFollowedBy($july2));

        $this->assertTrue($july->isConsecutiveWith($august2));
        $this->assertTrue($august->isConsecutiveWith($july2));

        $july = $periodClass::create('2019-07-29', '2019-08-01');
        $august = $periodClass::create('2019-08-01', '2019-08-12');

        $this->assertFalse($july->follows($august));
        $this->assertFalse($august->follows($july));

        $this->assertFalse($july->isFollowedBy($august));
        $this->assertFalse($august->isFollowedBy($july));

        $this->assertFalse($july->isConsecutiveWith($august));
        $this->assertFalse($august->isConsecutiveWith($july));

        $july = $periodClass::create('2019-07-29', '2019-07-31', $periodClass::EXCLUDE_END_DATE);
        $august = $periodClass::create('2019-08-01', '2019-08-12', $periodClass::EXCLUDE_START_DATE);

        $this->assertFalse($july->follows($august));
        $this->assertFalse($august->follows($july));

        $this->assertFalse($july->isFollowedBy($august));
        $this->assertFalse($august->isFollowedBy($july));

        $this->assertFalse($july->isConsecutiveWith($august));
        $this->assertFalse($august->isConsecutiveWith($july));
    }

    public function testConsecutivePeriodsWithExclusion()
    {
        $periodClass = static::$periodClass;
        $july = $periodClass::create('2019-07-29', '2019-08-01', $periodClass::EXCLUDE_END_DATE);
        $august = $periodClass::create('2019-07-31', '2019-08-12', $periodClass::EXCLUDE_START_DATE);

        $this->assertFalse($july->follows($august));
        $this->assertTrue($august->follows($july));

        $this->assertTrue($july->isFollowedBy($august));
        $this->assertFalse($august->isFollowedBy($july));

        $this->assertTrue($july->isConsecutiveWith($august));
        $this->assertTrue($august->isConsecutiveWith($july));
    }

    public function testConsecutivePeriodsWithDynamicEnd()
    {
        $periodClass = static::$periodClass;
        $july = $periodClass::create('2019-07-29', '1 day', 4);
        $august = $periodClass::create('2019-08-02', '2019-08-12');

        $this->assertFalse($july->follows($august));
        $this->assertTrue($august->follows($july));

        $this->assertTrue($july->isFollowedBy($august));
        $this->assertFalse($august->isFollowedBy($july));

        $this->assertTrue($july->isConsecutiveWith($august));
        $this->assertTrue($august->isConsecutiveWith($july));
    }
}
