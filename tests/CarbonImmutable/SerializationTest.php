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
use Carbon\CarbonTimeZone;
use DateTimeImmutable;
use InvalidArgumentException;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\RequiresPhpExtension;
use ReflectionClass;
use ReflectionObject;
use ReflectionProperty;
use Tests\AbstractTestCase;
use Throwable;

class SerializationTest extends AbstractTestCase
{
    protected string $serialized;

    protected function setUp(): void
    {
        parent::setUp();

        $this->serialized = \extension_loaded('msgpack')
            ? 'O:22:"Carbon\CarbonImmutable":4:{s:4:"date";s:26:"2016-02-01 13:20:25.000000";s:13:"timezone_type";i:3;s:8:"timezone";s:15:"America/Toronto";s:18:"dumpDateProperties";a:2:{s:4:"date";s:26:"2016-02-01 13:20:25.000000";s:8:"timezone";s:15:"America/Toronto";}}'
            : 'O:22:"Carbon\CarbonImmutable":3:{s:4:"date";s:26:"2016-02-01 13:20:25.000000";s:13:"timezone_type";i:3;s:8:"timezone";s:15:"America/Toronto";}';
    }

    protected function cleanSerialization(string $serialization): string
    {
        return preg_replace('/s:\d+:"[^"]*dumpDateProperties"/', 's:18:"dumpDateProperties"', $serialization);
    }

    public function testSerialize()
    {
        $dt = Carbon::create(2016, 2, 1, 13, 20, 25);
        $this->assertSame($this->serialized, $this->cleanSerialization($dt->serialize()));
        $this->assertSame($this->serialized, $this->cleanSerialization(serialize($dt)));
    }

    public function testFromUnserialized()
    {
        $dt = Carbon::fromSerialized($this->serialized);
        $this->assertCarbon($dt, 2016, 2, 1, 13, 20, 25);
        $timezone = $dt->getTimezone();
        $this->assertSame(CarbonTimeZone::class, $timezone::class);
        $this->assertSame('America/Toronto', $timezone->getName());

        $dt = unserialize($this->serialized);
        $timezone = $dt->getTimezone();
        $this->assertCarbon($dt, 2016, 2, 1, 13, 20, 25);
        $this->assertSame(CarbonTimeZone::class, $timezone::class);
        $this->assertSame('America/Toronto', $timezone->getName());
    }

    public function testSerialization()
    {
        $this->assertEquals(Carbon::now(), unserialize(serialize(Carbon::now())));
    }

    public static function dataForTestFromUnserializedWithInvalidValue()
    {
        return [
            [null],
            [true],
            [false],
            [123],
            ['foobar'],
        ];
    }

    #[DataProvider('dataForTestFromUnserializedWithInvalidValue')]
    public function testFromUnserializedWithInvalidValue(mixed $value)
    {
        $this->expectExceptionObject(new InvalidArgumentException(
            "Invalid serialized value: $value",
        ));

        Carbon::fromSerialized($value);
    }

    public function testDateSerializationReflectionCompatibility()
    {
        $tz = $this->firstValidTimezoneAmong(['America/Los_Angeles', 'US/Pacific'])->getName();

        try {
            $reflection = (new ReflectionClass(DateTimeImmutable::class))->newInstanceWithoutConstructor();

            @$reflection->date = '1990-01-17 10:28:07';
            @$reflection->timezone_type = 3;
            @$reflection->timezone = $tz;

            $date = unserialize(serialize($reflection));
        } catch (Throwable $exception) {
            $this->markTestSkipped(
                "It fails on DateTime so Carbon can't support it, error was:\n".$exception->getMessage()
            );
        }

        $this->assertSame('1990-01-17 10:28:07', $date->format('Y-m-d h:i:s'));

        $reflection = (new ReflectionClass(Carbon::class))->newInstanceWithoutConstructor();

        @$reflection->date = '1990-01-17 10:28:07';
        @$reflection->timezone_type = 3;
        @$reflection->timezone = $tz;

        $date = unserialize(serialize($reflection));

        $this->assertSame('1990-01-17 10:28:07', $date->format('Y-m-d h:i:s'));

        $reflection = new ReflectionObject(Carbon::parse('1990-01-17 10:28:07'));
        $target = (new ReflectionClass(Carbon::class))->newInstanceWithoutConstructor();
        /** @var ReflectionProperty[] $properties */
        $properties = [];

        foreach ($reflection->getProperties() as $property) {
            $property->setAccessible(true);
            $properties[$property->getName()] = $property;
        }

        $setValue = function ($key, $value) use (&$properties, &$target) {
            if (isset($properties[$key])) {
                $properties[$key]->setValue($target, $value);

                return;
            }

            @$target->$key = $value;
        };

        $setValue('date', '1990-01-17 10:28:07');
        $setValue('timezone_type', 3);
        $setValue('timezone', $tz);

        $date = unserialize(serialize($target));

        $this->assertSame('1990-01-17 10:28:07', $date->format('Y-m-d h:i:s'));
    }

