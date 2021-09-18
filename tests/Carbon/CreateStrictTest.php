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
use Carbon\Exceptions\OutOfRangeException;
use Tests\AbstractTestCase;
use TypeError;

class CreateStrictTest extends AbstractTestCase
{
    public function testCreateStrictThrowsExceptionForSecondLowerThanZero()
    {
        $this->expectExceptionObject(new OutOfRangeException('second', 0, 99, -1));

        Carbon::createStrict(null, null, null, null, null, -1);
    }

    public function testCreateStrictThrowsExceptionForMonthOverRange()
    {
        $this->expectExceptionObject(new OutOfRangeException('month', 0, 99, 9001));

        Carbon::createStrict(null, 9001);
    }

    public function testCreateStrictDoesNotAllowFormatString()
    {
        $this->expectException(TypeError::class);

        Carbon::createStrict('2021-05-25', 'Y-m-d');
    }

    public function testCreateStrictResetsStrictModeOnSuccess()
    {
        Carbon::useStrictMode(false);

        $this->assertInstanceOfCarbon(Carbon::createStrict());

        $this->assertFalse(Carbon::isStrictModeEnabled());
    }

    public function testCreateStrictResetsStrictModeOnFailure()
    {
        Carbon::useStrictMode(false);

        $exception = null;

        try {
            Carbon::createStrict(null, -1);
        } catch (OutOfRangeException $e) {
            $exception = $e;
        }
        $this->assertInstanceOf(OutOfRangeException::class, $exception);

        $this->assertFalse(Carbon::isStrictModeEnabled());
    }
}
