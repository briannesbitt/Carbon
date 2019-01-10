<?php

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
use Tests\AbstractTestCase;

class SerializationTest extends AbstractTestCase
{
    /**
     * @var string
     */
    protected $serialized;

    public function setUp()
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
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Invalid serialized value.
     * @dataProvider \Tests\Carbon\SerializationTest::providerTestFromUnserializedWithInvalidValue
     */
    public function testFromUnserializedWithInvalidValue($value)
    {
        Carbon::fromSerialized($value);
    }
}
