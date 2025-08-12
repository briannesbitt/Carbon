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

namespace Tests\CarbonPeriod;

use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Carbon\CarbonInterval;
use Carbon\Translator;
use DatePeriod;
use DateTime;
use DateTimeImmutable;
use ReflectionMethod;
use Tests\AbstractTestCase;

class ToDatePeriodTest extends AbstractTestCase
{
    public function testToArrayIsNotEmptyArray()
    {
        $periodClass = static::$periodClass;
        $period = $periodClass::create('2021-01-05', '2021-02-15');
        $result = $period->toDatePeriod();

        $this->assertFalse($period->isEndExcluded());
        $this->assertSame(DatePeriod::class, \get_class($result));
        $this->assertSame('2021-01-05', $result->getStartDate()->format('Y-m-d'));
        $this->assertSame('2021-02-15', $result->getEndDate()->format('Y-m-d'));
        // CarbonPeriod includes end date by default while DatePeriod will always exclude it
        $dates = iterator_to_array($result);
        $this->assertSame('2021-02-14', end($dates)->format('Y-m-d'));
        $this->assertTrue($period->equalTo($periodClass::instance($result)));

        $period = $periodClass::create('2021-01-05', '2021-02-15', $periodClass::EXCLUDE_END_DATE);
        $result = $period->toDatePeriod();
        $newInstance = $periodClass::instance($result);

        $this->assertTrue($period->isEndExcluded());
        $this->assertSame(DatePeriod::class, \get_class($result));
        $this->assertSame('2021-01-05', $result->getStartDate()->format('Y-m-d'));
        $this->assertSame('2021-02-14', $result->getEndDate()->format('Y-m-d'));
        $dates = iterator_to_array($result);
        $this->assertSame('2021-02-13', end($dates)->format('Y-m-d'));
        $this->assertSame('2021-01-05', $newInstance->getStartDate()->format('Y-m-d'));
        $this->assertSame('2021-02-14', $newInstance->getEndDate()->format('Y-m-d'));

        $period = $periodClass::create('2021-01-05', 3);
        $result = $period->toDatePeriod();
        $newInstance = $periodClass::instance($result);

        $this->assertSame(DatePeriod::class, \get_class($result));
        $this->assertSame('2021-01-05', $result->getStartDate()->format('Y-m-d'));
        $this->assertNull($result->getEndDate());
        $dates = iterator_to_array($result);
        $this->assertSame('2021-01-08', end($dates)->format('Y-m-d'));
        $this->assertSame('2021-01-05', $newInstance->getStartDate()->format('Y-m-d'));
        $this->assertSame(3, $newInstance->getRecurrences());
    }

    public function testWithIntervalLocalized()
    {
        CarbonInterval::setLocale('fr');
        $periodClass = static::$periodClass;
        $period = $periodClass::create('2021-01-05', 3);
        $result = $period->floor()->toDatePeriod();

        $this->assertSame(DatePeriod::class, \get_class($result));
        $this->assertSame('2021-01-05', $result->getStartDate()->format('Y-m-d'));
        $this->assertNull($result->getEndDate());

        if (method_exists($result, 'getRecurrences')) {
            $this->assertSame(3, $result->getRecurrences());
        }

        CarbonInterval::setLocale('en');
    }

    public function testWithModifiedEnglish()
    {
        $periodClass = static::$periodClass;
        $translator = Translator::get('en');
        $translator->setTranslations([
            'day' => ':count boring day|:count boring days',
        ]);
        $period = $periodClass::create('2021-01-05', 3);
        $result = $period->floor()->toDatePeriod();

        $this->assertSame(DatePeriod::class, \get_class($result));
        $this->assertSame('2021-01-05', $result->getStartDate()->format('Y-m-d'));
        $this->assertNull($result->getEndDate());

        if (method_exists($result, 'getRecurrences')) {
            $this->assertSame(3, $result->getRecurrences());
        }

        $translator->resetMessages();
    }

    public function testRawDate()
    {
        $periodClass = static::$periodClass;
        $period = new $periodClass();
        $method = new ReflectionMethod($periodClass, 'rawDate');

        $this->assertNull($method->invoke($period, false));
        $this->assertNull($method->invoke($period, null));

        $date = new DateTime();
        $this->assertSame($date, $method->invoke($period, $date));

        $date = new DateTimeImmutable();
        $this->assertSame($date, $method->invoke($period, $date));

        $date = new Carbon();
        $raw = $method->invoke($period, $date);
        $this->assertInstanceOf(DateTime::class, $raw);
        $this->assertEquals($date, $raw);

        $date = new CarbonImmutable();
        $raw = $method->invoke($period, $date);
        $this->assertInstanceOf(DateTimeImmutable::class, $raw);
        $this->assertEquals($date, $raw);

        $date = new class() extends DateTime {
            // void
        };
        $raw = $method->invoke($period, $date);
        $this->assertInstanceOf(DateTime::class, $raw);
        $this->assertEquals($date, $raw);

        $date = new class() extends DateTimeImmutable {
            // void
        };
        $raw = $method->invoke($period, $date);
        $this->assertInstanceOf(DateTimeImmutable::class, $raw);
        $this->assertEquals($date, $raw);
    }
}
