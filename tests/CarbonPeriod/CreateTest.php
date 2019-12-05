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
use Carbon\CarbonImmutable;
use Carbon\CarbonInterval;
use Carbon\CarbonPeriod;
use Carbon\Exceptions\NotAPeriodException;
use DateInterval;
use DatePeriod;
use DateTime;
use InvalidArgumentException;
use Tests\AbstractTestCase;

class CreateTest extends AbstractTestCase
{
    /**
     * @dataProvider provideIso8601String
     */
    public function testCreateFromIso8601String($arguments, $expected)
    {
        [$iso, $options] = array_pad($arguments, 2, null);

        $period = CarbonPeriod::create($iso, $options);

        $this->assertSame(
            $this->standardizeDates($expected),
            $this->standardizeDates($period)
        );
    }

    public function provideIso8601String()
    {
        return [
            [
                ['R4/2012-07-01T00:00:00/P7D'],
                ['2012-07-01', '2012-07-08', '2012-07-15', '2012-07-22'],
            ],
            [
                ['R4/2012-07-01T00:00:00/P7D', CarbonPeriod::EXCLUDE_START_DATE],
                ['2012-07-08', '2012-07-15', '2012-07-22', '2012-07-29'],
            ],
            [
                ['2012-07-01/P2D/2012-07-07'],
                ['2012-07-01', '2012-07-03', '2012-07-05', '2012-07-07'],
            ],
            [
                ['2012-07-01/2012-07-04', CarbonPeriod::EXCLUDE_END_DATE],
                ['2012-07-01', '2012-07-02', '2012-07-03'],
            ],
            [
                ['R2/2012-07-01T10:30:45Z/P2D'],
                ['2012-07-01 10:30:45 UTC', '2012-07-03 10:30:45 UTC'],
            ],
        ];
    }

    public function testCreateFromIso8601StringWithUnboundedRecurrences()
    {
        $period = CarbonPeriod::create('R/2012-07-01T00:00:00/P7D');

        $this->assertSame('2012-07-01', $period->getStartDate()->toDateString());
        $this->assertSame('P7D', $period->getDateInterval()->spec());
        $this->assertNull($period->getEndDate());
        $this->assertNull($period->getRecurrences());
    }

    /**
     * @dataProvider providePartialIso8601String
     */
    public function testCreateFromPartialIso8601String($iso, $from, $to)
    {
        $period = CarbonPeriod::create($iso);

        $this->assertSame(
            $this->standardizeDates([$from, $to]),
            $this->standardizeDates([$period->getStartDate(), $period->getEndDate()])
        );
    }

    public function providePartialIso8601String()
    {
        return [
            ['2008-02-15/03-14', '2008-02-15', '2008-03-14'],
            ['2007-12-14T13:30/15:30', '2007-12-14 13:30', '2007-12-14 15:30'],
        ];
    }

    /**
     * @dataProvider provideInvalidIso8601String
     */
    public function testCreateFromInvalidIso8601String($iso)
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessageRegExp(
            '/(Invalid ISO 8601 specification:|Unknown or bad format)/'
        );

