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

use Carbon\Exceptions\InvalidDateException;
use Tests\AbstractTestCase;

class InvalidDateExceptionTest extends AbstractTestCase
{
    public function testInvalidCastException(): void
    {
        $exception = new InvalidDateException('month', 13);

        $this->assertSame('month', $exception->getField());
        $this->assertSame(13, $exception->getValue());

        $this->assertSame('month : 13 is not a valid value.', $exception->getMessage());
        $this->assertSame(0, $exception->getCode());
        $this->assertNull($exception->getPrevious());
    }
}
