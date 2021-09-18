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

use Carbon\Exceptions\OutOfRangeException;
use Tests\AbstractTestCase;

class OutOfRangeExceptionTest extends AbstractTestCase
{
    public function testOutOfRangeException(): void
    {
        $exception = new OutOfRangeException('month', 1, 12, -1);

        $this->assertSame('month', $exception->getUnit());
        $this->assertSame(1, $exception->getMin());
        $this->assertSame(12, $exception->getMax());
        $this->assertSame(-1, $exception->getValue());

        $this->assertSame('month must be between 1 and 12, -1 given', $exception->getMessage());
        $this->assertSame(0, $exception->getCode());
        $this->assertNull($exception->getPrevious());
    }
}
