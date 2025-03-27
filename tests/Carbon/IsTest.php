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

use BadMethodCallException;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use Carbon\Month;
use Carbon\Unit;
use Carbon\WeekDay;
use DateInterval;
use DateTime;
use PHPUnit\Framework\Attributes\DataProvider;
use stdClass;
use Tests\AbstractTestCase;
use TypeError;

class IsTest extends AbstractTestCase
{
    public function testIsWeekdayTrue()
    {
        $this->assertTrue(Carbon::createFromDate(2012, 1, 2)->isWeekday());
    }

    public function testIsWeekdayFalse()
    {
        $this->assertFalse(Carbon::createFromDate(2012, 1, 1)->isWeekday());
    }

    public function testIsWeekendTrue()
    {
        $this->assertTrue(Carbon::createFromDate(2012, 1, 1)->isWeekend());
    }

    public function testIsWeekendFalse()
    {
        $this->assertFalse(Carbon::createFromDate(2012, 1, 2)->isWeekend());
    }

    public function testIsYesterdayTrue()
    {
        $this->assertTrue(Carbon::now()->subDay()->isYesterday());
    }

    public function testIsYesterdayFalseWithToday()
    {
        $this->assertFalse(Carbon::now()->endOfDay()->isYesterday());
    }

    public function testIsYesterdayFalseWith2Days()
    {
        $this->assertFalse(Carbon::now()->subDays(2)->startOfDay()->isYesterday());
    }

    public function testIsTodayTrue()
    {
        $this->assertTrue(Carbon::now()->isToday());
    }

    public function testIsCurrentWeek()
    {
        $this->assertFalse(Carbon::now()->subWeek()->isCurrentWeek());
        $this->assertFalse(Carbon::now()->addWeek()->isCurrentWeek());
        $this->assertTrue(Carbon::now()->isCurrentWeek());
        $this->assertTrue(Carbon::now()->startOfWeek()->isCurrentWeek());
        $this->assertTrue(Carbon::now()->endOfWeek()->isCurrentWeek());
    }

    public function testIsSameWeek()
    {
        $this->assertFalse(Carbon::now()->subWeek()->isSameWeek(Carbon::now()));
        $this->assertFalse(Carbon::now()->addWeek()->isSameWeek(Carbon::now()));
        $this->assertTrue(Carbon::now()->isSameWeek(Carbon::now()));
        $this->assertTrue(Carbon::now()->startOfWeek()->isSameWeek(Carbon::now()));
        $this->assertTrue(Carbon::now()->endOfWeek()->isSameWeek(Carbon::now()));
        $this->assertTrue(Carbon::parse('2019-01-01')->isSameWeek(Carbon::parse('2018-12-31')));
    }

    public function testIsNextWeekTrue()
    {
        $this->assertTrue(Carbon::now()->addWeek()->isNextWeek());
    }

    public function testIsLastWeekTrue()
    {
        $this->assertTrue(Carbon::now()->subWeek()->isLastWeek());
    }

    public function testIsNextWeekFalse()
    {
        /** @var mixed $date */
        $date = Carbon::now();
        $this->assertFalse($date->addWeek(2)->isNextWeek());
    }

    public function testIsLastWeekFalse()
    {
        /** @var mixed $date */
        $date = Carbon::now();
        $this->assertFalse($date->subWeek(2)->isLastWeek());
    }

    public function testIsNextQuarterTrue()
    {
        $this->assertTrue(Carbon::now()->addQuarterNoOverflow()->isNextQuarter());
    }

    public function testIsLastQuarterTrue()
    {
        $this->assertTrue(Carbon::now()->subQuarterNoOverflow()->isLastQuarter());
    }

    public function testIsNextQuarterFalse()
    {
        $this->assertFalse(Carbon::now()->addQuartersNoOverflow(2)->isNextQuarter());
        $this->assertFalse(Carbon::now()->addQuartersNoOverflow(5)->isNextQuarter());
    }

    public function testIsLastQuarterFalse()
    {
        $this->assertFalse(Carbon::now()->subQuartersNoOverflow(2)->isLastQuarter());
        $this->assertFalse(Carbon::now()->subQuartersNoOverflow(5)->isLastQuarter());
    }

    public function testIsNextMonthTrue()
    {
        $this->assertTrue(Carbon::now()->addMonthNoOverflow()->isNextMonth());
    }

    public function testIsLastMonthTrue()
    {
        $this->assertTrue(Carbon::now()->subMonthNoOverflow()->isLastMonth());
    }

    public function testIsNextMonthFalse()
    {
        $this->assertFalse(Carbon::now()->addMonthsNoOverflow(2)->isNextMonth());
        $this->assertFalse(Carbon::now()->addMonthsNoOverflow(13)->isNextMonth());
    }

    public function testIsLastMonthFalse()
    {
        Carbon::setTestNow(Carbon::create(2018, 5, 31));
        $this->assertFalse(Carbon::now()->subMonthsNoOverflow(2)->isLastMonth());
        $this->assertFalse(Carbon::now()->subMonthsNoOverflow(13)->isLastMonth());
    }

    public function testIsNextYearTrue()
    {
        $this->assertTrue(Carbon::now()->addYear()->isNextYear());
    }

    public function testIsLastYearTrue()
    {
        $this->assertTrue(Carbon::now()->subYear()->isLastYear());
    }

    public function testIsNextYearFalse()
    {
        /** @var mixed $date */
        $date = Carbon::now();
        $this->assertFalse($date->addYear(2)->isNextYear());
    }

    public function testIsLastYearFalse()
    {
        /** @var mixed $date */
        $date = Carbon::now();
        $this->assertFalse($date->subYear(2)->isLastYear());
    }

    public function testIsTodayFalseWithYesterday()
    {
        $this->assertFalse(Carbon::now()->subDay()->endOfDay()->isToday());
    }

    public function testIsTodayFalseWithTomorrow()
    {
        $this->assertFalse(Carbon::now()->addDay()->startOfDay()->isToday());
    }

    public function testIsTodayWithTimezone()
    {
        $this->assertTrue(Carbon::now('Asia/Tokyo')->isToday());
    }

    public function testIsTomorrowTrue()
    {
        $this->assertTrue(Carbon::now()->addDay()->isTomorrow());
    }

    public function testIsTomorrowFalseWithToday()
    {
        $this->assertFalse(Carbon::now()->endOfDay()->isTomorrow());
    }

    public function testIsTomorrowFalseWith2Days()
    {
        $this->assertFalse(Carbon::now()->addDays(2)->startOfDay()->isTomorrow());
    }

    public function testIsFutureTrue()
    {
        $this->assertTrue(Carbon::now()->addSecond()->isFuture());
    }

    public function testIsFutureFalse()
    {
        $this->assertFalse(Carbon::now()->isFuture());
    }

    public function testIsFutureFalseInThePast()
    {
        $this->assertFalse(Carbon::now()->subSecond()->isFuture());
    }

    public function testIsPastTrue()
    {
        $this->assertTrue(Carbon::now()->subSecond()->isPast());
    }

    public function testIsPastFalse()
    {
        $this->assertFalse(Carbon::now()->addSecond()->isPast());
    }

    public function testNowIsPastFalse()
    {
        $this->assertFalse(Carbon::now()->isPast());
    }

    public function testIsNowOrFutureTrue()
    {
        $this->assertTrue(Carbon::now()->addSecond()->isNowOrFuture());
    }

    public function testIsNowOrFutureFalse()
    {
        $this->assertFalse(Carbon::now()->subSecond()->isNowOrFuture());
    }

    public function testNowIsNowOrFutureTrue()
    {
        $this->assertTrue(Carbon::now()->isNowOrFuture());
    }

    public function testIsNowOrPastTrue()
    {
        $this->assertTrue(Carbon::now()->subSecond()->isNowOrPast());
    }

    public function testIsNowOrPastFalse()
    {
        $this->assertFalse(Carbon::now()->addSecond()->isNowOrPast());
    }

    public function testNowIsNowOrPastTrue()
    {
        $this->assertTrue(Carbon::now()->isNowOrPast());
    }

    public function testIsLeapYearTrue()
    {
        $this->assertTrue(Carbon::createFromDate(2016, 1, 1)->isLeapYear());
    }

    public function testIsLeapYearFalse()
    {
        $this->assertFalse(Carbon::createFromDate(2014, 1, 1)->isLeapYear());
    }

    public function testIsCurrentYearTrue()
    {
        $this->assertTrue(Carbon::now()->isCurrentYear());
    }

    public function testIsCurrentYearFalse()
    {
        $this->assertFalse(Carbon::now()->subYear()->isCurrentYear());
    }

    public function testIsSameYearTrue()
    {
        $this->assertTrue(Carbon::now()->isSameYear(Carbon::now()));
    }

    public function testIsSameYearFalse()
    {
        $this->assertFalse(Carbon::now()->isSameYear(Carbon::now()->subYear()));
    }

    public function testIsCurrentQuarterTrue()
    {
        $this->assertTrue(Carbon::now()->isCurrentQuarter());
    }

    public function testIsCurrentQuarterFalse()
    {
        Carbon::useMonthsOverflow(false);
        $this->assertFalse(Carbon::now()->subQuarter()->isCurrentQuarter());
        Carbon::resetMonthsOverflow();
    }

    public function testIsSameQuarterTrue()
    {
        $this->assertTrue(Carbon::now()->isSameQuarter(Carbon::now()));
    }

    public function testIsSameQuarterTrueWithDateTime()
    {
        $this->assertTrue(Carbon::now()->isSameQuarter(new DateTime()));
    }

