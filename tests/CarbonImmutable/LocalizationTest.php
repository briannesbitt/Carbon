<?php

/*
 * This file is part of the Carbon package.
 *
 * (c) Brian Nesbitt <brian@nesbot.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tests\CarbonImmutable;

use Carbon\CarbonImmutable as Carbon;
use Carbon\Translator;
use Symfony\Component\Translation\IdentityTranslator;
use Symfony\Component\Translation\Loader\ArrayLoader;
use Symfony\Component\Translation\MessageCatalogue;
use Symfony\Component\Translation\MessageSelector;
use Tests\AbstractTestCase;
use Tests\CarbonImmutable\Fixtures\MyCarbon;

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

    public function testResetTranslator()
    {
        $t = MyCarbon::getTranslator();
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

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Translator does not implement Symfony\Component\Translation\TranslatorInterface and Symfony\Component\Translation\TranslatorBagInterface.
     */
    public function testTranslationCustomWithCustomTranslator()
    {
        $date = Carbon::create(2018, 1, 1, 0, 0, 0);
        $date->setLocalTranslator(new IdentityTranslator(new MessageSelector()));

        $date->getTranslationMessage('foo');
    }
}
