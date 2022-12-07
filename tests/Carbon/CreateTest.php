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
use Carbon\Exceptions\InvalidTimeZoneException;
use Carbon\Exceptions\OutOfRangeException;
use DateTime;
use DateTimeZone;
use Generator;
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
            'month must be between 0 and 99, -5 given'
        ));

        Carbon::create(null, -5);
    }

    public function testOutOfRangeException()
    {
        /** @var OutOfRangeException $error */
        $error = null;

        try {
            Carbon::create(null, -5);
        } catch (OutOfRangeException $exception) {
            $error = $exception;
        }

        $this->assertInstanceOf(OutOfRangeException::class, $error);
        $this->assertSame('month', $error->getUnit());
        $this->assertSame(-5, $error->getValue());
        $this->assertSame(0, $error->getMin());
        $this->assertSame(99, $error->getMax());
    }

    public function testCreateWithInvalidMonthNonStrictMode()
    {
        Carbon::useStrictMode(false);
        $this->assertFalse(Carbon::isStrictModeEnabled());
        $this->assertFalse(Carbon::create(null, -5));
        Carbon::useStrictMode(true);
        $this->assertTrue(Carbon::isStrictModeEnabled());
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
            'day must be between 0 and 99, -4 given'
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
            'hour must be between 0 and 99, -1 given'
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
            'minute must be between 0 and 99, -2 given'
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
            'second must be between 0 and 99, -2 given'
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
            'Absolute timezone offset cannot be greater than 100.'
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
        $dateToday = Carbon::parseFromLocale('now', 'en');
        $dateTest = Carbon::parseFromLocale('à l\'instant', 'fr');

        $this->assertSame($dateToday->format('Y-m-d H:i:s'), $dateTest->format('Y-m-d H:i:s'));

        $dateToday = Carbon::parseFromLocale('today', 'en');
        $dateTest = Carbon::parseFromLocale('Aujourd\'hui', 'fr');

        $this->assertSame($dateToday->format('Y-m-d'), $dateTest->format('Y-m-d'));

        $dateTest = Carbon::parseFromLocale('Aujourd\'hui à 19:34', 'fr');

        $this->assertSame($dateToday->format('Y-m-d').' 19:34', $dateTest->format('Y-m-d H:i'));

        $dateTest = Carbon::parseFromLocale('Heute', 'de');

        $this->assertSame($dateToday->format('Y-m-d'), $dateTest->format('Y-m-d'));

        $dateTest = Carbon::parseFromLocale('Heute um 19:34', 'de');

        $this->assertSame($dateToday->format('Y-m-d').' 19:34', $dateTest->format('Y-m-d H:i'));

        $date = date('Y-m-d', strtotime($dateToday.' + 1 days'));
        $dateTest = Carbon::parseFromLocale('demain', 'fr');

        $this->assertSame($date, $dateTest->format('Y-m-d'));

        $date = date('Y-m-d', strtotime($dateToday.' + 2 days'));
        $dateTest = Carbon::parseFromLocale('après-demain', 'fr');

        $this->assertSame($date, $dateTest->format('Y-m-d'));

        $date = date('Y-m-d', strtotime($dateToday.' - 1 days'));
        $dateTest = Carbon::parseFromLocale('hier', 'fr');

        $this->assertSame($date, $dateTest->format('Y-m-d'));

        $date = date('Y-m-d', strtotime($dateToday.' - 2 days'));
        $dateTest = Carbon::parseFromLocale('avant-hier', 'fr');

        $this->assertSame($date, $dateTest->format('Y-m-d'));

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

    /**
     * @dataProvider \Tests\Carbon\CreateTest::dataForLocales
     * @group localization
     */
    public function testParseFromLocaleForEachLocale($locale)
    {
        $expectedDate = Carbon::parse('today 4:26');

        $date = Carbon::parseFromLocale($expectedDate->locale($locale)->calendar(), $locale);

        $this->assertSame($expectedDate->format('Y-m-d H:i'), $date->format('Y-m-d H:i'));
    }

    public function testParseFromLocaleWithDefaultLocale()
    {
        Carbon::setLocale('fr');

        $date = Carbon::parseFromLocale('Dimanche');

        $this->assertSame('dimanche', $date->dayName);

        $date = Carbon::parseFromLocale('Lundi');

        $this->assertSame('lundi', $date->dayName);

        $date = Carbon::parseFromLocale('à l’instant');

        $this->assertEquals(Carbon::now(), $date);

        $date = Carbon::parseFromLocale('après-demain');

        $this->assertEquals(Carbon::today()->addDays(2), $date);
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
            'Format wo not supported for creation.'
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

    public static function dataForLocales(): Generator
    {
        yield ['aa_ER'];
        yield ['aa_ER@saaho'];
        yield ['aa_ET'];
        yield ['af'];
        yield ['af_NA'];
        yield ['af_ZA'];
        yield ['agq'];
        yield ['agr'];
        yield ['agr_PE'];
        yield ['ak'];
        yield ['ak_GH'];
        yield ['am'];
        yield ['am_ET'];
        yield ['an'];
        yield ['an_ES'];
        yield ['anp'];
        yield ['anp_IN'];
        yield ['ar'];
        yield ['ar_AE'];
        yield ['ar_BH'];
        yield ['ar_DJ'];
        yield ['ar_DZ'];
        yield ['ar_EG'];
        yield ['ar_EH'];
        yield ['ar_ER'];
        yield ['ar_IL'];
        yield ['ar_IN'];
        yield ['ar_IQ'];
        yield ['ar_JO'];
        yield ['ar_KM'];
        yield ['ar_KW'];
        yield ['ar_LB'];
        yield ['ar_LY'];
        yield ['ar_MA'];
        yield ['ar_MR'];
        yield ['ar_OM'];
        yield ['ar_PS'];
        yield ['ar_QA'];
        yield ['ar_SA'];
        yield ['ar_SD'];
        yield ['ar_SO'];
        yield ['ar_SS'];
        yield ['ar_SY'];
        yield ['ar_Shakl'];
        yield ['ar_TD'];
        yield ['ar_TN'];
        yield ['ar_YE'];
        yield ['as'];
        yield ['as_IN'];
        yield ['asa'];
        yield ['ast'];
        yield ['ast_ES'];
        yield ['ayc'];
        yield ['ayc_PE'];
        yield ['az'];
        yield ['az_AZ'];
        yield ['az_Cyrl'];
        yield ['az_Latn'];
        yield ['bas'];
        yield ['be'];
        yield ['be_BY'];
        yield ['bem'];
        yield ['bem_ZM'];
        yield ['ber'];
        yield ['ber_DZ'];
        yield ['ber_MA'];
        yield ['bez'];
        yield ['bg'];
        yield ['bg_BG'];
        yield ['bhb'];
        yield ['bhb_IN'];
        yield ['bho'];
        yield ['bho_IN'];
        yield ['bi'];
        yield ['bi_VU'];
        yield ['bm'];
        yield ['bo_IN'];
        yield ['br'];
        yield ['br_FR'];
        yield ['brx'];
        yield ['brx_IN'];
        yield ['bs'];
        yield ['bs_BA'];
        yield ['bs_Cyrl'];
        yield ['bs_Latn'];
        yield ['ca'];
        yield ['ca_AD'];
        yield ['ca_ES'];
        yield ['ca_ES_Valencia'];
        yield ['ca_FR'];
        yield ['ca_IT'];
        yield ['ccp'];
        yield ['ccp_IN'];
        yield ['ce'];
        yield ['ce_RU'];
        yield ['cgg'];
        yield ['chr'];
        yield ['chr_US'];
        yield ['cmn'];
        yield ['cmn_TW'];
        yield ['crh'];
        yield ['crh_UA'];
        yield ['cu'];
        yield ['cy'];
        yield ['cy_GB'];
        yield ['da'];
        yield ['da_DK'];
        yield ['da_GL'];
        yield ['dav'];
        yield ['dje'];
        yield ['doi'];
        yield ['doi_IN'];
        yield ['dsb'];
        yield ['dsb_DE'];
        yield ['dua'];
        yield ['dv'];
        yield ['dv_MV'];
        yield ['dyo'];
        yield ['dz'];
        yield ['dz_BT'];
        yield ['ebu'];
        yield ['ee_TG'];
        yield ['el'];
        yield ['el_CY'];
        yield ['el_GR'];
        yield ['en'];
        yield ['en_001'];
        yield ['en_150'];
        yield ['en_AG'];
        yield ['en_AI'];
        yield ['en_AS'];
        yield ['en_AT'];
        yield ['en_AU'];
        yield ['en_BB'];
        yield ['en_BE'];
        yield ['en_BI'];
        yield ['en_BM'];
        yield ['en_BS'];
        yield ['en_BW'];
        yield ['en_BZ'];
        yield ['en_CA'];
        yield ['en_CC'];
        yield ['en_CH'];
        yield ['en_CK'];
        yield ['en_CM'];
        yield ['en_CX'];
        yield ['en_CY'];
        yield ['en_DE'];
        yield ['en_DG'];
        yield ['en_DK'];
        yield ['en_DM'];
        yield ['en_ER'];
        yield ['en_FI'];
        yield ['en_FJ'];
        yield ['en_FK'];
        yield ['en_FM'];
        yield ['en_GB'];
        yield ['en_GD'];
        yield ['en_GG'];
        yield ['en_GH'];
        yield ['en_GI'];
        yield ['en_GM'];
        yield ['en_GU'];
        yield ['en_GY'];
        yield ['en_HK'];
        yield ['en_IE'];
        yield ['en_IL'];
        yield ['en_IM'];
        yield ['en_IN'];
        yield ['en_IO'];
        yield ['en_ISO'];
        yield ['en_JE'];
        yield ['en_JM'];
        yield ['en_KE'];
        yield ['en_KI'];
        yield ['en_KN'];
        yield ['en_KY'];
        yield ['en_LC'];
        yield ['en_LR'];
        yield ['en_LS'];
        yield ['en_MG'];
        yield ['en_MH'];
        yield ['en_MO'];
        yield ['en_MP'];
        yield ['en_MS'];
        yield ['en_MT'];
        yield ['en_MU'];
        yield ['en_MW'];
        yield ['en_MY'];
        yield ['en_NA'];
        yield ['en_NF'];
        yield ['en_NG'];
        yield ['en_NL'];
        yield ['en_NR'];
        yield ['en_NU'];
        yield ['en_NZ'];
        yield ['en_PG'];
        yield ['en_PH'];
        yield ['en_PK'];
        yield ['en_PN'];
        yield ['en_PR'];
        yield ['en_PW'];
        yield ['en_RW'];
        yield ['en_SB'];
        yield ['en_SC'];
        yield ['en_SD'];
        yield ['en_SE'];
        yield ['en_SG'];
        yield ['en_SH'];
        yield ['en_SI'];
        yield ['en_SL'];
        yield ['en_SS'];
        yield ['en_SX'];
        yield ['en_SZ'];
        yield ['en_TC'];
        yield ['en_TK'];
        yield ['en_TO'];
        yield ['en_TT'];
        yield ['en_TV'];
        yield ['en_TZ'];
        yield ['en_UG'];
        yield ['en_UM'];
        yield ['en_US'];
        yield ['en_US_Posix'];
        yield ['en_VC'];
        yield ['en_VG'];
        yield ['en_VI'];
        yield ['en_VU'];
        yield ['en_WS'];
        yield ['en_ZA'];
        yield ['en_ZM'];
        yield ['en_ZW'];
        yield ['eo'];
        yield ['es'];
        yield ['es_419'];
        yield ['es_AR'];
        yield ['es_BO'];
        yield ['es_BR'];
        yield ['es_BZ'];
        yield ['es_CL'];
        yield ['es_CO'];
        yield ['es_CR'];
        yield ['es_CU'];
        yield ['es_DO'];
        yield ['es_EA'];
        yield ['es_EC'];
        yield ['es_ES'];
        yield ['es_GQ'];
        yield ['es_GT'];
        yield ['es_HN'];
        yield ['es_IC'];
        yield ['es_MX'];
        yield ['es_NI'];
        yield ['es_PA'];
        yield ['es_PE'];
        yield ['es_PH'];
        yield ['es_PR'];
        yield ['es_PY'];
        yield ['es_SV'];
        yield ['es_US'];
        yield ['es_UY'];
        yield ['es_VE'];
        yield ['et'];
        yield ['et_EE'];
        yield ['ewo'];
        yield ['ff'];
        yield ['ff_CM'];
        yield ['ff_GN'];
        yield ['ff_MR'];
        yield ['ff_SN'];
        yield ['fil'];
        yield ['fil_PH'];
        yield ['fo'];
        yield ['fo_DK'];
        yield ['fo_FO'];
        yield ['fr'];
        yield ['fr_BE'];
        yield ['fr_BF'];
        yield ['fr_BI'];
        yield ['fr_BJ'];
        yield ['fr_BL'];
        yield ['fr_CA'];
        yield ['fr_CD'];
        yield ['fr_CF'];
        yield ['fr_CG'];
        yield ['fr_CH'];
        yield ['fr_CI'];
        yield ['fr_CM'];
        yield ['fr_DJ'];
        yield ['fr_DZ'];
        yield ['fr_FR'];
        yield ['fr_GA'];
        yield ['fr_GF'];
        yield ['fr_GN'];
        yield ['fr_GP'];
        yield ['fr_GQ'];
        yield ['fr_HT'];
        yield ['fr_KM'];
        yield ['fr_LU'];
        yield ['fr_MA'];
        yield ['fr_MC'];
        yield ['fr_MF'];
        yield ['fr_MG'];
        yield ['fr_ML'];
        yield ['fr_MQ'];
        yield ['fr_MR'];
        yield ['fr_MU'];
        yield ['fr_NC'];
        yield ['fr_NE'];
        yield ['fr_PF'];
        yield ['fr_PM'];
        yield ['fr_RE'];
        yield ['fr_RW'];
        yield ['fr_SC'];
        yield ['fr_SN'];
        yield ['fr_SY'];
        yield ['fr_TD'];
        yield ['fr_TG'];
        yield ['fr_TN'];
        yield ['fr_VU'];
        yield ['fr_WF'];
        yield ['fr_YT'];
        yield ['fy'];
        yield ['fy_NL'];
        yield ['ga'];
        yield ['ga_IE'];
        yield ['gd'];
        yield ['gd_GB'];
        yield ['gez'];
        yield ['gez_ER'];
        yield ['gez_ET'];
        yield ['gl'];
        yield ['gl_ES'];
        yield ['guz'];
        yield ['gv'];
        yield ['gv_GB'];
        yield ['ha'];
        yield ['ha_GH'];
        yield ['ha_NE'];
        yield ['ha_NG'];
        yield ['hak'];
        yield ['hak_TW'];
        yield ['haw'];
        yield ['he'];
        yield ['he_IL'];
        yield ['hif'];
        yield ['hif_FJ'];
        yield ['hne'];
        yield ['hne_IN'];
        yield ['hr'];
        yield ['hr_BA'];
        yield ['hr_HR'];
        yield ['hsb'];
        yield ['hsb_DE'];
        yield ['ht'];
        yield ['ht_HT'];
        yield ['hy'];
        yield ['hy_AM'];
        yield ['ia'];
        yield ['ia_FR'];
        yield ['id'];
        yield ['id_ID'];
        yield ['ig'];
        yield ['ig_NG'];
        yield ['ii'];
        yield ['ik'];
        yield ['ik_CA'];
        yield ['in'];
        yield ['it'];
        yield ['it_CH'];
        yield ['it_IT'];
        yield ['it_SM'];
        yield ['it_VA'];
        yield ['iu'];
        yield ['iu_CA'];
        yield ['iw'];
        yield ['ja'];
        yield ['ja_JP'];
        yield ['jgo'];
        yield ['jmc'];
        yield ['jv'];
        yield ['kab'];
        yield ['kab_DZ'];
        yield ['kam'];
        yield ['kde'];
        yield ['kea'];
        yield ['khq'];
        yield ['ki'];
        yield ['kk'];
        yield ['kk_KZ'];
        yield ['kkj'];
        yield ['kl'];
        yield ['kl_GL'];
        yield ['kln'];
        yield ['km'];
        yield ['km_KH'];
        yield ['kok'];
        yield ['kok_IN'];
        yield ['ks'];
        yield ['ks_IN'];
        yield ['ks_IN@devanagari'];
        yield ['ksb'];
        yield ['ksf'];
        yield ['ksh'];
        yield ['kw'];
        yield ['kw_GB'];
        yield ['ky'];
        yield ['ky_KG'];
        yield ['lag'];
        yield ['lg'];
        yield ['lg_UG'];
        yield ['li'];
        yield ['li_NL'];
        yield ['lij'];
        yield ['lij_IT'];
        yield ['lkt'];
        yield ['ln'];
        yield ['ln_AO'];
        yield ['ln_CD'];
        yield ['ln_CF'];
        yield ['ln_CG'];
        yield ['lo'];
        yield ['lo_LA'];
        yield ['lrc'];
        yield ['lrc_IQ'];
        yield ['lt'];
        yield ['lt_LT'];
        yield ['lu'];
        yield ['luo'];
        yield ['luy'];
        yield ['lzh'];
        yield ['lzh_TW'];
        yield ['mag'];
        yield ['mag_IN'];
        yield ['mai'];
        yield ['mai_IN'];
        yield ['mas'];
        yield ['mas_TZ'];
        yield ['mer'];
        yield ['mfe'];
        yield ['mfe_MU'];
        yield ['mg'];
        yield ['mg_MG'];
        yield ['mgh'];
        yield ['mgo'];
        yield ['mhr'];
        yield ['mhr_RU'];
        yield ['mi'];
        yield ['mi_NZ'];
        yield ['miq'];
        yield ['miq_NI'];
        yield ['mjw'];
        yield ['mjw_IN'];
        yield ['mk'];
        yield ['mk_MK'];
        yield ['mni'];
        yield ['mni_IN'];
        yield ['mo'];
        yield ['ms'];
        yield ['ms_BN'];
        yield ['ms_MY'];
        yield ['ms_SG'];
        yield ['mt'];
        yield ['mt_MT'];
        yield ['mua'];
        yield ['mzn'];
        yield ['nan'];
        yield ['nan_TW'];
        yield ['nan_TW@latin'];
        yield ['naq'];
        yield ['nb'];
        yield ['nb_NO'];
        yield ['nb_SJ'];
        yield ['nd'];
        yield ['nds'];
        yield ['nds_DE'];
        yield ['nds_NL'];
        yield ['ne_IN'];
        yield ['nhn'];
        yield ['nhn_MX'];
        yield ['niu'];
        yield ['niu_NU'];
        yield ['nl'];
        yield ['nl_AW'];
        yield ['nl_BE'];
        yield ['nl_BQ'];
        yield ['nl_CW'];
        yield ['nl_NL'];
        yield ['nl_SR'];
        yield ['nl_SX'];
        yield ['nmg'];
        yield ['nn'];
        yield ['nn_NO'];
        yield ['nnh'];
        yield ['no'];
        yield ['nr'];
        yield ['nr_ZA'];
        yield ['nso'];
        yield ['nso_ZA'];
        yield ['nus'];
        yield ['nyn'];
        yield ['oc'];
        yield ['oc_FR'];
        yield ['om'];
        yield ['om_ET'];
        yield ['om_KE'];
        yield ['os'];
        yield ['os_RU'];
        yield ['pa_Arab'];
        yield ['pa_Guru'];
        yield ['pl'];
        yield ['pl_PL'];
        yield ['prg'];
        yield ['pt'];
        yield ['pt_AO'];
        yield ['pt_BR'];
        yield ['pt_CH'];
        yield ['pt_CV'];
        yield ['pt_GQ'];
        yield ['pt_GW'];
        yield ['pt_LU'];
        yield ['pt_MO'];
        yield ['pt_MZ'];
        yield ['pt_PT'];
        yield ['pt_ST'];
        yield ['pt_TL'];
        yield ['qu'];
        yield ['qu_BO'];
        yield ['qu_EC'];
        yield ['quz'];
        yield ['quz_PE'];
        yield ['raj'];
        yield ['raj_IN'];
        yield ['rm'];
        yield ['rn'];
        yield ['ro'];
        yield ['ro_MD'];
        yield ['ro_RO'];
        yield ['rof'];
        yield ['ru'];
        yield ['ru_BY'];
        yield ['ru_KG'];
        yield ['ru_KZ'];
        yield ['ru_MD'];
        yield ['ru_RU'];
        yield ['ru_UA'];
        yield ['rw'];
        yield ['rw_RW'];
        yield ['rwk'];
        yield ['sa'];
        yield ['sa_IN'];
        yield ['sah'];
        yield ['sah_RU'];
        yield ['saq'];
        yield ['sat'];
        yield ['sat_IN'];
        yield ['sbp'];
        yield ['sd'];
        yield ['sd_IN'];
        yield ['sd_IN@devanagari'];
        yield ['se'];
        yield ['se_FI'];
        yield ['se_NO'];
        yield ['se_SE'];
        yield ['seh'];
        yield ['ses'];
        yield ['sg'];
        yield ['sgs'];
        yield ['sgs_LT'];
        yield ['shi'];
        yield ['shi_Latn'];
        yield ['shi_Tfng'];
        yield ['shn'];
        yield ['shn_MM'];
        yield ['shs'];
        yield ['shs_CA'];
        yield ['sid'];
        yield ['sid_ET'];
        yield ['sl'];
        yield ['sl_SI'];
        yield ['sm'];
        yield ['sm_WS'];
        yield ['smn'];
        yield ['sn'];
        yield ['so'];
        yield ['so_DJ'];
        yield ['so_ET'];
        yield ['so_KE'];
        yield ['so_SO'];
        yield ['sq'];
        yield ['sq_AL'];
        yield ['sq_MK'];
        yield ['sq_XK'];
        yield ['sr'];
        yield ['sr_Cyrl'];
        yield ['sr_Cyrl_BA'];
        yield ['sr_Cyrl_ME'];
        yield ['sr_Cyrl_XK'];
        yield ['sr_Latn'];
        yield ['sr_Latn_BA'];
        yield ['sr_Latn_ME'];
        yield ['sr_Latn_XK'];
        yield ['sr_ME'];
        yield ['sr_RS'];
        yield ['sr_RS@latin'];
        yield ['ss'];
        yield ['ss_ZA'];
        yield ['st'];
        yield ['st_ZA'];
        yield ['sv'];
        yield ['sv_AX'];
        yield ['sv_FI'];
        yield ['sv_SE'];
        yield ['sw'];
        yield ['sw_CD'];
        yield ['sw_KE'];
        yield ['sw_TZ'];
        yield ['sw_UG'];
        yield ['szl'];
        yield ['szl_PL'];
        yield ['ta'];
        yield ['ta_IN'];
        yield ['ta_LK'];
        yield ['tcy'];
        yield ['tcy_IN'];
        yield ['teo'];
        yield ['teo_KE'];
        yield ['tet'];
        yield ['tg'];
        yield ['tg_TJ'];
        yield ['th'];
        yield ['th_TH'];
        yield ['the'];
        yield ['the_NP'];
        yield ['ti'];
        yield ['ti_ER'];
        yield ['ti_ET'];
        yield ['tk'];
        yield ['tk_TM'];
        yield ['tlh'];
        yield ['tn'];
        yield ['tn_ZA'];
        yield ['to'];
        yield ['to_TO'];
        yield ['tpi'];
        yield ['tpi_PG'];
        yield ['tr'];
        yield ['tr_TR'];
        yield ['ts'];
        yield ['ts_ZA'];
        yield ['tt_RU@iqtelif'];
        yield ['twq'];
        yield ['tzl'];
        yield ['tzm'];
        yield ['tzm_Latn'];
        yield ['ug'];
        yield ['ug_CN'];
        yield ['uk'];
        yield ['uk_UA'];
        yield ['unm'];
        yield ['unm_US'];
        yield ['ur'];
        yield ['ur_IN'];
        yield ['ur_PK'];
        yield ['uz_Arab'];
        yield ['vai'];
        yield ['vai_Vaii'];
        yield ['ve'];
        yield ['ve_ZA'];
        yield ['vi'];
        yield ['vi_VN'];
        yield ['vo'];
        yield ['vun'];
        yield ['wa'];
        yield ['wa_BE'];
        yield ['wae'];
        yield ['wae_CH'];
        yield ['wal'];
        yield ['wal_ET'];
        yield ['xh'];
        yield ['xh_ZA'];
        yield ['xog'];
        yield ['yav'];
        yield ['yi'];
        yield ['yi_US'];
        yield ['yo'];
        yield ['yo_BJ'];
        yield ['yo_NG'];
        yield ['yue'];
        yield ['yue_HK'];
        yield ['yue_Hans'];
        yield ['yue_Hant'];
        yield ['yuw'];
        yield ['yuw_PG'];
        yield ['zh'];
        yield ['zh_CN'];
        yield ['zh_HK'];
        yield ['zh_Hans'];
        yield ['zh_Hans_HK'];
        yield ['zh_Hans_MO'];
        yield ['zh_Hans_SG'];
        yield ['zh_Hant'];
        yield ['zh_Hant_HK'];
        yield ['zh_Hant_MO'];
        yield ['zh_Hant_TW'];
        yield ['zh_MO'];
        yield ['zh_SG'];
        yield ['zh_TW'];
        yield ['zh_YUE'];
        yield ['zu'];
        yield ['zu_ZA'];
    }
}