    public function testIsSameQuarterFalse()
    {
        Carbon::useMonthsOverflow(false);
        $this->assertFalse(Carbon::now()->isSameQuarter(Carbon::now()->subQuarter()));
        Carbon::resetMonthsOverflow();
    }

    public function testIsSameQuarterFalseWithDateTime()
    {
        $now = Carbon::now();
        $dt = new DateTime();
        $dt->modify((Carbon::MONTHS_PER_QUARTER * -1).' month');

        if ($dt->format('d') !== $now->format('d')) {
            $dt->modify('last day of previous month');
        }

        $this->assertFalse($now->isSameQuarter($dt));
    }

    public function testIsSameQuarterAndYearTrue()
    {
        $this->assertTrue(Carbon::now()->isSameQuarter(Carbon::now(), true));
    }

    public function testIsSameQuarterAndYearTrueWithDateTime()
    {
        $this->assertTrue(Carbon::now()->isSameQuarter(new DateTime(), true));
    }

    public function testIsSameQuarterAndYearFalse()
    {
        $this->assertFalse(Carbon::now()->isSameQuarter(Carbon::now()->subYear(), true));
    }

    public function testIsSameQuarterAndYearFalseWithDateTime()
    {
        $dt = new DateTime();
        $dt->modify('-1 year');
        $this->assertFalse(Carbon::now()->isSameQuarter($dt, true));
    }

    public function testIsCurrentMonth()
    {
        $this->assertTrue(Carbon::now()->isCurrentMonth());
        $dt = Carbon::now();
        $dt->modify(Carbon::now()->year.$dt->format('-m-').'01');
        $this->assertTrue($dt->isCurrentMonth());
        $dt->modify((Carbon::now()->year + 1).$dt->format('-m-').'28');
        $this->assertFalse($dt->isCurrentMonth());
    }

    public function testIsCurrentMonthFalse()
    {
        $this->assertFalse(Carbon::now()->day(15)->subMonth()->isCurrentMonth());
        $this->assertFalse(Carbon::now()->day(15)->addYear()->isCurrentMonth());
    }

    public function testIsSameMonth()
    {
        $this->assertTrue(Carbon::now()->isSameMonth(Carbon::now()));
        $dt = Carbon::now();
        for ($year = 1990; $year < Carbon::now()->year; $year++) {
            $dt->modify($year.$dt->format('-m-').'01');
            $this->assertTrue(Carbon::now()->isSameMonth($dt, false));
            $dt->modify($year.$dt->format('-m-').'28');
            $this->assertTrue(Carbon::now()->isSameMonth($dt, false));
        }
    }

    public function testIsSameMonthTrueWithDateTime()
    {
        $this->assertTrue(Carbon::now()->isSameMonth(new DateTime()));
        $dt = new DateTime();
        for ($year = 1990; $year < 2200; $year++) {
            $dt->modify($year.$dt->format('-m-').'01');
            $this->assertTrue(Carbon::now()->isSameMonth($dt, false));
            $dt->modify($year.$dt->format('-m-').'28');
            $this->assertTrue(Carbon::now()->isSameMonth($dt, false));
        }
    }

    public function testIsSameMonthOfSameYear()
    {
        $this->assertFalse(Carbon::now()->isSameMonth(Carbon::now()->day(15)->subMonth()));
        $this->assertTrue(Carbon::now()->isSameMonth(Carbon::now()));
        $dt = Carbon::now();
        for ($year = 1990; $year < Carbon::now()->year; $year++) {
            $dt->modify($year.$dt->format('-m-').'01');
            $this->assertFalse(Carbon::now()->isSameMonth($dt, true));
            $dt->modify($year.$dt->format('-m-').'28');
            $this->assertFalse(Carbon::now()->isSameMonth($dt, true));
        }
        $year = Carbon::now()->year;
        $dt->modify($year.$dt->format('-m-').'01');
        $this->assertTrue(Carbon::now()->isSameMonth($dt, true));
        $dt->modify($year.$dt->format('-m-').'28');
        $this->assertTrue(Carbon::now()->isSameMonth($dt, true));
        for ($year = Carbon::now()->year + 1; $year < 2200; $year++) {
            $dt->modify($year.$dt->format('-m-').'01');
            $this->assertFalse(Carbon::now()->isSameMonth($dt, true));
            $dt->modify($year.$dt->format('-m-').'28');
            $this->assertFalse(Carbon::now()->isSameMonth($dt, true));
        }
    }

    public function testIsSameMonthFalseWithDateTime()
    {
        $dt = new DateTime();
        $dt->modify('-2 months');
        $this->assertFalse(Carbon::now()->isSameMonth($dt));
    }

    public function testIsSameMonthAndYearTrue()
    {
        $this->assertTrue(Carbon::now()->isSameMonth(Carbon::now(), true));
        $dt = Carbon::now();
        $dt->modify($dt->format('Y-m-').'01');
        $this->assertTrue(Carbon::now()->isSameMonth($dt, true));
        $dt->modify($dt->format('Y-m-').'28');
        $this->assertTrue(Carbon::now()->isSameMonth($dt, true));
    }

    public function testIsSameMonthAndYearTrueWithDateTime()
    {
        $this->assertTrue(Carbon::now()->isSameMonth(new DateTime(), true));
        $dt = new DateTime();
        $dt->modify($dt->format('Y-m-').'01');
        $this->assertTrue(Carbon::now()->isSameMonth($dt, true));
        $dt->modify($dt->format('Y-m-').'28');
        $this->assertTrue(Carbon::now()->isSameMonth($dt, true));
    }

    public function testIsSameMonthAndYearFalse()
    {
        $this->assertFalse(Carbon::now()->isSameMonth(Carbon::now()->subYear(), true));
    }

    public function testIsSameMonthAndYearFalseWithDateTime()
    {
        $dt = new DateTime();
        $dt->modify('-1 year');
        $this->assertFalse(Carbon::now()->isSameMonth($dt, true));
    }

    public function testIsSameDayTrue()
    {
        $current = Carbon::createFromDate(2012, 1, 2);
        $this->assertTrue($current->isSameDay(Carbon::createFromDate(2012, 1, 2)));
        $this->assertTrue($current->isSameDay(Carbon::create(2012, 1, 2, 23, 59, 59)));
    }

    public function testIsSameDayWithString()
    {
        $current = Carbon::createFromDate(2012, 1, 2);
        $this->assertTrue($current->isSameDay('2012-01-02 15:00:25'));
        $this->assertTrue($current->isSameDay('2012-01-02'));
    }

    public function testIsSameDayTrueWithDateTime()
    {
        $current = Carbon::createFromDate(2012, 1, 2);
        $this->assertTrue($current->isSameDay(new DateTime('2012-01-02')));
        $this->assertTrue($current->isSameDay(new DateTime('2012-01-02 23:59:59')));
    }

    public function testIsSameDayFalse()
    {
        $current = Carbon::createFromDate(2012, 1, 2);
        $this->assertFalse($current->isSameDay(Carbon::createFromDate(2012, 1, 3)));
        $this->assertFalse($current->isSameDay(Carbon::createFromDate(2012, 6, 2)));
    }

    public function testIsSameDayFalseWithDateTime()
    {
        $current = Carbon::createFromDate(2012, 1, 2);
        $this->assertFalse($current->isSameDay(new DateTime('2012-01-03')));
        $this->assertFalse($current->isSameDay(new DateTime('2012-05-02')));
    }

    public function testIsCurrentDayTrue()
    {
        $this->assertTrue(Carbon::now()->isCurrentDay());
        $this->assertTrue(Carbon::now()->hour(0)->isCurrentDay());
        $this->assertTrue(Carbon::now()->hour(23)->isCurrentDay());
    }

    public function testIsCurrentDayFalse()
    {
        $this->assertFalse(Carbon::now()->subDay()->isCurrentDay());
        $this->assertFalse(Carbon::now()->subMonth()->isCurrentDay());
    }

    public function testIsSameHourTrue()
    {
        $current = Carbon::create(2018, 5, 6, 12);
        $this->assertTrue($current->isSameHour(Carbon::create(2018, 5, 6, 12)));
        $this->assertTrue($current->isSameHour(Carbon::create(2018, 5, 6, 12, 59, 59)));
    }

    public function testIsSameHourTrueWithDateTime()
    {
        $current = Carbon::create(2018, 5, 6, 12);
        $this->assertTrue($current->isSameHour(new DateTime('2018-05-06T12:00:00')));
        $this->assertTrue($current->isSameHour(new DateTime('2018-05-06T12:59:59')));
    }

    public function testIsSameHourFalse()
    {
        $current = Carbon::create(2018, 5, 6, 12);
        $this->assertFalse($current->isSameHour(Carbon::create(2018, 5, 6, 13)));
        $this->assertFalse($current->isSameHour(Carbon::create(2018, 5, 5, 12)));
    }

    public function testIsSameHourFalseWithDateTime()
    {
        $current = Carbon::create(2018, 5, 6, 12);
        $this->assertFalse($current->isSameHour(new DateTime('2018-05-06T13:00:00')));
        $this->assertFalse($current->isSameHour(new DateTime('2018-06-06T12:00:00')));
    }

    public function testIsCurrentHourTrue()
    {
        $this->assertTrue(Carbon::now()->isCurrentHour());
        $this->assertTrue(Carbon::now()->second(1)->isCurrentHour());
        $this->assertTrue(Carbon::now()->second(12)->isCurrentHour());
        $this->assertTrue(Carbon::now()->minute(0)->isCurrentHour());
        $this->assertTrue(Carbon::now()->minute(59)->second(59)->isCurrentHour());
    }

    public function testIsCurrentHourFalse()
    {
        $this->assertFalse(Carbon::now()->subHour()->isCurrentHour());
        $this->assertFalse(Carbon::now()->subDay()->isCurrentHour());
    }

