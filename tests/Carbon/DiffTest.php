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
use Carbon\CarbonInterface;
use Carbon\CarbonInterval;
use Carbon\Exceptions\InvalidFormatException;
use Closure;
use DateTime;
use InvalidArgumentException;
use Tests\AbstractTestCase;

class DiffTest extends AbstractTestCase
{
    public function wrapWithTestNow(Closure $func, ?CarbonInterface $dt = null)
    {
        parent::wrapWithTestNow($func, $dt ?: Carbon::createFromDate(2012, 1, 1));
    }

    public function testDiffAsCarbonInterval()
    {
        $dt = Carbon::createFromDate(2000, 1, 1);
        $this->assertCarbonInterval($dt->diffAsCarbonInterval($dt->copy()->addYear()), 1, 0, 0, 0, 0, 0);
        $this->assertTrue($dt->diffAsCarbonInterval($dt)->isEmpty());
    }

    public function testDiffInYearsPositive()
    {
        $dt = Carbon::createFromDate(2000, 1, 1);
        $this->assertSame(1, $dt->diffInYears($dt->copy()->addYear()));
    }

    public function testDiffInYearsNegativeWithSign()
    {
        $dt = Carbon::createFromDate(2000, 1, 1);
        $this->assertSame(-1, $dt->diffInYears($dt->copy()->subYear(), false));
    }

    public function testDiffInYearsNegativeNoSign()
    {
        $dt = Carbon::createFromDate(2000, 1, 1);
        $this->assertSame(1, $dt->diffInYears($dt->copy()->subYear()));
    }

    public function testDiffInYearsVsDefaultNow()
    {
        $this->wrapWithTestNow(function () {
            $this->assertSame(1, Carbon::now()->subYear()->diffInYears());
        });
    }

    public function testDiffInYearsEnsureIsTruncated()
    {
        $dt = Carbon::createFromDate(2000, 1, 1);
        $this->assertSame(1, $dt->diffInYears($dt->copy()->addYear()->addMonths(7)));
    }

    public function testDiffInQuartersPositive()
    {
        $dt = Carbon::createFromDate(2000, 1, 1);
        $this->assertSame(1, $dt->diffInQuarters($dt->copy()->addQuarter()->addDay()));
    }

    public function testDiffInQuartersNegativeWithSign()
    {
        $dt = Carbon::createFromDate(2000, 1, 1);
        $this->assertSame(-4, $dt->diffInQuarters($dt->copy()->subQuarters(4), false));
    }

    public function testDiffInQuartersNegativeWithNoSign()
    {
        $dt = Carbon::createFromDate(2000, 1, 1);
        $this->assertSame(4, $dt->diffInQuarters($dt->copy()->subQuarters(4)));
    }

    public function testDiffInQuartersVsDefaultNow()
    {
        $this->wrapWithTestNow(function () {
            $this->assertSame(4, Carbon::now()->subYear()->diffInQuarters());
        });
    }

    public function testDiffInQuartersEnsureIsTruncated()
    {
        $dt = Carbon::createFromDate(2000, 1, 1);
        $this->assertSame(1, $dt->diffInQuarters($dt->copy()->addQuarter()->addDays(12)));
    }

    public function testDiffInMonthsPositive()
    {
        $dt = Carbon::createFromDate(2000, 1, 1);
        $this->assertSame(13, $dt->diffInMonths($dt->copy()->addYear()->addMonth()));
    }

    public function testDiffInMonthsNegativeWithSign()
    {
        $dt = Carbon::createFromDate(2000, 1, 1);
        $this->assertSame(-11, $dt->diffInMonths($dt->copy()->subYear()->addMonth(), false));
    }

    public function testDiffInMonthsWithTimezone()
    {
        $first = new Carbon('2022-02-01 16:00 America/Toronto');
        $second = new Carbon('2022-01-01 20:00 Europe/Berlin');

        $this->assertSame(-1, $first->diffInMonths($second, false));
        $this->assertSame(1, $second->diffInMonths($first, false));

        $first = new Carbon('2022-02-01 01:00 America/Toronto');
        $second = new Carbon('2022-01-01 00:00 Europe/Berlin');

        $this->assertSame(-1, $first->diffInMonths($second, false));
        $this->assertSame(1, $second->diffInMonths($first, false));

        $first = new Carbon('2022-02-01 01:00 Europe/Berlin');
        $second = new Carbon('2022-01-01 00:00 America/Toronto');

        $this->assertSame(0, $first->diffInMonths($second, false));
        $this->assertSame(0, $second->diffInMonths($first, false));
    }

    public function testDiffInMonthsNegativeNoSign()
    {
        $dt = Carbon::createFromDate(2000, 1, 1);
        $this->assertSame(11, $dt->diffInMonths($dt->copy()->subYear()->addMonth()));
    }

    public function testDiffInMonthsVsDefaultNow()
    {
        $this->wrapWithTestNow(function () {
            $this->assertSame(12, Carbon::now()->subYear()->diffInMonths());
        });
    }

    public function testDiffInMonthsEnsureIsTruncated()
    {
        $dt = Carbon::createFromDate(2000, 1, 1);
        $this->assertSame(1, $dt->diffInMonths($dt->copy()->addMonth()->addDays(16)));
    }

    public function testDiffInDaysPositive()
    {
        $dt = Carbon::createFromDate(2000, 1, 1);
        $this->assertSame(366, $dt->diffInDays($dt->copy()->addYear()));
    }

    public function testDiffInDaysNegativeWithSign()
    {
        $dt = Carbon::createFromDate(2000, 1, 1);
        $this->assertSame(-365, $dt->diffInDays($dt->copy()->subYear(), false));
    }

    public function testDiffInDaysNegativeNoSign()
    {
        $dt = Carbon::createFromDate(2000, 1, 1);
        $this->assertSame(365, $dt->diffInDays($dt->copy()->subYear()));
    }

    public function testDiffInDaysVsDefaultNow()
    {
        $this->wrapWithTestNow(function () {
            $this->assertSame(7, Carbon::now()->subWeek()->diffInDays());
        });
    }

    public function testDiffInDaysEnsureIsTruncated()
    {
        $dt = Carbon::createFromDate(2000, 1, 1);
        $this->assertSame(1, $dt->diffInDays($dt->copy()->addDay()->addHours(13)));
    }

    public function testDiffInDaysFilteredPositiveWithMutated()
    {
        $dt = Carbon::createFromDate(2000, 1, 1);
        $this->assertSame(5, $dt->diffInDaysFiltered(function (Carbon $date) {
            return $date->dayOfWeek === 1;
        }, $dt->copy()->endOfMonth()));
    }

    public function testDiffInDaysFilteredPositiveWithSecondObject()
    {
        $dt1 = Carbon::createFromDate(2000, 1, 1);
        $dt2 = Carbon::createFromDate(2000, 1, 31);

        $this->assertSame(5, $dt1->diffInDaysFiltered(function (Carbon $date) {
            return $date->dayOfWeek === Carbon::SUNDAY;
        }, $dt2));
    }

    public function testDiffInDaysFilteredNegativeNoSignWithMutated()
    {
        $dt = Carbon::createFromDate(2000, 1, 31);
        $this->assertSame(5, $dt->diffInDaysFiltered(function (Carbon $date) {
            return $date->dayOfWeek === Carbon::SUNDAY;
        }, $dt->copy()->startOfMonth()));
    }

    public function testDiffInDaysFilteredNegativeNoSignWithSecondObject()
    {
        $dt1 = Carbon::createFromDate(2000, 1, 31);
        $dt2 = Carbon::createFromDate(2000, 1, 1);

        $this->assertSame(5, $dt1->diffInDaysFiltered(function (Carbon $date) {
            return $date->dayOfWeek === Carbon::SUNDAY;
        }, $dt2));
    }

    public function testDiffInDaysFilteredNegativeWithSignWithMutated()
    {
        $dt = Carbon::createFromDate(2000, 1, 31);
        $this->assertSame(-5, $dt->diffInDaysFiltered(function (Carbon $date) {
            return $date->dayOfWeek === 1;
        }, $dt->copy()->startOfMonth(), false));
    }

    public function testDiffInDaysFilteredNegativeWithSignWithSecondObject()
    {
        $dt1 = Carbon::createFromDate(2000, 1, 31);
        $dt2 = Carbon::createFromDate(2000, 1, 1);

        $this->assertSame(-5, $dt1->diffInDaysFiltered(function (Carbon $date) {
            return $date->dayOfWeek === Carbon::SUNDAY;
        }, $dt2, false));
    }

    public function testDiffInHoursFiltered()
    {
        $dt1 = Carbon::createFromDate(2000, 1, 31)->endOfDay();
        $dt2 = Carbon::createFromDate(2000, 1, 1)->startOfDay();

        $this->assertSame(31, $dt1->diffInHoursFiltered(function (Carbon $date) {
            return $date->hour === 9;
        }, $dt2));
    }

    public function testDiffInHoursFilteredNegative()
    {
        $dt1 = Carbon::createFromDate(2000, 1, 31)->endOfDay();
        $dt2 = Carbon::createFromDate(2000, 1, 1)->startOfDay();

        $this->assertSame(-31, $dt1->diffInHoursFiltered(function (Carbon $date) {
            return $date->hour === 9;
        }, $dt2, false));
    }

    public function testDiffInHoursFilteredWorkHoursPerWeek()
    {
        $dt1 = Carbon::createFromDate(2000, 1, 5)->endOfDay();
        $dt2 = Carbon::createFromDate(2000, 1, 1)->startOfDay();

        $this->assertSame(40, $dt1->diffInHoursFiltered(function (Carbon $date) {
            return $date->hour > 8 && $date->hour < 17;
        }, $dt2));
    }

    public function testDiffFilteredUsingMinutesPositiveWithMutated()
    {
        $dt = Carbon::createFromDate(2000, 1, 1)->startOfDay();
        $this->assertSame(60, $dt->diffFiltered(CarbonInterval::minute(), function (Carbon $date) {
            return $date->hour === 12;
        }, Carbon::createFromDate(2000, 1, 1)->endOfDay()));
    }

    public function testDiffFilteredPositiveWithSecondObject()
    {
        $dt1 = Carbon::create(2000, 1, 1);
        $dt2 = $dt1->copy()->addSeconds(80);

        $this->assertSame(40, $dt1->diffFiltered(CarbonInterval::second(), function (Carbon $date) {
            return $date->second % 2 === 0;
        }, $dt2));
    }

    public function testDiffFilteredNegativeNoSignWithMutated()
    {
        $dt = Carbon::createFromDate(2000, 1, 31);

        $this->assertSame(2, $dt->diffFiltered(CarbonInterval::days(2), function (Carbon $date) {
            return $date->dayOfWeek === Carbon::SUNDAY;
        }, $dt->copy()->startOfMonth()));
    }

    public function testDiffFilteredNegativeNoSignWithSecondObject()
    {
        $dt1 = Carbon::createFromDate(2006, 1, 31);
        $dt2 = Carbon::createFromDate(2000, 1, 1);

        $this->assertSame(7, $dt1->diffFiltered(CarbonInterval::year(), function (Carbon $date) {
            return $date->month === 1;
        }, $dt2));
    }

    public function testDiffFilteredNegativeWithSignWithMutated()
    {
        $dt = Carbon::createFromDate(2000, 1, 31);
        $this->assertSame(-4, $dt->diffFiltered(CarbonInterval::week(), function (Carbon $date) {
            return $date->month === 12;
        }, $dt->copy()->subMonths(3), false));
    }

