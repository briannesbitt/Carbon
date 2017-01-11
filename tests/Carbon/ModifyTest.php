<?php

/*
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

class ModifyTest extends AbstractTestCase
{
    public function testSimpleModify()
    {
        $a = new Carbon('2014-03-30 00:00:00');
        $b = $a->copy();
        $b->addHours(24);
        $this->assertSame(24, $a->diffInHours($b));
    }

    public function testTimezoneModify()
    {
        $a = new Carbon('2014-03-30 00:00:00', 'Europe/London');
        $b = $a->copy();
        $b->addHours(24);
        $this->assertSame(24, $a->diffInHours($b));
    }
}
