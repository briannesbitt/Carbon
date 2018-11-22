<?php

/*
 * This file is part of the Carbon package.
 *
 * (c) Brian Nesbitt <brian@nesbot.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tests\CarbonInterval;

use Carbon\Carbon;
use Carbon\CarbonInterval;
use DateInterval;
use Tests\AbstractTestCase;

class AddTest extends AbstractTestCase
{
    public function testAdd()
    {
        $ci = CarbonInterval::create(4, 3, 6, 7, 8, 10, 11)->add(new DateInterval('P2Y1M5DT22H33M44S'));
        $this->assertCarbonInterval($ci, 6, 4, 54, 30, 43, 55);
    }

    public function testAddWithDiffDateInterval()
    {
        $diff = Carbon::now()->diff(Carbon::now()->addWeeks(3));
        $ci = CarbonInterval::create(4, 3, 6, 7, 8, 10, 11)->add($diff);
        $this->assertCarbonInterval($ci, 4, 3, 70, 8, 10, 11);
    }

    public function testAddWithNegativeDiffDateInterval()
    {
        $diff = Carbon::now()->diff(Carbon::now()->subWeeks(3));
        $ci = CarbonInterval::create(4, 3, 6, 7, 8, 10, 11)->add($diff);
        $this->assertCarbonInterval($ci, 4, 3, 28, 8, 10, 11);
    }

    public function provideAddsResults()
    {
        return array(
            array(5, 2, 7),
            array(-5, -2, -7),
            array(-5, 2, -3),
            array(5, -2, 3),
            array(2, 5, 7),
            array(-2, -5, -7),
            array(-2, 5, 3),
            array(2, -5, -3),
        );
    }

    /**
     * @dataProvider provideAddsResults
     *
     * @param int $base
     * @param int $increment
     * @param int $expectedResult
     */
    public function testAddSign($base, $increment, $expectedResult)
    {
        $interval = new CarbonInterval();
        $interval->hours(abs($base));
        if ($base < 0) {
            $interval->invert();
        }
        $add = new CarbonInterval();
        $add->hours(abs($increment));
        if ($increment < 0) {
            $add->invert();
        }
        $interval->add($add);

        $this->assertGreaterThanOrEqual(0, $interval->hours);

        $actualResult = ($interval->invert ? -1 : 1) * $interval->hours;

        $this->assertSame($expectedResult, $actualResult);
    }
}
