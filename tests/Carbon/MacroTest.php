<?php

/*
 * This file is part of the Carbon package.
 *
 * (c) Brian Nesbitt <brian@nesbot.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tests\Carbon;

use Carbon\Carbon;
use Tests\AbstractTestCase;
use Tests\Carbon\Fixtures\Mixin;

class MacroTest extends AbstractTestCase
{
    /**
     * @var \Carbon\Carbon
     */
    protected $now;

    public function setUp()
    {
        parent::setUp();

        Carbon::setTestNow($this->now = Carbon::create(2017, 6, 27, 13, 14, 15, 'UTC'));
    }

    public function tearDown()
    {
        Carbon::setTestNow();
        Carbon::serializeUsing(null);

        parent::tearDown();
    }

    public function testInstance()
    {
        $this->assertInstanceOf('DateTime', $this->now);
        $this->assertInstanceOf('Carbon\Carbon', $this->now);
    }

    public function testCarbonIsMacroableWhenNotCalledStatically()
    {
        Carbon::macro('diffFromEaster', function ($year = 2019, $self = null) {
            $instance = Carbon::create($year, 1, 1);

            $a = $instance->year % 19;
            $b = floor($instance->year / 100);
            $c = $instance->year % 100;
            $d = floor($b / 4);
            $e = $b % 4;
            $f = floor(($b + 8) / 25);
            $g = floor(($b - $f + 1) / 3);
            $h = (19 * $a + $b - $d - $g + 15) % 30;
            $i = floor($c / 4);
            $k = $c % 4;
            $l = (32 + 2 * $e + 2 * $i - $h - $k) % 7;
            $m = floor(($a + 11 * $h + 22 * $l) / 451);
            $month = floor(($h + $l - 7 * $m + 114) / 31);
            $day = (($h + $l - 7 * $m + 114) % 31) + 1;

            $instance->month($month)->day($day);

            return $self->diff($instance);
        });

        $this->assertSame(1020, $this->now->diffFromEaster(2020)->days);
        $this->assertSame(663, $this->now->diffFromEaster()->days);

        Carbon::macro('otherParameterName', function ($other = true) {
            return $other;
        });

        $this->assertTrue($this->now->otherParameterName());
    }

    /**
     * @expectedException \BadMethodCallException
     * @expectedExceptionMessage Method diffFromEaster does not exist.
     */
    public function testResetMacros()
    {
        Carbon::macro('diffFromEaster', function () {
            return 42;
        });
        Carbon::resetMacros();

        $this->now->diffFromEaster();
    }

    public function testCarbonIsMacroableWhenNotCalledStaticallyUsingThis()
    {
        $this->requirePhpVersion('5.4.0');

        Carbon::macro('diffFromEaster2', function ($year) {
            $instance = Carbon::create($year, 1, 1);

            $a = $instance->year % 19;
            $b = floor($instance->year / 100);
            $c = $instance->year % 100;
            $d = floor($b / 4);
            $e = $b % 4;
            $f = floor(($b + 8) / 25);
            $g = floor(($b - $f + 1) / 3);
            $h = (19 * $a + $b - $d - $g + 15) % 30;
            $i = floor($c / 4);
            $k = $c % 4;
            $l = (32 + 2 * $e + 2 * $i - $h - $k) % 7;
            $m = floor(($a + 11 * $h + 22 * $l) / 451);
            $month = floor(($h + $l - 7 * $m + 114) / 31);
            $day = (($h + $l - 7 * $m + 114) % 31) + 1;

            $instance->month($month)->day($day);

            return $this->diff($instance);
        });

        $this->assertSame(1020, $this->now->diffFromEaster2(2020)->days);
    }

    public function testCarbonIsMacroableWhenCalledStatically()
    {
        Carbon::macro('easterDate', function ($year) {
            $instance = Carbon::create($year, 1, 1);

            $a = $instance->year % 19;
            $b = floor($instance->year / 100);
            $c = $instance->year % 100;
            $d = floor($b / 4);
            $e = $b % 4;
            $f = floor(($b + 8) / 25);
            $g = floor(($b - $f + 1) / 3);
            $h = (19 * $a + $b - $d - $g + 15) % 30;
            $i = floor($c / 4);
            $k = $c % 4;
            $l = (32 + 2 * $e + 2 * $i - $h - $k) % 7;
            $m = floor(($a + 11 * $h + 22 * $l) / 451);
            $month = floor(($h + $l - 7 * $m + 114) / 31);
            $day = (($h + $l - 7 * $m + 114) % 31) + 1;

            $instance->month($month)->day($day);

            return $instance;
        });

        $this->assertSame('05/04', Carbon::easterDate(2015)->format('d/m'));
    }

    public function testCarbonIsMacroableWhithNonClosureCallables()
    {
        Carbon::macro('lower', 'strtolower');

        $this->assertSame('abc', $this->now->lower('ABC'));
        $this->assertSame('abc', Carbon::lower('ABC'));
    }

    public function testCarbonIsMixinable()
    {
        include_once __DIR__.'/Fixtures/Mixin.php';
        $mixin = new Mixin();
        Carbon::mixin($mixin);
        Carbon::setUserTimezone('America/Belize');
        $date = Carbon::parse('2000-01-01 12:00:00', 'UTC');

        $this->assertSame('06:00 America/Belize', $date->userFormat('H:i e'));
    }

    /**
     * @expectedException \BadMethodCallException
     * @expectedExceptionMessage Method nonExistingStaticMacro does not exist.
     */
    public function testCarbonRaisesExceptionWhenStaticMacroIsNotFound()
    {
        Carbon::nonExistingStaticMacro();
    }

    /**
     * @expectedException \BadMethodCallException
     * @expectedExceptionMessage Method nonExistingMacro does not exist.
     */
    public function testCarbonRaisesExceptionWhenMacroIsNotFound()
    {
        Carbon::now()->nonExistingMacro();
    }
}
