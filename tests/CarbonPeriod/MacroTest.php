<?php

/*
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
    public function tearDown()
    {
        $reflection = new ReflectionClass('Carbon\CarbonPeriod');

        $macrosProperty = $reflection->getProperty('macros');

        $macrosProperty->setAccessible(true);
        $macrosProperty->setValue(array());

        parent::tearDown();
    }

    public function testCallMacro()
    {
        CarbonPeriod::macro('onlyWeekdays', function ($self) {
            return $self->addFilter(function ($date) {
                return !in_array($date->dayOfWeek, array(Carbon::SATURDAY, Carbon::SUNDAY));
            });
        });

        $period = CarbonPeriod::create('2018-05-10', '2018-05-14');

        $this->assertSame($period, $period->onlyWeekdays());

        $this->assertSame(
            $this->standardizeDates(array('2018-05-10', '2018-05-11', '2018-05-14')),
            $this->standardizeDates($period)
        );
    }

    public function testParameterOtherThanSelfIsNotGivenPeriodInstance()
    {
        CarbonPeriod::macro('foobar', function ($param = 123) {
            return $param;
        });

        $this->assertSame(123, CarbonPeriod::create()->foobar());
    }

    /**
     * @expectedException \BadMethodCallException
     * @expectedExceptionMessage Method foobar does not exist.
     */
    public function testResetMacros()
    {
        CarbonPeriod::macro('foobar', function () {
            return 42;
        });
        CarbonPeriod::resetMacros();

        CarbonPeriod::create()->foobar();
    }

    public function testPassPeriodInstanceAfterOptionalParameters()
    {
        CarbonPeriod::macro('formatStartDate', function ($format = 'l, j F Y', $self = null) {
            return $self->getStartDate()->format($format);
        });

        $this->assertSame(
            'Sunday, 11 September 2016', CarbonPeriod::start('2016-09-11')->formatStartDate()
        );
    }

    public function testMacroIsBindedToDatePeriodInstance()
    {
        $this->requirePhpVersion('5.4.0');

        CarbonPeriod::macro('myself', function () {
            return $this;
        });

        $period = new CarbonPeriod;

        $this->assertInstanceOf('Carbon\CarbonPeriod', $period->myself());
        $this->assertSame($period, $period->myself());
    }

    public function testCallMacroStatically()
    {
        CarbonPeriod::macro('countWeekdaysBetween', function ($from, $to) {
            return CarbonPeriod::create($from, $to)
                ->addFilter(function ($date) {
                    return !in_array($date->dayOfWeek, array(Carbon::SATURDAY, Carbon::SUNDAY));
                })
                ->count();
        });

        $this->assertSame(
            3, CarbonPeriod::countWeekdaysBetween('2018-05-10', '2018-05-14')
        );
    }

    public function testMacroIsBindedToDatePeriodClass()
    {
        $this->requirePhpVersion('5.4.0');

        CarbonPeriod::macro('newMyself', function () {
            return new static;
        });

        $this->assertInstanceOf('Carbon\CarbonPeriod', CarbonPeriod::newMyself());
    }

    public function testRegisterNonClosureMacro()
    {
        CarbonPeriod::macro('lower', 'strtolower');

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

    /**
     * @expectedException \BadMethodCallException
     * @expectedExceptionMessage Method nonExistingMacro does not exist.
     */
    public function testCallNonExistingMacro()
    {
        CarbonPeriod::create()->nonExistingMacro();
    }

    /**
     * @expectedException \BadMethodCallException
     * @expectedExceptionMessage Method nonExistingMacro does not exist.
     */
    public function testCallNonExistingMacroStatically()
    {
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
        CarbonPeriod::macro('fromTomorrow', function ($self) {
            return $self->setStartDate(Carbon::tomorrow());
        });

        $period = CarbonPeriod::fromTomorrow();

        $this->assertEquals(Carbon::tomorrow(), $period->getStartDate());
    }
}
