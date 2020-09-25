<?php

//declare(strict_types=1);

/**
 * @author userator
 */
namespace Tests\Carbon;

use Carbon\Carbon;
use Tests\AbstractTestCase;

class CreateFromMicrotimeTest extends AbstractTestCase
{
    public function testCreateFromMicrotimeFloat()
    {
        $microtime = 1600887164.889500;
        $d = Carbon::createFromMicrotimeFloat($microtime);
        $this->assertSame('1600887164.889500', $d->format('U.u'));

        $microtime = '1600887164.889522';
        $d = Carbon::createFromMicrotimeFloat($microtime);
        $this->assertSame($microtime, $d->format('U.u'));
    }

    public function testCreateFromMicrotimeWhitespace()
    {
        $microtime = '0.88951247 1600887164';
        $d = Carbon::createFromMicrotimeWhitespace($microtime);
        $this->assertSame('1600887164.889512', $d->format('U.u'));
    }
}
