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
            array('hy'),
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
	
    public function testDiffForHumansLocalizedInUrdu()
    {
        Carbon::setLocale('ur');

        $scope = $this;
        $this->wrapWithTestNow(function () use ($scope) {
            $d = Carbon::now()->subSecond();
            $scope->assertSame('1 سیکنڈ پہلے', $d->diffForHumans());

            $d = Carbon::now()->subSeconds(2);
            $scope->assertSame('2 سیکنڈ پہلے', $d->diffForHumans());

            $d = Carbon::now()->subMinute();
            $scope->assertSame('1 منٹ پہلے', $d->diffForHumans());

            $d = Carbon::now()->subMinutes(2);
            $scope->assertSame('2 منٹ پہلے', $d->diffForHumans());

            $d = Carbon::now()->subHour();
            $scope->assertSame('1 گھنٹے پہلے', $d->diffForHumans());

            $d = Carbon::now()->subHours(2);
            $scope->assertSame('2 گھنٹے پہلے', $d->diffForHumans());

            $d = Carbon::now()->subDay();
            $scope->assertSame('1 روز پہلے', $d->diffForHumans());

            $d = Carbon::now()->subDays(2);
            $scope->assertSame('2 روز پہلے', $d->diffForHumans());

            $d = Carbon::now()->subWeek();
            $scope->assertSame('1 ہفتے پہلے', $d->diffForHumans());

            $d = Carbon::now()->subWeeks(2);
            $scope->assertSame('2 ہفتے پہلے', $d->diffForHumans());

            $d = Carbon::now()->subMonth();
            $scope->assertSame('1 ماه پہلے', $d->diffForHumans());

            $d = Carbon::now()->subMonths(2);
            $scope->assertSame('2 ماه پہلے', $d->diffForHumans());

            $d = Carbon::now()->subYear();
            $scope->assertSame('1 سال پہلے', $d->diffForHumans());

            $d = Carbon::now()->subYears(2);
            $scope->assertSame('2 سال پہلے', $d->diffForHumans());

            $d = Carbon::now()->addSecond();
            $scope->assertSame('1 سیکنڈ بعد', $d->diffForHumans());

            $d = Carbon::now()->addSecond();
            $d2 = Carbon::now();
            $scope->assertSame('1 سیکنڈ بعد', $d->diffForHumans($d2));
            $scope->assertSame('1 سیکنڈ پہلے', $d2->diffForHumans($d));

            $d = Carbon::now()->addSecond();
            $d2 = Carbon::now();
            $scope->assertSame('1 سیکنڈ', $d->diffForHumans($d2, true));
            $scope->assertSame('2 سیکنڈ', $d2->diffForHumans($d->addSecond(), true));
        });
    }
}
