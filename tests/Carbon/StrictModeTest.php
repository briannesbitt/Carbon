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
use InvalidArgumentException;
use Tests\AbstractTestCase;

class StrictModeTest extends AbstractTestCase
{
    public function testSafeCreateDateTimeZoneWithStrictMode1(): void
    {
        $this->expectExceptionObject(new InvalidArgumentException(
            'Unknown or bad timezone (-15)'
        ));

        Carbon::createFromDate(2001, 1, 1, -15);
    }

    public function testSafeCreateDateTimeZoneWithStrictMode2(): void
    {
        $this->expectExceptionObject(new InvalidArgumentException(
            'Unknown or bad timezone (foobar)'
        ));

        Carbon::createFromDate(2001, 1, 1, 'foobar');
    }

    public function testSafeCreateDateTimeZoneWithoutStrictMode(): void
    {
        Carbon::useStrictMode(false);
        $this->assertFalse(Carbon::createFromDate(2001, 1, 1, -15));
        $this->assertFalse(Carbon::createFromDate(2001, 1, 1, 'foobar'));
    }

    public function testSetWithStrictMode(): void
    {
        $this->expectExceptionObject(new InvalidArgumentException(
            'Unknown setter \'foobar\''
        ));

        /** @var mixed $date */
        $date = Carbon::now();
        $date->foobar = 'biz';
    }

    public function testGetWithStrictMode(): void
    {
        $this->expectExceptionObject(new InvalidArgumentException(
            'Unknown getter \'foobar\''
        ));

        /** @var mixed $date */
        $date = Carbon::now();
        $date->foobar;
    }

    public function testSetAndGetWithoutStrictMode(): void
    {
        Carbon::useStrictMode(false);
        /** @var mixed $date */
        $date = Carbon::now();
        $date->foobar = 'biz';
        $this->assertSame('biz', $date->foobar);
    }

    public function testIsSameUnitWithStrictMode(): void
    {
        $this->expectExceptionObject(new InvalidArgumentException(
            'Bad comparison unit: \'foobar\''
        ));

        Carbon::now()->isSameUnit('foobar');
    }

    public function testIsSameUnitWithoutStrictMode(): void
    {
        Carbon::useStrictMode(false);
        $this->assertFalse(Carbon::now()->isSameUnit('foobar'));
    }

    public function testAddRealUnitWithStrictMode(): void
    {
        $this->expectExceptionObject(new InvalidArgumentException(
            'Invalid unit for real timestamp add/sub: \'foobar\''
        ));

        Carbon::now()->addRealUnit('foobar');
    }

    public function testAddRealUnitWithoutStrictMode(): void
    {
        Carbon::useStrictMode(false);
        $d = Carbon::create(2000, 1, 2, 3, 4, 5)->addRealUnit('foobar');
        $this->assertCarbon($d, 2000, 1, 2, 3, 4, 5);
    }

    public function testCallWithStrictMode(): void
    {
        $this->expectExceptionObject(new BadMethodCallException(
            'Method foobar does not exist.'
        ));

        /** @var mixed $date */
        $date = Carbon::now();
        $date->foobar();
    }

    public function testCallWithoutStrictMode(): void
    {
        Carbon::useStrictMode(false);
        /** @var mixed $date */
        $date = Carbon::now();
        $this->assertNull($date->foobar());
    }

    public function testStaticCallWithStrictMode(): void
    {
        $this->expectExceptionObject(new BadMethodCallException(
            'Method Carbon\Carbon::foobar does not exist.'
        ));

        Carbon::foobar();
    }

    public function testStaticCallWithoutStrictMode(): void
    {
        Carbon::useStrictMode(false);
        $this->assertNull(Carbon::foobar());
    }
}
