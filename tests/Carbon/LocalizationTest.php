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
use Carbon\CarbonInterval;
use Carbon\Exceptions\NotLocaleAwareException;
use Carbon\Language;
use Carbon\Translator;
use Generator;
use InvalidArgumentException;
use Symfony\Component\Translation\IdentityTranslator;
use Symfony\Component\Translation\Loader\ArrayLoader;
use Symfony\Component\Translation\MessageCatalogue;
use Symfony\Component\Translation\MessageSelector;
use Symfony\Component\Translation\Translator as SymfonyTranslator;
use Symfony\Component\Translation\TranslatorInterface;
use Tests\AbstractTestCase;
use Tests\Carbon\Fixtures\MyCarbon;

/**
 * @group localization
 */
class LocalizationTest extends AbstractTestCase
{
    protected function tearDown(): void
    {
        parent::tearDown();
        Carbon::setLocale('en');
    }

    public function testGetTranslator()
    {
        /** @var Translator $t */
        $t = Carbon::getTranslator();
        $this->assertNotNull($t);
        $this->assertSame('en', $t->getLocale());
    }

    public function testResetTranslator()
    {
        /** @var Translator $t */
        $t = MyCarbon::getTranslator();
        $this->assertNotNull($t);
        $this->assertSame('en', $t->getLocale());
    }

    public function testSetLocaleToAuto()
    {
        $currentLocale = setlocale(LC_ALL, '0');
        if (setlocale(LC_ALL, 'fr_FR.UTF-8', 'fr_FR.utf8', 'fr_FR', 'fr') === false) {
            $this->markTestSkipped('testSetLocaleToAuto test need fr_FR.UTF-8.');
        }
        Carbon::setLocale('auto');
        $locale = Carbon::getLocale();
        $diff = Carbon::now()->subSeconds(2)->diffForHumans();
        setlocale(LC_ALL, $currentLocale);

        $this->assertSame('fr', $locale === 'fr_FR' ? 'fr' : $locale);
        $this->assertSame('il y a 2 secondes', $diff);

        if (setlocale(LC_ALL, 'ar_AE.UTF-8', 'ar_AE.utf8', 'ar_AE', 'ar') === false) {
            $this->markTestSkipped('testSetLocaleToAuto test need ar_AE.UTF-8.');
        }
        rename(__DIR__.'/../../src/Carbon/Lang/ar_AE.php', __DIR__.'/../../src/Carbon/Lang/disabled_ar_AE.php');
        Carbon::setLocale('auto');
        $locale = Carbon::getLocale();
        $diff = Carbon::now()->subSeconds(2)->diffForHumans();
        setlocale(LC_ALL, $currentLocale);
        rename(__DIR__.'/../../src/Carbon/Lang/disabled_ar_AE.php', __DIR__.'/../../src/Carbon/Lang/ar_AE.php');

        $this->assertStringStartsWith('ar', $locale);
        $this->assertSame('منذ ثانيتين', $diff);

        if (setlocale(LC_ALL, 'sr_ME.UTF-8', 'sr_ME.utf8', 'sr_ME', 'sr') === false) {
            $this->markTestSkipped('testSetLocaleToAuto test need sr_ME.UTF-8.');
        }
        Carbon::setLocale('auto');
        $locale = Carbon::getLocale();
        $diff = Carbon::now()->subSeconds(2)->diffForHumans();
        setlocale(LC_ALL, $currentLocale);

        $this->assertStringStartsWith('sr', $locale);
        $this->assertSame('pre 2 sekunde', str_replace('prije', 'pre', $diff));

        if (setlocale(LC_ALL, 'zh_TW.UTF-8', 'zh_TW.utf8', 'zh_TW', 'zh') === false) {
            $this->markTestSkipped('testSetLocaleToAuto test need zh_TW.UTF-8.');
        }
        Carbon::setLocale('auto');
        $locale = Carbon::getLocale();
        $diff = Carbon::now()->subSeconds(2)->diffForHumans();
        setlocale(LC_ALL, $currentLocale);

        $this->assertStringStartsWith('zh', $locale);
        $this->assertSame('2秒前', $diff);

        /** @var Translator $translator */
        $translator = Carbon::getTranslator();
        $translator->resetMessages();
        $translator->setLocale('en');
        $directories = $translator->getDirectories();
        $directory = sys_get_temp_dir().'/carbon'.mt_rand(0, 9999999);
        mkdir($directory);
        $translator->setDirectories([$directory]);

        $files = [
            'zh_Hans',
            'zh',
            'fr',
            'fr_CA',
        ];

        foreach ($files as $file) {
            copy(__DIR__."/../../src/Carbon/Lang/$file.php", "$directory/$file.php");
        }

        $currentLocale = setlocale(LC_ALL, '0');
        if (setlocale(LC_ALL, 'fr_FR.UTF-8', 'fr_FR.utf8', 'fr_FR', 'fr') === false) {
            $this->markTestSkipped('testSetLocaleToAuto test need fr_FR.UTF-8.');
        }
        Carbon::setLocale('auto');
        $locale = Carbon::getLocale();
        $diff = Carbon::now()->subSeconds(2)->diffForHumans();
        setlocale(LC_ALL, $currentLocale);

        $this->assertSame('fr', $locale);
        $this->assertSame('il y a 2 secondes', $diff);

        if (setlocale(LC_ALL, 'zh_CN.UTF-8', 'zh_CN.utf8', 'zh_CN', 'zh') === false) {
            $this->markTestSkipped('testSetLocaleToAuto test need zh_CN.UTF-8.');
        }
        Carbon::setLocale('auto');
        $locale = Carbon::getLocale();
        $diff = Carbon::now()->subSeconds(2)->diffForHumans();
        setlocale(LC_ALL, $currentLocale);

        $this->assertSame('zh', $locale);
        $this->assertSame('2秒前', $diff);

        if (setlocale(LC_ALL, 'yo_NG.UTF-8', 'yo_NG.utf8', 'yo_NG', 'yo') === false) {
            $this->markTestSkipped('testSetLocaleToAuto test need yo_NG.UTF-8.');
        }
        Carbon::setLocale('en');
        Carbon::setLocale('auto');
        $locale = Carbon::getLocale();
        $diff = Carbon::now()->subSeconds(2)->diffForHumans();
        setlocale(LC_ALL, $currentLocale);

        $this->assertSame('en', $locale);
        $this->assertSame('2 seconds ago', $diff);

        $translator->setDirectories($directories);

        foreach ($files as $file) {
            unlink("$directory/$file.php");
        }

        rmdir($directory);
    }

