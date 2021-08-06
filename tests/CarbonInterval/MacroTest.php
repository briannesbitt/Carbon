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

namespace Tests\CarbonInterval;

use Carbon\CarbonInterval;
use Tests\AbstractTestCaseWithOldNow;
use Tests\CarbonInterval\Fixtures\Mixin;

class MacroTest extends AbstractTestCaseWithOldNow
{
    public function testCarbonIsMacroableWhenNotCalledStatically()
    {
        CarbonInterval::macro('twice', function () {
            /** @var CarbonInterval $interval */
            $interval = $this;

            return $interval->times(2);
        });

        /** @var mixed $interval */
        $interval = CarbonInterval::day();

        $this->assertSame('2 days', $interval->twice()->forHumans());

        CarbonInterval::macro('repeatInvert', function ($count = 0) {
            /** @var CarbonInterval $interval */
            $interval = $this;

            return $count % 2 ? $interval->invert() : $interval;
        });

        /** @var mixed $interval */
        $interval = CarbonInterval::day();

        $this->assertSame(0, $interval->repeatInvert()->invert);

        /** @var mixed $interval */
        $interval = CarbonInterval::day();

        $this->assertSame(1, $interval->repeatInvert(3)->invert);

        /** @var mixed $interval */
        $interval = CarbonInterval::day();

        $this->assertSame(0, $interval->repeatInvert(4)->invert);

        CarbonInterval::macro('otherParameterName', function ($other = true) {
            return $other;
        });

        /** @var mixed $interval */
        $interval = CarbonInterval::day();

        $this->assertTrue($interval->otherParameterName());
    }

    public function testCarbonIsMacroableWhenNotCalledStaticallyUsingThis()
    {
        CarbonInterval::macro('repeatInvert2', function ($count = 0) {
            /** @var CarbonInterval $interval */
            $interval = $this;

            return $count % 2 ? $interval->invert() : $interval;
        });

        /** @var mixed $interval */
        $interval = CarbonInterval::day();

        $this->assertSame(0, $interval->repeatInvert2()->invert);

        /** @var mixed $interval */
        $interval = CarbonInterval::day();

        $this->assertSame(1, $interval->repeatInvert2(3)->invert);

        /** @var mixed $interval */
        $interval = CarbonInterval::day();

        $this->assertSame(0, $interval->repeatInvert2(4)->invert);
    }

    public function testCarbonIsMacroableWhenCalledStatically()
    {
        CarbonInterval::macro('quarter', function () {
            return CarbonInterval::months(3);
        });

        $this->assertSame('3 months', CarbonInterval::quarter()->forHumans());

        CarbonInterval::macro('quarterIfEven', function ($value = 0) {
            return $value % 2 ? CarbonInterval::day() : CarbonInterval::months(3);
        });

        $this->assertSame('3 months', CarbonInterval::quarterIfEven()->forHumans());
        $this->assertSame('1 day', CarbonInterval::quarterIfEven(7)->forHumans());
        $this->assertSame('3 months', CarbonInterval::quarterIfEven(-6)->forHumans());
    }

    public function testCarbonIsMacroableWhithNonClosureCallables()
    {
        CarbonInterval::macro('lower', 'strtolower');

        /** @var mixed $interval */
        $interval = CarbonInterval::day();

        $this->assertSame('abc', $interval->lower('ABC'));
        $this->assertSame('abc', CarbonInterval::lower('ABC'));
    }

    public function testCarbonIsMixinable()
    {
        include_once __DIR__.'/Fixtures/Mixin.php';
        $mixin = new Mixin();
        CarbonInterval::mixin($mixin);
        CarbonInterval::setFactor(3);

        /** @var mixed $interval */
        $interval = CarbonInterval::hours(2);

        $this->assertSame('6 hours', $interval->doMultiply()->forHumans());
    }
}
