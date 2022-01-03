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
use Tests\AbstractTestCase;

class ModifyTest extends AbstractTestCase
{
    public function testSimpleModify()
    {
        $a = new Carbon('2014-03-30 00:00:00');
        $b = $a->addHours(24);
        $this->assertSame(24.0, $a->diffInHours($b));
    }

    /** @group php-8.1 */
    public function testTimezoneModify()
    {
        $php81Fix = version_compare(PHP_VERSION, '8.1.0-dev', '>=') ? 1.0 : 0.0;
        // For daylight saving time reason 2014-03-30 0h59 is immediately followed by 2h00

        $a = new Carbon('2014-03-30 00:00:00', 'Europe/London');
        $b = $a->addHours(24);
        $this->assertSame(23.0 + $php81Fix, $a->diffInHours($b));
        $this->assertSame(23.0 + $php81Fix, $b->diffInHours($a, true));
        $this->assertSame(-23.0 - $php81Fix, $b->diffInHours($a));
        $this->assertSame(-(23.0 + $php81Fix) * 60, $b->diffInMinutes($a));
        $this->assertSame(-(23.0 + $php81Fix) * 60 * 60, $b->diffInSeconds($a));
        $this->assertSame(-(23.0 + $php81Fix) * 60 * 60 * 1000, $b->diffInMilliseconds($a));
        $this->assertSame(-(23.0 + $php81Fix) * 60 * 60 * 1000000, $b->diffInMicroseconds($a));

        $a = new Carbon('2014-03-30 00:00:00', 'Europe/London');
        $b = $a->addUTCHours(24);
        $this->assertSame(-24.0, $b->diffInHours($a, false));
        $this->assertSame(-24.0 * 60, $b->diffInMinutes($a, false));
        $this->assertSame(-24.0 * 60 * 60, $b->diffInSeconds($a, false));
        $this->assertSame(-24.0 * 60 * 60 * 1000, $b->diffInMilliseconds($a, false));
        $this->assertSame(-24.0 * 60 * 60 * 1000000, $b->diffInMicroseconds($a, false));
        $b = $b->subUTCHours(24);
        $this->assertSame(0.0, $b->diffInHours($a, false));
        $this->assertSame(0.0, $b->diffInHours($a, false));

        $a = new Carbon('2014-03-30 00:59:00', 'Europe/London');
        $a = $a->addUTCHour();
        $this->assertSame('02:59', $a->format('H:i'));
        $a = $a->subUTCHour();
        $this->assertSame('00:59', $a->format('H:i'));

        $a = new Carbon('2014-03-30 00:59:00', 'Europe/London');
        $a = $a->addUTCMinutes(2);
        $this->assertSame('02:01', $a->format('H:i'));
        $a = $a->subUTCMinutes(2);
        $this->assertSame('00:59', $a->format('H:i'));

        $a = new Carbon('2014-03-30 00:59:30', 'Europe/London');
        $a = $a->addUTCMinute();
        $this->assertSame('02:00:30', $a->format('H:i:s'));
        $a = $a->subUTCMinute();
        $this->assertSame('00:59:30', $a->format('H:i:s'));

        $a = new Carbon('2014-03-30 00:59:30', 'Europe/London');
        $a = $a->addUTCSeconds(40);
        $this->assertSame('02:00:10', $a->format('H:i:s'));
        $a = $a->subUTCSeconds(40);
        $this->assertSame('00:59:30', $a->format('H:i:s'));

        $a = new Carbon('2014-03-30 00:59:59', 'Europe/London');
        $a = $a->addUTCSecond();
        $this->assertSame('02:00:00', $a->format('H:i:s'));
        $a = $a->subUTCSecond();
        $this->assertSame('00:59:59', $a->format('H:i:s'));

        $a = new Carbon('2014-03-30 00:59:59.990000', 'Europe/London');
        $a = $a->addUTCMilliseconds(20);
        $this->assertSame('02:00:00.010000', $a->format('H:i:s.u'));
        $a = $a->subUTCMilliseconds(20);
        $this->assertSame('00:59:59.990000', $a->format('H:i:s.u'));

        $a = new Carbon('2014-03-30 00:59:59.999990', 'Europe/London');
        $a = $a->addUTCMicroseconds(20);
        $this->assertSame('02:00:00.000010', $a->format('H:i:s.u'));
        $a = $a->subUTCMicroseconds(20);
        $this->assertSame('00:59:59.999990', $a->format('H:i:s.u'));

        $a = new Carbon('2014-03-30 00:59:59.999999', 'Europe/London');
        $a = $a->addUTCMicrosecond();
        $this->assertSame('02:00:00.000000', $a->format('H:i:s.u'));
        $a = $a->subUTCMicrosecond();
        $this->assertSame('00:59:59.999999', $a->format('H:i:s.u'));

        $a = new Carbon('2014-03-30 00:00:00', 'Europe/London');
        $b = $a->addUTCDay();
        $this->assertSame(-24.0, $b->diffInHours($a, false));
        $this->assertSame(-24.0 * 60, $b->diffInMinutes($a, false));
        $this->assertSame(-24.0 * 60 * 60, $b->diffInSeconds($a, false));
        $this->assertSame(-24.0 * 60 * 60 * 1000, $b->diffInMilliseconds($a, false));
        $this->assertSame(-24.0 * 60 * 60 * 1000000, $b->diffInMicroseconds($a, false));

        $a = new Carbon('2014-03-30 00:00:00', 'Europe/London');
        $b = $a->addUTCWeeks(1 / 7);
        $this->assertSame(-24.0, $b->diffInHours($a, false));
        $this->assertSame(-24.0 * 60, $b->diffInMinutes($a, false));
        $this->assertSame(-24.0 * 60 * 60, $b->diffInSeconds($a, false));
        $this->assertSame(-24.0 * 60 * 60 * 1000, $b->diffInMilliseconds($a, false));
        $this->assertSame(-24.0 * 60 * 60 * 1000000, $b->diffInMicroseconds($a, false));

        $a = new Carbon('2014-03-30 00:00:00', 'Europe/London');
        $b = $a->addUTCMonths(1 / 30);
        $this->assertSame(-24.0, $b->diffInHours($a, false));
        $this->assertSame(-24.0 * 60, $b->diffInMinutes($a, false));
        $this->assertSame(-24.0 * 60 * 60, $b->diffInSeconds($a, false));
        $this->assertSame(-24.0 * 60 * 60 * 1000, $b->diffInMilliseconds($a, false));
        $this->assertSame(-24.0 * 60 * 60 * 1000000, $b->diffInMicroseconds($a, false));

        $a = new Carbon('2014-03-30 00:00:00', 'Europe/London');
        $b = $a->addUTCQuarters(1 / 90);
        $this->assertSame(-24.0, $b->diffInHours($a, false));
        $this->assertSame(-24.0 * 60, $b->diffInMinutes($a, false));
        $this->assertSame(-24.0 * 60 * 60, $b->diffInSeconds($a, false));
        $this->assertSame(-24.0 * 60 * 60 * 1000, $b->diffInMilliseconds($a, false));
        $this->assertSame(-24.0 * 60 * 60 * 1000000, $b->diffInMicroseconds($a, false));

        $a = new Carbon('2014-03-30 00:00:00', 'Europe/London');
        $b = $a->addUTCYears(1 / 365);
        $this->assertSame(-24.0, $b->diffInHours($a, false));
        $this->assertSame(-24.0 * 60, $b->diffInMinutes($a, false));
        $this->assertSame(-24.0 * 60 * 60, $b->diffInSeconds($a, false));
        $this->assertSame(-24.0 * 60 * 60 * 1000, $b->diffInMilliseconds($a, false));
        $this->assertSame(-24.0 * 60 * 60 * 1000000, $b->diffInMicroseconds($a, false));

        $a = new Carbon('2014-03-30 00:00:00', 'Europe/London');
        $b = $a->addUTCDecades(1 / 3650);
        $this->assertSame(-24.0, $b->diffInHours($a, false));
        $this->assertSame(-24.0 * 60, $b->diffInMinutes($a, false));
        $this->assertSame(-24.0 * 60 * 60, $b->diffInSeconds($a, false));
        $this->assertSame(-24.0 * 60 * 60 * 1000, $b->diffInMilliseconds($a, false));
        $this->assertSame(-24.0 * 60 * 60 * 1000000, $b->diffInMicroseconds($a, false));

        $a = new Carbon('2014-03-30 00:00:00', 'Europe/London');
        $b = $a->addUTCCenturies(1 / 36500);
        $this->assertSame(-24.0, $b->diffInHours($a, false));
        $this->assertSame(-24.0 * 60, $b->diffInMinutes($a, false));
        $this->assertSame(-24.0 * 60 * 60, $b->diffInSeconds($a, false));
        $this->assertSame(-24.0 * 60 * 60 * 1000, $b->diffInMilliseconds($a, false));
        $this->assertSame(-24.0 * 60 * 60 * 1000000, $b->diffInMicroseconds($a, false));

        $a = new Carbon('2014-03-30 00:00:00', 'Europe/London');
        $b = $a->addUTCMillennia(1 / 365000);
        $this->assertSame(-24.0, $b->diffInHours($a, false));
        $this->assertSame(-24.0 * 60, $b->diffInMinutes($a, false));
        $this->assertSame(-24.0 * 60 * 60, $b->diffInSeconds($a, false));
        $this->assertSame(-24.0 * 60 * 60 * 1000, $b->diffInMilliseconds($a, false));
        $this->assertSame(-24.0 * 60 * 60 * 1000000, $b->diffInMicroseconds($a, false));
    }

