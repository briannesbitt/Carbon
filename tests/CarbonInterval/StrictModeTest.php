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

use BadMethodCallException;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use InvalidArgumentException;
use Tests\AbstractTestCase;

class StrictModeTest extends AbstractTestCase
{
    public function testSetWithStrictMode(): void
    {
        $this->expectExceptionObject(new InvalidArgumentException(
            'Unknown setter \'foobar\''
        ));

        /** @var mixed $interval */
        $interval = CarbonInterval::day();
        $interval->foobar = 'biz';
    }

    public function testGetWithStrictMode(): void
    {
        $this->expectExceptionObject(new InvalidArgumentException(
            'Unknown getter \'foobar\''
        ));

        /** @var mixed $interval */
        $interval = CarbonInterval::day();
        $interval->foobar;
    }

    public function testSetAndGetWithoutStrictMode(): void
    {
        Carbon::useStrictMode(false);
        /** @var mixed $interval */
        $interval = CarbonInterval::day();
        $interval->foobar = 'biz';
        $this->assertSame('biz', $interval->foobar);
    }

    public function testStaticCallWithStrictMode(): void
    {
        $this->expectExceptionObject(new BadMethodCallException(
            'Unknown fluent constructor \'foobar\''
        ));

        CarbonInterval::foobar();
    }

    public function testStaticCallWithoutStrictMode(): void
    {
        Carbon::useStrictMode(false);
        $this->assertNull(CarbonInterval::foobar());
    }
}
