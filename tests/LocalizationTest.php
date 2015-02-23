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
    }
}
