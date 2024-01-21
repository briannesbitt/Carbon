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
use Carbon\Exceptions\InvalidTimeZoneException;
use DateTime;
use DateTimeZone;
use InvalidArgumentException;
use Tests\AbstractTestCase;

class CreateTest extends AbstractTestCase
{
    public function testCreateReturnsDatingInstance()
    {
        $d = Carbon::create();
        $this->assertInstanceOfCarbon($d);
    }

    public function testCreateWithDefaults()
    {
        $d = Carbon::create();
        $this->assertSame($d->getTimestamp(), Carbon::create('0000-01-01 00:00:00')->getTimestamp());
    }

    public function testCreateWithNull()
    {
        $d = Carbon::create(null, null, null, null, null, null);
        $this->assertSame($d->getTimestamp(), Carbon::now()->getTimestamp());
    }

    public function testCreateAsParseAlias()
    {
        $d = Carbon::create('2019-02-05 12:30:06.99', 'Asia/Tokyo');
        $this->assertSame('2019-02-05 12:30:06.990000 Asia/Tokyo', $d->format('Y-m-d H:i:s.u e'));
    }

    public function testCreateWithYear()
    {
        $d = Carbon::create(2012);
        $this->assertSame(2012, $d->year);
    }

    public function testCreateHandlesNegativeYear()
    {
        $c = Carbon::create(-1, 10, 12, 1, 2, 3);
        $this->assertCarbon($c, -1, 10, 12, 1, 2, 3);
    }

    public function testCreateHandlesFiveDigitsPositiveYears()
    {
        $c = Carbon::create(999999999, 10, 12, 1, 2, 3);
        $this->assertCarbon($c, 999999999, 10, 12, 1, 2, 3);
    }

    public function testCreateHandlesFiveDigitsNegativeYears()
    {
        $c = Carbon::create(-999999999, 10, 12, 1, 2, 3);
        $this->assertCarbon($c, -999999999, 10, 12, 1, 2, 3);
    }

    public function testCreateWithMonth()
    {
        $d = Carbon::create(null, 3);
        $this->assertSame(3, $d->month);
    }

    public function testCreateWithInvalidMonth()
    {
        $this->expectExceptionObject(new InvalidArgumentException(
            'month must be between 0 and 99, -5 given',
        ));

        Carbon::create(null, -5);
    }

    public function testCreateMonthWraps()
    {
        $d = Carbon::create(2011, 0, 1, 0, 0, 0);
        $this->assertCarbon($d, 2010, 12, 1, 0, 0, 0);
    }

    public function testCreateWithDay()
    {
        $d = Carbon::create(null, null, 21);
        $this->assertSame(21, $d->day);
    }

    public function testCreateWithInvalidDay()
    {
        $this->expectExceptionObject(new InvalidArgumentException(
            'day must be between 0 and 99, -4 given',
        ));

        Carbon::create(null, null, -4);
    }

    public function testCreateDayWraps()
    {
        $d = Carbon::create(2011, 1, 40, 0, 0, 0);
        $this->assertCarbon($d, 2011, 2, 9, 0, 0, 0);
    }

    public function testCreateWithHourAndDefaultMinSecToZero()
    {
        $d = Carbon::create(null, null, null, 14);
        $this->assertSame(14, $d->hour);
        $this->assertSame(0, $d->minute);
        $this->assertSame(0, $d->second);
    }

    public function testCreateWithInvalidHour()
    {
        $this->expectExceptionObject(new InvalidArgumentException(
            'hour must be between 0 and 99, -1 given',
        ));

        Carbon::create(null, null, null, -1);
    }

    public function testCreateHourWraps()
    {
        $d = Carbon::create(2011, 1, 1, 24, 0, 0);
        $this->assertCarbon($d, 2011, 1, 2, 0, 0, 0);
    }

    public function testCreateWithMinute()
    {
        $d = Carbon::create(null, null, null, null, 58);
        $this->assertSame(58, $d->minute);
    }

