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
use Carbon\Translator;
use Symfony\Component\Translation\Loader\ArrayLoader;
use Symfony\Component\Translation\MessageCatalogue;
use Tests\AbstractTestCase;

class LocalizationTest extends AbstractTestCase
{
    protected function tearDown()
    {
        parent::tearDown();
        Carbon::setLocale('en');
    }

    public function testGetTranslator()
    {
        $t = Carbon::getTranslator();
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

        $this->assertSame('fr', $locale);
        $this->assertSame('il y a 2 secondes', $diff);

        if (setlocale(LC_ALL, 'ar_AE.UTF-8', 'ar_AE.utf8', 'ar_AE', 'ar') === false) {
            $this->markTestSkipped('testSetLocaleToAuto test need ar_AE.UTF-8.');
        }
        Carbon::setLocale('auto');
        $locale = Carbon::getLocale();
        $diff = Carbon::now()->subSeconds(2)->diffForHumans();
        setlocale(LC_ALL, $currentLocale);

        $this->assertSame('ar', $locale);
        $this->assertSame('منذ ثانيتين', $diff);

        if (setlocale(LC_ALL, 'sr_ME.UTF-8', 'sr_ME.utf8', 'sr_ME', 'sr') === false) {
            $this->markTestSkipped('testSetLocaleToAuto test need sr_ME.UTF-8.');
        }
        Carbon::setLocale('auto');
        $locale = Carbon::getLocale();
        $diff = Carbon::now()->subSeconds(2)->diffForHumans();
        setlocale(LC_ALL, $currentLocale);

        $this->assertSame('sr_ME', $locale);
        $this->assertSame('prije 2 sekunde', $diff);

        if (setlocale(LC_ALL, 'zh_TW.UTF-8', 'zh_TW.utf8', 'zh_TW', 'zh') === false) {
            $this->markTestSkipped('testSetLocaleToAuto test need zh_TW.UTF-8.');
        }
        Carbon::setLocale('auto');
        $locale = Carbon::getLocale();
        $diff = Carbon::now()->subSeconds(2)->diffForHumans();
        setlocale(LC_ALL, $currentLocale);

        $this->assertSame('zh_TW', $locale);
        $this->assertSame('2秒前', $diff);

        if (setlocale(LC_ALL, 'zh_CN.UTF-8', 'zh_CN.utf8', 'zh_CN', 'zh') === false) {
            $this->markTestSkipped('testSetLocaleToAuto test need zh_CN.UTF-8.');
        }
        Carbon::setLocale('en');
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
            ['ar_Shakl'],
            ['az'],
            ['bg'],
            ['bn'],
            ['ca'],
            ['cs'],
            ['da'],
            ['de'],
            ['dv_MV'],
            ['el'],
            ['en'],
            ['eo'],
            ['es'],
            ['et'],
            ['eu'],
            ['fa'],
            ['fi'],
            ['fo'],
            ['fr'],
            ['gl'],
            ['he'],
            ['hr'],
            ['hu'],
            ['hy'],
            ['id'],
            ['it'],
            ['ja'],
            ['ka'],
            ['kk'],
            ['km'],
            ['ko'],
            ['lt'],
            ['lv'],
            ['mk'],
            ['mn'],
            ['ms'],
            ['nl'],
            ['no'],
            ['pl'],
            ['pt'],
            ['pt_BR'],
            ['ps'],
            ['ro'],
            ['ru'],
            ['sk'],
            ['sl'],
            ['sq'],
            ['sr'],
            ['sr_Cyrl'],
            ['sr_Cyrl_ME'],
            ['sr_Latn_ME'],
            ['sr_ME'],
            ['sv'],
            ['th'],
            ['tr'],
            ['uk'],
            ['ur'],
            ['uz'],
            ['vi'],
            ['zh'],
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
        $this->assertSame($locale, Carbon::getLocale());
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

        $t = Carbon::getTranslator();
        $this->assertNotNull($t);
        $this->assertSame($locale, $t->getLocale());
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
        $resources['day'] = '1 boring day|:count boring days';
        $translator->addResource('array', $resources, 'en');

        $diff = Carbon::create(2018, 1, 1, 0, 0, 0)
            ->diffForHumans(Carbon::create(2018, 1, 4, 4, 0, 0), true, false, 2);

        $this->assertSame('3 boring days 4 hours', $diff);

        Carbon::setLocale('en');
    }