    public function testIsSameMinuteTrue()
    {
        $current = Carbon::create(2018, 5, 6, 12, 30);
        $this->assertTrue($current->isSameMinute(Carbon::create(2018, 5, 6, 12, 30)));
        $current = Carbon::create(2018, 5, 6, 12, 30, 15);
        $this->assertTrue($current->isSameMinute(Carbon::create(2018, 5, 6, 12, 30, 45)));
    }

    public function testIsSameMinuteTrueWithDateTime()
    {
        $current = Carbon::create(2018, 5, 6, 12, 30);
        $this->assertTrue($current->isSameMinute(new DateTime('2018-05-06T12:30:00')));
        $current = Carbon::create(2018, 5, 6, 12, 30, 20);
        $this->assertTrue($current->isSameMinute(new DateTime('2018-05-06T12:30:40')));
    }

    public function testIsSameMinuteFalse()
    {
        $current = Carbon::create(2018, 5, 6, 12, 30);
        $this->assertFalse($current->isSameMinute(Carbon::create(2018, 5, 6, 13, 31)));
        $this->assertFalse($current->isSameMinute(Carbon::create(2019, 5, 6, 13, 30)));
    }

    public function testIsSameMinuteFalseWithDateTime()
    {
        $current = Carbon::create(2018, 5, 6, 12, 30);
        $this->assertFalse($current->isSameMinute(new DateTime('2018-05-06T13:31:00')));
        $this->assertFalse($current->isSameMinute(new DateTime('2018-05-06T17:30:00')));
    }

    public function testIsCurrentMinuteTrue()
    {
        $this->assertTrue(Carbon::now()->isCurrentMinute());
        $this->assertTrue(Carbon::now()->second(0)->isCurrentMinute());
        $this->assertTrue(Carbon::now()->second(59)->isCurrentMinute());
    }

    public function testIsCurrentMinuteFalse()
    {
        $this->assertFalse(Carbon::now()->subMinute()->isCurrentMinute());
        $this->assertFalse(Carbon::now()->subHour()->isCurrentMinute());
    }

    public function testIsSameSecondTrue()
    {
        $current = Carbon::create(2018, 5, 6, 12, 30, 13);
        $other = Carbon::create(2018, 5, 6, 12, 30, 13);
        $this->assertTrue($current->isSameSecond($other));
        $this->assertTrue($current->modify($current->hour.':'.$current->minute.':'.$current->second.'.0')->isSameSecond($other));
        $this->assertTrue($current->modify($current->hour.':'.$current->minute.':'.$current->second.'.999999')->isSameSecond($other));
    }

    public function testIsSameSecondTrueWithDateTime()
    {
        $current = Carbon::create(2018, 5, 6, 12, 30, 13);
        $this->assertTrue($current->isSameSecond(new DateTime('2018-05-06T12:30:13')));
    }

    public function testIsSameSecondFalse()
    {
        $current = Carbon::create(2018, 5, 6, 12, 30, 13);
        $this->assertFalse($current->isSameSecond(Carbon::create(2018, 5, 6, 12, 30, 55)));
        $this->assertFalse($current->isSameSecond(Carbon::create(2018, 5, 6, 14, 30, 13)));
    }

    public function testIsSameSecondFalseWithDateTime()
    {
        $current = Carbon::create(2018, 5, 6, 12, 30, 13);
        $this->assertFalse($current->isSameSecond(new DateTime('2018-05-06T13:30:54')));
        $this->assertFalse($current->isSameSecond(new DateTime('2018-05-06T13:36:13')));
    }

    public function testIsCurrentSecondTrue()
    {
        $this->assertTrue(Carbon::now()->isCurrentSecond());
        $now = Carbon::now();
        $this->assertTrue($now->modify($now->hour.':'.$now->minute.':'.$now->second.'.0')->isCurrentSecond());
        $this->assertTrue($now->modify($now->hour.':'.$now->minute.':'.$now->second.'.999999')->isCurrentSecond());
    }

    public function testIsCurrentSecondFalse()
    {
        $this->assertFalse(Carbon::now()->subSecond()->isCurrentSecond());
        $this->assertFalse(Carbon::now()->subDay()->isCurrentSecond());
    }

    public function testIsSameMicrosecond()
    {
        $current = new Carbon('2018-05-06T13:30:54.123456');
        $this->assertTrue($current->isSameMicrosecond(new DateTime('2018-05-06T13:30:54.123456')));
        $this->assertFalse($current->isSameMicrosecond(new DateTime('2018-05-06T13:30:54.123457')));
        $this->assertFalse($current->isSameMicrosecond(new DateTime('2019-05-06T13:30:54.123456')));
        $this->assertFalse($current->isSameMicrosecond(new DateTime('2018-05-06T13:30:55.123456')));
        $this->assertTrue($current->isSameSecond($current->copy()));
        $this->assertTrue(Carbon::now()->isCurrentMicrosecond());
        $this->assertFalse(Carbon::now()->subMicrosecond()->isCurrentMicrosecond());
        $this->assertFalse(Carbon::now()->isLastMicrosecond());
        $this->assertTrue(Carbon::now()->subMicrosecond()->isLastMicrosecond());
        $this->assertFalse(Carbon::now()->isNextMicrosecond());
        $this->assertTrue(Carbon::now()->addMicrosecond()->isNextMicrosecond());
        $this->assertTrue(Carbon::now()->subMicroseconds(Carbon::MICROSECONDS_PER_SECOND)->isLastSecond());
        $this->assertSame(4.0, Carbon::now()->subMicroseconds(4 * Carbon::MICROSECONDS_PER_SECOND)->diffInSeconds(Carbon::now()));
    }

    public function testIsDayOfWeek()
    {
        // True in the past past
        $this->assertTrue(Carbon::createFromDate(2015, 5, 31)->isDayOfWeek(0));
        $this->assertTrue(Carbon::createFromDate(2015, 6, 21)->isDayOfWeek(0));
        $this->assertTrue(Carbon::now()->subWeek()->previous(Carbon::SUNDAY)->isDayOfWeek(0));
        $this->assertTrue(Carbon::now()->subWeek()->previous(Carbon::SUNDAY)->isDayOfWeek('sunday'));
        $this->assertTrue(Carbon::now()->subWeek()->previous(Carbon::SUNDAY)->isDayOfWeek('SUNDAY'));

        // True in the future
        $this->assertTrue(Carbon::now()->addWeek()->previous(Carbon::SUNDAY)->isDayOfWeek(0));
        $this->assertTrue(Carbon::now()->addMonth()->previous(Carbon::SUNDAY)->isDayOfWeek(0));
        $this->assertTrue(Carbon::now()->addMonth()->previous(Carbon::SUNDAY)->isDayOfWeek('sunday'));
        $this->assertTrue(Carbon::now()->addMonth()->previous(Carbon::SUNDAY)->isDayOfWeek('SUNDAY'));
        $this->assertTrue(Carbon::now()->addMonth()->previous(Carbon::MONDAY)->isDayOfWeek('monday'));
        $this->assertTrue(Carbon::now()->addMonth()->previous(Carbon::MONDAY)->isDayOfWeek('MONDAY'));

        // False in the past
        $this->assertFalse(Carbon::now()->subWeek()->previous(Carbon::MONDAY)->isDayOfWeek(0));
        $this->assertFalse(Carbon::now()->subMonth()->previous(Carbon::MONDAY)->isDayOfWeek(0));
        $this->assertFalse(Carbon::now()->subMonth()->previous(Carbon::MONDAY)->isDayOfWeek('sunday'));
        $this->assertFalse(Carbon::now()->subMonth()->previous(Carbon::MONDAY)->isDayOfWeek('SUNDAY'));
        $this->assertFalse(Carbon::now()->subMonth()->previous(Carbon::SUNDAY)->isDayOfWeek('monday'));
        $this->assertFalse(Carbon::now()->subMonth()->previous(Carbon::SUNDAY)->isDayOfWeek('MONDAY'));

        // False in the future
        $this->assertFalse(Carbon::now()->addWeek()->previous(Carbon::MONDAY)->isDayOfWeek(0));
        $this->assertFalse(Carbon::now()->addMonth()->previous(Carbon::MONDAY)->isDayOfWeek(0));
        $this->assertFalse(Carbon::now()->addMonth()->previous(Carbon::MONDAY)->isDayOfWeek('sunday'));
        $this->assertFalse(Carbon::now()->addMonth()->previous(Carbon::MONDAY)->isDayOfWeek('SUNDAY'));
        $this->assertFalse(Carbon::now()->addMonth()->previous(Carbon::SUNDAY)->isDayOfWeek('monday'));
        $this->assertFalse(Carbon::now()->addMonth()->previous(Carbon::SUNDAY)->isDayOfWeek('MONDAY'));
    }

    public function testIsSameAs()
    {
        $current = Carbon::createFromDate(2012, 1, 2);
        $this->assertTrue($current->isSameAs('c', $current));
    }

    public function testIsSameAsWithInvalidArgument()
    {
        $this->expectException(TypeError::class);

        $current = Carbon::createFromDate(2012, 1, 2);
        $current->isSameAs('Y-m-d', new stdClass());
    }

