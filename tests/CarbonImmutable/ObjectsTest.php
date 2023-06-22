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

        $this->assertObjectHasProperty('year', $dtToObject);
        $this->assertSame($dt->year, $dtToObject->year);

        $this->assertObjectHasProperty('month', $dtToObject);
        $this->assertSame($dt->month, $dtToObject->month);

        $this->assertObjectHasProperty('day', $dtToObject);
        $this->assertSame($dt->day, $dtToObject->day);

        $this->assertObjectHasProperty('dayOfWeek', $dtToObject);
        $this->assertSame($dt->dayOfWeek, $dtToObject->dayOfWeek);

        $this->assertObjectHasProperty('dayOfYear', $dtToObject);
        $this->assertSame($dt->dayOfYear, $dtToObject->dayOfYear);

        $this->assertObjectHasProperty('hour', $dtToObject);
        $this->assertSame($dt->hour, $dtToObject->hour);

        $this->assertObjectHasProperty('minute', $dtToObject);
        $this->assertSame($dt->minute, $dtToObject->minute);

        $this->assertObjectHasProperty('second', $dtToObject);
        $this->assertSame($dt->second, $dtToObject->second);

        $this->assertObjectHasProperty('micro', $dtToObject);
        $this->assertSame($dt->micro, $dtToObject->micro);

        $this->assertObjectHasProperty('timestamp', $dtToObject);
        $this->assertSame($dt->timestamp, $dtToObject->timestamp);

        $this->assertObjectHasProperty('timezone', $dtToObject);
        $this->assertEquals($dt->timezone, $dtToObject->timezone);

        $this->assertObjectHasProperty('formatted', $dtToObject);
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
