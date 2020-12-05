<?php
declare(strict_types=1);

namespace Tests\CarbonInterval;

use Carbon\Carbon;
use Carbon\CarbonInterval;
use Carbon\CarbonPeriod;
use Tests\AbstractTestCase;

class ToPeriodTest extends AbstractTestCase
{
    /**
     * @dataProvider provideToPeriodParameters
     */
    public function testConvertToDatePeriod($interval, $arguments, $expected)
    {
        $period = ([$interval, 'toPeriod'])(...$arguments);

        $this->assertInstanceOf(CarbonPeriod::class, $period);

        $this->assertSame($expected, $period->spec());
    }

    public function provideToPeriodParameters()
    {
        return [
            [
                CarbonInterval::days(3),
                ['2017-10-15', 4],
                'R4/2017-10-15T00:00:00-04:00/P3D',
            ],
            [
                CarbonInterval::hours(7),
                ['2017-10-15', '2017-10-17'],
                '2017-10-15T00:00:00-04:00/PT7H/2017-10-17T00:00:00-04:00',
            ],
            [
                CarbonInterval::months(3)->days(2)->hours(10)->minutes(20),
                ['2017-10-15'],
                '2017-10-15T00:00:00-04:00/P3M2DT10H20M',
            ],
            [
                CarbonInterval::minutes(30),
                [new Carbon('2018-05-14 17:30 UTC'), new Carbon('2018-05-14 18:00 Europe/Oslo')],
                '2018-05-14T17:30:00+00:00/PT30M/2018-05-14T18:00:00+02:00',
            ],
        ];
    }

    public function testStepBy()
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
}
