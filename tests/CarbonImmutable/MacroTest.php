<?php

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
use Tests\AbstractTestCaseWithOldNow;
use Tests\CarbonImmutable\Fixtures\Mixin;

class MacroTest extends AbstractTestCaseWithOldNow
{
    public function testCarbonIsMacroableWhenNotCalledDynamically()
    {
        Carbon::macro('easterDays', function ($year = 2019) {
            return easter_days($year);
        });

        /** @var mixed $now */
        $now = Carbon::now();

        $this->assertSame(22, $now->easterDays(2020));
        $this->assertSame(31, $now->easterDays());

        Carbon::macro('otherParameterName', function ($other = true) {
            return $other;
        });

        $this->assertTrue($now->otherParameterName());
    }

    public function testCarbonIsMacroableWhenNotCalledDynamicallyUsingThis()
    {
        Carbon::macro('diffFromEaster', function ($year) {
            /** @var Carbon $date */
            $date = $this;

            return $date->diff(
                Carbon::create($year, 3, 21)
                    ->setTimezone($date->getTimezone())
                    ->addDays(easter_days($year))
                    ->endOfDay()
            );
        });

        /** @var mixed $now */
        $now = Carbon::now();

        $this->assertSame(1020, $now->diffFromEaster(2020)->days);
    }

    public function testCarbonIsMacroableWhenCalledStatically()
    {
        Carbon::macro('easterDate', function ($year) {
            return Carbon::create($year, 3, 21)->addDays(easter_days($year));
        });

        $this->assertSame('05/04', Carbon::easterDate(2015)->format('d/m'));
    }

    public function testCarbonIsMacroableWhithNonClosureCallables()
    {
        Carbon::macro('lower2', 'strtolower');

        /** @var mixed $now */
        $now = Carbon::now();

        $this->assertSame('abc', $now->lower2('ABC'));
        $this->assertSame('abc', Carbon::lower2('ABC'));
    }

    public function testCarbonIsMixinable()
    {
        include_once __DIR__.'/Fixtures/Mixin.php';
        $mixin = new Mixin();
        Carbon::mixin($mixin);
        Carbon::setUserTimezone('America/Belize');

        /** @var mixed $date */
        $date = Carbon::parse('2000-01-01 12:00:00', 'UTC');

        $this->assertSame('06:00 America/Belize', $date->userFormat('H:i e'));
    }

    /**
     * @expectedException \BadMethodCallException
     * @expectedExceptionMessage Method Carbon\CarbonImmutable::nonExistingStaticMacro does not exist.
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
        /** @var mixed $date */
        $date = Carbon::now();
        $date->nonExistingMacro();
    }
}