    public function testCreateWithInvalidMinute()
    {
        $this->expectExceptionObject(new InvalidArgumentException(
            'minute must be between 0 and 99, -2 given',
        ));

        Carbon::create(2011, 1, 1, 0, -2, 0);
    }

    public function testCreateMinuteWraps()
    {
        $d = Carbon::create(2011, 1, 1, 0, 62, 0);
        $this->assertCarbon($d, 2011, 1, 1, 1, 2, 0);
    }

    public function testCreateWithSecond()
    {
        $d = Carbon::create(null, null, null, null, null, 59);
        $this->assertSame(59, $d->second);
    }

    public function testCreateWithInvalidSecond()
    {
        $this->expectExceptionObject(new InvalidArgumentException(
            'second must be between 0 and 99, -2 given',
        ));

        Carbon::create(null, null, null, null, null, -2);
    }

    public function testCreateSecondsWrap()
    {
        $d = Carbon::create(2012, 1, 1, 0, 0, 61);
        $this->assertCarbon($d, 2012, 1, 1, 0, 1, 1);
    }

    public function testCreateWithDateTimeZone()
    {
        $d = Carbon::create(2012, 1, 1, 0, 0, 0, new DateTimeZone('Europe/London'));
        $this->assertCarbon($d, 2012, 1, 1, 0, 0, 0);
        $this->assertSame('Europe/London', $d->tzName);
    }

    public function testCreateWithTimeZoneString()
    {
        $d = Carbon::create(2012, 1, 1, 0, 0, 0, 'Europe/London');
        $this->assertCarbon($d, 2012, 1, 1, 0, 0, 0);
        $this->assertSame('Europe/London', $d->tzName);
    }

    public function testMake()
    {
        $this->assertCarbon(Carbon::make('2017-01-05'), 2017, 1, 5, 0, 0, 0);
        $this->assertCarbon(Carbon::make(new DateTime('2017-01-05')), 2017, 1, 5, 0, 0, 0);
        $this->assertCarbon(Carbon::make(new Carbon('2017-01-05')), 2017, 1, 5, 0, 0, 0);
        $this->assertNull(Carbon::make(3));
    }

    public function testCreateWithInvalidTimezoneOffset()
    {
        $this->expectExceptionObject(new InvalidTimeZoneException(
            'Unknown or bad timezone (-28236)',
        ));

        Carbon::createFromDate(2000, 1, 1, -28236);
    }

    public function testCreateWithValidTimezoneOffset()
    {
        $dt = Carbon::createFromDate(2000, 1, 1, -4);
        $this->assertSame('America/New_York', $dt->tzName);

        $dt = Carbon::createFromDate(2000, 1, 1, '-4');
        $this->assertSame('-04:00', $dt->tzName);
    }

    public function testParseFromLocale()
    {
        $date = Carbon::parseFromLocale('23 Okt 2019', 'de');

        $this->assertSame('Wednesday, October 23, 2019 12:00 AM America/Toronto', $date->isoFormat('LLLL zz'));

        $date = Carbon::parseFromLocale('23 Okt 2019', 'de', 'Europe/Berlin')->locale('de');

        $this->assertSame('Mittwoch, 23. Oktober 2019 00:00 Europe/Berlin', $date->isoFormat('LLLL zz'));

        $date = Carbon::parseFromLocale('23 červenec 2019', 'cs');

        $this->assertSame('2019-07-23', $date->format('Y-m-d'));

        $date = Carbon::parseFromLocale('23 červen 2019', 'cs');

        $this->assertSame('2019-06-23', $date->format('Y-m-d'));

        Carbon::setTestNow('2021-01-26 15:45:13');

        $date = Carbon::parseFromLocale('завтра', 'ru');

        $this->assertSame('2021-01-27 00:00:00', $date->format('Y-m-d H:i:s'));
    }

