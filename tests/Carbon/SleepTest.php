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
use Tests\AbstractTestCase;

class SleepTest extends AbstractTestCase
{
    public function testFakeSleepDelay()
    {
        $this->wrapWithTestNow(
            function () {
                $before = time();

                $carbonBefore = Carbon::now();

                Carbon::sleep(5);

                $after = time();

                $carbonAfter = Carbon::now();

                $this->assertLessThanOrEqual(
                    1, // Allow up to 1 second in case of timing issue between calls
                    $after - $before,
                    'Carbon sleep called system sleep in test condition'
                );
            }
        );
    }

    public function testFakeSleepMoveTestTime()
    {
        $this->wrapWithTestNow(
            function () {
                $before = Carbon::now()->getTimestamp();

                Carbon::sleep(5);

                $after = Carbon::now()->getTimestamp();

                $this->assertEquals(
                    5,
                    $after - $before,
                    'Carbon sleep called system sleep in test condition'
                );
            }
        );
    }
}
