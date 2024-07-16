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

namespace Tests\CarbonInterval;

use BadMethodCallException;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use InvalidArgumentException;
use Tests\AbstractTestCase;

class SettersTest extends AbstractTestCase
{
    public function testSet()
    {
        $ci = CarbonInterval::create(4, 5, 6, 5, 8, 9, 10);
        $ci->set('seconds', 34);
        $this->assertSame(34, $ci->seconds);
        $ci->set([
            'seconds' => 59,
            'minutes' => 33,
        ]);
        $this->assertSame(59, $ci->seconds);
        $this->assertSame(33, $ci->minutes);
    }

    public function testYearsSetter()
    {
        $ci = CarbonInterval::create(4, 5, 6, 5, 8, 9, 10);
        $ci->years = 2;
        $this->assertSame(2, $ci->years);
        $ci->years(5);
        $this->assertSame(5, $ci->years);
    }

    public function testMonthsSetter()
    {
        $ci = CarbonInterval::create(4, 5, 6, 5, 8, 9, 10);
        $ci->months = 11;
        $this->assertSame(11, $ci->months);
        $ci->months(8);
        $this->assertSame(8, $ci->months);
    }

    public function testWeeksSetter()
    {
        $ci = CarbonInterval::create(4, 5, 6, 5, 8, 9, 10);
        $ci->weeks = 11;
        $this->assertSame(11, $ci->weeks);
        $this->assertSame(7 * 11, $ci->dayz);
        $ci->weeks(4);
        $this->assertSame(4, $ci->weeks);
    }

    public function testDayzSetter()
    {
        $ci = CarbonInterval::create(4, 5, 6, 5, 8, 9, 10);
        $ci->dayz = 11;
        $this->assertSame(11, $ci->dayz);
        $this->assertSame(1, $ci->weeks);
        $this->assertSame(4, $ci->dayzExcludeWeeks);
        $ci->days(1);
        $this->assertSame(1, $ci->dayz);
        $ci->day(3);
        $this->assertSame(3, $ci->dayz);

        $diff = (new Carbon('2024-07-15 00:00'))->diff('2024-08-12 23:15');

        $this->assertSame('4 weeks 23 hours 15 minutes', $diff->forHumans());
        $diff->set('days', false);
        $this->assertSame('4 weeks 23 hours 15 minutes', $diff->forHumans());
        $this->assertFalse($diff->days);
    }

    public function testHoursSetter()
    {
        $ci = CarbonInterval::create(4, 5, 6, 5, 8, 9, 10);
        $ci->hours = 12;
        $this->assertSame(12, $ci->hours);
        $ci->hours(0);
        $this->assertSame(0, $ci->hours);
    }

    public function testMinutesSetter()
    {
        $ci = CarbonInterval::create(4, 5, 6, 5, 8, 9, 10);
        $ci->minutes = 11;
        $this->assertSame(11, $ci->minutes);
        $ci->minutes(9);
        $this->assertSame(9, $ci->minutes);
    }

    public function testSecondsSetter()
    {
        $ci = CarbonInterval::create(4, 5, 6, 5, 8, 9, 10);
        $ci->seconds = 34;
        $this->assertSame(34, $ci->seconds);
        $ci->seconds(59);
        $this->assertSame(59, $ci->seconds);
        $ci->second(1);
        $this->assertSame(1, $ci->seconds);
    }

    public function testMillisecondsSetter()
    {
        $ci = CarbonInterval::create(4, 5, 6, 5, 8, 9, 10);
        $ci->milliseconds = 34;
        $this->assertSame(34, $ci->milliseconds);
        $ci->milliseconds(59);
        $this->assertSame(59, $ci->milliseconds);
        $ci->millisecond(1);
        $this->assertSame(1, $ci->milliseconds);
    }

    public function testMicrosecondsSetter()
    {
        $ci = CarbonInterval::create(4, 5, 6, 5, 8, 9, 10);
        $ci->microseconds = 34;
        $this->assertSame(34, $ci->microseconds);
        $ci->microseconds(59);
        $this->assertSame(59, $ci->microseconds);
        $ci->microsecond(1);
        $this->assertSame(1, $ci->microseconds);
    }

    public function testFluentSetters()
    {
        $ci = CarbonInterval::years(4)->months(2)->dayz(5)->hours(3)->minute()->seconds(59);
        $this->assertInstanceOfCarbonInterval($ci);
        $this->assertCarbonInterval($ci, 4, 2, 5, 3, 1, 59);

        $ci = CarbonInterval::years(4)->months(2)->weeks(2)->hours(3)->minute()->seconds(59);
        $this->assertInstanceOfCarbonInterval($ci);
        $this->assertCarbonInterval($ci, 4, 2, 14, 3, 1, 59);
    }

    public function testFluentSettersDaysOverwritesWeeks()
    {
        $ci = CarbonInterval::weeks(3)->days(5);
        $this->assertCarbonInterval($ci, 0, 0, 5, 0, 0, 0);
    }

