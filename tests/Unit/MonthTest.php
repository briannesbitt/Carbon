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

namespace Tests\Unit;

use Carbon\CarbonImmutable;
use Carbon\Exceptions\InvalidFormatException;
use Carbon\Month;
use Tests\AbstractTestCase;

class MonthTest extends AbstractTestCase
{
    public function testFromName(): void
    {
        $this->assertSame(Month::January, Month::fromName('jan'));
        $this->assertSame(Month::February, Month::fromName('FEBRUARY'));
        $this->assertSame(Month::February, Month::fromName('févr', 'fr'));
        $this->assertSame(Month::March, Month::fromName('Mars', 'fr'));
    }

    public function testFromNumber(): void
    {
        $this->assertSame(Month::May, Month::fromNumber(5));
        $this->assertSame(Month::October, Month::fromNumber(-2));
        $this->assertSame(Month::September, Month::fromNumber(9));
        $this->assertSame(Month::November, Month::fromNumber(-1));
        $this->assertSame(Month::July, Month::fromNumber(7));
        $this->assertSame(Month::December, Month::fromNumber(0));
        $this->assertSame(Month::December, Month::fromNumber(12));
        $this->assertSame(Month::January, Month::fromNumber(13));
    }

    public function testOfTheYear(): void
    {
        $date = Month::October->ofTheYear(2020);
        $this->assertInstanceOf(CarbonImmutable::class, $date);
        $this->assertSame('2020-10-01 00:00:00.000000 America/Toronto', $date->format('Y-m-d H:i:s.u e'));
    }

    public function testLocale(): void
    {
        $this->assertSame('ottobre', Month::October->locale('it')->monthName);
        $this->assertSame('diciembre', Month::January->locale('es')->subMonth()->monthName);
    }

    public function testFromNameFailure(): void
    {
        $this->expectExceptionObject(new InvalidFormatException("Could not parse 'pr 1'"));

        Month::fromName('pr', 'fr');
    }
}
