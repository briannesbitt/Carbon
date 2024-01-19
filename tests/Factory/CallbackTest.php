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

use Carbon\Callback;
use Carbon\CarbonInterface;
use Carbon\CarbonInterval;
use Carbon\CarbonPeriod;
use Carbon\CarbonTimeZone;
use DateInterval;
use DatePeriod;
use DateTimeImmutable;
use DateTimeZone;
use Tests\AbstractTestCase;

class CallbackTest extends AbstractTestCase
{
    public function testGetReflectionFunction(): void
    {
        $closure = static fn () => 4;
        $callback = Callback::fromClosure($closure);
        $function = $callback->getReflectionFunction();

        $this->assertSame($function, $callback->getReflectionFunction());
        $this->assertSame($closure, $function->getClosure());
    }

    public function testCall(): void
    {
        $closure = static function (CarbonInterface $date, CarbonInterval $interval, string $text, ?CarbonTimeZone $timezone, CarbonPeriod $period): string {
            return implode(', ', [$text, $date->monthName, $interval->seconds, $timezone?->getName(), $period->getRecurrences()]);
        };

        $callback = Callback::fromClosure($closure);
        $result = $callback->call(
            new DateTimeImmutable('2024-01-18'),
            new DateInterval('PT1M30S'),
            'foo',
            new DateTimeZone('CET'),
            new DatePeriod(
                new DateTimeImmutable('2012-07-01T00:00:00'),
                new DateInterval('P1D'),
                7,
            ),
        );

        $this->assertSame('foo, January, 30, CET, 7', $result);

        $result = $callback->call(
            interval: new DateInterval('PT1M21S'),
            date: new DateTimeImmutable('2024-02-18'),
            period: new DatePeriod(
                new DateTimeImmutable('2012-07-01T00:00:00'),
                new DateInterval('P1D'),
                4,
            ),
            timezone: null,
            text: 'bar',
        );

        $this->assertSame('bar, February, 21, , 4', $result);
    }

    public function testParameter(): void
    {
        $closure = static function (CarbonInterface $date, CarbonInterval $interval, string $text, ?CarbonTimeZone $timezone, CarbonPeriod $period): string {
            return implode(', ', [$text, $date->monthName, $interval->seconds, $timezone?->getName(), $period->getRecurrences()]);
        };

        $interval = new DateInterval('P1D');

        $this->assertSame($interval, Callback::parameter($closure, $interval));
        $this->assertSame($interval, Callback::parameter($closure, $interval, 0));
        $this->assertSame($interval, Callback::parameter($closure, $interval, 5));
        $this->assertSame($interval, Callback::parameter($closure, $interval, 'diff'));
        $this->assertSame($interval, Callback::parameter($closure, $interval, 'date'));
        $this->assertSame($interval, Callback::parameter($interval, $interval, 1));
        $this->assertSame($interval, Callback::parameter(static fn (FooBar $foo) => 42, $interval));

        $result = Callback::parameter($closure, $interval, 'interval');

        $this->assertSame(CarbonInterval::class, $result::class);
        $this->assertSame('1 day', $result->forHumans());

        $result = Callback::parameter($closure, $interval, 1);

        $this->assertSame(CarbonInterval::class, $result::class);
        $this->assertSame('1 day', $result->forHumans());
    }
}
