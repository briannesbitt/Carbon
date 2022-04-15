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

use Carbon\Exceptions\BadFluentConstructorException;
use Tests\AbstractTestCase;

class BadFluentConstructorExceptionTest extends AbstractTestCase
{
    public function testBadFluentConstructorException(): void
    {
        $exception = new BadFluentConstructorException($method = 'foo');

        $this->assertSame($method, $exception->getMethod());

        $this->assertSame("Unknown fluent constructor 'foo'.", $exception->getMessage());
        $this->assertSame(0, $exception->getCode());
        $this->assertNull($exception->getPrevious());
    }
}
