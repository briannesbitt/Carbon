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
use Carbon\CarbonInterface;
use Carbon\Factory;
use Carbon\FactoryImmutable;
use DateTimeImmutable;
use Psr\Clock\ClockInterface;
use ReflectionFunction;
use RuntimeException;
use Tests\AbstractTestCase;
use Tests\Carbon\Fixtures\MyCarbon;

class FactoryTest extends AbstractTestCase
{
    public function testFactory()
    {
        $factory = new Factory();

        $this->assertInstanceOf(Carbon::class, $factory->parse('2018-01-01'));
        $this->assertSame('01/01/2018', $factory->parse('2018-01-01')->format('d/m/Y'));

        $factory = new Factory([
            'locale' => 'fr',
        ]);

        $this->assertSame('fr', $factory->parse('2018-01-01')->locale);

        $factory = new Factory([
            'locale' => 'fr',
        ], MyCarbon::class);

        $this->assertInstanceOf(MyCarbon::class, $factory->parse('2018-01-01'));
        $this->assertSame('01/01/2018', $factory->parse('2018-01-01')->format('d/m/Y'));

        $factory = new FactoryImmutable([
            'locale' => 'fr',
        ]);

        $this->assertInstanceOf(CarbonImmutable::class, $factory->parse('2018-01-01'));
        $this->assertSame('01/01/2018', $factory->parse('2018-01-01')->format('d/m/Y'));
    }

    public function testFactoryModification()
    {
        $factory = new Factory();

        $this->assertSame(Carbon::class, $factory->className());
        $this->assertSame($factory, $factory->className(MyCarbon::class));
        $this->assertSame(MyCarbon::class, $factory->className());

        $this->assertSame([], $factory->settings());
        $this->assertSame($factory, $factory->settings([
            'locale' => 'fr',
        ]));
        $this->assertSame([
            'locale' => 'fr',
        ], $factory->settings());

        $this->assertSame($factory, $factory->mergeSettings([
            'timezone' => 'Europe/Paris',
        ]));
        $this->assertSame([
            'locale' => 'fr',
            'timezone' => 'Europe/Paris',
        ], $factory->settings());

        $this->assertSame($factory, $factory->settings([
            'timezone' => 'Europe/Paris',
        ]));
        $this->assertSame([
            'timezone' => 'Europe/Paris',
        ], $factory->settings());
    }

    public function testFactoryTimezone()
    {
        Carbon::setTestNowAndTimezone(Carbon::parse('2020-09-04 03:39:04.123456', 'UTC'));

        $factory = new Factory();

        $date = $factory->now();
        $this->assertInstanceOf(Carbon::class, $date);
        $this->assertSame('2020-09-04 03:39:04.123456 UTC', $date->format('Y-m-d H:i:s.u e'));

        $factory = new Factory([
            'timezone' => 'Europe/Paris',
        ]);

        $this->assertSame('2020-09-04 05:39:04.123456 Europe/Paris', $factory->now()->format('Y-m-d H:i:s.u e'));
        $this->assertSame('2020-09-04 00:00:00.000000 Europe/Paris', $factory->today()->format('Y-m-d H:i:s.u e'));
        $this->assertSame('2020-09-05 00:00:00.000000 Europe/Paris', $factory->tomorrow()->format('Y-m-d H:i:s.u e'));
        $this->assertSame('2020-09-04 09:39:04.123456 Europe/Paris', $factory->parse('2020-09-04 09:39:04.123456')->format('Y-m-d H:i:s.u e'));

        $factory = new Factory([
            'timezone' => 'America/Toronto',
        ]);

        $this->assertSame('2020-09-03 23:39:04.123456 America/Toronto', $factory->now()->format('Y-m-d H:i:s.u e'));
        $this->assertSame('2020-09-03 00:00:00.000000 America/Toronto', $factory->today()->format('Y-m-d H:i:s.u e'));
        $this->assertSame('2020-09-04 00:00:00.000000 America/Toronto', $factory->tomorrow()->format('Y-m-d H:i:s.u e'));
        $this->assertSame('2020-09-04 09:39:04.123456 America/Toronto', $factory->parse('2020-09-04 09:39:04.123456')->format('Y-m-d H:i:s.u e'));

        $factory = new Factory([
            'timezone' => 'Asia/Shanghai',
        ]);

        $baseDate = Carbon::parse('2021-08-01 08:00:00', 'UTC');

        $date = $factory->createFromTimestamp($baseDate->getTimestamp());
        $this->assertSame('2021-08-01T16:00:00+08:00', $date->format('c'));

        $date = $factory->make('2021-08-01 08:00:00');
        $this->assertSame('2021-08-01T08:00:00+08:00', $date->format('c'));

        $date = $factory->make($baseDate);
        $this->assertSame('2021-08-01T16:00:00+08:00', $date->format('c'));

        $date = $factory->create($baseDate);
        $this->assertSame('2021-08-01T16:00:00+08:00', $date->format('c'));

        $date = $factory->parse($baseDate);
        $this->assertSame('2021-08-01T16:00:00+08:00', $date->format('c'));

        $date = $factory->instance($baseDate);
        $this->assertSame('2021-08-01T16:00:00+08:00', $date->format('c'));

        $date = $factory->make('2021-08-01 08:00:00+00:20');
        $this->assertSame('2021-08-01T08:00:00+00:20', $date->format('c'));

        $date = $factory->parse('2021-08-01T08:00:00Z');
        $this->assertSame('2021-08-01T08:00:00+00:00', $date->format('c'));

        $date = $factory->create('2021-08-01 08:00:00 UTC');
        $this->assertSame('2021-08-01T08:00:00+00:00', $date->format('c'));

        $date = $factory->make('2021-08-01 08:00:00 Europe/Paris');
        $this->assertSame('2021-08-01T08:00:00+02:00', $date->format('c'));
    }

