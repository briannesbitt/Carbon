<?php

namespace Tests\Carbon;

use Tests\Carbon\Fixtures\MyCarbon as Carbon;
use Tests\AbstractTestCase;

class MicrotimeTest extends AbstractTestCase
{
    public function testMicroTime()
    {
        $now = Carbon::now();
        $nowMicro = Carbon::currentMicrotime();

        $this->assertSame($now->year,   $nowMicro->year);
        $this->assertSame($now->month,  $nowMicro->month);
        $this->assertSame($now->day,    $nowMicro->day);
        $this->assertSame($now->hour,   $nowMicro->hour);
        $this->assertSame($now->minute, $nowMicro->minute);
        $this->assertSame($now->second, $nowMicro->second);

        $this->assertSame(0, $now->micro);
        $this->assertTrue(is_int($nowMicro->micro));
    }
}
