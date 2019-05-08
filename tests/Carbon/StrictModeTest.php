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

use Carbon\Carbon;
use Tests\AbstractTestCase;

class StrictModeTest extends AbstractTestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Carbon::useStrictMode();
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        Carbon::useStrictMode();
    }

    public function testSafeCreateDateTimeZoneWithStrictMode1()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage(
            'Unknown or bad timezone (-15)'
        );

        Carbon::createFromDate(2001, 1, 1, -15);
    }

    public function testSafeCreateDateTimeZoneWithStrictMode2()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage(
            'Unknown or bad timezone (foobar)'
        );

        Carbon::createFromDate(2001, 1, 1, 'foobar');
    }

    public function testSafeCreateDateTimeZoneWithoutStrictMode()
    {
        Carbon::useStrictMode(false);
        $this->assertFalse(Carbon::createFromDate(2001, 1, 1, -15));
        $this->assertFalse(Carbon::createFromDate(2001, 1, 1, 'foobar'));
    }

    public function testSetWithStrictMode()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage(
            'Unknown setter \'foobar\''
        );

        /** @var mixed $date */
        $date = Carbon::now();
        $date->foobar = 'biz';
    }

    public function testGetWithStrictMode()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage(
            'Unknown getter \'foobar\''
        );

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

    public function testIsSameUnitWithStrictMode()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage(
            'Bad comparison unit: \'foobar\''
        );

        Carbon::now()->isSameUnit('foobar');
    }

    public function testIsSameUnitWithoutStrictMode()
    {
        Carbon::useStrictMode(false);
        $this->assertFalse(Carbon::now()->isSameUnit('foobar'));
    }

    public function testAddRealUnitWithStrictMode()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage(
            'Invalid unit for real timestamp add/sub: \'foobar\''
        );

        Carbon::now()->addRealUnit('foobar');
    }

    public function testAddRealUnitWithoutStrictMode()
    {
        Carbon::useStrictMode(false);
        $d = Carbon::create(2000, 1, 2, 3, 4, 5)->addRealUnit('foobar');
        $this->assertCarbon($d, 2000, 1, 2, 3, 4, 5);
    }

    public function testCallWithStrictMode()
    {
        $this->expectException(\BadMethodCallException::class);
        $this->expectExceptionMessage(
            'Method foobar does not exist.'
        );

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

    public function testStaticCallWithStrictMode()
    {
        $this->expectException(\BadMethodCallException::class);
        $this->expectExceptionMessage(
            'Method Carbon\Carbon::foobar does not exist.'
        );

        Carbon::foobar();
    }

    public function testStaticCallWithoutStrictMode()
    {
        Carbon::useStrictMode(false);
        $this->assertNull(Carbon::foobar());
    }
}
