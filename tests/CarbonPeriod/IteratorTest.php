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
use Carbon\CarbonInterval;
use Carbon\CarbonPeriod;
use Tests\AbstractTestCase;
use Tests\CarbonPeriod\Fixtures\CarbonPeriodFactory;

class IteratorTest extends AbstractTestCase
{
    protected $iterationLimit = 100;

    public function testKeyAndCurrentAreCorrectlyInstantiated(): void
    {
        $period = CarbonPeriodFactory::withEvenDaysFilter();

        $this->assertSame(0, $period->key());
        $this->assertInstanceOfCarbon($period->current());
        $this->assertSame('2012-07-04 00:00:00', $period->current()->format('Y-m-d H:i:s'));
        $this->assertTrue($period->valid());
    }

    public function testValidIsCorrectlyInstantiated(): void
    {
        $period = CarbonPeriodFactory::withEvenDaysFilter();

        $this->assertTrue($period->valid());
    }

    public function testCurrentIsAlwaysCarbonInstance(): void
    {
        $period = CarbonPeriodFactory::withEvenDaysFilter();

        foreach ($period as $key => $current) {
            $this->assertInstanceOfCarbon($current);
            $this->assertEquals($current, $period->current());
            $this->assertEquals($current, $period->current);
        }
    }

    public function testKeysAreSequential(): void
    {
        $keys = [];

        $period = CarbonPeriodFactory::withEvenDaysFilter();

        foreach ($period as $key => $current) {
            $this->assertIsInt($keys[] = $key);
            $this->assertSame($key, $period->key());
        }

        $this->assertSame(array_keys($keys), $keys);
    }

    public function testElementsInLoopAreAlwaysValid(): void
    {
        $period = CarbonPeriodFactory::withEvenDaysFilter();

        foreach ($period as $key => $current) {
            $this->assertTrue($period->valid());
        }
    }

    public function testKeyAndCurrentAreCorrectlyIterated(): void
    {
        $period = CarbonPeriodFactory::withEvenDaysFilter();

        $period->next();

        $this->assertSame(1, $period->key());
        $this->assertSame('2012-07-10 00:00:00', $period->current()->format('Y-m-d H:i:s'));
        $this->assertTrue($period->valid());
    }

    public function testKeyAndCurrentAreCorrectlyRewound(): void
    {
        $period = CarbonPeriodFactory::withEvenDaysFilter();

        $period->next();
        $period->rewind();

        $this->assertSame(0, $period->key());
        $this->assertSame('2012-07-04 00:00:00', $period->current()->format('Y-m-d H:i:s'));
        $this->assertTrue($period->valid());
    }

    public function testKeyAndCurrentAreNullAfterIteration(): void
    {
        $period = CarbonPeriodFactory::withEvenDaysFilter();

        foreach ($period as $key => $current) {
            //
        }

        $this->assertNull($period->key());
        $this->assertNull($period->current());
        $this->assertFalse($period->valid());
    }

    /**
     * @dataProvider provideIterateBackwardsArguments
     */
    public function testIterateBackwards($arguments, $expected): void
    {
        $period = CarbonPeriod::create(...$arguments);

        $interval = new CarbonInterval('P3D');
        $interval->invert = 1;

        $period->setDateInterval($interval);

        $this->assertSame(
            $this->standardizeDates($expected),
            $this->standardizeDates($period)
        );
    }

    public function provideIterateBackwardsArguments(): array
    {
        return [
            [
                ['2015-10-15', '2015-10-06'],
                ['2015-10-15', '2015-10-12', '2015-10-09', '2015-10-06'],
            ],
            [
                ['2015-10-15', '2015-10-06', CarbonPeriod::EXCLUDE_START_DATE],
                ['2015-10-12', '2015-10-09', '2015-10-06'],
            ],
            [
                ['2015-10-15', '2015-10-06', CarbonPeriod::EXCLUDE_END_DATE],
                ['2015-10-15', '2015-10-12', '2015-10-09'],
            ],
            [
                ['2015-10-15', '2015-10-06', CarbonPeriod::EXCLUDE_START_DATE | CarbonPeriod::EXCLUDE_END_DATE],
                ['2015-10-12', '2015-10-09'],
            ],
            [
                ['2015-10-15', 3],
                ['2015-10-15', '2015-10-12', '2015-10-09'],
            ],
        ];
    }

    public function testChangingParametersShouldNotCauseInfiniteLoop(): void
    {
        $period = CarbonPeriod::create()
            ->setStartDate($start = '2012-07-01')
            ->setEndDate($end = '2012-07-20')
            ->setDateInterval($interval = 'P1D')
            ->setRecurrences($recurrences = 10)
            ->setOptions($options = CarbonPeriod::EXCLUDE_START_DATE | CarbonPeriod::EXCLUDE_END_DATE)
            ->addFilter($filter = function () {
                return true;
            });

        $counter = 0;

        foreach ($period as $current) {
            if (++$counter >= $this->iterationLimit) {
                break;
            }

            $period->removeFilter($filter)
                ->prependFilter($filter)
                ->setFilters([])
                ->setStartDate($start)
                ->setEndDate($end)
                ->invertDateInterval()
                ->setDateInterval($interval)
                ->setRecurrences($recurrences)
                ->setOptions($options)
                ->resetFilters()
                ->addFilter($filter);
        }

        $this->assertLessThan($this->iterationLimit, $counter, 'Changing parameters during the iteration caused an infinite loop.');
    }