    public function testIsSunday()
    {
        // True in the past past
        $this->assertTrue(Carbon::createFromDate(2015, 5, 31)->isSunday());
        $this->assertTrue(Carbon::createFromDate(2015, 6, 21)->isSunday());
        $this->assertTrue(Carbon::now()->subWeek()->previous(Carbon::SUNDAY)->isSunday());
        $this->assertTrue(Carbon::now()->subWeek()->previous('Sunday')->isSunday());

        // True in the future
        $this->assertTrue(Carbon::now()->addWeek()->previous(Carbon::SUNDAY)->isSunday());
        $this->assertTrue(Carbon::now()->addMonth()->previous(Carbon::SUNDAY)->isSunday());

        // False in the past
        $this->assertFalse(Carbon::now()->subWeek()->previous(Carbon::MONDAY)->isSunday());
        $this->assertFalse(Carbon::now()->subMonth()->previous(Carbon::MONDAY)->isSunday());

        // False in the future
        $this->assertFalse(Carbon::now()->addWeek()->previous(Carbon::MONDAY)->isSunday());
        $this->assertFalse(Carbon::now()->addMonth()->previous(Carbon::MONDAY)->isSunday());
    }

    public function testIsMonday()
    {
        // True in the past past
        $this->assertTrue(Carbon::createFromDate(2015, 6, 1)->isMonday());
        $this->assertTrue(Carbon::now()->subWeek()->previous(Carbon::MONDAY)->isMonday());

        // True in the future
        $this->assertTrue(Carbon::now()->addWeek()->previous(Carbon::MONDAY)->isMonday());
        $this->assertTrue(Carbon::now()->addMonth()->previous(Carbon::MONDAY)->isMonday());

        // False in the past
        $this->assertFalse(Carbon::now()->subWeek()->previous(Carbon::TUESDAY)->isMonday());
        $this->assertFalse(Carbon::now()->subMonth()->previous(Carbon::TUESDAY)->isMonday());

        // False in the future
        $this->assertFalse(Carbon::now()->addWeek()->previous(Carbon::TUESDAY)->isMonday());
        $this->assertFalse(Carbon::now()->addMonth()->previous(Carbon::TUESDAY)->isMonday());
    }

    public function testIsTuesday()
    {
        // True in the past past
        $this->assertTrue(Carbon::createFromDate(2015, 6, 2)->isTuesday());
        $this->assertTrue(Carbon::now()->subWeek()->previous(Carbon::TUESDAY)->isTuesday());

        // True in the future
        $this->assertTrue(Carbon::now()->addWeek()->previous(Carbon::TUESDAY)->isTuesday());
        $this->assertTrue(Carbon::now()->addMonth()->previous(Carbon::TUESDAY)->isTuesday());

        // False in the past
        $this->assertFalse(Carbon::now()->subWeek()->previous(Carbon::WEDNESDAY)->isTuesday());
        $this->assertFalse(Carbon::now()->subMonth()->previous(Carbon::WEDNESDAY)->isTuesday());

        // False in the future
        $this->assertFalse(Carbon::now()->addWeek()->previous(Carbon::WEDNESDAY)->isTuesday());
        $this->assertFalse(Carbon::now()->addMonth()->previous(Carbon::WEDNESDAY)->isTuesday());
    }

    public function testIsWednesday()
    {
        // True in the past past
        $this->assertTrue(Carbon::createFromDate(2015, 6, 3)->isWednesday());
        $this->assertTrue(Carbon::now()->subWeek()->previous(Carbon::WEDNESDAY)->isWednesday());

        // True in the future
        $this->assertTrue(Carbon::now()->addWeek()->previous(Carbon::WEDNESDAY)->isWednesday());
        $this->assertTrue(Carbon::now()->addMonth()->previous(Carbon::WEDNESDAY)->isWednesday());

        // False in the past
        $this->assertFalse(Carbon::now()->subWeek()->previous(Carbon::THURSDAY)->isWednesday());
        $this->assertFalse(Carbon::now()->subMonth()->previous(Carbon::THURSDAY)->isWednesday());

        // False in the future
        $this->assertFalse(Carbon::now()->addWeek()->previous(Carbon::THURSDAY)->isWednesday());
        $this->assertFalse(Carbon::now()->addMonth()->previous(Carbon::THURSDAY)->isWednesday());
    }

    public function testIsThursday()
    {
        // True in the past past
        $this->assertTrue(Carbon::createFromDate(2015, 6, 4)->isThursday());
        $this->assertTrue(Carbon::now()->subWeek()->previous(Carbon::THURSDAY)->isThursday());

        // True in the future
        $this->assertTrue(Carbon::now()->addWeek()->previous(Carbon::THURSDAY)->isThursday());
        $this->assertTrue(Carbon::now()->addMonth()->previous(Carbon::THURSDAY)->isThursday());

        // False in the past
        $this->assertFalse(Carbon::now()->subWeek()->previous(Carbon::FRIDAY)->isThursday());
        $this->assertFalse(Carbon::now()->subMonth()->previous(Carbon::FRIDAY)->isThursday());

        // False in the future
        $this->assertFalse(Carbon::now()->addWeek()->previous(Carbon::FRIDAY)->isThursday());
        $this->assertFalse(Carbon::now()->addMonth()->previous(Carbon::FRIDAY)->isThursday());
    }

    public function testIsFriday()
    {
        // True in the past past
        $this->assertTrue(Carbon::createFromDate(2015, 6, 5)->isFriday());
        $this->assertTrue(Carbon::now()->subWeek()->previous(Carbon::FRIDAY)->isFriday());

        // True in the future
        $this->assertTrue(Carbon::now()->addWeek()->previous(Carbon::FRIDAY)->isFriday());
        $this->assertTrue(Carbon::now()->addMonth()->previous(Carbon::FRIDAY)->isFriday());

        // False in the past
        $this->assertFalse(Carbon::now()->subWeek()->previous(Carbon::SATURDAY)->isFriday());
        $this->assertFalse(Carbon::now()->subMonth()->previous(Carbon::SATURDAY)->isFriday());

        // False in the future
        $this->assertFalse(Carbon::now()->addWeek()->previous(Carbon::SATURDAY)->isFriday());
        $this->assertFalse(Carbon::now()->addMonth()->previous(Carbon::SATURDAY)->isFriday());
    }

    public function testIsSaturday()
    {
        // True in the past past
        $this->assertTrue(Carbon::createFromDate(2015, 6, 6)->isSaturday());
        $this->assertTrue(Carbon::now()->subWeek()->previous(Carbon::SATURDAY)->isSaturday());

        // True in the future
        $this->assertTrue(Carbon::now()->addWeek()->previous(Carbon::SATURDAY)->isSaturday());
        $this->assertTrue(Carbon::now()->addMonth()->previous(Carbon::SATURDAY)->isSaturday());

        // False in the past
        $this->assertFalse(Carbon::now()->subWeek()->previous(Carbon::SUNDAY)->isSaturday());
        $this->assertFalse(Carbon::now()->subMonth()->previous(Carbon::SUNDAY)->isSaturday());

        // False in the future
        $this->assertFalse(Carbon::now()->addWeek()->previous(Carbon::SUNDAY)->isSaturday());
        $this->assertFalse(Carbon::now()->addMonth()->previous(Carbon::SUNDAY)->isSaturday());
    }

    public function testIsStartOfMillisecond()
    {
        $this->assertFalse(Carbon::parse('2025-01-30 21:33:45.999999')->isStartOfMillisecond());
        $this->assertTrue(Carbon::parse('2025-01-30 21:33:45')->isStartOfMillisecond());
        $this->assertTrue(Carbon::parse('2025-01-30 21:33:45.123')->isStartOfMillisecond());
        $this->assertFalse(Carbon::parse('2025-01-30 21:33:45.000001')->isStartOfMillisecond());
        $this->assertFalse(Carbon::parse('2025-01-30 21:33:45.999999')->isStartOfMillisecond());
    }

    public function testIsEndOfMillisecond()
    {
        $this->assertTrue(Carbon::parse('2025-01-30 21:33:45.999999')->isEndOfMillisecond());
        $this->assertFalse(Carbon::parse('2025-01-30 21:33:45')->isEndOfMillisecond());
        $this->assertTrue(Carbon::parse('2025-01-30 21:33:45.999999')->isEndOfMillisecond());
        $this->assertFalse(Carbon::parse('2025-01-30 21:33:45.999998')->isEndOfMillisecond());
    }

    public function testIsStartOfSecond()
    {
        $this->assertFalse(Carbon::parse('2025-01-30 21:33:45.999999')->isStartOfSecond());
        $this->assertTrue(Carbon::parse('2025-01-30 21:33:45')->isStartOfSecond());
        $this->assertFalse(Carbon::parse('2025-01-30 21:33:45.000001')->isStartOfSecond());
        $this->assertFalse(Carbon::parse('2025-01-30 21:33:45.999999')->isStartOfSecond());
        $this->assertTrue(Carbon::parse('2025-01-30 21:33:45')->isStartOfSecond(Unit::Millisecond));
        $this->assertTrue(Carbon::parse('2025-01-30 21:33:45.000999')->isStartOfSecond(Unit::Millisecond));
        $this->assertFalse(Carbon::parse('2025-01-30 21:33:45.001')->isStartOfSecond(Unit::Millisecond));
    }

    public function testIsEndOfSecond()
    {
        $this->assertTrue(Carbon::parse('2025-01-30 21:33:45.999999')->isEndOfSecond());
        $this->assertFalse(Carbon::parse('2025-01-30 21:33:45')->isEndOfSecond());
        $this->assertTrue(Carbon::parse('2025-01-30 21:33:45.999999')->isEndOfSecond());
        $this->assertFalse(Carbon::parse('2025-01-30 21:33:45.999998')->isEndOfSecond());
        $this->assertTrue(Carbon::parse('2025-01-30 21:33:45.999998')->isEndOfSecond(Unit::Second));
        $this->assertTrue(Carbon::parse('2025-01-30 21:33:45.123456')->isEndOfSecond(Unit::Second));
    }

