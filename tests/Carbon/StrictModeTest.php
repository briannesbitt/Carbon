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
    public function testSafeCreateDateTimeZoneWithStrictMode1()
    {
        $this->expectExceptionObject(new InvalidArgumentException(
            'Invalid offset timezone -15',
        ));

        Carbon::createFromDate(2001, 1, 1, -15);
    }

    public function testSafeCreateDateTimeZoneWithStrictMode2()
    {
        $this->expectExceptionObject(new InvalidArgumentException(
            'Unknown or bad timezone (foobar)',
        ));

        Carbon::createFromDate(2001, 1, 1, 'foobar');
    }

    public function testSetWithStrictMode()
    {
        $this->expectExceptionObject(new InvalidArgumentException(
            'Unknown setter \'foobar\'',
        ));

        /** @var mixed $date */
        $date = Carbon::now();
        $date->foobar = 'biz';
    }

    public function testGetWithStrictMode()
    {
        $this->expectExceptionObject(new InvalidArgumentException(
            'Unknown getter \'foobar\'',
        ));

        /** @var mixed $date */
        $date = Carbon::now();
        $date->foobar;
    }

    public function testSetAndGetWithoutStrictMode()
    {
        Carbon::useStrictMode(false);
        /** @var mixed $date */
        $date = Carbon::now();
        @$date->foobar = 'biz';
        $this->assertSame('biz', $date->foobar);
    }

    public function testIsSameUnitWithStrictMode()
    {
        $this->expectExceptionObject(new InvalidArgumentException(
            'Bad comparison unit: \'foobar\'',
        ));

        Carbon::now()->isSameUnit('foobar', 'now');
    }

    public function testIsSameUnitWithoutStrictMode()
    {
        Carbon::useStrictMode(false);
        $this->assertFalse(Carbon::now()->isSameUnit('foobar', 'now'));
    }

    public function testAddRealUnitWithStrictMode()
    {
        $this->expectExceptionObject(new InvalidArgumentException(
            'Invalid unit for real timestamp add/sub: \'foobar\'',
        ));

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
        $this->expectExceptionObject(new BadMethodCallException(
            'Method foobar does not exist.',
        ));

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
        $this->expectExceptionObject(new BadMethodCallException(
            'Method Carbon\Carbon::foobar does not exist.',
        ));

        Carbon::foobar();
    }

    public function testStaticCallWithoutStrictMode()
    {
        Carbon::useStrictMode(false);
        $this->assertNull(Carbon::foobar());
    }
}
