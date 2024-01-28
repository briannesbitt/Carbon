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
use InvalidArgumentException;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Group;
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
            'month must be between 0 and 99, -5 given',
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
        $this->assertNull(Carbon::create(null, -5));
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

    #[Group('localization')]
    #[DataProvider('dataForLocales')]
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

    public static function dataForLocales(): array
    {
        $locales = [
            'aa_ER',
            'aa_ER@saaho',
            'aa_ET',
            'af',
            'af_NA',
            'af_ZA',
            'agq',
            'agr',
            'agr_PE',
            'ak',
            'ak_GH',
            'am',
            'am_ET',
            'an',
            'an_ES',
            'anp',
            'anp_IN',
            'ar',
            'ar_AE',
            'ar_BH',
            'ar_DJ',
            'ar_DZ',
            'ar_EG',
            'ar_EH',
            'ar_ER',
            'ar_IL',
            'ar_IN',
            'ar_IQ',
            'ar_JO',
            'ar_KM',
            'ar_KW',
            'ar_LB',
            'ar_LY',
            'ar_MA',
            'ar_MR',
            'ar_OM',
            'ar_PS',
            'ar_QA',
            'ar_SA',
            'ar_SD',
            'ar_SO',
            'ar_SS',
            'ar_SY',
            'ar_Shakl',
            'ar_TD',
            'ar_TN',
            'ar_YE',
            'as',
            'as_IN',
            'asa',
            'ast',
            'ast_ES',
            'ayc',
            'ayc_PE',
            'az',
            'az_AZ',
            'az_Cyrl',
            'az_Latn',
            'bas',
            'be',
            'be_BY',
            'bem',
            'bem_ZM',
            'ber',
            'ber_DZ',
            'ber_MA',
            'bez',
            'bg',
            'bg_BG',
            'bhb',
            'bhb_IN',
            'bho',
            'bho_IN',
            'bi',
            'bi_VU',
            'bm',
            'bo_IN',
            'br',
            'br_FR',
            'brx',
            'brx_IN',
            'bs',
            'bs_BA',
            'bs_Cyrl',
            'bs_Latn',
            'ca',
            'ca_AD',
            'ca_ES',
            'ca_ES_Valencia',
            'ca_FR',
            'ca_IT',
            'ccp',
            'ccp_IN',
            'ce',
            'ce_RU',
            'cgg',
            'chr',
            'chr_US',
            'cmn',
            'cmn_TW',
            'crh',
            'crh_UA',
            'cu',
            'cy',
            'cy_GB',
            'da',
            'da_DK',
            'da_GL',
            'dav',
            'dje',
            'doi',
            'doi_IN',
            'dsb',
            'dsb_DE',
            'dua',
            'dv',
            'dv_MV',
            'dyo',
            'dz',
            'dz_BT',
            'ebu',
            'ee_TG',
            'el',
            'el_CY',
            'el_GR',
            'en',
            'en_001',
            'en_150',
            'en_AG',
            'en_AI',
            'en_AS',
            'en_AT',
            'en_AU',
            'en_BB',
            'en_BE',
            'en_BI',
            'en_BM',
            'en_BS',
            'en_BW',
            'en_BZ',
            'en_CA',
            'en_CC',
            'en_CH',
            'en_CK',
            'en_CM',
            'en_CX',
            'en_CY',
            'en_DE',
            'en_DG',
            'en_DK',
            'en_DM',
            'en_ER',
            'en_FI',
            'en_FJ',
            'en_FK',
            'en_FM',
            'en_GB',
            'en_GD',
            'en_GG',
            'en_GH',
            'en_GI',
            'en_GM',
            'en_GU',
            'en_GY',
            'en_HK',
            'en_IE',
            'en_IL',
            'en_IM',
            'en_IN',
            'en_IO',
            'en_ISO',
            'en_JE',
            'en_JM',
            'en_KE',
            'en_KI',
            'en_KN',
            'en_KY',
            'en_LC',
            'en_LR',
            'en_LS',
            'en_MG',
            'en_MH',
            'en_MO',
            'en_MP',
            'en_MS',
            'en_MT',
            'en_MU',
            'en_MW',
            'en_MY',
            'en_NA',
            'en_NF',
            'en_NG',
            'en_NL',
            'en_NR',
            'en_NU',
            'en_NZ',
            'en_PG',
            'en_PH',
            'en_PK',
            'en_PN',
            'en_PR',
            'en_PW',
            'en_RW',
            'en_SB',
            'en_SC',
            'en_SD',
            'en_SE',
            'en_SG',
            'en_SH',
            'en_SI',
            'en_SL',
            'en_SS',
            'en_SX',
            'en_SZ',
            'en_TC',
            'en_TK',
            'en_TO',
            'en_TT',
            'en_TV',
            'en_TZ',
            'en_UG',
            'en_UM',
            'en_US',
            'en_US_Posix',
            'en_VC',
            'en_VG',
            'en_VI',
            'en_VU',
            'en_WS',
            'en_ZA',
            'en_ZM',
            'en_ZW',
            'eo',
            'es',
            'es_419',
            'es_AR',
            'es_BO',
            'es_BR',
            'es_BZ',
            'es_CL',
            'es_CO',
            'es_CR',
            'es_CU',
            'es_DO',
            'es_EA',
            'es_EC',
            'es_ES',
            'es_GQ',
            'es_GT',
            'es_HN',
            'es_IC',
            'es_MX',
            'es_NI',
            'es_PA',
            'es_PE',
            'es_PH',
            'es_PR',
            'es_PY',
            'es_SV',
            'es_US',
            'es_UY',
            'es_VE',
            'et',
            'et_EE',
            'ewo',
            'ff',
            'ff_CM',
            'ff_GN',
            'ff_MR',
            'ff_SN',
            'fil',
            'fil_PH',
            'fo',
            'fo_DK',
            'fo_FO',
            'fr',
            'fr_BE',
            'fr_BF',
            'fr_BI',
            'fr_BJ',
            'fr_BL',
            'fr_CA',
            'fr_CD',
            'fr_CF',
            'fr_CG',
            'fr_CH',
            'fr_CI',
            'fr_CM',
            'fr_DJ',
            'fr_DZ',
            'fr_FR',
            'fr_GA',
            'fr_GF',
            'fr_GN',
            'fr_GP',
            'fr_GQ',
            'fr_HT',
            'fr_KM',
            'fr_LU',
            'fr_MA',
            'fr_MC',
            'fr_MF',
            'fr_MG',
            'fr_ML',
            'fr_MQ',
            'fr_MR',
            'fr_MU',
            'fr_NC',
            'fr_NE',
            'fr_PF',
            'fr_PM',
            'fr_RE',
            'fr_RW',
            'fr_SC',
            'fr_SN',
            'fr_SY',
            'fr_TD',
            'fr_TG',
            'fr_TN',
            'fr_VU',
            'fr_WF',
            'fr_YT',
            'fy',
            'fy_NL',
            'ga',
            'ga_IE',
            'gd',
            'gd_GB',
            'gez',
            'gez_ER',
            'gez_ET',
            'gl',
            'gl_ES',
            'guz',
            'gv',
            'gv_GB',
            'ha',
            'ha_GH',
            'ha_NE',
            'ha_NG',
            'hak',
            'hak_TW',
            'haw',
            'he',
            'he_IL',
            'hif',
            'hif_FJ',
            'hne',
            'hne_IN',
            'hr',
            'hr_BA',
            'hr_HR',
            'hsb',
            'hsb_DE',
            'ht',
            'ht_HT',
            'hy',
            'hy_AM',
            'ia',
            'ia_FR',
            'id',
            'id_ID',
            'ig',
            'ig_NG',
            'ii',
            'ik',
            'ik_CA',
            'in',
            'it',
            'it_CH',
            'it_IT',
            'it_SM',
            'it_VA',
            'iu',
            'iu_CA',
            'iw',
            'ja',
            'ja_JP',
            'jgo',
            'jmc',
            'jv',
            'kab',
            'kab_DZ',
            'kam',
            'kde',
            'kea',
            'khq',
            'ki',
            'kk',
            'kk_KZ',
            'kkj',
            'kl',
            'kl_GL',
            'kln',
            'km',
            'km_KH',
            'kok',
            'kok_IN',
            'ks',
            'ks_IN',
            'ks_IN@devanagari',
            'ksb',
            'ksf',
            'ksh',
            'kw',
            'kw_GB',
            'ky',
            'ky_KG',
            'lag',
            'lg',
            'lg_UG',
            'li',
            'li_NL',
            'lij',
            'lij_IT',
            'lkt',
            'ln',
            'ln_AO',
            'ln_CD',
            'ln_CF',
            'ln_CG',
            'lo',
            'lo_LA',
            'lrc',
            'lrc_IQ',
            'lt',
            'lt_LT',
            'lu',
            'luo',
            'luy',
            'lzh',
            'lzh_TW',
            'mag',
            'mag_IN',
            'mai',
            'mai_IN',
            'mas',
            'mas_TZ',
            'mer',
            'mfe',
            'mfe_MU',
            'mg',
            'mg_MG',
            'mgh',
            'mgo',
            'mhr',
            'mhr_RU',
            'mi',
            'mi_NZ',
            'miq',
            'miq_NI',
            'mjw',
            'mjw_IN',
            'mk',
            'mk_MK',
            'mni',
            'mni_IN',
            'mo',
            'ms',
            'ms_BN',
            'ms_MY',
            'ms_SG',
            'mt',
            'mt_MT',
            'mua',
            'mzn',
            'nan',
            'nan_TW',
            'nan_TW@latin',
            'naq',
            'nb',
            'nb_NO',
            'nb_SJ',
            'nd',
            'nds',
            'nds_DE',
            'nds_NL',
            'ne_IN',
            'nhn',
            'nhn_MX',
            'niu',
            'niu_NU',
            'nl',
            'nl_AW',
            'nl_BE',
            'nl_BQ',
            'nl_CW',
            'nl_NL',
            'nl_SR',
            'nl_SX',
            'nmg',
            'nn',
            'nn_NO',
            'nnh',
            'no',
            'nr',
            'nr_ZA',
            'nso',
            'nso_ZA',
            'nus',
            'nyn',
            'oc',
            'oc_FR',
            'om',
            'om_ET',
            'om_KE',
            'os',
            'os_RU',
            'pa_Arab',
            'pa_Guru',
            'pl',
            'pl_PL',
            'prg',
            'pt',
            'pt_AO',
            'pt_BR',
            'pt_CH',
            'pt_CV',
            'pt_GQ',
            'pt_GW',
            'pt_LU',
            'pt_MO',
            'pt_MZ',
            'pt_PT',
            'pt_ST',
            'pt_TL',
            'qu',
            'qu_BO',
            'qu_EC',
            'quz',
            'quz_PE',
            'raj',
            'raj_IN',
            'rm',
            'rn',
            'ro',
            'ro_MD',
            'ro_RO',
            'rof',
            'ru',
            'ru_BY',
            'ru_KG',
            'ru_KZ',
            'ru_MD',
            'ru_RU',
            'ru_UA',
            'rw',
            'rw_RW',
            'rwk',
            'sa',
            'sa_IN',
            'sah',
            'sah_RU',
            'saq',
            'sat',
            'sat_IN',
            'sbp',
            'sd',
            'sd_IN',
            'sd_IN@devanagari',
            'se',
            'se_FI',
            'se_NO',
            'se_SE',
            'seh',
            'ses',
            'sg',
            'sgs',
            'sgs_LT',
            'shi',
            'shi_Latn',
            'shi_Tfng',
            'shn',
            'shn_MM',
            'shs',
            'shs_CA',
            'sid',
            'sid_ET',
            'sl',
            'sl_SI',
            'sm',
            'sm_WS',
            'smn',
            'sn',
            'so',
            'so_DJ',
            'so_ET',
            'so_KE',
            'so_SO',
            'sq',
            'sq_AL',
            'sq_MK',
            'sq_XK',
            'sr',
            'sr_Cyrl',
            'sr_Cyrl_BA',
            'sr_Cyrl_ME',
            'sr_Cyrl_XK',
            'sr_Latn',
            'sr_Latn_BA',
            'sr_Latn_ME',
            'sr_Latn_XK',
            'sr_ME',
            'sr_RS',
            'sr_RS@latin',
            'ss',
            'ss_ZA',
            'st',
            'st_ZA',
            'sv',
            'sv_AX',
            'sv_FI',
            'sv_SE',
            'sw',
            'sw_CD',
            'sw_KE',
            'sw_TZ',
            'sw_UG',
            'szl',
            'szl_PL',
            'ta',
            'ta_IN',
            'ta_LK',
            'tcy',
            'tcy_IN',
            'teo',
            'teo_KE',
            'tet',
            'tg',
            'tg_TJ',
            'th',
            'th_TH',
            'the',
            'the_NP',
            'ti',
            'ti_ER',
            'ti_ET',
            'tk',
            'tk_TM',
            'tlh',
            'tn',
            'tn_ZA',
            'to',
            'to_TO',
            'tpi',
            'tpi_PG',
            'tr',
            'tr_TR',
            'ts',
            'ts_ZA',
            'tt_RU@iqtelif',
            'twq',
            'tzl',
            'tzm',
            'tzm_Latn',
            'ug',
            'ug_CN',
            'uk',
            'uk_UA',
            'unm',
            'unm_US',
            'ur',
            'ur_IN',
            'ur_PK',
            'uz_Arab',
            'vai',
            'vai_Vaii',
            've',
            've_ZA',
            'vi',
            'vi_VN',
            'vo',
            'vun',
            'wa',
            'wa_BE',
            'wae',
            'wae_CH',
            'wal',
            'wal_ET',
            'xh',
            'xh_ZA',
            'xog',
            'yav',
            'yi',
            'yi_US',
            'yo',
            'yo_BJ',
            'yo_NG',
            'yue',
            'yue_HK',
            'yue_Hans',
            'yue_Hant',
            'yuw',
            'yuw_PG',
            'zh',
            'zh_CN',
            'zh_HK',
            'zh_Hans',
            'zh_Hans_HK',
            'zh_Hans_MO',
            'zh_Hans_SG',
            'zh_Hant',
            'zh_Hant_HK',
            'zh_Hant_MO',
            'zh_Hant_TW',
            'zh_MO',
            'zh_SG',
            'zh_TW',
            'zh_YUE',
            'zu',
            'zu_ZA',
        ];

        return array_combine(
            $locales,
            array_map(
                static fn (string $locale) => [$locale],
                $locales,
            ),
        );
    }
}