    public function testAddCustomTranslation()
    {
        $enBoring = [
            'day' => '1 boring day|:count boring days',
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

    public function testLocaleHasShortUnits()
    {
        $withShortUnit = array(
            'year' => 'foo',
            'y' => 'bar',
        );
        $withShortHourOnly = array(
            'year' => 'foo',
            'y' => 'foo',
            'day' => 'foo',
            'd' => 'foo',
            'hour' => 'foo',
            'h' => 'bar',
        );
        $withoutShortUnit = array(
            'year' => 'foo',
        );
        $withSameShortUnit = array(
            'year' => 'foo',
            'y' => 'foo',
        );
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
        $withDiffSyntax = array(
            'year' => 'foo',
            'ago' => ':time ago',
            'from_now' => ':time from now',
            'after' => ':time after',
            'before' => ':time before',
        );
        $withoutDiffSyntax = array(
            'year' => 'foo',
        );
        $withDiffSyntaxLocale = 'zz_'.ucfirst(strtolower('withDiffSyntax'));
        $withoutDiffSyntaxLocale = 'zz_'.ucfirst(strtolower('withoutDiffSyntax'));

        /** @var Translator $translator */
        $translator = Carbon::getTranslator();
        $translator->setMessages($withDiffSyntaxLocale, $withDiffSyntax);
        $translator->setMessages($withoutDiffSyntaxLocale, $withoutDiffSyntax);

        $this->assertTrue(Carbon::localeHasDiffSyntax($withDiffSyntaxLocale));
        $this->assertFalse(Carbon::localeHasDiffSyntax($withoutDiffSyntaxLocale));
    }

    public function testLocaleHasDiffOneDayWords()
    {
        $withOneDayWords = array(
            'year' => 'foo',
            'diff_now' => 'just now',
            'diff_yesterday' => 'yesterday',
            'diff_tomorrow' => 'tomorrow',
        );
        $withoutOneDayWords = array(
            'year' => 'foo',
        );
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
        $withTwoDayWords = array(
            'year' => 'foo',
            'diff_before_yesterday' => 'before yesterday',
            'diff_after_tomorrow' => 'after tomorrow',
        );
        $withoutTwoDayWords = array(
            'year' => 'foo',
        );
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
        $withPeriodSyntax = array(
            'year' => 'foo',
            'period_recurrences' => 'once|:count times',
            'period_interval' => 'every :interval',
            'period_start_date' => 'from :date',
            'period_end_date' => 'to :date',
        );
        $withoutPeriodSyntax = array(
            'year' => 'foo',
        );
        $withPeriodSyntaxLocale = 'zz_'.ucfirst(strtolower('withPeriodSyntax'));
        $withoutPeriodSyntaxLocale = 'zz_'.ucfirst(strtolower('withoutPeriodSyntax'));

        /** @var Translator $translator */
        $translator = Carbon::getTranslator();
        $translator->setMessages($withPeriodSyntaxLocale, $withPeriodSyntax);
        $translator->setMessages($withoutPeriodSyntaxLocale, $withoutPeriodSyntax);

        $this->assertTrue(Carbon::localeHasPeriodSyntax($withPeriodSyntaxLocale));
        $this->assertFalse(Carbon::localeHasPeriodSyntax($withoutPeriodSyntaxLocale));
    }

    public function testGetAvailableLocales()
    {
        $this->assertCount(count(glob(__DIR__.'/../../src/Carbon/Lang/*.php')), Carbon::getAvailableLocales());

        /** @var Translator $translator */
        $translator = Carbon::getTranslator();
        $translator->setMessages('zz_ZZ', array());
        $this->assertTrue(in_array('zz_ZZ', Carbon::getAvailableLocales()));

        Carbon::setTranslator(new \Symfony\Component\Translation\Translator('en'));
        $this->assertSame(array(), Carbon::getAvailableLocales());
    }
}