    public function testDiffFilteredNegativeWithSignWithSecondObject()
    {
        $dt1 = Carbon::createFromDate(2001, 1, 31);
        $dt2 = Carbon::createFromDate(1999, 1, 1);

        $this->assertSame(-12, $dt1->diffFiltered(CarbonInterval::month(), function (Carbon $date) {
            return $date->year === 2000;
        }, $dt2, false));
    }

    public function testBug188DiffWithSameDates()
    {
        $start = Carbon::create(2014, 10, 8, 15, 20, 0);
        $end = $start->copy();

        $this->assertSame(0, $start->diffInDays($end));
        $this->assertSame(0, $start->diffInWeekdays($end));
    }

    public function testBug188DiffWithDatesOnlyHoursApart()
    {
        $start = Carbon::create(2014, 10, 8, 15, 20, 0);
        $end = $start->copy();

        $this->assertSame(0, $start->diffInDays($end));
        $this->assertSame(0, $start->diffInWeekdays($end));
    }

    public function testBug188DiffWithSameDates1DayApart()
    {
        $start = Carbon::create(2014, 10, 8, 15, 20, 0);
        $end = $start->copy()->addDay();

        $this->assertSame(1, $start->diffInDays($end));
        $this->assertSame(1, $start->diffInWeekdays($end));
    }

    public function testBug188DiffWithDatesOnTheWeekend()
    {
        $start = Carbon::create(2014, 1, 1, 0, 0, 0);
        $start->next(Carbon::SATURDAY);
        $end = $start->copy()->addDay();

        $this->assertSame(1, $start->diffInDays($end));
        $this->assertSame(0, $start->diffInWeekdays($end));
    }

    public function testBug2798ConsistencyWithDiffInDays()
    {
        // 0 hour diff
        $s1 = Carbon::create(2023, 6, 6, 15, 0, 0);
        $e1 = Carbon::create(2023, 6, 6, 15, 0, 0);

        $this->assertSame(0, $s1->diffInWeekdays($e1));
        $this->assertSame(0, $s1->diffInDays($e1));

        // 1 hour diff
        $s2 = Carbon::create(2023, 6, 6, 15, 0, 0);
        $e2 = Carbon::create(2023, 6, 6, 16, 0, 0);

        $this->assertSame(0, $s2->diffInWeekdays($e2));
        $this->assertSame(0, $e2->diffInWeekdays($s2));
        $this->assertSame('2023-06-06 15:00:00', $s2->format('Y-m-d H:i:s'));
        $this->assertSame('2023-06-06 16:00:00', $e2->format('Y-m-d H:i:s'));
        $this->assertSame(0, $s2->diffInDays($e2));

        // 23 hour diff
        $s3 = Carbon::create(2023, 6, 6, 15, 0, 0);
        $e3 = Carbon::create(2023, 6, 7, 14, 0, 0);

        $this->assertSame(1, $s3->diffInWeekdays($e3));
        $this->assertSame(1, $e3->diffInWeekdays($s3));
        $this->assertSame('2023-06-06 15:00:00', $s3->format('Y-m-d H:i:s'));
        $this->assertSame('2023-06-07 14:00:00', $e3->format('Y-m-d H:i:s'));
        $this->assertSame(0, $s3->diffInDays($e3));

        // 24 hour diff
        $s4 = Carbon::create(2023, 6, 6, 15, 0, 0);
        $e4 = Carbon::create(2023, 6, 7, 15, 0, 0);

        $this->assertSame(1, $s4->diffInWeekdays($e4));
        $this->assertSame(1, $e4->diffInWeekdays($s4));
        $this->assertSame(1, $s4->diffInDays($e4));

        // 25 hour diff
        $s5 = Carbon::create(2023, 6, 6, 15, 0, 0);
        $e5 = Carbon::create(2023, 6, 7, 16, 0, 0);

        $this->assertSame(1, $s5->diffInWeekdays($e5));
        $this->assertSame(1, $e5->diffInWeekdays($s5));
        $this->assertSame('2023-06-06 15:00:00', $s5->format('Y-m-d H:i:s'));
        $this->assertSame('2023-06-07 16:00:00', $e5->format('Y-m-d H:i:s'));
        $this->assertSame(1, $s5->diffInDays($e5));
    }

    public function testDiffInWeekdaysPositive()
    {
        $dt = Carbon::createFromDate(2000, 1, 1);
        $this->assertSame(21, $dt->diffInWeekdays($dt->copy()->addMonth()));
    }

    public function testDiffInWeekdaysNegativeNoSign()
    {
        $dt = Carbon::createFromDate(2000, 1, 31);
        $this->assertSame(20, $dt->diffInWeekdays($dt->copy()->startOfMonth()));
    }

    public function testDiffInWeekdaysNegativeWithSign()
    {
        $dt = Carbon::createFromDate(2000, 1, 31);
        $this->assertSame(-20, $dt->diffInWeekdays($dt->copy()->startOfMonth(), false));
    }

    public function testDiffInWeekendDaysPositive()
    {
        $dt = Carbon::createFromDate(2000, 1, 1);
        $this->assertSame(10, $dt->diffInWeekendDays($dt->copy()->addMonth()));
    }

    public function testDiffInWeekendDaysNegativeNoSign()
    {
        $dt = Carbon::createFromDate(2000, 1, 31);
        $this->assertSame(10, $dt->diffInWeekendDays($dt->copy()->startOfMonth()));
    }

    public function testDiffInWeekendDaysNegativeWithSign()
    {
        $dt = Carbon::createFromDate(2000, 1, 31);
        $this->assertSame(-10, $dt->diffInWeekendDays($dt->copy()->startOfMonth(), false));
    }

    public function testDiffInWeeksPositive()
    {
        $dt = Carbon::createFromDate(2000, 1, 1);
        $this->assertSame(52, $dt->diffInWeeks($dt->copy()->addYear()));
    }

    public function testDiffInWeeksNegativeWithSign()
    {
        $dt = Carbon::createFromDate(2000, 1, 1);
        $this->assertSame(-52, $dt->diffInWeeks($dt->copy()->subYear(), false));
    }

    public function testDiffInWeeksNegativeNoSign()
    {
        $dt = Carbon::createFromDate(2000, 1, 1);
        $this->assertSame(52, $dt->diffInWeeks($dt->copy()->subYear()));
    }

    public function testDiffInWeeksVsDefaultNow()
    {
        $this->wrapWithTestNow(function () {
            $this->assertSame(1, Carbon::now()->subWeek()->diffInWeeks());
        });
    }

    public function testDiffInWeeksEnsureIsTruncated()
    {
        $dt = Carbon::createFromDate(2000, 1, 1);
        $this->assertSame(0, $dt->diffInWeeks($dt->copy()->addWeek()->subDay()));
    }

    public function testDiffInHoursPositive()
    {
        $dt = Carbon::createFromDate(2000, 1, 1);
        $this->assertSame(26, $dt->diffInHours($dt->copy()->addDay()->addHours(2)));
    }

    public function testDiffInHoursNegativeWithSign()
    {
        $dt = Carbon::createFromDate(2000, 1, 1);
        $this->assertSame(-22, $dt->diffInHours($dt->copy()->subDay()->addHours(2), false));
    }

    public function testDiffInHoursNegativeNoSign()
    {
        $dt = Carbon::createFromDate(2000, 1, 1);
        $this->assertSame(22, $dt->diffInHours($dt->copy()->subDay()->addHours(2)));
    }

    public function testDiffInHoursVsDefaultNow()
    {
        $this->wrapWithTestNow(function () {
            $this->assertSame(48, Carbon::now()->subDays(2)->diffInHours());
        }, Carbon::create(2012, 1, 15));
    }

    public function testDiffInHoursEnsureIsTruncated()
    {
        $dt = Carbon::createFromDate(2000, 1, 1);
        $this->assertSame(1, $dt->diffInHours($dt->copy()->addHour()->addMinutes(31)));
    }

    public function testDiffInHoursWithTimezones()
    {
        date_default_timezone_set('Africa/Algiers');
        Carbon::setTestNow();

        $dtToronto = Carbon::create(2012, 1, 1, 0, 0, 0, 'America/Toronto');
        $dtVancouver = Carbon::create(2012, 1, 1, 0, 0, 0, 'America/Vancouver');

        $this->assertSame(3, $dtVancouver->diffInHours($dtToronto), 'Midnight in Toronto is 3 hours from midnight in Vancouver');

        $dtToronto = Carbon::createFromDate(2012, 1, 1, 'America/Toronto');
        sleep(2);
        $dtVancouver = Carbon::createFromDate(2012, 1, 1, 'America/Vancouver');

        $this->assertSame(0, $dtVancouver->diffInHours($dtToronto) % 24);

        $dtToronto = Carbon::createMidnightDate(2012, 1, 1, 'America/Toronto');
        $dtVancouver = Carbon::createMidnightDate(2012, 1, 1, 'America/Vancouver');

        $this->assertSame(3, $dtVancouver->diffInHours($dtToronto), 'Midnight in Toronto is 3 hours from midnight in Vancouver');
    }

    public function testDiffInMinutesPositive()
    {
        $dt = Carbon::createFromDate(2000, 1, 1);
        $this->assertSame(62, $dt->diffInMinutes($dt->copy()->addHour()->addMinutes(2)));
    }

    public function testDiffInMinutesPositiveALot()
    {
        $dt = Carbon::createFromDate(2000, 1, 1);
        $this->assertSame(1502, $dt->diffInMinutes($dt->copy()->addHours(25)->addMinutes(2)));
    }

    public function testDiffInMinutesNegativeWithSign()
    {
        $dt = Carbon::createFromDate(2000, 1, 1);
        $this->assertSame(-58, $dt->diffInMinutes($dt->copy()->subHour()->addMinutes(2), false));
    }

    public function testDiffInMinutesNegativeNoSign()
    {
        $dt = Carbon::createFromDate(2000, 1, 1);
        $this->assertSame(58, $dt->diffInMinutes($dt->copy()->subHour()->addMinutes(2)));
    }

    public function testDiffInMinutesVsDefaultNow()
    {
        $this->wrapWithTestNow(function () {
            $this->assertSame(60, Carbon::now()->subHour()->diffInMinutes());
        });
    }

    public function testDiffInMinutesEnsureIsTruncated()
    {
        $dt = Carbon::createFromDate(2000, 1, 1);
        $this->assertSame(1, $dt->diffInMinutes($dt->copy()->addMinute()->addSeconds(31)));
    }

    public function testDiffInSecondsPositive()
    {
        $dt = Carbon::createFromDate(2000, 1, 1);
        $this->assertSame(62, $dt->diffInSeconds($dt->copy()->addMinute()->addSeconds(2)));
    }

    public function testDiffInSecondsPositiveALot()
    {
        $dt = Carbon::createFromDate(2000, 1, 1);
        $this->assertSame(7202, $dt->diffInSeconds($dt->copy()->addHours(2)->addSeconds(2)));
    }

    public function testDiffInSecondsNegativeWithSign()
    {
        $dt = Carbon::createFromDate(2000, 1, 1);
        $this->assertSame(-58, $dt->diffInSeconds($dt->copy()->subMinute()->addSeconds(2), false));
    }

    public function testDiffInSecondsNegativeNoSign()
    {
        $dt = Carbon::createFromDate(2000, 1, 1);
        $this->assertSame(58, $dt->diffInSeconds($dt->copy()->subMinute()->addSeconds(2)));
    }

