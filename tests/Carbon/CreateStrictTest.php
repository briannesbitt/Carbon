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

class CreateStrictTest extends AbstractTestCase
{
    public function testCreateStrictThrowsExceptionForSecondLowerThanZero()
    {
        $this->expectException(OutOfRangeException::class);
        $this->expectExceptionMessage(
            'second must be between 0 and 99, -1 given'
        );

        Carbon::createStrict(null, null, null, null, null, -1);
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
