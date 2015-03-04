<?php

/*
 * This file is part of the Carbon package.
 *
 * (c) Brian Nesbitt <brian@nesbot.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Carbon\CarbonInterval;

class CarbonIntervalForHumansTest extends TestFixture
{
    public function testYear()
    {
        $this->assertSame('1 year', CarbonInterval::year()->forHumans());
    }

    public function testYears()
    {
        $this->assertSame('2 years', CarbonInterval::years(2)->forHumans());
    }

    public function testYearsAndMonth()
    {
        $this->assertSame('2 years 1 month', CarbonInterval::create(2, 1)->forHumans());
    }

    public function testYearsAndMonthInFrench()
    {
        CarbonInterval::setLocale('fr');
        $this->assertSame('2 ans 1 mois', CarbonInterval::create(2, 1)->forHumans());
    }
}
