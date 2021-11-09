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
use Generator;
use Tests\AbstractTestCase;

class ToPeriodTest extends AbstractTestCase
{
    /**
     * @dataProvider \Tests\CarbonInterval\ToPeriodTest::dataForToPeriodParameters
     */
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

        $this->assertSame('2021-08-14 00:00 Asia/Tokyo', $period->start->format('Y-m-d H:i e'));
        $this->assertSame('2021-08-14 02:00 Asia/Tokyo', $period->end->format('Y-m-d H:i e'));
    }
}
