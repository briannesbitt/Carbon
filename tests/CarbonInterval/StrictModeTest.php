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
        CarbonInterval::day()->foobar = 'biz';
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Unknown getter 'foobar'
     */
    public function testGetWithStrictMode()
    {
        CarbonInterval::day()->foobar;
    }

    public function testSetAndGetWithoutStrictMode()
    {
        Carbon::useStrictMode(false);
        $d = CarbonInterval::day();
        $d->foobar = 'biz';
        $this->assertSame('biz', $d->foobar);
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