    public function testDiffInSecondsVsDefaultNow()
    {
        $this->wrapWithTestNow(function () {
            $this->assertSame(3600, Carbon::now()->subHour()->diffInSeconds());
        });
    }

    public function testDiffInSecondsEnsureIsTruncated()
    {
        $dt = Carbon::createFromDate(2000, 1, 1);
        $this->assertSame(1, $dt->diffInSeconds($dt->copy()->addSeconds(1.9)));
    }

    public function testDiffInSecondsWithTimezones()
    {
        $dtOttawa = Carbon::createFromDate(2000, 1, 1, 'America/Toronto');
        $dtVancouver = Carbon::createFromDate(2000, 1, 1, 'America/Vancouver');
        $this->assertSame(0, $dtOttawa->diffInSeconds($dtVancouver) % (24 * 3600));

        $dtOttawa = Carbon::createMidnightDate(2000, 1, 1, 'America/Toronto');
        $dtVancouver = Carbon::createMidnightDate(2000, 1, 1, 'America/Vancouver');
        $this->assertSame(3 * 60 * 60, $dtOttawa->diffInSeconds($dtVancouver));
    }

    public function testDiffInSecondsWithTimezonesAndVsDefault()
    {
        $vanNow = Carbon::now('America/Vancouver');
        $hereNow = $vanNow->copy()->setTimezone(Carbon::now()->tz);
        $this->wrapWithTestNow(function () use ($vanNow) {
            $this->assertSame(0, $vanNow->diffInSeconds());
        }, $hereNow);
    }

    public function testDiffForHumansNowAndSecond()
    {
        $this->wrapWithTestNow(function () {
            $this->assertSame('1 second ago', Carbon::now()->diffForHumans());
        });
    }

    /**
     * @see https://github.com/briannesbitt/Carbon/issues/2136
     */
    public function testDiffInTheFuture()
    {
        Carbon::setTestNow('2020-07-22 09:15');

        $this->assertSame(
            '1 week from now',
            Carbon::parse('2020-07-30 13:51:15')
                ->diffForHumans(['options' => CarbonInterface::ROUND])
        );
    }

    public function testDiffWithSkippedUnits()
    {
        Carbon::setTestNow('2021-11-04 15:42');

        $this->assertSame(
            '28 weeks from now',
            Carbon::parse('2022-05-25')
                ->diffForHumans(['skip' => ['y', 'm']])
        );
        $this->assertSame(
            '201 days from now',
            Carbon::parse('2022-05-25')
                ->diffForHumans(['skip' => ['y', 'm', 'w']])
        );
        $this->assertSame(
            '4 hours from now',
            Carbon::parse('2021-11-04 20:00')
                ->diffForHumans(['skip' => ['y', 'm', 'w']])
        );
        $this->assertSame(
            '6 hours ago',
            Carbon::parse('2021-11-04 09:00')
                ->diffForHumans(['skip' => ['y', 'm', 'w']])
        );
        $this->assertSame(
            '528 days ago',
            Carbon::parse('2020-05-25')
                ->diffForHumans(['skip' => ['y', 'm', 'w']])
        );

        Carbon::setTestNow('2023-01-02 16:57');
        $this->assertSame(
            '1 day 16 hours 57 minutes',
            Carbon::yesterday()->diffForHumans([
                'syntax' => CarbonInterface::DIFF_ABSOLUTE,
                'parts' => 3,
                'skip' => 's',
            ])
        );
    }

    public function testDiffForHumansNowAndSecondWithTimezone()
    {
        $vanNow = Carbon::now('America/Vancouver');
        $hereNow = $vanNow->copy()->setTimezone(Carbon::now()->tz);
        $this->wrapWithTestNow(function () use ($vanNow) {
            $this->assertSame('1 second ago', $vanNow->diffForHumans());
        }, $hereNow);
    }

    public function testDiffForHumansNowAndSeconds()
    {
        $this->wrapWithTestNow(function () {
            $this->assertSame('2 seconds ago', Carbon::now()->subSeconds(2)->diffForHumans());
        });
    }

    public function testDiffForHumansNowAndNearlyMinute()
    {
        $this->wrapWithTestNow(function () {
            $this->assertSame('59 seconds ago', Carbon::now()->subSeconds(59)->diffForHumans());
        });
    }

    public function testDiffForHumansNowAndMinute()
    {
        $this->wrapWithTestNow(function () {
            $this->assertSame('1 minute ago', Carbon::now()->subMinute()->diffForHumans());
        });
    }

    public function testDiffForHumansNowAndMinutes()
    {
        $this->wrapWithTestNow(function () {
            $this->assertSame('2 minutes ago', Carbon::now()->subMinutes(2)->diffForHumans());
        });
    }

    public function testDiffForHumansNowAndNearlyHour()
    {
        $this->wrapWithTestNow(function () {
            $this->assertSame('59 minutes ago', Carbon::now()->subMinutes(59)->diffForHumans());
        });
    }

    public function testDiffForHumansNowAndHour()
    {
        $this->wrapWithTestNow(function () {
            $this->assertSame('1 hour ago', Carbon::now()->subHour()->diffForHumans());
        });
    }

    public function testDiffForHumansNowAndHours()
    {
        $this->wrapWithTestNow(function () {
            $this->assertSame('2 hours ago', Carbon::now()->subHours(2)->diffForHumans());
        });
    }

    public function testDiffForHumansNowAndNearlyDay()
    {
        $this->wrapWithTestNow(function () {
            $this->assertSame('23 hours ago', Carbon::now()->subHours(23)->diffForHumans());
        });
    }

    public function testDiffForHumansNowAndDay()
    {
        $this->wrapWithTestNow(function () {
            $this->assertSame('1 day ago', Carbon::now()->subDay()->diffForHumans());
        });
    }

    public function testDiffForHumansNowAndDays()
    {
        $this->wrapWithTestNow(function () {
            $this->assertSame('2 days ago', Carbon::now()->subDays(2)->diffForHumans());
        });
    }

    public function testDiffForHumansNowAndNearlyWeek()
    {
        $this->wrapWithTestNow(function () {
            $this->assertSame('6 days ago', Carbon::now()->subDays(6)->diffForHumans());
        });
    }

    public function testDiffForHumansNowAndWeek()
    {
        $this->wrapWithTestNow(function () {
            $this->assertSame('1 week ago', Carbon::now()->subWeek()->diffForHumans());
        });
    }

    public function testDiffForHumansNowAndWeeks()
    {
        $this->wrapWithTestNow(function () {
            $this->assertSame('2 weeks ago', Carbon::now()->subWeeks(2)->diffForHumans());
        });
    }

    public function testDiffForHumansNowAndNearlyMonth()
    {
        $this->wrapWithTestNow(function () {
            $this->assertSame('3 weeks ago', Carbon::now()->subWeeks(3)->diffForHumans());
        });
    }

    public function testDiffForHumansNowAndMonth()
    {
        Carbon::setTestNow('2018-12-01');
        $this->assertSame('4 weeks ago', Carbon::now()->subWeeks(4)->diffForHumans());
        $this->assertSame('1 month ago', Carbon::now()->subMonth()->diffForHumans());
    }

    public function testDiffForHumansNowAndMonths()
    {
        $this->wrapWithTestNow(function () {
            $this->assertSame('2 months ago', Carbon::now()->subMonths(2)->diffForHumans());
        });
    }

    public function testDiffForHumansNowAndNearlyYear()
    {
        $this->wrapWithTestNow(function () {
            $this->assertSame('11 months ago', Carbon::now()->subMonths(11)->diffForHumans());
        });
    }

    public function testDiffForHumansNowAndYear()
    {
        $this->wrapWithTestNow(function () {
            $this->assertSame('1 year ago', Carbon::now()->subYear()->diffForHumans());
        });
    }

    public function testDiffForHumansNowAndYears()
    {
        $this->wrapWithTestNow(function () {
            $this->assertSame('2 years ago', Carbon::now()->subYears(2)->diffForHumans());
        });
    }

    public function testDiffForHumansNowAndFutureSecond()
    {
        $this->wrapWithTestNow(function () {
            $this->assertSame('1 second from now', Carbon::now()->addSecond()->diffForHumans());
        });
    }

    public function testDiffForHumansNowAndFutureSeconds()
    {
        $this->wrapWithTestNow(function () {
            $this->assertSame('2 seconds from now', Carbon::now()->addSeconds(2)->diffForHumans());
        });
    }

    public function testDiffForHumansNowAndNearlyFutureMinute()
    {
        $this->wrapWithTestNow(function () {
            $this->assertSame('59 seconds from now', Carbon::now()->addSeconds(59)->diffForHumans());
        });
    }

    public function testDiffForHumansNowAndFutureMinute()
    {
        $this->wrapWithTestNow(function () {
            $this->assertSame('1 minute from now', Carbon::now()->addMinute()->diffForHumans());
        });
    }

    public function testDiffForHumansNowAndFutureMinutes()
    {
        $this->wrapWithTestNow(function () {
            $this->assertSame('2 minutes from now', Carbon::now()->addMinutes(2)->diffForHumans());
        });
    }

    public function testDiffForHumansNowAndNearlyFutureHour()
    {
        $this->wrapWithTestNow(function () {
            $this->assertSame('59 minutes from now', Carbon::now()->addMinutes(59)->diffForHumans());
        });
    }

    public function testDiffForHumansNowAndFutureHour()
    {
        $this->wrapWithTestNow(function () {
            $this->assertSame('1 hour from now', Carbon::now()->addHour()->diffForHumans());
        });
    }

    public function testDiffForHumansNowAndFutureHours()
    {
        $this->wrapWithTestNow(function () {
            $this->assertSame('2 hours from now', Carbon::now()->addHours(2)->diffForHumans());
        });
    }

    public function testDiffForHumansNowAndNearlyFutureDay()
    {
        $this->wrapWithTestNow(function () {
            $this->assertSame('23 hours from now', Carbon::now()->addHours(23)->diffForHumans());
        });
    }

    public function testDiffForHumansNowAndFutureDay()
    {
        $this->wrapWithTestNow(function () {
            $this->assertSame('1 day from now', Carbon::now()->addDay()->diffForHumans());
        });
    }

    public function testDiffForHumansNowAndFutureDays()
    {
        $this->wrapWithTestNow(function () {
            $this->assertSame('2 days from now', Carbon::now()->addDays(2)->diffForHumans());
        });
    }

    public function testDiffForHumansNowAndNearlyFutureWeek()
    {
        $this->wrapWithTestNow(function () {
            $this->assertSame('6 days from now', Carbon::now()->addDays(6)->diffForHumans());
        });
    }

    public function testDiffForHumansNowAndFutureWeek()
    {
        $this->wrapWithTestNow(function () {
            $this->assertSame('1 week from now', Carbon::now()->addWeek()->diffForHumans());
        });
    }

    public function testDiffForHumansNowAndFutureWeeks()
    {
        $this->wrapWithTestNow(function () {
            $this->assertSame('2 weeks from now', Carbon::now()->addWeeks(2)->diffForHumans());
        });
    }

    public function testDiffForHumansNowAndNearlyFutureMonth()
    {
        $this->wrapWithTestNow(function () {
            $this->assertSame('3 weeks from now', Carbon::now()->addWeeks(3)->diffForHumans());
        });
    }

