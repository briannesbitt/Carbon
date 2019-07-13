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
    public function testInvalidDateExceptionProperties()
    {
        $e = new InvalidDateException('day', 'foo');
        $this->assertSame('day', $e->getField());
        $this->assertSame('foo', $e->getValue());
    }

    public function testCreateSafeThrowsExceptionForSecondLowerThanZero()
    {
        $this->expectException(\Carbon\Exceptions\InvalidDateException::class);
        $this->expectExceptionMessage(
            'second : -1 is not a valid value.'
        );

        Carbon::createSafe(null, null, null, null, null, -1);
    }

    public function testCreateSafeThrowsExceptionForSecondLowerThanZeroInStrictMode()
    {
        Carbon::useStrictMode(false);
        $this->assertFalse(Carbon::createSafe(null, null, null, null, null, -1));
        Carbon::useStrictMode(true);
    }

    public function testCreateSafeThrowsExceptionForSecondGreaterThan59()
    {
        $this->expectException(\Carbon\Exceptions\InvalidDateException::class);
        $this->expectExceptionMessage(
            'second : 60 is not a valid value.'
        );

        Carbon::createSafe(null, null, null, null, null, 60);
    }

    public function testCreateSafeThrowsExceptionForMinuteLowerThanZero()
    {
        $this->expectException(\Carbon\Exceptions\InvalidDateException::class);
        $this->expectExceptionMessage(
            'minute : -1 is not a valid value.'
        );

        Carbon::createSafe(null, null, null, null, -1);
    }

    public function testCreateSafeThrowsExceptionForMinuteGreaterThan59()
    {
        $this->expectException(\Carbon\Exceptions\InvalidDateException::class);
        $this->expectExceptionMessage(
            'minute : 60 is not a valid value.'
        );

        Carbon::createSafe(null, null, null, null, 60, 25);
    }

    public function testCreateSafeThrowsExceptionForHourLowerThanZero()
    {
        $this->expectException(\Carbon\Exceptions\InvalidDateException::class);
        $this->expectExceptionMessage(
            'hour : -6 is not a valid value.'
        );

        Carbon::createSafe(null, null, null, -6);
    }

    public function testCreateSafeThrowsExceptionForHourGreaterThan24()
    {
        $this->expectException(\Carbon\Exceptions\InvalidDateException::class);
        $this->expectExceptionMessage(
            'hour : 25 is not a valid value.'
        );

        Carbon::createSafe(null, null, null, 25, 16, 15);
    }

    public function testCreateSafeThrowsExceptionForDayLowerThanZero()
    {
        $this->expectException(\Carbon\Exceptions\InvalidDateException::class);
        $this->expectExceptionMessage(
            'day : -5 is not a valid value.'
        );

        Carbon::createSafe(null, null, -5);
    }

    public function testCreateSafeThrowsExceptionForDayGreaterThan31()
    {
        $this->expectException(\Carbon\Exceptions\InvalidDateException::class);
        $this->expectExceptionMessage(
            'day : 32 is not a valid value.'
        );

        Carbon::createSafe(null, null, 32, 17, 16, 15);
    }

    public function testCreateSafeThrowsExceptionForMonthLowerThanZero()
    {
        $this->expectException(\Carbon\Exceptions\InvalidDateException::class);
        $this->expectExceptionMessage(
            'month : -4 is not a valid value.'
        );

        Carbon::createSafe(null, -4);
    }

    public function testCreateSafeThrowsExceptionForMonthGreaterThan12()
    {
        $this->expectException(\Carbon\Exceptions\InvalidDateException::class);
        $this->expectExceptionMessage(
            'month : 13 is not a valid value.'
        );

        Carbon::createSafe(null, 13, 5, 17, 16, 15);
    }

    public function testCreateSafeThrowsExceptionForYearEqualToZero()
    {
        $this->expectException(\Carbon\Exceptions\InvalidDateException::class);
        $this->expectExceptionMessage(
            'year : 0 is not a valid value.'
        );

        Carbon::createSafe(0);
    }

    public function testCreateSafeThrowsExceptionForYearLowerThanZero()
    {
        $this->expectException(\Carbon\Exceptions\InvalidDateException::class);
        $this->expectExceptionMessage(
            'year : -5 is not a valid value.'
        );

        Carbon::createSafe(-5);
    }

    public function testCreateSafeThrowsExceptionForYearGreaterThan12()
    {
        $this->expectException(\Carbon\Exceptions\InvalidDateException::class);
        $this->expectExceptionMessage(
            'year : 10000 is not a valid value.'
        );

        Carbon::createSafe(10000, 12, 5, 17, 16, 15);
    }

    public function testCreateSafeThrowsExceptionForInvalidDayInShortMonth()
    {
        $this->expectException(\Carbon\Exceptions\InvalidDateException::class);
        $this->expectExceptionMessage(
            'day : 31 is not a valid value.'
        );

        // 30 days in April
        Carbon::createSafe(2016, 4, 31, 17, 16, 15);
    }

    public function testCreateSafeThrowsExceptionForInvalidDayForFebruaryInLeapYear()
    {
        $this->expectException(\Carbon\Exceptions\InvalidDateException::class);
        $this->expectExceptionMessage(
            'day : 30 is not a valid value.'
        );

        // 29 days in February for a leap year
        $this->assertTrue(Carbon::create(2016, 2)->isLeapYear());
        Carbon::createSafe(2016, 2, 30, 17, 16, 15);
    }

    public function testCreateSafeThrowsExceptionForInvalidDayForFebruaryInLeapYearInStrictMode()
    {
        Carbon::useStrictMode(false);
        $this->assertFalse(Carbon::createSafe(2016, 2, 30, 17, 16, 15));
        Carbon::useStrictMode(true);
    }

    public function testCreateSafePassesForFebruaryInLeapYear()
    {
        // 29 days in February for a leap year
        $this->assertSame(29, Carbon::createSafe(2016, 2, 29, 17, 16, 15)->day);
    }

    public function testCreateSafeThrowsExceptionForInvalidDayForFebruaryInNonLeapYear()
    {
        $this->expectException(\Carbon\Exceptions\InvalidDateException::class);
        $this->expectExceptionMessage(
            'day : 29 is not a valid value.'
        );

        // 28 days in February for a non-leap year
        $this->assertFalse(Carbon::create(2015, 2)->isLeapYear());
        Carbon::createSafe(2015, 2, 29, 17, 16, 15);
    }

    public function testCreateSafePassesForInvalidDSTTime()
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

    public function testCreateSafePassesForValidDSTTime()
    {
        $this->assertSame(0, Carbon::createSafe(2014, 3, 30, 0, 30, 0, 'Europe/London')->hour);
        $this->assertSame(2, Carbon::createSafe(2014, 3, 30, 2, 30, 0, 'Europe/London')->hour);
        $this->assertSame(1, Carbon::createSafe(2014, 3, 30, 1, 30, 0, 'UTC')->hour);
    }

    public function testCreateSafeThrowsExceptionForWithNonIntegerValue()
    {
        $this->expectException(\Carbon\Exceptions\InvalidDateException::class);
        $this->expectExceptionMessage(
            'second : 15.1 is not a valid value.'
        );

        Carbon::createSafe(2015, 2, 10, 17, 16, 15.1);
    }

    public function testCreateSafePassesForFebruaryInNonLeapYear()
    {
        // 28 days in February for a non-leap year
        $this->assertSame(28, Carbon::createSafe(2015, 2, 28, 17, 16, 15)->day);
    }

    public function testCreateSafePasses()
    {
        $sd = Carbon::createSafe(2015, 2, 15, 17, 16, 15);
        $d = Carbon::create(2015, 2, 15, 17, 16, 15);
        $this->assertEquals($d, $sd);
        $this->assertCarbon($sd, 2015, 2, 15, 17, 16, 15);
    }
}
