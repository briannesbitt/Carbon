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
use Carbon\CarbonPeriod;
use Carbon\Exceptions\UnknownGetterException;
use Carbon\Exceptions\UnreachableException;
use DateTime;
use Tests\AbstractTestCase;
use Tests\CarbonPeriod\Fixtures\CarbonPeriodFactory;

class GettersTest extends AbstractTestCase
{
    public function testGetStartDate()
    {
        $period = CarbonPeriodFactory::withStartIntervalEnd(static::$periodClass);

        $date = $period->getStartDate();

        $this->assertInstanceOfCarbon($date);

        $this->assertSame('2012-07-01 17:30:00', $date->format('Y-m-d H:i:s'));
    }

    public function testGetEndDate()
    {
        $period = CarbonPeriodFactory::withStartIntervalEnd(static::$periodClass);

        $date = $period->getEndDate();

        $this->assertInstanceOfCarbon($date);

        $this->assertSame('2012-07-15 11:15:00', $date->format('Y-m-d H:i:s'));
    }

    public function testGetDateInterval()
    {
        $period = CarbonPeriodFactory::withStartIntervalEnd(static::$periodClass);

        $interval = $period->getDateInterval();

        $this->assertInstanceOfCarbonInterval($interval);

        $this->assertSame('P3DT5H', $interval->spec());
    }

    public function testGetRecurrences()
    {
        $periodClass = static::$periodClass;

        $recurrences = $periodClass::create(new DateTime(), 5)->getRecurrences();

        $this->assertSame(5, $recurrences);

        $period = $periodClass::create('2024-09-01/3 days/2024-09-30');

        $this->assertNull($period->get('recurrences'));

        $period = $periodClass::create('R3/2024-09-01/3 days');

        $this->assertSame(3, $period->get('recurrences'));
    }

    public function testGetDefaultDateInterval()
    {
        $periodClass = static::$periodClass;

        $period = $periodClass::create(Carbon::parse('2015-09-30'), Carbon::parse('2015-10-03'));

        $this->assertInstanceOfCarbonInterval($period->getDateInterval());

        $this->assertSame('P1D', $period->getDateInterval()->spec());
    }

    public function testModifyStartDate()
    {
        $period = CarbonPeriodFactory::withStartIntervalEnd(static::$periodClass);

        $period->getStartDate()->subDays(3);

        $this->assertSame('2012-07-01', $period->getStartDate()->format('Y-m-d'));
    }

    public function testModifyEndDate()
    {
        $period = CarbonPeriodFactory::withStartIntervalEnd(static::$periodClass);

        $period->getEndDate()->addDays(3);

        $this->assertSame('2012-07-15', $period->getEndDate()->format('Y-m-d'));
    }

    public function testModifyDateInterval()
    {
        $period = CarbonPeriodFactory::withStartIntervalEnd(static::$periodClass);

        $period->getDateInterval()->days(5)->hours(0);

        $this->assertSame('P3DT5H', $period->getDateInterval()->spec());
    }

    public function testGetOptions()
    {
        $periodClass = static::$periodClass;

        $period = new $periodClass();

        $this->assertSame(0, $period->getOptions());

        $this->assertTrue($period->isStartIncluded());
        $this->assertTrue($period->isEndIncluded());

        if (PHP_VERSION < 8.2) {
            $this->assertTrue($period->include_start_date);
            $this->assertTrue($period->include_end_date);
        }

        $period = new $periodClass(new DateTime(), new DateTime(), $options = $periodClass::EXCLUDE_START_DATE | $periodClass::EXCLUDE_END_DATE);

        $this->assertSame($options, $period->getOptions());

        $this->assertFalse($period->isStartIncluded());
        $this->assertFalse($period->isEndIncluded());

        if (PHP_VERSION < 8.2) {
            $this->assertFalse($period->include_start_date);
            $this->assertFalse($period->include_end_date);
        }
    }

