<?php

namespace Tests\CarbonInterval;

use Carbon\CarbonInterval;
use Tests\AbstractTestCase;

class FromStringTest extends AbstractTestCase
{
    /**
     * @dataProvider provideValidStrings
     * @param $string
     * @param $expected
     */
    public function testReturnsInterval($string, $expected)
    {
        $result = CarbonInterval::fromString($string);

        $this->assertEquals($expected, $result);
    }

    public function provideValidStrings()
    {
        return array(
            // zero interval
            array( '', new CarbonInterval(0) ),

            // single values
            array( '1y', new CarbonInterval(1) ),
            array( '1M', new CarbonInterval(0, 1) ),
            array( '1w', new CarbonInterval(0, 0, 1) ),
            array( '1d', new CarbonInterval(0, 0, 0, 1) ),
            array( '1h', new CarbonInterval(0, 0, 0, 0, 1) ),
            array( '1m', new CarbonInterval(0, 0, 0, 0, 0, 1) ),
            array( '1s', new CarbonInterval(0, 0, 0, 0, 0, 0, 1) ),

            // fractions with integer result
            array( '0.571428571w', new CarbonInterval(0, 0, 0, 4) ),
            array( '0.5d', new CarbonInterval(0, 0, 0, 0, 12) ),
            array( '0.5h', new CarbonInterval(0, 0, 0, 0, 0, 30) ),
            array( '0.5m', new CarbonInterval(0, 0, 0, 0, 0, 0, 30) ),

            // fractions with float result
            array( '1.5w', new CarbonInterval(0, 0, 1, 4) ),
            array( '2.34d', new CarbonInterval(0, 0, 0, 2, 8) ),
            array( '3.12h', new CarbonInterval(0, 0, 0, 0, 3, 7) ),
            array( '3.129h', new CarbonInterval(0, 0, 0, 0, 3, 8) ),
            array( '4.24m', new CarbonInterval(0, 0, 0, 0, 0, 4, 14) ),

            // combinations
            array( '2w 3d', new CarbonInterval(0, 0, 0, 17) ),
            array( '1y 2M 1.5w 3d', new CarbonInterval(1, 2, 2, 0) ),
        );
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testThrowsExceptionForUnknownValues()
    {
        CarbonInterval::fromString('1q');
    }
}
