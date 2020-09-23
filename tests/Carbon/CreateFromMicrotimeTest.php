<?php

declare(strict_types=1);

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
        $this->assertSame(number_format($microtime, 6, '.', ''), $d->format('U.u'));
    }

    public function testCreateFromMicrotimeWhitespace()
    {
        $microtime = '0.88950000 1600887164';
        $d = Carbon::createFromMicrotimeWhitespace($microtime);
        $parts = explode(' ', $microtime);
        $this->assertSame(number_format(intval($parts[1]) + floatval($parts[0]), 6, '.', ''), $d->format('U.u'));
    }
}
