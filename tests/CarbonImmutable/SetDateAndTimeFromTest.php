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

namespace Tests\CarbonImmutable;

use Carbon\CarbonImmutable as Carbon;
use Tests\AbstractTestCase;

class SetDateAndTimeFromTest extends AbstractTestCase
{
    public function testSetDateFrom()
    {
        $this->assertCarbon(
            Carbon::create(2001, 1, 1, 1, 1, 1)
                ->setDateFrom(Carbon::create(2002, 2, 2, 2, 2, 2)),
            2002,
            2,
            2,
            1,
            1,
            1,
        );
    }

    public function testSetTimeFrom()
    {
        $this->assertCarbon(
            Carbon::create(2001, 1, 1, 1, 1, 1)
                ->setTimeFrom(Carbon::create(2002, 2, 2, 2, 2, 2)),
            2001,
            1,
            1,
            2,
            2,
            2,
        );
    }
}
