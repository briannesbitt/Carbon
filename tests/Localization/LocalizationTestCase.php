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

namespace Tests\Localization;

use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Carbon\CarbonInterval;
use InvalidArgumentException;
use PHPUnit\Framework\Attributes\Group;
use Tests\AbstractTestCase;

/**
 * @SuppressWarnings(NumberOfChildren)
 */
abstract class LocalizationTestCase extends AbstractTestCase
{
    public const LOCALE = 'en';

    public const LOCALES = [
        'aa' => 'Afar',
        'ab' => 'Abkhazian',
        'ae' => 'Avestan',
        'af' => 'Afrikaans',
        'ak' => 'Akan',
        'am' => 'Amharic',
        'an' => 'Aragonese',
        'ar' => 'Arabic',
        'as' => 'Assamese',
        'av' => 'Avaric',
        'ay' => 'Aymara',
        'az' => 'Azerbaijani',
        'ba' => 'Bashkir',
        'be' => 'Belarusian',
        'bg' => 'Bulgarian',
        'bh' => 'Bihari',
        'bi' => 'Bislama',
        'bm' => 'Bambara',
        'bn' => 'Bengali',
        'bo' => 'Tibetan',
        'br' => 'Breton',
        'bs' => 'Bosnian',
        'ca' => 'Catalan',
        'ce' => 'Chechen',
        'ch' => 'Chamorro',
        'co' => 'Corsican',
        'cr' => 'Cree',
        'cs' => 'Czech',
        'cu' => 'OldChurchSlavonic',
        'cv' => 'Chuvash',
        'cy' => 'Welsh',
        'da' => 'Danish',
        'de' => 'German',
        'dv' => 'Divehi',
        'dz' => 'Dzongkha',
        'ee' => 'Ewe',
        'el' => 'Greek',
        'en' => 'English',
        'eo' => 'Esperanto',
        'es' => 'Spanish',
        'et' => 'Estonian',
        'eu' => 'Basque',
        'fa' => 'Persian',
        'ff' => 'Fulah',
        'fi' => 'Finnish',
        'fj' => 'Fijian',
        'fo' => 'Faroese',
        'fr' => 'French',
        'fy' => 'WesternFrisian',
        'ga' => 'Irish',
        'gd' => 'ScottishGaelic',
        'gl' => 'Galician',
        'gn' => 'Guarani',
        'gu' => 'Gujarati',
        'gv' => 'Manx',
        'ha' => 'Hausa',
        'he' => 'Hebrew',
        'hi' => 'Hindi',
        'ho' => 'HiriMotu',
        'hr' => 'Croatian',
        'ht' => 'Haitian',
        'hu' => 'Hungarian',
        'hy' => 'Armenian',
        'hz' => 'Herero',
        'ia' => 'Interlingua',
        'id' => 'Indonesian',
        'ie' => 'Interlingue',
        'ig' => 'Igbo',
        'ii' => 'SichuanYi',
        'ik' => 'Inupiaq',
        'io' => 'Ido',
        'is' => 'Icelandic',
        'it' => 'Italian',
        'iu' => 'Inuktitut',
        'ja' => 'Japanese',
        'jv' => 'Javanese',
        'ka' => 'Georgian',
        'kg' => 'Kongo',
        'ki' => 'Kikuyu',
        'kj' => 'Kwanyama',
        'kk' => 'Kazakh',
        'kl' => 'Kalaallisut',
        'km' => 'Khmer',
        'kn' => 'Kannada',
        'ko' => 'Korean',
        'kr' => 'Kanuri',
        'ks' => 'Kashmiri',
        'ku' => 'Kurdish',
        'kv' => 'Komi',
        'kw' => 'Cornish',
        'ky' => 'Kirghiz',
        'la' => 'Latin',
        'lb' => 'Luxembourgish',
        'lg' => 'Ganda',
        'li' => 'Limburgish',
        'ln' => 'Lingala',
        'lo' => 'Lao',
        'lt' => 'Lithuanian',
        'lu' => 'LubaKatanga',
        'lv' => 'Latvian',
        'mg' => 'Malagasy',
        'mh' => 'Marshallese',
        'mi' => 'Maori',
        'mk' => 'Macedonian',
        'ml' => 'Malayalam',
        'mn' => 'Mongolian',
        'mo' => 'Moldavian',
        'mr' => 'Marathi',
        'ms' => 'Malay',
        'mt' => 'Maltese',
        'my' => 'Burmese',
        'na' => 'Nauru',
        'nb' => 'NorwegianBokmal',
        'nd' => 'NorthNdebele',
        'ne' => 'Nepali',
        'ng' => 'Ndonga',
        'nl' => 'Dutch',
        'nn' => 'NorwegianNynorsk',
        'no' => 'Norwegian',
        'nr' => 'SouthNdebele',
        'nv' => 'Navajo',
        'ny' => 'Chichewa',
        'oc' => 'Occitan',
        'oj' => 'Ojibwa',
        'om' => 'Oromo',
        'or' => 'Oriya',
        'os' => 'Ossetian',
        'pa' => 'Panjabi',
        'pi' => 'Pali',
        'pl' => 'Polish',
        'ps' => 'Pashto',
        'pt' => 'Portuguese',
        'qu' => 'Quechua',
        'rc' => 'Reunionese',
        'rm' => 'Romansh',
        'rn' => 'Kirundi',
        'ro' => 'Romanian',
        'ru' => 'Russian',
        'rw' => 'Kinyarwanda',
        'sa' => 'Sanskrit',
        'sc' => 'Sardinian',
        'sd' => 'Sindhi',
        'se' => 'NorthernSami',
        'sg' => 'Sango',
        'sh' => 'SerboCroatian',
        'si' => 'Sinhalese',
        'sk' => 'Slovak',
        'sl' => 'Slovenian',
        'sm' => 'Samoan',
        'sn' => 'Shona',
        'so' => 'Somali',
        'sq' => 'Albanian',
        'sr' => 'Serbian',
        'ss' => 'Swati',
        'st' => 'Sotho',
        'su' => 'Sundanese',
        'sv' => 'Swedish',
        'sw' => 'Swahili',
        'ta' => 'Tamil',
        'te' => 'Telugu',
        'tg' => 'Tajik',
        'th' => 'Thai',
        'ti' => 'Tigrinya',
        'tk' => 'Turkmen',
        'tl' => 'Tagalog',
        'tn' => 'Tswana',
        'to' => 'Tonga',
        'tr' => 'Turkish',
        'ts' => 'Tsonga',
        'tt' => 'Tatar',
        'tw' => 'Twi',
        'ty' => 'Tahitian',
        'ug' => 'Uighur',
        'uk' => 'Ukrainian',
        'ur' => 'Urdu',
        'uz' => 'Uzbek',
        've' => 'Venda',
        'vi' => 'Vietnamese',
        'vo' => 'Volapuk',
        'wa' => 'Walloon',
        'wo' => 'Wolof',
        'xh' => 'Xhosa',
        'yi' => 'Yiddish',
        'yo' => 'Yoruba',
        'za' => 'Zhuang',
        'zh' => 'Chinese',
        'zu' => 'Zulu',
        'gom' => 'Konkani Latin script',
    ];

