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

    public function testAddMicroseconds()
    {
        $diff = Carbon::now()->diff(Carbon::now()->addDays(3)->addMicroseconds(111222));
        $ci = CarbonInterval::create(1, 0, 0, 2, 0, 0, 0, 222333)->add($diff);
        if ($ci->seconds === 1) {
            $ci->seconds--;
            $ci->microseconds += 1000000;
        }
        $this->assertCarbonInterval($ci, 1, 0, 5, 0, 0, 0, 333555);
        $diff = Carbon::now()->diff(Carbon::now()->addDays(3));
        $ci = CarbonInterval::create(1, 0, 0, 2, 0, 0, 0, 222333)->add($diff);
        $this->assertCarbonInterval($ci, 1, 0, 5, 0, 0, 0, 222333);
        $diff = Carbon::now()->diff(Carbon::now()->addDays(3)->addMicroseconds(111222));
        $ci = CarbonInterval::create(1, 0, 0, 2, 0, 0, 0)->add($diff);
        if ($ci->seconds === 1) {
            $ci->seconds--;
            $ci->microseconds += 1000000;
        }
        $this->assertCarbonInterval($ci, 1, 0, 5, 0, 0, 0, 111222);
    }

    public function testAddWithRawDiffDateInterval()
    {
        $diff = (new \DateTime())->diff(new \DateTime('3 weeks'));
        $ci = CarbonInterval::create(4, 3, 6, 7, 8, 10, 11)->add($diff);
        $this->assertCarbonInterval($ci, 4, 3, 70, 8, 10, 11);
    }

    public function testAddWithRawNegativeDiffDateInterval()
    {
        $diff = (new \DateTime())->diff(new \DateTime('-3 weeks'));
        $ci = CarbonInterval::create(4, 3, 6, 7, 8, 10, 11)->add($diff);
        $this->assertCarbonInterval($ci, 4, 3, 28, 8, 10, 11);
    }

    public function testAddAndSubMultipleFormats()
    {
        $this->assertCarbonInterval(CarbonInterval::day()->add('hours', 3), 0, 0, 1, 3, 0, 0);
        $this->assertCarbonInterval(CarbonInterval::day()->add(5, 'hours'), 0, 0, 1, 5, 0, 0);
        $this->assertCarbonInterval(CarbonInterval::day()->add(3, '4 hours'), 0, 0, 1, 12, 0, 0);
        $this->assertCarbonInterval(CarbonInterval::day()->add(-5, 'hours'), 0, 0, 1, -5, 0, 0);
        $this->assertCarbonInterval(CarbonInterval::hours(4)->add('hour'), 0, 0, 0, 5, 0, 0);
        $this->assertCarbonInterval(CarbonInterval::hours(4)->add(new DateInterval('P5D')), 0, 0, 5, 4, 0, 0);
        $this->assertCarbonInterval(CarbonInterval::hours(4)->add(CarbonInterval::minutes(30)), 0, 0, 0, 4, 30, 0);
        $this->assertCarbonInterval(CarbonInterval::day()->sub('hours', 3), 0, 0, 1, -3, 0, 0);
        $this->assertCarbonInterval(CarbonInterval::day()->subtract(5, 'hours'), 0, 0, 1, -5, 0, 0);
        $this->assertCarbonInterval(CarbonInterval::day()->subtract(3, '4 hours'), 0, 0, 1, -12, 0, 0);
        $this->assertCarbonInterval(CarbonInterval::day()->subtract(-5, 'hours'), 0, 0, 1, 5, 0, 0);
        $this->assertCarbonInterval(CarbonInterval::hours(4)->sub('hour'), 0, 0, 0, 3, 0, 0);
        $this->assertCarbonInterval(CarbonInterval::hours(4)->subtract(new DateInterval('P5D')), 0, 0, -5, 4, 0, 0);
        $this->assertCarbonInterval(CarbonInterval::hours(4)->sub(CarbonInterval::minutes(30)), 0, 0, 0, 4, -30, 0);
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage This type of data cannot be added/subtracted.
     */
    public function testAddWrongFormat()
    {
        CarbonInterval::day()->add(Carbon::now());
    }
}