    public function testDiffForHumansNowAndFutureMonth()
    {
        $this->wrapWithTestNow(function () {
            $this->assertSame('4 weeks from now', Carbon::now()->addWeeks(4)->diffForHumans());
            $this->assertSame('1 month from now', Carbon::now()->addMonth()->diffForHumans());
        });
    }

    public function testDiffForHumansNowAndFutureMonths()
    {
        $this->wrapWithTestNow(function () {
            $this->assertSame('2 months from now', Carbon::now()->addMonths(2)->diffForHumans());
        });
    }

    public function testDiffForHumansNowAndNearlyFutureYear()
    {
        $this->wrapWithTestNow(function () {
            $this->assertSame('11 months from now', Carbon::now()->addMonths(11)->diffForHumans());
        });
    }

    public function testDiffForHumansNowAndFutureYear()
    {
        $this->wrapWithTestNow(function () {
            $this->assertSame('1 year from now', Carbon::now()->addYear()->diffForHumans());
        });
    }

    public function testDiffForHumansNowAndFutureYears()
    {
        $this->wrapWithTestNow(function () {
            $this->assertSame('2 years from now', Carbon::now()->addYears(2)->diffForHumans());
        });
    }

    public function testDiffForHumansOtherAndSecond()
    {
        $this->wrapWithTestNow(function () {
            $this->assertSame('1 second before', Carbon::now()->diffForHumans(Carbon::now()->addSecond()));
        });
    }

    public function testDiffForHumansOtherAndSeconds()
    {
        $this->wrapWithTestNow(function () {
            $this->assertSame('2 seconds before', Carbon::now()->diffForHumans(Carbon::now()->addSeconds(2)));
        });
    }

    public function testDiffForHumansOtherAndNearlyMinute()
    {
        $this->wrapWithTestNow(function () {
            $this->assertSame('59 seconds before', Carbon::now()->diffForHumans(Carbon::now()->addSeconds(59)));
        });
    }

    public function testDiffForHumansOtherAndMinute()
    {
        $this->wrapWithTestNow(function () {
            $this->assertSame('1 minute before', Carbon::now()->diffForHumans(Carbon::now()->addMinute()));
        });
    }

    public function testDiffForHumansOtherAndMinutes()
    {
        $this->wrapWithTestNow(function () {
            $this->assertSame('2 minutes before', Carbon::now()->diffForHumans(Carbon::now()->addMinutes(2)));
        });
    }

    public function testDiffForHumansOtherAndNearlyHour()
    {
        $this->wrapWithTestNow(function () {
            $this->assertSame('59 minutes before', Carbon::now()->diffForHumans(Carbon::now()->addMinutes(59)));
        });
    }

    public function testDiffForHumansOtherAndHour()
    {
        $this->wrapWithTestNow(function () {
            $this->assertSame('1 hour before', Carbon::now()->diffForHumans(Carbon::now()->addHour()));
        });
    }

    public function testDiffForHumansOtherAndHours()
    {
        $this->wrapWithTestNow(function () {
            $this->assertSame('2 hours before', Carbon::now()->diffForHumans(Carbon::now()->addHours(2)));
        });
    }

    public function testDiffForHumansOtherAndNearlyDay()
    {
        $this->wrapWithTestNow(function () {
            $this->assertSame('23 hours before', Carbon::now()->diffForHumans(Carbon::now()->addHours(23)));
        });
    }

    public function testDiffForHumansOtherAndDay()
    {
        $this->wrapWithTestNow(function () {
            $this->assertSame('1 day before', Carbon::now()->diffForHumans(Carbon::now()->addDay()));
        });
    }

    public function testDiffForHumansOtherAndDays()
    {
        $this->wrapWithTestNow(function () {
            $this->assertSame('2 days before', Carbon::now()->diffForHumans(Carbon::now()->addDays(2)));
        });
    }

    public function testDiffForHumansOtherAndNearlyWeek()
    {
        $this->wrapWithTestNow(function () {
            $this->assertSame('6 days before', Carbon::now()->diffForHumans(Carbon::now()->addDays(6)));
        });
    }

    public function testDiffForHumansOverWeekWithDefaultPartsCount()
    {
        $this->wrapWithTestNow(function () {
            $this->assertSame('1 week ago', Carbon::now()->subDays(8)->diffForHumans());
        });
    }

    public function testDiffForHumansOverWeekWithPartsCount1()
    {
        $this->wrapWithTestNow(function () {
            $this->assertSame(
                '1 week ago',
                Carbon::now()->subDays(8)->diffForHumans(null, false, false, 1)
            );
        });
    }

    public function testDiffForHumansOverWeekWithPartsCount2()
    {
        $this->wrapWithTestNow(function () {
            $this->assertSame(
                '1 week 1 day ago',
                Carbon::now()->subDays(8)->diffForHumans(null, false, false, 2)
            );
        });
    }

    public function testDiffForHumansOverWeekWithMicrosecondsBuggyGap()
    {
        $this->wrapWithTestNow(function () {
            $this->assertSame(
                '23 hours 59 minutes 59 seconds after',
                Carbon::parse('2018-12-03 12:34:45.123456')
                    ->diffForHumans('2018-12-02 12:34:45.123476', ['parts' => 3])
            );
        });
    }

    public function testDiffForHumansOtherAndWeek()
    {
        $this->wrapWithTestNow(function () {
            $this->assertSame('1 week before', Carbon::now()->diffForHumans(Carbon::now()->addWeek()));
        });
    }

    public function testDiffForHumansOtherAndWeeks()
    {
        $this->wrapWithTestNow(function () {
            $this->assertSame('2 weeks before', Carbon::now()->diffForHumans(Carbon::now()->addWeeks(2)));
        });
    }

    public function testDiffForHumansOtherAndNearlyMonth()
    {
        $this->wrapWithTestNow(function () {
            $this->assertSame('3 weeks before', Carbon::now()->diffForHumans(Carbon::now()->addWeeks(3)));
        });
    }

    public function testDiffForHumansOtherAndMonth()
    {
        $this->wrapWithTestNow(function () {
            $this->assertSame('4 weeks before', Carbon::now()->diffForHumans(Carbon::now()->addWeeks(4)));
            $this->assertSame('1 month before', Carbon::now()->diffForHumans(Carbon::now()->addMonth()));
        });
    }

    public function testDiffForHumansOtherAndMonths()
    {
        $this->wrapWithTestNow(function () {
            $this->assertSame('2 months before', Carbon::now()->diffForHumans(Carbon::now()->addMonths(2)));
        });
    }

    public function testDiffForHumansOtherAndNearlyYear()
    {
        $this->wrapWithTestNow(function () {
            $this->assertSame('11 months before', Carbon::now()->diffForHumans(Carbon::now()->addMonths(11)));
        });
    }

    public function testDiffForHumansOtherAndYear()
    {
        $this->wrapWithTestNow(function () {
            $this->assertSame('1 year before', Carbon::now()->diffForHumans(Carbon::now()->addYear()));
        });
    }

    public function testDiffForHumansOtherAndYears()
    {
        $this->wrapWithTestNow(function () {
            $this->assertSame('2 years before', Carbon::now()->diffForHumans(Carbon::now()->addYears(2)));
        });
    }

    public function testDiffForHumansOtherAndFutureSecond()
    {
        $this->wrapWithTestNow(function () {
            $this->assertSame('1 second after', Carbon::now()->diffForHumans(Carbon::now()->subSecond()));
        });
    }

    public function testDiffForHumansOtherAndFutureSeconds()
    {
        $this->wrapWithTestNow(function () {
            $this->assertSame('2 seconds after', Carbon::now()->diffForHumans(Carbon::now()->subSeconds(2)));
        });
    }

    public function testDiffForHumansOtherAndNearlyFutureMinute()
    {
        $this->wrapWithTestNow(function () {
            $this->assertSame('59 seconds after', Carbon::now()->diffForHumans(Carbon::now()->subSeconds(59)));
        });
    }

    public function testDiffForHumansOtherAndFutureMinute()
    {
        $this->wrapWithTestNow(function () {
            $this->assertSame('1 minute after', Carbon::now()->diffForHumans(Carbon::now()->subMinute()));
        });
    }

    public function testDiffForHumansOtherAndFutureMinutes()
    {
        $this->wrapWithTestNow(function () {
            $this->assertSame('2 minutes after', Carbon::now()->diffForHumans(Carbon::now()->subMinutes(2)));
        });
    }

    public function testDiffForHumansOtherAndNearlyFutureHour()
    {
        $this->wrapWithTestNow(function () {
            $this->assertSame('59 minutes after', Carbon::now()->diffForHumans(Carbon::now()->subMinutes(59)));
        });
    }

    public function testDiffForHumansOtherAndFutureHour()
    {
        $this->wrapWithTestNow(function () {
            $this->assertSame('1 hour after', Carbon::now()->diffForHumans(Carbon::now()->subHour()));
        });
    }

    public function testDiffForHumansOtherAndFutureHours()
    {
        $this->wrapWithTestNow(function () {
            $this->assertSame('2 hours after', Carbon::now()->diffForHumans(Carbon::now()->subHours(2)));
        });
    }

    public function testDiffForHumansOtherAndNearlyFutureDay()
    {
        $this->wrapWithTestNow(function () {
            $this->assertSame('23 hours after', Carbon::now()->diffForHumans(Carbon::now()->subHours(23)));
        });
    }

    public function testDiffForHumansOtherAndFutureDay()
    {
        $this->wrapWithTestNow(function () {
            $this->assertSame('1 day after', Carbon::now()->diffForHumans(Carbon::now()->subDay()));
        });
    }

    public function testDiffForHumansOtherAndFutureDays()
    {
        $this->wrapWithTestNow(function () {
            $this->assertSame('2 days after', Carbon::now()->diffForHumans(Carbon::now()->subDays(2)));
        });
    }

    public function testDiffForHumansOtherAndNearlyFutureWeek()
    {
        $this->wrapWithTestNow(function () {
            $this->assertSame('6 days after', Carbon::now()->diffForHumans(Carbon::now()->subDays(6)));
        });
    }

    public function testDiffForHumansOtherAndFutureWeek()
    {
        $this->wrapWithTestNow(function () {
            $this->assertSame('1 week after', Carbon::now()->diffForHumans(Carbon::now()->subWeek()));
        });
    }

    public function testDiffForHumansOtherAndFutureWeeks()
    {
        $this->wrapWithTestNow(function () {
            $this->assertSame('2 weeks after', Carbon::now()->diffForHumans(Carbon::now()->subWeeks(2)));
        });
    }

    public function testDiffForHumansOtherAndNearlyFutureMonth()
    {
        $this->wrapWithTestNow(function () {
            $this->assertSame('3 weeks after', Carbon::now()->diffForHumans(Carbon::now()->subWeeks(3)));
        });
    }

    public function testDiffForHumansOtherAndFutureMonth()
    {
        Carbon::setTestNow('2018-12-01');
        $this->assertSame('4 weeks after', Carbon::now()->diffForHumans(Carbon::now()->subWeeks(4)));
        $this->assertSame('1 month after', Carbon::now()->diffForHumans(Carbon::now()->subMonth()));
    }

    public function testDiffForHumansOtherAndFutureMonths()
    {
        $this->wrapWithTestNow(function () {
            $this->assertSame('2 months after', Carbon::now()->diffForHumans(Carbon::now()->subMonths(2)));
        });
    }

    public function testDiffForHumansOtherAndNearlyFutureYear()
    {
        $this->wrapWithTestNow(function () {
            $this->assertSame('11 months after', Carbon::now()->diffForHumans(Carbon::now()->subMonths(11)));
        });
    }

