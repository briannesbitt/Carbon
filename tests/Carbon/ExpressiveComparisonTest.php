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
use Tests\AbstractTestCase;

class ExpressiveComparisonTest extends AbstractTestCase
{
    public function testEqualToTrue()
    {
        $this->assertTrue(Carbon::createFromDate(2000, 1, 1)->equalTo(Carbon::createFromDate(2000, 1, 1)));
    }

    public function testEqualToFalse()
    {
        $this->assertFalse(Carbon::createFromDate(2000, 1, 1)->equalTo(Carbon::createFromDate(2000, 1, 2)));
    }

    public function testEqualWithTimezoneTrue()
    {
        $this->assertTrue(Carbon::create(2000, 1, 1, 12, 0, 0, 'America/Toronto')->equalTo(Carbon::create(2000, 1, 1, 9, 0, 0, 'America/Vancouver')));
    }

    public function testNotEqualToTrue()
    {
        $this->assertTrue(Carbon::createFromDate(2000, 1, 1)->notEqualTo(Carbon::createFromDate(2000, 1, 2)));
    }

    public function testNotEqualToFalse()
    {
        $this->assertFalse(Carbon::createFromDate(2000, 1, 1)->notEqualTo(Carbon::createFromDate(2000, 1, 1)));
    }

    public function testGreaterThanTrue()
    {
        $this->assertTrue(Carbon::createFromDate(2000, 1, 1)->greaterThan(Carbon::createFromDate(1999, 12, 31)));
        $this->assertTrue(Carbon::createFromDate(2000, 1, 1)->isAfter(Carbon::createFromDate(1999, 12, 31)));
    }

    public function testGreaterThanFalse()
    {
        $this->assertFalse(Carbon::createFromDate(2000, 1, 1)->greaterThan(Carbon::createFromDate(2000, 1, 2)));
        $this->assertFalse(Carbon::createFromDate(2000, 1, 1)->isAfter(Carbon::createFromDate(2000, 1, 2)));
    }

    public function testGreaterThanWithTimezoneTrue()
    {
        $dt1 = Carbon::create(2000, 1, 1, 12, 0, 0, 'America/Toronto');
        $dt2 = Carbon::create(2000, 1, 1, 8, 59, 59, 'America/Vancouver');
        $this->assertTrue($dt1->greaterThan($dt2));
    }

    public function testGreaterThanWithTimezoneFalse()
    {
        $dt1 = Carbon::create(2000, 1, 1, 12, 0, 0, 'America/Toronto');
        $dt2 = Carbon::create(2000, 1, 1, 9, 0, 1, 'America/Vancouver');
        $this->assertFalse($dt1->greaterThan($dt2));
    }

    public function testGreaterThanOrEqualTrue()
    {
        $this->assertTrue(Carbon::createFromDate(2000, 1, 1)->greaterThanOrEqualTo(Carbon::createFromDate(1999, 12, 31)));
    }

    public function testGreaterThanOrEqualTrueEqual()
    {
        $this->assertTrue(Carbon::createFromDate(2000, 1, 1)->greaterThanOrEqualTo(Carbon::createFromDate(2000, 1, 1)));
    }

    public function testGreaterThanOrEqualFalse()
    {
        $this->assertFalse(Carbon::createFromDate(2000, 1, 1)->greaterThanOrEqualTo(Carbon::createFromDate(2000, 1, 2)));
    }

    public function testLessThanTrue()
    {
        $this->assertTrue(Carbon::createFromDate(2000, 1, 1)->lessThan(Carbon::createFromDate(2000, 1, 2)));
        $this->assertTrue(Carbon::createFromDate(2000, 1, 1)->isBefore(Carbon::createFromDate(2000, 1, 2)));
    }