    public function testOverlaps()
    {
        $periodClass = static::$periodClass;

        $range1 = $periodClass::create('2019-01-26', '2019-03-03');
        $range2 = $periodClass::create('2019-02-15', '2019-04-01');

        $this->assertTrue($range1->overlaps($range2));
        $this->assertTrue($range2->overlaps($range1));

        $range1 = $periodClass::create('2019-01-26', '2019-02-13');
        $range2 = $periodClass::create('2019-02-15', '2019-04-01');

        $this->assertFalse($range1->overlaps($range2));
        $this->assertFalse($range2->overlaps($range1));

        $range1 = $periodClass::create('2019-01-26', '2019-02-15');
        $range2 = $periodClass::create('2019-02-15', '2019-04-01');

        $this->assertFalse($range1->overlaps($range2));
        $this->assertFalse($range2->overlaps($range1));

        $range1 = $periodClass::create('2019-01-26', '2019-02-15 00:00:01');
        $range2 = $periodClass::create('2019-02-15', '2019-04-01');

        $this->assertTrue($range1->overlaps($range2));
        $this->assertTrue($range2->overlaps($range1));

        $range1 = $periodClass::create('2019-01-26', '2019-02-15 00:00:01');
        $range2 = $periodClass::create('2019-02-15 00:00:01', '2019-04-01');

        $this->assertFalse($range1->overlaps($range2));
        $this->assertFalse($range2->overlaps($range1));

        $range1 = $periodClass::create('2019-01-26 10:30:12', '2019-01-26 13:30:12');
        $range2 = $periodClass::create('2019-01-26 10:30:05', '2019-01-26 13:32:12');

        $this->assertTrue($range1->overlaps($range2));
        $this->assertTrue($range2->overlaps($range1));

        $range1 = $periodClass::create('2019-01-26 10:30:12', INF);
        $range2 = $periodClass::create('2999-01-26 10:30:05', '2999-01-26 13:32:12');

        $this->assertFalse($range1->calculateEnd()->isStartOfTime());
        $this->assertTrue($range1->calculateEnd()->isEndOfTime());
        $this->assertFalse($range2->calculateEnd()->isStartOfTime());
        $this->assertFalse($range2->calculateEnd()->isEndOfTime());
        $this->assertTrue($range1->overlaps($range2));
        $this->assertTrue($range2->overlaps($range1));

        $range1 = $periodClass::create('2019-01-26 10:30:12', CarbonInterval::day(-1), INF);
        $range2 = $periodClass::create('2999-01-26 10:30:05', '2999-01-26 13:32:12');

        $this->assertTrue($range1->calculateEnd()->isStartOfTime());
        $this->assertFalse($range1->calculateEnd()->isEndOfTime());
        $this->assertFalse($range2->calculateEnd()->isStartOfTime());
        $this->assertFalse($range2->calculateEnd()->isEndOfTime());
        $this->assertFalse($range1->overlaps($range2));
        $this->assertFalse($range2->overlaps($range1));

        $range1 = $periodClass::create('2019-01-26 10:30:12', INF);
        $range2 = $periodClass::create('1975-01-26 10:30:05', '1975-01-26 13:32:12');

        $this->assertFalse($range1->overlaps($range2));
        $this->assertFalse($range2->overlaps($range1));

        $range1 = $periodClass::create('2019-01-26 10:30:12', CarbonInterval::day(-1), INF);
        $range2 = $periodClass::create('1975-01-26 10:30:05', '1975-01-26 13:32:12');

        $this->assertTrue($range1->overlaps($range2));
        $this->assertTrue($range2->overlaps($range1));

        $range1 = $periodClass::create('2019-01-26 10:30:12', INF);
        $range2 = $periodClass::create('2999-01-26 10:30:05', INF);

        $this->assertTrue($range1->overlaps($range2));
        $this->assertTrue($range2->overlaps($range1));

        $range1 = $periodClass::create('2019-01-26 10:30:12', CarbonInterval::day(-1), INF);
        $range2 = $periodClass::create('2999-01-26 10:30:05', INF);

        $this->assertFalse($range1->overlaps($range2));
        $this->assertFalse($range2->overlaps($range1));

        $range1 = $periodClass::create('2019-01-26 10:30:12', INF);
        $range2 = $periodClass::create('1975-01-26 10:30:05', INF);

        $this->assertTrue($range1->overlaps($range2));
        $this->assertTrue($range2->overlaps($range1));

        $range1 = $periodClass::create('2019-01-26 10:30:12', INF);
        $range2 = $periodClass::create('1975-01-26 10:30:05', CarbonInterval::day(-1), INF);

        $this->assertFalse($range1->overlaps($range2));
        $this->assertFalse($range2->overlaps($range1));

        $range1 = $periodClass::create('2019-01-26 10:30:12', CarbonInterval::day(-1), INF);
        $range2 = $periodClass::create('1975-01-26 10:30:05', INF);

        $this->assertTrue($range1->overlaps($range2));
        $this->assertTrue($range2->overlaps($range1));

        $range1 = $periodClass::create('2019-01-26 10:30:12', CarbonInterval::day(), 365, $periodClass::EXCLUDE_START_DATE);
        $range2 = $periodClass::create('2020-01-26 10:30:05', '2020-01-27 10:30:05');

        $this->assertTrue($range1->overlaps($range2));
        $this->assertTrue($range2->overlaps($range1));

        $range1 = $periodClass::create('2019-01-26 10:30:12', CarbonInterval::day(), 365, $periodClass::EXCLUDE_START_DATE);
        $range2 = $periodClass::create('2020-01-26 10:30:20', '2020-01-27 10:30:20');

        $this->assertFalse($range1->overlaps($range2));
        $this->assertFalse($range2->overlaps($range1));

        $range1 = $periodClass::create('2019-01-26 10:30:12', CarbonInterval::day(), 365);
        $range2 = $periodClass::create('2020-01-27 10:30:20', '2020-01-28 10:30:20');

        $this->assertFalse($range1->overlaps($range2));
        $this->assertFalse($range2->overlaps($range1));

        $range1 = $periodClass::create('2019-01-26 10:30:12', CarbonInterval::day(), INF);
        (function () {
            $this->dateInterval->subDays(1);
        })->call($range1);
        $range2 = $periodClass::create('2999-01-26 10:30:05', '2999-01-26 13:32:12');

        $this->assertFalse($range1->overlaps($range2));
        $this->assertFalse($range2->overlaps($range1));

        $range1 = $periodClass::create('2019-01-26 10:30:12', CarbonInterval::day(), INF);
        (function () {
            $this->dateInterval->subDays(1);
        })->call($range1);
        $range2 = $periodClass::create('2018-01-26 10:30:05', '2019-01-26 13:32:12');

        $this->assertTrue($range1->overlaps($range2));
        $this->assertTrue($range2->overlaps($range1));
    }

