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

namespace Tests\CarbonPeriod;

use BadMethodCallException;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Carbon\CarbonPeriodImmutable;
use ReflectionClass;
use Tests\AbstractTestCase;
use Tests\CarbonPeriod\Fixtures\MacroableClass;
use Tests\CarbonPeriod\Fixtures\Mixin;
use Tests\CarbonPeriod\Fixtures\MixinTrait;

class MacroTest extends AbstractTestCase
{
    protected function tearDown(): void
    {
        (new ReflectionClass(static::$periodClass))
            ->setStaticPropertyValue('macros', []);

        parent::tearDown();
    }

    public function testCallMacro()
    {
        $periodClass = static::$periodClass;
        $periodClass::macro('onlyWeekdays', function () {
            /** @var CarbonPeriod $period */
            $period = $this;

            return $period->addFilter(function ($date) {
                return !\in_array($date->dayOfWeek, [Carbon::SATURDAY, Carbon::SUNDAY], true);
            });
        });

        /** @var mixed $period */
        $period = $periodClass::create('2018-05-10', '2018-05-14');
        $result = $period->onlyWeekdays();

        $this->assertSame(
            $periodClass === CarbonPeriod::class,
            $period === $result,
            'Must be same object if mutable'
        );

        $this->assertSame(
            $this->standardizeDates(['2018-05-10', '2018-05-11', '2018-05-14']),
            $this->standardizeDates($result),
        );
    }

    public function testParameterOtherThanSelfIsNotGivenPeriodInstance()
    {
        $periodClass = static::$periodClass;
        $periodClass::macro('foobar', function ($param = 123) {
            return $param;
        });

        /** @var mixed $period */
        $period = $periodClass::create();

        $this->assertSame(123, $period->foobar());
    }

    public function testPassPeriodInstanceAfterOptionalParameters()
    {
        $periodClass = static::$periodClass;
        $periodClass::macro('formatStartDate', function ($format = 'l, j F Y') {
            /** @var CarbonPeriod $period */
            $period = $this;

            return $period->getStartDate()->format($format);
        });

        /** @var mixed $period */
        $period = $periodClass::start('2016-09-11');

        $this->assertSame(
            'Sunday, 11 September 2016',
            $period->formatStartDate(),
        );
    }

    public function testMacroIsBindedToDatePeriodInstance()
    {
        $periodClass = static::$periodClass;
        $periodClass::macro('myself', function () {
            return $this;
        });

        /** @var mixed $period */
        $period = new $periodClass();

        $this->assertInstanceOf($periodClass, $period->myself());
        $this->assertSame($period, $period->myself());
    }

    public function testCallMacroStatically()
    {
        $periodClass = static::$periodClass;
        $periodClass::macro('countWeekdaysBetween', function ($from, $to) use ($periodClass) {
            return $periodClass::create($from, $to)
                ->addFilter(function ($date) {
                    return !\in_array($date->dayOfWeek, [Carbon::SATURDAY, Carbon::SUNDAY], true);
                })
                ->count();
        });

        $this->assertSame(
            3,
            $periodClass::countWeekdaysBetween('2018-05-10', '2018-05-14'),
        );
    }

    public function testMacroIsBoundToDatePeriodClass()
    {
        $periodClass = static::$periodClass;
        $periodClass::macro('newMyself', function () {
            return new static();
        });

        $this->assertInstanceOf($periodClass, $periodClass::newMyself());
    }

    public function testRegisterNonClosureMacro()
    {
        $periodClass = static::$periodClass;
        $periodClass::macro('lower', 'strtolower');

        /** @var mixed $period */
        $period = new $periodClass();

        $this->assertSame('abc', $period->lower('ABC'));
        $this->assertSame('abc', $periodClass::lower('ABC'));
    }

    public function testRegisterMixin()
    {
        $periodClass = static::$periodClass;
        $periodClass::mixin(new Mixin());

        $this->assertNull($periodClass::getFoo());

        $periodClass::setFoo('bar');
        $this->assertSame('bar', $periodClass::getFoo());
    }

    public function testCallNonExistingMacro()
    {
        $this->expectExceptionObject(new BadMethodCallException(
            'Method nonExistingMacro does not exist.',
        ));

        $periodClass = static::$periodClass;
        /** @var mixed $period */
        $period = $periodClass::create();

        $period->nonExistingMacro();
    }

    public function testCallNonExistingMacroStatically()
    {
        $this->expectExceptionObject(new BadMethodCallException(
            'Method nonExistingMacro does not exist.',
        ));

        $periodClass = static::$periodClass;
        $periodClass::nonExistingMacro();
    }

    public function testOverrideAlias()
    {
        $periodClass = static::$periodClass;
        $periodClass::macro('recurrences', function () {
            return 'foo';
        });

        $this->assertSame('foo', $periodClass::recurrences());
    }

    public function testInstantiateViaStaticMacroCall()
    {
        $periodClass = static::$periodClass;
        $periodClass::macro('fromTomorrow', function () {
            /** @var CarbonPeriod $period */
            $period = $this;

            return $period->setStartDate(Carbon::tomorrow());
        });

        $period = $periodClass::fromTomorrow();

        $this->assertEquals(Carbon::tomorrow(), $period->getStartDate());
    }

    public function testMixinInstance()
    {
        require_once __DIR__.'/Fixtures/MixinTrait.php';
        require_once __DIR__.'/Fixtures/MacroableClass.php';

        $periodClass = static::$periodClass;
        $periodClass::mixin(MixinTrait::class);

        $period = $periodClass::create('2023-06-10', '2023-06-12');

        $copy = $period->copyOneMoreDay();

        $this->assertSame('Every 1 day from 2023-06-10 to 2023-06-12', (string) $period);
        $this->assertSame('Every 1 day from 2023-06-10 to 2023-06-13', (string) $copy);

        $mutated = $period->oneMoreDay();
        $immutable = (static::$periodClass === CarbonPeriodImmutable::class);
        $expectedEnd = $immutable ? '2023-06-12' : '2023-06-13';

        $this->assertSame('Every 1 day from 2023-06-10 to 2023-06-13', (string) $mutated);
        $this->assertSame("Every 1 day from 2023-06-10 to $expectedEnd", (string) $period);

        $expectedResult = $immutable ? 'a new instance' : 'the same instance';
        $this->assertSame(
            $immutable,
            ($mutated !== $period),
            "{static::$periodClass}::oneMoreDay() should return $expectedResult"
        );

        $this->assertNotSame($copy, $period);

        $this->assertSame('2023-06-14', $mutated->endNextDay()->format('Y-m-d'));
        $this->assertSame(static::$periodClass === CarbonPeriodImmutable::class
            ? '2023-06-13'
            : '2023-06-14', $period->endNextDay()->format('Y-m-d'));

        MacroableClass::mixin(MixinTrait::class);

        $obj = new MacroableClass();
        $result = $obj
            ->setEndDate(Carbon::parse('2023-06-01'))
            ->oneMoreDay();
        $endDate = $result->getEndDate();

        $this->assertInstanceOf(MacroableClass::class, $result);
        $this->assertNotSame(MacroableClass::class, \get_class($result));
        $this->assertSame(Carbon::class, \get_class($endDate));
        $this->assertSame('2023-06-02', $endDate->format('Y-m-d'));
    }
}
