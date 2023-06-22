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

use Carbon\CarbonInterface;
use Carbon\CarbonInterval;
use Carbon\Exceptions\InvalidFormatException;
use DateInterval;
use Tests\AbstractTestCase;

class ComparisonTest extends AbstractTestCase
{
    public function testEqualToTrue()
    {
        $oneDay = CarbonInterval::day();
        $this->assertTrue($oneDay->equalTo($oneDay));
        $this->assertTrue($oneDay->eq($oneDay));
        $this->assertTrue($oneDay->eq(CarbonInterval::day()));
        $this->assertTrue($oneDay->eq(new DateInterval('P1D')));
        $this->assertTrue($oneDay->eq(CarbonInterval::hours(24)));
        $this->assertTrue($oneDay->eq(CarbonInterval::hours(23)->minutes(60)));
        $this->assertTrue($oneDay->eq('24 hours'));
        $this->assertTrue($oneDay->eq('P1D'));
        $this->assertTrue(CarbonInterval::day()->invert()->eq(CarbonInterval::days(-1)));
        $this->assertTrue(CarbonInterval::day()->sub('1 day')->eq(CarbonInterval::create()));
        $nextWeekday = function (CarbonInterface $date) {
            return $date->nextWeekday();
        };
        $this->assertTrue(CarbonInterval::create($nextWeekday)->eq(CarbonInterval::create($nextWeekday)));
    }

    public function testEqualToFalse()
    {
        $oneDay = CarbonInterval::day();
        $this->assertFalse($oneDay->equalTo(CarbonInterval::hours(24)->microsecond(1)));
        $this->assertFalse($oneDay->equalTo(['not-valid']));
        $this->assertFalse($oneDay->eq(CarbonInterval::hours(24)->microsecond(1)));
        $this->assertFalse($oneDay->eq(CarbonInterval::hours(23)->minutes(59)->seconds(59)->microseconds(999999)));
        $nextWeekday = function (CarbonInterface $date) {
            return $date->nextWeekday();
        };
        $nextWeekendDay = function (CarbonInterface $date) {
            return $date->nextWeekendDay();
        };
        $this->assertFalse(CarbonInterval::create($nextWeekday)->eq(CarbonInterval::create($nextWeekendDay)));
    }

    public function testNotEqualToTrue()
    {
        $oneDay = CarbonInterval::day();
        $this->assertTrue($oneDay->notEqualTo(CarbonInterval::hours(24)->microsecond(1)));
        $this->assertTrue($oneDay->ne(CarbonInterval::hours(24)->microsecond(1)));
        $this->assertTrue($oneDay->ne(CarbonInterval::hours(23)->minutes(59)->seconds(59)->microseconds(999999)));
    }

    public function testNotEqualToFalse()
    {
        $oneDay = CarbonInterval::day();
        $this->assertFalse($oneDay->notEqualTo($oneDay));
        $this->assertFalse($oneDay->ne($oneDay));
        $this->assertFalse($oneDay->ne(CarbonInterval::day()));
        $this->assertFalse($oneDay->ne(new DateInterval('P1D')));
        $this->assertFalse($oneDay->ne(CarbonInterval::hours(24)));
        $this->assertFalse($oneDay->ne(CarbonInterval::hours(23)->minutes(60)));
        $this->assertFalse($oneDay->ne('24 hours'));
        $this->assertFalse($oneDay->ne('P1D'));
    }

    public function testGreaterThanToTrue()
    {
        $oneDay = CarbonInterval::day();
        $this->assertTrue($oneDay->greaterThan(CarbonInterval::day()->sub(1, 'microseconds')));
        $this->assertTrue($oneDay->gt(CarbonInterval::day()->sub(1, 'microseconds')));
        $this->assertTrue($oneDay->gt(new DateInterval('P0DT23H59M59S')));
        $this->assertTrue($oneDay->gt(CarbonInterval::hours(23)->minutes(59)->seconds(59)->microseconds(999999)));
        $this->assertTrue($oneDay->gt('23 hours 59 minutes 59 seconds 999999 microseconds'));
        $this->assertTrue($oneDay->gt('P0DT23H59M59S'));
    }

    public function testGreaterThanError()
    {
        $this->expectExceptionObject(new InvalidFormatException(
            'Could not create interval from: '.var_export('xxx', true),
        ));

        CarbonInterval::day()->gt('xxx');
    }

