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

use BadMethodCallException;
use Carbon\CarbonImmutable as Carbon;
use CarbonTimezoneTrait;
use Tests\AbstractTestCaseWithOldNow;
use Tests\Carbon\Fixtures\FooBar;
use Tests\CarbonImmutable\Fixtures\Mixin;

class MacroTest extends AbstractTestCaseWithOldNow
{
    public function testCarbonIsMacroableWhenNotCalledDynamically()
    {
        if (!\function_exists('easter_days')) {
            $this->markTestSkipped('This test requires ext-calendar to be enabled.');
        }

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
        if (!\function_exists('easter_days')) {
            $this->markTestSkipped('This test requires ext-calendar to be enabled.');
        }

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
        if (!\function_exists('easter_days')) {
            $this->markTestSkipped('This test requires ext-calendar to be enabled.');
        }

        Carbon::macro('easterDate', function ($year) {
            return Carbon::create($year, 3, 21)->addDays(easter_days($year));
        });

        $this->assertSame('05/04', Carbon::easterDate(2015)->format('d/m'));
    }

    public function testCarbonIsMacroableWithNonClosureCallables()
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

    public function testCarbonRaisesExceptionWhenStaticMacroIsNotFound()
    {
        $this->expectExceptionObject(new BadMethodCallException(
            'Method Carbon\CarbonImmutable::nonExistingStaticMacro does not exist.'
        ));

        Carbon::nonExistingStaticMacro();
    }

    public function testCarbonRaisesExceptionWhenMacroIsNotFound()
    {
        $this->expectExceptionObject(new BadMethodCallException(
            'Method nonExistingMacro does not exist.'
        ));

        /** @var mixed $date */
        $date = Carbon::now();
        $date->nonExistingMacro();
    }

    public function testTraitMixin()
    {
        Carbon::mixin(FooBar::class);
        Carbon::setTestNow('2019-07-19 00:00:00');

        $this->assertSame('supergirl / Friday / immutable', Carbon::super('girl'));
        $this->assertSame('superboy / Thursday / immutable', Carbon::parse('2019-07-18')->super('boy'));

        $this->assertInstanceOf(Carbon::class, Carbon::me());
    }

    /**
     * @requires PHP >= 8.0
     */
    public function testTraitWithNamedParameters()
    {
        require_once __DIR__.'/../Fixtures/CarbonTimezoneTrait.php';

        Carbon::mixin(CarbonTimezoneTrait::class);
        $now = Carbon::now();
        $now = eval("return \$now->toAppTz(tz: 'Europe/Paris');");

        $this->assertSame('Europe/Paris', $now->format('e'));
    }

    public function testSerializationAfterTraitChaining()
    {
        require_once __DIR__.'/../Fixtures/CarbonTimezoneTrait.php';

        Carbon::mixin(CarbonTimezoneTrait::class);
        Carbon::setTestNow('2023-05-24 14:49');

        $date = Carbon::toAppTz(false, 'Europe/Paris');

        $this->assertSame('2023-05-24 16:49 Europe/Paris', unserialize(serialize($date))->format('Y-m-d H:i e'));

        $date = Carbon::parse('2023-06-12 11:49')->toAppTz(false, 'Europe/Paris');

        $this->assertSame('2023-06-12 13:49 Europe/Paris', unserialize(serialize($date))->format('Y-m-d H:i e'));
    }
}
