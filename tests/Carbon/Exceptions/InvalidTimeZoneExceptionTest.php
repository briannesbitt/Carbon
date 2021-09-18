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

use Carbon\Exceptions\InvalidTimeZoneException;
use Tests\AbstractTestCase;

class InvalidTimeZoneExceptionTest extends AbstractTestCase
{
    public function testInvalidTimeZoneException(): void
    {
        $exception = new InvalidTimeZoneException($message = 'message');

        $this->assertSame($message, $exception->getMessage());
        $this->assertSame(0, $exception->getCode());
        $this->assertNull($exception->getPrevious());
    }
}
