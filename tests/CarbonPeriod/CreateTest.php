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
use Carbon\CarbonPeriodImmutable;
use Carbon\Exceptions\NotAPeriodException;
use DateInterval;
use DatePeriod;
use DateTime;
use Generator;
use InvalidArgumentException;
use stdClass;
use Tests\AbstractTestCase;

class CreateTest extends AbstractTestCase
{
    /**
     * @dataProvider \Tests\CarbonPeriod\CreateTest::dataForIso8601String
     */
    public function testCreateFromIso8601String($arguments, $expected)
    {
        $periodClass = $this->periodClass;
        [$iso, $options] = array_pad($arguments, 2, null);

        $period = $periodClass::create($iso, $options);

        $this->assertSame(
            $this->standardizeDates($expected),
            $this->standardizeDates($period)
        );
    }

    public static function dataForIso8601String(): Generator
    {
        yield [
            ['R4/2012-07-01T00:00:00/P7D'],
            ['2012-07-01', '2012-07-08', '2012-07-15', '2012-07-22'],
        ];
        yield [
            ['R4/2012-07-01T00:00:00/P7D', CarbonPeriod::EXCLUDE_START_DATE],
            ['2012-07-08', '2012-07-15', '2012-07-22', '2012-07-29'],
        ];
        yield [
            ['2012-07-01/P2D/2012-07-07'],
            ['2012-07-01', '2012-07-03', '2012-07-05', '2012-07-07'],
        ];
        yield [
            ['2012-07-01/2012-07-04', CarbonPeriod::EXCLUDE_END_DATE],
            ['2012-07-01', '2012-07-02', '2012-07-03'],
        ];
        yield [
            ['R2/2012-07-01T10:30:45Z/P2D'],
            ['2012-07-01 10:30:45 UTC', '2012-07-03 10:30:45 UTC'],
        ];
    }

    public function testCreateFromIso8601StringWithUnboundedRecurrences()
    {
        $periodClass = $this->periodClass;
        $period = $periodClass::create('R/2012-07-01T00:00:00/P7D');

        $this->assertSame('2012-07-01', $period->getStartDate()->toDateString());
        $this->assertSame('P7D', $period->getDateInterval()->spec());
        $this->assertNull($period->getEndDate());
        $this->assertNull($period->getRecurrences());
    }

    public function testCreateFromIso8601StringWithInfiniteRecurrences()
    {
        $periodClass = $this->periodClass;
        $period = $periodClass::create('RINF/2012-07-01T00:00:00/P7D');
        $this->assertSame('2012-07-01', $period->getStartDate()->toDateString());
        $this->assertSame('P7D', $period->getDateInterval()->spec());
        $this->assertNull($period->getEndDate());
        $this->assertInfinite($period->getRecurrences());
    }

    /**
     * @dataProvider \Tests\CarbonPeriod\CreateTest::dataForPartialIso8601String
     */
    public function testCreateFromPartialIso8601String($iso, $from, $to)
    {
        $periodClass = $this->periodClass;
        $period = $periodClass::create($iso);

        $this->assertSame(
            $this->standardizeDates([$from, $to]),
            $this->standardizeDates([$period->getStartDate(), $period->getEndDate()])
        );

        $period = new $periodClass($iso);

        $this->assertSame(
            $this->standardizeDates([$from, $to]),
            $this->standardizeDates([$period->getStartDate(), $period->getEndDate()])
        );
    }

    public static function dataForPartialIso8601String(): Generator
    {
        yield ['2008-02-15/03-14', '2008-02-15', '2008-03-14'];
        yield ['2007-12-14T13:30/15:30', '2007-12-14 13:30', '2007-12-14 15:30'];
    }

    /**
     * @dataProvider \Tests\CarbonPeriod\CreateTest::dataForInvalidIso8601String
     */
    public function testCreateFromInvalidIso8601String($iso)
    {
        $this->expectExceptionObject(new InvalidArgumentException(
            "Invalid ISO 8601 specification: $iso"
        ));

        $periodClass = $this->periodClass;
        $periodClass::create($iso);
    }

    public static function dataForInvalidIso8601String(): Generator
    {
        yield ['R2/R4'];
        yield ['2008-02-15/2008-02-16/2008-02-17'];
        yield ['P1D/2008-02-15/P2D'];
        yield ['2008-02-15/R5'];
        yield ['P2D/R2'];
        yield ['/'];
    }