    /**
     * @see \Tests\Carbon\LocalizationTest::testSetLocale
     * @see \Tests\Carbon\LocalizationTest::testSetTranslator
     *
     * @return \Generator
     */
    public static function dataForLocales(): Generator
    {
        yield ['af'];
        yield ['ar'];
        yield ['ar_DZ'];
        yield ['ar_KW'];
        yield ['ar_LY'];
        yield ['ar_MA'];
        yield ['ar_SA'];
        yield ['ar_Shakl'];
        yield ['ar_TN'];
        yield ['az'];
        yield ['be'];
        yield ['bg'];
        yield ['bm'];
        yield ['bn'];
        yield ['bo'];
        yield ['br'];
        yield ['bs'];
        yield ['bs_BA'];
        yield ['ca'];
        yield ['cs'];
        yield ['cv'];
        yield ['cy'];
        yield ['da'];
        yield ['de'];
        yield ['de_AT'];
        yield ['de_CH'];
        yield ['dv'];
        yield ['dv_MV'];
        yield ['el'];
        yield ['en'];
        yield ['en_AU'];
        yield ['en_CA'];
        yield ['en_GB'];
        yield ['en_IE'];
        yield ['en_IL'];
        yield ['en_NZ'];
        yield ['eo'];
        yield ['es'];
        yield ['es_DO'];
        yield ['es_US'];
        yield ['et'];
        yield ['eu'];
        yield ['fa'];
        yield ['fi'];
        yield ['fo'];
        yield ['fr'];
        yield ['fr_CA'];
        yield ['fr_CH'];
        yield ['fy'];
        yield ['gd'];
        yield ['gl'];
        yield ['gom_Latn'];
        yield ['gu'];
        yield ['he'];
        yield ['hi'];
        yield ['hr'];
        yield ['hu'];
        yield ['hy'];
        yield ['hy_AM'];
        yield ['id'];
        yield ['is'];
        yield ['it'];
        yield ['ja'];
        yield ['jv'];
        yield ['ka'];
        yield ['kk'];
        yield ['km'];
        yield ['kn'];
        yield ['ko'];
        yield ['ku'];
        yield ['ky'];
        yield ['lb'];
        yield ['lo'];
        yield ['lt'];
        yield ['lv'];
        yield ['me'];
        yield ['mi'];
        yield ['mk'];
        yield ['ml'];
        yield ['mn'];
        yield ['mr'];
        yield ['ms'];
        yield ['ms_MY'];
        yield ['mt'];
        yield ['my'];
        yield ['nb'];
        yield ['ne'];
        yield ['nl'];
        yield ['nl_BE'];
        yield ['nn'];
        yield ['no'];
        yield ['oc'];
        yield ['pa_IN'];
        yield ['pl'];
        yield ['ps'];
        yield ['pt'];
        yield ['pt_BR'];
        yield ['ro'];
        yield ['ru'];
        yield ['sd'];
        yield ['se'];
        yield ['sh'];
        yield ['si'];
        yield ['sk'];
        yield ['sl'];
        yield ['sq'];
        yield ['sr'];
        yield ['sr_Cyrl'];
        yield ['sr_Cyrl_ME'];
        yield ['sr_Latn_ME'];
        yield ['sr_ME'];
        yield ['ss'];
        yield ['sv'];
        yield ['sw'];
        yield ['ta'];
        yield ['te'];
        yield ['tet'];
        yield ['tg'];
        yield ['th'];
        yield ['tl_PH'];
        yield ['tlh'];
        yield ['tr'];
        yield ['tzl'];
        yield ['tzm'];
        yield ['tzm_Latn'];
        yield ['ug_CN'];
        yield ['uk'];
        yield ['ur'];
        yield ['uz'];
        yield ['uz_Latn'];
        yield ['vi'];
        yield ['yo'];
        yield ['zh'];
        yield ['zh_CN'];
        yield ['zh_HK'];
        yield ['zh_TW'];
    }