    public function testPsrClock()
    {
        FactoryImmutable::setCurrentClock(null);
        FactoryImmutable::getDefaultInstance()->setTestNow(null);
        $initial = Carbon::now('UTC');
        $factory = new FactoryImmutable();
        $factory->setTestNow($initial);
        $this->assertInstanceOf(ClockInterface::class, $factory);
        $this->assertInstanceOf(DateTimeImmutable::class, $factory->now());
        $this->assertInstanceOf(CarbonImmutable::class, $factory->now());
        $this->assertSame('America/Toronto', $factory->now()->tzName);
        $this->assertSame('UTC', $factory->now('UTC')->tzName);

        $timezonedFactory = $factory->withTimeZone('Asia/Tokyo');
        $this->assertInstanceOf(CarbonImmutable::class, $timezonedFactory->now());
        $this->assertSame('Asia/Tokyo', $timezonedFactory->now()->tzName);
        $this->assertSame('America/Toronto', $timezonedFactory->now('America/Toronto')->tzName);

        $this->assertSame(
            $initial->format('Y-m-d H:i:s.u'),
            $factory->now('UTC')->format('Y-m-d H:i:s.u'),
        );

        $before = microtime(true);
        $factory->sleep(5);
        $factory->sleep(20);
        $after = microtime(true);

        $this->assertLessThan(0.1, $after - $before);

        $this->assertSame(
            $initial->copy()->addSeconds(25)->format('Y-m-d H:i:s.u'),
            $factory->now('UTC')->format('Y-m-d H:i:s.u'),
        );

        $factory = new FactoryImmutable();
        $factory->setTestNow(null);
        $before = new DateTimeImmutable('now UTC');
        $now = $factory->now('UTC');
        $after = new DateTimeImmutable('now UTC');

        $this->assertGreaterThanOrEqual($before, $now);
        $this->assertLessThanOrEqual($after, $now);

        $before = new DateTimeImmutable('now UTC');
        $factory->sleep(0.5);
        $after = new DateTimeImmutable('now UTC');

        $this->assertSame(
            5,
            (int) round(10 * ((float) $after->format('U.u') - ((float) $before->format('U.u')))),
        );
    }

    public function testIsolation(): void
    {
        CarbonImmutable::setTestNow('1990-07-31 23:59:59');

        $libAFactory = new FactoryImmutable();
        $libAFactory->setTestNow('2000-02-05 15:20:00');

        $libBFactory = new FactoryImmutable();
        $libBFactory->setTestNow('2050-12-01 00:00:00');

        $this->assertSame('2000-02-05 15:20:00', (string) $libAFactory->now());
        $this->assertSame('2050-12-01 00:00:00', (string) $libBFactory->now());
        $this->assertSame('1990-07-31 23:59:59', (string) CarbonImmutable::now());

        CarbonImmutable::setTestNow();
    }

    public function testClosureMock(): void
    {
        $factory = new Factory();
        $now = Carbon::parse('2024-01-18 00:00:00');
        $factory->setTestNow(static fn () => $now);

        $result = $factory->now();

        $this->assertNotSame($now, $result);
        $this->assertSame($now->format('Y-m-d H:i:s.u e'), $result->format('Y-m-d H:i:s.u e'));
    }

    public function testClosureMockTypeFailure(): void
    {
        $factory = new Factory();
        $closure = static fn () => 42;
        $factory->setTestNow($closure);
        $function = new ReflectionFunction($closure);

        $this->expectExceptionObject(new RuntimeException(
            'The test closure defined in '.$function->getFileName().
            ' at line '.$function->getStartLine().' returned integer'.
            '; expected '.CarbonInterface::class.'|null',
        ));

        $factory->now();
    }
}
