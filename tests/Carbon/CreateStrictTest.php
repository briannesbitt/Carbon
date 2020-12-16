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
use InvalidArgumentException;
use Tests\AbstractTestCase;

class CreateStrictTest extends AbstractTestCase
{
    public function testCreateStrictReturnsDateInstance()
    {
        $d = Carbon::createStrict();
        $this->assertInstanceOfCarbon($d);
    }

    public function testCreateWithInvalidMonth()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('month must be between 0 and 99, -5 given');

        Carbon::createStrict(null, -5);
    }

    public function testCreateWithInvalidMonthNonStrictMode()
    {
        Carbon::useStrictMode(false);
        $this->assertFalse(Carbon::isStrictModeEnabled());

        $this->expectException(InvalidArgumentException::class);
        Carbon::createStrict(null, -5);

        Carbon::useStrictMode(true);
        $this->assertTrue(Carbon::isStrictModeEnabled());
    }
}
