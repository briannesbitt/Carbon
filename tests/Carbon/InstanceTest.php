<?php

/*
 * This file is part of the Carbon package.
 *
 * (c) Brian Nesbitt <brian@nesbot.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tests\Carbon;

use Carbon\Carbon;
use DateTime;
use DateTimeZone;
use Tests\AbstractTestCase;

class InstanceTest extends AbstractTestCase
{
    public function testInstanceFromDateTime()
    {
        $dating = Carbon::instance(DateTime::createFromFormat('Y-m-d H:i:s', '1975-05-21 22:32:11'));
        $this->assertCarbon($dating, 1975, 5, 21, 22, 32, 11);
    }

    public function testInstanceFromCarbon()
    {
        $dating = Carbon::instance(Carbon::create(1975, 5, 21, 22, 32, 11));
        $this->assertCarbon($dating, 1975, 5, 21, 22, 32, 11);
    }

    public function testInstanceFromDateTimeKeepsTimezoneName()
    {
        $dating = Carbon::instance(DateTime::createFromFormat('Y-m-d H:i:s', '1975-05-21 22:32:11')->setTimezone(new DateTimeZone('America/Vancouver')));
        $this->assertSame('America/Vancouver', $dating->tzName);
    }

    public function testInstanceFromCarbonKeepsTimezoneName()
    {
        $dating = Carbon::instance(Carbon::create(1975, 5, 21, 22, 32, 11)->setTimezone(new \DateTimeZone('America/Vancouver')));
        $this->assertSame('America/Vancouver', $dating->tzName);
    }

    public function testInstanceFromDateTimeKeepsMicros()
    {
        $micro = 254687;
        $datetime = DateTime::createFromFormat('Y-m-d H:i:s.u', '2014-02-01 03:45:27.'.$micro);
        $carbon = Carbon::instance($datetime);
        $this->assertSame($micro, $carbon->micro);
    }

    public function testInstanceFromCarbonKeepsMicros()
    {
        $micro = 254687;
        $carbon = Carbon::createFromFormat('Y-m-d H:i:s.u', '2014-02-01 03:45:27.'.$micro);
        $carbon = Carbon::instance($carbon);
        $this->assertSame($micro, $carbon->micro);
    }
}
