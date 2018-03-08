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
    }

    public function testResolveCarbon()
    {
        $dt = Carbon::now();
        $dt2 = Carbon::yesterday();
        $this->assertInstanceOfCarbon($dt->resolveCarbon($dt2));
        $this->assertSame($dt2, $dt->resolveCarbon($dt2));
    }

    public function testResolveCarbonNull()
    {
        $dt = Carbon::now();
        $this->assertInstanceOfCarbon($dt->resolveCarbon(null));
        $this->assertSame($dt->toDateTimeString(), $dt->resolveCarbon(null)->toDateTimeString());
    }
}
