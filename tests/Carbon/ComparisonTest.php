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
use DateTime;
use Tests\AbstractTestCase;

class ComparisonTest extends AbstractTestCase
{
    public function testEqualToTrue()
    {
        $this->assertTrue(Carbon::createFromDate(2000, 1, 1)->eq(Carbon::createFromDate(2000, 1, 1)));
    }

    public function testEqualToFalse()
    {
        $this->assertFalse(Carbon::createFromDate(2000, 1, 1)->eq(Carbon::createFromDate(2000, 1, 2)));
    }

    public function testEqualWithTimezoneTrue()
    {
        $this->assertTrue(Carbon::create(2000, 1, 1, 12, 0, 0, 'America/Toronto')->eq(Carbon::create(2000, 1, 1, 9, 0, 0, 'America/Vancouver')));
    }

    public function testEqualWithTimezoneFalse()
    {
        $timezones = ['Europe/London', 'America/Toronto', 'America/Vancouver', 'Asia/Tokyo'];

        foreach ($timezones as $a) {
            foreach ($timezones as $b) {
                $from = Carbon::createFromDate(2000, 1, 1, $a);
                $to = Carbon::createFromDate(2000, 1, 1, $b);
                $diff = $from->floatDiffInHours($to, false) + Carbon::now($a)->dst - Carbon::now($b)->dst;

                $this->assertTrue(\in_array($diff, $a === $b ? [0.0] : [0.0, 24.0, -24.0], true));
            }
        }

        Carbon::setTestNow();

        foreach ($timezones as $a) {
            foreach ($timezones as $b) {
                $from = Carbon::createFromDate(2000, 1, 1, $a);
                $to = Carbon::createFromDate(2000, 1, 1, $b);
                $diff = $from->floatDiffInHours($to, false) + Carbon::now($a)->dst - Carbon::now($b)->dst;
                $diff = round($diff * 1800) / 1800; // 2-seconds precision

                $this->assertTrue(\in_array($diff, $a === $b ? [0.0] : [0.0, 24.0, -24.0], true));
            }
        }
    }

    public function testNotEqualToTrue()
    {
        $this->assertTrue(Carbon::createFromDate(2000, 1, 1)->ne(Carbon::createFromDate(2000, 1, 2)));
    }

    public function testNotEqualToFalse()
    {
        $this->assertFalse(Carbon::createFromDate(2000, 1, 1)->ne(Carbon::createFromDate(2000, 1, 1)));
    }

    public function testGreaterThanTrue()
    {
        $this->assertTrue(Carbon::createFromDate(2000, 1, 1)->gt(Carbon::createFromDate(1999, 12, 31)));
    }

    public function testGreaterThanFalse()
    {
        $this->assertFalse(Carbon::createFromDate(2000, 1, 1)->gt(Carbon::createFromDate(2000, 1, 2)));
    }

    public function testGreaterThanWithTimezoneTrue()
    {
        $dt1 = Carbon::create(2000, 1, 1, 12, 0, 0, 'America/Toronto');
        $dt2 = Carbon::create(2000, 1, 1, 8, 59, 59, 'America/Vancouver');
        $this->assertTrue($dt1->gt($dt2));
    }

    public function testGreaterThanWithString()
    {
        Carbon::setToStringFormat('d.m.Y \a\t h:i a');
        $this->assertTrue(Carbon::parse('2022-05-03')->gt('2021-05-03'));
        $this->assertFalse(Carbon::parse('2021-05-03')->gt('2022-05-03'));
        Carbon::setToStringFormat(null);
    }

    public function testGreaterThanWithTimezoneFalse()
    {
        $dt1 = Carbon::create(2000, 1, 1, 12, 0, 0, 'America/Toronto');
        $dt2 = Carbon::create(2000, 1, 1, 9, 0, 1, 'America/Vancouver');
        $this->assertFalse($dt1->gt($dt2));
    }

    public function testGreaterThanOrEqualTrue()
    {
        $this->assertTrue(Carbon::createFromDate(2000, 1, 1)->gte(Carbon::createFromDate(1999, 12, 31)));
    }

