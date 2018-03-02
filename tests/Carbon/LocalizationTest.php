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
use Symfony\Component\Translation\Loader\ArrayLoader;
use Symfony\Component\Translation\MessageCatalogue;
use Symfony\Component\Translation\Translator;
use Tests\AbstractTestCase;

class LocalizationTest extends AbstractTestCase
{
    public function testGetTranslator()
    {
        $t = Carbon::getTranslator();
        $this->assertNotNull($t);
        $this->assertSame('en', $t->getLocale());
    }

    /**
     * @see \Tests\Carbon\LocalizationTest::testSetLocale
     * @see \Tests\Carbon\LocalizationTest::testSetTranslator
     *
     * @return array
     */
    public function providerLocales()
    {
        return array(
            array('af'),
            array('ar'),
            array('ar_Shakl'),
            array('az'),
            array('bg'),
            array('bn'),
            array('ca'),
            array('cs'),
            array('da'),
            array('de'),
            array('dv_MV'),
            array('el'),
            array('en'),
            array('eo'),
            array('es'),
            array('et'),
            array('eu'),
            array('fa'),
            array('fi'),
            array('fo'),
            array('fr'),
            array('gl'),
            array('he'),
            array('hr'),
            array('hu'),
            array('hy'),
            array('id'),
            array('it'),
            array('ja'),
            array('ka'),
            array('kk'),
            array('km'),
            array('ko'),
            array('lt'),
            array('lv'),
            array('mk'),
            array('mn'),
            array('ms'),
            array('nl'),
            array('no'),
            array('pl'),
            array('pt'),
            array('pt_BR'),
            array('ps'),
            array('ro'),
            array('ru'),
            array('sk'),
            array('sl'),
            array('sq'),
            array('sr'),
            array('sr_Cyrl'),
            array('sr_Cyrl_ME'),
            array('sr_Latn_ME'),
            array('sr_ME'),
            array('sv'),
            array('th'),
            array('tr'),
            array('uk'),
            array('ur'),
            array('uz'),
            array('vi'),
            array('zh'),
            array('zh_TW'),
        );
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
        $t = new Translator($locale);
        $t->addLoader('array', new ArrayLoader());
        Carbon::setTranslator($t);

        $t = Carbon::getTranslator();
        $this->assertNotNull($t);
        $this->assertSame($locale, $t->getLocale());
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
        return array(
            array('DE'),
            array('pt-BR'),
            array('pt-br'),
            array('PT-br'),
            array('PT-BR'),
            array('pt_br'),
            array('PT_br'),
            array('PT_BR'),
        );
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
}
