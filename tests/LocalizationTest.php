<?php

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

class LocalizationTest extends TestFixture
{
    public function testGetTranslator()
    {
        $t = Carbon::getTranslator();
        $this->assertNotNull($t);
        $this->assertSame('en', $t->getLocale());
    }

    public function testSetTranslator()
    {
        $t = new Translator('fr');
        $t->addLoader('array', new ArrayLoader());
        Carbon::setTranslator($t);

        $t = Carbon::getTranslator();
        $this->assertNotNull($t);
        $this->assertSame('fr', $t->getLocale());
    }

    public function testGetLocale()
    {
        Carbon::setLocale('en');
        $this->assertSame('en', Carbon::getLocale());
    }

    public function testSetLocale()
    {
        Carbon::setLocale('en');
        $this->assertSame('en', Carbon::getLocale());
        Carbon::setLocale('fr');
        $this->assertSame('fr', Carbon::getLocale());
    }

    /**
     * The purpose of these tests aren't to test the validitity of the translation
     * but more so to test that the language file exists.
     */

    public function testDiffForHumansLocalizedInFrench()
    {
        Carbon::setLocale('fr');

        $d = Carbon::now()->subSecond();
        $this->assertSame('il y a 1 seconde', $d->diffForHumans());

        $d = Carbon::now()->subSeconds(2);
        $this->assertSame('il y a 2 secondes', $d->diffForHumans());

        $d = Carbon::now()->subMinute();
        $this->assertSame('il y a 1 minute', $d->diffForHumans());

        $d = Carbon::now()->subMinutes(2);
        $this->assertSame('il y a 2 minutes', $d->diffForHumans());

        $d = Carbon::now()->subHour();
        $this->assertSame('il y a 1 heure', $d->diffForHumans());

        $d = Carbon::now()->subHours(2);
        $this->assertSame('il y a 2 heures', $d->diffForHumans());

        $d = Carbon::now()->subDay();
        $this->assertSame('il y a 1 jour', $d->diffForHumans());

        $d = Carbon::now()->subDays(2);
        $this->assertSame('il y a 2 jours', $d->diffForHumans());

        $d = Carbon::now()->subWeek();
        $this->assertSame('il y a 1 semaine', $d->diffForHumans());

        $d = Carbon::now()->subWeeks(2);
        $this->assertSame('il y a 2 semaines', $d->diffForHumans());

        $d = Carbon::now()->subMonth();
        $this->assertSame('il y a 1 mois', $d->diffForHumans());

        $d = Carbon::now()->subMonths(2);
        $this->assertSame('il y a 2 mois', $d->diffForHumans());

        $d = Carbon::now()->subYear();
        $this->assertSame('il y a 1 an', $d->diffForHumans());

        $d = Carbon::now()->subYears(2);
        $this->assertSame('il y a 2 ans', $d->diffForHumans());

        $d = Carbon::now()->addSecond();
        $this->assertSame('dans 1 seconde', $d->diffForHumans());

        $d = Carbon::now()->addSecond();
        $d2 = Carbon::now();
        $this->assertSame('1 seconde après', $d->diffForHumans($d2));
        $this->assertSame('1 seconde avant', $d2->diffForHumans($d));

        $this->assertSame('1 seconde', $d->diffForHumans($d2, true));
        $this->assertSame('2 secondes', $d2->diffForHumans($d->addSecond(), true));
    }

