<?php

namespace Tests\Jessengers;

use Carbon\Translator;
use Symfony\Component\Translation\Loader\ArrayLoader;

class TranslationHuTest extends TestCaseBase
{
    const LOCALE = 'hu';

    public function testGetsAndSetsTranslator()
    {
        $translator = new Translator('hu');
        $translator->addLoader('array', new ArrayLoader());
        $this->assertNotEquals($translator, JessengersDate::getTranslator());

        JessengersDate::setTranslator($translator);
        $this->assertEquals($translator, JessengersDate::getTranslator());
    }

    public function testTimespanTranslated()
    {
        $date = new JessengersDate(1403619368);
        $date = $date->sub('-100 days -3 hours -20 minutes');

        $this->assertSame('3 hónap, 1 hét, 1 nap, 3 óra, 20 perc', $date->timespan(1403619368));
    }

    public function testAgoTranslated()
    {
        $date = JessengersDate::parse('-1 minute');
        $this->assertSame('1 perce', $date->ago());

        $date = JessengersDate::parse('-21 hours');
        $this->assertSame('21 órája', $date->ago());

        $date = JessengersDate::parse('-5 days');
        $this->assertSame('5 napja', $date->ago());

        $date = JessengersDate::parse('-3 weeks');
        $this->assertSame('3 hete', $date->ago());

        $date = JessengersDate::parse('-6 months');
        $this->assertSame('6 hónapja', $date->ago());

        $date = JessengersDate::parse('-10 years');
        $this->assertSame('10 éve', $date->ago());
    }

    public function testFromNowTranslated()
    {
        $date = JessengersDate::parse('+1 minute');
        $this->assertSame('1 perc múlva', $date->ago());

        $date = JessengersDate::parse('+21 hours');
        $this->assertSame('21 óra múlva', $date->ago());

        $date = JessengersDate::parse('+5 days');
        $this->assertSame('5 nap múlva', $date->ago());

        $date = JessengersDate::parse('+3 weeks');
        $this->assertSame('3 hét múlva', $date->ago());

        $date = JessengersDate::parse('+6 months');
        $this->assertSame('6 hónap múlva', $date->ago());

        $date = JessengersDate::parse('+10 years');
        $this->assertSame('10 év múlva', $date->ago());
    }

    public function testAfterTranslated()
    {
        $date = JessengersDate::parse('+21 hours');
        $this->assertSame('21 órával később', $date->ago(JessengersDate::now()));

        $date = JessengersDate::parse('+5 days');
        $this->assertSame('5 nappal később', $date->ago(JessengersDate::now()));

        $date = JessengersDate::parse('+3 weeks');
        $this->assertSame('3 héttel később', $date->ago(JessengersDate::now()));

        $date = JessengersDate::parse('+6 months');
        $this->assertSame('6 hónappal később', $date->ago(JessengersDate::now()));

        $date = JessengersDate::parse('+10 years');
        $this->assertSame('10 évvel később', $date->ago(JessengersDate::now()));
    }

    public function testBeforeTranslated()
    {
        $date = JessengersDate::parse('-21 hours');
        $this->assertSame('21 órával korábban', $date->ago(JessengersDate::now()));

        $date = JessengersDate::parse('-5 days');
        $this->assertSame('5 nappal korábban', $date->ago(JessengersDate::now()));

        $date = JessengersDate::parse('-3 weeks');
        $this->assertSame('3 héttel korábban', $date->ago(JessengersDate::now()));

        $date = JessengersDate::parse('-6 months');
        $this->assertSame('6 hónappal korábban', $date->ago(JessengersDate::now()));

        $date = JessengersDate::parse('-10 years');
        $this->assertSame('10 évvel korábban', $date->ago(JessengersDate::now()));
    }

    public function testCreateFromFormat()
    {
        $date = JessengersDate::createFromFormat('Y. F d.', '2015. január 1.');
        $this->assertSame('2015-01-01', $date->format('Y-m-d'));

        $date = JessengersDate::createFromFormat('Y. F d., D', '2015. március 21., szombat');
        $this->assertSame('2015-03-21', $date->format('Y-m-d'));
    }
}
