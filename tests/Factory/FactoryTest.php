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
use DateTimeImmutable;
use Psr\Clock\ClockInterface;
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
        $factory = new FactoryImmutable();
        $this->assertInstanceOf(ClockInterface::class, $factory);
        $this->assertInstanceOf(DateTimeImmutable::class, $factory->now());
        $this->assertInstanceOf(CarbonImmutable::class, $factory->now());
    }
}
