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

namespace Tests\CarbonInterval;

use Carbon\Carbon;
use Carbon\CarbonInterface;
use Carbon\CarbonInterval;
use Carbon\Translator as CarbonTranslator;
use Symfony\Component\Translation\Loader\ArrayLoader;
use Symfony\Component\Translation\Translator;
use Tests\AbstractTestCase;
use Tests\CarbonInterval\Fixtures\MyCarbonInterval;

class ForHumansTest extends AbstractTestCase
{
    protected function tearDown(): void
    {
        parent::tearDown();
        CarbonInterval::setLocale('en');
    }

    public function testGetTranslator()
    {
        /** @var CarbonTranslator $t */
        $t = CarbonInterval::getTranslator();
        $this->assertNotNull($t);
        $this->assertSame('en', $t->getLocale());
        $this->assertSame('en', CarbonInterval::day()->locale());
    }

    public function testResetTranslator()
    {
        /** @var CarbonTranslator $t */
        $t = MyCarbonInterval::getTranslator();
        $this->assertNotNull($t);
        $this->assertSame('en', $t->getLocale());
        $this->assertSame('en', CarbonInterval::day()->locale());
    }

    public function testSetTranslator()
    {
        /** @var CarbonTranslator $ori */
        $ori = CarbonInterval::getTranslator();
        $t = new Translator('fr');
        $t->addLoader('array', new ArrayLoader());
        CarbonInterval::setTranslator($t);

        /** @var CarbonTranslator $t */
        $t = CarbonInterval::getTranslator();
        $this->assertNotNull($t);
        $this->assertSame('fr', $t->getLocale());
        CarbonInterval::setTranslator($ori);
    }

