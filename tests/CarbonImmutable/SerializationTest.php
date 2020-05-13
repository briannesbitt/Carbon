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
use InvalidArgumentException;
use ReflectionClass;
use ReflectionObject;
use ReflectionProperty;
use Tests\AbstractTestCase;

class SerializationTest extends AbstractTestCase
{
    /**
     * @var string
     */
    protected $serialized;

    protected function setUp(): void
    {
        parent::setUp();

        $this->serialized = 'O:22:"Carbon\CarbonImmutable":3:{s:4:"date";s:26:"2016-02-01 13:20:25.000000";s:13:"timezone_type";i:3;s:8:"timezone";s:15:"America/Toronto";}';
    }

    public function testSerialize()
    {
        $dt = Carbon::create(2016, 2, 1, 13, 20, 25);
        $this->assertSame($this->serialized, $dt->serialize());
        $this->assertSame($this->serialized, serialize($dt));
    }

    public function testFromUnserialized()
    {
        $dt = Carbon::fromSerialized($this->serialized);
        $this->assertCarbon($dt, 2016, 2, 1, 13, 20, 25);

        $dt = unserialize($this->serialized);
        $this->assertCarbon($dt, 2016, 2, 1, 13, 20, 25);
    }

    public function testSerialization()
    {
        $this->assertEquals(Carbon::now(), unserialize(serialize(Carbon::now())));
    }

    public function providerTestFromUnserializedWithInvalidValue()
    {
        return [
            [null],
            [true],
            [false],
            [123],
            ['foobar'],
        ];
    }

    /**
     * @param mixed $value
     *
     * @dataProvider \Tests\Carbon\SerializationTest::providerTestFromUnserializedWithInvalidValue
     */
    public function testFromUnserializedWithInvalidValue($value)
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            "Invalid serialized value: $value"
        );

        Carbon::fromSerialized($value);
    }

    public function testDateSerializationReflectionCompatibility()
    {
        $reflection = (new ReflectionClass(DateTime::class))->newInstanceWithoutConstructor();

        $reflection->date = '1990-01-17 10:28:07';
        $reflection->timezone_type = 3;
        $reflection->timezone = 'US/Pacific';

        $date = unserialize(serialize($reflection));

        $this->assertSame('1990-01-17 10:28:07', $date->format('Y-m-d h:i:s'));

        $reflection = (new ReflectionClass(Carbon::class))->newInstanceWithoutConstructor();

        $reflection->date = '1990-01-17 10:28:07';
        $reflection->timezone_type = 3;
        $reflection->timezone = 'US/Pacific';

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

            $target->$key = $value;
        };

        $setValue('date', '1990-01-17 10:28:07');
        $setValue('timezone_type', 3);
        $setValue('timezone', 'US/Pacific');

        $date = unserialize(serialize($target));

        $this->assertSame('1990-01-17 10:28:07', $date->format('Y-m-d h:i:s'));
    }
}
