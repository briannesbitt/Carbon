<?php
declare(strict_types=1);

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

        $this->assertEquals($expected, $result, "'$string' does not return expected interval.");
    }

    public function provideValidStrings()
    {
        return [
            // zero interval
            ['', new CarbonInterval(0)],

            // single values
            ['1y', new CarbonInterval(1)],
            ['1mo', new CarbonInterval(0, 1)],
            ['1w', new CarbonInterval(0, 0, 1)],
            ['1d', new CarbonInterval(0, 0, 0, 1)],
            ['1h', new CarbonInterval(0, 0, 0, 0, 1)],
            ['1m', new CarbonInterval(0, 0, 0, 0, 0, 1)],
            ['1s', new CarbonInterval(0, 0, 0, 0, 0, 0, 1)],
            ['1ms', new CarbonInterval(0, 0, 0, 0, 0, 0, 0, 1000)],
            ['1µs', new CarbonInterval(0, 0, 0, 0, 0, 0, 0, 1)],

            // single values with space
            ['1 y', new CarbonInterval(1)],
            ['1 mo', new CarbonInterval(0, 1)],
            ['1 w', new CarbonInterval(0, 0, 1)],

            // fractions with integer result
            ['0.571428571429w', new CarbonInterval(0, 0, 0, 4)],
            ['0.5d', new CarbonInterval(0, 0, 0, 0, 12)],
            ['0.5h', new CarbonInterval(0, 0, 0, 0, 0, 30)],
            ['0.5m', new CarbonInterval(0, 0, 0, 0, 0, 0, 30)],

            // fractions with float result
            ['1.5w', new CarbonInterval(0, 0, 1, 3, 12)],
            ['2.34d', new CarbonInterval(0, 0, 0, 2, 8, 9, 36)],
            ['3.12h', new CarbonInterval(0, 0, 0, 0, 3, 7, 12)],
            ['3.129h', new CarbonInterval(0, 0, 0, 0, 3, 7, 44, 400000)],
            ['4.24m', new CarbonInterval(0, 0, 0, 0, 0, 4, 14, 400000)],
            ['3.56s', new CarbonInterval(0, 0, 0, 0, 0, 0, 3, 560000)],
            ['3.56ms', new CarbonInterval(0, 0, 0, 0, 0, 0, 0, 3560)],

            // combinations
            ['2w 3d', new CarbonInterval(0, 0, 0, 17)],
            ['1y 2mo 1.5w 3d', new CarbonInterval(1, 2, 1, 6, 12)],

            // multi same values
            ['1y 2y', new CarbonInterval(3)],
            ['1mo 20mo', new CarbonInterval(0, 21)],
            ['1w 2w 3w', new CarbonInterval(0, 0, 6)],
            ['10d 20d 30d', new CarbonInterval(0, 0, 0, 60)],
            ['5h 15h 25h', new CarbonInterval(0, 0, 0, 0, 45)],
            ['3m 3m 3m 1m', new CarbonInterval(0, 0, 0, 0, 0, 10)],
            ['55s 45s 1s 2s 3s 4s', new CarbonInterval(0, 0, 0, 0, 0, 0, 110)],
            ['1500ms 1623555µs', new CarbonInterval(0, 0, 0, 0, 0, 0, 0, 3123555)],
            ['430 milli', new CarbonInterval(0, 0, 0, 0, 0, 0, 0, 430000)],

            // multi same values with space
            ['1 y 2 y', new CarbonInterval(3)],
            ['1 mo 20 mo', new CarbonInterval(0, 21)],
            ['1 w      2  w       3    w', new CarbonInterval(0, 0, 6)],

            // no-space values
            ['2w3d', new CarbonInterval(0, 0, 0, 17)],
            ['1y2mo3w4d5h6m7s', new CarbonInterval(1, 2, 3, 4, 5, 6, 7)],

            // written-out units
            ['1year 2month 3week 4day 5hour 6minute 7second', new CarbonInterval(1, 2, 3, 4, 5, 6, 7)],
            ['1 year 2 month 3 week', new CarbonInterval(1, 2, 3)],
            ['2 Years 3 Months 4 Weeks', new CarbonInterval(2, 3, 4)],
            ['5 Days 6 Hours 7 Minutes 8 Seconds', new CarbonInterval(0, 0, 0, 5, 6, 7, 8)],

            // ignore invalid format; parse only [num][char-format] or [num] [char-format]
            ['Hello! Please add 1y2w to ...', new CarbonInterval(1, 0, 2)],
            ['nothing to parse :(', new CarbonInterval(0)],

            // case insensitive
            ['1Y 3MO 1W 3D 12H 23M 42S', new CarbonInterval(1, 3, 1, 3, 12, 23, 42)],
        ];
    }

    /**
     * @dataProvider provideInvalidStrings
     *
     * @param string $string
     * @param string $part
     */
    public function testThrowsExceptionForUnknownValues($string, $part)
    {
        $message = null;

        try {
            CarbonInterval::fromString($string);
        } catch (\InvalidArgumentException $exception) {
            $message = $exception->getMessage();
        }

        $this->assertStringContainsString($part, $message);
    }

    public function provideInvalidStrings()
    {
        return [
            ['1q', '1q'],
            ['about 12..14m', '12..'],
            ['4h 13', '13'],
        ];
    }
}