    public function testLessThanFalse()
    {
        $this->assertFalse(Carbon::createFromDate(2000, 1, 1)->lessThan(Carbon::createFromDate(1999, 12, 31)));
        $this->assertFalse(Carbon::createFromDate(2000, 1, 1)->isBefore(Carbon::createFromDate(1999, 12, 31)));
    }

    public function testLessThanOrEqualTrue()
    {
        $this->assertTrue(Carbon::createFromDate(2000, 1, 1)->lessThanOrEqualTo(Carbon::createFromDate(2000, 1, 2)));
    }

    public function testLessThanOrEqualTrueEqual()
    {
        $this->assertTrue(Carbon::createFromDate(2000, 1, 1)->lessThanOrEqualTo(Carbon::createFromDate(2000, 1, 1)));
    }

    public function testLessThanOrEqualFalse()
    {
        $this->assertFalse(Carbon::createFromDate(2000, 1, 1)->lessThanOrEqualTo(Carbon::createFromDate(1999, 12, 31)));
    }

    public function testBetweenEqualTrue()
    {
        $this->assertTrue(Carbon::createFromDate(2000, 1, 15)->between(Carbon::createFromDate(2000, 1, 1), Carbon::createFromDate(2000, 1, 31), true));
    }

    public function testBetweenNotEqualTrue()
    {
        $this->assertTrue(Carbon::createFromDate(2000, 1, 15)->between(Carbon::createFromDate(2000, 1, 1), Carbon::createFromDate(2000, 1, 31), false));
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
        $this->assertInstanceOfCarbon($dt->minimum());
    }

    public function testMinWithNow()
    {
        $dt = Carbon::create(2012, 1, 1, 0, 0, 0)->minimum();
        $this->assertCarbon($dt, 2012, 1, 1, 0, 0, 0);
    }

    public function testMinWithInstance()
    {
        $dt1 = Carbon::create(2013, 12, 31, 23, 59, 59);
        $dt2 = Carbon::create(2012, 1, 1, 0, 0, 0)->minimum($dt1);
        $this->assertCarbon($dt2, 2012, 1, 1, 0, 0, 0);
    }

    public function testMaxIsFluid()
    {
        $dt = Carbon::now();
        $this->assertInstanceOfCarbon($dt->maximum());
    }

    public function testMaxWithNow()
    {
        $dt = Carbon::create(2099, 12, 31, 23, 59, 59)->maximum();
        $this->assertCarbon($dt, 2099, 12, 31, 23, 59, 59);
    }

    public function testMaxWithInstance()
    {
        $dt1 = Carbon::create(2012, 1, 1, 0, 0, 0);
        $dt2 = Carbon::create(2099, 12, 31, 23, 59, 59)->maximum($dt1);
        $this->assertCarbon($dt2, 2099, 12, 31, 23, 59, 59);
    }

    public function testIsBirthday()
    {
        $dt1 = Carbon::createFromDate(1987, 4, 23);
        $dt2 = Carbon::createFromDate(2014, 9, 26);
        $dt3 = Carbon::createFromDate(2014, 4, 23);
        $this->assertFalse($dt2->isBirthday($dt1));
        $this->assertTrue($dt3->isBirthday($dt1));
    }

    public function testIsLastOfMonth()
    {
        $dt1 = Carbon::createFromDate(2017, 1, 31);
        $dt2 = Carbon::createFromDate(2016, 2, 28);
        $dt3 = Carbon::createFromDate(2016, 2, 29);
        $dt4 = Carbon::createFromDate(2018, 5, 5);

        $this->assertTrue($dt1->isLastOfMonth());
        $this->assertFalse($dt2->isLastOfMonth());
        $this->assertTrue($dt3->isLastOfMonth());
        $this->assertFalse($dt4->isLastOfMonth());
    }

