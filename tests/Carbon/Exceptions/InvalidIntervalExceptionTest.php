<?php

/**
 * This file is part of the Carbon package.
 *
 * (c) Brian Nesbitt <brian@nesbot.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tests\Carbon\Exceptions;

use Carbon\Exceptions\InvalidIntervalException;
use Tests\AbstractTestCase;

class InvalidIntervalExceptionTest extends AbstractTestCase
{
    public function testInvalidIntervalException(): void
    {
        $exception = new InvalidIntervalException($message = 'message');

        $this->assertSame($message, $exception->getMessage());
        $this->assertSame(0, $exception->getCode());
        $this->assertNull($exception->getPrevious());
    }
}