    public function testNextAndPrevious()
    {
        Carbon::setTestNow('2019-06-02 13:27:09.816752');

        $this->assertSame('2019-06-02 14:00:00', Carbon::now()->next('2pm')->format('Y-m-d H:i:s'));
        $this->assertSame('2019-06-01 14:00:00', Carbon::now()->previous('2pm')->format('Y-m-d H:i:s'));
        $this->assertSame('2019-06-02 14:00:00', Carbon::now()->next('14h')->format('Y-m-d H:i:s'));
        $this->assertSame('2019-06-01 14:00:00', Carbon::now()->previous('14h')->format('Y-m-d H:i:s'));
        $this->assertSame('2019-06-03 09:00:00', Carbon::now()->next('9am')->format('Y-m-d H:i:s'));
        $this->assertSame('2019-06-02 09:00:00', Carbon::now()->previous('9am')->format('Y-m-d H:i:s'));

        $this->assertSame('2019-06-02 14:00:00', Carbon::parse('next 2pm')->format('Y-m-d H:i:s'));
        $this->assertSame('2019-06-01 14:00:00', Carbon::parse('previous 2pm')->format('Y-m-d H:i:s'));
        $this->assertSame('2019-06-02 14:00:00', Carbon::parse('next 14h')->format('Y-m-d H:i:s'));
        $this->assertSame('2019-06-01 14:00:00', Carbon::parse('previous 14h')->format('Y-m-d H:i:s'));
        $this->assertSame('2019-06-03 09:00:00', Carbon::parse('next 9am')->format('Y-m-d H:i:s'));
        $this->assertSame('2019-06-02 09:00:00', Carbon::parse('previous 9am')->format('Y-m-d H:i:s'));
    }
}
