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

use Carbon\Exceptions\UnknownGetterException;
use Tests\AbstractTestCase;

class UnknownGetterExceptionTest extends AbstractTestCase
{
    public function testUnknownGetterException(): void
    {
        $exception = new UnknownGetterException($getter = 'foo');

        $this->assertSame($getter, $exception->getGetter());

        $this->assertSame("Unknown getter 'foo'", $exception->getMessage());
        $this->assertSame(0, $exception->getCode());
        $this->assertNull($exception->getPrevious());
    }
}
