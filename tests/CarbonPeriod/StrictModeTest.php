<?php

/*
 * This file is part of the Carbon package.
 *
 * (c) Brian Nesbitt <brian@nesbot.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tests\CarbonPeriod;

use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Tests\AbstractTestCase;

class StrictModeTest extends AbstractTestCase
{
    protected function setUp()
    {
        parent::setUp();
        Carbon::useStrictMode();
    }

    protected function tearDown()
    {
        parent::tearDown();
        Carbon::useStrictMode();
    }

    /**
     * @expectedException \BadMethodCallException
     * @expectedExceptionMessage Method foobar does not exist.
     */
    public function testCallWithStrictMode()
    {
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
