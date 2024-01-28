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

namespace Tests\CarbonInterval;

use Carbon\Carbon;
use Carbon\CarbonInterval;
use Carbon\CarbonPeriod;
use Carbon\Exceptions\InvalidFormatException;
use DateTimeZone;
use Generator;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\AbstractTestCase;

class ToPeriodTest extends AbstractTestCase
{
    #[DataProvider('dataForToPeriodParameters')]
    public function testConvertToDatePeriod($interval, $arguments, $expected)
    {
        $period = ([$interval, 'toPeriod'])(...$arguments);

        $this->assertInstanceOf(CarbonPeriod::class, $period);

        $this->assertSame($expected, $period->spec());
    }

    public static function dataForToPeriodParameters(): Generator
    {
        yield [
                CarbonInterval::days(3),
                ['2017-10-15', 4],
                'R4/2017-10-15T00:00:00-04:00/P3D',
            ];
        yield [
                CarbonInterval::hours(7),
                ['2017-10-15', '2017-10-17'],
                '2017-10-15T00:00:00-04:00/PT7H/2017-10-17T00:00:00-04:00',
            ];
        yield [
                CarbonInterval::months(3)->days(2)->hours(10)->minutes(20),
                ['2017-10-15'],
                '2017-10-15T00:00:00-04:00/P3M2DT10H20M',
            ];
        yield [
                CarbonInterval::minutes(30),
                [new Carbon('2018-05-14 17:30 UTC'), new Carbon('2018-05-14 18:00 Europe/Oslo')],
                '2018-05-14T17:30:00+00:00/PT30M/2018-05-14T18:00:00+02:00',
            ];
    }

    public function testToDatePeriodWithTimezone(): void
    {
        $period = CarbonInterval::minutes(30)
            ->setTimezone('Asia/Tokyo')
            ->toPeriod('2021-08-14 00:00', '2021-08-14 02:00');

        $this->assertSame('2021-08-14 00:00 Asia/Tokyo', $period->start()->format('Y-m-d H:i e'));
        $this->assertSame('2021-08-14 02:00 Asia/Tokyo', $period->end()->format('Y-m-d H:i e'));

        $period = CarbonInterval::minutes(30)
            ->setTimezone(new DateTimeZone('America/New_York'))
            ->toPeriod('2021-08-14 00:00', '2021-08-14 02:00');

        $this->assertSame('2021-08-14 00:00 America/New_York', $period->start()->format('Y-m-d H:i e'));
        $this->assertSame('2021-08-14 02:00 America/New_York', $period->end()->format('Y-m-d H:i e'));
    }

    public function testStepBy(): void
    {
        $days = [];

        foreach (Carbon::parse('2020-08-29')->diff('2020-09-02')->stepBy('day') as $day) {
            $days[] = "$day";
        }

        $this->assertSame([
            '2020-08-29 00:00:00',
            '2020-08-30 00:00:00',
            '2020-08-31 00:00:00',
            '2020-09-01 00:00:00',
            '2020-09-02 00:00:00',
        ], $days);

        $times = [];

        foreach (Carbon::parse('2020-08-29')->diff('2020-08-31')->stepBy('12 hours') as $time) {
            $times[] = "$time";
        }

        $this->assertSame([
            '2020-08-29 00:00:00',
            '2020-08-29 12:00:00',
            '2020-08-30 00:00:00',
            '2020-08-30 12:00:00',
            '2020-08-31 00:00:00',
        ], $times);

        $days = [];
        /** @var CarbonPeriod $period */
        $period = Carbon::parse('2020-08-29')->diff('2020-09-02')->stepBy('day');

        foreach ($period->excludeEndDate() as $day) {
            $days[] = "$day";
        }

        $this->assertSame([
            '2020-08-29 00:00:00',
            '2020-08-30 00:00:00',
            '2020-08-31 00:00:00',
            '2020-09-01 00:00:00',
        ], $days);

        Carbon::setTestNow('2020-08-12 06:00:50');
        $days = [];

        foreach (CarbonInterval::week()->stepBy('day') as $day) {
            $days[] = "$day";
        }

        $this->assertSame([
            '2020-08-12 06:00:50',
            '2020-08-13 06:00:50',
            '2020-08-14 06:00:50',
            '2020-08-15 06:00:50',
            '2020-08-16 06:00:50',
            '2020-08-17 06:00:50',
            '2020-08-18 06:00:50',
            '2020-08-19 06:00:50',
        ], $days);

        Carbon::setTestNow(null);
    }

    public function testStepByError()
    {
        $this->expectExceptionObject(new InvalidFormatException(
            'Could not create interval from: '.var_export('1/2 days', true),
        ));

        CarbonInterval::week()->stepBy('1/2 days');
    }
}
