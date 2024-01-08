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
use Carbon\CarbonInterface;
use Carbon\Factory;
use DateTime;
use InvalidArgumentException;
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
        Carbon::setToStringFormat(function (CarbonInterface $d) {
            $format = $d->year === 1976 ?
                'jS \o\f F g:i:s a' :
                'jS \o\f F, Y g:i:s a';

            return $d->format($format);
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
        $d = Carbon::create(1975, 12, 25, 14, 15, 16.615342);
        $this->assertSame('1975-12-25T14:15:16', $d->toDateTimeLocalString());
        $this->assertSame('1975-12-25T14:15', $d->toDateTimeLocalString('minute'));
        $this->assertSame('1975-12-25T14:15:16', $d->toDateTimeLocalString('second'));
        $this->assertSame('1975-12-25T14:15:16.615', $d->toDateTimeLocalString('millisecond'));
        $this->assertSame('1975-12-25T14:15:16.615342', $d->toDateTimeLocalString('µs'));

        $message = null;

        try {
            $d->toDateTimeLocalString('hour');
        } catch (InvalidArgumentException $exception) {
            $message = $exception->getMessage();
        }

        $this->assertSame('Precision unit expected among: minute, second, millisecond and microsecond.', $message);
    }

    public function testToFormattedDateString()
    {
        $d = Carbon::create(1975, 12, 25, 14, 15, 16);
        $this->assertSame('Dec 25, 1975', $d->toFormattedDateString());
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

    public function testToDayDateString()
    {
        $d = Carbon::create(1975, 12, 25, 14, 15, 16);
        $this->assertSame('Thu, Dec 25, 1975', $d->toFormattedDayDateString());
    }

    public function testToAtomString()
    {
        $d = Carbon::create(1975, 12, 25, 14, 15, 16);
        $this->assertSame('1975-12-25T14:15:16-05:00', $d->toAtomString());
    }

    public function testToCOOKIEString()
    {
        $d = Carbon::create(1975, 12, 25, 14, 15, 16);
        $this->assertSame(
            DateTime::COOKIE === 'l, d-M-y H:i:s T'
                ? 'Thursday, 25-Dec-75 14:15:16 EST'
                : 'Thursday, 25-Dec-1975 14:15:16 EST',
            $d->toCookieString(),
        );
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

        $d = Carbon::create(1975, 12, 25, 14, 15, 16);
        $this->assertSame('1975-12-25T14:15:16.000-05:00', $d->toRfc3339String(true));
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
        $this->assertSame('2017', $d->locale('en_US')->isoFormat('g'));
        $this->assertSame('2016', $d->locale('fr')->isoFormat('g'));
        $this->assertSame('2016', $d->isoFormat('G'));
        $this->assertSame('2016', $d->locale('en_US')->isoFormat('G'));
        $this->assertSame('2016', $d->locale('fr')->isoFormat('G'));

        $d = Carbon::parse('2015-12-31');
        $this->assertSame('2016', $d->isoFormat('g'));
        $this->assertSame('2016', $d->locale('en_US')->isoFormat('g'));
        $this->assertSame('2015', $d->locale('fr')->isoFormat('g'));
        $this->assertSame('2015', $d->isoFormat('G'));
        $this->assertSame('2015', $d->locale('en_US')->isoFormat('G'));
        $this->assertSame('2015', $d->locale('fr')->isoFormat('G'));

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

        $this->assertSame('1st', Carbon::parse('2018-06-01')->isoFormat('Do'));
        $this->assertSame('11th', Carbon::parse('2018-06-11')->isoFormat('Do'));
        $this->assertSame('21st', Carbon::parse('2018-06-21')->isoFormat('Do'));
        $this->assertSame('15th', Carbon::parse('2018-06-15')->isoFormat('Do'));
    }

    public function testBadIsoFormat()
    {
        $d = BadIsoCarbon::parse('midnight');

        $this->assertSame('', $d->isoFormat('MMM'));
    }

    public function testTranslatedFormat()
    {
        $this->assertSame('1st', Carbon::parse('01-01-01')->translatedFormat('jS'));
        $this->assertSame('1er', Carbon::parse('01-01-01')->locale('fr')->translatedFormat('jS'));
        $this->assertSame('31 мая', Carbon::parse('2019-05-15')->locale('ru')->translatedFormat('t F'));
        $this->assertSame('5 май', Carbon::parse('2019-05-15')->locale('ru')->translatedFormat('n F'));
    }
}