    public function testDeprecation()
    {
        $log = [];
        $expectOneError = function ($errno, $errstr) use (&$log) {
            $this->assertCount(1, $log);
            $this->assertSame([$errno, $errstr], $log[0] ?? null);
            $log = [];
        };
        set_error_handler(static function ($errno, $errstr) use (&$log) {
            $log[] = [$errno, $errstr];
        });
        $before = Carbon::now()->subSecond();
        $after = Carbon::now()->addSecond();
        $this->assertTrue(Carbon::now()->eq(false));
        $expectOneError(\E_USER_DEPRECATED, "Since 2.61.0, it's deprecated to compare a date to true or false, meaning of such comparison is ambiguous and will no longer be possible in 3.0.0, you should explicitly pass 'now' or make an other check to eliminate boolean values.");
        $this->assertFalse($before->eq(false));
        $expectOneError(\E_USER_DEPRECATED, "Since 2.61.0, it's deprecated to compare a date to true or false, meaning of such comparison is ambiguous and will no longer be possible in 3.0.0, you should explicitly pass 'now' or make an other check to eliminate boolean values.");
        $this->assertTrue(Carbon::now()->eq(null));
        $expectOneError(\E_USER_DEPRECATED, "Since 2.61.0, it's deprecated to compare a date to null, meaning of such comparison is ambiguous and will no longer be possible in 3.0.0, you should explicitly pass 'now' or make an other check to eliminate null values.");
        $this->assertFalse($before->eq(null));
        $expectOneError(\E_USER_DEPRECATED, "Since 2.61.0, it's deprecated to compare a date to null, meaning of such comparison is ambiguous and will no longer be possible in 3.0.0, you should explicitly pass 'now' or make an other check to eliminate null values.");
        $this->assertFalse(Carbon::now()->ne(false));
        $expectOneError(\E_USER_DEPRECATED, "Since 2.61.0, it's deprecated to compare a date to true or false, meaning of such comparison is ambiguous and will no longer be possible in 3.0.0, you should explicitly pass 'now' or make an other check to eliminate boolean values.");
        $this->assertTrue($before->ne(false));
        $expectOneError(\E_USER_DEPRECATED, "Since 2.61.0, it's deprecated to compare a date to true or false, meaning of such comparison is ambiguous and will no longer be possible in 3.0.0, you should explicitly pass 'now' or make an other check to eliminate boolean values.");
        $this->assertFalse(Carbon::now()->ne(null));
        $expectOneError(\E_USER_DEPRECATED, "Since 2.61.0, it's deprecated to compare a date to null, meaning of such comparison is ambiguous and will no longer be possible in 3.0.0, you should explicitly pass 'now' or make an other check to eliminate null values.");
        $this->assertTrue($before->ne(null));
        $expectOneError(\E_USER_DEPRECATED, "Since 2.61.0, it's deprecated to compare a date to null, meaning of such comparison is ambiguous and will no longer be possible in 3.0.0, you should explicitly pass 'now' or make an other check to eliminate null values.");
        $this->assertFalse($after->lt(false));
        $expectOneError(\E_USER_DEPRECATED, "Since 2.61.0, it's deprecated to compare a date to true or false, meaning of such comparison is ambiguous and will no longer be possible in 3.0.0, you should explicitly pass 'now' or make an other check to eliminate boolean values.");
        $this->assertTrue($before->lt(false));
        $expectOneError(\E_USER_DEPRECATED, "Since 2.61.0, it's deprecated to compare a date to true or false, meaning of such comparison is ambiguous and will no longer be possible in 3.0.0, you should explicitly pass 'now' or make an other check to eliminate boolean values.");
        $this->assertTrue($before->lt(null));
        $expectOneError(\E_USER_DEPRECATED, "Since 2.61.0, it's deprecated to compare a date to null, meaning of such comparison is ambiguous and will no longer be possible in 3.0.0, you should explicitly pass 'now' or make an other check to eliminate null values.");
        $this->assertFalse($after->lt(null));
        $expectOneError(\E_USER_DEPRECATED, "Since 2.61.0, it's deprecated to compare a date to null, meaning of such comparison is ambiguous and will no longer be possible in 3.0.0, you should explicitly pass 'now' or make an other check to eliminate null values.");
        $this->assertTrue($after->gt(false));
        $expectOneError(\E_USER_DEPRECATED, "Since 2.61.0, it's deprecated to compare a date to true or false, meaning of such comparison is ambiguous and will no longer be possible in 3.0.0, you should explicitly pass 'now' or make an other check to eliminate boolean values.");
        $this->assertFalse($before->gt(false));
        $expectOneError(\E_USER_DEPRECATED, "Since 2.61.0, it's deprecated to compare a date to true or false, meaning of such comparison is ambiguous and will no longer be possible in 3.0.0, you should explicitly pass 'now' or make an other check to eliminate boolean values.");
        $this->assertFalse($before->gt(null));
        $expectOneError(\E_USER_DEPRECATED, "Since 2.61.0, it's deprecated to compare a date to null, meaning of such comparison is ambiguous and will no longer be possible in 3.0.0, you should explicitly pass 'now' or make an other check to eliminate null values.");
        $this->assertTrue($after->gt(null));
        $expectOneError(\E_USER_DEPRECATED, "Since 2.61.0, it's deprecated to compare a date to null, meaning of such comparison is ambiguous and will no longer be possible in 3.0.0, you should explicitly pass 'now' or make an other check to eliminate null values.");
        $this->assertFalse($after->lte(false));
        $expectOneError(\E_USER_DEPRECATED, "Since 2.61.0, it's deprecated to compare a date to true or false, meaning of such comparison is ambiguous and will no longer be possible in 3.0.0, you should explicitly pass 'now' or make an other check to eliminate boolean values.");
        $this->assertTrue($before->lte(false));
        $expectOneError(\E_USER_DEPRECATED, "Since 2.61.0, it's deprecated to compare a date to true or false, meaning of such comparison is ambiguous and will no longer be possible in 3.0.0, you should explicitly pass 'now' or make an other check to eliminate boolean values.");
        $this->assertTrue($before->lte(null));
        $expectOneError(\E_USER_DEPRECATED, "Since 2.61.0, it's deprecated to compare a date to null, meaning of such comparison is ambiguous and will no longer be possible in 3.0.0, you should explicitly pass 'now' or make an other check to eliminate null values.");
        $this->assertFalse($after->lte(null));
        $expectOneError(\E_USER_DEPRECATED, "Since 2.61.0, it's deprecated to compare a date to null, meaning of such comparison is ambiguous and will no longer be possible in 3.0.0, you should explicitly pass 'now' or make an other check to eliminate null values.");
        $this->assertTrue($after->gte(false));
        $expectOneError(\E_USER_DEPRECATED, "Since 2.61.0, it's deprecated to compare a date to true or false, meaning of such comparison is ambiguous and will no longer be possible in 3.0.0, you should explicitly pass 'now' or make an other check to eliminate boolean values.");
        $this->assertFalse($before->gte(false));
        $expectOneError(\E_USER_DEPRECATED, "Since 2.61.0, it's deprecated to compare a date to true or false, meaning of such comparison is ambiguous and will no longer be possible in 3.0.0, you should explicitly pass 'now' or make an other check to eliminate boolean values.");
        $this->assertFalse($before->gte(null));
        $expectOneError(\E_USER_DEPRECATED, "Since 2.61.0, it's deprecated to compare a date to null, meaning of such comparison is ambiguous and will no longer be possible in 3.0.0, you should explicitly pass 'now' or make an other check to eliminate null values.");
        $this->assertTrue($after->gte(null));
        $expectOneError(\E_USER_DEPRECATED, "Since 2.61.0, it's deprecated to compare a date to null, meaning of such comparison is ambiguous and will no longer be possible in 3.0.0, you should explicitly pass 'now' or make an other check to eliminate null values.");
        restore_error_handler();
    }
}