    /**
     * @dataProvider \Tests\CarbonPeriod\CreateTest::dataForStartDateAndEndDate
     */
    public function testCreateFromStartDateAndEndDate($arguments, $expected)
    {
        $periodClass = $this->periodClass;
        [$start, $end, $options] = array_pad($arguments, 3, null);

        $start = Carbon::parse($start);
        $end = Carbon::parse($end);

        $period = $periodClass::create($start, $end, $options);

        $this->assertSame(
            $this->standardizeDates($expected),
            $this->standardizeDates($period)
        );
    }

    public static function dataForStartDateAndEndDate(): Generator
    {
        yield [
                ['2015-09-30', '2015-10-03'],
                ['2015-09-30', '2015-10-01', '2015-10-02', '2015-10-03'],
            ];
        yield [
                ['2015-09-30', '2015-10-03', CarbonPeriod::EXCLUDE_START_DATE],
                ['2015-10-01', '2015-10-02', '2015-10-03'],
            ];
        yield [
                ['2015-09-30', '2015-10-03', CarbonPeriod::EXCLUDE_END_DATE],
                ['2015-09-30', '2015-10-01', '2015-10-02'],
            ];
        yield [
                ['2015-09-30', '2015-10-03', CarbonPeriod::EXCLUDE_START_DATE | CarbonPeriod::EXCLUDE_END_DATE],
                ['2015-10-01', '2015-10-02'],
            ];
        yield [
                ['2015-10-02', '2015-10-03', CarbonPeriod::EXCLUDE_START_DATE | CarbonPeriod::EXCLUDE_END_DATE],
                [],
            ];
        yield [
                ['2015-10-02', '2015-10-02'],
                ['2015-10-02'],
            ];
        yield [
                ['2015-10-02', '2015-10-02', CarbonPeriod::EXCLUDE_START_DATE],
                [],
            ];
        yield [
                ['2015-10-02', '2015-10-02', CarbonPeriod::EXCLUDE_END_DATE],
                [],
            ];
    }

    /**
     * @dataProvider \Tests\CarbonPeriod\CreateTest::dataForStartDateAndIntervalAndEndDate
     */
    public function testCreateFromStartDateAndIntervalAndEndDate($arguments, $expected)
    {
        $periodClass = $this->periodClass;
        [$start, $interval, $end, $options] = array_pad($arguments, 4, null);

        $start = Carbon::parse($start);
        $interval = CarbonInterval::create($interval);
        $end = Carbon::parse($end);

        $period = $periodClass::create($start, $interval, $end, $options);

        $this->assertSame(
            $this->standardizeDates($expected),
            $this->standardizeDates($period)
        );
    }

    public static function dataForStartDateAndIntervalAndEndDate(): Generator
    {
        yield [
            ['2018-04-21', 'P3D', '2018-04-26'],
            ['2018-04-21', '2018-04-24'],
        ];
        yield [
            ['2018-04-21 16:15', 'PT15M', '2018-04-21 16:59:59'],
            ['2018-04-21 16:15', '2018-04-21 16:30', '2018-04-21 16:45'],
        ];
        yield [
            ['2018-04-21 16:15', 'PT15M', '2018-04-21 17:00'],
            ['2018-04-21 16:15', '2018-04-21 16:30', '2018-04-21 16:45', '2018-04-21 17:00'],
        ];
        yield [
            ['2018-04-21 17:00', 'PT45S', '2018-04-21 17:02', CarbonPeriod::EXCLUDE_START_DATE],
            ['2018-04-21 17:00:45', '2018-04-21 17:01:30'],
        ];
        yield [
            ['2017-12-31 22:00', 'PT2H', '2018-01-01 4:00', CarbonPeriod::EXCLUDE_END_DATE],
            ['2017-12-31 22:00', '2018-01-01 0:00', '2018-01-01 2:00'],
        ];
        yield [
            [
                '2017-12-31 23:59',
                'PT30S',
                '2018-01-01 0:01',
                CarbonPeriod::EXCLUDE_START_DATE | CarbonPeriod::EXCLUDE_END_DATE,
            ],
            ['2017-12-31 23:59:30', '2018-01-01 0:00', '2018-01-01 0:00:30'],
        ];
        yield [
            ['2018-04-21', 'P1D', '2018-04-21'],
            ['2018-04-21'],
        ];
        yield [
            ['2018-04-21', 'P1D', '2018-04-20 23:59:59'],
            [],
        ];
    }