    public function testGreaterThanOrEqualTrueEqual()
    {
        $this->assertTrue(Carbon::createFromDate(2000, 1, 1)->gte(Carbon::createFromDate(2000, 1, 1)));
    }

    public function testGreaterThanOrEqualFalse()
    {
        $this->assertFalse(Carbon::createFromDate(2000, 1, 1)->gte(Carbon::createFromDate(2000, 1, 2)));
    }

    public function testLessThanTrue()
    {
        $this->assertTrue(Carbon::createFromDate(2000, 1, 1)->lt(Carbon::createFromDate(2000, 1, 2)));
    }

    public function testLessThanFalse()
    {
        $this->assertFalse(Carbon::createFromDate(2000, 1, 1)->lt(Carbon::createFromDate(1999, 12, 31)));
    }

    public function testLessThanOrEqualTrue()
    {
        $this->assertTrue(Carbon::createFromDate(2000, 1, 1)->lte(Carbon::createFromDate(2000, 1, 2)));
    }

    public function testLessThanOrEqualTrueEqual()
    {
        $this->assertTrue(Carbon::createFromDate(2000, 1, 1)->lte(Carbon::createFromDate(2000, 1, 1)));
    }

    public function testLessThanOrEqualFalse()
    {
        $this->assertFalse(Carbon::createFromDate(2000, 1, 1)->lte(Carbon::createFromDate(1999, 12, 31)));
    }

    public function testBetweenEqualTrue()
    {
        $this->assertTrue(Carbon::createFromDate(2000, 1, 15)->between(Carbon::createFromDate(2000, 1, 1), Carbon::createFromDate(2000, 1, 31), true));
        $this->assertTrue(Carbon::createFromDate(2000, 1, 15)->isBetween(Carbon::createFromDate(2000, 1, 1), Carbon::createFromDate(2000, 1, 31), true));
        $this->assertTrue(Carbon::createMidnightDate(2000, 1, 15)->between(Carbon::createFromDate(2000, 1, 1), Carbon::createFromDate(2000, 1, 15), true));
        $this->assertTrue(Carbon::createMidnightDate(2000, 1, 15)->isBetween(Carbon::createFromDate(2000, 1, 1), Carbon::createFromDate(2000, 1, 15), true));

        $this->assertTrue(Carbon::createFromDate(2000, 1, 15)->between(new DateTime('2000-01-01'), new DateTime('2000-01-31'), true));
        $this->assertTrue(Carbon::createFromDate(2000, 1, 15)->isBetween(new DateTime('2000-01-01'), new DateTime('2000-01-31'), true));
        $this->assertTrue(Carbon::createMidnightDate(2000, 1, 15)->between(new DateTime('2000-01-15'), new DateTime('2000-01-31'), true));
        $this->assertTrue(Carbon::createMidnightDate(2000, 1, 15)->isBetween(new DateTime('2000-01-15'), new DateTime('2000-01-31'), true));

        $this->assertTrue(Carbon::createFromDate(2000, 1, 15)->between('2000-01-01', '2000-01-31', true));
        $this->assertTrue(Carbon::createFromDate(2000, 1, 15)->isBetween('2000-01-01', '2000-01-31', true));
        $this->assertTrue(Carbon::createMidnightDate(2000, 1, 15)->between('2000-01-01', '2000-01-15', true));
        $this->assertTrue(Carbon::createMidnightDate(2000, 1, 15)->isBetween('2000-01-01', '2000-01-15', true));

        $this->assertTrue(Carbon::create(2000, 1, 15, 17, 20, 54)->between('2000-01-15 17:20:50', '2000-01-15 17:20:54', true));
        $this->assertTrue(Carbon::create(2000, 1, 15, 17, 20, 54)->isBetween('2000-01-15 17:20:50', '2000-01-15 17:20:54', true));
        $this->assertTrue(Carbon::create(2000, 1, 15, 17, 20, 54)->between('2000-01-15 17:20:54', '2000-01-15 17:20:56', true));
        $this->assertTrue(Carbon::create(2000, 1, 15, 17, 20, 54)->isBetween('2000-01-15 17:20:54', '2000-01-15 17:20:56', true));
    }

