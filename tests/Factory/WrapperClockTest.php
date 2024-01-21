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

namespace Tests\Factory;

use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Carbon\Factory;
use Carbon\FactoryImmutable;
use Carbon\WrapperClock;
use DateTime;
use DateTimeImmutable;
use DateTimeZone;
use Psr\Clock\ClockInterface;
use RuntimeException;
use Tests\AbstractTestCase;

class WrapperClockTest extends AbstractTestCase
{
    public function testWrapperClock(): void
    {
        $now = new DateTimeImmutable('now UTC');
        $clock = new WrapperClock($now);

        $this->assertSame($now, $clock->now());
        $this->assertSame($now, $clock->unwrap());

        $carbon = $clock->getFactory()->now();

        $this->assertSame(CarbonImmutable::class, $carbon::class);
        $this->assertSame($now->format('Y-m-d H:i:s.u e'), $carbon->format('Y-m-d H:i:s.u e'));

        $carbon = $clock->nowAs(Carbon::class, 'Europe/Berlin');

        $this->assertSame(Carbon::class, $carbon::class);
        $this->assertSame(
            $now->setTimezone(new DateTimeZone('Europe/Berlin'))->format('Y-m-d H:i:s.u e'),
            $carbon->format('Y-m-d H:i:s.u e'),
        );

        $carbon = $clock->nowAsCarbon();

        $this->assertSame(CarbonImmutable::class, $carbon::class);
        $this->assertSame($now->format('Y-m-d H:i:s.u e'), $carbon->format('Y-m-d H:i:s.u e'));

        $clock = new WrapperClock($carbon);

        $this->assertSame($clock->nowAsCarbon(), $carbon);
    }

    public function testWrapperClockMutable(): void
    {
        $now = new DateTime('now UTC');
        $clock = new WrapperClock($now);
        $result = $clock->now();
        $unwrapped = $clock->unwrap();

        $this->assertNotSame($now, $result);
        $this->assertSame($now, $unwrapped);
        $this->assertSame($now->format('Y-m-d H:i:s.u e'), $result->format('Y-m-d H:i:s.u e'));
        $this->assertSame($now->format('Y-m-d H:i:s.u e'), $unwrapped->format('Y-m-d H:i:s.u e'));

        $carbon = $clock->getFactory()->now();

        $this->assertSame(Carbon::class, $carbon::class);
        $this->assertSame($now->format('Y-m-d H:i:s.u e'), $carbon->format('Y-m-d H:i:s.u e'));
    }

    public function testWrapperClockPsrLink(): void
    {
        $now = new DateTimeImmutable('now UTC');
        $psrClock = new class($now) implements ClockInterface {
            public function __construct(private readonly DateTimeImmutable $currentTime)
            {
            }

            public function now(): DateTimeImmutable
            {
                return $this->currentTime;
            }
        };
        $clock = new WrapperClock($psrClock);
        $result = $clock->now();
        $unwrapped = $clock->unwrap();
        $unwrappedNow = $unwrapped->now();

        $this->assertSame($now, $result);
        $this->assertSame($psrClock, $unwrapped);
        $this->assertSame($now, $unwrappedNow);
        $this->assertSame($now->format('Y-m-d H:i:s.u e'), $result->format('Y-m-d H:i:s.u e'));
        $this->assertSame($now->format('Y-m-d H:i:s.u e'), $unwrappedNow->format('Y-m-d H:i:s.u e'));

        $carbon = $clock->getFactory()->now();

        $this->assertSame(CarbonImmutable::class, $carbon::class);
        $this->assertSame($now->format('Y-m-d H:i:s.u e'), $carbon->format('Y-m-d H:i:s.u e'));
    }

