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

use Carbon\Carbon;
use Carbon\CarbonPeriod;
use ReflectionClass;
use Tests\AbstractTestCase;
use Tests\CarbonPeriod\Fixtures\Mixin;

class MacroTest extends AbstractTestCase
{
    protected function tearDown(): void
    {
        $reflection = new ReflectionClass('Carbon\CarbonPeriod');

        $macrosProperty = $reflection->getProperty('macros');

        $macrosProperty->setAccessible(true);
        $macrosProperty->setValue([]);

        parent::tearDown();
    }

    public function testCallMacro()
    {
        CarbonPeriod::macro('onlyWeekdays', function () {
            /** @var CarbonPeriod $period */
            $period = $this;

            return $period->addFilter(function ($date) {
                return !in_array($date->dayOfWeek, [Carbon::SATURDAY, Carbon::SUNDAY]);
            });
        });

        /** @var mixed $period */
        $period = CarbonPeriod::create('2018-05-10', '2018-05-14');

        $this->assertSame($period, $period->onlyWeekdays());

        $this->assertSame(
            $this->standardizeDates(['2018-05-10', '2018-05-11', '2018-05-14']),
            $this->standardizeDates($period)
        );
    }

    public function testParameterOtherThanSelfIsNotGivenPeriodInstance()
    {
        CarbonPeriod::macro('foobar', function ($param = 123) {
            return $param;
        });

        /** @var mixed $period */
        $period = CarbonPeriod::create();

        $this->assertSame(123, $period->foobar());
    }

    public function testPassPeriodInstanceAfterOptionalParameters()
    {
        CarbonPeriod::macro('formatStartDate', function ($format = 'l, j F Y') {
            /** @var CarbonPeriod $period */
            $period = $this;

            return $period->getStartDate()->format($format);
        });

        /** @var mixed $period */
        $period = CarbonPeriod::start('2016-09-11');

        $this->assertSame(
            'Sunday, 11 September 2016',
            $period->formatStartDate()
        );
    }

    public function testMacroIsBindedToDatePeriodInstance()
    {
        CarbonPeriod::macro('myself', function () {
            return $this;
        });

        /** @var mixed $period */
        $period = new CarbonPeriod;

        $this->assertInstanceOf('Carbon\CarbonPeriod', $period->myself());
        $this->assertSame($period, $period->myself());
    }

    public function testCallMacroStatically()
    {
        CarbonPeriod::macro('countWeekdaysBetween', function ($from, $to) {
            return CarbonPeriod::create($from, $to)
                ->addFilter(function ($date) {
                    return !in_array($date->dayOfWeek, [Carbon::SATURDAY, Carbon::SUNDAY]);
                })
                ->count();
        });

        $this->assertSame(
            3,
            CarbonPeriod::countWeekdaysBetween('2018-05-10', '2018-05-14')
        );
    }

    public function testMacroIsBindedToDatePeriodClass()
    {
        CarbonPeriod::macro('newMyself', function () {
            return new static;
        });

        $this->assertInstanceOf('Carbon\CarbonPeriod', CarbonPeriod::newMyself());
    }

    public function testRegisterNonClosureMacro()
    {
        CarbonPeriod::macro('lower', 'strtolower');

        /** @var mixed $period */
        $period = new CarbonPeriod;

        $this->assertSame('abc', $period->lower('ABC'));
        $this->assertSame('abc', CarbonPeriod::lower('ABC'));
    }

    public function testRegisterMixin()
    {
        CarbonPeriod::mixin(new Mixin);

        $this->assertNull(CarbonPeriod::getFoo());

        CarbonPeriod::setFoo('bar');
        $this->assertSame('bar', CarbonPeriod::getFoo());
    }

    public function testCallNonExistingMacro()
    {
        $this->expectException(\BadMethodCallException::class);
        $this->expectExceptionMessage(
            'Method nonExistingMacro does not exist.'
        );

        /** @var mixed $period */
        $period = CarbonPeriod::create();

        $period->nonExistingMacro();
    }

    public function testCallNonExistingMacroStatically()
    {
        $this->expectException(\BadMethodCallException::class);
        $this->expectExceptionMessage(
            'Method nonExistingMacro does not exist.'
        );

        CarbonPeriod::nonExistingMacro();
    }

    public function testOverrideAlias()
    {
        CarbonPeriod::macro('recurrences', function () {
            return 'foo';
        });

        $this->assertSame('foo', CarbonPeriod::recurrences());
    }

    public function testInstatiateViaStaticMacroCall()
    {
        CarbonPeriod::macro('fromTomorrow', function () {
            /** @var CarbonPeriod $period */
            $period = $this;

            return $period->setStartDate(Carbon::tomorrow());
        });

        $period = CarbonPeriod::fromTomorrow();

        $this->assertEquals(Carbon::tomorrow(), $period->getStartDate());
    }
}