    public function testBetweenNotEqualTrue()
    {
        $this->assertTrue(Carbon::createFromDate(2000, 1, 15)->between(Carbon::createFromDate(2000, 1, 1), Carbon::createFromDate(2000, 1, 31), false));
        $this->assertTrue(Carbon::createFromDate(2000, 1, 15)->isBetween(Carbon::createFromDate(2000, 1, 1), Carbon::createFromDate(2000, 1, 31), false));
        $this->assertFalse(Carbon::createFromDate(2000, 1, 15)->between(Carbon::createFromDate(2000, 1, 1), Carbon::createFromDate(2000, 1, 15), false));
        $this->assertFalse(Carbon::createFromDate(2000, 1, 15)->isBetween(Carbon::createFromDate(2000, 1, 1), Carbon::createFromDate(2000, 1, 15), false));

        $this->assertTrue(Carbon::createFromDate(2000, 1, 15)->between(new DateTime('2000-01-01'), new DateTime('2000-01-31'), false));
        $this->assertTrue(Carbon::createFromDate(2000, 1, 15)->isBetween(new DateTime('2000-01-01'), new DateTime('2000-01-31'), false));
        $this->assertFalse(Carbon::createFromDate(2000, 1, 15)->between(new DateTime('2000-01-01'), new DateTime('2000-01-15'), false));
        $this->assertFalse(Carbon::createFromDate(2000, 1, 15)->isBetween(new DateTime('2000-01-01'), new DateTime('2000-01-15'), false));

        $this->assertTrue(Carbon::createFromDate(2000, 1, 15)->between('2000-01-01', '2000-01-31', false));
        $this->assertTrue(Carbon::createFromDate(2000, 1, 15)->isBetween('2000-01-01', '2000-01-31', false));
        $this->assertFalse(Carbon::createMidnightDate(2000, 1, 15)->between('2000-01-15', '2000-01-31', false));
        $this->assertFalse(Carbon::createMidnightDate(2000, 1, 15)->isBetween('2000-01-15', '2000-01-31', false));

        $this->assertTrue(Carbon::create(2000, 1, 15, 17, 20, 54)->between('2000-01-15 17:20:50', '2000-01-15 17:20:55', false));
        $this->assertTrue(Carbon::create(2000, 1, 15, 17, 20, 54)->isBetween('2000-01-15 17:20:50', '2000-01-15 17:20:55', false));
        $this->assertFalse(Carbon::create(2000, 1, 15, 17, 20, 54)->between('2000-01-15 17:20:50', '2000-01-15 17:20:54', false));
        $this->assertFalse(Carbon::create(2000, 1, 15, 17, 20, 54)->isBetween('2000-01-15 17:20:50', '2000-01-15 17:20:54', false));
        $this->assertFalse(Carbon::create(2000, 1, 15, 17, 20, 54)->between('2000-01-15 17:20:54', '2000-01-15 17:20:56', false));
        $this->assertFalse(Carbon::create(2000, 1, 15, 17, 20, 54)->isBetween('2000-01-15 17:20:54', '2000-01-15 17:20:56', false));
    }

    public function testBetweenExcludedTrue()
    {
        $this->assertTrue(Carbon::createFromDate(2000, 1, 15)->betweenExcluded(Carbon::createFromDate(2000, 1, 1), Carbon::createFromDate(2000, 1, 31)));

        $this->assertTrue(Carbon::createFromDate(2000, 1, 15)->betweenExcluded(new DateTime('2000-01-01'), new DateTime('2000-01-31')));

        $this->assertTrue(Carbon::createFromDate(2000, 1, 15)->betweenExcluded('2000-01-01', '2000-01-31'));
    }

