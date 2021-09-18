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

class TranslationJaTest extends TestCaseBase
{
    public const LOCALE = 'ja';

    public function testItCanTranslateMonth()
    {
        $jan = JenssegersDate::createFromFormat('m-d', '01-01');
        $feb = JenssegersDate::createFromFormat('m-d', '02-01');
        $mar = JenssegersDate::createFromFormat('m-d', '03-01');
        $apr = JenssegersDate::createFromFormat('m-d', '04-01');
        $may = JenssegersDate::createFromFormat('m-d', '05-01');
        $jun = JenssegersDate::createFromFormat('m-d', '06-01');
        $jul = JenssegersDate::createFromFormat('m-d', '07-01');
        $aug = JenssegersDate::createFromFormat('m-d', '08-01');
        $sep = JenssegersDate::createFromFormat('m-d', '09-01');
        $oct = JenssegersDate::createFromFormat('m-d', '10-01');
        $nov = JenssegersDate::createFromFormat('m-d', '11-01');
        $dec = JenssegersDate::createFromFormat('m-d', '12-01');

        $this->assertSame('1月', $jan->format('F'));
        $this->assertSame('2月', $feb->format('F'));
        $this->assertSame('3月', $mar->format('F'));
        $this->assertSame('4月', $apr->format('F'));
        $this->assertSame('5月', $may->format('F'));
        $this->assertSame('6月', $jun->format('F'));
        $this->assertSame('7月', $jul->format('F'));
        $this->assertSame('8月', $aug->format('F'));
        $this->assertSame('9月', $sep->format('F'));
        $this->assertSame('10月', $oct->format('F'));
        $this->assertSame('11月', $nov->format('F'));
        $this->assertSame('12月', $dec->format('F'));
    }

    public function testItCanTranslateWeekdays()
    {
        $mon = JenssegersDate::parse('next monday');
        $tue = JenssegersDate::parse('next tuesday');
        $wed = JenssegersDate::parse('next wednesday');
        $thu = JenssegersDate::parse('next thursday');
        $fri = JenssegersDate::parse('next friday');
        $sat = JenssegersDate::parse('next saturday');
        $sun = JenssegersDate::parse('next sunday');

        $this->assertSame('月曜日', $mon->format('l'));
        $this->assertSame('火曜日', $tue->format('l'));
        $this->assertSame('水曜日', $wed->format('l'));
        $this->assertSame('木曜日', $thu->format('l'));
        $this->assertSame('金曜日', $fri->format('l'));
        $this->assertSame('土曜日', $sat->format('l'));
        $this->assertSame('日曜日', $sun->format('l'));
    }

    public function testItCanTranslateWeekdaysShortForm()
    {
        $mon = JenssegersDate::parse('next monday');
        $tue = JenssegersDate::parse('next tuesday');
        $wed = JenssegersDate::parse('next wednesday');
        $thu = JenssegersDate::parse('next thursday');
        $fri = JenssegersDate::parse('next friday');
        $sat = JenssegersDate::parse('next saturday');
        $sun = JenssegersDate::parse('next sunday');

        $this->assertSame('月', $mon->format('D'));
        $this->assertSame('火', $tue->format('D'));
        $this->assertSame('水', $wed->format('D'));
        $this->assertSame('木', $thu->format('D'));
        $this->assertSame('金', $fri->format('D'));
        $this->assertSame('土', $sat->format('D'));
        $this->assertSame('日', $sun->format('D'));
    }

    public function testItCanTranslateSecondsAgo()
    {
        $oneSecondAgo = JenssegersDate::parse('-1 second');
        $fiveSecondsAgo = JenssegersDate::parse('-5 seconds');

        $this->assertSame('1秒前', $oneSecondAgo->ago());
        $this->assertSame('5秒前', $fiveSecondsAgo->ago());
    }

    public function testItCanTranslateMinutesAgo()
    {
        $oneMinuteAgo = JenssegersDate::parse('-1 minute');
        $fiveMinutesAgo = JenssegersDate::parse('-5 minutes');

        $this->assertSame('1分前', $oneMinuteAgo->ago());
        $this->assertSame('5分前', $fiveMinutesAgo->ago());
    }