    public function testDiffForHumansLocalizedInSpanish()
    {
        Carbon::setLocale('es');

        $d = Carbon::now()->subSecond();
        $this->assertSame('hace 1 segundo', $d->diffForHumans());

        $d = Carbon::now()->subSeconds(3);
        $this->assertSame('hace 3 segundos', $d->diffForHumans());

        $d = Carbon::now()->subMinute();
        $this->assertSame('hace 1 minuto', $d->diffForHumans());

        $d = Carbon::now()->subMinutes(2);
        $this->assertSame('hace 2 minutos', $d->diffForHumans());

        $d = Carbon::now()->subHour();
        $this->assertSame('hace 1 hora', $d->diffForHumans());

        $d = Carbon::now()->subHours(2);
        $this->assertSame('hace 2 horas', $d->diffForHumans());

        $d = Carbon::now()->subDay();
        $this->assertSame('hace 1 día', $d->diffForHumans());

        $d = Carbon::now()->subDays(2);
        $this->assertSame('hace 2 días', $d->diffForHumans());

        $d = Carbon::now()->subWeek();
        $this->assertSame('hace 1 semana', $d->diffForHumans());

        $d = Carbon::now()->subWeeks(2);
        $this->assertSame('hace 2 semanas', $d->diffForHumans());

        $d = Carbon::now()->subMonth();
        $this->assertSame('hace 1 mes', $d->diffForHumans());

        $d = Carbon::now()->subMonths(2);
        $this->assertSame('hace 2 meses', $d->diffForHumans());

        $d = Carbon::now()->subYear();
        $this->assertSame('hace 1 año', $d->diffForHumans());

        $d = Carbon::now()->subYears(2);
        $this->assertSame('hace 2 años', $d->diffForHumans());

        $d = Carbon::now()->addSecond();
        $this->assertSame('dentro de 1 segundo', $d->diffForHumans());

        $d = Carbon::now()->addSecond();
        $d2 = Carbon::now();
        $this->assertSame('1 segundo antes', $d->diffForHumans($d2));
        $this->assertSame('1 segundo después', $d2->diffForHumans($d));

        $this->assertSame('1 segundo', $d->diffForHumans($d2, true));
        $this->assertSame('2 segundos', $d2->diffForHumans($d->addSecond(), true));
    }

    public function testDiffForHumansLocalizedInItalian()
    {
        Carbon::setLocale('it');

        $d = Carbon::now()->addYear();
        $this->assertSame('1 anno da adesso', $d->diffForHumans());

        $d = Carbon::now()->addYears(2);
        $this->assertSame('2 anni da adesso', $d->diffForHumans());
    }

    public function testDiffForHumansLocalizedInGerman()
    {
        Carbon::setLocale('de');

        $d = Carbon::now()->addYear();
        $this->assertSame('in 1 Jahr', $d->diffForHumans());

        $d = Carbon::now()->addYears(2);
        $this->assertSame('in 2 Jahren', $d->diffForHumans());

        $d = Carbon::now()->subYear();
        $this->assertSame('1 Jahr später', Carbon::now()->diffForHumans($d));

        $d = Carbon::now()->subYears(2);
        $this->assertSame('2 Jahre später', Carbon::now()->diffForHumans($d));

        $d = Carbon::now()->addYear();
        $this->assertSame('1 Jahr zuvor', Carbon::now()->diffForHumans($d));

        $d = Carbon::now()->addYears(2);
        $this->assertSame('2 Jahre zuvor', Carbon::now()->diffForHumans($d));

        $d = Carbon::now()->subYear();
        $this->assertSame('vor 1 Jahr', $d->diffForHumans());

        $d = Carbon::now()->subYears(2);
        $this->assertSame('vor 2 Jahren', $d->diffForHumans());
    }

