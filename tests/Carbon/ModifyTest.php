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
use InvalidArgumentException;
use Tests\AbstractTestCase;

class ModifyTest extends AbstractTestCase
{
    public function testSimpleModify()
    {
        $a = new Carbon('2014-03-30 00:00:00');
        $b = $a->copy();
        $b->addHours(24);
        $this->assertSame(24.0, $a->diffInHours($b));
    }

    /** @group php-8.1 */
    public function testTimezoneModify()
    {
        $php81Fix = version_compare(PHP_VERSION, '8.1.0-dev', '>=') ? 1.0 : 0.0;
        // For daylight saving time reason 2014-03-30 0h59 is immediately followed by 2h00

        $a = new Carbon('2014-03-30 00:00:00', 'Europe/London');
        $b = $a->copy();
        $b->addHours(24);
        $this->assertSame(23.0 + $php81Fix, $a->diffInUTCHours($b));
        $this->assertSame(23.0 + $php81Fix, $b->diffInUTCHours($a, true));
        $this->assertSame(-(23.0 + $php81Fix), $b->diffInUTCHours($a));
        $this->assertSame(-(23.0 + $php81Fix) * 60, $b->diffInUTCMinutes($a));
        $this->assertSame(-(23.0 + $php81Fix) * 60 * 60, $b->diffInUTCSeconds($a));
        $this->assertSame(-(23.0 + $php81Fix) * 60 * 60 * 1000, $b->diffInUTCMilliseconds($a));
        $this->assertSame(-(23.0 + $php81Fix) * 60 * 60 * 1000000, $b->diffInUTCMicroseconds($a));

        $a = new Carbon('2014-03-30 00:00:00', 'Europe/London');
        $b = $a->copy();
        $b->addUTCHours(24);
        $this->assertSame(-24.0, $b->diffInHours($a, false));
        $this->assertSame(-24.0 * 60, $b->diffInMinutes($a, false));
        $this->assertSame(-24.0 * 60 * 60, $b->diffInSeconds($a, false));
        $this->assertSame(-24.0 * 60 * 60 * 1000, $b->diffInMilliseconds($a, false));
        $this->assertSame(-24.0 * 60 * 60 * 1000000, $b->diffInMicroseconds($a, false));
        $b->subUTCHours(24);
        $this->assertSame(0.0, $b->diffInHours($a, false));
        $this->assertSame(0.0, $b->diffInHours($a, false));

        $a = new Carbon('2014-03-30 00:59:00', 'Europe/London');
        $a->addUTCHour();
        $this->assertSame('02:59', $a->format('H:i'));
        $a->subUTCHour();
        $this->assertSame('00:59', $a->format('H:i'));

        $a = new Carbon('2014-03-30 00:59:00', 'Europe/London');
        $a->addUTCMinutes(2);
        $this->assertSame('02:01', $a->format('H:i'));
        $a->subUTCMinutes(2);
        $this->assertSame('00:59', $a->format('H:i'));

        $a = new Carbon('2014-03-30 00:59:30', 'Europe/London');
        $a->addUTCMinute();
        $this->assertSame('02:00:30', $a->format('H:i:s'));
        $a->subUTCMinute();
        $this->assertSame('00:59:30', $a->format('H:i:s'));

        $a = new Carbon('2014-03-30 00:59:30', 'Europe/London');
        $a->addUTCSeconds(40);
        $this->assertSame('02:00:10', $a->format('H:i:s'));
        $a->subUTCSeconds(40);
        $this->assertSame('00:59:30', $a->format('H:i:s'));

        $a = new Carbon('2014-03-30 00:59:59', 'Europe/London');
        $a->addUTCSecond();
        $this->assertSame('02:00:00', $a->format('H:i:s'));
        $a->subUTCSecond();
        $this->assertSame('00:59:59', $a->format('H:i:s'));

        $a = new Carbon('2014-03-30 00:59:59.990000', 'Europe/London');
        $a->addUTCMilliseconds(20);
        $this->assertSame('02:00:00.010000', $a->format('H:i:s.u'));
        $a->subUTCMilliseconds(20);
        $this->assertSame('00:59:59.990000', $a->format('H:i:s.u'));

        $a = new Carbon('2014-03-30 00:59:59.999990', 'Europe/London');
        $a->addUTCMicroseconds(20);
        $this->assertSame('02:00:00.000010', $a->format('H:i:s.u'));
        $a->subUTCMicroseconds(20);
        $this->assertSame('00:59:59.999990', $a->format('H:i:s.u'));

        $a = new Carbon('2014-03-30 00:59:59.999999', 'Europe/London');
        $a->addUTCMicrosecond();
        $this->assertSame('02:00:00.000000', $a->format('H:i:s.u'));
        $a->subUTCMicrosecond();
        $this->assertSame('00:59:59.999999', $a->format('H:i:s.u'));

        $a = new Carbon('2014-03-30 00:00:00', 'Europe/London');
        $b = $a->copy();
        $b->addUTCDay();
        $this->assertSame(-24.0, $b->diffInHours($a, false));
        $this->assertSame(-24.0 * 60, $b->diffInMinutes($a, false));
        $this->assertSame(-24.0 * 60 * 60, $b->diffInSeconds($a, false));
        $this->assertSame(-24.0 * 60 * 60 * 1000, $b->diffInMilliseconds($a, false));
        $this->assertSame(-24.0 * 60 * 60 * 1000000, $b->diffInMicroseconds($a, false));

        $a = new Carbon('2014-03-30 00:00:00', 'Europe/London');
        $b = $a->copy();
        $b->addUTCWeeks(1 / 7);
        $this->assertSame(-24.0, $b->diffInHours($a, false));
        $this->assertSame(-24.0 * 60, $b->diffInMinutes($a, false));
        $this->assertSame(-24.0 * 60 * 60, $b->diffInSeconds($a, false));
        $this->assertSame(-24.0 * 60 * 60 * 1000, $b->diffInMilliseconds($a, false));
        $this->assertSame(-24.0 * 60 * 60 * 1000000, $b->diffInMicroseconds($a, false));

        $a = new Carbon('2014-03-30 00:00:00', 'Europe/London');
        $b = $a->copy();
        $b->addUTCMonths(1 / 30);
        $this->assertSame(-24.0, $b->diffInHours($a, false));
        $this->assertSame(-24.0 * 60, $b->diffInMinutes($a, false));
        $this->assertSame(-24.0 * 60 * 60, $b->diffInSeconds($a, false));
        $this->assertSame(-24.0 * 60 * 60 * 1000, $b->diffInMilliseconds($a, false));
        $this->assertSame(-24.0 * 60 * 60 * 1000000, $b->diffInMicroseconds($a, false));

        $a = new Carbon('2014-03-30 00:00:00', 'Europe/London');
        $b = $a->copy();
        $b->addUTCQuarters(1 / 90);
        $this->assertSame(-24.0, $b->diffInHours($a, false));
        $this->assertSame(-24.0 * 60, $b->diffInMinutes($a, false));
        $this->assertSame(-24.0 * 60 * 60, $b->diffInSeconds($a, false));
        $this->assertSame(-24.0 * 60 * 60 * 1000, $b->diffInMilliseconds($a, false));
        $this->assertSame(-24.0 * 60 * 60 * 1000000, $b->diffInMicroseconds($a, false));

        $a = new Carbon('2014-03-30 00:00:00', 'Europe/London');
        $b = $a->copy();
        $b->addUTCYears(1 / 365);
        $this->assertSame(-24.0, $b->diffInHours($a, false));
        $this->assertSame(-24.0 * 60, $b->diffInMinutes($a, false));
        $this->assertSame(-24.0 * 60 * 60, $b->diffInSeconds($a, false));
        $this->assertSame(-24.0 * 60 * 60 * 1000, $b->diffInMilliseconds($a, false));
        $this->assertSame(-24.0 * 60 * 60 * 1000000, $b->diffInMicroseconds($a, false));

        $a = new Carbon('2014-03-30 00:00:00', 'Europe/London');
        $b = $a->copy();
        $b->addUTCDecades(1 / 3650);
        $this->assertSame(-24.0, $b->diffInHours($a, false));
        $this->assertSame(-24.0 * 60, $b->diffInMinutes($a, false));
        $this->assertSame(-24.0 * 60 * 60, $b->diffInSeconds($a, false));
        $this->assertSame(-24.0 * 60 * 60 * 1000, $b->diffInMilliseconds($a, false));
        $this->assertSame(-24.0 * 60 * 60 * 1000000, $b->diffInMicroseconds($a, false));

        $a = new Carbon('2014-03-30 00:00:00', 'Europe/London');
        $b = $a->copy();
        $b->addUTCCenturies(1 / 36500);
        $this->assertSame(-24.0, $b->diffInHours($a, false));
        $this->assertSame(-24.0 * 60, $b->diffInMinutes($a, false));
        $this->assertSame(-24.0 * 60 * 60, $b->diffInSeconds($a, false));
        $this->assertSame(-24.0 * 60 * 60 * 1000, $b->diffInMilliseconds($a, false));
        $this->assertSame(-24.0 * 60 * 60 * 1000000, $b->diffInMicroseconds($a, false));

        $a = new Carbon('2014-03-30 00:00:00', 'Europe/London');
        $b = $a->copy();
        $b->addUTCMillennia(1 / 365000);
        $this->assertSame(-24.0, $b->diffInHours($a, false));
        $this->assertSame(-24.0 * 60, $b->diffInMinutes($a, false));
        $this->assertSame(-24.0 * 60 * 60, $b->diffInSeconds($a, false));
        $this->assertSame(-24.0 * 60 * 60 * 1000, $b->diffInMilliseconds($a, false));
        $this->assertSame(-24.0 * 60 * 60 * 1000000, $b->diffInMicroseconds($a, false));
    }

