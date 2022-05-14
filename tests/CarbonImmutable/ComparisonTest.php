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

namespace Tests\CarbonImmutable;

use Carbon\CarbonImmutable as Carbon;
use DateTime;
use Tests\AbstractTestCase;

class ComparisonTest extends AbstractTestCase
{
    public function testEqualToTrue(): void
    {
        $this->assertTrue(Carbon::createFromDate(2000, 1, 1)->equalTo(Carbon::createFromDate(2000, 1, 1)));
    }

    public function testEqualToFalse(): void
    {
        $this->assertFalse(Carbon::createFromDate(2000, 1, 1)->equalTo(Carbon::createFromDate(2000, 1, 2)));
    }

    public function testEqualWithTimezoneTrue(): void
    {
        $this->assertTrue(Carbon::create(2000, 1, 1, 12, 0, 0, 'America/Toronto')->equalTo(Carbon::create(2000, 1, 1, 9, 0, 0, 'America/Vancouver')));
    }

    public function testNotEqualToTrue(): void
    {
        $this->assertTrue(Carbon::createFromDate(2000, 1, 1)->notEqualTo(Carbon::createFromDate(2000, 1, 2)));
    }

    public function testNotEqualToFalse(): void
    {
        $this->assertFalse(Carbon::createFromDate(2000, 1, 1)->notEqualTo(Carbon::createFromDate(2000, 1, 1)));
    }

    public function testGreaterThanTrue(): void
    {
        $this->assertTrue(Carbon::createFromDate(2000, 1, 1)->greaterThan(Carbon::createFromDate(1999, 12, 31)));
    }

    public function testGreaterThanFalse(): void
    {
        $this->assertFalse(Carbon::createFromDate(2000, 1, 1)->greaterThan(Carbon::createFromDate(2000, 1, 2)));
    }

    public function testGreaterThanWithTimezoneTrue(): void
    {
        $dt1 = Carbon::create(2000, 1, 1, 12, 0, 0, 'America/Toronto');
        $dt2 = Carbon::create(2000, 1, 1, 8, 59, 59, 'America/Vancouver');
        $this->assertTrue($dt1->greaterThan($dt2));
    }

    public function testGreaterThanWithTimezoneFalse(): void
    {
        $dt1 = Carbon::create(2000, 1, 1, 12, 0, 0, 'America/Toronto');
        $dt2 = Carbon::create(2000, 1, 1, 9, 0, 1, 'America/Vancouver');
        $this->assertFalse($dt1->greaterThan($dt2));
    }

    public function testGreaterThanOrEqualTrue(): void
    {
        $this->assertTrue(Carbon::createFromDate(2000, 1, 1)->greaterThanOrEqualTo(Carbon::createFromDate(1999, 12, 31)));
    }

    public function testGreaterThanOrEqualTrueEqual(): void
    {
        $this->assertTrue(Carbon::createFromDate(2000, 1, 1)->greaterThanOrEqualTo(Carbon::createFromDate(2000, 1, 1)));
    }

    public function testGreaterThanOrEqualFalse(): void
    {
        $this->assertFalse(Carbon::createFromDate(2000, 1, 1)->greaterThanOrEqualTo(Carbon::createFromDate(2000, 1, 2)));
    }

    public function testLessThanTrue(): void
    {
        $this->assertTrue(Carbon::createFromDate(2000, 1, 1)->lessThan(Carbon::createFromDate(2000, 1, 2)));
    }

    public function testLessThanFalse(): void
    {
        $this->assertFalse(Carbon::createFromDate(2000, 1, 1)->lessThan(Carbon::createFromDate(1999, 12, 31)));
    }

    public function testLessThanOrEqualTrue(): void
    {
        $this->assertTrue(Carbon::createFromDate(2000, 1, 1)->lessThanOrEqualTo(Carbon::createFromDate(2000, 1, 2)));
    }

    public function testLessThanOrEqualTrueEqual(): void
    {
        $this->assertTrue(Carbon::createFromDate(2000, 1, 1)->lessThanOrEqualTo(Carbon::createFromDate(2000, 1, 1)));
    }

    public function testLessThanOrEqualFalse(): void
    {
        $this->assertFalse(Carbon::createFromDate(2000, 1, 1)->lessThanOrEqualTo(Carbon::createFromDate(1999, 12, 31)));
    }