    public function testOverlapsErrorForNullEnd()
    {
        $periodClass = static::$periodClass;

        $this->expectExceptionObject(new UnreachableException(
            "Could not calculate period end without either explicit end or recurrences.\n".
            "If you're looking for a forever-period, use ->setRecurrences(INF).",
        ));

        $periodClass::create('2019-01-26 10:30:12', null)->overlaps('R2/2019-01-31T10:30:45Z/P2D');
    }

    public function testOverlapsErrorForMaxAttempts()
    {
        $periodClass = static::$periodClass;

        $this->expectExceptionObject(new UnreachableException(
            'Could not calculate period end after iterating 10000 times.',
        ));

        $period = $periodClass::create('2019-01-26 10:30:12', CarbonInterval::minute(), 98282828);
        $period->addFilter(function ($date) {
            return $date->minute % 2;
        });
        $period->overlaps('R2/2019-01-31T10:30:45Z/P2D');
    }

    public function testOverlapsCalculated()
    {
        $periodClass = static::$periodClass;

        $this->assertTrue($periodClass::create('2019-01-27', '2019-02-02')->overlaps('R2/2019-01-31T10:30:45Z/P2D'));
        $this->assertTrue($periodClass::create('2019-01-27', '2019-02-02')->overlaps('2018-12-31/2019-02-01'));
        $this->assertFalse($periodClass::create('2019-01-27', '2019-02-02')->overlaps('R6/2018-12-31/P3D'));
        $this->assertTrue($periodClass::create('2019-01-27', '2019-02-02')->overlaps('R6/2018-12-31/P6D'));
        $this->assertFalse($periodClass::create('R6/2018-12-31/P1D')->overlaps('R3/2019-01-05/PT3H'));
        $this->assertTrue($periodClass::create('R7/2018-12-31/P1D')->overlaps('R3/2019-01-05/PT3H'));
    }