    public function testGreaterThanToFalse()
    {
        $oneDay = CarbonInterval::day();
        $this->assertFalse($oneDay->greaterThan($oneDay));
        $this->assertFalse($oneDay->gt($oneDay));
        $this->assertFalse($oneDay->gt(CarbonInterval::day()));
        $this->assertFalse($oneDay->gt(CarbonInterval::hours(23)->minutes(60)));

        $this->assertFalse($oneDay->greaterThan(CarbonInterval::day()->add(1, 'microseconds')));
        $this->assertFalse($oneDay->gt(CarbonInterval::day()->add(1, 'microseconds')));
        $this->assertFalse($oneDay->gt(CarbonInterval::hours(23)->minutes(59)->seconds(59)->milliseconds(1001)));
    }

    public function testGreaterThanOrEqualToTrue()
    {
        $oneDay = CarbonInterval::day();
        $this->assertTrue($oneDay->greaterThanOrEqualTo($oneDay));
        $this->assertTrue($oneDay->gte($oneDay));
        $this->assertTrue($oneDay->gte(CarbonInterval::day()));
        $this->assertTrue($oneDay->gte(CarbonInterval::hours(23)->minutes(60)));

        $this->assertTrue($oneDay->greaterThanOrEqualTo(CarbonInterval::day()->sub(1, 'microseconds')));
        $this->assertTrue($oneDay->gte(CarbonInterval::day()->sub(1, 'microseconds')));
        $this->assertTrue($oneDay->gte(CarbonInterval::hours(23)->minutes(59)->seconds(59)->microseconds(999999)));
    }

    public function testGreaterThanOrEqualError()
    {
        $this->expectExceptionObject(new InvalidFormatException(
            'Could not create interval from: '.var_export('xxx', true),
        ));

        CarbonInterval::day()->gte('xxx');
    }

    public function testGreaterThanOrEqualToFalse()
    {
        $oneDay = CarbonInterval::day();
        $this->assertFalse($oneDay->greaterThanOrEqualTo(CarbonInterval::day()->add(1, 'microseconds')));
        $this->assertFalse($oneDay->gte(CarbonInterval::day()->add(1, 'microseconds')));
        $this->assertFalse($oneDay->gte(new DateInterval('P0DT23H59M61S')));
        $this->assertFalse($oneDay->gte(CarbonInterval::hours(23)->minutes(59)->seconds(59)->milliseconds(1001)));
        $this->assertFalse($oneDay->gte('23 hours 59 minutes 59 seconds 59 milliseconds 1001 milliseconds'));
        $this->assertFalse($oneDay->gte('P0DT23H59M61S'));
    }

    public function testLessThanToTrue()
    {
        $oneDay = CarbonInterval::day();
        $this->assertTrue($oneDay->lessThan(CarbonInterval::day()->add(1, 'microseconds')));
        $this->assertTrue($oneDay->lt(CarbonInterval::day()->add(1, 'microseconds')));
        $this->assertTrue($oneDay->lt(new DateInterval('P0DT23H59M61S')));
        $this->assertTrue($oneDay->lt(CarbonInterval::hours(23)->minutes(59)->seconds(59)->milliseconds(1001)));
        $this->assertTrue($oneDay->lt('23 hours 59 minutes 59 seconds 59 milliseconds 1001 milliseconds'));
        $this->assertTrue($oneDay->lt('P0DT23H59M61S'));
    }

    public function testLessThanToFalse()
    {
        $oneDay = CarbonInterval::day();
        $this->assertFalse($oneDay->lessThan($oneDay));
        $this->assertFalse($oneDay->lt($oneDay));
        $this->assertFalse($oneDay->lt(CarbonInterval::day()));
        $this->assertFalse($oneDay->lt(CarbonInterval::hours(23)->minutes(60)));

        $this->assertFalse($oneDay->lessThan(CarbonInterval::day()->sub(1, 'microseconds')));
        $this->assertFalse($oneDay->lt(CarbonInterval::day()->sub(1, 'microseconds')));
        $this->assertFalse($oneDay->lt(CarbonInterval::hours(23)->minutes(59)->seconds(59)->microseconds(999999)));
    }

    public function testLessThanError()
    {
        $this->expectExceptionObject(new InvalidFormatException(
            'Could not create interval from: '.var_export('xxx', true),
        ));

        CarbonInterval::day()->lt('xxx');
    }

