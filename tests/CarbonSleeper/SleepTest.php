<?php

namespace Tests\Carbon;

/*
 * This file is part of the Carbon package.
 *
 * (c) Brian Nesbitt <brian@nesbot.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Carbon\Carbon;
use Carbon\CarbonSleeper;
use Tests\AbstractTestCase;

class SleepTest extends AbstractTestCase
{
    protected function tearDown()
    {
        Carbon::setTestNow();
        parent::tearDown();
    }

    public function testFakeSleepDelay()
    {
        Carbon::setTestNow(Carbon::now());

        $before = time();

        $carbonBefore = Carbon::now();

        CarbonSleeper::sleep(5);

        $after = time();

        $carbonAfter = Carbon::now();

        $this->assertLessThanOrEqual(
            1, // Allow up to 1 second in case of timing issue between calls
            $after - $before,
            'Carbon sleep called system sleep in test condition'
        );
    }

    public function testFakeSleepMoveTestTime()
    {
        Carbon::setTestNow(Carbon::now());

        $before = Carbon::now()->getTimestamp();

        CarbonSleeper::sleep(5);

        $after = Carbon::now()->getTimestamp();

        $this->assertEquals(
            5,
            $after - $before,
            'Carbon sleep called system sleep in test condition'
        );
    }

    /**
     * @expectedException InvalidArgumentException
     * @expectedMessage Number of seconds must be greater than or equal to 0
     */
    public function testNegativeSleep()
    {
        Carbon::setTestNow(Carbon::now());

        CarbonSleeper::sleep(-1);
    }

    public function testRealSleep()
    {
        $before = time();

        CarbonSleeper::sleep(1);

        $after = time();

        $this->assertNotEquals($after, $before, 'Sleep did not delay execution');
    }
}
