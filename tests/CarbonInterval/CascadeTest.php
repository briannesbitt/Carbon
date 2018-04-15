<?php

namespace Tests\CarbonInterval;

use Carbon\CarbonInterval;
use Tests\AbstractTestCase;

class CascadeTest extends AbstractTestCase
{
    /**
     * @dataProvider provideIntervalSpecs
     */
    public function testCascadesOverflowedValues($spec, $expected)
    {
        $this->assertSame(
            $expected, CarbonInterval::fromString($spec)->cascade()->spec()
        );
    }

    public function provideIntervalSpecs()
    {
        return array(
            array('3600s',                        'PT1H'),
            array('10000s',                       'PT2H46M40S'),
            array('1276d',                        'P3Y6M16D'),
            array('47d 14h',                      'P1M17DT14H'),
            array('2y 123mo 5w 6d 47h 160m 217s', 'P12Y4M13DT1H43M37S'),
        );
    }
}