    public function testDiffForHumansOtherAndFutureYear()
    {
        $this->wrapWithTestNow(function () {
            $this->assertSame('1 year after', Carbon::now()->diffForHumans(Carbon::now()->subYear()));
        });
    }

    public function testDiffForHumansOtherAndFutureYears()
    {
        $this->wrapWithTestNow(function () {
            $this->assertSame('2 years after', Carbon::now()->diffForHumans(Carbon::now()->subYears(2)));
        });
    }

    public function testDiffForHumansAbsoluteSeconds()
    {
        $this->wrapWithTestNow(function () {
            $this->assertSame('59 seconds', Carbon::now()->diffForHumans(Carbon::now()->subSeconds(59), true));
            $this->assertSame('59 seconds', Carbon::now()->diffForHumans(Carbon::now()->addSeconds(59), true));
        });
    }

    public function testDiffForHumansAbsoluteMinutes()
    {
        $this->wrapWithTestNow(function () {
            $this->assertSame('30 minutes', Carbon::now()->diffForHumans(Carbon::now()->subMinutes(30), true));
            $this->assertSame('30 minutes', Carbon::now()->diffForHumans(Carbon::now()->addMinutes(30), true));
        });
    }

    public function testDiffForHumansAbsoluteHours()
    {
        $this->wrapWithTestNow(function () {
            $this->assertSame('3 hours', Carbon::now()->diffForHumans(Carbon::now()->subHours(3), true));
            $this->assertSame('3 hours', Carbon::now()->diffForHumans(Carbon::now()->addHours(3), true));
        });
    }

    public function testDiffForHumansAbsoluteDays()
    {
        $this->wrapWithTestNow(function () {
            $this->assertSame('2 days', Carbon::now()->diffForHumans(Carbon::now()->subDays(2), true));
            $this->assertSame('2 days', Carbon::now()->diffForHumans(Carbon::now()->addDays(2), true));
        });
    }

    public function testDiffForHumansAbsoluteWeeks()
    {
        $this->wrapWithTestNow(function () {
            $this->assertSame('2 weeks', Carbon::now()->diffForHumans(Carbon::now()->subWeeks(2), true));
            $this->assertSame('2 weeks', Carbon::now()->diffForHumans(Carbon::now()->addWeeks(2), true));
        });
    }

    public function testDiffForHumansAbsoluteMonths()
    {
        $this->wrapWithTestNow(function () {
            $this->assertSame('2 months', Carbon::now()->diffForHumans(Carbon::now()->subMonthsNoOverflow(2), true));
            $this->assertSame('2 months', Carbon::now()->diffForHumans(Carbon::now()->addMonthsNoOverflow(2), true));
        });
    }

    public function testDiffForHumansAbsoluteYears()
    {
        $this->wrapWithTestNow(function () {
            $this->assertSame('1 year', Carbon::now()->diffForHumans(Carbon::now()->subYears(1), true));
            $this->assertSame('1 year', Carbon::now()->diffForHumans(Carbon::now()->addYears(1), true));
        });
    }

    public function testDiffForHumansWithOptions()
    {
        $this->wrapWithTestNow(function () {
            $this->assertSame('1 year', Carbon::now()->diffForHumans(Carbon::now()->subYears(1), CarbonInterface::DIFF_ABSOLUTE));
            $this->assertSame('1 year', Carbon::now()->diffForHumans(Carbon::now()->addYears(1), CarbonInterface::DIFF_ABSOLUTE));
            $this->assertSame('1 year after', Carbon::now()->diffForHumans(Carbon::now()->subYears(1), CarbonInterface::DIFF_RELATIVE_AUTO));
            $this->assertSame('1 year before', Carbon::now()->diffForHumans(Carbon::now()->addYears(1), CarbonInterface::DIFF_RELATIVE_AUTO));
            $this->assertSame('1 year from now', Carbon::now()->diffForHumans(Carbon::now()->subYears(1), CarbonInterface::DIFF_RELATIVE_TO_NOW));
            $this->assertSame('1 year ago', Carbon::now()->diffForHumans(Carbon::now()->addYears(1), CarbonInterface::DIFF_RELATIVE_TO_NOW));
            $this->assertSame('1 year after', Carbon::now()->diffForHumans(Carbon::now()->subYears(1), CarbonInterface::DIFF_RELATIVE_TO_OTHER));
            $this->assertSame('1 year before', Carbon::now()->diffForHumans(Carbon::now()->addYears(1), CarbonInterface::DIFF_RELATIVE_TO_OTHER));
            $this->assertSame('1 year', Carbon::now()->subYears(1)->diffForHumans(null, CarbonInterface::DIFF_ABSOLUTE));
            $this->assertSame('1 year', Carbon::now()->addYears(1)->diffForHumans(null, CarbonInterface::DIFF_ABSOLUTE));
            $this->assertSame('1 year ago', Carbon::now()->subYears(1)->diffForHumans(null, CarbonInterface::DIFF_RELATIVE_AUTO));
            $this->assertSame('1 year from now', Carbon::now()->addYears(1)->diffForHumans(null, CarbonInterface::DIFF_RELATIVE_AUTO));
            $this->assertSame('1 year ago', Carbon::now()->subYears(1)->diffForHumans(null, CarbonInterface::DIFF_RELATIVE_TO_NOW));
            $this->assertSame('1 year from now', Carbon::now()->addYears(1)->diffForHumans(null, CarbonInterface::DIFF_RELATIVE_TO_NOW));
            $this->assertSame('1 year before', Carbon::now()->subYears(1)->diffForHumans(null, CarbonInterface::DIFF_RELATIVE_TO_OTHER));
            $this->assertSame('1 year after', Carbon::now()->addYears(1)->diffForHumans(null, CarbonInterface::DIFF_RELATIVE_TO_OTHER));
        });
    }

    public function testDiffForHumansWithMagicMethods()
    {
        $this->wrapWithTestNow(function () {
            $this->assertSame('1 year', Carbon::now()->longAbsoluteDiffForHumans(Carbon::now()->subYears(1)->subMonth()));
            $this->assertSame('1 year 1 month', Carbon::now()->longAbsoluteDiffForHumans(2, Carbon::now()->subYears(1)->subMonth()));
            $this->assertSame('1 year 1 month', Carbon::now()->longAbsoluteDiffForHumans(Carbon::now()->subYears(1)->subMonth(), 2));
            $this->assertSame('1 year', Carbon::now()->longAbsoluteDiffForHumans(Carbon::now()->subYears(1)));
            $this->assertSame('1 year', Carbon::now()->longAbsoluteDiffForHumans(Carbon::now()->addYears(1)));
            $this->assertSame('1yr', Carbon::now()->shortAbsoluteDiffForHumans(Carbon::now()->subYears(1)));
            $this->assertSame('1yr', Carbon::now()->shortAbsoluteDiffForHumans(Carbon::now()->addYears(1)));
            $this->assertSame('1 year after', Carbon::now()->longRelativeDiffForHumans(Carbon::now()->subYears(1)));
            $this->assertSame('1 year before', Carbon::now()->longRelativeDiffForHumans(Carbon::now()->addYears(1)));
            $this->assertSame('1yr after', Carbon::now()->shortRelativeDiffForHumans(Carbon::now()->subYears(1)));
            $this->assertSame('1yr before', Carbon::now()->shortRelativeDiffForHumans(Carbon::now()->addYears(1)));
            $this->assertSame('1 year from now', Carbon::now()->longRelativeToNowDiffForHumans(Carbon::now()->subYears(1)));
            $this->assertSame('1 year ago', Carbon::now()->longRelativeToNowDiffForHumans(Carbon::now()->addYears(1)));
            $this->assertSame('1yr from now', Carbon::now()->shortRelativeToNowDiffForHumans(Carbon::now()->subYears(1)));
            $this->assertSame('1yr ago', Carbon::now()->shortRelativeToNowDiffForHumans(Carbon::now()->addYears(1)));
            $this->assertSame('1 year after', Carbon::now()->longRelativeToOtherDiffForHumans(Carbon::now()->subYears(1)));
            $this->assertSame('1 year before', Carbon::now()->longRelativeToOtherDiffForHumans(Carbon::now()->addYears(1)));
            $this->assertSame('1yr after', Carbon::now()->shortRelativeToOtherDiffForHumans(Carbon::now()->subYears(1)));
            $this->assertSame('1yr before', Carbon::now()->shortRelativeToOtherDiffForHumans(Carbon::now()->addYears(1)));
            $this->assertSame('1 year', Carbon::now()->subYears(1)->longAbsoluteDiffForHumans());
            $this->assertSame('1 year', Carbon::now()->addYears(1)->longAbsoluteDiffForHumans());
            $this->assertSame('1yr', Carbon::now()->subYears(1)->shortAbsoluteDiffForHumans());
            $this->assertSame('1yr', Carbon::now()->addYears(1)->shortAbsoluteDiffForHumans());
            $this->assertSame('1 year ago', Carbon::now()->subYears(1)->longRelativeDiffForHumans());
            $this->assertSame('1 year from now', Carbon::now()->addYears(1)->longRelativeDiffForHumans());
            $this->assertSame('1yr ago', Carbon::now()->subYears(1)->shortRelativeDiffForHumans());
            $this->assertSame('1yr from now', Carbon::now()->addYears(1)->shortRelativeDiffForHumans());
            $this->assertSame('1 year ago', Carbon::now()->subYears(1)->longRelativeToNowDiffForHumans());
            $this->assertSame('1 year from now', Carbon::now()->addYears(1)->longRelativeToNowDiffForHumans());
            $this->assertSame('1yr ago', Carbon::now()->subYears(1)->shortRelativeToNowDiffForHumans());
            $this->assertSame('1yr from now', Carbon::now()->addYears(1)->shortRelativeToNowDiffForHumans());
            $this->assertSame('1 year before', Carbon::now()->subYears(1)->longRelativeToOtherDiffForHumans());
            $this->assertSame('1 year after', Carbon::now()->addYears(1)->longRelativeToOtherDiffForHumans());
            $this->assertSame('1yr before', Carbon::now()->subYears(1)->shortRelativeToOtherDiffForHumans());
            $this->assertSame('1yr after', Carbon::now()->addYears(1)->shortRelativeToOtherDiffForHumans());
        });
    }

    public function testDiffForHumansWithShorterMonthShouldStillBeAMonth()
    {
        $feb15 = Carbon::parse('2015-02-15');
        $mar15 = Carbon::parse('2015-03-15');
        $this->assertSame('1 month after', $mar15->diffForHumans($feb15));
    }

    public function testDiffForHumansWithDateTimeInstance()
    {
        $feb15 = new DateTime('2015-02-15');
        $mar15 = Carbon::parse('2015-03-15');
        $this->assertSame('1 month after', $mar15->diffForHumans($feb15));
    }

    public function testDiffForHumansWithDateString()
    {
        $mar13 = Carbon::parse('2018-03-13');
        $this->assertSame('1 month before', $mar13->diffForHumans('2018-04-13'));
    }

    public function testDiffForHumansWithDateTimeString()
    {
        $mar13 = Carbon::parse('2018-03-13');
        $this->assertSame('1 month before', $mar13->diffForHumans('2018-04-13 08:00:00'));
    }

    public function testDiffWithString()
    {
        $dt1 = Carbon::createFromDate(2000, 1, 25)->endOfDay();

        $this->assertSame(383, $dt1->diffInHours('2000-01-10'));
    }

