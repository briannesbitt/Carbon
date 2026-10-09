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
use Carbon\Exceptions\InvalidFormatException;
use Carbon\Exceptions\InvalidTimeZoneException;
use Carbon\Translator;
use DateTime;
use DateTimeZone;
use InvalidArgumentException;
use PHPUnit\Framework\Attributes\DataProvider;
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

    public function testParseFromLocaleWithDayNameAndMonthName()
    {
        $date = Carbon::parseFromLocale('mar 4 ago \'26 00:00', 'es');

        $this->assertSame('2026-08-04 00:00:00', $date->format('Y-m-d H:i:s'));

        $date = Carbon::parseFromLocale('mar 21 avr 26 00:00', 'fr');

        $this->assertSame('2026-04-21 00:00:00', $date->format('Y-m-d H:i:s'));
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

    public function testCreateFromIsoFormatWithEras()
    {
        $this->assertSame('2024-02-29', Carbon::createFromLocaleIsoFormat('D MMMM N y', 'th', '29 กุมภาพันธ์ พ.ศ. 2567')->format('Y-m-d'));
        // No era name: the era of today's date is used
        $this->assertSame('2026-09-30', Carbon::createFromLocaleIsoFormat('D/M/yyyy', 'th', '30/9/2569')->format('Y-m-d'));
        $this->assertSame('1957-01-01', Carbon::createFromLocaleIsoFormat('D MMMM NNNN y', 'th', '1 มกราคม พุทธศักราช 2500')->format('Y-m-d'));
        $this->assertSame('2024-02-29', Carbon::createFromLocaleIsoFormat('D MMMM y NNNNN', 'th', '29 กุมภาพันธ์ 2567 พ.ศ.')->format('Y-m-d'));
        // Era name only, no year
        $this->assertSame('2020-05-17', Carbon::createFromLocaleIsoFormat('!D MMMM N Y', 'th', '17 พฤษภาคม พ.ศ. 2020')->format('Y-m-d'));
        $this->assertSame('2024-02-29 18:30', Carbon::createFromIsoFormat('y-MM-DD N HH:mm', '2024-02-29 AD 18:30')->format('Y-m-d H:i'));
        $this->assertSame('0000-01-01', Carbon::createFromIsoFormat('!y-MM-DD N', '1-01-01 BC')->format('Y-m-d'));
        $this->assertSame('1999-12-31', Carbon::createFromIsoFormat('yo N MM DD', '1999th ad 12 31')->format('Y-m-d'));
        // Day of year counted in the era year (BE 2567 is a leap year)
        $this->assertSame('2024-02-29', Carbon::createFromLocaleIsoFormat('y N DDD', 'th', '2567 พ.ศ. 60')->format('Y-m-d'));
        // Escaped letters are not era tokens
        $this->assertSame('2024-01-01', Carbon::createFromIsoFormat('!YYYY \\N\\y', '2024 Ny')->format('Y-m-d'));
        $this->assertSame('2024-01-01', Carbon::createFromIsoFormat('!y \\N N', '2024 N AD')->format('Y-m-d'));
    }

    public function testCreateFromIsoFormatErasRoundTrip()
    {
        foreach ([2024, 2026] as $year) {
            for ($date = Carbon::create($year, 1, 1); $date->year === $year; $date = $date->addDay()) {
                foreach (['D MMMM N y', 'DD/MM/yyyy NNN', 'NNNN y-MM-DD', 'yo NNNNN, MMM D'] as $format) {
                    $string = $date->locale('th')->isoFormat($format);
                    $parsed = Carbon::createFromLocaleIsoFormat("!$format", 'th', $string);

                    $this->assertSame($date->format('Y-m-d'), $parsed->format('Y-m-d'), "$format: $string");
                }
            }
        }
    }

    public function testCreateFromIsoFormatCustomEras()
    {
        $translator = Translator::get('en_ParseEras');
        $translator->setTranslations([
            'eras' => [
                ['since' => '2019-05-01', 'until' => INF, 'offset' => 1, 'name' => 'Reiwa', 'narrow' => 'R', 'abbr' => 'R.'],
                ['since' => '1989-01-08', 'until' => '2019-04-30', 'offset' => 1, 'name' => 'Heisei', 'narrow' => 'H', 'abbr' => 'H.'],
            ],
        ]);

        $this->assertSame('2026-09-30', Carbon::createFromIsoFormat('NNNN y MM DD', 'Reiwa 8 09 30', null, 'en_ParseEras')->format('Y-m-d'));
        $this->assertSame('2019-04-30', Carbon::createFromIsoFormat('NNNNN y MM DD', 'H 31 04 30', null, 'en_ParseEras')->format('Y-m-d'));
        $this->assertSame('1989-02-01', Carbon::createFromIsoFormat('N y MM DD', 'H. 1 02 01', null, 'en_ParseEras')->format('Y-m-d'));
        $this->assertSame('2019-05-01', Carbon::createFromIsoFormat('N-y-MM-DD', 'r.-1-05-01', null, 'en_ParseEras')->format('Y-m-d'));

        $translator->resetMessages();
    }

    #[DataProvider('dataForInvalidEras')]
    public function testCreateFromIsoFormatInvalidEras(string $format, string $locale, string $time, string $message)
    {
        $this->expectExceptionObject(new InvalidFormatException($message));

        Carbon::createFromLocaleIsoFormat($format, $locale, $time);
    }

    public static function dataForInvalidEras(): array
    {
        return [
            'unknown era' => ['D MMMM N y', 'th', '1 มกราคม ค.ศ. 2500', "Unknown era 'ค.ศ.' for locale 'th' in '1 มกราคม ค.ศ. 2500'."],
            'before the first year of the era' => ['D MMMM N y', 'th', '1 มกราคม พ.ศ. 0', "Year 0 is out of the era 'พ.ศ.'."],
            'no year before Anno Domini' => ['y N', 'en', '0 AD', "Year 0 is out of the era 'AD'."],
            'Gregorian year out of range' => ['y N', 'th', '12000 พ.ศ.', "Year 12000 of the era 'พ.ศ.' is Gregorian year 11457, only years from 0 to 9999 can be created."],
            'not matching' => ['D MMMM N y', 'th', 'xx', "Could not parse 'xx' with format 'D MMMM N y'."],
            'not matching, translated' => ['D MMMM N y', 'th', '29 กุมภาพันธ์ x', "Could not parse '29 กุมภาพันธ์ x' with format 'D MMMM N y'."],
        ];
    }

    public function testCreateFromIsoFormatWithDayOfYear()
    {
        $this->assertSame('2019-01-01', Carbon::createFromIsoFormat('!YYYY DDDD', '2019 001')->format('Y-m-d'));
        $this->assertSame('2019-01-01', Carbon::createFromIsoFormat('!YYYY DDD', '2019 1')->format('Y-m-d'));
        $this->assertSame('2019-04-04', Carbon::createFromIsoFormat('!YYYY DDDD', '2019 094')->format('Y-m-d'));
        $this->assertSame('2020-12-31', Carbon::createFromIsoFormat('!YYYY DDDD', '2020 366')->format('Y-m-d'));

        $date = Carbon::parse('2019-04-04 13:45');
        $this->assertSame('2019-04-04 13:45', Carbon::createFromIsoFormat('YYYY-DDDD HH:mm', $date->isoFormat('YYYY-DDDD HH:mm'))->format('Y-m-d H:i'));
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

    public function testStartOfTime()
    {
        $this->assertTrue(Carbon::startOfTime()->isStartOfTime());
        $this->assertTrue(Carbon::startOfTime()->toImmutable()->isStartOfTime());
    }

    public function testEndOfTime()
    {
        $this->assertTrue(Carbon::endOfTime()->isEndOfTime());
        $this->assertTrue(Carbon::endOfTime()->toImmutable()->isEndOfTime());
    }
}