    public const TESTS = [
        '{class}::parse(\'2018-01-04 00:00:00\')->addDays(1)->calendar({class}::parse(\'2018-01-04 00:00:00\'))',
        '{class}::parse(\'2018-01-04 00:00:00\')->addDays(2)->calendar({class}::parse(\'2018-01-04 00:00:00\'))',
        '{class}::parse(\'2018-01-04 00:00:00\')->addDays(3)->calendar({class}::parse(\'2018-01-04 00:00:00\'))',
        '{class}::parse(\'2018-01-04 00:00:00\')->addDays(4)->calendar({class}::parse(\'2018-01-04 00:00:00\'))',
        '{class}::parse(\'2018-01-04 00:00:00\')->addDays(5)->calendar({class}::parse(\'2018-01-04 00:00:00\'))',
        '{class}::parse(\'2018-01-04 00:00:00\')->addDays(6)->calendar({class}::parse(\'2018-01-04 00:00:00\'))',
        '{class}::parse(\'2018-01-05 00:00:00\')->addDays(6)->calendar({class}::parse(\'2018-01-05 00:00:00\'))',
        '{class}::parse(\'2018-01-06 00:00:00\')->addDays(6)->calendar({class}::parse(\'2018-01-06 00:00:00\'))',
        '{class}::parse(\'2018-01-07 00:00:00\')->addDays(2)->calendar({class}::parse(\'2018-01-07 00:00:00\'))',
        '{class}::parse(\'2018-01-07 00:00:00\')->addDays(3)->calendar({class}::parse(\'2018-01-07 00:00:00\'))',
        '{class}::parse(\'2018-01-07 00:00:00\')->addDays(4)->calendar({class}::parse(\'2018-01-07 00:00:00\'))',
        '{class}::parse(\'2018-01-07 00:00:00\')->addDays(5)->calendar({class}::parse(\'2018-01-07 00:00:00\'))',
        '{class}::parse(\'2018-01-07 00:00:00\')->addDays(6)->calendar({class}::parse(\'2018-01-07 00:00:00\'))',
        '{class}::now()->subDays(2)->calendar()',
        '{class}::parse(\'2018-01-04 00:00:00\')->subHours(2)->calendar({class}::parse(\'2018-01-04 00:00:00\'))',
        '{class}::parse(\'2018-01-04 12:00:00\')->subHours(2)->calendar({class}::parse(\'2018-01-04 12:00:00\'))',
        '{class}::parse(\'2018-01-04 00:00:00\')->addHours(2)->calendar({class}::parse(\'2018-01-04 00:00:00\'))',
        '{class}::parse(\'2018-01-04 23:00:00\')->addHours(2)->calendar({class}::parse(\'2018-01-04 23:00:00\'))',
        '{class}::parse(\'2018-01-07 00:00:00\')->addDays(2)->calendar({class}::parse(\'2018-01-07 00:00:00\'))',
        '{class}::parse(\'2018-01-08 00:00:00\')->subDay()->calendar({class}::parse(\'2018-01-08 00:00:00\'))',
        '{class}::parse(\'2018-01-04 00:00:00\')->subDays(1)->calendar({class}::parse(\'2018-01-04 00:00:00\'))',
        '{class}::parse(\'2018-01-04 00:00:00\')->subDays(2)->calendar({class}::parse(\'2018-01-04 00:00:00\'))',
        '{class}::parse(\'2018-01-04 00:00:00\')->subDays(3)->calendar({class}::parse(\'2018-01-04 00:00:00\'))',
        '{class}::parse(\'2018-01-04 00:00:00\')->subDays(4)->calendar({class}::parse(\'2018-01-04 00:00:00\'))',
        '{class}::parse(\'2018-01-04 00:00:00\')->subDays(5)->calendar({class}::parse(\'2018-01-04 00:00:00\'))',
        '{class}::parse(\'2018-01-04 00:00:00\')->subDays(6)->calendar({class}::parse(\'2018-01-04 00:00:00\'))',
        '{class}::parse(\'2018-01-03 00:00:00\')->subDays(6)->calendar({class}::parse(\'2018-01-03 00:00:00\'))',
        '{class}::parse(\'2018-01-02 00:00:00\')->subDays(6)->calendar({class}::parse(\'2018-01-02 00:00:00\'))',
        '{class}::parse(\'2018-01-07 00:00:00\')->subDays(2)->calendar({class}::parse(\'2018-01-07 00:00:00\'))',
        '{class}::parse(\'2018-01-01 00:00:00\')->isoFormat(\'Qo Mo Do Wo wo\')',
        '{class}::parse(\'2018-01-02 00:00:00\')->isoFormat(\'Do wo\')',
        '{class}::parse(\'2018-01-03 00:00:00\')->isoFormat(\'Do wo\')',
        '{class}::parse(\'2018-01-04 00:00:00\')->isoFormat(\'Do wo\')',
        '{class}::parse(\'2018-01-05 00:00:00\')->isoFormat(\'Do wo\')',
        '{class}::parse(\'2018-01-06 00:00:00\')->isoFormat(\'Do wo\')',
        '{class}::parse(\'2018-01-07 00:00:00\')->isoFormat(\'Do wo\')',
        '{class}::parse(\'2018-01-11 00:00:00\')->isoFormat(\'Do wo\')',
        '{class}::parse(\'2018-02-09 00:00:00\')->isoFormat(\'DDDo\')',
        '{class}::parse(\'2018-02-10 00:00:00\')->isoFormat(\'DDDo\')',
        '{class}::parse(\'2018-04-10 00:00:00\')->isoFormat(\'DDDo\')',
        '{class}::parse(\'2018-02-10 00:00:00\', \'Europe/Paris\')->isoFormat(\'h:mm a z\')',
        '{class}::parse(\'2018-02-10 00:00:00\')->isoFormat(\'h:mm A, h:mm a\')',
        '{class}::parse(\'2018-02-10 01:30:00\')->isoFormat(\'h:mm A, h:mm a\')',
        '{class}::parse(\'2018-02-10 02:00:00\')->isoFormat(\'h:mm A, h:mm a\')',
        '{class}::parse(\'2018-02-10 06:00:00\')->isoFormat(\'h:mm A, h:mm a\')',
        '{class}::parse(\'2018-02-10 10:00:00\')->isoFormat(\'h:mm A, h:mm a\')',
        '{class}::parse(\'2018-02-10 12:00:00\')->isoFormat(\'h:mm A, h:mm a\')',
        '{class}::parse(\'2018-02-10 17:00:00\')->isoFormat(\'h:mm A, h:mm a\')',
        '{class}::parse(\'2018-02-10 21:30:00\')->isoFormat(\'h:mm A, h:mm a\')',
        '{class}::parse(\'2018-02-10 23:00:00\')->isoFormat(\'h:mm A, h:mm a\')',
        '{class}::parse(\'2018-01-01 00:00:00\')->ordinal(\'hour\')',
        '{class}::now()->subSeconds(1)->diffForHumans()',
        '{class}::now()->subSeconds(1)->diffForHumans(null, false, true)',
        '{class}::now()->subSeconds(2)->diffForHumans()',
        '{class}::now()->subSeconds(2)->diffForHumans(null, false, true)',
        '{class}::now()->subMinutes(1)->diffForHumans()',
        '{class}::now()->subMinutes(1)->diffForHumans(null, false, true)',
        '{class}::now()->subMinutes(2)->diffForHumans()',
        '{class}::now()->subMinutes(2)->diffForHumans(null, false, true)',
        '{class}::now()->subHours(1)->diffForHumans()',
        '{class}::now()->subHours(1)->diffForHumans(null, false, true)',
        '{class}::now()->subHours(2)->diffForHumans()',
        '{class}::now()->subHours(2)->diffForHumans(null, false, true)',
        '{class}::now()->subDays(1)->diffForHumans()',
        '{class}::now()->subDays(1)->diffForHumans(null, false, true)',
        '{class}::now()->subDays(2)->diffForHumans()',
        '{class}::now()->subDays(2)->diffForHumans(null, false, true)',
        '{class}::now()->subWeeks(1)->diffForHumans()',
        '{class}::now()->subWeeks(1)->diffForHumans(null, false, true)',
        '{class}::now()->subWeeks(2)->diffForHumans()',
        '{class}::now()->subWeeks(2)->diffForHumans(null, false, true)',
        '{class}::now()->subMonths(1)->diffForHumans()',
        '{class}::now()->subMonths(1)->diffForHumans(null, false, true)',
        '{class}::now()->subMonths(2)->diffForHumans()',
        '{class}::now()->subMonths(2)->diffForHumans(null, false, true)',
        '{class}::now()->subYears(1)->diffForHumans()',
        '{class}::now()->subYears(1)->diffForHumans(null, false, true)',
        '{class}::now()->subYears(2)->diffForHumans()',
        '{class}::now()->subYears(2)->diffForHumans(null, false, true)',
        '{class}::now()->addSecond()->diffForHumans()',
        '{class}::now()->addSecond()->diffForHumans(null, false, true)',
        '{class}::now()->addSecond()->diffForHumans({class}::now())',
        '{class}::now()->addSecond()->diffForHumans({class}::now(), false, true)',
        '{class}::now()->diffForHumans({class}::now()->addSecond())',
        '{class}::now()->diffForHumans({class}::now()->addSecond(), false, true)',
        '{class}::now()->addSecond()->diffForHumans({class}::now(), true)',
        '{class}::now()->addSecond()->diffForHumans({class}::now(), true, true)',
        '{class}::now()->diffForHumans({class}::now()->addSecond()->addSecond(), true)',
        '{class}::now()->diffForHumans({class}::now()->addSecond()->addSecond(), true, true)',
        '{class}::now()->addSecond()->diffForHumans(null, false, true, 1)',
        '{class}::now()->addMinute()->addSecond()->diffForHumans(null, true, false, 2)',
        '{class}::now()->addYears(2)->addMonths(3)->addDay()->addSecond()->diffForHumans(null, true, true, 4)',
        '{class}::now()->addYears(3)->diffForHumans(null, null, false, 4)',
        '{class}::now()->subMonths(5)->diffForHumans(null, null, true, 4)',
        '{class}::now()->subYears(2)->subMonths(3)->subDay()->subSecond()->diffForHumans(null, null, true, 4)',
        '{class}::now()->addWeek()->addHours(10)->diffForHumans(null, true, false, 2)',
        '{class}::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)',
        '{class}::now()->addWeek()->addDays(6)->diffForHumans(null, true, false, 2)',
        '{class}::now()->addWeek()->addDays(6)->diffForHumans(["join" => true, "parts" => 2])',
        '{class}::now()->addWeeks(2)->addHour()->diffForHumans(null, true, false, 2)',
        '{class}::now()->addHour()->diffForHumans(["aUnit" => true])',
        'CarbonInterval::days(2)->forHumans()',
        'CarbonInterval::create(\'P1DT3H\')->forHumans(true)',
    ];

