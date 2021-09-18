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

class TranslationElTest extends TestCaseBase
{
    public const LOCALE = 'el';

    public function testTimespanTranslated()
    {
        $date = new JenssegersDate('@1403619368');
        $date = $date->sub('-100 days -3 hours -20 minutes');

        $this->assertSame('3 μήνες, 1 εβδομάδα, 1 μέρα, 3 ώρες, 20 λεπτά', $date->timespan('@1403619368'));
    }

    public function testCreateFromFormat()
    {
        $date = JenssegersDate::createFromFormat('d F Y', '1 Ιανουαρίου 2015');
        $this->assertSame('2015-01-01', $date->format('Y-m-d'));

        $date = JenssegersDate::createFromFormat('D d F Y', 'Σάββατο 21 Μαρτίου 2015');
        $this->assertSame('2015-03-21', $date->format('Y-m-d'));
    }

    public function testAgoTranslated()
    {
        // Ago test can't work on February 29th
        if (JenssegersDate::now()->format('m-d') === '02-29') {
            JenssegersDate::setTestNow(JenssegersDate::now()->subDay());
        }

        $date = JenssegersDate::parse('-21 hours');
        $this->assertSame('πριν 21 ώρες', $date->ago());

        $date = JenssegersDate::parse('-5 days');
        $this->assertSame('πριν 5 μέρες', $date->ago());

        $date = JenssegersDate::parse('-3 weeks');
        $this->assertSame('πριν 3 εβδομάδες', $date->ago());

        $date = JenssegersDate::now()->subMonthsNoOverflow(6);
        $this->assertSame('πριν 6 μήνες', $date->ago());

        $date = JenssegersDate::parse('-10 years');
        $this->assertSame('πριν 10 χρόνια', $date->ago());
    }

    public function testFormatDeclensions()
    {
        $date = new JenssegersDate('10 march 2015');
        $this->assertSame('Μάρτιος 2015', $date->format('F Y'));

        $date = new JenssegersDate('10 march 2015');
        $this->assertSame('10 Μαρτίου 2015', $date->format('j F Y'));
    }

    public function testFormatShortNotation()
    {
        $date = new JenssegersDate('10 january 2015');
        $this->assertSame('10 Ιαν 2015', $date->format('j M Y'));

        $date = new JenssegersDate('10 february 2015');
        $this->assertSame('10 Φεβ 2015', $date->format('j M Y'));

        $date = new JenssegersDate('10 march 2015');
        $this->assertSame('10 Μαρ 2015', $date->format('j M Y'));

        $date = new JenssegersDate('10 april 2015');
        $this->assertSame('10 Απρ 2015', $date->format('j M Y'));

        $date = new JenssegersDate('10 may 2015');
        $this->assertSame('10 Μαϊ 2015', $date->format('j M Y'));

        $date = new JenssegersDate('10 june 2015');
        $this->assertSame('10 Ιουν 2015', $date->format('j M Y'));

        $date = new JenssegersDate('10 july 2015');
        $this->assertSame('10 Ιουλ 2015', $date->format('j M Y'));

        $date = new JenssegersDate('10 august 2015');
        $this->assertSame('10 Αυγ 2015', $date->format('j M Y'));

        $date = new JenssegersDate('10 september 2015');
        $this->assertSame('10 Σεπ 2015', $date->format('j M Y'));

        $date = new JenssegersDate('10 october 2015');
        $this->assertSame('10 Οκτ 2015', $date->format('j M Y'));

        $date = new JenssegersDate('10 november 2015');
        $this->assertSame('10 Νοε 2015', $date->format('j M Y'));

        $date = new JenssegersDate('10 december 2015');
        $this->assertSame('10 Δεκ 2015', $date->format('j M Y'));
    }

    public function testAfterTranslated()
    {
        $date = JenssegersDate::parse('+21 hours');
        $this->assertSame('σε 21 ώρες', $date->ago());

        $date = JenssegersDate::parse('+5 days');
        $this->assertSame('σε 5 μέρες', $date->ago());

        $date = JenssegersDate::parse('+3 weeks');
        $this->assertSame('σε 3 εβδομάδες', $date->ago());

        $date = JenssegersDate::parse('+6 months');
        $this->assertSame('σε 6 μήνες', $date->ago());

        $date = JenssegersDate::parse('+10 years');
        $this->assertSame('σε 10 χρόνια', $date->ago());
    }
}