    /**
     * @dataProvider \Tests\Carbon\LocalizationTest::dataForLocales
     *
     * @param string $locale
     */
    public function testSetLocale($locale)
    {
        $this->assertTrue(Carbon::setLocale($locale));
        $this->assertTrue($this->areSameLocales($locale, Carbon::getLocale()));
    }

    /**
     * @dataProvider \Tests\Carbon\LocalizationTest::dataForLocales
     *
     * @param string $locale
     */
    public function testSetTranslator($locale)
    {
        $ori = Carbon::getTranslator();
        $t = new Translator($locale);
        $t->addLoader('array', new ArrayLoader());
        Carbon::setTranslator($t);

        /** @var Translator $t */
        $t = Carbon::getTranslator();
        $this->assertNotNull($t);
        $this->assertTrue($this->areSameLocales($locale, $t->getLocale()));
        $this->assertTrue($this->areSameLocales($locale, Carbon::now()->locale()));
        Carbon::setTranslator($ori);
    }

    public function testSetLocaleWithKnownLocale()
    {
        $this->assertTrue(Carbon::setLocale('fr'));
    }

    /**
     * @see \Tests\Carbon\LocalizationTest::testSetLocaleWithMalformedLocale
     *
     * @return \Generator
     */
    public static function dataForTestSetLocaleWithMalformedLocale(): Generator
    {
        yield ['DE'];
        yield ['pt-BR'];
        yield ['pt-br'];
        yield ['PT-br'];
        yield ['PT-BR'];
        yield ['pt_br'];
        yield ['PT_br'];
        yield ['PT_BR'];
    }

    /**
     * @dataProvider \Tests\Carbon\LocalizationTest::dataForTestSetLocaleWithMalformedLocale
     *
     * @param string $malformedLocale
     */
    public function testSetLocaleWithMalformedLocale($malformedLocale)
    {
        $this->assertTrue(Carbon::setLocale($malformedLocale));
    }