    public function testChangeEndDateDuringIteration(): void
    {
        $period = CarbonPeriodFactory::withEvenDaysFilter();

        $results = [];

        foreach ($period as $key => $current) {
            $results[] = sprintf('%s => %s', $key, $current->toDateString());

            if ($current->toDateString() === '2012-07-16') {
                $period->setEndDate($current);

                // Note: Current is no longer valid, because it is now equal to end, which is excluded.
                $this->assertNull($period->key());
                $this->assertNull($period->current());
                $this->assertFalse($period->valid());
            }

            if (\count($results) >= $this->iterationLimit) {
                $this->fail('Infinite loop detected when traversing the period.');
            }
        }

        $this->assertSame(
            ['0 => 2012-07-04', '1 => 2012-07-10', '2 => 2012-07-16'],
            $results
        );
    }

    public function testKeepIncreasingRecurrencesDuringIteration(): void
    {
        $period = new CarbonPeriod('2012-07-01', $recurrences = 1);

        $results = [];

        foreach ($period as $key => $current) {
            $results[] = sprintf('%s => %s', $key, $current->toDateString());

            if ($recurrences < 4) {
                $period->setRecurrences(++$recurrences);

                // Note: Current is still valid, because we simply extended the period.
                $this->assertSame($key, $period->key());
                $this->assertEquals($current, $period->current());
                $this->assertTrue($period->valid());
            }

            if (\count($results) >= $this->iterationLimit) {
                $this->fail('Infinite loop detected when traversing the period.');
            }
        }

        $this->assertSame(
            ['0 => 2012-07-01', '1 => 2012-07-02', '2 => 2012-07-03', '3 => 2012-07-04'],
            $results
        );
    }

    public function testChangeStartDateDuringIteration(): void
    {
        $period = new CarbonPeriod('2012-07-01', '2012-07-04');

        $results = [];

        $newStart = new Carbon('2012-07-03');

        foreach ($period as $key => $current) {
            $results[] = sprintf('%s => %s', $key, $current->toDateString());

            if ($current < $newStart) {
                $period->setStartDate($newStart);

                // Note: Current is still valid, because start date is used only for initialization.
                $this->assertEquals($key, $period->key());
                $this->assertEquals($current, $period->current());
                $this->assertTrue($period->valid());
            }

            if (\count($results) >= $this->iterationLimit) {
                $this->fail('Infinite loop detected when traversing the period.');
            }
        }

        $this->assertSame(
            // Note: Results are not affected, because start date is used only for initialization.
            ['0 => 2012-07-01', '1 => 2012-07-02', '2 => 2012-07-03', '3 => 2012-07-04'],
            $results
        );
    }

    public function testChangeDateIntervalDuringIteration(): void
    {
        $period = new CarbonPeriod('2012-07-01', 3);

        $results = [];

        foreach ($period as $key => $current) {
            $results[] = sprintf('%s => %s', $key, $current->toDateString());

            $period->setDateInterval('P3D');

            // Note: Current is still valid, because changed interval changes only subsequent items.
            $this->assertSame($key, $period->key());
            $this->assertEquals($current, $period->current());
            $this->assertTrue($period->valid());

            if (\count($results) >= $this->iterationLimit) {
                $this->fail('Infinite loop detected when traversing the period.');
            }
        }

        $this->assertSame(
            ['0 => 2012-07-01', '1 => 2012-07-04', '2 => 2012-07-07'],
            $results
        );
    }

    public function testValidateOncePerIteration(): void
    {
        $period = CarbonPeriodFactory::withCounter($counter);

        $period->key();
        $period->current();
        $period->valid();
        $this->assertSame(1, $counter);

        $period->next();
        $this->assertSame(2, $counter);

        $period->key();
        $period->current();
        $period->valid();
        $this->assertSame(2, $counter);
    }

    public function testInvalidateCurrentAfterChangingParameters(): void
    {
        $period = CarbonPeriod::create('2012-10-01');

        $this->assertInstanceOfCarbon($period->current());

        $period->addFilter(CarbonPeriod::END_ITERATION);

        $this->assertNull($period->current());
    }

    public function testTraversePeriodDynamically(): void
    {
        $period = CarbonPeriodFactory::withEvenDaysFilter();

        $results = [];

        while ($current = $period->current()) {
            $results[] = $current;

            $period->next();

            if (\count($results) >= $this->iterationLimit) {
                $this->fail('Infinite loop detected when traversing the period.');
            }
        }

        $this->assertSame(
            $this->standardizeDates(['2012-07-04', '2012-07-10', '2012-07-16']),
            $this->standardizeDates($results)
        );
    }

