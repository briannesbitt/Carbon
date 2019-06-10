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
        // For daylight saving time reason 2014-03-30 0h59 is immediately followed by 2h00

        $a = new Carbon('2014-03-30 00:00:00', 'Europe/London');
        $b = $a->copy();
        $b->addHours(24);
        $this->assertSame(24, $a->diffInHours($b));
        $this->assertSame(24, $a->diffInHours($b, false));
        $this->assertSame(24, $b->diffInHours($a));
        $this->assertSame(-24, $b->diffInHours($a, false));
        $this->assertSame(-23, $b->diffInRealHours($a, false));
        $this->assertSame(-23 * 60, $b->diffInRealMinutes($a, false));
        $this->assertSame(-23 * 60 * 60, $b->diffInRealSeconds($a, false));

        if (version_compare(PHP_VERSION, '7.1.8-dev', '>=')) {
            $this->assertSame(-24 * 60 * 60 * 1000, $b->diffInMilliseconds($a, false));
            $this->assertSame(-23 * 60 * 60 * 1000, $b->diffInRealMilliseconds($a, false));
            $this->assertSame(-23 * 60 * 60 * 1000000, $b->diffInRealMicroseconds($a, false));
            $this->assertSame(-24 * 60 * 60 * 1000000, $b->diffInMicroseconds($a, false));
        }

        $a = new Carbon('2014-03-30 00:00:00', 'Europe/London');
        $b = $a->copy();
        $b->addRealHours(24);
        $this->assertSame(-24, $b->diffInRealHours($a, false));
        $this->assertSame(-24 * 60, $b->diffInRealMinutes($a, false));
        $this->assertSame(-24 * 60 * 60, $b->diffInRealSeconds($a, false));

        if (version_compare(PHP_VERSION, '7.1.8-dev', '>=')) {
            $this->assertSame(-25 * 60 * 60 * 1000, $b->diffInMilliseconds($a, false));
            $this->assertSame(-24 * 60 * 60 * 1000, $b->diffInRealMilliseconds($a, false));
            $this->assertSame(-24 * 60 * 60 * 1000000, $b->diffInRealMicroseconds($a, false));
            $this->assertSame(-25 * 60 * 60 * 1000000, $b->diffInMicroseconds($a, false));
        }

        $this->assertSame(-25, $b->diffInHours($a, false));
        $b->subRealHours(24);
        $this->assertSame(0, $b->diffInRealHours($a, false));
        $this->assertSame(0, $b->diffInHours($a, false));

        $a = new Carbon('2014-03-30 00:59:00', 'Europe/London');
        $a->addRealHour();
        $this->assertSame('02:59', $a->format('H:i'));
        $a->subRealHour();
        $this->assertSame('00:59', $a->format('H:i'));

        $a = new Carbon('2014-03-30 00:59:00', 'Europe/London');
        $a->addRealMinutes(2);
        $this->assertSame('02:01', $a->format('H:i'));
        $a->subRealMinutes(2);
        $this->assertSame('00:59', $a->format('H:i'));

        $a = new Carbon('2014-03-30 00:59:30', 'Europe/London');
        $a->addRealMinute();
        $this->assertSame('02:00:30', $a->format('H:i:s'));
        $a->subRealMinute();
        $this->assertSame('00:59:30', $a->format('H:i:s'));

        $a = new Carbon('2014-03-30 00:59:30', 'Europe/London');
        $a->addRealSeconds(40);
        $this->assertSame('02:00:10', $a->format('H:i:s'));
        $a->subRealSeconds(40);
        $this->assertSame('00:59:30', $a->format('H:i:s'));

        $a = new Carbon('2014-03-30 00:59:59', 'Europe/London');
        $a->addRealSecond();
        $this->assertSame('02:00:00', $a->format('H:i:s'));
        $a->subRealSecond();
        $this->assertSame('00:59:59', $a->format('H:i:s'));
    }
}