    public function testBetweenEqualTrue(): void
    {
        $this->assertTrue(Carbon::createFromDate(2000, 1, 15)->between(Carbon::createFromDate(2000, 1, 1), Carbon::createFromDate(2000, 1, 31), true));
        $this->assertTrue(Carbon::createFromDate(2000, 1, 15)->isBetween(Carbon::createFromDate(2000, 1, 1), Carbon::createFromDate(2000, 1, 31), true));

        $this->assertTrue(\Carbon\Carbon::createFromDate(2000, 1, 15)->between(new DateTime('2000-01-01'), new DateTime('2000-01-31'), true));
        $this->assertTrue(Carbon::createFromDate(2000, 1, 15)->isBetween(new DateTime('2000-01-01'), new DateTime('2000-01-31'), true));

        $this->assertTrue(Carbon::createFromDate(2000, 1, 15)->between('2000-01-01', '2000-01-31', true));
        $this->assertTrue(Carbon::createFromDate(2000, 1, 15)->isBetween('2000-01-01', '2000-01-31', true));
    }

    public function testBetweenNotEqualTrue(): void
    {
        $this->assertTrue(Carbon::createFromDate(2000, 1, 15)->between(Carbon::createFromDate(2000, 1, 1), Carbon::createFromDate(2000, 1, 31), false));
        $this->assertTrue(Carbon::createFromDate(2000, 1, 15)->isBetween(Carbon::createFromDate(2000, 1, 1), Carbon::createFromDate(2000, 1, 31), false));

        $this->assertTrue(Carbon::createFromDate(2000, 1, 15)->between(new DateTime('2000-01-01'), new DateTime('2000-01-31'), false));
        $this->assertTrue(Carbon::createFromDate(2000, 1, 15)->isBetween(new DateTime('2000-01-01'), new DateTime('2000-01-31'), false));

        $this->assertTrue(Carbon::createFromDate(2000, 1, 15)->between('2000-01-01', '2000-01-31', false));
        $this->assertTrue(Carbon::createFromDate(2000, 1, 15)->isBetween('2000-01-01', '2000-01-31', false));
    }

    public function testBetweenExcludedTrue(): void
    {
        $this->assertTrue(Carbon::createFromDate(2000, 1, 15)->betweenExcluded(Carbon::createFromDate(2000, 1, 1), Carbon::createFromDate(2000, 1, 31)));

        $this->assertTrue(Carbon::createFromDate(2000, 1, 15)->betweenExcluded(new DateTime('2000-01-01'), new DateTime('2000-01-31')));

        $this->assertTrue(Carbon::createFromDate(2000, 1, 15)->betweenExcluded('2000-01-01', '2000-01-31'));
    }

    public function testBetweenEqualFalse(): void
    {
        $this->assertFalse(Carbon::createFromDate(1999, 12, 31)->between(Carbon::createFromDate(2000, 1, 1), Carbon::createFromDate(2000, 1, 31), true));
    }

    public function testBetweenNotEqualFalse(): void
    {
        $this->assertFalse(Carbon::createFromDate(2000, 1, 1)->between(Carbon::createFromDate(2000, 1, 1), Carbon::createFromDate(2000, 1, 31), false));
    }

    public function testBetweenEqualSwitchTrue(): void
    {
        $this->assertTrue(Carbon::createFromDate(2000, 1, 15)->between(Carbon::createFromDate(2000, 1, 31), Carbon::createFromDate(2000, 1, 1), true));
    }

    public function testBetweenNotEqualSwitchTrue(): void
    {
        $this->assertTrue(Carbon::createFromDate(2000, 1, 15)->between(Carbon::createFromDate(2000, 1, 31), Carbon::createFromDate(2000, 1, 1), false));
    }

    public function testBetweenEqualSwitchFalse(): void
    {
        $this->assertFalse(Carbon::createFromDate(1999, 12, 31)->between(Carbon::createFromDate(2000, 1, 31), Carbon::createFromDate(2000, 1, 1), true));
    }

    public function testBetweenNotEqualSwitchFalse(): void
    {
        $this->assertFalse(Carbon::createFromDate(2000, 1, 1)->between(Carbon::createFromDate(2000, 1, 31), Carbon::createFromDate(2000, 1, 1), false));
    }

    public function testMinIsFluid(): void
    {
        $dt = Carbon::now();
        $this->assertInstanceOfCarbon($dt->min());
    }

    public function testMinWithNow(): void
    {
        $dt = Carbon::create(2012, 1, 1, 0, 0, 0)->min();
        $this->assertCarbon($dt, 2012, 1, 1, 0, 0, 0);
    }

