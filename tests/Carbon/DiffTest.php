<?php

namespace Tests\Carbon;

/*
 * This file is part of the Carbon package.
 *
 * (c) Brian Nesbitt <brian@nesbot.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Carbon\Carbon;
use Carbon\CarbonInterval;
use Closure;
use Tests\AbstractTestCase;

class DiffTest extends AbstractTestCase
{
    protected function wrapWithTestNow(Closure $func, Carbon $dt = null)
    {
        parent::wrapWithTestNow($func, ($dt === null) ? Carbon::createFromDate(2012, 1, 1) : $dt);
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
        $scope = $this;
        $this->wrapWithTestNow(function () use ($scope) {
            $scope->assertSame(1, Carbon::now()->subYear()->diffInYears());
        });
    }

    public function testDiffInYearsEnsureIsTruncated()
    {
        $dt = Carbon::createFromDate(2000, 1, 1);
        $this->assertSame(1, $dt->diffInYears($dt->copy()->addYear()->addMonths(7)));
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

    public function testDiffInMonthsNegativeNoSign()
    {
        $dt = Carbon::createFromDate(2000, 1, 1);
        $this->assertSame(11, $dt->diffInMonths($dt->copy()->subYear()->addMonth()));
    }

    public function testDiffInMonthsVsDefaultNow()
    {
        $scope = $this;
        $this->wrapWithTestNow(function () use ($scope) {
            $scope->assertSame(12, Carbon::now()->subYear()->diffInMonths());
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
        $scope = $this;
        $this->wrapWithTestNow(function () use ($scope) {
            $scope->assertSame(7, Carbon::now()->subWeek()->diffInDays());
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
            return ($date->hour > 8 && $date->hour < 17);
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

    public function testDiffInWeekdaysPositive()
    {
        $dt = Carbon::createFromDate(2000, 1, 1);
        $this->assertSame(21, $dt->diffInWeekdays($dt->copy()->endOfMonth()));
    }

    public function testDiffInWeekdaysNegativeNoSign()
    {
        $dt = Carbon::createFromDate(2000, 1, 31);
        $this->assertSame(21, $dt->diffInWeekdays($dt->copy()->startOfMonth()));
    }

    public function testDiffInWeekdaysNegativeWithSign()
    {
        $dt = Carbon::createFromDate(2000, 1, 31);
        $this->assertSame(-21, $dt->diffInWeekdays($dt->copy()->startOfMonth(), false));
    }

    public function testDiffInWeekendDaysPositive()
    {
        $dt = Carbon::createFromDate(2000, 1, 1);
        $this->assertSame(10, $dt->diffInWeekendDays($dt->copy()->endOfMonth()));
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
        $scope = $this;
        $this->wrapWithTestNow(function () use ($scope) {
            $scope->assertSame(1, Carbon::now()->subWeek()->diffInWeeks());
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
        $scope = $this;
        $this->wrapWithTestNow(function () use ($scope) {
            $scope->assertSame(48, Carbon::now()->subDays(2)->diffInHours());
        }, Carbon::create(2012, 1, 15));
    }

    public function testDiffInHoursEnsureIsTruncated()
    {
        $dt = Carbon::createFromDate(2000, 1, 1);
        $this->assertSame(1, $dt->diffInHours($dt->copy()->addHour()->addMinutes(31)));
    }

    public function testDiffInMinutesPositive()
    {
        $dt = Carbon::createFromDate(2000, 1, 1);
        $this->assertSame(62, $dt->diffInMinutes($dt->copy()->addHour()->addMinutes(2)));
    }

    public function testDiffInMinutesPositiveAlot()
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
        $scope = $this;
        $this->wrapWithTestNow(function () use ($scope) {
            $scope->assertSame(60, Carbon::now()->subHour()->diffInMinutes());
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

    public function testDiffInSecondsPositiveAlot()
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
        $scope = $this;
        $this->wrapWithTestNow(function () use ($scope) {
            $scope->assertSame(3600, Carbon::now()->subHour()->diffInSeconds());
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
        $this->assertSame(3 * 60 * 60, $dtOttawa->diffInSeconds($dtVancouver));
    }

    public function testDiffInSecondsWithTimezonesAndVsDefault()
    {
        $vanNow = Carbon::now('America/Vancouver');
        $hereNow = $vanNow->copy()->setTimezone(Carbon::now()->tz);

        $scope = $this;
        $this->wrapWithTestNow(function () use ($vanNow, $scope) {
            $scope->assertSame(0, $vanNow->diffInSeconds());
        }, $hereNow);
    }

    public function testDiffForHumansNowAndSecond()
    {
        $scope = $this;
        $this->wrapWithTestNow(function () use ($scope) {
            $scope->assertSame('1 second ago', Carbon::now()->diffForHumans());
        });
    }

    public function testDiffForHumansNowAndSecondWithTimezone()
    {
        $vanNow = Carbon::now('America/Vancouver');
        $hereNow = $vanNow->copy()->setTimezone(Carbon::now()->tz);

        $scope = $this;
        $this->wrapWithTestNow(function () use ($vanNow, $scope) {
            $scope->assertSame('1 second ago', $vanNow->diffForHumans());
        }, $hereNow);
    }

    public function testDiffForHumansNowAndSeconds()
    {
        $scope = $this;
        $this->wrapWithTestNow(function () use ($scope) {
            $scope->assertSame('2 seconds ago', Carbon::now()->subSeconds(2)->diffForHumans());
        });
    }

    public function testDiffForHumansNowAndNearlyMinute()
    {
        $scope = $this;
        $this->wrapWithTestNow(function () use ($scope) {
            $scope->assertSame('59 seconds ago', Carbon::now()->subSeconds(59)->diffForHumans());
        });
    }

    public function testDiffForHumansNowAndMinute()
    {
        $scope = $this;
        $this->wrapWithTestNow(function () use ($scope) {
            $scope->assertSame('1 minute ago', Carbon::now()->subMinute()->diffForHumans());
        });
    }

    public function testDiffForHumansNowAndMinutes()
    {
        $scope = $this;
        $this->wrapWithTestNow(function () use ($scope) {
            $scope->assertSame('2 minutes ago', Carbon::now()->subMinutes(2)->diffForHumans());
        });
    }

    public function testDiffForHumansNowAndNearlyHour()
    {
        $scope = $this;
        $this->wrapWithTestNow(function () use ($scope) {
            $scope->assertSame('59 minutes ago', Carbon::now()->subMinutes(59)->diffForHumans());
        });
    }

    public function testDiffForHumansNowAndHour()
    {
        $scope = $this;
        $this->wrapWithTestNow(function () use ($scope) {
            $scope->assertSame('1 hour ago', Carbon::now()->subHour()->diffForHumans());
        });
    }

    public function testDiffForHumansNowAndHours()
    {
        $scope = $this;
        $this->wrapWithTestNow(function () use ($scope) {
            $scope->assertSame('2 hours ago', Carbon::now()->subHours(2)->diffForHumans());
        });
    }

    public function testDiffForHumansNowAndNearlyDay()
    {
        $scope = $this;
        $this->wrapWithTestNow(function () use ($scope) {
            $scope->assertSame('23 hours ago', Carbon::now()->subHours(23)->diffForHumans());
        });
    }

    public function testDiffForHumansNowAndDay()
    {
        $scope = $this;
        $this->wrapWithTestNow(function () use ($scope) {
            $scope->assertSame('1 day ago', Carbon::now()->subDay()->diffForHumans());
        });
    }

    public function testDiffForHumansNowAndDays()
    {
        $scope = $this;
        $this->wrapWithTestNow(function () use ($scope) {
            $scope->assertSame('2 days ago', Carbon::now()->subDays(2)->diffForHumans());
        });
    }

    public function testDiffForHumansNowAndNearlyWeek()
    {
        $scope = $this;
        $this->wrapWithTestNow(function () use ($scope) {
            $scope->assertSame('6 days ago', Carbon::now()->subDays(6)->diffForHumans());
        });
    }

    public function testDiffForHumansNowAndWeek()
    {
        $scope = $this;
        $this->wrapWithTestNow(function () use ($scope) {
            $scope->assertSame('1 week ago', Carbon::now()->subWeek()->diffForHumans());
        });
    }

    public function testDiffForHumansNowAndWeeks()
    {
        $scope = $this;
        $this->wrapWithTestNow(function () use ($scope) {
            $scope->assertSame('2 weeks ago', Carbon::now()->subWeeks(2)->diffForHumans());
        });
    }

    public function testDiffForHumansNowAndNearlyMonth()
    {
        $scope = $this;
        $this->wrapWithTestNow(function () use ($scope) {
            $scope->assertSame('3 weeks ago', Carbon::now()->subWeeks(3)->diffForHumans());
        });
    }

    public function testDiffForHumansNowAndMonth()
    {
        $scope = $this;
        $this->wrapWithTestNow(function () use ($scope) {
            $scope->assertSame('4 weeks ago', Carbon::now()->subWeeks(4)->diffForHumans());
            $scope->assertSame('1 month ago', Carbon::now()->subMonth()->diffForHumans());
        });
    }

    public function testDiffForHumansNowAndMonths()
    {
        $scope = $this;
        $this->wrapWithTestNow(function () use ($scope) {
            $scope->assertSame('2 months ago', Carbon::now()->subMonths(2)->diffForHumans());
        });
    }

    public function testDiffForHumansNowAndNearlyYear()
    {
        $scope = $this;
        $this->wrapWithTestNow(function () use ($scope) {
            $scope->assertSame('11 months ago', Carbon::now()->subMonths(11)->diffForHumans());
        });
    }

    public function testDiffForHumansNowAndYear()
    {
        $scope = $this;
        $this->wrapWithTestNow(function () use ($scope) {
            $scope->assertSame('1 year ago', Carbon::now()->subYear()->diffForHumans());
        });
    }

    public function testDiffForHumansNowAndYears()
    {
        $scope = $this;
        $this->wrapWithTestNow(function () use ($scope) {
            $scope->assertSame('2 years ago', Carbon::now()->subYears(2)->diffForHumans());
        });
    }

    public function testDiffForHumansNowAndFutureSecond()
    {
        $scope = $this;
        $this->wrapWithTestNow(function () use ($scope) {
            $scope->assertSame('1 second from now', Carbon::now()->addSecond()->diffForHumans());
        });
    }

    public function testDiffForHumansNowAndFutureSeconds()
    {
        $scope = $this;
        $this->wrapWithTestNow(function () use ($scope) {
            $scope->assertSame('2 seconds from now', Carbon::now()->addSeconds(2)->diffForHumans());
        });
    }

    public function testDiffForHumansNowAndNearlyFutureMinute()
    {
        $scope = $this;
        $this->wrapWithTestNow(function () use ($scope) {
            $scope->assertSame('59 seconds from now', Carbon::now()->addSeconds(59)->diffForHumans());
        });
    }

    public function testDiffForHumansNowAndFutureMinute()
    {
        $scope = $this;
        $this->wrapWithTestNow(function () use ($scope) {
            $scope->assertSame('1 minute from now', Carbon::now()->addMinute()->diffForHumans());
        });
    }

    public function testDiffForHumansNowAndFutureMinutes()
    {
        $scope = $this;
        $this->wrapWithTestNow(function () use ($scope) {
            $scope->assertSame('2 minutes from now', Carbon::now()->addMinutes(2)->diffForHumans());
        });
    }

    public function testDiffForHumansNowAndNearlyFutureHour()
    {
        $scope = $this;
        $this->wrapWithTestNow(function () use ($scope) {
            $scope->assertSame('59 minutes from now', Carbon::now()->addMinutes(59)->diffForHumans());
        });
    }

    public function testDiffForHumansNowAndFutureHour()
    {
        $scope = $this;
        $this->wrapWithTestNow(function () use ($scope) {
            $scope->assertSame('1 hour from now', Carbon::now()->addHour()->diffForHumans());
        });
    }

    public function testDiffForHumansNowAndFutureHours()
    {
        $scope = $this;
        $this->wrapWithTestNow(function () use ($scope) {
            $scope->assertSame('2 hours from now', Carbon::now()->addHours(2)->diffForHumans());
        });
    }

    public function testDiffForHumansNowAndNearlyFutureDay()
    {
        $scope = $this;
        $this->wrapWithTestNow(function () use ($scope) {
            $scope->assertSame('23 hours from now', Carbon::now()->addHours(23)->diffForHumans());
        });
    }

    public function testDiffForHumansNowAndFutureDay()
    {
        $scope = $this;
        $this->wrapWithTestNow(function () use ($scope) {
            $scope->assertSame('1 day from now', Carbon::now()->addDay()->diffForHumans());
        });
    }

    public function testDiffForHumansNowAndFutureDays()
    {
        $scope = $this;
        $this->wrapWithTestNow(function () use ($scope) {
            $scope->assertSame('2 days from now', Carbon::now()->addDays(2)->diffForHumans());
        });
    }

    public function testDiffForHumansNowAndNearlyFutureWeek()
    {
        $scope = $this;
        $this->wrapWithTestNow(function () use ($scope) {
            $scope->assertSame('6 days from now', Carbon::now()->addDays(6)->diffForHumans());
        });
    }

    public function testDiffForHumansNowAndFutureWeek()
    {
        $scope = $this;
        $this->wrapWithTestNow(function () use ($scope) {
            $scope->assertSame('1 week from now', Carbon::now()->addWeek()->diffForHumans());
        });
    }

    public function testDiffForHumansNowAndFutureWeeks()
    {
        $scope = $this;
        $this->wrapWithTestNow(function () use ($scope) {
            $scope->assertSame('2 weeks from now', Carbon::now()->addWeeks(2)->diffForHumans());
        });
    }

    public function testDiffForHumansNowAndNearlyFutureMonth()
    {
        $scope = $this;
        $this->wrapWithTestNow(function () use ($scope) {
            $scope->assertSame('3 weeks from now', Carbon::now()->addWeeks(3)->diffForHumans());
        });
    }

    public function testDiffForHumansNowAndFutureMonth()
    {
        $scope = $this;
        $this->wrapWithTestNow(function () use ($scope) {
            $scope->assertSame('4 weeks from now', Carbon::now()->addWeeks(4)->diffForHumans());
            $scope->assertSame('1 month from now', Carbon::now()->addMonth()->diffForHumans());
        });
    }

    public function testDiffForHumansNowAndFutureMonths()
    {
        $scope = $this;
        $this->wrapWithTestNow(function () use ($scope) {
            $scope->assertSame('2 months from now', Carbon::now()->addMonths(2)->diffForHumans());
        });
    }

    public function testDiffForHumansNowAndNearlyFutureYear()
    {
        $scope = $this;
        $this->wrapWithTestNow(function () use ($scope) {
            $scope->assertSame('11 months from now', Carbon::now()->addMonths(11)->diffForHumans());
        });
    }

    public function testDiffForHumansNowAndFutureYear()
    {
        $scope = $this;
        $this->wrapWithTestNow(function () use ($scope) {
            $scope->assertSame('1 year from now', Carbon::now()->addYear()->diffForHumans());
        });
    }

    public function testDiffForHumansNowAndFutureYears()
    {
        $scope = $this;
        $this->wrapWithTestNow(function () use ($scope) {
            $scope->assertSame('2 years from now', Carbon::now()->addYears(2)->diffForHumans());
        });
    }

    public function testDiffForHumansOtherAndSecond()
    {
        $scope = $this;
        $this->wrapWithTestNow(function () use ($scope) {
            $scope->assertSame('1 second before', Carbon::now()->diffForHumans(Carbon::now()->addSecond()));
        });
    }

    public function testDiffForHumansOtherAndSeconds()
    {
        $scope = $this;
        $this->wrapWithTestNow(function () use ($scope) {
            $scope->assertSame('2 seconds before', Carbon::now()->diffForHumans(Carbon::now()->addSeconds(2)));
        });
    }

    public function testDiffForHumansOtherAndNearlyMinute()
    {
        $scope = $this;
        $this->wrapWithTestNow(function () use ($scope) {
            $scope->assertSame('59 seconds before', Carbon::now()->diffForHumans(Carbon::now()->addSeconds(59)));
        });
    }

    public function testDiffForHumansOtherAndMinute()
    {
        $scope = $this;
        $this->wrapWithTestNow(function () use ($scope) {
            $scope->assertSame('1 minute before', Carbon::now()->diffForHumans(Carbon::now()->addMinute()));
        });
    }

    public function testDiffForHumansOtherAndMinutes()
    {
        $scope = $this;
        $this->wrapWithTestNow(function () use ($scope) {
            $scope->assertSame('2 minutes before', Carbon::now()->diffForHumans(Carbon::now()->addMinutes(2)));
        });
    }

    public function testDiffForHumansOtherAndNearlyHour()
    {
        $scope = $this;
        $this->wrapWithTestNow(function () use ($scope) {
            $scope->assertSame('59 minutes before', Carbon::now()->diffForHumans(Carbon::now()->addMinutes(59)));
        });
    }

    public function testDiffForHumansOtherAndHour()
    {
        $scope = $this;
        $this->wrapWithTestNow(function () use ($scope) {
            $scope->assertSame('1 hour before', Carbon::now()->diffForHumans(Carbon::now()->addHour()));
        });
    }

    public function testDiffForHumansOtherAndHours()
    {
        $scope = $this;
        $this->wrapWithTestNow(function () use ($scope) {
            $scope->assertSame('2 hours before', Carbon::now()->diffForHumans(Carbon::now()->addHours(2)));
        });
    }

    public function testDiffForHumansOtherAndNearlyDay()
    {
        $scope = $this;
        $this->wrapWithTestNow(function () use ($scope) {
            $scope->assertSame('23 hours before', Carbon::now()->diffForHumans(Carbon::now()->addHours(23)));
        });
    }

    public function testDiffForHumansOtherAndDay()
    {
        $scope = $this;
        $this->wrapWithTestNow(function () use ($scope) {
            $scope->assertSame('1 day before', Carbon::now()->diffForHumans(Carbon::now()->addDay()));
        });
    }

    public function testDiffForHumansOtherAndDays()
    {
        $scope = $this;
        $this->wrapWithTestNow(function () use ($scope) {
            $scope->assertSame('2 days before', Carbon::now()->diffForHumans(Carbon::now()->addDays(2)));
        });
    }

    public function testDiffForHumansOtherAndNearlyWeek()
    {
        $scope = $this;
        $this->wrapWithTestNow(function () use ($scope) {
            $scope->assertSame('6 days before', Carbon::now()->diffForHumans(Carbon::now()->addDays(6)));
        });
    }

    public function testDiffForHumansOtherAndWeek()
    {
        $scope = $this;
        $this->wrapWithTestNow(function () use ($scope) {
            $scope->assertSame('1 week before', Carbon::now()->diffForHumans(Carbon::now()->addWeek()));
        });
    }

    public function testDiffForHumansOtherAndWeeks()
    {
        $scope = $this;
        $this->wrapWithTestNow(function () use ($scope) {
            $scope->assertSame('2 weeks before', Carbon::now()->diffForHumans(Carbon::now()->addWeeks(2)));
        });
    }

    public function testDiffForHumansOtherAndNearlyMonth()
    {
        $scope = $this;
        $this->wrapWithTestNow(function () use ($scope) {
            $scope->assertSame('3 weeks before', Carbon::now()->diffForHumans(Carbon::now()->addWeeks(3)));
        });
    }

    public function testDiffForHumansOtherAndMonth()
    {
        $scope = $this;
        $this->wrapWithTestNow(function () use ($scope) {
            $scope->assertSame('4 weeks before', Carbon::now()->diffForHumans(Carbon::now()->addWeeks(4)));
            $scope->assertSame('1 month before', Carbon::now()->diffForHumans(Carbon::now()->addMonth()));
        });
    }

    public function testDiffForHumansOtherAndMonths()
    {
        $scope = $this;
        $this->wrapWithTestNow(function () use ($scope) {
            $scope->assertSame('2 months before', Carbon::now()->diffForHumans(Carbon::now()->addMonths(2)));
        });
    }

    public function testDiffForHumansOtherAndNearlyYear()
    {
        $scope = $this;
        $this->wrapWithTestNow(function () use ($scope) {
            $scope->assertSame('11 months before', Carbon::now()->diffForHumans(Carbon::now()->addMonths(11)));
        });
    }

    public function testDiffForHumansOtherAndYear()
    {
        $scope = $this;
        $this->wrapWithTestNow(function () use ($scope) {
            $scope->assertSame('1 year before', Carbon::now()->diffForHumans(Carbon::now()->addYear()));
        });
    }

    public function testDiffForHumansOtherAndYears()
    {
        $scope = $this;
        $this->wrapWithTestNow(function () use ($scope) {
            $scope->assertSame('2 years before', Carbon::now()->diffForHumans(Carbon::now()->addYears(2)));
        });
    }

    public function testDiffForHumansOtherAndFutureSecond()
    {
        $scope = $this;
        $this->wrapWithTestNow(function () use ($scope) {
            $scope->assertSame('1 second after', Carbon::now()->diffForHumans(Carbon::now()->subSecond()));
        });
    }

    public function testDiffForHumansOtherAndFutureSeconds()
    {
        $scope = $this;
        $this->wrapWithTestNow(function () use ($scope) {
            $scope->assertSame('2 seconds after', Carbon::now()->diffForHumans(Carbon::now()->subSeconds(2)));
        });
    }

    public function testDiffForHumansOtherAndNearlyFutureMinute()
    {
        $scope = $this;
        $this->wrapWithTestNow(function () use ($scope) {
            $scope->assertSame('59 seconds after', Carbon::now()->diffForHumans(Carbon::now()->subSeconds(59)));
        });
    }

    public function testDiffForHumansOtherAndFutureMinute()
    {
        $scope = $this;
        $this->wrapWithTestNow(function () use ($scope) {
            $scope->assertSame('1 minute after', Carbon::now()->diffForHumans(Carbon::now()->subMinute()));
        });
    }

    public function testDiffForHumansOtherAndFutureMinutes()
    {
        $scope = $this;
        $this->wrapWithTestNow(function () use ($scope) {
            $scope->assertSame('2 minutes after', Carbon::now()->diffForHumans(Carbon::now()->subMinutes(2)));
        });
    }

    public function testDiffForHumansOtherAndNearlyFutureHour()
    {
        $scope = $this;
        $this->wrapWithTestNow(function () use ($scope) {
            $scope->assertSame('59 minutes after', Carbon::now()->diffForHumans(Carbon::now()->subMinutes(59)));
        });
    }

    public function testDiffForHumansOtherAndFutureHour()
    {
        $scope = $this;
        $this->wrapWithTestNow(function () use ($scope) {
            $scope->assertSame('1 hour after', Carbon::now()->diffForHumans(Carbon::now()->subHour()));
        });
    }

    public function testDiffForHumansOtherAndFutureHours()
    {
        $scope = $this;
        $this->wrapWithTestNow(function () use ($scope) {
            $scope->assertSame('2 hours after', Carbon::now()->diffForHumans(Carbon::now()->subHours(2)));
        });
    }

    public function testDiffForHumansOtherAndNearlyFutureDay()
    {
        $scope = $this;
        $this->wrapWithTestNow(function () use ($scope) {
            $scope->assertSame('23 hours after', Carbon::now()->diffForHumans(Carbon::now()->subHours(23)));
        });
    }

    public function testDiffForHumansOtherAndFutureDay()
    {
        $scope = $this;
        $this->wrapWithTestNow(function () use ($scope) {
            $scope->assertSame('1 day after', Carbon::now()->diffForHumans(Carbon::now()->subDay()));
        });
    }

    public function testDiffForHumansOtherAndFutureDays()
    {
        $scope = $this;
        $this->wrapWithTestNow(function () use ($scope) {
            $scope->assertSame('2 days after', Carbon::now()->diffForHumans(Carbon::now()->subDays(2)));
        });
    }

    public function testDiffForHumansOtherAndNearlyFutureWeek()
    {
        $scope = $this;
        $this->wrapWithTestNow(function () use ($scope) {
            $scope->assertSame('6 days after', Carbon::now()->diffForHumans(Carbon::now()->subDays(6)));
        });
    }

    public function testDiffForHumansOtherAndFutureWeek()
    {
        $scope = $this;
        $this->wrapWithTestNow(function () use ($scope) {
            $scope->assertSame('1 week after', Carbon::now()->diffForHumans(Carbon::now()->subWeek()));
        });
    }

    public function testDiffForHumansOtherAndFutureWeeks()
    {
        $scope = $this;
        $this->wrapWithTestNow(function () use ($scope) {
            $scope->assertSame('2 weeks after', Carbon::now()->diffForHumans(Carbon::now()->subWeeks(2)));
        });
    }

    public function testDiffForHumansOtherAndNearlyFutureMonth()
    {
        $scope = $this;
        $this->wrapWithTestNow(function () use ($scope) {
            $scope->assertSame('3 weeks after', Carbon::now()->diffForHumans(Carbon::now()->subWeeks(3)));
        });
    }

    public function testDiffForHumansOtherAndFutureMonth()
    {
        $scope = $this;
        $this->wrapWithTestNow(function () use ($scope) {
            $scope->assertSame('4 weeks after', Carbon::now()->diffForHumans(Carbon::now()->subWeeks(4)));
            $scope->assertSame('1 month after', Carbon::now()->diffForHumans(Carbon::now()->subMonth()));
        });
    }

    public function testDiffForHumansOtherAndFutureMonths()
    {
        $scope = $this;
        $this->wrapWithTestNow(function () use ($scope) {
            $scope->assertSame('2 months after', Carbon::now()->diffForHumans(Carbon::now()->subMonths(2)));
        });
    }

    public function testDiffForHumansOtherAndNearlyFutureYear()
    {
        $scope = $this;
        $this->wrapWithTestNow(function () use ($scope) {
            $scope->assertSame('11 months after', Carbon::now()->diffForHumans(Carbon::now()->subMonths(11)));
        });
    }

    public function testDiffForHumansOtherAndFutureYear()
    {
        $scope = $this;
        $this->wrapWithTestNow(function () use ($scope) {
            $scope->assertSame('1 year after', Carbon::now()->diffForHumans(Carbon::now()->subYear()));
        });
    }

    public function testDiffForHumansOtherAndFutureYears()
    {
        $scope = $this;
        $this->wrapWithTestNow(function () use ($scope) {
            $scope->assertSame('2 years after', Carbon::now()->diffForHumans(Carbon::now()->subYears(2)));
        });
    }

    public function testDiffForHumansAbsoluteSeconds()
    {
        $scope = $this;
        $this->wrapWithTestNow(function () use ($scope) {
            $scope->assertSame('59 seconds', Carbon::now()->diffForHumans(Carbon::now()->subSeconds(59), true));
            $scope->assertSame('59 seconds', Carbon::now()->diffForHumans(Carbon::now()->addSeconds(59), true));
        });
    }

    public function testDiffForHumansAbsoluteMinutes()
    {
        $scope = $this;
        $this->wrapWithTestNow(function () use ($scope) {
            $scope->assertSame('30 minutes', Carbon::now()->diffForHumans(Carbon::now()->subMinutes(30), true));
            $scope->assertSame('30 minutes', Carbon::now()->diffForHumans(Carbon::now()->addMinutes(30), true));
        });
    }

    public function testDiffForHumansAbsoluteHours()
    {
        $scope = $this;
        $this->wrapWithTestNow(function () use ($scope) {
            $scope->assertSame('3 hours', Carbon::now()->diffForHumans(Carbon::now()->subHours(3), true));
            $scope->assertSame('3 hours', Carbon::now()->diffForHumans(Carbon::now()->addHours(3), true));
        });
    }

    public function testDiffForHumansAbsoluteDays()
    {
        $scope = $this;
        $this->wrapWithTestNow(function () use ($scope) {
            $scope->assertSame('2 days', Carbon::now()->diffForHumans(Carbon::now()->subDays(2), true));
            $scope->assertSame('2 days', Carbon::now()->diffForHumans(Carbon::now()->addDays(2), true));
        });
    }

    public function testDiffForHumansAbsoluteWeeks()
    {
        $scope = $this;
        $this->wrapWithTestNow(function () use ($scope) {
            $scope->assertSame('2 weeks', Carbon::now()->diffForHumans(Carbon::now()->subWeeks(2), true));
            $scope->assertSame('2 weeks', Carbon::now()->diffForHumans(Carbon::now()->addWeeks(2), true));
        });
    }

    public function testDiffForHumansAbsoluteMonths()
    {
        $scope = $this;
        $this->wrapWithTestNow(function () use ($scope) {
            $scope->assertSame('2 months', Carbon::now()->diffForHumans(Carbon::now()->subMonths(2), true));
            $scope->assertSame('2 months', Carbon::now()->diffForHumans(Carbon::now()->addMonths(2), true));
        });
    }

    public function testDiffForHumansAbsoluteYears()
    {
        $scope = $this;
        $this->wrapWithTestNow(function () use ($scope) {
            $scope->assertSame('1 year', Carbon::now()->diffForHumans(Carbon::now()->subYears(1), true));
            $scope->assertSame('1 year', Carbon::now()->diffForHumans(Carbon::now()->addYears(1), true));
        });
    }

    public function testDiffForHumansWithShorterMonthShouldStillBeAMonth()
    {
        $feb15 = Carbon::parse('2015-02-15');
        $mar15 = Carbon::parse('2015-03-15');
        $this->assertSame('1 month after', $mar15->diffForHumans($feb15));
    }
}