    public function testIsStartOfMinute()
    {
        $this->assertFalse(Carbon::parse('2025-01-30 21:33:59.999999')->isStartOfMinute());
        $this->assertTrue(Carbon::parse('2025-01-01 22:34:00')->isStartOfMinute());
        $this->assertFalse(Carbon::parse('2025-01-01 22:34:00.000001')->isStartOfMinute());
        $this->assertFalse(Carbon::parse('2025-01-01 21:33:59.999999')->isStartOfMinute());
        $this->assertTrue(Carbon::parse('2025-01-31 22:34:00')->isStartOfMinute(Unit::Second));
        $this->assertTrue(Carbon::parse('2025-01-31 22:34:00.999999')->isStartOfMinute(Unit::Second));
        $this->assertFalse(Carbon::parse('2025-02-01 22:34:01')->isStartOfMinute(Unit::Second));
        $this->assertFalse(Carbon::parse('2025-01-02 21:33:59.999999')->isStartOfMinute());
        $this->assertFalse(Carbon::parse('2025-12-31 21:33:59.999999')->isStartOfMinute());
    }

    public function testIsEndOfMinute()
    {
        $this->assertTrue(Carbon::parse('2024-05-16 12:34:59.999999')->isEndOfMinute());
        $this->assertFalse(Carbon::parse('2024-05-16 12:35:00')->isEndOfMinute());
        $this->assertTrue(Carbon::parse('2024-05-16 12:34:59.999999')->isEndOfMinute());
        $this->assertFalse(Carbon::parse('2024-05-16 12:34:59.999998')->isEndOfMinute());
        $this->assertTrue(Carbon::parse('2024-05-16 12:34:59.999998')->isEndOfMinute(Unit::Second));
        $this->assertTrue(Carbon::parse('2024-05-16 12:34:59.123456')->isEndOfMinute(Unit::Second));
    }

    public function testIsStartOfHour()
    {
        $this->assertFalse(Carbon::parse('2025-01-30 21:59:59.999999')->isStartOfHour());
        $this->assertTrue(Carbon::parse('2025-01-01 22:00:00')->isStartOfHour());
        $this->assertFalse(Carbon::parse('2025-01-01 22:00:00.000001')->isStartOfHour());
        $this->assertFalse(Carbon::parse('2025-01-01 21:59:59.999999')->isStartOfHour());
        $this->assertTrue(Carbon::parse('2025-01-31 22:00:00')->isStartOfHour(Unit::Second));
        $this->assertTrue(Carbon::parse('2025-01-31 22:00:00.999999')->isStartOfHour(Unit::Second));
        $this->assertFalse(Carbon::parse('2025-02-01 22:00:01')->isStartOfHour(Unit::Second));
        $this->assertFalse(Carbon::parse('2025-01-02 21:59:59.999999')->isStartOfHour());
        $this->assertFalse(Carbon::parse('2025-12-31 21:59:59.999999')->isStartOfHour());
    }

    public function testIsEndOfHour()
    {
        $this->assertTrue(Carbon::parse('2024-05-16 23:59:59.999999')->isEndOfHour());
        $this->assertFalse(Carbon::parse('2024-05-16 00:00:00')->isEndOfHour());
        $this->assertTrue(Carbon::parse('2024-05-16 23:59:59.999999')->isEndOfHour());
        $this->assertFalse(Carbon::parse('2024-05-16 23:59:59.999998')->isEndOfHour());
        $this->assertTrue(Carbon::parse('2024-05-16 23:59:59.999998')->isEndOfHour(Unit::Second));
        $this->assertTrue(Carbon::parse('2024-05-16 23:59:59.123456')->isEndOfHour(Unit::Second));
    }

    public function testIsStartOfDay()
    {
        $this->assertTrue(Carbon::parse('00:00:00')->isStartOfDay(false));
        $this->assertTrue(Carbon::parse('00:00:00.999999')->isStartOfDay(false));
        $this->assertTrue(Carbon::now()->startOfDay()->isStartOfDay(false));

        $this->assertFalse(Carbon::parse('15:30:45')->isStartOfDay(false));
        $this->assertFalse(Carbon::now()->endOfDay()->isStartOfDay(false));

        $this->assertTrue(Carbon::parse('00:00:00')->isStartOfDay());
        $this->assertTrue(Carbon::parse('00:00:00.999999')->isStartOfDay());
        $this->assertTrue(Carbon::now()->startOfDay()->isStartOfDay());

        $this->assertFalse(Carbon::parse('15:30:45')->isStartOfDay());
        $this->assertFalse(Carbon::now()->endOfDay()->isStartOfDay());
    }

    public function testIsStartOfDayWithMicroseconds()
    {
        $this->assertTrue(Carbon::parse('00:00:00')->isStartOfDay(true));
        $this->assertTrue(Carbon::now()->startOfDay()->isStartOfDay(true));

        $this->assertFalse(Carbon::parse('00:00:00.000001')->isStartOfDay(true));
    }

    public function testIsStartOfDayInterval()
    {
        $this->assertTrue(Carbon::parse('00:00:00')->isStartOfDay('15 minutes'));
        $this->assertTrue(Carbon::parse('00:14:59.999999')->isStartOfDay('15 minutes'));
        $this->assertFalse(Carbon::parse('00:15:00')->isStartOfDay('15 minutes'));
        $this->assertTrue(Carbon::parse('00:59:59.999999')->isStartOfDay(Unit::Hour));
        $this->assertFalse(Carbon::parse('01:00:00')->isStartOfDay(Unit::Hour));
        $this->assertTrue(Carbon::parse('00:00:59.999999')->isStartOfDay(new DateInterval('PT1M')));
        $this->assertFalse(Carbon::parse('00:01:00')->isStartOfDay(new DateInterval('PT1M')));

        $this->assertTrue(Carbon::parse('00:00:00')->isStartOfDay(interval: '15 minutes'));
        $this->assertTrue(Carbon::parse('00:14:59.999999')->isStartOfDay(interval: '15 minutes'));
        $this->assertFalse(Carbon::parse('00:15:00')->isStartOfDay(interval: '15 minutes'));
        $this->assertTrue(Carbon::parse('00:59:59.999999')->isStartOfDay(interval: Unit::Hour));
        $this->assertFalse(Carbon::parse('01:00:00')->isStartOfDay(interval: Unit::Hour));
        $this->assertTrue(Carbon::parse('00:00:59.999999')->isStartOfDay(interval: new DateInterval('PT1M')));
        $this->assertFalse(Carbon::parse('00:01:00')->isStartOfDay(interval: new DateInterval('PT1M')));

        $this->assertTrue(Carbon::parse('00:01:59.999999')->isStartOfDay(interval: CarbonInterval::minutes(2)));
        $this->assertFalse(Carbon::parse('00:02:00')->isStartOfDay(interval: CarbonInterval::minutes(2)));

        // Always false with negative interval
        $this->assertFalse(Carbon::parse('00:00:00')->isStartOfDay(interval: CarbonInterval::minutes(-2)));

        // Always true with  interval bigger than 1 day
        $this->assertTrue(Carbon::parse('23:59:59.999999')->isStartOfDay(interval: CarbonInterval::hours(36)));
    }

    public function testIsStartOfUnit()
    {
        $this->assertTrue(Carbon::parse('00:00:00')->isStartOfUnit(Unit::Hour));

        $this->assertFalse(Carbon::parse('00:00:00.000001')->isStartOfUnit(Unit::Hour));
        $this->assertFalse(Carbon::parse('00:00:01')->isStartOfUnit(Unit::Hour));

        $this->assertTrue(Carbon::parse('00:00:00')->isStartOfUnit(Unit::Hour, '5 minutes'));
        $this->assertTrue(Carbon::parse('00:04:59.999999')->isStartOfUnit(Unit::Hour, '5 minutes'));

        $this->assertFalse(Carbon::parse('00:05:00')->isStartOfUnit(Unit::Hour, '5 minutes'));

        $this->assertTrue(Carbon::parse('Monday')->isStartOfUnit(Unit::Week));
        $this->assertTrue(Carbon::parse('Monday 23:59:59.999999')->isStartOfUnit(Unit::Week));

        $this->assertFalse(Carbon::parse('Tuesday')->isStartOfUnit(Unit::Week));
        $this->assertFalse(Carbon::parse('Monday')->isStartOfUnit(Unit::Week, CarbonInterval::day(-1)));
    }

    public function testIsEndOfDay()
    {
        $this->assertTrue(Carbon::parse('23:59:59')->isEndOfDay(false));
        $this->assertTrue(Carbon::parse('23:59:59.000000')->isEndOfDay(false));
        $this->assertTrue(Carbon::now()->endOfDay()->isEndOfDay(false));

        $this->assertFalse(Carbon::parse('15:30:45')->isEndOfDay(false));
        $this->assertFalse(Carbon::now()->startOfDay()->isEndOfDay(false));

        $this->assertTrue(Carbon::parse('23:59:59')->isEndOfDay());
        $this->assertTrue(Carbon::parse('23:59:59.000000')->isEndOfDay());
        $this->assertTrue(Carbon::now()->endOfDay()->isEndOfDay());

        $this->assertFalse(Carbon::parse('15:30:45')->isEndOfDay());
        $this->assertFalse(Carbon::now()->startOfDay()->isEndOfDay());
    }

    public function testIsEndOfDayWithMicroseconds()
    {
        $this->assertTrue(Carbon::parse('23:59:59.999999')->isEndOfDay(true));
        $this->assertTrue(Carbon::now()->endOfDay()->isEndOfDay(true));

        $this->assertFalse(Carbon::parse('23:59:59')->isEndOfDay(true));
        $this->assertFalse(Carbon::parse('23:59:59.999998')->isEndOfDay(true));
    }

