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
use Carbon\CarbonInterface;
use Carbon\CarbonInterval;
use Carbon\CarbonPeriod;
use Carbon\CarbonPeriodImmutable;
use Carbon\Exceptions\InvalidPeriodParameterException;
use Carbon\Exceptions\NotAPeriodException;
use Carbon\Month;
use Carbon\Unit;
use DateInterval;
use DatePeriod;
use DateTime;
use Generator;
use InvalidArgumentException;
use PHPUnit\Framework\Attributes\DataProvider;
use stdClass;
use Tests\AbstractTestCase;

class CreateTest extends AbstractTestCase
{
    #[DataProvider('dataForIso8601String')]
    public function testCreateFromIso8601String($arguments, $expected)
    {
        $periodClass = static::$periodClass;
        [$iso, $options] = array_pad($arguments, 2, null);

        $period = $periodClass::create($iso, $options);

        $this->assertInstanceOf(CarbonPeriod::class, $period);
        $this->assertInstanceOf(DatePeriod::class, $period);
        $this->assertSame(
            $this->standardizeDates($expected),
            $this->standardizeDates($period),
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
        $periodClass = static::$periodClass;
        $period = $periodClass::create('R/2012-07-01T00:00:00/P7D');

        $this->assertSame('2012-07-01', $period->getStartDate()->toDateString());
        $this->assertSame('P7D', $period->getDateInterval()->spec());
        $this->assertNull($period->getEndDate());
        $this->assertNull($period->getRecurrences());
    }

    public function testCreateFromIso8601StringWithInfiniteRecurrences()
    {
        $periodClass = static::$periodClass;
        $period = $periodClass::create('RINF/2012-07-01T00:00:00/P7D');
        $this->assertSame('2012-07-01', $period->getStartDate()->toDateString());
        $this->assertSame('P7D', $period->getDateInterval()->spec());
        $this->assertNull($period->getEndDate());
        $this->assertInfinite($period->getRecurrences());
    }

    #[DataProvider('dataForPartialIso8601String')]
    public function testCreateFromPartialIso8601String($iso, $from, $to)
    {
        $periodClass = static::$periodClass;
        $period = $periodClass::create($iso);

        $this->assertSame(
            $this->standardizeDates([$from, $to]),
            $this->standardizeDates([$period->getStartDate(), $period->getEndDate()]),
        );

        $period = new $periodClass($iso);

        $this->assertSame(
            $this->standardizeDates([$from, $to]),
            $this->standardizeDates([$period->getStartDate(), $period->getEndDate()]),
        );
    }

    public static function dataForPartialIso8601String(): Generator
    {
        yield ['2008-02-15/03-14', '2008-02-15', '2008-03-14'];
        yield ['2007-12-14T13:30/15:30', '2007-12-14 13:30', '2007-12-14 15:30'];
    }

    #[DataProvider('dataForInvalidIso8601String')]
    public function testCreateFromInvalidIso8601String($iso)
    {
        $this->expectExceptionObject(new InvalidArgumentException(
            "Invalid ISO 8601 specification: $iso",
        ));

        $periodClass = static::$periodClass;
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

    #[DataProvider('dataForStartDateAndEndDate')]
    public function testCreateFromStartDateAndEndDate($arguments, $expected)
    {
        $periodClass = static::$periodClass;
        [$start, $end, $options] = array_pad($arguments, 3, null);

        $start = Carbon::parse($start);
        $end = Carbon::parse($end);

        $period = $periodClass::create($start, $end, $options);

        $this->assertSame(
            $this->standardizeDates($expected),
            $this->standardizeDates($period),
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

    #[DataProvider('dataForStartDateAndIntervalAndEndDate')]
    public function testCreateFromStartDateAndIntervalAndEndDate($arguments, $expected)
    {
        $periodClass = static::$periodClass;
        [$start, $interval, $end, $options] = array_pad($arguments, 4, null);

        $start = Carbon::parse($start);
        $interval = CarbonInterval::create($interval);
        $end = Carbon::parse($end);

        $period = $periodClass::create($start, $interval, $end, $options);

        $this->assertSame(
            $this->standardizeDates($expected),
            $this->standardizeDates($period),
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

    #[DataProvider('dataForStartDateAndIntervalAndRecurrences')]
    public function testCreateFromStartDateAndIntervalAndRecurrences($arguments, $expected)
    {
        $periodClass = static::$periodClass;
        [$start, $interval, $recurrences, $options] = array_pad($arguments, 4, null);

        $start = Carbon::parse($start);
        $interval = CarbonInterval::create($interval);

        $period = $periodClass::create($start, $interval, $recurrences, $options);

        $this->assertSame(
            $this->standardizeDates($expected),
            $this->standardizeDates($period),
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

    #[DataProvider('dataForStartDateAndRecurrences')]
    public function testCreateFromStartDateAndRecurrences($arguments, $expected)
    {
        $periodClass = static::$periodClass;
        [$start, $recurrences, $options] = array_pad($arguments, 4, null);

        $start = Carbon::parse($start);

        $period = $periodClass::create($start, $recurrences, $options);

        $this->assertSame(
            $this->standardizeDates($expected),
            $this->standardizeDates($period),
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
        $periodClass = static::$periodClass;
        $period = $periodClass::create(
            new DateTime('2018-04-16'),
            new DateInterval('P1M'),
            new DateTime('2018-07-15'),
        );

        $this->assertSame(
            [
                '2018-04-16 00:00:00 -04:00',
                '2018-05-16 00:00:00 -04:00',
                '2018-06-16 00:00:00 -04:00',
            ],
            $this->standardizeDates($period),
        );
    }

    #[DataProvider('dataForInvalidParameters')]
    public function testCreateFromInvalidParameters(...$arguments)
    {
        $this->expectExceptionObject(new InvalidArgumentException(
            'Invalid constructor parameters.',
        ));

        $periodClass = static::$periodClass;
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
        $periodClass = static::$periodClass;
        $period = $periodClass::create(
            '2018-03-25 1:30 Europe/Oslo',
            'PT30M',
            '2018-03-25 3:30 Europe/Oslo',
        );

        $this->assertSame(
            [
                '2018-03-25 01:30:00 +01:00',
                '2018-03-25 03:00:00 +02:00',
                '2018-03-25 03:30:00 +02:00',
            ],
            $this->standardizeDates($period),
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
        $periodClass = static::$periodClass;
        $period = $periodClass::create(
            '2018-10-28 1:30 Europe/Oslo',
            'PT30M',
            '2018-10-28 3:30 Europe/Oslo',
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
            $this->standardizeDates($period),
        );
    }

    public function testInternalVariablesCannotBeIndirectlyModified()
    {
        $periodClass = static::$periodClass;
        $period = $periodClass::create(
            $start = new DateTime('2018-04-16'),
            $interval = new DateInterval('P1M'),
            $end = new DateTime('2018-07-15'),
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
            $end = new Carbon('2018-07-15'),
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
        $periodClass = static::$periodClass;
        $period = $periodClass::createFromArray([
            '2018-03-25', 'P2D', '2018-04-01', $periodClass::EXCLUDE_END_DATE,
        ]);

        $this->assertSame('2018-03-25', $period->getStartDate()->toDateString());
        $this->assertSame('P2D', $period->getDateInterval()->spec());
        $this->assertSame('2018-04-01', $period->getEndDate()->toDateString());
        $this->assertPeriodOptions($periodClass::EXCLUDE_END_DATE, $period);
    }

    public function testCreateFromIso()
    {
        $periodClass = static::$periodClass;
        $period = $periodClass::createFromIso('R3/2018-03-25/P2D/2018-04-01', $periodClass::EXCLUDE_END_DATE);

        $this->assertSame('2018-03-25', $period->getStartDate()->toDateString());
        $this->assertSame('P2D', $period->getDateInterval()->spec());
        $this->assertSame('2018-04-01', $period->getEndDate()->toDateString());
        $this->assertSame(3, $period->getRecurrences());
        $this->assertPeriodOptions($periodClass::EXCLUDE_END_DATE, $period);
    }

    public function testCreateEmpty()
    {
        $periodClass = static::$periodClass;
        $period = new $periodClass();

        $this->assertEquals(new Carbon(), $period->getStartDate());
        $this->assertSame('P1D', $period->getDateInterval()->spec());
        $this->assertNull($period->getEndDate());
        $this->assertNull($period->getRecurrences());
        $this->assertPeriodOptions(0, $period);
    }

    public function testCreateFromDateStringsWithTimezones()
    {
        $periodClass = static::$periodClass;
        $periodClass = \Carbon\CarbonPeriodImmutable::class;
        $period = $periodClass::create(
            $start = '2018-03-25 10:15:30 Europe/Oslo',
            $end = '2018-03-28 17:25:30 Asia/Kamchatka',
        );

        $this->assertSame('2018-03-25 10:15:30 Europe/Oslo', $period->first()->format('Y-m-d H:i:s e'));
        $this->assertSame('2018-03-27 10:15:30 Europe/Oslo', $period->last()->format('Y-m-d H:i:s e'));
        $this->assertSame($start, $period->getStartDate()->format('Y-m-d H:i:s e'));
        $this->assertSame($end, $period->getEndDate()->format('Y-m-d H:i:s e'));

        $period = $periodClass::create(
            '2024-01-01',
            '2024-01-05',
            \Carbon\CarbonTimeZone::create('Australia/Melbourne'),
        );
        $this->assertSame('Australia/Melbourne', $period->first()->timezone->getName());
        $this->assertSame('Australia/Melbourne', $period->last()->timezone->getName());
        $this->assertSame('Australia/Melbourne', $period->getStartDate()->timezone->getName());
        $this->assertSame('Australia/Melbourne', $period->getEndDate()->timezone->getName());
        $this->assertSame('2024-01-01 00:00:00 Australia/Melbourne', $period->first()->format('Y-m-d H:i:s e'));
        $this->assertSame('2024-01-05 00:00:00 Australia/Melbourne', $period->last()->format('Y-m-d H:i:s e'));
        $this->assertSame('2024-01-01 00:00:00 Australia/Melbourne', $period->getStartDate()->format('Y-m-d H:i:s e'));
        $this->assertSame('2024-01-05 00:00:00 Australia/Melbourne', $period->getEndDate()->format('Y-m-d H:i:s e'));

        $period = $periodClass::create(
            '2024-01-01',
            '2024-01-05',
            'Australia/Melbourne',
        );
        $this->assertSame('Australia/Melbourne', $period->first()->timezone->getName());
        $this->assertSame('Australia/Melbourne', $period->last()->timezone->getName());
        $this->assertSame('Australia/Melbourne', $period->getStartDate()->timezone->getName());
        $this->assertSame('Australia/Melbourne', $period->getEndDate()->timezone->getName());
        $this->assertSame('2024-01-01 00:00:00 Australia/Melbourne', $period->first()->format('Y-m-d H:i:s e'));
        $this->assertSame('2024-01-05 00:00:00 Australia/Melbourne', $period->last()->format('Y-m-d H:i:s e'));
        $this->assertSame('2024-01-01 00:00:00 Australia/Melbourne', $period->getStartDate()->format('Y-m-d H:i:s e'));
        $this->assertSame('2024-01-05 00:00:00 Australia/Melbourne', $period->getEndDate()->format('Y-m-d H:i:s e'));
    }

    public function testCreateWithIntervalInFromStringFormat()
    {
        $periodClass = static::$periodClass;
        $period = $periodClass::create(
            '2018-03-25 12:00',
            '2 days 10 hours',
            '2018-04-01 13:30',
        );

        $this->assertSame(
            $this->standardizeDates(['2018-03-25 12:00', '2018-03-27 22:00', '2018-03-30 08:00']),
            $this->standardizeDates($period),
        );

        $period = $periodClass::create(
            '2018-04-21',
            '3 days',
            '2018-04-27',
        );

        $this->assertSame(
            $this->standardizeDates(['2018-04-21 00:00', '2018-04-24 00:00', '2018-04-27 00:00']),
            $this->standardizeDates($period),
        );
    }

    public function testCreateFromRelativeDates()
    {
        $periodClass = static::$periodClass;
        $period = $periodClass::create(
            $start = 'previous friday',
            $end = '+6 days',
        );

        $this->assertEquals(new Carbon($start), $period->getStartDate());
        $this->assertEquals(new Carbon($end), $period->getEndDate());
    }

    public function testCreateFromCarbonInstances()
    {
        $date1 = Carbon::parse('2018-06-01');
        $date2 = Carbon::parse('2018-06-10');
        $period = $date1->toPeriod($date2, 'P1D');

        $this->assertSame(24.0, $period->getDateInterval()->totalHours);
        $this->assertInstanceOf(Carbon::class, $period->getStartDate());
        $this->assertSame('2018-06-01', $period->getStartDate()->format('Y-m-d'));
        $this->assertInstanceOf(Carbon::class, $period->getEndDate());
        $this->assertSame('2018-06-10', $period->getEndDate()->format('Y-m-d'));

        $period = Carbon::create('2019-01-02')->toPeriod(7);

        $this->assertSame(24.0, $period->getDateInterval()->totalHours);
        $this->assertInstanceOf(Carbon::class, $period->getStartDate());
        $this->assertSame('2019-01-02', $period->getStartDate()->format('Y-m-d'));
        $this->assertNull($period->getEndDate());
        $this->assertSame(7, $period->getRecurrences());
        $end = $period->calculateEnd();
        $this->assertInstanceOf(Carbon::class, $end);
        $this->assertSame('2019-01-08', $end->format('Y-m-d'));

        $period = Carbon::create('2019-01-02')->toPeriod('2019-02-05');

        $this->assertNull($period->getRecurrences());
        $this->assertSame(24.0, $period->getDateInterval()->totalHours);
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

        $this->assertSame(24.0, $period->getDateInterval()->totalHours);
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
        $this->assertSame(1.0, $period->getDateInterval()->totalHours);

        $this->assertSame('1 minute', Carbon::create('2019-01-02')->minutesUntil('2019-02-05')->getDateInterval()->forHumans());
        $this->assertSame('3 minutes', Carbon::create('2019-01-02')->minutesUntil('2019-02-05', 3)->getDateInterval()->forHumans());
        $this->assertSame('3 seconds', Carbon::create('2019-01-02')->range('2019-02-05', 3, 'seconds')->getDateInterval()->forHumans());
        $this->assertSame('1 second', Carbon::create('2019-01-02')->secondsUntil('2019-02-05')->getDateInterval()->forHumans());
        $this->assertSame(1.0, Carbon::create('2019-01-02')->millisecondsUntil('2019-02-05')->getDateInterval()->totalMilliseconds);
        $this->assertSame(1.0, Carbon::create('2019-01-02')->microsecondsUntil('2019-02-05')->getDateInterval()->totalMicroseconds);
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
            'Method unknownUnitsUntil does not exist.',
        ));

        /** @var object $date */
        $date = Carbon::create('2019-01-02');
        $date->unknownUnitsUntil('2019-02-05');
    }

    public function testInstance()
    {
        $periodClass = static::$periodClass;
        $source = new DatePeriod(
            new DateTime('2012-07-01'),
            CarbonInterval::days(2),
            new DateTime('2012-07-07'),
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
        $periodClass = static::$periodClass;
        $carbonClass = $periodClass === CarbonPeriodImmutable::class
            ? CarbonImmutable::class
            : Carbon::class;
        $period = $carbonClass::create('2019-01-02')->daysUntil(endDate: '2019-02-05');
        $this->assertInstanceOf($periodClass, $period);
        $this->assertSame('2019-01-02', $period->getStartDate()->format('Y-m-d'));
        $this->assertSame('2019-02-05', $period->getEndDate()->format('Y-m-d'));
        $this->assertSame('1 day', (string) $period->getDateInterval());

        $period = $carbonClass::create('2019-01-02')->hoursUntil(endDate: '2019-02-05', factor: 12);
        $this->assertInstanceOf($periodClass, $period);
        $this->assertSame('2019-01-02', $period->getStartDate()->format('Y-m-d'));
        $this->assertSame('2019-02-05', $period->getEndDate()->format('Y-m-d'));
        $this->assertSame('12 hours', (string) $period->getDateInterval());
    }

    public function testCast()
    {
        $periodClass = static::$periodClass;
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
            'DateTime has not the instance() method needed to cast the date.',
        ));

        $periodClass = static::$periodClass;
        $periodClass::create('2010-08-24', CarbonInterval::weeks(2), '2012-07-19')
            ->cast(DateTime::class);
    }

    public function testMake()
    {
        $periodClass = static::$periodClass;
        $period = $periodClass::make(new DatePeriod(
            new DateTime('2012-07-01'),
            CarbonInterval::days(2),
            new DateTime('2012-07-07'),
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
            'Argument 1 passed to '.static::$periodClass.'::instance() '.
            'must be an instance of DatePeriod or '.static::$periodClass.', string given.',
        ));

        $periodClass = static::$periodClass;
        $periodClass::instance('hello');
    }

    public function testInstanceInvalidInstance()
    {
        $this->expectExceptionObject(new NotAPeriodException(
            'Argument 1 passed to '.static::$periodClass.'::instance() '.
            'must be an instance of DatePeriod or '.static::$periodClass.', instance of Carbon\Carbon given.',
        ));

        $periodClass = static::$periodClass;
        $periodClass::instance(Carbon::now());
    }

    public function testMutability()
    {
        $this->assertSame(
            [Carbon::class, Carbon::class, Carbon::class],
            iterator_to_array(
                CarbonPeriod::between(Carbon::today(), Carbon::today()->addDays(2))->map('get_class'),
            ),
        );
        $this->assertSame(
            [Carbon::class, Carbon::class, Carbon::class],
            iterator_to_array(
                CarbonPeriod::between(CarbonImmutable::today(), CarbonImmutable::today()->addDays(2))->map('get_class'),
            ),
        );
        $this->assertSame(
            [Carbon::class, Carbon::class, Carbon::class],
            iterator_to_array(
                CarbonPeriod::between('today', 'today + 2 days')->map('get_class'),
            ),
        );
        $this->assertSame(
            [CarbonImmutable::class, CarbonImmutable::class, CarbonImmutable::class],
            iterator_to_array(
                CarbonPeriodImmutable::between(Carbon::today(), Carbon::today()->addDays(2))->map(get_class(...)),
            ),
        );
        $this->assertSame(
            [CarbonImmutable::class, CarbonImmutable::class, CarbonImmutable::class],
            iterator_to_array(
                CarbonPeriodImmutable::between(CarbonImmutable::today(), CarbonImmutable::today()->addDays(2))->map('get_class'),
            ),
        );
        $this->assertSame(
            [CarbonImmutable::class, CarbonImmutable::class, CarbonImmutable::class],
            iterator_to_array(
                CarbonPeriodImmutable::between('today', 'today + 2 days')->map('get_class'),
            ),
        );
    }

    public function testEnums()
    {
        $periodClass = static::$periodClass;
        $immutable = ($periodClass === CarbonPeriodImmutable::class);
        /** @var CarbonPeriod $period */
        $period = $periodClass::create(Month::January, Unit::Month, Month::June);

        $this->assertTrue($period->isStartIncluded());
        $this->assertTrue($period->isEndIncluded());
        $carbonClass = $immutable ? CarbonImmutable::class : Carbon::class;

        $this->assertSame(
            array_fill(0, 6, $carbonClass),
            iterator_to_array($period->map(get_class(...))),
        );
        $this->assertSame(
            ['01-01', '02-01', '03-01', '04-01', '05-01', '06-01'],
            iterator_to_array($period->map(static fn (CarbonInterface $date) => $date->format('m-d'))),
        );

        $result = $period->setDateInterval(Unit::Week);

        if ($immutable) {
            $this->assertSame(6, $period->count());

            $period = $result;
        }

        $this->assertSame(22, $period->count());

        $result = $period->setDateInterval(3, Unit::Week);

        if ($immutable) {
            $this->assertSame(22, $period->count());

            $period = $result;
        }

        $this->assertSame(8, $period->count());

        $result = $period->setDateInterval(Unit::Quarter);

        if ($immutable) {
            $this->assertSame(8, $period->count());

            $period = $result;
        }

        $this->assertSame(2, $period->count());
    }

    public function testStartAndEndFallback()
    {
        Carbon::setTestNow('2024-06-15');

        $this->assertSame([
            '2024-09-01',
            '2024-09-30',
        ], [
            Carbon::parse('Sep 1')->toPeriod('Sep 30')->start->format('Y-m-d'),
            Carbon::parse('Sep 1')->toPeriod('Sep 30')->end->format('Y-m-d'),
        ]);

        $periodClass = static::$periodClass;
        $period = new $periodClass('Sep 1', 'Sep 30');

        $this->assertSame([
            '2024-09-01',
            '2024-09-30',
        ], [
            $period->start->format('Y-m-d'),
            $period->end->format('Y-m-d'),
        ]);

        $period = new $periodClass('Sep 1');

        $this->assertSame([
            '2024-09-01',
            null,
        ], [
            $period->start->format('Y-m-d'),
            $period->end?->format('Y-m-d'),
        ]);
    }

    public function testSlashFormat()
    {
        $periodClass = static::$periodClass;
        $period = $periodClass::create('2024-09-01/3 days/2024-09-30');

        $this->assertSame('+3', $period->interval->format('%R%d'));
        $this->assertSame('3 days', $period->dateInterval->forHumans());
        $this->assertSame([
            '2024-09-01',
            '2024-09-30',
        ], [
            $period->start->format('Y-m-d'),
            $period->end->format('Y-m-d'),
        ]);
    }

    public function testInvalidTimezone()
    {
        $this->expectExceptionObject(new InvalidPeriodParameterException(
            'Invalid constructor parameters.',
        ));

        $periodClass = static::$periodClass;
        new $periodClass('2024-09-01', '3 days', '2024-09-30', 'America/Tokyo');
    }
}