    public function testDumpTranslator()
    {
        $t = new CarbonTranslator('tr_CY');
        $this->assertSame([
            'locale' => 'tr_CY',
        ], $t->__debugInfo());
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

    public function testOptions()
    {
        CarbonInterval::setLocale('en');
        $this->assertSame('1 year 2 months ago', CarbonInterval::year()->add(CarbonInterval::months(2))->forHumans(CarbonInterface::DIFF_RELATIVE_TO_NOW));
        $this->assertSame('1 year before', CarbonInterval::year()->add(CarbonInterval::months(2))->forHumans(CarbonInterface::DIFF_RELATIVE_TO_OTHER, 1));
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

    public function testCustomJoin()
    {
        $interval = CarbonInterval::create(1, 1, 0, 1, 1)->locale('fr');
        $this->assertSame('1 an 1 mois 1 jour 1 heure', $interval->forHumans());
        $this->assertSame('1 an, 1 mois, 1 jour et 1 heure', $interval->forHumans([
            'join' => true,
        ]));
        $this->assertSame('တစ်နှစ် တစ်လ တစ်ရက် တစ်နာရီ', $interval->copy()->locale('my')->forHumans([
            'join' => true,
        ]));
        $this->assertSame('un an, un mois, un jour, une heure', $interval->forHumans([
            'join' => ', ',
            'aUnit' => true,
        ]));
        $this->assertSame('un an et un mois et un jour et aussi une heure', $interval->forHumans([
            'join' => [' et ', ' et aussi '],
            'aUnit' => true,
        ]));
        $interval = CarbonInterval::create(1, 1, 0, 1, 1)->locale('en');
        $this->assertSame('1 year 1 month 1 day 1 hour', $interval->forHumans());
        $this->assertSame('1 year, 1 month, 1 day and 1 hour', $interval->forHumans([
            'join' => true,
        ]));
        $this->assertSame('1 year, 1 month, 1 day, 1 hour', $interval->forHumans([
            'join' => ', ',
        ]));
        $this->assertSame('a year and a month and a day and also an hour', $interval->forHumans([
            'join' => [' and ', ' and also '],
            'aUnit' => true,
        ]));
        $this->assertSame('[1 year;1 month;1 day;1 hour]', $interval->forHumans([
            'join' => function ($list) {
                return '['.implode(';', $list).']';
            },
        ]));
    }

    public function testChineseJoin()
    {
        $interval = CarbonInterval::create(1, 1, 0, 1, 1)->locale('zh_Hans');
        $this->assertSame('1年1个月1天1小时', $interval->forHumans());
        $this->assertSame('1年1个月1天1小时', $interval->forHumans([
            'join' => true,
        ]));
        $this->assertSame('1 年 1 个月 1 天 1 小时', $interval->forHumans([
            'join' => false,
        ]));
        $this->assertSame('1年1个月1天1小时', $interval->forHumans([
            'join' => '',
        ]));
        $this->assertSame('1 年 1 个月 1 天 1 小时', $interval->forHumans([
            'join' => ' ',
        ]));
        $this->assertSame('1年-1个月-1天-1小时', $interval->forHumans([
            'join' => '-',
        ]));
    }

    public function testOptionsAsArray()
    {
        $interval = CarbonInterval::create(1, 1, 0, 1, 1)->locale('fr');
        $this->assertSame('1 an', $interval->forHumans([
            'join' => 'foo',
            'parts' => 1,
        ]));
        $this->assertSame('il y a un an', $interval->forHumans([
            'join' => 'foo',
            'aUnit' => true,
            'parts' => 1,
            'syntax' => CarbonInterface::DIFF_RELATIVE_TO_NOW,
        ]));
        $interval = CarbonInterval::day();
        $this->assertSame('1d', $interval->forHumans([
            'short' => true,
        ]));
        $interval = CarbonInterval::day();
        $this->assertSame('yesterday', $interval->forHumans([
            'parts' => 1,
            'syntax' => CarbonInterface::DIFF_RELATIVE_TO_NOW,
            'options' => CarbonInterface::ONE_DAY_WORDS,
        ]));
    }

    public function testRoundYears()
    {
        CarbonInterval::setLocale('en');
        $interval = CarbonInterval::years(2)->months(11);
        $this->assertSame('3 years', $interval->forHumans(['parts' => 1, 'options' => CarbonInterface::ROUND]));
        $interval = CarbonInterval::years(2)->months(5)->days(70);
        $this->assertSame('3 years', $interval->forHumans(['parts' => 1, 'options' => CarbonInterface::ROUND]));
    }

    public function testRoundMonths()
    {
        CarbonInterval::setLocale('en');
        $interval = CarbonInterval::months(2)->weeks(3);
        $this->assertSame('3 months', $interval->forHumans(['parts' => 1, 'options' => CarbonInterface::ROUND]));
    }

    public function testRoundUp()
    {
        CarbonInterval::setLocale('en');
        $interval = CarbonInterval::days(2)->hours(23);
        $this->assertSame('3 days', $interval->forHumans(['parts' => 1, 'options' => CarbonInterface::ROUND]));
    }

    public function testRoundDown()
    {
        CarbonInterval::setLocale('en');
        $interval = CarbonInterval::days(2)->hours(11);
        $this->assertSame('2 days', $interval->forHumans(['parts' => 1, 'options' => CarbonInterface::ROUND]));
    }

    public function testRoundMinutes()
    {
        CarbonInterval::setLocale('en');
        $interval = CarbonInterval::days(2)->hours(11)->minutes(15);
        $this->assertSame('2 days 11 hours', $interval->forHumans(['parts' => 2, 'options' => CarbonInterface::ROUND]));
    }

    public function testRoundDownWhenNextIntervalIsNonSequential()
    {
        CarbonInterval::setLocale('en');
        $interval = CarbonInterval::days(2)->minutes(59);
        $this->assertSame('2 days', $interval->forHumans(['parts' => 1, 'options' => CarbonInterface::ROUND]));
    }

    public function testRoundMultipleParts()
    {
        CarbonInterval::setLocale('en');
        $interval = CarbonInterval::days(2)->minutes(45)->seconds(59);
        $this->assertSame('2 days 46 minutes', $interval->forHumans(['parts' => 2, 'options' => CarbonInterface::ROUND]));
    }

    public function testRoundMultiplePartsGap()
    {
        CarbonInterval::setLocale('en');
        $interval = CarbonInterval::days(2)->seconds(59);
        $this->assertSame('2 days 59 seconds', $interval->forHumans(['parts' => 2]));
        $this->assertSame('2 days 59 seconds', $interval->forHumans(['parts' => 2, 'options' => CarbonInterface::ROUND]));
        $this->assertSame('2 days', $interval->forHumans(['parts' => 1, 'options' => CarbonInterface::ROUND]));
    }

    public function testRoundWeeks()
    {
        CarbonInterval::setLocale('en');
        $interval = CarbonInterval::days(13);
        $this->assertSame('2 weeks', $interval->forHumans(['parts' => 1, 'options' => CarbonInterface::ROUND]));
    }

    public function testRoundWeeksWithMultipleParts()
    {
        CarbonInterval::setLocale('en');
        $interval = CarbonInterval::days(13);
        $this->assertSame('1 week 6 days', $interval->forHumans(['parts' => 2, 'options' => CarbonInterface::ROUND]));
    }

    public function testRoundOverflowNonSequentialRoundUp()
    {
        CarbonInterval::setLocale('en');
        $interval = CarbonInterval::years(2)->months(35);
        $this->assertSame('5 years', $interval->forHumans(['parts' => 1, 'options' => CarbonInterface::ROUND]));
    }

    public function testRoundOverflowNonSequentialRoundDown()
    {
        CarbonInterval::setLocale('en');
        $interval = CarbonInterval::years(2)->months(37);
        $this->assertSame('5 years', $interval->forHumans(['parts' => 1, 'options' => CarbonInterface::ROUND]));
    }

    public function testRoundCarryOverDoesntMatter()
    {
        CarbonInterval::setLocale('en');
        $interval = CarbonInterval::days(2)->hours(11)->minutes(59);
        $this->assertSame('2 days', $interval->forHumans(['parts' => 1, 'options' => CarbonInterface::ROUND]));

        $interval = CarbonInterval::days(2)->minutes(780);
        $this->assertSame('3 days', $interval->forHumans(['parts' => 1, 'options' => CarbonInterface::ROUND]));

        $interval = CarbonInterval::days(2)->minutes(59)->seconds(58);
        $this->assertSame('2 days 1 hour', $interval->forHumans(['parts' => 2, 'options' => CarbonInterface::ROUND]));

        $interval = CarbonInterval::days(2)->minutes(59)->seconds(1);
        $this->assertSame('2 days 1 hour', $interval->forHumans(['parts' => 2, 'options' => CarbonInterface::CEIL]));

        $interval = CarbonInterval::days(2)->minutes(59)->seconds(58);
        $this->assertSame('2 days 59 minutes', $interval->forHumans(['parts' => 2, 'options' => CarbonInterface::FLOOR]));

        // Floor is not the default behavior, see the difference below:
        $interval = CarbonInterval::days(2)->minutes(59)->seconds(62);
        $this->assertSame('2 days 1 hour', $interval->forHumans(['parts' => 2, 'options' => CarbonInterface::FLOOR]));

        $interval = CarbonInterval::days(2)->minutes(59)->seconds(62);
        $this->assertSame('2 days 59 minutes', $interval->forHumans(['parts' => 2]));

        $start = Carbon::create(2009, 9)->startOfMonth();
        $end = Carbon::create(2012, 2)->endOfMonth();

        $interval = CarbonInterval::instance($start->diff($end))->forHumans(
            Carbon::DIFF_ABSOLUTE,
            false,
            2,
            Carbon::CEIL,
        );

        $this->assertSame('2 years 6 months', $interval);

        $interval = CarbonInterval::months(2)->days(30);
        $this->assertSame('3 months', $interval->forHumans(['parts' => 1, 'options' => CarbonInterface::ROUND]));
        $interval = CarbonInterval::months(2)->days(31);
        $this->assertSame('3 months', $interval->forHumans(['parts' => 1, 'options' => CarbonInterface::ROUND]));
        $interval = CarbonInterval::months(2)->days(32);
        $this->assertSame('3 months', $interval->forHumans(['parts' => 1, 'options' => CarbonInterface::ROUND]));
        $interval = CarbonInterval::months(2)->days(30);
        $this->assertSame('3 months', $interval->forHumans(['parts' => 1, 'options' => CarbonInterface::CEIL]));
        $interval = CarbonInterval::months(2)->days(31);
        $this->assertSame('3 months', $interval->forHumans(['parts' => 1, 'options' => CarbonInterface::CEIL]));
        $interval = CarbonInterval::months(2)->days(32);
        $this->assertSame('4 months', $interval->forHumans(['parts' => 1, 'options' => CarbonInterface::CEIL]));
    }

    public function testCeilShortMonth()
    {
        Carbon::setTestNow('2022-02-08T10:27:03Z');
        $this->assertSame(
            '4 weeks ago',
            Carbon::parse('2022-01-11 15:36:29')->diffForHumans(['parts' => 1, 'options' => Carbon::CEIL])
        );
        $this->assertSame(
            '1 month ago',
            Carbon::parse('2022-01-10 16:57:38')->diffForHumans(['parts' => 1, 'options' => Carbon::CEIL])
        );
    }

    public function testSkipUnits()
    {
        CarbonInterval::setLocale('en');
        $interval = CarbonInterval::days(15)->hours(11)->minutes(15);
        $this->assertSame('15 days 11 hours', $interval->forHumans([
            'parts' => 2,
            'skip' => 'week',
        ]));

        $this->assertSame('15 days 675 minutes', $interval->forHumans([
            'parts' => 2,
            'skip' => ['weeks', 'hours'],
        ]));

        $interval = CarbonInterval::days(15)->hours(11)->minutes(15);
        $this->assertSame('15 days 675 minutes', $interval->forHumans([
            'parts' => 2,
            'skip' => ['weeks', 'hours'],
        ]));

        $factors = CarbonInterval::getCascadeFactors();

        CarbonInterval::setCascadeFactors(['weeks' => [5, 'days']]);

        $interval = CarbonInterval::days(15)->hours(11)->minutes(15);
        $this->assertSame('15 days 675 minutes', $interval->forHumans([
            'parts' => 2,
            'skip' => ['weeks', 'hours'],
        ]));

        CarbonInterval::setCascadeFactors([
            'weeks' => [5, 'days'],
            'hours' => [30, 'minutes'],
        ]);

        $interval = CarbonInterval::days(15)->hours(11)->minutes(15);
        $this->assertSame('15 days 345 minutes', $interval->forHumans([
            'parts' => 2,
            'skip' => ['weeks', 'hours'],
        ]));

        CarbonInterval::setCascadeFactors($factors);
    }

    public function testGetValuesSequence()
    {
        $this->assertSame([], CarbonInterval::days(0)->getValuesSequence());
    }

    public function testMinimumUnitDefault()
    {
        CarbonInterval::setLocale('en');
        $interval = CarbonInterval::fromString('1 second 114 milliseconds');
        $this->assertSame('1 second', $interval->forHumans(['parts' => 3]));
    }

    public function testMinimumUnitHours()
    {
        CarbonInterval::setLocale('en');
        $interval = CarbonInterval::fromString('1 hour 1 second 114 milliseconds');
        $this->assertSame('1 hour', $interval->forHumans(['parts' => 3, 'minimumUnit' => 'hour']));
    }

    public function testMinimumUnitMillisecondsShort()
    {
        CarbonInterval::setLocale('en');
        $interval = CarbonInterval::fromString('1 second 114 milliseconds');
        $this->assertSame('1s 114ms', $interval->forHumans(['parts' => 3, 'short' => true, 'minimumUnit' => 'ms']));
    }

    public function testMinimumUnitMicroseconds()
    {
        CarbonInterval::setLocale('fr');
        $interval = CarbonInterval::fromString('1s 114ms 584µs');
        $this->assertEquals(
            '1 seconde, 114 millisecondes et 584 microsecondes',
            $interval->forHumans(['parts' => 3, 'join' => true, 'minimumUnit' => 'µs']),
        );
    }

    public function testMinimumUnitMillisecondsInFrenchAndGerman()
    {
        $interval = CarbonInterval::fromString('98756 milliseconds')->cascade();
        $this->assertEquals(
            'une minute, 38 secondes et 756 millisecondes',
            $interval->locale('fr')->forHumans(['parts' => 3, 'minimumUnit' => 'ms', 'join' => true, 'aUnit' => true]),
        );
        $this->assertEquals(
            'eine Minute, 38 Sekunden und 756 Millisekunden',
            $interval->locale('de')->forHumans(['parts' => 3, 'minimumUnit' => 'ms', 'join' => true, 'aUnit' => true]),
        );
    }

    public function testMinimumUnitNoInterval()
    {
        CarbonInterval::setLocale('en');
        $interval = CarbonInterval::fromString('1 second 114 milliseconds');
        // Test with and without NO_ZERO_DIFF
        $this->assertSame('1 hour', $interval->forHumans(['parts' => 3, 'minimumUnit' => 'hour', 'options' => CarbonInterface::NO_ZERO_DIFF]));
        $this->assertSame('0 hours', $interval->forHumans(['parts' => 3, 'minimumUnit' => 'hour', 'options' => 0]));
    }
}
