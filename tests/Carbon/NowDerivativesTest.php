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
use Tests\AbstractTestCase;

class NowDerivativesTest extends AbstractTestCase
{
    public function testNowWithSameTimezone()
    {
        $dt = Carbon::now('Europe/London');
        $dt2 = $dt->nowWithSameTz();

        $this->assertSame($dt2->toDateTimeString(), $dt->toDateTimeString());
        $this->assertSame($dt2->tzName, $dt->tzName);

        Carbon::setTestNow(new Carbon('2017-07-29T07:57:27.123456Z'));
        $dt = Carbon::createFromTime(13, 40, 00, 'Africa/Asmara');
        $dt2 = $dt->nowWithSameTz();
        Carbon::setTestNow();

        $this->assertSame($dt->format('H:i'), '13:40');
        $this->assertSame($dt2->format('H:i'), '10:57');
        $this->assertSame($dt2->tzName, $dt->tzName);
    }
}
