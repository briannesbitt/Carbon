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
namespace Tests\CarbonImmutable;

use Carbon\CarbonImmutable as Carbon;
use Generator;
use Tests\AbstractTestCase;

class RelativeDateStringTest extends AbstractTestCase
{
    public function dataProviderRelativeDateString(): Generator
    {
        // ensure regular timestamps are flagged as relative
        yield ['2018-01-02 03:04:05', ['date' => '2018-01-02', 'is_relative' => false]];
        yield ['1500-01-02 12:00:00', ['date' => '1500-01-02', 'is_relative' => false]];
        yield ['1985-12-10', ['date' => '1985-12-10', 'is_relative' => false]];
        yield ['Dec 2017', ['date' => '2017-12-01', 'is_relative' => false]];
        yield ['25-Dec-2017', ['date' => '2017-12-25', 'is_relative' => false]];
        yield ['25 December 2017', ['date' => '2017-12-25', 'is_relative' => false]];
        yield ['25 Dec 2017', ['date' => '2017-12-25', 'is_relative' => false]];
        yield ['Dec 25 2017', ['date' => '2017-12-25', 'is_relative' => false]];

        // dates not relative now
        yield ['first day of January 2008', ['date' => '2008-01-01', 'is_relative' => false]];
        yield ['first day of January 1999', ['date' => '1999-01-01', 'is_relative' => false]];
        yield ['last day of January 1999', ['date' => '1999-01-31', 'is_relative' => false]];
        yield ['last monday of January 1999', ['date' => '1999-01-25', 'is_relative' => false]];
        yield ['first day of January 0001', ['date' => '0001-01-01', 'is_relative' => false]];
        yield ['monday december 1750', ['date' => '1750-12-07', 'is_relative' => false]];
        yield ['december 1750', ['date' => '1750-12-01', 'is_relative' => false]];
        yield ['last sunday of January 2005', ['date' => '2005-01-30', 'is_relative' => false]];
        yield ['January 2008', ['date' => '2008-01-01', 'is_relative' => false]];

        // dates relative to now
        yield ['first day of next month', ['date' => '2017-02-01', 'is_relative' => true]];
        yield ['sunday noon', ['date' => '2017-01-01', 'is_relative' => true]];
        yield ['sunday midnight', ['date' => '2017-01-01', 'is_relative' => true]];
        yield ['monday december', ['date' => '2017-12-04', 'is_relative' => true]];
        yield ['next saturday', ['date' => '2017-01-07', 'is_relative' => true]];
        yield ['april', ['date' => '2017-04-01', 'is_relative' => true]];
    }

    /**
     * @dataProvider dataProviderRelativeDateString
     *
     * @param string $string
     * @param array  $expected
     */
    public function testKeywordMatching($string, $expected)
    {
        $actual = Carbon::hasRelativeKeywords($string);

        $this->assertSame(
            $expected['is_relative'],
            $actual,
            "Failed relative keyword matching for scenario: {$string} (expected: {$expected['is_relative']})"
        );
    }

    /**
     * @dataProvider dataProviderRelativeDateString
     *
     * @param string $string
     * @param array  $expected
     */
    public function testRelativeInputStrings($string, $expected)
    {
        Carbon::setTestNow('2017-01-01 12:00:00');

        $actual = Carbon::parse($string)->format('Y-m-d');

        $this->assertSame(
            $expected['date'],
            $actual,
            "Failed relative date scenario: {$string}"
        );
    }
}
