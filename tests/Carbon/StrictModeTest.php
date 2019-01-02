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
     * @expectedExceptionMessage Unknown or bad timezone (-15)
     */
    public function testSafeCreateDateTimeZoneWithStrictMode1()
    {
        Carbon::createFromDate(2001, 1, 1, -15);
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Unknown or bad timezone (foobar)
     */
    public function testSafeCreateDateTimeZoneWithStrictMode2()
    {
        Carbon::createFromDate(2001, 1, 1, 'foobar');
    }

    public function testSafeCreateDateTimeZoneWithoutStrictMode()
    {
        Carbon::useStrictMode(false);
        $this->assertFalse(Carbon::createFromDate(2001, 1, 1, -15));
        $this->assertFalse(Carbon::createFromDate(2001, 1, 1, 'foobar'));
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Unknown setter 'foobar'
     */
    public function testSetWithStrictMode()
    {
        /** @var mixed $date */
        $date = Carbon::now();
        $date->foobar = 'biz';
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Unknown getter 'foobar'
     */
    public function testGetWithStrictMode()
    {
        /** @var mixed $date */
        $date = Carbon::now();
        $date->foobar;
    }

    public function testSetAndGetWithoutStrictMode()
    {
        Carbon::useStrictMode(false);
        /** @var mixed $date */
        $date = Carbon::now();
        $date->foobar = 'biz';
        $this->assertSame('biz', $date->foobar);
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Bad comparison unit: 'foobar'
     */
    public function testIsSameUnitWithStrictMode()
    {
        Carbon::now()->isSameUnit('foobar');
    }

    public function testIsSameUnitWithoutStrictMode()
    {
        Carbon::useStrictMode(false);
        $this->assertFalse(Carbon::now()->isSameUnit('foobar'));
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Invalid unit for real timestamp add/sub: 'foobar'
     */
    public function testAddRealUnitWithStrictMode()
    {
        Carbon::now()->addRealUnit('foobar');
    }

    public function testAddRealUnitWithoutStrictMode()
    {
        Carbon::useStrictMode(false);
        $d = Carbon::create(2000, 1, 2, 3, 4, 5)->addRealUnit('foobar');
        $this->assertCarbon($d, 2000, 1, 2, 3, 4, 5);
    }

    /**
     * @expectedException \BadMethodCallException
     * @expectedExceptionMessage Method foobar does not exist.
     */
    public function testCallWithStrictMode()
    {
        /** @var mixed $date */
        $date = Carbon::now();
        $date->foobar();
    }

    public function testCallWithoutStrictMode()
    {
        Carbon::useStrictMode(false);
        /** @var mixed $date */
        $date = Carbon::now();
        $this->assertNull($date->foobar());
    }

    /**
     * @expectedException \BadMethodCallException
     * @expectedExceptionMessage Method Carbon\Carbon::foobar does not exist.
     */
    public function testStaticCallWithStrictMode()
    {
        Carbon::foobar();
    }

    public function testStaticCallWithoutStrictMode()
    {
        Carbon::useStrictMode(false);
        $this->assertNull(Carbon::foobar());
    }
}