    public function testParseFromLocaleWithDefaultLocale()
    {
        Carbon::setLocale('fr');

        $date = Carbon::parseFromLocale('Dimanche');

        $this->assertSame('dimanche', $date->dayName);

        $date = Carbon::parseFromLocale('Lundi');

        $this->assertSame('lundi', $date->dayName);
    }

    public function testCreateFromLocaleFormat()
    {
        $date = Carbon::createFromLocaleFormat('Y M d H,i,s', 'zh_CN', '2019 四月 4 12,04,21');

        $this->assertSame('Thursday, April 4, 2019 12:04 PM America/Toronto', $date->isoFormat('LLLL zz'));

        $date = Carbon::createFromLocaleFormat('Y M d H,i,s', 'zh_TW', '2019 四月 4 12,04,21', 'Asia/Shanghai')->locale('zh');

        $this->assertSame('2019年4月4日星期四 中午 12点04分 Asia/Shanghai', $date->isoFormat('LLLL zz'));

        $this->assertSame(
            '2022-12-05 America/Mexico_City',
            Carbon::createFromLocaleFormat('d * F * Y', 'es', '05 de diciembre de 2022', 'America/Mexico_City')
                ->format('Y-m-d e')
        );

        $this->assertSame(
            '2022-12-05 America/Mexico_City',
            Carbon::createFromLocaleFormat('d \of F \of Y', 'es', '05 de diciembre de 2022', 'America/Mexico_City')
                ->format('Y-m-d e')
        );

        $this->assertSame(
            '2022-12-05 America/Mexico_City',
            Carbon::createFromLocaleFormat('d \o\f F \o\f Y', 'es', '05 de diciembre de 2022', 'America/Mexico_City')
                ->format('Y-m-d e')
        );

        $this->assertSame(
            '2022-12-05 America/Mexico_City',
            Carbon::createFromLocaleFormat('d \d\e F \d\e Y', 'es', '05 de diciembre de 2022', 'America/Mexico_City')
                ->format('Y-m-d e')
        );

        $this->assertSame(
            '2022-12-05 America/Mexico_City',
            Carbon::createFromLocaleFormat('d \n\o\t F \n\o\t Y', 'es', '05 not diciembre not 2022', 'America/Mexico_City')
                ->format('Y-m-d e')
        );
    }

    public function testCreateFromIsoFormat()
    {
        $date = Carbon::createFromIsoFormat('!YYYYY MMMM D', '2019 April 4');

        $this->assertSame('Thursday, April 4, 2019 12:00 AM America/Toronto', $date->isoFormat('LLLL zz'));
    }

    public function testCreateFromIsoFormatException()
    {
        $this->expectExceptionObject(new InvalidArgumentException(
            'Format wo not supported for creation.',
        ));

        Carbon::createFromIsoFormat('YY D wo', '2019 April 4');
    }

    public function testCreateFromLocaleIsoFormat()
    {
        $date = Carbon::createFromLocaleIsoFormat('YYYY MMMM D HH,mm,ss', 'zh_TW', '2019 四月 4 12,04,21');

        $this->assertSame('Thursday, April 4, 2019 12:04 PM America/Toronto', $date->isoFormat('LLLL zz'));

        $date = Carbon::createFromLocaleIsoFormat('LLL zz', 'zh', '2019年4月4日 下午 2点04分 Asia/Shanghai');

        $this->assertSame('Thursday, April 4, 2019 2:04 PM Asia/Shanghai', $date->isoFormat('LLLL zz'));

        $this->assertSame('2019年4月4日星期四 下午 2点04分 Asia/Shanghai', $date->locale('zh')->isoFormat('LLLL zz'));

        $date = Carbon::createFromLocaleIsoFormat('llll', 'fr_CA', 'mar. 24 juil. 2018 08:34');

        $this->assertSame('2018-07-24 08:34', $date->format('Y-m-d H:i'));
    }
}