    public function testDiffWithDateTime()
    {
        $dt1 = Carbon::createFromDate(2000, 1, 25)->endOfDay();
        $dt2 = new DateTime('2000-01-10');

        $this->assertSame(383, $dt1->diffInHours($dt2));
    }

    public function testDiffOptions()
    {
        $this->assertSame(1, Carbon::NO_ZERO_DIFF);
        $this->assertSame(2, Carbon::JUST_NOW);
        $this->assertSame(4, Carbon::ONE_DAY_WORDS);
        $this->assertSame(8, Carbon::TWO_DAY_WORDS);

        $options = Carbon::getHumanDiffOptions();
        $this->assertSame(1, $options);

        $date = Carbon::create(2018, 3, 12, 2, 5, 6, 'UTC');
        $this->assertSame('1 second before', $date->diffForHumans($date));

        Carbon::setHumanDiffOptions(0);
        $this->assertSame(0, Carbon::getHumanDiffOptions());

        $this->assertSame('0 seconds before', $date->diffForHumans($date));

        Carbon::setLocale('fr');
        $this->assertSame('0 seconde avant', $date->diffForHumans($date));

        Carbon::setLocale('en');
        Carbon::setHumanDiffOptions(Carbon::JUST_NOW);
        $this->assertSame(2, Carbon::getHumanDiffOptions());
        $this->assertSame('0 seconds before', $date->diffForHumans($date));
        $this->assertSame('just now', Carbon::now()->diffForHumans());

        Carbon::setHumanDiffOptions(Carbon::ONE_DAY_WORDS | Carbon::TWO_DAY_WORDS | Carbon::NO_ZERO_DIFF);
        $this->assertSame(13, Carbon::getHumanDiffOptions());

        $oneDayAfter = Carbon::create(2018, 3, 13, 2, 5, 6, 'UTC');
        $oneDayBefore = Carbon::create(2018, 3, 11, 2, 5, 6, 'UTC');
        $twoDayAfter = Carbon::create(2018, 3, 14, 2, 5, 6, 'UTC');
        $twoDayBefore = Carbon::create(2018, 3, 10, 2, 5, 6, 'UTC');

        $this->assertSame('1 day after', $oneDayAfter->diffForHumans($date));
        $this->assertSame('1 day before', $oneDayBefore->diffForHumans($date));
        $this->assertSame('2 days after', $twoDayAfter->diffForHumans($date));
        $this->assertSame('2 days before', $twoDayBefore->diffForHumans($date));

        $this->assertSame('tomorrow', Carbon::now()->addDay()->diffForHumans());
        $this->assertSame('yesterday', Carbon::now()->subDay()->diffForHumans());
        $this->assertSame('after tomorrow', Carbon::now()->addDays(2)->diffForHumans());
        $this->assertSame('before yesterday', Carbon::now()->subDays(2)->diffForHumans());

        Carbon::disableHumanDiffOption(Carbon::TWO_DAY_WORDS);
        $this->assertSame(5, Carbon::getHumanDiffOptions());
        Carbon::disableHumanDiffOption(Carbon::TWO_DAY_WORDS);
        $this->assertSame(5, Carbon::getHumanDiffOptions());

        $this->assertSame('tomorrow', Carbon::now()->addDay()->diffForHumans());
        $this->assertSame('yesterday', Carbon::now()->subDay()->diffForHumans());
        $this->assertSame('2 days from now', Carbon::now()->addDays(2)->diffForHumans());
        $this->assertSame('2 days ago', Carbon::now()->subDays(2)->diffForHumans());

        Carbon::enableHumanDiffOption(Carbon::JUST_NOW);
        $this->assertSame(7, Carbon::getHumanDiffOptions());
        Carbon::enableHumanDiffOption(Carbon::JUST_NOW);
        $this->assertSame(7, Carbon::getHumanDiffOptions());

        Carbon::setHumanDiffOptions($options);
    }

    public function testDiffForHumansArrayParameter()
    {
        Carbon::setTestNow('2000-01-01 00:00:00');
        $date = Carbon::now()->subtract('2 days, 3 hours and 40 minutes');
        $this->assertSame('2 days ago', $date->diffForHumans([
            'parts' => 1,
            'join' => true,
        ]));
        $this->assertSame('2 days and 3 hours ago', $date->diffForHumans([
            'parts' => 2,
            'join' => true,
        ]));
        $this->assertSame('hace 2 días y 3 horas', $date->copy()->locale('es')->diffForHumans([
            'parts' => 2,
            'join' => true,
        ]));
        $this->assertSame('2 days, 3 hours and 40 minutes ago', $date->diffForHumans([
            'parts' => -1,
            'join' => true,
        ]));
        $this->assertSame('3 days, 3 hours and 40 minutes before', $date->diffForHumans(Carbon::now()->addDay(), [
            'parts' => -1,
            'join' => true,
        ]));
        $this->assertSame('3 days, 3 hours and 40 minutes before', $date->diffForHumans([
            'other' => Carbon::now()->addDay(),
            'parts' => -1,
            'join' => true,
        ]));
        $this->assertSame('2 days, 3 hours ago', $date->diffForHumans([
            'parts' => 2,
            'join' => ', ',
        ]));
        $this->assertSame('2d, 3h ago', $date->diffForHumans([
            'parts' => 2,
            'join' => ', ',
            'short' => true,
        ]));
        $this->assertSame('2 days, 3 hours before', $date->diffForHumans([
            'parts' => 2,
            'join' => ', ',
            'syntax' => CarbonInterface::DIFF_RELATIVE_TO_OTHER,
        ]));
        $this->assertSame('yesterday', Carbon::yesterday()->diffForHumans([
            'options' => CarbonInterface::ONE_DAY_WORDS,
        ]));
        $this->assertSame('1 day ago', Carbon::yesterday()->diffForHumans([
            'options' => 0,
        ]));
    }

    public function testFromNow()
    {
        Carbon::setLocale('en');
        $this->assertSame('2 days from now', Carbon::now('UTC')->addDays(2)->fromNow());
        Carbon::setLocale('fr');
        $this->assertSame('dans 2 jours', Carbon::now('UTC')->addDays(2)->fromNow());
        Carbon::setLocale('en');
        $this->assertSame('2 days after', Carbon::now('UTC')->addDays(2)->fromNow(CarbonInterface::DIFF_RELATIVE_TO_OTHER));
        $this->assertSame('2d from now', Carbon::now('UTC')->addDays(2)->addHours(5)->fromNow(null, true));
        $this->assertSame('2 days 5 hours', Carbon::now('UTC')->addDays(2)->addHours(5)->fromNow(true, false, 2));
    }

    public function testFromNowBackwardCompatibleSyntax()
    {
        $date = Carbon::parse('-5 days');
        $this->assertSame('5 days', $date->fromNow(Carbon::now(), true));

        $date = Carbon::parse('+5 days');
        $this->assertSame('5 days', $date->fromNow(Carbon::now(), true));
    }

    public function testFrom()
    {
        Carbon::setLocale('en');
        $this->assertSame('2 days from now', Carbon::now()->addDays(2)->from());
        $this->assertSame('2 days from now', Carbon::now()->addDays(2)->from(null));
        $this->assertSame('2 days after', Carbon::now()->addDay()->from(Carbon::now()->subDay()));
        Carbon::setLocale('fr');
        $this->assertSame('2 jours après', Carbon::now()->addDay()->from(Carbon::now()->subDay()));
        Carbon::setLocale('en');
        $this->assertSame('2 days from now', Carbon::now()->addDay()->from(Carbon::now()->subDay(), CarbonInterface::DIFF_RELATIVE_TO_NOW));
        $this->assertSame('2d after', Carbon::now()->addDay()->addHours(5)->from(Carbon::now()->subDay(), null, true));
        $this->assertSame('2 days 5 hours', Carbon::now()->addDay()->addHours(5)->from(Carbon::now()->subDay(), true, false, 2));
    }

    public function testSince()
    {
        Carbon::setLocale('en');
        $this->assertSame('2 days from now', Carbon::now()->addDays(2)->since());
        $this->assertSame('2 days from now', Carbon::now()->addDays(2)->since(null));
        $this->assertSame('2 days after', Carbon::now()->addDay()->since(Carbon::now()->subDay()));
        Carbon::setLocale('fr');
        $this->assertSame('2 jours après', Carbon::now()->addDay()->since(Carbon::now()->subDay()));
        Carbon::setLocale('en');
        $this->assertSame('2 days from now', Carbon::now()->addDay()->since(Carbon::now()->subDay(), CarbonInterface::DIFF_RELATIVE_TO_NOW));
        $this->assertSame('2d after', Carbon::now()->addDay()->addHours(5)->since(Carbon::now()->subDay(), null, true));
        $this->assertSame('2 days 5 hours', Carbon::now()->addDay()->addHours(5)->since(Carbon::now()->subDay(), true, false, 2));
    }

    public function testToNow()
    {
        Carbon::setLocale('en');
        $this->assertSame('2 days ago', Carbon::now('UTC')->addDays(2)->toNow());
        Carbon::setLocale('fr');
        $this->assertSame('il y a 2 jours', Carbon::now('UTC')->addDays(2)->toNow());
        Carbon::setLocale('en');
        $this->assertSame('2 days before', Carbon::now('UTC')->addDays(2)->toNow(CarbonInterface::DIFF_RELATIVE_TO_OTHER));
        $this->assertSame('2d ago', Carbon::now('UTC')->addDays(2)->addHours(5)->toNow(null, true));
        $this->assertSame('2 days 5 hours', Carbon::now('UTC')->addDays(2)->addHours(5)->toNow(true, false, 2));
    }

    public function testTo()
    {
        Carbon::setLocale('en');
        $this->assertSame('2 days ago', Carbon::now()->addDays(2)->to());
        $this->assertSame('2 days ago', Carbon::now()->addDays(2)->to(null));
        $this->assertSame('2 days before', Carbon::now()->addDay()->to(Carbon::now()->subDay()));
        Carbon::setLocale('fr');
        $this->assertSame('2 jours avant', Carbon::now()->addDay()->to(Carbon::now()->subDay()));
        Carbon::setLocale('en');
        $this->assertSame('2 days ago', Carbon::now()->addDay()->to(Carbon::now()->subDay(), CarbonInterface::DIFF_RELATIVE_TO_NOW));
        $this->assertSame('2d before', Carbon::now()->addDay()->addHours(5)->to(Carbon::now()->subDay(), null, true));
        $this->assertSame('2 days 5 hours', Carbon::now()->addDay()->addHours(5)->to(Carbon::now()->subDay(), true, false, 2));
    }

    public function testUntil()
    {
        Carbon::setLocale('en');
        $this->assertSame('2 days ago', Carbon::now()->addDays(2)->until());
        $this->assertSame('2 days ago', Carbon::now()->addDays(2)->until(null));
        $this->assertSame('2 days before', Carbon::now()->addDay()->until(Carbon::now()->subDay()));
        Carbon::setLocale('fr');
        $this->assertSame('2 jours avant', Carbon::now()->addDay()->until(Carbon::now()->subDay()));
        Carbon::setLocale('en');
        $this->assertSame('2 days ago', Carbon::now()->addDay()->until(Carbon::now()->subDay(), CarbonInterface::DIFF_RELATIVE_TO_NOW));
        $this->assertSame('2d before', Carbon::now()->addDay()->addHours(5)->until(Carbon::now()->subDay(), null, true));
        $this->assertSame('2 days 5 hours', Carbon::now()->addDay()->addHours(5)->until(Carbon::now()->subDay(), true, false, 2));
    }

