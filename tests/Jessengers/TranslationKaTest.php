<?php

namespace Tests\Jessengers;

class TranslationKaTest extends TestCaseBase
{
    const LOCALE = 'ka';

    public function testTimespanTranslated()
    {
        $date = new JessengersDate(1403619368);
        $date = $date->sub('-100 days -3 hours -20 minutes');

        $this->assertSame('3 თვე, 1 კვირის, დღე, 3 საათი, 20 წუთი', $date->timespan(1403619368));
    }

    public function testCreateFromFormat()
    {
        $date = JessengersDate::createFromFormat('d F Y', '1 იანვარი 2015');
        $this->assertSame('2015-01-01', $date->format('Y-m-d'));

        $date = JessengersDate::createFromFormat('D d F Y', 'შაბათი 21 მარტი 2015');
        $this->assertSame('2015-03-21', $date->format('Y-m-d'));
    }

    public function testAgoTranslated()
    {
        $date = JessengersDate::parse('-21 hours');
        $this->assertSame('21 საათშიში', $date->ago());

        $date = JessengersDate::parse('-5 days');
        $this->assertSame('5 დღეში', $date->ago());

        $date = JessengersDate::parse('-3 weeks');
        $this->assertSame('3 კვირისში', $date->ago());

        $date = JessengersDate::parse('-6 months');
        $this->assertSame('6 თვეში', $date->ago());

        $date = JessengersDate::parse('-10 years');
        $this->assertSame('10 წელშიში', $date->ago());
    }

    public function testFormatDeclensions()
    {
        $date = new JessengersDate('10 march 2015');
        $this->assertSame('მარტი 2015', $date->format('F Y'));

        $date = new JessengersDate('10 march 2015');
        $this->assertSame('10 მარტს 2015', $date->format('j F Y'));
    }

    public function testAfterTranslated()
    {
        $date = JessengersDate::parse('+21 hours');
        $this->assertSame('21 საათის წინ', $date->ago());

        $date = JessengersDate::parse('+5 days');
        $this->assertSame('5 დღის წინ', $date->ago());

        $date = JessengersDate::parse('+3 weeks');
        $this->assertSame('3 კვირაა', $date->ago());

        $date = JessengersDate::parse('+6 months');
        $this->assertSame('6 თვის წინ', $date->ago());

        $date = JessengersDate::parse('+10 years');
        $this->assertSame('10 წლის წინ', $date->ago());
    }
}
