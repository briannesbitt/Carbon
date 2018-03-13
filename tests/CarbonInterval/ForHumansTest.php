<?php

/*
 * This file is part of the Carbon package.
 *
 * (c) Brian Nesbitt <brian@nesbot.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tests\CarbonInterval;

use Carbon\CarbonInterval;
use Symfony\Component\Translation\Loader\ArrayLoader;
use Symfony\Component\Translation\Translator;
use Tests\AbstractTestCase;

class ForHumansTest extends AbstractTestCase
{
    protected function tearDown()
    {
        parent::tearDown();
        CarbonInterval::setLocale('en');
    }

    public function testGetTranslator()
    {
        $t = CarbonInterval::getTranslator();
        $this->assertNotNull($t);
        $this->assertSame('en', $t->getLocale());
    }

    public function testSetTranslator()
    {
        $ori = CarbonInterval::getTranslator();
        $t = new Translator('fr');
        $t->addLoader('array', new ArrayLoader());
        CarbonInterval::setTranslator($t);

        $t = CarbonInterval::getTranslator();
        $this->assertNotNull($t);
        $this->assertSame('fr', $t->getLocale());
        CarbonInterval::setTranslator($ori);
    }

    public function testGetLocale()
    {
        CarbonInterval::setLocale('en');
        $this->assertSame('en', CarbonInterval::getLocale());
    }

    public function testSetLocale()
    {
        CarbonInterval::setLocale('en');
        $this->assertSame('en', CarbonInterval::getLocale());
        CarbonInterval::setLocale('fr');
        $this->assertSame('fr', CarbonInterval::getLocale());
    }

    public function testYear()
    {
        CarbonInterval::setLocale('en');
        $this->assertSame('1 year', CarbonInterval::year()->forHumans());
    }

    public function testYearToString()
    {
        CarbonInterval::setLocale('en');
        $this->assertSame('1 year:abc', CarbonInterval::year().':abc');
    }

    public function testYears()
    {
        CarbonInterval::setLocale('en');
        $this->assertSame('2 years', CarbonInterval::years(2)->forHumans());
    }

    public function testYearsAndMonth()
    {
        CarbonInterval::setLocale('en');
        $this->assertSame('2 years 1 month', CarbonInterval::create(2, 1)->forHumans());
    }

    public function testAll()
    {
        CarbonInterval::setLocale('en');
        $ci = CarbonInterval::create(11, 1, 2, 5, 22, 33, 55)->forHumans();
        $this->assertSame('11 years 1 month 2 weeks 5 days 22 hours 33 minutes 55 seconds', $ci);
    }

    public function testYearsAndMonthInFrench()
    {
        CarbonInterval::setLocale('fr');
        $this->assertSame('2 ans 1 mois', CarbonInterval::create(2, 1)->forHumans());
    }

    public function testYearsAndMonthInGerman()
    {
        CarbonInterval::setLocale('de');
        $this->assertSame('1 Jahr 1 Monat', CarbonInterval::create(1, 1)->forHumans());
        $this->assertSame('2 Jahre 1 Monat', CarbonInterval::create(2, 1)->forHumans());
    }

    public function testYearsAndMonthInBulgarian()
    {
        CarbonInterval::setLocale('bg');
        $this->assertSame('1 година 1 месец', CarbonInterval::create(1, 1)->forHumans());
        $this->assertSame('2 години 1 месец', CarbonInterval::create(2, 1)->forHumans());
    }

    public function testYearsAndMonthInCatalan()
    {
        CarbonInterval::setLocale('ca');
        $this->assertSame('1 any 1 mes', CarbonInterval::create(1, 1)->forHumans());
        $this->assertSame('2 anys 1 mes', CarbonInterval::create(2, 1)->forHumans());
    }

    public function testYearsAndMonthInCzech()
    {
        CarbonInterval::setLocale('cs');
        $this->assertSame('1 rok 1 měsíc', CarbonInterval::create(1, 1)->forHumans());
        $this->assertSame('2 roky 1 měsíc', CarbonInterval::create(2, 1)->forHumans());
    }

    public function testYearsAndMonthInGreek()
    {
        CarbonInterval::setLocale('el');
        $this->assertSame('1 χρόνος 1 μήνας', CarbonInterval::create(1, 1)->forHumans());
        $this->assertSame('2 χρόνια 1 μήνας', CarbonInterval::create(2, 1)->forHumans());
    }

    public function testYearsAndMonthsInDanish()
    {
        CarbonInterval::setLocale('da');
        $this->assertSame('1 år 1 måned', CarbonInterval::create(1, 1)->forHumans());
        $this->assertSame('2 år 1 måned', CarbonInterval::create(2, 1)->forHumans());
    }
}