    public function testDiffWithInvalidType()
    {
        $this->expectExceptionObject(new InvalidArgumentException(
            'Expected null, string, DateTime or DateTimeInterface, integer given'
        ));

        Carbon::createFromDate(2000, 1, 25)->diffInHours(10);
    }

    public function testDiffWithInvalidObject()
    {
        $this->expectExceptionObject(new InvalidArgumentException(
            'Expected null, string, DateTime or DateTimeInterface, Carbon\CarbonInterval given'
        ));

        Carbon::createFromDate(2000, 1, 25)->diffInHours(new CarbonInterval());
    }

    public function testDiffForHumansWithIncorrectDateTimeStringWhichIsNotACarbonInstance()
    {
        $this->expectExceptionObject(new InvalidFormatException(
            'Failed to parse time string (2018-04-13---08:00:00) at position 10'
        ));

        $mar13 = Carbon::parse('2018-03-13');
        $mar13->diffForHumans('2018-04-13---08:00:00');
    }

    /**
     * @group issue1490
     */
    public function testFloatDiff()
    {
        date_default_timezone_set('UTC');

        $this->assertSame(8986.665965, Carbon::parse('2018-03-31 23:55:12.321456')->floatDiffInSeconds(Carbon::parse('2018-04-01 02:24:58.987421')));

        $this->assertSame(1.0006944444444443, Carbon::parse('2018-12-01 00:00')->floatDiffInDays(Carbon::parse('2018-12-02 00:01')));
        $this->assertSame(1.0006944444444443 / 7, Carbon::parse('2018-12-01 00:00')->floatDiffInWeeks(Carbon::parse('2018-12-02 00:01')));

        $this->assertSame(0.9714742503779745, Carbon::parse('2018-03-13 20:55:12.321456')->floatDiffInMonths(Carbon::parse('2018-04-12 14:24:58.987421')));
        $this->assertSame(1.1724137931034484, Carbon::parse('2000-01-15 00:00')->floatDiffInMonths(Carbon::parse('2000-02-20 00:00')));
        $this->assertSame(1.1724137931034484, Carbon::parse('2000-01-15 00:00')->floatDiffInMonths('2000-02-20 00:00'));
        $this->assertSame(11.951612903225806, Carbon::parse('2018-12-16 00:00')->floatDiffInMonths('2019-12-15 00:00'));
        $this->assertSame(0.9714742503779745, Carbon::parse('2018-04-12 14:24:58.987421')->floatDiffInMonths(Carbon::parse('2018-03-13 20:55:12.321456')));
        $this->assertSame(0.9714742503779745, Carbon::parse('2018-03-13 20:55:12.321456')->floatDiffInMonths(Carbon::parse('2018-04-12 14:24:58.987421'), false));
        $this->assertSame(-0.9714742503779745, Carbon::parse('2018-04-12 14:24:58.987421')->floatDiffInMonths(Carbon::parse('2018-03-13 20:55:12.321456'), false));

        $this->assertSame(16.557633744585264, Carbon::parse('2018-02-13 20:55:12.321456')->floatDiffInMonths(Carbon::parse('2019-06-30 14:24:58.987421')));

        $this->assertSame(15.971474250377973, Carbon::parse('2018-02-13 20:55:12.321456')->floatDiffInMonths(Carbon::parse('2019-06-12 14:24:58.987421')));
        $this->assertSame(15.971474250377973, Carbon::parse('2019-06-12 14:24:58.987421')->floatDiffInMonths(Carbon::parse('2018-02-13 20:55:12.321456')));
        $this->assertSame(15.971474250377973, Carbon::parse('2018-02-13 20:55:12.321456')->floatDiffInMonths(Carbon::parse('2019-06-12 14:24:58.987421'), false));
        $this->assertSame(-15.971474250377973, Carbon::parse('2019-06-12 14:24:58.987421')->floatDiffInMonths(Carbon::parse('2018-02-13 20:55:12.321456'), false));

        $this->assertSame(1, Carbon::parse('2018-02-13 20:55:12.321456')->floatDiffInYears(Carbon::parse('2019-02-13 20:55:12.321456')));
        $this->assertSame(1.3746000338015283, Carbon::parse('2018-02-13 20:55:12.321456')->floatDiffInYears(Carbon::parse('2019-06-30 14:24:58.987421')));
        $this->assertSame(0.9609014036645421, Carbon::parse('2018-02-13 20:55:12.321456')->floatDiffInYears(Carbon::parse('2019-01-30 14:24:58.987421')));

        $this->assertSame(1.3252849653083778, Carbon::parse('2018-02-13 20:55:12.321456')->floatDiffInYears(Carbon::parse('2019-06-12 14:24:58.987421')));
        $this->assertSame(1.3252849653083778, Carbon::parse('2019-06-12 14:24:58.987421')->floatDiffInYears(Carbon::parse('2018-02-13 20:55:12.321456')));
        $this->assertSame(1.3252849653083778, Carbon::parse('2018-02-13 20:55:12.321456')->floatDiffInYears(Carbon::parse('2019-06-12 14:24:58.987421'), false));
        $this->assertSame(-1.3252849653083778, Carbon::parse('2019-06-12 14:24:58.987421')->floatDiffInYears(Carbon::parse('2018-02-13 20:55:12.321456'), false));

        $this->assertSame(5.325284965308378, Carbon::parse('2018-02-13 20:55:12.321456')->floatDiffInYears(Carbon::parse('2023-06-12 14:24:58.987421')));
        $this->assertSame(5.325284965308378, Carbon::parse('2023-06-12 14:24:58.987421')->floatDiffInYears(Carbon::parse('2018-02-13 20:55:12.321456')));
        $this->assertSame(5.325284965308378, Carbon::parse('2018-02-13 20:55:12.321456')->floatDiffInYears(Carbon::parse('2023-06-12 14:24:58.987421'), false));
        $this->assertSame(-5.325284965308378, Carbon::parse('2023-06-12 14:24:58.987421')->floatDiffInYears(Carbon::parse('2018-02-13 20:55:12.321456'), false));

        $this->assertSame(1, Carbon::parse('2018-10-01 00:00:00', 'Europe/Paris')->floatDiffInMonths(Carbon::parse('2018-11-01 00:00:00', 'Europe/Paris')));
        $this->assertSame(1, Carbon::parse('2018-10-28 00:00:00')->floatDiffInMonths(Carbon::parse('2018-11-28 00:00:00')));
        $this->assertSame(1, Carbon::parse('2018-10-28 00:00:00', 'Europe/Paris')->floatDiffInMonths(Carbon::parse('2018-11-28 00:00:00', 'Europe/Paris')));

        $this->assertSame(-1, Carbon::parse('2018-11-01 00:00:00', 'Europe/Paris')->floatDiffInMonths(Carbon::parse('2018-10-01 00:00:00', 'Europe/Paris'), false));
        $this->assertSame(-1, Carbon::parse('2018-11-28 00:00:00')->floatDiffInMonths(Carbon::parse('2018-10-28 00:00:00'), false));
        $this->assertSame(-1, Carbon::parse('2018-11-28 00:00:00', 'Europe/Paris')->floatDiffInMonths(Carbon::parse('2018-10-28 00:00:00', 'Europe/Paris'), false));

        if (version_compare(PHP_VERSION, '7.2.0-dev', '>=')) {
            $this->assertEqualsWithDelta(0.9999999999884259, Carbon::parse('2020-12-17 00:00:00.000001')->floatDiffInDays('2020-12-16 00:00:00.000002'), 0.0000000001);
        }
    }

    public function testDiffDayMinusOneMicrosecond()
    {
        if (version_compare(PHP_VERSION, '7.2.0-dev', '<')) {
            $this->markTestSkipped('PHP 7.1 return incorrect value for this case');
        }

        $now = new Carbon('2019-07-29 14:02:54.000000 UTC');
        $then1 = new Carbon('2019-07-28 14:02:54.000001 UTC');
        $then2 = new Carbon('2019-07-27 14:02:54.000001 UTC');

        $this->assertEqualsWithDelta(-0.99999999998843, $now->floatDiffInDays($then1, false), 0.001);
        $this->assertEqualsWithDelta(-1.99999999998843, $now->floatDiffInDays($then2, false), 0.001);
        $this->assertSame(0, $now->diffInDays($then1, false));
        $this->assertSame(-1, $now->diffInDays($then2, false));

        $this->assertSame(
            6.99999273113426,
            Carbon::parse('2022-01-04 13:32:30.628030')->floatDiffInDays('2022-01-11 13:32:30.000000')
        );
        $this->assertSame(
            6.999734949884259,
            Carbon::parse('2022-01-04 13:32:52.900330')->floatDiffInDays('2022-01-11 13:32:30.000000')
        );
    }