    public function testDiffForHumansLocalizedInTurkish()
    {
        Carbon::setLocale('tr');

        $d = Carbon::now()->subSecond();
        $this->assertSame('1 saniye önce', $d->diffForHumans());

        $d = Carbon::now()->subSeconds(2);
        $this->assertSame('2 saniye önce', $d->diffForHumans());

        $d = Carbon::now()->subMinute();
        $this->assertSame('1 dakika önce', $d->diffForHumans());

        $d = Carbon::now()->subMinutes(2);
        $this->assertSame('2 dakika önce', $d->diffForHumans());

        $d = Carbon::now()->subHour();
        $this->assertSame('1 saat önce', $d->diffForHumans());

        $d = Carbon::now()->subHours(2);
        $this->assertSame('2 saat önce', $d->diffForHumans());

        $d = Carbon::now()->subDay();
        $this->assertSame('1 gün önce', $d->diffForHumans());

        $d = Carbon::now()->subDays(2);
        $this->assertSame('2 gün önce', $d->diffForHumans());

        $d = Carbon::now()->subWeek();
        $this->assertSame('1 hafta önce', $d->diffForHumans());

        $d = Carbon::now()->subWeeks(2);
        $this->assertSame('2 hafta önce', $d->diffForHumans());

        $d = Carbon::now()->subMonth();
        $this->assertSame('1 ay önce', $d->diffForHumans());

        $d = Carbon::now()->subMonths(2);
        $this->assertSame('2 ay önce', $d->diffForHumans());

        $d = Carbon::now()->subYear();
        $this->assertSame('1 yıl önce', $d->diffForHumans());

        $d = Carbon::now()->subYears(2);
        $this->assertSame('2 yıl önce', $d->diffForHumans());

        $d = Carbon::now()->addSecond();
        $this->assertSame('1 saniye andan itibaren', $d->diffForHumans());

        $d = Carbon::now()->addSecond();
        $d2 = Carbon::now();
        $this->assertSame('1 saniye sonra', $d->diffForHumans($d2));
        $this->assertSame('1 saniye önce', $d2->diffForHumans($d));

        $this->assertSame('1 saniye', $d->diffForHumans($d2, true));
        $this->assertSame('2 saniye', $d2->diffForHumans($d->addSecond(), true));
    }

    public function testDiffForHumansLocalizedInDanish()
    {
        Carbon::setLocale('da');

        $d = Carbon::now()->subSecond();
        $this->assertSame('1 sekund siden', $d->diffForHumans());

        $d = Carbon::now()->subSeconds(2);
        $this->assertSame('2 sekunder siden', $d->diffForHumans());

        $d = Carbon::now()->subMinute();
        $this->assertSame('1 minut siden', $d->diffForHumans());

        $d = Carbon::now()->subMinutes(2);
        $this->assertSame('2 minutter siden', $d->diffForHumans());

        $d = Carbon::now()->subHour();
        $this->assertSame('1 time siden', $d->diffForHumans());

        $d = Carbon::now()->subHours(2);
        $this->assertSame('2 timer siden', $d->diffForHumans());

        $d = Carbon::now()->subDay();
        $this->assertSame('1 dag siden', $d->diffForHumans());

        $d = Carbon::now()->subDays(2);
        $this->assertSame('2 dage siden', $d->diffForHumans());

        $d = Carbon::now()->subWeek();
        $this->assertSame('1 uge siden', $d->diffForHumans());

        $d = Carbon::now()->subWeeks(2);
        $this->assertSame('2 uger siden', $d->diffForHumans());

        $d = Carbon::now()->subMonth();
        $this->assertSame('1 måned siden', $d->diffForHumans());

        $d = Carbon::now()->subMonths(2);
        $this->assertSame('2 måneder siden', $d->diffForHumans());

        $d = Carbon::now()->subYear();
        $this->assertSame('1 år siden', $d->diffForHumans());

        $d = Carbon::now()->subYears(2);
        $this->assertSame('2 år siden', $d->diffForHumans());

        $d = Carbon::now()->addSecond();
        $this->assertSame('om 1 sekund', $d->diffForHumans());

        $d = Carbon::now()->addSecond();
        $d2 = Carbon::now();
        $this->assertSame('1 sekund efter', $d->diffForHumans($d2));
        $this->assertSame('1 sekund før', $d2->diffForHumans($d));

        $this->assertSame('1 sekund', $d->diffForHumans($d2, true));
        $this->assertSame('2 sekunder', $d2->diffForHumans($d->addSecond(), true));
    }

    public function testDiffForHumansLocalizedInLithuanian()
    {
        Carbon::setLocale('lt');

        $d = Carbon::now()->addYear();
        $this->assertSame('1 metai nuo dabar', $d->diffForHumans());

        $d = Carbon::now()->addYears(2);
        $this->assertSame('2 metai nuo dabar', $d->diffForHumans());
    }

    public function testDiffForHumansLocalizedInKorean()
    {
        Carbon::setLocale('ko');

        $d = Carbon::now()->addYear();
        $this->assertSame('1 년 후', $d->diffForHumans());

        $d = Carbon::now()->addYears(2);
        $this->assertSame('2 년 후', $d->diffForHumans());
    }
}