    #[RequiresPhpExtension('msgpack')]
    public function testMsgPackExtension(): void
    {
        $string = '2018-06-01 21:25:13.321654 Europe/Vilnius';
        $date = Carbon::parse('2018-06-01 21:25:13.321654 Europe/Vilnius');
        $message = @msgpack_pack($date);
        $copy = msgpack_unpack($message);

        $this->assertSame($string, $copy->format('Y-m-d H:i:s.u e'));
    }

    public function testSleepRawMethod(): void
    {
        $date = Carbon::parse('2018-06-01 21:25:13.321654 Europe/Vilnius');

        $expected = ['date', 'timezone_type', 'timezone'];

        if (\extension_loaded('msgpack')) {
            $expected[] = 'dumpDateProperties';
        }

        $this->assertSame($expected, $date->__sleep());

        $date->locale('fr_FR');
        $expected[] = 'dumpLocale';

        $this->assertSame($expected, $date->__sleep());
    }

    public function testSerializeRawMethod(): void
    {
        $date = Carbon::parse('2018-06-01 21:25:13.321654 Europe/Vilnius');

        $expected = [
            'date' => '2018-06-01 21:25:13.321654',
            'timezone_type' => 3,
            'timezone' => 'Europe/Vilnius',
        ];

        if (\extension_loaded('msgpack')) {
            $expected['dumpDateProperties'] = [
                'date' => $date->format('Y-m-d H:i:s.u'),
                'timezone' => $date->tzName,
            ];
        }

        $this->assertSame($expected, $date->__serialize());

        $date->locale('lt_LT');
        $expected['dumpLocale'] = 'lt_LT';

        $this->assertSame($expected, $date->__serialize());
    }

    public function testWakeupRawMethod(): void
    {
        $tz = $this->firstValidTimezoneAmong(['America/Los_Angeles', 'US/Pacific'])->getName();

        /** @var Carbon $date */
        $date = (new ReflectionClass(Carbon::class))->newInstanceWithoutConstructor();

        @$date->date = '1990-01-17 10:28:07';
        @$date->timezone_type = 3;
        @$date->timezone = $tz;
        @$date->dumpLocale = 'es';

        $date->__wakeup();

        $this->assertSame('1990-01-17 10:28:07 '.$tz, $date->format('Y-m-d H:i:s e'));
        $this->assertSame('es', $date->locale);
    }

    public function testUnserializeRawMethod(): void
    {
        /** @var Carbon $date */
        $date = (new ReflectionClass(Carbon::class))->newInstanceWithoutConstructor();

        $date->__unserialize([
            'date' => '2018-06-01 21:25:13.321654',
            'timezone_type' => 3,
            'timezone' => 'Europe/Vilnius',
        ]);

        $this->assertSame('2018-06-01 21:25:13.321654 Europe/Vilnius', $date->format('Y-m-d H:i:s.u e'));
        $this->assertSame('en', $date->locale);

        /** @var Carbon $date */
        $date = (new ReflectionClass(Carbon::class))->newInstanceWithoutConstructor();

        $date->__unserialize([
            'date' => '2018-06-01 21:25:13.321654',
            'timezone_type' => 3,
            'timezone' => 'Europe/Vilnius',
            'dumpLocale' => 'lt_LT',
        ]);

        $this->assertSame('2018-06-01 21:25:13.321654 Europe/Vilnius', $date->format('Y-m-d H:i:s.u e'));
        $this->assertSame('lt_LT', $date->locale);
    }
}
