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
use DateTime;
use Tests\AbstractTestCase;
use Tests\Carbon\Fixtures\MyCarbon;

class StringsTest extends AbstractTestCase
{
    public function testToStringCast()
    {
        $d = Carbon::now();
        $this->assertSame(Carbon::now()->toDateTimeString(), ''.$d);
    }

    public function testToString()
    {
        $d = Carbon::create(1975, 12, 25, 14, 15, 16);
        $this->assertSame('Thu Dec 25 1975 14:15:16 GMT-0500', $d->toString());
    }

    public function testToISOString()
    {
        $d = Carbon::create(1975, 12, 25, 14, 15, 16);
        $this->assertSame('1975-12-25T19:15:16.000000Z', $d->toISOString());
        $d = Carbon::create(21975, 12, 25, 14, 15, 16);
        $this->assertSame('+021975-12-25T19:15:16.000000Z', $d->toISOString());
        $d = Carbon::create(-75, 12, 25, 14, 15, 16);
        $this->assertStringStartsWith('-000075-', $d->toISOString());
        $d = Carbon::create(1975, 12, 25, 14, 15, 16);
        $this->assertSame('1975-12-25T14:15:16.000000-05:00', $d->toISOString(true));
        $d = Carbon::create(21975, 12, 25, 14, 15, 16);
        $this->assertSame('+021975-12-25T14:15:16.000000-05:00', $d->toISOString(true));
        $d = Carbon::create(-75, 12, 25, 14, 15, 16);
        $this->assertStringStartsWith('-000075-', $d->toISOString(true));
        $d = Carbon::create(1975, 12, 25, 14, 15, 16);
        $this->assertSame('1975-12-25T19:15:16.000000Z', $d->toJSON());
        $d = Carbon::create(21975, 12, 25, 14, 15, 16);
        $this->assertSame('+021975-12-25T19:15:16.000000Z', $d->toJSON());
        $d = Carbon::create(-75, 12, 25, 14, 15, 16);
        $this->assertStringStartsWith('-000075-', $d->toJSON());
        $d = Carbon::create(0);
        $this->assertNull($d->toISOString());
    }

    public function testSetToStringFormatString()
    {
        Carbon::setToStringFormat('jS \o\f F, Y g:i:s a');
        $d = Carbon::create(1975, 12, 25, 14, 15, 16);
        $this->assertSame('25th of December, 1975 2:15:16 pm', ''.$d);
    }

    public function testSetToStringFormatClosure()
    {
        Carbon::setToStringFormat(function ($d) {
            return $d->year === 1976 ?
                'jS \o\f F g:i:s a' :
                'jS \o\f F, Y g:i:s a';
        });

        $d = Carbon::create(1976, 12, 25, 14, 15, 16);
        $this->assertSame('25th of December 2:15:16 pm', ''.$d);

        $d = Carbon::create(1975, 12, 25, 14, 15, 16);
        $this->assertSame('25th of December, 1975 2:15:16 pm', ''.$d);
    }

    public function testResetToStringFormat()
    {
        $d = Carbon::now();
        Carbon::setToStringFormat('123');
        Carbon::resetToStringFormat();
        $this->assertSame($d->toDateTimeString(), ''.$d);
    }

    public function testExtendedClassToString()
    {
        $d = MyCarbon::now();
        $this->assertSame($d->toDateTimeString(), ''.$d);
    }

    public function testToDateString()
    {
        $d = Carbon::create(1975, 12, 25, 14, 15, 16);
        $this->assertSame('1975-12-25', $d->toDateString());
    }

    public function testToDateTimeLocalString()
    {
        $d = Carbon::create(1975, 12, 25, 14, 15, 16);
        $this->assertSame('1975-12-25T14:15:16', $d->toDateTimeLocalString());
    }

    public function testToFormattedDateString()
    {
        $d = Carbon::create(1975, 12, 25, 14, 15, 16);
        $this->assertSame('Dec 25, 1975', $d->toFormattedDateString());
    }

    public function testToLocalizedFormattedDateString()
    {
        $currentLocale = setlocale(LC_TIME, '0');
        if (setlocale(LC_TIME, 'fr_FR.UTF-8') === false) {
            $this->markTestSkipped('UTF-8 test need fr_FR.UTF-8 (a locale with accents).');
        }
        $d = Carbon::create(1975, 12, 25, 14, 15, 16);
        $date = $d->formatLocalized('%A %d %B %Y');
        setlocale(LC_TIME, $currentLocale);

        $this->assertSame('jeudi 25 décembre 1975', $date);
    }

