<?php

declare(strict_types=1);

/**
 * This file is part of the Carbon package.
 *
 * (c) Brian Nesbitt <brian@nesbot.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tests\CarbonImmutable;

use Carbon\CarbonImmutable as Carbon;
use DateTime;
use DateTimeImmutable;
use stdClass;
use Tests\AbstractTestCase;

class ObjectsTest extends AbstractTestCase
{
    public function testToObject()
    {
        $dt = Carbon::now();
        $dtToObject = $dt->toObject();

        $this->assertInstanceOf(stdClass::class, $dtToObject);

        $this->assertTrue(property_exists($dtToObject, 'year'));
        $this->assertSame($dt->year, $dtToObject->year);

        $this->assertTrue(property_exists($dtToObject, 'month'));
        $this->assertSame($dt->month, $dtToObject->month);

        $this->assertTrue(property_exists($dtToObject, 'day'));
        $this->assertSame($dt->day, $dtToObject->day);

        $this->assertTrue(property_exists($dtToObject, 'dayOfWeek'));
        $this->assertSame($dt->dayOfWeek, $dtToObject->dayOfWeek);

        $this->assertTrue(property_exists($dtToObject, 'dayOfYear'));
        $this->assertSame($dt->dayOfYear, $dtToObject->dayOfYear);

        $this->assertTrue(property_exists($dtToObject, 'hour'));
        $this->assertSame($dt->hour, $dtToObject->hour);

        $this->assertTrue(property_exists($dtToObject, 'minute'));
        $this->assertSame($dt->minute, $dtToObject->minute);

        $this->assertTrue(property_exists($dtToObject, 'second'));
        $this->assertSame($dt->second, $dtToObject->second);

        $this->assertTrue(property_exists($dtToObject, 'micro'));
        $this->assertSame($dt->micro, $dtToObject->micro);

        $this->assertTrue(property_exists($dtToObject, 'timestamp'));
        $this->assertSame($dt->timestamp, $dtToObject->timestamp);

        $this->assertTrue(property_exists($dtToObject, 'timezone'));
        $this->assertEquals($dt->timezone, $dtToObject->timezone);

        $this->assertTrue(property_exists($dtToObject, 'formatted'));
        $this->assertSame($dt->format(Carbon::DEFAULT_TO_STRING_FORMAT), $dtToObject->formatted);
    }

    public function testToDateTime()
    {
        $dt = Carbon::create(2000, 3, 26);
        $date = $dt->toDateTime();

        $this->assertInstanceOf(DateTime::class, $date);

        $this->assertSame('2000-03-26', $date->format('Y-m-d'));

        $date = $dt->toDate();

        $this->assertInstanceOf(DateTime::class, $date);

        $this->assertSame('2000-03-26', $date->format('Y-m-d'));
    }

    public function testToDateTimeImmutable()
    {
        $dt = Carbon::create(2000, 3, 26);
        $date = $dt->toDateTimeImmutable();

        $this->assertInstanceOf(DateTimeImmutable::class, $date);

        $this->assertSame('2000-03-26', $date->format('Y-m-d'));
    }
}
