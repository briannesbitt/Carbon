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

        $this->assertSame(implode("\n", [
            'Given class does not implement Carbon\CarbonInterface: foo',
            "Behavior can be unpredictable and unsecure (in particular if you are unserializing data from a source you can't fully trust)",
            "But if you're sure you want to allow it use \$result = NotACarbonClassException::allow(static fn () => ...)",
        ]), $exception->getMessage());
        $this->assertSame(0, $exception->getCode());
        $this->assertNull($exception->getPrevious());
    }
}