    public function testOverlapsWithDatesCouple()
    {
        $periodClass = static::$periodClass;
        $carbonClass = $periodClass === CarbonPeriod::class ? Carbon::class : CarbonImmutable::class;

        $this->assertTrue($carbonClass::parse('2019-01-26')->toPeriod('2019-03-03')->overlaps('2019-02-15', '2019-04-01'));
        $this->assertTrue($carbonClass::parse('2019-02-15')->toPeriod('2019-04-01')->overlaps('2019-02-15', '2019-04-01'));
        $this->assertTrue($periodClass::create('2019-01-26', '2019-03-03')->overlaps('2019-02-15', '2019-04-01'));
        $this->assertTrue($periodClass::create('2019-01-26', '2019-03-03')->overlaps($carbonClass::parse('2019-02-15')->toPeriod('2019-04-01')));
        $this->assertTrue($carbonClass::parse('2019-01-26')->toPeriod('2019-03-03')->overlaps($carbonClass::parse('2019-02-15'), '2019-04-01'));
        $this->assertTrue(Carbon::parse('2019-02-15')->toPeriod('2019-04-01')->overlaps('2019-02-15', CarbonImmutable::parse('2019-04-01')));
        $this->assertTrue(CarbonImmutable::parse('2019-02-15')->toPeriod('2019-04-01')->overlaps('2019-02-15', Carbon::parse('2019-04-01')));
        $this->assertTrue($periodClass::create('2019-01-26', '2019-03-03')->overlaps(new DateTime('2019-02-15'), new DateTime('2019-04-01')));

        $this->assertFalse($carbonClass::parse('2018-01-26')->toPeriod('2018-03-03')->overlaps('2019-02-15', '2019-04-01'));
        $this->assertFalse($carbonClass::parse('2018-02-15')->toPeriod('2018-04-01')->overlaps('2019-02-15', '2019-04-01'));
        $this->assertFalse($periodClass::create('2018-01-26', '2018-02-13')->overlaps('2019-02-15', '2019-04-01'));
        $this->assertFalse($periodClass::create('2018-01-26', '2018-02-13')->overlaps($carbonClass::parse('2019-02-15')->toPeriod('2019-04-01')));
        $this->assertFalse($carbonClass::parse('2018-01-26')->toPeriod('2018-03-03')->overlaps($carbonClass::parse('2019-02-15'), '2019-04-01'));
        $this->assertFalse(Carbon::parse('2018-02-15')->toPeriod('2018-04-01')->overlaps('2019-02-15', CarbonImmutable::parse('2019-04-01')));
        $this->assertFalse($periodClass::create('2018-01-26', '2018-02-13')->overlaps(new DateTime('2019-02-15'), new DateTime('2019-04-01')));
    }

    public function testIsStarted()
    {
        $periodClass = static::$periodClass;

        Carbon::setTestNow('2019-08-03 11:47:00');

        $this->assertFalse($periodClass::create('2019-08-03 11:47:01', '2019-08-03 12:00:00')->isStarted());
        $this->assertFalse($periodClass::create('2020-01-01', '2020-07-01')->isStarted());
        $this->assertTrue($periodClass::create('2019-08-03 01:00:00', '2019-08-03 09:00:00')->isStarted());
        $this->assertTrue($periodClass::create('2019-01-01', '2019-07-01')->isStarted());
        $this->assertTrue($periodClass::create('2019-08-01', '2019-08-15')->isStarted());
        $this->assertTrue($periodClass::create('2019-08-03 11:47:00', '2019-08-15 11:47:00')->isStarted());
    }