    public function testItCanTranslateHoursAgo()
    {
        $oneHourAgo = JenssegersDate::parse('-1 hour');
        $fiveHoursAgo = JenssegersDate::parse('-5 hours');

        $this->assertSame('1時間前', $oneHourAgo->ago());
        $this->assertSame('5時間前', $fiveHoursAgo->ago());
    }

    public function testItCanTranslateDaysAgo()
    {
        $oneDayAgo = JenssegersDate::parse('-1 day');
        $threeDaysAgo = JenssegersDate::parse('-3 days');

        $this->assertSame('1日前', $oneDayAgo->ago());
        $this->assertSame('3日前', $threeDaysAgo->ago());
    }

    public function testItCanTranslateWeeksAgo()
    {
        $oneWeekAgo = JenssegersDate::parse('-1 week');
        $threeWeeksAgo = JenssegersDate::parse('-3 weeks');

        $this->assertSame('1週間前', $oneWeekAgo->ago());
        $this->assertSame('3週間前', $threeWeeksAgo->ago());
    }

    public function testItCanTranslateMonthsAgo()
    {
        JenssegersDate::setTestNow('2019-03-27');

        $oneMonthAgo = JenssegersDate::now()->subMonthNoOverflow();
        $twoMonthsAgo = JenssegersDate::now()->subMonthsNoOverflow(2);

        $this->assertSame('1ヶ月前', $oneMonthAgo->ago());
        $this->assertSame('2ヶ月前', $twoMonthsAgo->ago());
    }

    public function testItCanTranslateYearsAgo()
    {
        $oneYearAgo = JenssegersDate::parse('-1 year');
        $towYearsAgo = JenssegersDate::parse('-2 years');

        $this->assertSame('1年前', $oneYearAgo->ago());
        $this->assertSame('2年前', $towYearsAgo->ago());
    }

    public function testItCanTranslateSecondsFromNow()
    {
        $oneSecondFromNow = JenssegersDate::parse('1 second');
        $fiveSecondsFromNow = JenssegersDate::parse('5 seconds');

        $this->assertSame('1秒後', $oneSecondFromNow->diffForHumans());
        $this->assertSame('5秒後', $fiveSecondsFromNow->diffForHumans());
    }

    public function testItCanTranslateMinutesFromNow()
    {
        $oneMinuteFromNow = JenssegersDate::parse('1 minute');
        $fiveMinutesFromNow = JenssegersDate::parse('5 minutes');

        $this->assertSame('1分後', $oneMinuteFromNow->diffForHumans());
        $this->assertSame('5分後', $fiveMinutesFromNow->diffForHumans());
    }

    public function testItCanTranslateHoursFromNow()
    {
        $oneHourFromNow = JenssegersDate::parse('1 hour');
        $fiveHoursFromNow = JenssegersDate::parse('5 hours');

        $this->assertSame('1時間後', $oneHourFromNow->diffForHumans());
        $this->assertSame('5時間後', $fiveHoursFromNow->diffForHumans());
    }

    public function testItCanTranslateDaysFromNow()
    {
        $oneDayFromNow = JenssegersDate::parse('1 day');
        $threeDaysFromNow = JenssegersDate::parse('3 days');

        $this->assertSame('1日後', $oneDayFromNow->diffForHumans());
        $this->assertSame('3日後', $threeDaysFromNow->diffForHumans());
    }

    public function testItCanTranslateWeeksFromNow()
    {
        $oneWeekFromNow = JenssegersDate::parse('1 week');
        $threeWeeksFromNow = JenssegersDate::parse('3 weeks');

        $this->assertSame('1週間後', $oneWeekFromNow->diffForHumans());
        $this->assertSame('3週間後', $threeWeeksFromNow->diffForHumans());
    }

    public function testItCanTranslateMonthsFromNow()
    {
        $oneMonthFromNow = JenssegersDate::parse('1 month');
        $twoMonthsFromNow = JenssegersDate::parse('2 months');

        $this->assertSame('1ヶ月後', $oneMonthFromNow->diffForHumans());
        $this->assertSame('2ヶ月後', $twoMonthsFromNow->diffForHumans());
    }

    public function testItCanTranslateYearsFromNow()
    {
        $oneYearFromNow = JenssegersDate::parse('1 year');
        $towYearsFromNow = JenssegersDate::parse('2 years');

        $this->assertSame('1年後', $oneYearFromNow->diffForHumans());
        $this->assertSame('2年後', $towYearsFromNow->diffForHumans());
    }
}
