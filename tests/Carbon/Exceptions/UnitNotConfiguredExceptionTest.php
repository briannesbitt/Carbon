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

use Carbon\Exceptions\UnitNotConfiguredException;
use Tests\AbstractTestCase;

class UnitNotConfiguredExceptionTest extends AbstractTestCase
{
    public function testUnitNotConfiguredException(): void
    {
        $exception = new UnitNotConfiguredException($unit = 'foo');

        $this->assertSame($unit, $exception->getUnit());

        $this->assertSame('Unit foo have no configuration to get total from other units.', $exception->getMessage());
        $this->assertSame(0, $exception->getCode());
        $this->assertNull($exception->getPrevious());
    }
}
