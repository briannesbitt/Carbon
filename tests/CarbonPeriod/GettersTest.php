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
use Carbon\CarbonPeriod;
use DateTime;
use Tests\AbstractTestCase;
use Tests\CarbonPeriod\Fixtures\CarbonPeriodFactory;

class GettersTest extends AbstractTestCase
{
    public function testGetStartDate()
    {
        $period = CarbonPeriodFactory::withStartIntervalEnd();

        $date = $period->getStartDate();

        $this->assertInstanceOfCarbon($date);

        $this->assertSame('2012-07-01 17:30:00', $date->format('Y-m-d H:i:s'));
    }

    public function testGetEndDate()
    {
        $period = CarbonPeriodFactory::withStartIntervalEnd();

        $date = $period->getEndDate();

        $this->assertInstanceOfCarbon($date);

        $this->assertSame('2012-07-15 11:15:00', $date->format('Y-m-d H:i:s'));
    }

    public function testGetDateInterval()
    {
        $period = CarbonPeriodFactory::withStartIntervalEnd();

        $interval = $period->getDateInterval();

        $this->assertInstanceOfCarbonInterval($interval);

        $this->assertSame('P3DT5H', $interval->spec());
    }

    public function testGetRecurrences()
    {
        $recurrences = CarbonPeriod::create(new DateTime, 5)->getRecurrences();

        $this->assertSame(5, $recurrences);
    }

    public function testGetDefaultDateInterval()
    {
        $period = CarbonPeriod::create(Carbon::parse('2015-09-30'), Carbon::parse('2015-10-03'));

        $this->assertInstanceOfCarbonInterval($period->getDateInterval());

        $this->assertSame('P1D', $period->getDateInterval()->spec());
    }

    public function testModifyStartDate()
    {
        $period = CarbonPeriodFactory::withStartIntervalEnd();

        $period->getStartDate()->subDays(3);

        $this->assertSame('2012-07-01', $period->getStartDate()->format('Y-m-d'));
    }

    public function testModifyEndDate()
    {
        $period = CarbonPeriodFactory::withStartIntervalEnd();

        $period->getEndDate()->addDays(3);

        $this->assertSame('2012-07-15', $period->getEndDate()->format('Y-m-d'));
    }

    public function testModifyDateInterval()
    {
        $period = CarbonPeriodFactory::withStartIntervalEnd();

        $period->getDateInterval()->days(5)->hours(0);

        $this->assertSame('P3DT5H', $period->getDateInterval()->spec());
    }

    public function testGetOptions()
    {
        $period = new CarbonPeriod;

        $this->assertSame(0, $period->getOptions());

        $period = new CarbonPeriod(new DateTime, new DateTime, $options = CarbonPeriod::EXCLUDE_START_DATE | CarbonPeriod::EXCLUDE_END_DATE);

        $this->assertSame($options, $period->getOptions());
    }

    public function testOverlaps()
    {
        $range1 = CarbonPeriod::create('2019-01-26', '2019-03-03');
        $range2 = CarbonPeriod::create('2019-02-15', '2019-04-01');

        $this->assertTrue($range1->overlaps($range2));
        $this->assertTrue($range2->overlaps($range1));

        $range1 = CarbonPeriod::create('2019-01-26', '2019-02-13');
        $range2 = CarbonPeriod::create('2019-02-15', '2019-04-01');

        $this->assertFalse($range1->overlaps($range2));
        $this->assertFalse($range2->overlaps($range1));

        $range1 = CarbonPeriod::create('2019-01-26', '2019-02-15');
        $range2 = CarbonPeriod::create('2019-02-15', '2019-04-01');

        $this->assertFalse($range1->overlaps($range2));
        $this->assertFalse($range2->overlaps($range1));

        $range1 = CarbonPeriod::create('2019-01-26', '2019-02-15 00:00:01');
        $range2 = CarbonPeriod::create('2019-02-15', '2019-04-01');

        $this->assertTrue($range1->overlaps($range2));
        $this->assertTrue($range2->overlaps($range1));

        $range1 = CarbonPeriod::create('2019-01-26', '2019-02-15 00:00:01');
        $range2 = CarbonPeriod::create('2019-02-15 00:00:01', '2019-04-01');

        $this->assertFalse($range1->overlaps($range2));
        $this->assertFalse($range2->overlaps($range1));

        $range1 = CarbonPeriod::create('2019-01-26 10:30:12', '2019-01-26 13:30:12');
        $range2 = CarbonPeriod::create('2019-01-26 10:30:05', '2019-01-26 13:32:12');

        $this->assertTrue($range1->overlaps($range2));
        $this->assertTrue($range2->overlaps($range1));
    }

    public function testOverlapsCalculated()
    {
        $this->assertTrue(CarbonPeriod::create('2019-01-27', '2019-02-02')->overlaps('R2/2019-01-31T10:30:45Z/P2D'));
        $this->assertTrue(CarbonPeriod::create('2019-01-27', '2019-02-02')->overlaps('2018-12-31/2019-02-01'));
        $this->assertFalse(CarbonPeriod::create('2019-01-27', '2019-02-02')->overlaps('R6/2018-12-31/P3D'));
        $this->assertTrue(CarbonPeriod::create('2019-01-27', '2019-02-02')->overlaps('R6/2018-12-31/P6D'));
        $this->assertFalse(CarbonPeriod::create('R6/2018-12-31/P1D')->overlaps('R3/2019-01-05/PT3H'));
        $this->assertTrue(CarbonPeriod::create('R7/2018-12-31/P1D')->overlaps('R3/2019-01-05/PT3H'));
    }

