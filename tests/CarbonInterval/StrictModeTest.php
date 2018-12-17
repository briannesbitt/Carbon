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

class StrictModeTest extends AbstractTestCase
{
    protected function setUp()
    {
        parent::setUp();
        Carbon::useStrictMode();
    }

    protected function tearDown()
    {
        parent::tearDown();
        Carbon::useStrictMode();
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Unknown setter 'foobar'
     */
    public function testSetWithStrictMode()
    {
        /** @var mixed $interval */
        $interval = CarbonInterval::day();
        $interval->foobar = 'biz';
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Unknown getter 'foobar'
     */
    public function testGetWithStrictMode()
    {
        /** @var mixed $interval */
        $interval = CarbonInterval::day();
        $interval->foobar;
    }

    public function testSetAndGetWithoutStrictMode()
    {
        Carbon::useStrictMode(false);
        /** @var mixed $interval */
        $interval = CarbonInterval::day();
        $interval->foobar = 'biz';
        $this->assertSame('biz', $interval->foobar);
    }

    /**
     * @expectedException \BadMethodCallException
     * @expectedExceptionMessage Unknown fluent constructor 'foobar'.
     */
    public function testStaticCallWithStrictMode()
    {
        CarbonInterval::foobar();
    }

    public function testStaticCallWithoutStrictMode()
    {
        Carbon::useStrictMode(false);
        $this->assertNull(CarbonInterval::foobar());
    }
}