    public function testAddUTCUnitException()
    {
        $this->expectExceptionObject(new InvalidArgumentException(
            'Invalid unit for real timestamp add/sub: \'foobar\'',
        ));

        (new Carbon('2014-03-30 00:00:00'))->addUTCUnit('foobar');
    }

    public function testAddUTCMicrosecondWithLowFloatPrecision()
    {
        $precision = ini_set('precision', '9');

        $a = new Carbon('2014-03-30 00:59:59.999999', 'Europe/London');
        $a->addUTCMicrosecond();
        $this->assertSame('02:00:00.000000', $a->format('H:i:s.u'));

        ini_set('precision', $precision);
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

        $this->assertSame(
            '2019-06-04 00:00:00',
            Carbon::parse('after tomorrow')->format('Y-m-d H:i:s'),
        );
        $this->assertSame(
            '2000-01-27 00:00:00',
            Carbon::parse('2000-01-25')->change('after tomorrow')->format('Y-m-d H:i:s'),
        );
        $this->assertSame(
            '2019-05-31 00:00:00',
            Carbon::parse('before yesterday')->format('Y-m-d H:i:s'),
        );
        $this->assertSame(
            '2000-01-23 00:00:00',
            Carbon::parse('2000-01-25')->change('before yesterday')->format('Y-m-d H:i:s'),
        );
    }
}
