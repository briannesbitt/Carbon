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

use Carbon\Carbon;
use Carbon\CarbonInterval;
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

    public function testSetWithStrictMode()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage(
            'Unknown setter \'foobar\''
        );

        /** @var mixed $interval */
        $interval = CarbonInterval::day();
        $interval->foobar = 'biz';
    }

    public function testGetWithStrictMode()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage(
            'Unknown getter \'foobar\''
        );

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

    public function testStaticCallWithStrictMode()
    {
        $this->expectException(\BadMethodCallException::class);
        $this->expectExceptionMessage(
            'Unknown fluent constructor \'foobar\''
        );

        CarbonInterval::foobar();
    }

    public function testStaticCallWithoutStrictMode()
    {
        Carbon::useStrictMode(false);
        $this->assertNull(CarbonInterval::foobar());
    }
}
