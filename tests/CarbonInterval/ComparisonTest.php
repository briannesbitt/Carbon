<?php
declare(strict_types = 1);

/**
 * This file is part of the Carbon package.
 *
 * (c) Brian Nesbitt <brian@nesbot.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Tests\CarbonInterval;

use Carbon\CarbonInterval;
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
    }

    public function testEqualToFalse()
    {
        $oneDay = CarbonInterval::day();
        $this->assertFalse($oneDay->equalTo(CarbonInterval::hours(24)->microsecond(1)));
        $this->assertFalse($oneDay->eq(CarbonInterval::hours(24)->microsecond(1)));
        $this->assertFalse($oneDay->eq(CarbonInterval::hours(23)->minutes(59)->seconds(59)->microseconds(999999)));
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
}
