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

namespace Tests\Carbon;

use Carbon\Carbon;
use Tests\AbstractTestCase;

class TryParseTest extends AbstractTestCase
{
    public function testTryParse()
    {
        Carbon::setTestNow('2025-01-22 00:00:00');

        $this->assertInstanceOf(Carbon::class, Carbon::tryParse('2025-01-22'));

        $this->assertEquals('2025-01-22 00:00:00', Carbon::tryParse('2025-01-22 00:00:00')->format('Y-m-d H:i:s'));

        $this->assertNull(Carbon::tryParse('2025-99-99'));

        Carbon::setTestNow();
    }
}
