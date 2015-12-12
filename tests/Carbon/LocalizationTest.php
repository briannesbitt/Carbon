<?php

namespace Tests\Carbon;

/*
 * This file is part of the Carbon package.
 *
 * (c) Brian Nesbitt <brian@nesbot.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Carbon\Carbon;
use Symfony\Component\Translation\Translator;
use Symfony\Component\Translation\Loader\ArrayLoader;
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
            array('az'),
            array('bg'),
            array('bn'),
            array('ca'),
            array('cs'),
            array('da'),
            array('de'),
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
            array('he'),
            array('hr'),
            array('hu'),
            array('id'),
            array('it'),
            array('ja'),
            array('ko'),
            array('lt'),
            array('lv'),
            array('ms'),
            array('nl'),
            array('no'),
            array('pl'),
            array('pt'),
            array('pt_BR'),
            array('ro'),
            array('ru'),
            array('sk'),
            array('sl'),
            array('sq'),
            array('sr'),
            array('sv'),
            array('th'),
            array('tr'),
            array('uk'),
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

    public function testSetLocaleWithMalformedLocale()
    {
        $this->assertTrue(Carbon::setLocale('pt_br'));
        $this->assertTrue(Carbon::setLocale('PT_br'));
        $this->assertTrue(Carbon::setLocale('PT_BR'));

        $this->assertTrue(Carbon::setLocale('pt-BR'));
        $this->assertTrue(Carbon::setLocale('pt-br'));
        $this->assertTrue(Carbon::setLocale('PT-br'));
        $this->assertTrue(Carbon::setLocale('PT-BR'));
    }

    public function testSetLocaleWithNonExistingLocale()
    {
        $this->assertFalse(Carbon::setLocale('pt-XX'));
    }

    public function testSetLocaleWithUnknownLocale()
    {
        $this->assertFalse(Carbon::setLocale('zz'));
    }
}
