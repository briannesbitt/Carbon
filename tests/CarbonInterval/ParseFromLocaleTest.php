<?php
declare(strict_types=1);

namespace Tests\CarbonInterval;

use Carbon\CarbonInterval;
use Tests\AbstractTestCase;

class ParseFromLocaleTest extends AbstractTestCase
{
    /**
     * @dataProvider provideValidStrings
     *
     * @param string         $string
     * @param string         $locale
     * @param CarbonInterval $expected
     */
    public function testReturnsInterval($string, $locale, $expected)
    {
        $result = CarbonInterval::parseFromLocale($string, $locale);

        $this->assertEquals($expected, $result, "'{$string}' does not return expected interval.");
    }

    public function provideValidStrings()
    {
        return [
            // zero interval
            ['', 'en', new CarbonInterval(0)],

            // single values
            ['1y', 'en', new CarbonInterval(1)],
            ['1mo', 'en', new CarbonInterval(0, 1)],
            ['1w', 'en', new CarbonInterval(0, 0, 1)],
            ['1d', 'en', new CarbonInterval(0, 0, 0, 1)],
            ['1h', 'en', new CarbonInterval(0, 0, 0, 0, 1)],
            ['1m', 'en', new CarbonInterval(0, 0, 0, 0, 0, 1)],
            ['1s', 'en', new CarbonInterval(0, 0, 0, 0, 0, 0, 1)],
            ['1ms', 'en', new CarbonInterval(0, 0, 0, 0, 0, 0, 0, 1000)],
            ['1µs', 'en', new CarbonInterval(0, 0, 0, 0, 0, 0, 0, 1)],

            // single values with space
            ['1 y', 'en', new CarbonInterval(1)],
            ['1 mo', 'en', new CarbonInterval(0, 1)],
            ['1 w', 'en', new CarbonInterval(0, 0, 1)],

            // fractions with integer result
            ['0.571428571429w', 'en', new CarbonInterval(0, 0, 0, 4)],
            ['0.5d', 'en', new CarbonInterval(0, 0, 0, 0, 12)],
            ['0.5h', 'en', new CarbonInterval(0, 0, 0, 0, 0, 30)],
            ['0.5m', 'en', new CarbonInterval(0, 0, 0, 0, 0, 0, 30)],

            // fractions with float result
            ['1.5w', 'en', new CarbonInterval(0, 0, 1, 3, 12)],
            ['2.34d', 'en', new CarbonInterval(0, 0, 0, 2, 8, 9, 36)],
            ['3.12h', 'en', new CarbonInterval(0, 0, 0, 0, 3, 7, 12)],
            ['3.129h', 'en', new CarbonInterval(0, 0, 0, 0, 3, 7, 44, 400000)],
            ['4.24m', 'en', new CarbonInterval(0, 0, 0, 0, 0, 4, 14, 400000)],
            ['3.56s', 'en', new CarbonInterval(0, 0, 0, 0, 0, 0, 3, 560000)],
            ['3.56ms', 'en', new CarbonInterval(0, 0, 0, 0, 0, 0, 0, 3560)],

            // combinations
            ['2w 3d', 'en', new CarbonInterval(0, 0, 0, 17)],
            ['1y 2mo 1.5w 3d', 'en', new CarbonInterval(1, 2, 1, 6, 12)],

            // multi same values
            ['1y 2y', 'en', new CarbonInterval(3)],
            ['1mo 20mo', 'en', new CarbonInterval(0, 21)],
            ['1w 2w 3w', 'en', new CarbonInterval(0, 0, 6)],
            ['10d 20d 30d', 'en', new CarbonInterval(0, 0, 0, 60)],
            ['5h 15h 25h', 'en', new CarbonInterval(0, 0, 0, 0, 45)],
            ['3m 3m 3m 1m', 'en', new CarbonInterval(0, 0, 0, 0, 0, 10)],
            ['55s 45s 1s 2s 3s 4s', 'en', new CarbonInterval(0, 0, 0, 0, 0, 0, 110)],
            ['1500ms 1623555µs', 'en', new CarbonInterval(0, 0, 0, 0, 0, 0, 0, 3123555)],
            ['430 milli', 'en', new CarbonInterval(0, 0, 0, 0, 0, 0, 0, 430000)],

            // multi same values with space
            ['1 y 2 y', 'en', new CarbonInterval(3)],
            ['1 mo 20 mo', 'en', new CarbonInterval(0, 21)],
            ['1 w      2  w       3    w', 'en', new CarbonInterval(0, 0, 6)],

            // no-space values
            ['2w3d', 'en', new CarbonInterval(0, 0, 0, 17)],
            ['1y2mo3w4d5h6m7s', 'en', new CarbonInterval(1, 2, 3, 4, 5, 6, 7)],

            // written-out units
            ['1year 2month 3week 4day 5hour 6minute 7second', 'en', new CarbonInterval(1, 2, 3, 4, 5, 6, 7)],
            ['1 year 2 month 3 week', 'en', new CarbonInterval(1, 2, 3)],
            ['2 Years 3 Months 4 Weeks', 'en', new CarbonInterval(2, 3, 4)],
            ['5 Days 6 Hours 7 Minutes 8 Seconds', 'en', new CarbonInterval(0, 0, 0, 5, 6, 7, 8)],

            // ignore invalid format; parse only [num][char-format] or [num] [char-format]
            ['Hello! Please add 1y2w to ...', 'en', new CarbonInterval(1, 0, 2)],
            ['nothing to parse :(', 'en', new CarbonInterval(0)],

            // case insensitive
            ['1Y 3MO 1W 3D 12H 23M 42S', 'en', new CarbonInterval(1, 3, 1, 3, 12, 23, 42)],

            // Example for the ticket (#1756)
            ['2 jours 3 heures', 'fr', new CarbonInterval(0, 0, 0, 2, 3, 0, 0)],
        ];
    }

    /**
     * @dataProvider provideInvalidStrings
     *
     * @param string $string
     * @param string $part
     * @param string $locale
     */
    public function testThrowsExceptionForUnknownValues($string, $part, $locale)
    {
        $message = null;

        try {
            CarbonInterval::parseFromLocale($string, $locale);
        } catch (\InvalidArgumentException $exception) {
            $message = $exception->getMessage();
        }

        $this->assertStringContainsString($part, $message);
    }

    public function provideInvalidStrings()
    {
        return [
            ['1q', '1q', 'en'],
            ['about 12..14m', '12..', 'en'],
            ['4h 13', '13', 'en'],
        ];
    }
}
