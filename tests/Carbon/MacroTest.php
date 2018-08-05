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
use DateTime;
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
        $this->assertInstanceOf(DateTime::class, $this->now);
        $this->assertInstanceOf(Carbon::class, $this->now);
    }

    public function testCarbonIsMacroableWhenNotCalledDynamically()
    {
        Carbon::macro('easterDays', function ($year = 2019) {
            return easter_days($year);
        });

        $this->assertSame(22, $this->now->easterDays(2020));
        $this->assertSame(31, $this->now->easterDays());

        Carbon::macro('otherParameterName', function ($other = true) {
            return $other;
        });

        $this->assertTrue($this->now->otherParameterName());
    }

    public function testCarbonIsMacroableWhenNotCalledDynamicallyUsingThis()
    {
        Carbon::macro('diffFromEaster', function ($year) {
            return $this->diff(
                Carbon::create($year, 3, 21)
                    ->setTimezone($this->getTimezone())
                    ->addDays(easter_days($year))
                    ->endOfDay()
            );
        });

        $this->assertSame(1020, $this->now->diffFromEaster(2020)->days);
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

    public function testMacroProperties()
    {
        // Let say a school year start 5 months before, so school year 2018 is august 2017 to july 2018,
        // Then you can create get/set method this way:
        Carbon::macro('setSchoolYear', function ($schoolYear) {
            $this->year = $schoolYear;
            if ($this->month > 7) {
                $this->year--;
            }
        });
        Carbon::macro('getSchoolYear', function () {
            $schoolYear = $this->year;
            if ($this->month > 7) {
                $schoolYear++;
            }

            return $schoolYear;
        });
        // This will make getSchoolYear/setSchoolYear as usual, but get/set prefix will also enable
        // getter and setter for the ->schoolYear property

        $date = Carbon::parse('2016-06-01');

        $this->assertSame(2016, $date->schoolYear);

        $date->addMonths(3);

        $this->assertSame(2017, $date->schoolYear);

        $date->schoolYear++;

        $this->assertSame('2017-09-01', $date->format('Y-m-d'));

        $date->schoolYear = 2020;

        $this->assertSame('2019-09-01', $date->format('Y-m-d'));
    }

    /**
     * @expectedException \BadMethodCallException
     * @expectedExceptionMessage Method Carbon\Carbon::nonExistingStaticMacro does not exist.
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
