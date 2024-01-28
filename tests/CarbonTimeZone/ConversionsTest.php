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

namespace Tests\CarbonTimeZone;

use Carbon\Carbon;
use Carbon\CarbonTimeZone;
use DateTimeZone;
use Generator;
use InvalidArgumentException;
use PHPUnit\Framework\Attributes\DataProvider;
use stdClass;
use Tests\AbstractTestCaseWithOldNow;

class ConversionsTest extends AbstractTestCaseWithOldNow
{
    public function testToString()
    {
        $this->assertSame('+06:00', (string) (new CarbonTimeZone(6)));
        $this->assertSame('Europe/Paris', (string) (new CarbonTimeZone('Europe/Paris')));
    }

    public function testToRegionName()
    {
        $this->assertSame('America/Chicago', (new CarbonTimeZone(-5))->toRegionName());
        $this->assertSame('America/Toronto', (new CarbonTimeZone('America/Toronto'))->toRegionName());
        $this->assertSame('America/New_York', (new CarbonTimeZone('America/Toronto'))->toOffsetTimeZone()->toRegionName());
        $this->assertNull((new CarbonTimeZone(-15))->toRegionName());
        $date = Carbon::parse('2018-12-20');
        $this->assertSame('America/Chicago', (new CarbonTimeZone('America/Toronto'))->toOffsetTimeZone($date)->toRegionName($date));
        $date = Carbon::parse('2020-06-11T12:30:00-02:30');
        $this->assertSame('America/St_Johns', $date->getTimezone()->toRegionName($date));
    }

    public function testToRegionTimeZone()
    {
        $this->assertSame('America/Chicago', (new CarbonTimeZone(-5))->toRegionTimeZone()->getName());
        $this->assertSame('America/Toronto', (new CarbonTimeZone('America/Toronto'))->toRegionTimeZone()->getName());
        $this->assertSame('America/New_York', (new CarbonTimeZone('America/Toronto'))->toOffsetTimeZone()->toRegionTimeZone()->getName());
        $date = Carbon::parse('2018-12-20');
        $this->assertSame('America/Chicago', (new CarbonTimeZone('America/Toronto'))->toOffsetTimeZone($date)->toRegionTimeZone($date)->getName());
    }

    public static function dataForToOffsetName(): Generator
    {
        // timezone - number
        yield ['2018-12-20', '-05:00', -5];
        yield ['2018-06-20', '-05:00', -5];
        // timezone - use offset
        yield ['2018-12-20', '-05:00', '-05:00'];
        yield ['2018-06-20', '-05:00', '-05:00'];
        // timezone - by name - with daylight time
        yield ['2018-12-20', '-05:00', 'America/Toronto'];
        yield ['2018-06-20', '-04:00', 'America/Toronto'];
        // timezone - by name - without daylight time
        yield ['2018-12-20', '+03:00', 'Asia/Baghdad'];
        yield ['2018-06-20', '+03:00', 'Asia/Baghdad'];
        // timezone - no full hour - the same time
        yield ['2018-12-20', '-09:30', 'Pacific/Marquesas'];
        yield ['2018-06-20', '-09:30', 'Pacific/Marquesas'];
        // timezone - no full hour -
        yield ['2018-12-20', '-03:30', 'America/St_Johns'];
        yield ['2018-06-20', '-02:30', 'America/St_Johns'];
        // timezone - no full hour +
        yield ['2018-12-20', '+13:45', 'Pacific/Chatham'];
        yield ['2018-06-20', '+12:45', 'Pacific/Chatham'];
        // timezone - UTC
        yield ['2018-12-20', '+00:00', 'UTC'];
        yield ['2018-06-20', '+00:00', 'UTC'];
    }

    #[DataProvider('dataForToOffsetName')]
    public function testToOffsetName(string $date, string $expectedOffset, string|int $timezone)
    {
        Carbon::setTestNow(Carbon::parse($date));
        $offset = (new CarbonTimeZone($timezone))->toOffsetName();

        $this->assertSame($expectedOffset, $offset);
    }

    #[DataProvider('dataForToOffsetName')]
    public function testToOffsetNameDateAsParam(string $date, string $expectedOffset, string|int $timezone)
    {
        $offset = (new CarbonTimeZone($timezone))->toOffsetName(Carbon::parse($date));

        $this->assertSame($expectedOffset, $offset);
    }

    public function testToOffsetNameFromDifferentCreationMethods()
    {
        $summer = Carbon::parse('2020-06-15');
        $winter = Carbon::parse('2018-12-20');
        $this->assertSame('+02:00', (new CarbonTimeZone('Europe/Paris'))->toOffsetName());
        $this->assertSame('+05:30', $this->firstValidTimezoneAmong(['Asia/Kolkata', 'Asia/Calcutta'])->toOffsetName());
        $this->assertSame('+13:45', CarbonTimeZone::create('Pacific/Chatham')->toOffsetName($winter));
        $this->assertSame('+12:00', CarbonTimeZone::create('Pacific/Auckland')->toOffsetName($summer));
        $this->assertSame('-05:15', CarbonTimeZone::createFromHourOffset(-5.25)->toOffsetName());
        $this->assertSame('-02:30', CarbonTimeZone::createFromMinuteOffset(-150)->toOffsetName());
        $this->assertSame('-08:45', CarbonTimeZone::create('-8:45')->toOffsetName());
        $this->assertSame('-09:30', CarbonTimeZone::create('Pacific/Marquesas')->toOffsetName());
    }

    public function testCast()
    {
        $tz = (new CarbonTimeZone('America/Toronto'))->cast(DateTimeZone::class);

        $this->assertSame(DateTimeZone::class, \get_class($tz));
        $this->assertSame('America/Toronto', $tz->getName());

        $obj = new class('UTC') extends CarbonTimeZone {
        };
        $class = \get_class($obj);

        $tz = (new CarbonTimeZone('America/Toronto'))->cast($class);

        $this->assertSame($class, \get_class($tz));
        $this->assertSame('America/Toronto', $tz->getName());
    }

    public function testCastException()
    {
        $this->expectExceptionObject(new InvalidArgumentException(
            'stdClass has not the instance() method needed to cast the date.',
        ));

        (new CarbonTimeZone('America/Toronto'))->cast(stdClass::class);
    }

    public function testInvalidRegionForOffset()
    {
        Carbon::useStrictMode(false);
        $this->assertNull((new CarbonTimeZone(-15))->toRegionTimeZone());
    }

    public function testInvalidRegionForOffsetInStrictMode()
    {
        $this->expectExceptionObject(new InvalidArgumentException(
            'Unknown timezone for offset -54000 seconds.',
        ));

        (new CarbonTimeZone(-15))->toRegionTimeZone();
    }
}
