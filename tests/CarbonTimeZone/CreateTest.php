<?php

/*
 * This file is part of the Carbon package.
 *
 * (c) Brian Nesbitt <brian@nesbot.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tests\CarbonTimeZone;

use Carbon\CarbonTimeZone;
use Tests\AbstractTestCase;

class CreateTest extends AbstractTestCase
{
    public function testCreate()
    {
        $tz = new CarbonTimeZone(6);

        $this->assertSame('Asia/Yekaterinburg', $tz->getName());
    }

    public function testInstance()
    {
        $tz = new CarbonTimeZone();

        $this->assertSame($tz, CarbonTimeZone::instance($tz));
    }
}
