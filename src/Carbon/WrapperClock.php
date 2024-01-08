<?php

/**
 * This file is part of the Carbon package.
 *
 * (c) Brian Nesbitt <brian@nesbot.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Carbon;

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

    public function now(): DateTimeImmutable
    {
        $now = $this->currentClock instanceof DateTimeInterface
            ? $this->currentClock
            : $this->currentClock->now();

        return $now instanceof DateTimeImmutable
            ? $now
            :  new CarbonImmutable($now);
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
