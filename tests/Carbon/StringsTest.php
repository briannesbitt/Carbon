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
use Carbon\CarbonInterface;
use Carbon\Factory;
use DateTime;
use Tests\AbstractTestCase;
use Tests\Carbon\Fixtures\BadIsoCarbon;
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
        Carbon::setToStringFormat(function (CarbonInterface $d) {
            return $d->format($d->year === 1976 ?
                'jS \o\f F g:i:s a' :
                'jS \o\f F, Y g:i:s a'
            );
        });

        $d = Carbon::create(1976, 12, 25, 14, 15, 16);
        $this->assertSame('25th of December 2:15:16 pm', ''.$d);

        $d = Carbon::create(1975, 12, 25, 14, 15, 16);
        $this->assertSame('25th of December, 1975 2:15:16 pm', ''.$d);
    }

    public function testSetToStringFormatViaSettings()
    {
        $factory = new Factory([
            'toStringFormat' => function (CarbonInterface $d) {
                return $d->isoFormat('dddd');
            },
        ]);

        $d = $factory->create(1976, 12, 25, 14, 15, 16);
        $this->assertSame('Saturday', ''.$d);
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

    public function testIsoFormat()
    {
        $d = Carbon::parse('midnight');
        $this->assertSame('24', $d->isoFormat('k'));

        $d = Carbon::parse('2017-01-01');
        $this->assertSame('2017', $d->isoFormat('g'));
        $this->assertSame('2016', $d->isoFormat('G'));

        $d = Carbon::parse('2017-01-01 22:25:24.182937');
        $this->assertSame('1 18 182 1829 18293 182937 1829370 18293700 182937000', $d->isoFormat('S SS SSS SSSS SSSSS SSSSSS SSSSSSS SSSSSSSS SSSSSSSSS'));

        $this->assertSame('02017 +002017', $d->isoFormat('YYYYY YYYYYY'));
        $this->assertSame(-117, Carbon::create(-117, 1, 1)->year);
        $this->assertSame('-00117 -000117', Carbon::create(-117, 1, 1)->isoFormat('YYYYY YYYYYY'));

        $this->assertSame('M01', $d->isoFormat('\\MMM'));

        $this->assertSame('Jan', $d->isoFormat('MMM'));
        $this->assertSame('janv.', $d->locale('fr')->isoFormat('MMM'));
        $this->assertSame('ene.', $d->locale('es')->isoFormat('MMM'));
        $this->assertSame('1 de enero de 2017', $d->locale('es')->isoFormat('LL'));
        $this->assertSame('1 de ene. de 2017', $d->locale('es')->isoFormat('ll'));
    }

    public function testBadIsoFormat()
    {
        $d = BadIsoCarbon::parse('midnight');

        $this->assertSame('', $d->isoFormat('MMM'));
    }
}