    public function testFluentSettersWeeksOverwritesDays()
    {
        $ci = CarbonInterval::days(5)->weeks(3);
        $this->assertCarbonInterval($ci, 0, 0, 3 * 7, 0, 0, 0);
    }

    public function testFluentSettersWeeksAndDaysIsCumulative()
    {
        $ci = CarbonInterval::year(5)->weeksAndDays(2, 6);
        $this->assertCarbonInterval($ci, 5, 0, 20, 0, 0, 0);
        $this->assertSame(20, $ci->dayz);
        $this->assertSame(2, $ci->weeks);
        $this->assertSame(6, $ci->dayzExcludeWeeks);
    }

    public function testInvert()
    {
        $ci = new CarbonInterval();

        $this->assertSame($ci, $ci->invert());
        $this->assertSame(1, $ci->invert);

        $this->assertSame($ci, $ci->invert());
        $this->assertSame(0, $ci->invert);

        $this->assertSame($ci, $ci->invert(true));
        $this->assertSame(1, $ci->invert);

        $this->assertSame($ci, $ci->invert(true));
        $this->assertSame(1, $ci->invert);

        $this->assertSame($ci, $ci->invert(false));
        $this->assertSame(0, $ci->invert);

        $this->assertSame($ci, $ci->invert(false));
        $this->assertSame(0, $ci->invert);
    }

    public function testAbsolute()
    {
        $ci = CarbonInterval::day();

        $this->assertSame($ci, $ci->absolute());
        $this->assertSame(1.0, $ci->totalDays);

        $this->assertSame(1.0, $ci->invert()->absolute()->totalDays);
        $this->assertSame(-1.0, $ci->invert()->absolute(false)->totalDays);

        $this->assertSame(1.0, $ci->invert()->abs(true)->totalDays);
        $this->assertSame(-1.0, $ci->invert()->abs(false)->totalDays);
    }

    public function testInvalidSetter()
    {
        $this->expectExceptionObject(new InvalidArgumentException(
            'Unknown setter \'doesNotExit\'',
        ));

        /** @var mixed $ci */
        $ci = new CarbonInterval();
        $ci->doesNotExit = 123;
    }

    public function testInvalidFluentSetter()
    {
        $this->expectExceptionObject(new BadMethodCallException(
            'Unknown fluent setter \'doesNotExit\'',
        ));

        /** @var mixed $ci */
        $ci = new CarbonInterval();
        $ci->doesNotExit(123);
    }

    public function testInvalidStaticFluentSetter()
    {
        $this->expectExceptionObject(new BadMethodCallException(
            'Unknown fluent constructor \'doesNotExit\'',
        ));

        CarbonInterval::doesNotExit(123);
    }

    public function testLocale()
    {
        /** @var CarbonInterval $interval */
        $interval = CarbonInterval::hour()->locale('de');

        $this->assertSame('de', $interval->locale);
    }

    public function testShiftTimezone()
    {
        $interval = CarbonInterval::hour()->shiftTimezone('America/Toronto');

        $this->assertSame('America/Toronto', $interval->getSettings()['timezone']);

        /** @var CarbonInterval $interval */
        $interval = CarbonInterval::diff(
            Carbon::parse('2020-02-02 20:20 Asia/Tokyo'),
            Carbon::parse('2020-02-03 22:22 Europe/Madrid'),
        )->shiftTimezone('America/Toronto');

        $this->assertSame('America/Toronto', $interval->getSettings()['timezone']);
        $this->assertSame('2020-02-02 20:20 America/Toronto', $interval->start()->format('Y-m-d H:i e'));
        $this->assertSame('2020-02-03 22:22 America/Toronto', $interval->end()->format('Y-m-d H:i e'));
    }

    public function testSetTimezone()
    {
        /** @var CarbonInterval $interval */
        $interval = CarbonInterval::hour()->setTimezone('America/Toronto');

        $this->assertSame('America/Toronto', $interval->tzname);
        $this->assertSame('America/Toronto', $interval->tz_name);
        $this->assertSame('America/Toronto', $interval->getSettings()['timezone']);

        /** @var CarbonInterval $interval */
        $interval = CarbonInterval::diff(
            Carbon::parse('2020-02-02 20:20 Asia/Tokyo'),
            Carbon::parse('2020-02-03 22:22 Europe/Madrid'),
        )->setTimezone('America/Toronto');

        $this->assertSame('America/Toronto', $interval->getSettings()['timezone']);
        $this->assertSame('2020-02-02 06:20 America/Toronto', $interval->start()->format('Y-m-d H:i e'));
        $this->assertSame('2020-02-03 16:22 America/Toronto', $interval->end()->format('Y-m-d H:i e'));

        /** @var CarbonInterval $interval */
        $interval = CarbonInterval::hour();
        $next = $interval->set(' * foobar', 'biz');

        $this->assertSame($next, $interval);
        $this->assertSame('1 hour', $interval->forHumans());
    }
}
