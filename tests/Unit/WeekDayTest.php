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

use Carbon\Exceptions\InvalidFormatException;
use Carbon\WeekDay;
use Tests\AbstractTestCase;

class WeekDayTest extends AbstractTestCase
{
    public function testFromName(): void
    {
        $this->assertSame(WeekDay::Friday, WeekDay::fromName('fri'));
        $this->assertSame(WeekDay::Tuesday, WeekDay::fromName('TUESDAY'));
        $this->assertSame(WeekDay::Saturday, WeekDay::fromName('sam', 'fr'));
        $this->assertSame(WeekDay::Sunday, WeekDay::fromName('Dimanche', 'fr'));
    }

    public function testFromNumber(): void
    {
        $this->assertSame(WeekDay::Friday, WeekDay::fromNumber(5));
        $this->assertSame(WeekDay::Friday, WeekDay::fromNumber(-2));
        $this->assertSame(WeekDay::Tuesday, WeekDay::fromNumber(9));
        $this->assertSame(WeekDay::Saturday, WeekDay::fromNumber(-1));
        $this->assertSame(WeekDay::Sunday, WeekDay::fromNumber(7));
        $this->assertSame(WeekDay::Sunday, WeekDay::fromNumber(0));
    }

    public function testLocale(): void
    {
        $this->assertSame('venerdì', WeekDay::Friday->locale('it')->dayName);
        $this->assertSame('sábado', WeekDay::Sunday->locale('es')->subDay()->dayName);
    }

    public function testFromNameFailure(): void
    {
        $this->expectExceptionObject(new InvalidFormatException("Could not parse 'pr'"));

        WeekDay::fromName('pr', 'fr');
    }
}
