<?php

/*
 * This file is part of the Carbon package.
 *
 * (c) Brian Nesbitt <brian@nesbot.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Immutable;

use Carbon\CarbonImmutable;
use Symfony\Component\Translation\Translator;
use Symfony\Component\Translation\Loader\ArrayLoader;
use TestFixture;

class LocalizationTest extends TestFixture
{

    public function testGetTranslator()
    {
        $t = CarbonImmutable::getTranslator();
        $this->assertNotNull($t);
        $this->assertSame('en', $t->getLocale());
    }

    public function testSetTranslator()
    {
        $t = new Translator('fr');
        $t->addLoader('array', new ArrayLoader());
        CarbonImmutable::setTranslator($t);

        $t = CarbonImmutable::getTranslator();
        $this->assertNotNull($t);
        $this->assertSame('fr', $t->getLocale());
    }

    public function testGetLocale()
    {
        CarbonImmutable::setLocale('en');
        $this->assertSame('en', CarbonImmutable::getLocale());
    }

    public function testSetLocale()
    {
        CarbonImmutable::setLocale('en');
        $this->assertSame('en', CarbonImmutable::getLocale());
        CarbonImmutable::setLocale('fr');
        $this->assertSame('fr', CarbonImmutable::getLocale());
    }

    /**
     * The purpose of these tests aren't to test the validitity of the translation
     * but more so to test that the language file exists.
     */

    public function testDiffForHumansLocalizedInFrench()
    {
        CarbonImmutable::setLocale('fr');

        $scope = $this;
        $this->wrapWithTestNow(function () use ($scope) {

            $d = CarbonImmutable::now()->subSecond();
            $scope->assertSame('il y a 1 seconde', $d->diffForHumans());

            $d = CarbonImmutable::now()->subSeconds(2);
            $scope->assertSame('il y a 2 secondes', $d->diffForHumans());

            $d = CarbonImmutable::now()->subMinute();
            $scope->assertSame('il y a 1 minute', $d->diffForHumans());

            $d = CarbonImmutable::now()->subMinutes(2);
            $scope->assertSame('il y a 2 minutes', $d->diffForHumans());

            $d = CarbonImmutable::now()->subHour();
            $scope->assertSame('il y a 1 heure', $d->diffForHumans());

            $d = CarbonImmutable::now()->subHours(2);
            $scope->assertSame('il y a 2 heures', $d->diffForHumans());

            $d = CarbonImmutable::now()->subDay();
            $scope->assertSame('il y a 1 jour', $d->diffForHumans());

            $d = CarbonImmutable::now()->subDays(2);
            $scope->assertSame('il y a 2 jours', $d->diffForHumans());

            $d = CarbonImmutable::now()->subWeek();
            $scope->assertSame('il y a 1 semaine', $d->diffForHumans());

            $d = CarbonImmutable::now()->subWeeks(2);
            $scope->assertSame('il y a 2 semaines', $d->diffForHumans());

            $d = CarbonImmutable::now()->subMonth();
            $scope->assertSame('il y a 1 mois', $d->diffForHumans());

            $d = CarbonImmutable::now()->subMonths(2);
            $scope->assertSame('il y a 2 mois', $d->diffForHumans());

            $d = CarbonImmutable::now()->subYear();
            $scope->assertSame('il y a 1 an', $d->diffForHumans());

            $d = CarbonImmutable::now()->subYears(2);
            $scope->assertSame('il y a 2 ans', $d->diffForHumans());

            $d = CarbonImmutable::now()->addSecond();
            $scope->assertSame('dans 1 seconde', $d->diffForHumans());

            $d  = CarbonImmutable::now()->addSecond();
            $d2 = CarbonImmutable::now();
            $scope->assertSame('1 seconde après', $d->diffForHumans($d2));
            $scope->assertSame('1 seconde avant', $d2->diffForHumans($d));

            $scope->assertSame('1 seconde', $d->diffForHumans($d2, true));
            $scope->assertSame('2 secondes', $d2->diffForHumans($d->addSecond(), true));
        });
    }

    public function testDiffForHumansLocalizedInSpanish()
    {
        CarbonImmutable::setLocale('es');

        $scope = $this;
        $this->wrapWithTestNow(function () use ($scope) {
            $d = CarbonImmutable::now()->subSecond();
            $scope->assertSame('hace 1 segundo', $d->diffForHumans());

            $d = CarbonImmutable::now()->subSeconds(3);
            $scope->assertSame('hace 3 segundos', $d->diffForHumans());

            $d = CarbonImmutable::now()->subMinute();
            $scope->assertSame('hace 1 minuto', $d->diffForHumans());

            $d = CarbonImmutable::now()->subMinutes(2);
            $scope->assertSame('hace 2 minutos', $d->diffForHumans());

            $d = CarbonImmutable::now()->subHour();
            $scope->assertSame('hace 1 hora', $d->diffForHumans());

            $d = CarbonImmutable::now()->subHours(2);
            $scope->assertSame('hace 2 horas', $d->diffForHumans());

            $d = CarbonImmutable::now()->subDay();
            $scope->assertSame('hace 1 día', $d->diffForHumans());

            $d = CarbonImmutable::now()->subDays(2);
            $scope->assertSame('hace 2 días', $d->diffForHumans());

            $d = CarbonImmutable::now()->subWeek();
            $scope->assertSame('hace 1 semana', $d->diffForHumans());

            $d = CarbonImmutable::now()->subWeeks(2);
            $scope->assertSame('hace 2 semanas', $d->diffForHumans());

            $d = CarbonImmutable::now()->subMonth();
            $scope->assertSame('hace 1 mes', $d->diffForHumans());

            $d = CarbonImmutable::now()->subMonths(2);
            $scope->assertSame('hace 2 meses', $d->diffForHumans());

            $d = CarbonImmutable::now()->subYear();
            $scope->assertSame('hace 1 año', $d->diffForHumans());

            $d = CarbonImmutable::now()->subYears(2);
            $scope->assertSame('hace 2 años', $d->diffForHumans());

            $d = CarbonImmutable::now()->addSecond();
            $scope->assertSame('dentro de 1 segundo', $d->diffForHumans());

            $d  = CarbonImmutable::now()->addSecond();
            $d2 = CarbonImmutable::now();
            $scope->assertSame('1 segundo antes', $d->diffForHumans($d2));
            $scope->assertSame('1 segundo después', $d2->diffForHumans($d));

            $scope->assertSame('1 segundo', $d->diffForHumans($d2, true));
            $scope->assertSame('2 segundos', $d2->diffForHumans($d->addSecond(), true));
        });
    }

    public function testDiffForHumansLocalizedInItalian()
    {
        CarbonImmutable::setLocale('it');

        $scope = $this;
        $this->wrapWithTestNow(function () use ($scope) {
            $d = CarbonImmutable::now()->addYear();
            $scope->assertSame('1 anno da adesso', $d->diffForHumans());

            $d = CarbonImmutable::now()->addYears(2);
            $scope->assertSame('2 anni da adesso', $d->diffForHumans());
        });
    }

    public function testDiffForHumansLocalizedInGerman()
    {
        CarbonImmutable::setLocale('de');

        $scope = $this;
        $this->wrapWithTestNow(function () use ($scope) {
            $d = CarbonImmutable::now()->addYear();
            $scope->assertSame('in 1 Jahr', $d->diffForHumans());

            $d = CarbonImmutable::now()->addYears(2);
            $scope->assertSame('in 2 Jahren', $d->diffForHumans());

            $d = CarbonImmutable::now()->subYear();
            $scope->assertSame('1 Jahr später', CarbonImmutable::now()->diffForHumans($d));

            $d = CarbonImmutable::now()->subYears(2);
            $scope->assertSame('2 Jahre später', CarbonImmutable::now()->diffForHumans($d));

            $d = CarbonImmutable::now()->addYear();
            $scope->assertSame('1 Jahr zuvor', CarbonImmutable::now()->diffForHumans($d));

            $d = CarbonImmutable::now()->addYears(2);
            $scope->assertSame('2 Jahre zuvor', CarbonImmutable::now()->diffForHumans($d));

            $d = CarbonImmutable::now()->subYear();
            $scope->assertSame('vor 1 Jahr', $d->diffForHumans());

            $d = CarbonImmutable::now()->subYears(2);
            $scope->assertSame('vor 2 Jahren', $d->diffForHumans());
        });
    }

    public function testDiffForHumansLocalizedInTurkish()
    {
        CarbonImmutable::setLocale('tr');

        $scope = $this;
        $this->wrapWithTestNow(function () use ($scope) {
            $d = CarbonImmutable::now()->subSecond();
            $scope->assertSame('1 saniye önce', $d->diffForHumans());

            $d = CarbonImmutable::now()->subSeconds(2);
            $scope->assertSame('2 saniye önce', $d->diffForHumans());

            $d = CarbonImmutable::now()->subMinute();
            $scope->assertSame('1 dakika önce', $d->diffForHumans());

            $d = CarbonImmutable::now()->subMinutes(2);
            $scope->assertSame('2 dakika önce', $d->diffForHumans());

            $d = CarbonImmutable::now()->subHour();
            $scope->assertSame('1 saat önce', $d->diffForHumans());

            $d = CarbonImmutable::now()->subHours(2);
            $scope->assertSame('2 saat önce', $d->diffForHumans());

            $d = CarbonImmutable::now()->subDay();
            $scope->assertSame('1 gün önce', $d->diffForHumans());

            $d = CarbonImmutable::now()->subDays(2);
            $scope->assertSame('2 gün önce', $d->diffForHumans());

            $d = CarbonImmutable::now()->subWeek();
            $scope->assertSame('1 hafta önce', $d->diffForHumans());

            $d = CarbonImmutable::now()->subWeeks(2);
            $scope->assertSame('2 hafta önce', $d->diffForHumans());

            $d = CarbonImmutable::now()->subMonth();
            $scope->assertSame('1 ay önce', $d->diffForHumans());

            $d = CarbonImmutable::now()->subMonths(2);
            $scope->assertSame('2 ay önce', $d->diffForHumans());

            $d = CarbonImmutable::now()->subYear();
            $scope->assertSame('1 yıl önce', $d->diffForHumans());

            $d = CarbonImmutable::now()->subYears(2);
            $scope->assertSame('2 yıl önce', $d->diffForHumans());

            $d = CarbonImmutable::now()->addSecond();
            $scope->assertSame('1 saniye andan itibaren', $d->diffForHumans());

            $d  = CarbonImmutable::now()->addSecond();
            $d2 = CarbonImmutable::now();
            $scope->assertSame('1 saniye sonra', $d->diffForHumans($d2));
            $scope->assertSame('1 saniye önce', $d2->diffForHumans($d));

            $scope->assertSame('1 saniye', $d->diffForHumans($d2, true));
            $scope->assertSame('2 saniye', $d2->diffForHumans($d->addSecond(), true));
        });
    }

    public function testDiffForHumansLocalizedInDanish()
    {
        CarbonImmutable::setLocale('da');

        $scope = $this;
        $this->wrapWithTestNow(function () use ($scope) {
            $d = CarbonImmutable::now()->subSecond();
            $scope->assertSame('1 sekund siden', $d->diffForHumans());

            $d = CarbonImmutable::now()->subSeconds(2);
            $scope->assertSame('2 sekunder siden', $d->diffForHumans());

            $d = CarbonImmutable::now()->subMinute();
            $scope->assertSame('1 minut siden', $d->diffForHumans());

            $d = CarbonImmutable::now()->subMinutes(2);
            $scope->assertSame('2 minutter siden', $d->diffForHumans());

            $d = CarbonImmutable::now()->subHour();
            $scope->assertSame('1 time siden', $d->diffForHumans());

            $d = CarbonImmutable::now()->subHours(2);
            $scope->assertSame('2 timer siden', $d->diffForHumans());

            $d = CarbonImmutable::now()->subDay();
            $scope->assertSame('1 dag siden', $d->diffForHumans());

            $d = CarbonImmutable::now()->subDays(2);
            $scope->assertSame('2 dage siden', $d->diffForHumans());

            $d = CarbonImmutable::now()->subWeek();
            $scope->assertSame('1 uge siden', $d->diffForHumans());

            $d = CarbonImmutable::now()->subWeeks(2);
            $scope->assertSame('2 uger siden', $d->diffForHumans());

            $d = CarbonImmutable::now()->subMonth();
            $scope->assertSame('1 måned siden', $d->diffForHumans());

            $d = CarbonImmutable::now()->subMonths(2);
            $scope->assertSame('2 måneder siden', $d->diffForHumans());

            $d = CarbonImmutable::now()->subYear();
            $scope->assertSame('1 år siden', $d->diffForHumans());

            $d = CarbonImmutable::now()->subYears(2);
            $scope->assertSame('2 år siden', $d->diffForHumans());

            $d = CarbonImmutable::now()->addSecond();
            $scope->assertSame('om 1 sekund', $d->diffForHumans());

            $d  = CarbonImmutable::now()->addSecond();
            $d2 = CarbonImmutable::now();
            $scope->assertSame('1 sekund efter', $d->diffForHumans($d2));
            $scope->assertSame('1 sekund før', $d2->diffForHumans($d));

            $scope->assertSame('1 sekund', $d->diffForHumans($d2, true));
            $scope->assertSame('2 sekunder', $d2->diffForHumans($d->addSecond(), true));
        });
    }

    public function testDiffForHumansLocalizedInLithuanian()
    {
        CarbonImmutable::setLocale('lt');

        $scope = $this;
        $this->wrapWithTestNow(function () use ($scope) {
            $d = CarbonImmutable::now()->addYear();
            $scope->assertSame('už 1 metus', $d->diffForHumans());

            $d = CarbonImmutable::now()->addYears(2);
            $scope->assertSame('už 2 metus', $d->diffForHumans());
        });
    }

    public function testDiffForHumansLocalizedInKorean()
    {
        CarbonImmutable::setLocale('ko');

        $scope = $this;
        $this->wrapWithTestNow(function () use ($scope) {
            $d = CarbonImmutable::now()->addYear();
            $scope->assertSame('1 년 후', $d->diffForHumans());

            $d = CarbonImmutable::now()->addYears(2);
            $scope->assertSame('2 년 후', $d->diffForHumans());
        });
    }

    public function testDiffForHumansLocalizedInFarsi()
    {
        CarbonImmutable::setLocale('fa');

        $scope = $this;
        $this->wrapWithTestNow(function () use ($scope) {
            $d = CarbonImmutable::now()->subSecond();
            $scope->assertSame('1 ثانیه پیش', $d->diffForHumans());

            $d = CarbonImmutable::now()->subSeconds(2);
            $scope->assertSame('2 ثانیه پیش', $d->diffForHumans());

            $d = CarbonImmutable::now()->subMinute();
            $scope->assertSame('1 دقیقه پیش', $d->diffForHumans());

            $d = CarbonImmutable::now()->subMinutes(2);
            $scope->assertSame('2 دقیقه پیش', $d->diffForHumans());

            $d = CarbonImmutable::now()->subHour();
            $scope->assertSame('1 ساعت پیش', $d->diffForHumans());

            $d = CarbonImmutable::now()->subHours(2);
            $scope->assertSame('2 ساعت پیش', $d->diffForHumans());

            $d = CarbonImmutable::now()->subDay();
            $scope->assertSame('1 روز پیش', $d->diffForHumans());

            $d = CarbonImmutable::now()->subDays(2);
            $scope->assertSame('2 روز پیش', $d->diffForHumans());

            $d = CarbonImmutable::now()->subWeek();
            $scope->assertSame('1 هفته پیش', $d->diffForHumans());

            $d = CarbonImmutable::now()->subWeeks(2);
            $scope->assertSame('2 هفته پیش', $d->diffForHumans());

            $d = CarbonImmutable::now()->subMonth();
            $scope->assertSame('1 ماه پیش', $d->diffForHumans());

            $d = CarbonImmutable::now()->subMonths(2);
            $scope->assertSame('2 ماه پیش', $d->diffForHumans());

            $d = CarbonImmutable::now()->subYear();
            $scope->assertSame('1 سال پیش', $d->diffForHumans());

            $d = CarbonImmutable::now()->subYears(2);
            $scope->assertSame('2 سال پیش', $d->diffForHumans());

            $d = CarbonImmutable::now()->addSecond();
            $scope->assertSame('1 ثانیه بعد', $d->diffForHumans());

            $d  = CarbonImmutable::now()->addSecond();
            $d2 = CarbonImmutable::now();
            $scope->assertSame('1 ثانیه پیش از', $d->diffForHumans($d2));
            $scope->assertSame('1 ثانیه پس از', $d2->diffForHumans($d));

            $d  = CarbonImmutable::now()->addSecond();
            $d2 = CarbonImmutable::now();
            $scope->assertSame('1 ثانیه پیش از', $d->diffForHumans($d2));
            $scope->assertSame('1 ثانیه پس از', $d2->diffForHumans($d));

            $scope->assertSame('1 ثانیه', $d->diffForHumans($d2, true));
            $scope->assertSame('2 ثانیه', $d2->diffForHumans($d->addSecond(), true));
        });
    }

    public function testDiffForHumansLocalizedInFaroese()
    {
        CarbonImmutable::setLocale('fo');

        $scope = $this;
        $this->wrapWithTestNow(function () use ($scope) {
            $d = CarbonImmutable::now()->subSecond();
            $scope->assertSame('1 sekund síðan', $d->diffForHumans());

            $d = CarbonImmutable::now()->subSeconds(2);
            $scope->assertSame('2 sekundir síðan', $d->diffForHumans());

            $d = CarbonImmutable::now()->subMinute();
            $scope->assertSame('1 minutt síðan', $d->diffForHumans());

            $d = CarbonImmutable::now()->subMinutes(2);
            $scope->assertSame('2 minuttir síðan', $d->diffForHumans());

            $d = CarbonImmutable::now()->subHour();
            $scope->assertSame('1 tími síðan', $d->diffForHumans());

            $d = CarbonImmutable::now()->subHours(2);
            $scope->assertSame('2 tímar síðan', $d->diffForHumans());

            $d = CarbonImmutable::now()->subDay();
            $scope->assertSame('1 dag síðan', $d->diffForHumans());

            $d = CarbonImmutable::now()->subDays(2);
            $scope->assertSame('2 dagar síðan', $d->diffForHumans());

            $d = CarbonImmutable::now()->subWeek();
            $scope->assertSame('1 vika síðan', $d->diffForHumans());

            $d = CarbonImmutable::now()->subWeeks(2);
            $scope->assertSame('2 vikur síðan', $d->diffForHumans());

            $d = CarbonImmutable::now()->subMonth();
            $scope->assertSame('1 mánaður síðan', $d->diffForHumans());

            $d = CarbonImmutable::now()->subMonths(2);
            $scope->assertSame('2 mánaðir síðan', $d->diffForHumans());

            $d = CarbonImmutable::now()->subYear();
            $scope->assertSame('1 ár síðan', $d->diffForHumans());

            $d = CarbonImmutable::now()->subYears(2);
            $scope->assertSame('2 ár síðan', $d->diffForHumans());

            $d = CarbonImmutable::now()->addSecond();
            $scope->assertSame('um 1 sekund', $d->diffForHumans());

            $d  = CarbonImmutable::now()->addSecond();
            $d2 = CarbonImmutable::now();
            $scope->assertSame('1 sekund aftaná', $d->diffForHumans($d2));
            $scope->assertSame('1 sekund áðrenn', $d2->diffForHumans($d));

            $scope->assertSame('1 sekund', $d->diffForHumans($d2, true));
            $scope->assertSame('2 sekundir', $d2->diffForHumans($d->addSecond(), true));
        });
    }
}