    public function testIsEnded()
    {
        $periodClass = static::$periodClass;

        Carbon::setTestNow('2019-08-03 11:47:00');

        $this->assertFalse($periodClass::create('2019-08-03 11:47:01', '2019-08-03 12:00:00')->isEnded());
        $this->assertFalse($periodClass::create('2020-01-01', '2020-07-01')->isEnded());
        $this->assertFalse($periodClass::create('2019-08-01', '2019-08-15')->isEnded());
        $this->assertFalse($periodClass::create('2019-08-03 11:47:00', '2019-08-15 11:47:00')->isEnded());
        $this->assertTrue($periodClass::create('2019-08-03 01:00:00', '2019-08-03 09:00:00')->isEnded());
        $this->assertTrue($periodClass::create('2019-01-01', '2019-07-01')->isEnded());
        $this->assertTrue($periodClass::create('2019-08-02 11:47:00', '2019-08-03 11:47:00')->isEnded());
    }

    public function testIsInProgress()
    {
        $periodClass = static::$periodClass;

        Carbon::setTestNow('2019-08-03 11:47:00');

        $this->assertFalse($periodClass::create('2019-08-03 11:47:01', '2019-08-03 12:00:00')->isInProgress());
        $this->assertFalse($periodClass::create('2020-01-01', '2020-07-01')->isInProgress());
        $this->assertFalse($periodClass::create('2019-08-03 01:00:00', '2019-08-03 09:00:00')->isInProgress());
        $this->assertFalse($periodClass::create('2019-01-01', '2019-07-01')->isInProgress());
        $this->assertFalse($periodClass::create('2019-08-02 11:47:00', '2019-08-03 11:47:00')->isInProgress());
        $this->assertTrue($periodClass::create('2019-08-03 11:47:00', '2019-08-15 11:47:00')->isInProgress());
        $this->assertTrue($periodClass::create('2019-08-01', '2019-08-15')->isInProgress());
    }

    public function testIsset()
    {
        $periodClass = static::$periodClass;

        $this->assertTrue(isset($periodClass::create('2019-08-01', '2019-08-15')->startDate));
        $this->assertFalse(isset($periodClass::create('2019-08-01', '2019-08-15')->middleDate));
    }

    public function testMagicGet()
    {
        $periodClass = static::$periodClass;

        $this->assertSame(
            '2019-08-01',
            $periodClass::create('2019-08-01', '2019-08-15')->startDate->format('Y-m-d'),
        );
        $this->assertSame(
            'en',
            $periodClass::create('2019-08-01', '2019-08-15')->locale,
        );
        $this->assertSame(
            'fi',
            $periodClass::create('2019-08-01', '2019-08-15')->locale('fi')->locale,
        );
    }

    public function testGet()
    {
        $periodClass = static::$periodClass;

        $this->assertSame(
            '2019-08-01',
            $periodClass::create('2019-08-01', '2019-08-15')->get('start')->format('Y-m-d'),
        );
    }

    public function testUnknownGetter()
    {
        $periodClass = static::$periodClass;
        $this->expectExceptionObject(new UnknownGetterException('middle'));

        $periodClass::create('2019-08-01', '2019-08-15')->get('middle');
    }

    public function testGetEnd()
    {
        $periodClass = static::$periodClass;
        $period = $periodClass::create('2024-09-01/3 days/2024-09-30');

        $this->assertSame('2024-09-30 00:00:00', $period->end->format('Y-m-d H:i:s'));
        $this->assertSame('2024-09-30 00:00:00', $period->endDate->format('Y-m-d H:i:s'));
    }

    public function testGetCurrent()
    {
        $periodClass = static::$periodClass;
        $period = $periodClass::create('2024-09-01/3 days/2024-09-30');

        $this->assertSame('2024-09-01 00:00:00', $period->get('current')->format('Y-m-d H:i:s'));

        $period->next();

        $this->assertSame('2024-09-04 00:00:00', $period->get('current')->format('Y-m-d H:i:s'));
    }

    public function testGetInclude()
    {
        $periodClass = static::$periodClass;
        $period = $periodClass::create('2024-09-01/3 days/2024-09-30');

        $this->assertTrue($period->includeStartDate);
        $this->assertTrue($period->includeEndDate);

        $period = $periodClass::create('2024-09-01/3 days/2024-09-30')->excludeStartDate()->excludeEndDate();

        $this->assertFalse($period->includeStartDate);
        $this->assertFalse($period->includeEndDate);
    }
}