        CarbonPeriod::create($iso);
    }

    public function provideInvalidIso8601String()
    {
        return [
            ['R2/R4'],
            ['2008-02-15/2008-02-16/2008-02-17'],
            ['P1D/2008-02-15/P2D'],
            ['2008-02-15/R5'],
            ['P2D/R2'],
            ['/'],
        ];
    }

    /**
     * @dataProvider provideStartDateAndEndDate
     */
    public function testCreateFromStartDateAndEndDate($arguments, $expected)
    {
        [$start, $end, $options] = array_pad($arguments, 3, null);

        $start = Carbon::parse($start);
        $end = Carbon::parse($end);

        $period = CarbonPeriod::create($start, $end, $options);

        $this->assertSame(
            $this->standardizeDates($expected),
            $this->standardizeDates($period)
        );
    }

    public function provideStartDateAndEndDate()
    {
        return [
            [
                ['2015-09-30', '2015-10-03'],
                ['2015-09-30', '2015-10-01', '2015-10-02', '2015-10-03'],
            ],
            [
                ['2015-09-30', '2015-10-03', CarbonPeriod::EXCLUDE_START_DATE],
                ['2015-10-01', '2015-10-02', '2015-10-03'],
            ],
            [
                ['2015-09-30', '2015-10-03', CarbonPeriod::EXCLUDE_END_DATE],
                ['2015-09-30', '2015-10-01', '2015-10-02'],
            ],
            [
                ['2015-09-30', '2015-10-03', CarbonPeriod::EXCLUDE_START_DATE | CarbonPeriod::EXCLUDE_END_DATE],
                ['2015-10-01', '2015-10-02'],
            ],
            [
                ['2015-10-02', '2015-10-03', CarbonPeriod::EXCLUDE_START_DATE | CarbonPeriod::EXCLUDE_END_DATE],
                [],
            ],
            [
                ['2015-10-02', '2015-10-02'],
                ['2015-10-02'],
            ],
            [
                ['2015-10-02', '2015-10-02', CarbonPeriod::EXCLUDE_START_DATE],
                [],
            ],
            [
                ['2015-10-02', '2015-10-02', CarbonPeriod::EXCLUDE_END_DATE],
                [],
            ],
        ];
    }

    /**
     * @dataProvider provideStartDateAndIntervalAndEndDate
     */
    public function testCreateFromStartDateAndIntervalAndEndDate($arguments, $expected)
    {
        [$start, $interval, $end, $options] = array_pad($arguments, 4, null);

        $start = Carbon::parse($start);
        $interval = CarbonInterval::create($interval);
        $end = Carbon::parse($end);

        $period = CarbonPeriod::create($start, $interval, $end, $options);

        $this->assertSame(
            $this->standardizeDates($expected),
            $this->standardizeDates($period)
        );
    }

    public function provideStartDateAndIntervalAndEndDate()
    {
        return [
            [
                ['2018-04-21', 'P3D', '2018-04-26'],
                ['2018-04-21', '2018-04-24'],
            ],
            [
                ['2018-04-21 16:15', 'PT15M', '2018-04-21 16:59:59'],
                ['2018-04-21 16:15', '2018-04-21 16:30', '2018-04-21 16:45'],
            ],
            [
                ['2018-04-21 16:15', 'PT15M', '2018-04-21 17:00'],
                ['2018-04-21 16:15', '2018-04-21 16:30', '2018-04-21 16:45', '2018-04-21 17:00'],
            ],
            [
                ['2018-04-21 17:00', 'PT45S', '2018-04-21 17:02', CarbonPeriod::EXCLUDE_START_DATE],
                ['2018-04-21 17:00:45', '2018-04-21 17:01:30'],
            ],
            [
                ['2017-12-31 22:00', 'PT2H', '2018-01-01 4:00', CarbonPeriod::EXCLUDE_END_DATE],
                ['2017-12-31 22:00', '2018-01-01 0:00', '2018-01-01 2:00'],
            ],
            [
                ['2017-12-31 23:59', 'PT30S', '2018-01-01 0:01', CarbonPeriod::EXCLUDE_START_DATE | CarbonPeriod::EXCLUDE_END_DATE],
                ['2017-12-31 23:59:30', '2018-01-01 0:00', '2018-01-01 0:00:30'],
            ],
            [
                ['2018-04-21', 'P1D', '2018-04-21'],
                ['2018-04-21'],
            ],
            [
                ['2018-04-21', 'P1D', '2018-04-20 23:59:59'],
                [],
            ],
        ];
    }

    /**
     * @dataProvider provideStartDateAndIntervalAndRecurrences
     */
    public function testCreateFromStartDateAndIntervalAndRecurrences($arguments, $expected)
    {
        [$start, $interval, $recurrences, $options] = array_pad($arguments, 4, null);

        $start = Carbon::parse($start);
        $interval = CarbonInterval::create($interval);

        $period = CarbonPeriod::create($start, $interval, $recurrences, $options);

        $this->assertSame(
            $this->standardizeDates($expected),
            $this->standardizeDates($period)
        );
    }

    public function provideStartDateAndIntervalAndRecurrences()
    {
        return [
            [
                ['2018-04-16', 'P2D', 3],
                ['2018-04-16', '2018-04-18', '2018-04-20'],
            ],
            [
                ['2018-04-30', 'P2M', 2, CarbonPeriod::EXCLUDE_START_DATE],
                ['2018-06-30', '2018-08-30'],
            ],
        ];
    }

    /**
     * @dataProvider provideStartDateAndRecurrences
     */
    public function testCreateFromStartDateAndRecurrences($arguments, $expected)
    {
        [$start, $recurrences, $options] = array_pad($arguments, 4, null);

        $start = Carbon::parse($start);

        $period = CarbonPeriod::create($start, $recurrences, $options);

        $this->assertSame(
            $this->standardizeDates($expected),
            $this->standardizeDates($period)
        );
    }

    public function provideStartDateAndRecurrences()
    {
        return [
            [
                ['2018-04-16', 2],
                ['2018-04-16', '2018-04-17'],
            ],
            [
                ['2018-04-30', 1],
                ['2018-04-30'],
            ],
            [
                ['2018-04-30', 1, CarbonPeriod::EXCLUDE_START_DATE],
                ['2018-05-01'],
            ],
            [
                ['2018-05-17', 0],
                [],
            ],
        ];
    }

    public function testCreateFromBaseClasses()
    {
        $period = CarbonPeriod::create(
            new DateTime('2018-04-16'),
            new DateInterval('P1M'),
            new DateTime('2018-07-15')
        );

        $this->assertSame(
            $this->standardizeDates(['2018-04-16', '2018-05-16', '2018-06-16']),
            $this->standardizeDates($period)
        );
    }

    /**
     * @dataProvider provideInvalidParameters
     */
    public function testCreateFromInvalidParameters()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            'Invalid constructor parameters.'
        );

        call_user_func_array('Carbon\CarbonPeriod::create', func_get_args());
    }

    public function provideInvalidParameters()
    {
        return [
            [new \stdClass, CarbonInterval::days(1), Carbon::tomorrow()],
            [Carbon::now(), new \stdClass, Carbon::tomorrow()],
            [Carbon::now(), CarbonInterval::days(1), new \stdClass],
            [Carbon::yesterday(), Carbon::now(), Carbon::tomorrow()],
            [CarbonInterval::day(), CarbonInterval::hour()],
            [5, CarbonPeriod::EXCLUDE_START_DATE, CarbonPeriod::EXCLUDE_END_DATE],
            ['2017-10-15/P3D', CarbonInterval::hour()],
        ];
    }

    public function testCreateOnDstForwardChange()
    {
        $period = CarbonPeriod::create(
            '2018-03-25 1:30 Europe/Oslo',
            'PT30M',
            '2018-03-25 3:30 Europe/Oslo'
        );

        $this->assertSame(
            [
                '2018-03-25 01:30:00 +01:00',
                '2018-03-25 03:00:00 +02:00',
                '2018-03-25 03:30:00 +02:00',
            ],
            $this->standardizeDates($period)
        );
    }

    /**
     * Incorrect behaviour is caused by a bug in DateTime handling of DST backward change.
     * It was fixed by incrementing date casted to UTC, but offsets are still kind of wrong.
     *
     * @see https://bugs.php.net/bug.php?id=72255
     * @see https://bugs.php.net/bug.php?id=74274
     * @see https://wiki.php.net/rfc/datetime_and_daylight_saving_time
     */
    public function testCreateOnDstBackwardChange()
    {
        $period = CarbonPeriod::create(
            '2018-10-28 1:30 Europe/Oslo',
            'PT30M',
            '2018-10-28 3:30 Europe/Oslo'
        );

        $this->assertSame(
            [
                '2018-10-28 01:30:00 +02:00',
                '2018-10-28 02:00:00 +02:00',
                '2018-10-28 02:30:00 +02:00',
                '2018-10-28 02:00:00 +01:00',
                '2018-10-28 02:30:00 +01:00',
                '2018-10-28 03:00:00 +01:00',
                '2018-10-28 03:30:00 +01:00',
            ],
            $this->standardizeDates($period)
        );
    }

    public function testInternalVariablesCannotBeIndirectlyModified()
    {
        $period = CarbonPeriod::create(
            $start = new DateTime('2018-04-16'),
            $interval = new DateInterval('P1M'),
            $end = new DateTime('2018-07-15')
        );

        $start->modify('-5 days');
        $interval->d = 15;
        $end->modify('+5 days');

        $this->assertSame('2018-04-16', $period->getStartDate()->toDateString());
        $this->assertSame('P1M', $period->getDateInterval()->spec());
        $this->assertSame('2018-07-15', $period->getEndDate()->toDateString());

        $period = CarbonPeriod::create(
            $start = new Carbon('2018-04-16'),
            $interval = new CarbonInterval('P1M'),
            $end = new Carbon('2018-07-15')
        );

        $start->subDays(5);
        $interval->days(15);
        $end->addDays(5);

        $this->assertSame('2018-04-16', $period->getStartDate()->toDateString());
        $this->assertSame('P1M', $period->getDateInterval()->spec());
        $this->assertSame('2018-07-15', $period->getEndDate()->toDateString());
    }

    public function testCreateFromArray()
    {
        $period = CarbonPeriod::createFromArray([
            '2018-03-25', 'P2D', '2018-04-01', CarbonPeriod::EXCLUDE_END_DATE,
        ]);

        $this->assertSame('2018-03-25', $period->getStartDate()->toDateString());
        $this->assertSame('P2D', $period->getDateInterval()->spec());
        $this->assertSame('2018-04-01', $period->getEndDate()->toDateString());
        $this->assertSame(CarbonPeriod::EXCLUDE_END_DATE, $period->getOptions());
    }

    public function testCreateFromIso()
    {
        $period = CarbonPeriod::createFromIso('R3/2018-03-25/P2D/2018-04-01', CarbonPeriod::EXCLUDE_END_DATE);

        $this->assertSame('2018-03-25', $period->getStartDate()->toDateString());
        $this->assertSame('P2D', $period->getDateInterval()->spec());
        $this->assertSame('2018-04-01', $period->getEndDate()->toDateString());
        $this->assertSame(3, $period->getRecurrences());
        $this->assertSame(CarbonPeriod::EXCLUDE_END_DATE, $period->getOptions());
    }

    public function testCreateEmpty()
    {
        $period = new CarbonPeriod;

        $this->assertEquals(new Carbon, $period->getStartDate());
        $this->assertEquals('P1D', $period->getDateInterval()->spec());
        $this->assertNull($period->getEndDate());
        $this->assertNull($period->getRecurrences());
        $this->assertEquals(0, $period->getOptions());
    }

    public function testCreateFromDateStringsWithTimezones()
    {
        $period = CarbonPeriod::create(
            $start = '2018-03-25 10:15:30 Europe/Oslo',
            $end = '2018-03-28 17:25:30 Asia/Kamchatka'
        );

        $this->assertSame($start, $period->getStartDate()->format('Y-m-d H:i:s e'));
        $this->assertSame($end, $period->getEndDate()->format('Y-m-d H:i:s e'));
    }

    public function testCreateWithIntervalInFromStringFormat()
    {
        $period = CarbonPeriod::create(
            '2018-03-25 12:00',
            '2 days 10 hours',
            '2018-04-01 13:30'
        );

        $this->assertSame(
            $this->standardizeDates(['2018-03-25 12:00', '2018-03-27 22:00', '2018-03-30 08:00']),
            $this->standardizeDates($period)
        );

        $period = CarbonPeriod::create(
            '2018-04-21',
            '3 days',
            '2018-04-27'
        );

        $this->assertSame(
            $this->standardizeDates(['2018-04-21 00:00', '2018-04-24 00:00', '2018-04-27 00:00']),
            $this->standardizeDates($period)
        );
    }

    public function testCreateFromRelativeDates()
    {
        $period = CarbonPeriod::create(
            $start = 'previous friday',
            $end = '+6 days'
        );

        $this->assertEquals(new Carbon($start), $period->getStartDate());
        $this->assertEquals(new Carbon($end), $period->getEndDate());
    }

    public function testCreateFromCarbonInstances()
    {
        $period = Carbon::create('2019-01-02')->toPeriod(7);

        $this->assertSame(24, $period->getDateInterval()->totalHours);
        $this->assertInstanceOf(Carbon::class, $period->getStartDate());
        $this->assertSame('2019-01-02', $period->getStartDate()->format('Y-m-d'));
        $this->assertNull($period->getEndDate());
        $this->assertSame(7, $period->getRecurrences());
        $end = $period->calculateEnd();
        $this->assertInstanceOf(Carbon::class, $end);
        $this->assertSame('2019-01-08', $end->format('Y-m-d'));

        $period = Carbon::create('2019-01-02')->toPeriod('2019-02-05');

        $this->assertNull($period->getRecurrences());
        $this->assertSame(24, $period->getDateInterval()->totalHours);
        $this->assertInstanceOf(Carbon::class, $period->getStartDate());
        $this->assertSame('2019-01-02', $period->getStartDate()->format('Y-m-d'));
        $this->assertInstanceOf(Carbon::class, $period->getEndDate());
        $this->assertSame('2019-02-05', $period->getEndDate()->format('Y-m-d'));

        $period = Carbon::create('2019-01-02')->range('2019-02-05');

        $this->assertInstanceOf(Carbon::class, $period->getStartDate());
        $this->assertSame('2019-01-02', $period->getStartDate()->format('Y-m-d'));
        $this->assertInstanceOf(Carbon::class, $period->getEndDate());
        $this->assertSame('2019-02-05', $period->getEndDate()->format('Y-m-d'));

        $period = Carbon::create('2019-01-02')->daysUntil('2019-02-05');

        $this->assertSame(24, $period->getDateInterval()->totalHours);
        $this->assertInstanceOf(Carbon::class, $period->getStartDate());
        $this->assertSame('2019-01-02', $period->getStartDate()->format('Y-m-d'));
        $this->assertInstanceOf(Carbon::class, $period->getEndDate());
        $this->assertSame('2019-02-05', $period->getEndDate()->format('Y-m-d'));

        $period = CarbonImmutable::create('2019-01-02')->daysUntil('2019-02-05');

        $this->assertInstanceOf(CarbonImmutable::class, $period->getStartDate());
        $this->assertSame('2019-01-02', $period->getStartDate()->format('Y-m-d'));
        $this->assertInstanceOf(CarbonImmutable::class, $period->getEndDate());
        $this->assertSame('2019-02-05', $period->getEndDate()->format('Y-m-d'));

        $period = CarbonImmutable::create('2019-01-02')->daysUntil(Carbon::parse('2019-02-05'));

        $this->assertSame(CarbonImmutable::class, $period->getDateClass());
        $this->assertInstanceOf(CarbonImmutable::class, $period->getStartDate());
        $this->assertSame('2019-01-02', $period->getStartDate()->format('Y-m-d'));
        $this->assertInstanceOf(CarbonImmutable::class, $period->getEndDate());
        $this->assertSame('2019-02-05', $period->getEndDate()->format('Y-m-d'));

        $period = Carbon::create('2019-01-02')->hoursUntil('2019-02-05');
        $this->assertSame(1, $period->getDateInterval()->totalHours);

        $this->assertSame('1 minute', Carbon::create('2019-01-02')->minutesUntil('2019-02-05')->getDateInterval()->forHumans());
        $this->assertSame('3 minutes', Carbon::create('2019-01-02')->minutesUntil('2019-02-05', 3)->getDateInterval()->forHumans());
        $this->assertSame('3 seconds', Carbon::create('2019-01-02')->range('2019-02-05', 3, 'seconds')->getDateInterval()->forHumans());
        $this->assertSame('1 second', Carbon::create('2019-01-02')->secondsUntil('2019-02-05')->getDateInterval()->forHumans());
        $this->assertSame(1, Carbon::create('2019-01-02')->millisecondsUntil('2019-02-05')->getDateInterval()->totalMilliseconds);
        $this->assertSame(1, Carbon::create('2019-01-02')->microsecondsUntil('2019-02-05')->getDateInterval()->totalMicroseconds);
        $this->assertSame('1 week', Carbon::create('2019-01-02')->weeksUntil('2019-02-05')->getDateInterval()->forHumans());
        $this->assertSame('1 month', Carbon::create('2019-01-02')->monthsUntil('2019-02-05')->getDateInterval()->forHumans());
        $this->assertSame('3 months', Carbon::create('2019-01-02')->quartersUntil('2019-02-05')->getDateInterval()->forHumans());
        $this->assertSame('1 year', Carbon::create('2019-01-02')->yearsUntil('2019-02-05')->getDateInterval()->forHumans());
        $this->assertSame('10 years', Carbon::create('2019-01-02')->decadesUntil('2019-02-05')->getDateInterval()->forHumans());
        $this->assertSame('100 years', Carbon::create('2019-01-02')->centuriesUntil('2019-02-05')->getDateInterval()->forHumans());
        $this->assertSame('1000 years', Carbon::create('2019-01-02')->millenniaUntil('2019-02-05')->getDateInterval()->forHumans());
    }

    public function testCreateFromCarbonInstanceInvalidMethod()
    {
        $this->expectException(BadMethodCallException::class);
        $this->expectExceptionMessage('Method unknownUnitsUntil does not exist.');

        /** @var object $date */
        $date = Carbon::create('2019-01-02');
        $date->unknownUnitsUntil('2019-02-05');
    }

    public function testInstance()
    {
        $period = CarbonPeriod::instance(new DatePeriod(
            Carbon::parse('2012-07-01'),
            CarbonInterval::days(2),
            Carbon::parse('2012-07-07')
        ));

        $this->assertInstanceOf(CarbonPeriod::class, $period);
        $this->assertSame('2012-07-01', $period->getStartDate()->format('Y-m-d'));
        $this->assertSame(2, $period->getDateInterval()->d);
        $this->assertSame('2012-07-07', $period->getEndDate()->format('Y-m-d'));

        $period2 = CarbonPeriod::instance($period);

        $this->assertInstanceOf(CarbonPeriod::class, $period2);
        $this->assertSame('2012-07-01', $period2->getStartDate()->format('Y-m-d'));
        $this->assertSame(2, $period2->getDateInterval()->d);
        $this->assertSame('2012-07-07', $period2->getEndDate()->format('Y-m-d'));
        $this->assertNotSame($period, $period2);
    }

    public function testCast()
    {
        $period = new class('2012-07-01', CarbonInterval::days(2), '2012-07-07') extends CarbonPeriod {
            public function foo()
            {
                return $this->getStartDate()->format('j').' '.
                    $this->getDateInterval()->format('%d').' '.
                    $this->getEndDate()->format('j');
            }
        };
        $subClass = get_class($period);

        $this->assertInstanceOf(CarbonPeriod::class, $period);
        $this->assertNotSame(CarbonPeriod::class, $subClass);
        $this->assertSame('1 2 7', $period->foo());

        /** @var object $period */
        $period = CarbonPeriod::create('2010-08-24', CarbonInterval::weeks(2), '2012-07-19')
            ->cast($subClass);

        $this->assertInstanceOf($subClass, $period);
        $this->assertSame('24 14 19', $period->foo());
    }

    public function testBadCast()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('DateTime has not the instance() method needed to cast the date.');

        CarbonPeriod::create('2010-08-24', CarbonInterval::weeks(2), '2012-07-19')
            ->cast(DateTime::class);
    }

    public function testMake()
    {
        $period = CarbonPeriod::make(new DatePeriod(
            Carbon::parse('2012-07-01'),
            CarbonInterval::days(2),
            Carbon::parse('2012-07-07')
        ));

        $this->assertInstanceOf(CarbonPeriod::class, $period);
        $this->assertSame('2012-07-01', $period->getStartDate()->format('Y-m-d'));
        $this->assertSame(2, $period->getDateInterval()->d);
        $this->assertSame('2012-07-07', $period->getEndDate()->format('Y-m-d'));

        $period2 = CarbonPeriod::make($period);

        $this->assertInstanceOf(CarbonPeriod::class, $period2);
        $this->assertSame('2012-07-01', $period2->getStartDate()->format('Y-m-d'));
        $this->assertSame(2, $period2->getDateInterval()->d);
        $this->assertSame('2012-07-07', $period2->getEndDate()->format('Y-m-d'));
        $this->assertNotSame($period, $period2);

        $period2 = CarbonPeriod::make('2012-07-01/P2D/2012-07-07');

        $this->assertInstanceOf(CarbonPeriod::class, $period2);
        $this->assertSame('2012-07-01', $period2->getStartDate()->format('Y-m-d'));
        $this->assertSame(2, $period2->getDateInterval()->d);
        $this->assertSame('2012-07-07', $period2->getEndDate()->format('Y-m-d'));
    }

    public function testInstanceInvalidType()
    {
        $this->expectException(NotAPeriodException::class);
        $this->expectExceptionMessage('Argument 1 passed to Carbon\CarbonPeriod::Carbon\CarbonPeriod::instance() '.
            'must be an instance of DatePeriod or Carbon\CarbonPeriod, string given.');

        CarbonPeriod::instance('hello');
    }

    public function testInstanceInvalidInstance()
    {
        $this->expectException(NotAPeriodException::class);
        $this->expectExceptionMessage('Argument 1 passed to Carbon\CarbonPeriod::Carbon\CarbonPeriod::instance() '.
            'must be an instance of DatePeriod or Carbon\CarbonPeriod, instance of Carbon\Carbon given.');

        CarbonPeriod::instance(Carbon::now());
    }
}
