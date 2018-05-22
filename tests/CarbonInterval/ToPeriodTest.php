<?php

namespace Tests\CarbonInterval;

use Carbon\Carbon;
use Carbon\CarbonInterval;
use Tests\AbstractTestCase;

class ToPeriodTest extends AbstractTestCase
{
    /**
     * @dataProvider provideToPeriodParameters
     */
    public function testConvertToDatePeriod($interval, $arguments, $expected)
    {
        $period = call_user_func_array(array($interval, 'toPeriod'), $arguments);

        $this->assertInstanceOf('Carbon\CarbonPeriod', $period);

        $this->assertSame($expected, $period->spec());
    }

    public function provideToPeriodParameters()
    {
        return array(
            array(
                CarbonInterval::days(3),
                array('2017-10-15', 4),
                'R4/2017-10-15T00:00:00-04:00/P3D',
            ),
            array(
                CarbonInterval::hours(7),
                array('2017-10-15', '2017-10-17'),
                '2017-10-15T00:00:00-04:00/PT7H/2017-10-17T00:00:00-04:00',
            ),
            array(
                CarbonInterval::months(3)->days(2)->hours(10)->minutes(20),
                array('2017-10-15'),
                '2017-10-15T00:00:00-04:00/P3M2DT10H20M',
            ),
            array(
                CarbonInterval::minutes(30),
                array(new Carbon('2018-05-14 17:30 UTC'), new Carbon('2018-05-14 18:00 Europe/Oslo')),
                '2018-05-14T17:30:00+00:00/PT30M/2018-05-14T18:00:00+02:00',
            ),
        );
    }
}
