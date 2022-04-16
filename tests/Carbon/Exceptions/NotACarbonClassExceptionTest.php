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

use Carbon\Exceptions\NotACarbonClassException;
use Tests\AbstractTestCase;

class NotACarbonClassExceptionTest extends AbstractTestCase
{
    public function testNotACarbonClassException(): void
    {
        $exception = new NotACarbonClassException($className = 'foo');

        $this->assertSame($className, $exception->getClassName());

        $this->assertSame('Given class does not implement Carbon\CarbonInterface: foo', $exception->getMessage());
        $this->assertSame(0, $exception->getCode());
        $this->assertNull($exception->getPrevious());
    }
}
