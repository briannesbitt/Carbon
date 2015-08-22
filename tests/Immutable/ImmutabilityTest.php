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

use TestFixture;
use Carbon\CarbonImmutable;

class ImmutabilityTest extends TestFixture
{
    public function testAdd()
    {
        $dt1 = CarbonImmutable::createFromDate(2000, 1, 1);
        $dt2 = $dt1->addDay();
        $this->assertNotEquals($dt1, $dt2);
        $this->assertCarbonImmutable($dt1, 2000, 1, 1);
        $this->assertCarbonImmutable($dt2, 2000, 1, 2);
    }

    public function testSet()
    {
        $dt1 = CarbonImmutable::createFromDate(2000, 1, 1);
        $dt2 = $dt1->setDateTime(2001, 2, 2, 10, 20, 30);
        $this->assertNotEquals($dt1, $dt2);
        $this->assertCarbonImmutable($dt1, 2000, 1, 1);
        $this->assertCarbonImmutable($dt2, 2001, 2, 2, 10, 20, 30);
    }
}