    public function testOverlapsWithDatesCouple()
    {
        $this->assertTrue(Carbon::parse('2019-01-26')->toPeriod('2019-03-03')->overlaps('2019-02-15', '2019-04-01'));
        $this->assertTrue(Carbon::parse('2019-02-15')->toPeriod('2019-04-01')->overlaps('2019-02-15', '2019-04-01'));
        $this->assertTrue(CarbonPeriod::create('2019-01-26', '2019-03-03')->overlaps('2019-02-15', '2019-04-01'));
        $this->assertTrue(CarbonPeriod::create('2019-01-26', '2019-03-03')->overlaps(Carbon::parse('2019-02-15')->toPeriod('2019-04-01')));
        $this->assertTrue(Carbon::parse('2019-01-26')->toPeriod('2019-03-03')->overlaps(Carbon::parse('2019-02-15'), '2019-04-01'));
        $this->assertTrue(Carbon::parse('2019-02-15')->toPeriod('2019-04-01')->overlaps('2019-02-15', CarbonImmutable::parse('2019-04-01')));
        $this->assertTrue(CarbonPeriod::create('2019-01-26', '2019-03-03')->overlaps(new DateTime('2019-02-15'), new DateTime('2019-04-01')));

        $this->assertFalse(Carbon::parse('2018-01-26')->toPeriod('2018-03-03')->overlaps('2019-02-15', '2019-04-01'));
        $this->assertFalse(Carbon::parse('2018-02-15')->toPeriod('2018-04-01')->overlaps('2019-02-15', '2019-04-01'));
        $this->assertFalse(CarbonPeriod::create('2018-01-26', '2018-02-13')->overlaps('2019-02-15', '2019-04-01'));
        $this->assertFalse(CarbonPeriod::create('2018-01-26', '2018-02-13')->overlaps(Carbon::parse('2019-02-15')->toPeriod('2019-04-01')));
        $this->assertFalse(Carbon::parse('2018-01-26')->toPeriod('2018-03-03')->overlaps(Carbon::parse('2019-02-15'), '2019-04-01'));
        $this->assertFalse(Carbon::parse('2018-02-15')->toPeriod('2018-04-01')->overlaps('2019-02-15', CarbonImmutable::parse('2019-04-01')));
        $this->assertFalse(CarbonPeriod::create('2018-01-26', '2018-02-13')->overlaps(new DateTime('2019-02-15'), new DateTime('2019-04-01')));
    }

    public function testIsStarted()
    {
        Carbon::setTestNow('2019-08-03 11:47:00');

        $this->assertFalse(CarbonPeriod::create('2019-08-03 11:47:01', '2019-08-03 12:00:00')->isStarted());
        $this->assertFalse(CarbonPeriod::create('2020-01-01', '2020-07-01')->isStarted());
        $this->assertTrue(CarbonPeriod::create('2019-08-03 01:00:00', '2019-08-03 09:00:00')->isStarted());
        $this->assertTrue(CarbonPeriod::create('2019-01-01', '2019-07-01')->isStarted());
        $this->assertTrue(CarbonPeriod::create('2019-08-01', '2019-08-15')->isStarted());
        $this->assertTrue(CarbonPeriod::create('2019-08-03 11:47:00', '2019-08-15 11:47:00')->isStarted());
    }

    public function testIsEnded()
    {
        Carbon::setTestNow('2019-08-03 11:47:00');

        $this->assertFalse(CarbonPeriod::create('2019-08-03 11:47:01', '2019-08-03 12:00:00')->isEnded());
        $this->assertFalse(CarbonPeriod::create('2020-01-01', '2020-07-01')->isEnded());
        $this->assertFalse(CarbonPeriod::create('2019-08-01', '2019-08-15')->isEnded());
        $this->assertFalse(CarbonPeriod::create('2019-08-03 11:47:00', '2019-08-15 11:47:00')->isEnded());
        $this->assertTrue(CarbonPeriod::create('2019-08-03 01:00:00', '2019-08-03 09:00:00')->isEnded());
        $this->assertTrue(CarbonPeriod::create('2019-01-01', '2019-07-01')->isEnded());
        $this->assertTrue(CarbonPeriod::create('2019-08-02 11:47:00', '2019-08-03 11:47:00')->isEnded());
    }

    public function testIsInProgress()
    {
        Carbon::setTestNow('2019-08-03 11:47:00');

        $this->assertFalse(CarbonPeriod::create('2019-08-03 11:47:01', '2019-08-03 12:00:00')->isInProgress());
        $this->assertFalse(CarbonPeriod::create('2020-01-01', '2020-07-01')->isInProgress());
        $this->assertFalse(CarbonPeriod::create('2019-08-03 01:00:00', '2019-08-03 09:00:00')->isInProgress());
        $this->assertFalse(CarbonPeriod::create('2019-01-01', '2019-07-01')->isInProgress());
        $this->assertFalse(CarbonPeriod::create('2019-08-02 11:47:00', '2019-08-03 11:47:00')->isInProgress());
        $this->assertTrue(CarbonPeriod::create('2019-08-03 11:47:00', '2019-08-15 11:47:00')->isInProgress());
        $this->assertTrue(CarbonPeriod::create('2019-08-01', '2019-08-15')->isInProgress());
    }
}
