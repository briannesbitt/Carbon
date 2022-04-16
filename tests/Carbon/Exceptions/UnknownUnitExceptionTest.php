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

use Carbon\Exceptions\UnknownUnitException;
use Tests\AbstractTestCase;

class UnknownUnitExceptionTest extends AbstractTestCase
{
    public function testUnknownUnitException(): void
    {
        $exception = new UnknownUnitException($unit = 'foo');

        $this->assertSame($unit, $exception->getUnit());

        $this->assertSame("Unknown unit 'foo'.", $exception->getMessage());
        $this->assertSame(0, $exception->getCode());
        $this->assertNull($exception->getPrevious());
    }
}