    public function testBetweenIncludedTrue()
    {
        $this->assertTrue(Carbon::createMidnightDate(2000, 1, 15)->betweenIncluded(Carbon::createFromDate(2000, 1, 1), Carbon::createFromDate(2000, 1, 31)));

        $this->assertTrue(Carbon::createMidnightDate(2000, 1, 15)->betweenIncluded(new DateTime('2000-01-01'), new DateTime('2000-01-31')));

        $this->assertTrue(Carbon::createMidnightDate(2000, 1, 15)->betweenIncluded('2000-01-15', '2000-01-31'));

        $this->assertTrue(Carbon::createMidnightDate(2000, 1, 15)->betweenIncluded('2000-01-01', '2000-01-15'));
    }

    public function testBetweenIncludedFalse()
    {
        $this->assertFalse(Carbon::createMidnightDate(2000, 1, 15)->betweenIncluded(Carbon::createFromDate(2000, 1, 16), Carbon::createFromDate(2000, 1, 31)));

        $this->assertFalse(Carbon::createMidnightDate(2000, 1, 15)->betweenIncluded(new DateTime('2000-01-16'), new DateTime('2000-01-31')));

        $this->assertFalse(Carbon::createMidnightDate(2000, 1, 15)->betweenIncluded('2000-01-16', '2000-01-31'));
    }

    public function testBetweenEqualFalse()
    {
        $this->assertFalse(Carbon::createFromDate(1999, 12, 31)->between(Carbon::createFromDate(2000, 1, 1), Carbon::createFromDate(2000, 1, 31), true));
    }

    public function testBetweenNotEqualFalse()
    {
        $this->assertFalse(Carbon::createFromDate(2000, 1, 1)->between(Carbon::createFromDate(2000, 1, 1), Carbon::createFromDate(2000, 1, 31), false));
    }

    public function testBetweenEqualSwitchTrue()
    {
        $this->assertTrue(Carbon::createFromDate(2000, 1, 15)->between(Carbon::createFromDate(2000, 1, 31), Carbon::createFromDate(2000, 1, 1), true));
    }

    public function testBetweenNotEqualSwitchTrue()
    {
        $this->assertTrue(Carbon::createFromDate(2000, 1, 15)->between(Carbon::createFromDate(2000, 1, 31), Carbon::createFromDate(2000, 1, 1), false));
    }

    public function testBetweenEqualSwitchFalse()
    {
        $this->assertFalse(Carbon::createFromDate(1999, 12, 31)->between(Carbon::createFromDate(2000, 1, 31), Carbon::createFromDate(2000, 1, 1), true));
    }

    public function testBetweenNotEqualSwitchFalse()
    {
        $this->assertFalse(Carbon::createFromDate(2000, 1, 1)->between(Carbon::createFromDate(2000, 1, 31), Carbon::createFromDate(2000, 1, 1), false));
    }

    public function testMinIsFluid()
    {
        $dt = Carbon::now();
        $this->assertInstanceOfCarbon($dt->min());
    }

    public function testMinWithNow()
    {
        $dt = Carbon::create(2012, 1, 1, 0, 0, 0)->min();
        $this->assertCarbon($dt, 2012, 1, 1, 0, 0, 0);
    }

    public function testMinWithInstance()
    {
        $dt1 = Carbon::create(2013, 12, 31, 23, 59, 59);
        $dt2 = Carbon::create(2012, 1, 1, 0, 0, 0)->min($dt1);
        $this->assertCarbon($dt2, 2012, 1, 1, 0, 0, 0);
    }

    public function testMaxIsFluid()
    {
        $dt = Carbon::now();
        $this->assertInstanceOfCarbon($dt->max());
    }

    public function testMaxWithNow()
    {
        $dt = Carbon::create(2099, 12, 31, 23, 59, 59)->max();
        $this->assertCarbon($dt, 2099, 12, 31, 23, 59, 59);
    }

    public function testMaxWithInstance()
    {
        $dt1 = Carbon::create(2012, 1, 1, 0, 0, 0);
        $dt2 = Carbon::create(2099, 12, 31, 23, 59, 59)->max($dt1);
        $this->assertCarbon($dt2, 2099, 12, 31, 23, 59, 59);
    }