    public function testSetLocaleWithNonExistingLocale()
    {
        $this->assertFalse(Carbon::setLocale('pt-XX'));
    }

    public function testSetLocaleWithUnknownLocale()
    {
        $this->assertFalse(Carbon::setLocale('zz'));
    }

    public function testCustomTranslation()
    {
        Carbon::setLocale('en');
        /** @var Translator $translator */
        $translator = Carbon::getTranslator();
        /** @var MessageCatalogue $messages */
        $messages = $translator->getCatalogue('en');
        $resources = $messages->all('messages');
        $resources['day'] = '1 boring day|%count% boring days';
        $translator->addResource('array', $resources, 'en');

        $diff = Carbon::create(2018, 1, 1, 0, 0, 0)
            ->diffForHumans(Carbon::create(2018, 1, 4, 4, 0, 0), true, false, 2);

        $this->assertSame('3 boring days 4 hours', $diff);

        Carbon::setLocale('en');
    }

    public function testCustomLocalTranslation()
    {
        $boringLanguage = 'en_Overboring';
        $translator = Translator::get($boringLanguage);
        $translator->setTranslations([
            'day' => ':count boring day|:count boring days',
        ]);

        $date1 = Carbon::create(2018, 1, 1, 0, 0, 0);
        $date2 = Carbon::create(2018, 1, 4, 4, 0, 0);

        $this->assertSame('3 boring days before', $date1->locale($boringLanguage)->diffForHumans($date2));

        $translator->setTranslations([
            'before' => function ($time) {
                return '['.strtoupper($time).']';
            },
        ]);

        $this->assertSame('[3 BORING DAYS]', $date1->locale($boringLanguage)->diffForHumans($date2));

        $meridiem = Translator::get('ru')->trans('meridiem', [
            'hours' => 9,
            'minutes' => 30,
            'seconds' => 0,
        ]);

        $this->assertSame('утра', $meridiem);
    }

    public function testAddCustomTranslation()
    {
        $enBoring = [
            'day' => '1 boring day|%count% boring days',
        ];

        $this->assertTrue(Carbon::setLocale('en'));
        /** @var Translator $translator */
        $translator = Carbon::getTranslator();
        $translator->setMessages('en', $enBoring);

        $diff = Carbon::create(2018, 1, 1, 0, 0, 0)
            ->diffForHumans(Carbon::create(2018, 1, 4, 4, 0, 0), true, false, 2);

        $this->assertSame('3 boring days 4 hours', $diff);

        $translator->resetMessages('en');

        $diff = Carbon::create(2018, 1, 1, 0, 0, 0)
            ->diffForHumans(Carbon::create(2018, 1, 4, 4, 0, 0), true, false, 2);

        $this->assertSame('3 days 4 hours', $diff);

        $translator->setMessages('en_Boring', $enBoring);

        $this->assertSame($enBoring, $translator->getMessages('en_Boring'));

        $messages = $translator->getMessages();

        $this->assertArrayHasKey('en', $messages);
        $this->assertArrayHasKey('en_Boring', $messages);
        $this->assertSame($enBoring, $messages['en_Boring']);

        $this->assertTrue(Carbon::setLocale('en_Boring'));

        $diff = Carbon::create(2018, 1, 1, 0, 0, 0)
            ->diffForHumans(Carbon::create(2018, 1, 4, 4, 0, 0), true, false, 2);

        // en_Boring inherit en because it starts with "en", see symfony-translation behavior
        $this->assertSame('3 boring days 4 hours', $diff);

        $translator->resetMessages();

        $this->assertSame([], $translator->getMessages());

        $this->assertTrue(Carbon::setLocale('en'));
    }

