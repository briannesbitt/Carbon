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

class ParseFromLocaleTest extends AbstractTestCase
{
    #[DataProvider('dataForValidStrings')]
    public function testReturnsInterval(string $string, string $locale, CarbonInterval $expected)
    {
        $result = CarbonInterval::parseFromLocale($string, $locale);

        $this->assertEquals($expected->optimize(), $result->optimize(), "'{$string}' does not return expected interval.");
    }

    public static function dataForValidStrings(): Generator
    {
        // zero interval
        yield ['', 'en', new CarbonInterval(0)];

        // single values
        yield ['1y', 'en', new CarbonInterval(1)];
        yield ['1mo', 'en', new CarbonInterval(0, 1)];
        yield ['1w', 'en', new CarbonInterval(0, 0, 1)];
        yield ['1d', 'en', new CarbonInterval(0, 0, 0, 1)];
        yield ['1h', 'en', new CarbonInterval(0, 0, 0, 0, 1)];
        yield ['1m', 'en', new CarbonInterval(0, 0, 0, 0, 0, 1)];
        yield ['1s', 'en', new CarbonInterval(0, 0, 0, 0, 0, 0, 1)];
        yield ['1ms', 'en', new CarbonInterval(0, 0, 0, 0, 0, 0, 0, 1000)];
        yield ['1µs', 'en', new CarbonInterval(0, 0, 0, 0, 0, 0, 0, 1)];

        // single values with space
        yield ['1 y', 'en', new CarbonInterval(1)];
        yield ['1 mo', 'en', new CarbonInterval(0, 1)];
        yield ['1 w', 'en', new CarbonInterval(0, 0, 1)];

        // fractions with integer result
        yield ['0.571428571429w', 'en', new CarbonInterval(0, 0, 0, 4)];
        yield ['0.5d', 'en', new CarbonInterval(0, 0, 0, 0, 12)];
        yield ['0.5h', 'en', new CarbonInterval(0, 0, 0, 0, 0, 30)];
        yield ['0.5m', 'en', new CarbonInterval(0, 0, 0, 0, 0, 0, 30)];

        // fractions with float result
        yield ['1.5w', 'en', new CarbonInterval(0, 0, 1, 3, 12)];
        yield ['2.34d', 'en', new CarbonInterval(0, 0, 0, 2, 8, 9, 36)];
        yield ['3.12h', 'en', new CarbonInterval(0, 0, 0, 0, 3, 7, 12)];
        yield ['3.129h', 'en', new CarbonInterval(0, 0, 0, 0, 3, 7, 44, 400000)];
        yield ['4.24m', 'en', new CarbonInterval(0, 0, 0, 0, 0, 4, 14, 400000)];
        yield ['3.56s', 'en', new CarbonInterval(0, 0, 0, 0, 0, 0, 3, 560000)];
        yield ['3.56ms', 'en', new CarbonInterval(0, 0, 0, 0, 0, 0, 0, 3560)];

        // combinations
        yield ['2w 3d', 'en', new CarbonInterval(0, 0, 0, 17)];
        yield ['1y 2mo 1.5w 3d', 'en', new CarbonInterval(1, 2, 1, 6, 12)];

        // multi same values
        yield ['1y 2y', 'en', new CarbonInterval(3)];
        yield ['1mo 20mo', 'en', new CarbonInterval(0, 21)];
        yield ['1w 2w 3w', 'en', new CarbonInterval(0, 0, 6)];
        yield ['10d 20d 30d', 'en', new CarbonInterval(0, 0, 0, 60)];
        yield ['5h 15h 25h', 'en', new CarbonInterval(0, 0, 0, 0, 45)];
        yield ['3m 3m 3m 1m', 'en', new CarbonInterval(0, 0, 0, 0, 0, 10)];
        yield ['55s 45s 1s 2s 3s 4s', 'en', new CarbonInterval(0, 0, 0, 0, 0, 0, 110)];
        yield ['1500ms 1623555µs', 'en', new CarbonInterval(0, 0, 0, 0, 0, 0, 0, 3123555)];
        yield ['430 milli', 'en', new CarbonInterval(0, 0, 0, 0, 0, 0, 0, 430000)];

        // multi same values with space
        yield ['1 y 2 y', 'en', new CarbonInterval(3)];
        yield ['1 mo 20 mo', 'en', new CarbonInterval(0, 21)];
        yield ['1 w      2  w       3    w', 'en', new CarbonInterval(0, 0, 6)];

        // no-space values
        yield ['2w3d', 'en', new CarbonInterval(0, 0, 0, 17)];
        yield ['1y2mo3w4d5h6m7s', 'en', new CarbonInterval(1, 2, 3, 4, 5, 6, 7)];

        // written-out units
        yield ['1year 2month 3week 4day 5hour 6minute 7second', 'en', new CarbonInterval(1, 2, 3, 4, 5, 6, 7)];
        yield ['1 year 2 month 3 week', 'en', new CarbonInterval(1, 2, 3)];
        yield ['2 Years 3 Months 4 Weeks', 'en', new CarbonInterval(2, 3, 4)];
        yield ['5 Days 6 Hours 7 Minutes 8 Seconds', 'en', new CarbonInterval(0, 0, 0, 5, 6, 7, 8)];

        // ignore invalid format; parse only [num][char-format] or [num] [char-format]
        yield ['Hello! Please add 1y2w to ...', 'en', new CarbonInterval(1, 0, 2)];
        yield ['nothing to parse :(', 'en', new CarbonInterval(0)];

        // case insensitive
        yield ['1Y 3MO 1W 3D 12H 23M 42S', 'en', new CarbonInterval(1, 3, 1, 3, 12, 23, 42)];

        // Example for the ticket (#1756)
        yield ['2 jours 3 heures', 'fr', new CarbonInterval(0, 0, 0, 2, 3, 0, 0)];
    }

    #[TestWith(['1q', '1q', 'en'])]
    #[TestWith(['about 12..14m', '12..', 'en'])]
    #[TestWith(['4h 13', '13', 'en'])]
    public function testThrowsExceptionForUnknownValues(string $string, string $part, string $locale)
    {
        $message = null;

        try {
            CarbonInterval::parseFromLocale($string, $locale);
        } catch (InvalidArgumentException $exception) {
            $message = $exception->getMessage();
        }

        $this->assertStringContainsString($part, $message);
    }
}
