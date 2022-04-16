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

use Carbon\Exceptions\BadComparisonUnitException;
use Tests\AbstractTestCase;

class BadComparisonUnitExceptionTest extends AbstractTestCase
{
    public function testComparisonUnitException(): void
    {
        $exception = new BadComparisonUnitException($unit = 'foo');

        $this->assertSame($unit, $exception->getUnit());

        $this->assertSame("Bad comparison unit: 'foo'", $exception->getMessage());
        $this->assertSame(0, $exception->getCode());
        $this->assertNull($exception->getPrevious());
    }
}
