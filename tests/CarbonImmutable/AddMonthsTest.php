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
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\AbstractTestCase;

class AddMonthsTest extends AbstractTestCase
{
    private ?Carbon $carbon = null;

    protected function setUp(): void
    {
        parent::setUp();

        /** @var Carbon $date */
        $date = Carbon::create(2016, 1, 31);

        $this->carbon = $date;
    }

    public static function dataForTestAddMonthNoOverflow()
    {
        return [
            [-2, 2015, 11, 30],
            [-1, 2015, 12, 31],
            [0, 2016, 1, 31],
            [1, 2016, 2, 29],
            [2, 2016, 3, 31],
        ];
    }

    #[DataProvider('dataForTestAddMonthNoOverflow')]
    public function testAddMonthNoOverflow(int $months, int $y, int $m, int $d)
    {
        $this->assertCarbon($this->carbon->addMonthNoOverflow($months), $y, $m, $d);
    }

    #[DataProvider('dataForTestAddMonthNoOverflow')]
    public function testAddMonthsNoOverflow(int $months, int $y, int $m, int $d)
    {
        $this->assertCarbon($this->carbon->addMonthsNoOverflow($months), $y, $m, $d);
    }

    public static function dataForTestSubMonthNoOverflow(): array
    {
        return [
            [-2, 2016, 3, 31],
            [-1, 2016, 2, 29],
            [0, 2016, 1, 31],
            [1, 2015, 12, 31],
            [2, 2015, 11, 30],
        ];
    }

    #[DataProvider('dataForTestSubMonthNoOverflow')]
    public function testSubMonthNoOverflow(int $months, int $y, int $m, int $d)
    {
        $this->assertCarbon($this->carbon->subMonthNoOverflow($months), $y, $m, $d);
    }

    #[DataProvider('dataForTestSubMonthNoOverflow')]
    public function testSubMonthsNoOverflow(int $months, int $y, int $m, int $d)
    {
        $this->assertCarbon($this->carbon->subMonthsNoOverflow($months), $y, $m, $d);
    }

    public static function dataForTestAddMonthWithOverflow(): array
    {
        return [
            [-2, 2015, 12, 1],
            [-1, 2015, 12, 31],
            [0, 2016, 1, 31],
            [1, 2016, 3, 2],
            [2, 2016, 3, 31],
        ];
    }

    #[DataProvider('dataForTestAddMonthWithOverflow')]
    public function testAddMonthWithOverflow(int $months, int $y, int $m, int $d)
    {
        $this->assertCarbon($this->carbon->addMonthWithOverflow($months), $y, $m, $d);
    }

    #[DataProvider('dataForTestAddMonthWithOverflow')]
    public function testAddMonthsWithOverflow(int $months, int $y, int $m, int $d)
    {
        $this->assertCarbon($this->carbon->addMonthsWithOverflow($months), $y, $m, $d);
    }

    public static function dataForTestSubMonthWithOverflow(): array
    {
        return [
            [-2, 2016, 3, 31],
            [-1, 2016, 3, 2],
            [0, 2016, 1, 31],
            [1, 2015, 12, 31],
            [2, 2015, 12, 1],
        ];
    }

    #[DataProvider('dataForTestSubMonthWithOverflow')]
    public function testSubMonthWithOverflow(int $months, int $y, int $m, int $d)
    {
        $this->assertCarbon($this->carbon->subMonthWithOverflow($months), $y, $m, $d);
    }

    #[DataProvider('dataForTestSubMonthWithOverflow')]
    public function testSubMonthsWithOverflow(int $months, int $y, int $m, int $d)
    {
        $this->assertCarbon($this->carbon->subMonthsWithOverflow($months), $y, $m, $d);
    }

    public function testSetOverflowIsTrue()
    {
        Carbon::useMonthsOverflow(true);
        $this->assertTrue(Carbon::shouldOverflowMonths());
    }

    public function testSetOverflowIsFalse()
    {
        Carbon::useMonthsOverflow(false);
        $this->assertFalse(Carbon::shouldOverflowMonths());
    }

    public function testSetOverflowIsResetInTests()
    {
        $this->assertTrue(Carbon::shouldOverflowMonths());
    }

    public function testSetOverflowIsReset()
    {
        Carbon::useMonthsOverflow(false);
        $this->assertFalse(Carbon::shouldOverflowMonths());

        Carbon::resetMonthsOverflow();
        $this->assertTrue(Carbon::shouldOverflowMonths());
    }

    #[DataProvider('dataForTestAddMonthWithOverflow')]
    public function testUseOverflowAddMonth(int $months, int $y, int $m, int $d)
    {
        Carbon::useMonthsOverflow(true);
        $this->assertCarbon($this->carbon->addMonth($months), $y, $m, $d);
    }

    #[DataProvider('dataForTestAddMonthWithOverflow')]
    public function testUseOverflowAddMonths(int $months, int $y, int $m, int $d)
    {
        Carbon::useMonthsOverflow(true);
        $this->assertCarbon($this->carbon->addMonths($months), $y, $m, $d);
    }

    #[DataProvider('dataForTestSubMonthWithOverflow')]
    public function testUseOverflowSubMonth(int $months, int $y, int $m, int $d)
    {
        Carbon::useMonthsOverflow(true);
        $this->assertCarbon($this->carbon->subMonth($months), $y, $m, $d);
    }

    #[DataProvider('dataForTestSubMonthWithOverflow')]
    public function testUseOverflowSubMonths(int $months, int $y, int $m, int $d)
    {
        Carbon::useMonthsOverflow(true);
        $this->assertCarbon($this->carbon->subMonths($months), $y, $m, $d);
    }

    #[DataProvider('dataForTestAddMonthNoOverflow')]
    public function testSkipOverflowAddMonth(int $months, int $y, int $m, int $d)
    {
        Carbon::useMonthsOverflow(false);
        $this->assertCarbon($this->carbon->addMonth($months), $y, $m, $d);
    }

    #[DataProvider('dataForTestAddMonthNoOverflow')]
    public function testSkipOverflowAddMonths(int $months, int $y, int $m, int $d)
    {
        Carbon::useMonthsOverflow(false);
        $this->assertCarbon($this->carbon->addMonths($months), $y, $m, $d);
    }

    #[DataProvider('dataForTestSubMonthNoOverflow')]
    public function testSkipOverflowSubMonth(int $months, int $y, int $m, int $d)
    {
        Carbon::useMonthsOverflow(false);
        $this->assertCarbon($this->carbon->subMonth($months), $y, $m, $d);
    }

    #[DataProvider('dataForTestSubMonthNoOverflow')]
    public function testSkipOverflowSubMonths(int $months, int $y, int $m, int $d)
    {
        Carbon::useMonthsOverflow(false);
        $this->assertCarbon($this->carbon->subMonths($months), $y, $m, $d);
    }
}
