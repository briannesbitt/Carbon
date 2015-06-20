<?php

/*
 * This file is part of the Carbon package.
 *
 * (c) Brian Nesbitt <brian@nesbot.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Carbon\Carbon;

class DateTimeTest extends TestFixture
{
    public function testToDateTime()
    {
        $c = Carbon::now()->startOfYear();
        $d = $c->toDatetime();

        $this->assertInstanceOf('\DateTime', $d);
        $this->assertNotInstanceOf('\Carbon\Carbon', $d);

        $this->assertEquals($c->getTimestamp(), $d->getTimestamp());
        $this->assertEquals($c->getTimezone(), $d->getTimezone());
        $this->assertEquals($d, $c->instance($d));
    }
}
