<?php

declare(strict_types=1);

/**
 * This file is part of the Carbon package.
 *
 * (c) Brian Nesbitt <brian@nesbot.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tests\CarbonPeriod;

use BadMethodCallException;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Tests\AbstractTestCase;

class StrictModeTest extends AbstractTestCase
{
    public function testCallWithStrictMode()
    {
        $this->expectExceptionObject(new BadMethodCallException(
            'Method foobar does not exist.'
        ));

        /** @var mixed $period */
        $period = CarbonPeriod::create();
        $period->foobar();
    }

    public function testCallWithoutStrictMode()
    {
        Carbon::useStrictMode(false);
        /** @var mixed $period */
        $period = CarbonPeriod::create();
        $this->assertSame($period, $period->foobar());
    }
}