    public function testSleep(): void
    {
        $factory = new FactoryImmutable();
        $factory->setTestNowAndTimezone(new DateTimeImmutable('2024-01-18 00:00 UTC'));

        $clock = new WrapperClock($factory);
        $clock->sleep(2.5);
        $carbon = $clock->now();

        $this->assertSame(CarbonImmutable::class, $carbon::class);
        $this->assertSame('2024-01-18 00:00:02.500000 UTC', $carbon->format('Y-m-d H:i:s.u e'));

        $present = new DateTimeImmutable('2024-01-18 00:00 UTC');
        $clock = new WrapperClock($present);
        $clock->sleep(2.5);
        $now = $clock->now();

        $this->assertSame(DateTimeImmutable::class, $now::class);
        $this->assertSame('2024-01-18 00:00:02.500000 UTC', $now->format('Y-m-d H:i:s.u e'));

        $future = new DateTimeImmutable('2224-01-18 00:00 UTC');
        $seconds = $future->getTimestamp() - $present->getTimestamp() + 0.000_001;
        $clock->sleep($seconds);
        $now = $clock->now();

        $this->assertSame('2224-01-18 00:00:02.500001 UTC', $now->format('Y-m-d H:i:s.u e'));

        $present = new DateTime('2024-01-18 00:00 UTC');
        $clock = new WrapperClock($present);
        $clock->sleep(2.5);
        $now = $clock->now();

        $this->assertSame(CarbonImmutable::class, $now::class);
        $this->assertSame('2024-01-18 00:00:02.500000 UTC', $now->format('Y-m-d H:i:s.u e'));
        $this->assertSame('2024-01-18 00:00:00.000000 UTC', $present->format('Y-m-d H:i:s.u e'));

        $clock->sleep(0);
        $clock->sleep(0.0);
        $now = $clock->now();

        $this->assertSame('2024-01-18 00:00:02.500000 UTC', $now->format('Y-m-d H:i:s.u e'));

        $clock = new WrapperClock(new class() implements ClockInterface {
            public function now(): DateTimeImmutable
            {
                return new DateTimeImmutable('2024-01-18 00:00 UTC');
            }
        });
        $clock->sleep(2.5);
        $now = $clock->now();

        $this->assertSame(DateTimeImmutable::class, $now::class);
        $this->assertSame('2024-01-18 00:00:02.500000 UTC', $now->format('Y-m-d H:i:s.u e'));
    }

    public function testSleepNegative(): void
    {
        $this->expectExceptionObject(new RuntimeException(
            'Expected positive number of seconds, -1.0E-6 given',
        ));

        $present = new DateTimeImmutable('2024-01-18 00:00 UTC');
        $clock = new WrapperClock($present);
        $clock->sleep(-0.000_001);
    }

    public function testWithTimezoneOnFactory(): void
    {
        $factory = new FactoryImmutable();
        $factory->setTestNowAndTimezone(new DateTimeImmutable('2024-01-18 00:00 UTC'));

        $clock = new WrapperClock($factory);
        $clock->sleep(2.5);

        $carbon = $clock->now();

        $this->assertSame(CarbonImmutable::class, $carbon::class);
        $this->assertSame('2024-01-18 00:00:02.500000 UTC', $carbon->format('Y-m-d H:i:s.u e'));
    }

    public function testWithTimezone(): void
    {
        $factory = new FactoryImmutable();
        $factory->setTestNowAndTimezone(new DateTimeImmutable('2024-01-18 00:00 UTC'));
        $clock = new WrapperClock($factory);
        $now = $clock->withTimeZone('Pacific/Auckland')->now();

        $this->assertSame(CarbonImmutable::class, $now::class);
        $this->assertSame(
            '2024-01-18 13:00:00.000000 Pacific/Auckland',
            $now->format('Y-m-d H:i:s.u e'),
        );

        $factory = new Factory();
        $factory->setTestNowAndTimezone(Carbon::parse('2024-01-18 00:00 UTC'));
        $clock = new WrapperClock($factory);
        $now = $clock->withTimeZone('Pacific/Auckland')->now();

        $this->assertSame(CarbonImmutable::class, $now::class);
        $this->assertSame(
            '2024-01-18 13:00:00.000000 Pacific/Auckland',
            $now->format('Y-m-d H:i:s.u e'),
        );

        $clock = new WrapperClock(new DateTimeImmutable('2024-01-18 00:00 UTC'));
        $now = $clock->withTimeZone('Pacific/Auckland')->now();

        $this->assertSame(DateTimeImmutable::class, $now::class);
        $this->assertSame(
            '2024-01-18 13:00:00.000000 Pacific/Auckland',
            $now->format('Y-m-d H:i:s.u e'),
        );
    }
}
