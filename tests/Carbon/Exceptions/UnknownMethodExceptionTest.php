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

use Carbon\Exceptions\UnknownMethodException;
use Tests\AbstractTestCase;

class UnknownMethodExceptionTest extends AbstractTestCase
{
    public function testUnknownMethodException(): void
    {
        $exception = new UnknownMethodException($method = 'foo');

        $this->assertSame($method, $exception->getMethod());

        $this->assertSame('Method foo does not exist.', $exception->getMessage());
        $this->assertSame(0, $exception->getCode());
        $this->assertNull($exception->getPrevious());
    }
}
