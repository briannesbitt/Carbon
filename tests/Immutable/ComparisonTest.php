<?php

/*
 * This file is part of the Carbon package.
 *
 * (c) Brian Nesbitt <brian@nesbot.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Immutable;

use Carbon\CarbonImmutable;
use TestFixture;

class ComparisonTest extends TestFixture
{

    public function testEqualToTrue()
    {
        $this->assertTrue(CarbonImmutable::createFromDate(2000, 1, 1)->eq(CarbonImmutable::createFromDate(2000, 1, 1)));
    }

    public function testEqualToFalse()
    {
        $this->assertFalse(CarbonImmutable::createFromDate(2000, 1, 1)->eq(CarbonImmutable::createFromDate(2000, 1, 2)));
    }

    public function testEqualWithTimezoneTrue()
    {
        $this->assertTrue(CarbonImmutable::create(2000, 1, 1, 12, 0, 0, 'America/Toronto')->eq(CarbonImmutable::create(2000, 1, 1, 9, 0,
            0, 'America/Vancouver')));
    }

    public function testEqualWithTimezoneFalse()
    {
        $this->assertFalse(CarbonImmutable::createFromDate(2000, 1, 1, 'America/Toronto')->eq(CarbonImmutable::createFromDate(2000, 1, 1,
            'America/Vancouver')));
    }

    public function testNotEqualToTrue()
    {
        $this->assertTrue(CarbonImmutable::createFromDate(2000, 1, 1)->ne(CarbonImmutable::createFromDate(2000, 1, 2)));
    }

    public function testNotEqualToFalse()
    {
        $this->assertFalse(CarbonImmutable::createFromDate(2000, 1, 1)->ne(CarbonImmutable::createFromDate(2000, 1, 1)));
    }

    public function testNotEqualWithTimezone()
    {
        $this->assertTrue(CarbonImmutable::createFromDate(2000, 1, 1, 'America/Toronto')->ne(CarbonImmutable::createFromDate(2000, 1, 1,
            'America/Vancouver')));
    }

    public function testGreaterThanTrue()
    {
        $this->assertTrue(CarbonImmutable::createFromDate(2000, 1, 1)->gt(CarbonImmutable::createFromDate(1999, 12, 31)));
    }

    public function testGreaterThanFalse()
    {
        $this->assertFalse(CarbonImmutable::createFromDate(2000, 1, 1)->gt(CarbonImmutable::createFromDate(2000, 1, 2)));
    }

    public function testGreaterThanWithTimezoneTrue()
    {
        $dt1 = CarbonImmutable::create(2000, 1, 1, 12, 0, 0, 'America/Toronto');
        $dt2 = CarbonImmutable::create(2000, 1, 1, 8, 59, 59, 'America/Vancouver');
        $this->assertTrue($dt1->gt($dt2));
    }

    public function testGreaterThanWithTimezoneFalse()
    {
        $dt1 = CarbonImmutable::create(2000, 1, 1, 12, 0, 0, 'America/Toronto');
        $dt2 = CarbonImmutable::create(2000, 1, 1, 9, 0, 1, 'America/Vancouver');
        $this->assertFalse($dt1->gt($dt2));
    }

    public function testGreaterThanOrEqualTrue()
    {
        $this->assertTrue(CarbonImmutable::createFromDate(2000, 1, 1)->gte(CarbonImmutable::createFromDate(1999, 12, 31)));
    }

    public function testGreaterThanOrEqualTrueEqual()
    {
        $this->assertTrue(CarbonImmutable::createFromDate(2000, 1, 1)->gte(CarbonImmutable::createFromDate(2000, 1, 1)));
    }

    public function testGreaterThanOrEqualFalse()
    {
        $this->assertFalse(CarbonImmutable::createFromDate(2000, 1, 1)->gte(CarbonImmutable::createFromDate(2000, 1, 2)));
    }

    public function testLessThanTrue()
    {
        $this->assertTrue(CarbonImmutable::createFromDate(2000, 1, 1)->lt(CarbonImmutable::createFromDate(2000, 1, 2)));
    }

    public function testLessThanFalse()
    {
        $this->assertFalse(CarbonImmutable::createFromDate(2000, 1, 1)->lt(CarbonImmutable::createFromDate(1999, 12, 31)));
    }

    public function testLessThanOrEqualTrue()
    {
        $this->assertTrue(CarbonImmutable::createFromDate(2000, 1, 1)->lte(CarbonImmutable::createFromDate(2000, 1, 2)));
    }

    public function testLessThanOrEqualTrueEqual()
    {
        $this->assertTrue(CarbonImmutable::createFromDate(2000, 1, 1)->lte(CarbonImmutable::createFromDate(2000, 1, 1)));
    }

    public function testLessThanOrEqualFalse()
    {
        $this->assertFalse(CarbonImmutable::createFromDate(2000, 1, 1)->lte(CarbonImmutable::createFromDate(1999, 12, 31)));
    }

    public function testBetweenEqualTrue()
    {
        $this->assertTrue(CarbonImmutable::createFromDate(2000, 1, 15)->between(CarbonImmutable::createFromDate(2000, 1, 1),
            CarbonImmutable::createFromDate(2000, 1, 31), true));
    }

    public function testBetweenNotEqualTrue()
    {
        $this->assertTrue(CarbonImmutable::createFromDate(2000, 1, 15)->between(CarbonImmutable::createFromDate(2000, 1, 1),
            CarbonImmutable::createFromDate(2000, 1, 31), false));
    }

    public function testBetweenEqualFalse()
    {
        $this->assertFalse(CarbonImmutable::createFromDate(1999, 12, 31)->between(CarbonImmutable::createFromDate(2000, 1, 1),
            CarbonImmutable::createFromDate(2000, 1, 31), true));
    }

    public function testBetweenNotEqualFalse()
    {
        $this->assertFalse(CarbonImmutable::createFromDate(2000, 1, 1)->between(CarbonImmutable::createFromDate(2000, 1, 1),
            CarbonImmutable::createFromDate(2000, 1, 31), false));
    }

    public function testBetweenEqualSwitchTrue()
    {
        $this->assertTrue(CarbonImmutable::createFromDate(2000, 1, 15)->between(CarbonImmutable::createFromDate(2000, 1, 31),
            CarbonImmutable::createFromDate(2000, 1, 1), true));
    }

    public function testBetweenNotEqualSwitchTrue()
    {
        $this->assertTrue(CarbonImmutable::createFromDate(2000, 1, 15)->between(CarbonImmutable::createFromDate(2000, 1, 31),
            CarbonImmutable::createFromDate(2000, 1, 1), false));
    }

    public function testBetweenEqualSwitchFalse()
    {
        $this->assertFalse(CarbonImmutable::createFromDate(1999, 12, 31)->between(CarbonImmutable::createFromDate(2000, 1, 31),
            CarbonImmutable::createFromDate(2000, 1, 1), true));
    }

    public function testBetweenNotEqualSwitchFalse()
    {
        $this->assertFalse(CarbonImmutable::createFromDate(2000, 1, 1)->between(CarbonImmutable::createFromDate(2000, 1, 31),
            CarbonImmutable::createFromDate(2000, 1, 1), false));
    }

    public function testMinIsFluid()
    {
        $dt = CarbonImmutable::now();
        $this->assertTrue($dt->min() instanceof Carbon);
    }

    public function testMinWithNow()
    {
        $dt = CarbonImmutable::create(2012, 1, 1, 0, 0, 0)->min();
        $this->assertCarbon($dt, 2012, 1, 1, 0, 0, 0);
    }

    public function testMinWithInstance()
    {
        $dt1 = CarbonImmutable::create(2013, 12, 31, 23, 59, 59);
        $dt2 = CarbonImmutable::create(2012, 1, 1, 0, 0, 0)->min($dt1);
        $this->assertCarbon($dt2, 2012, 1, 1, 0, 0, 0);
    }

    public function testMaxIsFluid()
    {
        $dt = CarbonImmutable::now();
        $this->assertTrue($dt->max() instanceof Carbon);
    }

    public function testMaxWithNow()
    {
        $dt = CarbonImmutable::create(2099, 12, 31, 23, 59, 59)->max();
        $this->assertCarbon($dt, 2099, 12, 31, 23, 59, 59);
    }

    public function testMaxWithInstance()
    {
        $dt1 = CarbonImmutable::create(2012, 1, 1, 0, 0, 0);
        $dt2 = CarbonImmutable::create(2099, 12, 31, 23, 59, 59)->max($dt1);
        $this->assertCarbon($dt2, 2099, 12, 31, 23, 59, 59);
    }

    public function testIsBirthday()
    {
        $dt1 = CarbonImmutable::createFromDate(1987, 4, 23);
        $dt2 = CarbonImmutable::createFromDate(2014, 9, 26);
        $dt3 = CarbonImmutable::createFromDate(2014, 4, 23);
        $this->assertFalse($dt2->isBirthday($dt1));
        $this->assertTrue($dt3->isBirthday($dt1));
    }
}