    public const CASES = [];

    protected function setUp(): void
    {
        parent::setUp();

        Carbon::setLocale(static::LOCALE);

        if (!$this->areSameLocales(Carbon::getLocale(), static::LOCALE)) {
            throw new InvalidArgumentException('Locale '.static::LOCALE.' not found');
        }

        CarbonImmutable::setLocale(static::LOCALE);

        if (!$this->areSameLocales(CarbonImmutable::getLocale(), static::LOCALE)) {
            throw new InvalidArgumentException('Locale '.static::LOCALE.' not found');
        }

        CarbonInterval::setLocale(static::LOCALE);

        if (!$this->areSameLocales(CarbonInterval::getLocale(), static::LOCALE)) {
            throw new InvalidArgumentException('Locale '.static::LOCALE.' not found');
        }
    }

    #[Group('language')]
    public function testLanguage()
    {
        $this->wrapWithNonDstDate(function () {
            $date = Carbon::parse('2018-05-15 20:49:13.881726');
            Carbon::setTestNow($this->now = $date);
            $date = CarbonImmutable::parse('2018-05-15 20:49:13.881726');
            CarbonImmutable::setTestNow($this->immutableNow = $date);

            foreach (static::TESTS as $index => $test) {
                foreach ([Carbon::class, CarbonImmutable::class] as $class) {
                    $test = str_replace('{class}', $class, $test);
                    $result = eval("use Carbon\CarbonInterval; return $test;");
                    $expected = static::CASES[$index];
                    $locale = static::LOCALE;
                    $key = preg_replace('/^([^_]+)_.*$/', '$1', static::LOCALE);
                    if (isset(static::LOCALES[$key])) {
                        $locale = static::LOCALES[$key].' ('.$locale.')';
                    }

                    $this->assertSame($expected, $result, 'In '.$locale.', '.str_replace('Carbon\\', '', $test).' should return '.$expected);
                }
            }
        });
    }
}
