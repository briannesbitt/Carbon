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
    public function testToObject()
    {
        $dt = Carbon::now();
        $dtToObject = $dt->toObject();

        $this->assertInstanceOf('stdClass', $dtToObject);

        $this->assertObjectHasAttribute('year', $dtToObject);
        $this->assertSame($dt->year, $dtToObject->year);

        $this->assertObjectHasAttribute('month', $dtToObject);
        $this->assertSame($dt->month, $dtToObject->month);

        $this->assertObjectHasAttribute('day', $dtToObject);
        $this->assertSame($dt->day, $dtToObject->day);

        $this->assertObjectHasAttribute('dayOfWeek', $dtToObject);
        $this->assertSame($dt->dayOfWeek, $dtToObject->dayOfWeek);

        $this->assertObjectHasAttribute('dayOfYear', $dtToObject);
        $this->assertSame($dt->dayOfYear, $dtToObject->dayOfYear);

        $this->assertObjectHasAttribute('hour', $dtToObject);
        $this->assertSame($dt->hour, $dtToObject->hour);

        $this->assertObjectHasAttribute('minute', $dtToObject);
        $this->assertSame($dt->minute, $dtToObject->minute);

        $this->assertObjectHasAttribute('second', $dtToObject);
        $this->assertSame($dt->second, $dtToObject->second);

        $this->assertObjectHasAttribute('micro', $dtToObject);
        $this->assertSame($dt->micro, $dtToObject->micro);

        $this->assertObjectHasAttribute('timestamp', $dtToObject);
        $this->assertSame($dt->timestamp, $dtToObject->timestamp);

        $this->assertObjectHasAttribute('timezone', $dtToObject);
        $this->assertEquals($dt->timezone, $dtToObject->timezone);

        $this->assertObjectHasAttribute('formatted', $dtToObject);
        $this->assertSame($dt->format(Carbon::DEFAULT_TO_STRING_FORMAT), $dtToObject->formatted);
    }

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

    public function testToDateTime()
    {
        $dt = Carbon::create(2000, 3, 26);
        $date = $dt->toDateTime();

        $this->assertInstanceOf('DateTime', $date);

        $this->assertSame('2000-03-26', $date->format('Y-m-d'));

        $date = $dt->toDate();

        $this->assertInstanceOf('DateTime', $date);

        $this->assertSame('2000-03-26', $date->format('Y-m-d'));
    }

    public function testDebugInfo()
    {
        $dt = Carbon::parse('2019-04-09 11:10:10.667952');
        $debug = $dt->__debugInfo();
        $debug['date'] = preg_replace('/\.\d+$/', '', $debug['date']);

        $this->assertSame(array(
            'date' => '2019-04-09 11:10:10',
            'timezone_type' => 3,
            'timezone' => 'America/Toronto',
        ), $debug);
    }
}