    public function testIsBirthday()
    {
        $dt = Carbon::now();

        // Birthday test can't work on February 29th
        if ($dt->format('m-d') === '02-29') {
            Carbon::setTestNowAndTimezone($dt->subDay());
            $dt = Carbon::now();
        }

        $aBirthday = $dt->subYear();
        $this->assertTrue($aBirthday->isBirthday());
        $notABirthday = $dt->subDay();
        $this->assertFalse($notABirthday->isBirthday());
        $alsoNotABirthday = $dt->addDays(2);
        $this->assertFalse($alsoNotABirthday->isBirthday());

        $dt1 = Carbon::createFromDate(1987, 4, 23);
        $dt2 = Carbon::createFromDate(2014, 9, 26);
        $dt3 = Carbon::createFromDate(2014, 4, 23);
        $this->assertFalse($dt2->isBirthday($dt1));
        $this->assertTrue($dt3->isBirthday($dt1));
    }

    public function testClosest()
    {
        $instance = Carbon::create(2015, 5, 28, 12, 0, 0);
        $dt1 = Carbon::create(2015, 5, 28, 11, 0, 0);
        $dt2 = Carbon::create(2015, 5, 28, 14, 0, 0);
        $closest = $instance->closest($dt1, $dt2);
        $this->assertSame($dt1, $closest);
    }

    public function testClosestWithEquals()
    {
        $instance = Carbon::create(2015, 5, 28, 12, 0, 0);
        $dt1 = Carbon::create(2015, 5, 28, 12, 0, 0);
        $dt2 = Carbon::create(2015, 5, 28, 14, 0, 0);
        $closest = $instance->closest($dt1, $dt2);
        $this->assertSame($dt1, $closest);
    }

    public function testClosestWithMicroseconds()
    {
        $baseDate = Carbon::parse('2018-10-11 20:59:06.500000');
        $closestDate = Carbon::parse('2018-10-11 20:59:06.600000');
        $farthestDate = Carbon::parse('2018-10-11 20:59:06.300000');

        $this->assertSame('06.600000', $baseDate->closest($closestDate, $farthestDate)->format('s.u'));
    }

    public function testClosestWithFarDates()
    {
        $baseDate = Carbon::parse('2018-10-11 20:59:06.500000');
        $closestDate = Carbon::parse('-4025-10-11 20:59:06.600000');
        $farthestDate = Carbon::parse('9995-10-11 20:59:06.300000');

        $this->assertSame('06.600000', $baseDate->closest($closestDate, $farthestDate)->format('s.u'));
    }

    public function testFarthest()
    {
        $instance = Carbon::create(2015, 5, 28, 12, 0, 0);
        $dt1 = Carbon::create(2015, 5, 28, 11, 0, 0);
        $dt2 = Carbon::create(2015, 5, 28, 14, 0, 0);
        $farthest = $instance->farthest($dt1, $dt2);
        $this->assertSame($dt2, $farthest);
    }

    public function testFarthestWithEquals()
    {
        $instance = Carbon::create(2015, 5, 28, 12, 0, 0);
        $dt1 = Carbon::create(2015, 5, 28, 12, 0, 0);
        $dt2 = Carbon::create(2015, 5, 28, 14, 0, 0);
        $farthest = $instance->farthest($dt1, $dt2);
        $this->assertSame($dt2, $farthest);
    }

    public function testFarthestWithMicroseconds()
    {
        $baseDate = Carbon::parse('2018-10-11 20:59:06.500000');
        $closestDate = Carbon::parse('2018-10-11 20:59:06.600000');
        $farthestDate = Carbon::parse('2018-10-11 20:59:06.300000');

        $this->assertSame('06.300000', $baseDate->farthest($closestDate, $farthestDate)->format('s.u'));
    }

    public function testFarthestWithFarDates()
    {
        $baseDate = Carbon::parse('2018-10-11 20:59:06.500000');
        $closestDate = Carbon::parse('-4025-10-11 20:59:06.600000');
        $farthestDate = Carbon::parse('9995-10-11 20:59:06.300000');

        $this->assertSame('06.300000', $baseDate->farthest($closestDate, $farthestDate)->format('s.u'));
    }
}
