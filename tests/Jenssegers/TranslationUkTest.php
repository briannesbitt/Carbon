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

class TranslationUkTest extends TestCaseBase
{
    public const LOCALE = 'uk';

    public function testTimespanTranslated()
    {
        $date = new JenssegersDate('@1403619368');
        $date = $date->sub('-100 days -3 hours -20 minutes');

        $this->assertSame('3 місяці, 1 тиждень, 1 день, 3 години, 20 хвилин', $date->timespan('@1403619368'));
    }

    public function testCreateFromFormat()
    {
        $date = JenssegersDate::createFromFormat('d F Y', '01 січня 2015');
        $this->assertSame('2015-01-01', $date->format('Y-m-d'));

        $date = JenssegersDate::createFromFormat('D d F Y', 'сб 21 березня 2015');
        $this->assertSame('2015-03-21', $date->format('Y-m-d'));
    }

    public function testAgoTranslated()
    {
        // Ago test can't work on February 29th
        if (JenssegersDate::now()->format('m-d') === '02-29') {
            JenssegersDate::setTestNow(JenssegersDate::now()->subDay());
        }

        $date = JenssegersDate::parse('-21 hours');
        $this->assertSame('21 годину тому', $date->ago());

        $date = JenssegersDate::parse('-5 days');
        $this->assertSame('5 днів тому', $date->ago());

        $date = JenssegersDate::parse('-3 weeks');
        $this->assertSame('3 тижні тому', $date->ago());

        $date = JenssegersDate::now()->subMonthsNoOverflow(6);
        $this->assertSame('6 місяців тому', $date->ago());

        $date = JenssegersDate::parse('-10 years');
        $this->assertSame('10 років тому', $date->ago());
    }

    public function testFormatDeclensions()
    {
        $date = new JenssegersDate('10 march 2015');
        $this->assertSame('березень 2015', $date->format('F Y'));

        $date = new JenssegersDate('10 march 2015');
        $this->assertSame('10 березня 2015', $date->format('j F Y'));
    }

    public function testFormatShortNotation()
    {
        $date = new JenssegersDate('10 january 2015');
        $this->assertSame('10 січ 2015', $date->format('j M Y'));

        $date = new JenssegersDate('10 february 2015');
        $this->assertSame('10 лют 2015', $date->format('j M Y'));

        $date = new JenssegersDate('10 march 2015');
        $this->assertSame('10 бер 2015', $date->format('j M Y'));

        $date = new JenssegersDate('10 april 2015');
        $this->assertSame('10 кві 2015', $date->format('j M Y'));

        $date = new JenssegersDate('10 may 2015');
        $this->assertSame('10 тра 2015', $date->format('j M Y'));
    }

    public function testAfterTranslated()
    {
        $date = JenssegersDate::parse('+21 hours');
        $this->assertSame('за 21 годину', $date->ago());

        $date = JenssegersDate::parse('+5 days');
        $this->assertSame('за 5 днів', $date->ago());

        $date = JenssegersDate::parse('+3 weeks');
        $this->assertSame('за 3 тижні', $date->ago());

        $date = JenssegersDate::parse('+6 months');
        $this->assertSame('за 6 місяців', $date->ago());

        $date = JenssegersDate::parse('+10 years');
        $this->assertSame('за 10 років', $date->ago());
    }
}