    public function testIsEndOfDayInterval()
    {
        $this->assertTrue(Carbon::parse('23:59:59.999999')->isEndOfDay('15 minutes'));
        $this->assertTrue(Carbon::parse('23:45:00')->isEndOfDay('15 minutes'));
        $this->assertFalse(Carbon::parse('23:44:59.999999')->isEndOfDay('15 minutes'));
        $this->assertTrue(Carbon::parse('23:00:00')->isEndOfDay(Unit::Hour));
        $this->assertFalse(Carbon::parse('22:59:59.999999')->isEndOfDay(Unit::Hour));
        $this->assertTrue(Carbon::parse('23:59:00')->isEndOfDay(new DateInterval('PT1M')));
        $this->assertFalse(Carbon::parse('23:58:59.999999')->isEndOfDay(new DateInterval('PT1M')));

        $this->assertTrue(Carbon::parse('23:59:59.999999')->isEndOfDay(interval: '15 minutes'));
        $this->assertTrue(Carbon::parse('23:45:00')->isEndOfDay(interval: '15 minutes'));
        $this->assertFalse(Carbon::parse('23:44:59.999999')->isEndOfDay(interval: '15 minutes'));
        $this->assertTrue(Carbon::parse('23:00:00')->isEndOfDay(interval: Unit::Hour));
        $this->assertFalse(Carbon::parse('22:59:59.999999')->isEndOfDay(interval: Unit::Hour));
        $this->assertTrue(Carbon::parse('23:59:00')->isEndOfDay(interval: new DateInterval('PT1M')));
        $this->assertFalse(Carbon::parse('23:58:59.999999')->isEndOfDay(interval: new DateInterval('PT1M')));

        // Always false with negative interval
        $this->assertFalse(Carbon::parse('00:00:00')->isEndOfDay(interval: CarbonInterval::minutes(-2)));

        // Always true with  interval bigger than 1 day
        $this->assertTrue(Carbon::parse('23:59:59.999999')->isEndOfDay(interval: CarbonInterval::hours(36)));
    }

    public function testIsEndOfUnit()
    {
        $this->assertTrue(Carbon::parse('23:59:59.999999')->isEndOfUnit(Unit::Hour));

        $this->assertFalse(Carbon::parse('23:59:59.999998')->isEndOfUnit(Unit::Hour));
        $this->assertFalse(Carbon::parse('23:59:59')->isEndOfUnit(Unit::Hour));

        $this->assertTrue(Carbon::parse('23:55:00.000001')->isEndOfUnit(Unit::Hour, '5 minutes'));
        $this->assertTrue(Carbon::parse('23:55:00')->isEndOfUnit(Unit::Hour, '5 minutes'));

        $this->assertFalse(Carbon::parse('23:54:59.999999')->isEndOfUnit(Unit::Hour, '5 minutes'));

        $this->assertTrue(Carbon::parse('Sunday 23:59:59')->isEndOfUnit(Unit::Week, '2 days'));
        $this->assertTrue(Carbon::parse('Saturday 00:00')->isEndOfUnit(Unit::Week, '2 days'));

        $this->assertFalse(Carbon::parse('Saturday 00:00')->isEndOfUnit(Unit::Week));
        $this->assertFalse(Carbon::parse('Friday 23:59:59.999999')->isEndOfUnit(Unit::Week, '2 days'));
        $this->assertFalse(Carbon::parse('Sunday 23:59:59.999999')->isEndOfUnit(Unit::Week, CarbonInterval::day(-1)));
    }

    public function testIsStartOfWeek()
    {
        $this->assertTrue(Carbon::parse('Monday 01:06:12')->isStartOfWeek());
        $this->assertFalse(Carbon::parse('Saturday 01:06:12')->isStartOfWeek());

        Carbon::setLocale('ar');

        $this->assertTrue(Carbon::parse('Saturday 01:06:12')->isStartOfWeek());
        $this->assertFalse(Carbon::parse('Monday 01:06:12')->isStartOfWeek());

        $this->assertTrue(Carbon::parse('Sunday 01:06:12')->isStartOfWeek(weekStartsAt: WeekDay::Sunday));
        $this->assertFalse(Carbon::parse('Saturday 01:06:12')->isStartOfWeek(weekStartsAt: WeekDay::Sunday));

        $this->assertTrue(Carbon::parse('Saturday 01:06:12')->isStartOfWeek('2 hours'));
        $this->assertFalse(Carbon::parse('Saturday 01:06:12')->isStartOfWeek('1 hour'));
    }

    public function testIsEndOfWeek()
    {
        $this->assertTrue(Carbon::parse('Sunday 01:06:12')->isEndOfWeek());
        $this->assertFalse(Carbon::parse('Friday 01:06:12')->isEndOfWeek());

        Carbon::setLocale('ar');

        $this->assertTrue(Carbon::parse('Friday 01:06:12')->isEndOfWeek());
        $this->assertFalse(Carbon::parse('Sunday 01:06:12')->isEndOfWeek());

        $this->assertTrue(Carbon::parse('Saturday 01:06:12')->isEndOfWeek(weekEndsAt: WeekDay::Saturday));
        $this->assertFalse(Carbon::parse('Friday 01:06:12')->isEndOfWeek(weekEndsAt: WeekDay::Saturday));

        $this->assertTrue(Carbon::parse('Friday 22:06:12')->isEndOfWeek('2 hours'));
        $this->assertFalse(Carbon::parse('Saturday 22:06:12')->isEndOfWeek('1 hour'));
    }

    public function testIsStartOfMonth()
    {
        $this->assertFalse(Carbon::parse('2024-01-31 23:59:59.999999')->isStartOfMonth());
        $this->assertTrue(Carbon::parse('2024-02-01 00:00:00')->isStartOfMonth());
        $this->assertTrue(Carbon::parse('2024-02-01 23:59:59.999999')->isStartOfMonth());
        $this->assertTrue(Carbon::parse('2024-02-01 00:00:00')->isStartOfMonth(Unit::Microsecond));
        $this->assertFalse(Carbon::parse('2024-02-01 00:00:00.000001')->isStartOfMonth(Unit::Microsecond));
        $this->assertTrue(Carbon::parse('2024-02-01 00:00:59')->isStartOfMonth(Unit::Minute));
        $this->assertFalse(Carbon::parse('2024-02-01 00:01:00')->isStartOfMonth(Unit::Minute));
        $this->assertFalse(Carbon::parse('2024-02-02 23:59:59.999999')->isStartOfMonth());
        $this->assertFalse(Carbon::parse('2024-02-29 23:59:59.999999')->isStartOfMonth());
    }

    public function testIsEndOfMonth()
    {
        $this->assertTrue(Carbon::parse('2024-01-31 23:59:59.999999')->isEndOfMonth());
        $this->assertFalse(Carbon::parse('2024-02-01 00:00:00')->isEndOfMonth());
        $this->assertFalse(Carbon::parse('2024-02-28 23:59:59.999999')->isEndOfMonth());
        $this->assertTrue(Carbon::parse('2024-02-29 00:00:00')->isEndOfMonth());
        $this->assertTrue(Carbon::parse('2024-02-29 23:59:59.999999')->isEndOfMonth());
        $this->assertTrue(Carbon::parse('2024-02-29 23:59:59.999999')->isEndOfMonth(Unit::Microsecond));
        $this->assertFalse(Carbon::parse('2024-02-29 23:59:59.999998')->isEndOfMonth(Unit::Microsecond));
    }

    public function testIsStartOfQuarter()
    {
        $this->assertFalse(Carbon::parse('2024-01-31 23:59:59.999999')->isStartOfQuarter());
        $this->assertTrue(Carbon::parse('2024-01-01 00:00:00')->isStartOfQuarter());
        $this->assertTrue(Carbon::parse('2024-01-01 23:59:59.999999')->isStartOfQuarter());
        $this->assertTrue(Carbon::parse('2024-01-01 00:00:00')->isStartOfQuarter(Unit::Microsecond));
        $this->assertFalse(Carbon::parse('2024-01-01 00:00:00.000001')->isStartOfQuarter(Unit::Microsecond));
        $this->assertTrue(Carbon::parse('2024-01-01 00:00:59')->isStartOfQuarter(Unit::Minute));
        $this->assertFalse(Carbon::parse('2024-01-01 00:01:00')->isStartOfQuarter(Unit::Minute));
        $this->assertFalse(Carbon::parse('2024-01-02 23:59:59.999999')->isStartOfQuarter());
        $this->assertFalse(Carbon::parse('2024-03-31 23:59:59.999999')->isStartOfQuarter());
    }

    public function testIsEndOfQuarter()
    {
        $this->assertTrue(Carbon::parse('2024-12-31 23:59:59.999999')->isEndOfQuarter());
        $this->assertFalse(Carbon::parse('2024-03-01 00:00:00')->isEndOfQuarter());
        $this->assertFalse(Carbon::parse('2024-03-30 23:59:59.999999')->isEndOfQuarter());
        $this->assertTrue(Carbon::parse('2024-03-31 00:00:00')->isEndOfQuarter());
        $this->assertTrue(Carbon::parse('2024-03-31 23:59:59.999999')->isEndOfQuarter());
        $this->assertTrue(Carbon::parse('2024-03-31 23:59:59.999999')->isEndOfQuarter(Unit::Microsecond));
        $this->assertFalse(Carbon::parse('2024-03-31 23:59:59.999998')->isEndOfQuarter(Unit::Microsecond));
    }