    public function testMinWithInstance(): void
    {
        $dt1 = Carbon::create(2013, 12, 31, 23, 59, 59);
        $dt2 = Carbon::create(2012, 1, 1, 0, 0, 0)->min($dt1);
        $this->assertCarbon($dt2, 2012, 1, 1, 0, 0, 0);
    }

    public function testMaxIsFluid(): void
    {
        $dt = Carbon::now();
        $this->assertInstanceOfCarbon($dt->max());
    }

    public function testMaxWithNow(): void
    {
        $dt = Carbon::create(2099, 12, 31, 23, 59, 59)->max();
        $this->assertCarbon($dt, 2099, 12, 31, 23, 59, 59);
    }

    public function testMaxWithInstance(): void
    {
        $dt1 = Carbon::create(2012, 1, 1, 0, 0, 0);
        $dt2 = Carbon::create(2099, 12, 31, 23, 59, 59)->max($dt1);
        $this->assertCarbon($dt2, 2099, 12, 31, 23, 59, 59);
    }

    public function testIsBirthday(): void
    {
        $dt = Carbon::now();

        // Birthday test can't work on February 29th
        if ($dt->format('m-d') === '02-29') {
            Carbon::setTestNow($dt->subDay());
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

    public function testClosest(): void
    {
        $instance = Carbon::create(2015, 5, 28, 12, 0, 0);
        $dt1 = Carbon::create(2015, 5, 28, 11, 0, 0);
        $dt2 = Carbon::create(2015, 5, 28, 14, 0, 0);
        $closest = $instance->closest($dt1, $dt2);
        $this->assertSame($dt1, $closest);
    }

    public function testClosestWithEquals(): void
    {
        $instance = Carbon::create(2015, 5, 28, 12, 0, 0);
        $dt1 = Carbon::create(2015, 5, 28, 12, 0, 0);
        $dt2 = Carbon::create(2015, 5, 28, 14, 0, 0);
        $closest = $instance->closest($dt1, $dt2);
        $this->assertSame($dt1, $closest);
    }

    public function testClosestWithMicroseconds(): void
    {
        $baseDate = Carbon::parse('2018-10-11 20:59:06.500000');
        $closestDate = Carbon::parse('2018-10-11 20:59:06.600000');
        $farthestDate = Carbon::parse('2018-10-11 20:59:06.300000');

        $this->assertSame('06.600000', $baseDate->closest($closestDate, $farthestDate)->format('s.u'));
    }

    public function testClosestWithFarDates(): void
    {
        $baseDate = Carbon::parse('2018-10-11 20:59:06.500000');
        $closestDate = Carbon::parse('-4025-10-11 20:59:06.600000');
        $farthestDate = Carbon::parse('9995-10-11 20:59:06.300000');

        $this->assertSame('06.600000', $baseDate->closest($closestDate, $farthestDate)->format('s.u'));
    }

    public function testFarthest(): void
    {
        $instance = Carbon::create(2015, 5, 28, 12, 0, 0);
        $dt1 = Carbon::create(2015, 5, 28, 11, 0, 0);
        $dt2 = Carbon::create(2015, 5, 28, 14, 0, 0);
        $farthest = $instance->farthest($dt1, $dt2);
        $this->assertSame($dt2, $farthest);
    }

    public function testFarthestWithEquals(): void
    {
        $instance = Carbon::create(2015, 5, 28, 12, 0, 0);
        $dt1 = Carbon::create(2015, 5, 28, 12, 0, 0);
        $dt2 = Carbon::create(2015, 5, 28, 14, 0, 0);
        $farthest = $instance->farthest($dt1, $dt2);
        $this->assertSame($dt2, $farthest);
    }

    public function testFarthestWithMicroseconds(): void
    {
        $baseDate = Carbon::parse('2018-10-11 20:59:06.500000');
        $closestDate = Carbon::parse('2018-10-11 20:59:06.600000');
        $farthestDate = Carbon::parse('2018-10-11 20:59:06.300000');

        $this->assertSame('06.300000', $baseDate->farthest($closestDate, $farthestDate)->format('s.u'));
    }

    public function testFarthestWithFarDates(): void
    {
        $baseDate = Carbon::parse('2018-10-11 20:59:06.500000');
        $closestDate = Carbon::parse('-4025-10-11 20:59:06.600000');
        $farthestDate = Carbon::parse('9995-10-11 20:59:06.300000');

        $this->assertSame('06.300000', $baseDate->farthest($closestDate, $farthestDate)->format('s.u'));
    }
}