    public function testToLocalizedFormattedDateStringWhenUtf8IsNedded()
    {
        $currentLocale = setlocale(LC_TIME, '0');
        if (setlocale(LC_TIME, 'fr_FR.UTF-8') === false) {
            $this->markTestSkipped('UTF-8 test need fr_FR.UTF-8 (a locale with accents).');
        }
        $d = Carbon::create(1975, 12, 25, 14, 15, 16, 'Europe/Paris');
        Carbon::setUtf8(false);
        $nonUtf8Date = $d->formatLocalized('%B');
        Carbon::setUtf8(true);
        $utf8Date = $d->formatLocalized('%B');
        Carbon::setUtf8(false);
        setlocale(LC_TIME, $currentLocale);

        $this->assertSame('décembre', $nonUtf8Date);
        $this->assertSame(utf8_encode('décembre'), $utf8Date);
    }

    public function testToLocalizedFormattedTimezonedDateString()
    {
        $d = Carbon::create(1975, 12, 25, 14, 15, 16, 'Europe/London');
        $this->assertSame('Thursday 25 December 1975 14:15', $d->formatLocalized('%A %d %B %Y %H:%M'));
    }

    public function testToTimeString()
    {
        $d = Carbon::create(1975, 12, 25, 14, 15, 16);
        $this->assertSame('14:15:16', $d->toTimeString());
    }

    public function testToDateTimeString()
    {
        $d = Carbon::create(1975, 12, 25, 14, 15, 16);
        $this->assertSame('1975-12-25 14:15:16', $d->toDateTimeString());
    }

    public function testToDateTimeStringWithPaddedZeroes()
    {
        $d = Carbon::create(2000, 5, 2, 4, 3, 4);
        $this->assertSame('2000-05-02 04:03:04', $d->toDateTimeString());
    }

    public function testToDayDateTimeString()
    {
        $d = Carbon::create(1975, 12, 25, 14, 15, 16);
        $this->assertSame('Thu, Dec 25, 1975 2:15 PM', $d->toDayDateTimeString());
    }

    public function testToAtomString()
    {
        $d = Carbon::create(1975, 12, 25, 14, 15, 16);
        $this->assertSame('1975-12-25T14:15:16-05:00', $d->toAtomString());
    }

    public function testToCOOKIEString()
    {
        $d = Carbon::create(1975, 12, 25, 14, 15, 16);
        if (DateTime::COOKIE === 'l, d-M-y H:i:s T') {
            $cookieString = 'Thursday, 25-Dec-75 14:15:16 EST';
        } else {
            $cookieString = 'Thursday, 25-Dec-1975 14:15:16 EST';
        }

        $this->assertSame($cookieString, $d->toCookieString());
    }

    public function testToIso8601String()
    {
        $d = Carbon::create(1975, 12, 25, 14, 15, 16);
        $this->assertSame('1975-12-25T14:15:16-05:00', $d->toIso8601String());
    }

    public function testToIso8601ZuluString()
    {
        $d = Carbon::create(1975, 12, 25, 14, 15, 16);
        $this->assertSame('1975-12-25T19:15:16Z', $d->toIso8601ZuluString());
    }

    public function testToRC822String()
    {
        $d = Carbon::create(1975, 12, 25, 14, 15, 16);
        $this->assertSame('Thu, 25 Dec 75 14:15:16 -0500', $d->toRfc822String());
    }

    public function testToRfc850String()
    {
        $d = Carbon::create(1975, 12, 25, 14, 15, 16);
        $this->assertSame('Thursday, 25-Dec-75 14:15:16 EST', $d->toRfc850String());
    }

    public function testToRfc1036String()
    {
        $d = Carbon::create(1975, 12, 25, 14, 15, 16);
        $this->assertSame('Thu, 25 Dec 75 14:15:16 -0500', $d->toRfc1036String());
    }

    public function testToRfc1123String()
    {
        $d = Carbon::create(1975, 12, 25, 14, 15, 16);
        $this->assertSame('Thu, 25 Dec 1975 14:15:16 -0500', $d->toRfc1123String());
    }

    public function testToRfc2822String()
    {
        $d = Carbon::create(1975, 12, 25, 14, 15, 16);
        $this->assertSame('Thu, 25 Dec 1975 14:15:16 -0500', $d->toRfc2822String());
    }

    public function testToRfc3339String()
    {
        $d = Carbon::create(1975, 12, 25, 14, 15, 16);
        $this->assertSame('1975-12-25T14:15:16-05:00', $d->toRfc3339String());
    }

    public function testToRssString()
    {
        $d = Carbon::create(1975, 12, 25, 14, 15, 16);
        $this->assertSame('Thu, 25 Dec 1975 14:15:16 -0500', $d->toRssString());
    }

    public function testToW3cString()
    {
        $d = Carbon::create(1975, 12, 25, 14, 15, 16);
        $this->assertSame('1975-12-25T14:15:16-05:00', $d->toW3cString());
    }

    public function testToRfc7231String()
    {
        $d = Carbon::create(1975, 12, 25, 14, 15, 16, 'GMT');
        $this->assertSame('Thu, 25 Dec 1975 14:15:16 GMT', $d->toRfc7231String());

        $d = Carbon::create(1975, 12, 25, 14, 15, 16);
        $this->assertSame('Thu, 25 Dec 1975 19:15:16 GMT', $d->toRfc7231String());
    }
}