    public function testIsStartOfYear()
    {
        $this->assertFalse(Carbon::parse('2024-01-31 23:59:59.999999')->isStartOfYear());
        $this->assertTrue(Carbon::parse('2024-01-01 00:00:00')->isStartOfYear());
        $this->assertTrue(Carbon::parse('2024-01-01 23:59:59.999999')->isStartOfYear());
        $this->assertTrue(Carbon::parse('2024-01-31 00:00:00')->isStartOfYear(Unit::Month));
        $this->assertFalse(Carbon::parse('2024-02-01 00:00:00')->isStartOfYear(Unit::Month));
        $this->assertFalse(Carbon::parse('2024-01-02 23:59:59.999999')->isStartOfYear());
        $this->assertFalse(Carbon::parse('2024-12-31 23:59:59.999999')->isStartOfYear());
    }

    public function testIsEndOfYear()
    {
        $this->assertTrue(Carbon::parse('2024-12-31 23:59:59.999999')->isEndOfYear());
        $this->assertFalse(Carbon::parse('2024-03-01 00:00:00')->isEndOfYear());
        $this->assertFalse(Carbon::parse('2024-03-30 23:59:59.999999')->isEndOfYear());
        $this->assertTrue(Carbon::parse('2024-12-31 00:00:00')->isEndOfYear());
        $this->assertTrue(Carbon::parse('2024-12-31 23:59:59.999999')->isEndOfYear());
        $this->assertTrue(Carbon::parse('2024-12-31 23:59:59.999999')->isEndOfYear(Unit::Microsecond));
        $this->assertFalse(Carbon::parse('2024-12-31 23:59:59.999998')->isEndOfYear(Unit::Microsecond));
    }

    public function testIsStartOfDecade()
    {
        $this->assertFalse(Carbon::parse('2019-01-31 23:59:59.999999')->isStartOfDecade());
        $this->assertTrue(Carbon::parse('2020-01-01 00:00:00')->isStartOfDecade());
        $this->assertTrue(Carbon::parse('2020-01-01 23:59:59.999999')->isStartOfDecade());
        $this->assertTrue(Carbon::parse('2020-01-31 00:00:00')->isStartOfDecade(Unit::Month));
        $this->assertFalse(Carbon::parse('2020-02-01 00:00:00')->isStartOfDecade(Unit::Month));
        $this->assertFalse(Carbon::parse('2020-01-02 23:59:59.999999')->isStartOfDecade());
        $this->assertFalse(Carbon::parse('2029-12-31 23:59:59.999999')->isStartOfDecade());
    }

    public function testIsEndOfDecade()
    {
        $this->assertTrue(Carbon::parse('2019-12-31 23:59:59.999999')->isEndOfDecade());
        $this->assertFalse(Carbon::parse('2020-01-01 00:00:00')->isEndOfDecade());
        $this->assertFalse(Carbon::parse('2020-01-30 23:59:59.999999')->isEndOfDecade());
        $this->assertTrue(Carbon::parse('2029-12-31 00:00:00')->isEndOfDecade());
        $this->assertTrue(Carbon::parse('2029-12-31 23:59:59.999999')->isEndOfDecade());
        $this->assertTrue(Carbon::parse('2029-12-31 23:59:59.999999')->isEndOfDecade(Unit::Microsecond));
        $this->assertFalse(Carbon::parse('2029-12-31 23:59:59.999998')->isEndOfDecade(Unit::Microsecond));
    }

    public function testIsStartOfCentury()
    {
        $this->assertFalse(Carbon::parse('2000-01-31 23:59:59.999999')->isStartOfCentury());
        $this->assertTrue(Carbon::parse('2001-01-01 00:00:00')->isStartOfCentury());
        $this->assertTrue(Carbon::parse('2001-01-01 23:59:59.999999')->isStartOfCentury());
        $this->assertTrue(Carbon::parse('2001-01-31 00:00:00')->isStartOfCentury(Unit::Month));
        $this->assertFalse(Carbon::parse('2001-02-01 00:00:00')->isStartOfCentury(Unit::Month));
        $this->assertFalse(Carbon::parse('2001-01-02 23:59:59.999999')->isStartOfCentury());
        $this->assertFalse(Carbon::parse('2100-12-31 23:59:59.999999')->isStartOfCentury());
    }

    public function testIsEndOfCentury()
    {
        $this->assertTrue(Carbon::parse('2000-12-31 23:59:59.999999')->isEndOfCentury());
        $this->assertFalse(Carbon::parse('2001-01-01 00:00:00')->isEndOfCentury());
        $this->assertFalse(Carbon::parse('2001-01-30 23:59:59.999999')->isEndOfCentury());
        $this->assertTrue(Carbon::parse('2100-12-31 00:00:00')->isEndOfCentury());
        $this->assertTrue(Carbon::parse('2100-12-31 23:59:59.999999')->isEndOfCentury());
        $this->assertTrue(Carbon::parse('2100-12-31 23:59:59.999999')->isEndOfCentury(Unit::Microsecond));
        $this->assertFalse(Carbon::parse('2100-12-31 23:59:59.999998')->isEndOfCentury(Unit::Microsecond));
    }

    public function testIsStartOfMillennium()
    {
        $this->assertFalse(Carbon::parse('2000-01-31 23:59:59.999999')->isStartOfMillennium());
        $this->assertTrue(Carbon::parse('2001-01-01 00:00:00')->isStartOfMillennium());
        $this->assertTrue(Carbon::parse('2001-01-01 23:59:59.999999')->isStartOfMillennium());
        $this->assertTrue(Carbon::parse('2001-01-31 00:00:00')->isStartOfMillennium(Unit::Month));
        $this->assertFalse(Carbon::parse('2001-02-01 00:00:00')->isStartOfMillennium(Unit::Month));
        $this->assertFalse(Carbon::parse('2001-01-02 23:59:59.999999')->isStartOfMillennium());
        $this->assertFalse(Carbon::parse('3000-12-31 23:59:59.999999')->isStartOfMillennium());
    }

    public function testIsEndOfMillennium()
    {
        $this->assertTrue(Carbon::parse('2000-12-31 23:59:59.999999')->isEndOfMillennium());
        $this->assertFalse(Carbon::parse('2001-01-01 00:00:00')->isEndOfMillennium());
        $this->assertFalse(Carbon::parse('2001-01-30 23:59:59.999999')->isEndOfMillennium());
        $this->assertTrue(Carbon::parse('3000-12-31 00:00:00')->isEndOfMillennium());
        $this->assertTrue(Carbon::parse('3000-12-31 23:59:59.999999')->isEndOfMillennium());
        $this->assertTrue(Carbon::parse('3000-12-31 23:59:59.999999')->isEndOfMillennium(Unit::Microsecond));
        $this->assertFalse(Carbon::parse('3000-12-31 23:59:59.999998')->isEndOfMillennium(Unit::Microsecond));
    }

    public function testIsMidnight()
    {
        $this->assertTrue(Carbon::parse('00:00:00')->isMidnight());

        $this->assertFalse(Carbon::parse('15:30:45')->isMidnight());
    }

    public function testIsMidday()
    {
        $this->assertTrue(Carbon::parse('12:00:00')->isMidday());

        $this->assertFalse(Carbon::parse('15:30:45')->isMidday());
    }

    public function testHasFormat()
    {
        $this->assertTrue(Carbon::hasFormat('1975-05-01', 'Y-m-d'));
        $this->assertTrue(Carbon::hasFormat('12/30/2019', 'm/d/Y'));
        $this->assertTrue(Carbon::hasFormat('30/12/2019', 'd/m/Y'));
        $this->assertTrue(Carbon::hasFormat('Sun 21st', 'D jS'));

        $this->assertTrue(Carbon::hasFormat('2000-07-01T00:00:00+00:00', Carbon::ATOM));
        $this->assertTrue(Carbon::hasFormat('Y-01-30\\', '\\Y-m-d\\\\'));

        // @see https://github.com/briannesbitt/Carbon/issues/2180
        $this->assertTrue(Carbon::hasFormat('2020-09-01 12:00:00Europe/Moscow', 'Y-m-d H:i:se'));

        $this->assertTrue(Carbon::hasFormat('2012-12-04 22:59.32130', 'Y-m-d H:s.vi'));

        // Format failure
        $this->assertFalse(Carbon::hasFormat('', 'd m Y'));
        $this->assertFalse(Carbon::hasFormat('1975-05-01', 'd m Y'));
        $this->assertFalse(Carbon::hasFormat('1975-01-30\\', '\\Y-m-d\\\\'));
        $this->assertFalse(Carbon::hasFormat('Foo 21st', 'D jS'));
        $this->assertFalse(Carbon::hasFormat('Sun 51st', 'D jS'));
        $this->assertFalse(Carbon::hasFormat('Sun 21xx', 'D jS'));

        // Regex failure
        $this->assertFalse(Carbon::hasFormat('1975-5-1', 'Y-m-d'));
        $this->assertFalse(Carbon::hasFormat('19-05-01', 'Y-m-d'));
        $this->assertFalse(Carbon::hasFormat('30/12/2019', 'm/d/Y'));
        $this->assertFalse(Carbon::hasFormat('12/30/2019', 'd/m/Y'));
        $this->assertFalse(Carbon::hasFormat('1975-05-01', 'Y-m-d!'));
        $this->assertFalse(Carbon::hasFormat('1975-05-01', 'Y-m-d|'));
        $this->assertFalse(Carbon::hasFormat('1975-05-01', 'Y-*-d'));

        $this->assertTrue(Carbon::hasFormat('2012-12-04 22:59.32130', 'Y-m-d H:s.vi'));

        // New Zealand Daylight time
        $this->assertTrue(Carbon::hasFormat('2024-03-02T00:00:00+13:00', 'Y-m-d\TH:i:sP'));
    }

