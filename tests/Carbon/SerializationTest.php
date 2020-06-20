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
namespace Tests\Carbon;

use Carbon\Carbon;
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

        $this->serialized = 'O:13:"Carbon\Carbon":3:{s:4:"date";s:26:"2016-02-01 13:20:25.000000";s:13:"timezone_type";i:3;s:8:"timezone";s:15:"America/Toronto";}';
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
        $dt = Carbon::parse('2018-07-11 18:30:11.654321', 'Europe/Paris')->locale('fr_FR');
        $copy = unserialize(serialize($dt));
        $this->assertSame('fr_FR', $copy->locale);
        $this->assertSame('mercredi 18:30:11.654321', $copy->tz('Europe/Paris')->isoFormat('dddd HH:mm:ss.SSSSSS'));
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
        $d = (new ReflectionClass(DateTime::class))->newInstanceWithoutConstructor();

        $d->date = '1990-01-17 10:28:07';
        $d->timezone_type = 3;
        $d->timezone = 'US/Pacific';

        $x = unserialize(serialize($d));

        $this->assertSame('1990-01-17 10:28:07', $x->format('Y-m-d h:i:s'));

        $d = (new ReflectionClass(Carbon::class))->newInstanceWithoutConstructor();

        $d->date = '1990-01-17 10:28:07';
        $d->timezone_type = 3;
        $d->timezone = 'US/Pacific';

        $x = unserialize(serialize($d));

        $this->assertSame('1990-01-17 10:28:07', $x->format('Y-m-d h:i:s'));

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
