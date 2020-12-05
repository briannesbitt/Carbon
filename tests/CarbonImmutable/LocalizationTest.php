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
use Carbon\CarbonInterval;
use Carbon\Exceptions\NotLocaleAwareException;
use Carbon\Language;
use Carbon\Translator;
use Symfony\Component\Translation\IdentityTranslator;
use Symfony\Component\Translation\Loader\ArrayLoader;
use Symfony\Component\Translation\MessageCatalogue;
use Symfony\Component\Translation\MessageSelector;
use Symfony\Component\Translation\TranslatorInterface;
use Tests\AbstractTestCase;
use Tests\CarbonImmutable\Fixtures\MyCarbon;

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
     * @return array
     */
    public function providerLocales()
    {
        return [
            ['af'],
            ['ar'],
            ['ar_DZ'],
            ['ar_KW'],
            ['ar_LY'],
            ['ar_MA'],
            ['ar_SA'],
            ['ar_Shakl'],
            ['ar_TN'],
            ['az'],
            ['be'],
            ['bg'],
            ['bm'],
            ['bn'],
            ['bo'],
            ['br'],
            ['bs'],
            ['bs_BA'],
            ['ca'],
            ['cs'],
            ['cv'],
            ['cy'],
            ['da'],
            ['de'],
            ['de_AT'],
            ['de_CH'],
            ['dv'],
            ['dv_MV'],
            ['el'],
            ['en'],
            ['en_AU'],
            ['en_CA'],
            ['en_GB'],
            ['en_IE'],
            ['en_IL'],
            ['en_NZ'],
            ['eo'],
            ['es'],
            ['es_DO'],
            ['es_US'],
            ['et'],
            ['eu'],
            ['fa'],
            ['fi'],
            ['fo'],
            ['fr'],
            ['fr_CA'],
            ['fr_CH'],
            ['fy'],
            ['gd'],
            ['gl'],
            ['gom_Latn'],
            ['gu'],
            ['he'],
            ['hi'],
            ['hr'],
            ['hu'],
            ['hy'],
            ['hy_AM'],
            ['id'],
            ['is'],
            ['it'],
            ['ja'],
            ['jv'],
            ['ka'],
            ['kk'],
            ['km'],
            ['kn'],
            ['ko'],
            ['ku'],
            ['ky'],
            ['lb'],
            ['lo'],
            ['lt'],
            ['lv'],
            ['me'],
            ['mi'],
            ['mk'],
            ['ml'],
            ['mn'],
            ['mr'],
            ['ms'],
            ['ms_MY'],
            ['mt'],
            ['my'],
            ['nb'],
            ['ne'],
            ['nl'],
            ['nl_BE'],
            ['nn'],
            ['no'],
            ['oc'],
            ['pa_IN'],
            ['pl'],
            ['ps'],
            ['pt'],
            ['pt_BR'],
            ['ro'],
            ['ru'],
            ['sd'],
            ['se'],
            ['sh'],
            ['si'],
            ['sk'],
            ['sl'],
            ['sq'],
            ['sr'],
            ['sr_Cyrl'],
            ['sr_Cyrl_ME'],
            ['sr_Latn_ME'],
            ['sr_ME'],
            ['ss'],
            ['sv'],
            ['sw'],
            ['ta'],
            ['te'],
            ['tet'],
            ['tg'],
            ['th'],
            ['tl_PH'],
            ['tlh'],
            ['tr'],
            ['tzl'],
            ['tzm'],
            ['tzm_Latn'],
            ['ug_CN'],
            ['uk'],
            ['ur'],
            ['uz'],
            ['uz_Latn'],
            ['vi'],
            ['yo'],
            ['zh'],
            ['zh_CN'],
            ['zh_HK'],
            ['zh_TW'],
        ];
    }

    /**
     * @dataProvider \Tests\Carbon\LocalizationTest::providerLocales
     *
     * @param string $locale
     */
    public function testSetLocale($locale)
    {
        $this->assertTrue(Carbon::setLocale($locale));
        $this->assertTrue($this->areSameLocales($locale, Carbon::getLocale()));
    }

    /**
     * @dataProvider \Tests\Carbon\LocalizationTest::providerLocales
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
        Carbon::setTranslator($ori);
    }

    public function testSetLocaleWithKnownLocale()
    {
        $this->assertTrue(Carbon::setLocale('fr'));
    }

    /**
     * @see \Tests\Carbon\LocalizationTest::testSetLocaleWithMalformedLocale
     *
     * @return array
     */
    public function dataProviderTestSetLocaleWithMalformedLocale()
    {
        return [
            ['DE'],
            ['pt-BR'],
            ['pt-br'],
            ['PT-br'],
            ['PT-BR'],
            ['pt_br'],
            ['PT_br'],
            ['PT_BR'],
        ];
    }

    /**
     * @dataProvider \Tests\Carbon\LocalizationTest::dataProviderTestSetLocaleWithMalformedLocale
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
        $this->assertCount(count(glob(__DIR__.'/../../src/Carbon/Lang/*.php')), Carbon::getAvailableLocales());

        /** @var Translator $translator */
        $translator = Carbon::getTranslator();
        $translator->setMessages('zz_ZZ', []);
        $this->assertContains('zz_ZZ', Carbon::getAvailableLocales());

        Carbon::setTranslator(new \Symfony\Component\Translation\Translator('en'));
        $this->assertSame(['en'], Carbon::getAvailableLocales());
    }

    public function testNotLocaleAwareException()
    {
        if (method_exists(TranslatorInterface::class, 'getLocale')) {
            $this->markTestSkipped('In Symfony < 5, NotLocaleAwareException will never been thrown.');
        }

        $translator = new class implements TranslatorInterface {
            public function trans(string $id, array $parameters = [], string $domain = null, string $locale = null)
            {
                return 'x';
            }
        };

        Carbon::setTranslator($translator);

        $this->expectException(NotLocaleAwareException::class);
        $this->expectExceptionMessage(get_class($translator).' does neither implements Symfony\\Contracts\\Translation\\LocaleAwareInterface nor getLocale() method.');

        Carbon::now()->locale();
    }

    public function testGetAvailableLocalesInfo()
    {
        $infos = Carbon::getAvailableLocalesInfo();
        $this->assertCount(count(Carbon::getAvailableLocales()), Carbon::getAvailableLocalesInfo());
        $this->assertArrayHasKey('en', $infos);
        $this->assertInstanceOf(Language::class, $infos['en']);
        $this->assertSame('English', $infos['en']->getIsoName());
    }

    public function testGeorgianSpecialFromNowTranslation()
    {
        $diff = Carbon::now()->locale('ka')->addWeeks(3)->diffForHumans();

        $this->assertSame('3 კვირაში', $diff);
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
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage(
            'Translator does not implement Symfony\Component\Translation\TranslatorInterface '.
            'and Symfony\Component\Translation\TranslatorBagInterface. '.
            'Symfony\Component\Translation\IdentityTranslator has been given.'
        );

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

        Carbon::setTranslator(new \Symfony\Component\Translation\IdentityTranslator());

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
}
