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

use Carbon\Carbon;
use DateTimeImmutable;

class DateTest extends TestCaseBase
{
    public function testConstructFromString()
    {
        Carbon::setTestNow();

        $date = new Carbon('2013-01-31');
        $this->assertSame(1359590400, $date->getTimestamp());

        $before = (new DateTimeImmutable())->getTimestamp();
        $date = new Carbon('1 day ago');
        $after = (new DateTimeImmutable())->getTimestamp();
        $this->assertGreaterThanOrEqual($before - 86400, $date->getTimestamp());
        $this->assertLessThanOrEqual($after - 86400, $date->getTimestamp());
    }

    public function testConstructTimestamp()
    {
        $date = new Carbon('@1367186296');
        $this->assertSame(1367186296, $date->getTimestamp());
    }

    public function testMake()
    {
        $date1 = Carbon::make('Sunday 28 April 2013 21:58:16');
        $date2 = new Carbon('Sunday 28 April 2013 21:58:16');
        $this->assertEquals($date1, $date2);
    }

    public function testCreateFromCarbon()
    {
        // Preferred way
        $date = Carbon::make(Carbon::createFromFormat('U', '1367186296'));
        $this->assertInstanceOf(Carbon::class, $date);
        $this->assertSame(1367186296, $date->getTimestamp());

        // Accepted for backward-compatibility with some libraries
        $date = Carbon::make(Carbon::createFromFormat('!U', 1367186296));
        $this->assertInstanceOf(Carbon::class, $date);
        $this->assertSame(1367186296, $date->getTimestamp());

        // Deprecated usage
        $date = Carbon::make(Carbon::createFromFormat('!md', 1225));
        $this->assertInstanceOf(Carbon::class, $date);
        $this->assertSame(30931200, $date->getTimestamp());
    }

    public function testManipulation()
    {
        $now = Carbon::now();

        $this->assertSame(86400, $now->copy()->add('1 day')->getTimestamp() - $now->getTimestamp());
        $this->assertSame(4 * 86400, $now->copy()->add('4 day')->getTimestamp() - $now->getTimestamp());

        $this->assertSame(-86400, $now->copy()->sub('1 day')->getTimestamp() - $now->getTimestamp());
        $this->assertSame(-4 * 86400, $now->copy()->sub('4 day')->getTimestamp() - $now->getTimestamp());

        $this->assertSame(10 * 86400, $now->copy()->add('P10D')->getTimestamp() - $now->getTimestamp());
        $this->assertSame(-10 * 86400, $now->copy()->sub('P10D')->getTimestamp() - $now->getTimestamp());
    }

    public function testFormat()
    {
        $date = new Carbon('@1367186296');
        $this->assertSame('Sunday 28 April 2013 21:58:16', $date->format('l j F Y H:i:s'));
    }

    public function testAge()
    {
        // Age test can't work on February 29th
        if (Carbon::now()->format('m-d') === '02-29') {
            Carbon::setTestNow(Carbon::now()->subDay());
        }

        $date = Carbon::parse('-5 years');
        $this->assertSame(5, $date->age);
    }

    public function testAgo()
    {
        // Ago test can't work on February 29th
        if (Carbon::now()->format('m-d') === '02-29') {
            Carbon::setTestNow(Carbon::now()->subDay());
        }

        $date = Carbon::parse('-5 years');
        $this->assertSame('5 years ago', $date->ago());

        $date = JenssegersDate::now()->subMonthsNoOverflow(5);
        $this->assertSame('5 months ago', $date->ago());

        $date = Carbon::parse('-32 days');
        $this->assertSame('1 month ago', $date->ago());

        $date = Carbon::parse('-4 days');
        $this->assertSame('4 days ago', $date->ago());

        $date = Carbon::parse('-1 day');
        $this->assertSame('1 day ago', $date->ago());

        $date = Carbon::parse('-3 hours');
        $this->assertSame('3 hours ago', $date->ago());

        $date = Carbon::parse('-1 hour');
        $this->assertSame('1 hour ago', $date->ago());

        $date = Carbon::parse('-2 minutes');
        $this->assertSame('2 minutes ago', $date->ago());

        $date = Carbon::parse('-1 minute');
        $this->assertSame('1 minute ago', $date->ago());

        $date = Carbon::parse('-50 second');
        $this->assertSame('50 seconds ago', $date->ago());

        $date = Carbon::parse('-1 second');
        $this->assertSame('1 second ago', $date->ago());

        $date = Carbon::parse('+5 days');
        $this->assertSame('5 days from now', $date->ago());

        $date = Carbon::parse('+5 days');
        $this->assertSame('5 days after', $date->ago(Carbon::now()));

        $date = Carbon::parse('-5 days');
        $this->assertSame('5 days before', $date->ago(Carbon::now()));
    }

    public function testAbsoluteAgo()
    {
        $date = Carbon::parse('-5 days');
        $this->assertSame('5 days', $date->ago(Carbon::now(), true));

        $date = Carbon::parse('+5 days');
        $this->assertSame('5 days', $date->ago(Carbon::now(), true));
    }

    public function testDiffForHumans()
    {
        // Diff for humans test can't work on February 29th
        if (Carbon::now()->format('m-d') === '02-29') {
            Carbon::setTestNow(Carbon::now()->subDay());
        }

        $date = Carbon::parse('-5 years');
        $this->assertSame('5 years ago', $date->diffForHumans());

        $date = Carbon::parse('-15 days');
        $this->assertSame('2 weeks ago', $date->diffForHumans());

        $date = Carbon::parse('-13 days');
        $this->assertSame('1 week ago', $date->diffForHumans());

        $date = Carbon::parse('-13 days');
        $this->assertSame('1 week', $date->diffForHumans(null, true));

        $date = JenssegersDate::now()->subMonthsNoOverflow(3);
        $this->assertSame('3 months', $date->diffForHumans(null, true));

        $date = Carbon::parse('-1 week');
        $future = Carbon::parse('+1 week');
        $this->assertSame('2 weeks after', $future->diffForHumans($date));
        $this->assertSame('2 weeks before', $date->diffForHumans($future));
    }

    public function testTimespan()
    {
        $date = new Carbon('@1403619368');
        $date = $date->sub('-100 days -3 hours -20 minutes');

        $this->assertSame('3 months, 1 week, 1 day, 3 hours, 20 minutes', $date->timespan('@1403619368'));
    }

    public function testTranslateTimeString()
    {
        Carbon::setLocale('ru');
        $date = Carbon::translateTimeString('понедельник 21 март 2015');
        $this->assertSame('monday 21 march 2015', mb_strtolower($date));

        Carbon::setLocale('de');
        $date = Carbon::translateTimeString('Montag 21 März 2015');
        $this->assertSame('monday 21 march 2015', mb_strtolower($date));

        $this->assertSame('Foobar', Carbon::translateTimeString('Foobar', 'xx'));
    }

    public function testTranslateTimeStringWithOrdinalWords()
    {
        $date = Carbon::translateTimeString('Premier lundi de mai', 'fr', 'en');
        $this->assertSame('first monday of may', mb_strtolower($date));

        $date = Carbon::translateTimeString('Premier lundi de mai', 'fr', 'es');
        $this->assertSame('primer lunes de mayo', mb_strtolower($date));
    }
}
