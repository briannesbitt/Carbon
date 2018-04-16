<?php

namespace Tests\CarbonInterval;

use Carbon\Carbon;
use Carbon\CarbonInterval;
use DatePeriod;
use Tests\AbstractTestCase;

class ToPeriodTest extends AbstractTestCase
{
    protected function standarizeDates($dates)
    {
        return array_map(function ($date) {
            return Carbon::instance($date)->toDateTimeString();
        }, $dates);
    }

    /**
     * @dataProvider provideValidInput
     */
    public function testReturnsDatePeriod($interval, $arguments, $expected)
    {
        list($start, $end, $options) = array_pad($arguments, 3, 0);

        $period = $interval->toPeriod($start, $end, $options);

        $this->assertEquals(
            $this->standarizeDates($expected),
            $this->standarizeDates(iterator_to_array($period))
        );
    }

    public function provideValidInput()
    {
        $now = Carbon::now();

        $negative = CarbonInterval::days(2);
        $negative->invert = 1;

        return array(
            // Start date and recurrences.
            array(
                CarbonInterval::days(1),
                array($now, 0),
                array($now),
            ),
            array(
                CarbonInterval::days(1),
                array($now, 1),
                array($now, $now->copy()->addDay()),
            ),
            array(
                CarbonInterval::months(2),
                array($now, 2, CarbonInterval::EXCLUDE_START),
                array($now->copy()->addMonths(2), $now->copy()->addMonths(4)),
            ),
            array(
                CarbonInterval::years(3),
                array($now, 3, CarbonInterval::EXCLUDE_END),
                array($now, $now->copy()->addYears(3), $now->copy()->addYears(6)),
            ),
            array(
                CarbonInterval::hours(5),
                array($now, 2, CarbonInterval::EXCLUDE_START | CarbonInterval::EXCLUDE_END),
                array($now->copy()->addHours(5)),
            ),

            // Start and end dates.
            array(
                CarbonInterval::days(1),
                array($now, $now),
                array($now),
            ),
            array(
                CarbonInterval::minutes(15),
                array($now, $now->copy()->addMinutes(35)),
                array($now, $now->copy()->addMinutes(15), $now->copy()->addMinutes(30)),
            ),
            array(
                CarbonInterval::seconds(45),
                array($now, $now->copy()->addMinutes(2), CarbonInterval::EXCLUDE_START),
                array($now->copy()->addSeconds(45), $now->copy()->addSeconds(90)),
            ),
            array(
                CarbonInterval::hours(2),
                array($now->copy()->subHours(6), $now, CarbonInterval::EXCLUDE_END),
                array($now->copy()->subHours(6), $now->copy()->subHours(4), $now->copy()->subHours(2)),
            ),
            array(
                CarbonInterval::seconds(30),
                array($now, $now->copy()->addMinutes(2), CarbonInterval::EXCLUDE_START | CarbonInterval::EXCLUDE_END),
                array($now->copy()->addSeconds(30), $now->copy()->addSeconds(60), $now->copy()->addSeconds(90)),
            ),

            // Empty periods.
            array(
                CarbonInterval::days(1),
                array($now, -1),
                array(),
            ),
            array(
                CarbonInterval::days(1),
                array($now, $now->copy()->subSeconds(1)),
                array(),
            ),

            // Negative intervals (ignored by DatePeriod).
            array(
                $negative,
                array($now, $now->copy()->subDays(4)),
                array(),
            ),
            array(
                $negative,
                array($now, $now->copy()->addDays(4)),
                array($now, $now->copy()->addDays(2), $now->copy()->addDays(4)),
            ),

            // Complicated interval.
            array(
                CarbonInterval::days(2)->hours(10)->minutes(20),
                array($now, $now->copy()->addDays(5)),
                array($now, $now->copy()->addMinutes(3500), $now->copy()->addMinutes(7000)),
            ),
        );
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testThrowsExceptionForEmptyInterval()
    {
        CarbonInterval::create(0, 0, 0, 0, 0, 0, 0)->toPeriod(Carbon::now(), 1);
    }
}
