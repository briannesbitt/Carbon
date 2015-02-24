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
    public function testGetTranslator() {
        $t = Carbon::getTranslator();
        $this->assertNotNull($t);
        $this->assertSame('en', $t->getLocale());
    }
    
    public function testSetTranslator() {
        $t = new Translator('fr');
        $t->addLoader('array', new ArrayLoader());
        Carbon::setTranslator($t);

        $t = Carbon::getTranslator();
        $this->assertNotNull($t);
        $this->assertSame('fr', $t->getLocale());
    }

    public function testGetLocale() {
        Carbon::setLocale('en');
        $this->assertSame('en', Carbon::getLocale());
    }

    public function testSetLocale() {
        Carbon::setLocale('en');
        $this->assertSame('en', Carbon::getLocale());
        Carbon::setLocale('fr');
        $this->assertSame('fr', Carbon::getLocale());
    }

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
}