    public function testFloatDiffWithRealUnits()
    {
        $from = Carbon::parse('2021-03-27 20:00 Europe/Warsaw');
        $to = Carbon::parse('2021-03-27 20:00 Europe/London');
        $from->floatDiffInRealDays($to);

        $this->assertSame('2021-03-27 20:00:00 Europe/Warsaw', $from->format('Y-m-d H:i:s e'));
        $this->assertSame('2021-03-27 20:00:00 Europe/London', $to->format('Y-m-d H:i:s e'));

        date_default_timezone_set('UTC');

        $this->assertEqualsWithDelta(0.9583333333333335, Carbon::parse('2021-03-27 20:00 Europe/Warsaw')->floatDiffInRealDays('2021-03-28 20:00'), 0.0000000001);
        $this->assertEqualsWithDelta(1.9583333333333335, Carbon::parse('2021-03-26 20:00 Europe/Warsaw')->floatDiffInRealDays('2021-03-28 20:00'), 0.0000000001);
        $this->assertEqualsWithDelta(1.9583333333333335, Carbon::parse('2021-03-27 20:00 Europe/Warsaw')->floatDiffInRealDays('2021-03-29 20:00'), 0.0000000001);
        $this->assertEqualsWithDelta(1.0416666666666667, Carbon::parse('2021-10-30 20:00 Europe/Warsaw')->floatDiffInRealDays('2021-10-31 20:00'), 0.0000000001);

        $this->assertEqualsWithDelta(1.0006944444444443, Carbon::parse('2018-12-01 00:00')->floatDiffInRealDays(Carbon::parse('2018-12-02 00:01')), 0.0000000001);
        $this->assertEqualsWithDelta(1.0006944444444443 / 7, Carbon::parse('2018-12-01 00:00')->floatDiffInRealWeeks(Carbon::parse('2018-12-02 00:01')), 0.0000000001);

        $this->assertEqualsWithDelta(0.9714742503779745, Carbon::parse('2018-03-13 20:55:12.321456')->floatDiffInRealMonths(Carbon::parse('2018-04-12 14:24:58.987421')), 0.0000000001);
        $this->assertEqualsWithDelta(0.9714742503779745, Carbon::parse('2018-04-12 14:24:58.987421')->floatDiffInRealMonths(Carbon::parse('2018-03-13 20:55:12.321456')), 0.0000000001);
        $this->assertEqualsWithDelta(0.9714742503779745, Carbon::parse('2018-03-13 20:55:12.321456')->floatDiffInRealMonths(Carbon::parse('2018-04-12 14:24:58.987421'), false), 0.0000000001);
        $this->assertEqualsWithDelta(-0.9714742503779745, Carbon::parse('2018-04-12 14:24:58.987421')->floatDiffInRealMonths(Carbon::parse('2018-03-13 20:55:12.321456'), false), 0.0000000001);

        $this->assertEqualsWithDelta(16.557633744585264, Carbon::parse('2018-02-13 20:55:12.321456')->floatDiffInRealMonths(Carbon::parse('2019-06-30 14:24:58.987421')), 0.0000000001);

        $this->assertEqualsWithDelta(15.971474250377973, Carbon::parse('2018-02-13 20:55:12.321456')->floatDiffInRealMonths(Carbon::parse('2019-06-12 14:24:58.987421')), 0.0000000001);
        $this->assertEqualsWithDelta(15.971474250377973, Carbon::parse('2019-06-12 14:24:58.987421')->floatDiffInRealMonths(Carbon::parse('2018-02-13 20:55:12.321456')), 0.0000000001);
        $this->assertEqualsWithDelta(15.971474250377973, Carbon::parse('2018-02-13 20:55:12.321456')->floatDiffInRealMonths(Carbon::parse('2019-06-12 14:24:58.987421'), false), 0.0000000001);
        $this->assertEqualsWithDelta(-15.971474250377973, Carbon::parse('2019-06-12 14:24:58.987421')->floatDiffInRealMonths(Carbon::parse('2018-02-13 20:55:12.321456'), false), 0.0000000001);

        $this->assertEqualsWithDelta(1, Carbon::parse('2018-02-13 20:55:12.321456')->floatDiffInRealYears(Carbon::parse('2019-02-13 20:55:12.321456')), 0.0000000001);
        $this->assertEqualsWithDelta(1.3746000338015283, Carbon::parse('2018-02-13 20:55:12.321456')->floatDiffInRealYears(Carbon::parse('2019-06-30 14:24:58.987421')), 0.0000000001);
        $this->assertEqualsWithDelta(0.9609014036645421, Carbon::parse('2018-02-13 20:55:12.321456')->floatDiffInRealYears(Carbon::parse('2019-01-30 14:24:58.987421')), 0.0000000001);

        $this->assertEqualsWithDelta(1.3252849653083778, Carbon::parse('2018-02-13 20:55:12.321456')->floatDiffInRealYears(Carbon::parse('2019-06-12 14:24:58.987421')), 0.0000000001);
        $this->assertEqualsWithDelta(1.3252849653083778, Carbon::parse('2019-06-12 14:24:58.987421')->floatDiffInRealYears(Carbon::parse('2018-02-13 20:55:12.321456')), 0.0000000001);
        $this->assertEqualsWithDelta(1.3252849653083778, Carbon::parse('2018-02-13 20:55:12.321456')->floatDiffInRealYears(Carbon::parse('2019-06-12 14:24:58.987421'), false), 0.0000000001);
        $this->assertEqualsWithDelta(-1.3252849653083778, Carbon::parse('2019-06-12 14:24:58.987421')->floatDiffInRealYears(Carbon::parse('2018-02-13 20:55:12.321456'), false), 0.0000000001);

        $this->assertEqualsWithDelta(5.325284965308378, Carbon::parse('2018-02-13 20:55:12.321456')->floatDiffInRealYears(Carbon::parse('2023-06-12 14:24:58.987421')), 0.0000000001);
        $this->assertEqualsWithDelta(5.325284965308378, Carbon::parse('2023-06-12 14:24:58.987421')->floatDiffInRealYears(Carbon::parse('2018-02-13 20:55:12.321456')), 0.0000000001);
        $this->assertEqualsWithDelta(5.325284965308378, Carbon::parse('2018-02-13 20:55:12.321456')->floatDiffInRealYears(Carbon::parse('2023-06-12 14:24:58.987421'), false), 0.0000000001);
        $this->assertEqualsWithDelta(-5.325284965308378, Carbon::parse('2023-06-12 14:24:58.987421')->floatDiffInRealYears(Carbon::parse('2018-02-13 20:55:12.321456'), false), 0.0000000001);

        $this->assertSame(1, Carbon::parse('2018-10-01 00:00:00', 'Europe/Paris')->floatDiffInRealMonths(Carbon::parse('2018-11-01 00:00:00', 'Europe/Paris')));
        $this->assertSame(1, Carbon::parse('2018-10-28 00:00:00')->floatDiffInRealMonths(Carbon::parse('2018-11-28 00:00:00')));
        $this->assertSame(1, Carbon::parse('2018-10-28 00:00:00', 'Europe/Paris')->floatDiffInRealMonths(Carbon::parse('2018-11-28 00:00:00', 'Europe/Paris')));

        $this->assertSame(-1, Carbon::parse('2018-11-01 00:00:00', 'Europe/Paris')->floatDiffInRealMonths(Carbon::parse('2018-10-01 00:00:00', 'Europe/Paris'), false));
        $this->assertSame(-1, Carbon::parse('2018-11-28 00:00:00')->floatDiffInRealMonths(Carbon::parse('2018-10-28 00:00:00'), false));
        $this->assertSame(-1, Carbon::parse('2018-11-28 00:00:00', 'Europe/Paris')->floatDiffInRealMonths(Carbon::parse('2018-10-28 00:00:00', 'Europe/Paris'), false));

        Carbon::setTestNow('2021-03-28 20:00 Europe/Warsaw');
        $this->assertEqualsWithDelta(0.9583333333333335, Carbon::parse('2021-03-27 20:00 Europe/Warsaw')->floatDiffInRealDays(), 0.0000000001);
    }

    /**
     * https://bugs.php.net/bug.php?id=77007
     * https://github.com/briannesbitt/Carbon/issues/1503
     */
    public function testPhpBug77007()
    {
        $this->assertSame(3, Carbon::now()->addMinutes(3)->diffInMinutes());

        $startDate = Carbon::parse('2018-10-11 20:59:06.914653');
        $endDate = Carbon::parse('2018-10-11 20:59:07.237419');

        $this->assertSame(0, $startDate->diffInSeconds($endDate));

        $startDate = Carbon::parse('2018-10-11 20:59:06.914653');
        $endDate = Carbon::parse('2018-10-11 20:59:07.237419');

        $this->assertSame('+ 00-00-00 00:00:00.322766', $startDate->diffAsCarbonInterval($endDate)->format('%R %Y-%M-%D %H:%I:%S.%F'));
        $this->assertSame(0, $startDate->diffInSeconds($endDate));

        $startDate = Carbon::parse('2018-10-11 20:59:06.914653');
        $endDate = Carbon::parse('2018-10-11 20:59:05.237419');

        $this->assertSame('+ 00-00-00 00:00:01.677234', $startDate->diffAsCarbonInterval($endDate)->format('%R %Y-%M-%D %H:%I:%S.%F'));
        $this->assertSame(1, $startDate->diffInSeconds($endDate));

        $this->assertSame('- 00-00-00 00:00:01.677234', $startDate->diffAsCarbonInterval($endDate, false)->format('%R %Y-%M-%D %H:%I:%S.%F'));
        $this->assertSame(-1, $startDate->diffInSeconds($endDate, false));

        $startDate = Carbon::parse('2018-10-11 20:59:06.914653');
        $endDate = Carbon::parse('2018-10-11 20:59:06.237419');

        $this->assertSame('+ 00-00-00 00:00:00.677234', $startDate->diffAsCarbonInterval($endDate)->format('%R %Y-%M-%D %H:%I:%S.%F'));
        $this->assertSame(0, $startDate->diffInSeconds($endDate));

        $this->assertSame('- 00-00-00 00:00:00.677234', $startDate->diffAsCarbonInterval($endDate, false)->format('%R %Y-%M-%D %H:%I:%S.%F'));
        $this->assertSame(0, $startDate->diffInSeconds($endDate, false));

        $startDate = Carbon::parse('2017-12-31 23:59:59.914653');
        $endDate = Carbon::parse('2018-01-01 00:00:00.237419');

        $this->assertSame('+ 00-00-00 00:00:00.322766', $startDate->diffAsCarbonInterval($endDate)->format('%R %Y-%M-%D %H:%I:%S.%F'));
        $this->assertSame(0, $startDate->diffInSeconds($endDate));
    }

    public function testPHPBug80974()
    {
        $this->assertSame(3, Carbon::parse('2018-07-01 America/Toronto')->diff('2018-07-02 America/Vancouver')->h);
        $this->assertSame(0, Carbon::parse('2018-07-01')->utc()->diff('2018-07-02')->days);
        $this->assertSame(1, Carbon::parse('2018-07-01')->utc()->diff(Carbon::parse('2018-07-02'))->days);
        $this->assertSame(1, Carbon::parse('2018-07-01')->diff(Carbon::parse('2018-07-02')->utc())->days);
    }

    public function testDiffWithZeroAndNonZeroMicroseconds()
    {
        $requestTime = new Carbon('2018-11-14 18:23:12.0 +00:00');
        $serverTime = new Carbon('2018-11-14 18:23:12.307628 +00:00');

        $this->assertSame(0, $serverTime->diffInSeconds($requestTime));

        $requestTime = new Carbon('2019-02-10 18:23:12.0 +00:00');
        $serverTime = new Carbon('2019-02-10 18:23:12.307628 +00:00');

        $this->assertSame(0, $serverTime->diffInSeconds($requestTime));
    }

    public function testNearlyFullDayDiffInSeconds()
    {
        $d1 = Carbon::parse('2019-06-15 12:34:56.123456');
        $d2 = Carbon::parse('2019-06-16 12:34:56.123455');

        // Due to https://bugs.php.net/bug.php?id=77007, this changed in 7.2.12:
        $expected = version_compare(PHP_VERSION, '7.2.12-dev', '<')
            ? 86400 // Bad rounding before PHP 7.2.12
            : 86399; // Exact result since PHP 7.2.12

        $this->assertSame($expected, $d2->diffInSeconds($d1));
    }

    public function testNearlyFullDayDiffInMicroseconds()
    {
        $d1 = Carbon::parse('2019-06-15 12:34:56.123456');
        $d2 = Carbon::parse('2019-06-16 12:34:56.123455');

        $this->assertSame(86399999999, $d2->diffInMicroseconds($d1));
    }

    public function testExactMonthDiffInSeconds()
    {
        $d1 = Carbon::make('2019-01-23 12:00:00');
        $d2 = Carbon::make('2019-02-23 12:00:00');

        $this->assertSame(2678400, $d2->diffInSeconds($d1));
    }

    public function testDaysDiffPreservation()
    {
        $deletedDate = Carbon::now()->startOfDay()->addDays(31);

        $this->assertSame('31 days', $deletedDate->diffForHumans(Carbon::now()->startOfDay(), [
            'syntax' => CarbonInterface::DIFF_ABSOLUTE,
            'skip' => ['m', 'w'],
            'minimumUnit' => 'd',
        ]));

        $this->assertSame('31 days', $deletedDate->diffForHumans(Carbon::now()->startOfDay()->subHours(5), [
            'syntax' => CarbonInterface::DIFF_ABSOLUTE,
            'skip' => ['m', 'w'],
            'minimumUnit' => 'd',
        ]));

        $this->assertSame('30 days', $deletedDate->diffForHumans(Carbon::now()->startOfDay()->addHours(5), [
            'syntax' => CarbonInterface::DIFF_ABSOLUTE,
            'skip' => ['m', 'w'],
            'minimumUnit' => 'd',
        ]));
    }
}