    /**
     * @dataProvider \Tests\CarbonPeriod\CreateTest::dataForStartDateAndIntervalAndRecurrences
     */
    public function testCreateFromStartDateAndIntervalAndRecurrences($arguments, $expected)
    {
        $periodClass = $this->periodClass;
        [$start, $interval, $recurrences, $options] = array_pad($arguments, 4, null);

        $start = Carbon::parse($start);
        $interval = CarbonInterval::create($interval);

        $period = $periodClass::create($start, $interval, $recurrences, $options);

        $this->assertSame(
            $this->standardizeDates($expected),
            $this->standardizeDates($period)
        );
    }

    public static function dataForStartDateAndIntervalAndRecurrences(): Generator
    {
        yield [
            ['2018-04-16', 'P2D', 3],
            ['2018-04-16', '2018-04-18', '2018-04-20'],
        ];
        yield [
            ['2018-04-30', 'P2M', 2, CarbonPeriod::EXCLUDE_START_DATE],
            ['2018-06-30', '2018-08-30'],
        ];
    }

    /**
     * @dataProvider \Tests\CarbonPeriod\CreateTest::dataForStartDateAndRecurrences
     */
    public function testCreateFromStartDateAndRecurrences($arguments, $expected)
    {
        $periodClass = $this->periodClass;
        [$start, $recurrences, $options] = array_pad($arguments, 4, null);

        $start = Carbon::parse($start);

        $period = $periodClass::create($start, $recurrences, $options);

        $this->assertSame(
            $this->standardizeDates($expected),
            $this->standardizeDates($period)
        );
    }

    public static function dataForStartDateAndRecurrences(): Generator
    {
        yield [
                ['2018-04-16', 2],
                ['2018-04-16', '2018-04-17'],
            ];
        yield [
                ['2018-04-30', 1],
                ['2018-04-30'],
            ];
        yield [
                ['2018-04-30', 1, CarbonPeriod::EXCLUDE_START_DATE],
                ['2018-05-01'],
            ];
        yield [
                ['2018-05-17', 0],
                [],
            ];
    }

    public function testCreateFromBaseClasses()
    {
        $periodClass = $this->periodClass;
        $period = $periodClass::create(
            new DateTime('2018-04-16'),
            new DateInterval('P1M'),
            new DateTime('2018-07-15')
        );

        $this->assertSame(
            [
                '2018-04-16 00:00:00 -04:00',
                '2018-05-16 00:00:00 -04:00',
                '2018-06-16 00:00:00 -04:00',
            ],
            $this->standardizeDates($period)
        );
    }

    /**
     * @dataProvider \Tests\CarbonPeriod\CreateTest::dataForInvalidParameters
     */
    public function testCreateFromInvalidParameters(...$arguments)
    {
        $this->expectExceptionObject(new InvalidArgumentException(
            'Invalid constructor parameters.'
        ));

        $periodClass = $this->periodClass;
        $periodClass::create(...$arguments);
    }

    public static function dataForInvalidParameters(): Generator
    {
        yield [new stdClass(), CarbonInterval::days(1), Carbon::tomorrow()];
        yield [Carbon::now(), new stdClass(), Carbon::tomorrow()];
        yield [Carbon::now(), CarbonInterval::days(1), new stdClass()];
        yield [Carbon::yesterday(), Carbon::now(), Carbon::tomorrow()];
        yield [CarbonInterval::day(), CarbonInterval::hour()];
        yield [5, CarbonPeriod::EXCLUDE_START_DATE, CarbonPeriod::EXCLUDE_END_DATE];
        yield ['2017-10-15/P3D', CarbonInterval::hour()];
    }

