<?php

/*
 * This file is part of the Carbon package.
 *
 * (c) Brian Nesbitt <brian@nesbot.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Mutable;

use TestFixture;
use Carbon\Carbon;

class MutabilityTest extends TestFixture
{
    public function testAdd()
    {
        $dt1 = Carbon::createFromDate(2000, 1, 1);
        $dt2 = $dt1->addDay();
        $this->assertEquals($dt1, $dt2);
    }

    public function testSet()
    {
        $dt1 = Carbon::createFromDate(2000, 1, 1);
        $dt2 = $dt1->setDateTime(2001, 2, 2, 10, 20, 30);
        $this->assertEquals($dt1, $dt2);
    }
}
