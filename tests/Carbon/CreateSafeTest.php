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
namespace Tests\Carbon;

use Carbon\Carbon;
use Carbon\Exceptions\InvalidDateException;
use Tests\AbstractTestCase;

class CreateSafeTest extends AbstractTestCase
{
    public function testInvalidDateExceptionProperties(): void
    {
        $e = new InvalidDateException('day', 'foo');
        $this->assertSame('day', $e->getField());
        $this->assertSame('foo', $e->getValue());
    }

    public function testCreateSafeThrowsExceptionForSecondLowerThanZero(): void
    {
        $this->expectExceptionObject(new InvalidDateException('second', -1));

        Carbon::createSafe(null, null, null, null, null, -1);
    }

    public function testCreateSafeThrowsExceptionForSecondLowerThanZeroInStrictMode(): void
    {
        Carbon::useStrictMode(false);
        $this->assertFalse(Carbon::createSafe(null, null, null, null, null, -1));
    }

    public function testCreateSafeThrowsExceptionForSecondGreaterThan59(): void
    {
        $this->expectExceptionObject(new InvalidDateException('second', 60));

        Carbon::createSafe(null, null, null, null, null, 60);
    }

    public function testCreateSafeThrowsExceptionForMinuteLowerThanZero(): void
    {
        $this->expectExceptionObject(new InvalidDateException('minute', -1));

        Carbon::createSafe(null, null, null, null, -1);
    }

    public function testCreateSafeThrowsExceptionForMinuteGreaterThan59(): void
    {
        $this->expectExceptionObject(new InvalidDateException('minute', 60));

        Carbon::createSafe(null, null, null, null, 60, 25);
    }

    public function testCreateSafeThrowsExceptionForHourLowerThanZero(): void
    {
        $this->expectExceptionObject(new InvalidDateException('hour', -6));

        Carbon::createSafe(null, null, null, -6);
    }

    public function testCreateSafeThrowsExceptionForHourGreaterThan24(): void
    {
        $this->expectExceptionObject(new InvalidDateException('hour', 25));

        Carbon::createSafe(null, null, null, 25, 16, 15);
    }

    public function testCreateSafeThrowsExceptionForDayLowerThanZero(): void
    {
        $this->expectExceptionObject(new InvalidDateException('day', -5));

        Carbon::createSafe(null, null, -5);
    }

    public function testCreateSafeThrowsExceptionForDayGreaterThan31(): void
    {
        $this->expectExceptionObject(new InvalidDateException('day', 32));

        Carbon::createSafe(null, null, 32, 17, 16, 15);
    }

    public function testCreateSafeThrowsExceptionForMonthLowerThanZero(): void
    {
        $this->expectExceptionObject(new InvalidDateException('month', -4));

        Carbon::createSafe(null, -4);
    }

    public function testCreateSafeThrowsExceptionForMonthGreaterThan12(): void
    {
        $this->expectExceptionObject(new InvalidDateException('month', 13));

        Carbon::createSafe(null, 13, 5, 17, 16, 15);
    }

    public function testCreateSafeThrowsExceptionForYearEqualToZero(): void
    {
        $this->expectExceptionObject(new InvalidDateException('year', 0));

        Carbon::createSafe(0);
    }

    public function testCreateSafeThrowsExceptionForYearLowerThanZero(): void
    {
        $this->expectExceptionObject(new InvalidDateException('year', -5));

        Carbon::createSafe(-5);
    }

    public function testCreateSafeThrowsExceptionForYearGreaterThan12(): void
    {
        $this->expectExceptionObject(new InvalidDateException('year', 10000));

        Carbon::createSafe(10000, 12, 5, 17, 16, 15);
    }

    public function testCreateSafeThrowsExceptionForInvalidDayInShortMonth(): void
    {
        $this->expectExceptionObject(new InvalidDateException('day', 31));

        // 30 days in April
        Carbon::createSafe(2016, 4, 31, 17, 16, 15);
    }

    public function testCreateSafeThrowsExceptionForInvalidDayForFebruaryInLeapYear(): void
    {
        $this->expectExceptionObject(new InvalidDateException('day', 30));

        // 29 days in February for a leap year
        $this->assertTrue(Carbon::create(2016, 2)->isLeapYear());
        Carbon::createSafe(2016, 2, 30, 17, 16, 15);
    }

    public function testCreateSafeThrowsExceptionForInvalidDayForFebruaryInLeapYearInStrictMode(): void
    {
        Carbon::useStrictMode(false);
        $this->assertFalse(Carbon::createSafe(2016, 2, 30, 17, 16, 15));
    }

    public function testCreateSafePassesForFebruaryInLeapYear(): void
    {
        // 29 days in February for a leap year
        $this->assertSame(29, Carbon::createSafe(2016, 2, 29, 17, 16, 15)->day);
    }

    public function testCreateSafeThrowsExceptionForInvalidDayForFebruaryInNonLeapYear(): void
    {
        $this->expectExceptionObject(new InvalidDateException('day', 29));

        // 28 days in February for a non-leap year
        $this->assertFalse(Carbon::create(2015, 2)->isLeapYear());
        Carbon::createSafe(2015, 2, 29, 17, 16, 15);
    }

    public function testCreateSafePassesForInvalidDSTTime(): void
    {
        $message = '';
        $date = null;

        try {
            // 1h jumped to 2h because of the DST, so 1h30 is not a safe date in PHP 5.4+
            Carbon::createSafe(2014, 3, 30, 1, 30, 0, 'Europe/London');
        } catch (InvalidDateException $exception) {
            $message = $exception->getMessage();
        }

        $this->assertStringContainsString('hour : 1 is not a valid value.', $message);
    }

    public function testCreateSafePassesForValidDSTTime(): void
    {
        $this->assertSame(0, Carbon::createSafe(2014, 3, 30, 0, 30, 0, 'Europe/London')->hour);
        $this->assertSame(2, Carbon::createSafe(2014, 3, 30, 2, 30, 0, 'Europe/London')->hour);
        $this->assertSame(1, Carbon::createSafe(2014, 3, 30, 1, 30, 0, 'UTC')->hour);
    }

    public function testCreateSafeThrowsExceptionForWithNonIntegerValue(): void
    {
        $this->expectExceptionObject(new InvalidDateException('second', 15.1));

        Carbon::createSafe(2015, 2, 10, 17, 16, 15.1);
    }

    public function testCreateSafePassesForFebruaryInNonLeapYear(): void
    {
        // 28 days in February for a non-leap year
        $this->assertSame(28, Carbon::createSafe(2015, 2, 28, 17, 16, 15)->day);
    }

    public function testCreateSafePasses(): void
    {
        $sd = Carbon::createSafe(2015, 2, 15, 17, 16, 15);
        $d = Carbon::create(2015, 2, 15, 17, 16, 15);
        $this->assertEquals($d, $sd);
        $this->assertCarbon($sd, 2015, 2, 15, 17, 16, 15);
    }
}