    public function testCreateOnDstForwardChange()
    {
        $periodClass = $this->periodClass;
        $period = $periodClass::create(
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
        $periodClass = $this->periodClass;
        $period = $periodClass::create(
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
        $periodClass = $this->periodClass;
        $period = $periodClass::create(
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

        $period = $periodClass::create(
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
        $periodClass = $this->periodClass;
        $period = $periodClass::createFromArray([
            '2018-03-25', 'P2D', '2018-04-01', $periodClass::EXCLUDE_END_DATE,
        ]);

        $this->assertSame('2018-03-25', $period->getStartDate()->toDateString());
        $this->assertSame('P2D', $period->getDateInterval()->spec());
        $this->assertSame('2018-04-01', $period->getEndDate()->toDateString());
        $this->assertSame($periodClass::EXCLUDE_END_DATE, $period->getOptions());
    }

    public function testCreateFromIso()
    {
        $periodClass = $this->periodClass;
        $period = $periodClass::createFromIso('R3/2018-03-25/P2D/2018-04-01', $periodClass::EXCLUDE_END_DATE);

        $this->assertSame('2018-03-25', $period->getStartDate()->toDateString());
        $this->assertSame('P2D', $period->getDateInterval()->spec());
        $this->assertSame('2018-04-01', $period->getEndDate()->toDateString());
        $this->assertSame(3, $period->getRecurrences());
        $this->assertSame($periodClass::EXCLUDE_END_DATE, $period->getOptions());
    }

    public function testCreateEmpty()
    {
        $periodClass = $this->periodClass;
        $period = new $periodClass();

        $this->assertEquals(new Carbon(), $period->getStartDate());
        $this->assertSame('P1D', $period->getDateInterval()->spec());
        $this->assertNull($period->getEndDate());
        $this->assertNull($period->getRecurrences());
        $this->assertSame(0, $period->getOptions());
    }

    public function testCreateFromDateStringsWithTimezones()
    {
        $periodClass = $this->periodClass;
        $period = $periodClass::create(
            $start = '2018-03-25 10:15:30 Europe/Oslo',
            $end = '2018-03-28 17:25:30 Asia/Kamchatka'
        );

        $this->assertSame($start, $period->getStartDate()->format('Y-m-d H:i:s e'));
        $this->assertSame($end, $period->getEndDate()->format('Y-m-d H:i:s e'));
    }

    public function testCreateWithIntervalInFromStringFormat()
    {
        $periodClass = $this->periodClass;
        $period = $periodClass::create(
            '2018-03-25 12:00',
            '2 days 10 hours',
            '2018-04-01 13:30'
        );

        $this->assertSame(
            $this->standardizeDates(['2018-03-25 12:00', '2018-03-27 22:00', '2018-03-30 08:00']),
            $this->standardizeDates($period)
        );

        $period = $periodClass::create(
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
        $periodClass = $this->periodClass;
        $period = $periodClass::create(
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
        $this->expectExceptionObject(new BadMethodCallException(
            'Method unknownUnitsUntil does not exist.'
        ));

        /** @var object $date */
        $date = Carbon::create('2019-01-02');
        $date->unknownUnitsUntil('2019-02-05');
    }

    public function testInstance()
    {
        $periodClass = $this->periodClass;
        $source = new DatePeriod(
            new DateTime('2012-07-01'),
            CarbonInterval::days(2),
            new DateTime('2012-07-07')
        );

        $period = $periodClass::instance($source);

        $this->assertInstanceOf($periodClass, $period);
        $this->assertSame('2012-07-01', $period->getStartDate()->format('Y-m-d'));
        $this->assertSame(2, $period->getDateInterval()->d);
        $this->assertSame('2012-07-07', $period->getEndDate()->format('Y-m-d'));

        $period2 = $periodClass::instance($period);

        $this->assertInstanceOf($periodClass, $period2);
        $this->assertSame('2012-07-01', $period2->getStartDate()->format('Y-m-d'));
        $this->assertSame(2, $period2->getDateInterval()->d);
        $this->assertSame('2012-07-07', $period2->getEndDate()->format('Y-m-d'));
        $this->assertNotSame($period, $period2);

        $period3 = new $periodClass($source);

        $this->assertInstanceOf($periodClass, $period3);
        $this->assertSame('2012-07-01', $period3->getStartDate()->format('Y-m-d'));
        $this->assertSame(2, $period3->getDateInterval()->d);
        $this->assertSame('2012-07-07', $period3->getEndDate()->format('Y-m-d'));
        $this->assertNotSame($period, $period3);

        $period4 = new $periodClass($period);

        $this->assertInstanceOf($periodClass, $period4);
        $this->assertSame('2012-07-01', $period4->getStartDate()->format('Y-m-d'));
        $this->assertSame(2, $period4->getDateInterval()->d);
        $this->assertSame('2012-07-07', $period4->getEndDate()->format('Y-m-d'));
        $this->assertNotSame($period, $period4);
    }

    public function testCreateFromCarbonInstancesNamedParameters()
    {
        if (version_compare(PHP_VERSION, '8.0.0-dev', '<')) {
            $this->markTestSkipped('This tests needs PHP 8 named arguments syntax.');
        }

        $periodClass = $this->periodClass;
        $carbonClass = $periodClass === CarbonPeriodImmutable::class
            ? CarbonImmutable::class
            : Carbon::class;
        $period = eval("return \\$carbonClass::create('2019-01-02')->daysUntil(endDate: '2019-02-05');");
        $this->assertInstanceOf($periodClass, $period);
        $this->assertSame('2019-01-02', $period->getStartDate()->format('Y-m-d'));
        $this->assertSame('2019-02-05', $period->getEndDate()->format('Y-m-d'));
        $this->assertSame('1 day', (string) $period->getDateInterval());

        $period = eval("return \\$carbonClass::create('2019-01-02')->hoursUntil(endDate: '2019-02-05', factor: 12);");
        $this->assertInstanceOf($periodClass, $period);
        $this->assertSame('2019-01-02', $period->getStartDate()->format('Y-m-d'));
        $this->assertSame('2019-02-05', $period->getEndDate()->format('Y-m-d'));
        $this->assertSame('12 hours', (string) $period->getDateInterval());
    }

    public function testCast()
    {
        $periodClass = $this->periodClass;
        $period = $periodClass === CarbonPeriodImmutable::class
            ? (new class('2012-07-01', CarbonInterval::days(2), '2012-07-07') extends CarbonPeriodImmutable {
                public function foo()
                {
                    return $this->getStartDate()->format('j').' '.
                        $this->getDateInterval()->format('%d').' '.
                        $this->getEndDate()->format('j');
                }
            })
            : (new class('2012-07-01', CarbonInterval::days(2), '2012-07-07') extends CarbonPeriod {
                public function foo()
                {
                    return $this->getStartDate()->format('j').' '.
                        $this->getDateInterval()->format('%d').' '.
                        $this->getEndDate()->format('j');
                }
            });
        $subClass = \get_class($period);

        $this->assertInstanceOf($periodClass, $period);
        $this->assertNotSame($periodClass, $subClass);
        $this->assertSame('1 2 7', $period->foo());

        /** @var object $period */
        $period = $periodClass::create('2010-08-24', CarbonInterval::weeks(2), '2012-07-19')
            ->cast($subClass);

        $this->assertInstanceOf($subClass, $period);
        $this->assertSame('24 14 19', $period->foo());
    }

    public function testBadCast()
    {
        $this->expectExceptionObject(new InvalidArgumentException(
            'DateTime has not the instance() method needed to cast the date.'
        ));

        $periodClass = $this->periodClass;
        $periodClass::create('2010-08-24', CarbonInterval::weeks(2), '2012-07-19')
            ->cast(DateTime::class);
    }

    public function testMake()
    {
        $periodClass = $this->periodClass;
        $period = $periodClass::make(new DatePeriod(
            new DateTime('2012-07-01'),
            CarbonInterval::days(2),
            new DateTime('2012-07-07')
        ));

        $this->assertInstanceOf($periodClass, $period);
        $this->assertSame('2012-07-01', $period->getStartDate()->format('Y-m-d'));
        $this->assertSame(2, $period->getDateInterval()->d);
        $this->assertSame('2012-07-07', $period->getEndDate()->format('Y-m-d'));

        $period2 = $periodClass::make($period);

        $this->assertInstanceOf($periodClass, $period2);
        $this->assertSame('2012-07-01', $period2->getStartDate()->format('Y-m-d'));
        $this->assertSame(2, $period2->getDateInterval()->d);
        $this->assertSame('2012-07-07', $period2->getEndDate()->format('Y-m-d'));
        $this->assertNotSame($period, $period2);

        $period2 = $periodClass::make('2012-07-01/P2D/2012-07-07');

        $this->assertInstanceOf($periodClass, $period2);
        $this->assertSame('2012-07-01', $period2->getStartDate()->format('Y-m-d'));
        $this->assertSame(2, $period2->getDateInterval()->d);
        $this->assertSame('2012-07-07', $period2->getEndDate()->format('Y-m-d'));
    }

    public function testInstanceInvalidType()
    {
        $this->expectExceptionObject(new NotAPeriodException(
            'Argument 1 passed to Carbon\CarbonPeriod::Carbon\CarbonPeriod::instance() '.
            'must be an instance of DatePeriod or Carbon\CarbonPeriod, string given.'
        ));

        $periodClass = $this->periodClass;
        $periodClass::instance('hello');
    }

    public function testInstanceInvalidInstance()
    {
        $this->expectExceptionObject(new NotAPeriodException(
            'Argument 1 passed to Carbon\CarbonPeriod::Carbon\CarbonPeriod::instance() '.
            'must be an instance of DatePeriod or Carbon\CarbonPeriod, instance of Carbon\Carbon given.'
        ));

        $periodClass = $this->periodClass;
        $periodClass::instance(Carbon::now());
    }
}
