<?php

namespace Tests\CarbonInterval;

use Carbon\CarbonInterval;
use Tests\AbstractTestCase;

class FromStringTest extends AbstractTestCase
{
    /**
     * @dataProvider provideValidStrings
     *
     * @param string         $string
     * @param CarbonInterval $expected
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
            array('', new CarbonInterval(0)),

            // single values
            array('1y', new CarbonInterval(1)),
            array('1mo', new CarbonInterval(0, 1)),
            array('1w', new CarbonInterval(0, 0, 1)),
            array('1d', new CarbonInterval(0, 0, 0, 1)),
            array('1h', new CarbonInterval(0, 0, 0, 0, 1)),
            array('1m', new CarbonInterval(0, 0, 0, 0, 0, 1)),
            array('1s', new CarbonInterval(0, 0, 0, 0, 0, 0, 1)),

            // single values with space
            array('1 y', new CarbonInterval(1)),
            array('1 mo', new CarbonInterval(0, 1)),
            array('1 w', new CarbonInterval(0, 0, 1)),

            // fractions with integer result
            array('0.571428572w', new CarbonInterval(0, 0, 0, 4)),
            array('0.5d', new CarbonInterval(0, 0, 0, 0, 12)),
            array('0.5h', new CarbonInterval(0, 0, 0, 0, 0, 30)),
            array('0.5m', new CarbonInterval(0, 0, 0, 0, 0, 0, 30)),

            // fractions with float result
            array('1.5w', new CarbonInterval(0, 0, 1, 3, 12)),
            array('2.34d', new CarbonInterval(0, 0, 0, 2, 8, 9, 36)),
            array('3.12h', new CarbonInterval(0, 0, 0, 0, 3, 7, 12)),
            array('3.129h', new CarbonInterval(0, 0, 0, 0, 3, 7, 44)),
            array('4.24m', new CarbonInterval(0, 0, 0, 0, 0, 4, 14)),

            // combinations
            array('2w 3d', new CarbonInterval(0, 0, 0, 17)),
            array('1y 2mo 1.5w 3d', new CarbonInterval(1, 2, 1, 6, 12)),

            // multi same values
            array('1y 2y', new CarbonInterval(3)),
            array('1mo 20mo', new CarbonInterval(0, 21)),
            array('1w 2w 3w', new CarbonInterval(0, 0, 6)),
            array('10d 20d 30d', new CarbonInterval(0, 0, 0, 60)),
            array('5h 15h 25h', new CarbonInterval(0, 0, 0, 0, 45)),
            array('3m 3m 3m 1m', new CarbonInterval(0, 0, 0, 0, 0, 10)),
            array('55s 45s 1s 2s 3s 4s', new CarbonInterval(0, 0, 0, 0, 0, 0, 110)),

            // multi same values with space
            array('1 y 2 y', new CarbonInterval(3)),
            array('1 mo 20 mo', new CarbonInterval(0, 21)),
            array('1 w      2  w       3    w', new CarbonInterval(0, 0, 6)),

            // no-space values
            array('2w3d', new CarbonInterval(0, 0, 0, 17)),
            array('1y2mo3w4d5h6m7s', new CarbonInterval(1, 2, 3, 4, 5, 6, 7)),

            // written-out units
            array('1year 2month 3week 4day 5hour 6minute 7second', new CarbonInterval(1, 2, 3, 4, 5, 6, 7)),
            array('1 year 2 month 3 week', new CarbonInterval(1, 2, 3)),
            array('2 Years 3 Months 4 Weeks', new CarbonInterval(2, 3, 4)),
            array('5 Days 6 Hours 7 Minutes 8 Seconds', new CarbonInterval(0, 0, 0, 5, 6, 7, 8)),

            // ignore invalid format; parse only [num][char-format] or [num] [char-format]
            array('Hello! Please add 1y2w to ...', new CarbonInterval(1, 0, 2)),
            array('nothing to parse :(', new CarbonInterval(0)),

            // case insenstive
            array('1Y 3MO 1W 3D 12H 23M 42S', new CarbonInterval(1, 3, 1, 3, 12, 23, 42)),
        );
    }

    /**
     * @dataProvider provideInvalidStrings
     * @expectedException \InvalidArgumentException
     *
     * @param string $string
     * @param string $part
     */
    public function testThrowsExceptionForUnknownValues($string, $part)
    {
        try {
            CarbonInterval::fromString($string);
        } catch (\InvalidArgumentException $exception) {
            $this->assertContains($part, $exception->getMessage());
            throw $exception;
        }
    }

    public function provideInvalidStrings()
    {
        return array(
            array('1q', '1q'),
            array('about 12..14m', '12..'),
            array('4h 13', '13'),
        );
    }
}
