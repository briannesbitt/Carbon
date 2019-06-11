<?php

/*
 * This file is part of the Carbon package.
 *
 * (c) Brian Nesbitt <brian@nesbot.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tests\CarbonInterval;

use Carbon\Carbon;
use Carbon\CarbonInterval;
use Tests\AbstractTestCase;
use Tests\CarbonInterval\Fixtures\Mixin;

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

        parent::tearDown();
    }

    public function testCarbonIsMacroableWhenNotCalledStatically()
    {
        CarbonInterval::macro('twice', function ($self = null) {
            return $self->times(2);
        });

        $this->assertSame('2 days', CarbonInterval::day()->twice()->forHumans());

        CarbonInterval::macro('repeatInvert', function ($count = 0, $self = null) {
            return $count % 2 ? $self->invert() : $self;
        });

        $this->assertSame(0, CarbonInterval::day()->repeatInvert()->invert);
        $this->assertSame(1, CarbonInterval::day()->repeatInvert(3)->invert);
        $this->assertSame(0, CarbonInterval::day()->repeatInvert(4)->invert);

        CarbonInterval::macro('otherParameterName', function ($other = true) {
            return $other;
        });

        $this->assertTrue(CarbonInterval::day()->otherParameterName());
    }

    public function testResetMacros()
    {
        CarbonInterval::macro('twice', function () {
            return 42;
        });
        CarbonInterval::resetMacros();

        $this->assertSame('1 day', CarbonInterval::day()->twice()->forHumans());
    }

    public function testCarbonIsMacroableWhenNotCalledStaticallyUsingThis()
    {
        $this->requirePhpVersion('5.4.0');

        CarbonInterval::macro('repeatInvert2', function ($count = 0) {
            return $count % 2 ? $this->invert() : $this;
        });

        $this->assertSame(0, CarbonInterval::day()->repeatInvert2()->invert);
        $this->assertSame(1, CarbonInterval::day()->repeatInvert2(3)->invert);
        $this->assertSame(0, CarbonInterval::day()->repeatInvert2(4)->invert);
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

        $this->assertSame('abc', CarbonInterval::day()->lower('ABC'));
        $this->assertSame('abc', CarbonInterval::lower('ABC'));
    }

    public function testCarbonIsMixinable()
    {
        include_once __DIR__.'/Fixtures/Mixin.php';
        $mixin = new Mixin();
        CarbonInterval::mixin($mixin);
        CarbonInterval::setFactor(3);

        $this->assertSame('6 hours', CarbonInterval::hours(2)->multiply()->forHumans());
    }
}
