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

use Carbon\Exceptions\ImmutableException;
use Tests\AbstractTestCase;

class ImmutableExceptionTest extends AbstractTestCase
{
    public function testImmutableException(): void
    {
        $exception = new ImmutableException($value = 'foo is immutable.');

        $this->assertSame($value, $exception->getValue());
        $this->assertSame($value, $exception->getMessage());
        $this->assertSame(0, $exception->getCode());
        $this->assertNull($exception->getPrevious());
    }

    public function testImmutableExceptionFromClass(): void
    {
        $exception = ImmutableException::fromClass('Bar');

        $this->assertSame('Bar class', $exception->getValue());
        $this->assertSame('Bar class is immutable.', $exception->getMessage());
        $this->assertSame(0, $exception->getCode());
        $this->assertNull($exception->getPrevious());
    }

    public function testImmutableExceptionFromMethod(): void
    {
        $exception = ImmutableException::fromMethod('Bar', 'biz');

        $this->assertSame('Bar::biz method', $exception->getValue());
        $this->assertSame('biz not allowed on Bar.', $exception->getMessage());
        $this->assertSame(0, $exception->getCode());
        $this->assertNull($exception->getPrevious());
    }
}
