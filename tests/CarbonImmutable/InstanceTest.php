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

use Carbon\Carbon as CarbonMutable;
use Carbon\CarbonImmutable;
use Carbon\CarbonImmutable as Carbon;
use Carbon\CarbonInterface;
use DateTime;
use DateTimeZone;
use InvalidArgumentException;
use Tests\AbstractTestCase;

class InstanceTest extends AbstractTestCase
{
    public function testInstanceFromDateTime(): void
    {
        $dating = Carbon::instance(DateTime::createFromFormat('Y-m-d H:i:s', '1975-05-21 22:32:11'));
        $this->assertCarbon($dating, 1975, 5, 21, 22, 32, 11);
        $dating = Carbon::parse(DateTime::createFromFormat('Y-m-d H:i:s', '1975-05-21 22:32:11'));
        $this->assertCarbon($dating, 1975, 5, 21, 22, 32, 11);
    }

    public function testInstanceFromCarbon(): void
    {
        $dating = Carbon::instance(Carbon::create(1975, 5, 21, 22, 32, 11));
        $this->assertCarbon($dating, 1975, 5, 21, 22, 32, 11);
    }

    public function testInstanceFromDateTimeKeepsTimezoneName(): void
    {
        $dating = Carbon::instance(DateTime::createFromFormat('Y-m-d H:i:s', '1975-05-21 22:32:11')->setTimezone(new DateTimeZone('America/Vancouver')));
        $this->assertSame('America/Vancouver', $dating->tzName);
    }

    public function testInstanceFromCarbonKeepsTimezoneName(): void
    {
        $dating = Carbon::instance(Carbon::create(1975, 5, 21, 22, 32, 11)->setTimezone(new DateTimeZone('America/Vancouver')));
        $this->assertSame('America/Vancouver', $dating->tzName);
    }

    public function testInstanceFromDateTimeKeepsMicros(): void
    {
        $micro = 254687;
        $datetime = DateTime::createFromFormat('Y-m-d H:i:s.u', '2014-02-01 03:45:27.'.$micro);
        $carbon = Carbon::instance($datetime);
        $this->assertSame($micro, $carbon->micro);
    }

    public function testInstanceFromCarbonKeepsMicros(): void
    {
        $micro = 254687;
        $carbon = Carbon::createFromFormat('Y-m-d H:i:s.u', '2014-02-01 03:45:27.'.$micro);
        $carbon = Carbon::instance($carbon);
        $this->assertSame($micro, $carbon->micro);
    }

    public function testTimezoneCopy(): void
    {
        $carbon = new Carbon('2017-06-27 13:14:15.123456', 'Europe/Paris');
        $carbon = CarbonMutable::instance($carbon);
        $this->assertSame('2017-06-27 13:14:15.123456 Europe/Paris', $carbon->format('Y-m-d H:i:s.u e'));
    }

    public function testInstanceStateSetBySetStateMethod(): void
    {
        $carbon = Carbon::__set_state([
            'date' => '2017-05-18 13:02:15.273420',
            'timezone_type' => 3,
            'timezone' => 'UTC',
        ]);
        $this->assertInstanceOf(Carbon::class, $carbon);
        $this->assertSame('2017-05-18 13:02:15.273420', $carbon->format('Y-m-d H:i:s.u'));
    }

    public function testInstanceStateSetBySetStateString(): void
    {
        $carbon = Carbon::__set_state('2017-05-18 13:02:15.273420');
        $this->assertInstanceOf(Carbon::class, $carbon);
        $this->assertSame('2017-05-18 13:02:15.273420', $carbon->format('Y-m-d H:i:s.u'));
    }

    public function testDeserializationOccursCorrectly(): void
    {
        $carbon = new Carbon('2017-06-27 13:14:15.000000');
        $serialized = 'return '.var_export($carbon, true).';';
        $deserialized = eval($serialized);

        $this->assertInstanceOf(Carbon::class, $deserialized);
    }

    public function testMutableConversions(): void
    {
        $carbon = new Carbon('2017-06-27 13:14:15.123456', 'Europe/Paris');
        $carbon = $carbon->locale('en_CA');
        $copy = $carbon->toImmutable();

        $this->assertEquals($copy, $carbon);
        $this->assertNotSame($copy, $carbon);
        $this->assertSame('en_CA', $copy->locale());
        $this->assertInstanceOf(CarbonImmutable::class, $copy);
        $this->assertTrue($copy->isImmutable());
        $this->assertFalse($copy->isMutable());
        $this->assertSame('2017-06-27 13:14:15.123456', $copy->format(CarbonInterface::MOCK_DATETIME_FORMAT));
        $this->assertSame('Europe/Paris', $copy->tzName);
        $this->assertNotSame($copy, $copy->modify('+1 day'));

        $copy = $carbon->toMutable();

        $this->assertEquals($copy, $carbon);
        $this->assertNotSame($copy, $carbon);
        $this->assertSame('en_CA', $copy->locale());
        $this->assertInstanceOf(CarbonMutable::class, $copy);
        $this->assertFalse($copy->isImmutable());
        $this->assertTrue($copy->isMutable());
        $this->assertSame('2017-06-27 13:14:15.123456', $copy->format(CarbonInterface::MOCK_DATETIME_FORMAT));
        $this->assertSame('Europe/Paris', $copy->tzName);
        $this->assertSame($copy, $copy->modify('+1 day'));
    }

    public function testInvalidCast(): void
    {
        $this->expectExceptionObject(new InvalidArgumentException(
            'DateTimeZone has not the instance() method needed to cast the date.'
        ));

        $carbon = new Carbon('2017-06-27 13:14:15.123456', 'Europe/Paris');
        $carbon->cast(DateTimeZone::class);
    }

    public function testChildCast(): void
    {
        $class = \get_class(new class() extends Carbon {
            public function foo()
            {
                return 42;
            }
        });
        $carbon = new Carbon('2017-06-27 13:14:15.123456', 'Europe/Paris');
        /** @var object $casted */
        $casted = $carbon->cast($class);

        $this->assertInstanceOf($class, $casted);
        $this->assertInstanceOf(Carbon::class, $casted);
        $this->assertSame(42, $casted->foo());
        $this->assertSame('2017-06-27', $casted->format('Y-m-d'));
    }

    public function testSiblingCast(): void
    {
        $class = \get_class(new class() extends DateTime {
            public function foo()
            {
                return 42;
            }
        });
        $carbon = new Carbon('2017-06-27 13:14:15.123456', 'Europe/Paris');
        /** @var object $casted */
        $casted = $carbon->cast($class);

        $this->assertInstanceOf($class, $casted);
        $this->assertInstanceOf(DateTime::class, $casted);
        $this->assertSame(42, $casted->foo());
        $this->assertSame('2017-06-27', $casted->format('Y-m-d'));
    }
}