    public function testExtendCompletedIteration(): void
    {
        $period = CarbonPeriod::create('2018-10-10', '2018-10-11');

        $results = [];

        while ($period->valid()) {
            $results[] = $period->current();

            $period->next();
        }

        $period->setEndDate('2018-10-13');

        while ($period->valid()) {
            $results[] = $period->current();

            $period->next();
        }

        $this->assertSame(
            $this->standardizeDates(['2018-10-10', '2018-10-11', '2018-10-12', '2018-10-13']),
            $this->standardizeDates($results)
        );
    }

    public function testRevalidateCurrentAfterChangeOfParameters(): void
    {
        $period = CarbonPeriod::create()->setStartDate($start = new Carbon('2018-10-28'));
        $this->assertEquals($start, $period->current());
        $this->assertNotSame($start, $period->current());

        $period->addFilter($excludeStart = function ($date) use ($start) {
            return $date != $start;
        });
        $this->assertNull($period->current());

        $period->removeFilter($excludeStart);
        $this->assertEquals($start, $period->current());
        $this->assertNotSame($start, $period->current());
    }

    public function testRevalidateCurrentAfterEndOfIteration(): void
    {
        $period = CarbonPeriod::create()->setStartDate($start = new Carbon('2018-10-28'));
        $this->assertEquals($start, $period->current());
        $this->assertNotSame($start, $period->current());

        $period->addFilter(CarbonPeriod::END_ITERATION);
        $this->assertNull($period->current());

        $period->removeFilter(CarbonPeriod::END_ITERATION);
        $this->assertEquals($start, $period->current());
        $this->assertNotSame($start, $period->current());
    }

    public function testChangeStartDateBeforeIteration(): void
    {
        $period = CarbonPeriod::create(new Carbon('2018-10-05'), 3);

        $period->setStartDate(new Carbon('2018-10-13'));
        $period->toggleOptions(CarbonPeriod::EXCLUDE_START_DATE, true);

        $this->assertEquals(new Carbon('2018-10-14'), $period->current());
    }

    public function testChangeStartDateAfterStartedIteration(): void
    {
        $period = CarbonPeriod::create(new Carbon('2018-10-05'), 3);

        $current = $period->current();

        $period->toggleOptions(CarbonPeriod::EXCLUDE_START_DATE, true);
        $period->setStartDate(new Carbon('2018-10-13'));

        $this->assertEquals($current, $period->current());
    }

    public function testInvertDateIntervalDuringIteration(): void
    {
        $period = new CarbonPeriod('2018-04-11', 5);

        $results = [];

        foreach ($period as $key => $date) {
            $results[] = $date;

            if ($key === 2) {
                $period->invertDateInterval();
            }
        }

        $this->assertSame(
            $this->standardizeDates(['2018-04-11', '2018-04-12', '2018-04-13', '2018-04-12', '2018-04-11']),
            $this->standardizeDates($results)
        );
    }

    public function testManualIteration(): void
    {
        $period = CarbonPeriodFactory::withStackFilter();
        $period->rewind();
        $str = '';
        while ($period->valid()) {
            if ($period->key()) {
                $str .= ', ';
            }
            $str .= $period->current()->format('m-d');
            $period->next();
        }

        $this->assertSame('01-01, 01-03', $str);
    }

    public function testSkip(): void
    {
        $period = CarbonPeriod::create('2018-05-30', '2018-07-13');
        $output = [];

        foreach ($period as $day) {
            /* @var Carbon $day */
            $output[] = $day->format('Y-m-d');

            if ($day->isSunday()) {
                $this->assertTrue($period->skip(7));
                $output[] = '...';
            }
        }

        $this->assertSame([
            '2018-05-30',
            '2018-05-31',
            '2018-06-01',
            '2018-06-02',
            '2018-06-03',
            '...',
            '2018-06-11',
            '2018-06-12',
            '2018-06-13',
            '2018-06-14',
            '2018-06-15',
            '2018-06-16',
            '2018-06-17',
            '...',
            '2018-06-25',
            '2018-06-26',
            '2018-06-27',
            '2018-06-28',
            '2018-06-29',
            '2018-06-30',
            '2018-07-01',
            '...',
            '2018-07-09',
            '2018-07-10',
            '2018-07-11',
            '2018-07-12',
            '2018-07-13',
        ], $output);

        $this->assertFalse($period->skip());
        $this->assertFalse($period->skip(7));
    }

    public function testLocale(): void
    {
        /** @var CarbonPeriod $period */
        $period = CarbonPeriodFactory::withStackFilter()->locale('de');
        $str = '';

        foreach ($period as $key => $date) {
            if ($key) {
                $str .= ', ';
            }

            $str .= $date->isoFormat('MMMM dddd');
        }

        $this->assertSame('Januar Montag, Januar Mittwoch', $str);
    }

    public function testTimezone(): void
    {
        /** @var CarbonPeriod $period */
        $period = CarbonPeriodFactory::withStackFilter()->shiftTimezone('America/Toronto');
        $str = null;

        foreach ($period as $key => $date) {
            $str = $date->format('H e');

            break;
        }

        $this->assertSame('00 America/Toronto', $str);
    }
}
