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

use Carbon\CarbonInterval;
use Generator;
use InvalidArgumentException;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\TestWith;
use Tests\AbstractTestCase;

class FromStringTest extends AbstractTestCase
{
    #[DataProvider('dataForValidStrings')]
    public function testReturnsInterval(string $string, CarbonInterval $expected)
    {
        $result = CarbonInterval::fromString($string);

        $this->assertEquals($expected->optimize(), $result->optimize(), "'$string' does not return expected interval.");
    }

    public static function dataForValidStrings(): Generator
    {
        // zero interval
        yield ['', new CarbonInterval(0)];

        // single values
        yield ['1y', new CarbonInterval(1)];
        yield ['1mo', new CarbonInterval(0, 1)];
        yield ['1w', new CarbonInterval(0, 0, 1)];
        yield ['1d', new CarbonInterval(0, 0, 0, 1)];
        yield ['1h', new CarbonInterval(0, 0, 0, 0, 1)];
        yield ['1m', new CarbonInterval(0, 0, 0, 0, 0, 1)];
        yield ['1s', new CarbonInterval(0, 0, 0, 0, 0, 0, 1)];
        yield ['1ms', new CarbonInterval(0, 0, 0, 0, 0, 0, 0, 1000)];
        yield ['1µs', new CarbonInterval(0, 0, 0, 0, 0, 0, 0, 1)];

        // single values with space
        yield ['1 y', new CarbonInterval(1)];
        yield ['1 mo', new CarbonInterval(0, 1)];
        yield ['1 w', new CarbonInterval(0, 0, 1)];

        // fractions with integer result
        yield ['0.571428571429w', new CarbonInterval(0, 0, 0, 4)];
        yield ['0.5d', new CarbonInterval(0, 0, 0, 0, 12)];
        yield ['0.5h', new CarbonInterval(0, 0, 0, 0, 0, 30)];
        yield ['0.5m', new CarbonInterval(0, 0, 0, 0, 0, 0, 30)];

        // fractions with float result
        yield ['1.5w', new CarbonInterval(0, 0, 1, 3, 12)];
        yield ['2.34d', new CarbonInterval(0, 0, 0, 2, 8, 9, 36)];
        yield ['3.12h', new CarbonInterval(0, 0, 0, 0, 3, 7, 12)];
        yield ['3.129h', new CarbonInterval(0, 0, 0, 0, 3, 7, 44, 400000)];
        yield ['4.24m', new CarbonInterval(0, 0, 0, 0, 0, 4, 14, 400000)];
        yield ['3.56s', new CarbonInterval(0, 0, 0, 0, 0, 0, 3, 560000)];
        yield ['3.56ms', new CarbonInterval(0, 0, 0, 0, 0, 0, 0, 3560)];

        // combinations
        yield ['2w 3d', new CarbonInterval(0, 0, 0, 17)];
        yield ['1y 2mo 1.5w 3d', new CarbonInterval(1, 2, 1, 6, 12)];

        // multi same values
        yield ['1y 2y', new CarbonInterval(3)];
        yield ['1mo 20mo', new CarbonInterval(0, 21)];
        yield ['1w 2w 3w', new CarbonInterval(0, 0, 6)];
        yield ['10d 20d 30d', new CarbonInterval(0, 0, 0, 60)];
        yield ['5h 15h 25h', new CarbonInterval(0, 0, 0, 0, 45)];
        yield ['3m 3m 3m 1m', new CarbonInterval(0, 0, 0, 0, 0, 10)];
        yield ['55s 45s 1s 2s 3s 4s', new CarbonInterval(0, 0, 0, 0, 0, 0, 110)];
        yield ['1500ms 1623555µs', new CarbonInterval(0, 0, 0, 0, 0, 0, 0, 3123555)];
        yield ['430 milli', new CarbonInterval(0, 0, 0, 0, 0, 0, 0, 430000)];

        // multi same values with space
        yield ['1 y 2 y', new CarbonInterval(3)];
        yield ['1 mo 20 mo', new CarbonInterval(0, 21)];
        yield ['1 w      2  w       3    w', new CarbonInterval(0, 0, 6)];

        // no-space values
        yield ['2w3d', new CarbonInterval(0, 0, 0, 17)];
        yield ['1y2mo3w4d5h6m7s', new CarbonInterval(1, 2, 3, 4, 5, 6, 7)];

        // written-out units
        yield ['1year 2month 3week 4day 5hour 6minute 7second', new CarbonInterval(1, 2, 3, 4, 5, 6, 7)];
        yield ['1 year 2 month 3 week', new CarbonInterval(1, 2, 3)];
        yield ['2 Years 3 Months 4 Weeks', new CarbonInterval(2, 3, 4)];
        yield ['5 Days 6 Hours 7 Minutes 8 Seconds', new CarbonInterval(0, 0, 0, 5, 6, 7, 8)];

        // ignore invalid format; parse only [num][char-format] or [num] [char-format]
        yield ['Hello! Please add 1y2w to ...', new CarbonInterval(1, 0, 2)];
        yield ['nothing to parse :(', new CarbonInterval(0)];

        // case insensitive
        yield ['1Y 3MO 1W 3D 12H 23M 42S', new CarbonInterval(1, 3, 1, 3, 12, 23, 42)];

        // big numbers
        yield ['1999999999999.5 hours', new CarbonInterval(0, 0, 0, 0, 1999999999999, 30, 0)];
        yield [(0x7fffffffffffffff).' days', new CarbonInterval(0, 0, 0, 0x7fffffffffffffff, 0, 0, 0)];
        yield ['1999999999999.5 hours -85 minutes', new CarbonInterval(0, 0, 0, 0, 1999999999999, -55, 0)];
        yield ['2.333 seconds', new CarbonInterval(0, 0, 0, 0, 0, 0, 2, 333000)];
    }

    #[TestWith(['1q', '1q'])]
    #[TestWith(['about 12..14m', '12..'])]
    #[TestWith(['4h 13', '13'])]
    public function testThrowsExceptionForUnknownValues(string $string, string $part)
    {
        $message = null;

        try {
            CarbonInterval::fromString($string);
        } catch (InvalidArgumentException $exception) {
            $message = $exception->getMessage();
        }

        $this->assertStringContainsString($part, $message);
    }
}
