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
use ReflectionClass;
use Tests\AbstractTestCase;
use Tests\CarbonPeriod\Fixtures\Mixin;

class MacroTest extends AbstractTestCase
{
    protected function tearDown(): void
    {
        $reflection = new ReflectionClass($this->periodClass);

        $macrosProperty = $reflection->getProperty('macros');

        $macrosProperty->setAccessible(true);
        $macrosProperty->setValue([]);

        parent::tearDown();
    }

    public function testCallMacro()
    {
        $periodClass = $this->periodClass;
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
            $this->standardizeDates($result)
        );
    }

    public function testParameterOtherThanSelfIsNotGivenPeriodInstance()
    {
        $periodClass = $this->periodClass;
        $periodClass::macro('foobar', function ($param = 123) {
            return $param;
        });

        /** @var mixed $period */
        $period = $periodClass::create();

        $this->assertSame(123, $period->foobar());
    }

    public function testPassPeriodInstanceAfterOptionalParameters()
    {
        $periodClass = $this->periodClass;
        $periodClass::macro('formatStartDate', function ($format = 'l, j F Y') {
            /** @var CarbonPeriod $period */
            $period = $this;

            return $period->getStartDate()->format($format);
        });

        /** @var mixed $period */
        $period = $periodClass::start('2016-09-11');

        $this->assertSame(
            'Sunday, 11 September 2016',
            $period->formatStartDate()
        );
    }

    public function testMacroIsBindedToDatePeriodInstance()
    {
        $periodClass = $this->periodClass;
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
        $periodClass = $this->periodClass;
        $periodClass::macro('countWeekdaysBetween', function ($from, $to) use ($periodClass) {
            return $periodClass::create($from, $to)
                ->addFilter(function ($date) {
                    return !\in_array($date->dayOfWeek, [Carbon::SATURDAY, Carbon::SUNDAY], true);
                })
                ->count();
        });

        $this->assertSame(
            3,
            $periodClass::countWeekdaysBetween('2018-05-10', '2018-05-14')
        );
    }

    public function testMacroIsBoundToDatePeriodClass()
    {
        $periodClass = $this->periodClass;
        $periodClass::macro('newMyself', function () {
            return new static();
        });

        $this->assertInstanceOf($periodClass, $periodClass::newMyself());
    }

    public function testRegisterNonClosureMacro()
    {
        $periodClass = $this->periodClass;
        $periodClass::macro('lower', 'strtolower');

        /** @var mixed $period */
        $period = new $periodClass();

        $this->assertSame('abc', $period->lower('ABC'));
        $this->assertSame('abc', $periodClass::lower('ABC'));
    }

    public function testRegisterMixin()
    {
        $periodClass = $this->periodClass;
        $periodClass::mixin(new Mixin());

        $this->assertNull($periodClass::getFoo());

        $periodClass::setFoo('bar');
        $this->assertSame('bar', $periodClass::getFoo());
    }

    public function testCallNonExistingMacro()
    {
        $this->expectExceptionObject(new BadMethodCallException(
            'Method nonExistingMacro does not exist.'
        ));

        $periodClass = $this->periodClass;
        /** @var mixed $period */
        $period = $periodClass::create();

        $period->nonExistingMacro();
    }

    public function testCallNonExistingMacroStatically()
    {
        $this->expectExceptionObject(new BadMethodCallException(
            'Method nonExistingMacro does not exist.'
        ));

        $periodClass = $this->periodClass;
        $periodClass::nonExistingMacro();
    }

    public function testOverrideAlias()
    {
        $periodClass = $this->periodClass;
        $periodClass::macro('recurrences', function () {
            return 'foo';
        });

        $this->assertSame('foo', $periodClass::recurrences());
    }

    public function testInstatiateViaStaticMacroCall()
    {
        $periodClass = $this->periodClass;
        $periodClass::macro('fromTomorrow', function () {
            /** @var CarbonPeriod $period */
            $period = $this;

            return $period->setStartDate(Carbon::tomorrow());
        });

        $period = $periodClass::fromTomorrow();

        $this->assertEquals(Carbon::tomorrow(), $period->getStartDate());
    }
}
