<?php

declare(strict_types=1);

/**
 * This file is part of the Carbon package.
 *
 * (c) Brian Nesbitt <brian@nesbot.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tests\Jenssegers;

class TranslationKaTest extends TestCaseBase
{
    public const LOCALE = 'ka';

    public function testTimespanTranslated()
    {
        $date = new JenssegersDate('@1403619368');
        $date = $date->sub('-100 days -3 hours -20 minutes');

        $this->assertSame('3 თვე, 1 კვირა, 1 დღე, 3 საათი, 20 წუთი', $date->timespan('@1403619368'));
    }

    public function testCreateFromFormat()
    {
        $date = JenssegersDate::createFromFormat('d F Y', '1 იანვარი 2015');
        $this->assertSame('2015-01-01', $date->format('Y-m-d'));

        $date = JenssegersDate::createFromFormat('D d F Y', 'შაბათი 21 მარტი 2015');
        $this->assertSame('2015-03-21', $date->format('Y-m-d'));
    }

    public function testAgoTranslated()
    {
        $date = JenssegersDate::parse('-21 hours');
        $this->assertSame('21 საათის წინ', $date->ago());

        $date = JenssegersDate::parse('-5 days');
        $this->assertSame('5 დღის წინ', $date->ago());

        $date = JenssegersDate::parse('-3 weeks');
        $this->assertSame('3 კვირის წინ', $date->ago());

        $date = JenssegersDate::now()->subMonthsNoOverflow(6);
        $this->assertSame('6 თვის წინ', $date->ago());

        $date = JenssegersDate::parse('-10 years');
        $this->assertSame('10 წლის წინ', $date->ago());
    }

    public function testFormatDeclensions()
    {
        $date = new JenssegersDate('10 march 2015');
        $this->assertSame('მარტს 2015', $date->format('F Y'));

        $date = new JenssegersDate('10 march 2015');
        $this->assertSame('10 მარტი 2015', $date->format('j F Y'));
    }

    public function testAfterTranslated()
    {
        $date = JenssegersDate::parse('+21 hours');
        $this->assertSame('21 საათში', $date->ago());

        $date = JenssegersDate::parse('+5 days');
        $this->assertSame('5 დღეში', $date->ago());

        $date = JenssegersDate::parse('+3 weeks');
        $this->assertSame('3 კვირაში', $date->ago());

        $date = JenssegersDate::parse('+6 months');
        $this->assertSame('6 თვეში', $date->ago());

        $date = JenssegersDate::parse('+10 years');
        $this->assertSame('10 წელიწადში', $date->ago());
    }
}
