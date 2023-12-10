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
use Carbon\CarbonInterval;
use Carbon\CarbonPeriodImmutable;
use Carbon\Unit;
use Carbon\WeekDay;
use Tests\AbstractTestCase;

class UnitTest extends AbstractTestCase
{
    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();

        CarbonImmutable::setLocale('en');
    }

    /**
     * @dataProvider dataForFromName
     */
    public function testFromName(Unit $unit, string $name, ?string $locale = null): void
    {
        $this->assertSame($unit, Unit::fromName($name, $locale));
    }

    public static function dataForFromName(): array
    {
        return [
            [Unit::Microsecond, 'microseconds'],
            [Unit::Millisecond, 'millisecond'],
            [Unit::Second, 'second'],
            [Unit::Minute, 'minute'],
            [Unit::Hour, 'hours'],
            [Unit::Day, 'day'],
            [Unit::Week, 'WEEK'],
            [Unit::Month, 'Month'],
            [Unit::Quarter, 'quarters'],
            [Unit::Year, 'year'],
            [Unit::Decade, 'decade'],
            [Unit::Century, 'centuries'],
            [Unit::Millennium, 'millennia'],
            [Unit::Day, 'day'],
            [Unit::Day, 'day'],
            [Unit::Day, 'jour', 'fr_BE'],
            [Unit::Day, 'JOUR', 'fr'],
            [Unit::Month, 'Monaten', 'de'],
            [Unit::Month, 'monaten', 'de'],
        ];
    }

    public function testSingular(): void
    {
        $this->assertSame('day', Unit::Day->singular());
        $this->assertSame('century', Unit::Century->singular());
        $this->assertSame('jour', Unit::Day->singular('fr'));
        $this->assertSame('Tag', Unit::Day->singular('de'));
        $this->assertSame('siècle', Unit::Century->singular('fr'));
    }

    public function testPlural(): void
    {
        $this->assertSame('days', Unit::Day->plural());
        $this->assertSame('centuries', Unit::Century->plural());
        $this->assertSame('jours', Unit::Day->plural('fr'));
        $this->assertSame('Tage', Unit::Day->plural('de'));
        $this->assertSame('siècles', Unit::Century->plural('fr'));
    }

    public function testInterval(): void
    {
        $interval = Unit::Day->interval(2);
        $this->assertInstanceOf(CarbonInterval::class, $interval);
        $this->assertSame(['days' => 2], array_filter($interval->toArray()));
    }

    public function testLocale(): void
    {
        $interval = Unit::Day->locale('fr');
        $this->assertInstanceOf(CarbonInterval::class, $interval);
        $this->assertSame(['days' => 1], array_filter($interval->toArray()));
        $this->assertSame('1 jour', $interval->forHumans());
    }

    public function testToPeriod(): void
    {
        CarbonImmutable::setTestNow('2023-12-09 11:47:53');
        $days = Unit::Day->toPeriod(WeekDay::Monday, WeekDay::Friday);
        $this->assertInstanceOf(CarbonPeriodImmutable::class, $days);
        $this->assertSame('Every 1 day from 2023-12-11 to 2023-12-15', (string) $days);
    }

    public function testStepBy(): void
    {
        CarbonImmutable::setTestNow('2023-12-09 11:47:53');
        $days = Unit::Week->stepBy(Unit::Day);
        $this->assertInstanceOf(CarbonPeriodImmutable::class, $days);
        $this->assertSame('Every 1 day from 2023-12-09 11:47:53 to 2023-12-16 11:47:53', (string) $days);
    }
}
