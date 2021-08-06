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

namespace Tests\Carbon;

use BadMethodCallException;
use Carbon\Carbon;
use Carbon\CarbonInterface;
use DateTime;
use Tests\AbstractTestCaseWithOldNow;
use Tests\Carbon\Fixtures\FooBar;
use Tests\Carbon\Fixtures\Mixin;

class MacroTest extends AbstractTestCaseWithOldNow
{
    public function testInstance()
    {
        $this->assertInstanceOf(DateTime::class, $this->now);
        $this->assertInstanceOf(Carbon::class, $this->now);
    }

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
            /** @var CarbonInterface $date */
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

    public function testCarbonIsMacroableWhithNonClosureCallables()
    {
        Carbon::macro('lower', 'strtolower');

        /** @var mixed $now */
        $now = Carbon::now();

        $this->assertSame('abc', $now->lower('ABC'));
        $this->assertSame('abc', Carbon::lower('ABC'));
    }

    public function testCarbonIsMixinable()
    {
        include_once __DIR__.'/Fixtures/Mixin.php';
        $mixin = new Mixin('America/New_York');
        Carbon::mixin($mixin);
        Carbon::setUserTimezone('America/Belize');

        /** @var mixed $date */
        $date = Carbon::parse('2000-01-01 12:00:00', 'UTC');

        $this->assertSame('06:00 America/Belize', $date->userFormat('H:i e'));
    }

    public function testMacroProperties()
    {
        // Let say a school year start 5 months before, so school year 2018 is august 2017 to july 2018,
        // Then you can create get/set method this way:
        Carbon::macro('setSchoolYear', function ($schoolYear) {
            /** @var CarbonInterface $date */
            $date = $this;

            $date->year = $schoolYear;

            if ($date->month > 7) {
                $date->year--;
            }
        });

        Carbon::macro('getSchoolYear', function () {
            /** @var CarbonInterface $date */
            $date = $this;

            $schoolYear = $date->year;

            if ($date->month > 7) {
                $schoolYear++;
            }

            return $schoolYear;
        });
        // This will make getSchoolYear/setSchoolYear as usual, but get/set prefix will also enable
        // getter and setter for the ->schoolYear property

        /** @var mixed $date */
        $date = Carbon::parse('2016-06-01');

        $this->assertSame(2016, $date->schoolYear);

        $date->addMonths(3);

        $this->assertSame(2017, $date->schoolYear);

        $date->schoolYear++;

        $this->assertSame(2018, $date->schoolYear);

        $this->assertSame('2017-09-01', $date->format('Y-m-d'));

        $date->schoolYear = 2020;

        $this->assertSame('2019-09-01', $date->format('Y-m-d'));
    }

    public function testLocalMacroProperties()
    {
        /** @var mixed $date */
        $date = Carbon::parse('2016-06-01')->settings([
            'macros' => [
                'setSchoolYear' => function ($schoolYear) {
                    /** @var CarbonInterface $date */
                    $date = $this;

                    $date->year = $schoolYear;

                    if ($date->month > 7) {
                        $date->year--;
                    }
                },
                'getSchoolYear' => function () {
                    /** @var CarbonInterface $date */
                    $date = $this;

                    $schoolYear = $date->year;

                    if ($date->month > 7) {
                        $schoolYear++;
                    }

                    return $schoolYear;
                },
            ],
        ]);

        $this->assertTrue($date->hasLocalMacro('getSchoolYear'));
        $this->assertFalse(Carbon::now()->hasLocalMacro('getSchoolYear'));
        $this->assertFalse(Carbon::hasMacro('getSchoolYear'));

        $this->assertSame(2016, $date->schoolYear);

        $date->addMonths(3);

        $this->assertSame(2017, $date->schoolYear);

        $date->schoolYear++;

        $this->assertSame(2018, $date->schoolYear);

        $this->assertSame('2017-09-01', $date->format('Y-m-d'));

        $date->schoolYear = 2020;

        $this->assertSame('2019-09-01', $date->format('Y-m-d'));
    }

    public function testMacroOverridingMethod()
    {
        Carbon::macro('setDate', function ($dateString) {
            /** @var CarbonInterface $date */
            $date = $this;

            $date->modify($dateString);
        });

        /** @var mixed $date */
        $date = Carbon::parse('2016-06-01 11:25:36');
        $date->date = '1997-08-26 04:13:56';

        $this->assertSame('1997-08-26 04:13:56', $date->format('Y-m-d H:i:s'));

        $date->setDate(2001, 4, 13);

        $this->assertSame('2001-04-13 04:13:56', $date->format('Y-m-d H:i:s'));
    }

    public function testCarbonRaisesExceptionWhenStaticMacroIsNotFound()
    {
        $this->expectExceptionObject(new BadMethodCallException(
            'Method Carbon\Carbon::nonExistingStaticMacro does not exist.'
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

        $this->assertSame('supergirl / Friday / mutable', Carbon::super('girl'));
        $this->assertSame('superboy / Thursday / mutable', Carbon::parse('2019-07-18')->super('boy'));

        $this->assertInstanceOf(Carbon::class, Carbon::me());

        $this->assertFalse(Carbon::noThis());
        $this->assertFalse(Carbon::now()->noThis());
    }
}