    public function testLessThanOrEqualToTrue()
    {
        $oneDay = CarbonInterval::day();
        $this->assertTrue($oneDay->lessThanOrEqualTo($oneDay));
        $this->assertTrue($oneDay->lte($oneDay));
        $this->assertTrue($oneDay->lte(CarbonInterval::day()));
        $this->assertTrue($oneDay->lte(CarbonInterval::hours(23)->minutes(60)));

        $this->assertTrue($oneDay->lessThanOrEqualTo(CarbonInterval::day()->add(1, 'microseconds')));
        $this->assertTrue($oneDay->lte(CarbonInterval::day()->add(1, 'microseconds')));
        $this->assertTrue($oneDay->lte(CarbonInterval::hours(23)->minutes(59)->seconds(59)->milliseconds(1001)));
    }

    public function testLessThanOrEqualToFalse()
    {
        $oneDay = CarbonInterval::day();
        $this->assertFalse($oneDay->lessThanOrEqualTo(CarbonInterval::day()->sub(1, 'microseconds')));
        $this->assertFalse($oneDay->lte(CarbonInterval::day()->sub(1, 'microseconds')));
        $this->assertFalse($oneDay->lte(new DateInterval('P0DT23H59M59S')));
        $this->assertFalse($oneDay->lte(CarbonInterval::hours(23)->minutes(59)->seconds(59)->microseconds(999999)));
        $this->assertFalse($oneDay->lte('23 hours 59 minutes 59 seconds 999999 microseconds'));
        $this->assertFalse($oneDay->lte('P0DT23H59M59S'));
    }

    public function testLessThanOrEqualError()
    {
        $this->expectExceptionObject(new InvalidFormatException(
            'Could not create interval from: '.var_export('xxx', true),
        ));

        CarbonInterval::day()->lte('xxx');
    }

    public function testBetweenFalse()
    {
        $oneDay = CarbonInterval::day();
        $this->assertFalse($oneDay->between(CarbonInterval::days(2), CarbonInterval::days(3)));

        $twoDays = CarbonInterval::hours(48);
        $this->assertFalse($twoDays->between(CarbonInterval::day(), CarbonInterval::days(2), false));
    }

    public function testBetweenTrue()
    {
        $oneDay = CarbonInterval::day();
        $this->assertTrue($oneDay->between(CarbonInterval::hours(12), CarbonInterval::hours(36)));

        $twoDays = CarbonInterval::hours(48);
        $this->assertTrue($twoDays->between(CarbonInterval::day(), CarbonInterval::days(3), false));
        $this->assertTrue($twoDays->between(CarbonInterval::day(), CarbonInterval::days(3), true));
        $this->assertTrue($twoDays->between(CarbonInterval::day(), CarbonInterval::days(3)));
        $this->assertTrue($twoDays->between(CarbonInterval::day(), CarbonInterval::days(2)));
    }

    public function testBetweenIncludedFalse()
    {
        $oneDay = CarbonInterval::day();
        $this->assertFalse($oneDay->betweenIncluded(CarbonInterval::days(2), CarbonInterval::days(3)));
    }

    public function testBetweenIncludedTrue()
    {
        $oneDay = CarbonInterval::day();
        $this->assertTrue($oneDay->betweenIncluded(CarbonInterval::hours(12), CarbonInterval::hours(36)));

        $twoDays = CarbonInterval::hours(48);
        $this->assertTrue($twoDays->betweenIncluded(CarbonInterval::day(), CarbonInterval::days(2)));
    }

    public function testBetweenExcludedFalse()
    {
        $oneDay = CarbonInterval::day();
        $this->assertFalse($oneDay->betweenExcluded(CarbonInterval::days(2), CarbonInterval::days(3)));

        $twoDays = CarbonInterval::hours(48);
        $this->assertFalse($twoDays->betweenExcluded(CarbonInterval::day(), CarbonInterval::days(2)));
    }

    public function testIsBetweenTrue()
    {
        $oneDay = CarbonInterval::day();
        $this->assertTrue($oneDay->isBetween(CarbonInterval::hours(12), CarbonInterval::hours(36)));

        $twoDays = CarbonInterval::hours(48);
        $this->assertTrue($twoDays->isBetween(CarbonInterval::day(), CarbonInterval::days(3), false));
        $this->assertTrue($twoDays->isBetween(CarbonInterval::day(), CarbonInterval::days(3), true));
        $this->assertTrue($twoDays->isBetween(CarbonInterval::day(), CarbonInterval::days(3)));
        $this->assertTrue($twoDays->isBetween(CarbonInterval::day(), CarbonInterval::days(2)));
    }
}
