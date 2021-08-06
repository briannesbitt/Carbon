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

use Carbon\Exceptions\InvalidPeriodDateException;
use Tests\AbstractTestCase;

class InvalidPeriodDateExceptionTest extends AbstractTestCase
{
    public function testInvalidPeriodDateException(): void
    {
        $exception = new InvalidPeriodDateException($message = 'message');

        $this->assertSame($message, $exception->getMessage());
        $this->assertSame(0, $exception->getCode());
        $this->assertNull($exception->getPrevious());
    }
}