    public function testHasFormatWithModifiers()
    {
        $this->assertTrue(Carbon::hasFormatWithModifiers('2021-05-03T00:00:00+02:00', 'Y-m-d\TH:i:sp'));
        $this->assertTrue(Carbon::hasFormatWithModifiers('2021-05-03T00:00:00+02:00', 'Y-m-d\TH:i:sP'));
        $this->assertTrue(Carbon::hasFormatWithModifiers('2021-05-03T00:00:00Z', 'Y-m-d\TH:i:sp'));
        $this->assertTrue(Carbon::hasFormatWithModifiers('1975-05-01', 'Y-m-d!'));
        $this->assertTrue(Carbon::hasFormatWithModifiers('1975-05-01', 'Y-m-d|'));
        $this->assertTrue(Carbon::hasFormatWithModifiers('1975-05-01', 'Y-*-d'));
        $this->assertTrue(Carbon::hasFormatWithModifiers('1975-05-01', 'Y-??-d!'));
        $this->assertTrue(Carbon::hasFormatWithModifiers('1975-05-01', 'Y#m#d'));
        $this->assertTrue(Carbon::hasFormatWithModifiers('1975/05/31', 'Y#m#d'));

        $this->assertFalse(Carbon::hasFormatWithModifiers('2021-05-03T00:00:00Z', 'Y-m-d\TH:i:sP'));
        $this->assertFalse(Carbon::hasFormatWithModifiers('1975/31/05', 'Y#m#d'));
        $this->assertFalse(Carbon::hasFormatWithModifiers('1975-05-01', 'Y-?-d|'));
        $this->assertFalse(Carbon::hasFormatWithModifiers('1975--01', 'Y-*-d'));
        $this->assertFalse(Carbon::hasFormatWithModifiers('1975705-01', 'Y#m#d'));
    }

    public static function dataForFormatLetters(): array
    {
        return [
            'd' => ['d'],
            'D' => ['D'],
            'j' => ['j'],
            'l' => ['l'],
            'N' => ['N'],
            'S' => ['S'],
            'w' => ['w'],
            'z' => ['z'],
            'W' => ['W'],
            'F' => ['F'],
            'm' => ['m'],
            'M' => ['M'],
            'n' => ['n'],
            't' => ['t'],
            'L' => ['L'],
            'o' => ['o'],
            'Y' => ['Y'],
            'y' => ['y'],
            'a' => ['a'],
            'A' => ['A'],
            'B' => ['B'],
            'g' => ['g'],
            'G' => ['G'],
            'h' => ['h'],
            'H' => ['H'],
            'i' => ['i'],
            's' => ['s'],
            'u' => ['u'],
            'v' => ['v'],
            'e' => ['e'],
            'I' => ['I'],
            'O' => ['O'],
            'P' => ['P'],
            'T' => ['T'],
            'Z' => ['Z'],
            'U' => ['U'],
            'c' => ['c'],
            'r' => ['r'],
        ];
    }

    #[DataProvider('dataForFormatLetters')]
    public function testHasFormatWithSingleLetter($letter)
    {
        $output = Carbon::now()->format($letter);
        $this->assertTrue(Carbon::hasFormat($output, $letter), "'$letter' format should match '$output'");
    }

    public function testCanBeCreatedFromFormat()
    {
        $this->assertTrue(Carbon::canBeCreatedFromFormat('1975-05-01', 'Y-m-d'));
        $this->assertTrue(Carbon::canBeCreatedFromFormat('12/30/2019', 'm/d/Y'));
        $this->assertFalse(Carbon::canBeCreatedFromFormat(null, 'Y-m-d'));
        $this->assertFalse(Carbon::canBeCreatedFromFormat('1975-05-01', 'd m Y'));
        $this->assertFalse(Carbon::canBeCreatedFromFormat('1975-5-1', 'Y-m-d'));
        $this->assertFalse(Carbon::canBeCreatedFromFormat('19-05-01', 'Y-m-d'));
        $this->assertFalse(Carbon::canBeCreatedFromFormat('30/12/2019', 'm/d/Y'));
        $this->assertFalse(Carbon::canBeCreatedFromFormat('12/30/2019', 'd/m/Y'));
        $this->assertFalse(Carbon::canBeCreatedFromFormat('5', 'N'));
    }

    public function testIsSameFoobar()
    {
        $this->expectExceptionObject(new BadMethodCallException(
            'Method isSameFoobar does not exist.',
        ));

        /** @var mixed $date */
        $date = Carbon::parse('12:00:00');
        $date->isSameFoobar(Carbon::parse('15:30:45'));
    }

    public function testIsCurrentFoobar()
    {
        $this->expectExceptionObject(new BadMethodCallException(
            'Method isCurrentFoobar does not exist.',
        ));

        /** @var mixed $date */
        $date = Carbon::parse('12:00:00');
        $date->isCurrentFoobar();
    }

    public function testIs()
    {
        $this->assertTrue(Carbon::parse('2019-06-02 12:23:45')->is('2019'));
        $this->assertFalse(Carbon::parse('2019-06-02 12:23:45')->is('2018'));
        $this->assertTrue(Carbon::parse('2019-06-02 12:23:45')->is('2019-06'));
        $this->assertFalse(Carbon::parse('2019-06-02 12:23:45')->is('2018-06'));
        $this->assertFalse(Carbon::parse('2019-06-02 12:23:45')->is('2019-07'));
        $this->assertTrue(Carbon::parse('2019-06-02 12:23:45')->is('06-02'));
        $this->assertFalse(Carbon::parse('2019-06-02 12:23:45')->is('06-03'));
        $this->assertFalse(Carbon::parse('2019-06-02 12:23:45')->is('05-02'));
        $this->assertTrue(Carbon::parse('2019-06-02 12:23:45')->is('2019-06-02'));
        $this->assertFalse(Carbon::parse('2019-06-02 12:23:45')->is('2019-06-03'));
        $this->assertFalse(Carbon::parse('2019-06-02 12:23:45')->is('2019-05-02'));
        $this->assertFalse(Carbon::parse('2019-06-02 12:23:45')->is('2020-06-02'));
        $this->assertTrue(Carbon::parse('2019-06-02 12:23:45')->is('Sunday'));
        $this->assertFalse(Carbon::parse('2019-06-02 12:23:45')->is('Monday'));
        $this->assertTrue(Carbon::parse('2019-06-02 12:23:45')->is(WeekDay::Sunday));
        $this->assertFalse(Carbon::parse('2019-06-02 12:23:45')->is(WeekDay::Monday));
        $this->assertTrue(Carbon::parse('2019-06-02 12:23:45')->is('June'));
        $this->assertTrue(Carbon::parse('2019-05-31 12:23:45')->is('May'));
        $this->assertTrue(Carbon::parse('2019-05-31 12:23:45')->is('mAy'));
        $this->assertFalse(Carbon::parse('2019-05-31 12:23:45')->is('April'));
        $this->assertFalse(Carbon::parse('2019-06-02 12:23:45')->is('May'));
        $this->assertTrue(Carbon::parse('2019-05-31 12:23:45')->is(Month::May));
        $this->assertFalse(Carbon::parse('2019-05-31 12:23:45')->is(Month::April));
        $this->assertTrue(Carbon::parse('2019-06-02 12:23:45')->is('12:23'));
        $this->assertFalse(Carbon::parse('2019-06-02 12:23:45')->is('12:26'));
        $this->assertFalse(Carbon::parse('2019-06-02 12:23:45')->is('12:23:00'));
        $this->assertTrue(Carbon::parse('2019-06-02 12:23:45')->is('12h'));
        $this->assertFalse(Carbon::parse('2019-06-02 12:23:45')->is('15h'));
        $this->assertFalse(Carbon::parse('2019-06-02 12:23:45')->is('12:00'));
        $this->assertFalse(Carbon::parse('2019-06-02 12:23:45')->is('15:00'));
        $this->assertTrue(Carbon::parse('2019-06-02 15:23:45')->is('3pm'));
        $this->assertFalse(Carbon::parse('2019-06-02 15:23:45')->is('4pm'));
        $this->assertFalse(Carbon::parse('2019-06-02 15:23:45')->is('3am'));
        $this->assertTrue(Carbon::parse('2019-06-02 12:23:45')->is('2019-06-02 12:23'));
        $this->assertFalse(Carbon::parse('2019-06-02 12:23:45')->is('2019-06-03 12:23'));
        $this->assertFalse(Carbon::parse('2019-06-02 12:23:45')->is('2019-06-02 15:23'));
        $this->assertFalse(Carbon::parse('2019-06-02 12:23:45')->is('2019-06-02 12:33'));
        $this->assertTrue(Carbon::parse('2019-06-02 12:23:45')->is('2 June 2019'));
        $this->assertFalse(Carbon::parse('2019-06-02 12:23:45')->is('1 June 2019'));
        $this->assertTrue(Carbon::parse('2019-06-02 12:23:45')->is('June 2019'));
        $this->assertFalse(Carbon::parse('2019-06-02 12:23:45')->is('August 2019'));
        $this->assertFalse(Carbon::parse('2019-06-02 12:23:45')->is('June 2018'));
    }

    public function testHasFormatWithDots()
    {
        $this->assertTrue(Carbon::hasFormat('2020.09.09', 'Y.m.d'));
        $this->assertFalse(Carbon::hasFormat('2020009009', 'Y.m.d'));
        $this->assertFalse(Carbon::hasFormat('2020-09-09', 'Y.m.d'));
        $this->assertFalse(Carbon::hasFormat('2020*09*09', 'Y.m.d'));
        $this->assertFalse(Carbon::hasFormat('2020k09d09', 'Y.m.d'));
    }
}
