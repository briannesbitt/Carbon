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

class ArraysTest extends AbstractTestCase
{
    public function testToArray()
    {
        $dt = Carbon::now();
        $dtToArray = $dt->toArray();

        $this->assertInternalType('array', $dtToArray);

        $this->assertArrayHasKey('year', $dtToArray);
        $this->assertSame($dt->year, $dtToArray['year']);

        $this->assertArrayHasKey('month', $dtToArray);
        $this->assertSame($dt->month, $dtToArray['month']);

        $this->assertArrayHasKey('day', $dtToArray);
        $this->assertSame($dt->day, $dtToArray['day']);

        $this->assertArrayHasKey('dayOfWeek', $dtToArray);
        $this->assertSame($dt->dayOfWeek, $dtToArray['dayOfWeek']);

        $this->assertArrayHasKey('dayOfYear', $dtToArray);
        $this->assertSame($dt->dayOfYear, $dtToArray['dayOfYear']);

        $this->assertArrayHasKey('hour', $dtToArray);
        $this->assertSame($dt->hour, $dtToArray['hour']);

        $this->assertArrayHasKey('minute', $dtToArray);
        $this->assertSame($dt->minute, $dtToArray['minute']);

        $this->assertArrayHasKey('second', $dtToArray);
        $this->assertSame($dt->second, $dtToArray['second']);

        $this->assertArrayHasKey('micro', $dtToArray);
        $this->assertSame($dt->micro, $dtToArray['micro']);

        $this->assertArrayHasKey('timestamp', $dtToArray);
        $this->assertSame($dt->timestamp, $dtToArray['timestamp']);

        $this->assertArrayHasKey('timezone', $dtToArray);
        $this->assertEquals($dt->timezone, $dtToArray['timezone']);

        $this->assertArrayHasKey('formatted', $dtToArray);
        $this->assertSame($dt->format(Carbon::DEFAULT_TO_STRING_FORMAT), $dtToArray['formatted']);
    }
}
