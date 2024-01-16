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

namespace Carbon;

use DateTime;
use DateTimeImmutable;
use DateTimeInterface;
use DateTimeZone;
use Psr\Clock\ClockInterface as PsrClockInterface;
use Symfony\Component\Clock\ClockInterface;

final class WrapperClock implements ClockInterface
{
    public function __construct(
        private PsrClockInterface|Factory|DateTimeInterface $currentClock,
    ) {
    }

    public function unwrap(): PsrClockInterface|Factory|DateTimeInterface
    {
        return $this->currentClock;
    }

    public function getFactory(): Factory
    {
        if ($this->currentClock instanceof Factory) {
            return $this->currentClock;
        }

        if ($this->currentClock instanceof DateTime) {
            $factory = new Factory();
            $factory->setTestNow($this->currentClock);

            return $factory;
        }

        if ($this->currentClock instanceof DateTimeImmutable) {
            $factory = new FactoryImmutable();
            $factory->setTestNow($this->currentClock);

            return $factory;
        }

        $factory = new FactoryImmutable();
        $factory->setTestNow(fn () => $this->currentClock->now());

        return $factory;
    }

    private function nowRaw(): DateTimeInterface
    {
        if ($this->currentClock instanceof DateTimeInterface) {
            return $this->currentClock;
        }

        if ($this->currentClock instanceof Factory) {
            return $this->currentClock->__call('now', []);
        }

        return $this->currentClock->now();
    }

    public function now(): DateTimeImmutable
    {
        $now = $this->nowRaw();

        return $now instanceof DateTimeImmutable
            ? $now
            : new CarbonImmutable($now);
    }

    /**
     * @template T of CarbonInterface
     *
     * @param class-string<T> $class
     *
     * @return T
     */
    public function nowAs(string $class, DateTimeZone|string|int|null $tz = null): CarbonInterface
    {
        $now = $this->nowRaw();
        $date = $now instanceof $class ? $now : $class::instance($now);

        return $tz === null ? $date : $date->setTimezone($tz);
    }

    public function nowAsCarbon(DateTimeZone|string|int|null $tz = null): CarbonInterface
    {
        $now = $this->nowRaw();

        return $now instanceof CarbonInterface
            ? ($tz === null ? $now : $now->setTimezone($tz))
            : $this->dateAsCarbon($now);
    }

    private function dateAsCarbon(DateTimeInterface $date, DateTimeZone|string|int|null $tz = null): CarbonInterface
    {
        return $date instanceof DateTimeImmutable
            ? new CarbonImmutable($date, $tz)
            : new Carbon($date, $tz);
    }

    public function sleep(float|int $seconds): void
    {
        if ($this->currentClock instanceof DateTimeInterface) {
            $this->currentClock = $this->addSeconds($this->currentClock, $seconds);

            return;
        }

        if ($this->currentClock instanceof ClockInterface) {
            $this->currentClock->sleep($seconds);

            return;
        }

        $this->currentClock = $this->addSeconds($this->currentClock->now(), $seconds);
    }

    public function withTimeZone(DateTimeZone|string $timezone): static
    {
        if ($this->currentClock instanceof ClockInterface) {
            return $this->currentClock->withTimeZone($timezone);
        }

        $now = $this->currentClock instanceof DateTimeInterface
            ? $this->currentClock
            : $this->currentClock->now();

        if (!($now instanceof DateTimeImmutable)) {
            $now = clone $now;
        }

        if (\is_string($timezone)) {
            $timezone = new DateTimeZone($timezone);
        }

        return new self($now->setTimezone($timezone));
    }

    private function addSeconds(DateTimeInterface $date, float|int $seconds): DateTimeInterface
    {
        if ($date instanceof DateTimeImmutable) {
            return $date->modify("$seconds seconds");
        }

        return (clone $date)->modify("$seconds seconds");
    }
}
