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
use Tests\AbstractTestCase;
use Tests\Carbon\Fixtures\MyCarbon;

class JsonTest extends AbstractTestCase
{
    public function testToJson()
    {
        $d = new DateTime();
        $c = Carbon::instance($d);
        $this->assertSame(json_encode($d), json_encode($c));
    }

    public function testSetToJsonFormat()
    {
        Carbon::setToJsonFormat('jS \o\f F, Y g:i:s a');
        $d = Carbon::create(1975, 12, 25, 14, 15, 16);
        $this->assertSame('"25th of December, 1975 2:15:16 pm"', json_encode($d));
    }

    public function testResetToJsonFormat()
    {
        $d = new DateTime();
        $c = Carbon::instance($d);
        Carbon::setToJsonFormat('123');
        Carbon::resetToJsonFormat();
        $this->assertSame(json_encode($d), json_encode($c));
    }

    public function testExtendedClassToJson()
    {
        $d = new DateTime();
        $c = MyCarbon::instance($d);
        $this->assertSame(json_encode($d), json_encode($c));
    }

    public function testToIso8601String()
    {
        Carbon::setToJsonFormat(Carbon::ATOM);
        $d = Carbon::create(1975, 12, 25, 14, 15, 16);
        $this->assertSame('"1975-12-25T14:15:16-05:00"', json_encode($d));
    }

    public function testToW3cString()
    {
        Carbon::setToJsonFormat(Carbon::W3C);
        $d = Carbon::create(1975, 12, 25, 14, 15, 16);
        $this->assertSame('"1975-12-25T14:15:16-05:00"', json_encode($d));
    }
}