    public function testCustomWeekStart()
    {
        $this->assertTrue(Carbon::setLocale('ru'));

        /** @var Translator $translator */
        $translator = Carbon::getTranslator();

        $translator->setMessages('ru', [
            'first_day_of_week' => 1,
        ]);

        $calendar = Carbon::parse('2018-07-07 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-07-07 00:00:00'));
        $this->assertSame('В следующий вторник, в 0:00', $calendar);
        $calendar = Carbon::parse('2018-07-12 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-07-12 00:00:00'));
        $this->assertSame('В воскресенье, в 0:00', $calendar);

        $translator->setMessages('ru', [
            'first_day_of_week' => 5,
        ]);

        $calendar = Carbon::parse('2018-07-07 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-07-07 00:00:00'));
        $this->assertSame('Во вторник, в 0:00', $calendar);
        $calendar = Carbon::parse('2018-07-12 00:00:00')->addDays(3)->calendar(Carbon::parse('2018-07-12 00:00:00'));
        $this->assertSame('В следующее воскресенье, в 0:00', $calendar);

        $translator->resetMessages('ru');

        $this->assertTrue(Carbon::setLocale('en'));
    }

    public function testAddAndRemoveDirectory()
    {
        $directory = sys_get_temp_dir().'/carbon'.mt_rand(0, 9999999);
        mkdir($directory);
        copy(__DIR__.'/../../src/Carbon/Lang/fr.php', "$directory/foo.php");
        copy(__DIR__.'/../../src/Carbon/Lang/fr.php', "$directory/bar.php");

        /** @var Translator $translator */
        $translator = Carbon::getTranslator();
        Carbon::setLocale('en');

        $this->assertFalse(Carbon::setLocale('foo'));
        $this->assertSame('Saturday', Carbon::parse('2018-07-07 00:00:00')->isoFormat('dddd'));

        $translator->addDirectory($directory);

        $this->assertTrue(Carbon::setLocale('foo'));
        $this->assertSame('samedi', Carbon::parse('2018-07-07 00:00:00')->isoFormat('dddd'));

        Carbon::setLocale('en');
        $translator->removeDirectory($directory);

        $this->assertFalse(Carbon::setLocale('bar'));
        $this->assertSame('Saturday', Carbon::parse('2018-07-07 00:00:00')->isoFormat('dddd'));

        $this->assertTrue(Carbon::setLocale('foo'));
        $this->assertSame('samedi', Carbon::parse('2018-07-07 00:00:00')->isoFormat('dddd'));

        $this->assertTrue(Carbon::setLocale('en'));
    }

    public function testLocaleHasShortUnits()
    {
        $withShortUnit = [
            'year' => 'foo',
            'y' => 'bar',
        ];
        $withShortHourOnly = [
            'year' => 'foo',
            'y' => 'foo',
            'day' => 'foo',
            'd' => 'foo',
            'hour' => 'foo',
            'h' => 'bar',
        ];
        $withoutShortUnit = [
            'year' => 'foo',
        ];
        $withSameShortUnit = [
            'year' => 'foo',
            'y' => 'foo',
        ];
        $withShortHourOnlyLocale = 'zz_'.ucfirst(strtolower('withShortHourOnly'));
        $withShortUnitLocale = 'zz_'.ucfirst(strtolower('withShortUnit'));
        $withoutShortUnitLocale = 'zz_'.ucfirst(strtolower('withoutShortUnit'));
        $withSameShortUnitLocale = 'zz_'.ucfirst(strtolower('withSameShortUnit'));

        /** @var Translator $translator */
        $translator = Carbon::getTranslator();
        $translator->setMessages($withShortUnitLocale, $withShortUnit);
        $translator->setMessages($withShortHourOnlyLocale, $withShortHourOnly);
        $translator->setMessages($withoutShortUnitLocale, $withoutShortUnit);
        $translator->setMessages($withSameShortUnitLocale, $withSameShortUnit);

        $this->assertTrue(Carbon::localeHasShortUnits($withShortUnitLocale));
        $this->assertTrue(Carbon::localeHasShortUnits($withShortHourOnlyLocale));
        $this->assertFalse(Carbon::localeHasShortUnits($withoutShortUnitLocale));
        $this->assertFalse(Carbon::localeHasShortUnits($withSameShortUnitLocale));
    }

    public function testLocaleHasDiffSyntax()
    {
        $withDiffSyntax = [
            'year' => 'foo',
            'ago' => ':time ago',
            'from_now' => ':time from now',
            'after' => ':time after',
            'before' => ':time before',
        ];
        $withoutDiffSyntax = [
            'year' => 'foo',
        ];
        $withDiffSyntaxLocale = 'zz_'.ucfirst(strtolower('withDiffSyntax'));
        $withoutDiffSyntaxLocale = 'zz_'.ucfirst(strtolower('withoutDiffSyntax'));

        /** @var Translator $translator */
        $translator = Carbon::getTranslator();
        $translator->setMessages($withDiffSyntaxLocale, $withDiffSyntax);
        $translator->setMessages($withoutDiffSyntaxLocale, $withoutDiffSyntax);

        $this->assertTrue(Carbon::localeHasDiffSyntax($withDiffSyntaxLocale));
        $this->assertFalse(Carbon::localeHasDiffSyntax($withoutDiffSyntaxLocale));

        $this->assertTrue(Carbon::localeHasDiffSyntax('ka'));
        $this->assertFalse(Carbon::localeHasDiffSyntax('foobar'));
    }

    public function testLocaleHasDiffOneDayWords()
    {
        $withOneDayWords = [
            'year' => 'foo',
            'diff_now' => 'just now',
            'diff_yesterday' => 'yesterday',
            'diff_tomorrow' => 'tomorrow',
        ];
        $withoutOneDayWords = [
            'year' => 'foo',
        ];
        $withOneDayWordsLocale = 'zz_'.ucfirst(strtolower('withOneDayWords'));
        $withoutOneDayWordsLocale = 'zz_'.ucfirst(strtolower('withoutOneDayWords'));

        /** @var Translator $translator */
        $translator = Carbon::getTranslator();
        $translator->setMessages($withOneDayWordsLocale, $withOneDayWords);
        $translator->setMessages($withoutOneDayWordsLocale, $withoutOneDayWords);

        $this->assertTrue(Carbon::localeHasDiffOneDayWords($withOneDayWordsLocale));
        $this->assertFalse(Carbon::localeHasDiffOneDayWords($withoutOneDayWordsLocale));
    }

    public function testLocaleHasDiffTwoDayWords()
    {
        $withTwoDayWords = [
            'year' => 'foo',
            'diff_before_yesterday' => 'before yesterday',
            'diff_after_tomorrow' => 'after tomorrow',
        ];
        $withoutTwoDayWords = [
            'year' => 'foo',
        ];
        $withTwoDayWordsLocale = 'zz_'.ucfirst(strtolower('withTwoDayWords'));
        $withoutTwoDayWordsLocale = 'zz_'.ucfirst(strtolower('withoutTwoDayWords'));

        /** @var Translator $translator */
        $translator = Carbon::getTranslator();
        $translator->setMessages($withTwoDayWordsLocale, $withTwoDayWords);
        $translator->setMessages($withoutTwoDayWordsLocale, $withoutTwoDayWords);

        $this->assertTrue(Carbon::localeHasDiffTwoDayWords($withTwoDayWordsLocale));
        $this->assertFalse(Carbon::localeHasDiffTwoDayWords($withoutTwoDayWordsLocale));
    }

    public function testLocaleHasPeriodSyntax()
    {
        $withPeriodSyntax = [
            'year' => 'foo',
            'period_recurrences' => 'once|%count% times',
            'period_interval' => 'every :interval',
            'period_start_date' => 'from :date',
            'period_end_date' => 'to :date',
        ];
        $withoutPeriodSyntax = [
            'year' => 'foo',
        ];
        $withPeriodSyntaxLocale = 'zz_'.ucfirst(strtolower('withPeriodSyntax'));
        $withoutPeriodSyntaxLocale = 'zz_'.ucfirst(strtolower('withoutPeriodSyntax'));

        /** @var Translator $translator */
        $translator = Carbon::getTranslator();
        $translator->setMessages($withPeriodSyntaxLocale, $withPeriodSyntax);
        $translator->setMessages($withoutPeriodSyntaxLocale, $withoutPeriodSyntax);

        $this->assertTrue(Carbon::localeHasPeriodSyntax($withPeriodSyntaxLocale));
        $this->assertFalse(Carbon::localeHasPeriodSyntax($withoutPeriodSyntaxLocale));

        $this->assertTrue(Carbon::localeHasPeriodSyntax('nl'));
    }

    public function testGetAvailableLocales()
    {
        $this->assertCount(\count(glob(__DIR__.'/../../src/Carbon/Lang/*.php')), Carbon::getAvailableLocales());

        /** @var Translator $translator */
        $translator = Carbon::getTranslator();
        $translator->setMessages('zz_ZZ', []);
        $this->assertContains('zz_ZZ', Carbon::getAvailableLocales());

        Carbon::setTranslator(new SymfonyTranslator('en'));
        $this->assertSame(['en'], Carbon::getAvailableLocales());
    }

    public function testNotLocaleAwareException()
    {
        if (method_exists(TranslatorInterface::class, 'getLocale')) {
            $this->markTestSkipped('In Symfony < 5, NotLocaleAwareException will never been thrown.');
        }

        $translator = new class() implements TranslatorInterface {
            public function trans(string $id, array $parameters = [], ?string $domain = null, ?string $locale = null)
            {
                return 'x';
            }
        };

        Carbon::setTranslator($translator);

        $this->expectExceptionObject(new NotLocaleAwareException(
            $translator
        ));

        Carbon::now()->locale();
    }

    public function testGetAvailableLocalesInfo()
    {
        $infos = Carbon::getAvailableLocalesInfo();
        $this->assertCount(\count(Carbon::getAvailableLocales()), Carbon::getAvailableLocalesInfo());
        $this->assertArrayHasKey('en', $infos);
        $this->assertInstanceOf(Language::class, $infos['en']);
        $this->assertSame('English', $infos['en']->getIsoName());
    }

    public function testGeorgianSpecialFromNowTranslation()
    {
        $diff = Carbon::now()->locale('ka')->addWeeks(3)->diffForHumans();

        $this->assertSame('3 კვირაში', $diff);
    }

    public function testSinhaleseSpecialAfterTranslation()
    {
        $diff = Carbon::now()->locale('si')->addDays(3)->diffForHumans(Carbon::now());

        $this->assertSame('දින 3 න්', $diff);
    }

    public function testWeekDayMultipleForms()
    {
        $date = Carbon::parse('2018-10-10')->locale('ru');

        $this->assertSame('в среду', $date->isoFormat('[в] dddd'));
        $this->assertSame('среда, 10 октября 2018', $date->isoFormat('dddd, D MMMM YYYY'));
        $this->assertSame('среда', $date->dayName);
        $this->assertSame('ср', $date->isoFormat('dd'));

        $date = Carbon::parse('2018-10-10')->locale('uk');

        $this->assertSame('середа, 10', $date->isoFormat('dddd, D'));
        $this->assertSame('в середу', $date->isoFormat('[в] dddd'));
        $this->assertSame('минулої середи', $date->isoFormat('[минулої] dddd'));
    }

    public function testTranslationCustomWithCustomTranslator()
    {
        $this->expectExceptionObject(new InvalidArgumentException(
            'Translator does not implement Symfony\Component\Translation\TranslatorInterface '.
            'and Symfony\Component\Translation\TranslatorBagInterface. '.
            'Symfony\Component\Translation\IdentityTranslator has been given.'
        ));

        $date = Carbon::create(2018, 1, 1, 0, 0, 0);
        $date->setLocalTranslator(
            class_exists(MessageSelector::class)
                ? new IdentityTranslator(new MessageSelector())
                : new IdentityTranslator()
        );

        $date->getTranslationMessage('foo');
    }

    public function testTranslateTimeStringTo()
    {
        $date = Carbon::parse('2019-07-05')->locale('de');
        $baseString = $date->isoFormat('LLLL');

        $this->assertSame('Freitag, 5. Juli 2019 00:00', $baseString);
        $this->assertSame('Friday, 5. July 2019 00:00', $date->translateTimeStringTo($baseString));
        $this->assertSame('vendredi, 5. juillet 2019 00:00', $date->translateTimeStringTo($baseString, 'fr'));
    }

    public function testFallbackLocales()
    {
        // /!\ Used for backward compatibility, please avoid this method
        // @see testMultiLocales() as preferred method

        $myDialect = 'xx_MY_Dialect';
        $secondChoice = 'xy_MY_Dialect';
        $thirdChoice = 'it_CH';

        /** @var Translator $translator */
        $translator = Carbon::getTranslator();

        $translator->setMessages($myDialect, [
            'day' => ':count yub yub',
        ]);

        $translator->setMessages($secondChoice, [
            'day' => ':count buza',
            'hour' => ':count ohto',
        ]);

        Carbon::setLocale($myDialect);

        $this->assertNull(Carbon::getFallbackLocale());

        Carbon::setFallbackLocale($thirdChoice);

        $this->assertSame($thirdChoice, Carbon::getFallbackLocale());
        $this->assertSame('3 yub yub e 5 ora fa', Carbon::now()->subDays(3)->subHours(5)->ago([
            'parts' => 2,
            'join' => true,
        ]));

        Carbon::setTranslator(new Translator('en'));

        /** @var Translator $translator */
        $translator = Carbon::getTranslator();

        $translator->setMessages($myDialect, [
            'day' => ':count yub yub',
        ]);

        $translator->setMessages($secondChoice, [
            'day' => ':count buza',
            'hour' => ':count ohto',
        ]);

        Carbon::setLocale($myDialect);
        Carbon::setFallbackLocale($secondChoice);
        Carbon::setFallbackLocale($thirdChoice);

        $this->assertSame($thirdChoice, Carbon::getFallbackLocale());
        $this->assertSame('3 yub yub e 5 ohto fa', Carbon::now()->subDays(3)->subHours(5)->ago([
            'parts' => 2,
            'join' => true,
        ]));

        Carbon::setTranslator(new IdentityTranslator());

        $this->assertNull(Carbon::getFallbackLocale());

        Carbon::setTranslator(new Translator('en'));
    }

    public function testMultiLocales()
    {
        $myDialect = 'xx_MY_Dialect';
        $secondChoice = 'xy_MY_Dialect';
        $thirdChoice = 'it_CH';

        Translator::get($myDialect)->setTranslations([
            'day' => ':count yub yub',
        ]);

        Translator::get($secondChoice)->setTranslations([
            'day' => ':count buza',
            'hour' => ':count ohto',
        ]);

        $date = Carbon::now()->subDays(3)->subHours(5)->locale($myDialect, $secondChoice, $thirdChoice);

        $this->assertSame('3 yub yub e 5 ohto fa', $date->ago([
            'parts' => 2,
            'join' => true,
        ]));
    }

    public function testStandAloneMonthsInLLLFormat()
    {
        $this->assertSame(
            '29 февраля 2020 г., 12:24',
            Carbon::parse('2020-02-29 12:24:00')->locale('ru_RU')->isoFormat('LLL')
        );
    }

    public function testAgoDeclension()
    {
        $this->assertSame(
            'година',
            CarbonInterval::hour()->locale('uk')->forHumans(['aUnit' => true])
        );

        $this->assertSame(
            'годину тому',
            Carbon::now()->subHour()->locale('uk')->diffForHumans(['aUnit' => true])
        );
    }

    public function testAustriaGermanJanuary()
    {
        $this->assertSame(
            'Jänner',
            Carbon::parse('2020-01-15')->locale('de_AT')->monthName
        );

        $this->assertSame(
            'Januar',
            Carbon::parse('2020-01-15')->locale('de')->monthName
        );

        $this->assertSame(
            'Februar',
            Carbon::parse('2020-02-15')->locale('de_AT')->monthName
        );

        $this->assertSame(
            'Februar',
            Carbon::parse('2020-02-15')->locale('de')->monthName
        );
    }

    public function testDeclensionModes()
    {
        Carbon::setTestNow('2022-12-30');
        $this->assertSame(
            '2 жил 3 сар 1 өдөр 1с өмнө',
            Carbon::now()
                ->subYears(2)
                ->subMonths(3)
                ->subDay()
                ->subSecond()
                ->locale('mn')
                ->diffForHumans(null, null, true, 4)
        );
        $this->assertSame(
            '2 жил 3 сар 1 өдөр 1 секундын өмнө',
            Carbon::now()
                ->subYears(2)
                ->subMonths(3)
                ->subDay()
                ->subSecond()
                ->locale('mn')
                ->diffForHumans(null, null, false, 4)
        );
    }
}
