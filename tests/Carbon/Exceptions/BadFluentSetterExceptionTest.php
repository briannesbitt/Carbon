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

use Carbon\Exceptions\BadFluentSetterException;
use Tests\AbstractTestCase;

class BadFluentSetterExceptionTest extends AbstractTestCase
{
    public function testBadFluentSetterException(): void
    {
        $exception = new BadFluentSetterException($setter = 'foo');

        $this->assertSame($setter, $exception->getSetter());

        $this->assertSame("Unknown fluent setter 'foo'", $exception->getMessage());
        $this->assertSame(0, $exception->getCode());
        $this->assertNull($exception->getPrevious());
    }
}
